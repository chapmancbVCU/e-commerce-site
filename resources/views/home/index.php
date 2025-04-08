<?php use Core\Lib\Utilities\Env; ?>
<?php $this->start('body'); ?>

<main class="products-wrapper">
  <?php foreach($this->products as $product): ?>
    <?php $shipping = ($product->shipping == '0.00')? 'Free Shipping!' : 'Shipping: $'.$product->shipping; ?>
    <?php $list = ($product->list == '0.00')? '' : '$'.$product->list; ?>
    <div class="card">
      <img src="<?= $product->url ?>" class="card-img-top" alt="<?=$product->name?>">
      <div class="card-body">
        <h5 class="card-title"><a href="<?= Env::get('APP_DOMAIN', '/')?>products/details/<?=$product->id?>"><?=$product->name?></a></h5>
        <p class="products-brand">By: <?=$product->brand?></p>
        <p class="card-text">$<?=$product->price?> <span class="list-price"><?=$list?></span></p>
        <p class="card-text"><?=$shipping?></p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  <?php endforeach; ?>
</main>

<?php $this->end(); ?>