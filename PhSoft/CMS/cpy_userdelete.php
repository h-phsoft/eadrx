<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_userinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_user_delete = NULL; // Initialize page object first

class ccpy_user_delete extends ccpy_user {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_user';

	// Page object name
	var $PageObjName = 'cpy_user_delete';

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

		// Table object (cpy_user)
		if (!isset($GLOBALS["cpy_user"]) || get_class($GLOBALS["cpy_user"]) == "ccpy_user") {
			$GLOBALS["cpy_user"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_user"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_user', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_userlist.php"));
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
		$this->cntry_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->pgrp_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->gend_id->SetVisibility();
		$this->user_name->SetVisibility();
		$this->user_email->SetVisibility();
		$this->user_password->SetVisibility();
		$this->user_mobile->SetVisibility();
		$this->user_token->SetVisibility();
		$this->ins_datetime->SetVisibility();
		$this->upd_datetime->SetVisibility();

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
		global $EW_EXPORT, $cpy_user;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_user);
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
			$this->Page_Terminate("cpy_userlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in cpy_user class, cpy_userinfo.php

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
				$this->Page_Terminate("cpy_userlist.php"); // Return to list
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
		$this->user_id->setDbValue($row['user_id']);
		$this->cntry_id->setDbValue($row['cntry_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->pgrp_id->setDbValue($row['pgrp_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->gend_id->setDbValue($row['gend_id']);
		$this->user_name->setDbValue($row['user_name']);
		$this->user_email->setDbValue($row['user_email']);
		$this->user_password->setDbValue($row['user_password']);
		$this->user_mobile->setDbValue($row['user_mobile']);
		$this->user_token->setDbValue($row['user_token']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
		$this->upd_datetime->setDbValue($row['upd_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['user_id'] = NULL;
		$row['cntry_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['pgrp_id'] = NULL;
		$row['status_id'] = NULL;
		$row['gend_id'] = NULL;
		$row['user_name'] = NULL;
		$row['user_email'] = NULL;
		$row['user_password'] = NULL;
		$row['user_mobile'] = NULL;
		$row['user_token'] = NULL;
		$row['ins_datetime'] = NULL;
		$row['upd_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->user_id->DbValue = $row['user_id'];
		$this->cntry_id->DbValue = $row['cntry_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->pgrp_id->DbValue = $row['pgrp_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->gend_id->DbValue = $row['gend_id'];
		$this->user_name->DbValue = $row['user_name'];
		$this->user_email->DbValue = $row['user_email'];
		$this->user_password->DbValue = $row['user_password'];
		$this->user_mobile->DbValue = $row['user_mobile'];
		$this->user_token->DbValue = $row['user_token'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
		$this->upd_datetime->DbValue = $row['upd_datetime'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// user_id

		$this->user_id->CellCssStyle = "white-space: nowrap;";

		// cntry_id
		// lang_id
		// pgrp_id
		// status_id
		// gend_id
		// user_name
		// user_email
		// user_password
		// user_mobile
		// user_token
		// ins_datetime
		// upd_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// cntry_id
		if (strval($this->cntry_id->CurrentValue) <> "") {
			$sFilterWrk = "`cntry_id`" . ew_SearchString("=", $this->cntry_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cntry_id`, `cntry_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_country`";
		$sWhereWrk = "";
		$this->cntry_id->LookupFilters = array();
		$lookuptblfilter = "`status_id`=1";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cntry_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cntry_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cntry_id->ViewValue = $this->cntry_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cntry_id->ViewValue = $this->cntry_id->CurrentValue;
			}
		} else {
			$this->cntry_id->ViewValue = NULL;
		}
		$this->cntry_id->ViewCustomAttributes = "";

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

		// pgrp_id
		if (strval($this->pgrp_id->CurrentValue) <> "") {
			$sFilterWrk = "`pgrp_id`" . ew_SearchString("=", $this->pgrp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pgrp_id`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_pgroup`";
		$sWhereWrk = "";
		$this->pgrp_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `pgrp_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pgrp_id->ViewValue = $this->pgrp_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pgrp_id->ViewValue = $this->pgrp_id->CurrentValue;
			}
		} else {
			$this->pgrp_id->ViewValue = NULL;
		}
		$this->pgrp_id->ViewCustomAttributes = "";

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

		// gend_id
		if (strval($this->gend_id->CurrentValue) <> "") {
			$sFilterWrk = "`gend_id`" . ew_SearchString("=", $this->gend_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `gend_id`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_gender`";
		$sWhereWrk = "";
		$this->gend_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `gend_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->gend_id->ViewValue = $this->gend_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->gend_id->ViewValue = $this->gend_id->CurrentValue;
			}
		} else {
			$this->gend_id->ViewValue = NULL;
		}
		$this->gend_id->ViewCustomAttributes = "";

		// user_name
		$this->user_name->ViewValue = $this->user_name->CurrentValue;
		$this->user_name->ViewCustomAttributes = "";

		// user_email
		$this->user_email->ViewValue = $this->user_email->CurrentValue;
		$this->user_email->ViewCustomAttributes = "";

		// user_password
		$this->user_password->ViewValue = $this->user_password->CurrentValue;
		$this->user_password->ViewCustomAttributes = "";

		// user_mobile
		$this->user_mobile->ViewValue = $this->user_mobile->CurrentValue;
		$this->user_mobile->ViewCustomAttributes = "";

		// user_token
		$this->user_token->ViewValue = $this->user_token->CurrentValue;
		$this->user_token->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

		// upd_datetime
		$this->upd_datetime->ViewValue = $this->upd_datetime->CurrentValue;
		$this->upd_datetime->ViewValue = ew_FormatDateTime($this->upd_datetime->ViewValue, 0);
		$this->upd_datetime->ViewCustomAttributes = "";

			// cntry_id
			$this->cntry_id->LinkCustomAttributes = "";
			$this->cntry_id->HrefValue = "";
			$this->cntry_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// pgrp_id
			$this->pgrp_id->LinkCustomAttributes = "";
			$this->pgrp_id->HrefValue = "";
			$this->pgrp_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";
			$this->gend_id->TooltipValue = "";

			// user_name
			$this->user_name->LinkCustomAttributes = "";
			$this->user_name->HrefValue = "";
			$this->user_name->TooltipValue = "";

			// user_email
			$this->user_email->LinkCustomAttributes = "";
			$this->user_email->HrefValue = "";
			$this->user_email->TooltipValue = "";

			// user_password
			$this->user_password->LinkCustomAttributes = "";
			$this->user_password->HrefValue = "";
			$this->user_password->TooltipValue = "";

			// user_mobile
			$this->user_mobile->LinkCustomAttributes = "";
			$this->user_mobile->HrefValue = "";
			$this->user_mobile->TooltipValue = "";

			// user_token
			$this->user_token->LinkCustomAttributes = "";
			$this->user_token->HrefValue = "";
			$this->user_token->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";

			// upd_datetime
			$this->upd_datetime->LinkCustomAttributes = "";
			$this->upd_datetime->HrefValue = "";
			$this->upd_datetime->TooltipValue = "";
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
				$sThisKey .= $row['user_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_userlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($cpy_user_delete)) $cpy_user_delete = new ccpy_user_delete();

// Page init
$cpy_user_delete->Page_Init();

// Page main
$cpy_user_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_user_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fcpy_userdelete = new ew_Form("fcpy_userdelete", "delete");

// Form_CustomValidate event
fcpy_userdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_userdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_userdelete.Lists["x_cntry_id"] = {"LinkField":"x_cntry_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cntry_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_country"};
fcpy_userdelete.Lists["x_cntry_id"].Data = "<?php echo $cpy_user_delete->cntry_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_userdelete.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_userdelete.Lists["x_lang_id"].Data = "<?php echo $cpy_user_delete->lang_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_userdelete.Lists["x_pgrp_id"] = {"LinkField":"x_pgrp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pgrp_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_pgroup"};
fcpy_userdelete.Lists["x_pgrp_id"].Data = "<?php echo $cpy_user_delete->pgrp_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_userdelete.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_userdelete.Lists["x_status_id"].Data = "<?php echo $cpy_user_delete->status_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_userdelete.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fcpy_userdelete.Lists["x_gend_id"].Data = "<?php echo $cpy_user_delete->gend_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_user_delete->ShowPageHeader(); ?>
<?php
$cpy_user_delete->ShowMessage();
?>
<form name="fcpy_userdelete" id="fcpy_userdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_user_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_user_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_user">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cpy_user_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($cpy_user->cntry_id->Visible) { // cntry_id ?>
		<th class="<?php echo $cpy_user->cntry_id->HeaderCellClass() ?>"><span id="elh_cpy_user_cntry_id" class="cpy_user_cntry_id"><?php echo $cpy_user->cntry_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->lang_id->Visible) { // lang_id ?>
		<th class="<?php echo $cpy_user->lang_id->HeaderCellClass() ?>"><span id="elh_cpy_user_lang_id" class="cpy_user_lang_id"><?php echo $cpy_user->lang_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->pgrp_id->Visible) { // pgrp_id ?>
		<th class="<?php echo $cpy_user->pgrp_id->HeaderCellClass() ?>"><span id="elh_cpy_user_pgrp_id" class="cpy_user_pgrp_id"><?php echo $cpy_user->pgrp_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->status_id->Visible) { // status_id ?>
		<th class="<?php echo $cpy_user->status_id->HeaderCellClass() ?>"><span id="elh_cpy_user_status_id" class="cpy_user_status_id"><?php echo $cpy_user->status_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->gend_id->Visible) { // gend_id ?>
		<th class="<?php echo $cpy_user->gend_id->HeaderCellClass() ?>"><span id="elh_cpy_user_gend_id" class="cpy_user_gend_id"><?php echo $cpy_user->gend_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->user_name->Visible) { // user_name ?>
		<th class="<?php echo $cpy_user->user_name->HeaderCellClass() ?>"><span id="elh_cpy_user_user_name" class="cpy_user_user_name"><?php echo $cpy_user->user_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->user_email->Visible) { // user_email ?>
		<th class="<?php echo $cpy_user->user_email->HeaderCellClass() ?>"><span id="elh_cpy_user_user_email" class="cpy_user_user_email"><?php echo $cpy_user->user_email->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->user_password->Visible) { // user_password ?>
		<th class="<?php echo $cpy_user->user_password->HeaderCellClass() ?>"><span id="elh_cpy_user_user_password" class="cpy_user_user_password"><?php echo $cpy_user->user_password->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->user_mobile->Visible) { // user_mobile ?>
		<th class="<?php echo $cpy_user->user_mobile->HeaderCellClass() ?>"><span id="elh_cpy_user_user_mobile" class="cpy_user_user_mobile"><?php echo $cpy_user->user_mobile->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->user_token->Visible) { // user_token ?>
		<th class="<?php echo $cpy_user->user_token->HeaderCellClass() ?>"><span id="elh_cpy_user_user_token" class="cpy_user_user_token"><?php echo $cpy_user->user_token->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->ins_datetime->Visible) { // ins_datetime ?>
		<th class="<?php echo $cpy_user->ins_datetime->HeaderCellClass() ?>"><span id="elh_cpy_user_ins_datetime" class="cpy_user_ins_datetime"><?php echo $cpy_user->ins_datetime->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_user->upd_datetime->Visible) { // upd_datetime ?>
		<th class="<?php echo $cpy_user->upd_datetime->HeaderCellClass() ?>"><span id="elh_cpy_user_upd_datetime" class="cpy_user_upd_datetime"><?php echo $cpy_user->upd_datetime->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cpy_user_delete->RecCnt = 0;
$i = 0;
while (!$cpy_user_delete->Recordset->EOF) {
	$cpy_user_delete->RecCnt++;
	$cpy_user_delete->RowCnt++;

	// Set row properties
	$cpy_user->ResetAttrs();
	$cpy_user->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cpy_user_delete->LoadRowValues($cpy_user_delete->Recordset);

	// Render row
	$cpy_user_delete->RenderRow();
?>
	<tr<?php echo $cpy_user->RowAttributes() ?>>
<?php if ($cpy_user->cntry_id->Visible) { // cntry_id ?>
		<td<?php echo $cpy_user->cntry_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_cntry_id" class="cpy_user_cntry_id">
<span<?php echo $cpy_user->cntry_id->ViewAttributes() ?>>
<?php echo $cpy_user->cntry_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->lang_id->Visible) { // lang_id ?>
		<td<?php echo $cpy_user->lang_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_lang_id" class="cpy_user_lang_id">
<span<?php echo $cpy_user->lang_id->ViewAttributes() ?>>
<?php echo $cpy_user->lang_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->pgrp_id->Visible) { // pgrp_id ?>
		<td<?php echo $cpy_user->pgrp_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_pgrp_id" class="cpy_user_pgrp_id">
<span<?php echo $cpy_user->pgrp_id->ViewAttributes() ?>>
<?php echo $cpy_user->pgrp_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->status_id->Visible) { // status_id ?>
		<td<?php echo $cpy_user->status_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_status_id" class="cpy_user_status_id">
<span<?php echo $cpy_user->status_id->ViewAttributes() ?>>
<?php echo $cpy_user->status_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->gend_id->Visible) { // gend_id ?>
		<td<?php echo $cpy_user->gend_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_gend_id" class="cpy_user_gend_id">
<span<?php echo $cpy_user->gend_id->ViewAttributes() ?>>
<?php echo $cpy_user->gend_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->user_name->Visible) { // user_name ?>
		<td<?php echo $cpy_user->user_name->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_user_name" class="cpy_user_user_name">
<span<?php echo $cpy_user->user_name->ViewAttributes() ?>>
<?php echo $cpy_user->user_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->user_email->Visible) { // user_email ?>
		<td<?php echo $cpy_user->user_email->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_user_email" class="cpy_user_user_email">
<span<?php echo $cpy_user->user_email->ViewAttributes() ?>>
<?php echo $cpy_user->user_email->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->user_password->Visible) { // user_password ?>
		<td<?php echo $cpy_user->user_password->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_user_password" class="cpy_user_user_password">
<span<?php echo $cpy_user->user_password->ViewAttributes() ?>>
<?php echo $cpy_user->user_password->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->user_mobile->Visible) { // user_mobile ?>
		<td<?php echo $cpy_user->user_mobile->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_user_mobile" class="cpy_user_user_mobile">
<span<?php echo $cpy_user->user_mobile->ViewAttributes() ?>>
<?php echo $cpy_user->user_mobile->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->user_token->Visible) { // user_token ?>
		<td<?php echo $cpy_user->user_token->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_user_token" class="cpy_user_user_token">
<span<?php echo $cpy_user->user_token->ViewAttributes() ?>>
<?php echo $cpy_user->user_token->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->ins_datetime->Visible) { // ins_datetime ?>
		<td<?php echo $cpy_user->ins_datetime->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_ins_datetime" class="cpy_user_ins_datetime">
<span<?php echo $cpy_user->ins_datetime->ViewAttributes() ?>>
<?php echo $cpy_user->ins_datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_user->upd_datetime->Visible) { // upd_datetime ?>
		<td<?php echo $cpy_user->upd_datetime->CellAttributes() ?>>
<span id="el<?php echo $cpy_user_delete->RowCnt ?>_cpy_user_upd_datetime" class="cpy_user_upd_datetime">
<span<?php echo $cpy_user->upd_datetime->ViewAttributes() ?>>
<?php echo $cpy_user->upd_datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cpy_user_delete->Recordset->MoveNext();
}
$cpy_user_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_user_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fcpy_userdelete.Init();
</script>
<?php
$cpy_user_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_user_delete->Page_Terminate();
?>
