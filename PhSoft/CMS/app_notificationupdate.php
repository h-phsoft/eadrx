<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_notificationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_notification_forgridcls.php" ?>
<?php include_once "app_notification_statusgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_notification_update = NULL; // Initialize page object first

class capp_notification_update extends capp_notification {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_notification';

	// Page object name
	var $PageObjName = 'app_notification_update';

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
			define("EW_PAGE_ID", 'update', TRUE);

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
		// Create form object

		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("app_notification_for", $DetailTblVar)) {

					// Process auto fill for detail table 'app_notification_for'
					if (preg_match('/^fapp_notification_for(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_notification_for_grid"])) $GLOBALS["app_notification_for_grid"] = new capp_notification_for_grid;
						$GLOBALS["app_notification_for_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("app_notification_status", $DetailTblVar)) {

					// Process auto fill for detail table 'app_notification_status'
					if (preg_match('/^fapp_notification_status(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_notification_status_grid"])) $GLOBALS["app_notification_status_grid"] = new capp_notification_status_grid;
						$GLOBALS["app_notification_status_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
			}
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "app_notificationview.php")
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
			$this->Page_Terminate("app_notificationlist.php"); // No records selected, return to list
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
					$this->for_id->setDbValue($this->Recordset->fields('for_id'));
					$this->lang_id->setDbValue($this->Recordset->fields('lang_id'));
					$this->nstatus_id->setDbValue($this->Recordset->fields('nstatus_id'));
					$this->notif_title->setDbValue($this->Recordset->fields('notif_title'));
					$this->notif_text->setDbValue($this->Recordset->fields('notif_text'));
					$this->ins_datetime->setDbValue($this->Recordset->fields('ins_datetime'));
					$this->upd_datetime->setDbValue($this->Recordset->fields('upd_datetime'));
				} else {
					if (!ew_CompareValue($this->for_id->DbValue, $this->Recordset->fields('for_id')))
						$this->for_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_id->DbValue, $this->Recordset->fields('lang_id')))
						$this->lang_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->nstatus_id->DbValue, $this->Recordset->fields('nstatus_id')))
						$this->nstatus_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->notif_title->DbValue, $this->Recordset->fields('notif_title')))
						$this->notif_title->CurrentValue = NULL;
					if (!ew_CompareValue($this->notif_text->DbValue, $this->Recordset->fields('notif_text')))
						$this->notif_text->CurrentValue = NULL;
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
		$this->notif_id->CurrentValue = $sKeyFld;
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
		if (!$this->for_id->FldIsDetailKey) {
			$this->for_id->setFormValue($objForm->GetValue("x_for_id"));
		}
		$this->for_id->MultiUpdate = $objForm->GetValue("u_for_id");
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->MultiUpdate = $objForm->GetValue("u_lang_id");
		if (!$this->nstatus_id->FldIsDetailKey) {
			$this->nstatus_id->setFormValue($objForm->GetValue("x_nstatus_id"));
		}
		$this->nstatus_id->MultiUpdate = $objForm->GetValue("u_nstatus_id");
		if (!$this->notif_title->FldIsDetailKey) {
			$this->notif_title->setFormValue($objForm->GetValue("x_notif_title"));
		}
		$this->notif_title->MultiUpdate = $objForm->GetValue("u_notif_title");
		if (!$this->notif_text->FldIsDetailKey) {
			$this->notif_text->setFormValue($objForm->GetValue("x_notif_text"));
		}
		$this->notif_text->MultiUpdate = $objForm->GetValue("u_notif_text");
		if (!$this->ins_datetime->FldIsDetailKey) {
			$this->ins_datetime->setFormValue($objForm->GetValue("x_ins_datetime"));
			$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11);
		}
		$this->ins_datetime->MultiUpdate = $objForm->GetValue("u_ins_datetime");
		if (!$this->upd_datetime->FldIsDetailKey) {
			$this->upd_datetime->setFormValue($objForm->GetValue("x_upd_datetime"));
			$this->upd_datetime->CurrentValue = ew_UnFormatDateTime($this->upd_datetime->CurrentValue, 11);
		}
		$this->upd_datetime->MultiUpdate = $objForm->GetValue("u_upd_datetime");
		if (!$this->notif_id->FldIsDetailKey)
			$this->notif_id->setFormValue($objForm->GetValue("x_notif_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->notif_id->CurrentValue = $this->notif_id->FormValue;
		$this->for_id->CurrentValue = $this->for_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->nstatus_id->CurrentValue = $this->nstatus_id->FormValue;
		$this->notif_title->CurrentValue = $this->notif_title->FormValue;
		$this->notif_text->CurrentValue = $this->notif_text->FormValue;
		$this->ins_datetime->CurrentValue = $this->ins_datetime->FormValue;
		$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11);
		$this->upd_datetime->CurrentValue = $this->upd_datetime->FormValue;
		$this->upd_datetime->CurrentValue = ew_UnFormatDateTime($this->upd_datetime->CurrentValue, 11);
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// for_id
			$this->for_id->EditAttrs["class"] = "form-control";
			$this->for_id->EditCustomAttributes = "";
			if (trim(strval($this->for_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`for_id`" . ew_SearchString("=", $this->for_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `for_id`, `for_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_notif_for`";
			$sWhereWrk = "";
			$this->for_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->for_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->for_id->EditValue = $arwrk;

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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->lang_id->EditValue = $arwrk;

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

			// notif_title
			$this->notif_title->EditAttrs["class"] = "form-control";
			$this->notif_title->EditCustomAttributes = "";
			$this->notif_title->EditValue = ew_HtmlEncode($this->notif_title->CurrentValue);
			$this->notif_title->PlaceHolder = ew_RemoveHtml($this->notif_title->FldCaption());

			// notif_text
			$this->notif_text->EditAttrs["class"] = "form-control";
			$this->notif_text->EditCustomAttributes = "";
			$this->notif_text->EditValue = ew_HtmlEncode($this->notif_text->CurrentValue);
			$this->notif_text->PlaceHolder = ew_RemoveHtml($this->notif_text->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ins_datetime->CurrentValue, 11));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

			// upd_datetime
			$this->upd_datetime->EditAttrs["class"] = "form-control";
			$this->upd_datetime->EditCustomAttributes = "";
			$this->upd_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->upd_datetime->CurrentValue, 11));
			$this->upd_datetime->PlaceHolder = ew_RemoveHtml($this->upd_datetime->FldCaption());

			// Edit refer script
			// for_id

			$this->for_id->LinkCustomAttributes = "";
			$this->for_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// nstatus_id
			$this->nstatus_id->LinkCustomAttributes = "";
			$this->nstatus_id->HrefValue = "";

			// notif_title
			$this->notif_title->LinkCustomAttributes = "";
			$this->notif_title->HrefValue = "";

			// notif_text
			$this->notif_text->LinkCustomAttributes = "";
			$this->notif_text->HrefValue = "";

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
		if ($this->for_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->nstatus_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->notif_title->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->notif_text->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->ins_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->upd_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->notif_title->MultiUpdate <> "" && !$this->notif_title->FldIsDetailKey && !is_null($this->notif_title->FormValue) && $this->notif_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->notif_title->FldCaption(), $this->notif_title->ReqErrMsg));
		}
		if ($this->notif_text->MultiUpdate <> "" && !$this->notif_text->FldIsDetailKey && !is_null($this->notif_text->FormValue) && $this->notif_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->notif_text->FldCaption(), $this->notif_text->ReqErrMsg));
		}
		if ($this->ins_datetime->MultiUpdate <> "" && !$this->ins_datetime->FldIsDetailKey && !is_null($this->ins_datetime->FormValue) && $this->ins_datetime->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ins_datetime->FldCaption(), $this->ins_datetime->ReqErrMsg));
		}
		if ($this->ins_datetime->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($this->ins_datetime->FormValue)) {
				ew_AddMessage($gsFormError, $this->ins_datetime->FldErrMsg());
			}
		}
		if ($this->upd_datetime->MultiUpdate <> "" && !$this->upd_datetime->FldIsDetailKey && !is_null($this->upd_datetime->FormValue) && $this->upd_datetime->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->upd_datetime->FldCaption(), $this->upd_datetime->ReqErrMsg));
		}
		if ($this->upd_datetime->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($this->upd_datetime->FormValue)) {
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

			// for_id
			$this->for_id->SetDbValueDef($rsnew, $this->for_id->CurrentValue, 0, $this->for_id->ReadOnly || $this->for_id->MultiUpdate <> "1");

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly || $this->lang_id->MultiUpdate <> "1");

			// nstatus_id
			$this->nstatus_id->SetDbValueDef($rsnew, $this->nstatus_id->CurrentValue, 0, $this->nstatus_id->ReadOnly || $this->nstatus_id->MultiUpdate <> "1");

			// notif_title
			$this->notif_title->SetDbValueDef($rsnew, $this->notif_title->CurrentValue, "", $this->notif_title->ReadOnly || $this->notif_title->MultiUpdate <> "1");

			// notif_text
			$this->notif_text->SetDbValueDef($rsnew, $this->notif_text->CurrentValue, "", $this->notif_text->ReadOnly || $this->notif_text->MultiUpdate <> "1");

			// ins_datetime
			$this->ins_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11), ew_CurrentDate(), $this->ins_datetime->ReadOnly || $this->ins_datetime->MultiUpdate <> "1");

			// upd_datetime
			$this->upd_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->upd_datetime->CurrentValue, 11), ew_CurrentDate(), $this->upd_datetime->ReadOnly || $this->upd_datetime->MultiUpdate <> "1");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_notificationlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_for_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `for_id` AS `LinkFld`, `for_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_notif_for`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`for_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->for_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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
if (!isset($app_notification_update)) $app_notification_update = new capp_notification_update();

// Page init
$app_notification_update->Page_Init();

// Page main
$app_notification_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_notification_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fapp_notificationupdate = new ew_Form("fapp_notificationupdate", "update");

// Validate form
fapp_notificationupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_notif_title");
			uelm = this.GetElements("u" + infix + "_notif_title");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification->notif_title->FldCaption(), $app_notification->notif_title->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_notif_text");
			uelm = this.GetElements("u" + infix + "_notif_text");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification->notif_text->FldCaption(), $app_notification->notif_text->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_ins_datetime");
			uelm = this.GetElements("u" + infix + "_ins_datetime");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification->ins_datetime->FldCaption(), $app_notification->ins_datetime->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_ins_datetime");
			uelm = this.GetElements("u" + infix + "_ins_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_notification->ins_datetime->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_upd_datetime");
			uelm = this.GetElements("u" + infix + "_upd_datetime");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification->upd_datetime->FldCaption(), $app_notification->upd_datetime->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_upd_datetime");
			uelm = this.GetElements("u" + infix + "_upd_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_notification->upd_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_notificationupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_notificationupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_notificationupdate.Lists["x_for_id"] = {"LinkField":"x_for_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_for_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_for"};
fapp_notificationupdate.Lists["x_for_id"].Data = "<?php echo $app_notification_update->for_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_notificationupdate.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_notificationupdate.Lists["x_lang_id"].Data = "<?php echo $app_notification_update->lang_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_notificationupdate.Lists["x_nstatus_id"] = {"LinkField":"x_nstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_status"};
fapp_notificationupdate.Lists["x_nstatus_id"].Data = "<?php echo $app_notification_update->nstatus_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_notification_update->ShowPageHeader(); ?>
<?php
$app_notification_update->ShowMessage();
?>
<form name="fapp_notificationupdate" id="fapp_notificationupdate" class="<?php echo $app_notification_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_notification_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_notification_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_notification">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_notification_update->IsModal) ?>">
<?php foreach ($app_notification_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_app_notificationupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($app_notification->for_id->Visible) { // for_id ?>
	<div id="r_for_id" class="form-group">
		<label for="x_for_id" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_for_id" id="u_for_id" class="ewMultiSelect" value="1"<?php echo ($app_notification->for_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->for_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->for_id->CellAttributes() ?>>
<span id="el_app_notification_for_id">
<select data-table="app_notification" data-field="x_for_id" data-value-separator="<?php echo $app_notification->for_id->DisplayValueSeparatorAttribute() ?>" id="x_for_id" name="x_for_id"<?php echo $app_notification->for_id->EditAttributes() ?>>
<?php echo $app_notification->for_id->SelectOptionListHtml("x_for_id") ?>
</select>
</span>
<?php echo $app_notification->for_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_id" id="u_lang_id" class="ewMultiSelect" value="1"<?php echo ($app_notification->lang_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->lang_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->lang_id->CellAttributes() ?>>
<span id="el_app_notification_lang_id">
<select data-table="app_notification" data-field="x_lang_id" data-value-separator="<?php echo $app_notification->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $app_notification->lang_id->EditAttributes() ?>>
<?php echo $app_notification->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $app_notification->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->nstatus_id->Visible) { // nstatus_id ?>
	<div id="r_nstatus_id" class="form-group">
		<label for="x_nstatus_id" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_nstatus_id" id="u_nstatus_id" class="ewMultiSelect" value="1"<?php echo ($app_notification->nstatus_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->nstatus_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->nstatus_id->CellAttributes() ?>>
<span id="el_app_notification_nstatus_id">
<select data-table="app_notification" data-field="x_nstatus_id" data-value-separator="<?php echo $app_notification->nstatus_id->DisplayValueSeparatorAttribute() ?>" id="x_nstatus_id" name="x_nstatus_id"<?php echo $app_notification->nstatus_id->EditAttributes() ?>>
<?php echo $app_notification->nstatus_id->SelectOptionListHtml("x_nstatus_id") ?>
</select>
</span>
<?php echo $app_notification->nstatus_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->notif_title->Visible) { // notif_title ?>
	<div id="r_notif_title" class="form-group">
		<label for="x_notif_title" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_notif_title" id="u_notif_title" class="ewMultiSelect" value="1"<?php echo ($app_notification->notif_title->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->notif_title->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->notif_title->CellAttributes() ?>>
<span id="el_app_notification_notif_title">
<input type="text" data-table="app_notification" data-field="x_notif_title" name="x_notif_title" id="x_notif_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_notification->notif_title->getPlaceHolder()) ?>" value="<?php echo $app_notification->notif_title->EditValue ?>"<?php echo $app_notification->notif_title->EditAttributes() ?>>
</span>
<?php echo $app_notification->notif_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->notif_text->Visible) { // notif_text ?>
	<div id="r_notif_text" class="form-group">
		<label for="x_notif_text" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_notif_text" id="u_notif_text" class="ewMultiSelect" value="1"<?php echo ($app_notification->notif_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->notif_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->notif_text->CellAttributes() ?>>
<span id="el_app_notification_notif_text">
<textarea data-table="app_notification" data-field="x_notif_text" name="x_notif_text" id="x_notif_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_notification->notif_text->getPlaceHolder()) ?>"<?php echo $app_notification->notif_text->EditAttributes() ?>><?php echo $app_notification->notif_text->EditValue ?></textarea>
</span>
<?php echo $app_notification->notif_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_ins_datetime" id="u_ins_datetime" class="ewMultiSelect" value="1"<?php echo ($app_notification->ins_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->ins_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->ins_datetime->CellAttributes() ?>>
<span id="el_app_notification_ins_datetime">
<input type="text" data-table="app_notification" data-field="x_ins_datetime" data-format="11" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_notification->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_notification->ins_datetime->EditValue ?>"<?php echo $app_notification->ins_datetime->EditAttributes() ?>>
</span>
<?php echo $app_notification->ins_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->upd_datetime->Visible) { // upd_datetime ?>
	<div id="r_upd_datetime" class="form-group">
		<label for="x_upd_datetime" class="<?php echo $app_notification_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_upd_datetime" id="u_upd_datetime" class="ewMultiSelect" value="1"<?php echo ($app_notification->upd_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_notification->upd_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_notification_update->RightColumnClass ?>"><div<?php echo $app_notification->upd_datetime->CellAttributes() ?>>
<span id="el_app_notification_upd_datetime">
<input type="text" data-table="app_notification" data-field="x_upd_datetime" data-format="11" name="x_upd_datetime" id="x_upd_datetime" placeholder="<?php echo ew_HtmlEncode($app_notification->upd_datetime->getPlaceHolder()) ?>" value="<?php echo $app_notification->upd_datetime->EditValue ?>"<?php echo $app_notification->upd_datetime->EditAttributes() ?>>
</span>
<?php echo $app_notification->upd_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$app_notification_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $app_notification_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_notification_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_notificationupdate.Init();
</script>
<?php
$app_notification_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_notification_update->Page_Terminate();
?>
