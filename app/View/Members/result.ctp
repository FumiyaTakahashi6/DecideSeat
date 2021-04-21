<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-alpha.12/dist/html2canvas.min.js') ?>
<?= $this->Html->script('result', ['inline' => true]); ?>

<?php $this->assign('title', '席決め結果'); ?>
<div class="py-3">
    <h3 class="border-bottom">席決め結果</h3>
</div>
<div class="row justify-content-center">
    <div id="result" class="row col-sm-8 m-0 bg-white border">
        <?php foreach ($tables_seat_result as $index => $table_seat_result): ?>
            <div class="col-sm-3">
                <table class="table table-bordered table-sm bg-white" style="margin-top: 1rem; word-break: break-all;">
                    <thead style="background: #f1f1f1">
                        <tr>
                            <th><?= 'テーブル' . ($index + 1) ?></th>
                        </tr>
                    </thead>
                    <?php foreach ($table_seat_result as $seat_result): ?>
                        <thead>
                            <tr>
                                <td><?= h($seat_result) ?></td>
                            </tr>
                        </thead>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row justify-content-center py-3">
    <div class="col-sm-8 p-0">
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
    </div>
</div>
