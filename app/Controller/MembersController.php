<?php

class MembersController extends AppController {
    public $helpers = ['Html', 'Form', 'Flash'];
    public $components = ['Flash'];

    public function index() {
        //$this->log($this->Member->find('all'));
        $this->set('members', $this->Member->find('all'));
    }

    public function add() {
        // 部署データ
        $this->loadModel('Department');
        $this->set('departments', $this->Department->find('list', array(
            'fields' => array('Department.department_name')
        )));
        // 属性データ
        $this->loadModel('Attribute');
        $this->set('attributes', $this->Attribute->find('list', array(
            'fields' => array('Attribute.attribute_name')
        )));

        if ($this->request->is('post')) {
            $this->Member->create();
            if ($this->Member->saveAssociated($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
}