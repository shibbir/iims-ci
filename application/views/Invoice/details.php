<link rel="stylesheet" href="<?=base_url('Content/css/style-print.css')?>" />

<?php

foreach($invoice as $row) {
	$CreatedDate	= $row->CreatedDate;
	$InvoiceID 		= $row->ID;
	$InvoiceNumber 	= $row->InvoiceNumber;
	$InvoiceType 	= $row->InvoiceType;
	$CreatorName	= $row->CreatorName;
	$UserName		= $row->UserName;
	$ServiceCharge 	= $row->ServiceCharge;
	$TotalCost 		= $row->TotalCost;
	$TotalDiscount 	= $row->TotalDiscount;
	$VAT 			= $row->VAT;
	$GrandTotal 	= $row->GrandTotal;
}

if(isset($customer)) {
	foreach($customer as $row) {
		$CustomerName 		= $row->CustomerName;
		$CustomerContact 	= $row->Contact;
		$CustomerAddress	= $row->Address;
	}
}
else {
	$CustomerName 		= $CustomerNameForCashSale;
	$CustomerContact 	= ($CustomerMobileForCashSale) ? $CustomerMobileForCashSale : 'Not available.';
	$CustomerAddress 	= 'No address available.';
}

?>

<div class="block printer">
	<h2 class="pager">INVOICE</h2>
	<div class="row-fluid">
		<div class="span5">
			<dl>
				<dd>Invoice Date: <?=$CreatedDate?></dd>
				<dd>Invoice Number: <?=$InvoiceNumber?></dd>
				<dd>Prepared By: <a href="<?=site_url('user/profile').'/'.$UserName?>"><?=$CreatorName?></a></dd>
				<dd>Print Date: <?php date_default_timezone_set('Asia/Dhaka');echo date("d F, Y | g:i a");?></dd>
			</dl>
		</div>
		<div class="offset6 span1">
			<dl>
				<a title="<?=site_url("printer/index/$InvoiceID")?>" class="btn-print">
					<i class="icon-print icon-white"></i>
					<span>Print</span>
				</a>
			</dl>
		</div>
	</div>
	<hr style="margin-top: 0px;" />
	<div class="row-fluid">
		<div class="span4">
			<small>Customer Name: <?=$CustomerName?></small>
		</div>
		<div class="span3">
			<small>Contact: <?=$CustomerContact?></small>
		</div>
		<div class="span5">
			<small>Address: <?=$CustomerAddress?></small>
		</div>
	</div>

	<hr style="margin-top: 0px;" />

	<table class="table table-condensed">
		<thead>
	  		<tr>
	  			<th style="text-align: center;">Serial</th>
		   		<th>Product Title</th>
				<th>Description</th>
				<th style="text-align: center;">Quantity</th>
				<th style="text-align: center;">Warranty</th>
				<th style="text-align: center;">Unit Price</th>
				<th style="text-align: center;">Total Price</th>
			</tr>
		</thead>
		<tbody>
			<?php $SL = 0;?>
			<?php foreach ($invoice_details as $row):?>
			<tr>
				<td style="text-align: center;"><?=++$SL?></td>
				<td>
					<?=$row->Title?>
					<p>Serial Numbers: <?=$row->SerialNumber?></p>
				</td>
				<td><?=$row->Description?></td>
				<td style="text-align: center;"><?=$row->Quantity?></td>
				<td style="text-align: center;"><?=$row->Warranty?></td>
				<td style="text-align: center;"><?=$row->UnitPrice?></td>
				<td style="text-align: center;"><?=$row->Quantity*$row->UnitPrice?></td>
			</tr>
			<?php endforeach;?>
			<tr>
				<td colspan="6" style="text-align: right;">Total Cost</td>
				<td style="text-align: right;"><?=$TotalCost?> Tk</td>
			</tr>
			<tr>
				<td colspan="6" style="text-align: right;">Service Charge / Installation</td>
				<td style="text-align: right;"><?=$ServiceCharge?> Tk</td>
			</tr>
			<tr>
				<td colspan="6" style="text-align: right;">VAT</td>
				<td style="text-align: right;"><?=$VAT?> Tk</td>
			</tr>
			<tr>
				<td colspan="6" style="text-align: right;">Discount</td>
				<td style="text-align: right;">-<?=$TotalDiscount?> Tk</td>
			</tr>
			<tr>
				<th colspan="6" style="text-align: right;">Net Payable Amount</th>
				<th style="text-align: right;"><?=$GrandTotal?> Tk</th>
			</tr>
		</tbody>
	</table>
</div>

<script>
	$(function () {
		$.initPrint();
	});
</script>