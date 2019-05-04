<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_page_row_grid)) $cpy_page_row_grid = new ccpy_page_row_grid();

// Page init
$cpy_page_row_grid->Page_Init();

// Page main
$cpy_page_row_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_page_row_grid->Page_Render();
?>
<?php if ($cpy_page_row->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcpy_page_rowgrid = new ew_Form("fcpy_page_rowgrid", "grid");
fcpy_page_rowgrid.FormKeyCountName = '<?php echo $cpy_page_row_grid->FormKeyCountName ?>';

// Validate form
fcpy_page_rowgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_page_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->page_id->FldCaption(), $cpy_page_row->page_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->lang_id->FldCaption(), $cpy_page_row->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->status_id->FldCaption(), $cpy_page_row->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_color_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->color_id->FldCaption(), $cpy_page_row->color_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->slid_id->FldCaption(), $cpy_page_row->slid_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_row_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->row_order->FldCaption(), $cpy_page_row->row_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_row_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_page_row->row_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_row_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->row_name->FldCaption(), $cpy_page_row->row_name->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcpy_page_rowgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "page_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "status_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "color_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "row_order", false)) return false;
	if (ew_ValueChanged(fobj, infix, "row_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "row_stext", false)) return false;
	return true;
}

// Form_CustomValidate event
fcpy_page_rowgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_page_rowgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_page_rowgrid.Lists["x_page_id"] = {"LinkField":"x_page_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_page_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_page"};
fcpy_page_rowgrid.Lists["x_page_id"].Data = "<?php echo $cpy_page_row_grid->page_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_rowgrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_page_rowgrid.Lists["x_lang_id"].Data = "<?php echo $cpy_page_row_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_rowgrid.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_page_rowgrid.Lists["x_status_id"].Data = "<?php echo $cpy_page_row_grid->status_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_rowgrid.Lists["x_color_id"] = {"LinkField":"x_color_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_color_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_color"};
fcpy_page_rowgrid.Lists["x_color_id"].Data = "<?php echo $cpy_page_row_grid->color_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_rowgrid.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_page_rowgrid.Lists["x_slid_id"].Data = "<?php echo $cpy_page_row_grid->slid_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($cpy_page_row->CurrentAction == "gridadd") {
	if ($cpy_page_row->CurrentMode == "copy") {
		$bSelectLimit = $cpy_page_row_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cpy_page_row_grid->TotalRecs = $cpy_page_row->ListRecordCount();
			$cpy_page_row_grid->Recordset = $cpy_page_row_grid->LoadRecordset($cpy_page_row_grid->StartRec-1, $cpy_page_row_grid->DisplayRecs);
		} else {
			if ($cpy_page_row_grid->Recordset = $cpy_page_row_grid->LoadRecordset())
				$cpy_page_row_grid->TotalRecs = $cpy_page_row_grid->Recordset->RecordCount();
		}
		$cpy_page_row_grid->StartRec = 1;
		$cpy_page_row_grid->DisplayRecs = $cpy_page_row_grid->TotalRecs;
	} else {
		$cpy_page_row->CurrentFilter = "0=1";
		$cpy_page_row_grid->StartRec = 1;
		$cpy_page_row_grid->DisplayRecs = $cpy_page_row->GridAddRowCount;
	}
	$cpy_page_row_grid->TotalRecs = $cpy_page_row_grid->DisplayRecs;
	$cpy_page_row_grid->StopRec = $cpy_page_row_grid->DisplayRecs;
} else {
	$bSelectLimit = $cpy_page_row_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cpy_page_row_grid->TotalRecs <= 0)
			$cpy_page_row_grid->TotalRecs = $cpy_page_row->ListRecordCount();
	} else {
		if (!$cpy_page_row_grid->Recordset && ($cpy_page_row_grid->Recordset = $cpy_page_row_grid->LoadRecordset()))
			$cpy_page_row_grid->TotalRecs = $cpy_page_row_grid->Recordset->RecordCount();
	}
	$cpy_page_row_grid->StartRec = 1;
	$cpy_page_row_grid->DisplayRecs = $cpy_page_row_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cpy_page_row_grid->Recordset = $cpy_page_row_grid->LoadRecordset($cpy_page_row_grid->StartRec-1, $cpy_page_row_grid->DisplayRecs);

	// Set no record found message
	if ($cpy_page_row->CurrentAction == "" && $cpy_page_row_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cpy_page_row_grid->setWarningMessage(ew_DeniedMsg());
		if ($cpy_page_row_grid->SearchWhere == "0=101")
			$cpy_page_row_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cpy_page_row_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cpy_page_row_grid->RenderOtherOptions();
?>
<?php $cpy_page_row_grid->ShowPageHeader(); ?>
<?php
$cpy_page_row_grid->ShowMessage();
?>
<?php if ($cpy_page_row_grid->TotalRecs > 0 || $cpy_page_row->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($cpy_page_row_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> cpy_page_row">
<div id="fcpy_page_rowgrid" class="ewForm ewListForm form-inline">
<?php if ($cpy_page_row_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($cpy_page_row_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_cpy_page_row" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_cpy_page_rowgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$cpy_page_row_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cpy_page_row_grid->RenderListOptions();

// Render list options (header, left)
$cpy_page_row_grid->ListOptions->Render("header", "left");
?>
<?php if ($cpy_page_row->page_id->Visible) { // page_id ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->page_id) == "") { ?>
		<th data-name="page_id" class="<?php echo $cpy_page_row->page_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_page_id" class="cpy_page_row_page_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->page_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="page_id" class="<?php echo $cpy_page_row->page_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_page_id" class="cpy_page_row_page_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->page_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->page_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->page_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->lang_id->Visible) { // lang_id ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $cpy_page_row->lang_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_lang_id" class="cpy_page_row_lang_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $cpy_page_row->lang_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_lang_id" class="cpy_page_row_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->status_id->Visible) { // status_id ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $cpy_page_row->status_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_status_id" class="cpy_page_row_status_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $cpy_page_row->status_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_status_id" class="cpy_page_row_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->color_id->Visible) { // color_id ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->color_id) == "") { ?>
		<th data-name="color_id" class="<?php echo $cpy_page_row->color_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_color_id" class="cpy_page_row_color_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->color_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="color_id" class="<?php echo $cpy_page_row->color_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_color_id" class="cpy_page_row_color_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->color_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->color_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->color_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->slid_id->Visible) { // slid_id ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->slid_id) == "") { ?>
		<th data-name="slid_id" class="<?php echo $cpy_page_row->slid_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_slid_id" class="cpy_page_row_slid_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->slid_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_id" class="<?php echo $cpy_page_row->slid_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_slid_id" class="cpy_page_row_slid_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->slid_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->slid_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->slid_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->row_order->Visible) { // row_order ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->row_order) == "") { ?>
		<th data-name="row_order" class="<?php echo $cpy_page_row->row_order->HeaderCellClass() ?>"><div id="elh_cpy_page_row_row_order" class="cpy_page_row_row_order"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->row_order->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="row_order" class="<?php echo $cpy_page_row->row_order->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_row_order" class="cpy_page_row_row_order">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->row_order->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->row_order->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->row_order->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->row_name->Visible) { // row_name ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->row_name) == "") { ?>
		<th data-name="row_name" class="<?php echo $cpy_page_row->row_name->HeaderCellClass() ?>"><div id="elh_cpy_page_row_row_name" class="cpy_page_row_row_name"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->row_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="row_name" class="<?php echo $cpy_page_row->row_name->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_row_name" class="cpy_page_row_row_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->row_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->row_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->row_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->row_stext->Visible) { // row_stext ?>
	<?php if ($cpy_page_row->SortUrl($cpy_page_row->row_stext) == "") { ?>
		<th data-name="row_stext" class="<?php echo $cpy_page_row->row_stext->HeaderCellClass() ?>"><div id="elh_cpy_page_row_row_stext" class="cpy_page_row_row_stext"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row->row_stext->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="row_stext" class="<?php echo $cpy_page_row->row_stext->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_row_stext" class="cpy_page_row_row_stext">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row->row_stext->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row->row_stext->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row->row_stext->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cpy_page_row_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cpy_page_row_grid->StartRec = 1;
$cpy_page_row_grid->StopRec = $cpy_page_row_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cpy_page_row_grid->FormKeyCountName) && ($cpy_page_row->CurrentAction == "gridadd" || $cpy_page_row->CurrentAction == "gridedit" || $cpy_page_row->CurrentAction == "F")) {
		$cpy_page_row_grid->KeyCount = $objForm->GetValue($cpy_page_row_grid->FormKeyCountName);
		$cpy_page_row_grid->StopRec = $cpy_page_row_grid->StartRec + $cpy_page_row_grid->KeyCount - 1;
	}
}
$cpy_page_row_grid->RecCnt = $cpy_page_row_grid->StartRec - 1;
if ($cpy_page_row_grid->Recordset && !$cpy_page_row_grid->Recordset->EOF) {
	$cpy_page_row_grid->Recordset->MoveFirst();
	$bSelectLimit = $cpy_page_row_grid->UseSelectLimit;
	if (!$bSelectLimit && $cpy_page_row_grid->StartRec > 1)
		$cpy_page_row_grid->Recordset->Move($cpy_page_row_grid->StartRec - 1);
} elseif (!$cpy_page_row->AllowAddDeleteRow && $cpy_page_row_grid->StopRec == 0) {
	$cpy_page_row_grid->StopRec = $cpy_page_row->GridAddRowCount;
}

// Initialize aggregate
$cpy_page_row->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cpy_page_row->ResetAttrs();
$cpy_page_row_grid->RenderRow();
if ($cpy_page_row->CurrentAction == "gridadd")
	$cpy_page_row_grid->RowIndex = 0;
if ($cpy_page_row->CurrentAction == "gridedit")
	$cpy_page_row_grid->RowIndex = 0;
while ($cpy_page_row_grid->RecCnt < $cpy_page_row_grid->StopRec) {
	$cpy_page_row_grid->RecCnt++;
	if (intval($cpy_page_row_grid->RecCnt) >= intval($cpy_page_row_grid->StartRec)) {
		$cpy_page_row_grid->RowCnt++;
		if ($cpy_page_row->CurrentAction == "gridadd" || $cpy_page_row->CurrentAction == "gridedit" || $cpy_page_row->CurrentAction == "F") {
			$cpy_page_row_grid->RowIndex++;
			$objForm->Index = $cpy_page_row_grid->RowIndex;
			if ($objForm->HasValue($cpy_page_row_grid->FormActionName))
				$cpy_page_row_grid->RowAction = strval($objForm->GetValue($cpy_page_row_grid->FormActionName));
			elseif ($cpy_page_row->CurrentAction == "gridadd")
				$cpy_page_row_grid->RowAction = "insert";
			else
				$cpy_page_row_grid->RowAction = "";
		}

		// Set up key count
		$cpy_page_row_grid->KeyCount = $cpy_page_row_grid->RowIndex;

		// Init row class and style
		$cpy_page_row->ResetAttrs();
		$cpy_page_row->CssClass = "";
		if ($cpy_page_row->CurrentAction == "gridadd") {
			if ($cpy_page_row->CurrentMode == "copy") {
				$cpy_page_row_grid->LoadRowValues($cpy_page_row_grid->Recordset); // Load row values
				$cpy_page_row_grid->SetRecordKey($cpy_page_row_grid->RowOldKey, $cpy_page_row_grid->Recordset); // Set old record key
			} else {
				$cpy_page_row_grid->LoadRowValues(); // Load default values
				$cpy_page_row_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cpy_page_row_grid->LoadRowValues($cpy_page_row_grid->Recordset); // Load row values
		}
		$cpy_page_row->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cpy_page_row->CurrentAction == "gridadd") // Grid add
			$cpy_page_row->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cpy_page_row->CurrentAction == "gridadd" && $cpy_page_row->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cpy_page_row_grid->RestoreCurrentRowFormValues($cpy_page_row_grid->RowIndex); // Restore form values
		if ($cpy_page_row->CurrentAction == "gridedit") { // Grid edit
			if ($cpy_page_row->EventCancelled) {
				$cpy_page_row_grid->RestoreCurrentRowFormValues($cpy_page_row_grid->RowIndex); // Restore form values
			}
			if ($cpy_page_row_grid->RowAction == "insert")
				$cpy_page_row->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cpy_page_row->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cpy_page_row->CurrentAction == "gridedit" && ($cpy_page_row->RowType == EW_ROWTYPE_EDIT || $cpy_page_row->RowType == EW_ROWTYPE_ADD) && $cpy_page_row->EventCancelled) // Update failed
			$cpy_page_row_grid->RestoreCurrentRowFormValues($cpy_page_row_grid->RowIndex); // Restore form values
		if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cpy_page_row_grid->EditRowCnt++;
		if ($cpy_page_row->CurrentAction == "F") // Confirm row
			$cpy_page_row_grid->RestoreCurrentRowFormValues($cpy_page_row_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cpy_page_row->RowAttrs = array_merge($cpy_page_row->RowAttrs, array('data-rowindex'=>$cpy_page_row_grid->RowCnt, 'id'=>'r' . $cpy_page_row_grid->RowCnt . '_cpy_page_row', 'data-rowtype'=>$cpy_page_row->RowType));

		// Render row
		$cpy_page_row_grid->RenderRow();

		// Render list options
		$cpy_page_row_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cpy_page_row_grid->RowAction <> "delete" && $cpy_page_row_grid->RowAction <> "insertdelete" && !($cpy_page_row_grid->RowAction == "insert" && $cpy_page_row->CurrentAction == "F" && $cpy_page_row_grid->EmptyRow())) {
?>
	<tr<?php echo $cpy_page_row->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_page_row_grid->ListOptions->Render("body", "left", $cpy_page_row_grid->RowCnt);
?>
	<?php if ($cpy_page_row->page_id->Visible) { // page_id ?>
		<td data-name="page_id"<?php echo $cpy_page_row->page_id->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cpy_page_row->page_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->page_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id"><?php echo (strval($cpy_page_row->page_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row->page_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row->page_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row->page_id->ReadOnly || $cpy_page_row->page_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row->page_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo $cpy_page_row->page_id->CurrentValue ?>"<?php echo $cpy_page_row->page_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cpy_page_row->page_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->page_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id"><?php echo (strval($cpy_page_row->page_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row->page_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row->page_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row->page_id->ReadOnly || $cpy_page_row->page_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row->page_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo $cpy_page_row->page_id->CurrentValue ?>"<?php echo $cpy_page_row->page_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_page_id" class="cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->page_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row->row_id->CurrentValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row->row_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT || $cpy_page_row->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row->row_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($cpy_page_row->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $cpy_page_row->lang_id->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_lang_id" class="form-group cpy_page_row_lang_id">
<select data-table="cpy_page_row" data-field="x_lang_id" data-value-separator="<?php echo $cpy_page_row->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id"<?php echo $cpy_page_row->lang_id->EditAttributes() ?>>
<?php echo $cpy_page_row->lang_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_lang_id" class="form-group cpy_page_row_lang_id">
<select data-table="cpy_page_row" data-field="x_lang_id" data-value-separator="<?php echo $cpy_page_row->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id"<?php echo $cpy_page_row->lang_id->EditAttributes() ?>>
<?php echo $cpy_page_row->lang_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_lang_id" class="cpy_page_row_lang_id">
<span<?php echo $cpy_page_row->lang_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->lang_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $cpy_page_row->status_id->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_status_id" class="form-group cpy_page_row_status_id">
<select data-table="cpy_page_row" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id"<?php echo $cpy_page_row->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row->status_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_status_id" class="form-group cpy_page_row_status_id">
<select data-table="cpy_page_row" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id"<?php echo $cpy_page_row->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row->status_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_status_id" class="cpy_page_row_status_id">
<span<?php echo $cpy_page_row->status_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->status_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row->color_id->Visible) { // color_id ?>
		<td data-name="color_id"<?php echo $cpy_page_row->color_id->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_color_id" class="form-group cpy_page_row_color_id">
<select data-table="cpy_page_row" data-field="x_color_id" data-value-separator="<?php echo $cpy_page_row->color_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id"<?php echo $cpy_page_row->color_id->EditAttributes() ?>>
<?php echo $cpy_page_row->color_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_color_id" class="form-group cpy_page_row_color_id">
<select data-table="cpy_page_row" data-field="x_color_id" data-value-separator="<?php echo $cpy_page_row->color_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id"<?php echo $cpy_page_row->color_id->EditAttributes() ?>>
<?php echo $cpy_page_row->color_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_color_id" class="cpy_page_row_color_id">
<span<?php echo $cpy_page_row->color_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->color_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id"<?php echo $cpy_page_row->slid_id->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_slid_id" class="form-group cpy_page_row_slid_id">
<select data-table="cpy_page_row" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id"<?php echo $cpy_page_row->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row->slid_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_slid_id" class="form-group cpy_page_row_slid_id">
<select data-table="cpy_page_row" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id"<?php echo $cpy_page_row->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row->slid_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_slid_id" class="cpy_page_row_slid_id">
<span<?php echo $cpy_page_row->slid_id->ViewAttributes() ?>>
<?php echo $cpy_page_row->slid_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row->row_order->Visible) { // row_order ?>
		<td data-name="row_order"<?php echo $cpy_page_row->row_order->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_order" class="form-group cpy_page_row_row_order">
<input type="text" data-table="cpy_page_row" data-field="x_row_order" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_order->EditValue ?>"<?php echo $cpy_page_row->row_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_order" class="form-group cpy_page_row_row_order">
<input type="text" data-table="cpy_page_row" data-field="x_row_order" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_order->EditValue ?>"<?php echo $cpy_page_row->row_order->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_order" class="cpy_page_row_row_order">
<span<?php echo $cpy_page_row->row_order->ViewAttributes() ?>>
<?php echo $cpy_page_row->row_order->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row->row_name->Visible) { // row_name ?>
		<td data-name="row_name"<?php echo $cpy_page_row->row_name->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_name" class="form-group cpy_page_row_row_name">
<input type="text" data-table="cpy_page_row" data-field="x_row_name" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_name->EditValue ?>"<?php echo $cpy_page_row->row_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_name" class="form-group cpy_page_row_row_name">
<input type="text" data-table="cpy_page_row" data-field="x_row_name" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_name->EditValue ?>"<?php echo $cpy_page_row->row_name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_name" class="cpy_page_row_row_name">
<span<?php echo $cpy_page_row->row_name->ViewAttributes() ?>>
<?php echo $cpy_page_row->row_name->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row->row_stext->Visible) { // row_stext ?>
		<td data-name="row_stext"<?php echo $cpy_page_row->row_stext->CellAttributes() ?>>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_stext" class="form-group cpy_page_row_row_stext">
<textarea data-table="cpy_page_row" data-field="x_row_stext" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row->row_stext->EditAttributes() ?>><?php echo $cpy_page_row->row_stext->EditValue ?></textarea>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_stext" class="form-group cpy_page_row_row_stext">
<textarea data-table="cpy_page_row" data-field="x_row_stext" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row->row_stext->EditAttributes() ?>><?php echo $cpy_page_row->row_stext->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_grid->RowCnt ?>_cpy_page_row_row_stext" class="cpy_page_row_row_stext">
<span<?php echo $cpy_page_row->row_stext->ViewAttributes() ?>>
<?php echo $cpy_page_row->row_stext->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="fcpy_page_rowgrid$x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="fcpy_page_rowgrid$o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_page_row_grid->ListOptions->Render("body", "right", $cpy_page_row_grid->RowCnt);
?>
	</tr>
<?php if ($cpy_page_row->RowType == EW_ROWTYPE_ADD || $cpy_page_row->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcpy_page_rowgrid.UpdateOpts(<?php echo $cpy_page_row_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cpy_page_row->CurrentAction <> "gridadd" || $cpy_page_row->CurrentMode == "copy")
		if (!$cpy_page_row_grid->Recordset->EOF) $cpy_page_row_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cpy_page_row->CurrentMode == "add" || $cpy_page_row->CurrentMode == "copy" || $cpy_page_row->CurrentMode == "edit") {
		$cpy_page_row_grid->RowIndex = '$rowindex$';
		$cpy_page_row_grid->LoadRowValues();

		// Set row properties
		$cpy_page_row->ResetAttrs();
		$cpy_page_row->RowAttrs = array_merge($cpy_page_row->RowAttrs, array('data-rowindex'=>$cpy_page_row_grid->RowIndex, 'id'=>'r0_cpy_page_row', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cpy_page_row->RowAttrs["class"], "ewTemplate");
		$cpy_page_row->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_page_row_grid->RenderRow();

		// Render list options
		$cpy_page_row_grid->RenderListOptions();
		$cpy_page_row_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_page_row->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_page_row_grid->ListOptions->Render("body", "left", $cpy_page_row_grid->RowIndex);
?>
	<?php if ($cpy_page_row->page_id->Visible) { // page_id ?>
		<td data-name="page_id">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<?php if ($cpy_page_row->page_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->page_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id"><?php echo (strval($cpy_page_row->page_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row->page_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row->page_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row->page_id->ReadOnly || $cpy_page_row->page_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row->page_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo $cpy_page_row->page_id->CurrentValue ?>"<?php echo $cpy_page_row->page_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_page_id" class="form-group cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->page_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_lang_id" class="form-group cpy_page_row_lang_id">
<select data-table="cpy_page_row" data-field="x_lang_id" data-value-separator="<?php echo $cpy_page_row->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id"<?php echo $cpy_page_row->lang_id->EditAttributes() ?>>
<?php echo $cpy_page_row->lang_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_lang_id" class="form-group cpy_page_row_lang_id">
<span<?php echo $cpy_page_row->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_lang_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_page_row->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->status_id->Visible) { // status_id ?>
		<td data-name="status_id">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_status_id" class="form-group cpy_page_row_status_id">
<select data-table="cpy_page_row" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id"<?php echo $cpy_page_row->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row->status_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_status_id" class="form-group cpy_page_row_status_id">
<span<?php echo $cpy_page_row->status_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->status_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_status_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row->status_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->color_id->Visible) { // color_id ?>
		<td data-name="color_id">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_color_id" class="form-group cpy_page_row_color_id">
<select data-table="cpy_page_row" data-field="x_color_id" data-value-separator="<?php echo $cpy_page_row->color_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id"<?php echo $cpy_page_row->color_id->EditAttributes() ?>>
<?php echo $cpy_page_row->color_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_color_id" class="form-group cpy_page_row_color_id">
<span<?php echo $cpy_page_row->color_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->color_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_color_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_page_row->color_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_slid_id" class="form-group cpy_page_row_slid_id">
<select data-table="cpy_page_row" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id"<?php echo $cpy_page_row->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row->slid_id->SelectOptionListHtml("x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_slid_id" class="form-group cpy_page_row_slid_id">
<span<?php echo $cpy_page_row->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_slid_id" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row->slid_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->row_order->Visible) { // row_order ?>
		<td data-name="row_order">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_row_order" class="form-group cpy_page_row_row_order">
<input type="text" data-table="cpy_page_row" data-field="x_row_order" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_order->EditValue ?>"<?php echo $cpy_page_row->row_order->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_row_order" class="form-group cpy_page_row_row_order">
<span<?php echo $cpy_page_row->row_order->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->row_order->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_order" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_order" value="<?php echo ew_HtmlEncode($cpy_page_row->row_order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->row_name->Visible) { // row_name ?>
		<td data-name="row_name">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_row_name" class="form-group cpy_page_row_row_name">
<input type="text" data-table="cpy_page_row" data-field="x_row_name" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_name->EditValue ?>"<?php echo $cpy_page_row->row_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_row_name" class="form-group cpy_page_row_row_name">
<span<?php echo $cpy_page_row->row_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->row_name->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_name" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_name" value="<?php echo ew_HtmlEncode($cpy_page_row->row_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row->row_stext->Visible) { // row_stext ?>
		<td data-name="row_stext">
<?php if ($cpy_page_row->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_row_stext" class="form-group cpy_page_row_row_stext">
<textarea data-table="cpy_page_row" data-field="x_row_stext" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row->row_stext->EditAttributes() ?>><?php echo $cpy_page_row->row_stext->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_row_stext" class="form-group cpy_page_row_row_stext">
<span<?php echo $cpy_page_row->row_stext->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->row_stext->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="x<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row" data-field="x_row_stext" name="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" id="o<?php echo $cpy_page_row_grid->RowIndex ?>_row_stext" value="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_page_row_grid->ListOptions->Render("body", "right", $cpy_page_row_grid->RowIndex);
?>
<script type="text/javascript">
fcpy_page_rowgrid.UpdateOpts(<?php echo $cpy_page_row_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cpy_page_row->CurrentMode == "add" || $cpy_page_row->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cpy_page_row_grid->FormKeyCountName ?>" id="<?php echo $cpy_page_row_grid->FormKeyCountName ?>" value="<?php echo $cpy_page_row_grid->KeyCount ?>">
<?php echo $cpy_page_row_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_page_row->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cpy_page_row_grid->FormKeyCountName ?>" id="<?php echo $cpy_page_row_grid->FormKeyCountName ?>" value="<?php echo $cpy_page_row_grid->KeyCount ?>">
<?php echo $cpy_page_row_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_page_row->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcpy_page_rowgrid">
</div>
<?php

// Close recordset
if ($cpy_page_row_grid->Recordset)
	$cpy_page_row_grid->Recordset->Close();
?>
<?php if ($cpy_page_row_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($cpy_page_row_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cpy_page_row_grid->TotalRecs == 0 && $cpy_page_row->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_page_row_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cpy_page_row->Export == "") { ?>
<script type="text/javascript">
fcpy_page_rowgrid.Init();
</script>
<?php } ?>
<?php
$cpy_page_row_grid->Page_Terminate();
?>
