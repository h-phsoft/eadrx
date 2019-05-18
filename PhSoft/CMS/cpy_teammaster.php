<?php

// team_iname
// team_order
// team_photo

?>
<?php if ($cpy_team->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_cpy_teammaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($cpy_team->team_iname->Visible) { // team_iname ?>
		<tr id="r_team_iname">
			<td class="col-sm-2"><?php echo $cpy_team->team_iname->FldCaption() ?></td>
			<td<?php echo $cpy_team->team_iname->CellAttributes() ?>>
<span id="el_cpy_team_team_iname">
<span<?php echo $cpy_team->team_iname->ViewAttributes() ?>>
<?php echo $cpy_team->team_iname->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_team->team_order->Visible) { // team_order ?>
		<tr id="r_team_order">
			<td class="col-sm-2"><?php echo $cpy_team->team_order->FldCaption() ?></td>
			<td<?php echo $cpy_team->team_order->CellAttributes() ?>>
<span id="el_cpy_team_team_order">
<span<?php echo $cpy_team->team_order->ViewAttributes() ?>>
<?php echo $cpy_team->team_order->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cpy_team->team_photo->Visible) { // team_photo ?>
		<tr id="r_team_photo">
			<td class="col-sm-2"><?php echo $cpy_team->team_photo->FldCaption() ?></td>
			<td<?php echo $cpy_team->team_photo->CellAttributes() ?>>
<span id="el_cpy_team_team_photo">
<span>
<?php echo ew_GetFileViewTag($cpy_team->team_photo, $cpy_team->team_photo->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
