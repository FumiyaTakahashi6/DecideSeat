<h1>ユーザー登録ページ</h1>
<?php echo $this->Html->link(
    'ユーザー追加',
    array('controller' => 'members', 'action' => 'add')
); ?>
<table>
    <tr>
        <th>名前</th>
        <th>性別</th>
        <th>部署</th>
        <th>生年月日</th>
        <th>属性</th>
        <th>入社年数</th>
        <th>操作</th>
    </tr>

    <?php foreach ($members as $member): ?>
    <tr>
        <td><?php echo $member['Member']['member_name']; ?></td>
        <td>
            <?php 
                $genders = array('', '男性', '女性');
                echo $genders[$member['Member']['gender']]; 
            ?>
        </td>
        <td><?php echo $member['Department']['department_name']; ?></td>
        <td>
            <?php 
                $age = floor((date('Ymd') - str_replace('-', '', $member['Member']['birthday'])) / 10000);
                echo $age . '歳';
            ?>
        </td>
        <td>
            <?php foreach ($member['Attribute'] as $attribute): ?>
                <?php echo $attribute['attribute_name']; ?>
            <?php endforeach; ?>
        </td>
        <td>
            <?php 
                $years_of_employment = floor((date('Ymd') - str_replace('-', '', $member['Member']['hire_date'])) / 10000);
                echo $years_of_employment . '年';
            ?>
        </td>
        <td>
            <?php
                echo $this->Html->link(
                    '編集',
                    ['action' => 'edit', $member['Member']['id']]
                );
            ?>
            <?php
                echo $this->Form->postLink(
                    '削除',
                    ['action' => 'delete', $member['Member']['id']],
                    ['confirm' => 'Are you sure?']
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($member); ?>
</table>