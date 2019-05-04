<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_test_results_grid)) $app_test_results_grid = new capp_test_results_grid();

// Page init
$app_test_results_grid->Page_Init();

// Page main
$app_test_results_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_results_grid->Page_Render();
?>
<?php if ($app_test_results->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_test_resultsgrid = new ew_Form("fapp_test_resultsgrid", "grid");
fapp_test_resultsgrid.FormKeyCountName = '<?php echo $app_test_results_grid->FormKeyCountName ?>';

// Validate form
fapp_test_resultsgrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_results->user_id->FldCaption(), $app_test_results->user_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_test_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_results->test_id->FldCaption(), $app_test_results->test_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_res_request");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_results->res_request->FldCaption(), $app_test_results->res_request->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_res_result");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_results->res_result->FldCaption(), $app_test_results->res_result->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ins_datetime");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_results->ins_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_test_resultsgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "user_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "test_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "res_request", false)) return false;
	if (ew_ValueChanged(fobj, infix, "res_result", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ins_datetime", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_test_resultsgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_resultsgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_resultsgrid.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_test_resultsgrid.Lists["x_user_id"].Data = "<?php echo $app_test_results_grid->user_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_test_resultsgrid.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_resultsgrid.Lists["x_test_id"].Data = "<?php echo $app_test_results_grid->test_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_test_results->CurrentAction == "gridadd") {
	if ($app_test_results->CurrentMode == "copy") {
		$bSelectLimit = $app_test_results_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_test_results_grid->TotalRecs = $app_test_results->ListRecordCount();
			$app_test_results_grid->Recordset = $app_test_results_grid->LoadRecordset($app_test_results_grid->StartRec-1, $app_test_results_grid->DisplayRecs);
		} else {
			if ($app_test_results_grid->Recordset = $app_test_results_grid->LoadRecordset())
				$app_test_results_grid->TotalRecs = $app_test_results_grid->Recordset->RecordCount();
		}
		$app_test_results_grid->StartRec = 1;
		$app_test_results_grid->DisplayRecs = $app_test_results_grid->TotalRecs;
	} else {
		$app_test_results->CurrentFilter = "0=1";
		$app_test_results_grid->StartRec = 1;
		$app_test_results_grid->DisplayRecs = $app_test_results->GridAddRowCount;
	}
	$app_test_results_grid->TotalRecs = $app_test_results_grid->DisplayRecs;
	$app_test_results_grid->StopRec = $app_test_results_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_test_results_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_test_results_grid->TotalRecs <= 0)
			$app_test_results_grid->TotalRecs = $app_test_results->ListRecordCount();
	} else {
		if (!$app_test_results_grid->Recordset && ($app_test_results_grid->Recordset = $app_test_results_grid->LoadRecordset()))
			$app_test_results_grid->TotalRecs = $app_test_results_grid->Recordset->RecordCount();
	}
	$app_test_results_grid->StartRec = 1;
	$app_test_results_grid->DisplayRecs = $app_test_results_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_test_results_grid->Recordset = $app_test_results_grid->LoadRecordset($app_test_results_grid->StartRec-1, $app_test_results_grid->DisplayRecs);

	// Set no record found message
	if ($app_test_results->CurrentAction == "" && $app_test_results_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_test_results_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_test_results_grid->SearchWhere == "0=101")
			$app_test_results_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_test_results_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_test_results_grid->RenderOtherOptions();
?>
<?php $app_test_results_grid->ShowPageHeader(); ?>
<?php
$app_test_results_grid->ShowMessage();
?>
<?php if ($app_test_results_grid->TotalRecs > 0 || $app_test_results->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_test_results_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_test_results">
<div id="fapp_test_resultsgrid" class="ewForm ewListForm form-inline">
<?php if ($app_test_results_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_test_results_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_test_results" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_test_resultsgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_test_results_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_test_results_grid->RenderListOptions();

// Render list options (header, left)
$app_test_results_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_test_results->user_id->Visible) { // user_id ?>
	<?php if ($app_test_results->SortUrl($app_test_results->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $app_test_results->user_id->HeaderCellClass() ?>"><div id="elh_app_test_results_user_id" class="app_test_results_user_id"><div class="ewTableHeaderCaption"><?php echo $app_test_results->user_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $app_test_results->user_id->HeaderCellClass() ?>"><div><div id="elh_app_test_results_user_id" class="app_test_results_user_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_results->user_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_results->user_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_results->user_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_results->test_id->Visible) { // test_id ?>
	<?php if ($app_test_results->SortUrl($app_test_results->test_id) == "") { ?>
		<th data-name="test_id" class="<?php echo $app_test_results->test_id->HeaderCellClass() ?>"><div id="elh_app_test_results_test_id" class="app_test_results_test_id"><div class="ewTableHeaderCaption"><?php echo $app_test_results->test_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_id" class="<?php echo $app_test_results->test_id->HeaderCellClass() ?>"><div><div id="elh_app_test_results_test_id" class="app_test_results_test_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_results->test_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_results->test_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_results->test_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_results->res_request->Visible) { // res_request ?>
	<?php if ($app_test_results->SortUrl($app_test_results->res_request) == "") { ?>
		<th data-name="res_request" class="<?php echo $app_test_results->res_request->HeaderCellClass() ?>"><div id="elh_app_test_results_res_request" class="app_test_results_res_request"><div class="ewTableHeaderCaption"><?php echo $app_test_results->res_request->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="res_request" class="<?php echo $app_test_results->res_request->HeaderCellClass() ?>"><div><div id="elh_app_test_results_res_request" class="app_test_results_res_request">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_results->res_request->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_results->res_request->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_results->res_request->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_results->res_result->Visible) { // res_result ?>
	<?php if ($app_test_results->SortUrl($app_test_results->res_result) == "") { ?>
		<th data-name="res_result" class="<?php echo $app_test_results->res_result->HeaderCellClass() ?>"><div id="elh_app_test_results_res_result" class="app_test_results_res_result"><div class="ewTableHeaderCaption"><?php echo $app_test_results->res_result->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="res_result" class="<?php echo $app_test_results->res_result->HeaderCellClass() ?>"><div><div id="elh_app_test_results_res_result" class="app_test_results_res_result">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_results->res_result->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_results->res_result->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_results->res_result->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_results->ins_datetime->Visible) { // ins_datetime ?>
	<?php if ($app_test_results->SortUrl($app_test_results->ins_datetime) == "") { ?>
		<th data-name="ins_datetime" class="<?php echo $app_test_results->ins_datetime->HeaderCellClass() ?>"><div id="elh_app_test_results_ins_datetime" class="app_test_results_ins_datetime"><div class="ewTableHeaderCaption"><?php echo $app_test_results->ins_datetime->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ins_datetime" class="<?php echo $app_test_results->ins_datetime->HeaderCellClass() ?>"><div><div id="elh_app_test_results_ins_datetime" class="app_test_results_ins_datetime">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_results->ins_datetime->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_results->ins_datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_results->ins_datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_test_results_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_test_results_grid->StartRec = 1;
$app_test_results_grid->StopRec = $app_test_results_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_test_results_grid->FormKeyCountName) && ($app_test_results->CurrentAction == "gridadd" || $app_test_results->CurrentAction == "gridedit" || $app_test_results->CurrentAction == "F")) {
		$app_test_results_grid->KeyCount = $objForm->GetValue($app_test_results_grid->FormKeyCountName);
		$app_test_results_grid->StopRec = $app_test_results_grid->StartRec + $app_test_results_grid->KeyCount - 1;
	}
}
$app_test_results_grid->RecCnt = $app_test_results_grid->StartRec - 1;
if ($app_test_results_grid->Recordset && !$app_test_results_grid->Recordset->EOF) {
	$app_test_results_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_test_results_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_test_results_grid->StartRec > 1)
		$app_test_results_grid->Recordset->Move($app_test_results_grid->StartRec - 1);
} elseif (!$app_test_results->AllowAddDeleteRow && $app_test_results_grid->StopRec == 0) {
	$app_test_results_grid->StopRec = $app_test_results->GridAddRowCount;
}

// Initialize aggregate
$app_test_results->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_test_results->ResetAttrs();
$app_test_results_grid->RenderRow();
if ($app_test_results->CurrentAction == "gridadd")
	$app_test_results_grid->RowIndex = 0;
if ($app_test_results->CurrentAction == "gridedit")
	$app_test_results_grid->RowIndex = 0;
while ($app_test_results_grid->RecCnt < $app_test_results_grid->StopRec) {
	$app_test_results_grid->RecCnt++;
	if (intval($app_test_results_grid->RecCnt) >= intval($app_test_results_grid->StartRec)) {
		$app_test_results_grid->RowCnt++;
		if ($app_test_results->CurrentAction == "gridadd" || $app_test_results->CurrentAction == "gridedit" || $app_test_results->CurrentAction == "F") {
			$app_test_results_grid->RowIndex++;
			$objForm->Index = $app_test_results_grid->RowIndex;
			if ($objForm->HasValue($app_test_results_grid->FormActionName))
				$app_test_results_grid->RowAction = strval($objForm->GetValue($app_test_results_grid->FormActionName));
			elseif ($app_test_results->CurrentAction == "gridadd")
				$app_test_results_grid->RowAction = "insert";
			else
				$app_test_results_grid->RowAction = "";
		}

		// Set up key count
		$app_test_results_grid->KeyCount = $app_test_results_grid->RowIndex;

		// Init row class and style
		$app_test_results->ResetAttrs();
		$app_test_results->CssClass = "";
		if ($app_test_results->CurrentAction == "gridadd") {
			if ($app_test_results->CurrentMode == "copy") {
				$app_test_results_grid->LoadRowValues($app_test_results_grid->Recordset); // Load row values
				$app_test_results_grid->SetRecordKey($app_test_results_grid->RowOldKey, $app_test_results_grid->Recordset); // Set old record key
			} else {
				$app_test_results_grid->LoadRowValues(); // Load default values
				$app_test_results_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_test_results_grid->LoadRowValues($app_test_results_grid->Recordset); // Load row values
		}
		$app_test_results->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_test_results->CurrentAction == "gridadd") // Grid add
			$app_test_results->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_test_results->CurrentAction == "gridadd" && $app_test_results->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_test_results_grid->RestoreCurrentRowFormValues($app_test_results_grid->RowIndex); // Restore form values
		if ($app_test_results->CurrentAction == "gridedit") { // Grid edit
			if ($app_test_results->EventCancelled) {
				$app_test_results_grid->RestoreCurrentRowFormValues($app_test_results_grid->RowIndex); // Restore form values
			}
			if ($app_test_results_grid->RowAction == "insert")
				$app_test_results->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_test_results->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_test_results->CurrentAction == "gridedit" && ($app_test_results->RowType == EW_ROWTYPE_EDIT || $app_test_results->RowType == EW_ROWTYPE_ADD) && $app_test_results->EventCancelled) // Update failed
			$app_test_results_grid->RestoreCurrentRowFormValues($app_test_results_grid->RowIndex); // Restore form values
		if ($app_test_results->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_test_results_grid->EditRowCnt++;
		if ($app_test_results->CurrentAction == "F") // Confirm row
			$app_test_results_grid->RestoreCurrentRowFormValues($app_test_results_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_test_results->RowAttrs = array_merge($app_test_results->RowAttrs, array('data-rowindex'=>$app_test_results_grid->RowCnt, 'id'=>'r' . $app_test_results_grid->RowCnt . '_app_test_results', 'data-rowtype'=>$app_test_results->RowType));

		// Render row
		$app_test_results_grid->RenderRow();

		// Render list options
		$app_test_results_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_test_results_grid->RowAction <> "delete" && $app_test_results_grid->RowAction <> "insertdelete" && !($app_test_results_grid->RowAction == "insert" && $app_test_results->CurrentAction == "F" && $app_test_results_grid->EmptyRow())) {
?>
	<tr<?php echo $app_test_results->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_results_grid->ListOptions->Render("body", "left", $app_test_results_grid->RowCnt);
?>
	<?php if ($app_test_results->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $app_test_results->user_id->CellAttributes() ?>>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_user_id" class="form-group app_test_results_user_id">
<select data-table="app_test_results" data-field="x_user_id" data-value-separator="<?php echo $app_test_results->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_user_id"<?php echo $app_test_results->user_id->EditAttributes() ?>>
<?php echo $app_test_results->user_id->SelectOptionListHtml("x<?php echo $app_test_results_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_user_id" class="form-group app_test_results_user_id">
<select data-table="app_test_results" data-field="x_user_id" data-value-separator="<?php echo $app_test_results->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_user_id"<?php echo $app_test_results->user_id->EditAttributes() ?>>
<?php echo $app_test_results->user_id->SelectOptionListHtml("x<?php echo $app_test_results_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_user_id" class="app_test_results_user_id">
<span<?php echo $app_test_results->user_id->ViewAttributes() ?>>
<?php echo $app_test_results->user_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_id" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_id" value="<?php echo ew_HtmlEncode($app_test_results->res_id->CurrentValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_res_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_id" value="<?php echo ew_HtmlEncode($app_test_results->res_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_EDIT || $app_test_results->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_id" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_id" value="<?php echo ew_HtmlEncode($app_test_results->res_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_test_results->test_id->Visible) { // test_id ?>
		<td data-name="test_id"<?php echo $app_test_results->test_id->CellAttributes() ?>>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_test_results->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_test_id" class="form-group app_test_results_test_id">
<span<?php echo $app_test_results->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_test_id" class="form-group app_test_results_test_id">
<select data-table="app_test_results" data-field="x_test_id" data-value-separator="<?php echo $app_test_results->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id"<?php echo $app_test_results->test_id->EditAttributes() ?>>
<?php echo $app_test_results->test_id->SelectOptionListHtml("x<?php echo $app_test_results_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_test_results->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_test_id" class="form-group app_test_results_test_id">
<span<?php echo $app_test_results->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_test_id" class="form-group app_test_results_test_id">
<select data-table="app_test_results" data-field="x_test_id" data-value-separator="<?php echo $app_test_results->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id"<?php echo $app_test_results->test_id->EditAttributes() ?>>
<?php echo $app_test_results->test_id->SelectOptionListHtml("x<?php echo $app_test_results_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_test_id" class="app_test_results_test_id">
<span<?php echo $app_test_results->test_id->ViewAttributes() ?>>
<?php echo $app_test_results->test_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_results->res_request->Visible) { // res_request ?>
		<td data-name="res_request"<?php echo $app_test_results->res_request->CellAttributes() ?>>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_res_request" class="form-group app_test_results_res_request">
<textarea data-table="app_test_results" data-field="x_res_request" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_results->res_request->getPlaceHolder()) ?>"<?php echo $app_test_results->res_request->EditAttributes() ?>><?php echo $app_test_results->res_request->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->OldValue) ?>">
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_res_request" class="form-group app_test_results_res_request">
<textarea data-table="app_test_results" data-field="x_res_request" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_results->res_request->getPlaceHolder()) ?>"<?php echo $app_test_results->res_request->EditAttributes() ?>><?php echo $app_test_results->res_request->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_res_request" class="app_test_results_res_request">
<span<?php echo $app_test_results->res_request->ViewAttributes() ?>>
<?php echo $app_test_results->res_request->ListViewValue() ?></span>
</span>
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_results->res_result->Visible) { // res_result ?>
		<td data-name="res_result"<?php echo $app_test_results->res_result->CellAttributes() ?>>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_res_result" class="form-group app_test_results_res_result">
<textarea data-table="app_test_results" data-field="x_res_result" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_results->res_result->getPlaceHolder()) ?>"<?php echo $app_test_results->res_result->EditAttributes() ?>><?php echo $app_test_results->res_result->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->OldValue) ?>">
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_res_result" class="form-group app_test_results_res_result">
<textarea data-table="app_test_results" data-field="x_res_result" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_results->res_result->getPlaceHolder()) ?>"<?php echo $app_test_results->res_result->EditAttributes() ?>><?php echo $app_test_results->res_result->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_res_result" class="app_test_results_res_result">
<span<?php echo $app_test_results->res_result->ViewAttributes() ?>>
<?php echo $app_test_results->res_result->ListViewValue() ?></span>
</span>
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_results->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime"<?php echo $app_test_results->ins_datetime->CellAttributes() ?>>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_ins_datetime" class="form-group app_test_results_ins_datetime">
<input type="text" data-table="app_test_results" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_test_results->ins_datetime->EditValue ?>"<?php echo $app_test_results->ins_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->OldValue) ?>">
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_ins_datetime" class="form-group app_test_results_ins_datetime">
<input type="text" data-table="app_test_results" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_test_results->ins_datetime->EditValue ?>"<?php echo $app_test_results->ins_datetime->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_results->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_results_grid->RowCnt ?>_app_test_results_ins_datetime" class="app_test_results_ins_datetime">
<span<?php echo $app_test_results->ins_datetime->ViewAttributes() ?>>
<?php echo $app_test_results->ins_datetime->ListViewValue() ?></span>
</span>
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="fapp_test_resultsgrid$x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->FormValue) ?>">
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="fapp_test_resultsgrid$o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_results_grid->ListOptions->Render("body", "right", $app_test_results_grid->RowCnt);
?>
	</tr>
<?php if ($app_test_results->RowType == EW_ROWTYPE_ADD || $app_test_results->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_test_resultsgrid.UpdateOpts(<?php echo $app_test_results_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_test_results->CurrentAction <> "gridadd" || $app_test_results->CurrentMode == "copy")
		if (!$app_test_results_grid->Recordset->EOF) $app_test_results_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_test_results->CurrentMode == "add" || $app_test_results->CurrentMode == "copy" || $app_test_results->CurrentMode == "edit") {
		$app_test_results_grid->RowIndex = '$rowindex$';
		$app_test_results_grid->LoadRowValues();

		// Set row properties
		$app_test_results->ResetAttrs();
		$app_test_results->RowAttrs = array_merge($app_test_results->RowAttrs, array('data-rowindex'=>$app_test_results_grid->RowIndex, 'id'=>'r0_app_test_results', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_test_results->RowAttrs["class"], "ewTemplate");
		$app_test_results->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_test_results_grid->RenderRow();

		// Render list options
		$app_test_results_grid->RenderListOptions();
		$app_test_results_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_test_results->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_results_grid->ListOptions->Render("body", "left", $app_test_results_grid->RowIndex);
?>
	<?php if ($app_test_results->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_results_user_id" class="form-group app_test_results_user_id">
<select data-table="app_test_results" data-field="x_user_id" data-value-separator="<?php echo $app_test_results->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_user_id"<?php echo $app_test_results->user_id->EditAttributes() ?>>
<?php echo $app_test_results->user_id->SelectOptionListHtml("x<?php echo $app_test_results_grid->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_results_user_id" class="form-group app_test_results_user_id">
<span<?php echo $app_test_results->user_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->user_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="x<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_results" data-field="x_user_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_user_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_test_results->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_results->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<?php if ($app_test_results->test_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_test_results_test_id" class="form-group app_test_results_test_id">
<span<?php echo $app_test_results->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_test_results_test_id" class="form-group app_test_results_test_id">
<select data-table="app_test_results" data-field="x_test_id" data-value-separator="<?php echo $app_test_results->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id"<?php echo $app_test_results->test_id->EditAttributes() ?>>
<?php echo $app_test_results->test_id->SelectOptionListHtml("x<?php echo $app_test_results_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_test_results_test_id" class="form-group app_test_results_test_id">
<span<?php echo $app_test_results->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_results" data-field="x_test_id" name="o<?php echo $app_test_results_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_results_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_results->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_results->res_request->Visible) { // res_request ?>
		<td data-name="res_request">
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_results_res_request" class="form-group app_test_results_res_request">
<textarea data-table="app_test_results" data-field="x_res_request" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_results->res_request->getPlaceHolder()) ?>"<?php echo $app_test_results->res_request->EditAttributes() ?>><?php echo $app_test_results->res_request->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_results_res_request" class="form-group app_test_results_res_request">
<span<?php echo $app_test_results->res_request->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->res_request->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_request" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_request" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_request" value="<?php echo ew_HtmlEncode($app_test_results->res_request->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_results->res_result->Visible) { // res_result ?>
		<td data-name="res_result">
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_results_res_result" class="form-group app_test_results_res_result">
<textarea data-table="app_test_results" data-field="x_res_result" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_results->res_result->getPlaceHolder()) ?>"<?php echo $app_test_results->res_result->EditAttributes() ?>><?php echo $app_test_results->res_result->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_results_res_result" class="form-group app_test_results_res_result">
<span<?php echo $app_test_results->res_result->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->res_result->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="x<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_results" data-field="x_res_result" name="o<?php echo $app_test_results_grid->RowIndex ?>_res_result" id="o<?php echo $app_test_results_grid->RowIndex ?>_res_result" value="<?php echo ew_HtmlEncode($app_test_results->res_result->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_results->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime">
<?php if ($app_test_results->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_results_ins_datetime" class="form-group app_test_results_ins_datetime">
<input type="text" data-table="app_test_results" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_test_results->ins_datetime->EditValue ?>"<?php echo $app_test_results->ins_datetime->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_results_ins_datetime" class="form-group app_test_results_ins_datetime">
<span<?php echo $app_test_results->ins_datetime->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_results->ins_datetime->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_results" data-field="x_ins_datetime" name="o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_test_results_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_test_results->ins_datetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_results_grid->ListOptions->Render("body", "right", $app_test_results_grid->RowIndex);
?>
<script type="text/javascript">
fapp_test_resultsgrid.UpdateOpts(<?php echo $app_test_results_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_test_results->CurrentMode == "add" || $app_test_results->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_test_results_grid->FormKeyCountName ?>" id="<?php echo $app_test_results_grid->FormKeyCountName ?>" value="<?php echo $app_test_results_grid->KeyCount ?>">
<?php echo $app_test_results_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_results->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_test_results_grid->FormKeyCountName ?>" id="<?php echo $app_test_results_grid->FormKeyCountName ?>" value="<?php echo $app_test_results_grid->KeyCount ?>">
<?php echo $app_test_results_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_results->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_test_resultsgrid">
</div>
<?php

// Close recordset
if ($app_test_results_grid->Recordset)
	$app_test_results_grid->Recordset->Close();
?>
<?php if ($app_test_results_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_test_results_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_test_results_grid->TotalRecs == 0 && $app_test_results->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_results_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_test_results->Export == "") { ?>
<script type="text/javascript">
fapp_test_resultsgrid.Init();
</script>
<?php } ?>
<?php
$app_test_results_grid->Page_Terminate();
?>
