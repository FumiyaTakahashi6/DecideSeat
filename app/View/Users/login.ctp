<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>
<div class="w-100 p-3 ">
    <div class="w-100 p-2 border-bottom">
        <h3>ログイン</h3>
    </div>
</div>


<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div class="col-12">
    <div class="w-50 mx-auto shadow-sm">
        <fieldset>
            <?php echo $this->Form->input('username',[
                'class' => 'form-control',
                'div' => [
                    'class' => 'form-group'
                ],
                'label' => 'name'
            ]);
            echo $this->Form->input('password',[
                'class' => 'form-control',
                'div' => [
                    'class' => 'form-group'
                ],
                'label' => 'password'
            ]);
        ?>
        </fieldset>
        <div class="col text-center">
        <?php
            echo $this->Form->button('ログイン', [
                'type' => 'submit',
                'class' => 'btn btn-primary mx-auto'
            ]);
        ?>
        <?= $this->Form->end(); ?>
        </div>
    </div>
</div>