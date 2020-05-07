<?php

class AttributesController extends AppController
{
    public $helpers = ['Html', 'Form', 'Flash'];
    public $components = ['Flash'];

    public function add()
    {
        if ($this->request->is('post')) {
            $this->Attribute->create();
            if ($this->Attribute->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('controller' => 'members', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
}