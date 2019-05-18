<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_notification_status_grid)) $app_notification_status_grid = new capp_notification_status_grid();

// Page init
$app_notification_status_grid->Page_Init();

// Page main
$app_notification_status_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_notification_status_grid->Page_Render();
?>
<?php if ($app_notification_status->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_notification_statusgrid = new ew_Form("fapp_notification_statusgrid", "grid");
fapp_notification_statusgrid.FormKeyCountName = '<?php echo $app_notification_status_grid->FormKeyCountName ?>';

// Validate form
fapp_notification_statusgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_notif_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->notif_id->FldCaption(), $app_notification_status->notif_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nstatus_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->nstatus_id->FldCaption(), $app_notification_status->nstatus_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_user_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->user_id->FldCaption(), $app_notification_status->user_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_notif_datetime");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->notif_datetime->FldCaption(), $app_notification_status->notif_datetime->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_notif_datetime");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_notification_status->notif_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_notification_statusgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "notif_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nstatus_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "user_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "notif_datetime", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_notification_statusgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_notification_statusgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_notification_statusgrid.Lists["x_notif_id"] = {"LinkField":"x_notif_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_notif_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notification"};
fapp_notification_statusgrid.Lists["x_notif_id"].Data = "<?php echo $app_notification_status_grid->notif_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_notification_statusgrid.Lists["x_nstatus_id"] = {"LinkField":"x_nstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_status"};
fapp_notification_statusgrid.Lists["x_nstatus_id"].Data = "<?php echo $app_notification_status_grid->nstatus_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_notification_statusgrid.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_notification_statusgrid.Lists["x_user_id"].Data = "<?php echo $app_notification_status_grid->user_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_notification_status->CurrentAction == "gridadd") {
	if ($app_notification_status->CurrentMode == "copy") {
		$bSelectLimit = $app_notification_status_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_notification_status_grid->TotalRecs = $app_notification_status->ListRecordCount();
			$app_notification_status_grid->Recordset = $app_notification_status_grid->LoadRecordset($app_notification_status_grid->StartRec-1, $app_notification_status_grid->DisplayRecs);
		} else {
			if ($app_notification_status_grid->Recordset = $app_notification_status_grid->LoadRecordset())
				$app_notification_status_grid->TotalRecs = $app_notification_status_grid->Recordset->RecordCount();
		}
		$app_notification_status_grid->StartRec = 1;
		$app_notification_status_grid->DisplayRecs = $app_notification_status_grid->TotalRecs;
	} else {
		$app_notification_status->CurrentFilter = "0=1";
		$app_notification_status_grid->StartRec = 1;
		$app_notification_status_grid->DisplayRecs = $app_notification_status->GridAddRowCount;
	}
	$app_notification_status_grid->TotalRecs = $app_notification_status_grid->DisplayRecs;
	$app_notification_status_grid->StopRec = $app_notification_status_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_notification_status_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_notification_status_grid->TotalRecs <= 0)
			$app_notification_status_grid->TotalRecs = $app_notification_status->ListRecordCount();
	} else {
		if (!$app_notification_status_grid->Recordset && ($app_notification_status_grid->Recordset = $app_notification_status_grid->LoadRecordset()))
			$app_notification_status_grid->TotalRecs = $app_notification_status_grid->Recordset->RecordCount();
	}
	$app_notification_status_grid->StartRec = 1;
	$app_notification_status_grid->DisplayRecs = $app_notification_status_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_notification_status_grid->Recordset = $app_notification_status_grid->LoadRecordset($app_notification_status_grid->StartRec-1, $app_notification_status_grid->DisplayRecs);

	// Set no record found message
	if ($app_notification_status->CurrentAction == "" && $app_notification_status_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_notification_status_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_notification_status_grid->SearchWhere == "0=101")
			$app_notification_status_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_notification_status_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_notification_status_grid->RenderOtherOptions();
?>
<?php $app_notification_status_grid->ShowPageHeader(); ?>
<?php
$app_notification_status_grid->ShowMessage();
?>
<?php if ($app_notification_status_grid->TotalRecs > 0 || $app_notification_status->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_notification_status_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_notification_status">
<div id="fapp_notification_statusgrid" class="ewForm ewListForm form-inline">
<?php if ($app_notification_status_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_notification_status_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_notification_status" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_notification_statusgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_notification_status_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_notification_status_grid->RenderListOptions();

// Render list options (header, left)
$app_notification_status_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_notification_status->notif_id->Visible) { // notif_id ?>
	<?php if ($app_notification_status->SortUrl($app_notification_status->notif_id) == "") { ?>
		<th data-name="notif_id" class="<?php echo $app_notification_status->notif_id->HeaderCellClass() ?>"><div id="elh_app_notification_status_notif_id" class="app_notification_status_notif_id"><div class="ewTableHeaderCaption"><?php echo $app_notification_status->notif_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="notif_id" class="<?php echo $app_notification_status->notif_id->HeaderCellClass() ?>"><div><div id="elh_app_notification_status_notif_id" class="app_notification_status_notif_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_notification_status->notif_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_notification_status->notif_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_notification_status->notif_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_notification_status->nstatus_id->Visible) { // nstatus_id ?>
	<?php if ($app_notification_status->SortUrl($app_notification_status->nstatus_id) == "") { ?>
		<th data-name="nstatus_id" class="<?php echo $app_notification_status->nstatus_id->HeaderCellClass() ?>"><div id="elh_app_notification_status_nstatus_id" class="app_notification_status_nstatus_id"><div class="ewTableHeaderCaption"><?php echo $app_notification_status->nstatus_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nstatus_id" class="<?php echo $app_notification_status->nstatus_id->HeaderCellClass() ?>"><div><div id="elh_app_notification_status_nstatus_id" class="app_notification_status_nstatus_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_notification_status->nstatus_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_notification_status->nstatus_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_notification_status->nstatus_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_notification_status->user_id->Visible) { // user_id ?>
	<?php if ($app_notification_status->SortUrl($app_notification_status->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $app_notification_status->user_id->HeaderCellClass() ?>"><div id="elh_app_notification_status_user_id" class="app_notification_status_user_id"><div class="ewTableHeaderCaption"><?php echo $app_notification_status->user_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $app_notification_status->user_id->HeaderCellClass() ?>"><div><div id="elh_app_notification_status_user_id" class="app_notification_status_user_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_notification_status->user_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_notification_status->user_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_notification_status->user_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_notification_status->notif_datetime->Visible) { // notif_datetime ?>
	<?php if ($app_notification_status->SortUrl($app_notification_status->notif_datetime) == "") { ?>
		<th data-name="notif_datetime" class="<?php echo $app_notification_status->notif_datetime->HeaderCellClass() ?>"><div id="elh_app_notification_status_notif_datetime" class="app_notification_status_notif_datetime"><div class="ewTableHeaderCaption"><?php echo $app_notification_status->notif_datetime->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="notif_datetime" class="<?php echo $app_notification_status->notif_datetime->HeaderCellClass() ?>"><div><div id="elh_app_notification_status_notif_datetime" class="app_notification_status_notif_datetime">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_notification_status->notif_datetime->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_notification_status->notif_datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_notification_status->notif_datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_notification_status_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_notification_status_grid->StartRec = 1;
$app_notification_status_grid->StopRec = $app_notification_status_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_notification_status_grid->FormKeyCountName) && ($app_notification_status->CurrentAction == "gridadd" || $app_notification_status->CurrentAction == "gridedit" || $app_notification_status->CurrentAction == "F")) {
		$app_notification_status_grid->KeyCount = $objForm->GetValue($app_notification_status_grid->FormKeyCountName);
		$app_notification_status_grid->StopRec = $app_notification_status_grid->StartRec + $app_notification_status_grid->KeyCount - 1;
	}
}
$app_notification_status_grid->RecCnt = $app_notification_status_grid->StartRec - 1;
if ($app_notification_status_grid->Recordset && !$app_notification_status_grid->Recordset->EOF) {
	$app_notification_status_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_notification_status_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_notification_status_grid->StartRec > 1)
		$app_notification_status_grid->Recordset->Move($app_notification_status_grid->StartRec - 1);
} elseif (!$app_notification_status->AllowAddDeleteRow && $app_notification_status_grid->StopRec == 0) {
	$app_notification_status_grid->StopRec = $app_notification_status->GridAddRowCount;
}

// Initialize aggregate
$app_notification_status->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_notification_status->ResetAttrs();
$app_notification_status_grid->RenderRow();
if ($app_notification_status->CurrentAction == "gridadd")
	$app_notification_status_grid->RowIndex = 0;
if ($app_notification_status->CurrentAction == "gridedit")
	$app_notification_status_grid->RowIndex = 0;
while ($app_notification_status_grid->RecCnt < $app_notification_status_grid->StopRec) {
	$app_notification_status_grid->RecCnt++;
	if (intval($app_notification_status_grid->RecCnt) >= intval($app_notification_status_grid->StartRec)) {
		$app_notification_status_grid->RowCnt++;
		if ($app_notification_status->CurrentAction == "gridadd" || $app_notification_status->CurrentAction == "gridedit" || $app_notification_status->CurrentAction == "F") {
			$app_notification_status_grid->RowIndex++;
			$objForm->Index = $app_notification_status_grid->RowIndex;
			if ($objForm->HasValue($app_notification_status_grid->FormActionName))
				$app_notification_status_grid->RowAction = strval($objForm->GetValue($app_notification_status_grid->FormActionName));
			elseif ($app_notification_status->CurrentAction == "gridadd")
				$app_notification_status_grid->RowAction = "insert";
			else
				$app_notification_status_grid->RowAction = "";
		}

		// Set up key count
		$app_notification_status_grid->KeyCount = $app_notification_status_grid->RowIndex;

		// Init row class and style
		$app_notification_status->ResetAttrs();
		$app_notification_status->CssClass = "";
		if ($app_notification_status->CurrentAction == "gridadd") {
			if ($app_notification_status->CurrentMode == "copy") {
				$app_notification_status_grid->LoadRowValues($app_notification_status_grid->Recordset); // Load row values
				$app_notification_status_grid->SetRecordKey($app_notification_status_grid->RowOldKey, $app_notification_status_grid->Recordset); // Set old record key
			} else {
				$app_notification_status_grid->LoadRowValues(); // Load default values
				$app_notification_status_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_notification_status_grid->LoadRowValues($app_notification_status_grid->Recordset); // Load row values
		}
		$app_notification_status->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_notification_status->CurrentAction == "gridadd") // Grid add
			$app_notification_status->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_notification_status->CurrentAction == "gridadd" && $app_notification_status->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_notification_status_grid->RestoreCurrentRowFormValues($app_notification_status_grid->RowIndex); // Restore form values
		if ($app_notification_status->CurrentAction == "gridedit") { // Grid edit
			if ($app_notification_status->EventCancelled) {
				$app_notification_status_grid->RestoreCurrentRowFormValues($app_notification_status_grid->RowIndex); // Restore form values
			}
			if ($app_notification_status_grid->RowAction == "insert")
				$app_notification_status->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_notification_status->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_notification_status->CurrentAction == "gridedit" && ($app_notification_status->RowType == EW_ROWTYPE_EDIT || $app_notification_status->RowType == EW_ROWTYPE_ADD) && $app_notification_status->EventCancelled) // Update failed
			$app_notification_status_grid->RestoreCurrentRowFormValues($app_notification_status_grid->RowIndex); // Restore form values
		if ($app_notification_status->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_notification_status_grid->EditRowCnt++;
		if ($app_notification_status->CurrentAction == "F") // Confirm row
			$app_notification_status_grid->RestoreCurrentRowFormValues($app_notification_status_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_notification_status->RowAttrs = array_merge($app_notification_status->RowAttrs, array('data-rowindex'=>$app_notification_status_grid->RowCnt, 'id'=>'r' . $app_notification_status_grid->RowCnt . '_app_notification_status', 'data-rowtype'=>$app_notification_status->RowType));

		// Render row
		$app_notification_status_grid->RenderRow();

		// Render list options
		$app_notification_status_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_notification_status_grid->RowAction <> "delete" && $app_notification_status_grid->RowAction <> "insertdelete" && !($app_notification_status_grid->RowAction == "insert" && $app_notification_status->CurrentAction == "F" && $app_notification_status_grid->EmptyRow())) {
?>
	<tr<?php echo $app_notification_status->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_notification_status_grid->ListOptions->Render("body", "left", $app_notification_status_grid->RowCnt);
?>
	<?php if ($app_notification_status->notif_id->Visible) { // notif_id ?>
		<td data-name="notif_id"<?php echo $app_notification_status->notif_id->CellAttributes() ?>>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_notification_status->notif_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<span<?php echo $app_notification_status->notif_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->notif_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<select data-table="app_notification_status" data-field="x_notif_id" data-value-separator="<?php echo $app_notification_status->notif_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id"<?php echo $app_notification_status->notif_id->EditAttributes() ?>>
<?php echo $app_notification_status->notif_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->OldValue) ?>">
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_notification_status->notif_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<span<?php echo $app_notification_status->notif_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->notif_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<select data-table="app_notification_status" data-field="x_notif_id" data-value-separator="<?php echo $app_notification_status->notif_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id"<?php echo $app_notification_status->notif_id->EditAttributes() ?>>
<?php echo $app_notification_status->notif_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_id" class="app_notification_status_notif_id">
<span<?php echo $app_notification_status->notif_id->ViewAttributes() ?>>
<?php echo $app_notification_status->notif_id->ListViewValue() ?></span>
</span>
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_notification_status" data-field="x_snotif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_snotif_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_snotif_id" value="<?php echo ew_HtmlEncode($app_notification_status->snotif_id->CurrentValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_snotif_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_snotif_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_snotif_id" value="<?php echo ew_HtmlEncode($app_notification_status->snotif_id->OldValue) ?>">
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_EDIT || $app_notification_status->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_snotif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_snotif_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_snotif_id" value="<?php echo ew_HtmlEncode($app_notification_status->snotif_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_notification_status->nstatus_id->Visible) { // nstatus_id ?>
		<td data-name="nstatus_id"<?php echo $app_notification_status->nstatus_id->CellAttributes() ?>>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_nstatus_id" class="form-group app_notification_status_nstatus_id">
<select data-table="app_notification_status" data-field="x_nstatus_id" data-value-separator="<?php echo $app_notification_status->nstatus_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id"<?php echo $app_notification_status->nstatus_id->EditAttributes() ?>>
<?php echo $app_notification_status->nstatus_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id") ?>
</select>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->OldValue) ?>">
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_nstatus_id" class="form-group app_notification_status_nstatus_id">
<select data-table="app_notification_status" data-field="x_nstatus_id" data-value-separator="<?php echo $app_notification_status->nstatus_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id"<?php echo $app_notification_status->nstatus_id->EditAttributes() ?>>
<?php echo $app_notification_status->nstatus_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_nstatus_id" class="app_notification_status_nstatus_id">
<span<?php echo $app_notification_status->nstatus_id->ViewAttributes() ?>>
<?php echo $app_notification_status->nstatus_id->ListViewValue() ?></span>
</span>
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_notification_status->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $app_notification_status->user_id->CellAttributes() ?>>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_user_id" class="form-group app_notification_status_user_id">
<select data-table="app_notification_status" data-field="x_user_id" data-value-separator="<?php echo $app_notification_status->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id"<?php echo $app_notification_status->user_id->EditAttributes() ?>>
<?php echo $app_notification_status->user_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->OldValue) ?>">
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_user_id" class="form-group app_notification_status_user_id">
<select data-table="app_notification_status" data-field="x_user_id" data-value-separator="<?php echo $app_notification_status->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id"<?php echo $app_notification_status->user_id->EditAttributes() ?>>
<?php echo $app_notification_status->user_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_user_id" class="app_notification_status_user_id">
<span<?php echo $app_notification_status->user_id->ViewAttributes() ?>>
<?php echo $app_notification_status->user_id->ListViewValue() ?></span>
</span>
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_notification_status->notif_datetime->Visible) { // notif_datetime ?>
		<td data-name="notif_datetime"<?php echo $app_notification_status->notif_datetime->CellAttributes() ?>>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_datetime" class="form-group app_notification_status_notif_datetime">
<input type="text" data-table="app_notification_status" data-field="x_notif_datetime" data-format="11" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" placeholder="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->getPlaceHolder()) ?>" value="<?php echo $app_notification_status->notif_datetime->EditValue ?>"<?php echo $app_notification_status->notif_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->OldValue) ?>">
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_datetime" class="form-group app_notification_status_notif_datetime">
<input type="text" data-table="app_notification_status" data-field="x_notif_datetime" data-format="11" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" placeholder="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->getPlaceHolder()) ?>" value="<?php echo $app_notification_status->notif_datetime->EditValue ?>"<?php echo $app_notification_status->notif_datetime->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_notification_status_grid->RowCnt ?>_app_notification_status_notif_datetime" class="app_notification_status_notif_datetime">
<span<?php echo $app_notification_status->notif_datetime->ViewAttributes() ?>>
<?php echo $app_notification_status->notif_datetime->ListViewValue() ?></span>
</span>
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="fapp_notification_statusgrid$x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->FormValue) ?>">
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="fapp_notification_statusgrid$o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_notification_status_grid->ListOptions->Render("body", "right", $app_notification_status_grid->RowCnt);
?>
	</tr>
<?php if ($app_notification_status->RowType == EW_ROWTYPE_ADD || $app_notification_status->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_notification_statusgrid.UpdateOpts(<?php echo $app_notification_status_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_notification_status->CurrentAction <> "gridadd" || $app_notification_status->CurrentMode == "copy")
		if (!$app_notification_status_grid->Recordset->EOF) $app_notification_status_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_notification_status->CurrentMode == "add" || $app_notification_status->CurrentMode == "copy" || $app_notification_status->CurrentMode == "edit") {
		$app_notification_status_grid->RowIndex = '$rowindex$';
		$app_notification_status_grid->LoadRowValues();

		// Set row properties
		$app_notification_status->ResetAttrs();
		$app_notification_status->RowAttrs = array_merge($app_notification_status->RowAttrs, array('data-rowindex'=>$app_notification_status_grid->RowIndex, 'id'=>'r0_app_notification_status', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_notification_status->RowAttrs["class"], "ewTemplate");
		$app_notification_status->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_notification_status_grid->RenderRow();

		// Render list options
		$app_notification_status_grid->RenderListOptions();
		$app_notification_status_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_notification_status->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_notification_status_grid->ListOptions->Render("body", "left", $app_notification_status_grid->RowIndex);
?>
	<?php if ($app_notification_status->notif_id->Visible) { // notif_id ?>
		<td data-name="notif_id">
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<?php if ($app_notification_status->notif_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<span<?php echo $app_notification_status->notif_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->notif_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<select data-table="app_notification_status" data-field="x_notif_id" data-value-separator="<?php echo $app_notification_status->notif_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id"<?php echo $app_notification_status->notif_id->EditAttributes() ?>>
<?php echo $app_notification_status->notif_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_notification_status_notif_id" class="form-group app_notification_status_notif_id">
<span<?php echo $app_notification_status->notif_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->notif_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_notification_status->nstatus_id->Visible) { // nstatus_id ?>
		<td data-name="nstatus_id">
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_notification_status_nstatus_id" class="form-group app_notification_status_nstatus_id">
<select data-table="app_notification_status" data-field="x_nstatus_id" data-value-separator="<?php echo $app_notification_status->nstatus_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id"<?php echo $app_notification_status->nstatus_id->EditAttributes() ?>>
<?php echo $app_notification_status->nstatus_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_notification_status_nstatus_id" class="form-group app_notification_status_nstatus_id">
<span<?php echo $app_notification_status->nstatus_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->nstatus_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_notification_status" data-field="x_nstatus_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_nstatus_id" value="<?php echo ew_HtmlEncode($app_notification_status->nstatus_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_notification_status->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_notification_status_user_id" class="form-group app_notification_status_user_id">
<select data-table="app_notification_status" data-field="x_user_id" data-value-separator="<?php echo $app_notification_status->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id"<?php echo $app_notification_status->user_id->EditAttributes() ?>>
<?php echo $app_notification_status->user_id->SelectOptionListHtml("x<?php echo $app_notification_status_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_notification_status_user_id" class="form-group app_notification_status_user_id">
<span<?php echo $app_notification_status->user_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->user_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="x<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_notification_status" data-field="x_user_id" name="o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" id="o<?php echo $app_notification_status_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_notification_status->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_notification_status->notif_datetime->Visible) { // notif_datetime ?>
		<td data-name="notif_datetime">
<?php if ($app_notification_status->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_notification_status_notif_datetime" class="form-group app_notification_status_notif_datetime">
<input type="text" data-table="app_notification_status" data-field="x_notif_datetime" data-format="11" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" placeholder="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->getPlaceHolder()) ?>" value="<?php echo $app_notification_status->notif_datetime->EditValue ?>"<?php echo $app_notification_status->notif_datetime->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_notification_status_notif_datetime" class="form-group app_notification_status_notif_datetime">
<span<?php echo $app_notification_status->notif_datetime->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->notif_datetime->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="x<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_notification_status" data-field="x_notif_datetime" name="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" id="o<?php echo $app_notification_status_grid->RowIndex ?>_notif_datetime" value="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_notification_status_grid->ListOptions->Render("body", "right", $app_notification_status_grid->RowIndex);
?>
<script type="text/javascript">
fapp_notification_statusgrid.UpdateOpts(<?php echo $app_notification_status_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_notification_status->CurrentMode == "add" || $app_notification_status->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_notification_status_grid->FormKeyCountName ?>" id="<?php echo $app_notification_status_grid->FormKeyCountName ?>" value="<?php echo $app_notification_status_grid->KeyCount ?>">
<?php echo $app_notification_status_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_notification_status->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_notification_status_grid->FormKeyCountName ?>" id="<?php echo $app_notification_status_grid->FormKeyCountName ?>" value="<?php echo $app_notification_status_grid->KeyCount ?>">
<?php echo $app_notification_status_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_notification_status->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_notification_statusgrid">
</div>
<?php

// Close recordset
if ($app_notification_status_grid->Recordset)
	$app_notification_status_grid->Recordset->Close();
?>
<?php if ($app_notification_status_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_notification_status_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_notification_status_grid->TotalRecs == 0 && $app_notification_status->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_notification_status_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_notification_status->Export == "") { ?>
<script type="text/javascript">
fapp_notification_statusgrid.Init();
</script>
<?php } ?>
<?php
$app_notification_status_grid->Page_Terminate();
?>
