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

    public function delete()
    {
        $this->set('attributes', $this->Attribute->find('list', [
            'order' => 'Attribute.id ASC',
            'fields' => 'Attribute.attribute_name'
        ]));

        if ($this->request->is('post')) {
            if (!empty($this->request->data['Attribute']['id'])) {
                if ($this->Attribute->deleteAll(['Attribute.id' => $this->request->data['Attribute']['id']])) {
                    $this->Flash->success(__('Your post has been saved.'));
                    return $this->redirect(array('controller' => 'members', 'action' => 'index'));
                }
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
}
