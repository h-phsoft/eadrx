<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_faq_grid)) $cpy_faq_grid = new ccpy_faq_grid();

// Page init
$cpy_faq_grid->Page_Init();

// Page main
$cpy_faq_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_faq_grid->Page_Render();
?>
<?php if ($cpy_faq->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcpy_faqgrid = new ew_Form("fcpy_faqgrid", "grid");
fcpy_faqgrid.FormKeyCountName = '<?php echo $cpy_faq_grid->FormKeyCountName ?>';

// Validate form
fcpy_faqgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_fcat_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->fcat_id->FldCaption(), $cpy_faq->fcat_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->status_id->FldCaption(), $cpy_faq->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->lang_id->FldCaption(), $cpy_faq->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_color_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->color_id->FldCaption(), $cpy_faq->color_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_faq_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->faq_order->FldCaption(), $cpy_faq->faq_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_faq_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_faq->faq_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_faq_title");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->faq_title->FldCaption(), $cpy_faq->faq_title->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_faq_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->faq_text->FldCaption(), $cpy_faq->faq_text->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcpy_faqgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "fcat_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "status_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "color_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "faq_order", false)) return false;
	if (ew_ValueChanged(fobj, infix, "faq_title", false)) return false;
	if (ew_ValueChanged(fobj, infix, "faq_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fcpy_faqgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_faqgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_faqgrid.Lists["x_fcat_id"] = {"LinkField":"x_fcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_fcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_faq_category"};
fcpy_faqgrid.Lists["x_fcat_id"].Data = "<?php echo $cpy_faq_grid->fcat_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_faqgrid.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_faqgrid.Lists["x_status_id"].Data = "<?php echo $cpy_faq_grid->status_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_faqgrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_faqgrid.Lists["x_lang_id"].Data = "<?php echo $cpy_faq_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";
fcpy_faqgrid.Lists["x_color_id"] = {"LinkField":"x_color_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_color_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_color"};
fcpy_faqgrid.Lists["x_color_id"].Data = "<?php echo $cpy_faq_grid->color_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($cpy_faq->CurrentAction == "gridadd") {
	if ($cpy_faq->CurrentMode == "copy") {
		$bSelectLimit = $cpy_faq_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cpy_faq_grid->TotalRecs = $cpy_faq->ListRecordCount();
			$cpy_faq_grid->Recordset = $cpy_faq_grid->LoadRecordset($cpy_faq_grid->StartRec-1, $cpy_faq_grid->DisplayRecs);
		} else {
			if ($cpy_faq_grid->Recordset = $cpy_faq_grid->LoadRecordset())
				$cpy_faq_grid->TotalRecs = $cpy_faq_grid->Recordset->RecordCount();
		}
		$cpy_faq_grid->StartRec = 1;
		$cpy_faq_grid->DisplayRecs = $cpy_faq_grid->TotalRecs;
	} else {
		$cpy_faq->CurrentFilter = "0=1";
		$cpy_faq_grid->StartRec = 1;
		$cpy_faq_grid->DisplayRecs = $cpy_faq->GridAddRowCount;
	}
	$cpy_faq_grid->TotalRecs = $cpy_faq_grid->DisplayRecs;
	$cpy_faq_grid->StopRec = $cpy_faq_grid->DisplayRecs;
} else {
	$bSelectLimit = $cpy_faq_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cpy_faq_grid->TotalRecs <= 0)
			$cpy_faq_grid->TotalRecs = $cpy_faq->ListRecordCount();
	} else {
		if (!$cpy_faq_grid->Recordset && ($cpy_faq_grid->Recordset = $cpy_faq_grid->LoadRecordset()))
			$cpy_faq_grid->TotalRecs = $cpy_faq_grid->Recordset->RecordCount();
	}
	$cpy_faq_grid->StartRec = 1;
	$cpy_faq_grid->DisplayRecs = $cpy_faq_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cpy_faq_grid->Recordset = $cpy_faq_grid->LoadRecordset($cpy_faq_grid->StartRec-1, $cpy_faq_grid->DisplayRecs);

	// Set no record found message
	if ($cpy_faq->CurrentAction == "" && $cpy_faq_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cpy_faq_grid->setWarningMessage(ew_DeniedMsg());
		if ($cpy_faq_grid->SearchWhere == "0=101")
			$cpy_faq_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cpy_faq_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cpy_faq_grid->RenderOtherOptions();
?>
<?php $cpy_faq_grid->ShowPageHeader(); ?>
<?php
$cpy_faq_grid->ShowMessage();
?>
<?php if ($cpy_faq_grid->TotalRecs > 0 || $cpy_faq->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($cpy_faq_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> cpy_faq">
<div id="fcpy_faqgrid" class="ewForm ewListForm form-inline">
<?php if ($cpy_faq_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($cpy_faq_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_cpy_faq" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_cpy_faqgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$cpy_faq_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cpy_faq_grid->RenderListOptions();

// Render list options (header, left)
$cpy_faq_grid->ListOptions->Render("header", "left");
?>
<?php if ($cpy_faq->fcat_id->Visible) { // fcat_id ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->fcat_id) == "") { ?>
		<th data-name="fcat_id" class="<?php echo $cpy_faq->fcat_id->HeaderCellClass() ?>"><div id="elh_cpy_faq_fcat_id" class="cpy_faq_fcat_id"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->fcat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fcat_id" class="<?php echo $cpy_faq->fcat_id->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_fcat_id" class="cpy_faq_fcat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->fcat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->fcat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->fcat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_faq->status_id->Visible) { // status_id ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $cpy_faq->status_id->HeaderCellClass() ?>"><div id="elh_cpy_faq_status_id" class="cpy_faq_status_id"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $cpy_faq->status_id->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_status_id" class="cpy_faq_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_faq->lang_id->Visible) { // lang_id ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $cpy_faq->lang_id->HeaderCellClass() ?>"><div id="elh_cpy_faq_lang_id" class="cpy_faq_lang_id"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $cpy_faq->lang_id->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_lang_id" class="cpy_faq_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_faq->color_id->Visible) { // color_id ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->color_id) == "") { ?>
		<th data-name="color_id" class="<?php echo $cpy_faq->color_id->HeaderCellClass() ?>"><div id="elh_cpy_faq_color_id" class="cpy_faq_color_id"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->color_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="color_id" class="<?php echo $cpy_faq->color_id->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_color_id" class="cpy_faq_color_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->color_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->color_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->color_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_faq->faq_order->Visible) { // faq_order ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->faq_order) == "") { ?>
		<th data-name="faq_order" class="<?php echo $cpy_faq->faq_order->HeaderCellClass() ?>"><div id="elh_cpy_faq_faq_order" class="cpy_faq_faq_order"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->faq_order->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="faq_order" class="<?php echo $cpy_faq->faq_order->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_faq_order" class="cpy_faq_faq_order">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->faq_order->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->faq_order->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->faq_order->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_faq->faq_title->Visible) { // faq_title ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->faq_title) == "") { ?>
		<th data-name="faq_title" class="<?php echo $cpy_faq->faq_title->HeaderCellClass() ?>"><div id="elh_cpy_faq_faq_title" class="cpy_faq_faq_title"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->faq_title->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="faq_title" class="<?php echo $cpy_faq->faq_title->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_faq_title" class="cpy_faq_faq_title">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->faq_title->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->faq_title->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->faq_title->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_faq->faq_text->Visible) { // faq_text ?>
	<?php if ($cpy_faq->SortUrl($cpy_faq->faq_text) == "") { ?>
		<th data-name="faq_text" class="<?php echo $cpy_faq->faq_text->HeaderCellClass() ?>"><div id="elh_cpy_faq_faq_text" class="cpy_faq_faq_text"><div class="ewTableHeaderCaption"><?php echo $cpy_faq->faq_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="faq_text" class="<?php echo $cpy_faq->faq_text->HeaderCellClass() ?>"><div><div id="elh_cpy_faq_faq_text" class="cpy_faq_faq_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_faq->faq_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_faq->faq_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_faq->faq_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cpy_faq_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cpy_faq_grid->StartRec = 1;
$cpy_faq_grid->StopRec = $cpy_faq_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cpy_faq_grid->FormKeyCountName) && ($cpy_faq->CurrentAction == "gridadd" || $cpy_faq->CurrentAction == "gridedit" || $cpy_faq->CurrentAction == "F")) {
		$cpy_faq_grid->KeyCount = $objForm->GetValue($cpy_faq_grid->FormKeyCountName);
		$cpy_faq_grid->StopRec = $cpy_faq_grid->StartRec + $cpy_faq_grid->KeyCount - 1;
	}
}
$cpy_faq_grid->RecCnt = $cpy_faq_grid->StartRec - 1;
if ($cpy_faq_grid->Recordset && !$cpy_faq_grid->Recordset->EOF) {
	$cpy_faq_grid->Recordset->MoveFirst();
	$bSelectLimit = $cpy_faq_grid->UseSelectLimit;
	if (!$bSelectLimit && $cpy_faq_grid->StartRec > 1)
		$cpy_faq_grid->Recordset->Move($cpy_faq_grid->StartRec - 1);
} elseif (!$cpy_faq->AllowAddDeleteRow && $cpy_faq_grid->StopRec == 0) {
	$cpy_faq_grid->StopRec = $cpy_faq->GridAddRowCount;
}

// Initialize aggregate
$cpy_faq->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cpy_faq->ResetAttrs();
$cpy_faq_grid->RenderRow();
if ($cpy_faq->CurrentAction == "gridadd")
	$cpy_faq_grid->RowIndex = 0;
if ($cpy_faq->CurrentAction == "gridedit")
	$cpy_faq_grid->RowIndex = 0;
while ($cpy_faq_grid->RecCnt < $cpy_faq_grid->StopRec) {
	$cpy_faq_grid->RecCnt++;
	if (intval($cpy_faq_grid->RecCnt) >= intval($cpy_faq_grid->StartRec)) {
		$cpy_faq_grid->RowCnt++;
		if ($cpy_faq->CurrentAction == "gridadd" || $cpy_faq->CurrentAction == "gridedit" || $cpy_faq->CurrentAction == "F") {
			$cpy_faq_grid->RowIndex++;
			$objForm->Index = $cpy_faq_grid->RowIndex;
			if ($objForm->HasValue($cpy_faq_grid->FormActionName))
				$cpy_faq_grid->RowAction = strval($objForm->GetValue($cpy_faq_grid->FormActionName));
			elseif ($cpy_faq->CurrentAction == "gridadd")
				$cpy_faq_grid->RowAction = "insert";
			else
				$cpy_faq_grid->RowAction = "";
		}

		// Set up key count
		$cpy_faq_grid->KeyCount = $cpy_faq_grid->RowIndex;

		// Init row class and style
		$cpy_faq->ResetAttrs();
		$cpy_faq->CssClass = "";
		if ($cpy_faq->CurrentAction == "gridadd") {
			if ($cpy_faq->CurrentMode == "copy") {
				$cpy_faq_grid->LoadRowValues($cpy_faq_grid->Recordset); // Load row values
				$cpy_faq_grid->SetRecordKey($cpy_faq_grid->RowOldKey, $cpy_faq_grid->Recordset); // Set old record key
			} else {
				$cpy_faq_grid->LoadRowValues(); // Load default values
				$cpy_faq_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cpy_faq_grid->LoadRowValues($cpy_faq_grid->Recordset); // Load row values
		}
		$cpy_faq->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cpy_faq->CurrentAction == "gridadd") // Grid add
			$cpy_faq->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cpy_faq->CurrentAction == "gridadd" && $cpy_faq->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cpy_faq_grid->RestoreCurrentRowFormValues($cpy_faq_grid->RowIndex); // Restore form values
		if ($cpy_faq->CurrentAction == "gridedit") { // Grid edit
			if ($cpy_faq->EventCancelled) {
				$cpy_faq_grid->RestoreCurrentRowFormValues($cpy_faq_grid->RowIndex); // Restore form values
			}
			if ($cpy_faq_grid->RowAction == "insert")
				$cpy_faq->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cpy_faq->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cpy_faq->CurrentAction == "gridedit" && ($cpy_faq->RowType == EW_ROWTYPE_EDIT || $cpy_faq->RowType == EW_ROWTYPE_ADD) && $cpy_faq->EventCancelled) // Update failed
			$cpy_faq_grid->RestoreCurrentRowFormValues($cpy_faq_grid->RowIndex); // Restore form values
		if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cpy_faq_grid->EditRowCnt++;
		if ($cpy_faq->CurrentAction == "F") // Confirm row
			$cpy_faq_grid->RestoreCurrentRowFormValues($cpy_faq_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cpy_faq->RowAttrs = array_merge($cpy_faq->RowAttrs, array('data-rowindex'=>$cpy_faq_grid->RowCnt, 'id'=>'r' . $cpy_faq_grid->RowCnt . '_cpy_faq', 'data-rowtype'=>$cpy_faq->RowType));

		// Render row
		$cpy_faq_grid->RenderRow();

		// Render list options
		$cpy_faq_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cpy_faq_grid->RowAction <> "delete" && $cpy_faq_grid->RowAction <> "insertdelete" && !($cpy_faq_grid->RowAction == "insert" && $cpy_faq->CurrentAction == "F" && $cpy_faq_grid->EmptyRow())) {
?>
	<tr<?php echo $cpy_faq->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_faq_grid->ListOptions->Render("body", "left", $cpy_faq_grid->RowCnt);
?>
	<?php if ($cpy_faq->fcat_id->Visible) { // fcat_id ?>
		<td data-name="fcat_id"<?php echo $cpy_faq->fcat_id->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cpy_faq->fcat_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->fcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<select data-table="cpy_faq" data-field="x_fcat_id" data-value-separator="<?php echo $cpy_faq->fcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id"<?php echo $cpy_faq->fcat_id->EditAttributes() ?>>
<?php echo $cpy_faq->fcat_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cpy_faq->fcat_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->fcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<select data-table="cpy_faq" data-field="x_fcat_id" data-value-separator="<?php echo $cpy_faq->fcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id"<?php echo $cpy_faq->fcat_id->EditAttributes() ?>>
<?php echo $cpy_faq->fcat_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_fcat_id" class="cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<?php echo $cpy_faq->fcat_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_id" value="<?php echo ew_HtmlEncode($cpy_faq->faq_id->CurrentValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_id" value="<?php echo ew_HtmlEncode($cpy_faq->faq_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT || $cpy_faq->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_id" value="<?php echo ew_HtmlEncode($cpy_faq->faq_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($cpy_faq->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $cpy_faq->status_id->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_status_id" class="form-group cpy_faq_status_id">
<select data-table="cpy_faq" data-field="x_status_id" data-value-separator="<?php echo $cpy_faq->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id"<?php echo $cpy_faq->status_id->EditAttributes() ?>>
<?php echo $cpy_faq->status_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_status_id" class="form-group cpy_faq_status_id">
<select data-table="cpy_faq" data-field="x_status_id" data-value-separator="<?php echo $cpy_faq->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id"<?php echo $cpy_faq->status_id->EditAttributes() ?>>
<?php echo $cpy_faq->status_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_status_id" class="cpy_faq_status_id">
<span<?php echo $cpy_faq->status_id->ViewAttributes() ?>>
<?php echo $cpy_faq->status_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_faq->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $cpy_faq->lang_id->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_lang_id" class="form-group cpy_faq_lang_id">
<select data-table="cpy_faq" data-field="x_lang_id" data-value-separator="<?php echo $cpy_faq->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id"<?php echo $cpy_faq->lang_id->EditAttributes() ?>>
<?php echo $cpy_faq->lang_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_lang_id" class="form-group cpy_faq_lang_id">
<select data-table="cpy_faq" data-field="x_lang_id" data-value-separator="<?php echo $cpy_faq->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id"<?php echo $cpy_faq->lang_id->EditAttributes() ?>>
<?php echo $cpy_faq->lang_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_lang_id" class="cpy_faq_lang_id">
<span<?php echo $cpy_faq->lang_id->ViewAttributes() ?>>
<?php echo $cpy_faq->lang_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_faq->color_id->Visible) { // color_id ?>
		<td data-name="color_id"<?php echo $cpy_faq->color_id->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_color_id" class="form-group cpy_faq_color_id">
<select data-table="cpy_faq" data-field="x_color_id" data-value-separator="<?php echo $cpy_faq->color_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id"<?php echo $cpy_faq->color_id->EditAttributes() ?>>
<?php echo $cpy_faq->color_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_color_id") ?>
</select>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_color_id" class="form-group cpy_faq_color_id">
<select data-table="cpy_faq" data-field="x_color_id" data-value-separator="<?php echo $cpy_faq->color_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id"<?php echo $cpy_faq->color_id->EditAttributes() ?>>
<?php echo $cpy_faq->color_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_color_id") ?>
</select>
</span>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_color_id" class="cpy_faq_color_id">
<span<?php echo $cpy_faq->color_id->ViewAttributes() ?>>
<?php echo $cpy_faq->color_id->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_faq->faq_order->Visible) { // faq_order ?>
		<td data-name="faq_order"<?php echo $cpy_faq->faq_order->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_order" class="form-group cpy_faq_faq_order">
<input type="text" data-table="cpy_faq" data-field="x_faq_order" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_order->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_order->EditValue ?>"<?php echo $cpy_faq->faq_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_order" class="form-group cpy_faq_faq_order">
<input type="text" data-table="cpy_faq" data-field="x_faq_order" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_order->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_order->EditValue ?>"<?php echo $cpy_faq->faq_order->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_order" class="cpy_faq_faq_order">
<span<?php echo $cpy_faq->faq_order->ViewAttributes() ?>>
<?php echo $cpy_faq->faq_order->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_faq->faq_title->Visible) { // faq_title ?>
		<td data-name="faq_title"<?php echo $cpy_faq->faq_title->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_title" class="form-group cpy_faq_faq_title">
<input type="text" data-table="cpy_faq" data-field="x_faq_title" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_title->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_title->EditValue ?>"<?php echo $cpy_faq->faq_title->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_title" class="form-group cpy_faq_faq_title">
<input type="text" data-table="cpy_faq" data-field="x_faq_title" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_title->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_title->EditValue ?>"<?php echo $cpy_faq->faq_title->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_title" class="cpy_faq_faq_title">
<span<?php echo $cpy_faq->faq_title->ViewAttributes() ?>>
<?php echo $cpy_faq->faq_title->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_faq->faq_text->Visible) { // faq_text ?>
		<td data-name="faq_text"<?php echo $cpy_faq->faq_text->CellAttributes() ?>>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_text" class="form-group cpy_faq_faq_text">
<?php ew_AppendClass($cpy_faq->faq_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_faq" data-field="x_faq_text" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_text->getPlaceHolder()) ?>"<?php echo $cpy_faq->faq_text->EditAttributes() ?>><?php echo $cpy_faq->faq_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_faqgrid", "x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text", 35, 8, <?php echo ($cpy_faq->faq_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->OldValue) ?>">
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_text" class="form-group cpy_faq_faq_text">
<?php ew_AppendClass($cpy_faq->faq_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_faq" data-field="x_faq_text" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_text->getPlaceHolder()) ?>"<?php echo $cpy_faq->faq_text->EditAttributes() ?>><?php echo $cpy_faq->faq_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_faqgrid", "x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text", 35, 8, <?php echo ($cpy_faq->faq_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_faq_grid->RowCnt ?>_cpy_faq_faq_text" class="cpy_faq_faq_text">
<span<?php echo $cpy_faq->faq_text->ViewAttributes() ?>>
<?php echo $cpy_faq->faq_text->ListViewValue() ?></span>
</span>
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="fcpy_faqgrid$x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->FormValue) ?>">
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="fcpy_faqgrid$o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_faq_grid->ListOptions->Render("body", "right", $cpy_faq_grid->RowCnt);
?>
	</tr>
<?php if ($cpy_faq->RowType == EW_ROWTYPE_ADD || $cpy_faq->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcpy_faqgrid.UpdateOpts(<?php echo $cpy_faq_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cpy_faq->CurrentAction <> "gridadd" || $cpy_faq->CurrentMode == "copy")
		if (!$cpy_faq_grid->Recordset->EOF) $cpy_faq_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cpy_faq->CurrentMode == "add" || $cpy_faq->CurrentMode == "copy" || $cpy_faq->CurrentMode == "edit") {
		$cpy_faq_grid->RowIndex = '$rowindex$';
		$cpy_faq_grid->LoadRowValues();

		// Set row properties
		$cpy_faq->ResetAttrs();
		$cpy_faq->RowAttrs = array_merge($cpy_faq->RowAttrs, array('data-rowindex'=>$cpy_faq_grid->RowIndex, 'id'=>'r0_cpy_faq', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cpy_faq->RowAttrs["class"], "ewTemplate");
		$cpy_faq->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_faq_grid->RenderRow();

		// Render list options
		$cpy_faq_grid->RenderListOptions();
		$cpy_faq_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_faq->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_faq_grid->ListOptions->Render("body", "left", $cpy_faq_grid->RowIndex);
?>
	<?php if ($cpy_faq->fcat_id->Visible) { // fcat_id ?>
		<td data-name="fcat_id">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<?php if ($cpy_faq->fcat_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->fcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<select data-table="cpy_faq" data-field="x_fcat_id" data-value-separator="<?php echo $cpy_faq->fcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id"<?php echo $cpy_faq->fcat_id->EditAttributes() ?>>
<?php echo $cpy_faq->fcat_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_fcat_id" class="form-group cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->fcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_fcat_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_faq->status_id->Visible) { // status_id ?>
		<td data-name="status_id">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_faq_status_id" class="form-group cpy_faq_status_id">
<select data-table="cpy_faq" data-field="x_status_id" data-value-separator="<?php echo $cpy_faq->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id"<?php echo $cpy_faq->status_id->EditAttributes() ?>>
<?php echo $cpy_faq->status_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_status_id" class="form-group cpy_faq_status_id">
<span<?php echo $cpy_faq->status_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->status_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_status_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($cpy_faq->status_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_faq->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_faq_lang_id" class="form-group cpy_faq_lang_id">
<select data-table="cpy_faq" data-field="x_lang_id" data-value-separator="<?php echo $cpy_faq->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id"<?php echo $cpy_faq->lang_id->EditAttributes() ?>>
<?php echo $cpy_faq->lang_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_lang_id" class="form-group cpy_faq_lang_id">
<span<?php echo $cpy_faq->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_lang_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($cpy_faq->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_faq->color_id->Visible) { // color_id ?>
		<td data-name="color_id">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_faq_color_id" class="form-group cpy_faq_color_id">
<select data-table="cpy_faq" data-field="x_color_id" data-value-separator="<?php echo $cpy_faq->color_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id"<?php echo $cpy_faq->color_id->EditAttributes() ?>>
<?php echo $cpy_faq->color_id->SelectOptionListHtml("x<?php echo $cpy_faq_grid->RowIndex ?>_color_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_color_id" class="form-group cpy_faq_color_id">
<span<?php echo $cpy_faq->color_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->color_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="x<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_color_id" name="o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" id="o<?php echo $cpy_faq_grid->RowIndex ?>_color_id" value="<?php echo ew_HtmlEncode($cpy_faq->color_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_faq->faq_order->Visible) { // faq_order ?>
		<td data-name="faq_order">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_faq_faq_order" class="form-group cpy_faq_faq_order">
<input type="text" data-table="cpy_faq" data-field="x_faq_order" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_order->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_order->EditValue ?>"<?php echo $cpy_faq->faq_order->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_faq_order" class="form-group cpy_faq_faq_order">
<span<?php echo $cpy_faq->faq_order->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->faq_order->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_order" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_order" value="<?php echo ew_HtmlEncode($cpy_faq->faq_order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_faq->faq_title->Visible) { // faq_title ?>
		<td data-name="faq_title">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_faq_faq_title" class="form-group cpy_faq_faq_title">
<input type="text" data-table="cpy_faq" data-field="x_faq_title" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_title->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_title->EditValue ?>"<?php echo $cpy_faq->faq_title->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_faq_title" class="form-group cpy_faq_faq_title">
<span<?php echo $cpy_faq->faq_title->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->faq_title->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_title" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_title" value="<?php echo ew_HtmlEncode($cpy_faq->faq_title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_faq->faq_text->Visible) { // faq_text ?>
		<td data-name="faq_text">
<?php if ($cpy_faq->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cpy_faq_faq_text" class="form-group cpy_faq_faq_text">
<?php ew_AppendClass($cpy_faq->faq_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_faq" data-field="x_faq_text" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_text->getPlaceHolder()) ?>"<?php echo $cpy_faq->faq_text->EditAttributes() ?>><?php echo $cpy_faq->faq_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_faqgrid", "x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text", 35, 8, <?php echo ($cpy_faq->faq_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_cpy_faq_faq_text" class="form-group cpy_faq_faq_text">
<span<?php echo $cpy_faq->faq_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->faq_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="x<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cpy_faq" data-field="x_faq_text" name="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" id="o<?php echo $cpy_faq_grid->RowIndex ?>_faq_text" value="<?php echo ew_HtmlEncode($cpy_faq->faq_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_faq_grid->ListOptions->Render("body", "right", $cpy_faq_grid->RowIndex);
?>
<script type="text/javascript">
fcpy_faqgrid.UpdateOpts(<?php echo $cpy_faq_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cpy_faq->CurrentMode == "add" || $cpy_faq->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cpy_faq_grid->FormKeyCountName ?>" id="<?php echo $cpy_faq_grid->FormKeyCountName ?>" value="<?php echo $cpy_faq_grid->KeyCount ?>">
<?php echo $cpy_faq_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_faq->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cpy_faq_grid->FormKeyCountName ?>" id="<?php echo $cpy_faq_grid->FormKeyCountName ?>" value="<?php echo $cpy_faq_grid->KeyCount ?>">
<?php echo $cpy_faq_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_faq->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcpy_faqgrid">
</div>
<?php

// Close recordset
if ($cpy_faq_grid->Recordset)
	$cpy_faq_grid->Recordset->Close();
?>
<?php if ($cpy_faq_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($cpy_faq_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cpy_faq_grid->TotalRecs == 0 && $cpy_faq->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_faq_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cpy_faq->Export == "") { ?>
<script type="text/javascript">
fcpy_faqgrid.Init();
</script>
<?php } ?>
<?php
$cpy_faq_grid->Page_Terminate();
?>
