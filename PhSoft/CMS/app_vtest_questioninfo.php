<?php

// Global variable for table object
$app_vtest_question = NULL;

//
// Table class for app_vtest_question
//
class capp_vtest_question extends cTable {
	var $test_id;
	var $test_num;
	var $test_iname;
	var $status_id;
	var $test_price;
	var $test_image;
	var $ntest_id;
	var $lang_id;
	var $test_name;
	var $test_desc;
	var $qstn_id;
	var $gend_id;
	var $qstn_num;
	var $qstn_text;
	var $qstn_ansr1;
	var $qstn_ansr2;
	var $qstn_ansr3;
	var $qstn_ansr4;
	var $qstn_rep1;
	var $qstn_rep2;
	var $qstn_rep3;
	var $qstn_rep4;
	var $qstn_val1;
	var $qstn_val2;
	var $qstn_val3;
	var $qstn_val4;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_vtest_question';
		$this->TableName = 'app_vtest_question';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`app_vtest_question`";
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

		// test_id
		$this->test_id = new cField('app_vtest_question', 'app_vtest_question', 'x_test_id', 'test_id', '`test_id`', '`test_id`', 3, -1, FALSE, '`test_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->test_id->Sortable = TRUE; // Allow sort
		$this->test_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['test_id'] = &$this->test_id;

		// test_num
		$this->test_num = new cField('app_vtest_question', 'app_vtest_question', 'x_test_num', 'test_num', '`test_num`', '`test_num`', 16, -1, FALSE, '`test_num`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_num->Sortable = TRUE; // Allow sort
		$this->test_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['test_num'] = &$this->test_num;

		// test_iname
		$this->test_iname = new cField('app_vtest_question', 'app_vtest_question', 'x_test_iname', 'test_iname', '`test_iname`', '`test_iname`', 200, -1, FALSE, '`test_iname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_iname->Sortable = TRUE; // Allow sort
		$this->fields['test_iname'] = &$this->test_iname;

		// status_id
		$this->status_id = new cField('app_vtest_question', 'app_vtest_question', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// test_price
		$this->test_price = new cField('app_vtest_question', 'app_vtest_question', 'x_test_price', 'test_price', '`test_price`', '`test_price`', 131, -1, FALSE, '`test_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_price->Sortable = TRUE; // Allow sort
		$this->test_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['test_price'] = &$this->test_price;

		// test_image
		$this->test_image = new cField('app_vtest_question', 'app_vtest_question', 'x_test_image', 'test_image', '`test_image`', '`test_image`', 200, -1, FALSE, '`test_image`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_image->Sortable = TRUE; // Allow sort
		$this->fields['test_image'] = &$this->test_image;

		// ntest_id
		$this->ntest_id = new cField('app_vtest_question', 'app_vtest_question', 'x_ntest_id', 'ntest_id', '`ntest_id`', '`ntest_id`', 3, -1, FALSE, '`ntest_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ntest_id->Sortable = TRUE; // Allow sort
		$this->ntest_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ntest_id'] = &$this->ntest_id;

		// lang_id
		$this->lang_id = new cField('app_vtest_question', 'app_vtest_question', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_id->Sortable = TRUE; // Allow sort
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// test_name
		$this->test_name = new cField('app_vtest_question', 'app_vtest_question', 'x_test_name', 'test_name', '`test_name`', '`test_name`', 200, -1, FALSE, '`test_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_name->Sortable = TRUE; // Allow sort
		$this->fields['test_name'] = &$this->test_name;

		// test_desc
		$this->test_desc = new cField('app_vtest_question', 'app_vtest_question', 'x_test_desc', 'test_desc', '`test_desc`', '`test_desc`', 201, -1, FALSE, '`test_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->test_desc->Sortable = TRUE; // Allow sort
		$this->fields['test_desc'] = &$this->test_desc;

		// qstn_id
		$this->qstn_id = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_id', 'qstn_id', '`qstn_id`', '`qstn_id`', 3, -1, FALSE, '`qstn_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->qstn_id->Sortable = TRUE; // Allow sort
		$this->qstn_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['qstn_id'] = &$this->qstn_id;

		// gend_id
		$this->gend_id = new cField('app_vtest_question', 'app_vtest_question', 'x_gend_id', 'gend_id', '`gend_id`', '`gend_id`', 16, -1, FALSE, '`gend_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gend_id->Sortable = TRUE; // Allow sort
		$this->gend_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['gend_id'] = &$this->gend_id;

		// qstn_num
		$this->qstn_num = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_num', 'qstn_num', '`qstn_num`', '`qstn_num`', 16, -1, FALSE, '`qstn_num`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_num->Sortable = TRUE; // Allow sort
		$this->qstn_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['qstn_num'] = &$this->qstn_num;

		// qstn_text
		$this->qstn_text = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_text', 'qstn_text', '`qstn_text`', '`qstn_text`', 201, -1, FALSE, '`qstn_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_text->Sortable = TRUE; // Allow sort
		$this->fields['qstn_text'] = &$this->qstn_text;

		// qstn_ansr1
		$this->qstn_ansr1 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_ansr1', 'qstn_ansr1', '`qstn_ansr1`', '`qstn_ansr1`', 201, -1, FALSE, '`qstn_ansr1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr1->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr1'] = &$this->qstn_ansr1;

		// qstn_ansr2
		$this->qstn_ansr2 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_ansr2', 'qstn_ansr2', '`qstn_ansr2`', '`qstn_ansr2`', 201, -1, FALSE, '`qstn_ansr2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr2->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr2'] = &$this->qstn_ansr2;

		// qstn_ansr3
		$this->qstn_ansr3 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_ansr3', 'qstn_ansr3', '`qstn_ansr3`', '`qstn_ansr3`', 201, -1, FALSE, '`qstn_ansr3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr3->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr3'] = &$this->qstn_ansr3;

		// qstn_ansr4
		$this->qstn_ansr4 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_ansr4', 'qstn_ansr4', '`qstn_ansr4`', '`qstn_ansr4`', 201, -1, FALSE, '`qstn_ansr4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_ansr4->Sortable = TRUE; // Allow sort
		$this->fields['qstn_ansr4'] = &$this->qstn_ansr4;

		// qstn_rep1
		$this->qstn_rep1 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_rep1', 'qstn_rep1', '`qstn_rep1`', '`qstn_rep1`', 201, -1, FALSE, '`qstn_rep1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep1->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep1'] = &$this->qstn_rep1;

		// qstn_rep2
		$this->qstn_rep2 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_rep2', 'qstn_rep2', '`qstn_rep2`', '`qstn_rep2`', 201, -1, FALSE, '`qstn_rep2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep2->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep2'] = &$this->qstn_rep2;

		// qstn_rep3
		$this->qstn_rep3 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_rep3', 'qstn_rep3', '`qstn_rep3`', '`qstn_rep3`', 201, -1, FALSE, '`qstn_rep3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep3->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep3'] = &$this->qstn_rep3;

		// qstn_rep4
		$this->qstn_rep4 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_rep4', 'qstn_rep4', '`qstn_rep4`', '`qstn_rep4`', 201, -1, FALSE, '`qstn_rep4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->qstn_rep4->Sortable = TRUE; // Allow sort
		$this->fields['qstn_rep4'] = &$this->qstn_rep4;

		// qstn_val1
		$this->qstn_val1 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_val1', 'qstn_val1', '`qstn_val1`', '`qstn_val1`', 131, -1, FALSE, '`qstn_val1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val1->Sortable = TRUE; // Allow sort
		$this->qstn_val1->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val1'] = &$this->qstn_val1;

		// qstn_val2
		$this->qstn_val2 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_val2', 'qstn_val2', '`qstn_val2`', '`qstn_val2`', 131, -1, FALSE, '`qstn_val2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val2->Sortable = TRUE; // Allow sort
		$this->qstn_val2->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val2'] = &$this->qstn_val2;

		// qstn_val3
		$this->qstn_val3 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_val3', 'qstn_val3', '`qstn_val3`', '`qstn_val3`', 131, -1, FALSE, '`qstn_val3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val3->Sortable = TRUE; // Allow sort
		$this->qstn_val3->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val3'] = &$this->qstn_val3;

		// qstn_val4
		$this->qstn_val4 = new cField('app_vtest_question', 'app_vtest_question', 'x_qstn_val4', 'qstn_val4', '`qstn_val4`', '`qstn_val4`', 131, -1, FALSE, '`qstn_val4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qstn_val4->Sortable = TRUE; // Allow sort
		$this->qstn_val4->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['qstn_val4'] = &$this->qstn_val4;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_vtest_question`";
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
			$this->test_id->setDbValue($conn->Insert_ID());
			$rs['test_id'] = $this->test_id->DbValue;

			// Get insert id if necessary
			$this->ntest_id->setDbValue($conn->Insert_ID());
			$rs['ntest_id'] = $this->ntest_id->DbValue;

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
			if (array_key_exists('test_id', $rs))
				ew_AddFilter($where, ew_QuotedName('test_id', $this->DBID) . '=' . ew_QuotedValue($rs['test_id'], $this->test_id->FldDataType, $this->DBID));
			if (array_key_exists('ntest_id', $rs))
				ew_AddFilter($where, ew_QuotedName('ntest_id', $this->DBID) . '=' . ew_QuotedValue($rs['ntest_id'], $this->ntest_id->FldDataType, $this->DBID));
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
		return "`test_id` = @test_id@ AND `ntest_id` = @ntest_id@ AND `qstn_id` = @qstn_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->test_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->test_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@test_id@", ew_AdjustSql($this->test_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->ntest_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->ntest_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@ntest_id@", ew_AdjustSql($this->ntest_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_vtest_questionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_vtest_questionview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_vtest_questionedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_vtest_questionadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_vtest_questionlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_vtest_questionview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_vtest_questionview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_vtest_questionadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_vtest_questionadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("app_vtest_questionedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("app_vtest_questionadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_vtest_questiondelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "test_id:" . ew_VarToJson($this->test_id->CurrentValue, "number", "'");
		$json .= ",ntest_id:" . ew_VarToJson($this->ntest_id->CurrentValue, "number", "'");
		$json .= ",qstn_id:" . ew_VarToJson($this->qstn_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->test_id->CurrentValue)) {
			$sUrl .= "test_id=" . urlencode($this->test_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->ntest_id->CurrentValue)) {
			$sUrl .= "&ntest_id=" . urlencode($this->ntest_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->qstn_id->CurrentValue)) {
			$sUrl .= "&qstn_id=" . urlencode($this->qstn_id->CurrentValue);
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
			if ($isPost && isset($_POST["test_id"]))
				$arKey[] = $_POST["test_id"];
			elseif (isset($_GET["test_id"]))
				$arKey[] = $_GET["test_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["ntest_id"]))
				$arKey[] = $_POST["ntest_id"];
			elseif (isset($_GET["ntest_id"]))
				$arKey[] = $_GET["ntest_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["qstn_id"]))
				$arKey[] = $_POST["qstn_id"];
			elseif (isset($_GET["qstn_id"]))
				$arKey[] = $_GET["qstn_id"];
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 3)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // test_id
					continue;
				if (!is_numeric($key[1])) // ntest_id
					continue;
				if (!is_numeric($key[2])) // qstn_id
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
			$this->test_id->CurrentValue = $key[0];
			$this->ntest_id->CurrentValue = $key[1];
			$this->qstn_id->CurrentValue = $key[2];
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
		$this->test_id->setDbValue($rs->fields('test_id'));
		$this->test_num->setDbValue($rs->fields('test_num'));
		$this->test_iname->setDbValue($rs->fields('test_iname'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->test_price->setDbValue($rs->fields('test_price'));
		$this->test_image->setDbValue($rs->fields('test_image'));
		$this->ntest_id->setDbValue($rs->fields('ntest_id'));
		$this->lang_id->setDbValue($rs->fields('lang_id'));
		$this->test_name->setDbValue($rs->fields('test_name'));
		$this->test_desc->setDbValue($rs->fields('test_desc'));
		$this->qstn_id->setDbValue($rs->fields('qstn_id'));
		$this->gend_id->setDbValue($rs->fields('gend_id'));
		$this->qstn_num->setDbValue($rs->fields('qstn_num'));
		$this->qstn_text->setDbValue($rs->fields('qstn_text'));
		$this->qstn_ansr1->setDbValue($rs->fields('qstn_ansr1'));
		$this->qstn_ansr2->setDbValue($rs->fields('qstn_ansr2'));
		$this->qstn_ansr3->setDbValue($rs->fields('qstn_ansr3'));
		$this->qstn_ansr4->setDbValue($rs->fields('qstn_ansr4'));
		$this->qstn_rep1->setDbValue($rs->fields('qstn_rep1'));
		$this->qstn_rep2->setDbValue($rs->fields('qstn_rep2'));
		$this->qstn_rep3->setDbValue($rs->fields('qstn_rep3'));
		$this->qstn_rep4->setDbValue($rs->fields('qstn_rep4'));
		$this->qstn_val1->setDbValue($rs->fields('qstn_val1'));
		$this->qstn_val2->setDbValue($rs->fields('qstn_val2'));
		$this->qstn_val3->setDbValue($rs->fields('qstn_val3'));
		$this->qstn_val4->setDbValue($rs->fields('qstn_val4'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// test_id
		// test_num
		// test_iname
		// status_id
		// test_price
		// test_image
		// ntest_id
		// lang_id
		// test_name
		// test_desc
		// qstn_id
		// gend_id
		// qstn_num
		// qstn_text
		// qstn_ansr1
		// qstn_ansr2
		// qstn_ansr3
		// qstn_ansr4
		// qstn_rep1
		// qstn_rep2
		// qstn_rep3
		// qstn_rep4
		// qstn_val1
		// qstn_val2
		// qstn_val3
		// qstn_val4
		// test_id

		$this->test_id->ViewValue = $this->test_id->CurrentValue;
		$this->test_id->ViewCustomAttributes = "";

		// test_num
		$this->test_num->ViewValue = $this->test_num->CurrentValue;
		$this->test_num->ViewCustomAttributes = "";

		// test_iname
		$this->test_iname->ViewValue = $this->test_iname->CurrentValue;
		$this->test_iname->ViewCustomAttributes = "";

		// status_id
		$this->status_id->ViewValue = $this->status_id->CurrentValue;
		$this->status_id->ViewCustomAttributes = "";

		// test_price
		$this->test_price->ViewValue = $this->test_price->CurrentValue;
		$this->test_price->ViewCustomAttributes = "";

		// test_image
		$this->test_image->ViewValue = $this->test_image->CurrentValue;
		$this->test_image->ViewCustomAttributes = "";

		// ntest_id
		$this->ntest_id->ViewValue = $this->ntest_id->CurrentValue;
		$this->ntest_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->ViewValue = $this->lang_id->CurrentValue;
		$this->lang_id->ViewCustomAttributes = "";

		// test_name
		$this->test_name->ViewValue = $this->test_name->CurrentValue;
		$this->test_name->ViewCustomAttributes = "";

		// test_desc
		$this->test_desc->ViewValue = $this->test_desc->CurrentValue;
		$this->test_desc->ViewCustomAttributes = "";

		// qstn_id
		$this->qstn_id->ViewValue = $this->qstn_id->CurrentValue;
		$this->qstn_id->ViewCustomAttributes = "";

		// gend_id
		$this->gend_id->ViewValue = $this->gend_id->CurrentValue;
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

		// qstn_ansr2
		$this->qstn_ansr2->ViewValue = $this->qstn_ansr2->CurrentValue;
		$this->qstn_ansr2->ViewCustomAttributes = "";

		// qstn_ansr3
		$this->qstn_ansr3->ViewValue = $this->qstn_ansr3->CurrentValue;
		$this->qstn_ansr3->ViewCustomAttributes = "";

		// qstn_ansr4
		$this->qstn_ansr4->ViewValue = $this->qstn_ansr4->CurrentValue;
		$this->qstn_ansr4->ViewCustomAttributes = "";

		// qstn_rep1
		$this->qstn_rep1->ViewValue = $this->qstn_rep1->CurrentValue;
		$this->qstn_rep1->ViewCustomAttributes = "";

		// qstn_rep2
		$this->qstn_rep2->ViewValue = $this->qstn_rep2->CurrentValue;
		$this->qstn_rep2->ViewCustomAttributes = "";

		// qstn_rep3
		$this->qstn_rep3->ViewValue = $this->qstn_rep3->CurrentValue;
		$this->qstn_rep3->ViewCustomAttributes = "";

		// qstn_rep4
		$this->qstn_rep4->ViewValue = $this->qstn_rep4->CurrentValue;
		$this->qstn_rep4->ViewCustomAttributes = "";

		// qstn_val1
		$this->qstn_val1->ViewValue = $this->qstn_val1->CurrentValue;
		$this->qstn_val1->ViewCustomAttributes = "";

		// qstn_val2
		$this->qstn_val2->ViewValue = $this->qstn_val2->CurrentValue;
		$this->qstn_val2->ViewCustomAttributes = "";

		// qstn_val3
		$this->qstn_val3->ViewValue = $this->qstn_val3->CurrentValue;
		$this->qstn_val3->ViewCustomAttributes = "";

		// qstn_val4
		$this->qstn_val4->ViewValue = $this->qstn_val4->CurrentValue;
		$this->qstn_val4->ViewCustomAttributes = "";

		// test_id
		$this->test_id->LinkCustomAttributes = "";
		$this->test_id->HrefValue = "";
		$this->test_id->TooltipValue = "";

		// test_num
		$this->test_num->LinkCustomAttributes = "";
		$this->test_num->HrefValue = "";
		$this->test_num->TooltipValue = "";

		// test_iname
		$this->test_iname->LinkCustomAttributes = "";
		$this->test_iname->HrefValue = "";
		$this->test_iname->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// test_price
		$this->test_price->LinkCustomAttributes = "";
		$this->test_price->HrefValue = "";
		$this->test_price->TooltipValue = "";

		// test_image
		$this->test_image->LinkCustomAttributes = "";
		$this->test_image->HrefValue = "";
		$this->test_image->TooltipValue = "";

		// ntest_id
		$this->ntest_id->LinkCustomAttributes = "";
		$this->ntest_id->HrefValue = "";
		$this->ntest_id->TooltipValue = "";

		// lang_id
		$this->lang_id->LinkCustomAttributes = "";
		$this->lang_id->HrefValue = "";
		$this->lang_id->TooltipValue = "";

		// test_name
		$this->test_name->LinkCustomAttributes = "";
		$this->test_name->HrefValue = "";
		$this->test_name->TooltipValue = "";

		// test_desc
		$this->test_desc->LinkCustomAttributes = "";
		$this->test_desc->HrefValue = "";
		$this->test_desc->TooltipValue = "";

		// qstn_id
		$this->qstn_id->LinkCustomAttributes = "";
		$this->qstn_id->HrefValue = "";
		$this->qstn_id->TooltipValue = "";

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

		// qstn_ansr2
		$this->qstn_ansr2->LinkCustomAttributes = "";
		$this->qstn_ansr2->HrefValue = "";
		$this->qstn_ansr2->TooltipValue = "";

		// qstn_ansr3
		$this->qstn_ansr3->LinkCustomAttributes = "";
		$this->qstn_ansr3->HrefValue = "";
		$this->qstn_ansr3->TooltipValue = "";

		// qstn_ansr4
		$this->qstn_ansr4->LinkCustomAttributes = "";
		$this->qstn_ansr4->HrefValue = "";
		$this->qstn_ansr4->TooltipValue = "";

		// qstn_rep1
		$this->qstn_rep1->LinkCustomAttributes = "";
		$this->qstn_rep1->HrefValue = "";
		$this->qstn_rep1->TooltipValue = "";

		// qstn_rep2
		$this->qstn_rep2->LinkCustomAttributes = "";
		$this->qstn_rep2->HrefValue = "";
		$this->qstn_rep2->TooltipValue = "";

		// qstn_rep3
		$this->qstn_rep3->LinkCustomAttributes = "";
		$this->qstn_rep3->HrefValue = "";
		$this->qstn_rep3->TooltipValue = "";

		// qstn_rep4
		$this->qstn_rep4->LinkCustomAttributes = "";
		$this->qstn_rep4->HrefValue = "";
		$this->qstn_rep4->TooltipValue = "";

		// qstn_val1
		$this->qstn_val1->LinkCustomAttributes = "";
		$this->qstn_val1->HrefValue = "";
		$this->qstn_val1->TooltipValue = "";

		// qstn_val2
		$this->qstn_val2->LinkCustomAttributes = "";
		$this->qstn_val2->HrefValue = "";
		$this->qstn_val2->TooltipValue = "";

		// qstn_val3
		$this->qstn_val3->LinkCustomAttributes = "";
		$this->qstn_val3->HrefValue = "";
		$this->qstn_val3->TooltipValue = "";

		// qstn_val4
		$this->qstn_val4->LinkCustomAttributes = "";
		$this->qstn_val4->HrefValue = "";
		$this->qstn_val4->TooltipValue = "";

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

		// test_id
		$this->test_id->EditAttrs["class"] = "form-control";
		$this->test_id->EditCustomAttributes = "";
		$this->test_id->EditValue = $this->test_id->CurrentValue;
		$this->test_id->ViewCustomAttributes = "";

		// test_num
		$this->test_num->EditAttrs["class"] = "form-control";
		$this->test_num->EditCustomAttributes = "";
		$this->test_num->EditValue = $this->test_num->CurrentValue;
		$this->test_num->PlaceHolder = ew_RemoveHtml($this->test_num->FldCaption());

		// test_iname
		$this->test_iname->EditAttrs["class"] = "form-control";
		$this->test_iname->EditCustomAttributes = "";
		$this->test_iname->EditValue = $this->test_iname->CurrentValue;
		$this->test_iname->PlaceHolder = ew_RemoveHtml($this->test_iname->FldCaption());

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";
		$this->status_id->EditValue = $this->status_id->CurrentValue;
		$this->status_id->PlaceHolder = ew_RemoveHtml($this->status_id->FldCaption());

		// test_price
		$this->test_price->EditAttrs["class"] = "form-control";
		$this->test_price->EditCustomAttributes = "";
		$this->test_price->EditValue = $this->test_price->CurrentValue;
		$this->test_price->PlaceHolder = ew_RemoveHtml($this->test_price->FldCaption());
		if (strval($this->test_price->EditValue) <> "" && is_numeric($this->test_price->EditValue)) $this->test_price->EditValue = ew_FormatNumber($this->test_price->EditValue, -2, -1, -2, 0);

		// test_image
		$this->test_image->EditAttrs["class"] = "form-control";
		$this->test_image->EditCustomAttributes = "";
		$this->test_image->EditValue = $this->test_image->CurrentValue;
		$this->test_image->PlaceHolder = ew_RemoveHtml($this->test_image->FldCaption());

		// ntest_id
		$this->ntest_id->EditAttrs["class"] = "form-control";
		$this->ntest_id->EditCustomAttributes = "";
		$this->ntest_id->EditValue = $this->ntest_id->CurrentValue;
		$this->ntest_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->EditAttrs["class"] = "form-control";
		$this->lang_id->EditCustomAttributes = "";
		$this->lang_id->EditValue = $this->lang_id->CurrentValue;
		$this->lang_id->PlaceHolder = ew_RemoveHtml($this->lang_id->FldCaption());

		// test_name
		$this->test_name->EditAttrs["class"] = "form-control";
		$this->test_name->EditCustomAttributes = "";
		$this->test_name->EditValue = $this->test_name->CurrentValue;
		$this->test_name->PlaceHolder = ew_RemoveHtml($this->test_name->FldCaption());

		// test_desc
		$this->test_desc->EditAttrs["class"] = "form-control";
		$this->test_desc->EditCustomAttributes = "";
		$this->test_desc->EditValue = $this->test_desc->CurrentValue;
		$this->test_desc->PlaceHolder = ew_RemoveHtml($this->test_desc->FldCaption());

		// qstn_id
		$this->qstn_id->EditAttrs["class"] = "form-control";
		$this->qstn_id->EditCustomAttributes = "";
		$this->qstn_id->EditValue = $this->qstn_id->CurrentValue;
		$this->qstn_id->ViewCustomAttributes = "";

		// gend_id
		$this->gend_id->EditAttrs["class"] = "form-control";
		$this->gend_id->EditCustomAttributes = "";
		$this->gend_id->EditValue = $this->gend_id->CurrentValue;
		$this->gend_id->PlaceHolder = ew_RemoveHtml($this->gend_id->FldCaption());

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

		// qstn_ansr2
		$this->qstn_ansr2->EditAttrs["class"] = "form-control";
		$this->qstn_ansr2->EditCustomAttributes = "";
		$this->qstn_ansr2->EditValue = $this->qstn_ansr2->CurrentValue;
		$this->qstn_ansr2->PlaceHolder = ew_RemoveHtml($this->qstn_ansr2->FldCaption());

		// qstn_ansr3
		$this->qstn_ansr3->EditAttrs["class"] = "form-control";
		$this->qstn_ansr3->EditCustomAttributes = "";
		$this->qstn_ansr3->EditValue = $this->qstn_ansr3->CurrentValue;
		$this->qstn_ansr3->PlaceHolder = ew_RemoveHtml($this->qstn_ansr3->FldCaption());

		// qstn_ansr4
		$this->qstn_ansr4->EditAttrs["class"] = "form-control";
		$this->qstn_ansr4->EditCustomAttributes = "";
		$this->qstn_ansr4->EditValue = $this->qstn_ansr4->CurrentValue;
		$this->qstn_ansr4->PlaceHolder = ew_RemoveHtml($this->qstn_ansr4->FldCaption());

		// qstn_rep1
		$this->qstn_rep1->EditAttrs["class"] = "form-control";
		$this->qstn_rep1->EditCustomAttributes = "";
		$this->qstn_rep1->EditValue = $this->qstn_rep1->CurrentValue;
		$this->qstn_rep1->PlaceHolder = ew_RemoveHtml($this->qstn_rep1->FldCaption());

		// qstn_rep2
		$this->qstn_rep2->EditAttrs["class"] = "form-control";
		$this->qstn_rep2->EditCustomAttributes = "";
		$this->qstn_rep2->EditValue = $this->qstn_rep2->CurrentValue;
		$this->qstn_rep2->PlaceHolder = ew_RemoveHtml($this->qstn_rep2->FldCaption());

		// qstn_rep3
		$this->qstn_rep3->EditAttrs["class"] = "form-control";
		$this->qstn_rep3->EditCustomAttributes = "";
		$this->qstn_rep3->EditValue = $this->qstn_rep3->CurrentValue;
		$this->qstn_rep3->PlaceHolder = ew_RemoveHtml($this->qstn_rep3->FldCaption());

		// qstn_rep4
		$this->qstn_rep4->EditAttrs["class"] = "form-control";
		$this->qstn_rep4->EditCustomAttributes = "";
		$this->qstn_rep4->EditValue = $this->qstn_rep4->CurrentValue;
		$this->qstn_rep4->PlaceHolder = ew_RemoveHtml($this->qstn_rep4->FldCaption());

		// qstn_val1
		$this->qstn_val1->EditAttrs["class"] = "form-control";
		$this->qstn_val1->EditCustomAttributes = "";
		$this->qstn_val1->EditValue = $this->qstn_val1->CurrentValue;
		$this->qstn_val1->PlaceHolder = ew_RemoveHtml($this->qstn_val1->FldCaption());
		if (strval($this->qstn_val1->EditValue) <> "" && is_numeric($this->qstn_val1->EditValue)) $this->qstn_val1->EditValue = ew_FormatNumber($this->qstn_val1->EditValue, -2, -1, -2, 0);

		// qstn_val2
		$this->qstn_val2->EditAttrs["class"] = "form-control";
		$this->qstn_val2->EditCustomAttributes = "";
		$this->qstn_val2->EditValue = $this->qstn_val2->CurrentValue;
		$this->qstn_val2->PlaceHolder = ew_RemoveHtml($this->qstn_val2->FldCaption());
		if (strval($this->qstn_val2->EditValue) <> "" && is_numeric($this->qstn_val2->EditValue)) $this->qstn_val2->EditValue = ew_FormatNumber($this->qstn_val2->EditValue, -2, -1, -2, 0);

		// qstn_val3
		$this->qstn_val3->EditAttrs["class"] = "form-control";
		$this->qstn_val3->EditCustomAttributes = "";
		$this->qstn_val3->EditValue = $this->qstn_val3->CurrentValue;
		$this->qstn_val3->PlaceHolder = ew_RemoveHtml($this->qstn_val3->FldCaption());
		if (strval($this->qstn_val3->EditValue) <> "" && is_numeric($this->qstn_val3->EditValue)) $this->qstn_val3->EditValue = ew_FormatNumber($this->qstn_val3->EditValue, -2, -1, -2, 0);

		// qstn_val4
		$this->qstn_val4->EditAttrs["class"] = "form-control";
		$this->qstn_val4->EditCustomAttributes = "";
		$this->qstn_val4->EditValue = $this->qstn_val4->CurrentValue;
		$this->qstn_val4->PlaceHolder = ew_RemoveHtml($this->qstn_val4->FldCaption());
		if (strval($this->qstn_val4->EditValue) <> "" && is_numeric($this->qstn_val4->EditValue)) $this->qstn_val4->EditValue = ew_FormatNumber($this->qstn_val4->EditValue, -2, -1, -2, 0);

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
					if ($this->test_num->Exportable) $Doc->ExportCaption($this->test_num);
					if ($this->test_iname->Exportable) $Doc->ExportCaption($this->test_iname);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->test_price->Exportable) $Doc->ExportCaption($this->test_price);
					if ($this->test_image->Exportable) $Doc->ExportCaption($this->test_image);
					if ($this->ntest_id->Exportable) $Doc->ExportCaption($this->ntest_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->test_name->Exportable) $Doc->ExportCaption($this->test_name);
					if ($this->test_desc->Exportable) $Doc->ExportCaption($this->test_desc);
					if ($this->qstn_id->Exportable) $Doc->ExportCaption($this->qstn_id);
					if ($this->gend_id->Exportable) $Doc->ExportCaption($this->gend_id);
					if ($this->qstn_num->Exportable) $Doc->ExportCaption($this->qstn_num);
					if ($this->qstn_text->Exportable) $Doc->ExportCaption($this->qstn_text);
					if ($this->qstn_ansr1->Exportable) $Doc->ExportCaption($this->qstn_ansr1);
					if ($this->qstn_ansr2->Exportable) $Doc->ExportCaption($this->qstn_ansr2);
					if ($this->qstn_ansr3->Exportable) $Doc->ExportCaption($this->qstn_ansr3);
					if ($this->qstn_ansr4->Exportable) $Doc->ExportCaption($this->qstn_ansr4);
					if ($this->qstn_rep1->Exportable) $Doc->ExportCaption($this->qstn_rep1);
					if ($this->qstn_rep2->Exportable) $Doc->ExportCaption($this->qstn_rep2);
					if ($this->qstn_rep3->Exportable) $Doc->ExportCaption($this->qstn_rep3);
					if ($this->qstn_rep4->Exportable) $Doc->ExportCaption($this->qstn_rep4);
					if ($this->qstn_val1->Exportable) $Doc->ExportCaption($this->qstn_val1);
					if ($this->qstn_val2->Exportable) $Doc->ExportCaption($this->qstn_val2);
					if ($this->qstn_val3->Exportable) $Doc->ExportCaption($this->qstn_val3);
					if ($this->qstn_val4->Exportable) $Doc->ExportCaption($this->qstn_val4);
				} else {
					if ($this->test_id->Exportable) $Doc->ExportCaption($this->test_id);
					if ($this->test_num->Exportable) $Doc->ExportCaption($this->test_num);
					if ($this->test_iname->Exportable) $Doc->ExportCaption($this->test_iname);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->test_price->Exportable) $Doc->ExportCaption($this->test_price);
					if ($this->test_image->Exportable) $Doc->ExportCaption($this->test_image);
					if ($this->ntest_id->Exportable) $Doc->ExportCaption($this->ntest_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->test_name->Exportable) $Doc->ExportCaption($this->test_name);
					if ($this->qstn_id->Exportable) $Doc->ExportCaption($this->qstn_id);
					if ($this->gend_id->Exportable) $Doc->ExportCaption($this->gend_id);
					if ($this->qstn_num->Exportable) $Doc->ExportCaption($this->qstn_num);
					if ($this->qstn_val1->Exportable) $Doc->ExportCaption($this->qstn_val1);
					if ($this->qstn_val2->Exportable) $Doc->ExportCaption($this->qstn_val2);
					if ($this->qstn_val3->Exportable) $Doc->ExportCaption($this->qstn_val3);
					if ($this->qstn_val4->Exportable) $Doc->ExportCaption($this->qstn_val4);
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
						if ($this->test_num->Exportable) $Doc->ExportField($this->test_num);
						if ($this->test_iname->Exportable) $Doc->ExportField($this->test_iname);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->test_price->Exportable) $Doc->ExportField($this->test_price);
						if ($this->test_image->Exportable) $Doc->ExportField($this->test_image);
						if ($this->ntest_id->Exportable) $Doc->ExportField($this->ntest_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->test_name->Exportable) $Doc->ExportField($this->test_name);
						if ($this->test_desc->Exportable) $Doc->ExportField($this->test_desc);
						if ($this->qstn_id->Exportable) $Doc->ExportField($this->qstn_id);
						if ($this->gend_id->Exportable) $Doc->ExportField($this->gend_id);
						if ($this->qstn_num->Exportable) $Doc->ExportField($this->qstn_num);
						if ($this->qstn_text->Exportable) $Doc->ExportField($this->qstn_text);
						if ($this->qstn_ansr1->Exportable) $Doc->ExportField($this->qstn_ansr1);
						if ($this->qstn_ansr2->Exportable) $Doc->ExportField($this->qstn_ansr2);
						if ($this->qstn_ansr3->Exportable) $Doc->ExportField($this->qstn_ansr3);
						if ($this->qstn_ansr4->Exportable) $Doc->ExportField($this->qstn_ansr4);
						if ($this->qstn_rep1->Exportable) $Doc->ExportField($this->qstn_rep1);
						if ($this->qstn_rep2->Exportable) $Doc->ExportField($this->qstn_rep2);
						if ($this->qstn_rep3->Exportable) $Doc->ExportField($this->qstn_rep3);
						if ($this->qstn_rep4->Exportable) $Doc->ExportField($this->qstn_rep4);
						if ($this->qstn_val1->Exportable) $Doc->ExportField($this->qstn_val1);
						if ($this->qstn_val2->Exportable) $Doc->ExportField($this->qstn_val2);
						if ($this->qstn_val3->Exportable) $Doc->ExportField($this->qstn_val3);
						if ($this->qstn_val4->Exportable) $Doc->ExportField($this->qstn_val4);
					} else {
						if ($this->test_id->Exportable) $Doc->ExportField($this->test_id);
						if ($this->test_num->Exportable) $Doc->ExportField($this->test_num);
						if ($this->test_iname->Exportable) $Doc->ExportField($this->test_iname);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->test_price->Exportable) $Doc->ExportField($this->test_price);
						if ($this->test_image->Exportable) $Doc->ExportField($this->test_image);
						if ($this->ntest_id->Exportable) $Doc->ExportField($this->ntest_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->test_name->Exportable) $Doc->ExportField($this->test_name);
						if ($this->qstn_id->Exportable) $Doc->ExportField($this->qstn_id);
						if ($this->gend_id->Exportable) $Doc->ExportField($this->gend_id);
						if ($this->qstn_num->Exportable) $Doc->ExportField($this->qstn_num);
						if ($this->qstn_val1->Exportable) $Doc->ExportField($this->qstn_val1);
						if ($this->qstn_val2->Exportable) $Doc->ExportField($this->qstn_val2);
						if ($this->qstn_val3->Exportable) $Doc->ExportField($this->qstn_val3);
						if ($this->qstn_val4->Exportable) $Doc->ExportField($this->qstn_val4);
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
