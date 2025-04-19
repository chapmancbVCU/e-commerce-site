<?php use Core\FormHelper; ?>
<form class="form" action=<?=$this->postAction?> method="post">
    <?= FormHelper::csrfInput() ?>

</form>