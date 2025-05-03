<?php use Core\FormHelper; ?>

<?= FormHelper::csrfInput() ?>
<?= FormHelper::displayErrors($this->displayErrors) ?>
<div class="row g-3">
    <?= FormHelper::inputBlock('text', 'Name', 'name', $this->product->name, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-6']) ?>
    <?= FormHelper::inputBlock('text', 'Price', 'price', $this->product->price, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
    <?= FormHelper::inputBlock('text', 'List Price', 'list', $this->product->list, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2'],) ?>
    <?= FormHelper::inputBlock('text', 'Shipping', 'shipping', $this->product->shipping, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
    <?= FormHelper::selectBlock('Brand', 'brand_id', $this->product->brand_id, $this->brands, ['class' => 'form-control input-sm', 'required' => 'required'], ['class' => 'form-group col-md-3']); ?>
</div>

<div class="row">
    <?= FormHelper::textareaBlock(
        'Description',
        'description',
        $this->product->description,
        ['class' => 'form-control'],
        ['class' => 'form-group my-3']) 
    ?>
    <?= FormHelper::checkboxBlockLabelLeft('Featured', 'featured', "on", $this->product->isChecked(), [], ['class' => 'form-group mt-3 mb-2']) ?>
    <?= FormHelper::checkboxBlockLabelLeft('Has Options', 'has_options', "on", $this->product->hasOptions(), [], ['class' => 'form-group mt-2 mb-3']) ?>
</div>

<div id="optionsWrapper" class="row mb-3 <?= ($this->product->hasOptions()?"d-block" : "d-none")?>">
    <div class="col-12">
        Put table and select search box here
    </div>
</div>

<div class="row">
    <?= FormHelper::inputBlock('file', 
        "Upload Product Image(s)", 
        'productImages[]', 
        '', 
        ['multiple' => 'multiple', 'class' => 'form-control', 'accept' => 'image/gif image/jpeg image/png'], 
        ['class' => 'form-group mb-3'])
    ?>
</div>
    
<script>
    document.getElementById('has_options').addEventListener('change', function(evt) {
        const wrapper = document.getElementById('optionsWrapper');
        if(evt.target.checked) {
            wrapper.classList.add('d-block');
            wrapper.classList.remove('d-none');
        } else {
            wrapper.classList.add('d-none');
            wrapper.classList.remove('d-block');
        }
    });
</script>