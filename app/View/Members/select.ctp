<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<?php echo $this->Html->css('select.css');?>
<?php echo $this->Html->script('select', array('inline' => true)); ?>
<?php echo $this->Form->create('Member'); ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>席決め設定</h3>
    </div>
</div>

<p class="tohokuret"></p>
<p class="tohokuret2"></p>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">参加者設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">条件設定</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="item1" role="tabpanel" aria-labelledby="item1-tab">
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
                            if ($participants == null) {
                                $checked = true;
                            } else {
                                if (in_array($member['Member']['id'], $participants)) {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                            }
                            echo $this->Form->input('Participants.'. $index, [
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
    </div>
    <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">
        <h4>テーブル設定</h4>
        <?php
                echo $this->Form->input('Table.table_sum', [
                    'class' => 'form-control form-control-sm',
                    'div' => [
                        'class' => 'form-group col-sm-4'
                    ],
                    'options' => array_combine(
                        range(1, 10),
                        range(1, 10)
                    ),
                    'empty' => 'テーブル数を選択してください',
                    'onchange' => 'table_add(value)',
                    'label' => 'テーブル数',
                    'default' => $table_sum
            ]);
        ?>
        <table id="table" class="table table-bordered table-sm bg-light">
            <thead>
                <tr style="background-color:skyblue">
                    <th>テーブル</th>
                    <th>座席数</th>
                </tr>
            </thead>
            <?php for ($i = 0; $i < $table_sum; $i++): ?>
                <thead>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td>
                            <?php
                                echo $this->Form->input('Table.seat_sum.' . $i, [
                                    'class' => 'form-control form-control-sm col-sm-6',
                                    'options' => array_combine(
                                        range(0, 15),
                                        range(0, 15)
                                    ),
                                    'div' => false,
                                    'label' => false,
                                    'default' => $seat_sum[$i]
                                ]);
                            ?>
                        </td>
                    </tr>
                </thead>
            <?php endfor; ?>
        </table>
        <h4>優先度設定</h4>
        <table class="table table-bordered table-sm bg-light">
            <thead style="background-color:skyblue">
                <tr>
                    <th>優先度　</th>
                    <th>属性</th>
                </tr>
            </thead>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <thead>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td>
                            <?php
                            $this->log(($priority[$i]),LOG_DEBUG);
                            echo $this->Form->input('Conditions.priority.' . $i, [
                                'class' => 'form-control form-control-sm col-sm-6',
                                'options' => $attributes + $attributes_group,
                                'empty' => '優先度を選択してください',
                                'div' => false,
                                'label' => false,
                                'default' => $priority[$i]
                            ]);
                            ?>
                        </td>
                    </tr>
                </thead>
            <?php endfor; ?>
        </table>
    </div>
</div>

<?php echo $this->Form->end('シャッフル'); ?>