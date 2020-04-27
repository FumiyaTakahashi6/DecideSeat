<?php echo $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?php echo $this->Html->css('select.css');?>
<?php echo $this->Html->script('select', array('inline' => true)); ?>
<h1>ユーザー選択ページ</h1>
<?php echo $this->Html->link(
    'ユーザー登録',
    array('controller' => 'members', 'action' => 'index')
); ?>
<?php echo $this->Form->create('Member'); ?>
<div>
    <input id="all" type="radio" name="tab_item" checked>
    <label class="tab_item" for="all">参加者設定</label>
    <input id="programming" type="radio" name="tab_item">
    <label class="tab_item" for="programming">条件設定</label>
    <p class="tohokuret"></p>
    <div class="tab_content" id="all_content">
        <div class="tab_content_description">
            <table id=participant_table >
                <tr>
                    <th>選択</th>
                    <th>名前</th>
                    <th>性別</th>
                    <th>部署</th>
                    <th>属性</th>
                </tr>
                <?php foreach ($members as $index => $member): ?>
                <tr>
                    <td>
                        <?php
                            echo $this->Form->input('Participants.'. $index, [
                                'type' => 'checkbox',
                                'value' => $member['Member']['id'],
                                'hiddenField' => false,
                                'checked' => true
                        ]);
                        ?>
                    </td>
                    <td><?php echo $member['Member']['member_name']; ?></td>
                    <td>
                        <?php 
                            $genders = ['', '男性', '女性'];
                            echo $genders[$member['Member']['gender']]; 
                        ?>
                    </td>
                    <td><?php echo $member['Department']['department_name']; ?></td>
                    <td>
                        <?php foreach ($member['Attribute'] as $attribute): ?>
                            <?php echo $attribute['attribute_name']; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                    <?php endforeach; ?>
                    <?php unset($member); ?>
            </table> 
        </div>
    </div>

    <div class="tab_content" id="programming_content">
        <h2>テーブル設定</h2>
        <?php 
            echo $this->Form->input('Table.table_sum', [
                'options' => array_combine(
                    range(1, 10),
                    range(1, 10)
                ),
                'empty' => 'テーブル数を選択してください',
                'onchange' => 'table_add(value)',
                'label' => false,
                'default' => $table_sum
            ]);
        ?>
        <table id="table">
            <tr>
                <th>テーブル番号</th>
                <th>座席数</th>
            </tr>
                <?php for ($i = 0; $i < $table_sum; $i++): ?>
            <tr>
                <td><?php echo $i + 1 ?></td>
                <td>
                <?php 
                    echo $this->Form->input('Table.seat_sum.' . $i, [
                        'options' => array_combine(
                            range(1, 5),
                            range(1, 5)
                        ),
                        'div' => false,  
                        'label' => false,
                        'default' => $seat_sum[$i]
                    ]);
                ?>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
        <h2>条件設定</h2>
        <table>
            <tr>
                <th>優先度</th>
                <th>属性</th>
            </tr>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td>
                        <?php
                        echo $this->Form->input('Conditions.priority.' . $i, [
                            'options' => $attributes + $attributes_group,
                            'empty' => '優先度選択してください',
                            'div' => false,
                            'label' => false,
                            'default' => $priority[$i]
                        ]);
                        ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</div>
<?php echo $this->Form->end('シャッフル'); ?>