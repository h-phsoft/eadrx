<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_tips_pkg_cat_grid)) $app_tips_pkg_cat_grid = new capp_tips_pkg_cat_grid();

// Page init
$app_tips_pkg_cat_grid->Page_Init();

// Page main
$app_tips_pkg_cat_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_tips_pkg_cat_grid->Page_Render();
?>
<?php if ($app_tips_pkg_cat->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_tips_pkg_catgrid = new ew_Form("fapp_tips_pkg_catgrid", "grid");
fapp_tips_pkg_catgrid.FormKeyCountName = '<?php echo $app_tips_pkg_cat_grid->FormKeyCountName ?>';

// Validate form
fapp_tips_pkg_catgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_pkg_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips_pkg_cat->pkg_id->FldCaption(), $app_tips_pkg_cat->pkg_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tcat_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips_pkg_cat->tcat_id->FldCaption(), $app_tips_pkg_cat->tcat_id->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_tips_pkg_catgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "pkg_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tcat_id", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_tips_pkg_catgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_tips_pkg_catgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_tips_pkg_catgrid.Lists["x_pkg_id"] = {"LinkField":"x_pkg_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pkg_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_package"};
fapp_tips_pkg_catgrid.Lists["x_pkg_id"].Data = "<?php echo $app_tips_pkg_cat_grid->pkg_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_tips_pkg_catgrid.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_tips_pkg_catgrid.Lists["x_tcat_id"].Data = "<?php echo $app_tips_pkg_cat_grid->tcat_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_tips_pkg_cat->CurrentAction == "gridadd") {
	if ($app_tips_pkg_cat->CurrentMode == "copy") {
		$bSelectLimit = $app_tips_pkg_cat_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_tips_pkg_cat_grid->TotalRecs = $app_tips_pkg_cat->ListRecordCount();
			$app_tips_pkg_cat_grid->Recordset = $app_tips_pkg_cat_grid->LoadRecordset($app_tips_pkg_cat_grid->StartRec-1, $app_tips_pkg_cat_grid->DisplayRecs);
		} else {
			if ($app_tips_pkg_cat_grid->Recordset = $app_tips_pkg_cat_grid->LoadRecordset())
				$app_tips_pkg_cat_grid->TotalRecs = $app_tips_pkg_cat_grid->Recordset->RecordCount();
		}
		$app_tips_pkg_cat_grid->StartRec = 1;
		$app_tips_pkg_cat_grid->DisplayRecs = $app_tips_pkg_cat_grid->TotalRecs;
	} else {
		$app_tips_pkg_cat->CurrentFilter = "0=1";
		$app_tips_pkg_cat_grid->StartRec = 1;
		$app_tips_pkg_cat_grid->DisplayRecs = $app_tips_pkg_cat->GridAddRowCount;
	}
	$app_tips_pkg_cat_grid->TotalRecs = $app_tips_pkg_cat_grid->DisplayRecs;
	$app_tips_pkg_cat_grid->StopRec = $app_tips_pkg_cat_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_tips_pkg_cat_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_tips_pkg_cat_grid->TotalRecs <= 0)
			$app_tips_pkg_cat_grid->TotalRecs = $app_tips_pkg_cat->ListRecordCount();
	} else {
		if (!$app_tips_pkg_cat_grid->Recordset && ($app_tips_pkg_cat_grid->Recordset = $app_tips_pkg_cat_grid->LoadRecordset()))
			$app_tips_pkg_cat_grid->TotalRecs = $app_tips_pkg_cat_grid->Recordset->RecordCount();
	}
	$app_tips_pkg_cat_grid->StartRec = 1;
	$app_tips_pkg_cat_grid->DisplayRecs = $app_tips_pkg_cat_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_tips_pkg_cat_grid->Recordset = $app_tips_pkg_cat_grid->LoadRecordset($app_tips_pkg_cat_grid->StartRec-1, $app_tips_pkg_cat_grid->DisplayRecs);

	// Set no record found message
	if ($app_tips_pkg_cat->CurrentAction == "" && $app_tips_pkg_cat_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_tips_pkg_cat_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_tips_pkg_cat_grid->SearchWhere == "0=101")
			$app_tips_pkg_cat_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_tips_pkg_cat_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_tips_pkg_cat_grid->RenderOtherOptions();
?>
<?php $app_tips_pkg_cat_grid->ShowPageHeader(); ?>
<?php
$app_tips_pkg_cat_grid->ShowMessage();
?>
<?php if ($app_tips_pkg_cat_grid->TotalRecs > 0 || $app_tips_pkg_cat->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_tips_pkg_cat_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_tips_pkg_cat">
<div id="fapp_tips_pkg_catgrid" class="ewForm ewListForm form-inline">
<?php if ($app_tips_pkg_cat_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_tips_pkg_cat_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_tips_pkg_cat" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_tips_pkg_catgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_tips_pkg_cat_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_tips_pkg_cat_grid->RenderListOptions();

// Render list options (header, left)
$app_tips_pkg_cat_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_tips_pkg_cat->pkg_id->Visible) { // pkg_id ?>
	<?php if ($app_tips_pkg_cat->SortUrl($app_tips_pkg_cat->pkg_id) == "") { ?>
		<th data-name="pkg_id" class="<?php echo $app_tips_pkg_cat->pkg_id->HeaderCellClass() ?>"><div id="elh_app_tips_pkg_cat_pkg_id" class="app_tips_pkg_cat_pkg_id"><div class="ewTableHeaderCaption"><?php echo $app_tips_pkg_cat->pkg_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pkg_id" class="<?php echo $app_tips_pkg_cat->pkg_id->HeaderCellClass() ?>"><div><div id="elh_app_tips_pkg_cat_pkg_id" class="app_tips_pkg_cat_pkg_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips_pkg_cat->pkg_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips_pkg_cat->pkg_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips_pkg_cat->pkg_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_tips_pkg_cat->tcat_id->Visible) { // tcat_id ?>
	<?php if ($app_tips_pkg_cat->SortUrl($app_tips_pkg_cat->tcat_id) == "") { ?>
		<th data-name="tcat_id" class="<?php echo $app_tips_pkg_cat->tcat_id->HeaderCellClass() ?>"><div id="elh_app_tips_pkg_cat_tcat_id" class="app_tips_pkg_cat_tcat_id"><div class="ewTableHeaderCaption"><?php echo $app_tips_pkg_cat->tcat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tcat_id" class="<?php echo $app_tips_pkg_cat->tcat_id->HeaderCellClass() ?>"><div><div id="elh_app_tips_pkg_cat_tcat_id" class="app_tips_pkg_cat_tcat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_tips_pkg_cat->tcat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_tips_pkg_cat->tcat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_tips_pkg_cat->tcat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_tips_pkg_cat_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_tips_pkg_cat_grid->StartRec = 1;
$app_tips_pkg_cat_grid->StopRec = $app_tips_pkg_cat_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_tips_pkg_cat_grid->FormKeyCountName) && ($app_tips_pkg_cat->CurrentAction == "gridadd" || $app_tips_pkg_cat->CurrentAction == "gridedit" || $app_tips_pkg_cat->CurrentAction == "F")) {
		$app_tips_pkg_cat_grid->KeyCount = $objForm->GetValue($app_tips_pkg_cat_grid->FormKeyCountName);
		$app_tips_pkg_cat_grid->StopRec = $app_tips_pkg_cat_grid->StartRec + $app_tips_pkg_cat_grid->KeyCount - 1;
	}
}
$app_tips_pkg_cat_grid->RecCnt = $app_tips_pkg_cat_grid->StartRec - 1;
if ($app_tips_pkg_cat_grid->Recordset && !$app_tips_pkg_cat_grid->Recordset->EOF) {
	$app_tips_pkg_cat_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_tips_pkg_cat_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_tips_pkg_cat_grid->StartRec > 1)
		$app_tips_pkg_cat_grid->Recordset->Move($app_tips_pkg_cat_grid->StartRec - 1);
} elseif (!$app_tips_pkg_cat->AllowAddDeleteRow && $app_tips_pkg_cat_grid->StopRec == 0) {
	$app_tips_pkg_cat_grid->StopRec = $app_tips_pkg_cat->GridAddRowCount;
}

// Initialize aggregate
$app_tips_pkg_cat->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_tips_pkg_cat->ResetAttrs();
$app_tips_pkg_cat_grid->RenderRow();
if ($app_tips_pkg_cat->CurrentAction == "gridadd")
	$app_tips_pkg_cat_grid->RowIndex = 0;
if ($app_tips_pkg_cat->CurrentAction == "gridedit")
	$app_tips_pkg_cat_grid->RowIndex = 0;
while ($app_tips_pkg_cat_grid->RecCnt < $app_tips_pkg_cat_grid->StopRec) {
	$app_tips_pkg_cat_grid->RecCnt++;
	if (intval($app_tips_pkg_cat_grid->RecCnt) >= intval($app_tips_pkg_cat_grid->StartRec)) {
		$app_tips_pkg_cat_grid->RowCnt++;
		if ($app_tips_pkg_cat->CurrentAction == "gridadd" || $app_tips_pkg_cat->CurrentAction == "gridedit" || $app_tips_pkg_cat->CurrentAction == "F") {
			$app_tips_pkg_cat_grid->RowIndex++;
			$objForm->Index = $app_tips_pkg_cat_grid->RowIndex;
			if ($objForm->HasValue($app_tips_pkg_cat_grid->FormActionName))
				$app_tips_pkg_cat_grid->RowAction = strval($objForm->GetValue($app_tips_pkg_cat_grid->FormActionName));
			elseif ($app_tips_pkg_cat->CurrentAction == "gridadd")
				$app_tips_pkg_cat_grid->RowAction = "insert";
			else
				$app_tips_pkg_cat_grid->RowAction = "";
		}

		// Set up key count
		$app_tips_pkg_cat_grid->KeyCount = $app_tips_pkg_cat_grid->RowIndex;

		// Init row class and style
		$app_tips_pkg_cat->ResetAttrs();
		$app_tips_pkg_cat->CssClass = "";
		if ($app_tips_pkg_cat->CurrentAction == "gridadd") {
			if ($app_tips_pkg_cat->CurrentMode == "copy") {
				$app_tips_pkg_cat_grid->LoadRowValues($app_tips_pkg_cat_grid->Recordset); // Load row values
				$app_tips_pkg_cat_grid->SetRecordKey($app_tips_pkg_cat_grid->RowOldKey, $app_tips_pkg_cat_grid->Recordset); // Set old record key
			} else {
				$app_tips_pkg_cat_grid->LoadRowValues(); // Load default values
				$app_tips_pkg_cat_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_tips_pkg_cat_grid->LoadRowValues($app_tips_pkg_cat_grid->Recordset); // Load row values
		}
		$app_tips_pkg_cat->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_tips_pkg_cat->CurrentAction == "gridadd") // Grid add
			$app_tips_pkg_cat->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_tips_pkg_cat->CurrentAction == "gridadd" && $app_tips_pkg_cat->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_tips_pkg_cat_grid->RestoreCurrentRowFormValues($app_tips_pkg_cat_grid->RowIndex); // Restore form values
		if ($app_tips_pkg_cat->CurrentAction == "gridedit") { // Grid edit
			if ($app_tips_pkg_cat->EventCancelled) {
				$app_tips_pkg_cat_grid->RestoreCurrentRowFormValues($app_tips_pkg_cat_grid->RowIndex); // Restore form values
			}
			if ($app_tips_pkg_cat_grid->RowAction == "insert")
				$app_tips_pkg_cat->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_tips_pkg_cat->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_tips_pkg_cat->CurrentAction == "gridedit" && ($app_tips_pkg_cat->RowType == EW_ROWTYPE_EDIT || $app_tips_pkg_cat->RowType == EW_ROWTYPE_ADD) && $app_tips_pkg_cat->EventCancelled) // Update failed
			$app_tips_pkg_cat_grid->RestoreCurrentRowFormValues($app_tips_pkg_cat_grid->RowIndex); // Restore form values
		if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_tips_pkg_cat_grid->EditRowCnt++;
		if ($app_tips_pkg_cat->CurrentAction == "F") // Confirm row
			$app_tips_pkg_cat_grid->RestoreCurrentRowFormValues($app_tips_pkg_cat_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_tips_pkg_cat->RowAttrs = array_merge($app_tips_pkg_cat->RowAttrs, array('data-rowindex'=>$app_tips_pkg_cat_grid->RowCnt, 'id'=>'r' . $app_tips_pkg_cat_grid->RowCnt . '_app_tips_pkg_cat', 'data-rowtype'=>$app_tips_pkg_cat->RowType));

		// Render row
		$app_tips_pkg_cat_grid->RenderRow();

		// Render list options
		$app_tips_pkg_cat_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_tips_pkg_cat_grid->RowAction <> "delete" && $app_tips_pkg_cat_grid->RowAction <> "insertdelete" && !($app_tips_pkg_cat_grid->RowAction == "insert" && $app_tips_pkg_cat->CurrentAction == "F" && $app_tips_pkg_cat_grid->EmptyRow())) {
?>
	<tr<?php echo $app_tips_pkg_cat->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_tips_pkg_cat_grid->ListOptions->Render("body", "left", $app_tips_pkg_cat_grid->RowCnt);
?>
	<?php if ($app_tips_pkg_cat->pkg_id->Visible) { // pkg_id ?>
		<td data-name="pkg_id"<?php echo $app_tips_pkg_cat->pkg_id->CellAttributes() ?>>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_tips_pkg_cat->pkg_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<span<?php echo $app_tips_pkg_cat->pkg_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips_pkg_cat->pkg_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<select data-table="app_tips_pkg_cat" data-field="x_pkg_id" data-value-separator="<?php echo $app_tips_pkg_cat->pkg_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id"<?php echo $app_tips_pkg_cat->pkg_id->EditAttributes() ?>>
<?php echo $app_tips_pkg_cat->pkg_id->SelectOptionListHtml("x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_tips_pkg_cat->pkg_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<span<?php echo $app_tips_pkg_cat->pkg_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips_pkg_cat->pkg_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<select data-table="app_tips_pkg_cat" data-field="x_pkg_id" data-value-separator="<?php echo $app_tips_pkg_cat->pkg_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id"<?php echo $app_tips_pkg_cat->pkg_id->EditAttributes() ?>>
<?php echo $app_tips_pkg_cat->pkg_id->SelectOptionListHtml("x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_pkg_id" class="app_tips_pkg_cat_pkg_id">
<span<?php echo $app_tips_pkg_cat->pkg_id->ViewAttributes() ?>>
<?php echo $app_tips_pkg_cat->pkg_id->ListViewValue() ?></span>
</span>
<?php if ($app_tips_pkg_cat->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->FormValue) ?>">
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="fapp_tips_pkg_catgrid$x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="fapp_tips_pkg_catgrid$x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->FormValue) ?>">
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="fapp_tips_pkg_catgrid$o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="fapp_tips_pkg_catgrid$o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tpkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tpkg_id->CurrentValue) ?>">
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tpkg_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tpkg_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tpkg_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_EDIT || $app_tips_pkg_cat->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tpkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tpkg_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_tips_pkg_cat->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id"<?php echo $app_tips_pkg_cat->tcat_id->CellAttributes() ?>>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_tcat_id" class="form-group app_tips_pkg_cat_tcat_id">
<select data-table="app_tips_pkg_cat" data-field="x_tcat_id" data-value-separator="<?php echo $app_tips_pkg_cat->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id"<?php echo $app_tips_pkg_cat->tcat_id->EditAttributes() ?>>
<?php echo $app_tips_pkg_cat->tcat_id->SelectOptionListHtml("x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_tcat_id" class="form-group app_tips_pkg_cat_tcat_id">
<select data-table="app_tips_pkg_cat" data-field="x_tcat_id" data-value-separator="<?php echo $app_tips_pkg_cat->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id"<?php echo $app_tips_pkg_cat->tcat_id->EditAttributes() ?>>
<?php echo $app_tips_pkg_cat->tcat_id->SelectOptionListHtml("x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_tips_pkg_cat_grid->RowCnt ?>_app_tips_pkg_cat_tcat_id" class="app_tips_pkg_cat_tcat_id">
<span<?php echo $app_tips_pkg_cat->tcat_id->ViewAttributes() ?>>
<?php echo $app_tips_pkg_cat->tcat_id->ListViewValue() ?></span>
</span>
<?php if ($app_tips_pkg_cat->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->FormValue) ?>">
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="fapp_tips_pkg_catgrid$x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="fapp_tips_pkg_catgrid$x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->FormValue) ?>">
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="fapp_tips_pkg_catgrid$o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="fapp_tips_pkg_catgrid$o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_tips_pkg_cat_grid->ListOptions->Render("body", "right", $app_tips_pkg_cat_grid->RowCnt);
?>
	</tr>
<?php if ($app_tips_pkg_cat->RowType == EW_ROWTYPE_ADD || $app_tips_pkg_cat->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_tips_pkg_catgrid.UpdateOpts(<?php echo $app_tips_pkg_cat_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_tips_pkg_cat->CurrentAction <> "gridadd" || $app_tips_pkg_cat->CurrentMode == "copy")
		if (!$app_tips_pkg_cat_grid->Recordset->EOF) $app_tips_pkg_cat_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_tips_pkg_cat->CurrentMode == "add" || $app_tips_pkg_cat->CurrentMode == "copy" || $app_tips_pkg_cat->CurrentMode == "edit") {
		$app_tips_pkg_cat_grid->RowIndex = '$rowindex$';
		$app_tips_pkg_cat_grid->LoadRowValues();

		// Set row properties
		$app_tips_pkg_cat->ResetAttrs();
		$app_tips_pkg_cat->RowAttrs = array_merge($app_tips_pkg_cat->RowAttrs, array('data-rowindex'=>$app_tips_pkg_cat_grid->RowIndex, 'id'=>'r0_app_tips_pkg_cat', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_tips_pkg_cat->RowAttrs["class"], "ewTemplate");
		$app_tips_pkg_cat->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_tips_pkg_cat_grid->RenderRow();

		// Render list options
		$app_tips_pkg_cat_grid->RenderListOptions();
		$app_tips_pkg_cat_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_tips_pkg_cat->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_tips_pkg_cat_grid->ListOptions->Render("body", "left", $app_tips_pkg_cat_grid->RowIndex);
?>
	<?php if ($app_tips_pkg_cat->pkg_id->Visible) { // pkg_id ?>
		<td data-name="pkg_id">
<?php if ($app_tips_pkg_cat->CurrentAction <> "F") { ?>
<?php if ($app_tips_pkg_cat->pkg_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<span<?php echo $app_tips_pkg_cat->pkg_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips_pkg_cat->pkg_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<select data-table="app_tips_pkg_cat" data-field="x_pkg_id" data-value-separator="<?php echo $app_tips_pkg_cat->pkg_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id"<?php echo $app_tips_pkg_cat->pkg_id->EditAttributes() ?>>
<?php echo $app_tips_pkg_cat->pkg_id->SelectOptionListHtml("x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_tips_pkg_cat_pkg_id" class="form-group app_tips_pkg_cat_pkg_id">
<span<?php echo $app_tips_pkg_cat->pkg_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips_pkg_cat->pkg_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_pkg_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_pkg_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->pkg_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_tips_pkg_cat->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id">
<?php if ($app_tips_pkg_cat->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_tips_pkg_cat_tcat_id" class="form-group app_tips_pkg_cat_tcat_id">
<select data-table="app_tips_pkg_cat" data-field="x_tcat_id" data-value-separator="<?php echo $app_tips_pkg_cat->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id"<?php echo $app_tips_pkg_cat->tcat_id->EditAttributes() ?>>
<?php echo $app_tips_pkg_cat->tcat_id->SelectOptionListHtml("x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_tips_pkg_cat_tcat_id" class="form-group app_tips_pkg_cat_tcat_id">
<span<?php echo $app_tips_pkg_cat->tcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_tips_pkg_cat->tcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="x<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_tips_pkg_cat" data-field="x_tcat_id" name="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_tips_pkg_cat_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_tips_pkg_cat->tcat_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_tips_pkg_cat_grid->ListOptions->Render("body", "right", $app_tips_pkg_cat_grid->RowIndex);
?>
<script type="text/javascript">
fapp_tips_pkg_catgrid.UpdateOpts(<?php echo $app_tips_pkg_cat_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_tips_pkg_cat->CurrentMode == "add" || $app_tips_pkg_cat->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_tips_pkg_cat_grid->FormKeyCountName ?>" id="<?php echo $app_tips_pkg_cat_grid->FormKeyCountName ?>" value="<?php echo $app_tips_pkg_cat_grid->KeyCount ?>">
<?php echo $app_tips_pkg_cat_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_tips_pkg_cat->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_tips_pkg_cat_grid->FormKeyCountName ?>" id="<?php echo $app_tips_pkg_cat_grid->FormKeyCountName ?>" value="<?php echo $app_tips_pkg_cat_grid->KeyCount ?>">
<?php echo $app_tips_pkg_cat_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_tips_pkg_cat->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_tips_pkg_catgrid">
</div>
<?php

// Close recordset
if ($app_tips_pkg_cat_grid->Recordset)
	$app_tips_pkg_cat_grid->Recordset->Close();
?>
<?php if ($app_tips_pkg_cat_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_tips_pkg_cat_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_tips_pkg_cat_grid->TotalRecs == 0 && $app_tips_pkg_cat->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_tips_pkg_cat_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_tips_pkg_cat->Export == "") { ?>
<script type="text/javascript">
fapp_tips_pkg_catgrid.Init();
</script>
<?php } ?>
<?php
$app_tips_pkg_cat_grid->Page_Terminate();
?>
