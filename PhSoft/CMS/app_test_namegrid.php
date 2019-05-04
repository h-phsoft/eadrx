<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_test_name_grid)) $app_test_name_grid = new capp_test_name_grid();

// Page init
$app_test_name_grid->Page_Init();

// Page main
$app_test_name_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_name_grid->Page_Render();
?>
<?php if ($app_test_name->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_test_namegrid = new ew_Form("fapp_test_namegrid", "grid");
fapp_test_namegrid.FormKeyCountName = '<?php echo $app_test_name_grid->FormKeyCountName ?>';

// Validate form
fapp_test_namegrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_name->test_id->FldCaption(), $app_test_name->test_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_name->lang_id->FldCaption(), $app_test_name->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_test_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_name->test_name->FldCaption(), $app_test_name->test_name->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_test_namegrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "test_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "test_name", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_test_namegrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_namegrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_namegrid.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_namegrid.Lists["x_test_id"].Data = "<?php echo $app_test_name_grid->test_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_test_namegrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_namegrid.Lists["x_lang_id"].Data = "<?php echo $app_test_name_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_test_name->CurrentAction == "gridadd") {
	if ($app_test_name->CurrentMode == "copy") {
		$bSelectLimit = $app_test_name_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_test_name_grid->TotalRecs = $app_test_name->ListRecordCount();
			$app_test_name_grid->Recordset = $app_test_name_grid->LoadRecordset($app_test_name_grid->StartRec-1, $app_test_name_grid->DisplayRecs);
		} else {
			if ($app_test_name_grid->Recordset = $app_test_name_grid->LoadRecordset())
				$app_test_name_grid->TotalRecs = $app_test_name_grid->Recordset->RecordCount();
		}
		$app_test_name_grid->StartRec = 1;
		$app_test_name_grid->DisplayRecs = $app_test_name_grid->TotalRecs;
	} else {
		$app_test_name->CurrentFilter = "0=1";
		$app_test_name_grid->StartRec = 1;
		$app_test_name_grid->DisplayRecs = $app_test_name->GridAddRowCount;
	}
	$app_test_name_grid->TotalRecs = $app_test_name_grid->DisplayRecs;
	$app_test_name_grid->StopRec = $app_test_name_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_test_name_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_test_name_grid->TotalRecs <= 0)
			$app_test_name_grid->TotalRecs = $app_test_name->ListRecordCount();
	} else {
		if (!$app_test_name_grid->Recordset && ($app_test_name_grid->Recordset = $app_test_name_grid->LoadRecordset()))
			$app_test_name_grid->TotalRecs = $app_test_name_grid->Recordset->RecordCount();
	}
	$app_test_name_grid->StartRec = 1;
	$app_test_name_grid->DisplayRecs = $app_test_name_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_test_name_grid->Recordset = $app_test_name_grid->LoadRecordset($app_test_name_grid->StartRec-1, $app_test_name_grid->DisplayRecs);

	// Set no record found message
	if ($app_test_name->CurrentAction == "" && $app_test_name_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_test_name_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_test_name_grid->SearchWhere == "0=101")
			$app_test_name_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_test_name_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_test_name_grid->RenderOtherOptions();
?>
<?php $app_test_name_grid->ShowPageHeader(); ?>
<?php
$app_test_name_grid->ShowMessage();
?>
<?php if ($app_test_name_grid->TotalRecs > 0 || $app_test_name->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_test_name_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_test_name">
<div id="fapp_test_namegrid" class="ewForm ewListForm form-inline">
<?php if ($app_test_name_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_test_name_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_test_name" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_test_namegrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_test_name_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_test_name_grid->RenderListOptions();

// Render list options (header, left)
$app_test_name_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_test_name->test_id->Visible) { // test_id ?>
	<?php if ($app_test_name->SortUrl($app_test_name->test_id) == "") { ?>
		<th data-name="test_id" class="<?php echo $app_test_name->test_id->HeaderCellClass() ?>"><div id="elh_app_test_name_test_id" class="app_test_name_test_id"><div class="ewTableHeaderCaption"><?php echo $app_test_name->test_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_id" class="<?php echo $app_test_name->test_id->HeaderCellClass() ?>"><div><div id="elh_app_test_name_test_id" class="app_test_name_test_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_name->test_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_name->test_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_name->test_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_name->lang_id->Visible) { // lang_id ?>
	<?php if ($app_test_name->SortUrl($app_test_name->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_test_name->lang_id->HeaderCellClass() ?>"><div id="elh_app_test_name_lang_id" class="app_test_name_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_test_name->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_test_name->lang_id->HeaderCellClass() ?>"><div><div id="elh_app_test_name_lang_id" class="app_test_name_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_name->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_name->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_name->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_name->test_name->Visible) { // test_name ?>
	<?php if ($app_test_name->SortUrl($app_test_name->test_name) == "") { ?>
		<th data-name="test_name" class="<?php echo $app_test_name->test_name->HeaderCellClass() ?>"><div id="elh_app_test_name_test_name" class="app_test_name_test_name"><div class="ewTableHeaderCaption"><?php echo $app_test_name->test_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_name" class="<?php echo $app_test_name->test_name->HeaderCellClass() ?>"><div><div id="elh_app_test_name_test_name" class="app_test_name_test_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_name->test_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_name->test_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_name->test_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_test_name_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_test_name_grid->StartRec = 1;
$app_test_name_grid->StopRec = $app_test_name_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_test_name_grid->FormKeyCountName) && ($app_test_name->CurrentAction == "gridadd" || $app_test_name->CurrentAction == "gridedit" || $app_test_name->CurrentAction == "F")) {
		$app_test_name_grid->KeyCount = $objForm->GetValue($app_test_name_grid->FormKeyCountName);
		$app_test_name_grid->StopRec = $app_test_name_grid->StartRec + $app_test_name_grid->KeyCount - 1;
	}
}
$app_test_name_grid->RecCnt = $app_test_name_grid->StartRec - 1;
if ($app_test_name_grid->Recordset && !$app_test_name_grid->Recordset->EOF) {
	$app_test_name_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_test_name_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_test_name_grid->StartRec > 1)
		$app_test_name_grid->Recordset->Move($app_test_name_grid->StartRec - 1);
} elseif (!$app_test_name->AllowAddDeleteRow && $app_test_name_grid->StopRec == 0) {
	$app_test_name_grid->StopRec = $app_test_name->GridAddRowCount;
}

// Initialize aggregate
$app_test_name->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_test_name->ResetAttrs();
$app_test_name_grid->RenderRow();
if ($app_test_name->CurrentAction == "gridadd")
	$app_test_name_grid->RowIndex = 0;
if ($app_test_name->CurrentAction == "gridedit")
	$app_test_name_grid->RowIndex = 0;
while ($app_test_name_grid->RecCnt < $app_test_name_grid->StopRec) {
	$app_test_name_grid->RecCnt++;
	if (intval($app_test_name_grid->RecCnt) >= intval($app_test_name_grid->StartRec)) {
		$app_test_name_grid->RowCnt++;
		if ($app_test_name->CurrentAction == "gridadd" || $app_test_name->CurrentAction == "gridedit" || $app_test_name->CurrentAction == "F") {
			$app_test_name_grid->RowIndex++;
			$objForm->Index = $app_test_name_grid->RowIndex;
			if ($objForm->HasValue($app_test_name_grid->FormActionName))
				$app_test_name_grid->RowAction = strval($objForm->GetValue($app_test_name_grid->FormActionName));
			elseif ($app_test_name->CurrentAction == "gridadd")
				$app_test_name_grid->RowAction = "insert";
			else
				$app_test_name_grid->RowAction = "";
		}

		// Set up key count
		$app_test_name_grid->KeyCount = $app_test_name_grid->RowIndex;

		// Init row class and style
		$app_test_name->ResetAttrs();
		$app_test_name->CssClass = "";
		if ($app_test_name->CurrentAction == "gridadd") {
			if ($app_test_name->CurrentMode == "copy") {
				$app_test_name_grid->LoadRowValues($app_test_name_grid->Recordset); // Load row values
				$app_test_name_grid->SetRecordKey($app_test_name_grid->RowOldKey, $app_test_name_grid->Recordset); // Set old record key
			} else {
				$app_test_name_grid->LoadRowValues(); // Load default values
				$app_test_name_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_test_name_grid->LoadRowValues($app_test_name_grid->Recordset); // Load row values
		}
		$app_test_name->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_test_name->CurrentAction == "gridadd") // Grid add
			$app_test_name->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_test_name->CurrentAction == "gridadd" && $app_test_name->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_test_name_grid->RestoreCurrentRowFormValues($app_test_name_grid->RowIndex); // Restore form values
		if ($app_test_name->CurrentAction == "gridedit") { // Grid edit
			if ($app_test_name->EventCancelled) {
				$app_test_name_grid->RestoreCurrentRowFormValues($app_test_name_grid->RowIndex); // Restore form values
			}
			if ($app_test_name_grid->RowAction == "insert")
				$app_test_name->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_test_name->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_test_name->CurrentAction == "gridedit" && ($app_test_name->RowType == EW_ROWTYPE_EDIT || $app_test_name->RowType == EW_ROWTYPE_ADD) && $app_test_name->EventCancelled) // Update failed
			$app_test_name_grid->RestoreCurrentRowFormValues($app_test_name_grid->RowIndex); // Restore form values
		if ($app_test_name->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_test_name_grid->EditRowCnt++;
		if ($app_test_name->CurrentAction == "F") // Confirm row
			$app_test_name_grid->RestoreCurrentRowFormValues($app_test_name_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_test_name->RowAttrs = array_merge($app_test_name->RowAttrs, array('data-rowindex'=>$app_test_name_grid->RowCnt, 'id'=>'r' . $app_test_name_grid->RowCnt . '_app_test_name', 'data-rowtype'=>$app_test_name->RowType));

		// Render row
		$app_test_name_grid->RenderRow();

		// Render list options
		$app_test_name_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_test_name_grid->RowAction <> "delete" && $app_test_name_grid->RowAction <> "insertdelete" && !($app_test_name_grid->RowAction == "insert" && $app_test_name->CurrentAction == "F" && $app_test_name_grid->EmptyRow())) {
?>
	<tr<?php echo $app_test_name->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_name_grid->ListOptions->Render("body", "left", $app_test_name_grid->RowCnt);
?>
	<?php if ($app_test_name->test_id->Visible) { // test_id ?>
		<td data-name="test_id"<?php echo $app_test_name->test_id->CellAttributes() ?>>
<?php if ($app_test_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_test_name->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_id" class="form-group app_test_name_test_id">
<span<?php echo $app_test_name->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_name->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_id" class="form-group app_test_name_test_id">
<select data-table="app_test_name" data-field="x_test_id" data-value-separator="<?php echo $app_test_name->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id"<?php echo $app_test_name->test_id->EditAttributes() ?>>
<?php echo $app_test_name->test_id->SelectOptionListHtml("x<?php echo $app_test_name_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_test_name->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_id" class="form-group app_test_name_test_id">
<span<?php echo $app_test_name->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_name->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_id" class="form-group app_test_name_test_id">
<select data-table="app_test_name" data-field="x_test_id" data-value-separator="<?php echo $app_test_name->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id"<?php echo $app_test_name->test_id->EditAttributes() ?>>
<?php echo $app_test_name->test_id->SelectOptionListHtml("x<?php echo $app_test_name_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_id" class="app_test_name_test_id">
<span<?php echo $app_test_name->test_id->ViewAttributes() ?>>
<?php echo $app_test_name->test_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="fapp_test_namegrid$x<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="fapp_test_namegrid$x<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="fapp_test_namegrid$o<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="fapp_test_namegrid$o<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_test_name" data-field="x_ntest_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_ntest_id" id="x<?php echo $app_test_name_grid->RowIndex ?>_ntest_id" value="<?php echo ew_HtmlEncode($app_test_name->ntest_id->CurrentValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_ntest_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_ntest_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_ntest_id" value="<?php echo ew_HtmlEncode($app_test_name->ntest_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_EDIT || $app_test_name->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_test_name" data-field="x_ntest_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_ntest_id" id="x<?php echo $app_test_name_grid->RowIndex ?>_ntest_id" value="<?php echo ew_HtmlEncode($app_test_name->ntest_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_test_name->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_test_name->lang_id->CellAttributes() ?>>
<?php if ($app_test_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_lang_id" class="form-group app_test_name_lang_id">
<select data-table="app_test_name" data-field="x_lang_id" data-value-separator="<?php echo $app_test_name->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id"<?php echo $app_test_name->lang_id->EditAttributes() ?>>
<?php echo $app_test_name->lang_id->SelectOptionListHtml("x<?php echo $app_test_name_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_lang_id" class="form-group app_test_name_lang_id">
<select data-table="app_test_name" data-field="x_lang_id" data-value-separator="<?php echo $app_test_name->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id"<?php echo $app_test_name->lang_id->EditAttributes() ?>>
<?php echo $app_test_name->lang_id->SelectOptionListHtml("x<?php echo $app_test_name_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_lang_id" class="app_test_name_lang_id">
<span<?php echo $app_test_name->lang_id->ViewAttributes() ?>>
<?php echo $app_test_name->lang_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="fapp_test_namegrid$x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="fapp_test_namegrid$x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="fapp_test_namegrid$o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="fapp_test_namegrid$o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_name->test_name->Visible) { // test_name ?>
		<td data-name="test_name"<?php echo $app_test_name->test_name->CellAttributes() ?>>
<?php if ($app_test_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_name" class="form-group app_test_name_test_name">
<input type="text" data-table="app_test_name" data-field="x_test_name" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_test_name->test_name->getPlaceHolder()) ?>" value="<?php echo $app_test_name->test_name->EditValue ?>"<?php echo $app_test_name->test_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="o<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="o<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->OldValue) ?>">
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_name" class="form-group app_test_name_test_name">
<input type="text" data-table="app_test_name" data-field="x_test_name" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_test_name->test_name->getPlaceHolder()) ?>" value="<?php echo $app_test_name->test_name->EditValue ?>"<?php echo $app_test_name->test_name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_name_grid->RowCnt ?>_app_test_name_test_name" class="app_test_name_test_name">
<span<?php echo $app_test_name->test_name->ViewAttributes() ?>>
<?php echo $app_test_name->test_name->ListViewValue() ?></span>
</span>
<?php if ($app_test_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->FormValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="o<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="o<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="fapp_test_namegrid$x<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="fapp_test_namegrid$x<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->FormValue) ?>">
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="fapp_test_namegrid$o<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="fapp_test_namegrid$o<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_name_grid->ListOptions->Render("body", "right", $app_test_name_grid->RowCnt);
?>
	</tr>
<?php if ($app_test_name->RowType == EW_ROWTYPE_ADD || $app_test_name->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_test_namegrid.UpdateOpts(<?php echo $app_test_name_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_test_name->CurrentAction <> "gridadd" || $app_test_name->CurrentMode == "copy")
		if (!$app_test_name_grid->Recordset->EOF) $app_test_name_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_test_name->CurrentMode == "add" || $app_test_name->CurrentMode == "copy" || $app_test_name->CurrentMode == "edit") {
		$app_test_name_grid->RowIndex = '$rowindex$';
		$app_test_name_grid->LoadRowValues();

		// Set row properties
		$app_test_name->ResetAttrs();
		$app_test_name->RowAttrs = array_merge($app_test_name->RowAttrs, array('data-rowindex'=>$app_test_name_grid->RowIndex, 'id'=>'r0_app_test_name', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_test_name->RowAttrs["class"], "ewTemplate");
		$app_test_name->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_test_name_grid->RenderRow();

		// Render list options
		$app_test_name_grid->RenderListOptions();
		$app_test_name_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_test_name->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_name_grid->ListOptions->Render("body", "left", $app_test_name_grid->RowIndex);
?>
	<?php if ($app_test_name->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<?php if ($app_test_name->CurrentAction <> "F") { ?>
<?php if ($app_test_name->test_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_test_name_test_id" class="form-group app_test_name_test_id">
<span<?php echo $app_test_name->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_name->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_test_name_test_id" class="form-group app_test_name_test_id">
<select data-table="app_test_name" data-field="x_test_id" data-value-separator="<?php echo $app_test_name->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id"<?php echo $app_test_name->test_id->EditAttributes() ?>>
<?php echo $app_test_name->test_id->SelectOptionListHtml("x<?php echo $app_test_name_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_test_name_test_id" class="form-group app_test_name_test_id">
<span<?php echo $app_test_name->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_name->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_name->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_name->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($app_test_name->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_name_lang_id" class="form-group app_test_name_lang_id">
<select data-table="app_test_name" data-field="x_lang_id" data-value-separator="<?php echo $app_test_name->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id"<?php echo $app_test_name->lang_id->EditAttributes() ?>>
<?php echo $app_test_name->lang_id->SelectOptionListHtml("x<?php echo $app_test_name_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_name_lang_id" class="form-group app_test_name_lang_id">
<span<?php echo $app_test_name->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_name->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="x<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_name" data-field="x_lang_id" name="o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_name->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_name->test_name->Visible) { // test_name ?>
		<td data-name="test_name">
<?php if ($app_test_name->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_name_test_name" class="form-group app_test_name_test_name">
<input type="text" data-table="app_test_name" data-field="x_test_name" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_test_name->test_name->getPlaceHolder()) ?>" value="<?php echo $app_test_name->test_name->EditValue ?>"<?php echo $app_test_name->test_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_name_test_name" class="form-group app_test_name_test_name">
<span<?php echo $app_test_name->test_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_name->test_name->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="x<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_name" data-field="x_test_name" name="o<?php echo $app_test_name_grid->RowIndex ?>_test_name" id="o<?php echo $app_test_name_grid->RowIndex ?>_test_name" value="<?php echo ew_HtmlEncode($app_test_name->test_name->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_name_grid->ListOptions->Render("body", "right", $app_test_name_grid->RowIndex);
?>
<script type="text/javascript">
fapp_test_namegrid.UpdateOpts(<?php echo $app_test_name_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_test_name->CurrentMode == "add" || $app_test_name->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_test_name_grid->FormKeyCountName ?>" id="<?php echo $app_test_name_grid->FormKeyCountName ?>" value="<?php echo $app_test_name_grid->KeyCount ?>">
<?php echo $app_test_name_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_name->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_test_name_grid->FormKeyCountName ?>" id="<?php echo $app_test_name_grid->FormKeyCountName ?>" value="<?php echo $app_test_name_grid->KeyCount ?>">
<?php echo $app_test_name_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_name->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_test_namegrid">
</div>
<?php

// Close recordset
if ($app_test_name_grid->Recordset)
	$app_test_name_grid->Recordset->Close();
?>
<?php if ($app_test_name_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_test_name_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_test_name_grid->TotalRecs == 0 && $app_test_name->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_name_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_test_name->Export == "") { ?>
<script type="text/javascript">
fapp_test_namegrid.Init();
</script>
<?php } ?>
<?php
$app_test_name_grid->Page_Terminate();
?>
