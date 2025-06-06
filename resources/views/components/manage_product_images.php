<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\FormHelper; ?>
<div class="row">
    <?= FormHelper::inputBlock('file', 
        "Upload Product Image(s)", 
        'productImages[]', 
        '', 
        ['multiple' => 'multiple', 'class' => 'form-control', 'accept' => 'image/gif image/jpeg image/png'], 
        ['class' => 'form-group mb-3'])
    ?>
</div>

<div id="sortableImages" class="row align-items-center justify-content-start p-2">
    <?php foreach($this->productImages as $image):?>
        <div class="col flex-grow-0" id="image_<?=$image->id?>">
            <span class="btn-danger" onclick="deleteImage('<?=$image->id?>')"><i class="fa fa-times"></i></span>
            <div class="edit-image-wrapper <?= ($image->sort == 0) ? 'current-img' : ''?>" data-id="<?=$image->id?>">
                <img src="<?=Env::get('APP_DOMAIN', '/').$image->url?>" />
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function updateSort() {
        var sortedIDs = $("#sortableImages").sortable("toArray");
        $('#images_sorted').val(JSON.stringify(sortedIDs));
    }

    var APP_DOMAIN = "<?= rtrim(Env::get('APP_DOMAIN', '/'), '/') ?>";
    
    function deleteImage(image_id) {
        if(confirm("Are you sure? This cannot be undone!")) {
            jQuery.ajax({
                url : APP_DOMAIN + "/vendorproducts/deleteImage",
                method: "POST",
                data : {image_id : image_id},
                success: function(resp) {
                    if(resp.success) {
                        jQuery('#image_'+resp.model_id).remove();
                        updateSort();
                        alertMsg('Image Deleted.');
                    }
                } 
            });
        }
    }

    jQuery('document').ready(function(){
        jQuery('#sortableImages').sortable({
            axis: "x",
            placeholder: "sortable-placeholder",
            update : function(event, ui) {
                updateSort();
            }
        });
        updateSort();
    });
</script>