<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_slider_trn_grid)) $cpy_slider_trn_grid = new ccpy_slider_trn_grid();

// Page init
$cpy_slider_trn_grid->Page_Init();

// Page main
$cpy_slider_trn_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_slider_trn_grid->Page_Render();
?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcpy_slider_trngrid = new ew_Form("fcpy_slider_trngrid", "grid");
fcpy_slider_trngrid.FormKeyCountName = '<?php echo $cpy_slider_trn_grid->FormKeyCountName ?>';

// Validate form
fcpy_slider_trngrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_slid_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_id->FldCaption(), $cpy_slider_trn->slid_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_order->FldCaption(), $cpy_slider_trn->slid_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_slider_trn->slid_order->FldErrMsg()) ?>");
			felm = this.GetElements("x" + infix + "_slid_photo");
			elm = this.GetElements("fn_x" + infix + "_slid_photo");
			if (felm && elm && !ew_HasValue(elm))
				return this.OnError(felm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_photo->FldCaption(), $cpy_slider_trn->slid_photo->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcpy_slider_trngrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "slid_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_order", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_header", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_link", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_label", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_photo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fcpy_slider_trngrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_slider_trngrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_slider_trngrid.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_slider_trngrid.Lists["x_slid_id"].Data = "<?php echo $cpy_slider_trn_grid->slid_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($cpy_slider_trn->CurrentAction == "gridadd") {
	if ($cpy_slider_trn->CurrentMode == "copy") {
		$bSelectLimit = $cpy_slider_trn_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cpy_slider_trn_grid->TotalRecs = $cpy_slider_trn->ListRecordCount();
			$cpy_slider_trn_grid->Recordset = $cpy_slider_trn_grid->LoadRecordset($cpy_slider_trn_grid->StartRec-1, $cpy_slider_trn_grid->DisplayRecs);
		} else {
			if ($cpy_slider_trn_grid->Recordset = $cpy_slider_trn_grid->LoadRecordset())
				$cpy_slider_trn_grid->TotalRecs = $cpy_slider_trn_grid->Recordset->RecordCount();
		}
		$cpy_slider_trn_grid->StartRec = 1;
		$cpy_slider_trn_grid->DisplayRecs = $cpy_slider_trn_grid->TotalRecs;
	} else {
		$cpy_slider_trn->CurrentFilter = "0=1";
		$cpy_slider_trn_grid->StartRec = 1;
		$cpy_slider_trn_grid->DisplayRecs = $cpy_slider_trn->GridAddRowCount;
	}
	$cpy_slider_trn_grid->TotalRecs = $cpy_slider_trn_grid->DisplayRecs;
	$cpy_slider_trn_grid->StopRec = $cpy_slider_trn_grid->DisplayRecs;
} else {
	$bSelectLimit = $cpy_slider_trn_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cpy_slider_trn_grid->TotalRecs <= 0)
			$cpy_slider_trn_grid->TotalRecs = $cpy_slider_trn->ListRecordCount();
	} else {
		if (!$cpy_slider_trn_grid->Recordset && ($cpy_slider_trn_grid->Recordset = $cpy_slider_trn_grid->LoadRecordset()))
			$cpy_slider_trn_grid->TotalRecs = $cpy_slider_trn_grid->Recordset->RecordCount();
	}
	$cpy_slider_trn_grid->StartRec = 1;
	$cpy_slider_trn_grid->DisplayRecs = $cpy_slider_trn_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cpy_slider_trn_grid->Recordset = $cpy_slider_trn_grid->LoadRecordset($cpy_slider_trn_grid->StartRec-1, $cpy_slider_trn_grid->DisplayRecs);

	// Set no record found message
	if ($cpy_slider_trn->CurrentAction == "" && $cpy_slider_trn_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cpy_slider_trn_grid->setWarningMessage(ew_DeniedMsg());
		if ($cpy_slider_trn_grid->SearchWhere == "0=101")
			$cpy_slider_trn_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cpy_slider_trn_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cpy_slider_trn_grid->RenderOtherOptions();
?>
<?php $cpy_slider_trn_grid->ShowPageHeader(); ?>
<?php
$cpy_slider_trn_grid->ShowMessage();
?>
<?php if ($cpy_slider_trn_grid->TotalRecs > 0 || $cpy_slider_trn->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($cpy_slider_trn_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> cpy_slider_trn">
<div id="fcpy_slider_trngrid" class="ewForm ewListForm form-inline">
<?php if ($cpy_slider_trn_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($cpy_slider_trn_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_cpy_slider_trn" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_cpy_slider_trngrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$cpy_slider_trn_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cpy_slider_trn_grid->RenderListOptions();

// Render list options (header, left)
$cpy_slider_trn_grid->ListOptions->Render("header", "left");
?>
<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_id) == "") { ?>
		<th data-name="slid_id" class="<?php echo $cpy_slider_trn->slid_id->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_id" class="cpy_slider_trn_slid_id"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_id" class="<?php echo $cpy_slider_trn->slid_id->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_id" class="cpy_slider_trn_slid_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_order) == "") { ?>
		<th data-name="slid_order" class="<?php echo $cpy_slider_trn->slid_order->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_order" class="cpy_slider_trn_slid_order"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_order->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_order" class="<?php echo $cpy_slider_trn->slid_order->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_order" class="cpy_slider_trn_slid_order">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_order->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_order->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_order->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_header) == "") { ?>
		<th data-name="slid_header" class="<?php echo $cpy_slider_trn->slid_header->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_header" class="cpy_slider_trn_slid_header"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_header->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_header" class="<?php echo $cpy_slider_trn->slid_header->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_header" class="cpy_slider_trn_slid_header">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_header->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_header->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_header->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_link) == "") { ?>
		<th data-name="slid_link" class="<?php echo $cpy_slider_trn->slid_link->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_link" class="cpy_slider_trn_slid_link"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_link->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_link" class="<?php echo $cpy_slider_trn->slid_link->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_link" class="cpy_slider_trn_slid_link">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_link->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_link->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_link->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_label) == "") { ?>
		<th data-name="slid_label" class="<?php echo $cpy_slider_trn->slid_label->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_label" class="cpy_slider_trn_slid_label"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_label->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_label" class="<?php echo $cpy_slider_trn->slid_label->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_label" class="cpy_slider_trn_slid_label">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_label->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_label->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_label->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_photo) == "") { ?>
		<th data-name="slid_photo" class="<?php echo $cpy_slider_trn->slid_photo->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_photo" class="cpy_slider_trn_slid_photo"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_photo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_photo" class="<?php echo $cpy_slider_trn->slid_photo->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_photo" class="cpy_slider_trn_slid_photo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_photo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_photo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_photo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_text) == "") { ?>
		<th data-name="slid_text" class="<?php echo $cpy_slider_trn->slid_text->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_text" class="cpy_slider_trn_slid_text"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_text" class="<?php echo $cpy_slider_trn->slid_text->HeaderCellClass() ?>"><div><div id="elh_cpy_slider_trn_slid_text" class="cpy_slider_trn_slid_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cpy_slider_trn_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cpy_slider_trn_grid->StartRec = 1;
$cpy_slider_trn_grid->StopRec = $cpy_slider_trn_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cpy_slider_trn_grid->FormKeyCountName) && ($cpy_slider_trn->CurrentAction == "gridadd" || $cpy_slider_trn->CurrentAction == "gridedit" || $cpy_slider_trn->CurrentAction == "F")) {
		$cpy_slider_trn_grid->KeyCount = $objForm->GetValue($cpy_slider_trn_grid->FormKeyCountName);
		$cpy_slider_trn_grid->StopRec = $cpy_slider_trn_grid->StartRec + $cpy_slider_trn_grid->KeyCount - 1;
	}
}
$cpy_slider_trn_grid->RecCnt = $cpy_slider_trn_grid->StartRec - 1;
if ($cpy_slider_trn_grid->Recordset && !$cpy_slider_trn_grid->Recordset->EOF) {
	$cpy_slider_trn_grid->Recordset->MoveFirst();
	$bSelectLimit = $cpy_slider_trn_grid->UseSelectLimit;
	if (!$bSelectLimit && $cpy_slider_trn_grid->StartRec > 1)
		$cpy_slider_trn_grid->Recordset->Move($cpy_slider_trn_grid->StartRec - 1);
} elseif (!$cpy_slider_trn->AllowAddDeleteRow && $cpy_slider_trn_grid->StopRec == 0) {
	$cpy_slider_trn_grid->StopRec = $cpy_slider_trn->GridAddRowCount;
}

// Initialize aggregate
$cpy_slider_trn->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cpy_slider_trn->ResetAttrs();
$cpy_slider_trn_grid->RenderRow();
if ($cpy_slider_trn->CurrentAction == "gridadd")
	$cpy_slider_trn_grid->RowIndex = 0;
if ($cpy_slider_trn->CurrentAction == "gridedit")
	$cpy_slider_trn_grid->RowIndex = 0;
while ($cpy_slider_trn_grid->RecCnt < $cpy_slider_trn_grid->StopRec) {
	$cpy_slider_trn_grid->RecCnt++;
	if (intval($cpy_slider_trn_grid->RecCnt) >= intval($cpy_slider_trn_grid->StartRec)) {
		$cpy_slider_trn_grid->RowCnt++;
		if ($cpy_slider_trn->CurrentAction == "gridadd" || $cpy_slider_trn->CurrentAction == "gridedit" || $cpy_slider_trn->CurrentAction == "F") {
			$cpy_slider_trn_grid->RowIndex++;
			$objForm->Index = $cpy_slider_trn_grid->RowIndex;
			if ($objForm->HasValue($cpy_slider_trn_grid->FormActionName))
				$cpy_slider_trn_grid->RowAction = strval($objForm->GetValue($cpy_slider_trn_grid->FormActionName));
			elseif ($cpy_slider_trn->CurrentAction == "gridadd")
				$cpy_slider_trn_grid->RowAction = "insert";
			else
				$cpy_slider_trn_grid->RowAction = "";
		}

		// Set up key count
		$cpy_slider_trn_grid->KeyCount = $cpy_slider_trn_grid->RowIndex;

		// Init row class and style
		$cpy_slider_trn->ResetAttrs();
		$cpy_slider_trn->CssClass = "";
		if ($cpy_slider_trn->CurrentAction == "gridadd") {
			if ($cpy_slider_trn->CurrentMode == "copy") {
				$cpy_slider_trn_grid->LoadRowValues($cpy_slider_trn_grid->Recordset); // Load row values
				$cpy_slider_trn_grid->SetRecordKey($cpy_slider_trn_grid->RowOldKey, $cpy_slider_trn_grid->Recordset); // Set old record key
			} else {
				$cpy_slider_trn_grid->LoadRowValues(); // Load default values
				$cpy_slider_trn_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cpy_slider_trn_grid->LoadRowValues($cpy_slider_trn_grid->Recordset); // Load row values
		}
		$cpy_slider_trn->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cpy_slider_trn->CurrentAction == "gridadd") // Grid add
			$cpy_slider_trn->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cpy_slider_trn->CurrentAction == "gridadd" && $cpy_slider_trn->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cpy_slider_trn_grid->RestoreCurrentRowFormValues($cpy_slider_trn_grid->RowIndex); // Restore form values
		if ($cpy_slider_trn->CurrentAction == "gridedit") { // Grid edit
			if ($cpy_slider_trn->EventCancelled) {
				$cpy_slider_trn_grid->RestoreCurrentRowFormValues($cpy_slider_trn_grid->RowIndex); // Restore form values
			}
			if ($cpy_slider_trn_grid->RowAction == "insert")
				$cpy_slider_trn->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cpy_slider_trn->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cpy_slider_trn->CurrentAction == "gridedit" && ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT || $cpy_slider_trn->RowType == EW_ROWTYPE_ADD) && $cpy_slider_trn->EventCancelled) // Update failed
			$cpy_slider_trn_grid->RestoreCurrentRowFormValues($cpy_slider_trn_grid->RowIndex); // Restore form values
		if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cpy_slider_trn_grid->EditRowCnt++;
		if ($cpy_slider_trn->CurrentAction == "F") // Confirm row
			$cpy_slider_trn_grid->RestoreCurrentRowFormValues($cpy_slider_trn_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cpy_slider_trn->RowAttrs = array_merge($cpy_slider_trn->RowAttrs, array('data-rowindex'=>$cpy_slider_trn_grid->RowCnt, 'id'=>'r' . $cpy_slider_trn_grid->RowCnt . '_cpy_slider_trn', 'data-rowtype'=>$cpy_slider_trn->RowType));

		// Render row
		$cpy_slider_trn_grid->RenderRow();

		// Render list options
		$cpy_slider_trn_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cpy_slider_trn_grid->RowAction <> "delete" && $cpy_slider_trn_grid->RowAction <> "insertdelete" && !($cpy_slider_trn_grid->RowAction == "insert" && $cpy_slider_trn->CurrentAction == "F" && $cpy_slider_trn_grid->EmptyRow())) {
?>
	<tr<?php echo $cpy_slider_trn->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_slider_trn_grid->ListOptions->Render("body", "left", $cpy_slider_trn_grid->RowCnt);
?>
	<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id"<?php echo $cpy_slider_trn->slid_id->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_id" class="cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_tslid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_tslid_id" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_tslid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->tslid_id->CurrentValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_tslid_id" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_tslid_id" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_tslid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->tslid_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT || $cpy_slider_trn->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_tslid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_tslid_id" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_tslid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->tslid_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
		<td data-name="slid_order"<?php echo $cpy_slider_trn->slid_order->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_order" class="cpy_slider_trn_slid_order">
<span<?php echo $cpy_slider_trn->slid_order->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_order->ListViewValue() ?></span>
</span>
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
		<td data-name="slid_header"<?php echo $cpy_slider_trn->slid_header->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_header" class="cpy_slider_trn_slid_header">
<span<?php echo $cpy_slider_trn->slid_header->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_header->ListViewValue() ?></span>
</span>
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
		<td data-name="slid_link"<?php echo $cpy_slider_trn->slid_link->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_link" class="cpy_slider_trn_slid_link">
<span<?php echo $cpy_slider_trn->slid_link->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_link->ListViewValue() ?></span>
</span>
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
		<td data-name="slid_label"<?php echo $cpy_slider_trn->slid_label->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_label" class="cpy_slider_trn_slid_label">
<span<?php echo $cpy_slider_trn->slid_label->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_label->ListViewValue() ?></span>
</span>
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
		<td data-name="slid_photo"<?php echo $cpy_slider_trn->slid_photo->CellAttributes() ?>>
<?php if ($cpy_slider_trn_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_photo" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_photo->OldValue) ?>">
<?php } elseif ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_photo" class="cpy_slider_trn_slid_photo">
<span>
<?php echo ew_GetFileViewTag($cpy_slider_trn->slid_photo, $cpy_slider_trn->slid_photo->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
		<td data-name="slid_text"<?php echo $cpy_slider_trn->slid_text->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trngrid", "x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trngrid", "x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_grid->RowCnt ?>_cpy_slider_trn_slid_text" class="cpy_slider_trn_slid_text">
<span<?php echo $cpy_slider_trn->slid_text->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_text->ListViewValue() ?></span>
</span>
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="fcpy_slider_trngrid$x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->FormValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="fcpy_slider_trngrid$o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_slider_trn_grid->ListOptions->Render("body", "right", $cpy_slider_trn_grid->RowCnt);
?>
	</tr>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD || $cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcpy_slider_trngrid.UpdateOpts(<?php echo $cpy_slider_trn_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cpy_slider_trn->CurrentAction <> "gridadd" || $cpy_slider_trn->CurrentMode == "copy")
		if (!$cpy_slider_trn_grid->Recordset->EOF) $cpy_slider_trn_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cpy_slider_trn->CurrentMode == "add" || $cpy_slider_trn->CurrentMode == "copy" || $cpy_slider_trn->CurrentMode == "edit") {
		$cpy_slider_trn_grid->RowIndex = '$rowindex$';
		$cpy_slider_trn_grid->LoadRowValues();

		// Set row properties
		$cpy_slider_trn->ResetAttrs();
		$cpy_slider_trn->RowAttrs = array_merge($cpy_slider_trn->RowAttrs, array('data-rowindex'=>$cpy_slider_trn_grid->RowIndex, 'id'=>'r0_cpy_slider_trn', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cpy_slider_trn->RowAttrs["class"], "ewTemplate");
		$cpy_slider_trn->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_slider_trn_grid->RenderRow();

		// Render list options
		$cpy_slider_trn_grid->RenderListOptions();
		$cpy_slider_trn_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_slider_trn->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_slider_trn_grid->ListOptions->Render("body", "left", $cpy_slider_trn_grid->RowIndex);
?>
	<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id">
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
		<td data-name="slid_order">
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<span<?php echo $cpy_slider_trn->slid_order->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_order->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
		<td data-name="slid_header">
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<span<?php echo $cpy_slider_trn->slid_header->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_header->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
		<td data-name="slid_link">
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<span<?php echo $cpy_slider_trn->slid_link->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_link->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
		<td data-name="slid_label">
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<span<?php echo $cpy_slider_trn->slid_label->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_label->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
		<td data-name="slid_photo">
<span id="el$rowindex$_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_photo" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_photo" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_photo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
		<td data-name="slid_text">
<?php if ($cpy_slider_trn->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trngrid", "x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<span<?php echo $cpy_slider_trn->slid_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" id="o<?php echo $cpy_slider_trn_grid->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_slider_trn_grid->ListOptions->Render("body", "right", $cpy_slider_trn_grid->RowIndex);
?>
<script type="text/javascript">
fcpy_slider_trngrid.UpdateOpts(<?php echo $cpy_slider_trn_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cpy_slider_trn->CurrentMode == "add" || $cpy_slider_trn->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cpy_slider_trn_grid->FormKeyCountName ?>" id="<?php echo $cpy_slider_trn_grid->FormKeyCountName ?>" value="<?php echo $cpy_slider_trn_grid->KeyCount ?>">
<?php echo $cpy_slider_trn_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_slider_trn->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cpy_slider_trn_grid->FormKeyCountName ?>" id="<?php echo $cpy_slider_trn_grid->FormKeyCountName ?>" value="<?php echo $cpy_slider_trn_grid->KeyCount ?>">
<?php echo $cpy_slider_trn_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_slider_trn->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcpy_slider_trngrid">
</div>
<?php

// Close recordset
if ($cpy_slider_trn_grid->Recordset)
	$cpy_slider_trn_grid->Recordset->Close();
?>
<?php if ($cpy_slider_trn_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($cpy_slider_trn_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cpy_slider_trn_grid->TotalRecs == 0 && $cpy_slider_trn->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_slider_trn_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<script type="text/javascript">
fcpy_slider_trngrid.Init();
</script>
<?php } ?>
<?php
$cpy_slider_trn_grid->Page_Terminate();
?>
