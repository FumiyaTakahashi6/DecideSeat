<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/redmond/jquery-ui.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') ?>
<?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js') ?>
<?= $this->Html->script('add', array('inline' => true)); ?>
<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>ユーザーの追加</h3>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-sm-7 bg-white">
        <?php
        echo $this->Form->create('Member');
        // 名前
        echo $this->Form->input('member_name',[
            'class' => 'form-control',
            'div' => [
                'class' => 'form-group'
            ],
            'label' => '名前'
        ]);
        // 性別
        echo $this->Form->input('gender', [
            'class' => 'form-control',
            'div' => [
                'class' => 'form-group'
            ],
            'options' => [
                '1' => '男性',
                '2' => '女性',
            ],
            'empty' => '性別を選択してください',
            'label' => '性別'
        ]);

        // 生年月日
        echo $this->Form->input('birthday', [
            'class' => 'form-control',
            'div' => [
                'class' => 'form-group'
            ],
            'type' => 'text',
            'id' => "datepicker_birthday",
            'label' => '生年月日'
        ]);


        // 部署
        echo $this->Form->input('department_id', [
            'class' => 'form-control',
            'div' => [
                'class' => 'form-group'
            ],
            'options' => $departments,
            'empty' => '部署を選択してください',
            'label' => '部署'
        ]);
        // 属性
        echo $this->Form->input('Attribute', [
            'type' => 'select',
            'multiple'=> 'checkbox',
            'options' => $attributes,
            'label' => '属性'
        ]);
        // 入社年数

        echo $this->Form->input('hire_date', [
            'class' => 'form-control',
            'div' => [
                'class' => 'form-group'
            ],
            'type' => 'text',
            'id' => "datepicker_hire_date",
            'label' => '入社日'
        ]);
        echo $this->Form->end('登録');
        ?>
    </div>
</div>