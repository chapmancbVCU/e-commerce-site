<?php use Core\FormHelper as Forms; ?>
<?php use Core\Lib\Utilities\Env; ?>
<?php $this->start('body'); ?>

<div class="row">
    <div class="col-md-8">
        <h3>Purchase Details</h3>
            <form class="form" action="<?=Env::get('APP_DOMAIN')?>cart/checkout/<?=$this->cartId?>" method="post">
                <?= Forms::csrfInput() ?>
                <div class="row">
                    <?= Forms::hidden('step', "1") ?>

                    <?= Forms::inputBlock(
                        'text', 
                        'Name', 
                        'name', 
                        $this->tx->name, 
                        ['class' => 'form-control form-control-sm mb-3'], 
                        ['class' => 'form-group col-md-12'], 
                        $this->formErrors) 
                    ?>
   
                    <?= Forms::inputBlock(
                        'text', 
                        'Shipping Address', 
                        'shipping_address1', 
                        $this->tx->shipping_address1, 
                        ['class' => 'form-control form-control-sm mb-3'], 
                        ['class' => 'form-group col-md-12'], 
                        $this->formErrors) 
                    ?>

                    <?= Forms::inputBlock(
                        'text', 
                        'Shipping Address (cont.)', 
                        'shipping_address2', 
                        $this->tx->shipping_address2, 
                        ['class' => 'form-control form-control-sm mb-3'], 
                        ['class' => 'form-group col-md-12'], 
                        $this->formErrors) 
                    ?>

                    <?= Forms::inputBlock(
                        'text', 
                        'City', 
                        'shipping_city', 
                        $this->tx->shipping_city, 
                        ['class' => 'form-control form-control-sm mb-3'], 
                        ['class' => 'form-group col-md-6'], 
                        $this->formErrors) 
                    ?>

                    <?= Forms::inputBlock(
                        'text', 
                        'State', 
                        'shipping_state', 
                        $this->tx->shipping_state, 
                        ['class' => 'form-control form-control-sm mb-3'], 
                        ['class' => 'form-group col-md-3'], 
                        $this->formErrors) 
                    ?>

                    <?= Forms::inputBlock(
                        'text', 
                        'Zip', 
                        'shipping_zip', 
                        $this->tx->shipping_zip, 
                        ['class' => 'form-control form-control-sm'], 
                        ['class' => 'form-group col-md-3'], 
                        $this->formErrors) 
                    ?>
                </div>
                <button class="btn btn-lg btn-primary">Continue</button>
            </form>
        </div>

    <div class="col-md-4"><?= $this->component('product_preview')?></div>
</div>

<?php $this->end(); ?>