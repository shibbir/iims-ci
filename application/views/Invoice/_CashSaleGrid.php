<div id="notification-cashsale-delete"></div>

<table id="invoicesByCashSaleGrid">
	<thead>
		<tr>
	  		<th>Date</th>
	  		<th>Invoice Number</th>
	  		<th>Invoice Type</th>
	  		<th>Customer Info</th>
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

<script id="template-invoicesByCashSale" type="text/x-handlebars-template">
	<tr>
		<td>{{CreatedDate}}</td>
		<td>{{InvoiceNumber}}</td>
		<td>{{InvoiceType}}</td>
  		<td>
  			{{CustomerNameForCashSale}}
  			{{#if CustomerMobileForCashSale}}
  				<p>Contact: {{CustomerMobileForCashSale}}</p>
  			{{/if}}
  		</td>
  		<td>
  			<p>Total Cost: {{TotalCost}} tk.</p>
			<p>Service Charge: {{ServiceCharge}} tk.</p>
			<p>Total Discount: {{TotalDiscount}} tk.</p>
			<p>Grand Total: {{GrandTotal}} tk.</p>
  		</td>
  		<td><a href="<?=site_url('user/profile')?>/{{CreatorUserName}}">{{CreatorName}}</a></td>
  		<td>
  			<a title="<?=site_url('printer/index').'/{{ID}}'?>" class="btn-print btn btn-primary btn-mini">
				<i class="icon-print icon-white"></i>
				<span>Print</span>
			</a>
  			<a class="btn btn-info btn-mini" href="<?=site_url('invoice/details').'/{{ID}}'?>">
				<i class="icon-edit icon-white"></i>
				See Details
			</a>
			<a class="btn btn-danger btn-delete-cashsale delete btn-mini" data-id="{{ID}}">
				<i class="icon-trash icon-white"></i>
				<span>Delete</span>
			</a>
  		</td>
	</tr>
</script>

<script>
	$(function () {
		$(document).on('event/cashInvoiceAdded', function () {
			$.renderCashInvoiceGrid();
		});

		$(document).on('click', '.btn-delete-cashsale', function () {
			var form_data = {
				ID: $(this).data('id'),
				csrf_token: "<?=$this->security->get_csrf_hash();?>"
			};
			$.deleteRemoteData('invoice', 'delete', form_data).then(function (data) {
				if(data.status === 'success') {
					$.renderCashInvoiceGrid();
				}
				showNotification(data, '#notification-cashsale-delete');
			});
		});
	});
</script>