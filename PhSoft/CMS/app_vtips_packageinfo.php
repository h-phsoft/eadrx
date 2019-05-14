<?php

// Global variable for table object
$app_vtips_package = NULL;

//
// Table class for app_vtips_package
//
class capp_vtips_package extends cTable {
	var $pkg_id;
	var $tcat_id;
	var $cycle_id;
	var $tpkg_id;
	var $cycle_desc;
	var $pkg_name;
	var $status_id;
	var $tcat_name;
	var $cycle_name;
	var $pkg_price;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_vtips_package';
		$this->TableName = 'app_vtips_package';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`app_vtips_package`";
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

		// pkg_id
		$this->pkg_id = new cField('app_vtips_package', 'app_vtips_package', 'x_pkg_id', 'pkg_id', '`pkg_id`', '`pkg_id`', 3, -1, FALSE, '`pkg_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->pkg_id->Sortable = FALSE; // Allow sort
		$this->pkg_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pkg_id'] = &$this->pkg_id;

		// tcat_id
		$this->tcat_id = new cField('app_vtips_package', 'app_vtips_package', 'x_tcat_id', 'tcat_id', '`tcat_id`', '`tcat_id`', 3, -1, FALSE, '`tcat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->tcat_id->Sortable = FALSE; // Allow sort
		$this->tcat_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tcat_id'] = &$this->tcat_id;

		// cycle_id
		$this->cycle_id = new cField('app_vtips_package', 'app_vtips_package', 'x_cycle_id', 'cycle_id', '`cycle_id`', '`cycle_id`', 2, -1, FALSE, '`cycle_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->cycle_id->Sortable = FALSE; // Allow sort
		$this->cycle_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cycle_id'] = &$this->cycle_id;

		// tpkg_id
		$this->tpkg_id = new cField('app_vtips_package', 'app_vtips_package', 'x_tpkg_id', 'tpkg_id', '`tpkg_id`', '`tpkg_id`', 3, -1, FALSE, '`tpkg_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->tpkg_id->Sortable = FALSE; // Allow sort
		$this->tpkg_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tpkg_id'] = &$this->tpkg_id;

		// cycle_desc
		$this->cycle_desc = new cField('app_vtips_package', 'app_vtips_package', 'x_cycle_desc', 'cycle_desc', '`cycle_desc`', '`cycle_desc`', 200, -1, FALSE, '`cycle_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cycle_desc->Sortable = FALSE; // Allow sort
		$this->fields['cycle_desc'] = &$this->cycle_desc;

		// pkg_name
		$this->pkg_name = new cField('app_vtips_package', 'app_vtips_package', 'x_pkg_name', 'pkg_name', '`pkg_name`', '`pkg_name`', 200, -1, FALSE, '`pkg_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pkg_name->Sortable = TRUE; // Allow sort
		$this->fields['pkg_name'] = &$this->pkg_name;

		// status_id
		$this->status_id = new cField('app_vtips_package', 'app_vtips_package', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// tcat_name
		$this->tcat_name = new cField('app_vtips_package', 'app_vtips_package', 'x_tcat_name', 'tcat_name', '`tcat_name`', '`tcat_name`', 200, -1, FALSE, '`tcat_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tcat_name->Sortable = TRUE; // Allow sort
		$this->fields['tcat_name'] = &$this->tcat_name;

		// cycle_name
		$this->cycle_name = new cField('app_vtips_package', 'app_vtips_package', 'x_cycle_name', 'cycle_name', '`cycle_name`', '`cycle_name`', 200, -1, FALSE, '`cycle_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cycle_name->Sortable = TRUE; // Allow sort
		$this->fields['cycle_name'] = &$this->cycle_name;

		// pkg_price
		$this->pkg_price = new cField('app_vtips_package', 'app_vtips_package', 'x_pkg_price', 'pkg_price', '`pkg_price`', '`pkg_price`', 131, -1, FALSE, '`pkg_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pkg_price->Sortable = TRUE; // Allow sort
		$this->pkg_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pkg_price'] = &$this->pkg_price;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_vtips_package`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`cycle_name` ASC,`pkg_name` ASC,`tcat_name` ASC";
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
			$this->pkg_id->setDbValue($conn->Insert_ID());
			$rs['pkg_id'] = $this->pkg_id->DbValue;

			// Get insert id if necessary
			$this->tcat_id->setDbValue($conn->Insert_ID());
			$rs['tcat_id'] = $this->tcat_id->DbValue;

			// Get insert id if necessary
			$this->cycle_id->setDbValue($conn->Insert_ID());
			$rs['cycle_id'] = $this->cycle_id->DbValue;

			// Get insert id if necessary
			$this->tpkg_id->setDbValue($conn->Insert_ID());
			$rs['tpkg_id'] = $this->tpkg_id->DbValue;
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
			if (array_key_exists('pkg_id', $rs))
				ew_AddFilter($where, ew_QuotedName('pkg_id', $this->DBID) . '=' . ew_QuotedValue($rs['pkg_id'], $this->pkg_id->FldDataType, $this->DBID));
			if (array_key_exists('tcat_id', $rs))
				ew_AddFilter($where, ew_QuotedName('tcat_id', $this->DBID) . '=' . ew_QuotedValue($rs['tcat_id'], $this->tcat_id->FldDataType, $this->DBID));
			if (array_key_exists('cycle_id', $rs))
				ew_AddFilter($where, ew_QuotedName('cycle_id', $this->DBID) . '=' . ew_QuotedValue($rs['cycle_id'], $this->cycle_id->FldDataType, $this->DBID));
			if (array_key_exists('tpkg_id', $rs))
				ew_AddFilter($where, ew_QuotedName('tpkg_id', $this->DBID) . '=' . ew_QuotedValue($rs['tpkg_id'], $this->tpkg_id->FldDataType, $this->DBID));
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
		return "`pkg_id` = @pkg_id@ AND `tcat_id` = @tcat_id@ AND `cycle_id` = @cycle_id@ AND `tpkg_id` = @tpkg_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->pkg_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->pkg_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@pkg_id@", ew_AdjustSql($this->pkg_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->tcat_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->tcat_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@tcat_id@", ew_AdjustSql($this->tcat_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->cycle_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->cycle_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@cycle_id@", ew_AdjustSql($this->cycle_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->tpkg_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->tpkg_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@tpkg_id@", ew_AdjustSql($this->tpkg_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_vtips_packagelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_vtips_packageview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_vtips_packageedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_vtips_packageadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_vtips_packagelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_vtips_packageview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_vtips_packageview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_vtips_packageadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_vtips_packageadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("app_vtips_packageedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("app_vtips_packageadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_vtips_packagedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "pkg_id:" . ew_VarToJson($this->pkg_id->CurrentValue, "number", "'");
		$json .= ",tcat_id:" . ew_VarToJson($this->tcat_id->CurrentValue, "number", "'");
		$json .= ",cycle_id:" . ew_VarToJson($this->cycle_id->CurrentValue, "number", "'");
		$json .= ",tpkg_id:" . ew_VarToJson($this->tpkg_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->pkg_id->CurrentValue)) {
			$sUrl .= "pkg_id=" . urlencode($this->pkg_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->tcat_id->CurrentValue)) {
			$sUrl .= "&tcat_id=" . urlencode($this->tcat_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->cycle_id->CurrentValue)) {
			$sUrl .= "&cycle_id=" . urlencode($this->cycle_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->tpkg_id->CurrentValue)) {
			$sUrl .= "&tpkg_id=" . urlencode($this->tpkg_id->CurrentValue);
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
			if ($isPost && isset($_POST["pkg_id"]))
				$arKey[] = $_POST["pkg_id"];
			elseif (isset($_GET["pkg_id"]))
				$arKey[] = $_GET["pkg_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["tcat_id"]))
				$arKey[] = $_POST["tcat_id"];
			elseif (isset($_GET["tcat_id"]))
				$arKey[] = $_GET["tcat_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["cycle_id"]))
				$arKey[] = $_POST["cycle_id"];
			elseif (isset($_GET["cycle_id"]))
				$arKey[] = $_GET["cycle_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["tpkg_id"]))
				$arKey[] = $_POST["tpkg_id"];
			elseif (isset($_GET["tpkg_id"]))
				$arKey[] = $_GET["tpkg_id"];
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 4)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // pkg_id
					continue;
				if (!is_numeric($key[1])) // tcat_id
					continue;
				if (!is_numeric($key[2])) // cycle_id
					continue;
				if (!is_numeric($key[3])) // tpkg_id
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
			$this->pkg_id->CurrentValue = $key[0];
			$this->tcat_id->CurrentValue = $key[1];
			$this->cycle_id->CurrentValue = $key[2];
			$this->tpkg_id->CurrentValue = $key[3];
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
		$this->pkg_id->setDbValue($rs->fields('pkg_id'));
		$this->tcat_id->setDbValue($rs->fields('tcat_id'));
		$this->cycle_id->setDbValue($rs->fields('cycle_id'));
		$this->tpkg_id->setDbValue($rs->fields('tpkg_id'));
		$this->cycle_desc->setDbValue($rs->fields('cycle_desc'));
		$this->pkg_name->setDbValue($rs->fields('pkg_name'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->tcat_name->setDbValue($rs->fields('tcat_name'));
		$this->cycle_name->setDbValue($rs->fields('cycle_name'));
		$this->pkg_price->setDbValue($rs->fields('pkg_price'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// pkg_id

		$this->pkg_id->CellCssStyle = "white-space: nowrap;";

		// tcat_id
		$this->tcat_id->CellCssStyle = "white-space: nowrap;";

		// cycle_id
		$this->cycle_id->CellCssStyle = "white-space: nowrap;";

		// tpkg_id
		$this->tpkg_id->CellCssStyle = "white-space: nowrap;";

		// cycle_desc
		$this->cycle_desc->CellCssStyle = "white-space: nowrap;";

		// pkg_name
		// status_id
		// tcat_name
		// cycle_name
		// pkg_price
		// pkg_id

		$this->pkg_id->ViewValue = $this->pkg_id->CurrentValue;
		$this->pkg_id->ViewCustomAttributes = "";

		// tcat_id
		$this->tcat_id->ViewValue = $this->tcat_id->CurrentValue;
		$this->tcat_id->ViewCustomAttributes = "";

		// cycle_id
		$this->cycle_id->ViewValue = $this->cycle_id->CurrentValue;
		$this->cycle_id->ViewCustomAttributes = "";

		// tpkg_id
		$this->tpkg_id->ViewValue = $this->tpkg_id->CurrentValue;
		$this->tpkg_id->ViewCustomAttributes = "";

		// cycle_desc
		$this->cycle_desc->ViewValue = $this->cycle_desc->CurrentValue;
		$this->cycle_desc->ViewCustomAttributes = "";

		// pkg_name
		$this->pkg_name->ViewValue = $this->pkg_name->CurrentValue;
		$this->pkg_name->ViewCustomAttributes = "";

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

		// tcat_name
		$this->tcat_name->ViewValue = $this->tcat_name->CurrentValue;
		$this->tcat_name->ViewCustomAttributes = "";

		// cycle_name
		$this->cycle_name->ViewValue = $this->cycle_name->CurrentValue;
		$this->cycle_name->ViewCustomAttributes = "";

		// pkg_price
		$this->pkg_price->ViewValue = $this->pkg_price->CurrentValue;
		$this->pkg_price->ViewCustomAttributes = "";

		// pkg_id
		$this->pkg_id->LinkCustomAttributes = "";
		$this->pkg_id->HrefValue = "";
		$this->pkg_id->TooltipValue = "";

		// tcat_id
		$this->tcat_id->LinkCustomAttributes = "";
		$this->tcat_id->HrefValue = "";
		$this->tcat_id->TooltipValue = "";

		// cycle_id
		$this->cycle_id->LinkCustomAttributes = "";
		$this->cycle_id->HrefValue = "";
		$this->cycle_id->TooltipValue = "";

		// tpkg_id
		$this->tpkg_id->LinkCustomAttributes = "";
		$this->tpkg_id->HrefValue = "";
		$this->tpkg_id->TooltipValue = "";

		// cycle_desc
		$this->cycle_desc->LinkCustomAttributes = "";
		$this->cycle_desc->HrefValue = "";
		$this->cycle_desc->TooltipValue = "";

		// pkg_name
		$this->pkg_name->LinkCustomAttributes = "";
		$this->pkg_name->HrefValue = "";
		$this->pkg_name->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// tcat_name
		$this->tcat_name->LinkCustomAttributes = "";
		$this->tcat_name->HrefValue = "";
		$this->tcat_name->TooltipValue = "";

		// cycle_name
		$this->cycle_name->LinkCustomAttributes = "";
		$this->cycle_name->HrefValue = "";
		$this->cycle_name->TooltipValue = "";

		// pkg_price
		$this->pkg_price->LinkCustomAttributes = "";
		$this->pkg_price->HrefValue = "";
		$this->pkg_price->TooltipValue = "";

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

		// pkg_id
		$this->pkg_id->EditAttrs["class"] = "form-control";
		$this->pkg_id->EditCustomAttributes = "";
		$this->pkg_id->EditValue = $this->pkg_id->CurrentValue;
		$this->pkg_id->ViewCustomAttributes = "";

		// tcat_id
		$this->tcat_id->EditAttrs["class"] = "form-control";
		$this->tcat_id->EditCustomAttributes = "";
		$this->tcat_id->EditValue = $this->tcat_id->CurrentValue;
		$this->tcat_id->ViewCustomAttributes = "";

		// cycle_id
		$this->cycle_id->EditAttrs["class"] = "form-control";
		$this->cycle_id->EditCustomAttributes = "";
		$this->cycle_id->EditValue = $this->cycle_id->CurrentValue;
		$this->cycle_id->ViewCustomAttributes = "";

		// tpkg_id
		$this->tpkg_id->EditAttrs["class"] = "form-control";
		$this->tpkg_id->EditCustomAttributes = "";
		$this->tpkg_id->EditValue = $this->tpkg_id->CurrentValue;
		$this->tpkg_id->ViewCustomAttributes = "";

		// cycle_desc
		$this->cycle_desc->EditAttrs["class"] = "form-control";
		$this->cycle_desc->EditCustomAttributes = "";
		$this->cycle_desc->EditValue = $this->cycle_desc->CurrentValue;
		$this->cycle_desc->PlaceHolder = ew_RemoveHtml($this->cycle_desc->FldCaption());

		// pkg_name
		$this->pkg_name->EditAttrs["class"] = "form-control";
		$this->pkg_name->EditCustomAttributes = "";
		$this->pkg_name->EditValue = $this->pkg_name->CurrentValue;
		$this->pkg_name->PlaceHolder = ew_RemoveHtml($this->pkg_name->FldCaption());

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// tcat_name
		$this->tcat_name->EditAttrs["class"] = "form-control";
		$this->tcat_name->EditCustomAttributes = "";
		$this->tcat_name->EditValue = $this->tcat_name->CurrentValue;
		$this->tcat_name->PlaceHolder = ew_RemoveHtml($this->tcat_name->FldCaption());

		// cycle_name
		$this->cycle_name->EditAttrs["class"] = "form-control";
		$this->cycle_name->EditCustomAttributes = "";
		$this->cycle_name->EditValue = $this->cycle_name->CurrentValue;
		$this->cycle_name->PlaceHolder = ew_RemoveHtml($this->cycle_name->FldCaption());

		// pkg_price
		$this->pkg_price->EditAttrs["class"] = "form-control";
		$this->pkg_price->EditCustomAttributes = "";
		$this->pkg_price->EditValue = $this->pkg_price->CurrentValue;
		$this->pkg_price->PlaceHolder = ew_RemoveHtml($this->pkg_price->FldCaption());
		if (strval($this->pkg_price->EditValue) <> "" && is_numeric($this->pkg_price->EditValue)) $this->pkg_price->EditValue = ew_FormatNumber($this->pkg_price->EditValue, -2, -1, -2, 0);

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
					if ($this->pkg_name->Exportable) $Doc->ExportCaption($this->pkg_name);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->tcat_name->Exportable) $Doc->ExportCaption($this->tcat_name);
					if ($this->cycle_name->Exportable) $Doc->ExportCaption($this->cycle_name);
					if ($this->pkg_price->Exportable) $Doc->ExportCaption($this->pkg_price);
				} else {
					if ($this->pkg_name->Exportable) $Doc->ExportCaption($this->pkg_name);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->tcat_name->Exportable) $Doc->ExportCaption($this->tcat_name);
					if ($this->cycle_name->Exportable) $Doc->ExportCaption($this->cycle_name);
					if ($this->pkg_price->Exportable) $Doc->ExportCaption($this->pkg_price);
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
						if ($this->pkg_name->Exportable) $Doc->ExportField($this->pkg_name);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->tcat_name->Exportable) $Doc->ExportField($this->tcat_name);
						if ($this->cycle_name->Exportable) $Doc->ExportField($this->cycle_name);
						if ($this->pkg_price->Exportable) $Doc->ExportField($this->pkg_price);
					} else {
						if ($this->pkg_name->Exportable) $Doc->ExportField($this->pkg_name);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->tcat_name->Exportable) $Doc->ExportField($this->tcat_name);
						if ($this->cycle_name->Exportable) $Doc->ExportField($this->cycle_name);
						if ($this->pkg_price->Exportable) $Doc->ExportField($this->pkg_price);
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
