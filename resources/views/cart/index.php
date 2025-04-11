<?php use Core\Lib\Utilities\Env; ?>
<?php $this->setSiteTitle("Shopping Cart"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h2 class="text-center">Shopping Cart</h2>
<div class="row">
    <div class="col col-md-8">
        <?php foreach($this->items as $item): ?>
            <div class="shopping-cart-item">
                <div class="shopping-cart-item-image">
                    <img src="<?=Env::get('APP_DOMAIN') . $item->url?>" alt="<?=$item->name?>">
                </div>
                <div class="shopping-cart-item-name">
                    <a href="<?=Env::get('APP_DOMAIN')?>products/details/<?=$item->id?>" title="<?=$item->name?>">
                        <?=$item->name?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col col-md-4">

    </div>
</div>
<?php $this->end(); ?>


