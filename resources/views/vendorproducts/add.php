<?php $this->setSiteTitle("Add Product"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h1 class="text-center">Add New Product</h1>
<div class="row">
    <div class="col-md-10 offset-md-1 bg-light">
        <?php $this->component('add_product') ?>
    </div>
</div>
<?php $this->end(); ?>
