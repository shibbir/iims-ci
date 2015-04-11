<div id="ModalCategoryAdd" class="modal hide fade" data-backdrop="true">

	<form action="#" class="form-horizontal category-add-form">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Add Category</h3>
	    </div>

	    <div id="notification-category-add"></div>

	    <div class="modal-body">
			<div class="control-group">
		    	<label class="control-label" for="CategoryName">Category Name</label>
		        <div class="controls">
		        	<input type="text" name="CategoryName" class="input-xlarge" />
		        </div>
			</div>

			<div class="control-group">
		        <label class="control-label" for="Description">Description</label>
		        <div class="controls">
		        	<textarea name="Description" rows="10" style="width:80%;"></textarea>
		        </div>
		    </div>
	    </div>

	    <div class="modal-footer">
	    	<button type="button" class="btn-add-category btn btn-success btn-ajax">
	            <i class="icon-plus icon-white"></i> Add
	        </button>
	        <button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> loading...</button>
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    </div>
	</form>
</div>

<script>
	$(function () {
		$(document).on('click', '.btn-add-category', function () {
			$.buttonIndicator('on');
			$.postRemoteData('category', 'add', $('.category-add-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					fetchCategory();
				}
				showNotification(data, '#notification-category-add');
				$.buttonIndicator('off');
			});
		});
	});
</script>