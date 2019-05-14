<?php

// Global variable for table object
$cpy_slider_trn = NULL;

//
// Table class for cpy_slider_trn
//
class ccpy_slider_trn extends cTable {
	var $tslid_id;
	var $slid_id;
	var $slid_order;
	var $slid_header;
	var $slid_link;
	var $slid_label;
	var $slid_photo;
	var $slid_text;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cpy_slider_trn';
		$this->TableName = 'cpy_slider_trn';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cpy_slider_trn`";
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

		// tslid_id
		$this->tslid_id = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_tslid_id', 'tslid_id', '`tslid_id`', '`tslid_id`', 3, -1, FALSE, '`tslid_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->tslid_id->Sortable = FALSE; // Allow sort
		$this->tslid_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tslid_id'] = &$this->tslid_id;

		// slid_id
		$this->slid_id = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_id', 'slid_id', '`slid_id`', '`slid_id`', 3, -1, FALSE, '`slid_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->slid_id->Sortable = TRUE; // Allow sort
		$this->slid_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->slid_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->slid_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['slid_id'] = &$this->slid_id;

		// slid_order
		$this->slid_order = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_order', 'slid_order', '`slid_order`', '`slid_order`', 2, -1, FALSE, '`slid_order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slid_order->Sortable = TRUE; // Allow sort
		$this->slid_order->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['slid_order'] = &$this->slid_order;

		// slid_header
		$this->slid_header = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_header', 'slid_header', '`slid_header`', '`slid_header`', 200, -1, FALSE, '`slid_header`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slid_header->Sortable = TRUE; // Allow sort
		$this->fields['slid_header'] = &$this->slid_header;

		// slid_link
		$this->slid_link = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_link', 'slid_link', '`slid_link`', '`slid_link`', 200, -1, FALSE, '`slid_link`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slid_link->Sortable = TRUE; // Allow sort
		$this->fields['slid_link'] = &$this->slid_link;

		// slid_label
		$this->slid_label = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_label', 'slid_label', '`slid_label`', '`slid_label`', 200, -1, FALSE, '`slid_label`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slid_label->Sortable = TRUE; // Allow sort
		$this->fields['slid_label'] = &$this->slid_label;

		// slid_photo
		$this->slid_photo = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_photo', 'slid_photo', '`slid_photo`', '`slid_photo`', 200, -1, TRUE, '`slid_photo`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->slid_photo->Sortable = TRUE; // Allow sort
		$this->fields['slid_photo'] = &$this->slid_photo;

		// slid_text
		$this->slid_text = new cField('cpy_slider_trn', 'cpy_slider_trn', 'x_slid_text', 'slid_text', '`slid_text`', '`slid_text`', 201, -1, FALSE, '`slid_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->slid_text->Sortable = TRUE; // Allow sort
		$this->fields['slid_text'] = &$this->slid_text;
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
		if ($this->getCurrentMasterTable() == "cpy_slider_mst") {
			if ($this->slid_id->getSessionValue() <> "")
				$sMasterFilter .= "`slid_id`=" . ew_QuotedValue($this->slid_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cpy_slider_mst") {
			if ($this->slid_id->getSessionValue() <> "")
				$sDetailFilter .= "`slid_id`=" . ew_QuotedValue($this->slid_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cpy_slider_mst() {
		return "`slid_id`=@slid_id@";
	}

	// Detail filter
	function SqlDetailFilter_cpy_slider_mst() {
		return "`slid_id`=@slid_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cpy_slider_trn`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`slid_id` ASC,`slid_order` ASC,`tslid_id` ASC";
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
			$this->tslid_id->setDbValue($conn->Insert_ID());
			$rs['tslid_id'] = $this->tslid_id->DbValue;
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
			if (array_key_exists('tslid_id', $rs))
				ew_AddFilter($where, ew_QuotedName('tslid_id', $this->DBID) . '=' . ew_QuotedValue($rs['tslid_id'], $this->tslid_id->FldDataType, $this->DBID));
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
		return "`tslid_id` = @tslid_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->tslid_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->tslid_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@tslid_id@", ew_AdjustSql($this->tslid_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cpy_slider_trnlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "cpy_slider_trnview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "cpy_slider_trnedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "cpy_slider_trnadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "cpy_slider_trnlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("cpy_slider_trnview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("cpy_slider_trnview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "cpy_slider_trnadd.php?" . $this->UrlParm($parm);
		else
			$url = "cpy_slider_trnadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("cpy_slider_trnedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("cpy_slider_trnadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cpy_slider_trndelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "cpy_slider_mst" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_slid_id=" . urlencode($this->slid_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "tslid_id:" . ew_VarToJson($this->tslid_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->tslid_id->CurrentValue)) {
			$sUrl .= "tslid_id=" . urlencode($this->tslid_id->CurrentValue);
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
			if ($isPost && isset($_POST["tslid_id"]))
				$arKeys[] = $_POST["tslid_id"];
			elseif (isset($_GET["tslid_id"]))
				$arKeys[] = $_GET["tslid_id"];
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
			$this->tslid_id->CurrentValue = $key;
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
		$this->tslid_id->setDbValue($rs->fields('tslid_id'));
		$this->slid_id->setDbValue($rs->fields('slid_id'));
		$this->slid_order->setDbValue($rs->fields('slid_order'));
		$this->slid_header->setDbValue($rs->fields('slid_header'));
		$this->slid_link->setDbValue($rs->fields('slid_link'));
		$this->slid_label->setDbValue($rs->fields('slid_label'));
		$this->slid_photo->Upload->DbValue = $rs->fields('slid_photo');
		$this->slid_text->setDbValue($rs->fields('slid_text'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// tslid_id

		$this->tslid_id->CellCssStyle = "white-space: nowrap;";

		// slid_id
		// slid_order
		// slid_header
		// slid_link
		// slid_label
		// slid_photo
		// slid_text
		// tslid_id

		$this->tslid_id->ViewValue = $this->tslid_id->CurrentValue;
		$this->tslid_id->ViewCustomAttributes = "";

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

		// slid_order
		$this->slid_order->ViewValue = $this->slid_order->CurrentValue;
		$this->slid_order->ViewCustomAttributes = "";

		// slid_header
		$this->slid_header->ViewValue = $this->slid_header->CurrentValue;
		$this->slid_header->ViewCustomAttributes = "";

		// slid_link
		$this->slid_link->ViewValue = $this->slid_link->CurrentValue;
		$this->slid_link->ViewCustomAttributes = "";

		// slid_label
		$this->slid_label->ViewValue = $this->slid_label->CurrentValue;
		$this->slid_label->ViewCustomAttributes = "";

		// slid_photo
		$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
		if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
			$this->slid_photo->ImageWidth = 200;
			$this->slid_photo->ImageHeight = 0;
			$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
			$this->slid_photo->ViewValue = $this->slid_photo->Upload->DbValue;
		} else {
			$this->slid_photo->ViewValue = "";
		}
		$this->slid_photo->ViewCustomAttributes = "";

		// slid_text
		$this->slid_text->ViewValue = $this->slid_text->CurrentValue;
		$this->slid_text->ViewCustomAttributes = "";

		// tslid_id
		$this->tslid_id->LinkCustomAttributes = "";
		$this->tslid_id->HrefValue = "";
		$this->tslid_id->TooltipValue = "";

		// slid_id
		$this->slid_id->LinkCustomAttributes = "";
		$this->slid_id->HrefValue = "";
		$this->slid_id->TooltipValue = "";

		// slid_order
		$this->slid_order->LinkCustomAttributes = "";
		$this->slid_order->HrefValue = "";
		$this->slid_order->TooltipValue = "";

		// slid_header
		$this->slid_header->LinkCustomAttributes = "";
		$this->slid_header->HrefValue = "";
		$this->slid_header->TooltipValue = "";

		// slid_link
		$this->slid_link->LinkCustomAttributes = "";
		$this->slid_link->HrefValue = "";
		$this->slid_link->TooltipValue = "";

		// slid_label
		$this->slid_label->LinkCustomAttributes = "";
		$this->slid_label->HrefValue = "";
		$this->slid_label->TooltipValue = "";

		// slid_photo
		$this->slid_photo->LinkCustomAttributes = "";
		$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
		if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
			$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
			$this->slid_photo->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
		} else {
			$this->slid_photo->HrefValue = "";
		}
		$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;
		$this->slid_photo->TooltipValue = "";
		if ($this->slid_photo->UseColorbox) {
			if (ew_Empty($this->slid_photo->TooltipValue))
				$this->slid_photo->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->slid_photo->LinkAttrs["data-rel"] = "cpy_slider_trn_x_slid_photo";
			ew_AppendClass($this->slid_photo->LinkAttrs["class"], "ewLightbox");
		}

		// slid_text
		$this->slid_text->LinkCustomAttributes = "";
		$this->slid_text->HrefValue = "";
		$this->slid_text->TooltipValue = "";

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

		// tslid_id
		$this->tslid_id->EditAttrs["class"] = "form-control";
		$this->tslid_id->EditCustomAttributes = "";
		$this->tslid_id->EditValue = $this->tslid_id->CurrentValue;
		$this->tslid_id->ViewCustomAttributes = "";

		// slid_id
		$this->slid_id->EditAttrs["class"] = "form-control";
		$this->slid_id->EditCustomAttributes = "";
		if ($this->slid_id->getSessionValue() <> "") {
			$this->slid_id->CurrentValue = $this->slid_id->getSessionValue();
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
		} else {
		}

		// slid_order
		$this->slid_order->EditAttrs["class"] = "form-control";
		$this->slid_order->EditCustomAttributes = "";
		$this->slid_order->EditValue = $this->slid_order->CurrentValue;
		$this->slid_order->PlaceHolder = ew_RemoveHtml($this->slid_order->FldCaption());

		// slid_header
		$this->slid_header->EditAttrs["class"] = "form-control";
		$this->slid_header->EditCustomAttributes = "";
		$this->slid_header->EditValue = $this->slid_header->CurrentValue;
		$this->slid_header->PlaceHolder = ew_RemoveHtml($this->slid_header->FldCaption());

		// slid_link
		$this->slid_link->EditAttrs["class"] = "form-control";
		$this->slid_link->EditCustomAttributes = "";
		$this->slid_link->EditValue = $this->slid_link->CurrentValue;
		$this->slid_link->PlaceHolder = ew_RemoveHtml($this->slid_link->FldCaption());

		// slid_label
		$this->slid_label->EditAttrs["class"] = "form-control";
		$this->slid_label->EditCustomAttributes = "";
		$this->slid_label->EditValue = $this->slid_label->CurrentValue;
		$this->slid_label->PlaceHolder = ew_RemoveHtml($this->slid_label->FldCaption());

		// slid_photo
		$this->slid_photo->EditAttrs["class"] = "form-control";
		$this->slid_photo->EditCustomAttributes = "";
		$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
		if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
			$this->slid_photo->ImageWidth = 200;
			$this->slid_photo->ImageHeight = 0;
			$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
			$this->slid_photo->EditValue = $this->slid_photo->Upload->DbValue;
		} else {
			$this->slid_photo->EditValue = "";
		}
		if (!ew_Empty($this->slid_photo->CurrentValue))
				$this->slid_photo->Upload->FileName = $this->slid_photo->CurrentValue;

		// slid_text
		$this->slid_text->EditAttrs["class"] = "form-control";
		$this->slid_text->EditCustomAttributes = "";
		$this->slid_text->EditValue = $this->slid_text->CurrentValue;
		$this->slid_text->PlaceHolder = ew_RemoveHtml($this->slid_text->FldCaption());

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
					if ($this->slid_id->Exportable) $Doc->ExportCaption($this->slid_id);
					if ($this->slid_order->Exportable) $Doc->ExportCaption($this->slid_order);
					if ($this->slid_header->Exportable) $Doc->ExportCaption($this->slid_header);
					if ($this->slid_link->Exportable) $Doc->ExportCaption($this->slid_link);
					if ($this->slid_label->Exportable) $Doc->ExportCaption($this->slid_label);
					if ($this->slid_photo->Exportable) $Doc->ExportCaption($this->slid_photo);
					if ($this->slid_text->Exportable) $Doc->ExportCaption($this->slid_text);
				} else {
					if ($this->slid_id->Exportable) $Doc->ExportCaption($this->slid_id);
					if ($this->slid_order->Exportable) $Doc->ExportCaption($this->slid_order);
					if ($this->slid_header->Exportable) $Doc->ExportCaption($this->slid_header);
					if ($this->slid_link->Exportable) $Doc->ExportCaption($this->slid_link);
					if ($this->slid_label->Exportable) $Doc->ExportCaption($this->slid_label);
					if ($this->slid_photo->Exportable) $Doc->ExportCaption($this->slid_photo);
					if ($this->slid_text->Exportable) $Doc->ExportCaption($this->slid_text);
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
						if ($this->slid_id->Exportable) $Doc->ExportField($this->slid_id);
						if ($this->slid_order->Exportable) $Doc->ExportField($this->slid_order);
						if ($this->slid_header->Exportable) $Doc->ExportField($this->slid_header);
						if ($this->slid_link->Exportable) $Doc->ExportField($this->slid_link);
						if ($this->slid_label->Exportable) $Doc->ExportField($this->slid_label);
						if ($this->slid_photo->Exportable) $Doc->ExportField($this->slid_photo);
						if ($this->slid_text->Exportable) $Doc->ExportField($this->slid_text);
					} else {
						if ($this->slid_id->Exportable) $Doc->ExportField($this->slid_id);
						if ($this->slid_order->Exportable) $Doc->ExportField($this->slid_order);
						if ($this->slid_header->Exportable) $Doc->ExportField($this->slid_header);
						if ($this->slid_link->Exportable) $Doc->ExportField($this->slid_link);
						if ($this->slid_label->Exportable) $Doc->ExportField($this->slid_label);
						if ($this->slid_photo->Exportable) $Doc->ExportField($this->slid_photo);
						if ($this->slid_text->Exportable) $Doc->ExportField($this->slid_text);
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
