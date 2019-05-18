<?php

// cycle_id
// status_id
// pkg_order
// pkg_name
// pkg_price

?>
<?php if ($app_tips_package->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_tips_packagemaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_tips_package->cycle_id->Visible) { // cycle_id ?>
		<tr id="r_cycle_id">
			<td class="col-sm-2"><?php echo $app_tips_package->cycle_id->FldCaption() ?></td>
			<td<?php echo $app_tips_package->cycle_id->CellAttributes() ?>>
<span id="el_app_tips_package_cycle_id">
<span<?php echo $app_tips_package->cycle_id->ViewAttributes() ?>>
<?php echo $app_tips_package->cycle_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_tips_package->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $app_tips_package->status_id->FldCaption() ?></td>
			<td<?php echo $app_tips_package->status_id->CellAttributes() ?>>
<span id="el_app_tips_package_status_id">
<span<?php echo $app_tips_package->status_id->ViewAttributes() ?>>
<?php echo $app_tips_package->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_tips_package->pkg_order->Visible) { // pkg_order ?>
		<tr id="r_pkg_order">
			<td class="col-sm-2"><?php echo $app_tips_package->pkg_order->FldCaption() ?></td>
			<td<?php echo $app_tips_package->pkg_order->CellAttributes() ?>>
<span id="el_app_tips_package_pkg_order">
<span<?php echo $app_tips_package->pkg_order->ViewAttributes() ?>>
<?php echo $app_tips_package->pkg_order->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_tips_package->pkg_name->Visible) { // pkg_name ?>
		<tr id="r_pkg_name">
			<td class="col-sm-2"><?php echo $app_tips_package->pkg_name->FldCaption() ?></td>
			<td<?php echo $app_tips_package->pkg_name->CellAttributes() ?>>
<span id="el_app_tips_package_pkg_name">
<span<?php echo $app_tips_package->pkg_name->ViewAttributes() ?>>
<?php echo $app_tips_package->pkg_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_tips_package->pkg_price->Visible) { // pkg_price ?>
		<tr id="r_pkg_price">
			<td class="col-sm-2"><?php echo $app_tips_package->pkg_price->FldCaption() ?></td>
			<td<?php echo $app_tips_package->pkg_price->CellAttributes() ?>>
<span id="el_app_tips_package_pkg_price">
<span<?php echo $app_tips_package->pkg_price->ViewAttributes() ?>>
<?php echo $app_tips_package->pkg_price->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
