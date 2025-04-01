<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle("Brands"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<div class="card bg-light col-md-6 offset-md-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h2>Brands</h2>
        </div>
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandForm">
                Add New Brand
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped table-sm" id="brandsTable">
            <thead>
                <th>ID</th>
                <th>Brand Name</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach($this->brands as $brand): ?>
                    <tr data-id="<?=$brand->id?>">
                        <td><?=$brand->id?></td>
                        <td><?=$brand->name?></td>
                        <td class="text-end">
                            <a href="<?=Env::get('APP_DOMAIN')?>adminbrands/edit/<?=$brand->id?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form method="POST" 
                                action="<?=Env::get('APP_DOMAIN')?>adminbrands/delete" 
                                class="d-inline-block" 
                                onsubmit="return confirm('Are you sure you want to delete this brand? It cannot be reversed.');">
                                <?= FormHelper::hidden('id', $brand->id) ?>
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
    </div>
</div>

<?= $this->component('brands_form') ?>
<?php $this->end(); ?>
