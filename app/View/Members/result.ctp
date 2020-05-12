<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-alpha.12/dist/html2canvas.min.js') ?>
<?= $this->Html->script('result', array('inline' => true)); ?>

<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>席決め結果</h3>
    </div>
</div>
<div id="result">
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
                            <?= h($seat_result) ?>
                        </td>
                    </tr>
                </thead>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
</div>
<div class="float-right">
    <?php echo $this->Html->link(
        '再設定',
        [
            'action' => 'select'
        ],
        [
            'class' => 'btn btn-danger'
        ]
    ); ?>
    <button id="saveImage" class="btn btn-success" type="button">結果を保存</button>
</div>
