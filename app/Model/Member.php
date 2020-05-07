<?php

class Member extends AppModel {
    public $belongsTo = array(
        'Department' => array(
            'className' => 'Department',
            'foreignKey'=> 'department_id',
        )
    );

    public $hasAndBelongsToMany = array(
        'Attribute' => array(
        'className' => 'attribute',
        'joinTable' => 'members_attributes',
        'foreignKey' => 'member_id',
        'associationForeignKey' => 'attribute_id',
        'unique' => true
        ),
    );

    public $validate = array(
        'member_name' => array(
            'rule' => 'notBlank'
        ),
        'gender' => array(
            'rule' => 'notBlank'
        ),
        'birthday' => array(
            'rule' => 'notBlank'
        ),
        'hire_date' => array(
            'rule' => 'notBlank'
        )
    );

    public function isOwnedBy($member, $user) {
        return $this->field('id', array('id' => $member, 'user_id' => $user)) !== false;
    }
}