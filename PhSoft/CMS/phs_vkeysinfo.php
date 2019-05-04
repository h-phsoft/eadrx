<?php

// Global variable for table object
$phs_vkeys = NULL;

//
// Table class for phs_vkeys
//
class cphs_vkeys extends cTable {
	var $key_id;
	var $key_name;
	var $key_defvalue;
	var $lang_id;
	var $lang_name;
	var $lang_dir;
	var $status_id;
	var $lang_code;
	var $kval_id;
	var $key_value;
	var $key_rvalue;
	var $key_text;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'phs_vkeys';
		$this->TableName = 'phs_vkeys';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`phs_vkeys`";
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

		// key_id
		$this->key_id = new cField('phs_vkeys', 'phs_vkeys', 'x_key_id', 'key_id', '`key_id`', '`key_id`', 3, -1, FALSE, '`key_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->key_id->Sortable = FALSE; // Allow sort
		$this->key_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['key_id'] = &$this->key_id;

		// key_name
		$this->key_name = new cField('phs_vkeys', 'phs_vkeys', 'x_key_name', 'key_name', '`key_name`', '`key_name`', 200, -1, FALSE, '`key_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->key_name->Sortable = TRUE; // Allow sort
		$this->fields['key_name'] = &$this->key_name;

		// key_defvalue
		$this->key_defvalue = new cField('phs_vkeys', 'phs_vkeys', 'x_key_defvalue', 'key_defvalue', '`key_defvalue`', '`key_defvalue`', 200, -1, FALSE, '`key_defvalue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->key_defvalue->Sortable = TRUE; // Allow sort
		$this->fields['key_defvalue'] = &$this->key_defvalue;

		// lang_id
		$this->lang_id = new cField('phs_vkeys', 'phs_vkeys', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->lang_id->Sortable = FALSE; // Allow sort
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// lang_name
		$this->lang_name = new cField('phs_vkeys', 'phs_vkeys', 'x_lang_name', 'lang_name', '`lang_name`', '`lang_name`', 200, -1, FALSE, '`lang_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_name->Sortable = TRUE; // Allow sort
		$this->fields['lang_name'] = &$this->lang_name;

		// lang_dir
		$this->lang_dir = new cField('phs_vkeys', 'phs_vkeys', 'x_lang_dir', 'lang_dir', '`lang_dir`', '`lang_dir`', 200, -1, FALSE, '`lang_dir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_dir->Sortable = FALSE; // Allow sort
		$this->fields['lang_dir'] = &$this->lang_dir;

		// status_id
		$this->status_id = new cField('phs_vkeys', 'phs_vkeys', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_id->Sortable = FALSE; // Allow sort
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// lang_code
		$this->lang_code = new cField('phs_vkeys', 'phs_vkeys', 'x_lang_code', 'lang_code', '`lang_code`', '`lang_code`', 200, -1, FALSE, '`lang_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_code->Sortable = FALSE; // Allow sort
		$this->fields['lang_code'] = &$this->lang_code;

		// kval_id
		$this->kval_id = new cField('phs_vkeys', 'phs_vkeys', 'x_kval_id', 'kval_id', '`kval_id`', '`kval_id`', 3, -1, FALSE, '`kval_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->kval_id->Sortable = FALSE; // Allow sort
		$this->kval_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['kval_id'] = &$this->kval_id;

		// key_value
		$this->key_value = new cField('phs_vkeys', 'phs_vkeys', 'x_key_value', 'key_value', '`key_value`', '`key_value`', 200, -1, FALSE, '`key_value`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->key_value->Sortable = TRUE; // Allow sort
		$this->fields['key_value'] = &$this->key_value;

		// key_rvalue
		$this->key_rvalue = new cField('phs_vkeys', 'phs_vkeys', 'x_key_rvalue', 'key_rvalue', '`key_rvalue`', '`key_rvalue`', 200, -1, FALSE, '`key_rvalue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->key_rvalue->Sortable = TRUE; // Allow sort
		$this->fields['key_rvalue'] = &$this->key_rvalue;

		// key_text
		$this->key_text = new cField('phs_vkeys', 'phs_vkeys', 'x_key_text', 'key_text', '`key_text`', '`key_text`', 201, -1, FALSE, '`key_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->key_text->Sortable = TRUE; // Allow sort
		$this->fields['key_text'] = &$this->key_text;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`phs_vkeys`";
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
			$this->key_id->setDbValue($conn->Insert_ID());
			$rs['key_id'] = $this->key_id->DbValue;

			// Get insert id if necessary
			$this->lang_id->setDbValue($conn->Insert_ID());
			$rs['lang_id'] = $this->lang_id->DbValue;

			// Get insert id if necessary
			$this->kval_id->setDbValue($conn->Insert_ID());
			$rs['kval_id'] = $this->kval_id->DbValue;
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
			if (array_key_exists('key_id', $rs))
				ew_AddFilter($where, ew_QuotedName('key_id', $this->DBID) . '=' . ew_QuotedValue($rs['key_id'], $this->key_id->FldDataType, $this->DBID));
			if (array_key_exists('lang_id', $rs))
				ew_AddFilter($where, ew_QuotedName('lang_id', $this->DBID) . '=' . ew_QuotedValue($rs['lang_id'], $this->lang_id->FldDataType, $this->DBID));
			if (array_key_exists('kval_id', $rs))
				ew_AddFilter($where, ew_QuotedName('kval_id', $this->DBID) . '=' . ew_QuotedValue($rs['kval_id'], $this->kval_id->FldDataType, $this->DBID));
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
		return "`key_id` = @key_id@ AND `lang_id` = @lang_id@ AND `kval_id` = @kval_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->key_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->key_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@key_id@", ew_AdjustSql($this->key_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->lang_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->lang_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@lang_id@", ew_AdjustSql($this->lang_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->kval_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->kval_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@kval_id@", ew_AdjustSql($this->kval_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "phs_vkeyslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "phs_vkeysview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "phs_vkeysedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "phs_vkeysadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "phs_vkeyslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("phs_vkeysview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("phs_vkeysview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "phs_vkeysadd.php?" . $this->UrlParm($parm);
		else
			$url = "phs_vkeysadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("phs_vkeysedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("phs_vkeysadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("phs_vkeysdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "key_id:" . ew_VarToJson($this->key_id->CurrentValue, "number", "'");
		$json .= ",lang_id:" . ew_VarToJson($this->lang_id->CurrentValue, "number", "'");
		$json .= ",kval_id:" . ew_VarToJson($this->kval_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->key_id->CurrentValue)) {
			$sUrl .= "key_id=" . urlencode($this->key_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->lang_id->CurrentValue)) {
			$sUrl .= "&lang_id=" . urlencode($this->lang_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->kval_id->CurrentValue)) {
			$sUrl .= "&kval_id=" . urlencode($this->kval_id->CurrentValue);
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
			if ($isPost && isset($_POST["key_id"]))
				$arKey[] = $_POST["key_id"];
			elseif (isset($_GET["key_id"]))
				$arKey[] = $_GET["key_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["lang_id"]))
				$arKey[] = $_POST["lang_id"];
			elseif (isset($_GET["lang_id"]))
				$arKey[] = $_GET["lang_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["kval_id"]))
				$arKey[] = $_POST["kval_id"];
			elseif (isset($_GET["kval_id"]))
				$arKey[] = $_GET["kval_id"];
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
				if (!is_numeric($key[0])) // key_id
					continue;
				if (!is_numeric($key[1])) // lang_id
					continue;
				if (!is_numeric($key[2])) // kval_id
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
			$this->key_id->CurrentValue = $key[0];
			$this->lang_id->CurrentValue = $key[1];
			$this->kval_id->CurrentValue = $key[2];
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
		$this->key_id->setDbValue($rs->fields('key_id'));
		$this->key_name->setDbValue($rs->fields('key_name'));
		$this->key_defvalue->setDbValue($rs->fields('key_defvalue'));
		$this->lang_id->setDbValue($rs->fields('lang_id'));
		$this->lang_name->setDbValue($rs->fields('lang_name'));
		$this->lang_dir->setDbValue($rs->fields('lang_dir'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->lang_code->setDbValue($rs->fields('lang_code'));
		$this->kval_id->setDbValue($rs->fields('kval_id'));
		$this->key_value->setDbValue($rs->fields('key_value'));
		$this->key_rvalue->setDbValue($rs->fields('key_rvalue'));
		$this->key_text->setDbValue($rs->fields('key_text'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// key_id

		$this->key_id->CellCssStyle = "white-space: nowrap;";

		// key_name
		// key_defvalue
		// lang_id

		$this->lang_id->CellCssStyle = "white-space: nowrap;";

		// lang_name
		// lang_dir

		$this->lang_dir->CellCssStyle = "white-space: nowrap;";

		// status_id
		$this->status_id->CellCssStyle = "white-space: nowrap;";

		// lang_code
		$this->lang_code->CellCssStyle = "white-space: nowrap;";

		// kval_id
		$this->kval_id->CellCssStyle = "white-space: nowrap;";

		// key_value
		// key_rvalue
		// key_text
		// key_id

		$this->key_id->ViewValue = $this->key_id->CurrentValue;
		$this->key_id->ViewCustomAttributes = "";

		// key_name
		$this->key_name->ViewValue = $this->key_name->CurrentValue;
		$this->key_name->ViewCustomAttributes = "";

		// key_defvalue
		$this->key_defvalue->ViewValue = $this->key_defvalue->CurrentValue;
		$this->key_defvalue->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->ViewValue = $this->lang_id->CurrentValue;
		$this->lang_id->ViewCustomAttributes = "";

		// lang_name
		$this->lang_name->ViewValue = $this->lang_name->CurrentValue;
		$this->lang_name->ViewCustomAttributes = "";

		// lang_dir
		$this->lang_dir->ViewValue = $this->lang_dir->CurrentValue;
		$this->lang_dir->ViewCustomAttributes = "";

		// status_id
		$this->status_id->ViewValue = $this->status_id->CurrentValue;
		$this->status_id->ViewCustomAttributes = "";

		// lang_code
		$this->lang_code->ViewValue = $this->lang_code->CurrentValue;
		$this->lang_code->ViewCustomAttributes = "";

		// kval_id
		$this->kval_id->ViewValue = $this->kval_id->CurrentValue;
		$this->kval_id->ViewCustomAttributes = "";

		// key_value
		$this->key_value->ViewValue = $this->key_value->CurrentValue;
		$this->key_value->ViewCustomAttributes = "";

		// key_rvalue
		$this->key_rvalue->ViewValue = $this->key_rvalue->CurrentValue;
		$this->key_rvalue->ViewCustomAttributes = "";

		// key_text
		$this->key_text->ViewValue = $this->key_text->CurrentValue;
		$this->key_text->ViewCustomAttributes = "";

		// key_id
		$this->key_id->LinkCustomAttributes = "";
		$this->key_id->HrefValue = "";
		$this->key_id->TooltipValue = "";

		// key_name
		$this->key_name->LinkCustomAttributes = "";
		$this->key_name->HrefValue = "";
		$this->key_name->TooltipValue = "";

		// key_defvalue
		$this->key_defvalue->LinkCustomAttributes = "";
		$this->key_defvalue->HrefValue = "";
		$this->key_defvalue->TooltipValue = "";

		// lang_id
		$this->lang_id->LinkCustomAttributes = "";
		$this->lang_id->HrefValue = "";
		$this->lang_id->TooltipValue = "";

		// lang_name
		$this->lang_name->LinkCustomAttributes = "";
		$this->lang_name->HrefValue = "";
		$this->lang_name->TooltipValue = "";

		// lang_dir
		$this->lang_dir->LinkCustomAttributes = "";
		$this->lang_dir->HrefValue = "";
		$this->lang_dir->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// lang_code
		$this->lang_code->LinkCustomAttributes = "";
		$this->lang_code->HrefValue = "";
		$this->lang_code->TooltipValue = "";

		// kval_id
		$this->kval_id->LinkCustomAttributes = "";
		$this->kval_id->HrefValue = "";
		$this->kval_id->TooltipValue = "";

		// key_value
		$this->key_value->LinkCustomAttributes = "";
		$this->key_value->HrefValue = "";
		$this->key_value->TooltipValue = "";

		// key_rvalue
		$this->key_rvalue->LinkCustomAttributes = "";
		$this->key_rvalue->HrefValue = "";
		$this->key_rvalue->TooltipValue = "";

		// key_text
		$this->key_text->LinkCustomAttributes = "";
		$this->key_text->HrefValue = "";
		$this->key_text->TooltipValue = "";

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

		// key_id
		$this->key_id->EditAttrs["class"] = "form-control";
		$this->key_id->EditCustomAttributes = "";
		$this->key_id->EditValue = $this->key_id->CurrentValue;
		$this->key_id->ViewCustomAttributes = "";

		// key_name
		$this->key_name->EditAttrs["class"] = "form-control";
		$this->key_name->EditCustomAttributes = "";
		$this->key_name->EditValue = $this->key_name->CurrentValue;
		$this->key_name->PlaceHolder = ew_RemoveHtml($this->key_name->FldCaption());

		// key_defvalue
		$this->key_defvalue->EditAttrs["class"] = "form-control";
		$this->key_defvalue->EditCustomAttributes = "";
		$this->key_defvalue->EditValue = $this->key_defvalue->CurrentValue;
		$this->key_defvalue->PlaceHolder = ew_RemoveHtml($this->key_defvalue->FldCaption());

		// lang_id
		$this->lang_id->EditAttrs["class"] = "form-control";
		$this->lang_id->EditCustomAttributes = "";
		$this->lang_id->EditValue = $this->lang_id->CurrentValue;
		$this->lang_id->ViewCustomAttributes = "";

		// lang_name
		$this->lang_name->EditAttrs["class"] = "form-control";
		$this->lang_name->EditCustomAttributes = "";
		$this->lang_name->EditValue = $this->lang_name->CurrentValue;
		$this->lang_name->PlaceHolder = ew_RemoveHtml($this->lang_name->FldCaption());

		// lang_dir
		$this->lang_dir->EditAttrs["class"] = "form-control";
		$this->lang_dir->EditCustomAttributes = "";
		$this->lang_dir->EditValue = $this->lang_dir->CurrentValue;
		$this->lang_dir->PlaceHolder = ew_RemoveHtml($this->lang_dir->FldCaption());

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";
		$this->status_id->EditValue = $this->status_id->CurrentValue;
		$this->status_id->PlaceHolder = ew_RemoveHtml($this->status_id->FldCaption());

		// lang_code
		$this->lang_code->EditAttrs["class"] = "form-control";
		$this->lang_code->EditCustomAttributes = "";
		$this->lang_code->EditValue = $this->lang_code->CurrentValue;
		$this->lang_code->PlaceHolder = ew_RemoveHtml($this->lang_code->FldCaption());

		// kval_id
		$this->kval_id->EditAttrs["class"] = "form-control";
		$this->kval_id->EditCustomAttributes = "";
		$this->kval_id->EditValue = $this->kval_id->CurrentValue;
		$this->kval_id->ViewCustomAttributes = "";

		// key_value
		$this->key_value->EditAttrs["class"] = "form-control";
		$this->key_value->EditCustomAttributes = "";
		$this->key_value->EditValue = $this->key_value->CurrentValue;
		$this->key_value->PlaceHolder = ew_RemoveHtml($this->key_value->FldCaption());

		// key_rvalue
		$this->key_rvalue->EditAttrs["class"] = "form-control";
		$this->key_rvalue->EditCustomAttributes = "";
		$this->key_rvalue->EditValue = $this->key_rvalue->CurrentValue;
		$this->key_rvalue->PlaceHolder = ew_RemoveHtml($this->key_rvalue->FldCaption());

		// key_text
		$this->key_text->EditAttrs["class"] = "form-control";
		$this->key_text->EditCustomAttributes = "";
		$this->key_text->EditValue = $this->key_text->CurrentValue;
		$this->key_text->PlaceHolder = ew_RemoveHtml($this->key_text->FldCaption());

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
					if ($this->key_name->Exportable) $Doc->ExportCaption($this->key_name);
					if ($this->key_defvalue->Exportable) $Doc->ExportCaption($this->key_defvalue);
					if ($this->lang_name->Exportable) $Doc->ExportCaption($this->lang_name);
					if ($this->key_value->Exportable) $Doc->ExportCaption($this->key_value);
					if ($this->key_rvalue->Exportable) $Doc->ExportCaption($this->key_rvalue);
					if ($this->key_text->Exportable) $Doc->ExportCaption($this->key_text);
				} else {
					if ($this->key_name->Exportable) $Doc->ExportCaption($this->key_name);
					if ($this->key_defvalue->Exportable) $Doc->ExportCaption($this->key_defvalue);
					if ($this->lang_name->Exportable) $Doc->ExportCaption($this->lang_name);
					if ($this->key_value->Exportable) $Doc->ExportCaption($this->key_value);
					if ($this->key_rvalue->Exportable) $Doc->ExportCaption($this->key_rvalue);
					if ($this->key_text->Exportable) $Doc->ExportCaption($this->key_text);
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
						if ($this->key_name->Exportable) $Doc->ExportField($this->key_name);
						if ($this->key_defvalue->Exportable) $Doc->ExportField($this->key_defvalue);
						if ($this->lang_name->Exportable) $Doc->ExportField($this->lang_name);
						if ($this->key_value->Exportable) $Doc->ExportField($this->key_value);
						if ($this->key_rvalue->Exportable) $Doc->ExportField($this->key_rvalue);
						if ($this->key_text->Exportable) $Doc->ExportField($this->key_text);
					} else {
						if ($this->key_name->Exportable) $Doc->ExportField($this->key_name);
						if ($this->key_defvalue->Exportable) $Doc->ExportField($this->key_defvalue);
						if ($this->lang_name->Exportable) $Doc->ExportField($this->lang_name);
						if ($this->key_value->Exportable) $Doc->ExportField($this->key_value);
						if ($this->key_rvalue->Exportable) $Doc->ExportField($this->key_rvalue);
						if ($this->key_text->Exportable) $Doc->ExportField($this->key_text);
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
