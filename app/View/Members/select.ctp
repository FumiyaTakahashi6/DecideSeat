<?php echo $this->Html->css('select.css');?>
<?php echo $this->Html->script('select', array('inline' => true)); ?>
<h1>ユーザー選択ページ</h1>
<?php echo $this->Form->create('Member'); ?>
<div>
    <input id="all" type="radio" name="tab_item" checked>
    <label class="tab_item" for="all">参加者設定</label>
    <input id="programming" type="radio" name="tab_item">
    <label class="tab_item" for="programming">条件設定</label>
    <div class="tab_content" id="all_content">
        <div class="tab_content_description">
            <table>
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
                            echo $this->Form->input('participant.'. $index, [
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
            echo $this->Form->input('', [
                'options' => range(1, 10),
                'empty' => 'テーブル数を選択してください',
                'onchange' => 'table_add(value)'
            ]);
        ?>
        <table id="table">
            <tr>
                <th>テーブル番号</th>
                <th>座席数</th>
            </tr>
            <tr>
            </tr>
        </table>
        <h2>条件設定</h2>
        <?php
            echo $this->Form->input('Conditions.conditions', [
                'options' => ['部署'],
                'empty' => '振り分け条件選択してください'
            ]);
        ?>
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
                            'options' => $attributes,
                            'empty' => '優先度選択してください',
                            'div' => false  
                        ]);
                        ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</div>
<?php echo $this->Form->end('Save Member'); ?>