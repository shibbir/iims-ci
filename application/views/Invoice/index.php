<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-first" id="btn-sale-archive" data-toggle="tab">Regular Sale Archive</a></li>
	<li><a href="#tab-second" id="btn-cashsale-archive" data-toggle="tab">Cash Sale Archive</a></li>
    <li><a href="#tab-third" id="btn-sale-add" data-toggle="tab">Create New Invoice</a></li>
</ul>

<div class="tab-content">
	<div id="tab-first" class="tab-pane fade active in">
		<div id="notification-invoice-delete"></div>
    	<table id="invoiceGrid">
 			<thead>
				<tr>
	          		<th>Date</th>
	          		<th>Invoice Number</th>
	          		<th>Invoice Type</th>
	          		<th>Customer</th>
	          		<th>Transaction Details</th>
	          		<th>Created By</th>
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
	<div id="tab-second" class="tab-pane fade">
		<?=$this->load->view('invoice/_CashSaleGrid')?>
	</div>
	<div id="tab-third" class="tab-pane fade form-container">
		<?=$this->load->view('invoice/_MakeInvoice')?>
	</div>
</div>

<script id="template-invoice" type="text/x-handlebars-template">
	<tr>
		<td>{{CreatedDate}}</td>
		<td>{{InvoiceNumber}}</td>
		<td>{{InvoiceType}}</td>
  		<td><a href="<?=site_url('customer/profile')?>/{{CustomerID}}">{{CustomerName}}</a></td>
  		<td>
  			<p>Total Cost: {{TotalCost}} tk.</p>
			<p>Service Charge: {{ServiceCharge}} tk.</p>
			<p>Total Discount: {{TotalDiscount}} tk.</p>
			<p>Grand Total: {{GrandTotal}} tk.</p>
  		</td>
  		<td><a href="<?=site_url('user/profile')?>/{{UserName}}">{{CreatorName}}</a></td>
  		<td>
  			<a title="<?=site_url('printer/index').'/{{ID}}'?>" class="btn-print btn btn-primary btn-mini">
				<i class="icon-print icon-white"></i>
				<span>Print</span>
			</a>
  			<a class="btn btn-info btn-mini" href="<?=site_url('invoice/details').'/{{ID}}'?>">
				<i class="icon-edit icon-white"></i>
				See Details
			</a>
			<a class="btn btn-danger btn-delete-invoice delete btn-mini" data-id="{{ID}}">
				<i class="icon-trash icon-white"></i>
				<span>Delete</span>
			</a>
  		</td>
	</tr>
</script>

<script>
	function fetchCategoryForInvoice() {
		$.fetchRemoteData('category', 'getCategories').then(function (data) {
			renderCategoryDropDown(data);
			$.hideSpinner();
		});
	}
	$(function () {
		$.renderRegularInvoiceGrid();
		$.renderCashInvoiceGrid();

		$(document).on('event/regularInvoiceAdded', function () {
			$.renderRegularInvoiceGrid();
		});
		$(document).on('click', '.btn-delete-invoice', function () {
			var form_data = {
				ID: $(this).data('id'),
				csrf_token: "<?=$this->security->get_csrf_hash();?>"
			};
			$.deleteRemoteData('invoice', 'delete', form_data).then(function (data) {
				if(data.status === 'success') {
					$.renderRegularInvoiceGrid();
				}
				showNotification(data, '#notification-invoice-delete');
			});
		});
	});
</script>