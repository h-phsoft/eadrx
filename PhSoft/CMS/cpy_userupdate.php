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

$cpy_user_update = NULL; // Initialize page object first

class ccpy_user_update extends ccpy_user {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_user';

	// Page object name
	var $PageObjName = 'cpy_user_update';

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
			define("EW_PAGE_ID", 'update', TRUE);

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
		// Create form object

		$objForm = new cFormObj();
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "cpy_userview.php")
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
			$this->Page_Terminate("cpy_userlist.php"); // No records selected, return to list
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
					$this->cntry_id->setDbValue($this->Recordset->fields('cntry_id'));
					$this->lang_id->setDbValue($this->Recordset->fields('lang_id'));
					$this->pgrp_id->setDbValue($this->Recordset->fields('pgrp_id'));
					$this->status_id->setDbValue($this->Recordset->fields('status_id'));
					$this->gend_id->setDbValue($this->Recordset->fields('gend_id'));
					$this->user_name->setDbValue($this->Recordset->fields('user_name'));
					$this->user_email->setDbValue($this->Recordset->fields('user_email'));
					$this->user_password->setDbValue($this->Recordset->fields('user_password'));
					$this->user_mobile->setDbValue($this->Recordset->fields('user_mobile'));
					$this->user_token->setDbValue($this->Recordset->fields('user_token'));
					$this->ins_datetime->setDbValue($this->Recordset->fields('ins_datetime'));
					$this->upd_datetime->setDbValue($this->Recordset->fields('upd_datetime'));
				} else {
					if (!ew_CompareValue($this->cntry_id->DbValue, $this->Recordset->fields('cntry_id')))
						$this->cntry_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_id->DbValue, $this->Recordset->fields('lang_id')))
						$this->lang_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->pgrp_id->DbValue, $this->Recordset->fields('pgrp_id')))
						$this->pgrp_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->status_id->DbValue, $this->Recordset->fields('status_id')))
						$this->status_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->gend_id->DbValue, $this->Recordset->fields('gend_id')))
						$this->gend_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->user_name->DbValue, $this->Recordset->fields('user_name')))
						$this->user_name->CurrentValue = NULL;
					if (!ew_CompareValue($this->user_email->DbValue, $this->Recordset->fields('user_email')))
						$this->user_email->CurrentValue = NULL;
					if (!ew_CompareValue($this->user_password->DbValue, $this->Recordset->fields('user_password')))
						$this->user_password->CurrentValue = NULL;
					if (!ew_CompareValue($this->user_mobile->DbValue, $this->Recordset->fields('user_mobile')))
						$this->user_mobile->CurrentValue = NULL;
					if (!ew_CompareValue($this->user_token->DbValue, $this->Recordset->fields('user_token')))
						$this->user_token->CurrentValue = NULL;
					if (!ew_CompareValue($this->ins_datetime->DbValue, $this->Recordset->fields('ins_datetime')))
						$this->ins_datetime->CurrentValue = NULL;
					if (!ew_CompareValue($this->upd_datetime->DbValue, $this->Recordset->fields('upd_datetime')))
						$this->upd_datetime->CurrentValue = NULL;
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
		$this->user_id->CurrentValue = $sKeyFld;
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
		if (!$this->cntry_id->FldIsDetailKey) {
			$this->cntry_id->setFormValue($objForm->GetValue("x_cntry_id"));
		}
		$this->cntry_id->MultiUpdate = $objForm->GetValue("u_cntry_id");
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->MultiUpdate = $objForm->GetValue("u_lang_id");
		if (!$this->pgrp_id->FldIsDetailKey) {
			$this->pgrp_id->setFormValue($objForm->GetValue("x_pgrp_id"));
		}
		$this->pgrp_id->MultiUpdate = $objForm->GetValue("u_pgrp_id");
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		$this->status_id->MultiUpdate = $objForm->GetValue("u_status_id");
		if (!$this->gend_id->FldIsDetailKey) {
			$this->gend_id->setFormValue($objForm->GetValue("x_gend_id"));
		}
		$this->gend_id->MultiUpdate = $objForm->GetValue("u_gend_id");
		if (!$this->user_name->FldIsDetailKey) {
			$this->user_name->setFormValue($objForm->GetValue("x_user_name"));
		}
		$this->user_name->MultiUpdate = $objForm->GetValue("u_user_name");
		if (!$this->user_email->FldIsDetailKey) {
			$this->user_email->setFormValue($objForm->GetValue("x_user_email"));
		}
		$this->user_email->MultiUpdate = $objForm->GetValue("u_user_email");
		if (!$this->user_password->FldIsDetailKey) {
			$this->user_password->setFormValue($objForm->GetValue("x_user_password"));
		}
		$this->user_password->MultiUpdate = $objForm->GetValue("u_user_password");
		if (!$this->user_mobile->FldIsDetailKey) {
			$this->user_mobile->setFormValue($objForm->GetValue("x_user_mobile"));
		}
		$this->user_mobile->MultiUpdate = $objForm->GetValue("u_user_mobile");
		if (!$this->user_token->FldIsDetailKey) {
			$this->user_token->setFormValue($objForm->GetValue("x_user_token"));
		}
		$this->user_token->MultiUpdate = $objForm->GetValue("u_user_token");
		if (!$this->ins_datetime->FldIsDetailKey) {
			$this->ins_datetime->setFormValue($objForm->GetValue("x_ins_datetime"));
			$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0);
		}
		$this->ins_datetime->MultiUpdate = $objForm->GetValue("u_ins_datetime");
		if (!$this->upd_datetime->FldIsDetailKey) {
			$this->upd_datetime->setFormValue($objForm->GetValue("x_upd_datetime"));
			$this->upd_datetime->CurrentValue = ew_UnFormatDateTime($this->upd_datetime->CurrentValue, 0);
		}
		$this->upd_datetime->MultiUpdate = $objForm->GetValue("u_upd_datetime");
		if (!$this->user_id->FldIsDetailKey)
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->cntry_id->CurrentValue = $this->cntry_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->pgrp_id->CurrentValue = $this->pgrp_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->gend_id->CurrentValue = $this->gend_id->FormValue;
		$this->user_name->CurrentValue = $this->user_name->FormValue;
		$this->user_email->CurrentValue = $this->user_email->FormValue;
		$this->user_password->CurrentValue = $this->user_password->FormValue;
		$this->user_mobile->CurrentValue = $this->user_mobile->FormValue;
		$this->user_token->CurrentValue = $this->user_token->FormValue;
		$this->ins_datetime->CurrentValue = $this->ins_datetime->FormValue;
		$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0);
		$this->upd_datetime->CurrentValue = $this->upd_datetime->FormValue;
		$this->upd_datetime->CurrentValue = ew_UnFormatDateTime($this->upd_datetime->CurrentValue, 0);
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// cntry_id
			$this->cntry_id->EditAttrs["class"] = "form-control";
			$this->cntry_id->EditCustomAttributes = "";
			if (trim(strval($this->cntry_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cntry_id`" . ew_SearchString("=", $this->cntry_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cntry_id`, `cntry_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_country`";
			$sWhereWrk = "";
			$this->cntry_id->LookupFilters = array();
			$lookuptblfilter = "`status_id`=1";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cntry_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cntry_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cntry_id->EditValue = $arwrk;

			// lang_id
			$this->lang_id->EditAttrs["class"] = "form-control";
			$this->lang_id->EditCustomAttributes = "";
			if (trim(strval($this->lang_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `lang_id`, `lang_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_language`";
			$sWhereWrk = "";
			$this->lang_id->LookupFilters = array();
			$lookuptblfilter = "`status_id`=1";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->lang_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `lang_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->lang_id->EditValue = $arwrk;

			// pgrp_id
			$this->pgrp_id->EditAttrs["class"] = "form-control";
			$this->pgrp_id->EditCustomAttributes = "";
			if (trim(strval($this->pgrp_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pgrp_id`" . ew_SearchString("=", $this->pgrp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `pgrp_id`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_pgroup`";
			$sWhereWrk = "";
			$this->pgrp_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pgrp_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pgrp_id->EditValue = $arwrk;

			// status_id
			$this->status_id->EditAttrs["class"] = "form-control";
			$this->status_id->EditCustomAttributes = "";
			if (trim(strval($this->status_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`status_id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `status_id`, `status_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_status`";
			$sWhereWrk = "";
			$this->status_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `status_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// gend_id
			$this->gend_id->EditAttrs["class"] = "form-control";
			$this->gend_id->EditCustomAttributes = "";
			if (trim(strval($this->gend_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`gend_id`" . ew_SearchString("=", $this->gend_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `gend_id`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_gender`";
			$sWhereWrk = "";
			$this->gend_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `gend_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->gend_id->EditValue = $arwrk;

			// user_name
			$this->user_name->EditAttrs["class"] = "form-control";
			$this->user_name->EditCustomAttributes = "";
			$this->user_name->EditValue = ew_HtmlEncode($this->user_name->CurrentValue);
			$this->user_name->PlaceHolder = ew_RemoveHtml($this->user_name->FldCaption());

			// user_email
			$this->user_email->EditAttrs["class"] = "form-control";
			$this->user_email->EditCustomAttributes = "";
			$this->user_email->EditValue = ew_HtmlEncode($this->user_email->CurrentValue);
			$this->user_email->PlaceHolder = ew_RemoveHtml($this->user_email->FldCaption());

			// user_password
			$this->user_password->EditAttrs["class"] = "form-control";
			$this->user_password->EditCustomAttributes = "";
			$this->user_password->EditValue = ew_HtmlEncode($this->user_password->CurrentValue);
			$this->user_password->PlaceHolder = ew_RemoveHtml($this->user_password->FldCaption());

			// user_mobile
			$this->user_mobile->EditAttrs["class"] = "form-control";
			$this->user_mobile->EditCustomAttributes = "";
			$this->user_mobile->EditValue = ew_HtmlEncode($this->user_mobile->CurrentValue);
			$this->user_mobile->PlaceHolder = ew_RemoveHtml($this->user_mobile->FldCaption());

			// user_token
			$this->user_token->EditAttrs["class"] = "form-control";
			$this->user_token->EditCustomAttributes = "";
			$this->user_token->EditValue = ew_HtmlEncode($this->user_token->CurrentValue);
			$this->user_token->PlaceHolder = ew_RemoveHtml($this->user_token->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ins_datetime->CurrentValue, 8));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

			// upd_datetime
			$this->upd_datetime->EditAttrs["class"] = "form-control";
			$this->upd_datetime->EditCustomAttributes = "";
			$this->upd_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->upd_datetime->CurrentValue, 8));
			$this->upd_datetime->PlaceHolder = ew_RemoveHtml($this->upd_datetime->FldCaption());

			// Edit refer script
			// cntry_id

			$this->cntry_id->LinkCustomAttributes = "";
			$this->cntry_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// pgrp_id
			$this->pgrp_id->LinkCustomAttributes = "";
			$this->pgrp_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";

			// user_name
			$this->user_name->LinkCustomAttributes = "";
			$this->user_name->HrefValue = "";

			// user_email
			$this->user_email->LinkCustomAttributes = "";
			$this->user_email->HrefValue = "";

			// user_password
			$this->user_password->LinkCustomAttributes = "";
			$this->user_password->HrefValue = "";

			// user_mobile
			$this->user_mobile->LinkCustomAttributes = "";
			$this->user_mobile->HrefValue = "";

			// user_token
			$this->user_token->LinkCustomAttributes = "";
			$this->user_token->HrefValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";

			// upd_datetime
			$this->upd_datetime->LinkCustomAttributes = "";
			$this->upd_datetime->HrefValue = "";
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
		if ($this->cntry_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->pgrp_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->status_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->gend_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->user_name->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->user_email->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->user_password->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->user_mobile->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->user_token->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->ins_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->upd_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->cntry_id->MultiUpdate <> "" && !$this->cntry_id->FldIsDetailKey && !is_null($this->cntry_id->FormValue) && $this->cntry_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cntry_id->FldCaption(), $this->cntry_id->ReqErrMsg));
		}
		if ($this->lang_id->MultiUpdate <> "" && !$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if ($this->pgrp_id->MultiUpdate <> "" && !$this->pgrp_id->FldIsDetailKey && !is_null($this->pgrp_id->FormValue) && $this->pgrp_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pgrp_id->FldCaption(), $this->pgrp_id->ReqErrMsg));
		}
		if ($this->status_id->MultiUpdate <> "" && !$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if ($this->gend_id->MultiUpdate <> "" && !$this->gend_id->FldIsDetailKey && !is_null($this->gend_id->FormValue) && $this->gend_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->gend_id->FldCaption(), $this->gend_id->ReqErrMsg));
		}
		if ($this->user_name->MultiUpdate <> "" && !$this->user_name->FldIsDetailKey && !is_null($this->user_name->FormValue) && $this->user_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_name->FldCaption(), $this->user_name->ReqErrMsg));
		}
		if ($this->user_email->MultiUpdate <> "" && !$this->user_email->FldIsDetailKey && !is_null($this->user_email->FormValue) && $this->user_email->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_email->FldCaption(), $this->user_email->ReqErrMsg));
		}
		if ($this->user_password->MultiUpdate <> "" && !$this->user_password->FldIsDetailKey && !is_null($this->user_password->FormValue) && $this->user_password->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_password->FldCaption(), $this->user_password->ReqErrMsg));
		}
		if ($this->ins_datetime->MultiUpdate <> "") {
			if (!ew_CheckDateDef($this->ins_datetime->FormValue)) {
				ew_AddMessage($gsFormError, $this->ins_datetime->FldErrMsg());
			}
		}
		if ($this->upd_datetime->MultiUpdate <> "") {
			if (!ew_CheckDateDef($this->upd_datetime->FormValue)) {
				ew_AddMessage($gsFormError, $this->upd_datetime->FldErrMsg());
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
		if ($this->user_name->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`user_name` = '" . ew_AdjustSql($this->user_name->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->user_name->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->user_name->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		if ($this->user_email->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`user_email` = '" . ew_AdjustSql($this->user_email->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->user_email->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->user_email->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		if ($this->user_token->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`user_token` = '" . ew_AdjustSql($this->user_token->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->user_token->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->user_token->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
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

			// cntry_id
			$this->cntry_id->SetDbValueDef($rsnew, $this->cntry_id->CurrentValue, NULL, $this->cntry_id->ReadOnly || $this->cntry_id->MultiUpdate <> "1");

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly || $this->lang_id->MultiUpdate <> "1");

			// pgrp_id
			$this->pgrp_id->SetDbValueDef($rsnew, $this->pgrp_id->CurrentValue, 0, $this->pgrp_id->ReadOnly || $this->pgrp_id->MultiUpdate <> "1");

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly || $this->status_id->MultiUpdate <> "1");

			// gend_id
			$this->gend_id->SetDbValueDef($rsnew, $this->gend_id->CurrentValue, 0, $this->gend_id->ReadOnly || $this->gend_id->MultiUpdate <> "1");

			// user_name
			$this->user_name->SetDbValueDef($rsnew, $this->user_name->CurrentValue, "", $this->user_name->ReadOnly || $this->user_name->MultiUpdate <> "1");

			// user_email
			$this->user_email->SetDbValueDef($rsnew, $this->user_email->CurrentValue, NULL, $this->user_email->ReadOnly || $this->user_email->MultiUpdate <> "1");

			// user_password
			$this->user_password->SetDbValueDef($rsnew, $this->user_password->CurrentValue, "", $this->user_password->ReadOnly || $this->user_password->MultiUpdate <> "1");

			// user_mobile
			$this->user_mobile->SetDbValueDef($rsnew, $this->user_mobile->CurrentValue, NULL, $this->user_mobile->ReadOnly || $this->user_mobile->MultiUpdate <> "1");

			// user_token
			$this->user_token->SetDbValueDef($rsnew, $this->user_token->CurrentValue, NULL, $this->user_token->ReadOnly || $this->user_token->MultiUpdate <> "1");

			// ins_datetime
			$this->ins_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0), NULL, $this->ins_datetime->ReadOnly || $this->ins_datetime->MultiUpdate <> "1");

			// upd_datetime
			$this->upd_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->upd_datetime->CurrentValue, 0), NULL, $this->upd_datetime->ReadOnly || $this->upd_datetime->MultiUpdate <> "1");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_userlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_cntry_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cntry_id` AS `LinkFld`, `cntry_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_country`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`status_id`=1";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cntry_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cntry_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cntry_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_lang_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `lang_id` AS `LinkFld`, `lang_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`status_id`=1";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`lang_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->lang_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `lang_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_pgrp_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pgrp_id` AS `LinkFld`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_pgroup`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pgrp_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pgrp_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_status_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `status_id` AS `LinkFld`, `status_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`status_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `status_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_gend_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `gend_id` AS `LinkFld`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_gender`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`gend_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `gend_id`";
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
if (!isset($cpy_user_update)) $cpy_user_update = new ccpy_user_update();

// Page init
$cpy_user_update->Page_Init();

// Page main
$cpy_user_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_user_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fcpy_userupdate = new ew_Form("fcpy_userupdate", "update");

// Validate form
fcpy_userupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_cntry_id");
			uelm = this.GetElements("u" + infix + "_cntry_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->cntry_id->FldCaption(), $cpy_user->cntry_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_id");
			uelm = this.GetElements("u" + infix + "_lang_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->lang_id->FldCaption(), $cpy_user->lang_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_pgrp_id");
			uelm = this.GetElements("u" + infix + "_pgrp_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->pgrp_id->FldCaption(), $cpy_user->pgrp_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_status_id");
			uelm = this.GetElements("u" + infix + "_status_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->status_id->FldCaption(), $cpy_user->status_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_gend_id");
			uelm = this.GetElements("u" + infix + "_gend_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->gend_id->FldCaption(), $cpy_user->gend_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_user_name");
			uelm = this.GetElements("u" + infix + "_user_name");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->user_name->FldCaption(), $cpy_user->user_name->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_user_email");
			uelm = this.GetElements("u" + infix + "_user_email");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->user_email->FldCaption(), $cpy_user->user_email->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_user_password");
			uelm = this.GetElements("u" + infix + "_user_password");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_user->user_password->FldCaption(), $cpy_user->user_password->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_ins_datetime");
			uelm = this.GetElements("u" + infix + "_ins_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_user->ins_datetime->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_upd_datetime");
			uelm = this.GetElements("u" + infix + "_upd_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_user->upd_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcpy_userupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_userupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_userupdate.Lists["x_cntry_id"] = {"LinkField":"x_cntry_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cntry_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_country"};
fcpy_userupdate.Lists["x_cntry_id"].Data = "<?php echo $cpy_user_update->cntry_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_userupdate.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_userupdate.Lists["x_lang_id"].Data = "<?php echo $cpy_user_update->lang_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_userupdate.Lists["x_pgrp_id"] = {"LinkField":"x_pgrp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pgrp_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_pgroup"};
fcpy_userupdate.Lists["x_pgrp_id"].Data = "<?php echo $cpy_user_update->pgrp_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_userupdate.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_userupdate.Lists["x_status_id"].Data = "<?php echo $cpy_user_update->status_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_userupdate.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fcpy_userupdate.Lists["x_gend_id"].Data = "<?php echo $cpy_user_update->gend_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_user_update->ShowPageHeader(); ?>
<?php
$cpy_user_update->ShowMessage();
?>
<form name="fcpy_userupdate" id="fcpy_userupdate" class="<?php echo $cpy_user_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_user_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_user_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_user">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_user_update->IsModal) ?>">
<?php foreach ($cpy_user_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_cpy_userupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($cpy_user->cntry_id->Visible) { // cntry_id ?>
	<div id="r_cntry_id" class="form-group">
		<label for="x_cntry_id" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cntry_id" id="u_cntry_id" class="ewMultiSelect" value="1"<?php echo ($cpy_user->cntry_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->cntry_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->cntry_id->CellAttributes() ?>>
<span id="el_cpy_user_cntry_id">
<select data-table="cpy_user" data-field="x_cntry_id" data-value-separator="<?php echo $cpy_user->cntry_id->DisplayValueSeparatorAttribute() ?>" id="x_cntry_id" name="x_cntry_id"<?php echo $cpy_user->cntry_id->EditAttributes() ?>>
<?php echo $cpy_user->cntry_id->SelectOptionListHtml("x_cntry_id") ?>
</select>
</span>
<?php echo $cpy_user->cntry_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_id" id="u_lang_id" class="ewMultiSelect" value="1"<?php echo ($cpy_user->lang_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->lang_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->lang_id->CellAttributes() ?>>
<span id="el_cpy_user_lang_id">
<select data-table="cpy_user" data-field="x_lang_id" data-value-separator="<?php echo $cpy_user->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $cpy_user->lang_id->EditAttributes() ?>>
<?php echo $cpy_user->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $cpy_user->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->pgrp_id->Visible) { // pgrp_id ?>
	<div id="r_pgrp_id" class="form-group">
		<label for="x_pgrp_id" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_pgrp_id" id="u_pgrp_id" class="ewMultiSelect" value="1"<?php echo ($cpy_user->pgrp_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->pgrp_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->pgrp_id->CellAttributes() ?>>
<span id="el_cpy_user_pgrp_id">
<select data-table="cpy_user" data-field="x_pgrp_id" data-value-separator="<?php echo $cpy_user->pgrp_id->DisplayValueSeparatorAttribute() ?>" id="x_pgrp_id" name="x_pgrp_id"<?php echo $cpy_user->pgrp_id->EditAttributes() ?>>
<?php echo $cpy_user->pgrp_id->SelectOptionListHtml("x_pgrp_id") ?>
</select>
</span>
<?php echo $cpy_user->pgrp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_status_id" id="u_status_id" class="ewMultiSelect" value="1"<?php echo ($cpy_user->status_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->status_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->status_id->CellAttributes() ?>>
<span id="el_cpy_user_status_id">
<select data-table="cpy_user" data-field="x_status_id" data-value-separator="<?php echo $cpy_user->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_user->status_id->EditAttributes() ?>>
<?php echo $cpy_user->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $cpy_user->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->gend_id->Visible) { // gend_id ?>
	<div id="r_gend_id" class="form-group">
		<label for="x_gend_id" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_gend_id" id="u_gend_id" class="ewMultiSelect" value="1"<?php echo ($cpy_user->gend_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->gend_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->gend_id->CellAttributes() ?>>
<span id="el_cpy_user_gend_id">
<select data-table="cpy_user" data-field="x_gend_id" data-value-separator="<?php echo $cpy_user->gend_id->DisplayValueSeparatorAttribute() ?>" id="x_gend_id" name="x_gend_id"<?php echo $cpy_user->gend_id->EditAttributes() ?>>
<?php echo $cpy_user->gend_id->SelectOptionListHtml("x_gend_id") ?>
</select>
</span>
<?php echo $cpy_user->gend_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_name->Visible) { // user_name ?>
	<div id="r_user_name" class="form-group">
		<label for="x_user_name" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_name" id="u_user_name" class="ewMultiSelect" value="1"<?php echo ($cpy_user->user_name->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->user_name->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->user_name->CellAttributes() ?>>
<span id="el_cpy_user_user_name">
<input type="text" data-table="cpy_user" data-field="x_user_name" name="x_user_name" id="x_user_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_name->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_name->EditValue ?>"<?php echo $cpy_user->user_name->EditAttributes() ?>>
</span>
<?php echo $cpy_user->user_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_email->Visible) { // user_email ?>
	<div id="r_user_email" class="form-group">
		<label for="x_user_email" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_email" id="u_user_email" class="ewMultiSelect" value="1"<?php echo ($cpy_user->user_email->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->user_email->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->user_email->CellAttributes() ?>>
<span id="el_cpy_user_user_email">
<input type="text" data-table="cpy_user" data-field="x_user_email" name="x_user_email" id="x_user_email" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_email->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_email->EditValue ?>"<?php echo $cpy_user->user_email->EditAttributes() ?>>
</span>
<?php echo $cpy_user->user_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_password->Visible) { // user_password ?>
	<div id="r_user_password" class="form-group">
		<label for="x_user_password" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_password" id="u_user_password" class="ewMultiSelect" value="1"<?php echo ($cpy_user->user_password->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->user_password->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->user_password->CellAttributes() ?>>
<span id="el_cpy_user_user_password">
<input type="text" data-table="cpy_user" data-field="x_user_password" name="x_user_password" id="x_user_password" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_password->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_password->EditValue ?>"<?php echo $cpy_user->user_password->EditAttributes() ?>>
</span>
<?php echo $cpy_user->user_password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_mobile->Visible) { // user_mobile ?>
	<div id="r_user_mobile" class="form-group">
		<label for="x_user_mobile" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_mobile" id="u_user_mobile" class="ewMultiSelect" value="1"<?php echo ($cpy_user->user_mobile->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->user_mobile->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->user_mobile->CellAttributes() ?>>
<span id="el_cpy_user_user_mobile">
<input type="text" data-table="cpy_user" data-field="x_user_mobile" name="x_user_mobile" id="x_user_mobile" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_mobile->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_mobile->EditValue ?>"<?php echo $cpy_user->user_mobile->EditAttributes() ?>>
</span>
<?php echo $cpy_user->user_mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_token->Visible) { // user_token ?>
	<div id="r_user_token" class="form-group">
		<label for="x_user_token" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_token" id="u_user_token" class="ewMultiSelect" value="1"<?php echo ($cpy_user->user_token->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->user_token->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->user_token->CellAttributes() ?>>
<span id="el_cpy_user_user_token">
<input type="text" data-table="cpy_user" data-field="x_user_token" name="x_user_token" id="x_user_token" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_token->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_token->EditValue ?>"<?php echo $cpy_user->user_token->EditAttributes() ?>>
</span>
<?php echo $cpy_user->user_token->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_ins_datetime" id="u_ins_datetime" class="ewMultiSelect" value="1"<?php echo ($cpy_user->ins_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->ins_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->ins_datetime->CellAttributes() ?>>
<span id="el_cpy_user_ins_datetime">
<input type="text" data-table="cpy_user" data-field="x_ins_datetime" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($cpy_user->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $cpy_user->ins_datetime->EditValue ?>"<?php echo $cpy_user->ins_datetime->EditAttributes() ?>>
</span>
<?php echo $cpy_user->ins_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->upd_datetime->Visible) { // upd_datetime ?>
	<div id="r_upd_datetime" class="form-group">
		<label for="x_upd_datetime" class="<?php echo $cpy_user_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_upd_datetime" id="u_upd_datetime" class="ewMultiSelect" value="1"<?php echo ($cpy_user->upd_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_user->upd_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_user_update->RightColumnClass ?>"><div<?php echo $cpy_user->upd_datetime->CellAttributes() ?>>
<span id="el_cpy_user_upd_datetime">
<input type="text" data-table="cpy_user" data-field="x_upd_datetime" name="x_upd_datetime" id="x_upd_datetime" placeholder="<?php echo ew_HtmlEncode($cpy_user->upd_datetime->getPlaceHolder()) ?>" value="<?php echo $cpy_user->upd_datetime->EditValue ?>"<?php echo $cpy_user->upd_datetime->EditAttributes() ?>>
</span>
<?php echo $cpy_user->upd_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$cpy_user_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $cpy_user_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_user_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_userupdate.Init();
</script>
<?php
$cpy_user_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_user_update->Page_Terminate();
?>
