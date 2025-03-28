<?php $this->setSiteTitle("Add Product"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

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
