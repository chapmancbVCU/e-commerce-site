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

<?= FormHelper::textareaBlock(
    'Description',
    'description',
    $this->product->description,
    ['class' => 'form-control'],
    ['class' => 'form-group my-3']) 
?>

<?= FormHelper::checkboxBlockLabelLeft('Featured', 'featured', "on", $this->product->isChecked(), [], ['class' => 'form-group my-3']) ?>
<?= FormHelper::inputBlock('file', 
    "Upload Product Image(s)", 
    'productImages[]', 
    '', 
    ['multiple' => 'multiple', 'class' => 'form-control', 'accept' => 'image/gif image/jpeg image/png'], 
    ['class' => 'form-group mb-3'])
?>
    
