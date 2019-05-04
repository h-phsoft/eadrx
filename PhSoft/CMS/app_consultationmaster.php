<?php

// user_id
// cstatus_id
// cat_id
// cons_amount
// cons_file
// cons_audio
// ins_datetime

?>
<?php if ($app_consultation->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_consultationmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_consultation->user_id->Visible) { // user_id ?>
		<tr id="r_user_id">
			<td class="col-sm-2"><?php echo $app_consultation->user_id->FldCaption() ?></td>
			<td<?php echo $app_consultation->user_id->CellAttributes() ?>>
<span id="el_app_consultation_user_id">
<span<?php echo $app_consultation->user_id->ViewAttributes() ?>>
<?php echo $app_consultation->user_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation->cstatus_id->Visible) { // cstatus_id ?>
		<tr id="r_cstatus_id">
			<td class="col-sm-2"><?php echo $app_consultation->cstatus_id->FldCaption() ?></td>
			<td<?php echo $app_consultation->cstatus_id->CellAttributes() ?>>
<span id="el_app_consultation_cstatus_id">
<span<?php echo $app_consultation->cstatus_id->ViewAttributes() ?>>
<?php echo $app_consultation->cstatus_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation->cat_id->Visible) { // cat_id ?>
		<tr id="r_cat_id">
			<td class="col-sm-2"><?php echo $app_consultation->cat_id->FldCaption() ?></td>
			<td<?php echo $app_consultation->cat_id->CellAttributes() ?>>
<span id="el_app_consultation_cat_id">
<span<?php echo $app_consultation->cat_id->ViewAttributes() ?>>
<?php echo $app_consultation->cat_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation->cons_amount->Visible) { // cons_amount ?>
		<tr id="r_cons_amount">
			<td class="col-sm-2"><?php echo $app_consultation->cons_amount->FldCaption() ?></td>
			<td<?php echo $app_consultation->cons_amount->CellAttributes() ?>>
<span id="el_app_consultation_cons_amount">
<span<?php echo $app_consultation->cons_amount->ViewAttributes() ?>>
<?php echo $app_consultation->cons_amount->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation->cons_file->Visible) { // cons_file ?>
		<tr id="r_cons_file">
			<td class="col-sm-2"><?php echo $app_consultation->cons_file->FldCaption() ?></td>
			<td<?php echo $app_consultation->cons_file->CellAttributes() ?>>
<span id="el_app_consultation_cons_file">
<span<?php echo $app_consultation->cons_file->ViewAttributes() ?>>
<?php echo $app_consultation->cons_file->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation->cons_audio->Visible) { // cons_audio ?>
		<tr id="r_cons_audio">
			<td class="col-sm-2"><?php echo $app_consultation->cons_audio->FldCaption() ?></td>
			<td<?php echo $app_consultation->cons_audio->CellAttributes() ?>>
<span id="el_app_consultation_cons_audio">
<span<?php echo $app_consultation->cons_audio->ViewAttributes() ?>>
<?php echo $app_consultation->cons_audio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_consultation->ins_datetime->Visible) { // ins_datetime ?>
		<tr id="r_ins_datetime">
			<td class="col-sm-2"><?php echo $app_consultation->ins_datetime->FldCaption() ?></td>
			<td<?php echo $app_consultation->ins_datetime->CellAttributes() ?>>
<span id="el_app_consultation_ins_datetime">
<span<?php echo $app_consultation->ins_datetime->ViewAttributes() ?>>
<?php echo $app_consultation->ins_datetime->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
