<?php

// status_id
// tcat_name

?>
<?php if ($app_tips_category->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_tips_categorymaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_tips_category->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $app_tips_category->status_id->FldCaption() ?></td>
			<td<?php echo $app_tips_category->status_id->CellAttributes() ?>>
<span id="el_app_tips_category_status_id">
<span<?php echo $app_tips_category->status_id->ViewAttributes() ?>>
<?php echo $app_tips_category->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_tips_category->tcat_name->Visible) { // tcat_name ?>
		<tr id="r_tcat_name">
			<td class="col-sm-2"><?php echo $app_tips_category->tcat_name->FldCaption() ?></td>
			<td<?php echo $app_tips_category->tcat_name->CellAttributes() ?>>
<span id="el_app_tips_category_tcat_name">
<span<?php echo $app_tips_category->tcat_name->ViewAttributes() ?>>
<?php echo $app_tips_category->tcat_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
