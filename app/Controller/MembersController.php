<?php

class MembersController extends AppController {
    public $helpers = ['Html', 'Form', 'Flash'];
    public $components = ['Flash'];

    public function index() {
        debug($this->Member->findById(1));
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
            if ($this->Member->saveAssociated($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
}