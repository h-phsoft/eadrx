<?php

// serv_id
// user_id
// cycle_id
// book_id
// pkg_id
// tcat_id
// test_id
// cat_id
// cons_id
// subs_start
// subs_end
// subs_qnt
// subs_price
// subs_amt
// ins_datetime

?>
<?php if ($app_subscribe->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_app_subscribemaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
		<tr id="r_serv_id">
			<td class="col-sm-2"><?php echo $app_subscribe->serv_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->serv_id->CellAttributes() ?>>
<span id="el_app_subscribe_serv_id">
<span<?php echo $app_subscribe->serv_id->ViewAttributes() ?>>
<?php echo $app_subscribe->serv_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
		<tr id="r_user_id">
			<td class="col-sm-2"><?php echo $app_subscribe->user_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->user_id->CellAttributes() ?>>
<span id="el_app_subscribe_user_id">
<span<?php echo $app_subscribe->user_id->ViewAttributes() ?>>
<?php echo $app_subscribe->user_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
		<tr id="r_cycle_id">
			<td class="col-sm-2"><?php echo $app_subscribe->cycle_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->cycle_id->CellAttributes() ?>>
<span id="el_app_subscribe_cycle_id">
<span<?php echo $app_subscribe->cycle_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cycle_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
		<tr id="r_book_id">
			<td class="col-sm-2"><?php echo $app_subscribe->book_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->book_id->CellAttributes() ?>>
<span id="el_app_subscribe_book_id">
<span<?php echo $app_subscribe->book_id->ViewAttributes() ?>>
<?php echo $app_subscribe->book_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->pkg_id->Visible) { // pkg_id ?>
		<tr id="r_pkg_id">
			<td class="col-sm-2"><?php echo $app_subscribe->pkg_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->pkg_id->CellAttributes() ?>>
<span id="el_app_subscribe_pkg_id">
<span<?php echo $app_subscribe->pkg_id->ViewAttributes() ?>>
<?php echo $app_subscribe->pkg_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
		<tr id="r_tcat_id">
			<td class="col-sm-2"><?php echo $app_subscribe->tcat_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->tcat_id->CellAttributes() ?>>
<span id="el_app_subscribe_tcat_id">
<span<?php echo $app_subscribe->tcat_id->ViewAttributes() ?>>
<?php echo $app_subscribe->tcat_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
		<tr id="r_test_id">
			<td class="col-sm-2"><?php echo $app_subscribe->test_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->test_id->CellAttributes() ?>>
<span id="el_app_subscribe_test_id">
<span<?php echo $app_subscribe->test_id->ViewAttributes() ?>>
<?php echo $app_subscribe->test_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
		<tr id="r_cat_id">
			<td class="col-sm-2"><?php echo $app_subscribe->cat_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->cat_id->CellAttributes() ?>>
<span id="el_app_subscribe_cat_id">
<span<?php echo $app_subscribe->cat_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cat_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
		<tr id="r_cons_id">
			<td class="col-sm-2"><?php echo $app_subscribe->cons_id->FldCaption() ?></td>
			<td<?php echo $app_subscribe->cons_id->CellAttributes() ?>>
<span id="el_app_subscribe_cons_id">
<span<?php echo $app_subscribe->cons_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cons_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
		<tr id="r_subs_start">
			<td class="col-sm-2"><?php echo $app_subscribe->subs_start->FldCaption() ?></td>
			<td<?php echo $app_subscribe->subs_start->CellAttributes() ?>>
<span id="el_app_subscribe_subs_start">
<span<?php echo $app_subscribe->subs_start->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_start->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
		<tr id="r_subs_end">
			<td class="col-sm-2"><?php echo $app_subscribe->subs_end->FldCaption() ?></td>
			<td<?php echo $app_subscribe->subs_end->CellAttributes() ?>>
<span id="el_app_subscribe_subs_end">
<span<?php echo $app_subscribe->subs_end->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_end->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
		<tr id="r_subs_qnt">
			<td class="col-sm-2"><?php echo $app_subscribe->subs_qnt->FldCaption() ?></td>
			<td<?php echo $app_subscribe->subs_qnt->CellAttributes() ?>>
<span id="el_app_subscribe_subs_qnt">
<span<?php echo $app_subscribe->subs_qnt->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_qnt->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
		<tr id="r_subs_price">
			<td class="col-sm-2"><?php echo $app_subscribe->subs_price->FldCaption() ?></td>
			<td<?php echo $app_subscribe->subs_price->CellAttributes() ?>>
<span id="el_app_subscribe_subs_price">
<span<?php echo $app_subscribe->subs_price->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_price->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
		<tr id="r_subs_amt">
			<td class="col-sm-2"><?php echo $app_subscribe->subs_amt->FldCaption() ?></td>
			<td<?php echo $app_subscribe->subs_amt->CellAttributes() ?>>
<span id="el_app_subscribe_subs_amt">
<span<?php echo $app_subscribe->subs_amt->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_amt->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
		<tr id="r_ins_datetime">
			<td class="col-sm-2"><?php echo $app_subscribe->ins_datetime->FldCaption() ?></td>
			<td<?php echo $app_subscribe->ins_datetime->CellAttributes() ?>>
<span id="el_app_subscribe_ins_datetime">
<span<?php echo $app_subscribe->ins_datetime->ViewAttributes() ?>>
<?php echo $app_subscribe->ins_datetime->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
