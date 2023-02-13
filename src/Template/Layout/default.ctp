<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if($auth) {?>
                    <li><a href=""><?= $auth['User']['email'] ?></a></li>
                    <li><?= $this->Html->link('Logout', ['controller'=>'Users', 'action'=>'logout']); ?></li>
                <?php }else{?>
                    <li><?= $this->Html->link('Sign Up', ['controller'=>'Users', 'action'=>'signup']); ?></li>
                    <li><?= $this->Html->link('Login', ['controller'=>'Users', 'action'=>'login']); ?></li>
                    <li><?= $this->Html->link('Forgot Password', ['controller'=>'Users', 'action'=>'forgotPassword']); ?></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix m-0 p-0 mw-100">
        <?php
            if($auth){
                $currentViewDetiails =  strtolower($Inflector::singularize($this->name));

                if(isset($$currentViewDetiails->user_id)){
                    $$currentViewDetiailsID = $$currentViewDetiails->user_id;
                }

                if($currentViewDetiails == 'User'){
                    $currentViewDetiailsID = $$currentViewDetiails->id;
                }

                $isAuthorized = false;
                if(isset($$currentViewDetiails) && $$currentViewDetiails -> id == $auth['User']['id'] || $auth['User']['role_id'] == 1){
                    $isAuthorized = true;
                }
                echo $this->element('sidemenus/side_menu_logged_in', ['viewName' => $Inflector::singularize($this->name), 'isAuthorized' => $isAuthorized]);
            }else{
                echo $this->element('sidemenus/side_menu_logged_out');
            }
        ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
