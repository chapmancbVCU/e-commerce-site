<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\Lib\Utilities\Config; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle('Edit ' . $this->product->name); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=Env::get('APP_DOMAIN', '/')?>resources/css/profileImage.css?v=<?=Config::get('config.version')?>" media="screen" title="no title" charset="utf-8">
<script src="<?=Env::get('APP_DOMAIN', '/')?>vendor/tinymce/tinymce/tinymce.min.js?v=<?=Config::get('config.version')?>"></script>
<script src='<?=Env::get('APP_DOMAIN', '/')?>resources/js/descriptionTinyMCE.js'></script>
<script type="text/javascript" src="<?=Env::get('APP_DOMAIN', '/')?>node_modules/jquery-ui/dist/jquery-ui.min.js"></script>
<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h1 class="text-center">Edit <?=$this->product->name?></h1>
<div class="row g-3 mb-5">
    <div class="col-md-10 offset-md-1 bg-light px-4 rounded shadow-sm">
        <form class="form mb-3" action="" method="post" enctype="multipart/form-data">
            <!-- Common form elements -->
            <?php $this->component('product_form') ?>
            <input type="hidden" id="images_sorted" name="images_sorted" value="" />
            <?=$this->component('manage_product_images') ?>
            <div class="col-md-12 text-end">
            <a href="<?=Env::get('APP_DOMAIN', '/')?>vendorproducts" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Save', ['class' => 'btn btn-primary']); ?>
            </div>
        </form>   
    </div>
</div>
<?php $this->end(); ?>
