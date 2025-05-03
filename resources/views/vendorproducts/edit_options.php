<?php
use Core\FormHelper;
use Core\Lib\Utilities\Env;
use Core\Lib\Utilities\Config;
?>
<?php $this->setSiteTitle("Edit Option"); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h3 class="text-center"><?=$this->header?></h3>
        <hr>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::inputBlock('text', "Option Name", 'name', $this->option->name, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
            <div class="d-flex justify-content-end">
                <a href="<?=Env::get('APP_DOMAIN')?>vendorproducts/options" class="btn btn-secondary me-1">Cancel</a>
                <?= FormHelper::submitTag('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>