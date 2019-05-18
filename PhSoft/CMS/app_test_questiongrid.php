<?php include_once "phs_usersinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_test_question_grid)) $app_test_question_grid = new capp_test_question_grid();

// Page init
$app_test_question_grid->Page_Init();

// Page main
$app_test_question_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_question_grid->Page_Render();
?>
<?php if ($app_test_question->Export == "") { ?>
<script type="text/javascript">

// Form object
var fapp_test_questiongrid = new ew_Form("fapp_test_questiongrid", "grid");
fapp_test_questiongrid.FormKeyCountName = '<?php echo $app_test_question_grid->FormKeyCountName ?>';

// Validate form
fapp_test_questiongrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_test_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->test_id->FldCaption(), $app_test_question->test_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->lang_id->FldCaption(), $app_test_question->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_gend_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->gend_id->FldCaption(), $app_test_question->gend_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_num");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_num->FldCaption(), $app_test_question->qstn_num->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_num");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_num->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_text->FldCaption(), $app_test_question->qstn_text->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_ansr1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_ansr1->FldCaption(), $app_test_question->qstn_ansr1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_val1->FldCaption(), $app_test_question->qstn_val1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val1");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val1->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_rep1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_rep1->FldCaption(), $app_test_question->qstn_rep1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_ansr2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_ansr2->FldCaption(), $app_test_question->qstn_ansr2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_val2->FldCaption(), $app_test_question->qstn_val2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val2");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_rep2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_rep2->FldCaption(), $app_test_question->qstn_rep2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val3");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val3->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val4");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val4->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fapp_test_questiongrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "test_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "gend_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_num", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_text", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_ansr1", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_val1", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_rep1", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_ansr2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_val2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_rep2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_ansr3", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_val3", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_rep3", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_ansr4", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_val4", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qstn_rep4", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_test_questiongrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_questiongrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_questiongrid.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_questiongrid.Lists["x_test_id"].Data = "<?php echo $app_test_question_grid->test_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_test_questiongrid.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_questiongrid.Lists["x_lang_id"].Data = "<?php echo $app_test_question_grid->lang_id->LookupFilterQuery(FALSE, "grid") ?>";
fapp_test_questiongrid.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_test_questiongrid.Lists["x_gend_id"].Data = "<?php echo $app_test_question_grid->gend_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($app_test_question->CurrentAction == "gridadd") {
	if ($app_test_question->CurrentMode == "copy") {
		$bSelectLimit = $app_test_question_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$app_test_question_grid->TotalRecs = $app_test_question->ListRecordCount();
			$app_test_question_grid->Recordset = $app_test_question_grid->LoadRecordset($app_test_question_grid->StartRec-1, $app_test_question_grid->DisplayRecs);
		} else {
			if ($app_test_question_grid->Recordset = $app_test_question_grid->LoadRecordset())
				$app_test_question_grid->TotalRecs = $app_test_question_grid->Recordset->RecordCount();
		}
		$app_test_question_grid->StartRec = 1;
		$app_test_question_grid->DisplayRecs = $app_test_question_grid->TotalRecs;
	} else {
		$app_test_question->CurrentFilter = "0=1";
		$app_test_question_grid->StartRec = 1;
		$app_test_question_grid->DisplayRecs = $app_test_question->GridAddRowCount;
	}
	$app_test_question_grid->TotalRecs = $app_test_question_grid->DisplayRecs;
	$app_test_question_grid->StopRec = $app_test_question_grid->DisplayRecs;
} else {
	$bSelectLimit = $app_test_question_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_test_question_grid->TotalRecs <= 0)
			$app_test_question_grid->TotalRecs = $app_test_question->ListRecordCount();
	} else {
		if (!$app_test_question_grid->Recordset && ($app_test_question_grid->Recordset = $app_test_question_grid->LoadRecordset()))
			$app_test_question_grid->TotalRecs = $app_test_question_grid->Recordset->RecordCount();
	}
	$app_test_question_grid->StartRec = 1;
	$app_test_question_grid->DisplayRecs = $app_test_question_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$app_test_question_grid->Recordset = $app_test_question_grid->LoadRecordset($app_test_question_grid->StartRec-1, $app_test_question_grid->DisplayRecs);

	// Set no record found message
	if ($app_test_question->CurrentAction == "" && $app_test_question_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_test_question_grid->setWarningMessage(ew_DeniedMsg());
		if ($app_test_question_grid->SearchWhere == "0=101")
			$app_test_question_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_test_question_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_test_question_grid->RenderOtherOptions();
?>
<?php $app_test_question_grid->ShowPageHeader(); ?>
<?php
$app_test_question_grid->ShowMessage();
?>
<?php if ($app_test_question_grid->TotalRecs > 0 || $app_test_question->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_test_question_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_test_question">
<div id="fapp_test_questiongrid" class="ewForm ewListForm form-inline">
<?php if ($app_test_question_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($app_test_question_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_app_test_question" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_app_test_questiongrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_test_question_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_test_question_grid->RenderListOptions();

// Render list options (header, left)
$app_test_question_grid->ListOptions->Render("header", "left");
?>
<?php if ($app_test_question->test_id->Visible) { // test_id ?>
	<?php if ($app_test_question->SortUrl($app_test_question->test_id) == "") { ?>
		<th data-name="test_id" class="<?php echo $app_test_question->test_id->HeaderCellClass() ?>"><div id="elh_app_test_question_test_id" class="app_test_question_test_id"><div class="ewTableHeaderCaption"><?php echo $app_test_question->test_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_id" class="<?php echo $app_test_question->test_id->HeaderCellClass() ?>"><div><div id="elh_app_test_question_test_id" class="app_test_question_test_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->test_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->test_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->test_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->lang_id->Visible) { // lang_id ?>
	<?php if ($app_test_question->SortUrl($app_test_question->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_test_question->lang_id->HeaderCellClass() ?>"><div id="elh_app_test_question_lang_id" class="app_test_question_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_test_question->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_test_question->lang_id->HeaderCellClass() ?>"><div><div id="elh_app_test_question_lang_id" class="app_test_question_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->gend_id->Visible) { // gend_id ?>
	<?php if ($app_test_question->SortUrl($app_test_question->gend_id) == "") { ?>
		<th data-name="gend_id" class="<?php echo $app_test_question->gend_id->HeaderCellClass() ?>"><div id="elh_app_test_question_gend_id" class="app_test_question_gend_id"><div class="ewTableHeaderCaption"><?php echo $app_test_question->gend_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gend_id" class="<?php echo $app_test_question->gend_id->HeaderCellClass() ?>"><div><div id="elh_app_test_question_gend_id" class="app_test_question_gend_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->gend_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->gend_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->gend_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_num->Visible) { // qstn_num ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_num) == "") { ?>
		<th data-name="qstn_num" class="<?php echo $app_test_question->qstn_num->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_num" class="app_test_question_qstn_num"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_num->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_num" class="<?php echo $app_test_question->qstn_num->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_num" class="app_test_question_qstn_num">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_num->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_num->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_num->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_text->Visible) { // qstn_text ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_text) == "") { ?>
		<th data-name="qstn_text" class="<?php echo $app_test_question->qstn_text->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_text" class="app_test_question_qstn_text"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_text" class="<?php echo $app_test_question->qstn_text->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_text" class="app_test_question_qstn_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_text->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_ansr1->Visible) { // qstn_ansr1 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_ansr1) == "") { ?>
		<th data-name="qstn_ansr1" class="<?php echo $app_test_question->qstn_ansr1->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_ansr1" class="app_test_question_qstn_ansr1"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_ansr1" class="<?php echo $app_test_question->qstn_ansr1->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_ansr1" class="app_test_question_qstn_ansr1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_ansr1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_ansr1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_val1->Visible) { // qstn_val1 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_val1) == "") { ?>
		<th data-name="qstn_val1" class="<?php echo $app_test_question->qstn_val1->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_val1" class="app_test_question_qstn_val1"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_val1" class="<?php echo $app_test_question->qstn_val1->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_val1" class="app_test_question_qstn_val1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_val1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_val1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_rep1->Visible) { // qstn_rep1 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_rep1) == "") { ?>
		<th data-name="qstn_rep1" class="<?php echo $app_test_question->qstn_rep1->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_rep1" class="app_test_question_qstn_rep1"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_rep1" class="<?php echo $app_test_question->qstn_rep1->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_rep1" class="app_test_question_qstn_rep1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_rep1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_rep1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_ansr2->Visible) { // qstn_ansr2 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_ansr2) == "") { ?>
		<th data-name="qstn_ansr2" class="<?php echo $app_test_question->qstn_ansr2->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_ansr2" class="app_test_question_qstn_ansr2"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_ansr2" class="<?php echo $app_test_question->qstn_ansr2->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_ansr2" class="app_test_question_qstn_ansr2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_ansr2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_ansr2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_val2->Visible) { // qstn_val2 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_val2) == "") { ?>
		<th data-name="qstn_val2" class="<?php echo $app_test_question->qstn_val2->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_val2" class="app_test_question_qstn_val2"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_val2" class="<?php echo $app_test_question->qstn_val2->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_val2" class="app_test_question_qstn_val2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_val2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_val2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_rep2->Visible) { // qstn_rep2 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_rep2) == "") { ?>
		<th data-name="qstn_rep2" class="<?php echo $app_test_question->qstn_rep2->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_rep2" class="app_test_question_qstn_rep2"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_rep2" class="<?php echo $app_test_question->qstn_rep2->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_rep2" class="app_test_question_qstn_rep2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_rep2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_rep2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_ansr3->Visible) { // qstn_ansr3 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_ansr3) == "") { ?>
		<th data-name="qstn_ansr3" class="<?php echo $app_test_question->qstn_ansr3->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_ansr3" class="app_test_question_qstn_ansr3"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_ansr3" class="<?php echo $app_test_question->qstn_ansr3->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_ansr3" class="app_test_question_qstn_ansr3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr3->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_ansr3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_ansr3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_val3->Visible) { // qstn_val3 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_val3) == "") { ?>
		<th data-name="qstn_val3" class="<?php echo $app_test_question->qstn_val3->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_val3" class="app_test_question_qstn_val3"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_val3" class="<?php echo $app_test_question->qstn_val3->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_val3" class="app_test_question_qstn_val3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val3->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_val3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_val3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_rep3->Visible) { // qstn_rep3 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_rep3) == "") { ?>
		<th data-name="qstn_rep3" class="<?php echo $app_test_question->qstn_rep3->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_rep3" class="app_test_question_qstn_rep3"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_rep3" class="<?php echo $app_test_question->qstn_rep3->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_rep3" class="app_test_question_qstn_rep3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep3->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_rep3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_rep3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_ansr4->Visible) { // qstn_ansr4 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_ansr4) == "") { ?>
		<th data-name="qstn_ansr4" class="<?php echo $app_test_question->qstn_ansr4->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_ansr4" class="app_test_question_qstn_ansr4"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr4->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_ansr4" class="<?php echo $app_test_question->qstn_ansr4->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_ansr4" class="app_test_question_qstn_ansr4">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_ansr4->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_ansr4->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_ansr4->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_val4->Visible) { // qstn_val4 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_val4) == "") { ?>
		<th data-name="qstn_val4" class="<?php echo $app_test_question->qstn_val4->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_val4" class="app_test_question_qstn_val4"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val4->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_val4" class="<?php echo $app_test_question->qstn_val4->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_val4" class="app_test_question_qstn_val4">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_val4->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_val4->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_val4->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_question->qstn_rep4->Visible) { // qstn_rep4 ?>
	<?php if ($app_test_question->SortUrl($app_test_question->qstn_rep4) == "") { ?>
		<th data-name="qstn_rep4" class="<?php echo $app_test_question->qstn_rep4->HeaderCellClass() ?>"><div id="elh_app_test_question_qstn_rep4" class="app_test_question_qstn_rep4"><div class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep4->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qstn_rep4" class="<?php echo $app_test_question->qstn_rep4->HeaderCellClass() ?>"><div><div id="elh_app_test_question_qstn_rep4" class="app_test_question_qstn_rep4">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_question->qstn_rep4->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_question->qstn_rep4->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_question->qstn_rep4->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_test_question_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$app_test_question_grid->StartRec = 1;
$app_test_question_grid->StopRec = $app_test_question_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_test_question_grid->FormKeyCountName) && ($app_test_question->CurrentAction == "gridadd" || $app_test_question->CurrentAction == "gridedit" || $app_test_question->CurrentAction == "F")) {
		$app_test_question_grid->KeyCount = $objForm->GetValue($app_test_question_grid->FormKeyCountName);
		$app_test_question_grid->StopRec = $app_test_question_grid->StartRec + $app_test_question_grid->KeyCount - 1;
	}
}
$app_test_question_grid->RecCnt = $app_test_question_grid->StartRec - 1;
if ($app_test_question_grid->Recordset && !$app_test_question_grid->Recordset->EOF) {
	$app_test_question_grid->Recordset->MoveFirst();
	$bSelectLimit = $app_test_question_grid->UseSelectLimit;
	if (!$bSelectLimit && $app_test_question_grid->StartRec > 1)
		$app_test_question_grid->Recordset->Move($app_test_question_grid->StartRec - 1);
} elseif (!$app_test_question->AllowAddDeleteRow && $app_test_question_grid->StopRec == 0) {
	$app_test_question_grid->StopRec = $app_test_question->GridAddRowCount;
}

// Initialize aggregate
$app_test_question->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_test_question->ResetAttrs();
$app_test_question_grid->RenderRow();
if ($app_test_question->CurrentAction == "gridadd")
	$app_test_question_grid->RowIndex = 0;
if ($app_test_question->CurrentAction == "gridedit")
	$app_test_question_grid->RowIndex = 0;
while ($app_test_question_grid->RecCnt < $app_test_question_grid->StopRec) {
	$app_test_question_grid->RecCnt++;
	if (intval($app_test_question_grid->RecCnt) >= intval($app_test_question_grid->StartRec)) {
		$app_test_question_grid->RowCnt++;
		if ($app_test_question->CurrentAction == "gridadd" || $app_test_question->CurrentAction == "gridedit" || $app_test_question->CurrentAction == "F") {
			$app_test_question_grid->RowIndex++;
			$objForm->Index = $app_test_question_grid->RowIndex;
			if ($objForm->HasValue($app_test_question_grid->FormActionName))
				$app_test_question_grid->RowAction = strval($objForm->GetValue($app_test_question_grid->FormActionName));
			elseif ($app_test_question->CurrentAction == "gridadd")
				$app_test_question_grid->RowAction = "insert";
			else
				$app_test_question_grid->RowAction = "";
		}

		// Set up key count
		$app_test_question_grid->KeyCount = $app_test_question_grid->RowIndex;

		// Init row class and style
		$app_test_question->ResetAttrs();
		$app_test_question->CssClass = "";
		if ($app_test_question->CurrentAction == "gridadd") {
			if ($app_test_question->CurrentMode == "copy") {
				$app_test_question_grid->LoadRowValues($app_test_question_grid->Recordset); // Load row values
				$app_test_question_grid->SetRecordKey($app_test_question_grid->RowOldKey, $app_test_question_grid->Recordset); // Set old record key
			} else {
				$app_test_question_grid->LoadRowValues(); // Load default values
				$app_test_question_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$app_test_question_grid->LoadRowValues($app_test_question_grid->Recordset); // Load row values
		}
		$app_test_question->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_test_question->CurrentAction == "gridadd") // Grid add
			$app_test_question->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_test_question->CurrentAction == "gridadd" && $app_test_question->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_test_question_grid->RestoreCurrentRowFormValues($app_test_question_grid->RowIndex); // Restore form values
		if ($app_test_question->CurrentAction == "gridedit") { // Grid edit
			if ($app_test_question->EventCancelled) {
				$app_test_question_grid->RestoreCurrentRowFormValues($app_test_question_grid->RowIndex); // Restore form values
			}
			if ($app_test_question_grid->RowAction == "insert")
				$app_test_question->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_test_question->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_test_question->CurrentAction == "gridedit" && ($app_test_question->RowType == EW_ROWTYPE_EDIT || $app_test_question->RowType == EW_ROWTYPE_ADD) && $app_test_question->EventCancelled) // Update failed
			$app_test_question_grid->RestoreCurrentRowFormValues($app_test_question_grid->RowIndex); // Restore form values
		if ($app_test_question->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_test_question_grid->EditRowCnt++;
		if ($app_test_question->CurrentAction == "F") // Confirm row
			$app_test_question_grid->RestoreCurrentRowFormValues($app_test_question_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$app_test_question->RowAttrs = array_merge($app_test_question->RowAttrs, array('data-rowindex'=>$app_test_question_grid->RowCnt, 'id'=>'r' . $app_test_question_grid->RowCnt . '_app_test_question', 'data-rowtype'=>$app_test_question->RowType));

		// Render row
		$app_test_question_grid->RenderRow();

		// Render list options
		$app_test_question_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_test_question_grid->RowAction <> "delete" && $app_test_question_grid->RowAction <> "insertdelete" && !($app_test_question_grid->RowAction == "insert" && $app_test_question->CurrentAction == "F" && $app_test_question_grid->EmptyRow())) {
?>
	<tr<?php echo $app_test_question->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_question_grid->ListOptions->Render("body", "left", $app_test_question_grid->RowCnt);
?>
	<?php if ($app_test_question->test_id->Visible) { // test_id ?>
		<td data-name="test_id"<?php echo $app_test_question->test_id->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_test_question->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_test_id" class="form-group app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_test_id" class="form-group app_test_question_test_id">
<select data-table="app_test_question" data-field="x_test_id" data-value-separator="<?php echo $app_test_question->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id"<?php echo $app_test_question->test_id->EditAttributes() ?>>
<?php echo $app_test_question->test_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_test_question->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_test_id" class="form-group app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_test_id" class="form-group app_test_question_test_id">
<select data-table="app_test_question" data-field="x_test_id" data-value-separator="<?php echo $app_test_question->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id"<?php echo $app_test_question->test_id->EditAttributes() ?>>
<?php echo $app_test_question->test_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_test_id" class="app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<?php echo $app_test_question->test_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_id" value="<?php echo ew_HtmlEncode($app_test_question->qstn_id->CurrentValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_id" value="<?php echo ew_HtmlEncode($app_test_question->qstn_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT || $app_test_question->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_id" value="<?php echo ew_HtmlEncode($app_test_question->qstn_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_test_question->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_test_question->lang_id->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_lang_id" class="form-group app_test_question_lang_id">
<select data-table="app_test_question" data-field="x_lang_id" data-value-separator="<?php echo $app_test_question->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id"<?php echo $app_test_question->lang_id->EditAttributes() ?>>
<?php echo $app_test_question->lang_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_lang_id" class="form-group app_test_question_lang_id">
<select data-table="app_test_question" data-field="x_lang_id" data-value-separator="<?php echo $app_test_question->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id"<?php echo $app_test_question->lang_id->EditAttributes() ?>>
<?php echo $app_test_question->lang_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_lang_id" class="app_test_question_lang_id">
<span<?php echo $app_test_question->lang_id->ViewAttributes() ?>>
<?php echo $app_test_question->lang_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id"<?php echo $app_test_question->gend_id->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_gend_id" class="form-group app_test_question_gend_id">
<select data-table="app_test_question" data-field="x_gend_id" data-value-separator="<?php echo $app_test_question->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id"<?php echo $app_test_question->gend_id->EditAttributes() ?>>
<?php echo $app_test_question->gend_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_gend_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_gend_id" class="form-group app_test_question_gend_id">
<select data-table="app_test_question" data-field="x_gend_id" data-value-separator="<?php echo $app_test_question->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id"<?php echo $app_test_question->gend_id->EditAttributes() ?>>
<?php echo $app_test_question->gend_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_gend_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_gend_id" class="app_test_question_gend_id">
<span<?php echo $app_test_question->gend_id->ViewAttributes() ?>>
<?php echo $app_test_question->gend_id->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_num->Visible) { // qstn_num ?>
		<td data-name="qstn_num"<?php echo $app_test_question->qstn_num->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_num" class="form-group app_test_question_qstn_num">
<input type="text" data-table="app_test_question" data-field="x_qstn_num" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_num->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_num->EditValue ?>"<?php echo $app_test_question->qstn_num->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_num" class="form-group app_test_question_qstn_num">
<input type="text" data-table="app_test_question" data-field="x_qstn_num" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_num->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_num->EditValue ?>"<?php echo $app_test_question->qstn_num->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_num" class="app_test_question_qstn_num">
<span<?php echo $app_test_question->qstn_num->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_num->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_text->Visible) { // qstn_text ?>
		<td data-name="qstn_text"<?php echo $app_test_question->qstn_text->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_text" class="form-group app_test_question_qstn_text">
<?php ew_AppendClass($app_test_question->qstn_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_text" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_text->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_text->EditAttributes() ?>><?php echo $app_test_question->qstn_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questiongrid", "x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text", 35, 4, <?php echo ($app_test_question->qstn_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_text" class="form-group app_test_question_qstn_text">
<?php ew_AppendClass($app_test_question->qstn_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_text" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_text->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_text->EditAttributes() ?>><?php echo $app_test_question->qstn_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questiongrid", "x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text", 35, 4, <?php echo ($app_test_question->qstn_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_text" class="app_test_question_qstn_text">
<span<?php echo $app_test_question->qstn_text->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_text->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr1->Visible) { // qstn_ansr1 ?>
		<td data-name="qstn_ansr1"<?php echo $app_test_question->qstn_ansr1->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr1" class="form-group app_test_question_qstn_ansr1">
<?php ew_AppendClass($app_test_question->qstn_ansr1->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_ansr1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr1->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr1->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questiongrid", "x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1", 35, 2, <?php echo ($app_test_question->qstn_ansr1->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr1" class="form-group app_test_question_qstn_ansr1">
<?php ew_AppendClass($app_test_question->qstn_ansr1->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_ansr1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr1->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr1->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questiongrid", "x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1", 35, 2, <?php echo ($app_test_question->qstn_ansr1->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr1" class="app_test_question_qstn_ansr1">
<span<?php echo $app_test_question->qstn_ansr1->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr1->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val1->Visible) { // qstn_val1 ?>
		<td data-name="qstn_val1"<?php echo $app_test_question->qstn_val1->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val1" class="form-group app_test_question_qstn_val1">
<input type="text" data-table="app_test_question" data-field="x_qstn_val1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val1->EditValue ?>"<?php echo $app_test_question->qstn_val1->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val1" class="form-group app_test_question_qstn_val1">
<input type="text" data-table="app_test_question" data-field="x_qstn_val1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val1->EditValue ?>"<?php echo $app_test_question->qstn_val1->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val1" class="app_test_question_qstn_val1">
<span<?php echo $app_test_question->qstn_val1->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val1->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep1->Visible) { // qstn_rep1 ?>
		<td data-name="qstn_rep1"<?php echo $app_test_question->qstn_rep1->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep1" class="form-group app_test_question_qstn_rep1">
<textarea data-table="app_test_question" data-field="x_qstn_rep1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep1->EditAttributes() ?>><?php echo $app_test_question->qstn_rep1->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep1" class="form-group app_test_question_qstn_rep1">
<textarea data-table="app_test_question" data-field="x_qstn_rep1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep1->EditAttributes() ?>><?php echo $app_test_question->qstn_rep1->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep1" class="app_test_question_qstn_rep1">
<span<?php echo $app_test_question->qstn_rep1->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep1->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr2->Visible) { // qstn_ansr2 ?>
		<td data-name="qstn_ansr2"<?php echo $app_test_question->qstn_ansr2->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr2" class="form-group app_test_question_qstn_ansr2">
<textarea data-table="app_test_question" data-field="x_qstn_ansr2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr2->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr2->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr2" class="form-group app_test_question_qstn_ansr2">
<textarea data-table="app_test_question" data-field="x_qstn_ansr2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr2->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr2->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr2" class="app_test_question_qstn_ansr2">
<span<?php echo $app_test_question->qstn_ansr2->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr2->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val2->Visible) { // qstn_val2 ?>
		<td data-name="qstn_val2"<?php echo $app_test_question->qstn_val2->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val2" class="form-group app_test_question_qstn_val2">
<input type="text" data-table="app_test_question" data-field="x_qstn_val2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val2->EditValue ?>"<?php echo $app_test_question->qstn_val2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val2" class="form-group app_test_question_qstn_val2">
<input type="text" data-table="app_test_question" data-field="x_qstn_val2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val2->EditValue ?>"<?php echo $app_test_question->qstn_val2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val2" class="app_test_question_qstn_val2">
<span<?php echo $app_test_question->qstn_val2->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val2->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep2->Visible) { // qstn_rep2 ?>
		<td data-name="qstn_rep2"<?php echo $app_test_question->qstn_rep2->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep2" class="form-group app_test_question_qstn_rep2">
<textarea data-table="app_test_question" data-field="x_qstn_rep2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep2->EditAttributes() ?>><?php echo $app_test_question->qstn_rep2->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep2" class="form-group app_test_question_qstn_rep2">
<textarea data-table="app_test_question" data-field="x_qstn_rep2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep2->EditAttributes() ?>><?php echo $app_test_question->qstn_rep2->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep2" class="app_test_question_qstn_rep2">
<span<?php echo $app_test_question->qstn_rep2->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep2->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr3->Visible) { // qstn_ansr3 ?>
		<td data-name="qstn_ansr3"<?php echo $app_test_question->qstn_ansr3->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr3" class="form-group app_test_question_qstn_ansr3">
<textarea data-table="app_test_question" data-field="x_qstn_ansr3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr3->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr3->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr3" class="form-group app_test_question_qstn_ansr3">
<textarea data-table="app_test_question" data-field="x_qstn_ansr3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr3->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr3->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr3" class="app_test_question_qstn_ansr3">
<span<?php echo $app_test_question->qstn_ansr3->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr3->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val3->Visible) { // qstn_val3 ?>
		<td data-name="qstn_val3"<?php echo $app_test_question->qstn_val3->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val3" class="form-group app_test_question_qstn_val3">
<input type="text" data-table="app_test_question" data-field="x_qstn_val3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val3->EditValue ?>"<?php echo $app_test_question->qstn_val3->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val3" class="form-group app_test_question_qstn_val3">
<input type="text" data-table="app_test_question" data-field="x_qstn_val3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val3->EditValue ?>"<?php echo $app_test_question->qstn_val3->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val3" class="app_test_question_qstn_val3">
<span<?php echo $app_test_question->qstn_val3->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val3->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep3->Visible) { // qstn_rep3 ?>
		<td data-name="qstn_rep3"<?php echo $app_test_question->qstn_rep3->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep3" class="form-group app_test_question_qstn_rep3">
<textarea data-table="app_test_question" data-field="x_qstn_rep3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep3->EditAttributes() ?>><?php echo $app_test_question->qstn_rep3->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep3" class="form-group app_test_question_qstn_rep3">
<textarea data-table="app_test_question" data-field="x_qstn_rep3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep3->EditAttributes() ?>><?php echo $app_test_question->qstn_rep3->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep3" class="app_test_question_qstn_rep3">
<span<?php echo $app_test_question->qstn_rep3->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep3->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr4->Visible) { // qstn_ansr4 ?>
		<td data-name="qstn_ansr4"<?php echo $app_test_question->qstn_ansr4->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr4" class="form-group app_test_question_qstn_ansr4">
<textarea data-table="app_test_question" data-field="x_qstn_ansr4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr4->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr4->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr4" class="form-group app_test_question_qstn_ansr4">
<textarea data-table="app_test_question" data-field="x_qstn_ansr4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr4->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr4->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_ansr4" class="app_test_question_qstn_ansr4">
<span<?php echo $app_test_question->qstn_ansr4->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr4->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val4->Visible) { // qstn_val4 ?>
		<td data-name="qstn_val4"<?php echo $app_test_question->qstn_val4->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val4" class="form-group app_test_question_qstn_val4">
<input type="text" data-table="app_test_question" data-field="x_qstn_val4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val4->EditValue ?>"<?php echo $app_test_question->qstn_val4->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val4" class="form-group app_test_question_qstn_val4">
<input type="text" data-table="app_test_question" data-field="x_qstn_val4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val4->EditValue ?>"<?php echo $app_test_question->qstn_val4->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_val4" class="app_test_question_qstn_val4">
<span<?php echo $app_test_question->qstn_val4->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val4->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep4->Visible) { // qstn_rep4 ?>
		<td data-name="qstn_rep4"<?php echo $app_test_question->qstn_rep4->CellAttributes() ?>>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep4" class="form-group app_test_question_qstn_rep4">
<textarea data-table="app_test_question" data-field="x_qstn_rep4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep4->EditAttributes() ?>><?php echo $app_test_question->qstn_rep4->EditValue ?></textarea>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->OldValue) ?>">
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep4" class="form-group app_test_question_qstn_rep4">
<textarea data-table="app_test_question" data-field="x_qstn_rep4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep4->EditAttributes() ?>><?php echo $app_test_question->qstn_rep4->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($app_test_question->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_question_grid->RowCnt ?>_app_test_question_qstn_rep4" class="app_test_question_qstn_rep4">
<span<?php echo $app_test_question->qstn_rep4->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep4->ListViewValue() ?></span>
</span>
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="fapp_test_questiongrid$x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->FormValue) ?>">
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="fapp_test_questiongrid$o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_question_grid->ListOptions->Render("body", "right", $app_test_question_grid->RowCnt);
?>
	</tr>
<?php if ($app_test_question->RowType == EW_ROWTYPE_ADD || $app_test_question->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_test_questiongrid.UpdateOpts(<?php echo $app_test_question_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_test_question->CurrentAction <> "gridadd" || $app_test_question->CurrentMode == "copy")
		if (!$app_test_question_grid->Recordset->EOF) $app_test_question_grid->Recordset->MoveNext();
}
?>
<?php
	if ($app_test_question->CurrentMode == "add" || $app_test_question->CurrentMode == "copy" || $app_test_question->CurrentMode == "edit") {
		$app_test_question_grid->RowIndex = '$rowindex$';
		$app_test_question_grid->LoadRowValues();

		// Set row properties
		$app_test_question->ResetAttrs();
		$app_test_question->RowAttrs = array_merge($app_test_question->RowAttrs, array('data-rowindex'=>$app_test_question_grid->RowIndex, 'id'=>'r0_app_test_question', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_test_question->RowAttrs["class"], "ewTemplate");
		$app_test_question->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_test_question_grid->RenderRow();

		// Render list options
		$app_test_question_grid->RenderListOptions();
		$app_test_question_grid->StartRowCnt = 0;
?>
	<tr<?php echo $app_test_question->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_question_grid->ListOptions->Render("body", "left", $app_test_question_grid->RowIndex);
?>
	<?php if ($app_test_question->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<?php if ($app_test_question->test_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_test_question_test_id" class="form-group app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_test_question_test_id" class="form-group app_test_question_test_id">
<select data-table="app_test_question" data-field="x_test_id" data-value-separator="<?php echo $app_test_question->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id"<?php echo $app_test_question->test_id->EditAttributes() ?>>
<?php echo $app_test_question->test_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_test_id" class="form-group app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_test_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_test_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_lang_id" class="form-group app_test_question_lang_id">
<select data-table="app_test_question" data-field="x_lang_id" data-value-separator="<?php echo $app_test_question->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id"<?php echo $app_test_question->lang_id->EditAttributes() ?>>
<?php echo $app_test_question->lang_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_lang_id" class="form-group app_test_question_lang_id">
<span<?php echo $app_test_question->lang_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->lang_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_lang_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_question->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_gend_id" class="form-group app_test_question_gend_id">
<select data-table="app_test_question" data-field="x_gend_id" data-value-separator="<?php echo $app_test_question->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id"<?php echo $app_test_question->gend_id->EditAttributes() ?>>
<?php echo $app_test_question->gend_id->SelectOptionListHtml("x<?php echo $app_test_question_grid->RowIndex ?>_gend_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_gend_id" class="form-group app_test_question_gend_id">
<span<?php echo $app_test_question->gend_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->gend_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="x<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_gend_id" name="o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" id="o<?php echo $app_test_question_grid->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_question->gend_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_num->Visible) { // qstn_num ?>
		<td data-name="qstn_num">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_num" class="form-group app_test_question_qstn_num">
<input type="text" data-table="app_test_question" data-field="x_qstn_num" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_num->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_num->EditValue ?>"<?php echo $app_test_question->qstn_num->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_num" class="form-group app_test_question_qstn_num">
<span<?php echo $app_test_question->qstn_num->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_num->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_num" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_num" value="<?php echo ew_HtmlEncode($app_test_question->qstn_num->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_text->Visible) { // qstn_text ?>
		<td data-name="qstn_text">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_text" class="form-group app_test_question_qstn_text">
<?php ew_AppendClass($app_test_question->qstn_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_text" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_text->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_text->EditAttributes() ?>><?php echo $app_test_question->qstn_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questiongrid", "x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text", 35, 4, <?php echo ($app_test_question->qstn_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_text" class="form-group app_test_question_qstn_text">
<span<?php echo $app_test_question->qstn_text->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_text->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_text" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_text" value="<?php echo ew_HtmlEncode($app_test_question->qstn_text->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr1->Visible) { // qstn_ansr1 ?>
		<td data-name="qstn_ansr1">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr1" class="form-group app_test_question_qstn_ansr1">
<?php ew_AppendClass($app_test_question->qstn_ansr1->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_ansr1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr1->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr1->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questiongrid", "x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1", 35, 2, <?php echo ($app_test_question->qstn_ansr1->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr1" class="form-group app_test_question_qstn_ansr1">
<span<?php echo $app_test_question->qstn_ansr1->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_ansr1->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val1->Visible) { // qstn_val1 ?>
		<td data-name="qstn_val1">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_val1" class="form-group app_test_question_qstn_val1">
<input type="text" data-table="app_test_question" data-field="x_qstn_val1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val1->EditValue ?>"<?php echo $app_test_question->qstn_val1->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_val1" class="form-group app_test_question_qstn_val1">
<span<?php echo $app_test_question->qstn_val1->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_val1->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep1->Visible) { // qstn_rep1 ?>
		<td data-name="qstn_rep1">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_rep1" class="form-group app_test_question_qstn_rep1">
<textarea data-table="app_test_question" data-field="x_qstn_rep1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep1->EditAttributes() ?>><?php echo $app_test_question->qstn_rep1->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_rep1" class="form-group app_test_question_qstn_rep1">
<span<?php echo $app_test_question->qstn_rep1->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_rep1->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep1" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep1" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr2->Visible) { // qstn_ansr2 ?>
		<td data-name="qstn_ansr2">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr2" class="form-group app_test_question_qstn_ansr2">
<textarea data-table="app_test_question" data-field="x_qstn_ansr2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr2->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr2->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr2" class="form-group app_test_question_qstn_ansr2">
<span<?php echo $app_test_question->qstn_ansr2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_ansr2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val2->Visible) { // qstn_val2 ?>
		<td data-name="qstn_val2">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_val2" class="form-group app_test_question_qstn_val2">
<input type="text" data-table="app_test_question" data-field="x_qstn_val2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val2->EditValue ?>"<?php echo $app_test_question->qstn_val2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_val2" class="form-group app_test_question_qstn_val2">
<span<?php echo $app_test_question->qstn_val2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_val2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep2->Visible) { // qstn_rep2 ?>
		<td data-name="qstn_rep2">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_rep2" class="form-group app_test_question_qstn_rep2">
<textarea data-table="app_test_question" data-field="x_qstn_rep2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep2->EditAttributes() ?>><?php echo $app_test_question->qstn_rep2->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_rep2" class="form-group app_test_question_qstn_rep2">
<span<?php echo $app_test_question->qstn_rep2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_rep2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep2" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep2" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr3->Visible) { // qstn_ansr3 ?>
		<td data-name="qstn_ansr3">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr3" class="form-group app_test_question_qstn_ansr3">
<textarea data-table="app_test_question" data-field="x_qstn_ansr3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr3->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr3->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr3" class="form-group app_test_question_qstn_ansr3">
<span<?php echo $app_test_question->qstn_ansr3->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_ansr3->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val3->Visible) { // qstn_val3 ?>
		<td data-name="qstn_val3">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_val3" class="form-group app_test_question_qstn_val3">
<input type="text" data-table="app_test_question" data-field="x_qstn_val3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val3->EditValue ?>"<?php echo $app_test_question->qstn_val3->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_val3" class="form-group app_test_question_qstn_val3">
<span<?php echo $app_test_question->qstn_val3->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_val3->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep3->Visible) { // qstn_rep3 ?>
		<td data-name="qstn_rep3">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_rep3" class="form-group app_test_question_qstn_rep3">
<textarea data-table="app_test_question" data-field="x_qstn_rep3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep3->EditAttributes() ?>><?php echo $app_test_question->qstn_rep3->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_rep3" class="form-group app_test_question_qstn_rep3">
<span<?php echo $app_test_question->qstn_rep3->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_rep3->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep3" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep3" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_ansr4->Visible) { // qstn_ansr4 ?>
		<td data-name="qstn_ansr4">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr4" class="form-group app_test_question_qstn_ansr4">
<textarea data-table="app_test_question" data-field="x_qstn_ansr4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr4->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr4->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_ansr4" class="form-group app_test_question_qstn_ansr4">
<span<?php echo $app_test_question->qstn_ansr4->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_ansr4->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_ansr4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_ansr4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_val4->Visible) { // qstn_val4 ?>
		<td data-name="qstn_val4">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_val4" class="form-group app_test_question_qstn_val4">
<input type="text" data-table="app_test_question" data-field="x_qstn_val4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val4->EditValue ?>"<?php echo $app_test_question->qstn_val4->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_val4" class="form-group app_test_question_qstn_val4">
<span<?php echo $app_test_question->qstn_val4->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_val4->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_val4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_val4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_question->qstn_rep4->Visible) { // qstn_rep4 ?>
		<td data-name="qstn_rep4">
<?php if ($app_test_question->CurrentAction <> "F") { ?>
<span id="el$rowindex$_app_test_question_qstn_rep4" class="form-group app_test_question_qstn_rep4">
<textarea data-table="app_test_question" data-field="x_qstn_rep4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep4->EditAttributes() ?>><?php echo $app_test_question->qstn_rep4->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_app_test_question_qstn_rep4" class="form-group app_test_question_qstn_rep4">
<span<?php echo $app_test_question->qstn_rep4->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->qstn_rep4->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="x<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="app_test_question" data-field="x_qstn_rep4" name="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" id="o<?php echo $app_test_question_grid->RowIndex ?>_qstn_rep4" value="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_question_grid->ListOptions->Render("body", "right", $app_test_question_grid->RowIndex);
?>
<script type="text/javascript">
fapp_test_questiongrid.UpdateOpts(<?php echo $app_test_question_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($app_test_question->CurrentMode == "add" || $app_test_question->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_test_question_grid->FormKeyCountName ?>" id="<?php echo $app_test_question_grid->FormKeyCountName ?>" value="<?php echo $app_test_question_grid->KeyCount ?>">
<?php echo $app_test_question_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_question->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_test_question_grid->FormKeyCountName ?>" id="<?php echo $app_test_question_grid->FormKeyCountName ?>" value="<?php echo $app_test_question_grid->KeyCount ?>">
<?php echo $app_test_question_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_question->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapp_test_questiongrid">
</div>
<?php

// Close recordset
if ($app_test_question_grid->Recordset)
	$app_test_question_grid->Recordset->Close();
?>
<?php if ($app_test_question_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($app_test_question_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($app_test_question_grid->TotalRecs == 0 && $app_test_question->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_question_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_test_question->Export == "") { ?>
<script type="text/javascript">
fapp_test_questiongrid.Init();
</script>
<?php } ?>
<?php
$app_test_question_grid->Page_Terminate();
?>
