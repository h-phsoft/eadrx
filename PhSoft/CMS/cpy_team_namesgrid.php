<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_team_names_grid)) $cpy_team_names_grid = new ccpy_team_names_grid();

// Page init
$cpy_team_names_grid->Page_Init();

// Page main
$cpy_team_names_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_team_names_grid->Page_Render();
?>
<?php if ($cpy_team_names->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcpy_team_namesgrid = new ew_Form("fcpy_team_namesgrid", "grid");
fcpy_team_namesgrid.FormKeyCountName = '<?php echo $cpy_team_names_grid->FormKeyCountName ?>';

// Validate form
fcpy_team_namesgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_team_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_id->FldCaption(), $cpy_team_names->team_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->lang_id->FldCaption(), $cpy_team_names->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_team_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_name->FldCaption(), $cpy_team_names->team_name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_team_title");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_title->FldCaption(), $cpy_team_names->team_title->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_team_position");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_position->FldCaption(), $cpy_team_names->team_position->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcpy_team_namesgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "team_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "team_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "team_title", false)) return false;
	if (ew_ValueChanged(fobj, infix, "team_position", false)) return false;
	if (ew_ValueChanged(fobj, infix, "team_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fcpy_team_namesgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_team_namesgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_team_namesgrid.Lists["x_team_id"] = {"LinkField":"x_team_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_team_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_team"};
fcpy_team_namesgrid.Lists["x_team_id"].Data = "<?php echo $cpy_team_names_grid->team_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_team_namesgrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_team_namesgrid.Lists["x_lang_id"].Data = "<?php echo $cpy_team_names_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($cpy_team_names->CurrentAction == "gridadd") {
	if ($cpy_team_names->CurrentMode == "copy") {
		$bSelectLimit = $cpy_team_names_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cpy_team_names_grid->TotalRecs = $cpy_team_names->ListRecordCount();
			$cpy_team_names_grid->Recordset = $cpy_team_names_grid->LoadRecordset($cpy_team_names_grid->StartRec-1, $cpy_team_names_grid->DisplayRecs);
		} else {
			if ($cpy_team_names_grid->Recordset = $cpy_team_names_grid->LoadRecordset())
				$cpy_team_names_grid->TotalRecs = $cpy_team_names_grid->Recordset->RecordCount();
		}
		$cpy_team_names_grid->StartRec = 1;
		$cpy_team_names_grid->DisplayRecs = $cpy_team_names_grid->TotalRecs;
	} else {
		$cpy_team_names->CurrentFilter = "0=1";
		$cpy_team_names_grid->StartRec = 1;
		$cpy_team_names_grid->DisplayRecs = $cpy_team_names->GridAddRowCount;
	}
	$cpy_team_names_grid->TotalRecs = $cpy_team_names_grid->DisplayRecs;
	$cpy_team_names_grid->StopRec = $cpy_team_names_grid->DisplayRecs;
} else {
	$bSelectLimit = $cpy_team_names_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cpy_team_names_grid->TotalRecs <= 0)
			$cpy_team_names_grid->TotalRecs = $cpy_team_names->ListRecordCount();
	} else {
		if (!$cpy_team_names_grid->Recordset && ($cpy_team_names_grid->Recordset = $cpy_team_names_grid->LoadRecordset()))
			$cpy_team_names_grid->TotalRecs = $cpy_team_names_grid->Recordset->RecordCount();
	}
	$cpy_team_names_grid->StartRec = 1;
	$cpy_team_names_grid->DisplayRecs = $cpy_team_names_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cpy_team_names_grid->Recordset = $cpy_team_names_grid->LoadRecordset($cpy_team_names_grid->StartRec-1, $cpy_team_names_grid->DisplayRecs);

	// Set no record found message
	if ($cpy_team_names->CurrentAction == "" && $cpy_team_names_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cpy_team_names_grid->setWarningMessage(ew_DeniedMsg());
		if ($cpy_team_names_grid->SearchWhere == "0=101")
			$cpy_team_names_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cpy_team_names_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cpy_team_names_grid->RenderOtherOptions();
?>
<?php $cpy_team_names_grid->ShowPageHeader(); ?>
<?php
$cpy_team_names_grid->ShowMessage();
?>
<?php if ($cpy_team_names_grid->TotalRecs > 0 || $cpy_team_names->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($cpy_team_names_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> cpy_team_names">
<div id="fcpy_team_namesgrid" class="ewForm ewListForm form-inline">
<?php if ($cpy_team_names_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($cpy_team_names_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_cpy_team_names" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_cpy_team_namesgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$cpy_team_names_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cpy_team_names_grid->RenderListOptions();

// Render list options (header, left)
$cpy_team_names_grid->ListOptions->Render("header", "left");
?>
<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->teamn_id) == "") { ?>
		<th data-name="teamn_id" class="<?php echo $cpy_team_names->teamn_id->HeaderCellClass() ?>"><div id="elh_cpy_team_names_teamn_id" class="cpy_team_names_teamn_id"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->teamn_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="teamn_id" class="<?php echo $cpy_team_names->teamn_id->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_teamn_id" class="cpy_team_names_teamn_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->teamn_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->teamn_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->teamn_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->team_id) == "") { ?>
		<th data-name="team_id" class="<?php echo $cpy_team_names->team_id->HeaderCellClass() ?>"><div id="elh_cpy_team_names_team_id" class="cpy_team_names_team_id"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="team_id" class="<?php echo $cpy_team_names->team_id->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_team_id" class="cpy_team_names_team_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->team_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->team_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $cpy_team_names->lang_id->HeaderCellClass() ?>"><div id="elh_cpy_team_names_lang_id" class="cpy_team_names_lang_id"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $cpy_team_names->lang_id->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_lang_id" class="cpy_team_names_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->team_name) == "") { ?>
		<th data-name="team_name" class="<?php echo $cpy_team_names->team_name->HeaderCellClass() ?>"><div id="elh_cpy_team_names_team_name" class="cpy_team_names_team_name"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="team_name" class="<?php echo $cpy_team_names->team_name->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_team_name" class="cpy_team_names_team_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->team_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->team_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->team_title) == "") { ?>
		<th data-name="team_title" class="<?php echo $cpy_team_names->team_title->HeaderCellClass() ?>"><div id="elh_cpy_team_names_team_title" class="cpy_team_names_team_title"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_title->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="team_title" class="<?php echo $cpy_team_names->team_title->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_team_title" class="cpy_team_names_team_title">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_title->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->team_title->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->team_title->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->team_position) == "") { ?>
		<th data-name="team_position" class="<?php echo $cpy_team_names->team_position->HeaderCellClass() ?>"><div id="elh_cpy_team_names_team_position" class="cpy_team_names_team_position"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_position->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="team_position" class="<?php echo $cpy_team_names->team_position->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_team_position" class="cpy_team_names_team_position">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_position->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->team_position->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->team_position->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
	<?php if ($cpy_team_names->SortUrl($cpy_team_names->team_text) == "") { ?>
		<th data-name="team_text" class="<?php echo $cpy_team_names->team_text->HeaderCellClass() ?>"><div id="elh_cpy_team_names_team_text" class="cpy_team_names_team_text"><div class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="team_text" class="<?php echo $cpy_team_names->team_text->HeaderCellClass() ?>"><div><div id="elh_cpy_team_names_team_text" class="cpy_team_names_team_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_team_names->team_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_team_names->team_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_team_names->team_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cpy_team_names_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cpy_team_names_grid->StartRec = 1;
$cpy_team_names_grid->StopRec = $cpy_team_names_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cpy_team_names_grid->FormKeyCountName) && ($cpy_team_names->CurrentAction == "gridadd" || $cpy_team_names->CurrentAction == "gridedit" || $cpy_team_names->CurrentAction == "F")) {
		$cpy_team_names_grid->KeyCount = $objForm->GetValue($cpy_team_names_grid->FormKeyCountName);
		$cpy_team_names_grid->StopRec = $cpy_team_names_grid->StartRec + $cpy_team_names_grid->KeyCount - 1;
	}
}
$cpy_team_names_grid->RecCnt = $cpy_team_names_grid->StartRec - 1;
if ($cpy_team_names_grid->Recordset && !$cpy_team_names_grid->Recordset->EOF) {
	$cpy_team_names_grid->Recordset->MoveFirst();
	$bSelectLimit = $cpy_team_names_grid->UseSelectLimit;
	if (!$bSelectLimit && $cpy_team_names_grid->StartRec > 1)
		$cpy_team_names_grid->Recordset->Move($cpy_team_names_grid->StartRec - 1);
} elseif (!$cpy_team_names->AllowAddDeleteRow && $cpy_team_names_grid->StopRec == 0) {
	$cpy_team_names_grid->StopRec = $cpy_team_names->GridAddRowCount;
}

// Initialize aggregate
$cpy_team_names->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cpy_team_names->ResetAttrs();
$cpy_team_names_grid->RenderRow();
if ($cpy_team_names->CurrentAction == "gridadd")
	$cpy_team_names_grid->RowIndex = 0;
if ($cpy_team_names->CurrentAction == "gridedit")
	$cpy_team_names_grid->RowIndex = 0;
while ($cpy_team_names_grid->RecCnt < $cpy_team_names_grid->StopRec) {
	$cpy_team_names_grid->RecCnt++;
	if (intval($cpy_team_names_grid->RecCnt) >= intval($cpy_team_names_grid->StartRec)) {
		$cpy_team_names_grid->RowCnt++;
		if ($cpy_team_names->CurrentAction == "gridadd" || $cpy_team_names->CurrentAction == "gridedit" || $cpy_team_names->CurrentAction == "F") {
			$cpy_team_names_grid->RowIndex++;
			$objForm->Index = $cpy_team_names_grid->RowIndex;
			if ($objForm->HasValue($cpy_team_names_grid->FormActionName))
				$cpy_team_names_grid->RowAction = strval($objForm->GetValue($cpy_team_names_grid->FormActionName));
			elseif ($cpy_team_names->CurrentAction == "gridadd")
				$cpy_team_names_grid->RowAction = "insert";
			else
				$cpy_team_names_grid->RowAction = "";
		}

		// Set up key count
		$cpy_team_names_grid->KeyCount = $cpy_team_names_grid->RowIndex;

		// Init row class and style
		$cpy_team_names->ResetAttrs();
		$cpy_team_names->CssClass = "";
		if ($cpy_team_names->CurrentAction == "gridadd") {
			if ($cpy_team_names->CurrentMode == "copy") {
				$cpy_team_names_grid->LoadRowValues($cpy_team_names_grid->Recordset); // Load row values
				$cpy_team_names_grid->SetRecordKey($cpy_team_names_grid->RowOldKey, $cpy_team_names_grid->Recordset); // Set old record key
			} else {
				$cpy_team_names_grid->LoadRowValues(); // Load default values
				$cpy_team_names_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cpy_team_names_grid->LoadRowValues($cpy_team_names_grid->Recordset); // Load row values
		}
		$cpy_team_names->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cpy_team_names->CurrentAction == "gridadd") // Grid add
			$cpy_team_names->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cpy_team_names->CurrentAction == "gridadd" && $cpy_team_names->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cpy_team_names_grid->RestoreCurrentRowFormValues($cpy_team_names_grid->RowIndex); // Restore form values
		if ($cpy_team_names->CurrentAction == "gridedit") { // Grid edit
			if ($cpy_team_names->EventCancelled) {
				$cpy_team_names_grid->RestoreCurrentRowFormValues($cpy_team_names_grid->RowIndex); // Restore form values
			}
			if ($cpy_team_names_grid->RowAction == "insert")
				$cpy_team_names->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cpy_team_names->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cpy_team_names->CurrentAction == "gridedit" && ($cpy_team_names->RowType == EW_ROWTYPE_EDIT || $cpy_team_names->RowType == EW_ROWTYPE_ADD) && $cpy_team_names->EventCancelled) // Update failed
			$cpy_team_names_grid->RestoreCurrentRowFormValues($cpy_team_names_grid->RowIndex); // Restore form values
		if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cpy_team_names_grid->EditRowCnt++;
		if ($cpy_team_names->CurrentAction == "F") // Confirm row
			$cpy_team_names_grid->RestoreCurrentRowFormValues($cpy_team_names_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cpy_team_names->RowAttrs = array_merge($cpy_team_names->RowAttrs, array('data-rowindex'=>$cpy_team_names_grid->RowCnt, 'id'=>'r' . $cpy_team_names_grid->RowCnt . '_cpy_team_names', 'data-rowtype'=>$cpy_team_names->RowType));

		// Render row
		$cpy_team_names_grid->RenderRow();

		// Render list options
		$cpy_team_names_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cpy_team_names_grid->RowAction <> "delete" && $cpy_team_names_grid->RowAction <> "insertdelete" && !($cpy_team_names_grid->RowAction == "insert" && $cpy_team_names->CurrentAction == "F" && $cpy_team_names_grid->EmptyRow())) {
?>
	<tr<?php echo $cpy_team_names->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_team_names_grid->ListOptions->Render("body", "left", $cpy_team_names_grid->RowCnt);
?>
	<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
		<td data-name="teamn_id"<?php echo $cpy_team_names->teamn_id->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_teamn_id" class="form-group cpy_team_names_teamn_id">
<span<?php echo $cpy_team_names->teamn_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->teamn_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->CurrentValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_teamn_id" class="cpy_team_names_teamn_id">
<span<?php echo $cpy_team_names->teamn_id->ViewAttributes() ?>>
<?php echo $cpy_team_names->teamn_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
		<td data-name="team_id"<?php echo $cpy_team_names->team_id->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cpy_team_names->team_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<select data-table="cpy_team_names" data-field="x_team_id" data-value-separator="<?php echo $cpy_team_names->team_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id"<?php echo $cpy_team_names->team_id->EditAttributes() ?>>
<?php echo $cpy_team_names->team_id->SelectOptionListHtml("x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cpy_team_names->team_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<select data-table="cpy_team_names" data-field="x_team_id" data-value-separator="<?php echo $cpy_team_names->team_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id"<?php echo $cpy_team_names->team_id->EditAttributes() ?>>
<?php echo $cpy_team_names->team_id->SelectOptionListHtml("x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_id" class="cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $cpy_team_names->lang_id->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_lang_id" class="form-group cpy_team_names_lang_id">
<select data-table="cpy_team_names" data-field="x_lang_id" data-value-separator="<?php echo $cpy_team_names->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id"<?php echo $cpy_team_names->lang_id->EditAttributes() ?>>
<?php echo $cpy_team_names->lang_id->SelectOptionListHtml("x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_lang_id" class="form-group cpy_team_names_lang_id">
<select data-table="cpy_team_names" data-field="x_lang_id" data-value-separator="<?php echo $cpy_team_names->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id"<?php echo $cpy_team_names->lang_id->EditAttributes() ?>>
<?php echo $cpy_team_names->lang_id->SelectOptionListHtml("x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_lang_id" class="cpy_team_names_lang_id">
<span<?php echo $cpy_team_names->lang_id->ViewAttributes() ?>>
<?php echo $cpy_team_names->lang_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
		<td data-name="team_name"<?php echo $cpy_team_names->team_name->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_name" class="form-group cpy_team_names_team_name">
<input type="text" data-table="cpy_team_names" data-field="x_team_name" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_name->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_name->EditValue ?>"<?php echo $cpy_team_names->team_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_name" class="form-group cpy_team_names_team_name">
<input type="text" data-table="cpy_team_names" data-field="x_team_name" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_name->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_name->EditValue ?>"<?php echo $cpy_team_names->team_name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_name" class="cpy_team_names_team_name">
<span<?php echo $cpy_team_names->team_name->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_name->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
		<td data-name="team_title"<?php echo $cpy_team_names->team_title->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_title" class="form-group cpy_team_names_team_title">
<input type="text" data-table="cpy_team_names" data-field="x_team_title" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_title->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_title->EditValue ?>"<?php echo $cpy_team_names->team_title->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_title" class="form-group cpy_team_names_team_title">
<input type="text" data-table="cpy_team_names" data-field="x_team_title" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_title->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_title->EditValue ?>"<?php echo $cpy_team_names->team_title->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_title" class="cpy_team_names_team_title">
<span<?php echo $cpy_team_names->team_title->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_title->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
		<td data-name="team_position"<?php echo $cpy_team_names->team_position->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_position" class="form-group cpy_team_names_team_position">
<input type="text" data-table="cpy_team_names" data-field="x_team_position" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_position->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_position->EditValue ?>"<?php echo $cpy_team_names->team_position->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_position" class="form-group cpy_team_names_team_position">
<input type="text" data-table="cpy_team_names" data-field="x_team_position" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_position->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_position->EditValue ?>"<?php echo $cpy_team_names->team_position->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_position" class="cpy_team_names_team_position">
<span<?php echo $cpy_team_names->team_position->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_position->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
		<td data-name="team_text"<?php echo $cpy_team_names->team_text->CellAttributes() ?>>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_text" class="form-group cpy_team_names_team_text">
<?php ew_AppendClass($cpy_team_names->team_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_team_names" data-field="x_team_text" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_text->getPlaceHolder()) ?>"<?php echo $cpy_team_names->team_text->EditAttributes() ?>><?php echo $cpy_team_names->team_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_team_namesgrid", "x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text", 35, 8, <?php echo ($cpy_team_names->team_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->OldValue) ?>">
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_text" class="form-group cpy_team_names_team_text">
<?php ew_AppendClass($cpy_team_names->team_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_team_names" data-field="x_team_text" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_text->getPlaceHolder()) ?>"<?php echo $cpy_team_names->team_text->EditAttributes() ?>><?php echo $cpy_team_names->team_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_team_namesgrid", "x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text", 35, 8, <?php echo ($cpy_team_names->team_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_team_names_grid->RowCnt ?>_cpy_team_names_team_text" class="cpy_team_names_team_text">
<span<?php echo $cpy_team_names->team_text->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_text->ListViewValue() ?></span>
</span>
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="fcpy_team_namesgrid$x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->FormValue) ?>">
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="fcpy_team_namesgrid$o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_team_names_grid->ListOptions->Render("body", "right", $cpy_team_names_grid->RowCnt);
?>
	</tr>
<?php if ($cpy_team_names->RowType == EW_ROWTYPE_ADD || $cpy_team_names->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcpy_team_namesgrid.UpdateOpts(<?php echo $cpy_team_names_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cpy_team_names->CurrentAction <> "gridadd" || $cpy_team_names->CurrentMode == "copy")
		if (!$cpy_team_names_grid->Recordset->EOF) $cpy_team_names_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cpy_team_names->CurrentMode == "add" || $cpy_team_names->CurrentMode == "copy" || $cpy_team_names->CurrentMode == "edit") {
		$cpy_team_names_grid->RowIndex = '$rowindex$';
		$cpy_team_names_grid->LoadRowValues();

		// Set row properties
		$cpy_team_names->ResetAttrs();
		$cpy_team_names->RowAttrs = array_merge($cpy_team_names->RowAttrs, array('data-rowindex'=>$cpy_team_names_grid->RowIndex, 'id'=>'r0_cpy_team_names', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cpy_team_names->RowAttrs["class"], "ewTemplate");
		$cpy_team_names->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_team_names_grid->RenderRow();

		// Render list options
		$cpy_team_names_grid->RenderListOptions();
		$cpy_team_names_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_team_names->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_team_names_grid->ListOptions->Render("body", "left", $cpy_team_names_grid->RowIndex);
?>
	<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
		<td data-name="teamn_id">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_teamn_id" class="form-group cpy_team_names_teamn_id">
<span<?php echo $cpy_team_names->teamn_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->teamn_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
		<td data-name="team_id">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<?php if ($cpy_team_names->team_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<select data-table="cpy_team_names" data-field="x_team_id" data-value-separator="<?php echo $cpy_team_names->team_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id"<?php echo $cpy_team_names->team_id->EditAttributes() ?>>
<?php echo $cpy_team_names->team_id->SelectOptionListHtml("x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_team_id" class="form-group cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_team_names_lang_id" class="form-group cpy_team_names_lang_id">
<select data-table="cpy_team_names" data-field="x_lang_id" data-value-separator="<?php echo $cpy_team_names->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id"<?php echo $cpy_team_names->lang_id->EditAttributes() ?>>
<?php echo $cpy_team_names->lang_id->SelectOptionListHtml("x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_lang_id" class="form-group cpy_team_names_lang_id">
<span<?php echo $cpy_team_names->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_lang_id" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_team_names->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
		<td data-name="team_name">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_team_names_team_name" class="form-group cpy_team_names_team_name">
<input type="text" data-table="cpy_team_names" data-field="x_team_name" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_name->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_name->EditValue ?>"<?php echo $cpy_team_names->team_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_team_name" class="form-group cpy_team_names_team_name">
<span<?php echo $cpy_team_names->team_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_name->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_name" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_name" value="<?php echo ew_HtmlEncode($cpy_team_names->team_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
		<td data-name="team_title">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_team_names_team_title" class="form-group cpy_team_names_team_title">
<input type="text" data-table="cpy_team_names" data-field="x_team_title" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_title->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_title->EditValue ?>"<?php echo $cpy_team_names->team_title->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_team_title" class="form-group cpy_team_names_team_title">
<span<?php echo $cpy_team_names->team_title->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_title->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_title" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_title" value="<?php echo ew_HtmlEncode($cpy_team_names->team_title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
		<td data-name="team_position">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_team_names_team_position" class="form-group cpy_team_names_team_position">
<input type="text" data-table="cpy_team_names" data-field="x_team_position" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_position->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_position->EditValue ?>"<?php echo $cpy_team_names->team_position->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_team_position" class="form-group cpy_team_names_team_position">
<span<?php echo $cpy_team_names->team_position->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_position->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_position" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_position" value="<?php echo ew_HtmlEncode($cpy_team_names->team_position->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
		<td data-name="team_text">
<?php if ($cpy_team_names->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_team_names_team_text" class="form-group cpy_team_names_team_text">
<?php ew_AppendClass($cpy_team_names->team_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_team_names" data-field="x_team_text" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_text->getPlaceHolder()) ?>"<?php echo $cpy_team_names->team_text->EditAttributes() ?>><?php echo $cpy_team_names->team_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_team_namesgrid", "x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text", 35, 8, <?php echo ($cpy_team_names->team_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_team_names_team_text" class="form-group cpy_team_names_team_text">
<span<?php echo $cpy_team_names->team_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="x<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_team_names" data-field="x_team_text" name="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" id="o<?php echo $cpy_team_names_grid->RowIndex ?>_team_text" value="<?php echo ew_HtmlEncode($cpy_team_names->team_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_team_names_grid->ListOptions->Render("body", "right", $cpy_team_names_grid->RowIndex);
?>
<script type="text/javascript">
fcpy_team_namesgrid.UpdateOpts(<?php echo $cpy_team_names_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cpy_team_names->CurrentMode == "add" || $cpy_team_names->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cpy_team_names_grid->FormKeyCountName ?>" id="<?php echo $cpy_team_names_grid->FormKeyCountName ?>" value="<?php echo $cpy_team_names_grid->KeyCount ?>">
<?php echo $cpy_team_names_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_team_names->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cpy_team_names_grid->FormKeyCountName ?>" id="<?php echo $cpy_team_names_grid->FormKeyCountName ?>" value="<?php echo $cpy_team_names_grid->KeyCount ?>">
<?php echo $cpy_team_names_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_team_names->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcpy_team_namesgrid">
</div>
<?php

// Close recordset
if ($cpy_team_names_grid->Recordset)
	$cpy_team_names_grid->Recordset->Close();
?>
<?php if ($cpy_team_names_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($cpy_team_names_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cpy_team_names_grid->TotalRecs == 0 && $cpy_team_names->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_team_names_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cpy_team_names->Export == "") { ?>
<script type="text/javascript">
fcpy_team_namesgrid.Init();
</script>
<?php } ?>
<?php
$cpy_team_names_grid->Page_Terminate();
?>
