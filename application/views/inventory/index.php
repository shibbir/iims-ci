<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?=$this->load->view('inventory/modal/modal-edit-category')?>
<?=$this->load->view('inventory/modal/modal-edit-inventory')?>

<ul class="nav nav-tabs" id="tab-inventory">
	<li class="active"><a data-target="#inventory-list" data-toggle="tab">Inventory List</a></li>
    <li><a data-target="#add-category" data-toggle="tab">Manage Category</a></li>
    <li><a data-target="#add-inventory" data-toggle="tab">Add new product</a></li>
</ul>

<div class="tab-content">
	<div id="inventory-list" class="tab-pane fade active in">
		<div class="placeholder-category-dropdown"></div>
		<br />
		<div id="notification-inventory-delete"></div>
		<table id="inventoryGrid">
 			<thead>
				<tr>
	          		<th>Title</th>
	          		<th>Description</th>
	          		<th>UnitPrice</th>
	          		<th>Warranty</th>
	          		<th>Quantity</th>
	          		<th>Status</th>
	          		<th>Action</th>
	      		</tr>
	  		</thead>
	  		<tbody>
				<tr>
					<td colspan="7"></td>
				</tr>
			</tbody>
 		</table>
	</div>
	<div id="add-category" class="tab-pane fade form-container">
		<?=$this->load->view('inventory/category')?>
	</div>
	<div id="add-inventory" class="tab-pane fade form-container">
		<?=$this->load->view('inventory/modal/modal-add-inventory')?>
	</div>
</div>

<script id="template-inventory" type="text/x-handlebars-template">
	<tr>
		<td>{{Title}}</td>
  		<td>{{{Description}}}</td>
  		<td>{{UnitPrice}}</td>
  		<td>{{Warranty}}</td>
  		<td>{{Quantity}}</td>
  		<td>{{Status}}</td>
  		<td data-id="{{ID}}">
  			<a class="btn btn-primary btn-mini inventory-edit-modal" data-target="#ModalInventoryEdit" data-toggle="modal">
				<i class="icon-edit icon-white"></i>
				Edit
			</a>
			<a class="btn btn-danger btn-mini btn-delete-inventory delete" data-category-id="{{CategoryID}}">
				<i class="icon-trash icon-white"></i>
				Delete
			</a>
  		</td>
	</tr>
</script>

<script>
	function renderInventoryList(categoryId) {
		var form_data = {
			CategoryID: categoryId
		};
		$.fetchRemoteData('inventory', 'getInventory', form_data).then(function (data) {
			$.hideSpinner();
			var template = Handlebars.compile($('#template-inventory').html());
			var dataSource = new kendo.data.DataSource({
			      data: data,
			      pageSize: 15
			});

			var grid = $('#inventoryGrid').data('kendoGrid');

			if(grid === undefined) {
				$('#inventoryGrid').kendoGrid({
					filterable: false,
					sortable: false,
	     			scrollable: true,
	     			pageable: {
	     				info: true
	     			},
	     			scrollable: false,
	     			rowTemplate: function(data) {
		                return template(data);
		            },
		            dataSource: dataSource
				});
			}
			else {
				grid.setDataSource(dataSource);
				grid.refresh();
			}
		});
	}
	$(function () {
		renderInventoryList(1);

		$('a[data-toggle="tab"]:first').on('shown', function () {
			$('.category-dropDown').addClass('category-handler-for-inventory');
		});
		$('#tab-inventory li:eq(1) a').on('shown', function () {
			clearInput();
		});
		$('a[data-toggle="tab"]:last').on('shown', function () {
			resetAddInventory();
		});

		$(document).on('change', '.category-handler-for-inventory', function () {
			if($(this).val()) {
				renderInventoryList($(this).val());
			}
		});
		$(document).on('click', '.btn-delete-inventory', function () {
			var $this = $(this),
				categoryId = $this.data('categoryId'),
				form_data = {
					ID: $this.parent('td').data('id'),
					csrf_token: "<?=$this->security->get_csrf_hash();?>"
				};
			$.deleteRemoteData('inventory', 'delete', form_data).then(function (data) {
				if(data.status === 'success') {
					renderInventoryList(categoryId);
				}
				showNotification(data, '#notification-inventory-delete');
			});
		});
		$(document).on('event/inventoryAdded', function () {
			fetchCategory();
			renderInventoryList(1);
		});
	});
</script>