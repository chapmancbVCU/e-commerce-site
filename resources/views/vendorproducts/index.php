<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle("My Products"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<?= $csrfToken = FormHelper::csrfInput() ?>
<table class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <th>Name</th>
        <th>Price</th>
        <th>Shipping</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->products as $product): ?>
            <tr data-id="<?=$product->id?>">
                <td><?=$product->name?></td>
                <td><?=$product->price?></td>
                <td><?=$product->shipping?></td>
                <td class="text-end">
                    <a href="<?=Env::get('APP_DOMAIN')?>vendorproducts/edit/<?=$product->id?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <form method="POST" 
                        action="<?=Env::get('APP_DOMAIN')?>vendorproducts/delete" 
                        class="d-inline-block" 
                        onsubmit="return 
                        confirm('Are you sure you want to delete this product? It cannot be reversed.');"
                    >
                        <?= FormHelper::hidden('id', $product->id) ?>
                        <?= $csrfToken ?>
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