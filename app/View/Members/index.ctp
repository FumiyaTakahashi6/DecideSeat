<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="py-3">
    <h3 class="border-bottom">ユーザ一覧</h3>
</div>
<div class="row justify-content-center">
    <div class="col-sm-9">
        <div class="px-3 pb-3">
            <?php
                echo $this->Html->link(
                '属性の編集',
                [
                    'controller' => 'attributes',
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
                            'controller' => 'members',
                            'action' => 'add'
                        ],
                        [
                            'class' => 'btn btn-info'
                        ]
                    );
                ?>
            </div>

            <div>
                <table class="table table-bordered table-sm bg-white" style="word-break: break-all;">
                    <thead style="background-color: #f1f1f1">
                        <tr>
                            <th style="width: 20%">名前</th>
                            <th style="width: 10%">性別</th>
                            <th style="width: 10%">部署</th>
                            <th style="width: 10%">生年月日</th>
                            <th style="width: 20%">属性</th>
                            <th style="width: 10%">入社年数</th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?= h($member['Member']['member_name']); ?></td>
                        <td>
                            <?php
                                $genders = array('', '男性', '女性');
                                echo h($genders[$member['Member']['gender']]);
                            ?>
                        </td>
                        <td><?= h($member['Department']['department_name']); ?></td>
                        <td><?= h($member['Member']['birthday']); ?></td>
                        <td>
                            <?php foreach ($member['Attribute'] as $attribute): ?>
                                <?= h($attribute['attribute_name']); ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php
                                $years_of_employment = floor((date('Ymd') - str_replace('-', '', $member['Member']['hire_date'])) / 10000);
                                echo h($years_of_employment) . '年';
                            ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link(
                                '編集',
                                [
                                    'action' => 'edit',
                                    $member['Member']['id']
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
                                        $member['Member']['id']
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
                    <?php unset($member); ?>
                </table>
            </div>
        </div>
    </div>
</div>