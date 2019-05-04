<?php

// status_id
// slid_id
// page_name
// page_stext
// page_desc

?>
<?php if ($cpy_page->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_cpy_pagemaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($cpy_page->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $cpy_page->status_id->FldCaption() ?></td>
			<td<?php echo $cpy_page->status_id->CellAttributes() ?>>
<span id="el_cpy_page_status_id">
<span<?php echo $cpy_page->status_id->ViewAttributes() ?>>
<?php echo $cpy_page->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page->slid_id->Visible) { // slid_id ?>
		<tr id="r_slid_id">
			<td class="col-sm-2"><?php echo $cpy_page->slid_id->FldCaption() ?></td>
			<td<?php echo $cpy_page->slid_id->CellAttributes() ?>>
<span id="el_cpy_page_slid_id">
<span<?php echo $cpy_page->slid_id->ViewAttributes() ?>>
<?php echo $cpy_page->slid_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page->page_name->Visible) { // page_name ?>
		<tr id="r_page_name">
			<td class="col-sm-2"><?php echo $cpy_page->page_name->FldCaption() ?></td>
			<td<?php echo $cpy_page->page_name->CellAttributes() ?>>
<span id="el_cpy_page_page_name">
<span<?php echo $cpy_page->page_name->ViewAttributes() ?>>
<?php echo $cpy_page->page_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page->page_stext->Visible) { // page_stext ?>
		<tr id="r_page_stext">
			<td class="col-sm-2"><?php echo $cpy_page->page_stext->FldCaption() ?></td>
			<td<?php echo $cpy_page->page_stext->CellAttributes() ?>>
<span id="el_cpy_page_page_stext">
<span<?php echo $cpy_page->page_stext->ViewAttributes() ?>>
<?php echo $cpy_page->page_stext->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_page->page_desc->Visible) { // page_desc ?>
		<tr id="r_page_desc">
			<td class="col-sm-2"><?php echo $cpy_page->page_desc->FldCaption() ?></td>
			<td<?php echo $cpy_page->page_desc->CellAttributes() ?>>
<span id="el_cpy_page_page_desc">
<span<?php echo $cpy_page->page_desc->ViewAttributes() ?>>
<?php echo $cpy_page->page_desc->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
