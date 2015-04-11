<div id="ModalInventoryEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
	<div id="placeholder-inventory-edit-form"></div>
</div>

<script id="template-inventory-edit-form" type="text/x-handlebars-template">

	<form action="#" class="form-horizontal inventory-edit-form">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

		<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h3>Update the Inventory</h3>
	    </div>

		<div id="notification-inventory-edit"></div>

		<div class="modal-body">
			<div class="row-fluid">
				{{#inventory}}
					<div class="span8">
			    		<div class="control-group">
			        		<label class="control-label" for="Title">Title</label>
			        		<div class="controls">
								<input type="text" name="Title" class="input-xlarge" value="{{Title}}" />
			        		</div>
			    		</div>
				    	<div class="control-group">
							<label class="control-label" for="Category">Category</label>
				        	<div class="controls">
				            	<select id="CategoryID" name="CategoryID">
									{{#../categories}}
										{{#ifSelectedCategory ID ../CategoryID}}
											<option value="{{ID}}" selected>{{CategoryName}}</option>
										{{else}}
											<option value="{{ID}}">{{CategoryName}}</option>
    									{{/ifSelectedCategory}}
									{{/../categories}}
								</select>
				        	</div>
				    	</div>
				    	<div class="control-group">
				        	<label class="control-label" for="Description">Description</label>
				        	<div class="controls">
				            	<textarea class="EditDescription" rows="10" style="width:80%;">{{{Description}}}</textarea>
				            	<input type="hidden" name="Description" class="hiddenTextarea" />
				        	</div>
				    	</div>
					</div>

					<div class="span4">
				    	<div class="control-group">
				        	<label class="control-label" for="Quantity">Quantity</label>
				        	<div class="controls">
				            	<input type="number" name="Quantity" class="qty input-medium" value="{{Quantity}}" min="0" max="1000" step="1" />
				        	</div>
				    	</div>

				    	<div class="control-group">
				        	<label class="control-label" for="UnitPrice">UnitPrice</label>
				        	<div class="controls">
				            	<input type="number" name="UnitPrice" class="currency input-medium" value="{{UnitPrice}}" min="0" step="1" />
				        	</div>
				    	</div>

				    	<div class="control-group">
				        	<label class="control-label" for="Warranty">Warranty</label>
				        	<div class="controls">
								<input type="text" name="Warranty" class="input-medium" value="{{Warranty}}" />
				        	</div>
				    	</div>

				    	<div class="control-group">
				        	<label class="control-label" for="Status">Available</label>
				        	<div class="controls">
				            	<select name="Status" class="input-medium">
									{{#getStatus Status}}
									{{/getStatus}}
				            	</select>
				        	</div>
				    	</div>
			    	</div>
					<input type="hidden" name="ID" value="{{ID}}" />
				{{/inventory}}
			</div>
	    </div>

	    <div class="modal-footer">
	        <button type="button" class="btn-edit-inventory btn btn-success btn-ajax">
	            <i class="icon-pencil icon-white"></i> Update Product
	        </button>
			<button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> Updating...</button>
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    </div>

	</form>
</script>

<script>
	$(function () {
		$(document).on('click', '.inventory-edit-modal', function () {
			var form_data = {
				ID: $(this).parent('td').data('id')
			};
			Handlebars.registerHelper('ifSelectedCategory', function(selectedID, CategoryID, options) {
				if(CategoryID == selectedID) {
			    	return options.fn(this);
			  	}
				else {
				    return options.inverse(this);
				}
			});
			Handlebars.registerHelper('getStatus', function(Status, options) {
				var option = '';
				if(Status == 'Yes') {
					option += "<option value='Yes' selected>Available</option>";
                	option += "<option value='No'>Not Available</option>";
				}
				else {
					option += "<option value='Yes'>Available</option>";
                	option += "<option value='No' selected>Not Available</option>";
				}
				return option;
			});
			$.fetchRemoteData('inventory', 'getInventoryById', form_data).then(function (data) {
				renderHandlebarsTemplate('#template-inventory-edit-form', '#placeholder-inventory-edit-form', data);
				$.hideSpinner();
			});
		});
		$(document).on('click', '.btn-edit-inventory', function() {
			$('.hiddenTextarea').val($('.EditDescription').val().replace(/\n/g, '<br />'));
			$.buttonIndicator('on');
			$.postRemoteData('inventory', 'edit', $('.inventory-edit-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					$catId = $('#CategoryID').find(':selected').val();
					renderInventoryList($catId);
				}
				showNotification(data, '#notification-inventory-edit', 'edit');
				$.buttonIndicator('off');
			});
		});
	});
</script>