<?php

// status_id
// fcat_order
// fcat_name

?>
<?php if ($cpy_faq_category->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_cpy_faq_categorymaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($cpy_faq_category->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $cpy_faq_category->status_id->FldCaption() ?></td>
			<td<?php echo $cpy_faq_category->status_id->CellAttributes() ?>>
<span id="el_cpy_faq_category_status_id">
<span<?php echo $cpy_faq_category->status_id->ViewAttributes() ?>>
<?php echo $cpy_faq_category->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_faq_category->fcat_order->Visible) { // fcat_order ?>
		<tr id="r_fcat_order">
			<td class="col-sm-2"><?php echo $cpy_faq_category->fcat_order->FldCaption() ?></td>
			<td<?php echo $cpy_faq_category->fcat_order->CellAttributes() ?>>
<span id="el_cpy_faq_category_fcat_order">
<span<?php echo $cpy_faq_category->fcat_order->ViewAttributes() ?>>
<?php echo $cpy_faq_category->fcat_order->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_faq_category->fcat_name->Visible) { // fcat_name ?>
		<tr id="r_fcat_name">
			<td class="col-sm-2"><?php echo $cpy_faq_category->fcat_name->FldCaption() ?></td>
			<td<?php echo $cpy_faq_category->fcat_name->CellAttributes() ?>>
<span id="el_cpy_faq_category_fcat_name">
<span<?php echo $cpy_faq_category->fcat_name->ViewAttributes() ?>>
<?php echo $cpy_faq_category->fcat_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
