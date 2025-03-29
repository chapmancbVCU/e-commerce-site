<?php use Core\FormHelper; ?>

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
        ['class' => 'form-group my-3'],
        $this->displayErrors
    ) ?>

    <?= FormHelper::inputBlock('file', 
        "Upload Product Image(s)", 
        'productImages', 
        '', 
        ['multiple' => 'multiple', 'class' => 'form-control', 'accept' => 'image/gif image/jpeg image/png'], 
        ['class' => 'form-group mb-3'], $this->displayErrors) 
    ?>
    
