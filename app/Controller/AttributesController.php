<?php
class AttributesController extends AppController
{
    public $helpers = ['Html', 'Form', 'Flash'];
    public $components = ['Flash'];

    public function index()
    {
        $this->set(
            'attributes',
            $this->Attribute->find(
                'all', [
                'order' => array('Attribute.id ASC')
                ]
            )
        );
    }

    public function add()
    {
        $this->loadModel('Attribute');
        $this->loadModel('Member');
        $this->set(
            'members',
            $this->Member->find(
                'all', [
                'order' => array('Member.id ASC'),
                ]
            )
        );

        if ($this->request->is('post')) {
            $this->Attribute->create();
            if ($this->Attribute->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('controller' => 'attributes', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function edit($id = null)
    {
        $this->loadModel('Member');
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }
        $attribute = $this->Attribute->findById($id);
        if (!$attribute) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set(
            'members',
            $this->Member->find(
                'all', [
                'order' => array('Member.id ASC'),
                ]
            )
        );

        $this->loadModel('Members_attribute');
        $this->set(
            'members_attributes',
            $this->Members_attribute->find(
                'list', [
                'conditions' => array('Members_attribute.attribute_id' => $id),
                'fields' => 'Members_attribute.member_id'
                ]
            )
        );

        if ($this->request->is(['post', 'put'])) {
            $this->Attribute->id = $id;
            if (empty($this->request->data['Member'])) {
                $this->request->data['Member'] = [];
            }
            if ($this->Attribute->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $attribute;
        }
    }

    public function delete($id)
    {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Attribute->delete($id)) {
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
}

