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
        'className' => 'Attribute',
        'joinTable' => 'members_attributes',
        'foreignKey' => 'member_id',
        'associationForeignKey' => 'attribute_id',
        'unique' => true
        ),
    );
}