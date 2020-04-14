<h1>Add Post</h1>
<?php
echo $this->Form->create('Member');
// 名前
echo $this->Form->input('Member.member_name');
// 性別
echo $this->Form->input('Member.gender', array(
    'options' => [  
        '1' => '男性',  
        '2' => '女性',  
    ],
    'empty' => '性別を選択してください'
));
// 生年月日
echo $this->Form->text('Member.birthday', array('type' => 'date'));
// 部署
echo $this->Form->input('Member.department_id', array(
    'options' => $departments,
    'empty' => '部署を選択してください'
));
// 属性
echo $this->Form->input('Attribute.attribute_id', array(
    'options' => $attributes,
    'empty' => '属性を選択してください'
));
// 入社年数
echo $this->Form->text('Member.hire_date', array('type' => 'date'));
echo $this->Form->end('Save Member');
?>