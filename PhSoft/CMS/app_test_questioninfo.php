<?php

// Global variable for table object
$app_test_question = NULL;

//
// Table class for app_test_question
//
class capp_test_question extends cTable {
	var $qstn_id;
	var $test_id;
	var $lang_id;
	var $gend_id;
	var $qstn_num;
	var $qstn_text;
	var $qstn_ansr1;
	var $qstn_val1;
	var $qstn_rep1;
	var $qstn_ansr2;
	var $qstn_val2;
	var $qstn_rep2;
	var $qstn_ansr3;
	var $qstn_val3;
	var $qstn_rep3;
	var $qstn_ansr4;
	var $qstn_val4;
	var $qstn_rep4;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_test_question';
		$this->TableName = 'app_test_question';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`app_test_question`";
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

		// qstn_id
		$this->qstn_id = new cField('app_test_question', 'app_test_question', 'x_qstn_id', 'qstn_id', '`qstn_id`', '`qstn_id`', 3, -1, FALSE, '`qstn_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->qstn_id->Sortable = FALSE; // Allow sort
		$this->qstn_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['qstn_id'] = &$this->qstn_id;

		// test_id
		$this->test_id = new cField('app_test_question', 'app_test_question', 'x_test_id', 'test_id', '`test_id`', '`test_id`', 3, -1, FALSE, '`test_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->test_id->Sortable = TRUE; // Allow sort
		$this->test_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->test_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->test_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['test_id'] = &$this->test_id;

		// lang_id
		$this->lang_id = new cField('app_test_question', 'app_test_question', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->lang_id->Sortable = TRUE; // Allow sort
		$this->lang_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->lang_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// gend_id
		$this->gend_id = new cField('app_test_question', 'app_test_question', 'x_gend_id', 'gend_id', '`gend_id`', '`gend_id`', 16, -1, FALSE, '`gend_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->gend_id->Sortable = TRUE; // Allow sort
		$this->gend_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->gend_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->gend_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['gend_id'] = &$this->gend_id;

		// qstn_num
		$this->qstn_num = new cField('app_test_question', 'app_test_question', 'x_qstn_num', 'qstn_num', '`qstn_num`', '`qstn_num`', 16, -1, FALSE, '`qstn_num`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_num->Sortable = TRUE; // Allow sort
		$this->qstn_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['qstn_num'] = &$this->qstn_num;

		// qstn_text
		$this->qstn_text = new cField('app_test_question', 'app_test_question', 'x_qstn_text', 'qstn_text', '`qstn_text`', '`qstn_text`', 201, -1, FALSE, '`qstn_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_text->Sortable = TRUE; // Allow sort
		$this->fields['qstn_text'] = &$this->qstn_text;

		// qstn_ansr1
		$this->qstn_ansr1 = new cField('app_test_question', 'app_test_question', 'x_qstn_ansr1', 'qstn_ansr1', '`qstn_ansr1`', '`qstn_ansr1`', 201, -1, FALSE, '`qstn_ansr1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr1->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr1'] = &$this->qstn_ansr1;

		// qstn_val1
		$this->qstn_val1 = new cField('app_test_question', 'app_test_question', 'x_qstn_val1', 'qstn_val1', '`qstn_val1`', '`qstn_val1`', 131, -1, FALSE, '`qstn_val1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val1->Sortable = TRUE; // Allow sort
		$this->qstn_val1->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val1'] = &$this->qstn_val1;

		// qstn_rep1
		$this->qstn_rep1 = new cField('app_test_question', 'app_test_question', 'x_qstn_rep1', 'qstn_rep1', '`qstn_rep1`', '`qstn_rep1`', 201, -1, FALSE, '`qstn_rep1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep1->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep1'] = &$this->qstn_rep1;

		// qstn_ansr2
		$this->qstn_ansr2 = new cField('app_test_question', 'app_test_question', 'x_qstn_ansr2', 'qstn_ansr2', '`qstn_ansr2`', '`qstn_ansr2`', 201, -1, FALSE, '`qstn_ansr2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr2->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr2'] = &$this->qstn_ansr2;

		// qstn_val2
		$this->qstn_val2 = new cField('app_test_question', 'app_test_question', 'x_qstn_val2', 'qstn_val2', '`qstn_val2`', '`qstn_val2`', 131, -1, FALSE, '`qstn_val2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val2->Sortable = TRUE; // Allow sort
		$this->qstn_val2->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val2'] = &$this->qstn_val2;

		// qstn_rep2
		$this->qstn_rep2 = new cField('app_test_question', 'app_test_question', 'x_qstn_rep2', 'qstn_rep2', '`qstn_rep2`', '`qstn_rep2`', 201, -1, FALSE, '`qstn_rep2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep2->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep2'] = &$this->qstn_rep2;

		// qstn_ansr3
		$this->qstn_ansr3 = new cField('app_test_question', 'app_test_question', 'x_qstn_ansr3', 'qstn_ansr3', '`qstn_ansr3`', '`qstn_ansr3`', 201, -1, FALSE, '`qstn_ansr3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr3->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr3'] = &$this->qstn_ansr3;

		// qstn_val3
		$this->qstn_val3 = new cField('app_test_question', 'app_test_question', 'x_qstn_val3', 'qstn_val3', '`qstn_val3`', '`qstn_val3`', 131, -1, FALSE, '`qstn_val3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val3->Sortable = TRUE; // Allow sort
		$this->qstn_val3->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val3'] = &$this->qstn_val3;

		// qstn_rep3
		$this->qstn_rep3 = new cField('app_test_question', 'app_test_question', 'x_qstn_rep3', 'qstn_rep3', '`qstn_rep3`', '`qstn_rep3`', 201, -1, FALSE, '`qstn_rep3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep3->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep3'] = &$this->qstn_rep3;

		// qstn_ansr4
		$this->qstn_ansr4 = new cField('app_test_question', 'app_test_question', 'x_qstn_ansr4', 'qstn_ansr4', '`qstn_ansr4`', '`qstn_ansr4`', 201, -1, FALSE, '`qstn_ansr4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr4->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr4'] = &$this->qstn_ansr4;

		// qstn_val4
		$this->qstn_val4 = new cField('app_test_question', 'app_test_question', 'x_qstn_val4', 'qstn_val4', '`qstn_val4`', '`qstn_val4`', 131, -1, FALSE, '`qstn_val4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val4->Sortable = TRUE; // Allow sort
		$this->qstn_val4->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val4'] = &$this->qstn_val4;

		// qstn_rep4
		$this->qstn_rep4 = new cField('app_test_question', 'app_test_question', 'x_qstn_rep4', 'qstn_rep4', '`qstn_rep4`', '`qstn_rep4`', 201, -1, FALSE, '`qstn_rep4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep4->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep4'] = &$this->qstn_rep4;
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
		if ($this->getCurrentMasterTable() == "app_test") {
			if ($this->test_id->getSessionValue() <> "")
				$sMasterFilter .= "`test_id`=" . ew_QuotedValue($this->test_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "app_test") {
			if ($this->test_id->getSessionValue() <> "")
				$sDetailFilter .= "`test_id`=" . ew_QuotedValue($this->test_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_app_test() {
		return "`test_id`=@test_id@";
	}

	// Detail filter
	function SqlDetailFilter_app_test() {
		return "`test_id`=@test_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_test_question`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
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
			$this->qstn_id->setDbValue($conn->Insert_ID());
			$rs['qstn_id'] = $this->qstn_id->DbValue;
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
			if (array_key_exists('qstn_id', $rs))
				ew_AddFilter($where, ew_QuotedName('qstn_id', $this->DBID) . '=' . ew_QuotedValue($rs['qstn_id'], $this->qstn_id->FldDataType, $this->DBID));
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
		return "`qstn_id` = @qstn_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->qstn_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->qstn_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@qstn_id@", ew_AdjustSql($this->qstn_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_test_questionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_test_questionview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_test_questionedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_test_questionadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_test_questionlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_test_questionview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_test_questionview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_test_questionadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_test_questionadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("app_test_questionedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("app_test_questionadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_test_questiondelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "app_test" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_test_id=" . urlencode($this->test_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "qstn_id:" . ew_VarToJson($this->qstn_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->qstn_id->CurrentValue)) {
			$sUrl .= "qstn_id=" . urlencode($this->qstn_id->CurrentValue);
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
			if ($isPost && isset($_POST["qstn_id"]))
				$arKeys[] = $_POST["qstn_id"];
			elseif (isset($_GET["qstn_id"]))
				$arKeys[] = $_GET["qstn_id"];
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
			$this->qstn_id->CurrentValue = $key;
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
		$this->qstn_id->setDbValue($rs->fields('qstn_id'));
		$this->test_id->setDbValue($rs->fields('test_id'));
		$this->lang_id->setDbValue($rs->fields('lang_id'));
		$this->gend_id->setDbValue($rs->fields('gend_id'));
		$this->qstn_num->setDbValue($rs->fields('qstn_num'));
		$this->qstn_text->setDbValue($rs->fields('qstn_text'));
		$this->qstn_ansr1->setDbValue($rs->fields('qstn_ansr1'));
		$this->qstn_val1->setDbValue($rs->fields('qstn_val1'));
		$this->qstn_rep1->setDbValue($rs->fields('qstn_rep1'));
		$this->qstn_ansr2->setDbValue($rs->fields('qstn_ansr2'));
		$this->qstn_val2->setDbValue($rs->fields('qstn_val2'));
		$this->qstn_rep2->setDbValue($rs->fields('qstn_rep2'));
		$this->qstn_ansr3->setDbValue($rs->fields('qstn_ansr3'));
		$this->qstn_val3->setDbValue($rs->fields('qstn_val3'));
		$this->qstn_rep3->setDbValue($rs->fields('qstn_rep3'));
		$this->qstn_ansr4->setDbValue($rs->fields('qstn_ansr4'));
		$this->qstn_val4->setDbValue($rs->fields('qstn_val4'));
		$this->qstn_rep4->setDbValue($rs->fields('qstn_rep4'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// qstn_id

		$this->qstn_id->CellCssStyle = "white-space: nowrap;";

		// test_id
		// lang_id
		// gend_id
		// qstn_num
		// qstn_text
		// qstn_ansr1
		// qstn_val1
		// qstn_rep1
		// qstn_ansr2
		// qstn_val2
		// qstn_rep2
		// qstn_ansr3
		// qstn_val3
		// qstn_rep3
		// qstn_ansr4
		// qstn_val4
		// qstn_rep4
		// qstn_id

		$this->qstn_id->ViewValue = $this->qstn_id->CurrentValue;
		$this->qstn_id->ViewCustomAttributes = "";

		// test_id
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `test_num`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->test_id->ViewValue = $this->test_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->test_id->ViewValue = $this->test_id->CurrentValue;
			}
		} else {
			$this->test_id->ViewValue = NULL;
		}
		$this->test_id->ViewCustomAttributes = "";

		// lang_id
		if (strval($this->lang_id->CurrentValue) <> "") {
			$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `lang_id`, `lang_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
		$sWhereWrk = "";
		$this->lang_id->LookupFilters = array();
		$lookuptblfilter = "`status_id`=1";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->lang_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `lang_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->lang_id->ViewValue = $this->lang_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->lang_id->ViewValue = $this->lang_id->CurrentValue;
			}
		} else {
			$this->lang_id->ViewValue = NULL;
		}
		$this->lang_id->ViewCustomAttributes = "";

		// gend_id
		if (strval($this->gend_id->CurrentValue) <> "") {
			$sFilterWrk = "`gend_id`" . ew_SearchString("=", $this->gend_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `gend_id`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_gender`";
		$sWhereWrk = "";
		$this->gend_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `gend_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->gend_id->ViewValue = $this->gend_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->gend_id->ViewValue = $this->gend_id->CurrentValue;
			}
		} else {
			$this->gend_id->ViewValue = NULL;
		}
		$this->gend_id->ViewCustomAttributes = "";

		// qstn_num
		$this->qstn_num->ViewValue = $this->qstn_num->CurrentValue;
		$this->qstn_num->ViewCustomAttributes = "";

		// qstn_text
		$this->qstn_text->ViewValue = $this->qstn_text->CurrentValue;
		$this->qstn_text->ViewCustomAttributes = "";

		// qstn_ansr1
		$this->qstn_ansr1->ViewValue = $this->qstn_ansr1->CurrentValue;
		$this->qstn_ansr1->ViewCustomAttributes = "";

		// qstn_val1
		$this->qstn_val1->ViewValue = $this->qstn_val1->CurrentValue;
		$this->qstn_val1->ViewCustomAttributes = "";

		// qstn_rep1
		$this->qstn_rep1->ViewValue = $this->qstn_rep1->CurrentValue;
		$this->qstn_rep1->ViewCustomAttributes = "";

		// qstn_ansr2
		$this->qstn_ansr2->ViewValue = $this->qstn_ansr2->CurrentValue;
		$this->qstn_ansr2->ViewCustomAttributes = "";

		// qstn_val2
		$this->qstn_val2->ViewValue = $this->qstn_val2->CurrentValue;
		$this->qstn_val2->ViewCustomAttributes = "";

		// qstn_rep2
		$this->qstn_rep2->ViewValue = $this->qstn_rep2->CurrentValue;
		$this->qstn_rep2->ViewCustomAttributes = "";

		// qstn_ansr3
		$this->qstn_ansr3->ViewValue = $this->qstn_ansr3->CurrentValue;
		$this->qstn_ansr3->ViewCustomAttributes = "";

		// qstn_val3
		$this->qstn_val3->ViewValue = $this->qstn_val3->CurrentValue;
		$this->qstn_val3->ViewCustomAttributes = "";

		// qstn_rep3
		$this->qstn_rep3->ViewValue = $this->qstn_rep3->CurrentValue;
		$this->qstn_rep3->ViewCustomAttributes = "";

		// qstn_ansr4
		$this->qstn_ansr4->ViewValue = $this->qstn_ansr4->CurrentValue;
		$this->qstn_ansr4->ViewCustomAttributes = "";

		// qstn_val4
		$this->qstn_val4->ViewValue = $this->qstn_val4->CurrentValue;
		$this->qstn_val4->ViewValue = ew_FormatNumber($this->qstn_val4->ViewValue, 2, -2, -2, -2);
		$this->qstn_val4->ViewCustomAttributes = "";

		// qstn_rep4
		$this->qstn_rep4->ViewValue = $this->qstn_rep4->CurrentValue;
		$this->qstn_rep4->ViewCustomAttributes = "";

		// qstn_id
		$this->qstn_id->LinkCustomAttributes = "";
		$this->qstn_id->HrefValue = "";
		$this->qstn_id->TooltipValue = "";

		// test_id
		$this->test_id->LinkCustomAttributes = "";
		$this->test_id->HrefValue = "";
		$this->test_id->TooltipValue = "";

		// lang_id
		$this->lang_id->LinkCustomAttributes = "";
		$this->lang_id->HrefValue = "";
		$this->lang_id->TooltipValue = "";

		// gend_id
		$this->gend_id->LinkCustomAttributes = "";
		$this->gend_id->HrefValue = "";
		$this->gend_id->TooltipValue = "";

		// qstn_num
		$this->qstn_num->LinkCustomAttributes = "";
		$this->qstn_num->HrefValue = "";
		$this->qstn_num->TooltipValue = "";

		// qstn_text
		$this->qstn_text->LinkCustomAttributes = "";
		$this->qstn_text->HrefValue = "";
		$this->qstn_text->TooltipValue = "";

		// qstn_ansr1
		$this->qstn_ansr1->LinkCustomAttributes = "";
		$this->qstn_ansr1->HrefValue = "";
		$this->qstn_ansr1->TooltipValue = "";

		// qstn_val1
		$this->qstn_val1->LinkCustomAttributes = "";
		$this->qstn_val1->HrefValue = "";
		$this->qstn_val1->TooltipValue = "";

		// qstn_rep1
		$this->qstn_rep1->LinkCustomAttributes = "";
		$this->qstn_rep1->HrefValue = "";
		$this->qstn_rep1->TooltipValue = "";

		// qstn_ansr2
		$this->qstn_ansr2->LinkCustomAttributes = "";
		$this->qstn_ansr2->HrefValue = "";
		$this->qstn_ansr2->TooltipValue = "";

		// qstn_val2
		$this->qstn_val2->LinkCustomAttributes = "";
		$this->qstn_val2->HrefValue = "";
		$this->qstn_val2->TooltipValue = "";

		// qstn_rep2
		$this->qstn_rep2->LinkCustomAttributes = "";
		$this->qstn_rep2->HrefValue = "";
		$this->qstn_rep2->TooltipValue = "";

		// qstn_ansr3
		$this->qstn_ansr3->LinkCustomAttributes = "";
		$this->qstn_ansr3->HrefValue = "";
		$this->qstn_ansr3->TooltipValue = "";

		// qstn_val3
		$this->qstn_val3->LinkCustomAttributes = "";
		$this->qstn_val3->HrefValue = "";
		$this->qstn_val3->TooltipValue = "";

		// qstn_rep3
		$this->qstn_rep3->LinkCustomAttributes = "";
		$this->qstn_rep3->HrefValue = "";
		$this->qstn_rep3->TooltipValue = "";

		// qstn_ansr4
		$this->qstn_ansr4->LinkCustomAttributes = "";
		$this->qstn_ansr4->HrefValue = "";
		$this->qstn_ansr4->TooltipValue = "";

		// qstn_val4
		$this->qstn_val4->LinkCustomAttributes = "";
		$this->qstn_val4->HrefValue = "";
		$this->qstn_val4->TooltipValue = "";

		// qstn_rep4
		$this->qstn_rep4->LinkCustomAttributes = "";
		$this->qstn_rep4->HrefValue = "";
		$this->qstn_rep4->TooltipValue = "";

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

		// qstn_id
		$this->qstn_id->EditAttrs["class"] = "form-control";
		$this->qstn_id->EditCustomAttributes = "";
		$this->qstn_id->EditValue = $this->qstn_id->CurrentValue;
		$this->qstn_id->ViewCustomAttributes = "";

		// test_id
		$this->test_id->EditAttrs["class"] = "form-control";
		$this->test_id->EditCustomAttributes = "";
		if ($this->test_id->getSessionValue() <> "") {
			$this->test_id->CurrentValue = $this->test_id->getSessionValue();
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `test_num`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->test_id->ViewValue = $this->test_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->test_id->ViewValue = $this->test_id->CurrentValue;
			}
		} else {
			$this->test_id->ViewValue = NULL;
		}
		$this->test_id->ViewCustomAttributes = "";
		} else {
		}

		// lang_id
		$this->lang_id->EditAttrs["class"] = "form-control";
		$this->lang_id->EditCustomAttributes = "";

		// gend_id
		$this->gend_id->EditAttrs["class"] = "form-control";
		$this->gend_id->EditCustomAttributes = "";

		// qstn_num
		$this->qstn_num->EditAttrs["class"] = "form-control";
		$this->qstn_num->EditCustomAttributes = "";
		$this->qstn_num->EditValue = $this->qstn_num->CurrentValue;
		$this->qstn_num->PlaceHolder = ew_RemoveHtml($this->qstn_num->FldCaption());

		// qstn_text
		$this->qstn_text->EditAttrs["class"] = "form-control";
		$this->qstn_text->EditCustomAttributes = "";
		$this->qstn_text->EditValue = $this->qstn_text->CurrentValue;
		$this->qstn_text->PlaceHolder = ew_RemoveHtml($this->qstn_text->FldCaption());

		// qstn_ansr1
		$this->qstn_ansr1->EditAttrs["class"] = "form-control";
		$this->qstn_ansr1->EditCustomAttributes = "";
		$this->qstn_ansr1->EditValue = $this->qstn_ansr1->CurrentValue;
		$this->qstn_ansr1->PlaceHolder = ew_RemoveHtml($this->qstn_ansr1->FldCaption());

		// qstn_val1
		$this->qstn_val1->EditAttrs["class"] = "form-control";
		$this->qstn_val1->EditCustomAttributes = "";
		$this->qstn_val1->EditValue = $this->qstn_val1->CurrentValue;
		$this->qstn_val1->PlaceHolder = ew_RemoveHtml($this->qstn_val1->FldCaption());
		if (strval($this->qstn_val1->EditValue) <> "" && is_numeric($this->qstn_val1->EditValue)) $this->qstn_val1->EditValue = ew_FormatNumber($this->qstn_val1->EditValue, -2, -1, -2, 0);

		// qstn_rep1
		$this->qstn_rep1->EditAttrs["class"] = "form-control";
		$this->qstn_rep1->EditCustomAttributes = "";
		$this->qstn_rep1->EditValue = $this->qstn_rep1->CurrentValue;
		$this->qstn_rep1->PlaceHolder = ew_RemoveHtml($this->qstn_rep1->FldCaption());

		// qstn_ansr2
		$this->qstn_ansr2->EditAttrs["class"] = "form-control";
		$this->qstn_ansr2->EditCustomAttributes = "";
		$this->qstn_ansr2->EditValue = $this->qstn_ansr2->CurrentValue;
		$this->qstn_ansr2->PlaceHolder = ew_RemoveHtml($this->qstn_ansr2->FldCaption());

		// qstn_val2
		$this->qstn_val2->EditAttrs["class"] = "form-control";
		$this->qstn_val2->EditCustomAttributes = "";
		$this->qstn_val2->EditValue = $this->qstn_val2->CurrentValue;
		$this->qstn_val2->PlaceHolder = ew_RemoveHtml($this->qstn_val2->FldCaption());
		if (strval($this->qstn_val2->EditValue) <> "" && is_numeric($this->qstn_val2->EditValue)) $this->qstn_val2->EditValue = ew_FormatNumber($this->qstn_val2->EditValue, -2, -1, -2, 0);

		// qstn_rep2
		$this->qstn_rep2->EditAttrs["class"] = "form-control";
		$this->qstn_rep2->EditCustomAttributes = "";
		$this->qstn_rep2->EditValue = $this->qstn_rep2->CurrentValue;
		$this->qstn_rep2->PlaceHolder = ew_RemoveHtml($this->qstn_rep2->FldCaption());

		// qstn_ansr3
		$this->qstn_ansr3->EditAttrs["class"] = "form-control";
		$this->qstn_ansr3->EditCustomAttributes = "";
		$this->qstn_ansr3->EditValue = $this->qstn_ansr3->CurrentValue;
		$this->qstn_ansr3->PlaceHolder = ew_RemoveHtml($this->qstn_ansr3->FldCaption());

		// qstn_val3
		$this->qstn_val3->EditAttrs["class"] = "form-control";
		$this->qstn_val3->EditCustomAttributes = "";
		$this->qstn_val3->EditValue = $this->qstn_val3->CurrentValue;
		$this->qstn_val3->PlaceHolder = ew_RemoveHtml($this->qstn_val3->FldCaption());
		if (strval($this->qstn_val3->EditValue) <> "" && is_numeric($this->qstn_val3->EditValue)) $this->qstn_val3->EditValue = ew_FormatNumber($this->qstn_val3->EditValue, -2, -1, -2, 0);

		// qstn_rep3
		$this->qstn_rep3->EditAttrs["class"] = "form-control";
		$this->qstn_rep3->EditCustomAttributes = "";
		$this->qstn_rep3->EditValue = $this->qstn_rep3->CurrentValue;
		$this->qstn_rep3->PlaceHolder = ew_RemoveHtml($this->qstn_rep3->FldCaption());

		// qstn_ansr4
		$this->qstn_ansr4->EditAttrs["class"] = "form-control";
		$this->qstn_ansr4->EditCustomAttributes = "";
		$this->qstn_ansr4->EditValue = $this->qstn_ansr4->CurrentValue;
		$this->qstn_ansr4->PlaceHolder = ew_RemoveHtml($this->qstn_ansr4->FldCaption());

		// qstn_val4
		$this->qstn_val4->EditAttrs["class"] = "form-control";
		$this->qstn_val4->EditCustomAttributes = "";
		$this->qstn_val4->EditValue = $this->qstn_val4->CurrentValue;
		$this->qstn_val4->PlaceHolder = ew_RemoveHtml($this->qstn_val4->FldCaption());
		if (strval($this->qstn_val4->EditValue) <> "" && is_numeric($this->qstn_val4->EditValue)) $this->qstn_val4->EditValue = ew_FormatNumber($this->qstn_val4->EditValue, -2, -2, -2, -2);

		// qstn_rep4
		$this->qstn_rep4->EditAttrs["class"] = "form-control";
		$this->qstn_rep4->EditCustomAttributes = "";
		$this->qstn_rep4->EditValue = $this->qstn_rep4->CurrentValue;
		$this->qstn_rep4->PlaceHolder = ew_RemoveHtml($this->qstn_rep4->FldCaption());

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
					if ($this->test_id->Exportable) $Doc->ExportCaption($this->test_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->gend_id->Exportable) $Doc->ExportCaption($this->gend_id);
					if ($this->qstn_num->Exportable) $Doc->ExportCaption($this->qstn_num);
					if ($this->qstn_text->Exportable) $Doc->ExportCaption($this->qstn_text);
					if ($this->qstn_ansr1->Exportable) $Doc->ExportCaption($this->qstn_ansr1);
					if ($this->qstn_val1->Exportable) $Doc->ExportCaption($this->qstn_val1);
					if ($this->qstn_rep1->Exportable) $Doc->ExportCaption($this->qstn_rep1);
					if ($this->qstn_ansr2->Exportable) $Doc->ExportCaption($this->qstn_ansr2);
					if ($this->qstn_val2->Exportable) $Doc->ExportCaption($this->qstn_val2);
					if ($this->qstn_rep2->Exportable) $Doc->ExportCaption($this->qstn_rep2);
					if ($this->qstn_ansr3->Exportable) $Doc->ExportCaption($this->qstn_ansr3);
					if ($this->qstn_val3->Exportable) $Doc->ExportCaption($this->qstn_val3);
					if ($this->qstn_rep3->Exportable) $Doc->ExportCaption($this->qstn_rep3);
					if ($this->qstn_ansr4->Exportable) $Doc->ExportCaption($this->qstn_ansr4);
					if ($this->qstn_val4->Exportable) $Doc->ExportCaption($this->qstn_val4);
					if ($this->qstn_rep4->Exportable) $Doc->ExportCaption($this->qstn_rep4);
				} else {
					if ($this->test_id->Exportable) $Doc->ExportCaption($this->test_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->gend_id->Exportable) $Doc->ExportCaption($this->gend_id);
					if ($this->qstn_num->Exportable) $Doc->ExportCaption($this->qstn_num);
					if ($this->qstn_text->Exportable) $Doc->ExportCaption($this->qstn_text);
					if ($this->qstn_ansr1->Exportable) $Doc->ExportCaption($this->qstn_ansr1);
					if ($this->qstn_val1->Exportable) $Doc->ExportCaption($this->qstn_val1);
					if ($this->qstn_rep1->Exportable) $Doc->ExportCaption($this->qstn_rep1);
					if ($this->qstn_ansr2->Exportable) $Doc->ExportCaption($this->qstn_ansr2);
					if ($this->qstn_val2->Exportable) $Doc->ExportCaption($this->qstn_val2);
					if ($this->qstn_rep2->Exportable) $Doc->ExportCaption($this->qstn_rep2);
					if ($this->qstn_ansr3->Exportable) $Doc->ExportCaption($this->qstn_ansr3);
					if ($this->qstn_val3->Exportable) $Doc->ExportCaption($this->qstn_val3);
					if ($this->qstn_rep3->Exportable) $Doc->ExportCaption($this->qstn_rep3);
					if ($this->qstn_ansr4->Exportable) $Doc->ExportCaption($this->qstn_ansr4);
					if ($this->qstn_val4->Exportable) $Doc->ExportCaption($this->qstn_val4);
					if ($this->qstn_rep4->Exportable) $Doc->ExportCaption($this->qstn_rep4);
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
						if ($this->test_id->Exportable) $Doc->ExportField($this->test_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->gend_id->Exportable) $Doc->ExportField($this->gend_id);
						if ($this->qstn_num->Exportable) $Doc->ExportField($this->qstn_num);
						if ($this->qstn_text->Exportable) $Doc->ExportField($this->qstn_text);
						if ($this->qstn_ansr1->Exportable) $Doc->ExportField($this->qstn_ansr1);
						if ($this->qstn_val1->Exportable) $Doc->ExportField($this->qstn_val1);
						if ($this->qstn_rep1->Exportable) $Doc->ExportField($this->qstn_rep1);
						if ($this->qstn_ansr2->Exportable) $Doc->ExportField($this->qstn_ansr2);
						if ($this->qstn_val2->Exportable) $Doc->ExportField($this->qstn_val2);
						if ($this->qstn_rep2->Exportable) $Doc->ExportField($this->qstn_rep2);
						if ($this->qstn_ansr3->Exportable) $Doc->ExportField($this->qstn_ansr3);
						if ($this->qstn_val3->Exportable) $Doc->ExportField($this->qstn_val3);
						if ($this->qstn_rep3->Exportable) $Doc->ExportField($this->qstn_rep3);
						if ($this->qstn_ansr4->Exportable) $Doc->ExportField($this->qstn_ansr4);
						if ($this->qstn_val4->Exportable) $Doc->ExportField($this->qstn_val4);
						if ($this->qstn_rep4->Exportable) $Doc->ExportField($this->qstn_rep4);
					} else {
						if ($this->test_id->Exportable) $Doc->ExportField($this->test_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->gend_id->Exportable) $Doc->ExportField($this->gend_id);
						if ($this->qstn_num->Exportable) $Doc->ExportField($this->qstn_num);
						if ($this->qstn_text->Exportable) $Doc->ExportField($this->qstn_text);
						if ($this->qstn_ansr1->Exportable) $Doc->ExportField($this->qstn_ansr1);
						if ($this->qstn_val1->Exportable) $Doc->ExportField($this->qstn_val1);
						if ($this->qstn_rep1->Exportable) $Doc->ExportField($this->qstn_rep1);
						if ($this->qstn_ansr2->Exportable) $Doc->ExportField($this->qstn_ansr2);
						if ($this->qstn_val2->Exportable) $Doc->ExportField($this->qstn_val2);
						if ($this->qstn_rep2->Exportable) $Doc->ExportField($this->qstn_rep2);
						if ($this->qstn_ansr3->Exportable) $Doc->ExportField($this->qstn_ansr3);
						if ($this->qstn_val3->Exportable) $Doc->ExportField($this->qstn_val3);
						if ($this->qstn_rep3->Exportable) $Doc->ExportField($this->qstn_rep3);
						if ($this->qstn_ansr4->Exportable) $Doc->ExportField($this->qstn_ansr4);
						if ($this->qstn_val4->Exportable) $Doc->ExportField($this->qstn_val4);
						if ($this->qstn_rep4->Exportable) $Doc->ExportField($this->qstn_rep4);
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
