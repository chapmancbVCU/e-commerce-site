<?php use Core\FormHelper; ?>
<?php use Core\Lib\Utilities\Env; ?>
<!-- Modal -->
<div class="modal fade" id="addBrandForm" tabindex="-1" aria-labelledby="addBrandFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addBrandFormLabel">Add Brand</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="form" action='' id="brandForm" method="post">
                <input type="hidden" id="brand_id" name="brand_id" value="new" />
                <?= FormHelper::csrfInput() ?>
                <?= FormHelper::inputBlock('text', 'Brand Name', 'name', $this->brand->name, ['class' => 'form-control'], ['class' => 'form-group', $this->formErrors]); ?>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="saveBrand()">Save</button>
        </div>
        </div>
    </div>
</div>

<script>
    jQuery('#addBrandForm').on('hidden.bs.modal', function () {
        jQuery('#name').val('');
        jQuery('#brand_id').val('new');
        jQuery('#addBrandFormLabel').text('Add Brand');
    });

    function saveBrand() {
        let formData = jQuery("#brandForm").serialize();
        jQuery.ajax({
            url : '<?=Env::get('APP_DOMAIN')?>adminbrands/save',
            method : "POST",
            data : formData,
            success : function(resp) {
                if(resp.success) {
                    console.log(resp);
                    alertMsg("Brand Successfully Saved", 'success');
                    jQuery('#addBrandForm').modal('hide');
                    let row = jQuery('tr[data-id="'+resp.brand.id+'"]');
                    let newRow = '<tr data-id="'+resp.brand.id+'"><td>'+resp.brand.id+'</td><td>'+resp.brand.name+'</td><td></td></tr>'
                    if(row.length === 0) {
                        jQuery('#brandsTable tbody').prepend(newRow);
                    } else {
                        jQuery('tr[data-id="'+resp.brand.id+'"] td:nth-child(2)').text(resp.brand.name);
                    }
                } else if (resp.errors){
                    alertMsg(resp.errors.name, 'danger');
                } else {
                    alertMsg("CSRF validation failed", 'danger');
                }
                console.log(resp);
            },
            error: function(xhr) {
                alertMsg("Request failed — likely CSRF token mismatch.", 'danger');
                console.error(xhr.responseText); // Optional: log for debugging
            }
        });
    }
</script>