<?php use Core\FormHelper; ?>

<form class="form" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
    <?= FormHelper::csrfInput() ?>
    <div class="row g-3">
        <?= FormHelper::inputBlock('text', 'Name', 'name', $this->product->name, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-6'], $this->displayErrors) ?>
        <?= FormHelper::inputBlock('text', 'Price', 'price', $this->product->price, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2'], $this->displayErrors) ?>
        <?= FormHelper::inputBlock('text', 'List Price', 'list', $this->product->list, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2'], $this->displayErrors) ?>
        <?= FormHelper::inputBlock('text', 'Shipping', 'shipping', $this->product->shipping, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2'], $this->displayErrors) ?>
    </div>

    <?= FormHelper::textareaBlock(
        'Description',
        'description',
        $this->product->description,
        ['class' => 'form-control', 'rows' => '6'],
        ['class' => 'form-group mt-3'],
        $this->displayErrors
    ) ?>
    
    <?= FormHelper::submitBlock('Save', ['class' => 'btn btn-large btn-primary mt-3'], ['class' => 'text-end col-md-12']); ?>
</form>