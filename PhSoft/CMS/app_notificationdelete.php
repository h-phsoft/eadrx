<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_notificationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_notification_delete = NULL; // Initialize page object first

class capp_notification_delete extends capp_notification {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_notification';

	// Page object name
	var $PageObjName = 'app_notification_delete';

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

		// Table object (app_notification)
		if (!isset($GLOBALS["app_notification"]) || get_class($GLOBALS["app_notification"]) == "capp_notification") {
			$GLOBALS["app_notification"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_notification"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_notification', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_notificationlist.php"));
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
		$this->for_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->nstatus_id->SetVisibility();
		$this->notif_title->SetVisibility();
		$this->notif_text->SetVisibility();
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
		global $EW_EXPORT, $app_notification;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_notification);
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
			$this->Page_Terminate("app_notificationlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in app_notification class, app_notificationinfo.php

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
				$this->Page_Terminate("app_notificationlist.php"); // Return to list
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
		$this->notif_id->setDbValue($row['notif_id']);
		$this->for_id->setDbValue($row['for_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->nstatus_id->setDbValue($row['nstatus_id']);
		$this->notif_title->setDbValue($row['notif_title']);
		$this->notif_text->setDbValue($row['notif_text']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
		$this->upd_datetime->setDbValue($row['upd_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['notif_id'] = NULL;
		$row['for_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['nstatus_id'] = NULL;
		$row['notif_title'] = NULL;
		$row['notif_text'] = NULL;
		$row['ins_datetime'] = NULL;
		$row['upd_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->notif_id->DbValue = $row['notif_id'];
		$this->for_id->DbValue = $row['for_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->nstatus_id->DbValue = $row['nstatus_id'];
		$this->notif_title->DbValue = $row['notif_title'];
		$this->notif_text->DbValue = $row['notif_text'];
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
		// notif_id

		$this->notif_id->CellCssStyle = "white-space: nowrap;";

		// for_id
		// lang_id
		// nstatus_id
		// notif_title
		// notif_text
		// ins_datetime
		// upd_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// for_id
		if (strval($this->for_id->CurrentValue) <> "") {
			$sFilterWrk = "`for_id`" . ew_SearchString("=", $this->for_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `for_id`, `for_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notif_for`";
		$sWhereWrk = "";
		$this->for_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->for_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->for_id->ViewValue = $this->for_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->for_id->ViewValue = $this->for_id->CurrentValue;
			}
		} else {
			$this->for_id->ViewValue = NULL;
		}
		$this->for_id->ViewCustomAttributes = "";

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

		// nstatus_id
		if (strval($this->nstatus_id->CurrentValue) <> "") {
			$sFilterWrk = "`nstatus_id`" . ew_SearchString("=", $this->nstatus_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `nstatus_id`, `nstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notif_status`";
		$sWhereWrk = "";
		$this->nstatus_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nstatus_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->nstatus_id->ViewValue = $this->nstatus_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nstatus_id->ViewValue = $this->nstatus_id->CurrentValue;
			}
		} else {
			$this->nstatus_id->ViewValue = NULL;
		}
		$this->nstatus_id->ViewCustomAttributes = "";

		// notif_title
		$this->notif_title->ViewValue = $this->notif_title->CurrentValue;
		$this->notif_title->ViewCustomAttributes = "";

		// notif_text
		$this->notif_text->ViewValue = $this->notif_text->CurrentValue;
		$this->notif_text->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

		// upd_datetime
		$this->upd_datetime->ViewValue = $this->upd_datetime->CurrentValue;
		$this->upd_datetime->ViewValue = ew_FormatDateTime($this->upd_datetime->ViewValue, 11);
		$this->upd_datetime->ViewCustomAttributes = "";

			// for_id
			$this->for_id->LinkCustomAttributes = "";
			$this->for_id->HrefValue = "";
			$this->for_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// nstatus_id
			$this->nstatus_id->LinkCustomAttributes = "";
			$this->nstatus_id->HrefValue = "";
			$this->nstatus_id->TooltipValue = "";

			// notif_title
			$this->notif_title->LinkCustomAttributes = "";
			$this->notif_title->HrefValue = "";
			$this->notif_title->TooltipValue = "";

			// notif_text
			$this->notif_text->LinkCustomAttributes = "";
			$this->notif_text->HrefValue = "";
			$this->notif_text->TooltipValue = "";

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
				$sThisKey .= $row['notif_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_notificationlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($app_notification_delete)) $app_notification_delete = new capp_notification_delete();

// Page init
$app_notification_delete->Page_Init();

// Page main
$app_notification_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_notification_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fapp_notificationdelete = new ew_Form("fapp_notificationdelete", "delete");

// Form_CustomValidate event
fapp_notificationdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_notificationdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_notificationdelete.Lists["x_for_id"] = {"LinkField":"x_for_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_for_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_for"};
fapp_notificationdelete.Lists["x_for_id"].Data = "<?php echo $app_notification_delete->for_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_notificationdelete.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_notificationdelete.Lists["x_lang_id"].Data = "<?php echo $app_notification_delete->lang_id->LookupFilterQuery(FALSE, "delete") ?>";
fapp_notificationdelete.Lists["x_nstatus_id"] = {"LinkField":"x_nstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_status"};
fapp_notificationdelete.Lists["x_nstatus_id"].Data = "<?php echo $app_notification_delete->nstatus_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_notification_delete->ShowPageHeader(); ?>
<?php
$app_notification_delete->ShowMessage();
?>
<form name="fapp_notificationdelete" id="fapp_notificationdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_notification_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_notification_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_notification">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($app_notification_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($app_notification->for_id->Visible) { // for_id ?>
		<th class="<?php echo $app_notification->for_id->HeaderCellClass() ?>"><span id="elh_app_notification_for_id" class="app_notification_for_id"><?php echo $app_notification->for_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_notification->lang_id->Visible) { // lang_id ?>
		<th class="<?php echo $app_notification->lang_id->HeaderCellClass() ?>"><span id="elh_app_notification_lang_id" class="app_notification_lang_id"><?php echo $app_notification->lang_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_notification->nstatus_id->Visible) { // nstatus_id ?>
		<th class="<?php echo $app_notification->nstatus_id->HeaderCellClass() ?>"><span id="elh_app_notification_nstatus_id" class="app_notification_nstatus_id"><?php echo $app_notification->nstatus_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_notification->notif_title->Visible) { // notif_title ?>
		<th class="<?php echo $app_notification->notif_title->HeaderCellClass() ?>"><span id="elh_app_notification_notif_title" class="app_notification_notif_title"><?php echo $app_notification->notif_title->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_notification->notif_text->Visible) { // notif_text ?>
		<th class="<?php echo $app_notification->notif_text->HeaderCellClass() ?>"><span id="elh_app_notification_notif_text" class="app_notification_notif_text"><?php echo $app_notification->notif_text->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_notification->ins_datetime->Visible) { // ins_datetime ?>
		<th class="<?php echo $app_notification->ins_datetime->HeaderCellClass() ?>"><span id="elh_app_notification_ins_datetime" class="app_notification_ins_datetime"><?php echo $app_notification->ins_datetime->FldCaption() ?></span></th>
<?php } ?>
<?php if ($app_notification->upd_datetime->Visible) { // upd_datetime ?>
		<th class="<?php echo $app_notification->upd_datetime->HeaderCellClass() ?>"><span id="elh_app_notification_upd_datetime" class="app_notification_upd_datetime"><?php echo $app_notification->upd_datetime->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$app_notification_delete->RecCnt = 0;
$i = 0;
while (!$app_notification_delete->Recordset->EOF) {
	$app_notification_delete->RecCnt++;
	$app_notification_delete->RowCnt++;

	// Set row properties
	$app_notification->ResetAttrs();
	$app_notification->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$app_notification_delete->LoadRowValues($app_notification_delete->Recordset);

	// Render row
	$app_notification_delete->RenderRow();
?>
	<tr<?php echo $app_notification->RowAttributes() ?>>
<?php if ($app_notification->for_id->Visible) { // for_id ?>
		<td<?php echo $app_notification->for_id->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_for_id" class="app_notification_for_id">
<span<?php echo $app_notification->for_id->ViewAttributes() ?>>
<?php echo $app_notification->for_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_notification->lang_id->Visible) { // lang_id ?>
		<td<?php echo $app_notification->lang_id->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_lang_id" class="app_notification_lang_id">
<span<?php echo $app_notification->lang_id->ViewAttributes() ?>>
<?php echo $app_notification->lang_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_notification->nstatus_id->Visible) { // nstatus_id ?>
		<td<?php echo $app_notification->nstatus_id->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_nstatus_id" class="app_notification_nstatus_id">
<span<?php echo $app_notification->nstatus_id->ViewAttributes() ?>>
<?php echo $app_notification->nstatus_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_notification->notif_title->Visible) { // notif_title ?>
		<td<?php echo $app_notification->notif_title->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_notif_title" class="app_notification_notif_title">
<span<?php echo $app_notification->notif_title->ViewAttributes() ?>>
<?php echo $app_notification->notif_title->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_notification->notif_text->Visible) { // notif_text ?>
		<td<?php echo $app_notification->notif_text->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_notif_text" class="app_notification_notif_text">
<span<?php echo $app_notification->notif_text->ViewAttributes() ?>>
<?php echo $app_notification->notif_text->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_notification->ins_datetime->Visible) { // ins_datetime ?>
		<td<?php echo $app_notification->ins_datetime->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_ins_datetime" class="app_notification_ins_datetime">
<span<?php echo $app_notification->ins_datetime->ViewAttributes() ?>>
<?php echo $app_notification->ins_datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_notification->upd_datetime->Visible) { // upd_datetime ?>
		<td<?php echo $app_notification->upd_datetime->CellAttributes() ?>>
<span id="el<?php echo $app_notification_delete->RowCnt ?>_app_notification_upd_datetime" class="app_notification_upd_datetime">
<span<?php echo $app_notification->upd_datetime->ViewAttributes() ?>>
<?php echo $app_notification->upd_datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$app_notification_delete->Recordset->MoveNext();
}
$app_notification_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_notification_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fapp_notificationdelete.Init();
</script>
<?php
$app_notification_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_notification_delete->Page_Terminate();
?>
