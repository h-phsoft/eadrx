<?php

// cat_id
// status_id
// cat_order
// cat_name
// cat_Price

?>
<?php if ($app_consultation_category->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_consultation_categorymaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_consultation_category->cat_id->Visible) { // cat_id ?>
		<tr id="r_cat_id">
			<td class="col-sm-2"><?php echo $app_consultation_category->cat_id->FldCaption() ?></td>
			<td<?php echo $app_consultation_category->cat_id->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_id">
<span<?php echo $app_consultation_category->cat_id->ViewAttributes() ?>>
<?php echo $app_consultation_category->cat_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation_category->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $app_consultation_category->status_id->FldCaption() ?></td>
			<td<?php echo $app_consultation_category->status_id->CellAttributes() ?>>
<span id="el_app_consultation_category_status_id">
<span<?php echo $app_consultation_category->status_id->ViewAttributes() ?>>
<?php echo $app_consultation_category->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation_category->cat_order->Visible) { // cat_order ?>
		<tr id="r_cat_order">
			<td class="col-sm-2"><?php echo $app_consultation_category->cat_order->FldCaption() ?></td>
			<td<?php echo $app_consultation_category->cat_order->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_order">
<span<?php echo $app_consultation_category->cat_order->ViewAttributes() ?>>
<?php echo $app_consultation_category->cat_order->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation_category->cat_name->Visible) { // cat_name ?>
		<tr id="r_cat_name">
			<td class="col-sm-2"><?php echo $app_consultation_category->cat_name->FldCaption() ?></td>
			<td<?php echo $app_consultation_category->cat_name->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_name">
<span<?php echo $app_consultation_category->cat_name->ViewAttributes() ?>>
<?php echo $app_consultation_category->cat_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation_category->cat_Price->Visible) { // cat_Price ?>
		<tr id="r_cat_Price">
			<td class="col-sm-2"><?php echo $app_consultation_category->cat_Price->FldCaption() ?></td>
			<td<?php echo $app_consultation_category->cat_Price->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_Price">
<span<?php echo $app_consultation_category->cat_Price->ViewAttributes() ?>>
<?php echo $app_consultation_category->cat_Price->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
