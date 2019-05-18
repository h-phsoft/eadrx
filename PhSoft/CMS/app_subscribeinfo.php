<?php

// Global variable for table object
$app_subscribe = NULL;

//
// Table class for app_subscribe
//
class capp_subscribe extends cTable {
	var $subs_id;
	var $serv_id;
	var $user_id;
	var $cycle_id;
	var $book_id;
	var $pkg_id;
	var $tcat_id;
	var $test_id;
	var $cat_id;
	var $cons_id;
	var $subs_start;
	var $subs_end;
	var $subs_qnt;
	var $subs_price;
	var $subs_amt;
	var $ins_datetime;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_subscribe';
		$this->TableName = 'app_subscribe';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`app_subscribe`";
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

		// subs_id
		$this->subs_id = new cField('app_subscribe', 'app_subscribe', 'x_subs_id', 'subs_id', '`subs_id`', '`subs_id`', 3, -1, FALSE, '`subs_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->subs_id->Sortable = FALSE; // Allow sort
		$this->subs_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['subs_id'] = &$this->subs_id;

		// serv_id
		$this->serv_id = new cField('app_subscribe', 'app_subscribe', 'x_serv_id', 'serv_id', '`serv_id`', '`serv_id`', 2, -1, FALSE, '`serv_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->serv_id->Sortable = TRUE; // Allow sort
		$this->serv_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->serv_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->serv_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['serv_id'] = &$this->serv_id;

		// user_id
		$this->user_id = new cField('app_subscribe', 'app_subscribe', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->user_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// cycle_id
		$this->cycle_id = new cField('app_subscribe', 'app_subscribe', 'x_cycle_id', 'cycle_id', '`cycle_id`', '`cycle_id`', 2, -1, FALSE, '`cycle_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cycle_id->Sortable = TRUE; // Allow sort
		$this->cycle_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cycle_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->cycle_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cycle_id'] = &$this->cycle_id;

		// book_id
		$this->book_id = new cField('app_subscribe', 'app_subscribe', 'x_book_id', 'book_id', '`book_id`', '`book_id`', 3, -1, FALSE, '`book_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->book_id->Sortable = TRUE; // Allow sort
		$this->book_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->book_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->book_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['book_id'] = &$this->book_id;

		// pkg_id
		$this->pkg_id = new cField('app_subscribe', 'app_subscribe', 'x_pkg_id', 'pkg_id', '`pkg_id`', '`pkg_id`', 3, -1, FALSE, '`pkg_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pkg_id->Sortable = TRUE; // Allow sort
		$this->pkg_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pkg_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->pkg_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pkg_id'] = &$this->pkg_id;

		// tcat_id
		$this->tcat_id = new cField('app_subscribe', 'app_subscribe', 'x_tcat_id', 'tcat_id', '`tcat_id`', '`tcat_id`', 3, -1, FALSE, '`tcat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tcat_id->Sortable = TRUE; // Allow sort
		$this->tcat_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tcat_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->tcat_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tcat_id'] = &$this->tcat_id;

		// test_id
		$this->test_id = new cField('app_subscribe', 'app_subscribe', 'x_test_id', 'test_id', '`test_id`', '`test_id`', 3, -1, FALSE, '`test_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->test_id->Sortable = TRUE; // Allow sort
		$this->test_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->test_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->test_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['test_id'] = &$this->test_id;

		// cat_id
		$this->cat_id = new cField('app_subscribe', 'app_subscribe', 'x_cat_id', 'cat_id', '`cat_id`', '`cat_id`', 3, -1, FALSE, '`cat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cat_id->Sortable = TRUE; // Allow sort
		$this->cat_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cat_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->cat_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cat_id'] = &$this->cat_id;

		// cons_id
		$this->cons_id = new cField('app_subscribe', 'app_subscribe', 'x_cons_id', 'cons_id', '`cons_id`', '`cons_id`', 3, -1, FALSE, '`cons_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cons_id->Sortable = TRUE; // Allow sort
		$this->cons_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cons_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->cons_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cons_id'] = &$this->cons_id;

		// subs_start
		$this->subs_start = new cField('app_subscribe', 'app_subscribe', 'x_subs_start', 'subs_start', '`subs_start`', ew_CastDateFieldForLike('`subs_start`', 0, "DB"), 133, 0, FALSE, '`subs_start`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subs_start->Sortable = TRUE; // Allow sort
		$this->subs_start->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['subs_start'] = &$this->subs_start;

		// subs_end
		$this->subs_end = new cField('app_subscribe', 'app_subscribe', 'x_subs_end', 'subs_end', '`subs_end`', ew_CastDateFieldForLike('`subs_end`', 0, "DB"), 133, 0, FALSE, '`subs_end`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subs_end->Sortable = TRUE; // Allow sort
		$this->subs_end->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['subs_end'] = &$this->subs_end;

		// subs_qnt
		$this->subs_qnt = new cField('app_subscribe', 'app_subscribe', 'x_subs_qnt', 'subs_qnt', '`subs_qnt`', '`subs_qnt`', 131, -1, FALSE, '`subs_qnt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subs_qnt->Sortable = TRUE; // Allow sort
		$this->subs_qnt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subs_qnt'] = &$this->subs_qnt;

		// subs_price
		$this->subs_price = new cField('app_subscribe', 'app_subscribe', 'x_subs_price', 'subs_price', '`subs_price`', '`subs_price`', 131, -1, FALSE, '`subs_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subs_price->Sortable = TRUE; // Allow sort
		$this->subs_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subs_price'] = &$this->subs_price;

		// subs_amt
		$this->subs_amt = new cField('app_subscribe', 'app_subscribe', 'x_subs_amt', 'subs_amt', '`subs_amt`', '`subs_amt`', 131, -1, FALSE, '`subs_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subs_amt->Sortable = TRUE; // Allow sort
		$this->subs_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subs_amt'] = &$this->subs_amt;

		// ins_datetime
		$this->ins_datetime = new cField('app_subscribe', 'app_subscribe', 'x_ins_datetime', 'ins_datetime', '`ins_datetime`', ew_CastDateFieldForLike('`ins_datetime`', 0, "DB"), 135, 0, FALSE, '`ins_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ins_datetime->Sortable = TRUE; // Allow sort
		$this->ins_datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ins_datetime'] = &$this->ins_datetime;
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

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "app_subscribe_cats") {
			$sDetailUrl = $GLOBALS["app_subscribe_cats"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_subs_id=" . urlencode($this->subs_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "app_subscribelist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_subscribe`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`serv_id` ASC,`user_id` ASC,`cycle_id` ASC,`ins_datetime` DESC";
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
			$this->subs_id->setDbValue($conn->Insert_ID());
			$rs['subs_id'] = $this->subs_id->DbValue;
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
			if (array_key_exists('subs_id', $rs))
				ew_AddFilter($where, ew_QuotedName('subs_id', $this->DBID) . '=' . ew_QuotedValue($rs['subs_id'], $this->subs_id->FldDataType, $this->DBID));
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
		return "`subs_id` = @subs_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->subs_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->subs_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@subs_id@", ew_AdjustSql($this->subs_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_subscribelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_subscribeview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_subscribeedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_subscribeadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_subscribelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_subscribeview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_subscribeview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_subscribeadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_subscribeadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_subscribeedit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_subscribeedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_subscribeadd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_subscribeadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_subscribedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "subs_id:" . ew_VarToJson($this->subs_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->subs_id->CurrentValue)) {
			$sUrl .= "subs_id=" . urlencode($this->subs_id->CurrentValue);
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
			if ($isPost && isset($_POST["subs_id"]))
				$arKeys[] = $_POST["subs_id"];
			elseif (isset($_GET["subs_id"]))
				$arKeys[] = $_GET["subs_id"];
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
			$this->subs_id->CurrentValue = $key;
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
		$this->subs_id->setDbValue($rs->fields('subs_id'));
		$this->serv_id->setDbValue($rs->fields('serv_id'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->cycle_id->setDbValue($rs->fields('cycle_id'));
		$this->book_id->setDbValue($rs->fields('book_id'));
		$this->pkg_id->setDbValue($rs->fields('pkg_id'));
		$this->tcat_id->setDbValue($rs->fields('tcat_id'));
		$this->test_id->setDbValue($rs->fields('test_id'));
		$this->cat_id->setDbValue($rs->fields('cat_id'));
		$this->cons_id->setDbValue($rs->fields('cons_id'));
		$this->subs_start->setDbValue($rs->fields('subs_start'));
		$this->subs_end->setDbValue($rs->fields('subs_end'));
		$this->subs_qnt->setDbValue($rs->fields('subs_qnt'));
		$this->subs_price->setDbValue($rs->fields('subs_price'));
		$this->subs_amt->setDbValue($rs->fields('subs_amt'));
		$this->ins_datetime->setDbValue($rs->fields('ins_datetime'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// subs_id

		$this->subs_id->CellCssStyle = "white-space: nowrap;";

		// serv_id
		// user_id
		// cycle_id
		// book_id
		// pkg_id
		// tcat_id
		// test_id
		// cat_id
		// cons_id
		// subs_start
		// subs_end
		// subs_qnt
		// subs_price
		// subs_amt
		// ins_datetime
		// subs_id

		$this->subs_id->ViewValue = $this->subs_id->CurrentValue;
		$this->subs_id->ViewCustomAttributes = "";

		// serv_id
		if (strval($this->serv_id->CurrentValue) <> "") {
			$sFilterWrk = "`serv_id`" . ew_SearchString("=", $this->serv_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `serv_id`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_service`";
		$sWhereWrk = "";
		$this->serv_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->serv_id->ViewValue = $this->serv_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->serv_id->ViewValue = $this->serv_id->CurrentValue;
			}
		} else {
			$this->serv_id->ViewValue = NULL;
		}
		$this->serv_id->ViewCustomAttributes = "";

		// user_id
		if (strval($this->user_id->CurrentValue) <> "") {
			$sFilterWrk = "`user_id`" . ew_SearchString("=", $this->user_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `user_id`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
		$sWhereWrk = "";
		$this->user_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->user_id->ViewValue = $this->user_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->user_id->ViewValue = $this->user_id->CurrentValue;
			}
		} else {
			$this->user_id->ViewValue = NULL;
		}
		$this->user_id->ViewCustomAttributes = "";

		// cycle_id
		if (strval($this->cycle_id->CurrentValue) <> "") {
			$sFilterWrk = "`cycle_id`" . ew_SearchString("=", $this->cycle_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cycle_id`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_bill_cycle`";
		$sWhereWrk = "";
		$this->cycle_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cycle_id->ViewValue = $this->cycle_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cycle_id->ViewValue = $this->cycle_id->CurrentValue;
			}
		} else {
			$this->cycle_id->ViewValue = NULL;
		}
		$this->cycle_id->ViewCustomAttributes = "";

		// book_id
		if (strval($this->book_id->CurrentValue) <> "") {
			$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
		$sWhereWrk = "";
		$this->book_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->book_id->ViewValue = $this->book_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->book_id->ViewValue = $this->book_id->CurrentValue;
			}
		} else {
			$this->book_id->ViewValue = NULL;
		}
		$this->book_id->ViewCustomAttributes = "";

		// pkg_id
		if (strval($this->pkg_id->CurrentValue) <> "") {
			$sFilterWrk = "`pkg_id`" . ew_SearchString("=", $this->pkg_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pkg_id`, `pkg_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_package`";
		$sWhereWrk = "";
		$this->pkg_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pkg_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pkg_id->ViewValue = $this->pkg_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pkg_id->ViewValue = $this->pkg_id->CurrentValue;
			}
		} else {
			$this->pkg_id->ViewValue = NULL;
		}
		$this->pkg_id->ViewCustomAttributes = "";

		// tcat_id
		if (strval($this->tcat_id->CurrentValue) <> "") {
			$sFilterWrk = "`tcat_id`" . ew_SearchString("=", $this->tcat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `tcat_id`, `tcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_category`";
		$sWhereWrk = "";
		$this->tcat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tcat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tcat_id->ViewValue = $this->tcat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tcat_id->ViewValue = $this->tcat_id->CurrentValue;
			}
		} else {
			$this->tcat_id->ViewValue = NULL;
		}
		$this->tcat_id->ViewCustomAttributes = "";

		// test_id
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// cat_id
		if (strval($this->cat_id->CurrentValue) <> "") {
			$sFilterWrk = "`cat_id`" . ew_SearchString("=", $this->cat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cat_id`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_category`";
		$sWhereWrk = "";
		$this->cat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cat_id->ViewValue = $this->cat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cat_id->ViewValue = $this->cat_id->CurrentValue;
			}
		} else {
			$this->cat_id->ViewValue = NULL;
		}
		$this->cat_id->ViewCustomAttributes = "";

		// cons_id
		if (strval($this->cons_id->CurrentValue) <> "") {
			$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cons_id`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
		$sWhereWrk = "";
		$this->cons_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cons_id->ViewValue = $this->cons_id->CurrentValue;
			}
		} else {
			$this->cons_id->ViewValue = NULL;
		}
		$this->cons_id->ViewCustomAttributes = "";

		// subs_start
		$this->subs_start->ViewValue = $this->subs_start->CurrentValue;
		$this->subs_start->ViewValue = ew_FormatDateTime($this->subs_start->ViewValue, 0);
		$this->subs_start->ViewCustomAttributes = "";

		// subs_end
		$this->subs_end->ViewValue = $this->subs_end->CurrentValue;
		$this->subs_end->ViewValue = ew_FormatDateTime($this->subs_end->ViewValue, 0);
		$this->subs_end->ViewCustomAttributes = "";

		// subs_qnt
		$this->subs_qnt->ViewValue = $this->subs_qnt->CurrentValue;
		$this->subs_qnt->ViewCustomAttributes = "";

		// subs_price
		$this->subs_price->ViewValue = $this->subs_price->CurrentValue;
		$this->subs_price->ViewCustomAttributes = "";

		// subs_amt
		$this->subs_amt->ViewValue = $this->subs_amt->CurrentValue;
		$this->subs_amt->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

		// subs_id
		$this->subs_id->LinkCustomAttributes = "";
		$this->subs_id->HrefValue = "";
		$this->subs_id->TooltipValue = "";

		// serv_id
		$this->serv_id->LinkCustomAttributes = "";
		$this->serv_id->HrefValue = "";
		$this->serv_id->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// cycle_id
		$this->cycle_id->LinkCustomAttributes = "";
		$this->cycle_id->HrefValue = "";
		$this->cycle_id->TooltipValue = "";

		// book_id
		$this->book_id->LinkCustomAttributes = "";
		$this->book_id->HrefValue = "";
		$this->book_id->TooltipValue = "";

		// pkg_id
		$this->pkg_id->LinkCustomAttributes = "";
		$this->pkg_id->HrefValue = "";
		$this->pkg_id->TooltipValue = "";

		// tcat_id
		$this->tcat_id->LinkCustomAttributes = "";
		$this->tcat_id->HrefValue = "";
		$this->tcat_id->TooltipValue = "";

		// test_id
		$this->test_id->LinkCustomAttributes = "";
		$this->test_id->HrefValue = "";
		$this->test_id->TooltipValue = "";

		// cat_id
		$this->cat_id->LinkCustomAttributes = "";
		$this->cat_id->HrefValue = "";
		$this->cat_id->TooltipValue = "";

		// cons_id
		$this->cons_id->LinkCustomAttributes = "";
		$this->cons_id->HrefValue = "";
		$this->cons_id->TooltipValue = "";

		// subs_start
		$this->subs_start->LinkCustomAttributes = "";
		$this->subs_start->HrefValue = "";
		$this->subs_start->TooltipValue = "";

		// subs_end
		$this->subs_end->LinkCustomAttributes = "";
		$this->subs_end->HrefValue = "";
		$this->subs_end->TooltipValue = "";

		// subs_qnt
		$this->subs_qnt->LinkCustomAttributes = "";
		$this->subs_qnt->HrefValue = "";
		$this->subs_qnt->TooltipValue = "";

		// subs_price
		$this->subs_price->LinkCustomAttributes = "";
		$this->subs_price->HrefValue = "";
		$this->subs_price->TooltipValue = "";

		// subs_amt
		$this->subs_amt->LinkCustomAttributes = "";
		$this->subs_amt->HrefValue = "";
		$this->subs_amt->TooltipValue = "";

		// ins_datetime
		$this->ins_datetime->LinkCustomAttributes = "";
		$this->ins_datetime->HrefValue = "";
		$this->ins_datetime->TooltipValue = "";

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

		// subs_id
		$this->subs_id->EditAttrs["class"] = "form-control";
		$this->subs_id->EditCustomAttributes = "";
		$this->subs_id->EditValue = $this->subs_id->CurrentValue;
		$this->subs_id->ViewCustomAttributes = "";

		// serv_id
		$this->serv_id->EditAttrs["class"] = "form-control";
		$this->serv_id->EditCustomAttributes = "";

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";

		// cycle_id
		$this->cycle_id->EditAttrs["class"] = "form-control";
		$this->cycle_id->EditCustomAttributes = "";

		// book_id
		$this->book_id->EditAttrs["class"] = "form-control";
		$this->book_id->EditCustomAttributes = "";

		// pkg_id
		$this->pkg_id->EditAttrs["class"] = "form-control";
		$this->pkg_id->EditCustomAttributes = "";

		// tcat_id
		$this->tcat_id->EditAttrs["class"] = "form-control";
		$this->tcat_id->EditCustomAttributes = "";

		// test_id
		$this->test_id->EditAttrs["class"] = "form-control";
		$this->test_id->EditCustomAttributes = "";

		// cat_id
		$this->cat_id->EditAttrs["class"] = "form-control";
		$this->cat_id->EditCustomAttributes = "";

		// cons_id
		$this->cons_id->EditAttrs["class"] = "form-control";
		$this->cons_id->EditCustomAttributes = "";

		// subs_start
		$this->subs_start->EditAttrs["class"] = "form-control";
		$this->subs_start->EditCustomAttributes = "";
		$this->subs_start->EditValue = ew_FormatDateTime($this->subs_start->CurrentValue, 8);
		$this->subs_start->PlaceHolder = ew_RemoveHtml($this->subs_start->FldCaption());

		// subs_end
		$this->subs_end->EditAttrs["class"] = "form-control";
		$this->subs_end->EditCustomAttributes = "";
		$this->subs_end->EditValue = ew_FormatDateTime($this->subs_end->CurrentValue, 8);
		$this->subs_end->PlaceHolder = ew_RemoveHtml($this->subs_end->FldCaption());

		// subs_qnt
		$this->subs_qnt->EditAttrs["class"] = "form-control";
		$this->subs_qnt->EditCustomAttributes = "";
		$this->subs_qnt->EditValue = $this->subs_qnt->CurrentValue;
		$this->subs_qnt->PlaceHolder = ew_RemoveHtml($this->subs_qnt->FldCaption());
		if (strval($this->subs_qnt->EditValue) <> "" && is_numeric($this->subs_qnt->EditValue)) $this->subs_qnt->EditValue = ew_FormatNumber($this->subs_qnt->EditValue, -2, -1, -2, 0);

		// subs_price
		$this->subs_price->EditAttrs["class"] = "form-control";
		$this->subs_price->EditCustomAttributes = "";
		$this->subs_price->EditValue = $this->subs_price->CurrentValue;
		$this->subs_price->PlaceHolder = ew_RemoveHtml($this->subs_price->FldCaption());
		if (strval($this->subs_price->EditValue) <> "" && is_numeric($this->subs_price->EditValue)) $this->subs_price->EditValue = ew_FormatNumber($this->subs_price->EditValue, -2, -1, -2, 0);

		// subs_amt
		$this->subs_amt->EditAttrs["class"] = "form-control";
		$this->subs_amt->EditCustomAttributes = "";
		$this->subs_amt->EditValue = $this->subs_amt->CurrentValue;
		$this->subs_amt->PlaceHolder = ew_RemoveHtml($this->subs_amt->FldCaption());
		if (strval($this->subs_amt->EditValue) <> "" && is_numeric($this->subs_amt->EditValue)) $this->subs_amt->EditValue = ew_FormatNumber($this->subs_amt->EditValue, -2, -1, -2, 0);

		// ins_datetime
		$this->ins_datetime->EditAttrs["class"] = "form-control";
		$this->ins_datetime->EditCustomAttributes = "";
		$this->ins_datetime->EditValue = ew_FormatDateTime($this->ins_datetime->CurrentValue, 8);
		$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

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
					if ($this->serv_id->Exportable) $Doc->ExportCaption($this->serv_id);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->cycle_id->Exportable) $Doc->ExportCaption($this->cycle_id);
					if ($this->book_id->Exportable) $Doc->ExportCaption($this->book_id);
					if ($this->pkg_id->Exportable) $Doc->ExportCaption($this->pkg_id);
					if ($this->tcat_id->Exportable) $Doc->ExportCaption($this->tcat_id);
					if ($this->test_id->Exportable) $Doc->ExportCaption($this->test_id);
					if ($this->cat_id->Exportable) $Doc->ExportCaption($this->cat_id);
					if ($this->cons_id->Exportable) $Doc->ExportCaption($this->cons_id);
					if ($this->subs_start->Exportable) $Doc->ExportCaption($this->subs_start);
					if ($this->subs_end->Exportable) $Doc->ExportCaption($this->subs_end);
					if ($this->subs_qnt->Exportable) $Doc->ExportCaption($this->subs_qnt);
					if ($this->subs_price->Exportable) $Doc->ExportCaption($this->subs_price);
					if ($this->subs_amt->Exportable) $Doc->ExportCaption($this->subs_amt);
					if ($this->ins_datetime->Exportable) $Doc->ExportCaption($this->ins_datetime);
				} else {
					if ($this->serv_id->Exportable) $Doc->ExportCaption($this->serv_id);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->cycle_id->Exportable) $Doc->ExportCaption($this->cycle_id);
					if ($this->book_id->Exportable) $Doc->ExportCaption($this->book_id);
					if ($this->pkg_id->Exportable) $Doc->ExportCaption($this->pkg_id);
					if ($this->tcat_id->Exportable) $Doc->ExportCaption($this->tcat_id);
					if ($this->test_id->Exportable) $Doc->ExportCaption($this->test_id);
					if ($this->cat_id->Exportable) $Doc->ExportCaption($this->cat_id);
					if ($this->cons_id->Exportable) $Doc->ExportCaption($this->cons_id);
					if ($this->subs_start->Exportable) $Doc->ExportCaption($this->subs_start);
					if ($this->subs_end->Exportable) $Doc->ExportCaption($this->subs_end);
					if ($this->subs_qnt->Exportable) $Doc->ExportCaption($this->subs_qnt);
					if ($this->subs_price->Exportable) $Doc->ExportCaption($this->subs_price);
					if ($this->subs_amt->Exportable) $Doc->ExportCaption($this->subs_amt);
					if ($this->ins_datetime->Exportable) $Doc->ExportCaption($this->ins_datetime);
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
						if ($this->serv_id->Exportable) $Doc->ExportField($this->serv_id);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->cycle_id->Exportable) $Doc->ExportField($this->cycle_id);
						if ($this->book_id->Exportable) $Doc->ExportField($this->book_id);
						if ($this->pkg_id->Exportable) $Doc->ExportField($this->pkg_id);
						if ($this->tcat_id->Exportable) $Doc->ExportField($this->tcat_id);
						if ($this->test_id->Exportable) $Doc->ExportField($this->test_id);
						if ($this->cat_id->Exportable) $Doc->ExportField($this->cat_id);
						if ($this->cons_id->Exportable) $Doc->ExportField($this->cons_id);
						if ($this->subs_start->Exportable) $Doc->ExportField($this->subs_start);
						if ($this->subs_end->Exportable) $Doc->ExportField($this->subs_end);
						if ($this->subs_qnt->Exportable) $Doc->ExportField($this->subs_qnt);
						if ($this->subs_price->Exportable) $Doc->ExportField($this->subs_price);
						if ($this->subs_amt->Exportable) $Doc->ExportField($this->subs_amt);
						if ($this->ins_datetime->Exportable) $Doc->ExportField($this->ins_datetime);
					} else {
						if ($this->serv_id->Exportable) $Doc->ExportField($this->serv_id);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->cycle_id->Exportable) $Doc->ExportField($this->cycle_id);
						if ($this->book_id->Exportable) $Doc->ExportField($this->book_id);
						if ($this->pkg_id->Exportable) $Doc->ExportField($this->pkg_id);
						if ($this->tcat_id->Exportable) $Doc->ExportField($this->tcat_id);
						if ($this->test_id->Exportable) $Doc->ExportField($this->test_id);
						if ($this->cat_id->Exportable) $Doc->ExportField($this->cat_id);
						if ($this->cons_id->Exportable) $Doc->ExportField($this->cons_id);
						if ($this->subs_start->Exportable) $Doc->ExportField($this->subs_start);
						if ($this->subs_end->Exportable) $Doc->ExportField($this->subs_end);
						if ($this->subs_qnt->Exportable) $Doc->ExportField($this->subs_qnt);
						if ($this->subs_price->Exportable) $Doc->ExportField($this->subs_price);
						if ($this->subs_amt->Exportable) $Doc->ExportField($this->subs_amt);
						if ($this->ins_datetime->Exportable) $Doc->ExportField($this->ins_datetime);
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
