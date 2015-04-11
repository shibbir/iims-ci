<?=$this->load->view('customer/modal-edit-customer')?>

<ul class="nav nav-tabs">
	<li class="active"><a data-target="#customer" data-toggle="tab">Customer</a></li>
    <li><a data-target="#customer-invoice" data-toggle="tab">Invoice Log</a></li>
</ul>

<div class="tab-content">
	<div id="customer" class="tab-pane fade active in">
		<div id="placeholder-customer"></div>
	</div>
	<div id="customer-invoice" class="tab-pane fader">
		<div id="placeholder-customerHistory"></div>
	</div>
</div>

<script id="template-customer" type="text/x-handlebars-template">
	{{#if customer}}
		{{#customer}}
			<div class="block">
   				<h3>Customer Name: {{CustomerName}}</h3>
   				<h4>Registration Date: {{CreatedDate}}</h4>
				<h4>Contact Number: {{Contact}}</h4>

				<h4><address>Address: {{{Address}}}</address></h4>

				<a class="btn btn-primary customer-edit-modal" data-id="{{ID}}" data-target="#ModalCustomerEdit" data-toggle="modal">
					<i class="icon-edit icon-white"></i>
					Edit
				</a>
			</div>
		{{/customer}}
	{{else}}
		<div class="block pager text-error"><strong>Sorry, no information found! Try reloading the page.</strong></div>
	{{/if}}
</script>

<script id="template-customerHistory" type="text/x-handlebars-template">
	{{#if invoice}}
	    <table class="table table-striped">
	    	<thead>
				<tr>
					<th>Invoice Number</th>
					<th>Invoice Type</th>
					<th>Created By</th>
					<th>Created Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				{{#invoice}}
				<tr>
					<td>{{InvoiceNumber}}</td>
					<td>{{InvoiceType}}</td>
					<td><a href="<?=site_url('user/profile').'/{{CreatorUserName}}'?>">{{CreatorName}}</a></td>
					<td>{{CreatedDate}}</td>
					<td><a href="<?=site_url('invoice/details').'/{{ID}}'?>">See Details</a></td>
				</tr>
				{{/invoice}}
			</tbody>
	    </table>
    {{else}}
		<div class="block pager text-error"><strong>Sorry, no record found for this customer!</strong></div>
	{{/if}}	
</script>

<script>
	var customer = {};
	function renderCustomer() {
		var form_data = {
			ID: <?=$customerId?>
		};
		$.fetchRemoteData('customer', 'getCustomer', form_data).then(function (data) {
			customer = {
			    ID: data.customer[0].ID,
			    CustomerName: data.customer[0].CustomerName,
			    Contact: data.customer[0].Contact,
			    Address: data.customer[0].Address,
			    CreatedDate: data.customer[0].CreatedDate
			}
			renderHandlebarsTemplate('#template-customer', '#placeholder-customer', data);
			$.hideSpinner();
		});
	}

	function renderCustomerHistory() {
		var form_data = {
			CustomerID: <?=$customerId?>
		};
		$.fetchRemoteData('invoice', 'getInvoiceByCustomerID', form_data).then(function (data) {
			renderHandlebarsTemplate('#template-customerHistory', '#placeholder-customerHistory', data);
			$.hideSpinner();
		});
	}
	$(function () {
		renderCustomer();
		renderCustomerHistory();

		$(document).on('event/customerEdited', function () {
			renderCustomer();
	    });
	});
</script>