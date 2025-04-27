<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper as Forms; ?>
<?php $this->setSiteTitle("Checkout"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<script src="https://js.braintreegateway.com/web/dropin/1.44.1/js/dropin.min.js"></script>
<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>

<?php $this->end(); ?>
