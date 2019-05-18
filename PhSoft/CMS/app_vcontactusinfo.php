<?php

// Global variable for table object
$app_vcontactus = NULL;

//
// Table class for app_vcontactus
//
class capp_vcontactus extends cTable {
	var $cont_id;
	var $pgrp_id;
	var $lang_id;
	var $cntry_id;
	var $user_id;
	var $gend_id;
	var $status_id;
	var $status_name;
	var $lang_code;
	var $lang_dir;
	var $lang_name;
	var $lang_dname;
	var $lang_ccode;
	var $cntry_code;
	var $user_email;
	var $user_password;
	var $user_mobile;
	var $user_token;
	var $ins_datetime;
	var $upd_datetime;
	var $pgrp_name;
	var $cntry_name;
	var $gend_name;
	var $user_name;
	var $cont_subj;
	var $cont_msg;
	var $cont_datetime;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_vcontactus';
		$this->TableName = 'app_vcontactus';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`app_vcontactus`";
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

		// cont_id
		$this->cont_id = new cField('app_vcontactus', 'app_vcontactus', 'x_cont_id', 'cont_id', '`cont_id`', '`cont_id`', 3, -1, FALSE, '`cont_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->cont_id->Sortable = TRUE; // Allow sort
		$this->cont_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cont_id'] = &$this->cont_id;

		// pgrp_id
		$this->pgrp_id = new cField('app_vcontactus', 'app_vcontactus', 'x_pgrp_id', 'pgrp_id', '`pgrp_id`', '`pgrp_id`', 3, -1, FALSE, '`pgrp_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pgrp_id->Sortable = TRUE; // Allow sort
		$this->pgrp_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pgrp_id'] = &$this->pgrp_id;

		// lang_id
		$this->lang_id = new cField('app_vcontactus', 'app_vcontactus', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->lang_id->Sortable = TRUE; // Allow sort
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// cntry_id
		$this->cntry_id = new cField('app_vcontactus', 'app_vcontactus', 'x_cntry_id', 'cntry_id', '`cntry_id`', '`cntry_id`', 3, -1, FALSE, '`cntry_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->cntry_id->Sortable = FALSE; // Allow sort
		$this->cntry_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cntry_id'] = &$this->cntry_id;

		// user_id
		$this->user_id = new cField('app_vcontactus', 'app_vcontactus', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->user_id->Sortable = FALSE; // Allow sort
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// gend_id
		$this->gend_id = new cField('app_vcontactus', 'app_vcontactus', 'x_gend_id', 'gend_id', '`gend_id`', '`gend_id`', 16, -1, FALSE, '`gend_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gend_id->Sortable = FALSE; // Allow sort
		$this->gend_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['gend_id'] = &$this->gend_id;

		// status_id
		$this->status_id = new cField('app_vcontactus', 'app_vcontactus', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->status_id->Sortable = FALSE; // Allow sort
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// status_name
		$this->status_name = new cField('app_vcontactus', 'app_vcontactus', 'x_status_name', 'status_name', '`status_name`', '`status_name`', 200, -1, FALSE, '`status_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_name->Sortable = FALSE; // Allow sort
		$this->fields['status_name'] = &$this->status_name;

		// lang_code
		$this->lang_code = new cField('app_vcontactus', 'app_vcontactus', 'x_lang_code', 'lang_code', '`lang_code`', '`lang_code`', 200, -1, FALSE, '`lang_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_code->Sortable = FALSE; // Allow sort
		$this->fields['lang_code'] = &$this->lang_code;

		// lang_dir
		$this->lang_dir = new cField('app_vcontactus', 'app_vcontactus', 'x_lang_dir', 'lang_dir', '`lang_dir`', '`lang_dir`', 200, -1, FALSE, '`lang_dir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_dir->Sortable = FALSE; // Allow sort
		$this->fields['lang_dir'] = &$this->lang_dir;

		// lang_name
		$this->lang_name = new cField('app_vcontactus', 'app_vcontactus', 'x_lang_name', 'lang_name', '`lang_name`', '`lang_name`', 200, -1, FALSE, '`lang_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_name->Sortable = FALSE; // Allow sort
		$this->fields['lang_name'] = &$this->lang_name;

		// lang_dname
		$this->lang_dname = new cField('app_vcontactus', 'app_vcontactus', 'x_lang_dname', 'lang_dname', '`lang_dname`', '`lang_dname`', 200, -1, FALSE, '`lang_dname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_dname->Sortable = FALSE; // Allow sort
		$this->fields['lang_dname'] = &$this->lang_dname;

		// lang_ccode
		$this->lang_ccode = new cField('app_vcontactus', 'app_vcontactus', 'x_lang_ccode', 'lang_ccode', '`lang_ccode`', '`lang_ccode`', 200, -1, FALSE, '`lang_ccode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_ccode->Sortable = FALSE; // Allow sort
		$this->fields['lang_ccode'] = &$this->lang_ccode;

		// cntry_code
		$this->cntry_code = new cField('app_vcontactus', 'app_vcontactus', 'x_cntry_code', 'cntry_code', '`cntry_code`', '`cntry_code`', 200, -1, FALSE, '`cntry_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cntry_code->Sortable = FALSE; // Allow sort
		$this->fields['cntry_code'] = &$this->cntry_code;

		// user_email
		$this->user_email = new cField('app_vcontactus', 'app_vcontactus', 'x_user_email', 'user_email', '`user_email`', '`user_email`', 200, -1, FALSE, '`user_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_email->Sortable = FALSE; // Allow sort
		$this->fields['user_email'] = &$this->user_email;

		// user_password
		$this->user_password = new cField('app_vcontactus', 'app_vcontactus', 'x_user_password', 'user_password', '`user_password`', '`user_password`', 200, -1, FALSE, '`user_password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_password->Sortable = FALSE; // Allow sort
		$this->fields['user_password'] = &$this->user_password;

		// user_mobile
		$this->user_mobile = new cField('app_vcontactus', 'app_vcontactus', 'x_user_mobile', 'user_mobile', '`user_mobile`', '`user_mobile`', 200, -1, FALSE, '`user_mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_mobile->Sortable = FALSE; // Allow sort
		$this->fields['user_mobile'] = &$this->user_mobile;

		// user_token
		$this->user_token = new cField('app_vcontactus', 'app_vcontactus', 'x_user_token', 'user_token', '`user_token`', '`user_token`', 200, -1, FALSE, '`user_token`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_token->Sortable = FALSE; // Allow sort
		$this->fields['user_token'] = &$this->user_token;

		// ins_datetime
		$this->ins_datetime = new cField('app_vcontactus', 'app_vcontactus', 'x_ins_datetime', 'ins_datetime', '`ins_datetime`', ew_CastDateFieldForLike('`ins_datetime`', 0, "DB"), 135, 0, FALSE, '`ins_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ins_datetime->Sortable = FALSE; // Allow sort
		$this->ins_datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ins_datetime'] = &$this->ins_datetime;

		// upd_datetime
		$this->upd_datetime = new cField('app_vcontactus', 'app_vcontactus', 'x_upd_datetime', 'upd_datetime', '`upd_datetime`', ew_CastDateFieldForLike('`upd_datetime`', 0, "DB"), 135, 0, FALSE, '`upd_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->upd_datetime->Sortable = FALSE; // Allow sort
		$this->upd_datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['upd_datetime'] = &$this->upd_datetime;

		// pgrp_name
		$this->pgrp_name = new cField('app_vcontactus', 'app_vcontactus', 'x_pgrp_name', 'pgrp_name', '`pgrp_name`', '`pgrp_name`', 200, -1, FALSE, '`pgrp_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pgrp_name->Sortable = TRUE; // Allow sort
		$this->fields['pgrp_name'] = &$this->pgrp_name;

		// cntry_name
		$this->cntry_name = new cField('app_vcontactus', 'app_vcontactus', 'x_cntry_name', 'cntry_name', '`cntry_name`', '`cntry_name`', 200, -1, FALSE, '`cntry_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cntry_name->Sortable = TRUE; // Allow sort
		$this->fields['cntry_name'] = &$this->cntry_name;

		// gend_name
		$this->gend_name = new cField('app_vcontactus', 'app_vcontactus', 'x_gend_name', 'gend_name', '`gend_name`', '`gend_name`', 200, -1, FALSE, '`gend_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gend_name->Sortable = TRUE; // Allow sort
		$this->fields['gend_name'] = &$this->gend_name;

		// user_name
		$this->user_name = new cField('app_vcontactus', 'app_vcontactus', 'x_user_name', 'user_name', '`user_name`', '`user_name`', 200, -1, FALSE, '`user_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_name->Sortable = TRUE; // Allow sort
		$this->fields['user_name'] = &$this->user_name;

		// cont_subj
		$this->cont_subj = new cField('app_vcontactus', 'app_vcontactus', 'x_cont_subj', 'cont_subj', '`cont_subj`', '`cont_subj`', 200, -1, FALSE, '`cont_subj`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cont_subj->Sortable = TRUE; // Allow sort
		$this->fields['cont_subj'] = &$this->cont_subj;

		// cont_msg
		$this->cont_msg = new cField('app_vcontactus', 'app_vcontactus', 'x_cont_msg', 'cont_msg', '`cont_msg`', '`cont_msg`', 201, -1, FALSE, '`cont_msg`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->cont_msg->Sortable = TRUE; // Allow sort
		$this->fields['cont_msg'] = &$this->cont_msg;

		// cont_datetime
		$this->cont_datetime = new cField('app_vcontactus', 'app_vcontactus', 'x_cont_datetime', 'cont_datetime', '`cont_datetime`', ew_CastDateFieldForLike('`cont_datetime`', 0, "DB"), 135, 0, FALSE, '`cont_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cont_datetime->Sortable = TRUE; // Allow sort
		$this->cont_datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['cont_datetime'] = &$this->cont_datetime;
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

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_vcontactus`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`cont_datetime` DESC,`pgrp_name` ASC,`lang_id` ASC,`user_name` ASC";
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
			$this->cont_id->setDbValue($conn->Insert_ID());
			$rs['cont_id'] = $this->cont_id->DbValue;

			// Get insert id if necessary
			$this->lang_id->setDbValue($conn->Insert_ID());
			$rs['lang_id'] = $this->lang_id->DbValue;

			// Get insert id if necessary
			$this->cntry_id->setDbValue($conn->Insert_ID());
			$rs['cntry_id'] = $this->cntry_id->DbValue;

			// Get insert id if necessary
			$this->user_id->setDbValue($conn->Insert_ID());
			$rs['user_id'] = $this->user_id->DbValue;

			// Get insert id if necessary
			$this->status_id->setDbValue($conn->Insert_ID());
			$rs['status_id'] = $this->status_id->DbValue;
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
			if (array_key_exists('cont_id', $rs))
				ew_AddFilter($where, ew_QuotedName('cont_id', $this->DBID) . '=' . ew_QuotedValue($rs['cont_id'], $this->cont_id->FldDataType, $this->DBID));
			if (array_key_exists('pgrp_id', $rs))
				ew_AddFilter($where, ew_QuotedName('pgrp_id', $this->DBID) . '=' . ew_QuotedValue($rs['pgrp_id'], $this->pgrp_id->FldDataType, $this->DBID));
			if (array_key_exists('lang_id', $rs))
				ew_AddFilter($where, ew_QuotedName('lang_id', $this->DBID) . '=' . ew_QuotedValue($rs['lang_id'], $this->lang_id->FldDataType, $this->DBID));
			if (array_key_exists('cntry_id', $rs))
				ew_AddFilter($where, ew_QuotedName('cntry_id', $this->DBID) . '=' . ew_QuotedValue($rs['cntry_id'], $this->cntry_id->FldDataType, $this->DBID));
			if (array_key_exists('user_id', $rs))
				ew_AddFilter($where, ew_QuotedName('user_id', $this->DBID) . '=' . ew_QuotedValue($rs['user_id'], $this->user_id->FldDataType, $this->DBID));
			if (array_key_exists('gend_id', $rs))
				ew_AddFilter($where, ew_QuotedName('gend_id', $this->DBID) . '=' . ew_QuotedValue($rs['gend_id'], $this->gend_id->FldDataType, $this->DBID));
			if (array_key_exists('status_id', $rs))
				ew_AddFilter($where, ew_QuotedName('status_id', $this->DBID) . '=' . ew_QuotedValue($rs['status_id'], $this->status_id->FldDataType, $this->DBID));
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
		return "`cont_id` = @cont_id@ AND `pgrp_id` = @pgrp_id@ AND `lang_id` = @lang_id@ AND `cntry_id` = @cntry_id@ AND `user_id` = @user_id@ AND `gend_id` = @gend_id@ AND `status_id` = @status_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->cont_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->cont_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@cont_id@", ew_AdjustSql($this->cont_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->pgrp_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->pgrp_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@pgrp_id@", ew_AdjustSql($this->pgrp_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->lang_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->lang_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@lang_id@", ew_AdjustSql($this->lang_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->cntry_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->cntry_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@cntry_id@", ew_AdjustSql($this->cntry_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->user_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->user_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@user_id@", ew_AdjustSql($this->user_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->gend_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->gend_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@gend_id@", ew_AdjustSql($this->gend_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->status_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->status_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@status_id@", ew_AdjustSql($this->status_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_vcontactuslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_vcontactusview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_vcontactusedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_vcontactusadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_vcontactuslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_vcontactusview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_vcontactusview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_vcontactusadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_vcontactusadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("app_vcontactusedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("app_vcontactusadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_vcontactusdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "cont_id:" . ew_VarToJson($this->cont_id->CurrentValue, "number", "'");
		$json .= ",pgrp_id:" . ew_VarToJson($this->pgrp_id->CurrentValue, "number", "'");
		$json .= ",lang_id:" . ew_VarToJson($this->lang_id->CurrentValue, "number", "'");
		$json .= ",cntry_id:" . ew_VarToJson($this->cntry_id->CurrentValue, "number", "'");
		$json .= ",user_id:" . ew_VarToJson($this->user_id->CurrentValue, "number", "'");
		$json .= ",gend_id:" . ew_VarToJson($this->gend_id->CurrentValue, "number", "'");
		$json .= ",status_id:" . ew_VarToJson($this->status_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->cont_id->CurrentValue)) {
			$sUrl .= "cont_id=" . urlencode($this->cont_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->pgrp_id->CurrentValue)) {
			$sUrl .= "&pgrp_id=" . urlencode($this->pgrp_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->lang_id->CurrentValue)) {
			$sUrl .= "&lang_id=" . urlencode($this->lang_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->cntry_id->CurrentValue)) {
			$sUrl .= "&cntry_id=" . urlencode($this->cntry_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->user_id->CurrentValue)) {
			$sUrl .= "&user_id=" . urlencode($this->user_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->gend_id->CurrentValue)) {
			$sUrl .= "&gend_id=" . urlencode($this->gend_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->status_id->CurrentValue)) {
			$sUrl .= "&status_id=" . urlencode($this->status_id->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["cont_id"]))
				$arKey[] = $_POST["cont_id"];
			elseif (isset($_GET["cont_id"]))
				$arKey[] = $_GET["cont_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["pgrp_id"]))
				$arKey[] = $_POST["pgrp_id"];
			elseif (isset($_GET["pgrp_id"]))
				$arKey[] = $_GET["pgrp_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["lang_id"]))
				$arKey[] = $_POST["lang_id"];
			elseif (isset($_GET["lang_id"]))
				$arKey[] = $_GET["lang_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["cntry_id"]))
				$arKey[] = $_POST["cntry_id"];
			elseif (isset($_GET["cntry_id"]))
				$arKey[] = $_GET["cntry_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["user_id"]))
				$arKey[] = $_POST["user_id"];
			elseif (isset($_GET["user_id"]))
				$arKey[] = $_GET["user_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["gend_id"]))
				$arKey[] = $_POST["gend_id"];
			elseif (isset($_GET["gend_id"]))
				$arKey[] = $_GET["gend_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["status_id"]))
				$arKey[] = $_POST["status_id"];
			elseif (isset($_GET["status_id"]))
				$arKey[] = $_GET["status_id"];
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 7)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // cont_id
					continue;
				if (!is_numeric($key[1])) // pgrp_id
					continue;
				if (!is_numeric($key[2])) // lang_id
					continue;
				if (!is_numeric($key[3])) // cntry_id
					continue;
				if (!is_numeric($key[4])) // user_id
					continue;
				if (!is_numeric($key[5])) // gend_id
					continue;
				if (!is_numeric($key[6])) // status_id
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
			$this->cont_id->CurrentValue = $key[0];
			$this->pgrp_id->CurrentValue = $key[1];
			$this->lang_id->CurrentValue = $key[2];
			$this->cntry_id->CurrentValue = $key[3];
			$this->user_id->CurrentValue = $key[4];
			$this->gend_id->CurrentValue = $key[5];
			$this->status_id->CurrentValue = $key[6];
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
		$this->cont_id->setDbValue($rs->fields('cont_id'));
		$this->pgrp_id->setDbValue($rs->fields('pgrp_id'));
		$this->lang_id->setDbValue($rs->fields('lang_id'));
		$this->cntry_id->setDbValue($rs->fields('cntry_id'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->gend_id->setDbValue($rs->fields('gend_id'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->status_name->setDbValue($rs->fields('status_name'));
		$this->lang_code->setDbValue($rs->fields('lang_code'));
		$this->lang_dir->setDbValue($rs->fields('lang_dir'));
		$this->lang_name->setDbValue($rs->fields('lang_name'));
		$this->lang_dname->setDbValue($rs->fields('lang_dname'));
		$this->lang_ccode->setDbValue($rs->fields('lang_ccode'));
		$this->cntry_code->setDbValue($rs->fields('cntry_code'));
		$this->user_email->setDbValue($rs->fields('user_email'));
		$this->user_password->setDbValue($rs->fields('user_password'));
		$this->user_mobile->setDbValue($rs->fields('user_mobile'));
		$this->user_token->setDbValue($rs->fields('user_token'));
		$this->ins_datetime->setDbValue($rs->fields('ins_datetime'));
		$this->upd_datetime->setDbValue($rs->fields('upd_datetime'));
		$this->pgrp_name->setDbValue($rs->fields('pgrp_name'));
		$this->cntry_name->setDbValue($rs->fields('cntry_name'));
		$this->gend_name->setDbValue($rs->fields('gend_name'));
		$this->user_name->setDbValue($rs->fields('user_name'));
		$this->cont_subj->setDbValue($rs->fields('cont_subj'));
		$this->cont_msg->setDbValue($rs->fields('cont_msg'));
		$this->cont_datetime->setDbValue($rs->fields('cont_datetime'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// cont_id
		// pgrp_id
		// lang_id
		// cntry_id

		$this->cntry_id->CellCssStyle = "white-space: nowrap;";

		// user_id
		$this->user_id->CellCssStyle = "white-space: nowrap;";

		// gend_id
		$this->gend_id->CellCssStyle = "white-space: nowrap;";

		// status_id
		$this->status_id->CellCssStyle = "white-space: nowrap;";

		// status_name
		$this->status_name->CellCssStyle = "white-space: nowrap;";

		// lang_code
		$this->lang_code->CellCssStyle = "white-space: nowrap;";

		// lang_dir
		$this->lang_dir->CellCssStyle = "white-space: nowrap;";

		// lang_name
		$this->lang_name->CellCssStyle = "white-space: nowrap;";

		// lang_dname
		$this->lang_dname->CellCssStyle = "white-space: nowrap;";

		// lang_ccode
		$this->lang_ccode->CellCssStyle = "white-space: nowrap;";

		// cntry_code
		$this->cntry_code->CellCssStyle = "white-space: nowrap;";

		// user_email
		$this->user_email->CellCssStyle = "white-space: nowrap;";

		// user_password
		$this->user_password->CellCssStyle = "white-space: nowrap;";

		// user_mobile
		$this->user_mobile->CellCssStyle = "white-space: nowrap;";

		// user_token
		$this->user_token->CellCssStyle = "white-space: nowrap;";

		// ins_datetime
		$this->ins_datetime->CellCssStyle = "white-space: nowrap;";

		// upd_datetime
		$this->upd_datetime->CellCssStyle = "white-space: nowrap;";

		// pgrp_name
		// cntry_name
		// gend_name
		// user_name
		// cont_subj
		// cont_msg
		// cont_datetime
		// cont_id

		$this->cont_id->ViewValue = $this->cont_id->CurrentValue;
		$this->cont_id->ViewCustomAttributes = "";

		// pgrp_id
		$this->pgrp_id->ViewValue = $this->pgrp_id->CurrentValue;
		$this->pgrp_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->ViewValue = $this->lang_id->CurrentValue;
		$this->lang_id->ViewCustomAttributes = "";

		// cntry_id
		$this->cntry_id->ViewValue = $this->cntry_id->CurrentValue;
		$this->cntry_id->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// gend_id
		$this->gend_id->ViewValue = $this->gend_id->CurrentValue;
		$this->gend_id->ViewCustomAttributes = "";

		// status_id
		$this->status_id->ViewValue = $this->status_id->CurrentValue;
		$this->status_id->ViewCustomAttributes = "";

		// status_name
		$this->status_name->ViewValue = $this->status_name->CurrentValue;
		$this->status_name->ViewCustomAttributes = "";

		// lang_code
		$this->lang_code->ViewValue = $this->lang_code->CurrentValue;
		$this->lang_code->ViewCustomAttributes = "";

		// lang_dir
		$this->lang_dir->ViewValue = $this->lang_dir->CurrentValue;
		$this->lang_dir->ViewCustomAttributes = "";

		// lang_name
		$this->lang_name->ViewValue = $this->lang_name->CurrentValue;
		$this->lang_name->ViewCustomAttributes = "";

		// lang_dname
		$this->lang_dname->ViewValue = $this->lang_dname->CurrentValue;
		$this->lang_dname->ViewCustomAttributes = "";

		// lang_ccode
		$this->lang_ccode->ViewValue = $this->lang_ccode->CurrentValue;
		$this->lang_ccode->ViewCustomAttributes = "";

		// cntry_code
		$this->cntry_code->ViewValue = $this->cntry_code->CurrentValue;
		$this->cntry_code->ViewCustomAttributes = "";

		// user_email
		$this->user_email->ViewValue = $this->user_email->CurrentValue;
		$this->user_email->ViewCustomAttributes = "";

		// user_password
		$this->user_password->ViewValue = $this->user_password->CurrentValue;
		$this->user_password->ViewCustomAttributes = "";

		// user_mobile
		$this->user_mobile->ViewValue = $this->user_mobile->CurrentValue;
		$this->user_mobile->ViewCustomAttributes = "";

		// user_token
		$this->user_token->ViewValue = $this->user_token->CurrentValue;
		$this->user_token->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

		// upd_datetime
		$this->upd_datetime->ViewValue = $this->upd_datetime->CurrentValue;
		$this->upd_datetime->ViewValue = ew_FormatDateTime($this->upd_datetime->ViewValue, 0);
		$this->upd_datetime->ViewCustomAttributes = "";

		// pgrp_name
		$this->pgrp_name->ViewValue = $this->pgrp_name->CurrentValue;
		$this->pgrp_name->ViewCustomAttributes = "";

		// cntry_name
		$this->cntry_name->ViewValue = $this->cntry_name->CurrentValue;
		$this->cntry_name->ViewCustomAttributes = "";

		// gend_name
		$this->gend_name->ViewValue = $this->gend_name->CurrentValue;
		$this->gend_name->ViewCustomAttributes = "";

		// user_name
		$this->user_name->ViewValue = $this->user_name->CurrentValue;
		$this->user_name->ViewCustomAttributes = "";

		// cont_subj
		$this->cont_subj->ViewValue = $this->cont_subj->CurrentValue;
		$this->cont_subj->ViewCustomAttributes = "";

		// cont_msg
		$this->cont_msg->ViewValue = $this->cont_msg->CurrentValue;
		$this->cont_msg->ViewCustomAttributes = "";

		// cont_datetime
		$this->cont_datetime->ViewValue = $this->cont_datetime->CurrentValue;
		$this->cont_datetime->ViewValue = ew_FormatDateTime($this->cont_datetime->ViewValue, 0);
		$this->cont_datetime->ViewCustomAttributes = "";

		// cont_id
		$this->cont_id->LinkCustomAttributes = "";
		$this->cont_id->HrefValue = "";
		$this->cont_id->TooltipValue = "";

		// pgrp_id
		$this->pgrp_id->LinkCustomAttributes = "";
		$this->pgrp_id->HrefValue = "";
		$this->pgrp_id->TooltipValue = "";

		// lang_id
		$this->lang_id->LinkCustomAttributes = "";
		$this->lang_id->HrefValue = "";
		$this->lang_id->TooltipValue = "";

		// cntry_id
		$this->cntry_id->LinkCustomAttributes = "";
		$this->cntry_id->HrefValue = "";
		$this->cntry_id->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// gend_id
		$this->gend_id->LinkCustomAttributes = "";
		$this->gend_id->HrefValue = "";
		$this->gend_id->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// status_name
		$this->status_name->LinkCustomAttributes = "";
		$this->status_name->HrefValue = "";
		$this->status_name->TooltipValue = "";

		// lang_code
		$this->lang_code->LinkCustomAttributes = "";
		$this->lang_code->HrefValue = "";
		$this->lang_code->TooltipValue = "";

		// lang_dir
		$this->lang_dir->LinkCustomAttributes = "";
		$this->lang_dir->HrefValue = "";
		$this->lang_dir->TooltipValue = "";

		// lang_name
		$this->lang_name->LinkCustomAttributes = "";
		$this->lang_name->HrefValue = "";
		$this->lang_name->TooltipValue = "";

		// lang_dname
		$this->lang_dname->LinkCustomAttributes = "";
		$this->lang_dname->HrefValue = "";
		$this->lang_dname->TooltipValue = "";

		// lang_ccode
		$this->lang_ccode->LinkCustomAttributes = "";
		$this->lang_ccode->HrefValue = "";
		$this->lang_ccode->TooltipValue = "";

		// cntry_code
		$this->cntry_code->LinkCustomAttributes = "";
		$this->cntry_code->HrefValue = "";
		$this->cntry_code->TooltipValue = "";

		// user_email
		$this->user_email->LinkCustomAttributes = "";
		$this->user_email->HrefValue = "";
		$this->user_email->TooltipValue = "";

		// user_password
		$this->user_password->LinkCustomAttributes = "";
		$this->user_password->HrefValue = "";
		$this->user_password->TooltipValue = "";

		// user_mobile
		$this->user_mobile->LinkCustomAttributes = "";
		$this->user_mobile->HrefValue = "";
		$this->user_mobile->TooltipValue = "";

		// user_token
		$this->user_token->LinkCustomAttributes = "";
		$this->user_token->HrefValue = "";
		$this->user_token->TooltipValue = "";

		// ins_datetime
		$this->ins_datetime->LinkCustomAttributes = "";
		$this->ins_datetime->HrefValue = "";
		$this->ins_datetime->TooltipValue = "";

		// upd_datetime
		$this->upd_datetime->LinkCustomAttributes = "";
		$this->upd_datetime->HrefValue = "";
		$this->upd_datetime->TooltipValue = "";

		// pgrp_name
		$this->pgrp_name->LinkCustomAttributes = "";
		$this->pgrp_name->HrefValue = "";
		$this->pgrp_name->TooltipValue = "";

		// cntry_name
		$this->cntry_name->LinkCustomAttributes = "";
		$this->cntry_name->HrefValue = "";
		$this->cntry_name->TooltipValue = "";

		// gend_name
		$this->gend_name->LinkCustomAttributes = "";
		$this->gend_name->HrefValue = "";
		$this->gend_name->TooltipValue = "";

		// user_name
		$this->user_name->LinkCustomAttributes = "";
		$this->user_name->HrefValue = "";
		$this->user_name->TooltipValue = "";

		// cont_subj
		$this->cont_subj->LinkCustomAttributes = "";
		$this->cont_subj->HrefValue = "";
		$this->cont_subj->TooltipValue = "";

		// cont_msg
		$this->cont_msg->LinkCustomAttributes = "";
		$this->cont_msg->HrefValue = "";
		$this->cont_msg->TooltipValue = "";

		// cont_datetime
		$this->cont_datetime->LinkCustomAttributes = "";
		$this->cont_datetime->HrefValue = "";
		$this->cont_datetime->TooltipValue = "";

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

		// cont_id
		$this->cont_id->EditAttrs["class"] = "form-control";
		$this->cont_id->EditCustomAttributes = "";
		$this->cont_id->EditValue = $this->cont_id->CurrentValue;
		$this->cont_id->ViewCustomAttributes = "";

		// pgrp_id
		$this->pgrp_id->EditAttrs["class"] = "form-control";
		$this->pgrp_id->EditCustomAttributes = "";
		$this->pgrp_id->EditValue = $this->pgrp_id->CurrentValue;
		$this->pgrp_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->EditAttrs["class"] = "form-control";
		$this->lang_id->EditCustomAttributes = "";
		$this->lang_id->EditValue = $this->lang_id->CurrentValue;
		$this->lang_id->ViewCustomAttributes = "";

		// cntry_id
		$this->cntry_id->EditAttrs["class"] = "form-control";
		$this->cntry_id->EditCustomAttributes = "";
		$this->cntry_id->EditValue = $this->cntry_id->CurrentValue;
		$this->cntry_id->ViewCustomAttributes = "";

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";
		$this->user_id->EditValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// gend_id
		$this->gend_id->EditAttrs["class"] = "form-control";
		$this->gend_id->EditCustomAttributes = "";
		$this->gend_id->EditValue = $this->gend_id->CurrentValue;
		$this->gend_id->ViewCustomAttributes = "";

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";
		$this->status_id->EditValue = $this->status_id->CurrentValue;
		$this->status_id->ViewCustomAttributes = "";

		// status_name
		$this->status_name->EditAttrs["class"] = "form-control";
		$this->status_name->EditCustomAttributes = "";
		$this->status_name->EditValue = $this->status_name->CurrentValue;
		$this->status_name->PlaceHolder = ew_RemoveHtml($this->status_name->FldCaption());

		// lang_code
		$this->lang_code->EditAttrs["class"] = "form-control";
		$this->lang_code->EditCustomAttributes = "";
		$this->lang_code->EditValue = $this->lang_code->CurrentValue;
		$this->lang_code->PlaceHolder = ew_RemoveHtml($this->lang_code->FldCaption());

		// lang_dir
		$this->lang_dir->EditAttrs["class"] = "form-control";
		$this->lang_dir->EditCustomAttributes = "";
		$this->lang_dir->EditValue = $this->lang_dir->CurrentValue;
		$this->lang_dir->PlaceHolder = ew_RemoveHtml($this->lang_dir->FldCaption());

		// lang_name
		$this->lang_name->EditAttrs["class"] = "form-control";
		$this->lang_name->EditCustomAttributes = "";
		$this->lang_name->EditValue = $this->lang_name->CurrentValue;
		$this->lang_name->PlaceHolder = ew_RemoveHtml($this->lang_name->FldCaption());

		// lang_dname
		$this->lang_dname->EditAttrs["class"] = "form-control";
		$this->lang_dname->EditCustomAttributes = "";
		$this->lang_dname->EditValue = $this->lang_dname->CurrentValue;
		$this->lang_dname->PlaceHolder = ew_RemoveHtml($this->lang_dname->FldCaption());

		// lang_ccode
		$this->lang_ccode->EditAttrs["class"] = "form-control";
		$this->lang_ccode->EditCustomAttributes = "";
		$this->lang_ccode->EditValue = $this->lang_ccode->CurrentValue;
		$this->lang_ccode->PlaceHolder = ew_RemoveHtml($this->lang_ccode->FldCaption());

		// cntry_code
		$this->cntry_code->EditAttrs["class"] = "form-control";
		$this->cntry_code->EditCustomAttributes = "";
		$this->cntry_code->EditValue = $this->cntry_code->CurrentValue;
		$this->cntry_code->PlaceHolder = ew_RemoveHtml($this->cntry_code->FldCaption());

		// user_email
		$this->user_email->EditAttrs["class"] = "form-control";
		$this->user_email->EditCustomAttributes = "";
		$this->user_email->EditValue = $this->user_email->CurrentValue;
		$this->user_email->PlaceHolder = ew_RemoveHtml($this->user_email->FldCaption());

		// user_password
		$this->user_password->EditAttrs["class"] = "form-control";
		$this->user_password->EditCustomAttributes = "";
		$this->user_password->EditValue = $this->user_password->CurrentValue;
		$this->user_password->PlaceHolder = ew_RemoveHtml($this->user_password->FldCaption());

		// user_mobile
		$this->user_mobile->EditAttrs["class"] = "form-control";
		$this->user_mobile->EditCustomAttributes = "";
		$this->user_mobile->EditValue = $this->user_mobile->CurrentValue;
		$this->user_mobile->PlaceHolder = ew_RemoveHtml($this->user_mobile->FldCaption());

		// user_token
		$this->user_token->EditAttrs["class"] = "form-control";
		$this->user_token->EditCustomAttributes = "";
		$this->user_token->EditValue = $this->user_token->CurrentValue;
		$this->user_token->PlaceHolder = ew_RemoveHtml($this->user_token->FldCaption());

		// ins_datetime
		$this->ins_datetime->EditAttrs["class"] = "form-control";
		$this->ins_datetime->EditCustomAttributes = "";
		$this->ins_datetime->EditValue = ew_FormatDateTime($this->ins_datetime->CurrentValue, 8);
		$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

		// upd_datetime
		$this->upd_datetime->EditAttrs["class"] = "form-control";
		$this->upd_datetime->EditCustomAttributes = "";
		$this->upd_datetime->EditValue = ew_FormatDateTime($this->upd_datetime->CurrentValue, 8);
		$this->upd_datetime->PlaceHolder = ew_RemoveHtml($this->upd_datetime->FldCaption());

		// pgrp_name
		$this->pgrp_name->EditAttrs["class"] = "form-control";
		$this->pgrp_name->EditCustomAttributes = "";
		$this->pgrp_name->EditValue = $this->pgrp_name->CurrentValue;
		$this->pgrp_name->PlaceHolder = ew_RemoveHtml($this->pgrp_name->FldCaption());

		// cntry_name
		$this->cntry_name->EditAttrs["class"] = "form-control";
		$this->cntry_name->EditCustomAttributes = "";
		$this->cntry_name->EditValue = $this->cntry_name->CurrentValue;
		$this->cntry_name->PlaceHolder = ew_RemoveHtml($this->cntry_name->FldCaption());

		// gend_name
		$this->gend_name->EditAttrs["class"] = "form-control";
		$this->gend_name->EditCustomAttributes = "";
		$this->gend_name->EditValue = $this->gend_name->CurrentValue;
		$this->gend_name->PlaceHolder = ew_RemoveHtml($this->gend_name->FldCaption());

		// user_name
		$this->user_name->EditAttrs["class"] = "form-control";
		$this->user_name->EditCustomAttributes = "";
		$this->user_name->EditValue = $this->user_name->CurrentValue;
		$this->user_name->PlaceHolder = ew_RemoveHtml($this->user_name->FldCaption());

		// cont_subj
		$this->cont_subj->EditAttrs["class"] = "form-control";
		$this->cont_subj->EditCustomAttributes = "";
		$this->cont_subj->EditValue = $this->cont_subj->CurrentValue;
		$this->cont_subj->PlaceHolder = ew_RemoveHtml($this->cont_subj->FldCaption());

		// cont_msg
		$this->cont_msg->EditAttrs["class"] = "form-control";
		$this->cont_msg->EditCustomAttributes = "";
		$this->cont_msg->EditValue = $this->cont_msg->CurrentValue;
		$this->cont_msg->PlaceHolder = ew_RemoveHtml($this->cont_msg->FldCaption());

		// cont_datetime
		$this->cont_datetime->EditAttrs["class"] = "form-control";
		$this->cont_datetime->EditCustomAttributes = "";
		$this->cont_datetime->EditValue = ew_FormatDateTime($this->cont_datetime->CurrentValue, 8);
		$this->cont_datetime->PlaceHolder = ew_RemoveHtml($this->cont_datetime->FldCaption());

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
					if ($this->cont_id->Exportable) $Doc->ExportCaption($this->cont_id);
					if ($this->pgrp_id->Exportable) $Doc->ExportCaption($this->pgrp_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->pgrp_name->Exportable) $Doc->ExportCaption($this->pgrp_name);
					if ($this->cntry_name->Exportable) $Doc->ExportCaption($this->cntry_name);
					if ($this->gend_name->Exportable) $Doc->ExportCaption($this->gend_name);
					if ($this->user_name->Exportable) $Doc->ExportCaption($this->user_name);
					if ($this->cont_subj->Exportable) $Doc->ExportCaption($this->cont_subj);
					if ($this->cont_msg->Exportable) $Doc->ExportCaption($this->cont_msg);
					if ($this->cont_datetime->Exportable) $Doc->ExportCaption($this->cont_datetime);
				} else {
					if ($this->cont_id->Exportable) $Doc->ExportCaption($this->cont_id);
					if ($this->pgrp_id->Exportable) $Doc->ExportCaption($this->pgrp_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->pgrp_name->Exportable) $Doc->ExportCaption($this->pgrp_name);
					if ($this->cntry_name->Exportable) $Doc->ExportCaption($this->cntry_name);
					if ($this->gend_name->Exportable) $Doc->ExportCaption($this->gend_name);
					if ($this->user_name->Exportable) $Doc->ExportCaption($this->user_name);
					if ($this->cont_subj->Exportable) $Doc->ExportCaption($this->cont_subj);
					if ($this->cont_msg->Exportable) $Doc->ExportCaption($this->cont_msg);
					if ($this->cont_datetime->Exportable) $Doc->ExportCaption($this->cont_datetime);
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
						if ($this->cont_id->Exportable) $Doc->ExportField($this->cont_id);
						if ($this->pgrp_id->Exportable) $Doc->ExportField($this->pgrp_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->pgrp_name->Exportable) $Doc->ExportField($this->pgrp_name);
						if ($this->cntry_name->Exportable) $Doc->ExportField($this->cntry_name);
						if ($this->gend_name->Exportable) $Doc->ExportField($this->gend_name);
						if ($this->user_name->Exportable) $Doc->ExportField($this->user_name);
						if ($this->cont_subj->Exportable) $Doc->ExportField($this->cont_subj);
						if ($this->cont_msg->Exportable) $Doc->ExportField($this->cont_msg);
						if ($this->cont_datetime->Exportable) $Doc->ExportField($this->cont_datetime);
					} else {
						if ($this->cont_id->Exportable) $Doc->ExportField($this->cont_id);
						if ($this->pgrp_id->Exportable) $Doc->ExportField($this->pgrp_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->pgrp_name->Exportable) $Doc->ExportField($this->pgrp_name);
						if ($this->cntry_name->Exportable) $Doc->ExportField($this->cntry_name);
						if ($this->gend_name->Exportable) $Doc->ExportField($this->gend_name);
						if ($this->user_name->Exportable) $Doc->ExportField($this->user_name);
						if ($this->cont_subj->Exportable) $Doc->ExportField($this->cont_subj);
						if ($this->cont_msg->Exportable) $Doc->ExportField($this->cont_msg);
						if ($this->cont_datetime->Exportable) $Doc->ExportField($this->cont_datetime);
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
