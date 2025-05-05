<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\Lib\Utilities\Config; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle('Edit ' . $this->product->name); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=Env::get('APP_DOMAIN', '/')?>resources/css/profileImage.css?v=<?=Config::get('config.version')?>" media="screen" title="no title" charset="utf-8">
<script src="<?=Env::get('APP_DOMAIN', '/')?>vendor/tinymce/tinymce/tinymce.min.js?v=<?=Config::get('config.version')?>"></script>
<script src='<?=Env::get('APP_DOMAIN', '/')?>resources/js/descriptionTinyMCE.js'></script>
<script type="text/javascript" src="<?=Env::get('APP_DOMAIN', '/')?>node_modules/jquery-ui/dist/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?=Env::get('APP_DOMAIN', '/')?>node_modules/select2/dist/css/select2.min.css" media="screen" title="no title" charset="utf-8">
<script src="<?=Env::get('APP_DOMAIN', '/')?>node_modules/select2/dist/js/select2.min.js"></script>

<style>
    .select2-container {
        display: block;
    }
</style>

<script>
    function calcInventory() {
        let total = 0;
        const options = document.querySelectorAll('input.option_inventory');
        for(let i = 0; i < options.length; i++) {
            let option = options[i];
            total += parseInt(option.value, 10);
        }
        document.getElementById('inventory').value = total;
    }

    $(document).ready(function() {
        calcInventory();

        // Initialize select2
        $('.multi-options-select').select2({
            ajax : {
                url : '<?=Env::get('APP_DOMAIN')?>vendorproducts/getOptionsForForm',
                dataType : 'json',
                processResults : function(resp) {
                    return { results : resp.items }
                }
            }
        });

        // select option
        $('.multi-options-select').on('select2:select', function(e) {
            const wrap = document.getElementById('optionsInventoryWrapper');
            const inputWrap = document.createElement('div');
            inputWrap.setAttribute('class', 'form-group');
            inputWrap.setAttribute('data-id', e.params.data.id);

            const label = document.createElement('label');
            label.setAttribute('class', 'control-label');
            label.setAttribute('for', 'inventory_'+e.params.data.id);
            const labelText = document.createTextNode(e.params.data.text + " Inventory");
            label.appendChild(labelText);
            inputWrap.appendChild(label);

            const input = document.createElement('input');
            input.setAttribute('class', 'form-control option_inventory');
            input.setAttribute('type', 'number');
            input.setAttribute('id', 'inventory_' + e.params.data.id);
            input.setAttribute('name', 'inventory_' + e.params.data.id);
            input.setAttribute('value', 0);
            input.setAttribute('onblur', 'calcInventory()');
            
            inputWrap.appendChild(input);
            wrap.appendChild(inputWrap);
        });

        // unselect option
        $('.multi-options-select').on('select2:unselect', function(e) {
            let wrap = document.querySelector('div[data-id="'+e.params.data.id+'"]')
            wrap.remove();
            calcInventory();
        });
    });
</script>
<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h1 class="text-center"><?=$this->header?></h1>
<div class="row g-3 mb-5">
    <div class="col-md-10 offset-md-1 bg-light px-4 rounded shadow-sm">
        <form class="form mb-3" action="" method="post" enctype="multipart/form-data">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <div class="row g-3">
                <?= FormHelper::inputBlock('text', 'Name', 'name', $this->product->name, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-6']) ?>
                <?= FormHelper::inputBlock('text', 'Price', 'price', $this->product->price, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
                <?= FormHelper::inputBlock('text', 'List Price', 'list', $this->product->list, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2'],) ?>
                <?= FormHelper::inputBlock('text', 'Shipping', 'shipping', $this->product->shipping, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-2']) ?>
                <?= FormHelper::selectBlock('Brand', 'brand_id', $this->product->brand_id, $this->brands, ['class' => 'form-control input-sm', 'required' => 'required'], ['class' => 'form-group col-md-3']); ?>
                <?php 
                    $invInputClass = ['class' => 'form-control input-sm'];
                    if($this->product->hasOptions()) {
                        $invInputClass['readonly'] = 'readonly';
                    }
                ?>

                <?= FormHelper::inputBlock('number', 'Inventory', 'inventory', $this->product->inventory, $invInputClass, ['class' => 'form-group col-md-2']) ?>
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

            <div id="optionsWrapper" class="row my-3 <?= ($this->product->hasOptions()) ? 'd-flex' : 'd-none'?>">
                <div class="col-6 form-group">
                    <label class="control-label">Options</label>
                    <select class="multi-options-select form-control" name="options[]" multiple="multiple">
                        <?php foreach($this->options as $option): ?>
                            <option value="<?=$option->id?>" selected="selected"><?=$option->name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-6" id="optionsInventoryWrapper">
                    <?php foreach($this->options as $option) {
                        echo FormHelper::inputBlock(
                            'number', 
                            $option->name . " Inventory", 
                            'inventory_'.$option->id, $option->inventory, 
                            ['class' => 'form-control option_inventory', 'onblur' => "calcInventory()"], 
                            ['class' => 'form-group', 'data-id' => $option->id]
                        );
                    } ?>
                </div>
            </div>
            <input type="hidden" id="images_sorted" name="images_sorted" value="" />
            <?=$this->component('manage_product_images') ?>
            <div class="col-md-12 text-end">
            <a href="<?=Env::get('APP_DOMAIN', '/')?>vendorproducts" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Save', ['class' => 'btn btn-primary']); ?>
            </div>
        </form>   
    </div>
</div>

<script>
    document.getElementById('has_options').addEventListener('change', function(evt) {
        const wrapper = document.getElementById('optionsWrapper');
        const inventory = document.getElementById('inventory');
        if(evt.target.checked) {
            wrapper.classList.add('d-flex');
            wrapper.classList.remove('d-none');
            inventory.setAttribute('readonly', 'readonly');
        } else {
            wrapper.classList.add('d-none');
            wrapper.classList.remove('d-flex');
            inventory.removeAttribute('readonly');
        }
    });
</script>
<?php $this->end(); ?>
