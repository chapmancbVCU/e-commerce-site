<?php use Core\FormHelper; ?>

<form class="form" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
    <?= FormHelper::csrfInput() ?>
    <?= FormHelper::displayErrors($this->displayErrors) ?>
    <?= FormHelper::inputBlock('text', 'Name', 'name', '', ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-6']) ?>
</form>