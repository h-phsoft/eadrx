<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_page_row_block_grid)) $cpy_page_row_block_grid = new ccpy_page_row_block_grid();

// Page init
$cpy_page_row_block_grid->Page_Init();

// Page main
$cpy_page_row_block_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_page_row_block_grid->Page_Render();
?>
<?php if ($cpy_page_row_block->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcpy_page_row_blockgrid = new ew_Form("fcpy_page_row_blockgrid", "grid");
fcpy_page_row_blockgrid.FormKeyCountName = '<?php echo $cpy_page_row_block_grid->FormKeyCountName ?>';

// Validate form
fcpy_page_row_blockgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_row_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->row_id->FldCaption(), $cpy_page_row_block->row_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_type_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->type_id->FldCaption(), $cpy_page_row_block->type_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->slid_id->FldCaption(), $cpy_page_row_block->slid_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_video_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->video_id->FldCaption(), $cpy_page_row_block->video_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->status_id->FldCaption(), $cpy_page_row_block->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cols_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->cols_id->FldCaption(), $cpy_page_row_block->cols_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_blk_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->blk_order->FldCaption(), $cpy_page_row_block->blk_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_blk_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_page_row_block->blk_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_blk_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->blk_name->FldCaption(), $cpy_page_row_block->blk_name->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcpy_page_row_blockgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "row_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "type_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "video_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "status_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cols_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "blk_order", false)) return false;
	if (ew_ValueChanged(fobj, infix, "blk_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "blk_header", false)) return false;
	if (ew_ValueChanged(fobj, infix, "blk_image", false)) return false;
	if (ew_ValueChanged(fobj, infix, "blk_stext", false)) return false;
	return true;
}

// Form_CustomValidate event
fcpy_page_row_blockgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_page_row_blockgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_page_row_blockgrid.Lists["x_row_id"] = {"LinkField":"x_row_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_row_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_page_row"};
fcpy_page_row_blockgrid.Lists["x_row_id"].Data = "<?php echo $cpy_page_row_block_grid->row_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_row_blockgrid.Lists["x_type_id"] = {"LinkField":"x_type_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_type_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_block_type"};
fcpy_page_row_blockgrid.Lists["x_type_id"].Data = "<?php echo $cpy_page_row_block_grid->type_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_row_blockgrid.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_page_row_blockgrid.Lists["x_slid_id"].Data = "<?php echo $cpy_page_row_block_grid->slid_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_row_blockgrid.Lists["x_video_id"] = {"LinkField":"x_video_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_video_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_video"};
fcpy_page_row_blockgrid.Lists["x_video_id"].Data = "<?php echo $cpy_page_row_block_grid->video_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_row_blockgrid.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_page_row_blockgrid.Lists["x_status_id"].Data = "<?php echo $cpy_page_row_block_grid->status_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_page_row_blockgrid.Lists["x_cols_id"] = {"LinkField":"x_cols_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cols_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_cols"};
fcpy_page_row_blockgrid.Lists["x_cols_id"].Data = "<?php echo $cpy_page_row_block_grid->cols_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($cpy_page_row_block->CurrentAction == "gridadd") {
	if ($cpy_page_row_block->CurrentMode == "copy") {
		$bSelectLimit = $cpy_page_row_block_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cpy_page_row_block_grid->TotalRecs = $cpy_page_row_block->ListRecordCount();
			$cpy_page_row_block_grid->Recordset = $cpy_page_row_block_grid->LoadRecordset($cpy_page_row_block_grid->StartRec-1, $cpy_page_row_block_grid->DisplayRecs);
		} else {
			if ($cpy_page_row_block_grid->Recordset = $cpy_page_row_block_grid->LoadRecordset())
				$cpy_page_row_block_grid->TotalRecs = $cpy_page_row_block_grid->Recordset->RecordCount();
		}
		$cpy_page_row_block_grid->StartRec = 1;
		$cpy_page_row_block_grid->DisplayRecs = $cpy_page_row_block_grid->TotalRecs;
	} else {
		$cpy_page_row_block->CurrentFilter = "0=1";
		$cpy_page_row_block_grid->StartRec = 1;
		$cpy_page_row_block_grid->DisplayRecs = $cpy_page_row_block->GridAddRowCount;
	}
	$cpy_page_row_block_grid->TotalRecs = $cpy_page_row_block_grid->DisplayRecs;
	$cpy_page_row_block_grid->StopRec = $cpy_page_row_block_grid->DisplayRecs;
} else {
	$bSelectLimit = $cpy_page_row_block_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cpy_page_row_block_grid->TotalRecs <= 0)
			$cpy_page_row_block_grid->TotalRecs = $cpy_page_row_block->ListRecordCount();
	} else {
		if (!$cpy_page_row_block_grid->Recordset && ($cpy_page_row_block_grid->Recordset = $cpy_page_row_block_grid->LoadRecordset()))
			$cpy_page_row_block_grid->TotalRecs = $cpy_page_row_block_grid->Recordset->RecordCount();
	}
	$cpy_page_row_block_grid->StartRec = 1;
	$cpy_page_row_block_grid->DisplayRecs = $cpy_page_row_block_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cpy_page_row_block_grid->Recordset = $cpy_page_row_block_grid->LoadRecordset($cpy_page_row_block_grid->StartRec-1, $cpy_page_row_block_grid->DisplayRecs);

	// Set no record found message
	if ($cpy_page_row_block->CurrentAction == "" && $cpy_page_row_block_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cpy_page_row_block_grid->setWarningMessage(ew_DeniedMsg());
		if ($cpy_page_row_block_grid->SearchWhere == "0=101")
			$cpy_page_row_block_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cpy_page_row_block_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cpy_page_row_block_grid->RenderOtherOptions();
?>
<?php $cpy_page_row_block_grid->ShowPageHeader(); ?>
<?php
$cpy_page_row_block_grid->ShowMessage();
?>
<?php if ($cpy_page_row_block_grid->TotalRecs > 0 || $cpy_page_row_block->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($cpy_page_row_block_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> cpy_page_row_block">
<div id="fcpy_page_row_blockgrid" class="ewForm ewListForm form-inline">
<?php if ($cpy_page_row_block_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($cpy_page_row_block_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_cpy_page_row_block" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_cpy_page_row_blockgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$cpy_page_row_block_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cpy_page_row_block_grid->RenderListOptions();

// Render list options (header, left)
$cpy_page_row_block_grid->ListOptions->Render("header", "left");
?>
<?php if ($cpy_page_row_block->row_id->Visible) { // row_id ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->row_id) == "") { ?>
		<th data-name="row_id" class="<?php echo $cpy_page_row_block->row_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_row_id" class="cpy_page_row_block_row_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->row_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="row_id" class="<?php echo $cpy_page_row_block->row_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_row_id" class="cpy_page_row_block_row_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->row_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->row_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->row_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->type_id->Visible) { // type_id ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->type_id) == "") { ?>
		<th data-name="type_id" class="<?php echo $cpy_page_row_block->type_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_type_id" class="cpy_page_row_block_type_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->type_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_id" class="<?php echo $cpy_page_row_block->type_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_type_id" class="cpy_page_row_block_type_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->type_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->type_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->type_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->slid_id->Visible) { // slid_id ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->slid_id) == "") { ?>
		<th data-name="slid_id" class="<?php echo $cpy_page_row_block->slid_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_slid_id" class="cpy_page_row_block_slid_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->slid_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_id" class="<?php echo $cpy_page_row_block->slid_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_slid_id" class="cpy_page_row_block_slid_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->slid_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->slid_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->slid_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->video_id->Visible) { // video_id ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->video_id) == "") { ?>
		<th data-name="video_id" class="<?php echo $cpy_page_row_block->video_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_video_id" class="cpy_page_row_block_video_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->video_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="video_id" class="<?php echo $cpy_page_row_block->video_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_video_id" class="cpy_page_row_block_video_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->video_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->video_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->video_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->status_id->Visible) { // status_id ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $cpy_page_row_block->status_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_status_id" class="cpy_page_row_block_status_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $cpy_page_row_block->status_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_status_id" class="cpy_page_row_block_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->cols_id->Visible) { // cols_id ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->cols_id) == "") { ?>
		<th data-name="cols_id" class="<?php echo $cpy_page_row_block->cols_id->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_cols_id" class="cpy_page_row_block_cols_id"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->cols_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cols_id" class="<?php echo $cpy_page_row_block->cols_id->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_cols_id" class="cpy_page_row_block_cols_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->cols_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->cols_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->cols_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->blk_order->Visible) { // blk_order ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->blk_order) == "") { ?>
		<th data-name="blk_order" class="<?php echo $cpy_page_row_block->blk_order->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_blk_order" class="cpy_page_row_block_blk_order"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_order->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="blk_order" class="<?php echo $cpy_page_row_block->blk_order->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_blk_order" class="cpy_page_row_block_blk_order">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_order->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->blk_order->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->blk_order->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->blk_name->Visible) { // blk_name ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->blk_name) == "") { ?>
		<th data-name="blk_name" class="<?php echo $cpy_page_row_block->blk_name->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_blk_name" class="cpy_page_row_block_blk_name"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="blk_name" class="<?php echo $cpy_page_row_block->blk_name->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_blk_name" class="cpy_page_row_block_blk_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->blk_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->blk_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->blk_header->Visible) { // blk_header ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->blk_header) == "") { ?>
		<th data-name="blk_header" class="<?php echo $cpy_page_row_block->blk_header->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_blk_header" class="cpy_page_row_block_blk_header"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_header->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="blk_header" class="<?php echo $cpy_page_row_block->blk_header->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_blk_header" class="cpy_page_row_block_blk_header">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_header->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->blk_header->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->blk_header->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->blk_image->Visible) { // blk_image ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->blk_image) == "") { ?>
		<th data-name="blk_image" class="<?php echo $cpy_page_row_block->blk_image->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_blk_image" class="cpy_page_row_block_blk_image"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_image->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="blk_image" class="<?php echo $cpy_page_row_block->blk_image->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_blk_image" class="cpy_page_row_block_blk_image">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_image->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->blk_image->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->blk_image->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->blk_stext->Visible) { // blk_stext ?>
	<?php if ($cpy_page_row_block->SortUrl($cpy_page_row_block->blk_stext) == "") { ?>
		<th data-name="blk_stext" class="<?php echo $cpy_page_row_block->blk_stext->HeaderCellClass() ?>"><div id="elh_cpy_page_row_block_blk_stext" class="cpy_page_row_block_blk_stext"><div class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_stext->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="blk_stext" class="<?php echo $cpy_page_row_block->blk_stext->HeaderCellClass() ?>"><div><div id="elh_cpy_page_row_block_blk_stext" class="cpy_page_row_block_blk_stext">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_page_row_block->blk_stext->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_page_row_block->blk_stext->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_page_row_block->blk_stext->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cpy_page_row_block_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cpy_page_row_block_grid->StartRec = 1;
$cpy_page_row_block_grid->StopRec = $cpy_page_row_block_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cpy_page_row_block_grid->FormKeyCountName) && ($cpy_page_row_block->CurrentAction == "gridadd" || $cpy_page_row_block->CurrentAction == "gridedit" || $cpy_page_row_block->CurrentAction == "F")) {
		$cpy_page_row_block_grid->KeyCount = $objForm->GetValue($cpy_page_row_block_grid->FormKeyCountName);
		$cpy_page_row_block_grid->StopRec = $cpy_page_row_block_grid->StartRec + $cpy_page_row_block_grid->KeyCount - 1;
	}
}
$cpy_page_row_block_grid->RecCnt = $cpy_page_row_block_grid->StartRec - 1;
if ($cpy_page_row_block_grid->Recordset && !$cpy_page_row_block_grid->Recordset->EOF) {
	$cpy_page_row_block_grid->Recordset->MoveFirst();
	$bSelectLimit = $cpy_page_row_block_grid->UseSelectLimit;
	if (!$bSelectLimit && $cpy_page_row_block_grid->StartRec > 1)
		$cpy_page_row_block_grid->Recordset->Move($cpy_page_row_block_grid->StartRec - 1);
} elseif (!$cpy_page_row_block->AllowAddDeleteRow && $cpy_page_row_block_grid->StopRec == 0) {
	$cpy_page_row_block_grid->StopRec = $cpy_page_row_block->GridAddRowCount;
}

// Initialize aggregate
$cpy_page_row_block->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cpy_page_row_block->ResetAttrs();
$cpy_page_row_block_grid->RenderRow();
if ($cpy_page_row_block->CurrentAction == "gridadd")
	$cpy_page_row_block_grid->RowIndex = 0;
if ($cpy_page_row_block->CurrentAction == "gridedit")
	$cpy_page_row_block_grid->RowIndex = 0;
while ($cpy_page_row_block_grid->RecCnt < $cpy_page_row_block_grid->StopRec) {
	$cpy_page_row_block_grid->RecCnt++;
	if (intval($cpy_page_row_block_grid->RecCnt) >= intval($cpy_page_row_block_grid->StartRec)) {
		$cpy_page_row_block_grid->RowCnt++;
		if ($cpy_page_row_block->CurrentAction == "gridadd" || $cpy_page_row_block->CurrentAction == "gridedit" || $cpy_page_row_block->CurrentAction == "F") {
			$cpy_page_row_block_grid->RowIndex++;
			$objForm->Index = $cpy_page_row_block_grid->RowIndex;
			if ($objForm->HasValue($cpy_page_row_block_grid->FormActionName))
				$cpy_page_row_block_grid->RowAction = strval($objForm->GetValue($cpy_page_row_block_grid->FormActionName));
			elseif ($cpy_page_row_block->CurrentAction == "gridadd")
				$cpy_page_row_block_grid->RowAction = "insert";
			else
				$cpy_page_row_block_grid->RowAction = "";
		}

		// Set up key count
		$cpy_page_row_block_grid->KeyCount = $cpy_page_row_block_grid->RowIndex;

		// Init row class and style
		$cpy_page_row_block->ResetAttrs();
		$cpy_page_row_block->CssClass = "";
		if ($cpy_page_row_block->CurrentAction == "gridadd") {
			if ($cpy_page_row_block->CurrentMode == "copy") {
				$cpy_page_row_block_grid->LoadRowValues($cpy_page_row_block_grid->Recordset); // Load row values
				$cpy_page_row_block_grid->SetRecordKey($cpy_page_row_block_grid->RowOldKey, $cpy_page_row_block_grid->Recordset); // Set old record key
			} else {
				$cpy_page_row_block_grid->LoadRowValues(); // Load default values
				$cpy_page_row_block_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cpy_page_row_block_grid->LoadRowValues($cpy_page_row_block_grid->Recordset); // Load row values
		}
		$cpy_page_row_block->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cpy_page_row_block->CurrentAction == "gridadd") // Grid add
			$cpy_page_row_block->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cpy_page_row_block->CurrentAction == "gridadd" && $cpy_page_row_block->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cpy_page_row_block_grid->RestoreCurrentRowFormValues($cpy_page_row_block_grid->RowIndex); // Restore form values
		if ($cpy_page_row_block->CurrentAction == "gridedit") { // Grid edit
			if ($cpy_page_row_block->EventCancelled) {
				$cpy_page_row_block_grid->RestoreCurrentRowFormValues($cpy_page_row_block_grid->RowIndex); // Restore form values
			}
			if ($cpy_page_row_block_grid->RowAction == "insert")
				$cpy_page_row_block->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cpy_page_row_block->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cpy_page_row_block->CurrentAction == "gridedit" && ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT || $cpy_page_row_block->RowType == EW_ROWTYPE_ADD) && $cpy_page_row_block->EventCancelled) // Update failed
			$cpy_page_row_block_grid->RestoreCurrentRowFormValues($cpy_page_row_block_grid->RowIndex); // Restore form values
		if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cpy_page_row_block_grid->EditRowCnt++;
		if ($cpy_page_row_block->CurrentAction == "F") // Confirm row
			$cpy_page_row_block_grid->RestoreCurrentRowFormValues($cpy_page_row_block_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cpy_page_row_block->RowAttrs = array_merge($cpy_page_row_block->RowAttrs, array('data-rowindex'=>$cpy_page_row_block_grid->RowCnt, 'id'=>'r' . $cpy_page_row_block_grid->RowCnt . '_cpy_page_row_block', 'data-rowtype'=>$cpy_page_row_block->RowType));

		// Render row
		$cpy_page_row_block_grid->RenderRow();

		// Render list options
		$cpy_page_row_block_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cpy_page_row_block_grid->RowAction <> "delete" && $cpy_page_row_block_grid->RowAction <> "insertdelete" && !($cpy_page_row_block_grid->RowAction == "insert" && $cpy_page_row_block->CurrentAction == "F" && $cpy_page_row_block_grid->EmptyRow())) {
?>
	<tr<?php echo $cpy_page_row_block->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_page_row_block_grid->ListOptions->Render("body", "left", $cpy_page_row_block_grid->RowCnt);
?>
	<?php if ($cpy_page_row_block->row_id->Visible) { // row_id ?>
		<td data-name="row_id"<?php echo $cpy_page_row_block->row_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cpy_page_row_block->row_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->row_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<select data-table="cpy_page_row_block" data-field="x_row_id" data-value-separator="<?php echo $cpy_page_row_block->row_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id"<?php echo $cpy_page_row_block->row_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cpy_page_row_block->row_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->row_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<select data-table="cpy_page_row_block" data-field="x_row_id" data-value-separator="<?php echo $cpy_page_row_block->row_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id"<?php echo $cpy_page_row_block->row_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_row_id" class="cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_id->CurrentValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT || $cpy_page_row_block->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($cpy_page_row_block->type_id->Visible) { // type_id ?>
		<td data-name="type_id"<?php echo $cpy_page_row_block->type_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_type_id" class="form-group cpy_page_row_block_type_id">
<select data-table="cpy_page_row_block" data-field="x_type_id" data-value-separator="<?php echo $cpy_page_row_block->type_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id"<?php echo $cpy_page_row_block->type_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_type_id" class="form-group cpy_page_row_block_type_id">
<select data-table="cpy_page_row_block" data-field="x_type_id" data-value-separator="<?php echo $cpy_page_row_block->type_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id"<?php echo $cpy_page_row_block->type_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_type_id" class="cpy_page_row_block_type_id">
<span<?php echo $cpy_page_row_block->type_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id"<?php echo $cpy_page_row_block->slid_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_slid_id" class="form-group cpy_page_row_block_slid_id">
<select data-table="cpy_page_row_block" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row_block->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id"<?php echo $cpy_page_row_block->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_slid_id" class="form-group cpy_page_row_block_slid_id">
<select data-table="cpy_page_row_block" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row_block->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id"<?php echo $cpy_page_row_block->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_slid_id" class="cpy_page_row_block_slid_id">
<span<?php echo $cpy_page_row_block->slid_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->video_id->Visible) { // video_id ?>
		<td data-name="video_id"<?php echo $cpy_page_row_block->video_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_video_id" class="form-group cpy_page_row_block_video_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id"><?php echo (strval($cpy_page_row_block->video_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row_block->video_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row_block->video_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row_block->video_id->ReadOnly || $cpy_page_row_block->video_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row_block->video_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo $cpy_page_row_block->video_id->CurrentValue ?>"<?php echo $cpy_page_row_block->video_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_video_id" class="form-group cpy_page_row_block_video_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id"><?php echo (strval($cpy_page_row_block->video_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row_block->video_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row_block->video_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row_block->video_id->ReadOnly || $cpy_page_row_block->video_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row_block->video_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo $cpy_page_row_block->video_id->CurrentValue ?>"<?php echo $cpy_page_row_block->video_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_video_id" class="cpy_page_row_block_video_id">
<span<?php echo $cpy_page_row_block->video_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->video_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $cpy_page_row_block->status_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_status_id" class="form-group cpy_page_row_block_status_id">
<select data-table="cpy_page_row_block" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row_block->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id"<?php echo $cpy_page_row_block->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_status_id" class="form-group cpy_page_row_block_status_id">
<select data-table="cpy_page_row_block" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row_block->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id"<?php echo $cpy_page_row_block->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_status_id" class="cpy_page_row_block_status_id">
<span<?php echo $cpy_page_row_block->status_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->cols_id->Visible) { // cols_id ?>
		<td data-name="cols_id"<?php echo $cpy_page_row_block->cols_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_cols_id" class="form-group cpy_page_row_block_cols_id">
<select data-table="cpy_page_row_block" data-field="x_cols_id" data-value-separator="<?php echo $cpy_page_row_block->cols_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id"<?php echo $cpy_page_row_block->cols_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_cols_id" class="form-group cpy_page_row_block_cols_id">
<select data-table="cpy_page_row_block" data-field="x_cols_id" data-value-separator="<?php echo $cpy_page_row_block->cols_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id"<?php echo $cpy_page_row_block->cols_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_cols_id" class="cpy_page_row_block_cols_id">
<span<?php echo $cpy_page_row_block->cols_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_order->Visible) { // blk_order ?>
		<td data-name="blk_order"<?php echo $cpy_page_row_block->blk_order->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_order" class="form-group cpy_page_row_block_blk_order">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_order" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_order->EditValue ?>"<?php echo $cpy_page_row_block->blk_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_order" class="form-group cpy_page_row_block_blk_order">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_order" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_order->EditValue ?>"<?php echo $cpy_page_row_block->blk_order->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_order" class="cpy_page_row_block_blk_order">
<span<?php echo $cpy_page_row_block->blk_order->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_order->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_name->Visible) { // blk_name ?>
		<td data-name="blk_name"<?php echo $cpy_page_row_block->blk_name->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_name" class="form-group cpy_page_row_block_blk_name">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_name" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_name->EditValue ?>"<?php echo $cpy_page_row_block->blk_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_name" class="form-group cpy_page_row_block_blk_name">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_name" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_name->EditValue ?>"<?php echo $cpy_page_row_block->blk_name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_name" class="cpy_page_row_block_blk_name">
<span<?php echo $cpy_page_row_block->blk_name->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_name->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_header->Visible) { // blk_header ?>
		<td data-name="blk_header"<?php echo $cpy_page_row_block->blk_header->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_header" class="form-group cpy_page_row_block_blk_header">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_header" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_header->EditValue ?>"<?php echo $cpy_page_row_block->blk_header->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_header" class="form-group cpy_page_row_block_blk_header">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_header" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_header->EditValue ?>"<?php echo $cpy_page_row_block->blk_header->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_header" class="cpy_page_row_block_blk_header">
<span<?php echo $cpy_page_row_block->blk_header->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_header->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_image->Visible) { // blk_image ?>
		<td data-name="blk_image"<?php echo $cpy_page_row_block->blk_image->CellAttributes() ?>>
<?php if ($cpy_page_row_block_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_cpy_page_row_block_blk_image" class="form-group cpy_page_row_block_blk_image">
<div id="fd_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image">
<span title="<?php echo $cpy_page_row_block->blk_image->FldTitle() ? $cpy_page_row_block->blk_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_page_row_block->blk_image->ReadOnly || $cpy_page_row_block->blk_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_page_row_block" data-field="x_blk_image" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image"<?php echo $cpy_page_row_block->blk_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fn_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fs_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fx_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fm_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_image" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_image->OldValue) ?>">
<?php } elseif ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_image" class="cpy_page_row_block_blk_image">
<span>
<?php echo ew_GetFileViewTag($cpy_page_row_block->blk_image, $cpy_page_row_block->blk_image->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_image" class="form-group cpy_page_row_block_blk_image">
<div id="fd_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image">
<span title="<?php echo $cpy_page_row_block->blk_image->FldTitle() ? $cpy_page_row_block->blk_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_page_row_block->blk_image->ReadOnly || $cpy_page_row_block->blk_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_page_row_block" data-field="x_blk_image" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image"<?php echo $cpy_page_row_block->blk_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fn_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fs_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fx_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fm_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_stext->Visible) { // blk_stext ?>
		<td data-name="blk_stext"<?php echo $cpy_page_row_block->blk_stext->CellAttributes() ?>>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_stext" class="form-group cpy_page_row_block_blk_stext">
<textarea data-table="cpy_page_row_block" data-field="x_blk_stext" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row_block->blk_stext->EditAttributes() ?>><?php echo $cpy_page_row_block->blk_stext->EditValue ?></textarea>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->OldValue) ?>">
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_stext" class="form-group cpy_page_row_block_blk_stext">
<textarea data-table="cpy_page_row_block" data-field="x_blk_stext" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row_block->blk_stext->EditAttributes() ?>><?php echo $cpy_page_row_block->blk_stext->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_page_row_block_grid->RowCnt ?>_cpy_page_row_block_blk_stext" class="cpy_page_row_block_blk_stext">
<span<?php echo $cpy_page_row_block->blk_stext->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_stext->ListViewValue() ?></span>
</span>
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="fcpy_page_row_blockgrid$x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->FormValue) ?>">
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="fcpy_page_row_blockgrid$o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_page_row_block_grid->ListOptions->Render("body", "right", $cpy_page_row_block_grid->RowCnt);
?>
	</tr>
<?php if ($cpy_page_row_block->RowType == EW_ROWTYPE_ADD || $cpy_page_row_block->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcpy_page_row_blockgrid.UpdateOpts(<?php echo $cpy_page_row_block_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cpy_page_row_block->CurrentAction <> "gridadd" || $cpy_page_row_block->CurrentMode == "copy")
		if (!$cpy_page_row_block_grid->Recordset->EOF) $cpy_page_row_block_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cpy_page_row_block->CurrentMode == "add" || $cpy_page_row_block->CurrentMode == "copy" || $cpy_page_row_block->CurrentMode == "edit") {
		$cpy_page_row_block_grid->RowIndex = '$rowindex$';
		$cpy_page_row_block_grid->LoadRowValues();

		// Set row properties
		$cpy_page_row_block->ResetAttrs();
		$cpy_page_row_block->RowAttrs = array_merge($cpy_page_row_block->RowAttrs, array('data-rowindex'=>$cpy_page_row_block_grid->RowIndex, 'id'=>'r0_cpy_page_row_block', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cpy_page_row_block->RowAttrs["class"], "ewTemplate");
		$cpy_page_row_block->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_page_row_block_grid->RenderRow();

		// Render list options
		$cpy_page_row_block_grid->RenderListOptions();
		$cpy_page_row_block_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_page_row_block->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_page_row_block_grid->ListOptions->Render("body", "left", $cpy_page_row_block_grid->RowIndex);
?>
	<?php if ($cpy_page_row_block->row_id->Visible) { // row_id ?>
		<td data-name="row_id">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<?php if ($cpy_page_row_block->row_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->row_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<select data-table="cpy_page_row_block" data-field="x_row_id" data-value-separator="<?php echo $cpy_page_row_block->row_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id"<?php echo $cpy_page_row_block->row_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_row_id" class="form-group cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->row_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_row_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->type_id->Visible) { // type_id ?>
		<td data-name="type_id">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_type_id" class="form-group cpy_page_row_block_type_id">
<select data-table="cpy_page_row_block" data-field="x_type_id" data-value-separator="<?php echo $cpy_page_row_block->type_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id"<?php echo $cpy_page_row_block->type_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_type_id" class="form-group cpy_page_row_block_type_id">
<span<?php echo $cpy_page_row_block->type_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->type_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_type_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_type_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->type_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_slid_id" class="form-group cpy_page_row_block_slid_id">
<select data-table="cpy_page_row_block" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row_block->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id"<?php echo $cpy_page_row_block->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_slid_id" class="form-group cpy_page_row_block_slid_id">
<span<?php echo $cpy_page_row_block->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_slid_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->slid_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->video_id->Visible) { // video_id ?>
		<td data-name="video_id">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_video_id" class="form-group cpy_page_row_block_video_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id"><?php echo (strval($cpy_page_row_block->video_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row_block->video_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row_block->video_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row_block->video_id->ReadOnly || $cpy_page_row_block->video_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row_block->video_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo $cpy_page_row_block->video_id->CurrentValue ?>"<?php echo $cpy_page_row_block->video_id->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_video_id" class="form-group cpy_page_row_block_video_id">
<span<?php echo $cpy_page_row_block->video_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->video_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_video_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->video_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->status_id->Visible) { // status_id ?>
		<td data-name="status_id">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_status_id" class="form-group cpy_page_row_block_status_id">
<select data-table="cpy_page_row_block" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row_block->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id"<?php echo $cpy_page_row_block->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_status_id" class="form-group cpy_page_row_block_status_id">
<span<?php echo $cpy_page_row_block->status_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->status_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_status_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->status_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->cols_id->Visible) { // cols_id ?>
		<td data-name="cols_id">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_cols_id" class="form-group cpy_page_row_block_cols_id">
<select data-table="cpy_page_row_block" data-field="x_cols_id" data-value-separator="<?php echo $cpy_page_row_block->cols_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id"<?php echo $cpy_page_row_block->cols_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->SelectOptionListHtml("x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_cols_id" class="form-group cpy_page_row_block_cols_id">
<span<?php echo $cpy_page_row_block->cols_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->cols_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_cols_id" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_cols_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->cols_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_order->Visible) { // blk_order ?>
		<td data-name="blk_order">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_order" class="form-group cpy_page_row_block_blk_order">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_order" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_order->EditValue ?>"<?php echo $cpy_page_row_block->blk_order->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_order" class="form-group cpy_page_row_block_blk_order">
<span<?php echo $cpy_page_row_block->blk_order->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->blk_order->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_order" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_order" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_name->Visible) { // blk_name ?>
		<td data-name="blk_name">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_name" class="form-group cpy_page_row_block_blk_name">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_name" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_name->EditValue ?>"<?php echo $cpy_page_row_block->blk_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_name" class="form-group cpy_page_row_block_blk_name">
<span<?php echo $cpy_page_row_block->blk_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->blk_name->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_name" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_name" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_header->Visible) { // blk_header ?>
		<td data-name="blk_header">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_header" class="form-group cpy_page_row_block_blk_header">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_header" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_header->EditValue ?>"<?php echo $cpy_page_row_block->blk_header->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_header" class="form-group cpy_page_row_block_blk_header">
<span<?php echo $cpy_page_row_block->blk_header->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->blk_header->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_header" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_header" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_image->Visible) { // blk_image ?>
		<td data-name="blk_image">
<span id="el$rowindex$_cpy_page_row_block_blk_image" class="form-group cpy_page_row_block_blk_image">
<div id="fd_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image">
<span title="<?php echo $cpy_page_row_block->blk_image->FldTitle() ? $cpy_page_row_block->blk_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_page_row_block->blk_image->ReadOnly || $cpy_page_row_block->blk_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_page_row_block" data-field="x_blk_image" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image"<?php echo $cpy_page_row_block->blk_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fn_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fa_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fs_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fx_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id= "fm_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_image" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_image" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_image->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_page_row_block->blk_stext->Visible) { // blk_stext ?>
		<td data-name="blk_stext">
<?php if ($cpy_page_row_block->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_stext" class="form-group cpy_page_row_block_blk_stext">
<textarea data-table="cpy_page_row_block" data-field="x_blk_stext" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row_block->blk_stext->EditAttributes() ?>><?php echo $cpy_page_row_block->blk_stext->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_page_row_block_blk_stext" class="form-group cpy_page_row_block_blk_stext">
<span<?php echo $cpy_page_row_block->blk_stext->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->blk_stext->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="x<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_stext" name="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" id="o<?php echo $cpy_page_row_block_grid->RowIndex ?>_blk_stext" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_page_row_block_grid->ListOptions->Render("body", "right", $cpy_page_row_block_grid->RowIndex);
?>
<script type="text/javascript">
fcpy_page_row_blockgrid.UpdateOpts(<?php echo $cpy_page_row_block_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cpy_page_row_block->CurrentMode == "add" || $cpy_page_row_block->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cpy_page_row_block_grid->FormKeyCountName ?>" id="<?php echo $cpy_page_row_block_grid->FormKeyCountName ?>" value="<?php echo $cpy_page_row_block_grid->KeyCount ?>">
<?php echo $cpy_page_row_block_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_page_row_block->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cpy_page_row_block_grid->FormKeyCountName ?>" id="<?php echo $cpy_page_row_block_grid->FormKeyCountName ?>" value="<?php echo $cpy_page_row_block_grid->KeyCount ?>">
<?php echo $cpy_page_row_block_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_page_row_block->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcpy_page_row_blockgrid">
</div>
<?php

// Close recordset
if ($cpy_page_row_block_grid->Recordset)
	$cpy_page_row_block_grid->Recordset->Close();
?>
<?php if ($cpy_page_row_block_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($cpy_page_row_block_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cpy_page_row_block_grid->TotalRecs == 0 && $cpy_page_row_block->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_page_row_block_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cpy_page_row_block->Export == "") { ?>
<script type="text/javascript">
fcpy_page_row_blockgrid.Init();
</script>
<?php } ?>
<?php
$cpy_page_row_block_grid->Page_Terminate();
?>
