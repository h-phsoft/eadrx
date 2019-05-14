<?php

// Global variable for table object
$app_vtest = NULL;

//
// Table class for app_vtest
//
class capp_vtest extends cTable {
	var $test_id;
	var $ntest_id;
	var $lang_id;
	var $test_num;
	var $test_name;
	var $test_iname;
	var $status_id;
	var $test_image;
	var $test_price;
	var $test_desc;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_vtest';
		$this->TableName = 'app_vtest';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`app_vtest`";
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
		$this->test_id = new cField('app_vtest', 'app_vtest', 'x_test_id', 'test_id', '`test_id`', '`test_id`', 3, -1, FALSE, '`test_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->test_id->Sortable = FALSE; // Allow sort
		$this->test_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['test_id'] = &$this->test_id;

		// ntest_id
		$this->ntest_id = new cField('app_vtest', 'app_vtest', 'x_ntest_id', 'ntest_id', '`ntest_id`', '`ntest_id`', 3, -1, FALSE, '`ntest_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ntest_id->Sortable = FALSE; // Allow sort
		$this->ntest_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ntest_id'] = &$this->ntest_id;

		// lang_id
		$this->lang_id = new cField('app_vtest', 'app_vtest', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->lang_id->Sortable = TRUE; // Allow sort
		$this->lang_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->lang_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// test_num
		$this->test_num = new cField('app_vtest', 'app_vtest', 'x_test_num', 'test_num', '`test_num`', '`test_num`', 16, -1, FALSE, '`test_num`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_num->Sortable = TRUE; // Allow sort
		$this->test_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['test_num'] = &$this->test_num;

		// test_name
		$this->test_name = new cField('app_vtest', 'app_vtest', 'x_test_name', 'test_name', '`test_name`', '`test_name`', 200, -1, FALSE, '`test_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_name->Sortable = TRUE; // Allow sort
		$this->fields['test_name'] = &$this->test_name;

		// test_iname
		$this->test_iname = new cField('app_vtest', 'app_vtest', 'x_test_iname', 'test_iname', '`test_iname`', '`test_iname`', 200, -1, FALSE, '`test_iname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_iname->Sortable = TRUE; // Allow sort
		$this->fields['test_iname'] = &$this->test_iname;

		// status_id
		$this->status_id = new cField('app_vtest', 'app_vtest', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// test_image
		$this->test_image = new cField('app_vtest', 'app_vtest', 'x_test_image', 'test_image', '`test_image`', '`test_image`', 200, -1, TRUE, '`test_image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->test_image->Sortable = TRUE; // Allow sort
		$this->fields['test_image'] = &$this->test_image;

		// test_price
		$this->test_price = new cField('app_vtest', 'app_vtest', 'x_test_price', 'test_price', '`test_price`', '`test_price`', 131, -1, FALSE, '`test_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->test_price->Sortable = TRUE; // Allow sort
		$this->test_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['test_price'] = &$this->test_price;

		// test_desc
		$this->test_desc = new cField('app_vtest', 'app_vtest', 'x_test_desc', 'test_desc', '`test_desc`', '`test_desc`', 201, -1, FALSE, '`test_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->test_desc->Sortable = TRUE; // Allow sort
		$this->fields['test_desc'] = &$this->test_desc;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_vtest`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`lang_id` ASC,`test_num` ASC";
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
		return "`test_id` = @test_id@ AND `ntest_id` = @ntest_id@";
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
			return "app_vtestlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_vtestview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_vtestedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_vtestadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_vtestlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_vtestview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_vtestview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_vtestadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_vtestadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("app_vtestedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("app_vtestadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_vtestdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "test_id:" . ew_VarToJson($this->test_id->CurrentValue, "number", "'");
		$json .= ",ntest_id:" . ew_VarToJson($this->ntest_id->CurrentValue, "number", "'");
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
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // test_id
					continue;
				if (!is_numeric($key[1])) // ntest_id
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
		$this->ntest_id->setDbValue($rs->fields('ntest_id'));
		$this->lang_id->setDbValue($rs->fields('lang_id'));
		$this->test_num->setDbValue($rs->fields('test_num'));
		$this->test_name->setDbValue($rs->fields('test_name'));
		$this->test_iname->setDbValue($rs->fields('test_iname'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->test_image->Upload->DbValue = $rs->fields('test_image');
		$this->test_price->setDbValue($rs->fields('test_price'));
		$this->test_desc->setDbValue($rs->fields('test_desc'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// test_id

		$this->test_id->CellCssStyle = "white-space: nowrap;";

		// ntest_id
		$this->ntest_id->CellCssStyle = "white-space: nowrap;";

		// lang_id
		// test_num
		// test_name
		// test_iname
		// status_id
		// test_image
		// test_price
		// test_desc
		// test_id

		$this->test_id->ViewValue = $this->test_id->CurrentValue;
		$this->test_id->ViewCustomAttributes = "";

		// ntest_id
		$this->ntest_id->ViewValue = $this->ntest_id->CurrentValue;
		$this->ntest_id->ViewCustomAttributes = "";

		// lang_id
		if (strval($this->lang_id->CurrentValue) <> "") {
			$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `lang_id`, `lang_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
		$sWhereWrk = "";
		$this->lang_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->lang_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// test_num
		$this->test_num->ViewValue = $this->test_num->CurrentValue;
		$this->test_num->ViewCustomAttributes = "";

		// test_name
		$this->test_name->ViewValue = $this->test_name->CurrentValue;
		$this->test_name->ViewCustomAttributes = "";

		// test_iname
		$this->test_iname->ViewValue = $this->test_iname->CurrentValue;
		$this->test_iname->ViewCustomAttributes = "";

		// status_id
		if (strval($this->status_id->CurrentValue) <> "") {
			$sFilterWrk = "`status_id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `status_id`, `status_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
		$sWhereWrk = "";
		$this->status_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// test_image
		$this->test_image->UploadPath = '../../assets/img/testImages';
		if (!ew_Empty($this->test_image->Upload->DbValue)) {
			$this->test_image->ImageWidth = 200;
			$this->test_image->ImageHeight = 0;
			$this->test_image->ImageAlt = $this->test_image->FldAlt();
			$this->test_image->ViewValue = $this->test_image->Upload->DbValue;
		} else {
			$this->test_image->ViewValue = "";
		}
		$this->test_image->ViewCustomAttributes = "";

		// test_price
		$this->test_price->ViewValue = $this->test_price->CurrentValue;
		$this->test_price->ViewCustomAttributes = "";

		// test_desc
		$this->test_desc->ViewValue = $this->test_desc->CurrentValue;
		$this->test_desc->ViewCustomAttributes = "";

		// test_id
		$this->test_id->LinkCustomAttributes = "";
		$this->test_id->HrefValue = "";
		$this->test_id->TooltipValue = "";

		// ntest_id
		$this->ntest_id->LinkCustomAttributes = "";
		$this->ntest_id->HrefValue = "";
		$this->ntest_id->TooltipValue = "";

		// lang_id
		$this->lang_id->LinkCustomAttributes = "";
		$this->lang_id->HrefValue = "";
		$this->lang_id->TooltipValue = "";

		// test_num
		$this->test_num->LinkCustomAttributes = "";
		$this->test_num->HrefValue = "";
		$this->test_num->TooltipValue = "";

		// test_name
		$this->test_name->LinkCustomAttributes = "";
		$this->test_name->HrefValue = "";
		$this->test_name->TooltipValue = "";

		// test_iname
		$this->test_iname->LinkCustomAttributes = "";
		$this->test_iname->HrefValue = "";
		$this->test_iname->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// test_image
		$this->test_image->LinkCustomAttributes = "";
		$this->test_image->UploadPath = '../../assets/img/testImages';
		if (!ew_Empty($this->test_image->Upload->DbValue)) {
			$this->test_image->HrefValue = ew_GetFileUploadUrl($this->test_image, $this->test_image->Upload->DbValue); // Add prefix/suffix
			$this->test_image->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->test_image->HrefValue = ew_FullUrl($this->test_image->HrefValue, "href");
		} else {
			$this->test_image->HrefValue = "";
		}
		$this->test_image->HrefValue2 = $this->test_image->UploadPath . $this->test_image->Upload->DbValue;
		$this->test_image->TooltipValue = "";
		if ($this->test_image->UseColorbox) {
			if (ew_Empty($this->test_image->TooltipValue))
				$this->test_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->test_image->LinkAttrs["data-rel"] = "app_vtest_x_test_image";
			ew_AppendClass($this->test_image->LinkAttrs["class"], "ewLightbox");
		}

		// test_price
		$this->test_price->LinkCustomAttributes = "";
		$this->test_price->HrefValue = "";
		$this->test_price->TooltipValue = "";

		// test_desc
		$this->test_desc->LinkCustomAttributes = "";
		$this->test_desc->HrefValue = "";
		$this->test_desc->TooltipValue = "";

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

		// ntest_id
		$this->ntest_id->EditAttrs["class"] = "form-control";
		$this->ntest_id->EditCustomAttributes = "";
		$this->ntest_id->EditValue = $this->ntest_id->CurrentValue;
		$this->ntest_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->EditAttrs["class"] = "form-control";
		$this->lang_id->EditCustomAttributes = "";

		// test_num
		$this->test_num->EditAttrs["class"] = "form-control";
		$this->test_num->EditCustomAttributes = "";
		$this->test_num->EditValue = $this->test_num->CurrentValue;
		$this->test_num->PlaceHolder = ew_RemoveHtml($this->test_num->FldCaption());

		// test_name
		$this->test_name->EditAttrs["class"] = "form-control";
		$this->test_name->EditCustomAttributes = "";
		$this->test_name->EditValue = $this->test_name->CurrentValue;
		$this->test_name->PlaceHolder = ew_RemoveHtml($this->test_name->FldCaption());

		// test_iname
		$this->test_iname->EditAttrs["class"] = "form-control";
		$this->test_iname->EditCustomAttributes = "";
		$this->test_iname->EditValue = $this->test_iname->CurrentValue;
		$this->test_iname->PlaceHolder = ew_RemoveHtml($this->test_iname->FldCaption());

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// test_image
		$this->test_image->EditAttrs["class"] = "form-control";
		$this->test_image->EditCustomAttributes = "";
		$this->test_image->UploadPath = '../../assets/img/testImages';
		if (!ew_Empty($this->test_image->Upload->DbValue)) {
			$this->test_image->ImageWidth = 200;
			$this->test_image->ImageHeight = 0;
			$this->test_image->ImageAlt = $this->test_image->FldAlt();
			$this->test_image->EditValue = $this->test_image->Upload->DbValue;
		} else {
			$this->test_image->EditValue = "";
		}
		if (!ew_Empty($this->test_image->CurrentValue))
				$this->test_image->Upload->FileName = $this->test_image->CurrentValue;

		// test_price
		$this->test_price->EditAttrs["class"] = "form-control";
		$this->test_price->EditCustomAttributes = "";
		$this->test_price->EditValue = $this->test_price->CurrentValue;
		$this->test_price->PlaceHolder = ew_RemoveHtml($this->test_price->FldCaption());
		if (strval($this->test_price->EditValue) <> "" && is_numeric($this->test_price->EditValue)) $this->test_price->EditValue = ew_FormatNumber($this->test_price->EditValue, -2, -1, -2, 0);

		// test_desc
		$this->test_desc->EditAttrs["class"] = "form-control";
		$this->test_desc->EditCustomAttributes = "";
		$this->test_desc->EditValue = $this->test_desc->CurrentValue;
		$this->test_desc->PlaceHolder = ew_RemoveHtml($this->test_desc->FldCaption());

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
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->test_num->Exportable) $Doc->ExportCaption($this->test_num);
					if ($this->test_name->Exportable) $Doc->ExportCaption($this->test_name);
					if ($this->test_iname->Exportable) $Doc->ExportCaption($this->test_iname);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->test_image->Exportable) $Doc->ExportCaption($this->test_image);
					if ($this->test_price->Exportable) $Doc->ExportCaption($this->test_price);
					if ($this->test_desc->Exportable) $Doc->ExportCaption($this->test_desc);
				} else {
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->test_num->Exportable) $Doc->ExportCaption($this->test_num);
					if ($this->test_name->Exportable) $Doc->ExportCaption($this->test_name);
					if ($this->test_iname->Exportable) $Doc->ExportCaption($this->test_iname);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->test_image->Exportable) $Doc->ExportCaption($this->test_image);
					if ($this->test_price->Exportable) $Doc->ExportCaption($this->test_price);
					if ($this->test_desc->Exportable) $Doc->ExportCaption($this->test_desc);
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
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->test_num->Exportable) $Doc->ExportField($this->test_num);
						if ($this->test_name->Exportable) $Doc->ExportField($this->test_name);
						if ($this->test_iname->Exportable) $Doc->ExportField($this->test_iname);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->test_image->Exportable) $Doc->ExportField($this->test_image);
						if ($this->test_price->Exportable) $Doc->ExportField($this->test_price);
						if ($this->test_desc->Exportable) $Doc->ExportField($this->test_desc);
					} else {
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->test_num->Exportable) $Doc->ExportField($this->test_num);
						if ($this->test_name->Exportable) $Doc->ExportField($this->test_name);
						if ($this->test_iname->Exportable) $Doc->ExportField($this->test_iname);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->test_image->Exportable) $Doc->ExportField($this->test_image);
						if ($this->test_price->Exportable) $Doc->ExportField($this->test_price);
						if ($this->test_desc->Exportable) $Doc->ExportField($this->test_desc);
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
