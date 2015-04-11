<?php
	$modal = false;
	$controller = $this->uri->segment(1);
	if($controller == 'invoice') $modal = true;
?>

<?php if($modal):?>
	<div id="ModalCustomerAdd" class="modal hide fade" data-backdrop="true">
<?php endif;?>

<form action="#" class="form-horizontal customer-add-form">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

	<div class="modal-header">
    	<?php if($modal):?>
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php endif;?>
        <h3>Add Customer</h3>
    </div>

    <div id="notification-customer-add"></div>

    <div class="modal-body">
		<div class="control-group">
	     	<label class="control-label" for="CustomerName">Customer Name</label>
	        <div class="controls">
	            <input type="text" name="CustomerName" class="CustomerName input-xlarge" />
	        </div>
	    </div>

	    <div class="control-group">
	        <label class="control-label" for="Contact">Contact</label>
	        <div class="controls">
	            <input type="text" name="Contact" class="Contact input-xlarge" />
	        </div>
	    </div>

	    <div class="control-group">
	        <label class="control-label" for="Address">Address</label>
	        <div class="controls">
	        	<textarea name="Address" class="Address" rows="10" style="width:80%;"></textarea>
	        </div>
	    </div>
    </div>

	<div class="modal-footer">
        <button type="button" class="btn-add-customer btn btn-success btn-ajax">
            <i class="icon-plus icon-white"></i> Add Customer
        </button>
        <button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> loading...</button>
        <?php if($modal):?>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<?php else: ?>
			<button type="reset" class="btn">Reset</button>
		<?php endif;?>
    </div>
</form>

<?php if($modal):?>
	</div>
<?php endif;?>

<script>
	$(function () {
		$(document).on('click', '.btn-add-customer', function () {
			$.buttonIndicator('on');
			$.postRemoteData('customer', 'add', $('.customer-add-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					IIMSApp.newlyCreatedCustomerId = data.newlyCreatedCustomerId;
					$(document).trigger('event/customerAdded');
				}
				showNotification(data, '#notification-customer-add');
				$.buttonIndicator('off');
			});
		});
	});
</script>