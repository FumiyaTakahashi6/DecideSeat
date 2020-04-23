<?php

class MembersController extends AppController {
    public $helpers = ['Html', 'Form', 'Flash'];
    public $components = ['Flash'];

    public function index() {
        $this->set('members', $this->Member->find('all',[
            'order' => array('Member.id ASC')
        ]));
    }

    // ユーザーの追加
    public function add() {
        // 部署データ
        $this->loadModel('Department');
        $this->set('departments', $this->Department->find('list', [
            'fields' => 'Department.department_name'
        ]));
        // 属性データ
        $this->loadModel('Attribute');
        $this->set('attributes', $this->Attribute->find('list', [
            'fields' => 'Attribute.attribute_name'
        ]));

        if ($this->request->is('post')) {
            $this->Member->create();
            // $this->log(($this->request->data),LOG_DEBUG);
            // debug($this->request->data);
            if ($this->Member->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
    // ユーザー編集
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }
        $member = $this->Member->findById($id);
        $this->log($member,LOG_DEBUG);

        if (!$member) {
            throw new NotFoundException(__('Invalid'));
        }

        // 部署データ
        $this->loadModel('Department');
        $this->set('departments', $this->Department->find('list', [
            'fields' => 'Department.department_name'
        ]));
        
        // 属性データ
        $this->loadModel('Attribute');
        $this->set('attributes', $this->Attribute->find('list', [
            'fields' => 'Attribute.attribute_name'
        ]));
    
        if ($this->request->is(['post', 'put'])) {
            $this->Member->id = $id;
            if ($this->Member->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your post.'));
        }
    
        if (!$this->request->data) {
            $this->request->data = $member;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Member->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }
    
        return $this->redirect(['action' => 'index']);
    }



    public function select() {
        //$this->request->data = $this->request->query 
        $this->log($this->request,LOG_DEBUG);

        // メンバーデータの送信
        $this->set('members', $this->Member->find('all',[
            'order' => array('Member.id ASC')
        ]));
        
        // 属性データの送信
        $this->loadModel('Attribute');
        $this->set('attributes', $this->Attribute->find('list', [
            'fields' => 'Attribute.attribute_name'
        ]));

        // 属性グループデータの送信
        $this->set('attributes_group', [
            '部署' => '部署'
        ]);


        if ($this->request->is('post')) {
            // 参加者データの取得
            $participants_id = $this->request->data['Participants'];
            $participants = $this->Member->find('all', [
                'conditions'=>array('Member.id'=> $participants_id),
                'order' => 'RAND()'
            ]);

            // 座席データの取得
            $table_sum = $this->request->data['Table']['table_sum'];
            $tables_seat_sum = $this->request->data['Table']['seat_sum'];
            
            // 優先度データ
            $prioritys = array_filter($this->request->data['Conditions']['priority']);

            //  部署データの取得
            $this->loadModel('Department');
            $departments_id = $this->Department->find('list', [
                'fields' => 'Department.id',
                'order' => 'RAND()'
            ]);

            
            // 優先度順に並び替える
            // 優先度順にソートしたデータを格納
            $participants_sort = [];
            $priority_group_num = 0;
            foreach ($prioritys as $priority_index => $priority) {
                unset($prioritys[$priority_index]);
                // 優先度で部署が選択された場合 break
                if ($priority == '部署'){
                    $priority_group_num = 1;
                    break;
                }
                foreach ($participants as $participant_index => $participant) {
                    foreach ($participant['Attribute'] as $attribute) {
                        // 選択された優先度の要素とユーザーが持っている属性が一致した場合
                        if ($priority == $attribute['id']){
                            $participants_sort[] = $participant;
                            unset($participants[$participant_index]);
                        }
                    }
                }
            }
            // 優先度で部署が選択された場合
            if ($priority_group_num == 1){
                $departments_members = [];
                // 部署毎に分類
                foreach ($departments_id as $department_id) {
                    foreach ($participants as $participant_index => $participant) {
                        if ($department_id == $participant['Department']['id']){
                            $departments_members[$department_id][] = $participant;
                            unset($participants[$participant_index]);
                        }
                    }
                }

                // 部署内で優先度順に分類
                foreach ($departments_members as $department_members) {
                    foreach ($prioritys as $priority_index => $priority) {
                        foreach ($department_members as $department_member_index => $department_member) {
                            foreach ($department_member['Attribute'] as $attribute) {
                                if ($priority == $attribute['id']){
                                    $participants_sort[] = $department_member;
                                    unset($department_members[$department_member_index]);
                                }
                            }
                        }
                    }
                    // 部署内で優先度の属性に該当しない人の追加
                    $participants_sort = array_merge($participants_sort, $department_members);
                }
            }
            // 部署が指定されていない人の追加
            $participants_sort = array_merge($participants_sort, $participants);
            

            //　テーブルの人数毎に振り分け
            // テーブルに番号を与える
            for ($i = 0; $i < $table_sum * max($tables_seat_sum); $i++) {
                $table_num = $i % $table_sum;
                $tables_seat_template[$table_num][] = [$i,$table_num];
            }
            foreach ($tables_seat_sum as $index => $table_seat_sum) {
               array_splice($tables_seat_template[$index], $table_seat_sum);
            }

            $tables_seat_templates2 = [];
            // 連想配列を配列に変更
            foreach ($tables_seat_template as $table_seat_template) {
                $tables_seat_templates2 = array_merge($tables_seat_templates2, $table_seat_template);
            }
            // 座席番号順にソート
            foreach ($tables_seat_templates2 as $index => $table_seat_templates2) {
                $sort[$index] = $table_seat_templates2[0];
            }
            array_multisort($sort, SORT_ASC, $tables_seat_templates2);
            
            // 席番号をkey,テーブル番号をvalue
            foreach ($tables_seat_templates2 as $index => $table_seat_templates2) {
                $tables_seat_templates3[$index] = $table_seat_templates2[1];
            }

            // ソートデータから名前だけを抽出
            foreach ($participants_sort as $index => $participant_sort) {
                $participants_name[$index] = $participant_sort['Member']['member_name'];
            }

            // 名前をkey,座席番号をvalue
            $tables_seat_result = array_combine($participants_name, $tables_seat_templates3);
            // 連想配列に変更
            foreach ($tables_seat_result as $key => $table_seat_result) {
                $table_seat_result2[$table_seat_result][] = $key;
            }
            $this->set('tables_seat_result',$table_seat_result2);
            $this->render('result');
        }
    }
}