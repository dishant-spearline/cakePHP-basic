<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <!-- <li role="separator" class="divider"></li> -->
        <!-- <li class="heading"><?= $viewName ?></li> -->

        
        <?php if($this->getTemplate() == 'view' && ($isAuthorized)){

            $viewNameLower = strtolower($viewName);

            ?>

            <li><?= $this->Html->link(__('Edit '.$viewName), ['action' => 'edit', $$viewNameLower->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete '.$viewName), ['action' => 'delete', $$viewNameLower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $$viewNameLower->id)]) ?> </li>
            
            <?php } ?>
            
            <li role="separator" class="divider"></li>
            <li class="heading">My Account</li>
            
            <li><?= $this->Html->link(__('Chanage Password'), ['controller' => 'Users', 'action' => 'changePassword']) ?></li>
            
            <?php if($auth['User']['role_id'] == 1) { ?>
                <li role="separator" class="divider"></li>
                <li class="heading">Admin</li>
                
                <li><?= $this->Html->link(__('New '.$viewName), ['action' => 'add']); ?></li>
                <li><?= $this->Html->link(__('User'), ['controller' => 'Users', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
            <?php } ?>
        </ul>
</nav>