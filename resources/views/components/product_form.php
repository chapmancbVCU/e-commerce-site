<?php use Core\FormHelper; ?>

<form class="form" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
    <?= FormHelper::csrfInput() ?>
    <?= FormHelper::displayErrors($this->displayErrors) ?>
    <?= FormHelper::inputBlock('text', 'Name', 'name', '', ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-6']) ?>
    <?= FormHelper::inputBlock('text', 'Price', 'price', '', ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
    <?= FormHelper::inputBlock('text', 'List Price', 'list', '', ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
    <?= FormHelper::inputBlock('text', 'Shipping', 'shipping', '', ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
</form>