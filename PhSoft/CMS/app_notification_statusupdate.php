<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_notification_statusinfo.php" ?>
<?php include_once "app_notificationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_notification_status_update = NULL; // Initialize page object first

class capp_notification_status_update extends capp_notification_status {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_notification_status';

	// Page object name
	var $PageObjName = 'app_notification_status_update';

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

		// Table object (app_notification_status)
		if (!isset($GLOBALS["app_notification_status"]) || get_class($GLOBALS["app_notification_status"]) == "capp_notification_status") {
			$GLOBALS["app_notification_status"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_notification_status"];
		}

		// Table object (app_notification)
		if (!isset($GLOBALS['app_notification'])) $GLOBALS['app_notification'] = new capp_notification();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_notification_status', TRUE);

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

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("app_notification_statuslist.php"));
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
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->notif_id->SetVisibility();
		$this->nstatus_id->SetVisibility();
		$this->user_id->SetVisibility();
		$this->notif_datetime->SetVisibility();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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
		global $EW_EXPORT, $app_notification_status;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_notification_status);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "app_notification_statusview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewUpdateForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $RecKeys;
	var $Disabled;
	var $Recordset;
	var $UpdateCount = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewUpdateForm form-horizontal";

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		if (@$_POST["a_update"] <> "") {

			// Get action
			$this->CurrentAction = $_POST["a_update"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->LoadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->Page_Terminate("app_notification_statuslist.php"); // No records selected, return to list
		switch ($this->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		$this->CurrentFilter = $this->GetKeyFilter();

		// Load recordset
		if ($this->Recordset = $this->LoadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->notif_id->setDbValue($this->Recordset->fields('notif_id'));
					$this->nstatus_id->setDbValue($this->Recordset->fields('nstatus_id'));
					$this->user_id->setDbValue($this->Recordset->fields('user_id'));
					$this->notif_datetime->setDbValue($this->Recordset->fields('notif_datetime'));
				} else {
					if (!ew_CompareValue($this->notif_id->DbValue, $this->Recordset->fields('notif_id')))
						$this->notif_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->nstatus_id->DbValue, $this->Recordset->fields('nstatus_id')))
						$this->nstatus_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->user_id->DbValue, $this->Recordset->fields('user_id')))
						$this->user_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->notif_datetime->DbValue, $this->Recordset->fields('notif_datetime')))
						$this->notif_datetime->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->MoveNext();
			}
			$this->Recordset->Close();
		}
	}

	// Set up key value
	function SetupKeyValues($key) {
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$this->snotif_id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $Language;
		$conn = &$this->Connection();
		$conn->BeginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->GetKeyFilter();
		$sSql = $this->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->RecKeys as $key) {
			if ($this->SetupKeyValues($key)) {
				$sThisKey = $key;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				break; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->notif_id->FldIsDetailKey) {
			$this->notif_id->setFormValue($objForm->GetValue("x_notif_id"));
		}
		$this->notif_id->MultiUpdate = $objForm->GetValue("u_notif_id");
		if (!$this->nstatus_id->FldIsDetailKey) {
			$this->nstatus_id->setFormValue($objForm->GetValue("x_nstatus_id"));
		}
		$this->nstatus_id->MultiUpdate = $objForm->GetValue("u_nstatus_id");
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		$this->user_id->MultiUpdate = $objForm->GetValue("u_user_id");
		if (!$this->notif_datetime->FldIsDetailKey) {
			$this->notif_datetime->setFormValue($objForm->GetValue("x_notif_datetime"));
			$this->notif_datetime->CurrentValue = ew_UnFormatDateTime($this->notif_datetime->CurrentValue, 11);
		}
		$this->notif_datetime->MultiUpdate = $objForm->GetValue("u_notif_datetime");
		if (!$this->snotif_id->FldIsDetailKey)
			$this->snotif_id->setFormValue($objForm->GetValue("x_snotif_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->snotif_id->CurrentValue = $this->snotif_id->FormValue;
		$this->notif_id->CurrentValue = $this->notif_id->FormValue;
		$this->nstatus_id->CurrentValue = $this->nstatus_id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->notif_datetime->CurrentValue = $this->notif_datetime->FormValue;
		$this->notif_datetime->CurrentValue = ew_UnFormatDateTime($this->notif_datetime->CurrentValue, 11);
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
		$this->snotif_id->setDbValue($row['snotif_id']);
		$this->notif_id->setDbValue($row['notif_id']);
		$this->nstatus_id->setDbValue($row['nstatus_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->notif_datetime->setDbValue($row['notif_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['snotif_id'] = NULL;
		$row['notif_id'] = NULL;
		$row['nstatus_id'] = NULL;
		$row['user_id'] = NULL;
		$row['notif_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->snotif_id->DbValue = $row['snotif_id'];
		$this->notif_id->DbValue = $row['notif_id'];
		$this->nstatus_id->DbValue = $row['nstatus_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->notif_datetime->DbValue = $row['notif_datetime'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// snotif_id
		// notif_id
		// nstatus_id
		// user_id
		// notif_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// notif_id
		if (strval($this->notif_id->CurrentValue) <> "") {
			$sFilterWrk = "`notif_id`" . ew_SearchString("=", $this->notif_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `notif_id`, `notif_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notification`";
		$sWhereWrk = "";
		$this->notif_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->notif_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->notif_id->ViewValue = $this->notif_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->notif_id->ViewValue = $this->notif_id->CurrentValue;
			}
		} else {
			$this->notif_id->ViewValue = NULL;
		}
		$this->notif_id->ViewCustomAttributes = "";

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

		// notif_datetime
		$this->notif_datetime->ViewValue = $this->notif_datetime->CurrentValue;
		$this->notif_datetime->ViewValue = ew_FormatDateTime($this->notif_datetime->ViewValue, 11);
		$this->notif_datetime->ViewCustomAttributes = "";

			// notif_id
			$this->notif_id->LinkCustomAttributes = "";
			$this->notif_id->HrefValue = "";
			$this->notif_id->TooltipValue = "";

			// nstatus_id
			$this->nstatus_id->LinkCustomAttributes = "";
			$this->nstatus_id->HrefValue = "";
			$this->nstatus_id->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// notif_datetime
			$this->notif_datetime->LinkCustomAttributes = "";
			$this->notif_datetime->HrefValue = "";
			$this->notif_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// notif_id
			$this->notif_id->EditAttrs["class"] = "form-control";
			$this->notif_id->EditCustomAttributes = "";
			if ($this->notif_id->getSessionValue() <> "") {
				$this->notif_id->CurrentValue = $this->notif_id->getSessionValue();
			if (strval($this->notif_id->CurrentValue) <> "") {
				$sFilterWrk = "`notif_id`" . ew_SearchString("=", $this->notif_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `notif_id`, `notif_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notification`";
			$sWhereWrk = "";
			$this->notif_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->notif_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->notif_id->ViewValue = $this->notif_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->notif_id->ViewValue = $this->notif_id->CurrentValue;
				}
			} else {
				$this->notif_id->ViewValue = NULL;
			}
			$this->notif_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->notif_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`notif_id`" . ew_SearchString("=", $this->notif_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `notif_id`, `notif_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_notification`";
			$sWhereWrk = "";
			$this->notif_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->notif_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->notif_id->EditValue = $arwrk;
			}

			// nstatus_id
			$this->nstatus_id->EditAttrs["class"] = "form-control";
			$this->nstatus_id->EditCustomAttributes = "";
			if (trim(strval($this->nstatus_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`nstatus_id`" . ew_SearchString("=", $this->nstatus_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `nstatus_id`, `nstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_notif_status`";
			$sWhereWrk = "";
			$this->nstatus_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->nstatus_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->nstatus_id->EditValue = $arwrk;

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			if (trim(strval($this->user_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`user_id`" . ew_SearchString("=", $this->user_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `user_id`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_user`";
			$sWhereWrk = "";
			$this->user_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->user_id->EditValue = $arwrk;

			// notif_datetime
			$this->notif_datetime->EditAttrs["class"] = "form-control";
			$this->notif_datetime->EditCustomAttributes = "";
			$this->notif_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->notif_datetime->CurrentValue, 11));
			$this->notif_datetime->PlaceHolder = ew_RemoveHtml($this->notif_datetime->FldCaption());

			// Edit refer script
			// notif_id

			$this->notif_id->LinkCustomAttributes = "";
			$this->notif_id->HrefValue = "";

			// nstatus_id
			$this->nstatus_id->LinkCustomAttributes = "";
			$this->nstatus_id->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// notif_datetime
			$this->notif_datetime->LinkCustomAttributes = "";
			$this->notif_datetime->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($this->notif_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->nstatus_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->user_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->notif_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->notif_id->MultiUpdate <> "" && !$this->notif_id->FldIsDetailKey && !is_null($this->notif_id->FormValue) && $this->notif_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->notif_id->FldCaption(), $this->notif_id->ReqErrMsg));
		}
		if ($this->nstatus_id->MultiUpdate <> "" && !$this->nstatus_id->FldIsDetailKey && !is_null($this->nstatus_id->FormValue) && $this->nstatus_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nstatus_id->FldCaption(), $this->nstatus_id->ReqErrMsg));
		}
		if ($this->user_id->MultiUpdate <> "" && !$this->user_id->FldIsDetailKey && !is_null($this->user_id->FormValue) && $this->user_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_id->FldCaption(), $this->user_id->ReqErrMsg));
		}
		if ($this->notif_datetime->MultiUpdate <> "" && !$this->notif_datetime->FldIsDetailKey && !is_null($this->notif_datetime->FormValue) && $this->notif_datetime->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->notif_datetime->FldCaption(), $this->notif_datetime->ReqErrMsg));
		}
		if ($this->notif_datetime->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($this->notif_datetime->FormValue)) {
				ew_AddMessage($gsFormError, $this->notif_datetime->FldErrMsg());
			}
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// notif_id
			$this->notif_id->SetDbValueDef($rsnew, $this->notif_id->CurrentValue, 0, $this->notif_id->ReadOnly || $this->notif_id->MultiUpdate <> "1");

			// nstatus_id
			$this->nstatus_id->SetDbValueDef($rsnew, $this->nstatus_id->CurrentValue, 0, $this->nstatus_id->ReadOnly || $this->nstatus_id->MultiUpdate <> "1");

			// user_id
			$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly || $this->user_id->MultiUpdate <> "1");

			// notif_datetime
			$this->notif_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->notif_datetime->CurrentValue, 11), ew_CurrentDate(), $this->notif_datetime->ReadOnly || $this->notif_datetime->MultiUpdate <> "1");

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_notification_statuslist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_notif_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `notif_id` AS `LinkFld`, `notif_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notification`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`notif_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->notif_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_nstatus_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `nstatus_id` AS `LinkFld`, `nstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notif_status`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`nstatus_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nstatus_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_user_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `user_id` AS `LinkFld`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`user_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_notification_status_update)) $app_notification_status_update = new capp_notification_status_update();

// Page init
$app_notification_status_update->Page_Init();

// Page main
$app_notification_status_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_notification_status_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fapp_notification_statusupdate = new ew_Form("fapp_notification_statusupdate", "update");

// Validate form
fapp_notification_statusupdate.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		ew_Alert(ewLanguage.Phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_notif_id");
			uelm = this.GetElements("u" + infix + "_notif_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->notif_id->FldCaption(), $app_notification_status->notif_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_nstatus_id");
			uelm = this.GetElements("u" + infix + "_nstatus_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->nstatus_id->FldCaption(), $app_notification_status->nstatus_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_user_id");
			uelm = this.GetElements("u" + infix + "_user_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->user_id->FldCaption(), $app_notification_status->user_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_notif_datetime");
			uelm = this.GetElements("u" + infix + "_notif_datetime");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification_status->notif_datetime->FldCaption(), $app_notification_status->notif_datetime->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_notif_datetime");
			uelm = this.GetElements("u" + infix + "_notif_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_notification_status->notif_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_notification_statusupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_notification_statusupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_notification_statusupdate.Lists["x_notif_id"] = {"LinkField":"x_notif_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_notif_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notification"};
fapp_notification_statusupdate.Lists["x_notif_id"].Data = "<?php echo $app_notification_status_update->notif_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_notification_statusupdate.Lists["x_nstatus_id"] = {"LinkField":"x_nstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_status"};
fapp_notification_statusupdate.Lists["x_nstatus_id"].Data = "<?php echo $app_notification_status_update->nstatus_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_notification_statusupdate.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_notification_statusupdate.Lists["x_user_id"].Data = "<?php echo $app_notification_status_update->user_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_notification_status_update->ShowPageHeader(); ?>
<?php
$app_notification_status_update->ShowMessage();
?>
<form name="fapp_notification_statusupdate" id="fapp_notification_statusupdate" class="<?php echo $app_notification_status_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_notification_status_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_notification_status_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_notification_status">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_notification_status_update->IsModal) ?>">
<?php foreach ($app_notification_status_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_app_notification_statusupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($app_notification_status->notif_id->Visible) { // notif_id ?>
	<div id="r_notif_id" class="form-group">
		<label for="x_notif_id" class="<?php echo $app_notification_status_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_notif_id" id="u_notif_id" class="ewMultiSelect" value="1"<?php echo ($app_notification_status->notif_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification_status->notif_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_status_update->RightColumnClass ?>"><div<?php echo $app_notification_status->notif_id->CellAttributes() ?>>
<?php if ($app_notification_status->notif_id->getSessionValue() <> "") { ?>
<span id="el_app_notification_status_notif_id">
<span<?php echo $app_notification_status->notif_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_notification_status->notif_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_notif_id" name="x_notif_id" value="<?php echo ew_HtmlEncode($app_notification_status->notif_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_app_notification_status_notif_id">
<select data-table="app_notification_status" data-field="x_notif_id" data-value-separator="<?php echo $app_notification_status->notif_id->DisplayValueSeparatorAttribute() ?>" id="x_notif_id" name="x_notif_id"<?php echo $app_notification_status->notif_id->EditAttributes() ?>>
<?php echo $app_notification_status->notif_id->SelectOptionListHtml("x_notif_id") ?>
</select>
</span>
<?php } ?>
<?php echo $app_notification_status->notif_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification_status->nstatus_id->Visible) { // nstatus_id ?>
	<div id="r_nstatus_id" class="form-group">
		<label for="x_nstatus_id" class="<?php echo $app_notification_status_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_nstatus_id" id="u_nstatus_id" class="ewMultiSelect" value="1"<?php echo ($app_notification_status->nstatus_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification_status->nstatus_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_status_update->RightColumnClass ?>"><div<?php echo $app_notification_status->nstatus_id->CellAttributes() ?>>
<span id="el_app_notification_status_nstatus_id">
<select data-table="app_notification_status" data-field="x_nstatus_id" data-value-separator="<?php echo $app_notification_status->nstatus_id->DisplayValueSeparatorAttribute() ?>" id="x_nstatus_id" name="x_nstatus_id"<?php echo $app_notification_status->nstatus_id->EditAttributes() ?>>
<?php echo $app_notification_status->nstatus_id->SelectOptionListHtml("x_nstatus_id") ?>
</select>
</span>
<?php echo $app_notification_status->nstatus_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification_status->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label for="x_user_id" class="<?php echo $app_notification_status_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_id" id="u_user_id" class="ewMultiSelect" value="1"<?php echo ($app_notification_status->user_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification_status->user_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_status_update->RightColumnClass ?>"><div<?php echo $app_notification_status->user_id->CellAttributes() ?>>
<span id="el_app_notification_status_user_id">
<select data-table="app_notification_status" data-field="x_user_id" data-value-separator="<?php echo $app_notification_status->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_notification_status->user_id->EditAttributes() ?>>
<?php echo $app_notification_status->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
<?php echo $app_notification_status->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification_status->notif_datetime->Visible) { // notif_datetime ?>
	<div id="r_notif_datetime" class="form-group">
		<label for="x_notif_datetime" class="<?php echo $app_notification_status_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_notif_datetime" id="u_notif_datetime" class="ewMultiSelect" value="1"<?php echo ($app_notification_status->notif_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification_status->notif_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_status_update->RightColumnClass ?>"><div<?php echo $app_notification_status->notif_datetime->CellAttributes() ?>>
<span id="el_app_notification_status_notif_datetime">
<input type="text" data-table="app_notification_status" data-field="x_notif_datetime" data-format="11" name="x_notif_datetime" id="x_notif_datetime" placeholder="<?php echo ew_HtmlEncode($app_notification_status->notif_datetime->getPlaceHolder()) ?>" value="<?php echo $app_notification_status->notif_datetime->EditValue ?>"<?php echo $app_notification_status->notif_datetime->EditAttributes() ?>>
</span>
<?php echo $app_notification_status->notif_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$app_notification_status_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $app_notification_status_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_notification_status_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_notification_statusupdate.Init();
</script>
<?php
$app_notification_status_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_notification_status_update->Page_Terminate();
?>
