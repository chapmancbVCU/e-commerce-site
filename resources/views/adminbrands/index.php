<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle("Brands"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=Env::get('APP_DOMAIN', '/')?>node_modules/bootstrap/dist/css/bootstrap.bundle.css" media="screen" title="no title" charset="utf-8">
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
                            <button onclick="editBrand(<?=$brand->id?>)" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Edit</button>
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
<script>
    function editBrand(id) {
        jQuery.ajax({
            url : '<?=Env::get('APP_DOMAIN')?>adminbrands/getBrandById',
            method : "POST",
            data : {id:id},
            success : function(resp) {
                if(resp) {
                    jQuery('#name').val(resp.brand.name);
                    jQuery('#brand_id').val(resp.brand.id);
                    jQuery('#addBrandFormLabel').text('Edit Brand');
                    
                    const modalEl = document.getElementById('addBrandForm');
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                } else {
                    jQuery('#name').val('');
                    jQuery('#brand_id').val('new');
                }
            }
        });
    }
</script>
<?php $this->end(); ?>
