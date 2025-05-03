<?php

use Core\FormHelper;
use Core\Lib\Utilities\Env; ?>
<?php $this->setSiteTitle($this->product->name); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<div class="row">
    <div class="col-md-6 product-details-slideshow">
        <p>
            <a class="back-to-results" href="<?= Env::get('APP_DOMAIN')?>home"><i class="fas fa-arrow-left"></i>Back to results</a>
        </p>
        <!-- Slide show -->
        <div id="carouselIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <?php for($i = 0; $i < sizeof($this->images); $i++): ?>
                    <?php $active = ($i == 0) ? "active" : ""; ?>
                    <button style="background-color: #101820;" type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="<?=$i?>" class="<?=$active?>" aria-current="true" aria-label="Slide 1"></button>
                <?php endfor; ?>
            </div>
            <div class="carousel-inner">
                <?php for($i = 0; $i < sizeof($this->images); $i++): ?>
                    <?php $active = ($i == 0) ? " active" : ""; ?>
                    <div class="carousel-item<?=$active?>">
                        <img src="<?= Env::get('APP_DOMAIN').$this->images[$i]->url?>" class="d-block image-fluid" style="height: 475px; margin: 0 auto;" alt="<?=$this->product->name?>">
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Details -->
        <h3><?=$this->product->name?></h3>
        <p>by <?=$this->product->getBrandName()?></p>
        <hr>
        <div>
            <span class="product-details-label">Price: </span>
            <span class="product-details-price">$<?=$this->product->price?></span> & 
            <?php if($this->product->shipping != 0):?>
                <span class="product-details-label">Shipping: </span>
            <?php endif; ?>
            <?=$this->product->displayShipping()?>
        </div>
        <form action="<?=Env::get('APP_DOMAIN')?>cart/addToCart/<?=$this->product->id?>" method="post">
            <?= FormHelper::csrfInput() ?>
            <?php if($this->product->hasOptions()): ?>
                <div class="col-6 mt-2 mb-2">
                    <select name="option_id" id="option_id" class="form-control form-control-sm">
                        <option>-Choose Option-</option>
                        <?php foreach($this->options as $option): ?>
                            <option value="<?=$option->id?>"><?=$option->name?> (<?=$option->inventory?> available)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="product-details-body"><?=html_entity_decode($this->product->description)?></div>
            <div>
                <button class="btn btn-info">
                    <i class="fas fa-cart-plus p-2"></i>Add to Shopping Cart
                </button>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>