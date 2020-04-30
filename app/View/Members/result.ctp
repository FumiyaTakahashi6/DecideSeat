<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<?= $this->Html->script('result', array('inline' => true)); ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>席決め結果</h3>
    </div>
</div>

<?php foreach ($tables_seat_result as $index => $table_seat_result): ?>
    
    <table class="table table-bordered table-sm" >
        <thead style="background-color:skyblue">
            <tr>
                <th><?php echo 'テーブル' . ($index + 1) ?></th>
            </tr>
        </thead>
        <?php foreach ($table_seat_result as $seat_result): ?>
            <thead class = "bg-light">
                <tr>
                    <td>
                        <?php echo $seat_result ?>
                    </td>
                </tr>
            </thead>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>
<div class="float-right">
    <?php echo $this->Html->link(
        '再設定',
        [
            'controller' => 'members',
            'action' => 'select'
        ],
        [
            'class' => 'btn btn-danger'
        ]
    ); ?>
</div>
