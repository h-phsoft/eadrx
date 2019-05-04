<?php

// Global variable for table object
$app_vbook = NULL;

//
// Table class for app_vbook
//
class capp_vbook extends cTable {
	var $book_id;
	var $lang_id;
	var $status_id;
	var $book_title;
	var $book_desc;
	var $book_image;
	var $book_price;
	var $ins_datetime;
	var $bpage_id;
	var $page_num;
	var $page_image;
	var $page_text;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'app_vbook';
		$this->TableName = 'app_vbook';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`app_vbook`";
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
		$this->book_id = new cField('app_vbook', 'app_vbook', 'x_book_id', 'book_id', '`book_id`', '`book_id`', 3, -1, FALSE, '`book_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->book_id->Sortable = TRUE; // Allow sort
		$this->book_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['book_id'] = &$this->book_id;

		// lang_id
		$this->lang_id = new cField('app_vbook', 'app_vbook', 'x_lang_id', 'lang_id', '`lang_id`', '`lang_id`', 3, -1, FALSE, '`lang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lang_id->Sortable = TRUE; // Allow sort
		$this->lang_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['lang_id'] = &$this->lang_id;

		// status_id
		$this->status_id = new cField('app_vbook', 'app_vbook', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 16, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// book_title
		$this->book_title = new cField('app_vbook', 'app_vbook', 'x_book_title', 'book_title', '`book_title`', '`book_title`', 200, -1, FALSE, '`book_title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->book_title->Sortable = TRUE; // Allow sort
		$this->fields['book_title'] = &$this->book_title;

		// book_desc
		$this->book_desc = new cField('app_vbook', 'app_vbook', 'x_book_desc', 'book_desc', '`book_desc`', '`book_desc`', 201, -1, FALSE, '`book_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->book_desc->Sortable = TRUE; // Allow sort
		$this->fields['book_desc'] = &$this->book_desc;

		// book_image
		$this->book_image = new cField('app_vbook', 'app_vbook', 'x_book_image', 'book_image', '`book_image`', '`book_image`', 200, -1, FALSE, '`book_image`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->book_image->Sortable = TRUE; // Allow sort
		$this->fields['book_image'] = &$this->book_image;

		// book_price
		$this->book_price = new cField('app_vbook', 'app_vbook', 'x_book_price', 'book_price', '`book_price`', '`book_price`', 131, -1, FALSE, '`book_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->book_price->Sortable = TRUE; // Allow sort
		$this->book_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['book_price'] = &$this->book_price;

		// ins_datetime
		$this->ins_datetime = new cField('app_vbook', 'app_vbook', 'x_ins_datetime', 'ins_datetime', '`ins_datetime`', ew_CastDateFieldForLike('`ins_datetime`', 0, "DB"), 135, 0, FALSE, '`ins_datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ins_datetime->Sortable = TRUE; // Allow sort
		$this->ins_datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ins_datetime'] = &$this->ins_datetime;

		// bpage_id
		$this->bpage_id = new cField('app_vbook', 'app_vbook', 'x_bpage_id', 'bpage_id', '`bpage_id`', '`bpage_id`', 3, -1, FALSE, '`bpage_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->bpage_id->Sortable = TRUE; // Allow sort
		$this->bpage_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bpage_id'] = &$this->bpage_id;

		// page_num
		$this->page_num = new cField('app_vbook', 'app_vbook', 'x_page_num', 'page_num', '`page_num`', '`page_num`', 2, -1, FALSE, '`page_num`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->page_num->Sortable = TRUE; // Allow sort
		$this->page_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['page_num'] = &$this->page_num;

		// page_image
		$this->page_image = new cField('app_vbook', 'app_vbook', 'x_page_image', 'page_image', '`page_image`', '`page_image`', 200, -1, FALSE, '`page_image`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->page_image->Sortable = TRUE; // Allow sort
		$this->fields['page_image'] = &$this->page_image;

		// page_text
		$this->page_text = new cField('app_vbook', 'app_vbook', 'x_page_text', 'page_text', '`page_text`', '`page_text`', 201, -1, FALSE, '`page_text`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->page_text->Sortable = TRUE; // Allow sort
		$this->fields['page_text'] = &$this->page_text;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`app_vbook`";
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
			$this->book_id->setDbValue($conn->Insert_ID());
			$rs['book_id'] = $this->book_id->DbValue;

			// Get insert id if necessary
			$this->bpage_id->setDbValue($conn->Insert_ID());
			$rs['bpage_id'] = $this->bpage_id->DbValue;
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
			if (array_key_exists('bpage_id', $rs))
				ew_AddFilter($where, ew_QuotedName('bpage_id', $this->DBID) . '=' . ew_QuotedValue($rs['bpage_id'], $this->bpage_id->FldDataType, $this->DBID));
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
		return "`book_id` = @book_id@ AND `bpage_id` = @bpage_id@";
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
		if (!is_numeric($this->bpage_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->bpage_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@bpage_id@", ew_AdjustSql($this->bpage_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "app_vbooklist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "app_vbookview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "app_vbookedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "app_vbookadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "app_vbooklist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("app_vbookview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("app_vbookview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "app_vbookadd.php?" . $this->UrlParm($parm);
		else
			$url = "app_vbookadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("app_vbookedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("app_vbookadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("app_vbookdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "book_id:" . ew_VarToJson($this->book_id->CurrentValue, "number", "'");
		$json .= ",bpage_id:" . ew_VarToJson($this->bpage_id->CurrentValue, "number", "'");
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
		if (!is_null($this->bpage_id->CurrentValue)) {
			$sUrl .= "&bpage_id=" . urlencode($this->bpage_id->CurrentValue);
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
			if ($isPost && isset($_POST["book_id"]))
				$arKey[] = $_POST["book_id"];
			elseif (isset($_GET["book_id"]))
				$arKey[] = $_GET["book_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["bpage_id"]))
				$arKey[] = $_POST["bpage_id"];
			elseif (isset($_GET["bpage_id"]))
				$arKey[] = $_GET["bpage_id"];
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
				if (!is_numeric($key[0])) // book_id
					continue;
				if (!is_numeric($key[1])) // bpage_id
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
			$this->book_id->CurrentValue = $key[0];
			$this->bpage_id->CurrentValue = $key[1];
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
		$this->book_desc->setDbValue($rs->fields('book_desc'));
		$this->book_image->setDbValue($rs->fields('book_image'));
		$this->book_price->setDbValue($rs->fields('book_price'));
		$this->ins_datetime->setDbValue($rs->fields('ins_datetime'));
		$this->bpage_id->setDbValue($rs->fields('bpage_id'));
		$this->page_num->setDbValue($rs->fields('page_num'));
		$this->page_image->setDbValue($rs->fields('page_image'));
		$this->page_text->setDbValue($rs->fields('page_text'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// book_id
		// lang_id
		// status_id
		// book_title
		// book_desc
		// book_image
		// book_price
		// ins_datetime
		// bpage_id
		// page_num
		// page_image
		// page_text
		// book_id

		$this->book_id->ViewValue = $this->book_id->CurrentValue;
		$this->book_id->ViewCustomAttributes = "";

		// lang_id
		$this->lang_id->ViewValue = $this->lang_id->CurrentValue;
		$this->lang_id->ViewCustomAttributes = "";

		// status_id
		$this->status_id->ViewValue = $this->status_id->CurrentValue;
		$this->status_id->ViewCustomAttributes = "";

		// book_title
		$this->book_title->ViewValue = $this->book_title->CurrentValue;
		$this->book_title->ViewCustomAttributes = "";

		// book_desc
		$this->book_desc->ViewValue = $this->book_desc->CurrentValue;
		$this->book_desc->ViewCustomAttributes = "";

		// book_image
		$this->book_image->ViewValue = $this->book_image->CurrentValue;
		$this->book_image->ViewCustomAttributes = "";

		// book_price
		$this->book_price->ViewValue = $this->book_price->CurrentValue;
		$this->book_price->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

		// bpage_id
		$this->bpage_id->ViewValue = $this->bpage_id->CurrentValue;
		$this->bpage_id->ViewCustomAttributes = "";

		// page_num
		$this->page_num->ViewValue = $this->page_num->CurrentValue;
		$this->page_num->ViewCustomAttributes = "";

		// page_image
		$this->page_image->ViewValue = $this->page_image->CurrentValue;
		$this->page_image->ViewCustomAttributes = "";

		// page_text
		$this->page_text->ViewValue = $this->page_text->CurrentValue;
		$this->page_text->ViewCustomAttributes = "";

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

		// book_desc
		$this->book_desc->LinkCustomAttributes = "";
		$this->book_desc->HrefValue = "";
		$this->book_desc->TooltipValue = "";

		// book_image
		$this->book_image->LinkCustomAttributes = "";
		$this->book_image->HrefValue = "";
		$this->book_image->TooltipValue = "";

		// book_price
		$this->book_price->LinkCustomAttributes = "";
		$this->book_price->HrefValue = "";
		$this->book_price->TooltipValue = "";

		// ins_datetime
		$this->ins_datetime->LinkCustomAttributes = "";
		$this->ins_datetime->HrefValue = "";
		$this->ins_datetime->TooltipValue = "";

		// bpage_id
		$this->bpage_id->LinkCustomAttributes = "";
		$this->bpage_id->HrefValue = "";
		$this->bpage_id->TooltipValue = "";

		// page_num
		$this->page_num->LinkCustomAttributes = "";
		$this->page_num->HrefValue = "";
		$this->page_num->TooltipValue = "";

		// page_image
		$this->page_image->LinkCustomAttributes = "";
		$this->page_image->HrefValue = "";
		$this->page_image->TooltipValue = "";

		// page_text
		$this->page_text->LinkCustomAttributes = "";
		$this->page_text->HrefValue = "";
		$this->page_text->TooltipValue = "";

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
		$this->lang_id->EditValue = $this->lang_id->CurrentValue;
		$this->lang_id->PlaceHolder = ew_RemoveHtml($this->lang_id->FldCaption());

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";
		$this->status_id->EditValue = $this->status_id->CurrentValue;
		$this->status_id->PlaceHolder = ew_RemoveHtml($this->status_id->FldCaption());

		// book_title
		$this->book_title->EditAttrs["class"] = "form-control";
		$this->book_title->EditCustomAttributes = "";
		$this->book_title->EditValue = $this->book_title->CurrentValue;
		$this->book_title->PlaceHolder = ew_RemoveHtml($this->book_title->FldCaption());

		// book_desc
		$this->book_desc->EditAttrs["class"] = "form-control";
		$this->book_desc->EditCustomAttributes = "";
		$this->book_desc->EditValue = $this->book_desc->CurrentValue;
		$this->book_desc->PlaceHolder = ew_RemoveHtml($this->book_desc->FldCaption());

		// book_image
		$this->book_image->EditAttrs["class"] = "form-control";
		$this->book_image->EditCustomAttributes = "";
		$this->book_image->EditValue = $this->book_image->CurrentValue;
		$this->book_image->PlaceHolder = ew_RemoveHtml($this->book_image->FldCaption());

		// book_price
		$this->book_price->EditAttrs["class"] = "form-control";
		$this->book_price->EditCustomAttributes = "";
		$this->book_price->EditValue = $this->book_price->CurrentValue;
		$this->book_price->PlaceHolder = ew_RemoveHtml($this->book_price->FldCaption());
		if (strval($this->book_price->EditValue) <> "" && is_numeric($this->book_price->EditValue)) $this->book_price->EditValue = ew_FormatNumber($this->book_price->EditValue, -2, -1, -2, 0);

		// ins_datetime
		$this->ins_datetime->EditAttrs["class"] = "form-control";
		$this->ins_datetime->EditCustomAttributes = "";
		$this->ins_datetime->EditValue = ew_FormatDateTime($this->ins_datetime->CurrentValue, 8);
		$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

		// bpage_id
		$this->bpage_id->EditAttrs["class"] = "form-control";
		$this->bpage_id->EditCustomAttributes = "";
		$this->bpage_id->EditValue = $this->bpage_id->CurrentValue;
		$this->bpage_id->ViewCustomAttributes = "";

		// page_num
		$this->page_num->EditAttrs["class"] = "form-control";
		$this->page_num->EditCustomAttributes = "";
		$this->page_num->EditValue = $this->page_num->CurrentValue;
		$this->page_num->PlaceHolder = ew_RemoveHtml($this->page_num->FldCaption());

		// page_image
		$this->page_image->EditAttrs["class"] = "form-control";
		$this->page_image->EditCustomAttributes = "";
		$this->page_image->EditValue = $this->page_image->CurrentValue;
		$this->page_image->PlaceHolder = ew_RemoveHtml($this->page_image->FldCaption());

		// page_text
		$this->page_text->EditAttrs["class"] = "form-control";
		$this->page_text->EditCustomAttributes = "";
		$this->page_text->EditValue = $this->page_text->CurrentValue;
		$this->page_text->PlaceHolder = ew_RemoveHtml($this->page_text->FldCaption());

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
					if ($this->book_id->Exportable) $Doc->ExportCaption($this->book_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->book_title->Exportable) $Doc->ExportCaption($this->book_title);
					if ($this->book_desc->Exportable) $Doc->ExportCaption($this->book_desc);
					if ($this->book_image->Exportable) $Doc->ExportCaption($this->book_image);
					if ($this->book_price->Exportable) $Doc->ExportCaption($this->book_price);
					if ($this->ins_datetime->Exportable) $Doc->ExportCaption($this->ins_datetime);
					if ($this->bpage_id->Exportable) $Doc->ExportCaption($this->bpage_id);
					if ($this->page_num->Exportable) $Doc->ExportCaption($this->page_num);
					if ($this->page_image->Exportable) $Doc->ExportCaption($this->page_image);
					if ($this->page_text->Exportable) $Doc->ExportCaption($this->page_text);
				} else {
					if ($this->book_id->Exportable) $Doc->ExportCaption($this->book_id);
					if ($this->lang_id->Exportable) $Doc->ExportCaption($this->lang_id);
					if ($this->status_id->Exportable) $Doc->ExportCaption($this->status_id);
					if ($this->book_title->Exportable) $Doc->ExportCaption($this->book_title);
					if ($this->book_image->Exportable) $Doc->ExportCaption($this->book_image);
					if ($this->book_price->Exportable) $Doc->ExportCaption($this->book_price);
					if ($this->ins_datetime->Exportable) $Doc->ExportCaption($this->ins_datetime);
					if ($this->bpage_id->Exportable) $Doc->ExportCaption($this->bpage_id);
					if ($this->page_num->Exportable) $Doc->ExportCaption($this->page_num);
					if ($this->page_image->Exportable) $Doc->ExportCaption($this->page_image);
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
						if ($this->book_id->Exportable) $Doc->ExportField($this->book_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->book_title->Exportable) $Doc->ExportField($this->book_title);
						if ($this->book_desc->Exportable) $Doc->ExportField($this->book_desc);
						if ($this->book_image->Exportable) $Doc->ExportField($this->book_image);
						if ($this->book_price->Exportable) $Doc->ExportField($this->book_price);
						if ($this->ins_datetime->Exportable) $Doc->ExportField($this->ins_datetime);
						if ($this->bpage_id->Exportable) $Doc->ExportField($this->bpage_id);
						if ($this->page_num->Exportable) $Doc->ExportField($this->page_num);
						if ($this->page_image->Exportable) $Doc->ExportField($this->page_image);
						if ($this->page_text->Exportable) $Doc->ExportField($this->page_text);
					} else {
						if ($this->book_id->Exportable) $Doc->ExportField($this->book_id);
						if ($this->lang_id->Exportable) $Doc->ExportField($this->lang_id);
						if ($this->status_id->Exportable) $Doc->ExportField($this->status_id);
						if ($this->book_title->Exportable) $Doc->ExportField($this->book_title);
						if ($this->book_image->Exportable) $Doc->ExportField($this->book_image);
						if ($this->book_price->Exportable) $Doc->ExportField($this->book_price);
						if ($this->ins_datetime->Exportable) $Doc->ExportField($this->ins_datetime);
						if ($this->bpage_id->Exportable) $Doc->ExportField($this->bpage_id);
						if ($this->page_num->Exportable) $Doc->ExportField($this->page_num);
						if ($this->page_image->Exportable) $Doc->ExportField($this->page_image);
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
