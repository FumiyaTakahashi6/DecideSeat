<?php

class MembersController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->log($this->Member->find('all'));
        $this->set('members', $this->Member->find('all'));
    }
}