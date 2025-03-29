<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\Lib\Utilities\Config; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle("Add Product"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<script src="<?=Env::get('APP_DOMAIN', '/')?>vendor/tinymce/tinymce/tinymce.min.js?v=<?=Config::get('config.version')?>"></script>
<script src='<?=Env::get('APP_DOMAIN', '/')?>resources/js/descriptionTinyMCE.js'></script>
<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h1 class="text-center">Add New Product</h1>
<div class="row g-3">
    <div class="col-md-10 offset-md-1 bg-light p-4 rounded shadow-sm">
        <form class="form" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
            <!-- Common form elements -->
            <?php $this->component('product_form') ?>

            <div class="col-md-12 text-end">
            <a href="<?=Env::get('APP_DOMAIN', '/')?>vendorproducts" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Save', ['class' => 'btn btn-primary']); ?>
            </div>
        </form>   
    </div>
</div>
<?php $this->end(); ?>
