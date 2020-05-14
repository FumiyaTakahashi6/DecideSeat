<?= $this->Html->css('bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js'); ?>
<?= $this->Html->script('bootstrap.min.js') ?>

<div class="py-3">
    <h3 class="border-bottom">ログイン</h3>
</div>

<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div class="row justify-content-center">
    <div class="row justify-content-center col-sm-5 bg-white border">
        <div class="col-sm-10">
            <div class="text-center">
                <h2>Sign In</h2>
            </div>
            <fieldset>
                <?php
                echo $this->Form->input('username', [
                    'class' => 'form-control',
                    'div' => [
                        'class' => 'form-group'
                    ],
                    'label' => false,
                    'placeholder' => 'ユーザー名'
                ]);
                echo $this->Form->input('password', [
                    'class' => 'form-control',
                    'div' => [
                        'class' => 'form-group'
                    ],
                    'label' => false,
                    'placeholder' => 'パスワード'
                ]);
            ?>
            </fieldset>
            <div class="text-center">
                <?php
                    echo $this->Form->button('Sign in', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary w-100'
                    ]);
                ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>