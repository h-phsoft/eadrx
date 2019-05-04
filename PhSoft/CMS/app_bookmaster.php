<?php

// lang_id
// status_id
// book_title
// book_price
// book_image
// ins_datetime

?>
<?php if ($app_book->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_bookmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_book->lang_id->Visible) { // lang_id ?>
		<tr id="r_lang_id">
			<td class="col-sm-2"><?php echo $app_book->lang_id->FldCaption() ?></td>
			<td<?php echo $app_book->lang_id->CellAttributes() ?>>
<span id="el_app_book_lang_id">
<span<?php echo $app_book->lang_id->ViewAttributes() ?>>
<?php echo $app_book->lang_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_book->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $app_book->status_id->FldCaption() ?></td>
			<td<?php echo $app_book->status_id->CellAttributes() ?>>
<span id="el_app_book_status_id">
<span<?php echo $app_book->status_id->ViewAttributes() ?>>
<?php echo $app_book->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_book->book_title->Visible) { // book_title ?>
		<tr id="r_book_title">
			<td class="col-sm-2"><?php echo $app_book->book_title->FldCaption() ?></td>
			<td<?php echo $app_book->book_title->CellAttributes() ?>>
<span id="el_app_book_book_title">
<span<?php echo $app_book->book_title->ViewAttributes() ?>>
<?php echo $app_book->book_title->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_book->book_price->Visible) { // book_price ?>
		<tr id="r_book_price">
			<td class="col-sm-2"><?php echo $app_book->book_price->FldCaption() ?></td>
			<td<?php echo $app_book->book_price->CellAttributes() ?>>
<span id="el_app_book_book_price">
<span<?php echo $app_book->book_price->ViewAttributes() ?>>
<?php echo $app_book->book_price->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_book->book_image->Visible) { // book_image ?>
		<tr id="r_book_image">
			<td class="col-sm-2"><?php echo $app_book->book_image->FldCaption() ?></td>
			<td<?php echo $app_book->book_image->CellAttributes() ?>>
<span id="el_app_book_book_image">
<span>
<?php echo ew_GetFileViewTag($app_book->book_image, $app_book->book_image->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_book->ins_datetime->Visible) { // ins_datetime ?>
		<tr id="r_ins_datetime">
			<td class="col-sm-2"><?php echo $app_book->ins_datetime->FldCaption() ?></td>
			<td<?php echo $app_book->ins_datetime->CellAttributes() ?>>
<span id="el_app_book_ins_datetime">
<span<?php echo $app_book->ins_datetime->ViewAttributes() ?>>
<?php echo $app_book->ins_datetime->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
