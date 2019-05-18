<?php

// page_id
// lang_id
// status_id
// color_id
// slid_id
// row_order
// row_name
// row_stext

?>
<?php if ($cpy_page_row->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_cpy_page_rowmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($cpy_page_row->page_id->Visible) { // page_id ?>
		<tr id="r_page_id">
			<td class="col-sm-2"><?php echo $cpy_page_row->page_id->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->page_id->CellAttributes() ?>>
<span id="el_cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->page_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->lang_id->Visible) { // lang_id ?>
		<tr id="r_lang_id">
			<td class="col-sm-2"><?php echo $cpy_page_row->lang_id->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->lang_id->CellAttributes() ?>>
<span id="el_cpy_page_row_lang_id">
<span<?php echo $cpy_page_row->lang_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->lang_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $cpy_page_row->status_id->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->status_id->CellAttributes() ?>>
<span id="el_cpy_page_row_status_id">
<span<?php echo $cpy_page_row->status_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->color_id->Visible) { // color_id ?>
		<tr id="r_color_id">
			<td class="col-sm-2"><?php echo $cpy_page_row->color_id->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->color_id->CellAttributes() ?>>
<span id="el_cpy_page_row_color_id">
<span<?php echo $cpy_page_row->color_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->color_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->slid_id->Visible) { // slid_id ?>
		<tr id="r_slid_id">
			<td class="col-sm-2"><?php echo $cpy_page_row->slid_id->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->slid_id->CellAttributes() ?>>
<span id="el_cpy_page_row_slid_id">
<span<?php echo $cpy_page_row->slid_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->slid_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->row_order->Visible) { // row_order ?>
		<tr id="r_row_order">
			<td class="col-sm-2"><?php echo $cpy_page_row->row_order->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->row_order->CellAttributes() ?>>
<span id="el_cpy_page_row_row_order">
<span<?php echo $cpy_page_row->row_order->ViewAttributes() ?>>
<?php echo $cpy_page_row->row_order->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->row_name->Visible) { // row_name ?>
		<tr id="r_row_name">
			<td class="col-sm-2"><?php echo $cpy_page_row->row_name->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->row_name->CellAttributes() ?>>
<span id="el_cpy_page_row_row_name">
<span<?php echo $cpy_page_row->row_name->ViewAttributes() ?>>
<?php echo $cpy_page_row->row_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page_row->row_stext->Visible) { // row_stext ?>
		<tr id="r_row_stext">
			<td class="col-sm-2"><?php echo $cpy_page_row->row_stext->FldCaption() ?></td>
			<td<?php echo $cpy_page_row->row_stext->CellAttributes() ?>>
<span id="el_cpy_page_row_row_stext">
<span<?php echo $cpy_page_row->row_stext->ViewAttributes() ?>>
<?php echo $cpy_page_row->row_stext->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
