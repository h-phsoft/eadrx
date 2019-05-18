<?php

// for_id
// lang_id
// nstatus_id
// notif_title
// notif_text
// ins_datetime
// upd_datetime

?>
<?php if ($app_notification->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_notificationmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_notification->for_id->Visible) { // for_id ?>
		<tr id="r_for_id">
			<td class="col-sm-2"><?php echo $app_notification->for_id->FldCaption() ?></td>
			<td<?php echo $app_notification->for_id->CellAttributes() ?>>
<span id="el_app_notification_for_id">
<span<?php echo $app_notification->for_id->ViewAttributes() ?>>
<?php echo $app_notification->for_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_notification->lang_id->Visible) { // lang_id ?>
		<tr id="r_lang_id">
			<td class="col-sm-2"><?php echo $app_notification->lang_id->FldCaption() ?></td>
			<td<?php echo $app_notification->lang_id->CellAttributes() ?>>
<span id="el_app_notification_lang_id">
<span<?php echo $app_notification->lang_id->ViewAttributes() ?>>
<?php echo $app_notification->lang_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_notification->nstatus_id->Visible) { // nstatus_id ?>
		<tr id="r_nstatus_id">
			<td class="col-sm-2"><?php echo $app_notification->nstatus_id->FldCaption() ?></td>
			<td<?php echo $app_notification->nstatus_id->CellAttributes() ?>>
<span id="el_app_notification_nstatus_id">
<span<?php echo $app_notification->nstatus_id->ViewAttributes() ?>>
<?php echo $app_notification->nstatus_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_notification->notif_title->Visible) { // notif_title ?>
		<tr id="r_notif_title">
			<td class="col-sm-2"><?php echo $app_notification->notif_title->FldCaption() ?></td>
			<td<?php echo $app_notification->notif_title->CellAttributes() ?>>
<span id="el_app_notification_notif_title">
<span<?php echo $app_notification->notif_title->ViewAttributes() ?>>
<?php echo $app_notification->notif_title->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_notification->notif_text->Visible) { // notif_text ?>
		<tr id="r_notif_text">
			<td class="col-sm-2"><?php echo $app_notification->notif_text->FldCaption() ?></td>
			<td<?php echo $app_notification->notif_text->CellAttributes() ?>>
<span id="el_app_notification_notif_text">
<span<?php echo $app_notification->notif_text->ViewAttributes() ?>>
<?php echo $app_notification->notif_text->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_notification->ins_datetime->Visible) { // ins_datetime ?>
		<tr id="r_ins_datetime">
			<td class="col-sm-2"><?php echo $app_notification->ins_datetime->FldCaption() ?></td>
			<td<?php echo $app_notification->ins_datetime->CellAttributes() ?>>
<span id="el_app_notification_ins_datetime">
<span<?php echo $app_notification->ins_datetime->ViewAttributes() ?>>
<?php echo $app_notification->ins_datetime->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_notification->upd_datetime->Visible) { // upd_datetime ?>
		<tr id="r_upd_datetime">
			<td class="col-sm-2"><?php echo $app_notification->upd_datetime->FldCaption() ?></td>
			<td<?php echo $app_notification->upd_datetime->CellAttributes() ?>>
<span id="el_app_notification_upd_datetime">
<span<?php echo $app_notification->upd_datetime->ViewAttributes() ?>>
<?php echo $app_notification->upd_datetime->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
