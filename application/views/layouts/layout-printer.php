<?php

foreach($invoice as $row) {
	$CreatedDate 	= $row->CreatedDate;
	$InvoiceNumber 	= $row->InvoiceNumber;
	$InvoiceType 	= $row->InvoiceType;
	$CreatorName 	= $row->CreatorName;
	$ServiceCharge 	= ($row->ServiceCharge) ? $row->ServiceCharge : 0;
	$TotalCost 		= ($row->TotalCost) ? $row->TotalCost : 0;
	$TotalDiscount 	= ($row->TotalDiscount) ? $row->TotalDiscount : 0;
	$VAT 			= ($row->VAT) ? $row->VAT : 0;
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
	$CustomerContact 	= ($CustomerMobileForCashSale) ? $CustomerMobileForCashSale : 'Not found!.';
	$CustomerAddress 	= 'Not found!';
}

?>

<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="description" content="IIMS is a simple easy-to-use, online inventory and invoice management system that also help you manage your customers, employees, products." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>IIMS</title>

        <link rel="stylesheet" href="<?=base_url('content/css/printer.min.css')?>" />
    </head>
    <body>
		<div class="container printer">
			<h2 class="pager">INVOICE</h2>
			<div class="row-fluid">
				<div class="span6">
					<h5 style="margin-bottom: 0px;"><?=$organization->Title?></h5>
					<small style="display: block;"><?=$organization->SubTitle?></small>
					<small><?=$organization->Address?></small>
					<dl>
						<dd>Phone: <?=$organization->Phone?></dd>
						<dd>Mobile: <?=$organization->Mobile?></dd>
						<dd>Email: <?=$organization->Email?></dd>
					</dl>
				</div>
				<div class="offset1 span5">
					<dl>
						<dd>Invoice Type: <?=$InvoiceType?></dd>
						<dd>Invoice Date: <?=$CreatedDate?></dd>
						<dd>Invoice Number: <?=$InvoiceNumber?></dd>
						<dd>Prepared By: <?=$CreatorName?></dd>
						<dd>Print Date: <?php date_default_timezone_set('Asia/Dhaka');echo date("d F, Y | g:i a");?></dd>
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
			<table class="table table-condensed table-bordered">
				<thead>
			  		<tr>
			  			<th style="text-align: center;">Serial</th>
				   		<th>Product Title</th>
						<th>Description</th>
						<th style="text-align: center;">Quantity</th>
						<th style="text-align: center;">Warranty</th>
						<th style="text-align: center;">Unit Price (Tk)</th>
						<th style="text-align: center;">Total Price (Tk)</th>
					</tr>
				</thead>
				<tbody>
					<?php $SL = 0;?>
					<?php foreach ($invoice_details as $row):?>
					<tr>
						<td style="text-align: center;"><?=++$SL?></td>
						<td>
							<?=$row->Title?>
							<?php if($row->SerialNumber): ?>
								<p>Serial Numbers: <?=$row->SerialNumber?></p>
							<?php endif;?>
						</td>
						<td><?=$row->Description?></td>
						<td style="text-align: center;"><?=$row->Quantity?></td>
						<td><?=$row->Warranty?></td>
						<td style="text-align: right;"><?=$row->UnitPrice?></td>
						<td style="text-align: right;"><?=$row->Quantity*$row->UnitPrice?></td>
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
						<td colspan="6" style="text-align: right;">(-) Discount</td>
						<td style="text-align: right;"><?=$TotalDiscount?> Tk</td>
					</tr>
					<tr>
						<th colspan="6" style="text-align: right;">Net Payable Amount</th>
						<th style="text-align: right;"><?=$GrandTotal?> Tk</th>
					</tr>
				</tbody>
			</table>
			<div class="row-fluid">
				<div class="span6">
					<p>Declaration</p>
					<small>
					    We declare that warranty support will not cover any kind of "Physical Damage", "Moisture/Dumpness",
					    "Burn Case", or "Time Expiration" and warranty for keyboard, mouse, speaker, casing, PSU.
					</small>
				</div>
				<div class="span6" style="text-align:right;">
					<?=$organization->Title?>
					<br /><br />
					-----------------------------<br />
					Authorized Signature
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<br /><br />
					----------------------------<br />
					Customer Signature
				</div>
				<div class="span6" style="text-align:right;">
					<br /><br />
					<small>
    					Inventory &amp; Invoice Management System
					</small>
				</div>
			</div>
		</div>
    </body>
</html>