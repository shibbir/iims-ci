<div class="well">
	<div style="margin-bottom: 5px;">
		<span class="label label-important label-notification">Critical</span>
		<span class="text-info">This product has zero quantity</span>
	</div>
	<div>
		<span class="label label-warning label-notification">Warning</span>
		<span class="text-info">The qunatity of this product is less than five.</span>
	</div>
</div>

<?php if($notifications):?>

	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Label</th>
				<th>Category</th>
				<th>Product Title</th>
				<th>Quantity</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($notifications as $notification):?>
			<tr>
				<td>
					<?php if($notification->Quantity <= 0):?>
						<span class="label label-important label-notification">Critical</span>
					<?php else:?>
						<span class="label label-warning label-notification">Warning</span>
					<?php endif;?>
				</td>
				<td><?=$notification->CategoryName?></td>
				<td><?=$notification->Title?></td>
				<td><?=$notification->Quantity?></td>
				<td>
					<?php if($notification->Status == 'Yes'):?>
						<span class="green">Available</span>
					<?php else:?>
						<span class="red">Not Available</span>
					<?php endif;?>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>

<?php else: ?>
	No notification found.
<?php endif;?>