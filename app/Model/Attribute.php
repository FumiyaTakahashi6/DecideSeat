<?php
class Attribute extends AppModel
{
    public $hasAndBelongsToMany = [
        'Member' => [
            'className' => 'member',
            'joinTable' => 'members_attributes',
            'foreignKey' => 'attribute_id',
            'associationForeignKey' => 'member_id',
            'unique' => true,
        ]
    ];

    public $validate = [
        'attribute_name' => [
            'rule' => 'isUnique',
            'message' => '登録済の属性です。'
        ],
    ];
}
