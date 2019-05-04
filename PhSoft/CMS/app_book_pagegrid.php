<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_book_page_grid)) $app_book_page_grid = new capp_book_page_grid();

// Page init
$app_book_page_grid->Page_Init();

// Page main
$app_book_page_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_book_page_grid->Page_Render();
?>
<?php if ($app_book_page->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_book_pagegrid = new ew_Form("fapp_book_pagegrid", "grid");
fapp_book_pagegrid.FormKeyCountName = '<?php echo $app_book_page_grid->FormKeyCountName ?>';

// Validate form
fapp_book_pagegrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_book_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->book_id->FldCaption(), $app_book_page->book_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_page_num");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->page_num->FldCaption(), $app_book_page->page_num->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_page_num");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_book_page->page_num->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_book_pagegrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "book_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "page_num", false)) return false;
	if (ew_ValueChanged(fobj, infix, "page_image", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_book_pagegrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_book_pagegrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_book_pagegrid.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_book_pagegrid.Lists["x_book_id"].Data = "<?php echo $app_book_page_grid->book_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_book_page->CurrentAction == "gridadd") {
	if ($app_book_page->CurrentMode == "copy") {
		$bSelectLimit = $app_book_page_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_book_page_grid->TotalRecs = $app_book_page->ListRecordCount();
			$app_book_page_grid->Recordset = $app_book_page_grid->LoadRecordset($app_book_page_grid->StartRec-1, $app_book_page_grid->DisplayRecs);
		} else {
			if ($app_book_page_grid->Recordset = $app_book_page_grid->LoadRecordset())
				$app_book_page_grid->TotalRecs = $app_book_page_grid->Recordset->RecordCount();
		}
		$app_book_page_grid->StartRec = 1;
		$app_book_page_grid->DisplayRecs = $app_book_page_grid->TotalRecs;
	} else {
		$app_book_page->CurrentFilter = "0=1";
		$app_book_page_grid->StartRec = 1;
		$app_book_page_grid->DisplayRecs = $app_book_page->GridAddRowCount;
	}
	$app_book_page_grid->TotalRecs = $app_book_page_grid->DisplayRecs;
	$app_book_page_grid->StopRec = $app_book_page_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_book_page_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_book_page_grid->TotalRecs <= 0)
			$app_book_page_grid->TotalRecs = $app_book_page->ListRecordCount();
	} else {
		if (!$app_book_page_grid->Recordset && ($app_book_page_grid->Recordset = $app_book_page_grid->LoadRecordset()))
			$app_book_page_grid->TotalRecs = $app_book_page_grid->Recordset->RecordCount();
	}
	$app_book_page_grid->StartRec = 1;
	$app_book_page_grid->DisplayRecs = $app_book_page_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_book_page_grid->Recordset = $app_book_page_grid->LoadRecordset($app_book_page_grid->StartRec-1, $app_book_page_grid->DisplayRecs);

	// Set no record found message
	if ($app_book_page->CurrentAction == "" && $app_book_page_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_book_page_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_book_page_grid->SearchWhere == "0=101")
			$app_book_page_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_book_page_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_book_page_grid->RenderOtherOptions();
?>
<?php $app_book_page_grid->ShowPageHeader(); ?>
<?php
$app_book_page_grid->ShowMessage();
?>
<?php if ($app_book_page_grid->TotalRecs > 0 || $app_book_page->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_book_page_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_book_page">
<div id="fapp_book_pagegrid" class="ewForm ewListForm form-inline">
<?php if ($app_book_page_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_book_page_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_book_page" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_book_pagegrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_book_page_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_book_page_grid->RenderListOptions();

// Render list options (header, left)
$app_book_page_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_book_page->book_id->Visible) { // book_id ?>
	<?php if ($app_book_page->SortUrl($app_book_page->book_id) == "") { ?>
		<th data-name="book_id" class="<?php echo $app_book_page->book_id->HeaderCellClass() ?>"><div id="elh_app_book_page_book_id" class="app_book_page_book_id"><div class="ewTableHeaderCaption"><?php echo $app_book_page->book_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="book_id" class="<?php echo $app_book_page->book_id->HeaderCellClass() ?>"><div><div id="elh_app_book_page_book_id" class="app_book_page_book_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_book_page->book_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_book_page->book_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_book_page->book_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_book_page->page_num->Visible) { // page_num ?>
	<?php if ($app_book_page->SortUrl($app_book_page->page_num) == "") { ?>
		<th data-name="page_num" class="<?php echo $app_book_page->page_num->HeaderCellClass() ?>"><div id="elh_app_book_page_page_num" class="app_book_page_page_num"><div class="ewTableHeaderCaption"><?php echo $app_book_page->page_num->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="page_num" class="<?php echo $app_book_page->page_num->HeaderCellClass() ?>"><div><div id="elh_app_book_page_page_num" class="app_book_page_page_num">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_book_page->page_num->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_book_page->page_num->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_book_page->page_num->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_book_page->page_image->Visible) { // page_image ?>
	<?php if ($app_book_page->SortUrl($app_book_page->page_image) == "") { ?>
		<th data-name="page_image" class="<?php echo $app_book_page->page_image->HeaderCellClass() ?>"><div id="elh_app_book_page_page_image" class="app_book_page_page_image"><div class="ewTableHeaderCaption"><?php echo $app_book_page->page_image->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="page_image" class="<?php echo $app_book_page->page_image->HeaderCellClass() ?>"><div><div id="elh_app_book_page_page_image" class="app_book_page_page_image">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_book_page->page_image->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_book_page->page_image->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_book_page->page_image->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_book_page_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_book_page_grid->StartRec = 1;
$app_book_page_grid->StopRec = $app_book_page_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_book_page_grid->FormKeyCountName) && ($app_book_page->CurrentAction == "gridadd" || $app_book_page->CurrentAction == "gridedit" || $app_book_page->CurrentAction == "F")) {
		$app_book_page_grid->KeyCount = $objForm->GetValue($app_book_page_grid->FormKeyCountName);
		$app_book_page_grid->StopRec = $app_book_page_grid->StartRec + $app_book_page_grid->KeyCount - 1;
	}
}
$app_book_page_grid->RecCnt = $app_book_page_grid->StartRec - 1;
if ($app_book_page_grid->Recordset && !$app_book_page_grid->Recordset->EOF) {
	$app_book_page_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_book_page_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_book_page_grid->StartRec > 1)
		$app_book_page_grid->Recordset->Move($app_book_page_grid->StartRec - 1);
} elseif (!$app_book_page->AllowAddDeleteRow && $app_book_page_grid->StopRec == 0) {
	$app_book_page_grid->StopRec = $app_book_page->GridAddRowCount;
}

// Initialize aggregate
$app_book_page->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_book_page->ResetAttrs();
$app_book_page_grid->RenderRow();
if ($app_book_page->CurrentAction == "gridadd")
	$app_book_page_grid->RowIndex = 0;
if ($app_book_page->CurrentAction == "gridedit")
	$app_book_page_grid->RowIndex = 0;
while ($app_book_page_grid->RecCnt < $app_book_page_grid->StopRec) {
	$app_book_page_grid->RecCnt++;
	if (intval($app_book_page_grid->RecCnt) >= intval($app_book_page_grid->StartRec)) {
		$app_book_page_grid->RowCnt++;
		if ($app_book_page->CurrentAction == "gridadd" || $app_book_page->CurrentAction == "gridedit" || $app_book_page->CurrentAction == "F") {
			$app_book_page_grid->RowIndex++;
			$objForm->Index = $app_book_page_grid->RowIndex;
			if ($objForm->HasValue($app_book_page_grid->FormActionName))
				$app_book_page_grid->RowAction = strval($objForm->GetValue($app_book_page_grid->FormActionName));
			elseif ($app_book_page->CurrentAction == "gridadd")
				$app_book_page_grid->RowAction = "insert";
			else
				$app_book_page_grid->RowAction = "";
		}

		// Set up key count
		$app_book_page_grid->KeyCount = $app_book_page_grid->RowIndex;

		// Init row class and style
		$app_book_page->ResetAttrs();
		$app_book_page->CssClass = "";
		if ($app_book_page->CurrentAction == "gridadd") {
			if ($app_book_page->CurrentMode == "copy") {
				$app_book_page_grid->LoadRowValues($app_book_page_grid->Recordset); // Load row values
				$app_book_page_grid->SetRecordKey($app_book_page_grid->RowOldKey, $app_book_page_grid->Recordset); // Set old record key
			} else {
				$app_book_page_grid->LoadRowValues(); // Load default values
				$app_book_page_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_book_page_grid->LoadRowValues($app_book_page_grid->Recordset); // Load row values
		}
		$app_book_page->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_book_page->CurrentAction == "gridadd") // Grid add
			$app_book_page->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_book_page->CurrentAction == "gridadd" && $app_book_page->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_book_page_grid->RestoreCurrentRowFormValues($app_book_page_grid->RowIndex); // Restore form values
		if ($app_book_page->CurrentAction == "gridedit") { // Grid edit
			if ($app_book_page->EventCancelled) {
				$app_book_page_grid->RestoreCurrentRowFormValues($app_book_page_grid->RowIndex); // Restore form values
			}
			if ($app_book_page_grid->RowAction == "insert")
				$app_book_page->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_book_page->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_book_page->CurrentAction == "gridedit" && ($app_book_page->RowType == EW_ROWTYPE_EDIT || $app_book_page->RowType == EW_ROWTYPE_ADD) && $app_book_page->EventCancelled) // Update failed
			$app_book_page_grid->RestoreCurrentRowFormValues($app_book_page_grid->RowIndex); // Restore form values
		if ($app_book_page->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_book_page_grid->EditRowCnt++;
		if ($app_book_page->CurrentAction == "F") // Confirm row
			$app_book_page_grid->RestoreCurrentRowFormValues($app_book_page_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_book_page->RowAttrs = array_merge($app_book_page->RowAttrs, array('data-rowindex'=>$app_book_page_grid->RowCnt, 'id'=>'r' . $app_book_page_grid->RowCnt . '_app_book_page', 'data-rowtype'=>$app_book_page->RowType));

		// Render row
		$app_book_page_grid->RenderRow();

		// Render list options
		$app_book_page_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_book_page_grid->RowAction <> "delete" && $app_book_page_grid->RowAction <> "insertdelete" && !($app_book_page_grid->RowAction == "insert" && $app_book_page->CurrentAction == "F" && $app_book_page_grid->EmptyRow())) {
?>
	<tr<?php echo $app_book_page->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_book_page_grid->ListOptions->Render("body", "left", $app_book_page_grid->RowCnt);
?>
	<?php if ($app_book_page->book_id->Visible) { // book_id ?>
		<td data-name="book_id"<?php echo $app_book_page->book_id->CellAttributes() ?>>
<?php if ($app_book_page->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_book_page->book_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_book_id" class="form-group app_book_page_book_id">
<span<?php echo $app_book_page->book_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_book_page->book_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_book_id" class="form-group app_book_page_book_id">
<select data-table="app_book_page" data-field="x_book_id" data-value-separator="<?php echo $app_book_page->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id"<?php echo $app_book_page->book_id->EditAttributes() ?>>
<?php echo $app_book_page->book_id->SelectOptionListHtml("x<?php echo $app_book_page_grid->RowIndex ?>_book_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="o<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="o<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->OldValue) ?>">
<?php } ?>
<?php if ($app_book_page->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_book_page->book_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_book_id" class="form-group app_book_page_book_id">
<span<?php echo $app_book_page->book_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_book_page->book_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_book_id" class="form-group app_book_page_book_id">
<select data-table="app_book_page" data-field="x_book_id" data-value-separator="<?php echo $app_book_page->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id"<?php echo $app_book_page->book_id->EditAttributes() ?>>
<?php echo $app_book_page->book_id->SelectOptionListHtml("x<?php echo $app_book_page_grid->RowIndex ?>_book_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_book_page->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_book_id" class="app_book_page_book_id">
<span<?php echo $app_book_page->book_id->ViewAttributes() ?>>
<?php echo $app_book_page->book_id->ListViewValue() ?></span>
</span>
<?php if ($app_book_page->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->FormValue) ?>">
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="o<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="o<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="fapp_book_pagegrid$x<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="fapp_book_pagegrid$x<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->FormValue) ?>">
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="fapp_book_pagegrid$o<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="fapp_book_pagegrid$o<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_book_page->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_book_page" data-field="x_bpage_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_bpage_id" id="x<?php echo $app_book_page_grid->RowIndex ?>_bpage_id" value="<?php echo ew_HtmlEncode($app_book_page->bpage_id->CurrentValue) ?>">
<input type="hidden" data-table="app_book_page" data-field="x_bpage_id" name="o<?php echo $app_book_page_grid->RowIndex ?>_bpage_id" id="o<?php echo $app_book_page_grid->RowIndex ?>_bpage_id" value="<?php echo ew_HtmlEncode($app_book_page->bpage_id->OldValue) ?>">
<?php } ?>
<?php if ($app_book_page->RowType == EW_ROWTYPE_EDIT || $app_book_page->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_book_page" data-field="x_bpage_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_bpage_id" id="x<?php echo $app_book_page_grid->RowIndex ?>_bpage_id" value="<?php echo ew_HtmlEncode($app_book_page->bpage_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_book_page->page_num->Visible) { // page_num ?>
		<td data-name="page_num"<?php echo $app_book_page->page_num->CellAttributes() ?>>
<?php if ($app_book_page->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_page_num" class="form-group app_book_page_page_num">
<input type="text" data-table="app_book_page" data-field="x_page_num" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_num->getPlaceHolder()) ?>" value="<?php echo $app_book_page->page_num->EditValue ?>"<?php echo $app_book_page->page_num->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="o<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="o<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->OldValue) ?>">
<?php } ?>
<?php if ($app_book_page->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_page_num" class="form-group app_book_page_page_num">
<input type="text" data-table="app_book_page" data-field="x_page_num" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_num->getPlaceHolder()) ?>" value="<?php echo $app_book_page->page_num->EditValue ?>"<?php echo $app_book_page->page_num->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_book_page->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_page_num" class="app_book_page_page_num">
<span<?php echo $app_book_page->page_num->ViewAttributes() ?>>
<?php echo $app_book_page->page_num->ListViewValue() ?></span>
</span>
<?php if ($app_book_page->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->FormValue) ?>">
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="o<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="o<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="fapp_book_pagegrid$x<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="fapp_book_pagegrid$x<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->FormValue) ?>">
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="fapp_book_pagegrid$o<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="fapp_book_pagegrid$o<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_book_page->page_image->Visible) { // page_image ?>
		<td data-name="page_image"<?php echo $app_book_page->page_image->CellAttributes() ?>>
<?php if ($app_book_page_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_app_book_page_page_image" class="form-group app_book_page_page_image">
<div id="fd_x<?php echo $app_book_page_grid->RowIndex ?>_page_image">
<span title="<?php echo $app_book_page->page_image->FldTitle() ? $app_book_page->page_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_book_page->page_image->ReadOnly || $app_book_page->page_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_book_page" data-field="x_page_image" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_image"<?php echo $app_book_page->page_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fn_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="0">
<input type="hidden" name="fs_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fs_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="200">
<input type="hidden" name="fx_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fx_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fm_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="app_book_page" data-field="x_page_image" name="o<?php echo $app_book_page_grid->RowIndex ?>_page_image" id="o<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo ew_HtmlEncode($app_book_page->page_image->OldValue) ?>">
<?php } elseif ($app_book_page->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_page_image" class="app_book_page_page_image">
<span>
<?php echo ew_GetFileViewTag($app_book_page->page_image, $app_book_page->page_image->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $app_book_page_grid->RowCnt ?>_app_book_page_page_image" class="form-group app_book_page_page_image">
<div id="fd_x<?php echo $app_book_page_grid->RowIndex ?>_page_image">
<span title="<?php echo $app_book_page->page_image->FldTitle() ? $app_book_page->page_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_book_page->page_image->ReadOnly || $app_book_page->page_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_book_page" data-field="x_page_image" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_image"<?php echo $app_book_page->page_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fn_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fs_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="200">
<input type="hidden" name="fx_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fx_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fm_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_book_page_grid->ListOptions->Render("body", "right", $app_book_page_grid->RowCnt);
?>
	</tr>
<?php if ($app_book_page->RowType == EW_ROWTYPE_ADD || $app_book_page->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_book_pagegrid.UpdateOpts(<?php echo $app_book_page_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_book_page->CurrentAction <> "gridadd" || $app_book_page->CurrentMode == "copy")
		if (!$app_book_page_grid->Recordset->EOF) $app_book_page_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_book_page->CurrentMode == "add" || $app_book_page->CurrentMode == "copy" || $app_book_page->CurrentMode == "edit") {
		$app_book_page_grid->RowIndex = '$rowindex$';
		$app_book_page_grid->LoadRowValues();

		// Set row properties
		$app_book_page->ResetAttrs();
		$app_book_page->RowAttrs = array_merge($app_book_page->RowAttrs, array('data-rowindex'=>$app_book_page_grid->RowIndex, 'id'=>'r0_app_book_page', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_book_page->RowAttrs["class"], "ewTemplate");
		$app_book_page->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_book_page_grid->RenderRow();

		// Render list options
		$app_book_page_grid->RenderListOptions();
		$app_book_page_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_book_page->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_book_page_grid->ListOptions->Render("body", "left", $app_book_page_grid->RowIndex);
?>
	<?php if ($app_book_page->book_id->Visible) { // book_id ?>
		<td data-name="book_id">
<?php if ($app_book_page->CurrentAction <> "F") { ?>
<?php if ($app_book_page->book_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_book_page_book_id" class="form-group app_book_page_book_id">
<span<?php echo $app_book_page->book_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_book_page->book_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_book_page_book_id" class="form-group app_book_page_book_id">
<select data-table="app_book_page" data-field="x_book_id" data-value-separator="<?php echo $app_book_page->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id"<?php echo $app_book_page->book_id->EditAttributes() ?>>
<?php echo $app_book_page->book_id->SelectOptionListHtml("x<?php echo $app_book_page_grid->RowIndex ?>_book_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_book_page_book_id" class="form-group app_book_page_book_id">
<span<?php echo $app_book_page->book_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_book_page->book_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="x<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_book_page" data-field="x_book_id" name="o<?php echo $app_book_page_grid->RowIndex ?>_book_id" id="o<?php echo $app_book_page_grid->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_book_page->page_num->Visible) { // page_num ?>
		<td data-name="page_num">
<?php if ($app_book_page->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_book_page_page_num" class="form-group app_book_page_page_num">
<input type="text" data-table="app_book_page" data-field="x_page_num" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_num->getPlaceHolder()) ?>" value="<?php echo $app_book_page->page_num->EditValue ?>"<?php echo $app_book_page->page_num->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_book_page_page_num" class="form-group app_book_page_page_num">
<span<?php echo $app_book_page->page_num->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_book_page->page_num->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_book_page" data-field="x_page_num" name="o<?php echo $app_book_page_grid->RowIndex ?>_page_num" id="o<?php echo $app_book_page_grid->RowIndex ?>_page_num" value="<?php echo ew_HtmlEncode($app_book_page->page_num->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_book_page->page_image->Visible) { // page_image ?>
		<td data-name="page_image">
<span id="el$rowindex$_app_book_page_page_image" class="form-group app_book_page_page_image">
<div id="fd_x<?php echo $app_book_page_grid->RowIndex ?>_page_image">
<span title="<?php echo $app_book_page->page_image->FldTitle() ? $app_book_page->page_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_book_page->page_image->ReadOnly || $app_book_page->page_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_book_page" data-field="x_page_image" name="x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id="x<?php echo $app_book_page_grid->RowIndex ?>_page_image"<?php echo $app_book_page->page_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fn_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fa_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="0">
<input type="hidden" name="fs_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fs_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="200">
<input type="hidden" name="fx_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fx_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" id= "fm_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo $app_book_page->page_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $app_book_page_grid->RowIndex ?>_page_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="app_book_page" data-field="x_page_image" name="o<?php echo $app_book_page_grid->RowIndex ?>_page_image" id="o<?php echo $app_book_page_grid->RowIndex ?>_page_image" value="<?php echo ew_HtmlEncode($app_book_page->page_image->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_book_page_grid->ListOptions->Render("body", "right", $app_book_page_grid->RowIndex);
?>
<script type="text/javascript">
fapp_book_pagegrid.UpdateOpts(<?php echo $app_book_page_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_book_page->CurrentMode == "add" || $app_book_page->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_book_page_grid->FormKeyCountName ?>" id="<?php echo $app_book_page_grid->FormKeyCountName ?>" value="<?php echo $app_book_page_grid->KeyCount ?>">
<?php echo $app_book_page_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_book_page->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_book_page_grid->FormKeyCountName ?>" id="<?php echo $app_book_page_grid->FormKeyCountName ?>" value="<?php echo $app_book_page_grid->KeyCount ?>">
<?php echo $app_book_page_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_book_page->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_book_pagegrid">
</div>
<?php

// Close recordset
if ($app_book_page_grid->Recordset)
	$app_book_page_grid->Recordset->Close();
?>
<?php if ($app_book_page_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_book_page_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_book_page_grid->TotalRecs == 0 && $app_book_page->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_book_page_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_book_page->Export == "") { ?>
<script type="text/javascript">
fapp_book_pagegrid.Init();
</script>
<?php } ?>
<?php
$app_book_page_grid->Page_Terminate();
?>
