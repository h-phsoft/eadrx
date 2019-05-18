<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_tips_grid)) $app_tips_grid = new capp_tips_grid();

// Page init
$app_tips_grid->Page_Init();

// Page main
$app_tips_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_tips_grid->Page_Render();
?>
<?php if ($app_tips->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_tipsgrid = new ew_Form("fapp_tipsgrid", "grid");
fapp_tipsgrid.FormKeyCountName = '<?php echo $app_tips_grid->FormKeyCountName ?>';

// Validate form
fapp_tipsgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_tcat_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips->tcat_id->FldCaption(), $app_tips->tcat_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips->lang_id->FldCaption(), $app_tips->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips->status_id->FldCaption(), $app_tips->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tips_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips->tips_text->FldCaption(), $app_tips->tips_text->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ins_datetime");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_tips->ins_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_tipsgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "tcat_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "status_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tips_text", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ins_datetime", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_tipsgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_tipsgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_tipsgrid.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_tipsgrid.Lists["x_tcat_id"].Data = "<?php echo $app_tips_grid->tcat_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_tipsgrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_tipsgrid.Lists["x_lang_id"].Data = "<?php echo $app_tips_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_tipsgrid.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_tipsgrid.Lists["x_status_id"].Data = "<?php echo $app_tips_grid->status_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_tips->CurrentAction == "gridadd") {
	if ($app_tips->CurrentMode == "copy") {
		$bSelectLimit = $app_tips_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_tips_grid->TotalRecs = $app_tips->ListRecordCount();
			$app_tips_grid->Recordset = $app_tips_grid->LoadRecordset($app_tips_grid->StartRec-1, $app_tips_grid->DisplayRecs);
		} else {
			if ($app_tips_grid->Recordset = $app_tips_grid->LoadRecordset())
				$app_tips_grid->TotalRecs = $app_tips_grid->Recordset->RecordCount();
		}
		$app_tips_grid->StartRec = 1;
		$app_tips_grid->DisplayRecs = $app_tips_grid->TotalRecs;
	} else {
		$app_tips->CurrentFilter = "0=1";
		$app_tips_grid->StartRec = 1;
		$app_tips_grid->DisplayRecs = $app_tips->GridAddRowCount;
	}
	$app_tips_grid->TotalRecs = $app_tips_grid->DisplayRecs;
	$app_tips_grid->StopRec = $app_tips_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_tips_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_tips_grid->TotalRecs <= 0)
			$app_tips_grid->TotalRecs = $app_tips->ListRecordCount();
	} else {
		if (!$app_tips_grid->Recordset && ($app_tips_grid->Recordset = $app_tips_grid->LoadRecordset()))
			$app_tips_grid->TotalRecs = $app_tips_grid->Recordset->RecordCount();
	}
	$app_tips_grid->StartRec = 1;
	$app_tips_grid->DisplayRecs = $app_tips_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_tips_grid->Recordset = $app_tips_grid->LoadRecordset($app_tips_grid->StartRec-1, $app_tips_grid->DisplayRecs);

	// Set no record found message
	if ($app_tips->CurrentAction == "" && $app_tips_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_tips_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_tips_grid->SearchWhere == "0=101")
			$app_tips_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_tips_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_tips_grid->RenderOtherOptions();
?>
<?php $app_tips_grid->ShowPageHeader(); ?>
<?php
$app_tips_grid->ShowMessage();
?>
<?php if ($app_tips_grid->TotalRecs > 0 || $app_tips->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_tips_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_tips">
<div id="fapp_tipsgrid" class="ewForm ewListForm form-inline">
<?php if ($app_tips_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_tips_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_tips" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_tipsgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_tips_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_tips_grid->RenderListOptions();

// Render list options (header, left)
$app_tips_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_tips->tcat_id->Visible) { // tcat_id ?>
	<?php if ($app_tips->SortUrl($app_tips->tcat_id) == "") { ?>
		<th data-name="tcat_id" class="<?php echo $app_tips->tcat_id->HeaderCellClass() ?>"><div id="elh_app_tips_tcat_id" class="app_tips_tcat_id"><div class="ewTableHeaderCaption"><?php echo $app_tips->tcat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tcat_id" class="<?php echo $app_tips->tcat_id->HeaderCellClass() ?>"><div><div id="elh_app_tips_tcat_id" class="app_tips_tcat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips->tcat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips->tcat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips->tcat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_tips->lang_id->Visible) { // lang_id ?>
	<?php if ($app_tips->SortUrl($app_tips->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_tips->lang_id->HeaderCellClass() ?>"><div id="elh_app_tips_lang_id" class="app_tips_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_tips->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_tips->lang_id->HeaderCellClass() ?>"><div><div id="elh_app_tips_lang_id" class="app_tips_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_tips->status_id->Visible) { // status_id ?>
	<?php if ($app_tips->SortUrl($app_tips->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $app_tips->status_id->HeaderCellClass() ?>"><div id="elh_app_tips_status_id" class="app_tips_status_id"><div class="ewTableHeaderCaption"><?php echo $app_tips->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $app_tips->status_id->HeaderCellClass() ?>"><div><div id="elh_app_tips_status_id" class="app_tips_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_tips->tips_text->Visible) { // tips_text ?>
	<?php if ($app_tips->SortUrl($app_tips->tips_text) == "") { ?>
		<th data-name="tips_text" class="<?php echo $app_tips->tips_text->HeaderCellClass() ?>"><div id="elh_app_tips_tips_text" class="app_tips_tips_text"><div class="ewTableHeaderCaption"><?php echo $app_tips->tips_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tips_text" class="<?php echo $app_tips->tips_text->HeaderCellClass() ?>"><div><div id="elh_app_tips_tips_text" class="app_tips_tips_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips->tips_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips->tips_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips->tips_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_tips->ins_datetime->Visible) { // ins_datetime ?>
	<?php if ($app_tips->SortUrl($app_tips->ins_datetime) == "") { ?>
		<th data-name="ins_datetime" class="<?php echo $app_tips->ins_datetime->HeaderCellClass() ?>"><div id="elh_app_tips_ins_datetime" class="app_tips_ins_datetime"><div class="ewTableHeaderCaption"><?php echo $app_tips->ins_datetime->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ins_datetime" class="<?php echo $app_tips->ins_datetime->HeaderCellClass() ?>"><div><div id="elh_app_tips_ins_datetime" class="app_tips_ins_datetime">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips->ins_datetime->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips->ins_datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips->ins_datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_tips_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_tips_grid->StartRec = 1;
$app_tips_grid->StopRec = $app_tips_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_tips_grid->FormKeyCountName) && ($app_tips->CurrentAction == "gridadd" || $app_tips->CurrentAction == "gridedit" || $app_tips->CurrentAction == "F")) {
		$app_tips_grid->KeyCount = $objForm->GetValue($app_tips_grid->FormKeyCountName);
		$app_tips_grid->StopRec = $app_tips_grid->StartRec + $app_tips_grid->KeyCount - 1;
	}
}
$app_tips_grid->RecCnt = $app_tips_grid->StartRec - 1;
if ($app_tips_grid->Recordset && !$app_tips_grid->Recordset->EOF) {
	$app_tips_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_tips_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_tips_grid->StartRec > 1)
		$app_tips_grid->Recordset->Move($app_tips_grid->StartRec - 1);
} elseif (!$app_tips->AllowAddDeleteRow && $app_tips_grid->StopRec == 0) {
	$app_tips_grid->StopRec = $app_tips->GridAddRowCount;
}

// Initialize aggregate
$app_tips->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_tips->ResetAttrs();
$app_tips_grid->RenderRow();
if ($app_tips->CurrentAction == "gridadd")
	$app_tips_grid->RowIndex = 0;
if ($app_tips->CurrentAction == "gridedit")
	$app_tips_grid->RowIndex = 0;
while ($app_tips_grid->RecCnt < $app_tips_grid->StopRec) {
	$app_tips_grid->RecCnt++;
	if (intval($app_tips_grid->RecCnt) >= intval($app_tips_grid->StartRec)) {
		$app_tips_grid->RowCnt++;
		if ($app_tips->CurrentAction == "gridadd" || $app_tips->CurrentAction == "gridedit" || $app_tips->CurrentAction == "F") {
			$app_tips_grid->RowIndex++;
			$objForm->Index = $app_tips_grid->RowIndex;
			if ($objForm->HasValue($app_tips_grid->FormActionName))
				$app_tips_grid->RowAction = strval($objForm->GetValue($app_tips_grid->FormActionName));
			elseif ($app_tips->CurrentAction == "gridadd")
				$app_tips_grid->RowAction = "insert";
			else
				$app_tips_grid->RowAction = "";
		}

		// Set up key count
		$app_tips_grid->KeyCount = $app_tips_grid->RowIndex;

		// Init row class and style
		$app_tips->ResetAttrs();
		$app_tips->CssClass = "";
		if ($app_tips->CurrentAction == "gridadd") {
			if ($app_tips->CurrentMode == "copy") {
				$app_tips_grid->LoadRowValues($app_tips_grid->Recordset); // Load row values
				$app_tips_grid->SetRecordKey($app_tips_grid->RowOldKey, $app_tips_grid->Recordset); // Set old record key
			} else {
				$app_tips_grid->LoadRowValues(); // Load default values
				$app_tips_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_tips_grid->LoadRowValues($app_tips_grid->Recordset); // Load row values
		}
		$app_tips->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_tips->CurrentAction == "gridadd") // Grid add
			$app_tips->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_tips->CurrentAction == "gridadd" && $app_tips->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_tips_grid->RestoreCurrentRowFormValues($app_tips_grid->RowIndex); // Restore form values
		if ($app_tips->CurrentAction == "gridedit") { // Grid edit
			if ($app_tips->EventCancelled) {
				$app_tips_grid->RestoreCurrentRowFormValues($app_tips_grid->RowIndex); // Restore form values
			}
			if ($app_tips_grid->RowAction == "insert")
				$app_tips->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_tips->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_tips->CurrentAction == "gridedit" && ($app_tips->RowType == EW_ROWTYPE_EDIT || $app_tips->RowType == EW_ROWTYPE_ADD) && $app_tips->EventCancelled) // Update failed
			$app_tips_grid->RestoreCurrentRowFormValues($app_tips_grid->RowIndex); // Restore form values
		if ($app_tips->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_tips_grid->EditRowCnt++;
		if ($app_tips->CurrentAction == "F") // Confirm row
			$app_tips_grid->RestoreCurrentRowFormValues($app_tips_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_tips->RowAttrs = array_merge($app_tips->RowAttrs, array('data-rowindex'=>$app_tips_grid->RowCnt, 'id'=>'r' . $app_tips_grid->RowCnt . '_app_tips', 'data-rowtype'=>$app_tips->RowType));

		// Render row
		$app_tips_grid->RenderRow();

		// Render list options
		$app_tips_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_tips_grid->RowAction <> "delete" && $app_tips_grid->RowAction <> "insertdelete" && !($app_tips_grid->RowAction == "insert" && $app_tips->CurrentAction == "F" && $app_tips_grid->EmptyRow())) {
?>
	<tr<?php echo $app_tips->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_tips_grid->ListOptions->Render("body", "left", $app_tips_grid->RowCnt);
?>
	<?php if ($app_tips->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id"<?php echo $app_tips->tcat_id->CellAttributes() ?>>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_tips->tcat_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<span<?php echo $app_tips->tcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->tcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<select data-table="app_tips" data-field="x_tcat_id" data-value-separator="<?php echo $app_tips->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id"<?php echo $app_tips->tcat_id->EditAttributes() ?>>
<?php echo $app_tips->tcat_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_tips->tcat_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<span<?php echo $app_tips->tcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->tcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<select data-table="app_tips" data-field="x_tcat_id" data-value-separator="<?php echo $app_tips->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id"<?php echo $app_tips->tcat_id->EditAttributes() ?>>
<?php echo $app_tips->tcat_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tcat_id" class="app_tips_tcat_id">
<span<?php echo $app_tips->tcat_id->ViewAttributes() ?>>
<?php echo $app_tips->tcat_id->ListViewValue() ?></span>
</span>
<?php if ($app_tips->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_tips" data-field="x_tips_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_id" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_id" value="<?php echo ew_HtmlEncode($app_tips->tips_id->CurrentValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_tips_id" name="o<?php echo $app_tips_grid->RowIndex ?>_tips_id" id="o<?php echo $app_tips_grid->RowIndex ?>_tips_id" value="<?php echo ew_HtmlEncode($app_tips->tips_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_EDIT || $app_tips->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_tips" data-field="x_tips_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_id" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_id" value="<?php echo ew_HtmlEncode($app_tips->tips_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_tips->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_tips->lang_id->CellAttributes() ?>>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_lang_id" class="form-group app_tips_lang_id">
<select data-table="app_tips" data-field="x_lang_id" data-value-separator="<?php echo $app_tips->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" name="x<?php echo $app_tips_grid->RowIndex ?>_lang_id"<?php echo $app_tips->lang_id->EditAttributes() ?>>
<?php echo $app_tips->lang_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="o<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="o<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_lang_id" class="form-group app_tips_lang_id">
<select data-table="app_tips" data-field="x_lang_id" data-value-separator="<?php echo $app_tips->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" name="x<?php echo $app_tips_grid->RowIndex ?>_lang_id"<?php echo $app_tips->lang_id->EditAttributes() ?>>
<?php echo $app_tips->lang_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_lang_id" class="app_tips_lang_id">
<span<?php echo $app_tips->lang_id->ViewAttributes() ?>>
<?php echo $app_tips->lang_id->ListViewValue() ?></span>
</span>
<?php if ($app_tips->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="o<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="o<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_tips->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $app_tips->status_id->CellAttributes() ?>>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_status_id" class="form-group app_tips_status_id">
<select data-table="app_tips" data-field="x_status_id" data-value-separator="<?php echo $app_tips->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_status_id" name="x<?php echo $app_tips_grid->RowIndex ?>_status_id"<?php echo $app_tips->status_id->EditAttributes() ?>>
<?php echo $app_tips->status_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="o<?php echo $app_tips_grid->RowIndex ?>_status_id" id="o<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_status_id" class="form-group app_tips_status_id">
<select data-table="app_tips" data-field="x_status_id" data-value-separator="<?php echo $app_tips->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_status_id" name="x<?php echo $app_tips_grid->RowIndex ?>_status_id"<?php echo $app_tips->status_id->EditAttributes() ?>>
<?php echo $app_tips->status_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_status_id" class="app_tips_status_id">
<span<?php echo $app_tips->status_id->ViewAttributes() ?>>
<?php echo $app_tips->status_id->ListViewValue() ?></span>
</span>
<?php if ($app_tips->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="x<?php echo $app_tips_grid->RowIndex ?>_status_id" id="x<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="o<?php echo $app_tips_grid->RowIndex ?>_status_id" id="o<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_status_id" id="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_status_id" id="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_tips->tips_text->Visible) { // tips_text ?>
		<td data-name="tips_text"<?php echo $app_tips->tips_text->CellAttributes() ?>>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tips_text" class="form-group app_tips_tips_text">
<?php ew_AppendClass($app_tips->tips_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_tips" data-field="x_tips_text" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_tips->tips_text->getPlaceHolder()) ?>"<?php echo $app_tips->tips_text->EditAttributes() ?>><?php echo $app_tips->tips_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_tipsgrid", "x<?php echo $app_tips_grid->RowIndex ?>_tips_text", 35, 4, <?php echo ($app_tips->tips_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="o<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="o<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->OldValue) ?>">
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tips_text" class="form-group app_tips_tips_text">
<?php ew_AppendClass($app_tips->tips_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_tips" data-field="x_tips_text" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_tips->tips_text->getPlaceHolder()) ?>"<?php echo $app_tips->tips_text->EditAttributes() ?>><?php echo $app_tips->tips_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_tipsgrid", "x<?php echo $app_tips_grid->RowIndex ?>_tips_text", 35, 4, <?php echo ($app_tips->tips_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_tips_text" class="app_tips_tips_text">
<span<?php echo $app_tips->tips_text->ViewAttributes() ?>>
<?php echo $app_tips->tips_text->ListViewValue() ?></span>
</span>
<?php if ($app_tips->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="o<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="o<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_tips->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime"<?php echo $app_tips->ins_datetime->CellAttributes() ?>>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_ins_datetime" class="form-group app_tips_ins_datetime">
<input type="text" data-table="app_tips" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_tips->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_tips->ins_datetime->EditValue ?>"<?php echo $app_tips->ins_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->OldValue) ?>">
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_ins_datetime" class="form-group app_tips_ins_datetime">
<input type="text" data-table="app_tips" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_tips->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_tips->ins_datetime->EditValue ?>"<?php echo $app_tips->ins_datetime->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_tips->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_grid->RowCnt ?>_app_tips_ins_datetime" class="app_tips_ins_datetime">
<span<?php echo $app_tips->ins_datetime->ViewAttributes() ?>>
<?php echo $app_tips->ins_datetime->ListViewValue() ?></span>
</span>
<?php if ($app_tips->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="fapp_tipsgrid$x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->FormValue) ?>">
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="fapp_tipsgrid$o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_tips_grid->ListOptions->Render("body", "right", $app_tips_grid->RowCnt);
?>
	</tr>
<?php if ($app_tips->RowType == EW_ROWTYPE_ADD || $app_tips->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_tipsgrid.UpdateOpts(<?php echo $app_tips_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_tips->CurrentAction <> "gridadd" || $app_tips->CurrentMode == "copy")
		if (!$app_tips_grid->Recordset->EOF) $app_tips_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_tips->CurrentMode == "add" || $app_tips->CurrentMode == "copy" || $app_tips->CurrentMode == "edit") {
		$app_tips_grid->RowIndex = '$rowindex$';
		$app_tips_grid->LoadRowValues();

		// Set row properties
		$app_tips->ResetAttrs();
		$app_tips->RowAttrs = array_merge($app_tips->RowAttrs, array('data-rowindex'=>$app_tips_grid->RowIndex, 'id'=>'r0_app_tips', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_tips->RowAttrs["class"], "ewTemplate");
		$app_tips->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_tips_grid->RenderRow();

		// Render list options
		$app_tips_grid->RenderListOptions();
		$app_tips_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_tips->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_tips_grid->ListOptions->Render("body", "left", $app_tips_grid->RowIndex);
?>
	<?php if ($app_tips->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id">
<?php if ($app_tips->CurrentAction <> "F") { ?>
<?php if ($app_tips->tcat_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<span<?php echo $app_tips->tcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->tcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<select data-table="app_tips" data-field="x_tcat_id" data-value-separator="<?php echo $app_tips->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id"<?php echo $app_tips->tcat_id->EditAttributes() ?>>
<?php echo $app_tips->tcat_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_tips_tcat_id" class="form-group app_tips_tcat_id">
<span<?php echo $app_tips->tcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->tcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="x<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips" data-field="x_tcat_id" name="o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_tips_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips->tcat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_tips->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($app_tips->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_tips_lang_id" class="form-group app_tips_lang_id">
<select data-table="app_tips" data-field="x_lang_id" data-value-separator="<?php echo $app_tips->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" name="x<?php echo $app_tips_grid->RowIndex ?>_lang_id"<?php echo $app_tips->lang_id->EditAttributes() ?>>
<?php echo $app_tips->lang_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_tips_lang_id" class="form-group app_tips_lang_id">
<span<?php echo $app_tips->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="x<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips" data-field="x_lang_id" name="o<?php echo $app_tips_grid->RowIndex ?>_lang_id" id="o<?php echo $app_tips_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_tips->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_tips->status_id->Visible) { // status_id ?>
		<td data-name="status_id">
<?php if ($app_tips->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_tips_status_id" class="form-group app_tips_status_id">
<select data-table="app_tips" data-field="x_status_id" data-value-separator="<?php echo $app_tips->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_grid->RowIndex ?>_status_id" name="x<?php echo $app_tips_grid->RowIndex ?>_status_id"<?php echo $app_tips->status_id->EditAttributes() ?>>
<?php echo $app_tips->status_id->SelectOptionListHtml("x<?php echo $app_tips_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_tips_status_id" class="form-group app_tips_status_id">
<span<?php echo $app_tips->status_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->status_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="x<?php echo $app_tips_grid->RowIndex ?>_status_id" id="x<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips" data-field="x_status_id" name="o<?php echo $app_tips_grid->RowIndex ?>_status_id" id="o<?php echo $app_tips_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($app_tips->status_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_tips->tips_text->Visible) { // tips_text ?>
		<td data-name="tips_text">
<?php if ($app_tips->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_tips_tips_text" class="form-group app_tips_tips_text">
<?php ew_AppendClass($app_tips->tips_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_tips" data-field="x_tips_text" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_tips->tips_text->getPlaceHolder()) ?>"<?php echo $app_tips->tips_text->EditAttributes() ?>><?php echo $app_tips->tips_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_tipsgrid", "x<?php echo $app_tips_grid->RowIndex ?>_tips_text", 35, 4, <?php echo ($app_tips->tips_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_tips_tips_text" class="form-group app_tips_tips_text">
<span<?php echo $app_tips->tips_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->tips_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="x<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips" data-field="x_tips_text" name="o<?php echo $app_tips_grid->RowIndex ?>_tips_text" id="o<?php echo $app_tips_grid->RowIndex ?>_tips_text" value="<?php echo ew_HtmlEncode($app_tips->tips_text->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_tips->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime">
<?php if ($app_tips->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_tips_ins_datetime" class="form-group app_tips_ins_datetime">
<input type="text" data-table="app_tips" data-field="x_ins_datetime" data-format="11" name="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_tips->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_tips->ins_datetime->EditValue ?>"<?php echo $app_tips->ins_datetime->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_tips_ins_datetime" class="form-group app_tips_ins_datetime">
<span<?php echo $app_tips->ins_datetime->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips->ins_datetime->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="x<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips" data-field="x_ins_datetime" name="o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" id="o<?php echo $app_tips_grid->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_tips->ins_datetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_tips_grid->ListOptions->Render("body", "right", $app_tips_grid->RowIndex);
?>
<script type="text/javascript">
fapp_tipsgrid.UpdateOpts(<?php echo $app_tips_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_tips->CurrentMode == "add" || $app_tips->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_tips_grid->FormKeyCountName ?>" id="<?php echo $app_tips_grid->FormKeyCountName ?>" value="<?php echo $app_tips_grid->KeyCount ?>">
<?php echo $app_tips_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_tips->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_tips_grid->FormKeyCountName ?>" id="<?php echo $app_tips_grid->FormKeyCountName ?>" value="<?php echo $app_tips_grid->KeyCount ?>">
<?php echo $app_tips_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_tips->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_tipsgrid">
</div>
<?php

// Close recordset
if ($app_tips_grid->Recordset)
	$app_tips_grid->Recordset->Close();
?>
<?php if ($app_tips_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_tips_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_tips_grid->TotalRecs == 0 && $app_tips->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_tips_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_tips->Export == "") { ?>
<script type="text/javascript">
fapp_tipsgrid.Init();
</script>
<?php } ?>
<?php
$app_tips_grid->Page_Terminate();
?>
