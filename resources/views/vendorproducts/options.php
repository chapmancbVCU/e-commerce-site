<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle("Options"); ?>

<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h2 class="text-center">Options</h2>
<table class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <th>Id</th>
        <th>Name</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->options as $option): ?>
            <tr>
                <td><?=$option->id?></td>
                <td><?=$option->name?></td>
                <td class="text-end">
                    <a href="<?=Env::get('APP_DOMAIN')?>vendorproducts/editOption/<?=$option->id?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <form method="POST" 
                        action="<?=Env::get('APP_DOMAIN')?>vendorproducts/deleteOption" 
                        class="d-inline-block" 
                        onsubmit="return confirm('Are you sure you want to delete this option? It cannot be reversed.');">
                        <?= FormHelper::hidden('id', $option->id) ?>
                        <?= $csrfToken = FormHelper::csrfInput() ?>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>