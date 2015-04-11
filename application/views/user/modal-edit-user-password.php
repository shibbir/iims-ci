<form action="#" class="form-horizontal user-password-form">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

	<div class="modal-header">
    	<h3>Update Password</h3>
    </div>

    <div id="notification-user-edit-password"></div>

    <div class="modal-body">
	    <div class="control-group">
	        <label class="control-label" for="CurrentPassword" data-required=1>Current Password</label>
	        <div class="controls">
	            <input type="password" name="CurrentPassword" class="input-xlarge" />
	        </div>
	    </div>

	    <div class="control-group">
	        <label class="control-label" for="NewPassword" data-required=1>New Password</label>
	        <div class="controls">
	            <input type="password" name="NewPassword" class="input-xlarge" />
	        </div>
	    </div>

	    <div class="control-group">
	        <label class="control-label" for="RepeatNewPassword" data-required=1>Repeat New Password</label>
	        <div class="controls">
	            <input type="password" name="RepeatNewPassword" class="input-xlarge" />
	        </div>
	    </div>
	</div>

	<input type="hidden" name="UserName" value="<?=$this->uri->segment(3)?>" />

	<div class="modal-footer">
	    <button type="button" class="btn-edit-password btn btn-success btn-ajax">
	    	<i class="icon-plus icon-white"></i> Change Password
	    </button>
	    <button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> loading...</button>
		<button type="reset" class="btn">Reset</button>
    </div>
</form>

<script>
	$(function () {
		$(document).on('click', '.btn-edit-password', function () {
			$.buttonIndicator('on');
			$.postRemoteData('user', 'changePassword', $('.user-password-form').serialize()).then(function (data) {
				showNotification(data, '#notification-user-edit-password');
				$.buttonIndicator('off');
			});
		});
	});
</script>