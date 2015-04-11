<?php
	$modal = false;
	$controller = $this->uri->segment(1);
	if($controller == 'invoice') $modal = true;
?>

<?php if($modal):?>
	<div id="ModalInventoryAdd" class="modal hide fade" data-backdrop="true">
<?php endif;?>

<form action="#" class="form-horizontal inventory-add-form">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" />

	<div class="modal-header">
		<?php if($modal):?>
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php endif;?>
    	<h3>Add Inventory</h3>
    </div>

    <div id="notification-inventory-add"></div>

    <div class="modal-body">
	    <div class="row-fluid">
			<div class="span8">
		    	<div class="control-group">
		        	<label class="control-label" for="Title" data-required=1>Title</label>
		        	<div class="controls">
		            	<input type="text" name="Title" class="input-xlarge" />
		        	</div>
		    	</div>

			    <div class="control-group">
			    	<label class="control-label" for="Category" data-required=1>Category</label>
			        <div class="controls">
			        	<div class="placeholder-category-dropdown"></div>
		        	</div>
		    	</div>

			    <div class="control-group">
			        <label class="control-label" for="Description">Description</label>
			        <div class="controls">
			        	<textarea class="AddDescription" rows="10" style="width:90%;"></textarea>
			        	<input type="hidden" name="Description" class="hiddenTextarea" />
			        </div>
			    </div>
			</div>
			<div class="span4">
		    	<div class="control-group">
		        	<label class="control-label" for="Quantity">Quantity</label>
		        	<div class="controls">
		        		<input name="Quantity" type="number" class="qty input-medium" value="0" min="0" max="1000" step="1" />
		        	</div>
		    	</div>

			    <div class="control-group">
			        <label class="control-label" for="UnitPrice">Unit Price</label>
			        <div class="controls">
			            <input type="number" name="UnitPrice" class="currency input-medium" />
			        </div>
			    </div>

			    <div class="control-group">
			        <label class="control-label" for="Warranty">Warranty</label>
			        <div class="controls">
			            <div class="placeholder-year inline"></div>
			            <div class="placeholder-month inline"></div>
			            <label class="checkbox inline">
							<input name="LifetimeWarranty" type="checkbox" class="lifetime-warranty" value="Lifetime Warranty"> Lifetime Warranty
						</label>
			        </div>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal-footer">
        <button type="button" class="btn btn-success btn-add-inventory btn-ajax">
            <i class="icon-plus icon-white"></i> Add Inventory
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

<script class="template-category-dropdown" type="text/x-handlebars-template">
	<select name="CategoryID" class="input-medium category-dropDown category-handler-for-inventory">
		{{#categories}}
			<option value="{{ID}}">{{CategoryName}}</option>
		{{/categories}}
	</select>
</script>

<script class="template-year" type="text/x-handlebars-template">
	<select name="WarrantyInYear" class="input-small warranty">
		<option>Year</option>
		{{#numbers}}
			<option>{{Index}}</option>
		{{/numbers}}
	</select>
</script>

<script class="template-month" type="text/x-handlebars-template">
	<select name="WarrantyInMonth" class="input-small warranty">
		<option>Month</option>
		{{#numbers}}
			<option>{{Index}}</option>
		{{/numbers}}
	</select>
</script>

<script>
	function renderCategoryDropDown(data) {
		renderHandlebarsTemplate('.template-category-dropdown', '.placeholder-category-dropdown', data);
	}
	function resetAddInventory() {
		clearInput();
		warrantyListGenerator('year');
		warrantyListGenerator('month');
		$('.lifetime-warranty').attr('checked', false);
	}
	function warrantyListGenerator(warrantyType) {
		var length = 0, numbers  = [];
		if(warrantyType === 'year') length = 10;
		else if(warrantyType === 'month') length = 11;
		for(var i = 1; i <= length; i++) {
			numbers.push({Index: i});
		}
		renderHandlebarsTemplate('.template-' + warrantyType, '.placeholder-' + warrantyType, {numbers: numbers});
	}
	$(function () {
		$(document).on('click', '.lifetime-warranty', function () {
			if($('.lifetime-warranty').is(':checked')) {
				$('.warranty').attr('disabled', true);
			}
			else $('.warranty').removeAttr('disabled');
		});
		$(document).on('click', '.btn-add-inventory', function () {
			$('.hiddenTextarea').val($('.AddDescription').val().replace(/\n/g, '<br />'));
			$.buttonIndicator('on');
			$.postRemoteData('inventory', 'add', $('.inventory-add-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					IIMSApp.newlyCreatedProductId = data.newlyCreatedProductId;
					$(document).trigger('event/inventoryAdded');
				}
				showNotification(data, '#notification-inventory-add');
				$.buttonIndicator('off');
			});
		});
		$(document).on('show', '#ModalInventoryAdd', function () {
			$('.category-dropDown').removeClass('category-handler-for-inventory');
	    });
	    $(document).on('hidden', '#ModalInventoryAdd', function () {
			$('.category-dropDown').addClass('category-handler-for-inventory');
	    });
	});
</script>