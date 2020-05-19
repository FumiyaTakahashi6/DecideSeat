<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="py-3">
    <h3 class="border-bottom">属性の編集</h3>
</div>
<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="px-3 pb-3">
            <?php
                echo $this->Html->link(
                '＜戻る',
                [
                    'action' => 'index'
                ],
                [
                    'class' => 'btn btn-outline-secondary'
                ]
            );
            ?>
        </div>

        <div class="bg-white border px-3">
            <?php
            echo $this->Form->create('Attribute');

            echo $this->Form->input('attribute_name',[
                'class' => 'form-control',
                'div' => [
                    'class' => 'form-group'
                ],
                'label' => '属性の名前'
            ]);
            ?>
            <table class="table table-bordered table-sm bg-white" style="word-break: break-all;">
                <thead style="background-color: #f1f1f1">
                    <tr>
                        <th style="width: 10%">選択</th>
                        <th style="width: 25%">名前</th>
                        <th style="width: 12%">性別</th>
                        <th style="width: 23%">部署</th>
                        <th style="width: 30%">属性</th>
                    </tr>
                </thead>
                <?php foreach ($members as $index => $member): ?>
                    <tr>
                        <td>
                            <?php
                                if (in_array($member['Member']['id'], $members_attributes)) {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                echo $this->Form->input('Member.'. $index, [
                                    'type' => 'checkbox',
                                    'value' => $member['Member']['id'],
                                    'hiddenField' => false,
                                    'checked' => $checked,
                                    'label' => false,
                            ]);
                            ?>
                        </td>
                        <td><?= h($member['Member']['member_name']); ?></td>
                        <td>
                            <?php
                                $genders = ['', '男性', '女性'];
                                echo h($genders[$member['Member']['gender']]);
                            ?>
                        </td>
                        <td><?= h($member['Department']['department_name']); ?></td>
                        <td>
                            <?php foreach ($member['Attribute'] as $attribute): ?>
                                <?= h($attribute['attribute_name']); ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php unset($member); ?>
                </table>
            <?php
                echo $this->Form->end('変更');
            ?>
        </div>
    </div>
<div>