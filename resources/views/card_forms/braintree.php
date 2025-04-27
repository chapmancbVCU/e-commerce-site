<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper as Forms; ?>
<?php $this->setSiteTitle("Checkout"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<script src="https://js.braintreegateway.com/web/dropin/1.44.1/js/dropin.min.js"></script>
<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<div class="row">
    <div class="col-md-8">
        <h3>Purchase Details</h3>

        <form action="<?=Env::get('APP_DOMAIN')?>cart/checkout/<?=$this->cartId?>" method="post" id="payment-form">
            <?= Forms::csrfInput() ?>
            <?= Forms::hidden('step', "2") ?>
            <input type="hidden" id="nonce" name="payment_method_nonce" />
            <?= Forms::hidden('name' ,$this->tx->name) ?>
            <?= Forms::hidden('shipping_address1', $this->tx->shipping_address1) ?>
            <?= Forms::hidden('shipping_address2', $this->tx->shipping_address2) ?>
            <?= Forms::hidden('shipping_city', $this->tx->shipping_city) ?>
            <?= Forms::hidden('shipping_state', $this->tx->shipping_state) ?>
            <?= Forms::hidden('shipping_zip', $this->tx->shipping_zip) ?>
            
            <div id="dropin-container"></div>

            <div class="col-md-12">
                    <button class="btn btn-lg btn-primary">Submit Payment</button>
            </div>
        </form>
    </div>

    <div class="col-md-4">
        <?= $this->component('product_preview') ?>
    </div>
</div>

<script type="text/javascript">
    const form = document.getElementById('payment-form');

    braintree.dropin.create({
        authorization: '<?=$this->gatewayToken?>',
        container: '#dropin-container'
    }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();
            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);
                // Step four: when the user is ready to complete their
                // transaction, use the dropinInstance to get a payment
                // method nonce for the user's selected payment method,
                // then add it a the hidden field before submitting the
                // complete form to a server-side integration
                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>
<?php $this->end(); ?>
