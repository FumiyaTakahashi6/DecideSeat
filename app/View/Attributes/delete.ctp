<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>属性の削除</h3>
    </div>
</div>

<?php

echo $this->Form->create('Attribute');

echo $this->Form->input('id', [
    'type' => 'select',
    'multiple'=> 'checkbox',
    'options' => $attributes,
    'label' => '属性'
]);

echo $this->Form->end('削除');
?>