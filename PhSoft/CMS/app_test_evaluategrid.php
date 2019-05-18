<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_test_evaluate_grid)) $app_test_evaluate_grid = new capp_test_evaluate_grid();

// Page init
$app_test_evaluate_grid->Page_Init();

// Page main
$app_test_evaluate_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_evaluate_grid->Page_Render();
?>
<?php if ($app_test_evaluate->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_test_evaluategrid = new ew_Form("fapp_test_evaluategrid", "grid");
fapp_test_evaluategrid.FormKeyCountName = '<?php echo $app_test_evaluate_grid->FormKeyCountName ?>';

// Validate form
fapp_test_evaluategrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_test_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->test_id->FldCaption(), $app_test_evaluate->test_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->lang_id->FldCaption(), $app_test_evaluate->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_gend_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->gend_id->FldCaption(), $app_test_evaluate->gend_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_eval_from");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->eval_from->FldCaption(), $app_test_evaluate->eval_from->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_eval_from");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_evaluate->eval_from->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_eval_to");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->eval_to->FldCaption(), $app_test_evaluate->eval_to->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_eval_to");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_evaluate->eval_to->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_eval_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->eval_text->FldCaption(), $app_test_evaluate->eval_text->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_test_evaluategrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "test_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "gend_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "eval_from", false)) return false;
	if (ew_ValueChanged(fobj, infix, "eval_to", false)) return false;
	if (ew_ValueChanged(fobj, infix, "eval_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_test_evaluategrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_evaluategrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_evaluategrid.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_evaluategrid.Lists["x_test_id"].Data = "<?php echo $app_test_evaluate_grid->test_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_test_evaluategrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_evaluategrid.Lists["x_lang_id"].Data = "<?php echo $app_test_evaluate_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_test_evaluategrid.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_test_evaluategrid.Lists["x_gend_id"].Data = "<?php echo $app_test_evaluate_grid->gend_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_test_evaluate->CurrentAction == "gridadd") {
	if ($app_test_evaluate->CurrentMode == "copy") {
		$bSelectLimit = $app_test_evaluate_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_test_evaluate_grid->TotalRecs = $app_test_evaluate->ListRecordCount();
			$app_test_evaluate_grid->Recordset = $app_test_evaluate_grid->LoadRecordset($app_test_evaluate_grid->StartRec-1, $app_test_evaluate_grid->DisplayRecs);
		} else {
			if ($app_test_evaluate_grid->Recordset = $app_test_evaluate_grid->LoadRecordset())
				$app_test_evaluate_grid->TotalRecs = $app_test_evaluate_grid->Recordset->RecordCount();
		}
		$app_test_evaluate_grid->StartRec = 1;
		$app_test_evaluate_grid->DisplayRecs = $app_test_evaluate_grid->TotalRecs;
	} else {
		$app_test_evaluate->CurrentFilter = "0=1";
		$app_test_evaluate_grid->StartRec = 1;
		$app_test_evaluate_grid->DisplayRecs = $app_test_evaluate->GridAddRowCount;
	}
	$app_test_evaluate_grid->TotalRecs = $app_test_evaluate_grid->DisplayRecs;
	$app_test_evaluate_grid->StopRec = $app_test_evaluate_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_test_evaluate_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_test_evaluate_grid->TotalRecs <= 0)
			$app_test_evaluate_grid->TotalRecs = $app_test_evaluate->ListRecordCount();
	} else {
		if (!$app_test_evaluate_grid->Recordset && ($app_test_evaluate_grid->Recordset = $app_test_evaluate_grid->LoadRecordset()))
			$app_test_evaluate_grid->TotalRecs = $app_test_evaluate_grid->Recordset->RecordCount();
	}
	$app_test_evaluate_grid->StartRec = 1;
	$app_test_evaluate_grid->DisplayRecs = $app_test_evaluate_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_test_evaluate_grid->Recordset = $app_test_evaluate_grid->LoadRecordset($app_test_evaluate_grid->StartRec-1, $app_test_evaluate_grid->DisplayRecs);

	// Set no record found message
	if ($app_test_evaluate->CurrentAction == "" && $app_test_evaluate_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_test_evaluate_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_test_evaluate_grid->SearchWhere == "0=101")
			$app_test_evaluate_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_test_evaluate_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_test_evaluate_grid->RenderOtherOptions();
?>
<?php $app_test_evaluate_grid->ShowPageHeader(); ?>
<?php
$app_test_evaluate_grid->ShowMessage();
?>
<?php if ($app_test_evaluate_grid->TotalRecs > 0 || $app_test_evaluate->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_test_evaluate_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_test_evaluate">
<div id="fapp_test_evaluategrid" class="ewForm ewListForm form-inline">
<?php if ($app_test_evaluate_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_test_evaluate_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_test_evaluate" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_test_evaluategrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_test_evaluate_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_test_evaluate_grid->RenderListOptions();

// Render list options (header, left)
$app_test_evaluate_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->test_id) == "") { ?>
		<th data-name="test_id" class="<?php echo $app_test_evaluate->test_id->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_test_id" class="app_test_evaluate_test_id"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->test_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_id" class="<?php echo $app_test_evaluate->test_id->HeaderCellClass() ?>"><div><div id="elh_app_test_evaluate_test_id" class="app_test_evaluate_test_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->test_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->test_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->test_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_test_evaluate->lang_id->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_lang_id" class="app_test_evaluate_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_test_evaluate->lang_id->HeaderCellClass() ?>"><div><div id="elh_app_test_evaluate_lang_id" class="app_test_evaluate_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->gend_id) == "") { ?>
		<th data-name="gend_id" class="<?php echo $app_test_evaluate->gend_id->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_gend_id" class="app_test_evaluate_gend_id"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->gend_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gend_id" class="<?php echo $app_test_evaluate->gend_id->HeaderCellClass() ?>"><div><div id="elh_app_test_evaluate_gend_id" class="app_test_evaluate_gend_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->gend_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->gend_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->gend_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->eval_from) == "") { ?>
		<th data-name="eval_from" class="<?php echo $app_test_evaluate->eval_from->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_eval_from" class="app_test_evaluate_eval_from"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_from->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_from" class="<?php echo $app_test_evaluate->eval_from->HeaderCellClass() ?>"><div><div id="elh_app_test_evaluate_eval_from" class="app_test_evaluate_eval_from">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_from->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->eval_from->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->eval_from->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->eval_to) == "") { ?>
		<th data-name="eval_to" class="<?php echo $app_test_evaluate->eval_to->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_eval_to" class="app_test_evaluate_eval_to"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_to->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_to" class="<?php echo $app_test_evaluate->eval_to->HeaderCellClass() ?>"><div><div id="elh_app_test_evaluate_eval_to" class="app_test_evaluate_eval_to">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_to->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->eval_to->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->eval_to->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->eval_text) == "") { ?>
		<th data-name="eval_text" class="<?php echo $app_test_evaluate->eval_text->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_eval_text" class="app_test_evaluate_eval_text"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_text" class="<?php echo $app_test_evaluate->eval_text->HeaderCellClass() ?>"><div><div id="elh_app_test_evaluate_eval_text" class="app_test_evaluate_eval_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->eval_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->eval_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_test_evaluate_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_test_evaluate_grid->StartRec = 1;
$app_test_evaluate_grid->StopRec = $app_test_evaluate_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_test_evaluate_grid->FormKeyCountName) && ($app_test_evaluate->CurrentAction == "gridadd" || $app_test_evaluate->CurrentAction == "gridedit" || $app_test_evaluate->CurrentAction == "F")) {
		$app_test_evaluate_grid->KeyCount = $objForm->GetValue($app_test_evaluate_grid->FormKeyCountName);
		$app_test_evaluate_grid->StopRec = $app_test_evaluate_grid->StartRec + $app_test_evaluate_grid->KeyCount - 1;
	}
}
$app_test_evaluate_grid->RecCnt = $app_test_evaluate_grid->StartRec - 1;
if ($app_test_evaluate_grid->Recordset && !$app_test_evaluate_grid->Recordset->EOF) {
	$app_test_evaluate_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_test_evaluate_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_test_evaluate_grid->StartRec > 1)
		$app_test_evaluate_grid->Recordset->Move($app_test_evaluate_grid->StartRec - 1);
} elseif (!$app_test_evaluate->AllowAddDeleteRow && $app_test_evaluate_grid->StopRec == 0) {
	$app_test_evaluate_grid->StopRec = $app_test_evaluate->GridAddRowCount;
}

// Initialize aggregate
$app_test_evaluate->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_test_evaluate->ResetAttrs();
$app_test_evaluate_grid->RenderRow();
if ($app_test_evaluate->CurrentAction == "gridadd")
	$app_test_evaluate_grid->RowIndex = 0;
if ($app_test_evaluate->CurrentAction == "gridedit")
	$app_test_evaluate_grid->RowIndex = 0;
while ($app_test_evaluate_grid->RecCnt < $app_test_evaluate_grid->StopRec) {
	$app_test_evaluate_grid->RecCnt++;
	if (intval($app_test_evaluate_grid->RecCnt) >= intval($app_test_evaluate_grid->StartRec)) {
		$app_test_evaluate_grid->RowCnt++;
		if ($app_test_evaluate->CurrentAction == "gridadd" || $app_test_evaluate->CurrentAction == "gridedit" || $app_test_evaluate->CurrentAction == "F") {
			$app_test_evaluate_grid->RowIndex++;
			$objForm->Index = $app_test_evaluate_grid->RowIndex;
			if ($objForm->HasValue($app_test_evaluate_grid->FormActionName))
				$app_test_evaluate_grid->RowAction = strval($objForm->GetValue($app_test_evaluate_grid->FormActionName));
			elseif ($app_test_evaluate->CurrentAction == "gridadd")
				$app_test_evaluate_grid->RowAction = "insert";
			else
				$app_test_evaluate_grid->RowAction = "";
		}

		// Set up key count
		$app_test_evaluate_grid->KeyCount = $app_test_evaluate_grid->RowIndex;

		// Init row class and style
		$app_test_evaluate->ResetAttrs();
		$app_test_evaluate->CssClass = "";
		if ($app_test_evaluate->CurrentAction == "gridadd") {
			if ($app_test_evaluate->CurrentMode == "copy") {
				$app_test_evaluate_grid->LoadRowValues($app_test_evaluate_grid->Recordset); // Load row values
				$app_test_evaluate_grid->SetRecordKey($app_test_evaluate_grid->RowOldKey, $app_test_evaluate_grid->Recordset); // Set old record key
			} else {
				$app_test_evaluate_grid->LoadRowValues(); // Load default values
				$app_test_evaluate_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_test_evaluate_grid->LoadRowValues($app_test_evaluate_grid->Recordset); // Load row values
		}
		$app_test_evaluate->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_test_evaluate->CurrentAction == "gridadd") // Grid add
			$app_test_evaluate->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_test_evaluate->CurrentAction == "gridadd" && $app_test_evaluate->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_test_evaluate_grid->RestoreCurrentRowFormValues($app_test_evaluate_grid->RowIndex); // Restore form values
		if ($app_test_evaluate->CurrentAction == "gridedit") { // Grid edit
			if ($app_test_evaluate->EventCancelled) {
				$app_test_evaluate_grid->RestoreCurrentRowFormValues($app_test_evaluate_grid->RowIndex); // Restore form values
			}
			if ($app_test_evaluate_grid->RowAction == "insert")
				$app_test_evaluate->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_test_evaluate->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_test_evaluate->CurrentAction == "gridedit" && ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT || $app_test_evaluate->RowType == EW_ROWTYPE_ADD) && $app_test_evaluate->EventCancelled) // Update failed
			$app_test_evaluate_grid->RestoreCurrentRowFormValues($app_test_evaluate_grid->RowIndex); // Restore form values
		if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_test_evaluate_grid->EditRowCnt++;
		if ($app_test_evaluate->CurrentAction == "F") // Confirm row
			$app_test_evaluate_grid->RestoreCurrentRowFormValues($app_test_evaluate_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_test_evaluate->RowAttrs = array_merge($app_test_evaluate->RowAttrs, array('data-rowindex'=>$app_test_evaluate_grid->RowCnt, 'id'=>'r' . $app_test_evaluate_grid->RowCnt . '_app_test_evaluate', 'data-rowtype'=>$app_test_evaluate->RowType));

		// Render row
		$app_test_evaluate_grid->RenderRow();

		// Render list options
		$app_test_evaluate_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_test_evaluate_grid->RowAction <> "delete" && $app_test_evaluate_grid->RowAction <> "insertdelete" && !($app_test_evaluate_grid->RowAction == "insert" && $app_test_evaluate->CurrentAction == "F" && $app_test_evaluate_grid->EmptyRow())) {
?>
	<tr<?php echo $app_test_evaluate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_evaluate_grid->ListOptions->Render("body", "left", $app_test_evaluate_grid->RowCnt);
?>
	<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
		<td data-name="test_id"<?php echo $app_test_evaluate->test_id->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_test_id" class="app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<?php echo $app_test_evaluate->test_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_id->CurrentValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT || $app_test_evaluate->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_test_evaluate->lang_id->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_lang_id" class="app_test_evaluate_lang_id">
<span<?php echo $app_test_evaluate->lang_id->ViewAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id"<?php echo $app_test_evaluate->gend_id->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_gend_id" class="app_test_evaluate_gend_id">
<span<?php echo $app_test_evaluate->gend_id->ViewAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
		<td data-name="eval_from"<?php echo $app_test_evaluate->eval_from->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_from" class="app_test_evaluate_eval_from">
<span<?php echo $app_test_evaluate->eval_from->ViewAttributes() ?>>
<?php echo $app_test_evaluate->eval_from->ListViewValue() ?></span>
</span>
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
		<td data-name="eval_to"<?php echo $app_test_evaluate->eval_to->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_to" class="app_test_evaluate_eval_to">
<span<?php echo $app_test_evaluate->eval_to->ViewAttributes() ?>>
<?php echo $app_test_evaluate->eval_to->ListViewValue() ?></span>
</span>
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
		<td data-name="eval_text"<?php echo $app_test_evaluate->eval_text->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluategrid", "x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluategrid", "x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_grid->RowCnt ?>_app_test_evaluate_eval_text" class="app_test_evaluate_eval_text">
<span<?php echo $app_test_evaluate->eval_text->ViewAttributes() ?>>
<?php echo $app_test_evaluate->eval_text->ListViewValue() ?></span>
</span>
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="fapp_test_evaluategrid$x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->FormValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="fapp_test_evaluategrid$o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_evaluate_grid->ListOptions->Render("body", "right", $app_test_evaluate_grid->RowCnt);
?>
	</tr>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD || $app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_test_evaluategrid.UpdateOpts(<?php echo $app_test_evaluate_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_test_evaluate->CurrentAction <> "gridadd" || $app_test_evaluate->CurrentMode == "copy")
		if (!$app_test_evaluate_grid->Recordset->EOF) $app_test_evaluate_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_test_evaluate->CurrentMode == "add" || $app_test_evaluate->CurrentMode == "copy" || $app_test_evaluate->CurrentMode == "edit") {
		$app_test_evaluate_grid->RowIndex = '$rowindex$';
		$app_test_evaluate_grid->LoadRowValues();

		// Set row properties
		$app_test_evaluate->ResetAttrs();
		$app_test_evaluate->RowAttrs = array_merge($app_test_evaluate->RowAttrs, array('data-rowindex'=>$app_test_evaluate_grid->RowIndex, 'id'=>'r0_app_test_evaluate', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_test_evaluate->RowAttrs["class"], "ewTemplate");
		$app_test_evaluate->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_test_evaluate_grid->RenderRow();

		// Render list options
		$app_test_evaluate_grid->RenderListOptions();
		$app_test_evaluate_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_test_evaluate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_evaluate_grid->ListOptions->Render("body", "left", $app_test_evaluate_grid->RowIndex);
?>
	<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<span<?php echo $app_test_evaluate->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id">
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<span<?php echo $app_test_evaluate->gend_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->gend_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
		<td data-name="eval_from">
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<span<?php echo $app_test_evaluate->eval_from->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->eval_from->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
		<td data-name="eval_to">
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<span<?php echo $app_test_evaluate->eval_to->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->eval_to->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
		<td data-name="eval_text">
<?php if ($app_test_evaluate->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluategrid", "x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<span<?php echo $app_test_evaluate->eval_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->eval_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" id="o<?php echo $app_test_evaluate_grid->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_evaluate_grid->ListOptions->Render("body", "right", $app_test_evaluate_grid->RowIndex);
?>
<script type="text/javascript">
fapp_test_evaluategrid.UpdateOpts(<?php echo $app_test_evaluate_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_test_evaluate->CurrentMode == "add" || $app_test_evaluate->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_test_evaluate_grid->FormKeyCountName ?>" id="<?php echo $app_test_evaluate_grid->FormKeyCountName ?>" value="<?php echo $app_test_evaluate_grid->KeyCount ?>">
<?php echo $app_test_evaluate_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_evaluate->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_test_evaluate_grid->FormKeyCountName ?>" id="<?php echo $app_test_evaluate_grid->FormKeyCountName ?>" value="<?php echo $app_test_evaluate_grid->KeyCount ?>">
<?php echo $app_test_evaluate_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_evaluate->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_test_evaluategrid">
</div>
<?php

// Close recordset
if ($app_test_evaluate_grid->Recordset)
	$app_test_evaluate_grid->Recordset->Close();
?>
<?php if ($app_test_evaluate_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_test_evaluate_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_test_evaluate_grid->TotalRecs == 0 && $app_test_evaluate->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_evaluate_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_test_evaluate->Export == "") { ?>
<script type="text/javascript">
fapp_test_evaluategrid.Init();
</script>
<?php } ?>
<?php
$app_test_evaluate_grid->Page_Terminate();
?>
