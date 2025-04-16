<?php use Core\Lib\Utilities\Env; ?>
<?php $this->setSiteTitle("Shopping Cart"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h2 class="text-center">Shopping Cart (<?= $this->itemCount ?> item<?= ($this->itemCount == 1) ? "" : 's'?>)</h2>
<div class="row">
    <div class="col col-md-8">
        <?php foreach($this->items as $item): ?>
            <?php $shipping = ($item->shipping == 0)? "Free Shipping" : "Shipping: $" . $item->shipping; ?>
            <div class="shopping-cart-item">
                <div class="shopping-cart-item-image">
                    <img src="<?=Env::get('APP_DOMAIN') . $item->url?>" alt="<?=$item->name?>">
                </div>
                <div class="shopping-cart-item-name">
                    <a href="<?=Env::get('APP_DOMAIN')?>products/details/<?=$item->id?>" title="<?=$item->name?>">
                        <?=$item->name?>
                    </a>
                    <p>by <?= $item->brand?> <p>
                </div>

                <div class="shopping-cart-item-qty">
                    <label>Qty </label>
                    <?= $item->qty ?>
                </div>

                <div class="shopping-cart-item-price">
                    <div>$<?=$item->price?></div>
                    <div class="shipping"><?= $shipping ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <aside class="col col-md-4">
        <div class="shopping-cart-summary">
            <div class="d-grid">
                <button class="btn btn-lg btn-primary">Proceed With Checkout</button>
            </div>
            <div class="cart-line-item">
                <div>Item<?= ($this->itemCount == 1) ? " " : "s "?>(<?=$this->itemCount?>)</div>
                <div>$<?=$this->subTotal?></div>
            </div>
            <div class="cart-line-item">
                <div>Shipping</div>
                <div>$<?=$this->shippingTotal?></div>
            </div>
            <hr>
            <div class="cart-line-item grand-total">
                <div>Total:</div>
                <div>$<?=$this->grandTotal?></div>
            </div>
        </div>
        </aside>
</div>
<?php $this->end(); ?>


