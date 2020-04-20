<?php

class MembersController extends AppController {
    public $helpers = ['Html', 'Form', 'Flash'];
    public $components = ['Flash'];

    public function index() {
        $this->set('members', $this->Member->find('all'));
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
        
        $this->set('members', $this->Member->find('all'));
        $this->loadModel('Attribute');
        $this->set('attributes', $this->Attribute->find('list', [
            'fields' => 'Attribute.attribute_name'
        ]));
        
        $this->log(($this->request->data),LOG_DEBUG);
    }
}