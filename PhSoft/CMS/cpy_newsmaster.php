<?php

// status_id
// news_date
// news_title
// news_image
// news_stext
// news_text

?>
<?php if ($cpy_news->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_cpy_newsmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($cpy_news->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $cpy_news->status_id->FldCaption() ?></td>
			<td<?php echo $cpy_news->status_id->CellAttributes() ?>>
<span id="el_cpy_news_status_id">
<span<?php echo $cpy_news->status_id->ViewAttributes() ?>>
<?php echo $cpy_news->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_news->news_date->Visible) { // news_date ?>
		<tr id="r_news_date">
			<td class="col-sm-2"><?php echo $cpy_news->news_date->FldCaption() ?></td>
			<td<?php echo $cpy_news->news_date->CellAttributes() ?>>
<span id="el_cpy_news_news_date">
<span<?php echo $cpy_news->news_date->ViewAttributes() ?>>
<?php echo $cpy_news->news_date->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_news->news_title->Visible) { // news_title ?>
		<tr id="r_news_title">
			<td class="col-sm-2"><?php echo $cpy_news->news_title->FldCaption() ?></td>
			<td<?php echo $cpy_news->news_title->CellAttributes() ?>>
<span id="el_cpy_news_news_title">
<span<?php echo $cpy_news->news_title->ViewAttributes() ?>>
<?php echo $cpy_news->news_title->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_news->news_image->Visible) { // news_image ?>
		<tr id="r_news_image">
			<td class="col-sm-2"><?php echo $cpy_news->news_image->FldCaption() ?></td>
			<td<?php echo $cpy_news->news_image->CellAttributes() ?>>
<span id="el_cpy_news_news_image">
<span>
<?php echo ew_GetFileViewTag($cpy_news->news_image, $cpy_news->news_image->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_news->news_stext->Visible) { // news_stext ?>
		<tr id="r_news_stext">
			<td class="col-sm-2"><?php echo $cpy_news->news_stext->FldCaption() ?></td>
			<td<?php echo $cpy_news->news_stext->CellAttributes() ?>>
<span id="el_cpy_news_news_stext">
<span<?php echo $cpy_news->news_stext->ViewAttributes() ?>>
<?php echo $cpy_news->news_stext->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_news->news_text->Visible) { // news_text ?>
		<tr id="r_news_text">
			<td class="col-sm-2"><?php echo $cpy_news->news_text->FldCaption() ?></td>
			<td<?php echo $cpy_news->news_text->CellAttributes() ?>>
<span id="el_cpy_news_news_text">
<span<?php echo $cpy_news->news_text->ViewAttributes() ?>>
<?php echo $cpy_news->news_text->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
