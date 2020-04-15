<h1>ユーザー追加</h1>
<?php
echo $this->Form->create('Member');
// 名前
echo $this->Form->input('member_name');
// 性別
echo $this->Form->input('gender', [
    'options' => [  
        '1' => '男性',  
        '2' => '女性',  
    ],
    'empty' => '性別を選択してください'
]);
// 生年月日
echo $this->Form->text('birthday', ['type' => 'date']);
// 部署
echo $this->Form->input('department_id', [
    'options' => $departments,
    'empty' => '部署を選択してください'
]);
// 属性
echo $this->Form->input('Attribute', [
    'type' => 'select',
    'multiple'=> 'checkbox',
    'options' => $attributes
]);
// 入社年数
echo $this->Form->text('hire_date', ['type' => 'date']);
echo $this->Form->end('Save Member');
?>