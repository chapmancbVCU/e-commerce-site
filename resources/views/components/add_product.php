<?php use Core\FormHelper; ?>

<form class="form" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
    <?= FormHelper::csrfInput() ?>

</form>