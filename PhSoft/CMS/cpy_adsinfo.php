<?php

// Global variable for table object
$cpy_ads = NULL;

//
// Table class for cpy_ads
//
class ccpy_ads extends cTable {
	var $ads_id;
	var $status_id;
	var $repeat_id;
	var $every_id;
	var $ads_title;
	var $ads_desc;
	var $ads_sdate;
	var $ads_edate;
	var $hour_sid;
	var $hour_eid;
	var $ads_image;
	var $ads_text;
	var $ins_datetime;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cpy_ads';
		$this->TableName = 'cpy_ads';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cpy_ads`";
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

		// ads_id
		$this->ads_id = new cField('cpy_ads', 'cpy_ads', 'x_ads_id', 'ads_id', '`ads_id`', '`ads_id`', 3, -1, FALSE, '`ads_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ads_id->Sortable = FALSE; // Allow sort
		$this->ads_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ads_id'] = &$this->ads_id;

		// status_id
		$this->status_id = new cField('cpy_ads', 'cpy_ads', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// repeat_id
		$this->repeat_id = new cField('cpy_ads', 'cpy_ads', 'x_repeat_id', 'repeat_id', '`repeat_id`', '`repeat_id`', 16, -1, FALSE, '`repeat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->repeat_id->Sortable = TRUE; // Allow sort
		$this->repeat_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->repeat_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->repeat_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['repeat_id'] = &$this->repeat_id;

		// every_id
		$this->every_id = new cField('cpy_ads', 'cpy_ads', 'x_every_id', 'every_id', '`every_id`', '`every_id`', 16, -1, FALSE, '`every_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->every_id->Sortable = TRUE; // Allow sort
		$this->every_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->every_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->every_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['every_id'] = &$this->every_id;

		// ads_title
		$this->ads_title = new cField('cpy_ads', 'cpy_ads', 'x_ads_title', 'ads_title', '`ads_title`', '`ads_title`', 200, -1, FALSE, '`ads_title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ads_title->Sortable = TRUE; // Allow sort
		$this->fields['ads_title'] = &$this->ads_title;

		// ads_desc
		$this->ads_desc = new cField('cpy_ads', 'cpy_ads', 'x_ads_desc', 'ads_desc', '`ads_desc`', '`ads_desc`', 200, -1, FALSE, '`ads_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ads_desc->Sortable = TRUE; // Allow sort
		$this->fields['ads_desc'] = &$this->ads_desc;

		// ads_sdate
		$this->ads_sdate = new cField('cpy_ads', 'cpy_ads', 'x_ads_sdate', 'ads_sdate', '`ads_sdate`', ew_CastDateFieldForLike('`ads_sdate`', 0, "DB"), 133, 0, FALSE, '`ads_sdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ads_sdate->Sortable = TRUE; // Allow sort
		$this->ads_sdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ads_sdate'] = &$this->ads_sdate;

		// ads_edate
		$this->ads_edate = new cField('cpy_ads', 'cpy_ads', 'x_ads_edate', 'ads_edate', '`ads_edate`', ew_CastDateFieldForLike('`ads_edate`', 0, "DB"), 133, 0, FALSE, '`ads_edate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ads_edate->Sortable = TRUE; // Allow sort
		$this->ads_edate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ads_edate'] = &$this->ads_edate;

		// hour_sid
		$this->hour_sid = new cField('cpy_ads', 'cpy_ads', 'x_hour_sid', 'hour_sid', '`hour_sid`', '`hour_sid`', 16, -1, FALSE, '`hour_sid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->hour_sid->Sortable = TRUE; // Allow sort
		$this->hour_sid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->hour_sid->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->hour_sid->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['hour_sid'] = &$this->hour_sid;

		// hour_eid
		$this->hour_eid = new cField('cpy_ads', 'cpy_ads', 'x_hour_eid', 'hour_eid', '`hour_eid`', '`hour_eid`', 16, -1, FALSE, '`hour_eid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->hour_eid->Sortable = TRUE; // Allow sort
		$this->hour_eid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->hour_eid->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->hour_eid->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['hour_eid'] = &$this->hour_eid;

		// ads_image
		$this->ads_image = new cField('cpy_ads', 'cpy_ads', 'x_ads_image', 'ads_image', '`ads_image`', '`ads_image`', 200, -1, TRUE, '`ads_image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->ads_image->Sortable = TRUE; // Allow sort
		$this->fields['ads_image'] = &$this->ads_image;

		// ads_text
		$this->ads_text = new cField('cpy_ads', 'cpy_ads', 'x_ads_text', 'ads_text', '`ads_text`', '`ads_text`', 201, -1, FALSE, '`ads_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ads_text->Sortable = TRUE; // Allow sort
		$this->fields['ads_text'] = &$this->ads_text;

		// ins_datetime
		$this->ins_datetime = new cField('cpy_ads', 'cpy_ads', 'x_ins_datetime', 'ins_datetime', '`ins_datetime`', ew_CastDateFieldForLike('`ins_datetime`', 11, "DB"), 135, 11, FALSE, '`ins_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ins_datetime->Sortable = TRUE; // Allow sort
		$this->ins_datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
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

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cpy_ads`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`ads_sdate` DESC,`ads_edate` DESC,`hour_sid` ASC,`hour_eid` ASC,`repeat_id` ASC,`every_id` ASC";
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
			$this->ads_id->setDbValue($conn->Insert_ID());
			$rs['ads_id'] = $this->ads_id->DbValue;
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
			if (array_key_exists('ads_id', $rs))
				ew_AddFilter($where, ew_QuotedName('ads_id', $this->DBID) . '=' . ew_QuotedValue($rs['ads_id'], $this->ads_id->FldDataType, $this->DBID));
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
		return "`ads_id` = @ads_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ads_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->ads_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@ads_id@", ew_AdjustSql($this->ads_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cpy_adslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "cpy_adsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "cpy_adsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "cpy_adsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "cpy_adslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("cpy_adsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("cpy_adsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "cpy_adsadd.php?" . $this->UrlParm($parm);
		else
			$url = "cpy_adsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("cpy_adsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("cpy_adsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cpy_adsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "ads_id:" . ew_VarToJson($this->ads_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ads_id->CurrentValue)) {
			$sUrl .= "ads_id=" . urlencode($this->ads_id->CurrentValue);
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
			if ($isPost && isset($_POST["ads_id"]))
				$arKeys[] = $_POST["ads_id"];
			elseif (isset($_GET["ads_id"]))
				$arKeys[] = $_GET["ads_id"];
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
			$this->ads_id->CurrentValue = $key;
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
		$this->ads_id->setDbValue($rs->fields('ads_id'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->repeat_id->setDbValue($rs->fields('repeat_id'));
		$this->every_id->setDbValue($rs->fields('every_id'));
		$this->ads_title->setDbValue($rs->fields('ads_title'));
		$this->ads_desc->setDbValue($rs->fields('ads_desc'));
		$this->ads_sdate->setDbValue($rs->fields('ads_sdate'));
		$this->ads_edate->setDbValue($rs->fields('ads_edate'));
		$this->hour_sid->setDbValue($rs->fields('hour_sid'));
		$this->hour_eid->setDbValue($rs->fields('hour_eid'));
		$this->ads_image->Upload->DbValue = $rs->fields('ads_image');
		$this->ads_text->setDbValue($rs->fields('ads_text'));
		$this->ins_datetime->setDbValue($rs->fields('ins_datetime'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// ads_id

		$this->ads_id->CellCssStyle = "white-space: nowrap;";

		// status_id
		// repeat_id
		// every_id
		// ads_title
		// ads_desc
		// ads_sdate
		// ads_edate
		// hour_sid
		// hour_eid
		// ads_image
		// ads_text
		// ins_datetime
		// ads_id

		$this->ads_id->ViewValue = $this->ads_id->CurrentValue;
		$this->ads_id->ViewCustomAttributes = "";

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

		// repeat_id
		if (strval($this->repeat_id->CurrentValue) <> "") {
			$sFilterWrk = "`repeat_id`" . ew_SearchString("=", $this->repeat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `repeat_id`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_repeat`";
		$sWhereWrk = "";
		$this->repeat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `repeat_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->repeat_id->ViewValue = $this->repeat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->repeat_id->ViewValue = $this->repeat_id->CurrentValue;
			}
		} else {
			$this->repeat_id->ViewValue = NULL;
		}
		$this->repeat_id->ViewCustomAttributes = "";

		// every_id
		if (strval($this->every_id->CurrentValue) <> "") {
			$sFilterWrk = "`every_id`" . ew_SearchString("=", $this->every_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `every_id`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_every`";
		$sWhereWrk = "";
		$this->every_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `every_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->every_id->ViewValue = $this->every_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->every_id->ViewValue = $this->every_id->CurrentValue;
			}
		} else {
			$this->every_id->ViewValue = NULL;
		}
		$this->every_id->ViewCustomAttributes = "";

		// ads_title
		$this->ads_title->ViewValue = $this->ads_title->CurrentValue;
		$this->ads_title->ViewCustomAttributes = "";

		// ads_desc
		$this->ads_desc->ViewValue = $this->ads_desc->CurrentValue;
		$this->ads_desc->ViewCustomAttributes = "";

		// ads_sdate
		$this->ads_sdate->ViewValue = $this->ads_sdate->CurrentValue;
		$this->ads_sdate->ViewValue = ew_FormatDateTime($this->ads_sdate->ViewValue, 0);
		$this->ads_sdate->ViewCustomAttributes = "";

		// ads_edate
		$this->ads_edate->ViewValue = $this->ads_edate->CurrentValue;
		$this->ads_edate->ViewValue = ew_FormatDateTime($this->ads_edate->ViewValue, 0);
		$this->ads_edate->ViewCustomAttributes = "";

		// hour_sid
		if (strval($this->hour_sid->CurrentValue) <> "") {
			$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_sid->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
		$sWhereWrk = "";
		$this->hour_sid->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->hour_sid->ViewValue = $this->hour_sid->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->hour_sid->ViewValue = $this->hour_sid->CurrentValue;
			}
		} else {
			$this->hour_sid->ViewValue = NULL;
		}
		$this->hour_sid->ViewCustomAttributes = "";

		// hour_eid
		if (strval($this->hour_eid->CurrentValue) <> "") {
			$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_eid->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
		$sWhereWrk = "";
		$this->hour_eid->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->hour_eid->ViewValue = $this->hour_eid->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->hour_eid->ViewValue = $this->hour_eid->CurrentValue;
			}
		} else {
			$this->hour_eid->ViewValue = NULL;
		}
		$this->hour_eid->ViewCustomAttributes = "";

		// ads_image
		$this->ads_image->UploadPath = '../../assets/img/adsImages';
		if (!ew_Empty($this->ads_image->Upload->DbValue)) {
			$this->ads_image->ImageWidth = 200;
			$this->ads_image->ImageHeight = 0;
			$this->ads_image->ImageAlt = $this->ads_image->FldAlt();
			$this->ads_image->ViewValue = $this->ads_image->Upload->DbValue;
		} else {
			$this->ads_image->ViewValue = "";
		}
		$this->ads_image->ViewCustomAttributes = "";

		// ads_text
		$this->ads_text->ViewValue = $this->ads_text->CurrentValue;
		$this->ads_text->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

		// ads_id
		$this->ads_id->LinkCustomAttributes = "";
		$this->ads_id->HrefValue = "";
		$this->ads_id->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// repeat_id
		$this->repeat_id->LinkCustomAttributes = "";
		$this->repeat_id->HrefValue = "";
		$this->repeat_id->TooltipValue = "";

		// every_id
		$this->every_id->LinkCustomAttributes = "";
		$this->every_id->HrefValue = "";
		$this->every_id->TooltipValue = "";

		// ads_title
		$this->ads_title->LinkCustomAttributes = "";
		$this->ads_title->HrefValue = "";
		$this->ads_title->TooltipValue = "";

		// ads_desc
		$this->ads_desc->LinkCustomAttributes = "";
		$this->ads_desc->HrefValue = "";
		$this->ads_desc->TooltipValue = "";

		// ads_sdate
		$this->ads_sdate->LinkCustomAttributes = "";
		$this->ads_sdate->HrefValue = "";
		$this->ads_sdate->TooltipValue = "";

		// ads_edate
		$this->ads_edate->LinkCustomAttributes = "";
		$this->ads_edate->HrefValue = "";
		$this->ads_edate->TooltipValue = "";

		// hour_sid
		$this->hour_sid->LinkCustomAttributes = "";
		$this->hour_sid->HrefValue = "";
		$this->hour_sid->TooltipValue = "";

		// hour_eid
		$this->hour_eid->LinkCustomAttributes = "";
		$this->hour_eid->HrefValue = "";
		$this->hour_eid->TooltipValue = "";

		// ads_image
		$this->ads_image->LinkCustomAttributes = "";
		$this->ads_image->UploadPath = '../../assets/img/adsImages';
		if (!ew_Empty($this->ads_image->Upload->DbValue)) {
			$this->ads_image->HrefValue = ew_GetFileUploadUrl($this->ads_image, $this->ads_image->Upload->DbValue); // Add prefix/suffix
			$this->ads_image->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->ads_image->HrefValue = ew_FullUrl($this->ads_image->HrefValue, "href");
		} else {
			$this->ads_image->HrefValue = "";
		}
		$this->ads_image->HrefValue2 = $this->ads_image->UploadPath . $this->ads_image->Upload->DbValue;
		$this->ads_image->TooltipValue = "";
		if ($this->ads_image->UseColorbox) {
			if (ew_Empty($this->ads_image->TooltipValue))
				$this->ads_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->ads_image->LinkAttrs["data-rel"] = "cpy_ads_x_ads_image";
			ew_AppendClass($this->ads_image->LinkAttrs["class"], "ewLightbox");
		}

		// ads_text
		$this->ads_text->LinkCustomAttributes = "";
		$this->ads_text->HrefValue = "";
		$this->ads_text->TooltipValue = "";

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

		// ads_id
		$this->ads_id->EditAttrs["class"] = "form-control";
		$this->ads_id->EditCustomAttributes = "";
		$this->ads_id->EditValue = $this->ads_id->CurrentValue;
		$this->ads_id->ViewCustomAttributes = "";

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// repeat_id
		$this->repeat_id->EditAttrs["class"] = "form-control";
		$this->repeat_id->EditCustomAttributes = "";

		// every_id
		$this->every_id->EditAttrs["class"] = "form-control";
		$this->every_id->EditCustomAttributes = "";

		// ads_title
		$this->ads_title->EditAttrs["class"] = "form-control";
		$this->ads_title->EditCustomAttributes = "";
		$this->ads_title->EditValue = $this->ads_title->CurrentValue;
		$this->ads_title->PlaceHolder = ew_RemoveHtml($this->ads_title->FldCaption());

		// ads_desc
		$this->ads_desc->EditAttrs["class"] = "form-control";
		$this->ads_desc->EditCustomAttributes = "";
		$this->ads_desc->EditValue = $this->ads_desc->CurrentValue;
		$this->ads_desc->PlaceHolder = ew_RemoveHtml($this->ads_desc->FldCaption());

		// ads_sdate
		$this->ads_sdate->EditAttrs["class"] = "form-control";
		$this->ads_sdate->EditCustomAttributes = "";
		$this->ads_sdate->EditValue = ew_FormatDateTime($this->ads_sdate->CurrentValue, 8);
		$this->ads_sdate->PlaceHolder = ew_RemoveHtml($this->ads_sdate->FldCaption());

		// ads_edate
		$this->ads_edate->EditAttrs["class"] = "form-control";
		$this->ads_edate->EditCustomAttributes = "";
		$this->ads_edate->EditValue = ew_FormatDateTime($this->ads_edate->CurrentValue, 8);
		$this->ads_edate->PlaceHolder = ew_RemoveHtml($this->ads_edate->FldCaption());

		// hour_sid
		$this->hour_sid->EditAttrs["class"] = "form-control";
		$this->hour_sid->EditCustomAttributes = "";

		// hour_eid
		$this->hour_eid->EditAttrs["class"] = "form-control";
		$this->hour_eid->EditCustomAttributes = "";

		// ads_image
		$this->ads_image->EditAttrs["class"] = "form-control";
		$this->ads_image->EditCustomAttributes = "";
		$this->ads_image->UploadPath = '../../assets/img/adsImages';
		if (!ew_Empty($this->ads_image->Upload->DbValue)) {
			$this->ads_image->ImageWidth = 200;
			$this->ads_image->ImageHeight = 0;
			$this->ads_image->ImageAlt = $this->ads_image->FldAlt();
			$this->ads_image->EditValue = $this->ads_image->Upload->DbValue;
		} else {
			$this->ads_image->EditValue = "";
		}
		if (!ew_Empty($this->ads_image->CurrentValue))
				$this->ads_image->Upload->FileName = $this->ads_image->CurrentValue;

		// ads_text
		$this->ads_text->EditAttrs["class"] = "form-control";
		$this->ads_text->EditCustomAttributes = "";
		$this->ads_text->EditValue = $this->ads_text->CurrentValue;
		$this->ads_text->PlaceHolder = ew_RemoveHtml($this->ads_text->FldCaption());

		// ins_datetime
		$this->ins_datetime->EditAttrs["class"] = "form-control";
		$this->ins_datetime->EditCustomAttributes = "";
		$this->ins_datetime->EditValue = ew_FormatDateTime($this->ins_datetime->CurrentValue, 11);
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
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->repeat_id->Exportable) $Doc->ExportCaption($this->repeat_id);
					if ($this->every_id->Exportable) $Doc->ExportCaption($this->every_id);
					if ($this->ads_title->Exportable) $Doc->ExportCaption($this->ads_title);
					if ($this->ads_desc->Exportable) $Doc->ExportCaption($this->ads_desc);
					if ($this->ads_sdate->Exportable) $Doc->ExportCaption($this->ads_sdate);
					if ($this->ads_edate->Exportable) $Doc->ExportCaption($this->ads_edate);
					if ($this->hour_sid->Exportable) $Doc->ExportCaption($this->hour_sid);
					if ($this->hour_eid->Exportable) $Doc->ExportCaption($this->hour_eid);
					if ($this->ads_image->Exportable) $Doc->ExportCaption($this->ads_image);
					if ($this->ads_text->Exportable) $Doc->ExportCaption($this->ads_text);
					if ($this->ins_datetime->Exportable) $Doc->ExportCaption($this->ins_datetime);
				} else {
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->repeat_id->Exportable) $Doc->ExportCaption($this->repeat_id);
					if ($this->every_id->Exportable) $Doc->ExportCaption($this->every_id);
					if ($this->ads_title->Exportable) $Doc->ExportCaption($this->ads_title);
					if ($this->ads_desc->Exportable) $Doc->ExportCaption($this->ads_desc);
					if ($this->ads_sdate->Exportable) $Doc->ExportCaption($this->ads_sdate);
					if ($this->ads_edate->Exportable) $Doc->ExportCaption($this->ads_edate);
					if ($this->hour_sid->Exportable) $Doc->ExportCaption($this->hour_sid);
					if ($this->hour_eid->Exportable) $Doc->ExportCaption($this->hour_eid);
					if ($this->ads_image->Exportable) $Doc->ExportCaption($this->ads_image);
					if ($this->ads_text->Exportable) $Doc->ExportCaption($this->ads_text);
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
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->repeat_id->Exportable) $Doc->ExportField($this->repeat_id);
						if ($this->every_id->Exportable) $Doc->ExportField($this->every_id);
						if ($this->ads_title->Exportable) $Doc->ExportField($this->ads_title);
						if ($this->ads_desc->Exportable) $Doc->ExportField($this->ads_desc);
						if ($this->ads_sdate->Exportable) $Doc->ExportField($this->ads_sdate);
						if ($this->ads_edate->Exportable) $Doc->ExportField($this->ads_edate);
						if ($this->hour_sid->Exportable) $Doc->ExportField($this->hour_sid);
						if ($this->hour_eid->Exportable) $Doc->ExportField($this->hour_eid);
						if ($this->ads_image->Exportable) $Doc->ExportField($this->ads_image);
						if ($this->ads_text->Exportable) $Doc->ExportField($this->ads_text);
						if ($this->ins_datetime->Exportable) $Doc->ExportField($this->ins_datetime);
					} else {
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->repeat_id->Exportable) $Doc->ExportField($this->repeat_id);
						if ($this->every_id->Exportable) $Doc->ExportField($this->every_id);
						if ($this->ads_title->Exportable) $Doc->ExportField($this->ads_title);
						if ($this->ads_desc->Exportable) $Doc->ExportField($this->ads_desc);
						if ($this->ads_sdate->Exportable) $Doc->ExportField($this->ads_sdate);
						if ($this->ads_edate->Exportable) $Doc->ExportField($this->ads_edate);
						if ($this->hour_sid->Exportable) $Doc->ExportField($this->hour_sid);
						if ($this->hour_eid->Exportable) $Doc->ExportField($this->hour_eid);
						if ($this->ads_image->Exportable) $Doc->ExportField($this->ads_image);
						if ($this->ads_text->Exportable) $Doc->ExportField($this->ads_text);
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
