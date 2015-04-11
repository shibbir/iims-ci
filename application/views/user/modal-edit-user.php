<div id="placeholder-user-edit-form"></div>

<script id="template-user-edit-form" type="text/x-handlebars-template">
	<form action="#" class="form-horizontal user-edit-form">

		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

		<div class="modal-header">
			<h3>Update your profile</h3>
		</div>

		<div id="notification-user-edit"></div>

		{{#user}}
			<div class="modal-body">
		  		<div class="control-group">
		       		<label class="control-label" for="Username" data-required=1>Username</label>
		       		<div class="controls">
		           		<input type="text" name="UserName" class="input-xlarge" value="{{UserName}}" />
		       		</div>
		   		</div>
		   		<div class="control-group">
		       		<label class="control-label" for="Name" data-required=1>Name</label>
		       		<div class="controls">
		           		<input type="text" name="Name" class="input-xlarge" value="{{Name}}" />
		       		</div>
		   		</div>
		   		<div class="control-group">
		       		<label class="control-label" for="Contact" data-required=1>Contact</label>
		       		<div class="controls">
		           		<input type="text" name="Contact" class="input-xlarge" value="{{Contact}}" />
		       		</div>
		   		</div>
		   		<div class="control-group">
			   		<label class="control-label" for="Address" data-required=1>Address</label>
		       		<div class="controls">
		    	   		<textarea name="Address" rows="10" style="width:80%;">{{{Address}}}</textarea>
		        	</div>
		    	</div>
			</div>
			<input type="hidden" name="ID" value="{{ID}}" />
		{{/user}}

		<div class="modal-footer">
		   	<button type="button" class="btn-edit-user btn btn-success btn-ajax">
		    	<i class="icon-pencil icon-white"></i> Update
		    </button>
			<button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> Updating...</button>
			<button type="reset" class="btn">Reset</button>
	    </div>
	</form>
</script>

<script>
	$(function () {
		$(document).on('click', '.user-edit', function () {
			var form_data = {
				UserName: '<?=$this->uri->segment(3)?>'
			};
			$.fetchRemoteData('user', 'getUserByUsername', form_data).then(function (data) {
				renderHandlebarsTemplate('#template-user-edit-form', '#placeholder-user-edit-form', data);
				$.hideSpinner();
			});
		});
		$(document).on('click', '.btn-edit-user', function () {
			$.buttonIndicator('on');
			$.postRemoteData('user', 'edit', $('.user-edit-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					$(document).trigger('event/userEdited');
				}
				showNotification(data, '#notification-user-edit', 'edit');
				$.buttonIndicator('off');
			});
		});
	});
</script>