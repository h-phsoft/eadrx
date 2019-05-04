<?php

// status_id
// test_num
// test_iname
// test_price
// test_image

?>
<?php if ($app_test->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_testmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_test->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-2"><?php echo $app_test->status_id->FldCaption() ?></td>
			<td<?php echo $app_test->status_id->CellAttributes() ?>>
<span id="el_app_test_status_id">
<span<?php echo $app_test->status_id->ViewAttributes() ?>>
<?php echo $app_test->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_test->test_num->Visible) { // test_num ?>
		<tr id="r_test_num">
			<td class="col-sm-2"><?php echo $app_test->test_num->FldCaption() ?></td>
			<td<?php echo $app_test->test_num->CellAttributes() ?>>
<span id="el_app_test_test_num">
<span<?php echo $app_test->test_num->ViewAttributes() ?>>
<?php echo $app_test->test_num->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_test->test_iname->Visible) { // test_iname ?>
		<tr id="r_test_iname">
			<td class="col-sm-2"><?php echo $app_test->test_iname->FldCaption() ?></td>
			<td<?php echo $app_test->test_iname->CellAttributes() ?>>
<span id="el_app_test_test_iname">
<span<?php echo $app_test->test_iname->ViewAttributes() ?>>
<?php echo $app_test->test_iname->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_test->test_price->Visible) { // test_price ?>
		<tr id="r_test_price">
			<td class="col-sm-2"><?php echo $app_test->test_price->FldCaption() ?></td>
			<td<?php echo $app_test->test_price->CellAttributes() ?>>
<span id="el_app_test_test_price">
<span<?php echo $app_test->test_price->ViewAttributes() ?>>
<?php echo $app_test->test_price->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_test->test_image->Visible) { // test_image ?>
		<tr id="r_test_image">
			<td class="col-sm-2"><?php echo $app_test->test_image->FldCaption() ?></td>
			<td<?php echo $app_test->test_image->CellAttributes() ?>>
<span id="el_app_test_test_image">
<span>
<?php echo ew_GetFileViewTag($app_test->test_image, $app_test->test_image->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
