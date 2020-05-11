<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>ユーザー一覧</h3>
    </div>
</div>

<div class="float-right">
    <?php
        echo $this->Html->link(
            '属性の追加',
            [
                'controller' => 'attributes',
                'action' => 'add'
            ],
            [
                'class' => 'btn btn-outline-secondary'
            ]
        );
        echo $this->Html->link(
            '属性の削除',
            [
                'controller' => 'attributes',
                'action' => 'delete'
            ],
            [
                'class' => 'btn btn-outline-secondary'
            ]
        );
        echo $this->Html->link(
            'ユーザーの新規追加',
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
<table class="table table-bordered table-sm">
    <thead style="background-color:skyblue">
        <tr>
            <th>名前</th>
            <th>性別</th>
            <th>部署</th>
            <th>生年月日</th>
            <th>属性</th>
            <th>入社年数</th>
            <th>操作</th>
        </tr>
    </thead>
    <?php foreach ($members as $member): ?>
    <tr class="bg-light">
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