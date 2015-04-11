<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?=$this->load->view('customer/modal-edit-customer')?>

<ul class="nav nav-tabs">
	<li class="active"><a data-target="#customer-list" data-toggle="tab">Customer List</a></li>
    <li><a data-target="#customer-add" data-toggle="tab">Add new customer</a></li>
</ul>

<div class="tab-content">
	<div id="customer-list" class="tab-pane fade active in">
		<div id="notification-customer-delete"></div>
		<table id="customerGrid">
 			<thead>
				<tr>
	          		<th>Customer Name</th>
	          		<th>Contact</th>
	          		<th>Address</th>
	          		<th>Created By</th>
	          		<th>Created Date</th>
	          		<th>Modified By</th>
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
	<div id="customer-add" class="tab-pane fade form-container">
		<?=$this->load->view('customer/modal-add-customer')?>
	</div>
</div>

<script id="template-customer" type="text/x-handlebars-template">
	<tr data-id="{{ID}}">
		<td data-field="CustomerName">{{CustomerName}}</td>
  		<td data-field="Contact">{{Contact}}</td>
  		<td data-field="Address">{{{Address}}}</td>
  		<td><a href="<?=site_url('user/profile')?>/{{CreatorUserName}}">{{CreatorName}}</a></td>
  		<td>{{CreatedDate}}</td>
  		<td><a href="<?=site_url('user/profile')?>/{{ModifierUserName}}">{{ModifierName}}</a></td>
  		<td>
  			<a class="btn btn-info btn-mini" href="<?=site_url('customer/profile').'/{{ID}}'?>">
				<i class="icon-edit icon-white"></i>
				Details
			</a>
  			<a class="btn btn-primary customer-edit-modal  btn-mini" data-id="{{ID}}" data-target="#ModalCustomerEdit" data-toggle="modal">
				<i class="icon-edit icon-white"></i>
				Edit
			</a>
			<a class="btn btn-danger btn-delete-customer delete btn-mini" data-id="{{ID}}">
				<i class="icon-trash icon-white"></i>
				Delete
			</a>
  		</td>
	</tr>
</script>

<script>
	$(function () {
		$.renderCustomerGrid();
		$(document).on('event/customerAdded', function () {
			$.renderCustomerGrid();
		});
		$(document).on('event/customerEdited', function () {
			$.renderCustomerGrid();
		});
		$('a[data-toggle="tab"]:last').on('shown', function () {
			clearInput();
		});
		$(document).on('click', '.btn-delete-customer', function () {
			var form_data = {
				ID: $(this).data('id'),
				csrf_token: "<?=$this->security->get_csrf_hash();?>"
			};
			$.deleteRemoteData('customer', 'delete', form_data).then(function (data) {
				if(data.status === 'success') {
					$.renderCustomerGrid();
				}
				showNotification(data, '#notification-customer-delete');
			});
		});
	});
</script>