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

$app_notification_edit = NULL; // Initialize page object first

class capp_notification_edit extends capp_notification {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_notification';

	// Page object name
	var $PageObjName = 'app_notification_edit';

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
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $RecCnt;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_notif_id")) {
				$this->notif_id->setFormValue($objForm->GetValue("x_notif_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["notif_id"])) {
				$this->notif_id->setQueryStringValue($_GET["notif_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->notif_id->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("app_notificationlist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->notif_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->notif_id->CurrentValue) == strval($this->Recordset->fields('notif_id'))) {
						$this->setStartRecordNumber($this->StartRec); // Save record position
						$loaded = TRUE;
						break;
					} else {
						$this->StartRec++;
						$this->Recordset->MoveNext();
					}
				}
			}
		}

		// Load current row values
		if ($loaded)
			$this->LoadRowValues($this->Recordset);

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("app_notificationlist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "app_notificationlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->SetupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
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
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		if (!$this->nstatus_id->FldIsDetailKey) {
			$this->nstatus_id->setFormValue($objForm->GetValue("x_nstatus_id"));
		}
		if (!$this->notif_title->FldIsDetailKey) {
			$this->notif_title->setFormValue($objForm->GetValue("x_notif_title"));
		}
		if (!$this->notif_text->FldIsDetailKey) {
			$this->notif_text->setFormValue($objForm->GetValue("x_notif_text"));
		}
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("notif_id")) <> "")
			$this->notif_id->CurrentValue = $this->getKey("notif_id"); // notif_id
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->notif_title->FldIsDetailKey && !is_null($this->notif_title->FormValue) && $this->notif_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->notif_title->FldCaption(), $this->notif_title->ReqErrMsg));
		}
		if (!$this->notif_text->FldIsDetailKey && !is_null($this->notif_text->FormValue) && $this->notif_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->notif_text->FldCaption(), $this->notif_text->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("app_notification_for", $DetailTblVar) && $GLOBALS["app_notification_for"]->DetailEdit) {
			if (!isset($GLOBALS["app_notification_for_grid"])) $GLOBALS["app_notification_for_grid"] = new capp_notification_for_grid(); // get detail page object
			$GLOBALS["app_notification_for_grid"]->ValidateGridForm();
		}
		if (in_array("app_notification_status", $DetailTblVar) && $GLOBALS["app_notification_status"]->DetailEdit) {
			if (!isset($GLOBALS["app_notification_status_grid"])) $GLOBALS["app_notification_status_grid"] = new capp_notification_status_grid(); // get detail page object
			$GLOBALS["app_notification_status_grid"]->ValidateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// for_id
			$this->for_id->SetDbValueDef($rsnew, $this->for_id->CurrentValue, 0, $this->for_id->ReadOnly);

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly);

			// nstatus_id
			$this->nstatus_id->SetDbValueDef($rsnew, $this->nstatus_id->CurrentValue, 0, $this->nstatus_id->ReadOnly);

			// notif_title
			$this->notif_title->SetDbValueDef($rsnew, $this->notif_title->CurrentValue, "", $this->notif_title->ReadOnly);

			// notif_text
			$this->notif_text->SetDbValueDef($rsnew, $this->notif_text->CurrentValue, "", $this->notif_text->ReadOnly);

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

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("app_notification_for", $DetailTblVar) && $GLOBALS["app_notification_for"]->DetailEdit) {
						if (!isset($GLOBALS["app_notification_for_grid"])) $GLOBALS["app_notification_for_grid"] = new capp_notification_for_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "app_notification_for"); // Load user level of detail table
						$EditRow = $GLOBALS["app_notification_for_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($EditRow) {
					if (in_array("app_notification_status", $DetailTblVar) && $GLOBALS["app_notification_status"]->DetailEdit) {
						if (!isset($GLOBALS["app_notification_status_grid"])) $GLOBALS["app_notification_status_grid"] = new capp_notification_status_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "app_notification_status"); // Load user level of detail table
						$EditRow = $GLOBALS["app_notification_status_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
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

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("app_notification_for", $DetailTblVar)) {
				if (!isset($GLOBALS["app_notification_for_grid"]))
					$GLOBALS["app_notification_for_grid"] = new capp_notification_for_grid;
				if ($GLOBALS["app_notification_for_grid"]->DetailEdit) {
					$GLOBALS["app_notification_for_grid"]->CurrentMode = "edit";
					$GLOBALS["app_notification_for_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["app_notification_for_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_notification_for_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_notification_for_grid"]->notif_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_notification_for_grid"]->notif_id->CurrentValue = $this->notif_id->CurrentValue;
					$GLOBALS["app_notification_for_grid"]->notif_id->setSessionValue($GLOBALS["app_notification_for_grid"]->notif_id->CurrentValue);
				}
			}
			if (in_array("app_notification_status", $DetailTblVar)) {
				if (!isset($GLOBALS["app_notification_status_grid"]))
					$GLOBALS["app_notification_status_grid"] = new capp_notification_status_grid;
				if ($GLOBALS["app_notification_status_grid"]->DetailEdit) {
					$GLOBALS["app_notification_status_grid"]->CurrentMode = "edit";
					$GLOBALS["app_notification_status_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["app_notification_status_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_notification_status_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_notification_status_grid"]->notif_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_notification_status_grid"]->notif_id->CurrentValue = $this->notif_id->CurrentValue;
					$GLOBALS["app_notification_status_grid"]->notif_id->setSessionValue($GLOBALS["app_notification_status_grid"]->notif_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_notificationlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
if (!isset($app_notification_edit)) $app_notification_edit = new capp_notification_edit();

// Page init
$app_notification_edit->Page_Init();

// Page main
$app_notification_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_notification_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fapp_notificationedit = new ew_Form("fapp_notificationedit", "edit");

// Validate form
fapp_notificationedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_notif_title");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification->notif_title->FldCaption(), $app_notification->notif_title->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_notif_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_notification->notif_text->FldCaption(), $app_notification->notif_text->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_notificationedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_notificationedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_notificationedit.Lists["x_for_id"] = {"LinkField":"x_for_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_for_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_for"};
fapp_notificationedit.Lists["x_for_id"].Data = "<?php echo $app_notification_edit->for_id->LookupFilterQuery(FALSE, "edit") ?>";
fapp_notificationedit.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_notificationedit.Lists["x_lang_id"].Data = "<?php echo $app_notification_edit->lang_id->LookupFilterQuery(FALSE, "edit") ?>";
fapp_notificationedit.Lists["x_nstatus_id"] = {"LinkField":"x_nstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_notif_status"};
fapp_notificationedit.Lists["x_nstatus_id"].Data = "<?php echo $app_notification_edit->nstatus_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_notification_edit->ShowPageHeader(); ?>
<?php
$app_notification_edit->ShowMessage();
?>
<?php if (!$app_notification_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_notification_edit->Pager)) $app_notification_edit->Pager = new cPrevNextPager($app_notification_edit->StartRec, $app_notification_edit->DisplayRecs, $app_notification_edit->TotalRecs, $app_notification_edit->AutoHidePager) ?>
<?php if ($app_notification_edit->Pager->RecordCount > 0 && $app_notification_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_notification_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_notification_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_notification_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_notification_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_notification_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_notification_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fapp_notificationedit" id="fapp_notificationedit" class="<?php echo $app_notification_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_notification_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_notification_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_notification">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_notification_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($app_notification->for_id->Visible) { // for_id ?>
	<div id="r_for_id" class="form-group">
		<label id="elh_app_notification_for_id" for="x_for_id" class="<?php echo $app_notification_edit->LeftColumnClass ?>"><?php echo $app_notification->for_id->FldCaption() ?></label>
		<div class="<?php echo $app_notification_edit->RightColumnClass ?>"><div<?php echo $app_notification->for_id->CellAttributes() ?>>
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
		<label id="elh_app_notification_lang_id" for="x_lang_id" class="<?php echo $app_notification_edit->LeftColumnClass ?>"><?php echo $app_notification->lang_id->FldCaption() ?></label>
		<div class="<?php echo $app_notification_edit->RightColumnClass ?>"><div<?php echo $app_notification->lang_id->CellAttributes() ?>>
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
		<label id="elh_app_notification_nstatus_id" for="x_nstatus_id" class="<?php echo $app_notification_edit->LeftColumnClass ?>"><?php echo $app_notification->nstatus_id->FldCaption() ?></label>
		<div class="<?php echo $app_notification_edit->RightColumnClass ?>"><div<?php echo $app_notification->nstatus_id->CellAttributes() ?>>
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
		<label id="elh_app_notification_notif_title" for="x_notif_title" class="<?php echo $app_notification_edit->LeftColumnClass ?>"><?php echo $app_notification->notif_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_notification_edit->RightColumnClass ?>"><div<?php echo $app_notification->notif_title->CellAttributes() ?>>
<span id="el_app_notification_notif_title">
<input type="text" data-table="app_notification" data-field="x_notif_title" name="x_notif_title" id="x_notif_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_notification->notif_title->getPlaceHolder()) ?>" value="<?php echo $app_notification->notif_title->EditValue ?>"<?php echo $app_notification->notif_title->EditAttributes() ?>>
</span>
<?php echo $app_notification->notif_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_notification->notif_text->Visible) { // notif_text ?>
	<div id="r_notif_text" class="form-group">
		<label id="elh_app_notification_notif_text" for="x_notif_text" class="<?php echo $app_notification_edit->LeftColumnClass ?>"><?php echo $app_notification->notif_text->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_notification_edit->RightColumnClass ?>"><div<?php echo $app_notification->notif_text->CellAttributes() ?>>
<span id="el_app_notification_notif_text">
<textarea data-table="app_notification" data-field="x_notif_text" name="x_notif_text" id="x_notif_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_notification->notif_text->getPlaceHolder()) ?>"<?php echo $app_notification->notif_text->EditAttributes() ?>><?php echo $app_notification->notif_text->EditValue ?></textarea>
</span>
<?php echo $app_notification->notif_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="app_notification" data-field="x_notif_id" name="x_notif_id" id="x_notif_id" value="<?php echo ew_HtmlEncode($app_notification->notif_id->CurrentValue) ?>">
<?php
	if (in_array("app_notification_for", explode(",", $app_notification->getCurrentDetailTable())) && $app_notification_for->DetailEdit) {
?>
<?php if ($app_notification->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_notification_for", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_notification_forgrid.php" ?>
<?php } ?>
<?php
	if (in_array("app_notification_status", explode(",", $app_notification->getCurrentDetailTable())) && $app_notification_status->DetailEdit) {
?>
<?php if ($app_notification->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_notification_status", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_notification_statusgrid.php" ?>
<?php } ?>
<?php if (!$app_notification_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_notification_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_notification_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$app_notification_edit->IsModal) { ?>
<?php if (!isset($app_notification_edit->Pager)) $app_notification_edit->Pager = new cPrevNextPager($app_notification_edit->StartRec, $app_notification_edit->DisplayRecs, $app_notification_edit->TotalRecs, $app_notification_edit->AutoHidePager) ?>
<?php if ($app_notification_edit->Pager->RecordCount > 0 && $app_notification_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_notification_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_notification_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_notification_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_notification_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_notification_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_notification_edit->PageUrl() ?>start=<?php echo $app_notification_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_notification_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fapp_notificationedit.Init();
</script>
<?php
$app_notification_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_notification_edit->Page_Terminate();
?>
