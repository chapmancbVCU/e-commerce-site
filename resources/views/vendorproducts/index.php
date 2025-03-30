<?php use Core\Lib\Utilities\Env; ?>
<?php $this->setSiteTitle("My Products"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>

<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<table class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <th>Name</th>
        <th>Price</th>
        <th>Shipping</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->products as $product): ?>
            <tr data-id="<?=$product->id?>">
                <td><?=$product->name?></td>
                <td><?=$product->price?></td>
                <td><?=$product->shipping?></td>
                <td class="text-end">
                    <a href="<?=Env::get('APP_DOMAIN')?>vendorproducts/edit/<?=$product->id?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="deleteProduct('<?=$product->id?>'); return false;"><i class="fas fa-trash-alt"></i> Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function deleteProduct(id) {
        if(window.confirm("Are you sure you want to delete this product. It cannot be reversed.")){
        jQuery.ajax({
            url : '<?=Env::get('APP_DOMAIN', '/')?>vendorproducts/delete',
            method : "POST",
            data : {id : id},
            success: function(resp) {
                console.log(resp);
                var msgType = (resp.success)? 'success' : 'danger';
                if(resp.success){
                    jQuery('tr[data-id="'+resp.model_id+'"]').remove();
                }
                alertMsg(resp.msg, msgType);
            }
        });
    }
}
</script>
<?php $this->end(); ?>