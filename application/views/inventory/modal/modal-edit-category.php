<div id="ModalCategoryEdit" class="modal hide fade" data-backdrop="true">
	<div id="placeholder-category-edit-form"></div>
</div>

<script id="template-category-edit-form" type="text/x-handlebars-template">

	<form action="#" class="form-horizontal category-edit-form">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    		<h3>Edit Category</h3>
    	</div>

		<div id="notification-category-edit"></div>

    	<div class="modal-body">

			<div class="control-group">
	    		<label class="control-label" for="CategoryName">Category Name</label>
	        	<div class="controls">
	        		<input type="text" name="CategoryName" class="input-xlarge" value="{{CategoryName}}" />
	        	</div>
			</div>

			<div class="control-group">
		        <label class="control-label" for="Description">Description</label>
		        <div class="controls">
		            <textarea name="Description" rows="10" style="width:80%;">{{Description}}</textarea>
		        </div>
		    </div>
    	</div>

    	<input type="hidden" name="ID" value="{{ID}}" />

	   	<div class="modal-footer">
	   		<button type="button" class="btn-edit-category btn btn-success btn-ajax">
	           	<i class="icon-pencil icon-white"></i> Update
	       	</button>
			<button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> Updating...</button>
	       	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	   	</div>
    </form>
</script>

<script>
	$(function () {
		$(document).on('click', '.modal-edit-category', function () {
			var form_data = {
				ID: $(this).parents('div').data('id')
			};
			$.fetchRemoteData('category', 'getCategory', form_data).then(function (data) {
				renderHandlebarsTemplate('#template-category-edit-form', '#placeholder-category-edit-form', data);
				$.hideSpinner();
			});
		});
		$(document).on('click', '.btn-edit-category', function () {
			$.buttonIndicator('on');
			$.postRemoteData('category', 'edit', $('.category-edit-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					fetchCategory();
				}
				showNotification(data, '#notification-category-edit', 'edit');
				$.buttonIndicator('off');
			});
		});
	});
</script>