<div id="ModalOrganizationAdd" class="modal hide fade in" data-backdrop="true" tabindex="-1" role="dialog" aria-hidden="true">

	<form action="#" class="form-horizontal organization-add-form">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

	    <div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h3>Add Organization Information</h3>
	    </div>

	    <div id="notification-organization-add"></div>

    	<div class="modal-body">
    		<div class="row-fluid">
				<div class="span6">
					 <div class="control-group">
				     	<label class="control-label" for="Title">Title</label>
				        <div class="controls">
				            <input type="text" name="Title" class="input-xlarge" />
				        </div>
				    </div>

				    <div class="control-group">
				     	<label class="control-label" for="SubTitle">Sub Title</label>
				        <div class="controls">
				            <input type="text" name="SubTitle" class="input-xlarge" />
				        </div>
				    </div>

				    <div class="control-group">
				        <label class="control-label" for="Website">Website</label>
				        <div class="controls">
				            <div class="input-prepend">
				            	<span class="add-on"><i class="icon-globe"></i></span>
				            	<input type="text" name="Website" class="input-xlarge" />
				            </div>
				        </div>
				    </div>

				    <div class="control-group">
						<label class="control-label" for="Description">Description</label>
				        <div class="controls">
							<textarea name="Description" rows="10" style="width:90%;"></textarea>
				        </div>
				    </div>
				</div>

				<div class="span6">
				    <div class="control-group">
				        <label class="control-label" for="Mobile">Mobile</label>
				        <div class="controls">
				            <input type="text" name="Mobile" class="input-xlarge" />
				        </div>
				    </div>

				    <div class="control-group">
				        <label class="control-label" for="Phone">Phone</label>
				        <div class="controls">
				            <input type="text" name="Phone" class="input-xlarge" />
				        </div>
				    </div>

				    <div class="control-group">
				        <label class="control-label" for="Email">Email</label>
				        <div class="controls">
				            <div class="input-prepend">
				            	<span class="add-on"><i class="icon-envelope"></i></span>
				            	<input type="text" name="Email" class="input-xlarge" />
				            </div>
				        </div>
				    </div>

				    <div class="control-group">
				        <label class="control-label" for="Address">Address</label>
				        <div class="controls">
				            <textarea name="Address" rows="10" style="width:90%;"></textarea>
				        </div>
				    </div>

		    	</div>
		    </div>
		</div>

		<div class="modal-footer">
	        <button type="button" class="btn btn-success btn-ajax btn-add-organization">
	            <i class="icon-plus icon-white"></i> Add Organization
	        </button>
	        <button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> loading...</button>
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    </div>
	</form>
</div>