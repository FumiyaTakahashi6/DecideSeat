<h1>ユーザー登録ページ</h1>
<h2>ユーザー追加</h2>
<table>
    <tr>
        <th>名前</th>
        <th>性別</th>
        <th>部署</th>
        <th>生年月日</th>
        <th>属性</th>
        <th>入社年数</th>
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
                echo $age . '年';
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($member); ?>
</table>