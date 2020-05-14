<?php

class Attribute extends AppModel
{
    public $hasAndBelongsToMany = array(
        'Member' => array(
            'className' => 'member',
            'joinTable' => 'members_attributes',
            'foreignKey' => 'attribute_id',
            'associationForeignKey' => 'member_id',
            'unique' => true,
        )
    );

    public $validate = array(
        'attribute_name' => array(
          'rule' => 'isUnique',
          'message' => '登録済の属性です。'
        ),
    );
}
