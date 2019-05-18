<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_consultation_category_name_grid)) $app_consultation_category_name_grid = new capp_consultation_category_name_grid();

// Page init
$app_consultation_category_name_grid->Page_Init();

// Page main
$app_consultation_category_name_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consultation_category_name_grid->Page_Render();
?>
<?php if ($app_consultation_category_name->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_consultation_category_namegrid = new ew_Form("fapp_consultation_category_namegrid", "grid");
fapp_consultation_category_namegrid.FormKeyCountName = '<?php echo $app_consultation_category_name_grid->FormKeyCountName ?>';

// Validate form
fapp_consultation_category_namegrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_cat_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation_category_name->cat_name->FldCaption(), $app_consultation_category_name->cat_name->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_consultation_category_namegrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "cat_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cat_name", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_consultation_category_namegrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consultation_category_namegrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consultation_category_namegrid.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_consultation_category_namegrid.Lists["x_cat_id"].Data = "<?php echo $app_consultation_category_name_grid->cat_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_consultation_category_namegrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_consultation_category_namegrid.Lists["x_lang_id"].Data = "<?php echo $app_consultation_category_name_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_consultation_category_name->CurrentAction == "gridadd") {
	if ($app_consultation_category_name->CurrentMode == "copy") {
		$bSelectLimit = $app_consultation_category_name_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_consultation_category_name_grid->TotalRecs = $app_consultation_category_name->ListRecordCount();
			$app_consultation_category_name_grid->Recordset = $app_consultation_category_name_grid->LoadRecordset($app_consultation_category_name_grid->StartRec-1, $app_consultation_category_name_grid->DisplayRecs);
		} else {
			if ($app_consultation_category_name_grid->Recordset = $app_consultation_category_name_grid->LoadRecordset())
				$app_consultation_category_name_grid->TotalRecs = $app_consultation_category_name_grid->Recordset->RecordCount();
		}
		$app_consultation_category_name_grid->StartRec = 1;
		$app_consultation_category_name_grid->DisplayRecs = $app_consultation_category_name_grid->TotalRecs;
	} else {
		$app_consultation_category_name->CurrentFilter = "0=1";
		$app_consultation_category_name_grid->StartRec = 1;
		$app_consultation_category_name_grid->DisplayRecs = $app_consultation_category_name->GridAddRowCount;
	}
	$app_consultation_category_name_grid->TotalRecs = $app_consultation_category_name_grid->DisplayRecs;
	$app_consultation_category_name_grid->StopRec = $app_consultation_category_name_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_consultation_category_name_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_consultation_category_name_grid->TotalRecs <= 0)
			$app_consultation_category_name_grid->TotalRecs = $app_consultation_category_name->ListRecordCount();
	} else {
		if (!$app_consultation_category_name_grid->Recordset && ($app_consultation_category_name_grid->Recordset = $app_consultation_category_name_grid->LoadRecordset()))
			$app_consultation_category_name_grid->TotalRecs = $app_consultation_category_name_grid->Recordset->RecordCount();
	}
	$app_consultation_category_name_grid->StartRec = 1;
	$app_consultation_category_name_grid->DisplayRecs = $app_consultation_category_name_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_consultation_category_name_grid->Recordset = $app_consultation_category_name_grid->LoadRecordset($app_consultation_category_name_grid->StartRec-1, $app_consultation_category_name_grid->DisplayRecs);

	// Set no record found message
	if ($app_consultation_category_name->CurrentAction == "" && $app_consultation_category_name_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_consultation_category_name_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_consultation_category_name_grid->SearchWhere == "0=101")
			$app_consultation_category_name_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_consultation_category_name_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_consultation_category_name_grid->RenderOtherOptions();
?>
<?php $app_consultation_category_name_grid->ShowPageHeader(); ?>
<?php
$app_consultation_category_name_grid->ShowMessage();
?>
<?php if ($app_consultation_category_name_grid->TotalRecs > 0 || $app_consultation_category_name->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_consultation_category_name_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_consultation_category_name">
<div id="fapp_consultation_category_namegrid" class="ewForm ewListForm form-inline">
<?php if ($app_consultation_category_name_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_consultation_category_name_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_consultation_category_name" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_consultation_category_namegrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_consultation_category_name_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_consultation_category_name_grid->RenderListOptions();

// Render list options (header, left)
$app_consultation_category_name_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_consultation_category_name->ncat_id->Visible) { // ncat_id ?>
	<?php if ($app_consultation_category_name->SortUrl($app_consultation_category_name->ncat_id) == "") { ?>
		<th data-name="ncat_id" class="<?php echo $app_consultation_category_name->ncat_id->HeaderCellClass() ?>"><div id="elh_app_consultation_category_name_ncat_id" class="app_consultation_category_name_ncat_id"><div class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->ncat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ncat_id" class="<?php echo $app_consultation_category_name->ncat_id->HeaderCellClass() ?>"><div><div id="elh_app_consultation_category_name_ncat_id" class="app_consultation_category_name_ncat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->ncat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consultation_category_name->ncat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consultation_category_name->ncat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_consultation_category_name->cat_id->Visible) { // cat_id ?>
	<?php if ($app_consultation_category_name->SortUrl($app_consultation_category_name->cat_id) == "") { ?>
		<th data-name="cat_id" class="<?php echo $app_consultation_category_name->cat_id->HeaderCellClass() ?>"><div id="elh_app_consultation_category_name_cat_id" class="app_consultation_category_name_cat_id"><div class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->cat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_id" class="<?php echo $app_consultation_category_name->cat_id->HeaderCellClass() ?>"><div><div id="elh_app_consultation_category_name_cat_id" class="app_consultation_category_name_cat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->cat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consultation_category_name->cat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consultation_category_name->cat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_consultation_category_name->lang_id->Visible) { // lang_id ?>
	<?php if ($app_consultation_category_name->SortUrl($app_consultation_category_name->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_consultation_category_name->lang_id->HeaderCellClass() ?>"><div id="elh_app_consultation_category_name_lang_id" class="app_consultation_category_name_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_consultation_category_name->lang_id->HeaderCellClass() ?>"><div><div id="elh_app_consultation_category_name_lang_id" class="app_consultation_category_name_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consultation_category_name->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consultation_category_name->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_consultation_category_name->cat_name->Visible) { // cat_name ?>
	<?php if ($app_consultation_category_name->SortUrl($app_consultation_category_name->cat_name) == "") { ?>
		<th data-name="cat_name" class="<?php echo $app_consultation_category_name->cat_name->HeaderCellClass() ?>"><div id="elh_app_consultation_category_name_cat_name" class="app_consultation_category_name_cat_name"><div class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->cat_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_name" class="<?php echo $app_consultation_category_name->cat_name->HeaderCellClass() ?>"><div><div id="elh_app_consultation_category_name_cat_name" class="app_consultation_category_name_cat_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_consultation_category_name->cat_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_consultation_category_name->cat_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_consultation_category_name->cat_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_consultation_category_name_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_consultation_category_name_grid->StartRec = 1;
$app_consultation_category_name_grid->StopRec = $app_consultation_category_name_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_consultation_category_name_grid->FormKeyCountName) && ($app_consultation_category_name->CurrentAction == "gridadd" || $app_consultation_category_name->CurrentAction == "gridedit" || $app_consultation_category_name->CurrentAction == "F")) {
		$app_consultation_category_name_grid->KeyCount = $objForm->GetValue($app_consultation_category_name_grid->FormKeyCountName);
		$app_consultation_category_name_grid->StopRec = $app_consultation_category_name_grid->StartRec + $app_consultation_category_name_grid->KeyCount - 1;
	}
}
$app_consultation_category_name_grid->RecCnt = $app_consultation_category_name_grid->StartRec - 1;
if ($app_consultation_category_name_grid->Recordset && !$app_consultation_category_name_grid->Recordset->EOF) {
	$app_consultation_category_name_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_consultation_category_name_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_consultation_category_name_grid->StartRec > 1)
		$app_consultation_category_name_grid->Recordset->Move($app_consultation_category_name_grid->StartRec - 1);
} elseif (!$app_consultation_category_name->AllowAddDeleteRow && $app_consultation_category_name_grid->StopRec == 0) {
	$app_consultation_category_name_grid->StopRec = $app_consultation_category_name->GridAddRowCount;
}

// Initialize aggregate
$app_consultation_category_name->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_consultation_category_name->ResetAttrs();
$app_consultation_category_name_grid->RenderRow();
if ($app_consultation_category_name->CurrentAction == "gridadd")
	$app_consultation_category_name_grid->RowIndex = 0;
if ($app_consultation_category_name->CurrentAction == "gridedit")
	$app_consultation_category_name_grid->RowIndex = 0;
while ($app_consultation_category_name_grid->RecCnt < $app_consultation_category_name_grid->StopRec) {
	$app_consultation_category_name_grid->RecCnt++;
	if (intval($app_consultation_category_name_grid->RecCnt) >= intval($app_consultation_category_name_grid->StartRec)) {
		$app_consultation_category_name_grid->RowCnt++;
		if ($app_consultation_category_name->CurrentAction == "gridadd" || $app_consultation_category_name->CurrentAction == "gridedit" || $app_consultation_category_name->CurrentAction == "F") {
			$app_consultation_category_name_grid->RowIndex++;
			$objForm->Index = $app_consultation_category_name_grid->RowIndex;
			if ($objForm->HasValue($app_consultation_category_name_grid->FormActionName))
				$app_consultation_category_name_grid->RowAction = strval($objForm->GetValue($app_consultation_category_name_grid->FormActionName));
			elseif ($app_consultation_category_name->CurrentAction == "gridadd")
				$app_consultation_category_name_grid->RowAction = "insert";
			else
				$app_consultation_category_name_grid->RowAction = "";
		}

		// Set up key count
		$app_consultation_category_name_grid->KeyCount = $app_consultation_category_name_grid->RowIndex;

		// Init row class and style
		$app_consultation_category_name->ResetAttrs();
		$app_consultation_category_name->CssClass = "";
		if ($app_consultation_category_name->CurrentAction == "gridadd") {
			if ($app_consultation_category_name->CurrentMode == "copy") {
				$app_consultation_category_name_grid->LoadRowValues($app_consultation_category_name_grid->Recordset); // Load row values
				$app_consultation_category_name_grid->SetRecordKey($app_consultation_category_name_grid->RowOldKey, $app_consultation_category_name_grid->Recordset); // Set old record key
			} else {
				$app_consultation_category_name_grid->LoadRowValues(); // Load default values
				$app_consultation_category_name_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_consultation_category_name_grid->LoadRowValues($app_consultation_category_name_grid->Recordset); // Load row values
		}
		$app_consultation_category_name->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_consultation_category_name->CurrentAction == "gridadd") // Grid add
			$app_consultation_category_name->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_consultation_category_name->CurrentAction == "gridadd" && $app_consultation_category_name->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_consultation_category_name_grid->RestoreCurrentRowFormValues($app_consultation_category_name_grid->RowIndex); // Restore form values
		if ($app_consultation_category_name->CurrentAction == "gridedit") { // Grid edit
			if ($app_consultation_category_name->EventCancelled) {
				$app_consultation_category_name_grid->RestoreCurrentRowFormValues($app_consultation_category_name_grid->RowIndex); // Restore form values
			}
			if ($app_consultation_category_name_grid->RowAction == "insert")
				$app_consultation_category_name->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_consultation_category_name->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_consultation_category_name->CurrentAction == "gridedit" && ($app_consultation_category_name->RowType == EW_ROWTYPE_EDIT || $app_consultation_category_name->RowType == EW_ROWTYPE_ADD) && $app_consultation_category_name->EventCancelled) // Update failed
			$app_consultation_category_name_grid->RestoreCurrentRowFormValues($app_consultation_category_name_grid->RowIndex); // Restore form values
		if ($app_consultation_category_name->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_consultation_category_name_grid->EditRowCnt++;
		if ($app_consultation_category_name->CurrentAction == "F") // Confirm row
			$app_consultation_category_name_grid->RestoreCurrentRowFormValues($app_consultation_category_name_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_consultation_category_name->RowAttrs = array_merge($app_consultation_category_name->RowAttrs, array('data-rowindex'=>$app_consultation_category_name_grid->RowCnt, 'id'=>'r' . $app_consultation_category_name_grid->RowCnt . '_app_consultation_category_name', 'data-rowtype'=>$app_consultation_category_name->RowType));

		// Render row
		$app_consultation_category_name_grid->RenderRow();

		// Render list options
		$app_consultation_category_name_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_consultation_category_name_grid->RowAction <> "delete" && $app_consultation_category_name_grid->RowAction <> "insertdelete" && !($app_consultation_category_name_grid->RowAction == "insert" && $app_consultation_category_name->CurrentAction == "F" && $app_consultation_category_name_grid->EmptyRow())) {
?>
	<tr<?php echo $app_consultation_category_name->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_consultation_category_name_grid->ListOptions->Render("body", "left", $app_consultation_category_name_grid->RowCnt);
?>
	<?php if ($app_consultation_category_name->ncat_id->Visible) { // ncat_id ?>
		<td data-name="ncat_id"<?php echo $app_consultation_category_name->ncat_id->CellAttributes() ?>>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_ncat_id" class="form-group app_consultation_category_name_ncat_id">
<span<?php echo $app_consultation_category_name->ncat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->ncat_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->CurrentValue) ?>">
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_ncat_id" class="app_consultation_category_name_ncat_id">
<span<?php echo $app_consultation_category_name->ncat_id->ViewAttributes() ?>>
<?php echo $app_consultation_category_name->ncat_id->ListViewValue() ?></span>
</span>
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_consultation_category_name->cat_id->Visible) { // cat_id ?>
		<td data-name="cat_id"<?php echo $app_consultation_category_name->cat_id->CellAttributes() ?>>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_consultation_category_name->cat_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<span<?php echo $app_consultation_category_name->cat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->cat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<select data-table="app_consultation_category_name" data-field="x_cat_id" data-value-separator="<?php echo $app_consultation_category_name->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id"<?php echo $app_consultation_category_name->cat_id->EditAttributes() ?>>
<?php echo $app_consultation_category_name->cat_id->SelectOptionListHtml("x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_consultation_category_name->cat_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<span<?php echo $app_consultation_category_name->cat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->cat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<select data-table="app_consultation_category_name" data-field="x_cat_id" data-value-separator="<?php echo $app_consultation_category_name->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id"<?php echo $app_consultation_category_name->cat_id->EditAttributes() ?>>
<?php echo $app_consultation_category_name->cat_id->SelectOptionListHtml("x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_id" class="app_consultation_category_name_cat_id">
<span<?php echo $app_consultation_category_name->cat_id->ViewAttributes() ?>>
<?php echo $app_consultation_category_name->cat_id->ListViewValue() ?></span>
</span>
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_consultation_category_name->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_consultation_category_name->lang_id->CellAttributes() ?>>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_lang_id" class="form-group app_consultation_category_name_lang_id">
<select data-table="app_consultation_category_name" data-field="x_lang_id" data-value-separator="<?php echo $app_consultation_category_name->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id"<?php echo $app_consultation_category_name->lang_id->EditAttributes() ?>>
<?php echo $app_consultation_category_name->lang_id->SelectOptionListHtml("x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_lang_id" class="form-group app_consultation_category_name_lang_id">
<select data-table="app_consultation_category_name" data-field="x_lang_id" data-value-separator="<?php echo $app_consultation_category_name->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id"<?php echo $app_consultation_category_name->lang_id->EditAttributes() ?>>
<?php echo $app_consultation_category_name->lang_id->SelectOptionListHtml("x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_lang_id" class="app_consultation_category_name_lang_id">
<span<?php echo $app_consultation_category_name->lang_id->ViewAttributes() ?>>
<?php echo $app_consultation_category_name->lang_id->ListViewValue() ?></span>
</span>
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_consultation_category_name->cat_name->Visible) { // cat_name ?>
		<td data-name="cat_name"<?php echo $app_consultation_category_name->cat_name->CellAttributes() ?>>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_name" class="form-group app_consultation_category_name_cat_name">
<input type="text" data-table="app_consultation_category_name" data-field="x_cat_name" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->getPlaceHolder()) ?>" value="<?php echo $app_consultation_category_name->cat_name->EditValue ?>"<?php echo $app_consultation_category_name->cat_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->OldValue) ?>">
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_name" class="form-group app_consultation_category_name_cat_name">
<input type="text" data-table="app_consultation_category_name" data-field="x_cat_name" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->getPlaceHolder()) ?>" value="<?php echo $app_consultation_category_name->cat_name->EditValue ?>"<?php echo $app_consultation_category_name->cat_name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_consultation_category_name_grid->RowCnt ?>_app_consultation_category_name_cat_name" class="app_consultation_category_name_cat_name">
<span<?php echo $app_consultation_category_name->cat_name->ViewAttributes() ?>>
<?php echo $app_consultation_category_name->cat_name->ListViewValue() ?></span>
</span>
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="fapp_consultation_category_namegrid$x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->FormValue) ?>">
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="fapp_consultation_category_namegrid$o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_consultation_category_name_grid->ListOptions->Render("body", "right", $app_consultation_category_name_grid->RowCnt);
?>
	</tr>
<?php if ($app_consultation_category_name->RowType == EW_ROWTYPE_ADD || $app_consultation_category_name->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_consultation_category_namegrid.UpdateOpts(<?php echo $app_consultation_category_name_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_consultation_category_name->CurrentAction <> "gridadd" || $app_consultation_category_name->CurrentMode == "copy")
		if (!$app_consultation_category_name_grid->Recordset->EOF) $app_consultation_category_name_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_consultation_category_name->CurrentMode == "add" || $app_consultation_category_name->CurrentMode == "copy" || $app_consultation_category_name->CurrentMode == "edit") {
		$app_consultation_category_name_grid->RowIndex = '$rowindex$';
		$app_consultation_category_name_grid->LoadRowValues();

		// Set row properties
		$app_consultation_category_name->ResetAttrs();
		$app_consultation_category_name->RowAttrs = array_merge($app_consultation_category_name->RowAttrs, array('data-rowindex'=>$app_consultation_category_name_grid->RowIndex, 'id'=>'r0_app_consultation_category_name', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_consultation_category_name->RowAttrs["class"], "ewTemplate");
		$app_consultation_category_name->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_consultation_category_name_grid->RenderRow();

		// Render list options
		$app_consultation_category_name_grid->RenderListOptions();
		$app_consultation_category_name_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_consultation_category_name->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_consultation_category_name_grid->ListOptions->Render("body", "left", $app_consultation_category_name_grid->RowIndex);
?>
	<?php if ($app_consultation_category_name->ncat_id->Visible) { // ncat_id ?>
		<td data-name="ncat_id">
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_app_consultation_category_name_ncat_id" class="form-group app_consultation_category_name_ncat_id">
<span<?php echo $app_consultation_category_name->ncat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->ncat_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_ncat_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_ncat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->ncat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_consultation_category_name->cat_id->Visible) { // cat_id ?>
		<td data-name="cat_id">
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<?php if ($app_consultation_category_name->cat_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<span<?php echo $app_consultation_category_name->cat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->cat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<select data-table="app_consultation_category_name" data-field="x_cat_id" data-value-separator="<?php echo $app_consultation_category_name->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id"<?php echo $app_consultation_category_name->cat_id->EditAttributes() ?>>
<?php echo $app_consultation_category_name->cat_id->SelectOptionListHtml("x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_consultation_category_name_cat_id" class="form-group app_consultation_category_name_cat_id">
<span<?php echo $app_consultation_category_name->cat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->cat_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_consultation_category_name->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_consultation_category_name_lang_id" class="form-group app_consultation_category_name_lang_id">
<select data-table="app_consultation_category_name" data-field="x_lang_id" data-value-separator="<?php echo $app_consultation_category_name->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id"<?php echo $app_consultation_category_name->lang_id->EditAttributes() ?>>
<?php echo $app_consultation_category_name->lang_id->SelectOptionListHtml("x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_consultation_category_name_lang_id" class="form-group app_consultation_category_name_lang_id">
<span<?php echo $app_consultation_category_name->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_lang_id" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_consultation_category_name->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_consultation_category_name->cat_name->Visible) { // cat_name ?>
		<td data-name="cat_name">
<?php if ($app_consultation_category_name->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_consultation_category_name_cat_name" class="form-group app_consultation_category_name_cat_name">
<input type="text" data-table="app_consultation_category_name" data-field="x_cat_name" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->getPlaceHolder()) ?>" value="<?php echo $app_consultation_category_name->cat_name->EditValue ?>"<?php echo $app_consultation_category_name->cat_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_consultation_category_name_cat_name" class="form-group app_consultation_category_name_cat_name">
<span<?php echo $app_consultation_category_name->cat_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consultation_category_name->cat_name->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="x<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_consultation_category_name" data-field="x_cat_name" name="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" id="o<?php echo $app_consultation_category_name_grid->RowIndex ?>_cat_name" value="<?php echo ew_HtmlEncode($app_consultation_category_name->cat_name->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_consultation_category_name_grid->ListOptions->Render("body", "right", $app_consultation_category_name_grid->RowIndex);
?>
<script type="text/javascript">
fapp_consultation_category_namegrid.UpdateOpts(<?php echo $app_consultation_category_name_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_consultation_category_name->CurrentMode == "add" || $app_consultation_category_name->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_consultation_category_name_grid->FormKeyCountName ?>" id="<?php echo $app_consultation_category_name_grid->FormKeyCountName ?>" value="<?php echo $app_consultation_category_name_grid->KeyCount ?>">
<?php echo $app_consultation_category_name_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_consultation_category_name->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_consultation_category_name_grid->FormKeyCountName ?>" id="<?php echo $app_consultation_category_name_grid->FormKeyCountName ?>" value="<?php echo $app_consultation_category_name_grid->KeyCount ?>">
<?php echo $app_consultation_category_name_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_consultation_category_name->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_consultation_category_namegrid">
</div>
<?php

// Close recordset
if ($app_consultation_category_name_grid->Recordset)
	$app_consultation_category_name_grid->Recordset->Close();
?>
<?php if ($app_consultation_category_name_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_consultation_category_name_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_consultation_category_name_grid->TotalRecs == 0 && $app_consultation_category_name->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_consultation_category_name_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_consultation_category_name->Export == "") { ?>
<script type="text/javascript">
fapp_consultation_category_namegrid.Init();
</script>
<?php } ?>
<?php
$app_consultation_category_name_grid->Page_Terminate();
?>
