<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<?php echo $this->Html->css('select.css');?>
<?php echo $this->Html->script('select', ['inline' => true]); ?>

<?php $this->assign('title', '席決め設定'); ?>
<div class="py-3">
    <h3 class="border-bottom">席決め設定</h3>
</div>
<div class="border bg-white">
    <div class="p-1">
    【参加者設定】
    <br>【条件設定】
    <br>【注意】
    </div>
</div>
<?php echo $this->Form->create('Member'); ?>
<div class="row">
    <div class="col-sm-9">
        <ul class="nav nav-tabs m-0" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">参加者設定</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">条件設定</a>
            </li>
        </ul>

        <div class="tab-content bg-white border-left border-bottom border-right">
            <div class="tab-pane fade show active" id="item1" role="tabpanel" aria-labelledby="item1-tab">
                    <table class="table table-bordered table-sm bg-white" id="participant_table" style="word-break: break-all;">
                        <thead style="background: #f1f1f1">
                            <tr>
                                <th style="width: 10%">選択</th>
                                <th style="width: 30%">名前</th>
                                <th style="width: 15%">性別</th>
                                <th style="width: 15%">部署</th>
                                <th style="width: 30%">属性</th>
                            </tr>
                        </thead>
                        <thead>
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
                        </thead>
                        <?php unset($member); ?>
                    </table>
            </div>
            <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">
                <div id="table_setting">
                    <h4>テーブル設定</h4>
                    <?php
                            echo $this->Form->input('Table.table_sum', [
                                'class' => 'form-control form-control-sm',
                                'div' => [
                                    'class' => 'form-group col-sm-5'
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
                    <table id="seat_table" class="table table-bordered table-sm bg-white" style="word-break: break-all;">
                        <thead>
                            <tr style="background: #f1f1f1">
                                <th style="width: 30%">テーブル</th>
                                <th style="width: 70%">座席数</th>
                            </tr>
                        </thead>
                        <thead>
                            <?php for ($i = 0; $i < $table_sum; $i++): ?>
                                <tr>
                                    <td><?php echo $i + 1 ?></td>
                                    <td>
                                        <?php
                                            echo $this->Form->input('Table.seat_sum.' . $i, [
                                                'class' => 'form-control form-control-sm col-sm-6',
                                                'options' => array_combine(
                                                    range(0, 20),
                                                    range(0, 20)
                                                ),
                                                'div' => false,
                                                'label' => false,
                                                'default' => $seat_sum[$i]
                                            ]);
                                        ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </thead>
                    </table>
                </div>
                <div>
                    <h4>優先度設定</h4>
                    <table class="table table-bordered table-sm bg-white" style="word-break: break-all;">
                        <thead style="background: #f1f1f1">
                            <tr>
                                <th style="width: 30%">優先度</th>
                                <th style="width: 70%">属性</th>
                            </tr>
                        </thead>
                        <thead>
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td>
                                        <?php
                                        echo $this->Form->input('Conditions.priority.' . $i, [
                                            'class' => 'form-control form-control-sm col-sm-6',
                                            'options' => $attributes + $attributes_group,
                                            'empty' => '属性を選択してください',
                                            'div' => false,
                                            'label' => false,
                                            'default' => $priority[$i]
                                        ]);
                                        ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="border bg-white" style="margin-top: 41px">
            <div class="tohokuret"></div>
            <div class="tohokuret2"></div>
            <div class="tohokuret3 text-danger"></div>
        </div>
    </div>
</div>

<?php echo $this->Form->end('シャッフル'); ?>