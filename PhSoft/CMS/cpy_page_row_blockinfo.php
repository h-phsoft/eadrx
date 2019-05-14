<?php

// Global variable for table object
$cpy_page_row_block = NULL;

//
// Table class for cpy_page_row_block
//
class ccpy_page_row_block extends cTable {
	var $blk_id;
	var $row_id;
	var $type_id;
	var $slid_id;
	var $video_id;
	var $status_id;
	var $cols_id;
	var $blk_order;
	var $blk_name;
	var $blk_header;
	var $blk_image;
	var $blk_stext;
	var $blk_text;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cpy_page_row_block';
		$this->TableName = 'cpy_page_row_block';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cpy_page_row_block`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// blk_id
		$this->blk_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_id', 'blk_id', '`blk_id`', '`blk_id`', 3, -1, FALSE, '`blk_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->blk_id->Sortable = FALSE; // Allow sort
		$this->blk_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['blk_id'] = &$this->blk_id;

		// row_id
		$this->row_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_row_id', 'row_id', '`row_id`', '`row_id`', 3, -1, FALSE, '`row_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->row_id->Sortable = TRUE; // Allow sort
		$this->row_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->row_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->row_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['row_id'] = &$this->row_id;

		// type_id
		$this->type_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_type_id', 'type_id', '`type_id`', '`type_id`', 16, -1, FALSE, '`type_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->type_id->Sortable = TRUE; // Allow sort
		$this->type_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->type_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->type_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['type_id'] = &$this->type_id;

		// slid_id
		$this->slid_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_slid_id', 'slid_id', '`slid_id`', '`slid_id`', 3, -1, FALSE, '`slid_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->slid_id->Sortable = TRUE; // Allow sort
		$this->slid_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->slid_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->slid_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['slid_id'] = &$this->slid_id;

		// video_id
		$this->video_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_video_id', 'video_id', '`video_id`', '`video_id`', 3, -1, FALSE, '`video_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->video_id->Sortable = TRUE; // Allow sort
		$this->video_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->video_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->video_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['video_id'] = &$this->video_id;

		// status_id
		$this->status_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// cols_id
		$this->cols_id = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_cols_id', 'cols_id', '`cols_id`', '`cols_id`', 16, -1, FALSE, '`cols_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cols_id->Sortable = TRUE; // Allow sort
		$this->cols_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cols_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->cols_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cols_id'] = &$this->cols_id;

		// blk_order
		$this->blk_order = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_order', 'blk_order', '`blk_order`', '`blk_order`', 2, -1, FALSE, '`blk_order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->blk_order->Sortable = TRUE; // Allow sort
		$this->blk_order->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['blk_order'] = &$this->blk_order;

		// blk_name
		$this->blk_name = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_name', 'blk_name', '`blk_name`', '`blk_name`', 200, -1, FALSE, '`blk_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->blk_name->Sortable = TRUE; // Allow sort
		$this->fields['blk_name'] = &$this->blk_name;

		// blk_header
		$this->blk_header = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_header', 'blk_header', '`blk_header`', '`blk_header`', 200, -1, FALSE, '`blk_header`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->blk_header->Sortable = TRUE; // Allow sort
		$this->fields['blk_header'] = &$this->blk_header;

		// blk_image
		$this->blk_image = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_image', 'blk_image', '`blk_image`', '`blk_image`', 200, -1, TRUE, '`blk_image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->blk_image->Sortable = TRUE; // Allow sort
		$this->fields['blk_image'] = &$this->blk_image;

		// blk_stext
		$this->blk_stext = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_stext', 'blk_stext', '`blk_stext`', '`blk_stext`', 201, -1, FALSE, '`blk_stext`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->blk_stext->Sortable = TRUE; // Allow sort
		$this->fields['blk_stext'] = &$this->blk_stext;

		// blk_text
		$this->blk_text = new cField('cpy_page_row_block', 'cpy_page_row_block', 'x_blk_text', 'blk_text', '`blk_text`', '`blk_text`', 201, -1, FALSE, '`blk_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->blk_text->Sortable = TRUE; // Allow sort
		$this->fields['blk_text'] = &$this->blk_text;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "cpy_page_row") {
			if ($this->row_id->getSessionValue() <> "")
				$sMasterFilter .= "`row_id`=" . ew_QuotedValue($this->row_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cpy_page_row") {
			if ($this->row_id->getSessionValue() <> "")
				$sDetailFilter .= "`row_id`=" . ew_QuotedValue($this->row_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cpy_page_row() {
		return "`row_id`=@row_id@";
	}

	// Detail filter
	function SqlDetailFilter_cpy_page_row() {
		return "`row_id`=@row_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cpy_page_row_block`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`row_id` ASC,`blk_order` ASC,`blk_id` ASC";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->blk_id->setDbValue($conn->Insert_ID());
			$rs['blk_id'] = $this->blk_id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('blk_id', $rs))
				ew_AddFilter($where, ew_QuotedName('blk_id', $this->DBID) . '=' . ew_QuotedValue($rs['blk_id'], $this->blk_id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`blk_id` = @blk_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->blk_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->blk_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@blk_id@", ew_AdjustSql($this->blk_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "cpy_page_row_blocklist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "cpy_page_row_blockview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "cpy_page_row_blockedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "cpy_page_row_blockadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "cpy_page_row_blocklist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("cpy_page_row_blockview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("cpy_page_row_blockview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "cpy_page_row_blockadd.php?" . $this->UrlParm($parm);
		else
			$url = "cpy_page_row_blockadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("cpy_page_row_blockedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("cpy_page_row_blockadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cpy_page_row_blockdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "cpy_page_row" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_row_id=" . urlencode($this->row_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "blk_id:" . ew_VarToJson($this->blk_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->blk_id->CurrentValue)) {
			$sUrl .= "blk_id=" . urlencode($this->blk_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["blk_id"]))
				$arKeys[] = $_POST["blk_id"];
			elseif (isset($_GET["blk_id"]))
				$arKeys[] = $_GET["blk_id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->blk_id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->blk_id->setDbValue($rs->fields('blk_id'));
		$this->row_id->setDbValue($rs->fields('row_id'));
		$this->type_id->setDbValue($rs->fields('type_id'));
		$this->slid_id->setDbValue($rs->fields('slid_id'));
		$this->video_id->setDbValue($rs->fields('video_id'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->cols_id->setDbValue($rs->fields('cols_id'));
		$this->blk_order->setDbValue($rs->fields('blk_order'));
		$this->blk_name->setDbValue($rs->fields('blk_name'));
		$this->blk_header->setDbValue($rs->fields('blk_header'));
		$this->blk_image->Upload->DbValue = $rs->fields('blk_image');
		$this->blk_stext->setDbValue($rs->fields('blk_stext'));
		$this->blk_text->setDbValue($rs->fields('blk_text'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// blk_id

		$this->blk_id->CellCssStyle = "white-space: nowrap;";

		// row_id
		// type_id
		// slid_id
		// video_id
		// status_id
		// cols_id
		// blk_order
		// blk_name
		// blk_header
		// blk_image
		// blk_stext
		// blk_text
		// blk_id

		$this->blk_id->ViewValue = $this->blk_id->CurrentValue;
		$this->blk_id->ViewCustomAttributes = "";

		// row_id
		if (strval($this->row_id->CurrentValue) <> "") {
			$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
		$sWhereWrk = "";
		$this->row_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->row_id->ViewValue = $this->row_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->row_id->ViewValue = $this->row_id->CurrentValue;
			}
		} else {
			$this->row_id->ViewValue = NULL;
		}
		$this->row_id->ViewCustomAttributes = "";

		// type_id
		if (strval($this->type_id->CurrentValue) <> "") {
			$sFilterWrk = "`type_id`" . ew_SearchString("=", $this->type_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `type_id`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_block_type`";
		$sWhereWrk = "";
		$this->type_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `type_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->type_id->ViewValue = $this->type_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->type_id->ViewValue = $this->type_id->CurrentValue;
			}
		} else {
			$this->type_id->ViewValue = NULL;
		}
		$this->type_id->ViewCustomAttributes = "";

		// slid_id
		if (strval($this->slid_id->CurrentValue) <> "") {
			$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `slid_id`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_slider_mst`";
		$sWhereWrk = "";
		$this->slid_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `slid_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->slid_id->ViewValue = $this->slid_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->slid_id->ViewValue = $this->slid_id->CurrentValue;
			}
		} else {
			$this->slid_id->ViewValue = NULL;
		}
		$this->slid_id->ViewCustomAttributes = "";

		// video_id
		if (strval($this->video_id->CurrentValue) <> "") {
			$sFilterWrk = "`video_id`" . ew_SearchString("=", $this->video_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `video_id`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_video`";
		$sWhereWrk = "";
		$this->video_id->LookupFilters = array("dx1" => '`video_name`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `video_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->video_id->ViewValue = $this->video_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->video_id->ViewValue = $this->video_id->CurrentValue;
			}
		} else {
			$this->video_id->ViewValue = NULL;
		}
		$this->video_id->ViewCustomAttributes = "";

		// status_id
		if (strval($this->status_id->CurrentValue) <> "") {
			$sFilterWrk = "`status_id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `status_id`, `status_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
		$sWhereWrk = "";
		$this->status_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `status_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->status_id->ViewValue = $this->status_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->status_id->ViewValue = $this->status_id->CurrentValue;
			}
		} else {
			$this->status_id->ViewValue = NULL;
		}
		$this->status_id->ViewCustomAttributes = "";

		// cols_id
		if (strval($this->cols_id->CurrentValue) <> "") {
			$sFilterWrk = "`cols_id`" . ew_SearchString("=", $this->cols_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cols_id`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_cols`";
		$sWhereWrk = "";
		$this->cols_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cols_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cols_id->ViewValue = $this->cols_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cols_id->ViewValue = $this->cols_id->CurrentValue;
			}
		} else {
			$this->cols_id->ViewValue = NULL;
		}
		$this->cols_id->ViewCustomAttributes = "";

		// blk_order
		$this->blk_order->ViewValue = $this->blk_order->CurrentValue;
		$this->blk_order->ViewCustomAttributes = "";

		// blk_name
		$this->blk_name->ViewValue = $this->blk_name->CurrentValue;
		$this->blk_name->ViewCustomAttributes = "";

		// blk_header
		$this->blk_header->ViewValue = $this->blk_header->CurrentValue;
		$this->blk_header->ViewCustomAttributes = "";

		// blk_image
		$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
		if (!ew_Empty($this->blk_image->Upload->DbValue)) {
			$this->blk_image->ImageWidth = 200;
			$this->blk_image->ImageHeight = 0;
			$this->blk_image->ImageAlt = $this->blk_image->FldAlt();
			$this->blk_image->ViewValue = $this->blk_image->Upload->DbValue;
		} else {
			$this->blk_image->ViewValue = "";
		}
		$this->blk_image->ViewCustomAttributes = "";

		// blk_stext
		$this->blk_stext->ViewValue = $this->blk_stext->CurrentValue;
		$this->blk_stext->ViewCustomAttributes = "";

		// blk_text
		$this->blk_text->ViewValue = $this->blk_text->CurrentValue;
		$this->blk_text->ViewCustomAttributes = "";

		// blk_id
		$this->blk_id->LinkCustomAttributes = "";
		$this->blk_id->HrefValue = "";
		$this->blk_id->TooltipValue = "";

		// row_id
		$this->row_id->LinkCustomAttributes = "";
		$this->row_id->HrefValue = "";
		$this->row_id->TooltipValue = "";

		// type_id
		$this->type_id->LinkCustomAttributes = "";
		$this->type_id->HrefValue = "";
		$this->type_id->TooltipValue = "";

		// slid_id
		$this->slid_id->LinkCustomAttributes = "";
		$this->slid_id->HrefValue = "";
		$this->slid_id->TooltipValue = "";

		// video_id
		$this->video_id->LinkCustomAttributes = "";
		$this->video_id->HrefValue = "";
		$this->video_id->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// cols_id
		$this->cols_id->LinkCustomAttributes = "";
		$this->cols_id->HrefValue = "";
		$this->cols_id->TooltipValue = "";

		// blk_order
		$this->blk_order->LinkCustomAttributes = "";
		$this->blk_order->HrefValue = "";
		$this->blk_order->TooltipValue = "";

		// blk_name
		$this->blk_name->LinkCustomAttributes = "";
		$this->blk_name->HrefValue = "";
		$this->blk_name->TooltipValue = "";

		// blk_header
		$this->blk_header->LinkCustomAttributes = "";
		$this->blk_header->HrefValue = "";
		$this->blk_header->TooltipValue = "";

		// blk_image
		$this->blk_image->LinkCustomAttributes = "";
		$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
		if (!ew_Empty($this->blk_image->Upload->DbValue)) {
			$this->blk_image->HrefValue = ew_GetFileUploadUrl($this->blk_image, $this->blk_image->Upload->DbValue); // Add prefix/suffix
			$this->blk_image->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->blk_image->HrefValue = ew_FullUrl($this->blk_image->HrefValue, "href");
		} else {
			$this->blk_image->HrefValue = "";
		}
		$this->blk_image->HrefValue2 = $this->blk_image->UploadPath . $this->blk_image->Upload->DbValue;
		$this->blk_image->TooltipValue = "";
		if ($this->blk_image->UseColorbox) {
			if (ew_Empty($this->blk_image->TooltipValue))
				$this->blk_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->blk_image->LinkAttrs["data-rel"] = "cpy_page_row_block_x_blk_image";
			ew_AppendClass($this->blk_image->LinkAttrs["class"], "ewLightbox");
		}

		// blk_stext
		$this->blk_stext->LinkCustomAttributes = "";
		$this->blk_stext->HrefValue = "";
		$this->blk_stext->TooltipValue = "";

		// blk_text
		$this->blk_text->LinkCustomAttributes = "";
		$this->blk_text->HrefValue = "";
		$this->blk_text->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// blk_id
		$this->blk_id->EditAttrs["class"] = "form-control";
		$this->blk_id->EditCustomAttributes = "";
		$this->blk_id->EditValue = $this->blk_id->CurrentValue;
		$this->blk_id->ViewCustomAttributes = "";

		// row_id
		$this->row_id->EditAttrs["class"] = "form-control";
		$this->row_id->EditCustomAttributes = "";
		if ($this->row_id->getSessionValue() <> "") {
			$this->row_id->CurrentValue = $this->row_id->getSessionValue();
		if (strval($this->row_id->CurrentValue) <> "") {
			$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
		$sWhereWrk = "";
		$this->row_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->row_id->ViewValue = $this->row_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->row_id->ViewValue = $this->row_id->CurrentValue;
			}
		} else {
			$this->row_id->ViewValue = NULL;
		}
		$this->row_id->ViewCustomAttributes = "";
		} else {
		}

		// type_id
		$this->type_id->EditAttrs["class"] = "form-control";
		$this->type_id->EditCustomAttributes = "";

		// slid_id
		$this->slid_id->EditAttrs["class"] = "form-control";
		$this->slid_id->EditCustomAttributes = "";

		// video_id
		$this->video_id->EditAttrs["class"] = "form-control";
		$this->video_id->EditCustomAttributes = "";

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// cols_id
		$this->cols_id->EditAttrs["class"] = "form-control";
		$this->cols_id->EditCustomAttributes = "";

		// blk_order
		$this->blk_order->EditAttrs["class"] = "form-control";
		$this->blk_order->EditCustomAttributes = "";
		$this->blk_order->EditValue = $this->blk_order->CurrentValue;
		$this->blk_order->PlaceHolder = ew_RemoveHtml($this->blk_order->FldCaption());

		// blk_name
		$this->blk_name->EditAttrs["class"] = "form-control";
		$this->blk_name->EditCustomAttributes = "";
		$this->blk_name->EditValue = $this->blk_name->CurrentValue;
		$this->blk_name->PlaceHolder = ew_RemoveHtml($this->blk_name->FldCaption());

		// blk_header
		$this->blk_header->EditAttrs["class"] = "form-control";
		$this->blk_header->EditCustomAttributes = "";
		$this->blk_header->EditValue = $this->blk_header->CurrentValue;
		$this->blk_header->PlaceHolder = ew_RemoveHtml($this->blk_header->FldCaption());

		// blk_image
		$this->blk_image->EditAttrs["class"] = "form-control";
		$this->blk_image->EditCustomAttributes = "";
		$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
		if (!ew_Empty($this->blk_image->Upload->DbValue)) {
			$this->blk_image->ImageWidth = 200;
			$this->blk_image->ImageHeight = 0;
			$this->blk_image->ImageAlt = $this->blk_image->FldAlt();
			$this->blk_image->EditValue = $this->blk_image->Upload->DbValue;
		} else {
			$this->blk_image->EditValue = "";
		}
		if (!ew_Empty($this->blk_image->CurrentValue))
				$this->blk_image->Upload->FileName = $this->blk_image->CurrentValue;

		// blk_stext
		$this->blk_stext->EditAttrs["class"] = "form-control";
		$this->blk_stext->EditCustomAttributes = "";
		$this->blk_stext->EditValue = $this->blk_stext->CurrentValue;
		$this->blk_stext->PlaceHolder = ew_RemoveHtml($this->blk_stext->FldCaption());

		// blk_text
		$this->blk_text->EditAttrs["class"] = "form-control";
		$this->blk_text->EditCustomAttributes = "";
		$this->blk_text->EditValue = $this->blk_text->CurrentValue;
		$this->blk_text->PlaceHolder = ew_RemoveHtml($this->blk_text->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->row_id->Exportable) $Doc->ExportCaption($this->row_id);
					if ($this->type_id->Exportable) $Doc->ExportCaption($this->type_id);
					if ($this->slid_id->Exportable) $Doc->ExportCaption($this->slid_id);
					if ($this->video_id->Exportable) $Doc->ExportCaption($this->video_id);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->cols_id->Exportable) $Doc->ExportCaption($this->cols_id);
					if ($this->blk_order->Exportable) $Doc->ExportCaption($this->blk_order);
					if ($this->blk_name->Exportable) $Doc->ExportCaption($this->blk_name);
					if ($this->blk_header->Exportable) $Doc->ExportCaption($this->blk_header);
					if ($this->blk_image->Exportable) $Doc->ExportCaption($this->blk_image);
					if ($this->blk_stext->Exportable) $Doc->ExportCaption($this->blk_stext);
					if ($this->blk_text->Exportable) $Doc->ExportCaption($this->blk_text);
				} else {
					if ($this->row_id->Exportable) $Doc->ExportCaption($this->row_id);
					if ($this->type_id->Exportable) $Doc->ExportCaption($this->type_id);
					if ($this->slid_id->Exportable) $Doc->ExportCaption($this->slid_id);
					if ($this->video_id->Exportable) $Doc->ExportCaption($this->video_id);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->cols_id->Exportable) $Doc->ExportCaption($this->cols_id);
					if ($this->blk_order->Exportable) $Doc->ExportCaption($this->blk_order);
					if ($this->blk_name->Exportable) $Doc->ExportCaption($this->blk_name);
					if ($this->blk_header->Exportable) $Doc->ExportCaption($this->blk_header);
					if ($this->blk_image->Exportable) $Doc->ExportCaption($this->blk_image);
					if ($this->blk_stext->Exportable) $Doc->ExportCaption($this->blk_stext);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->row_id->Exportable) $Doc->ExportField($this->row_id);
						if ($this->type_id->Exportable) $Doc->ExportField($this->type_id);
						if ($this->slid_id->Exportable) $Doc->ExportField($this->slid_id);
						if ($this->video_id->Exportable) $Doc->ExportField($this->video_id);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->cols_id->Exportable) $Doc->ExportField($this->cols_id);
						if ($this->blk_order->Exportable) $Doc->ExportField($this->blk_order);
						if ($this->blk_name->Exportable) $Doc->ExportField($this->blk_name);
						if ($this->blk_header->Exportable) $Doc->ExportField($this->blk_header);
						if ($this->blk_image->Exportable) $Doc->ExportField($this->blk_image);
						if ($this->blk_stext->Exportable) $Doc->ExportField($this->blk_stext);
						if ($this->blk_text->Exportable) $Doc->ExportField($this->blk_text);
					} else {
						if ($this->row_id->Exportable) $Doc->ExportField($this->row_id);
						if ($this->type_id->Exportable) $Doc->ExportField($this->type_id);
						if ($this->slid_id->Exportable) $Doc->ExportField($this->slid_id);
						if ($this->video_id->Exportable) $Doc->ExportField($this->video_id);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->cols_id->Exportable) $Doc->ExportField($this->cols_id);
						if ($this->blk_order->Exportable) $Doc->ExportField($this->blk_order);
						if ($this->blk_name->Exportable) $Doc->ExportField($this->blk_name);
						if ($this->blk_header->Exportable) $Doc->ExportField($this->blk_header);
						if ($this->blk_image->Exportable) $Doc->ExportField($this->blk_image);
						if ($this->blk_stext->Exportable) $Doc->ExportField($this->blk_stext);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
