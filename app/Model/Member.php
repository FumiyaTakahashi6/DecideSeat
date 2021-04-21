<?php
class Member extends AppModel
{
    public $belongsTo = [
        'Department' => [
            'className' => 'Department',
            'foreignKey'=> 'department_id',
        ]
    ];

    public $hasAndBelongsToMany = [
        'Attribute' => [
            'className' => 'attribute',
            'joinTable' => 'members_attributes',
            'foreignKey' => 'member_id',
            'associationForeignKey' => 'attribute_id',
            'unique' => true
        ],
    ];

    public $validate = [
        'member_name' => [
            'rule' => 'isUnique'
        ],
        'gender' => [
            'rule' => 'notBlank'
        ],
    ];

    public function isOwnedBy($member, $user)
    {
        return $this->field('id', ['id' => $member, 'user_id' => $user]) !== false;
    }
}
