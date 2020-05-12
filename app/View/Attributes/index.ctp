<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>属性一覧</h3>
    </div>
</div>

<div class="float-right">
    <?php
        echo $this->Html->link(
            '属性の追加',
            [
                'action' => 'add'
            ],
            [
                'class' => 'btn btn-outline-secondary'
            ]
        );
    ?>
</div>
<table class="table table-bordered table-sm">
    <thead style="background-color:skyblue">
        <tr>
            <th>名前</th>
            <th>操作</th>
        </tr>
    </thead>
    <?php foreach ($attributes as $attribute): ?>
    <tr class="bg-light">
        <td><?= h($attribute['Attribute']['attribute_name']); ?></td>
        <td>
            <?php echo $this->Html->link(
                '編集',
                [
                    'action' => 'edit',
                    $attribute['Attribute']['id']
                ],
                [
                    'class' => 'btn btn-success'
                ]
            ); ?>
            <?php
                echo $this->Form->postLink(
                    '削除',
                    [
                        'action' => 'delete',
                        $attribute['Attribute']['id']
                    ],
                    [
                        'confirm' => '本当に削除してもよろしいですか?',
                        'class' => 'btn btn-danger'
                    ]
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($attribute); ?>
</table>