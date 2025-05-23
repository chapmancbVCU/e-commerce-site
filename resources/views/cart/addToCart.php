<?php use Core\Lib\Utilities\Env; ?>
<?php $this->setSiteTitle("My title here"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>

<div class="row">
    <div class="col col-md-8 offset-md-2 text-center">
        <h3>Do you want to check out or continue shopping?</h3>
        <a href="<?=Env::get('APP_DOMAIN')?>" class="btn btn-lg btn-info">Continue Shopping</a>
        <a href="<?=Env::get('APP_DOMAIN')?>cart" class="btn btn-lg btn-primary">Checkout</a>
    </div>
</div>
<?php $this->end(); ?>
