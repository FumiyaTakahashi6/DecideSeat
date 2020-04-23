<?php echo $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?php echo $this->Html->script('result', array('inline' => true)); ?>
<?php foreach ($tables_seat_result as $index => $table_seat_result): ?>
    <h1><?php echo 'テーブル' . ($index + 1) ?></h1>
    <table class="table">
        <?php foreach ($table_seat_result as $seat_result): ?>
            <tr>
                <td>
                    <?php echo $seat_result ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>
