<?php

// Global variable for table object
$app_book = NULL;

//
// Table class for app_book
//
class capp_book extends cTable {
	var $book_id;
	var $lang_id;
	var $status_id;
	var $book_title;
	var $book_price;
	var $book_image;
	var $book_desc;
	var $ins_datetime;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_book';
		$this->TableName = 'app_book';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`app_book`";
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

		// book_id
		$this->book_id = new cField('app_book', 'app_book', 'x_book_id', 'book_id', '`book_id`', '`book_id`', 3, -1, FALSE, '`book_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->book_id->Sortable = FALSE; // Allow sort
		$this->book_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['book_id'] = &$this->book_id;

		// lang_id
		$this->lang_id = new cField('app_book', 'app_book', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->lang_id->Sortable = TRUE; // Allow sort
		$this->lang_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->lang_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// status_id
		$this->status_id = new cField('app_book', 'app_book', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// book_title
		$this->book_title = new cField('app_book', 'app_book', 'x_book_title', 'book_title', '`book_title`', '`book_title`', 200, -1, FALSE, '`book_title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->book_title->Sortable = TRUE; // Allow sort
		$this->fields['book_title'] = &$this->book_title;

		// book_price
		$this->book_price = new cField('app_book', 'app_book', 'x_book_price', 'book_price', '`book_price`', '`book_price`', 131, -1, FALSE, '`book_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->book_price->Sortable = TRUE; // Allow sort
		$this->book_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['book_price'] = &$this->book_price;

		// book_image
		$this->book_image = new cField('app_book', 'app_book', 'x_book_image', 'book_image', '`book_image`', '`book_image`', 200, -1, TRUE, '`book_image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->book_image->Sortable = TRUE; // Allow sort
		$this->fields['book_image'] = &$this->book_image;

		// book_desc
		$this->book_desc = new cField('app_book', 'app_book', 'x_book_desc', 'book_desc', '`book_desc`', '`book_desc`', 201, -1, FALSE, '`book_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->book_desc->Sortable = TRUE; // Allow sort
		$this->fields['book_desc'] = &$this->book_desc;

		// ins_datetime
		$this->ins_datetime = new cField('app_book', 'app_book', 'x_ins_datetime', 'ins_datetime', '`ins_datetime`', ew_CastDateFieldForLike('`ins_datetime`', 11, "DB"), 135, 11, FALSE, '`ins_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentDetailTable() == "app_book_page") {
			$sDetailUrl = $GLOBALS["app_book_page"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_book_id=" . urlencode($this->book_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "app_booklist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_book`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`lang_id` ASC,`book_title` ASC";
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
			$this->book_id->setDbValue($conn->Insert_ID());
			$rs['book_id'] = $this->book_id->DbValue;
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
			if (array_key_exists('book_id', $rs))
				ew_AddFilter($where, ew_QuotedName('book_id', $this->DBID) . '=' . ew_QuotedValue($rs['book_id'], $this->book_id->FldDataType, $this->DBID));
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
		return "`book_id` = @book_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->book_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->book_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@book_id@", ew_AdjustSql($this->book_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_booklist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_bookview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_bookedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_bookadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_booklist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_bookview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_bookview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_bookadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_bookadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_bookedit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_bookedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("app_bookadd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_bookadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_bookdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "book_id:" . ew_VarToJson($this->book_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->book_id->CurrentValue)) {
			$sUrl .= "book_id=" . urlencode($this->book_id->CurrentValue);
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
			if ($isPost && isset($_POST["book_id"]))
				$arKeys[] = $_POST["book_id"];
			elseif (isset($_GET["book_id"]))
				$arKeys[] = $_GET["book_id"];
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
			$this->book_id->CurrentValue = $key;
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
		$this->book_id->setDbValue($rs->fields('book_id'));
		$this->lang_id->setDbValue($rs->fields('lang_id'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->book_title->setDbValue($rs->fields('book_title'));
		$this->book_price->setDbValue($rs->fields('book_price'));
		$this->book_image->Upload->DbValue = $rs->fields('book_image');
		$this->book_desc->setDbValue($rs->fields('book_desc'));
		$this->ins_datetime->setDbValue($rs->fields('ins_datetime'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// book_id

		$this->book_id->CellCssStyle = "white-space: nowrap;";

		// lang_id
		// status_id
		// book_title
		// book_price
		// book_image
		// book_desc
		// ins_datetime
		// book_id

		$this->book_id->ViewValue = $this->book_id->CurrentValue;
		$this->book_id->ViewCustomAttributes = "";

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

		// book_title
		$this->book_title->ViewValue = $this->book_title->CurrentValue;
		$this->book_title->ViewCustomAttributes = "";

		// book_price
		$this->book_price->ViewValue = $this->book_price->CurrentValue;
		$this->book_price->ViewValue = ew_FormatCurrency($this->book_price->ViewValue, 2, -2, -2, -1);
		$this->book_price->ViewCustomAttributes = "";

		// book_image
		$this->book_image->UploadPath = '../../assets/img/bookImages';
		if (!ew_Empty($this->book_image->Upload->DbValue)) {
			$this->book_image->ImageWidth = 200;
			$this->book_image->ImageHeight = 0;
			$this->book_image->ImageAlt = $this->book_image->FldAlt();
			$this->book_image->ViewValue = $this->book_image->Upload->DbValue;
		} else {
			$this->book_image->ViewValue = "";
		}
		$this->book_image->ViewCustomAttributes = "";

		// book_desc
		$this->book_desc->ViewValue = $this->book_desc->CurrentValue;
		$this->book_desc->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

		// book_id
		$this->book_id->LinkCustomAttributes = "";
		$this->book_id->HrefValue = "";
		$this->book_id->TooltipValue = "";

		// lang_id
		$this->lang_id->LinkCustomAttributes = "";
		$this->lang_id->HrefValue = "";
		$this->lang_id->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// book_title
		$this->book_title->LinkCustomAttributes = "";
		$this->book_title->HrefValue = "";
		$this->book_title->TooltipValue = "";

		// book_price
		$this->book_price->LinkCustomAttributes = "";
		$this->book_price->HrefValue = "";
		$this->book_price->TooltipValue = "";

		// book_image
		$this->book_image->LinkCustomAttributes = "";
		$this->book_image->UploadPath = '../../assets/img/bookImages';
		if (!ew_Empty($this->book_image->Upload->DbValue)) {
			$this->book_image->HrefValue = ew_GetFileUploadUrl($this->book_image, $this->book_image->Upload->DbValue); // Add prefix/suffix
			$this->book_image->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->book_image->HrefValue = ew_FullUrl($this->book_image->HrefValue, "href");
		} else {
			$this->book_image->HrefValue = "";
		}
		$this->book_image->HrefValue2 = $this->book_image->UploadPath . $this->book_image->Upload->DbValue;
		$this->book_image->TooltipValue = "";
		if ($this->book_image->UseColorbox) {
			if (ew_Empty($this->book_image->TooltipValue))
				$this->book_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->book_image->LinkAttrs["data-rel"] = "app_book_x_book_image";
			ew_AppendClass($this->book_image->LinkAttrs["class"], "ewLightbox");
		}

		// book_desc
		$this->book_desc->LinkCustomAttributes = "";
		$this->book_desc->HrefValue = "";
		$this->book_desc->TooltipValue = "";

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

		// book_id
		$this->book_id->EditAttrs["class"] = "form-control";
		$this->book_id->EditCustomAttributes = "";
		$this->book_id->EditValue = $this->book_id->CurrentValue;
		$this->book_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->EditAttrs["class"] = "form-control";
		$this->lang_id->EditCustomAttributes = "";

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// book_title
		$this->book_title->EditAttrs["class"] = "form-control";
		$this->book_title->EditCustomAttributes = "";
		$this->book_title->EditValue = $this->book_title->CurrentValue;
		$this->book_title->PlaceHolder = ew_RemoveHtml($this->book_title->FldCaption());

		// book_price
		$this->book_price->EditAttrs["class"] = "form-control";
		$this->book_price->EditCustomAttributes = "";
		$this->book_price->EditValue = $this->book_price->CurrentValue;
		$this->book_price->PlaceHolder = ew_RemoveHtml($this->book_price->FldCaption());
		if (strval($this->book_price->EditValue) <> "" && is_numeric($this->book_price->EditValue)) $this->book_price->EditValue = ew_FormatNumber($this->book_price->EditValue, -2, -2, -2, -1);

		// book_image
		$this->book_image->EditAttrs["class"] = "form-control";
		$this->book_image->EditCustomAttributes = "";
		$this->book_image->UploadPath = '../../assets/img/bookImages';
		if (!ew_Empty($this->book_image->Upload->DbValue)) {
			$this->book_image->ImageWidth = 200;
			$this->book_image->ImageHeight = 0;
			$this->book_image->ImageAlt = $this->book_image->FldAlt();
			$this->book_image->EditValue = $this->book_image->Upload->DbValue;
		} else {
			$this->book_image->EditValue = "";
		}
		if (!ew_Empty($this->book_image->CurrentValue))
				$this->book_image->Upload->FileName = $this->book_image->CurrentValue;

		// book_desc
		$this->book_desc->EditAttrs["class"] = "form-control";
		$this->book_desc->EditCustomAttributes = "";
		$this->book_desc->EditValue = $this->book_desc->CurrentValue;
		$this->book_desc->PlaceHolder = ew_RemoveHtml($this->book_desc->FldCaption());

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
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->book_title->Exportable) $Doc->ExportCaption($this->book_title);
					if ($this->book_price->Exportable) $Doc->ExportCaption($this->book_price);
					if ($this->book_image->Exportable) $Doc->ExportCaption($this->book_image);
					if ($this->book_desc->Exportable) $Doc->ExportCaption($this->book_desc);
					if ($this->ins_datetime->Exportable) $Doc->ExportCaption($this->ins_datetime);
				} else {
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->book_title->Exportable) $Doc->ExportCaption($this->book_title);
					if ($this->book_price->Exportable) $Doc->ExportCaption($this->book_price);
					if ($this->book_image->Exportable) $Doc->ExportCaption($this->book_image);
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
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->book_title->Exportable) $Doc->ExportField($this->book_title);
						if ($this->book_price->Exportable) $Doc->ExportField($this->book_price);
						if ($this->book_image->Exportable) $Doc->ExportField($this->book_image);
						if ($this->book_desc->Exportable) $Doc->ExportField($this->book_desc);
						if ($this->ins_datetime->Exportable) $Doc->ExportField($this->ins_datetime);
					} else {
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->book_title->Exportable) $Doc->ExportField($this->book_title);
						if ($this->book_price->Exportable) $Doc->ExportField($this->book_price);
						if ($this->book_image->Exportable) $Doc->ExportField($this->book_image);
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
