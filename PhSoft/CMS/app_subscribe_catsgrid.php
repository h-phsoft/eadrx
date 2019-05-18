<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_subscribe_cats_grid)) $app_subscribe_cats_grid = new capp_subscribe_cats_grid();

// Page init
$app_subscribe_cats_grid->Page_Init();

// Page main
$app_subscribe_cats_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_subscribe_cats_grid->Page_Render();
?>
<?php if ($app_subscribe_cats->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_subscribe_catsgrid = new ew_Form("fapp_subscribe_catsgrid", "grid");
fapp_subscribe_catsgrid.FormKeyCountName = '<?php echo $app_subscribe_cats_grid->FormKeyCountName ?>';

// Validate form
fapp_subscribe_catsgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_sub_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe_cats->sub_id->FldCaption(), $app_subscribe_cats->sub_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tpkg_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe_cats->tpkg_id->FldCaption(), $app_subscribe_cats->tpkg_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tpkg_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe_cats->tpkg_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tcat_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe_cats->tcat_id->FldCaption(), $app_subscribe_cats->tcat_id->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_subscribe_catsgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "sub_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tpkg_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tcat_id", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_subscribe_catsgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_subscribe_catsgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_subscribe_catsgrid.Lists["x_sub_id"] = {"LinkField":"x_subs_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_subs_start","x_subs_end","x_subs_amt","x_ins_datetime"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_subscribe"};
fapp_subscribe_catsgrid.Lists["x_sub_id"].Data = "<?php echo $app_subscribe_cats_grid->sub_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_subscribe_catsgrid.Lists["x_tpkg_id"] = {"LinkField":"x_tpkg_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pkg_name","x_tcat_name","x_cycle_name",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_vtips_package"};
fapp_subscribe_catsgrid.Lists["x_tpkg_id"].Data = "<?php echo $app_subscribe_cats_grid->tpkg_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_subscribe_catsgrid.AutoSuggests["x_tpkg_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $app_subscribe_cats_grid->tpkg_id->LookupFilterQuery(TRUE, "grid"))) ?>;
fapp_subscribe_catsgrid.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_subscribe_catsgrid.Lists["x_tcat_id"].Data = "<?php echo $app_subscribe_cats_grid->tcat_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_subscribe_cats->CurrentAction == "gridadd") {
	if ($app_subscribe_cats->CurrentMode == "copy") {
		$bSelectLimit = $app_subscribe_cats_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_subscribe_cats_grid->TotalRecs = $app_subscribe_cats->ListRecordCount();
			$app_subscribe_cats_grid->Recordset = $app_subscribe_cats_grid->LoadRecordset($app_subscribe_cats_grid->StartRec-1, $app_subscribe_cats_grid->DisplayRecs);
		} else {
			if ($app_subscribe_cats_grid->Recordset = $app_subscribe_cats_grid->LoadRecordset())
				$app_subscribe_cats_grid->TotalRecs = $app_subscribe_cats_grid->Recordset->RecordCount();
		}
		$app_subscribe_cats_grid->StartRec = 1;
		$app_subscribe_cats_grid->DisplayRecs = $app_subscribe_cats_grid->TotalRecs;
	} else {
		$app_subscribe_cats->CurrentFilter = "0=1";
		$app_subscribe_cats_grid->StartRec = 1;
		$app_subscribe_cats_grid->DisplayRecs = $app_subscribe_cats->GridAddRowCount;
	}
	$app_subscribe_cats_grid->TotalRecs = $app_subscribe_cats_grid->DisplayRecs;
	$app_subscribe_cats_grid->StopRec = $app_subscribe_cats_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_subscribe_cats_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_subscribe_cats_grid->TotalRecs <= 0)
			$app_subscribe_cats_grid->TotalRecs = $app_subscribe_cats->ListRecordCount();
	} else {
		if (!$app_subscribe_cats_grid->Recordset && ($app_subscribe_cats_grid->Recordset = $app_subscribe_cats_grid->LoadRecordset()))
			$app_subscribe_cats_grid->TotalRecs = $app_subscribe_cats_grid->Recordset->RecordCount();
	}
	$app_subscribe_cats_grid->StartRec = 1;
	$app_subscribe_cats_grid->DisplayRecs = $app_subscribe_cats_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_subscribe_cats_grid->Recordset = $app_subscribe_cats_grid->LoadRecordset($app_subscribe_cats_grid->StartRec-1, $app_subscribe_cats_grid->DisplayRecs);

	// Set no record found message
	if ($app_subscribe_cats->CurrentAction == "" && $app_subscribe_cats_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_subscribe_cats_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_subscribe_cats_grid->SearchWhere == "0=101")
			$app_subscribe_cats_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_subscribe_cats_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_subscribe_cats_grid->RenderOtherOptions();
?>
<?php $app_subscribe_cats_grid->ShowPageHeader(); ?>
<?php
$app_subscribe_cats_grid->ShowMessage();
?>
<?php if ($app_subscribe_cats_grid->TotalRecs > 0 || $app_subscribe_cats->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_subscribe_cats_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_subscribe_cats">
<div id="fapp_subscribe_catsgrid" class="ewForm ewListForm form-inline">
<?php if ($app_subscribe_cats_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_subscribe_cats_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_subscribe_cats" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_subscribe_catsgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_subscribe_cats_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_subscribe_cats_grid->RenderListOptions();

// Render list options (header, left)
$app_subscribe_cats_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_subscribe_cats->sub_id->Visible) { // sub_id ?>
	<?php if ($app_subscribe_cats->SortUrl($app_subscribe_cats->sub_id) == "") { ?>
		<th data-name="sub_id" class="<?php echo $app_subscribe_cats->sub_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_cats_sub_id" class="app_subscribe_cats_sub_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe_cats->sub_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sub_id" class="<?php echo $app_subscribe_cats->sub_id->HeaderCellClass() ?>"><div><div id="elh_app_subscribe_cats_sub_id" class="app_subscribe_cats_sub_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe_cats->sub_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe_cats->sub_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe_cats->sub_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe_cats->tpkg_id->Visible) { // tpkg_id ?>
	<?php if ($app_subscribe_cats->SortUrl($app_subscribe_cats->tpkg_id) == "") { ?>
		<th data-name="tpkg_id" class="<?php echo $app_subscribe_cats->tpkg_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_cats_tpkg_id" class="app_subscribe_cats_tpkg_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe_cats->tpkg_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tpkg_id" class="<?php echo $app_subscribe_cats->tpkg_id->HeaderCellClass() ?>"><div><div id="elh_app_subscribe_cats_tpkg_id" class="app_subscribe_cats_tpkg_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe_cats->tpkg_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe_cats->tpkg_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe_cats->tpkg_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe_cats->tcat_id->Visible) { // tcat_id ?>
	<?php if ($app_subscribe_cats->SortUrl($app_subscribe_cats->tcat_id) == "") { ?>
		<th data-name="tcat_id" class="<?php echo $app_subscribe_cats->tcat_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_cats_tcat_id" class="app_subscribe_cats_tcat_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe_cats->tcat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tcat_id" class="<?php echo $app_subscribe_cats->tcat_id->HeaderCellClass() ?>"><div><div id="elh_app_subscribe_cats_tcat_id" class="app_subscribe_cats_tcat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe_cats->tcat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe_cats->tcat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe_cats->tcat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_subscribe_cats_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_subscribe_cats_grid->StartRec = 1;
$app_subscribe_cats_grid->StopRec = $app_subscribe_cats_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_subscribe_cats_grid->FormKeyCountName) && ($app_subscribe_cats->CurrentAction == "gridadd" || $app_subscribe_cats->CurrentAction == "gridedit" || $app_subscribe_cats->CurrentAction == "F")) {
		$app_subscribe_cats_grid->KeyCount = $objForm->GetValue($app_subscribe_cats_grid->FormKeyCountName);
		$app_subscribe_cats_grid->StopRec = $app_subscribe_cats_grid->StartRec + $app_subscribe_cats_grid->KeyCount - 1;
	}
}
$app_subscribe_cats_grid->RecCnt = $app_subscribe_cats_grid->StartRec - 1;
if ($app_subscribe_cats_grid->Recordset && !$app_subscribe_cats_grid->Recordset->EOF) {
	$app_subscribe_cats_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_subscribe_cats_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_subscribe_cats_grid->StartRec > 1)
		$app_subscribe_cats_grid->Recordset->Move($app_subscribe_cats_grid->StartRec - 1);
} elseif (!$app_subscribe_cats->AllowAddDeleteRow && $app_subscribe_cats_grid->StopRec == 0) {
	$app_subscribe_cats_grid->StopRec = $app_subscribe_cats->GridAddRowCount;
}

// Initialize aggregate
$app_subscribe_cats->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_subscribe_cats->ResetAttrs();
$app_subscribe_cats_grid->RenderRow();
if ($app_subscribe_cats->CurrentAction == "gridadd")
	$app_subscribe_cats_grid->RowIndex = 0;
if ($app_subscribe_cats->CurrentAction == "gridedit")
	$app_subscribe_cats_grid->RowIndex = 0;
while ($app_subscribe_cats_grid->RecCnt < $app_subscribe_cats_grid->StopRec) {
	$app_subscribe_cats_grid->RecCnt++;
	if (intval($app_subscribe_cats_grid->RecCnt) >= intval($app_subscribe_cats_grid->StartRec)) {
		$app_subscribe_cats_grid->RowCnt++;
		if ($app_subscribe_cats->CurrentAction == "gridadd" || $app_subscribe_cats->CurrentAction == "gridedit" || $app_subscribe_cats->CurrentAction == "F") {
			$app_subscribe_cats_grid->RowIndex++;
			$objForm->Index = $app_subscribe_cats_grid->RowIndex;
			if ($objForm->HasValue($app_subscribe_cats_grid->FormActionName))
				$app_subscribe_cats_grid->RowAction = strval($objForm->GetValue($app_subscribe_cats_grid->FormActionName));
			elseif ($app_subscribe_cats->CurrentAction == "gridadd")
				$app_subscribe_cats_grid->RowAction = "insert";
			else
				$app_subscribe_cats_grid->RowAction = "";
		}

		// Set up key count
		$app_subscribe_cats_grid->KeyCount = $app_subscribe_cats_grid->RowIndex;

		// Init row class and style
		$app_subscribe_cats->ResetAttrs();
		$app_subscribe_cats->CssClass = "";
		if ($app_subscribe_cats->CurrentAction == "gridadd") {
			if ($app_subscribe_cats->CurrentMode == "copy") {
				$app_subscribe_cats_grid->LoadRowValues($app_subscribe_cats_grid->Recordset); // Load row values
				$app_subscribe_cats_grid->SetRecordKey($app_subscribe_cats_grid->RowOldKey, $app_subscribe_cats_grid->Recordset); // Set old record key
			} else {
				$app_subscribe_cats_grid->LoadRowValues(); // Load default values
				$app_subscribe_cats_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_subscribe_cats_grid->LoadRowValues($app_subscribe_cats_grid->Recordset); // Load row values
		}
		$app_subscribe_cats->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_subscribe_cats->CurrentAction == "gridadd") // Grid add
			$app_subscribe_cats->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_subscribe_cats->CurrentAction == "gridadd" && $app_subscribe_cats->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_subscribe_cats_grid->RestoreCurrentRowFormValues($app_subscribe_cats_grid->RowIndex); // Restore form values
		if ($app_subscribe_cats->CurrentAction == "gridedit") { // Grid edit
			if ($app_subscribe_cats->EventCancelled) {
				$app_subscribe_cats_grid->RestoreCurrentRowFormValues($app_subscribe_cats_grid->RowIndex); // Restore form values
			}
			if ($app_subscribe_cats_grid->RowAction == "insert")
				$app_subscribe_cats->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_subscribe_cats->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_subscribe_cats->CurrentAction == "gridedit" && ($app_subscribe_cats->RowType == EW_ROWTYPE_EDIT || $app_subscribe_cats->RowType == EW_ROWTYPE_ADD) && $app_subscribe_cats->EventCancelled) // Update failed
			$app_subscribe_cats_grid->RestoreCurrentRowFormValues($app_subscribe_cats_grid->RowIndex); // Restore form values
		if ($app_subscribe_cats->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_subscribe_cats_grid->EditRowCnt++;
		if ($app_subscribe_cats->CurrentAction == "F") // Confirm row
			$app_subscribe_cats_grid->RestoreCurrentRowFormValues($app_subscribe_cats_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_subscribe_cats->RowAttrs = array_merge($app_subscribe_cats->RowAttrs, array('data-rowindex'=>$app_subscribe_cats_grid->RowCnt, 'id'=>'r' . $app_subscribe_cats_grid->RowCnt . '_app_subscribe_cats', 'data-rowtype'=>$app_subscribe_cats->RowType));

		// Render row
		$app_subscribe_cats_grid->RenderRow();

		// Render list options
		$app_subscribe_cats_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_subscribe_cats_grid->RowAction <> "delete" && $app_subscribe_cats_grid->RowAction <> "insertdelete" && !($app_subscribe_cats_grid->RowAction == "insert" && $app_subscribe_cats->CurrentAction == "F" && $app_subscribe_cats_grid->EmptyRow())) {
?>
	<tr<?php echo $app_subscribe_cats->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_subscribe_cats_grid->ListOptions->Render("body", "left", $app_subscribe_cats_grid->RowCnt);
?>
	<?php if ($app_subscribe_cats->sub_id->Visible) { // sub_id ?>
		<td data-name="sub_id"<?php echo $app_subscribe_cats->sub_id->CellAttributes() ?>>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_subscribe_cats->sub_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<span<?php echo $app_subscribe_cats->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->sub_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<select data-table="app_subscribe_cats" data-field="x_sub_id" data-value-separator="<?php echo $app_subscribe_cats->sub_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id"<?php echo $app_subscribe_cats->sub_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->sub_id->SelectOptionListHtml("x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_subscribe_cats->sub_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<span<?php echo $app_subscribe_cats->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->sub_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<select data-table="app_subscribe_cats" data-field="x_sub_id" data-value-separator="<?php echo $app_subscribe_cats->sub_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id"<?php echo $app_subscribe_cats->sub_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->sub_id->SelectOptionListHtml("x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_sub_id" class="app_subscribe_cats_sub_id">
<span<?php echo $app_subscribe_cats->sub_id->ViewAttributes() ?>>
<?php echo $app_subscribe_cats->sub_id->ListViewValue() ?></span>
</span>
<?php if ($app_subscribe_cats->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->FormValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="fapp_subscribe_catsgrid$x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="fapp_subscribe_catsgrid$x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->FormValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="fapp_subscribe_catsgrid$o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="fapp_subscribe_catsgrid$o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tsub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tsub_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tsub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tsub_id->CurrentValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tsub_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tsub_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tsub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tsub_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_EDIT || $app_subscribe_cats->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tsub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tsub_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tsub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tsub_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_subscribe_cats->tpkg_id->Visible) { // tpkg_id ?>
		<td data-name="tpkg_id"<?php echo $app_subscribe_cats->tpkg_id->CellAttributes() ?>>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_tpkg_id" class="form-group app_subscribe_cats_tpkg_id">
<?php
$wrkonchange = trim(" " . @$app_subscribe_cats->tpkg_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$app_subscribe_cats->tpkg_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" style="white-space: nowrap; z-index: <?php echo (9000 - $app_subscribe_cats_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="sv_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo $app_subscribe_cats->tpkg_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>"<?php echo $app_subscribe_cats->tpkg_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" data-value-separator="<?php echo $app_subscribe_cats->tpkg_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fapp_subscribe_catsgrid.CreateAutoSuggest({"id":"x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_tpkg_id" class="form-group app_subscribe_cats_tpkg_id">
<?php
$wrkonchange = trim(" " . @$app_subscribe_cats->tpkg_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$app_subscribe_cats->tpkg_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" style="white-space: nowrap; z-index: <?php echo (9000 - $app_subscribe_cats_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="sv_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo $app_subscribe_cats->tpkg_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>"<?php echo $app_subscribe_cats->tpkg_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" data-value-separator="<?php echo $app_subscribe_cats->tpkg_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fapp_subscribe_catsgrid.CreateAutoSuggest({"id":"x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_tpkg_id" class="app_subscribe_cats_tpkg_id">
<span<?php echo $app_subscribe_cats->tpkg_id->ViewAttributes() ?>>
<?php echo $app_subscribe_cats->tpkg_id->ListViewValue() ?></span>
</span>
<?php if ($app_subscribe_cats->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->FormValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="fapp_subscribe_catsgrid$x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="fapp_subscribe_catsgrid$x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->FormValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="fapp_subscribe_catsgrid$o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="fapp_subscribe_catsgrid$o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe_cats->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id"<?php echo $app_subscribe_cats->tcat_id->CellAttributes() ?>>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_tcat_id" class="form-group app_subscribe_cats_tcat_id">
<select data-table="app_subscribe_cats" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe_cats->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id"<?php echo $app_subscribe_cats->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_tcat_id" class="form-group app_subscribe_cats_tcat_id">
<select data-table="app_subscribe_cats" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe_cats->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id"<?php echo $app_subscribe_cats->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_cats_grid->RowCnt ?>_app_subscribe_cats_tcat_id" class="app_subscribe_cats_tcat_id">
<span<?php echo $app_subscribe_cats->tcat_id->ViewAttributes() ?>>
<?php echo $app_subscribe_cats->tcat_id->ListViewValue() ?></span>
</span>
<?php if ($app_subscribe_cats->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->FormValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="fapp_subscribe_catsgrid$x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="fapp_subscribe_catsgrid$x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->FormValue) ?>">
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="fapp_subscribe_catsgrid$o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="fapp_subscribe_catsgrid$o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_subscribe_cats_grid->ListOptions->Render("body", "right", $app_subscribe_cats_grid->RowCnt);
?>
	</tr>
<?php if ($app_subscribe_cats->RowType == EW_ROWTYPE_ADD || $app_subscribe_cats->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_subscribe_catsgrid.UpdateOpts(<?php echo $app_subscribe_cats_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_subscribe_cats->CurrentAction <> "gridadd" || $app_subscribe_cats->CurrentMode == "copy")
		if (!$app_subscribe_cats_grid->Recordset->EOF) $app_subscribe_cats_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_subscribe_cats->CurrentMode == "add" || $app_subscribe_cats->CurrentMode == "copy" || $app_subscribe_cats->CurrentMode == "edit") {
		$app_subscribe_cats_grid->RowIndex = '$rowindex$';
		$app_subscribe_cats_grid->LoadRowValues();

		// Set row properties
		$app_subscribe_cats->ResetAttrs();
		$app_subscribe_cats->RowAttrs = array_merge($app_subscribe_cats->RowAttrs, array('data-rowindex'=>$app_subscribe_cats_grid->RowIndex, 'id'=>'r0_app_subscribe_cats', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_subscribe_cats->RowAttrs["class"], "ewTemplate");
		$app_subscribe_cats->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_subscribe_cats_grid->RenderRow();

		// Render list options
		$app_subscribe_cats_grid->RenderListOptions();
		$app_subscribe_cats_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_subscribe_cats->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_subscribe_cats_grid->ListOptions->Render("body", "left", $app_subscribe_cats_grid->RowIndex);
?>
	<?php if ($app_subscribe_cats->sub_id->Visible) { // sub_id ?>
		<td data-name="sub_id">
<?php if ($app_subscribe_cats->CurrentAction <> "F") { ?>
<?php if ($app_subscribe_cats->sub_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<span<?php echo $app_subscribe_cats->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->sub_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<select data-table="app_subscribe_cats" data-field="x_sub_id" data-value-separator="<?php echo $app_subscribe_cats->sub_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id"<?php echo $app_subscribe_cats->sub_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->sub_id->SelectOptionListHtml("x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_subscribe_cats_sub_id" class="form-group app_subscribe_cats_sub_id">
<span<?php echo $app_subscribe_cats->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->sub_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_sub_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe_cats->tpkg_id->Visible) { // tpkg_id ?>
		<td data-name="tpkg_id">
<?php if ($app_subscribe_cats->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_subscribe_cats_tpkg_id" class="form-group app_subscribe_cats_tpkg_id">
<?php
$wrkonchange = trim(" " . @$app_subscribe_cats->tpkg_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$app_subscribe_cats->tpkg_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" style="white-space: nowrap; z-index: <?php echo (9000 - $app_subscribe_cats_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="sv_x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo $app_subscribe_cats->tpkg_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>"<?php echo $app_subscribe_cats->tpkg_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" data-value-separator="<?php echo $app_subscribe_cats->tpkg_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fapp_subscribe_catsgrid.CreateAutoSuggest({"id":"x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id","forceSelect":false});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_subscribe_cats_tpkg_id" class="form-group app_subscribe_cats_tpkg_id">
<span<?php echo $app_subscribe_cats->tpkg_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->tpkg_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe_cats->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id">
<?php if ($app_subscribe_cats->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_subscribe_cats_tcat_id" class="form-group app_subscribe_cats_tcat_id">
<select data-table="app_subscribe_cats" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe_cats->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id"<?php echo $app_subscribe_cats->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_subscribe_cats_tcat_id" class="form-group app_subscribe_cats_tcat_id">
<span<?php echo $app_subscribe_cats->tcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->tcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="x<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tcat_id" name="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" id="o<?php echo $app_subscribe_cats_grid->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tcat_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_subscribe_cats_grid->ListOptions->Render("body", "right", $app_subscribe_cats_grid->RowIndex);
?>
<script type="text/javascript">
fapp_subscribe_catsgrid.UpdateOpts(<?php echo $app_subscribe_cats_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_subscribe_cats->CurrentMode == "add" || $app_subscribe_cats->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_subscribe_cats_grid->FormKeyCountName ?>" id="<?php echo $app_subscribe_cats_grid->FormKeyCountName ?>" value="<?php echo $app_subscribe_cats_grid->KeyCount ?>">
<?php echo $app_subscribe_cats_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_subscribe_cats->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_subscribe_cats_grid->FormKeyCountName ?>" id="<?php echo $app_subscribe_cats_grid->FormKeyCountName ?>" value="<?php echo $app_subscribe_cats_grid->KeyCount ?>">
<?php echo $app_subscribe_cats_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_subscribe_cats->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_subscribe_catsgrid">
</div>
<?php

// Close recordset
if ($app_subscribe_cats_grid->Recordset)
	$app_subscribe_cats_grid->Recordset->Close();
?>
<?php if ($app_subscribe_cats_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_subscribe_cats_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_subscribe_cats_grid->TotalRecs == 0 && $app_subscribe_cats->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_subscribe_cats_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_subscribe_cats->Export == "") { ?>
<script type="text/javascript">
fapp_subscribe_catsgrid.Init();
</script>
<?php } ?>
<?php
$app_subscribe_cats_grid->Page_Terminate();
?>
