<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>属性の編集</h3>
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

// echo $this->Form->input('Member', [
//     'type' => 'select',
//     'multiple'=> 'checkbox',
//     'options' => $members,
// ]);
?>
<table class="table table-bordered table-sm　bg-light" id="participant_table" >
            <thead style="background-color:skyblue">
                <tr>
                    <th>選択</th>
                    <th>名前</th>
                    <th>性別</th>
                    <th>部署</th>
                    <th>属性</th>
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