<?php

class Attribute extends AppModel {
    public $hasAndBelongsToMany = array(
        'Member' =>
          array(
            'className'              => 'member',
            'joinTable'              => 'members_attributes',
            'foreignKey'             => 'attribute_id',
            'associationForeignKey'  => 'member_id',
            'unique'                 => true,
          )
      );
}