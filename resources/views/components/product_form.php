<?php use Core\FormHelper; ?>

<form class="form" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
    <?= FormHelper::csrfInput() ?>
    <?= FormHelper::displayErrors($this->displayErrors) ?>
    <div class="row g-3">
        <?= FormHelper::inputBlock('text', 'Name', 'name', $this->product->name, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-6']) ?>
        <?= FormHelper::inputBlock('text', 'Price', 'price', $this->product->price, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
        <?= FormHelper::inputBlock('text', 'List Price', 'list', $this->product->list, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
        <?= FormHelper::inputBlock('text', 'Shipping', 'shipping', $this->product->shipping, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
    </div>
</form>