<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>属性の追加</h3>
    </div>
</div>

<?php
echo $this->Form->create('Attribute');

echo $this->Form->input('attribute_name',[
    'class' => 'form-control',
    'div' => [
        'class' => 'form-group col-sm-6'
    ],
    'label' => '属性の名前'
]);

echo $this->Form->end('追加');
?>