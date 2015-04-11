<div class="row-fluid">
	<div class="span6">
		<div class="widget">
			<div class="widget-header"><h4>Quick Dashbaord</h4></div>
			<div class="widget-body">
				<ul class="cpanel">
					<li><a class="button1" href="<?=site_url('user/profile')?>">My Profile</a></li>
					<li><a class="button2" href="<?=site_url('user')?>">Staff</a></li>
					<li><a class="button3" href="<?=site_url('customer')?>">Customer</a></li>
					<li><a class="button4" href="<?=site_url('inventory')?>">Inventory</a></li>
					<li><a class="button5" href="<?=site_url('invoice')?>">Invoice</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="widget">
			<div class="widget-header">
				<h4>Organization Information</h4>
			</div>
			<div class="widget-body">
				<?=$this->load->view('organization/modal-add-organization')?>
				<?=$this->load->view('organization/modal-edit-organization')?>

				<div id="placeholder-organization"></div>
			</div>
		</div>
	</div>
</div>

<div class="widget">
	<div class="widget-header"><h4>Pie Chart - Inventory category</h4></div>
	<div class="widget-body">
		<div id="inventory-chart"></div>
	</div>
</div>

<div class="widget">
	<div class="widget-header"><h4>Bar Chart - Invoice By Year</h4></div>
	<div class="widget-body">
		<label class="control-label" for="ProductCategory">Select a year</label>
		<select class="invoice-per-year input-small">
			<?php for($year = date('Y'); $year >= 2012; $year--):?>
				<option><?=$year?></option>
			<?php endfor;?>
		</select>
		<div class="loading hide" style="display:inline;">
			<i class="icon-spinner icon-spin icon-2x"></i>
		</div>
		<div id="invoice-chart"></div>
	</div>
</div>

<script id="template-organization" type="text/x-handlebars-template">
	{{#if ID}}
		<h4>{{Title}}</h4>
		<small>{{SubTitle}}</small>
		<address>{{{Address}}}</address>
		<p><span class="label label-important">Mobile</span> {{Mobile}}</p>
		<p><span class="label label-important">Phone</span> {{Phone}}</p>
		<p><span class="label label-info">Email</span> {{Email}}</p>
		<p><span class="label label-info">Website</span> <a target="_blank" href="{{Website}}">{{Website}}</a></p>

		<a class="pull-right organization-edit-modal" data-target="#ModalOrganizationEdit" data-toggle="modal">Edit Organization</a>
	{{else}}
		<div class="pager text-error"><strong>Please add your organization information.</strong></div>
		<a href="#ModalOrganizationAdd" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus icon-white icon-large"></i> Add Organization Info</a>
	{{/if}}
</script>

<script>
	$(function() {
		function reloadInventoryChart() {
			$('#inventory-chart').html('');
			ajaxDataReceive('dashboard', 'getInventoryChart', 'inventory-chart');
		}
		function renderInvoiceByYear(year) {
			initInvoiceCountByYear(year);
		}

		reloadInventoryChart();
		renderInvoiceByYear(2013);
		$('.invoice-per-year').on('change', function() {
			renderInvoiceByYear($(this).val());
		});
		$(document).on('event/ajax-start', function() {
			$('.loading').show();
		});
		$(document).on('event/ajax-end', function() {
			$('.loading').hide();
		});

		var renderOrganization = function () {
			$.fetchRemoteData('organization', 'getOrganization').then(function (data) {
				renderHandlebarsTemplate('#template-organization', '#placeholder-organization', data);
				renderHandlebarsTemplate('#template-organization-edit-form', '#placeholder-organization-edit-form', data);
				$.hideSpinner();
			});
		};

		var addOrganization = function() {
			$.buttonIndicator('on');
			$.postRemoteData('organization', 'add', $('.organization-add-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					renderOrganization();
					$("#ModalOrganizationAdd").modal("hide");
				}
				showNotification(data, '#notification-organization-add');
				$.buttonIndicator('off');
			});
		};

		var updateOrganization = function() {
			$.buttonIndicator('on');
			$.postRemoteData('organization', 'edit', $('.organization-edit-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					renderOrganization();
				}
				showNotification(data, '#notification-organization-edit', 'edit');
				$.buttonIndicator('off');
			});
		};

		$(document).on('click', '.btn-add-organization', function () {
			addOrganization();
		});
		$(document).on('click', '.btn-edit-organization', function () {
			updateOrganization();
		});

		renderOrganization();
	});
</script>