<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="py-3">
    <h3 class="border-bottom">属性一覧</h3>
</div>
<div class="row justify-content-center">
    <div class="col-sm-9">
        <div class="px-3 pb-3">
            <?php
                echo $this->Html->link(
                    'ユーザの編集',
                    [
                        'controller' => 'Members',
                        'action' => 'index'
                    ],
                    [
                        'class' => 'btn btn-outline-secondary'
                    ]
                );
            ?>
        </div>

        <div class="bg-white border px-3">
            <div class="float-right py-3">
                <?php
                    echo $this->Html->link(
                        '新規追加',
                        [
                            'action' => 'add'
                        ],
                        [
                            'class' => 'btn btn-info'
                        ]
                    );
                ?>
            </div>
            <table class="table table-bordered table-sm bg-white">
                <thead style="background-color: #f1f1f1">
                    <tr>
                        <th style="width: 80%">名前</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <?php foreach ($attributes as $attribute): ?>
                <tr>
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
        </div>
    </div>
</div>