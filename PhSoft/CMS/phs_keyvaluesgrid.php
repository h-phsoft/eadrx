<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($phs_keyvalues_grid)) $phs_keyvalues_grid = new cphs_keyvalues_grid();

// Page init
$phs_keyvalues_grid->Page_Init();

// Page main
$phs_keyvalues_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phs_keyvalues_grid->Page_Render();
?>
<?php if ($phs_keyvalues->Export == "") { ?>
<script type="text/javascript">

// Form object
var fphs_keyvaluesgrid = new ew_Form("fphs_keyvaluesgrid", "grid");
fphs_keyvaluesgrid.FormKeyCountName = '<?php echo $phs_keyvalues_grid->FormKeyCountName ?>';

// Validate form
fphs_keyvaluesgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_key_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->key_id->FldCaption(), $phs_keyvalues->key_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->lang_id->FldCaption(), $phs_keyvalues->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_key_value");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->key_value->FldCaption(), $phs_keyvalues->key_value->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_key_rvalue");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->key_rvalue->FldCaption(), $phs_keyvalues->key_rvalue->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fphs_keyvaluesgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "key_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "key_value", false)) return false;
	if (ew_ValueChanged(fobj, infix, "key_rvalue", false)) return false;
	if (ew_ValueChanged(fobj, infix, "key_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fphs_keyvaluesgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fphs_keyvaluesgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fphs_keyvaluesgrid.Lists["x_key_id"] = {"LinkField":"x_key_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_key_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_keys"};
fphs_keyvaluesgrid.Lists["x_key_id"].Data = "<?php echo $phs_keyvalues_grid->key_id->LookupFilterQuery(FALSE, "grid") ?>";
fphs_keyvaluesgrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fphs_keyvaluesgrid.Lists["x_lang_id"].Data = "<?php echo $phs_keyvalues_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($phs_keyvalues->CurrentAction == "gridadd") {
	if ($phs_keyvalues->CurrentMode == "copy") {
		$bSelectLimit = $phs_keyvalues_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$phs_keyvalues_grid->TotalRecs = $phs_keyvalues->ListRecordCount();
			$phs_keyvalues_grid->Recordset = $phs_keyvalues_grid->LoadRecordset($phs_keyvalues_grid->StartRec-1, $phs_keyvalues_grid->DisplayRecs);
		} else {
			if ($phs_keyvalues_grid->Recordset = $phs_keyvalues_grid->LoadRecordset())
				$phs_keyvalues_grid->TotalRecs = $phs_keyvalues_grid->Recordset->RecordCount();
		}
		$phs_keyvalues_grid->StartRec = 1;
		$phs_keyvalues_grid->DisplayRecs = $phs_keyvalues_grid->TotalRecs;
	} else {
		$phs_keyvalues->CurrentFilter = "0=1";
		$phs_keyvalues_grid->StartRec = 1;
		$phs_keyvalues_grid->DisplayRecs = $phs_keyvalues->GridAddRowCount;
	}
	$phs_keyvalues_grid->TotalRecs = $phs_keyvalues_grid->DisplayRecs;
	$phs_keyvalues_grid->StopRec = $phs_keyvalues_grid->DisplayRecs;
} else {
	$bSelectLimit = $phs_keyvalues_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($phs_keyvalues_grid->TotalRecs <= 0)
			$phs_keyvalues_grid->TotalRecs = $phs_keyvalues->ListRecordCount();
	} else {
		if (!$phs_keyvalues_grid->Recordset && ($phs_keyvalues_grid->Recordset = $phs_keyvalues_grid->LoadRecordset()))
			$phs_keyvalues_grid->TotalRecs = $phs_keyvalues_grid->Recordset->RecordCount();
	}
	$phs_keyvalues_grid->StartRec = 1;
	$phs_keyvalues_grid->DisplayRecs = $phs_keyvalues_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$phs_keyvalues_grid->Recordset = $phs_keyvalues_grid->LoadRecordset($phs_keyvalues_grid->StartRec-1, $phs_keyvalues_grid->DisplayRecs);

	// Set no record found message
	if ($phs_keyvalues->CurrentAction == "" && $phs_keyvalues_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$phs_keyvalues_grid->setWarningMessage(ew_DeniedMsg());
		if ($phs_keyvalues_grid->SearchWhere == "0=101")
			$phs_keyvalues_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$phs_keyvalues_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$phs_keyvalues_grid->RenderOtherOptions();
?>
<?php $phs_keyvalues_grid->ShowPageHeader(); ?>
<?php
$phs_keyvalues_grid->ShowMessage();
?>
<?php if ($phs_keyvalues_grid->TotalRecs > 0 || $phs_keyvalues->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($phs_keyvalues_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> phs_keyvalues">
<div id="fphs_keyvaluesgrid" class="ewForm ewListForm form-inline">
<?php if ($phs_keyvalues_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($phs_keyvalues_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_phs_keyvalues" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_phs_keyvaluesgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$phs_keyvalues_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$phs_keyvalues_grid->RenderListOptions();

// Render list options (header, left)
$phs_keyvalues_grid->ListOptions->Render("header", "left");
?>
<?php if ($phs_keyvalues->key_id->Visible) { // key_id ?>
	<?php if ($phs_keyvalues->SortUrl($phs_keyvalues->key_id) == "") { ?>
		<th data-name="key_id" class="<?php echo $phs_keyvalues->key_id->HeaderCellClass() ?>"><div id="elh_phs_keyvalues_key_id" class="phs_keyvalues_key_id"><div class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="key_id" class="<?php echo $phs_keyvalues->key_id->HeaderCellClass() ?>"><div><div id="elh_phs_keyvalues_key_id" class="phs_keyvalues_key_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($phs_keyvalues->key_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($phs_keyvalues->key_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($phs_keyvalues->lang_id->Visible) { // lang_id ?>
	<?php if ($phs_keyvalues->SortUrl($phs_keyvalues->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $phs_keyvalues->lang_id->HeaderCellClass() ?>"><div id="elh_phs_keyvalues_lang_id" class="phs_keyvalues_lang_id"><div class="ewTableHeaderCaption"><?php echo $phs_keyvalues->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $phs_keyvalues->lang_id->HeaderCellClass() ?>"><div><div id="elh_phs_keyvalues_lang_id" class="phs_keyvalues_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $phs_keyvalues->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($phs_keyvalues->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($phs_keyvalues->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($phs_keyvalues->key_value->Visible) { // key_value ?>
	<?php if ($phs_keyvalues->SortUrl($phs_keyvalues->key_value) == "") { ?>
		<th data-name="key_value" class="<?php echo $phs_keyvalues->key_value->HeaderCellClass() ?>"><div id="elh_phs_keyvalues_key_value" class="phs_keyvalues_key_value"><div class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_value->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="key_value" class="<?php echo $phs_keyvalues->key_value->HeaderCellClass() ?>"><div><div id="elh_phs_keyvalues_key_value" class="phs_keyvalues_key_value">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_value->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($phs_keyvalues->key_value->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($phs_keyvalues->key_value->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($phs_keyvalues->key_rvalue->Visible) { // key_rvalue ?>
	<?php if ($phs_keyvalues->SortUrl($phs_keyvalues->key_rvalue) == "") { ?>
		<th data-name="key_rvalue" class="<?php echo $phs_keyvalues->key_rvalue->HeaderCellClass() ?>"><div id="elh_phs_keyvalues_key_rvalue" class="phs_keyvalues_key_rvalue"><div class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_rvalue->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="key_rvalue" class="<?php echo $phs_keyvalues->key_rvalue->HeaderCellClass() ?>"><div><div id="elh_phs_keyvalues_key_rvalue" class="phs_keyvalues_key_rvalue">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_rvalue->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($phs_keyvalues->key_rvalue->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($phs_keyvalues->key_rvalue->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($phs_keyvalues->key_text->Visible) { // key_text ?>
	<?php if ($phs_keyvalues->SortUrl($phs_keyvalues->key_text) == "") { ?>
		<th data-name="key_text" class="<?php echo $phs_keyvalues->key_text->HeaderCellClass() ?>"><div id="elh_phs_keyvalues_key_text" class="phs_keyvalues_key_text"><div class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="key_text" class="<?php echo $phs_keyvalues->key_text->HeaderCellClass() ?>"><div><div id="elh_phs_keyvalues_key_text" class="phs_keyvalues_key_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $phs_keyvalues->key_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($phs_keyvalues->key_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($phs_keyvalues->key_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$phs_keyvalues_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$phs_keyvalues_grid->StartRec = 1;
$phs_keyvalues_grid->StopRec = $phs_keyvalues_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($phs_keyvalues_grid->FormKeyCountName) && ($phs_keyvalues->CurrentAction == "gridadd" || $phs_keyvalues->CurrentAction == "gridedit" || $phs_keyvalues->CurrentAction == "F")) {
		$phs_keyvalues_grid->KeyCount = $objForm->GetValue($phs_keyvalues_grid->FormKeyCountName);
		$phs_keyvalues_grid->StopRec = $phs_keyvalues_grid->StartRec + $phs_keyvalues_grid->KeyCount - 1;
	}
}
$phs_keyvalues_grid->RecCnt = $phs_keyvalues_grid->StartRec - 1;
if ($phs_keyvalues_grid->Recordset && !$phs_keyvalues_grid->Recordset->EOF) {
	$phs_keyvalues_grid->Recordset->MoveFirst();
	$bSelectLimit = $phs_keyvalues_grid->UseSelectLimit;
	if (!$bSelectLimit && $phs_keyvalues_grid->StartRec > 1)
		$phs_keyvalues_grid->Recordset->Move($phs_keyvalues_grid->StartRec - 1);
} elseif (!$phs_keyvalues->AllowAddDeleteRow && $phs_keyvalues_grid->StopRec == 0) {
	$phs_keyvalues_grid->StopRec = $phs_keyvalues->GridAddRowCount;
}

// Initialize aggregate
$phs_keyvalues->RowType = EW_ROWTYPE_AGGREGATEINIT;
$phs_keyvalues->ResetAttrs();
$phs_keyvalues_grid->RenderRow();
if ($phs_keyvalues->CurrentAction == "gridadd")
	$phs_keyvalues_grid->RowIndex = 0;
if ($phs_keyvalues->CurrentAction == "gridedit")
	$phs_keyvalues_grid->RowIndex = 0;
while ($phs_keyvalues_grid->RecCnt < $phs_keyvalues_grid->StopRec) {
	$phs_keyvalues_grid->RecCnt++;
	if (intval($phs_keyvalues_grid->RecCnt) >= intval($phs_keyvalues_grid->StartRec)) {
		$phs_keyvalues_grid->RowCnt++;
		if ($phs_keyvalues->CurrentAction == "gridadd" || $phs_keyvalues->CurrentAction == "gridedit" || $phs_keyvalues->CurrentAction == "F") {
			$phs_keyvalues_grid->RowIndex++;
			$objForm->Index = $phs_keyvalues_grid->RowIndex;
			if ($objForm->HasValue($phs_keyvalues_grid->FormActionName))
				$phs_keyvalues_grid->RowAction = strval($objForm->GetValue($phs_keyvalues_grid->FormActionName));
			elseif ($phs_keyvalues->CurrentAction == "gridadd")
				$phs_keyvalues_grid->RowAction = "insert";
			else
				$phs_keyvalues_grid->RowAction = "";
		}

		// Set up key count
		$phs_keyvalues_grid->KeyCount = $phs_keyvalues_grid->RowIndex;

		// Init row class and style
		$phs_keyvalues->ResetAttrs();
		$phs_keyvalues->CssClass = "";
		if ($phs_keyvalues->CurrentAction == "gridadd") {
			if ($phs_keyvalues->CurrentMode == "copy") {
				$phs_keyvalues_grid->LoadRowValues($phs_keyvalues_grid->Recordset); // Load row values
				$phs_keyvalues_grid->SetRecordKey($phs_keyvalues_grid->RowOldKey, $phs_keyvalues_grid->Recordset); // Set old record key
			} else {
				$phs_keyvalues_grid->LoadRowValues(); // Load default values
				$phs_keyvalues_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$phs_keyvalues_grid->LoadRowValues($phs_keyvalues_grid->Recordset); // Load row values
		}
		$phs_keyvalues->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($phs_keyvalues->CurrentAction == "gridadd") // Grid add
			$phs_keyvalues->RowType = EW_ROWTYPE_ADD; // Render add
		if ($phs_keyvalues->CurrentAction == "gridadd" && $phs_keyvalues->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$phs_keyvalues_grid->RestoreCurrentRowFormValues($phs_keyvalues_grid->RowIndex); // Restore form values
		if ($phs_keyvalues->CurrentAction == "gridedit") { // Grid edit
			if ($phs_keyvalues->EventCancelled) {
				$phs_keyvalues_grid->RestoreCurrentRowFormValues($phs_keyvalues_grid->RowIndex); // Restore form values
			}
			if ($phs_keyvalues_grid->RowAction == "insert")
				$phs_keyvalues->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$phs_keyvalues->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($phs_keyvalues->CurrentAction == "gridedit" && ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT || $phs_keyvalues->RowType == EW_ROWTYPE_ADD) && $phs_keyvalues->EventCancelled) // Update failed
			$phs_keyvalues_grid->RestoreCurrentRowFormValues($phs_keyvalues_grid->RowIndex); // Restore form values
		if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT) // Edit row
			$phs_keyvalues_grid->EditRowCnt++;
		if ($phs_keyvalues->CurrentAction == "F") // Confirm row
			$phs_keyvalues_grid->RestoreCurrentRowFormValues($phs_keyvalues_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$phs_keyvalues->RowAttrs = array_merge($phs_keyvalues->RowAttrs, array('data-rowindex'=>$phs_keyvalues_grid->RowCnt, 'id'=>'r' . $phs_keyvalues_grid->RowCnt . '_phs_keyvalues', 'data-rowtype'=>$phs_keyvalues->RowType));

		// Render row
		$phs_keyvalues_grid->RenderRow();

		// Render list options
		$phs_keyvalues_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($phs_keyvalues_grid->RowAction <> "delete" && $phs_keyvalues_grid->RowAction <> "insertdelete" && !($phs_keyvalues_grid->RowAction == "insert" && $phs_keyvalues->CurrentAction == "F" && $phs_keyvalues_grid->EmptyRow())) {
?>
	<tr<?php echo $phs_keyvalues->RowAttributes() ?>>
<?php

// Render list options (body, left)
$phs_keyvalues_grid->ListOptions->Render("body", "left", $phs_keyvalues_grid->RowCnt);
?>
	<?php if ($phs_keyvalues->key_id->Visible) { // key_id ?>
		<td data-name="key_id"<?php echo $phs_keyvalues->key_id->CellAttributes() ?>>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($phs_keyvalues->key_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<span<?php echo $phs_keyvalues->key_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<select data-table="phs_keyvalues" data-field="x_key_id" data-value-separator="<?php echo $phs_keyvalues->key_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id"<?php echo $phs_keyvalues->key_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->key_id->SelectOptionListHtml("x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->OldValue) ?>">
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($phs_keyvalues->key_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<span<?php echo $phs_keyvalues->key_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<select data-table="phs_keyvalues" data-field="x_key_id" data-value-separator="<?php echo $phs_keyvalues->key_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id"<?php echo $phs_keyvalues->key_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->key_id->SelectOptionListHtml("x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_id" class="phs_keyvalues_key_id">
<span<?php echo $phs_keyvalues->key_id->ViewAttributes() ?>>
<?php echo $phs_keyvalues->key_id->ListViewValue() ?></span>
</span>
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_kval_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_kval_id" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_kval_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->kval_id->CurrentValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_kval_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_kval_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_kval_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->kval_id->OldValue) ?>">
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT || $phs_keyvalues->CurrentMode == "edit") { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_kval_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_kval_id" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_kval_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->kval_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($phs_keyvalues->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $phs_keyvalues->lang_id->CellAttributes() ?>>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_lang_id" class="form-group phs_keyvalues_lang_id">
<select data-table="phs_keyvalues" data-field="x_lang_id" data-value-separator="<?php echo $phs_keyvalues->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id"<?php echo $phs_keyvalues->lang_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->lang_id->SelectOptionListHtml("x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_lang_id" class="form-group phs_keyvalues_lang_id">
<select data-table="phs_keyvalues" data-field="x_lang_id" data-value-separator="<?php echo $phs_keyvalues->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id"<?php echo $phs_keyvalues->lang_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->lang_id->SelectOptionListHtml("x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_lang_id" class="phs_keyvalues_lang_id">
<span<?php echo $phs_keyvalues->lang_id->ViewAttributes() ?>>
<?php echo $phs_keyvalues->lang_id->ListViewValue() ?></span>
</span>
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->key_value->Visible) { // key_value ?>
		<td data-name="key_value"<?php echo $phs_keyvalues->key_value->CellAttributes() ?>>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_value" class="form-group phs_keyvalues_key_value">
<input type="text" data-table="phs_keyvalues" data-field="x_key_value" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_value->EditValue ?>"<?php echo $phs_keyvalues->key_value->EditAttributes() ?>>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->OldValue) ?>">
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_value" class="form-group phs_keyvalues_key_value">
<input type="text" data-table="phs_keyvalues" data-field="x_key_value" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_value->EditValue ?>"<?php echo $phs_keyvalues->key_value->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_value" class="phs_keyvalues_key_value">
<span<?php echo $phs_keyvalues->key_value->ViewAttributes() ?>>
<?php echo $phs_keyvalues->key_value->ListViewValue() ?></span>
</span>
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->key_rvalue->Visible) { // key_rvalue ?>
		<td data-name="key_rvalue"<?php echo $phs_keyvalues->key_rvalue->CellAttributes() ?>>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_rvalue" class="form-group phs_keyvalues_key_rvalue">
<input type="text" data-table="phs_keyvalues" data-field="x_key_rvalue" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_rvalue->EditValue ?>"<?php echo $phs_keyvalues->key_rvalue->EditAttributes() ?>>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->OldValue) ?>">
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_rvalue" class="form-group phs_keyvalues_key_rvalue">
<input type="text" data-table="phs_keyvalues" data-field="x_key_rvalue" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_rvalue->EditValue ?>"<?php echo $phs_keyvalues->key_rvalue->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_rvalue" class="phs_keyvalues_key_rvalue">
<span<?php echo $phs_keyvalues->key_rvalue->ViewAttributes() ?>>
<?php echo $phs_keyvalues->key_rvalue->ListViewValue() ?></span>
</span>
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->key_text->Visible) { // key_text ?>
		<td data-name="key_text"<?php echo $phs_keyvalues->key_text->CellAttributes() ?>>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_text" class="form-group phs_keyvalues_key_text">
<?php ew_AppendClass($phs_keyvalues->key_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="phs_keyvalues" data-field="x_key_text" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->getPlaceHolder()) ?>"<?php echo $phs_keyvalues->key_text->EditAttributes() ?>><?php echo $phs_keyvalues->key_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fphs_keyvaluesgrid", "x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text", 35, 4, <?php echo ($phs_keyvalues->key_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->OldValue) ?>">
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_text" class="form-group phs_keyvalues_key_text">
<?php ew_AppendClass($phs_keyvalues->key_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="phs_keyvalues" data-field="x_key_text" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->getPlaceHolder()) ?>"<?php echo $phs_keyvalues->key_text->EditAttributes() ?>><?php echo $phs_keyvalues->key_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fphs_keyvaluesgrid", "x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text", 35, 4, <?php echo ($phs_keyvalues->key_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $phs_keyvalues_grid->RowCnt ?>_phs_keyvalues_key_text" class="phs_keyvalues_key_text">
<span<?php echo $phs_keyvalues->key_text->ViewAttributes() ?>>
<?php echo $phs_keyvalues->key_text->ListViewValue() ?></span>
</span>
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="fphs_keyvaluesgrid$x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->FormValue) ?>">
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="fphs_keyvaluesgrid$o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$phs_keyvalues_grid->ListOptions->Render("body", "right", $phs_keyvalues_grid->RowCnt);
?>
	</tr>
<?php if ($phs_keyvalues->RowType == EW_ROWTYPE_ADD || $phs_keyvalues->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fphs_keyvaluesgrid.UpdateOpts(<?php echo $phs_keyvalues_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($phs_keyvalues->CurrentAction <> "gridadd" || $phs_keyvalues->CurrentMode == "copy")
		if (!$phs_keyvalues_grid->Recordset->EOF) $phs_keyvalues_grid->Recordset->MoveNext();
}
?>
<?php
	if ($phs_keyvalues->CurrentMode == "add" || $phs_keyvalues->CurrentMode == "copy" || $phs_keyvalues->CurrentMode == "edit") {
		$phs_keyvalues_grid->RowIndex = '$rowindex$';
		$phs_keyvalues_grid->LoadRowValues();

		// Set row properties
		$phs_keyvalues->ResetAttrs();
		$phs_keyvalues->RowAttrs = array_merge($phs_keyvalues->RowAttrs, array('data-rowindex'=>$phs_keyvalues_grid->RowIndex, 'id'=>'r0_phs_keyvalues', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($phs_keyvalues->RowAttrs["class"], "ewTemplate");
		$phs_keyvalues->RowType = EW_ROWTYPE_ADD;

		// Render row
		$phs_keyvalues_grid->RenderRow();

		// Render list options
		$phs_keyvalues_grid->RenderListOptions();
		$phs_keyvalues_grid->StartRowCnt = 0;
?>
	<tr<?php echo $phs_keyvalues->RowAttributes() ?>>
<?php

// Render list options (body, left)
$phs_keyvalues_grid->ListOptions->Render("body", "left", $phs_keyvalues_grid->RowIndex);
?>
	<?php if ($phs_keyvalues->key_id->Visible) { // key_id ?>
		<td data-name="key_id">
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<?php if ($phs_keyvalues->key_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<span<?php echo $phs_keyvalues->key_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<select data-table="phs_keyvalues" data-field="x_key_id" data-value-separator="<?php echo $phs_keyvalues->key_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id"<?php echo $phs_keyvalues->key_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->key_id->SelectOptionListHtml("x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_phs_keyvalues_key_id" class="form-group phs_keyvalues_key_id">
<span<?php echo $phs_keyvalues->key_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<span id="el$rowindex$_phs_keyvalues_lang_id" class="form-group phs_keyvalues_lang_id">
<select data-table="phs_keyvalues" data-field="x_lang_id" data-value-separator="<?php echo $phs_keyvalues->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id"<?php echo $phs_keyvalues->lang_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->lang_id->SelectOptionListHtml("x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_phs_keyvalues_lang_id" class="form-group phs_keyvalues_lang_id">
<span<?php echo $phs_keyvalues->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_lang_id" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->key_value->Visible) { // key_value ?>
		<td data-name="key_value">
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<span id="el$rowindex$_phs_keyvalues_key_value" class="form-group phs_keyvalues_key_value">
<input type="text" data-table="phs_keyvalues" data-field="x_key_value" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_value->EditValue ?>"<?php echo $phs_keyvalues->key_value->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_phs_keyvalues_key_value" class="form-group phs_keyvalues_key_value">
<span<?php echo $phs_keyvalues->key_value->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_value->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_value" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_value" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->key_rvalue->Visible) { // key_rvalue ?>
		<td data-name="key_rvalue">
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<span id="el$rowindex$_phs_keyvalues_key_rvalue" class="form-group phs_keyvalues_key_rvalue">
<input type="text" data-table="phs_keyvalues" data-field="x_key_rvalue" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_rvalue->EditValue ?>"<?php echo $phs_keyvalues->key_rvalue->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_phs_keyvalues_key_rvalue" class="form-group phs_keyvalues_key_rvalue">
<span<?php echo $phs_keyvalues->key_rvalue->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_rvalue->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_rvalue" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_rvalue" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($phs_keyvalues->key_text->Visible) { // key_text ?>
		<td data-name="key_text">
<?php if ($phs_keyvalues->CurrentAction <> "F") { ?>
<span id="el$rowindex$_phs_keyvalues_key_text" class="form-group phs_keyvalues_key_text">
<?php ew_AppendClass($phs_keyvalues->key_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="phs_keyvalues" data-field="x_key_text" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->getPlaceHolder()) ?>"<?php echo $phs_keyvalues->key_text->EditAttributes() ?>><?php echo $phs_keyvalues->key_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fphs_keyvaluesgrid", "x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text", 35, 4, <?php echo ($phs_keyvalues->key_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_phs_keyvalues_key_text" class="form-group phs_keyvalues_key_text">
<span<?php echo $phs_keyvalues->key_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="x<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="phs_keyvalues" data-field="x_key_text" name="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" id="o<?php echo $phs_keyvalues_grid->RowIndex ?>_key_text" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$phs_keyvalues_grid->ListOptions->Render("body", "right", $phs_keyvalues_grid->RowIndex);
?>
<script type="text/javascript">
fphs_keyvaluesgrid.UpdateOpts(<?php echo $phs_keyvalues_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($phs_keyvalues->CurrentMode == "add" || $phs_keyvalues->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $phs_keyvalues_grid->FormKeyCountName ?>" id="<?php echo $phs_keyvalues_grid->FormKeyCountName ?>" value="<?php echo $phs_keyvalues_grid->KeyCount ?>">
<?php echo $phs_keyvalues_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($phs_keyvalues->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $phs_keyvalues_grid->FormKeyCountName ?>" id="<?php echo $phs_keyvalues_grid->FormKeyCountName ?>" value="<?php echo $phs_keyvalues_grid->KeyCount ?>">
<?php echo $phs_keyvalues_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($phs_keyvalues->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fphs_keyvaluesgrid">
</div>
<?php

// Close recordset
if ($phs_keyvalues_grid->Recordset)
	$phs_keyvalues_grid->Recordset->Close();
?>
<?php if ($phs_keyvalues_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($phs_keyvalues_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($phs_keyvalues_grid->TotalRecs == 0 && $phs_keyvalues->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($phs_keyvalues_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($phs_keyvalues->Export == "") { ?>
<script type="text/javascript">
fphs_keyvaluesgrid.Init();
</script>
<?php } ?>
<?php
$phs_keyvalues_grid->Page_Terminate();
?>
