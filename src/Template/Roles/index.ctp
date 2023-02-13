<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
?>

<div class="roles index large-9 medium-8 columns content">
    <h3><?= __('Roles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" width="5%"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" width="40%"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col" class="actions" width="10%"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= $this->Number->format($role->id) ?></td>
                <td><?= $this->Html->link(__(h($role->name)), ['action' => 'view', $role->id]) ?></td>
                <td><?= h($role->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id], ['class' => 'btn btn-success btn-sm']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete role: {0}?', $role->name)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
