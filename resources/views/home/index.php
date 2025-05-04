<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper as Forms; ?>
<?php $openClass = $this->hasFilters ? " open" : ""; ?>
<?php $openIcon = $this->hasFilters ? "fa-chevron-left" : "fa-search"; ?>
<?php $this->start('body'); ?>

<div class="d-flex two-column-wrapper <?=$openClass?>" id="two-column-wrapper">
  <div id="expand-filters">
    <i id="toggleIcon" class="fas <?=$openIcon?>"></i>
  </div>  

  <aside class="filters-wrapper">
    <form id="filter-form" action="" method="post" autocomplete="off">
      <div class="form-group">
        <label for="search" class="sr-only">Search</label>
        <div class="input-group">
          <input type="text" class="form-control" id="search" name="search" value="<?=$this->search?>" placeholder="Search..." />
          <button class="input-group-append btn btn-info"><i class="fas fa-search"></i></button>
        </div>
      </div>

      <div class="row">
        <?= Forms::hidden('page', $this->page) ?>
        <?= Forms::selectBlock('Brand', 'brand', $this->brand, $this->brandOptions, ['class' => 'form-control form-control-sm'], ['class' => 'form-group col-12']) ?>
        <?= Forms::inputBlock('number', 'Price Min', 'min_price', $this->min_price, ['class' => 'form-control form-control-sm', 'step' => 'any'], ['class' => 'form-group col-6']) ?>
        <?= Forms::inputBlock('number', 'Price Max', 'max_price', $this->max_price, ['class' => 'form-control form-control-sm', 'step' => 'any'], ['class' => 'form-group col-6']) ?>
      </div>

      <div class="row mt-3">
        <div class="col-12">
          <button class="btn btn-info w-100">Search</button>
        </div>
      </div>
    </form>
  </aside>

  <main class="products-wrapper">
    <h1 class="text-center text-secondary w-100">Chappy.php E-commerce Site</h1>
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
          <a href="<?= Env::get('APP_DOMAIN', '/')?>products/details/<?=$product->id?>" class="btn btn-primary">See Details</a>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="d-flex justify-content-center align-items-center mt-3 w-100">
      <?php $disableBack = ($this->page == 1)? ' disabled="disabled"' : ''; ?>
      <?php $disableNext = ($this->page == $this->totalPages)? ' disabled="disabled"' : ''; ?>
      <button class="btn btn-light me-3" <?=$disableBack?> onclick="pager('back')"><i class="fas fa-chevron-left"></i></button>
      <?=$this->page?> of <?=$this->totalPages?>
      <button class="btn btn-light me-3" <?=$disableNext?> onclick="pager('next')"><i class="fas fa-chevron-right"></i></button>
    </div>
  </main>
</div>

<script>
  function toggleExpandFilters() {
    let wrapper = document.getElementById('two-column-wrapper');
    let toggleIcon = document.getElementById('toggleIcon');
    wrapper.classList.toggle('open');

    if(wrapper.classList.contains('open')) {
      toggleIcon.classList.remove('fa-search');
      toggleIcon.classList.add('fa-chevron-left');
    } else {
      toggleIcon.classList.remove('fa-chevron-left');
      toggleIcon.classList.add('fa-search');
    }
  }

  function pager(direction) {
    let form = document.getElementById('filter-form');
    let input = document.getElementById('page');
    let page = parseInt(input.value, 10);
    let newPageValue = (direction === 'next') ? page + 1 : page - 1;
    input.value = newPageValue;
    form.submit();
  }

  document.getElementById('filter-form').addEventListener('submit', function(evt) {
    let form = evt.target;
    evt.preventDefault();
    document.getElementById('page').value = 1;
    form.submit();
  });

  document.getElementById('expand-filters').addEventListener('click', toggleExpandFilters);
</script>
<?php $this->end(); ?>