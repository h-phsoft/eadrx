<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_subscribeinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_subscribe_delete = NULL; // Initialize page object first

class capp_subscribe_delete extends capp_subscribe {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_subscribe';

	// Page object name
	var $PageObjName = 'app_subscribe_delete';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (app_subscribe)
		if (!isset($GLOBALS["app_subscribe"]) || get_class($GLOBALS["app_subscribe"]) == "capp_subscribe") {
			$GLOBALS["app_subscribe"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_subscribe"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_subscribe', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// User table object (phs_users)
		if (!isset($UserTable)) {
			$UserTable = new cphs_users();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("app_subscribelist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->serv_id->SetVisibility();
		$this->user_id->SetVisibility();
		$this->cycle_id->SetVisibility();
		$this->book_id->SetVisibility();
		$this->tcat_id->SetVisibility();
		$this->test_id->SetVisibility();
		$this->cat_id->SetVisibility();
		$this->cons_id->SetVisibility();
		$this->subs_start->SetVisibility();
		$this->subs_end->SetVisibility();
		$this->subs_qnt->SetVisibility();
		$this->subs_price->SetVisibility();
		$this->subs_amt->SetVisibility();
		$this->ins_datetime->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $app_subscribe;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_subscribe);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("app_subscribelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in app_subscribe class, app_subscribeinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("app_subscribelist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->subs_id->setDbValue($row['subs_id']);
		$this->serv_id->setDbValue($row['serv_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->cycle_id->setDbValue($row['cycle_id']);
		$this->book_id->setDbValue($row['book_id']);
		$this->tcat_id->setDbValue($row['tcat_id']);
		$this->test_id->setDbValue($row['test_id']);
		$this->cat_id->setDbValue($row['cat_id']);
		$this->cons_id->setDbValue($row['cons_id']);
		$this->subs_start->setDbValue($row['subs_start']);
		$this->subs_end->setDbValue($row['subs_end']);
		$this->subs_qnt->setDbValue($row['subs_qnt']);
		$this->subs_price->setDbValue($row['subs_price']);
		$this->subs_amt->setDbValue($row['subs_amt']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['subs_id'] = NULL;
		$row['serv_id'] = NULL;
		$row['user_id'] = NULL;
		$row['cycle_id'] = NULL;
		$row['book_id'] = NULL;
		$row['tcat_id'] = NULL;
		$row['test_id'] = NULL;
		$row['cat_id'] = NULL;
		$row['cons_id'] = NULL;
		$row['subs_start'] = NULL;
		$row['subs_end'] = NULL;
		$row['subs_qnt'] = NULL;
		$row['subs_price'] = NULL;
		$row['subs_amt'] = NULL;
		$row['ins_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->subs_id->DbValue = $row['subs_id'];
		$this->serv_id->DbValue = $row['serv_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->cycle_id->DbValue = $row['cycle_id'];
		$this->book_id->DbValue = $row['book_id'];
		$this->tcat_id->DbValue = $row['tcat_id'];
		$this->test_id->DbValue = $row['test_id'];
		$this->cat_id->DbValue = $row['cat_id'];
		$this->cons_id->DbValue = $row['cons_id'];
		$this->subs_start->DbValue = $row['subs_start'];
		$this->subs_end->DbValue = $row['subs_end'];
		$this->subs_qnt->DbValue = $row['subs_qnt'];
		$this->subs_price->DbValue = $row['subs_price'];
		$this->subs_amt->DbValue = $row['subs_amt'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->subs_qnt->FormValue == $this->subs_qnt->CurrentValue && is_numeric(ew_StrToFloat($this->subs_qnt->CurrentValue)))
			$this->subs_qnt->CurrentValue = ew_StrToFloat($this->subs_qnt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subs_price->FormValue == $this->subs_price->CurrentValue && is_numeric(ew_StrToFloat($this->subs_price->CurrentValue)))
			$this->subs_price->CurrentValue = ew_StrToFloat($this->subs_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subs_amt->FormValue == $this->subs_amt->CurrentValue && is_numeric(ew_StrToFloat($this->subs_amt->CurrentValue)))
			$this->subs_amt->CurrentValue = ew_StrToFloat($this->subs_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// subs_id

		$this->subs_id->CellCssStyle = "white-space: nowrap;";

		// serv_id
		// user_id
		// cycle_id
		// book_id
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['subs_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_subscribelist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_subscribe_delete)) $app_subscribe_delete = new capp_subscribe_delete();

// Page init
$app_subscribe_delete->Page_Init();

// Page main
$app_subscribe_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_subscribe_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fapp_subscribedelete = new ew_Form("fapp_subscribedelete", "delete");

// Form_CustomValidate event
fapp_subscribedelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_subscribedelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_subscribedelete.Lists["x_serv_id"] = {"LinkField":"x_serv_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_serv_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_service"};
fapp_subscribedelete.Lists["x_serv_id"].Data = "<?php echo $app_subscribe_delete->serv_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_subscribedelete.Lists["x_user_id"].Data = "<?php echo $app_subscribe_delete->user_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_cycle_id"] = {"LinkField":"x_cycle_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cycle_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_bill_cycle"};
fapp_subscribedelete.Lists["x_cycle_id"].Data = "<?php echo $app_subscribe_delete->cycle_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_subscribedelete.Lists["x_book_id"].Data = "<?php echo $app_subscribe_delete->book_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_subscribedelete.Lists["x_tcat_id"].Data = "<?php echo $app_subscribe_delete->tcat_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_subscribedelete.Lists["x_test_id"].Data = "<?php echo $app_subscribe_delete->test_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_subscribedelete.Lists["x_cat_id"].Data = "<?php echo $app_subscribe_delete->cat_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_subscribedelete.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_amount","x_cons_message","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_subscribedelete.Lists["x_cons_id"].Data = "<?php echo $app_subscribe_delete->cons_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_subscribe_delete->ShowPageHeader(); ?>
<?php
$app_subscribe_delete->ShowMessage();
?>
<form name="fapp_subscribedelete" id="fapp_subscribedelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_subscribe_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_subscribe_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_subscribe">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($app_subscribe_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
		<th class="<?php echo $app_subscribe->serv_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_serv_id" class="app_subscribe_serv_id"><?php echo $app_subscribe->serv_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
		<th class="<?php echo $app_subscribe->user_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_user_id" class="app_subscribe_user_id"><?php echo $app_subscribe->user_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
		<th class="<?php echo $app_subscribe->cycle_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_cycle_id" class="app_subscribe_cycle_id"><?php echo $app_subscribe->cycle_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
		<th class="<?php echo $app_subscribe->book_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_book_id" class="app_subscribe_book_id"><?php echo $app_subscribe->book_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
		<th class="<?php echo $app_subscribe->tcat_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_tcat_id" class="app_subscribe_tcat_id"><?php echo $app_subscribe->tcat_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
		<th class="<?php echo $app_subscribe->test_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_test_id" class="app_subscribe_test_id"><?php echo $app_subscribe->test_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
		<th class="<?php echo $app_subscribe->cat_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_cat_id" class="app_subscribe_cat_id"><?php echo $app_subscribe->cat_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
		<th class="<?php echo $app_subscribe->cons_id->HeaderCellClass() ?>"><span id="elh_app_subscribe_cons_id" class="app_subscribe_cons_id"><?php echo $app_subscribe->cons_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
		<th class="<?php echo $app_subscribe->subs_start->HeaderCellClass() ?>"><span id="elh_app_subscribe_subs_start" class="app_subscribe_subs_start"><?php echo $app_subscribe->subs_start->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
		<th class="<?php echo $app_subscribe->subs_end->HeaderCellClass() ?>"><span id="elh_app_subscribe_subs_end" class="app_subscribe_subs_end"><?php echo $app_subscribe->subs_end->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
		<th class="<?php echo $app_subscribe->subs_qnt->HeaderCellClass() ?>"><span id="elh_app_subscribe_subs_qnt" class="app_subscribe_subs_qnt"><?php echo $app_subscribe->subs_qnt->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
		<th class="<?php echo $app_subscribe->subs_price->HeaderCellClass() ?>"><span id="elh_app_subscribe_subs_price" class="app_subscribe_subs_price"><?php echo $app_subscribe->subs_price->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
		<th class="<?php echo $app_subscribe->subs_amt->HeaderCellClass() ?>"><span id="elh_app_subscribe_subs_amt" class="app_subscribe_subs_amt"><?php echo $app_subscribe->subs_amt->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
		<th class="<?php echo $app_subscribe->ins_datetime->HeaderCellClass() ?>"><span id="elh_app_subscribe_ins_datetime" class="app_subscribe_ins_datetime"><?php echo $app_subscribe->ins_datetime->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$app_subscribe_delete->RecCnt = 0;
$i = 0;
while (!$app_subscribe_delete->Recordset->EOF) {
	$app_subscribe_delete->RecCnt++;
	$app_subscribe_delete->RowCnt++;

	// Set row properties
	$app_subscribe->ResetAttrs();
	$app_subscribe->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$app_subscribe_delete->LoadRowValues($app_subscribe_delete->Recordset);

	// Render row
	$app_subscribe_delete->RenderRow();
?>
	<tr<?php echo $app_subscribe->RowAttributes() ?>>
<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
		<td<?php echo $app_subscribe->serv_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_serv_id" class="app_subscribe_serv_id">
<span<?php echo $app_subscribe->serv_id->ViewAttributes() ?>>
<?php echo $app_subscribe->serv_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
		<td<?php echo $app_subscribe->user_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_user_id" class="app_subscribe_user_id">
<span<?php echo $app_subscribe->user_id->ViewAttributes() ?>>
<?php echo $app_subscribe->user_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
		<td<?php echo $app_subscribe->cycle_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_cycle_id" class="app_subscribe_cycle_id">
<span<?php echo $app_subscribe->cycle_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cycle_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
		<td<?php echo $app_subscribe->book_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_book_id" class="app_subscribe_book_id">
<span<?php echo $app_subscribe->book_id->ViewAttributes() ?>>
<?php echo $app_subscribe->book_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
		<td<?php echo $app_subscribe->tcat_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_tcat_id" class="app_subscribe_tcat_id">
<span<?php echo $app_subscribe->tcat_id->ViewAttributes() ?>>
<?php echo $app_subscribe->tcat_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
		<td<?php echo $app_subscribe->test_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_test_id" class="app_subscribe_test_id">
<span<?php echo $app_subscribe->test_id->ViewAttributes() ?>>
<?php echo $app_subscribe->test_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
		<td<?php echo $app_subscribe->cat_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_cat_id" class="app_subscribe_cat_id">
<span<?php echo $app_subscribe->cat_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cat_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
		<td<?php echo $app_subscribe->cons_id->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_cons_id" class="app_subscribe_cons_id">
<span<?php echo $app_subscribe->cons_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cons_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
		<td<?php echo $app_subscribe->subs_start->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_subs_start" class="app_subscribe_subs_start">
<span<?php echo $app_subscribe->subs_start->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_start->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
		<td<?php echo $app_subscribe->subs_end->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_subs_end" class="app_subscribe_subs_end">
<span<?php echo $app_subscribe->subs_end->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_end->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
		<td<?php echo $app_subscribe->subs_qnt->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_subs_qnt" class="app_subscribe_subs_qnt">
<span<?php echo $app_subscribe->subs_qnt->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_qnt->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
		<td<?php echo $app_subscribe->subs_price->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_subs_price" class="app_subscribe_subs_price">
<span<?php echo $app_subscribe->subs_price->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_price->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
		<td<?php echo $app_subscribe->subs_amt->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_subs_amt" class="app_subscribe_subs_amt">
<span<?php echo $app_subscribe->subs_amt->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_amt->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
		<td<?php echo $app_subscribe->ins_datetime->CellAttributes() ?>>
<span id="el<?php echo $app_subscribe_delete->RowCnt ?>_app_subscribe_ins_datetime" class="app_subscribe_ins_datetime">
<span<?php echo $app_subscribe->ins_datetime->ViewAttributes() ?>>
<?php echo $app_subscribe->ins_datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$app_subscribe_delete->Recordset->MoveNext();
}
$app_subscribe_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_subscribe_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fapp_subscribedelete.Init();
</script>
<?php
$app_subscribe_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_subscribe_delete->Page_Terminate();
?>
