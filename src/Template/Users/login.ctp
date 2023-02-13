<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users form large-9 medium-8 columns content d-flex align-items-center justify-content-center">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <legend class="mb-3"><?= __('Login') ?></legend>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <?= $this->Form->create() ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('email', ['class' => 'form-control', 'placeholder' => 'Enter your email']) ?>
                        </div>

                        <div class="form-group">
                            <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter your password']) ?>
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <?= $this->Form->button(__('Login in'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </fieldset>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>