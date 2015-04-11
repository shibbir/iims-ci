<div id="ModalCustomerEdit" class="modal hide fade" data-backdrop="true">
	<div id="placeholder-customer-edit-form"></div>
</div>

<script id="template-customer-edit-form" type="text/x-handlebars-template">

	<form action="#" class="form-horizontal customer-edit-form">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

		<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h3>Update the Customer</h3>
	    </div>

		<div id="notification-customer-edit"></div>

		<div class="modal-body">
		    <div class="control-group">
				<label class="control-label" for="CustomerName">Customer Name</label>
		        <div class="controls">
					<input type="text" name="CustomerName" class="input-xlarge" value="{{CustomerName}}" />
		        </div>
		    </div>

		    <div class="control-group">
				<label class="control-label" for="Contact">Contact</label>
		        <div class="controls">
					<input type="text" name="Contact" class="contact input-xlarge" value="{{Contact}}" />
		        </div>
		    </div>

		    <div class="control-group">
				<label class="control-label" for="Address">Address</label>
		        <div class="controls">
					<textarea name="Address" rows="10" style="width:80%;">{{{Address}}}</textarea>
		        </div>
		    </div>
	    </div>

	    <input type="hidden" name="ID" value="{{ID}}" />

	    <div class="modal-footer">
	        <button type="button" class="btn-edit-customer btn btn-success btn-ajax">
	            <i class="icon-pencil icon-white"></i> Update Customer
	        </button>
			<button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> Updating...</button>
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    </div>

	</form>
</script>

<script>
	$(function () {
		$(document).on('click', '.customer-edit-modal', function () {
			var customerObject;
			if($('#customerGrid tbody').length) {
				customerObject = $.makeObject('table#customerGrid tbody tr', $(this).data('id'));
			}
			else {
				// we are in customer/profile page
				customerObject = customer;
			}

			renderHandlebarsTemplate('#template-customer-edit-form', '#placeholder-customer-edit-form', customerObject);
		});
		$(document).on('click', '.btn-edit-customer', function() {
			$.buttonIndicator('on');
			$.postRemoteData('customer', 'edit', $('.customer-edit-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					IIMSApp.newlyEditedCustomerId = data.newlyEditedCustomerId;
					$(document).trigger('event/customerEdited');
				}
				showNotification(data, '#notification-customer-edit', 'edit');
				$.buttonIndicator('off');
			});
		});
	});
</script>