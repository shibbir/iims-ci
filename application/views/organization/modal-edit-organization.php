<div id="ModalOrganizationEdit" class="modal hide fade in" data-backdrop="true" tabindex="-1" role="dialog" aria-hidden="true">
	<form action="#" class="form-horizontal organization-edit-form">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h3>Update Organization Information</h3>
		</div>

		<div id="notification-organization-edit"></div>

		<div id="placeholder-organization-edit-form"></div>

	    <div class="modal-footer">
	        <button type="button" class="btn btn-success btn-ajax btn-edit-organization">
	            <i class="icon-pencil icon-white"></i> Update
	        </button>
			<button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> Updating...</button>
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    </div>
	</form>
</div>

<script id="template-organization-edit-form" type="text/x-handlebars-template">
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span6">
    			<div class="control-group">
					<label class="control-label" for="Title">Title</label>
        			<div class="controls">
						<input type="text" name="Title" class="input-xlarge" value="{{Title}}" />
        			</div>
    			</div>

				<div class="control-group">
					<label class="control-label" for="SubTitle">SubTitle</label>
        			<div class="controls">
						<input type="text" name="SubTitle" class="input-xlarge" value="{{SubTitle}}" />
        			</div>
    			</div>

				<div class="control-group">
        			<label class="control-label" for="Website">Website</label>
        			<div class="controls">
            			<div class="input-prepend">
            				<span class="add-on"><i class="icon-globe"></i></span>
            				<input type="text" name="Website" class="input-xlarge" value="{{Website}}" style="width: 243px;" />
            			</div>
        			</div>
    			</div>

				<div class="control-group">
					<label class="control-label" for="Description">Description</label>
        			<div class="controls">
        				<textarea name="Description" rows="10" style="width:90%;">{{Description}}</textarea>
        			</div>
    			</div>

			</div>

			<div class="span6">
    			<div class="control-group">
					<label class="control-label" for="Mobile">Mobile</label>
        			<div class="controls">
						<input type="text" name="Mobile" class="input-xlarge" value="{{Mobile}}" />
        			</div>
    			</div>

				<div class="control-group">
					<label class="control-label" for="Phone">Phone</label>
        			<div class="controls">
						<input type="text" name="Phone" class="input-xlarge" value="{{Phone}}" />
        			</div>
    			</div>

				<div class="control-group">
        			<label class="control-label" for="Email">Email</label>
        			<div class="controls">
            			<div class="input-prepend">
	            			<span class="add-on"><i class="icon-envelope"></i></span>
            				<input type="text" name="Email" class="input-xlarge" value="{{Email}}" style="width: 243px;" />
            			</div>
        			</div>
    			</div>

    			<div class="control-group">
					<label class="control-label" for="Address">Address</label>
        			<div class="controls">
						<textarea name="Address" rows="10" style="width:90%;">{{{Address}}}</textarea>
        			</div>
    			</div>

			</div>
		</div>
	</div>
	<input type="hidden" name="ID" value="{{ID}}" />
</script>