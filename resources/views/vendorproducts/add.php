<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\Lib\Utilities\Config; ?>
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
        <?php $this->component('product_form') ?>
    </div>
</div>
<?php $this->end(); ?>

