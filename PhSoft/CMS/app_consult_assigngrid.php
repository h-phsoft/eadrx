<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_consult_assign_grid)) $app_consult_assign_grid = new capp_consult_assign_grid();

// Page init
$app_consult_assign_grid->Page_Init();

// Page main
$app_consult_assign_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consult_assign_grid->Page_Render();
?>
<?php if ($app_consult_assign->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_consult_assigngrid = new ew_Form("fapp_consult_assigngrid", "grid");
fapp_consult_assigngrid.FormKeyCountName = '<?php echo $app_consult_assign_grid->FormKeyCountName ?>';

// Validate form
fapp_consult_assigngrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_user_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consult_assign->user_id->FldCaption(), $app_consult_assign->user_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cons_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consult_assign->cons_id->FldCaption(), $app_consult_assign->cons_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consult_assign->status_id->FldCaption(), $app_consult_assign->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ins_datetime");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_consult_assign->ins_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_consult_assigngrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "user_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cons_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "status_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ins_datetime", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_consult_assigngrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consult_assigngrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consult_assigngrid.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_consult_assigngrid.Lists["x_user_id"].Data = "<?php echo $app_consult_assign_grid->user_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_consult_assigngrid.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_message","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_consult_assigngrid.Lists["x_cons_id"].Data = "<?php echo $app_consult_assign_grid->cons_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_consult_assigngrid.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_consult_assigngrid.Lists["x_status_id"].Data = "<?php echo $app_consult_assign_grid->status_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_consult_assign->CurrentAction == "gridadd") {
	if ($app_consult_assign->CurrentMode == "copy") {
		$bSelectLimit = $app_consult_assign_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_consult_assign_grid->TotalRecs = $app_consult_assign->ListRecordCount();
			$app_consult_assign_grid->Recordset = $app_consult_assign_grid->LoadRecordset($app_consult_assign_grid->StartRec-1, $app_consult_assign_grid->DisplayRecs);
		} else {
			if ($app_consult_assign_grid->Recordset = $app_consult_assign_grid->LoadRecordset())
				$app_consult_assign_grid->TotalRecs = $app_consult_assign_grid->Recordset->RecordCount();
		}
		$app_consult_assign_grid->StartRec = 1;
		$app_consult_assign_grid->DisplayRecs = $app_consult_assign_grid->TotalRecs;
	} else {
		$app_consult_assign->CurrentFilter = "0=1";
		$app_consult_assign_grid->StartRec = 1;
		$app_consult_assign_grid->DisplayRecs = $app_consult_assign->GridAddRowCount;
	}
	$app_consult_assign_grid->TotalRecs = $app_consult_assign_grid->DisplayRecs;
	$app_consult_assign_grid->StopRec = $app_consult_assign_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_consult_assign_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_consult_assign_grid->TotalRecs <= 0)
			$app_consult_assign_grid->TotalRecs = $app_consult_assign->ListRecordCount();
	} else {
		if (!$app_consult_assign_grid->Recordset && ($app_consult_assign_grid->Recordset = $app_consult_assign_grid->LoadRecordset()))
			$app_consult_assign_grid->TotalRecs = $app_consult_assign_grid->Recordset->RecordCount();
	}
	$app_consult_assign_grid->StartRec = 1;
	$app_consult_assign_grid->DisplayRecs = $app_consult_assign_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_consult_assign_grid->Recordset = $app_consult_assign_grid->LoadRecordset($app_consult_assign_grid->StartRec-1, $app_consult_assign_grid->DisplayRecs);

	// Set no record found message
	if ($app_consult_assign->CurrentAction == "" && $app_consult_assign_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_consult_assign_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_consult_assign_grid->SearchWhere == "0=101")
			$app_consult_assign_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_consult_assign_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_consult_assign_grid->RenderOtherOptions();
?>
<?php $app_consult_assign_grid->ShowPageHeader(); ?>
<?php
$app_consult_assign_grid->ShowMessage();
?>
<?php if ($app_consult_assign_grid->TotalRecs > 0 || $app_consult_assign->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_consult_assign_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_consult_assign">
<div id="fapp_consult_assigngrid" class="ewForm ewListForm form-inline">
<?php if ($app_consult_assign_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_consult_assign_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_consult_assign" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_consult_assigngrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_consult_assign_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_consult_assign_grid->RenderListOptions();

// Render list options (header, left)
$app_consult_assign_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_consult_assign->user_id->Visible) { // user_id ?>
	<?php if ($app_consult_assign->SortUrl($app_consult_assign->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $app_consult_assign->user_id->HeaderCellClass() ?>"><div id="elh_app_consult_assign_user_id" class="app_consult_assign_user_id"><div class="ewTableHeaderCaption"><?php echo $app_consult_assign->user_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $app_consult_assign->user_id->HeaderCellClass() ?>"><div><div id="elh_app_consult_assign_user_id" class="app_consult_assign_user_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consult_assign->user_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consult_assign->user_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consult_assign->user_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_consult_assign->cons_id->Visible) { // cons_id ?>
	<?php if ($app_consult_assign->SortUrl($app_consult_assign->cons_id) == "") { ?>
		<th data-name="cons_id" class="<?php echo $app_consult_assign->cons_id->HeaderCellClass() ?>"><div id="elh_app_consult_assign_cons_id" class="app_consult_assign_cons_id"><div class="ewTableHeaderCaption"><?php echo $app_consult_assign->cons_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cons_id" class="<?php echo $app_consult_assign->cons_id->HeaderCellClass() ?>"><div><div id="elh_app_consult_assign_cons_id" class="app_consult_assign_cons_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consult_assign->cons_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consult_assign->cons_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consult_assign->cons_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_consult_assign->status_id->Visible) { // status_id ?>
	<?php if ($app_consult_assign->SortUrl($app_consult_assign->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $app_consult_assign->status_id->HeaderCellClass() ?>"><div id="elh_app_consult_assign_status_id" class="app_consult_assign_status_id"><div class="ewTableHeaderCaption"><?php echo $app_consult_assign->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $app_consult_assign->status_id->HeaderCellClass() ?>"><div><div id="elh_app_consult_assign_status_id" class="app_consult_assign_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consult_assign->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consult_assign->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consult_assign->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_consult_assign->ins_datetime->Visible) { // ins_datetime ?>
	<?php if ($app_consult_assign->SortUrl($app_consult_assign->ins_datetime) == "") { ?>
		<th data-name="ins_datetime" class="<?php echo $app_consult_assign->ins_datetime->HeaderCellClass() ?>"><div id="elh_app_consult_assign_ins_datetime" class="app_consult_assign_ins_datetime"><div class="ewTableHeaderCaption"><?php echo $app_consult_assign->ins_datetime->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ins_datetime" class="<?php echo $app_consult_assign->ins_datetime->HeaderCellClass() ?>"><div><div id="elh_app_consult_assign_ins_datetime" class="app_consult_assign_ins_datetime">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consult_assign->ins_datetime->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consult_assign->ins_datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consult_assign->ins_datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_consult_assign_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_consult_assign_grid->StartRec = 1;
$app_consult_assign_grid->StopRec = $app_consult_assign_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_consult_assign_grid->FormKeyCountName) && ($app_consult_assign->CurrentAction == "gridadd" || $app_consult_assign->CurrentAction == "gridedit" || $app_consult_assign->CurrentAction == "F")) {
		$app_consult_assign_grid->KeyCount = $objForm->GetValue($app_consult_assign_grid->FormKeyCountName);
		$app_consult_assign_grid->StopRec = $app_consult_assign_grid->StartRec + $app_consult_assign_grid->KeyCount - 1;
	}
}
$app_consult_assign_grid->RecCnt = $app_consult_assign_grid->StartRec - 1;
if ($app_consult_assign_grid->Recordset && !$app_consult_assign_grid->Recordset->EOF) {
	$app_consult_assign_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_consult_assign_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_consult_assign_grid->StartRec > 1)
		$app_consult_assign_grid->Recordset->Move($app_consult_assign_grid->StartRec - 1);
} elseif (!$app_consult_assign->AllowAddDeleteRow && $app_consult_assign_grid->StopRec == 0) {
	$app_consult_assign_grid->StopRec = $app_consult_assign->GridAddRowCount;
}

// Initialize aggregate
$app_consult_assign->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_consult_assign->ResetAttrs();
$app_consult_assign_grid->RenderRow();
if ($app_consult_assign->CurrentAction == "gridadd")
	$app_consult_assign_grid->RowIndex = 0;
if ($app_consult_assign->CurrentAction == "gridedit")
	$app_consult_assign_grid->RowIndex = 0;
while ($app_consult_assign_grid->RecCnt < $app_consult_assign_grid->StopRec) {
	$app_consult_assign_grid->RecCnt++;
	if (intval($app_consult_assign_grid->RecCnt) >= intval($app_consult_assign_grid->StartRec)) {
		$app_consult_assign_grid->RowCnt++;
		if ($app_consult_assign->CurrentAction == "gridadd" || $app_consult_assign->CurrentAction == "gridedit" || $app_consult_assign->CurrentAction == "F") {
			$app_consult_assign_grid->RowIndex++;
			$objForm->Index = $app_consult_assign_grid->RowIndex;
			if ($objForm->HasValue($app_consult_assign_grid->FormActionName))
				$app_consult_assign_grid->RowAction = strval($objForm->GetValue($app_consult_assign_grid->FormActionName));
			elseif ($app_consult_assign->CurrentAction == "gridadd")
				$app_consult_assign_grid->RowAction = "insert";
			else
				$app_consult_assign_grid->RowAction = "";
		}

		// Set up key count
		$app_consult_assign_grid->KeyCount = $app_consult_assign_grid->RowIndex;

		// Init row class and style
		$app_consult_assign->ResetAttrs();
		$app_consult_assign->CssClass = "";
		if ($app_consult_assign->CurrentAction == "gridadd") {
			if ($app_consult_assign->CurrentMode == "copy") {
				$app_consult_assign_grid->LoadRowValues($app_consult_assign_grid->Recordset); // Load row values
				$app_consult_assign_grid->SetRecordKey($app_consult_assign_grid->RowOldKey, $app_consult_assign_grid->Recordset); // Set old record key
			} else {
				$app_consult_assign_grid->LoadRowValues(); // Load default values
				$app_consult_assign_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_consult_assign_grid->LoadRowValues($app_consult_assign_grid->Recordset); // Load row values
		}
		$app_consult_assign->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_consult_assign->CurrentAction == "gridadd") // Grid add
			$app_consult_assign->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_consult_assign->CurrentAction == "gridadd" && $app_consult_assign->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_consult_assign_grid->RestoreCurrentRowFormValues($app_consult_assign_grid->RowIndex); // Restore form values
		if ($app_consult_assign->CurrentAction == "gridedit") { // Grid edit
			if ($app_consult_assign->EventCancelled) {
				$app_consult_assign_grid->RestoreCurrentRowFormValues($app_consult_assign_grid->RowIndex); // Restore form values
			}
			if ($app_consult_assign_grid->RowAction == "insert")
				$app_consult_assign->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_consult_assign->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_consult_assign->CurrentAction == "gridedit" && ($app_consult_assign->RowType == EW_ROWTYPE_EDIT || $app_consult_assign->RowType == EW_ROWTYPE_ADD) && $app_consult_assign->EventCancelled) // Update failed
			$app_consult_assign_grid->RestoreCurrentRowFormValues($app_consult_assign_grid->RowIndex); // Restore form values
		if ($app_consult_assign->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_consult_assign_grid->EditRowCnt++;
		if ($app_consult_assign->CurrentAction == "F") // Confirm row
			$app_consult_assign_grid->RestoreCurrentRowFormValues($app_consult_assign_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_consult_assign->RowAttrs = array_merge($app_consult_assign->RowAttrs, array('data-rowindex'=>$app_consult_assign_grid->RowCnt, 'id'=>'r' . $app_consult_assign_grid->RowCnt . '_app_consult_assign', 'data-rowtype'=>$app_consult_assign->RowType));

		// Render row
		$app_consult_assign_grid->RenderRow();

		// Render list options
		$app_consult_assign_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_consult_assign_grid->RowAction <> "delete" && $app_consult_assign_grid->RowAction <> "insertdelete" && !($app_consult_assign_grid->RowAction == "insert" && $app_consult_assign->CurrentAction == "F" && $app_consult_assign_grid->EmptyRow())) {
?>
	<tr<?php echo $app_consult_assign->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_consult_assign_grid->ListOptions->Render("body", "left", $app_consult_assign_grid->RowCnt);
?>
	<?php if ($app_consult_assign->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $app_consult_assign->user_id->CellAttributes() ?>>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_user_id" class="form-group app_consult_assign_user_id">
<select data-table="app_consult_assign" data-field="x_user_id" data-value-separator="<?php echo $app_consult_assign->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id"<?php echo $app_consult_assign->user_id->EditAttributes() ?>>
<?php echo $app_consult_assign->user_id->SelectOptionListHtml("x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_user_id" class="form-group app_consult_assign_user_id">
<select data-table="app_consult_assign" data-field="x_user_id" data-value-separator="<?php echo $app_consult_assign->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id"<?php echo $app_consult_assign->user_id->EditAttributes() ?>>
<?php echo $app_consult_assign->user_id->SelectOptionListHtml("x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_user_id" class="app_consult_assign_user_id">
<span<?php echo $app_consult_assign->user_id->ViewAttributes() ?>>
<?php echo $app_consult_assign->user_id->ListViewValue() ?></span>
</span>
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_assign_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_assign_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_assign_id" value="<?php echo ew_HtmlEncode($app_consult_assign->assign_id->CurrentValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_assign_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_assign_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_assign_id" value="<?php echo ew_HtmlEncode($app_consult_assign->assign_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_EDIT || $app_consult_assign->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_assign_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_assign_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_assign_id" value="<?php echo ew_HtmlEncode($app_consult_assign->assign_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_consult_assign->cons_id->Visible) { // cons_id ?>
		<td data-name="cons_id"<?php echo $app_consult_assign->cons_id->CellAttributes() ?>>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_consult_assign->cons_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span<?php echo $app_consult_assign->cons_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->cons_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id"><?php echo (strval($app_consult_assign->cons_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $app_consult_assign->cons_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($app_consult_assign->cons_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($app_consult_assign->cons_id->ReadOnly || $app_consult_assign->cons_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $app_consult_assign->cons_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo $app_consult_assign->cons_id->CurrentValue ?>"<?php echo $app_consult_assign->cons_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_consult_assign->cons_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span<?php echo $app_consult_assign->cons_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->cons_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id"><?php echo (strval($app_consult_assign->cons_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $app_consult_assign->cons_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($app_consult_assign->cons_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($app_consult_assign->cons_id->ReadOnly || $app_consult_assign->cons_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $app_consult_assign->cons_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo $app_consult_assign->cons_id->CurrentValue ?>"<?php echo $app_consult_assign->cons_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_cons_id" class="app_consult_assign_cons_id">
<span<?php echo $app_consult_assign->cons_id->ViewAttributes() ?>>
<?php echo $app_consult_assign->cons_id->ListViewValue() ?></span>
</span>
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_consult_assign->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $app_consult_assign->status_id->CellAttributes() ?>>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_status_id" class="form-group app_consult_assign_status_id">
<select data-table="app_consult_assign" data-field="x_status_id" data-value-separator="<?php echo $app_consult_assign->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id"<?php echo $app_consult_assign->status_id->EditAttributes() ?>>
<?php echo $app_consult_assign->status_id->SelectOptionListHtml("x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_status_id" class="form-group app_consult_assign_status_id">
<select data-table="app_consult_assign" data-field="x_status_id" data-value-separator="<?php echo $app_consult_assign->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id"<?php echo $app_consult_assign->status_id->EditAttributes() ?>>
<?php echo $app_consult_assign->status_id->SelectOptionListHtml("x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_status_id" class="app_consult_assign_status_id">
<span<?php echo $app_consult_assign->status_id->ViewAttributes() ?>>
<?php echo $app_consult_assign->status_id->ListViewValue() ?></span>
</span>
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_consult_assign->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime"<?php echo $app_consult_assign->ins_datetime->CellAttributes() ?>>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_ins_datetime" class="form-group app_consult_assign_ins_datetime">
<input type="text" data-table="app_consult_assign" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_consult_assign->ins_datetime->EditValue ?>"<?php echo $app_consult_assign->ins_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->OldValue) ?>">
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_ins_datetime" class="form-group app_consult_assign_ins_datetime">
<input type="text" data-table="app_consult_assign" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_consult_assign->ins_datetime->EditValue ?>"<?php echo $app_consult_assign->ins_datetime->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consult_assign_grid->RowCnt ?>_app_consult_assign_ins_datetime" class="app_consult_assign_ins_datetime">
<span<?php echo $app_consult_assign->ins_datetime->ViewAttributes() ?>>
<?php echo $app_consult_assign->ins_datetime->ListViewValue() ?></span>
</span>
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="fapp_consult_assigngrid$x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->FormValue) ?>">
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="fapp_consult_assigngrid$o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_consult_assign_grid->ListOptions->Render("body", "right", $app_consult_assign_grid->RowCnt);
?>
	</tr>
<?php if ($app_consult_assign->RowType == EW_ROWTYPE_ADD || $app_consult_assign->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_consult_assigngrid.UpdateOpts(<?php echo $app_consult_assign_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_consult_assign->CurrentAction <> "gridadd" || $app_consult_assign->CurrentMode == "copy")
		if (!$app_consult_assign_grid->Recordset->EOF) $app_consult_assign_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_consult_assign->CurrentMode == "add" || $app_consult_assign->CurrentMode == "copy" || $app_consult_assign->CurrentMode == "edit") {
		$app_consult_assign_grid->RowIndex = '$rowindex$';
		$app_consult_assign_grid->LoadRowValues();

		// Set row properties
		$app_consult_assign->ResetAttrs();
		$app_consult_assign->RowAttrs = array_merge($app_consult_assign->RowAttrs, array('data-rowindex'=>$app_consult_assign_grid->RowIndex, 'id'=>'r0_app_consult_assign', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_consult_assign->RowAttrs["class"], "ewTemplate");
		$app_consult_assign->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_consult_assign_grid->RenderRow();

		// Render list options
		$app_consult_assign_grid->RenderListOptions();
		$app_consult_assign_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_consult_assign->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_consult_assign_grid->ListOptions->Render("body", "left", $app_consult_assign_grid->RowIndex);
?>
	<?php if ($app_consult_assign->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_consult_assign_user_id" class="form-group app_consult_assign_user_id">
<select data-table="app_consult_assign" data-field="x_user_id" data-value-separator="<?php echo $app_consult_assign->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id"<?php echo $app_consult_assign->user_id->EditAttributes() ?>>
<?php echo $app_consult_assign->user_id->SelectOptionListHtml("x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_consult_assign_user_id" class="form-group app_consult_assign_user_id">
<span<?php echo $app_consult_assign->user_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->user_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_user_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_consult_assign->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_consult_assign->cons_id->Visible) { // cons_id ?>
		<td data-name="cons_id">
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<?php if ($app_consult_assign->cons_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span<?php echo $app_consult_assign->cons_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->cons_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id"><?php echo (strval($app_consult_assign->cons_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $app_consult_assign->cons_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($app_consult_assign->cons_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($app_consult_assign->cons_id->ReadOnly || $app_consult_assign->cons_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $app_consult_assign->cons_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo $app_consult_assign->cons_id->CurrentValue ?>"<?php echo $app_consult_assign->cons_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_consult_assign_cons_id" class="form-group app_consult_assign_cons_id">
<span<?php echo $app_consult_assign->cons_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->cons_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_cons_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_consult_assign->cons_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_consult_assign->status_id->Visible) { // status_id ?>
		<td data-name="status_id">
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_consult_assign_status_id" class="form-group app_consult_assign_status_id">
<select data-table="app_consult_assign" data-field="x_status_id" data-value-separator="<?php echo $app_consult_assign->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id"<?php echo $app_consult_assign->status_id->EditAttributes() ?>>
<?php echo $app_consult_assign->status_id->SelectOptionListHtml("x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_consult_assign_status_id" class="form-group app_consult_assign_status_id">
<span<?php echo $app_consult_assign->status_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->status_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_status_id" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_consult_assign->status_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_consult_assign->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime">
<?php if ($app_consult_assign->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_consult_assign_ins_datetime" class="form-group app_consult_assign_ins_datetime">
<input type="text" data-table="app_consult_assign" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_consult_assign->ins_datetime->EditValue ?>"<?php echo $app_consult_assign->ins_datetime->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_consult_assign_ins_datetime" class="form-group app_consult_assign_ins_datetime">
<span<?php echo $app_consult_assign->ins_datetime->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_assign->ins_datetime->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consult_assign" data-field="x_ins_datetime" name="o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_consult_assign_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_consult_assign->ins_datetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_consult_assign_grid->ListOptions->Render("body", "right", $app_consult_assign_grid->RowIndex);
?>
<script type="text/javascript">
fapp_consult_assigngrid.UpdateOpts(<?php echo $app_consult_assign_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_consult_assign->CurrentMode == "add" || $app_consult_assign->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_consult_assign_grid->FormKeyCountName ?>" id="<?php echo $app_consult_assign_grid->FormKeyCountName ?>" value="<?php echo $app_consult_assign_grid->KeyCount ?>">
<?php echo $app_consult_assign_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_consult_assign->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_consult_assign_grid->FormKeyCountName ?>" id="<?php echo $app_consult_assign_grid->FormKeyCountName ?>" value="<?php echo $app_consult_assign_grid->KeyCount ?>">
<?php echo $app_consult_assign_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_consult_assign->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_consult_assigngrid">
</div>
<?php

// Close recordset
if ($app_consult_assign_grid->Recordset)
	$app_consult_assign_grid->Recordset->Close();
?>
<?php if ($app_consult_assign_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_consult_assign_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_consult_assign_grid->TotalRecs == 0 && $app_consult_assign->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_consult_assign_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_consult_assign->Export == "") { ?>
<script type="text/javascript">
fapp_consult_assigngrid.Init();
</script>
<?php } ?>
<?php
$app_consult_assign_grid->Page_Terminate();
?>
