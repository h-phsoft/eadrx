<?php

// key_name
// key_defvalue

?>
<?php if ($phs_keys->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_phs_keysmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($phs_keys->key_name->Visible) { // key_name ?>
		<tr id="r_key_name">
			<td class="col-sm-2"><?php echo $phs_keys->key_name->FldCaption() ?></td>
			<td<?php echo $phs_keys->key_name->CellAttributes() ?>>
<span id="el_phs_keys_key_name">
<span<?php echo $phs_keys->key_name->ViewAttributes() ?>>
<?php echo $phs_keys->key_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($phs_keys->key_defvalue->Visible) { // key_defvalue ?>
		<tr id="r_key_defvalue">
			<td class="col-sm-2"><?php echo $phs_keys->key_defvalue->FldCaption() ?></td>
			<td<?php echo $phs_keys->key_defvalue->CellAttributes() ?>>
<span id="el_phs_keys_key_defvalue">
<span<?php echo $phs_keys->key_defvalue->ViewAttributes() ?>>
<?php echo $phs_keys->key_defvalue->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
