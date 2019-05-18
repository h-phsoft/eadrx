<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "phs_bill_cycleinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$phs_bill_cycle_edit = NULL; // Initialize page object first

class cphs_bill_cycle_edit extends cphs_bill_cycle {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'phs_bill_cycle';

	// Page object name
	var $PageObjName = 'phs_bill_cycle_edit';

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

		// Table object (phs_bill_cycle)
		if (!isset($GLOBALS["phs_bill_cycle"]) || get_class($GLOBALS["phs_bill_cycle"]) == "cphs_bill_cycle") {
			$GLOBALS["phs_bill_cycle"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["phs_bill_cycle"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'phs_bill_cycle', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("phs_bill_cyclelist.php"));
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
		$this->cycle_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->cycle_id->Visible = FALSE;
		$this->cycle_name->SetVisibility();
		$this->cycle_interval->SetVisibility();
		$this->status_id->SetVisibility();
		$this->cycle_desc->SetVisibility();

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
		global $EW_EXPORT, $phs_bill_cycle;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($phs_bill_cycle);
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
					if ($pageName == "phs_bill_cycleview.php")
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
			if ($objForm->HasValue("x_cycle_id")) {
				$this->cycle_id->setFormValue($objForm->GetValue("x_cycle_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["cycle_id"])) {
				$this->cycle_id->setQueryStringValue($_GET["cycle_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->cycle_id->CurrentValue = NULL;
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
			$this->Page_Terminate("phs_bill_cyclelist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->cycle_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->cycle_id->CurrentValue) == strval($this->Recordset->fields('cycle_id'))) {
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
					$this->Page_Terminate("phs_bill_cyclelist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "phs_bill_cyclelist.php")
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
		if (!$this->cycle_id->FldIsDetailKey)
			$this->cycle_id->setFormValue($objForm->GetValue("x_cycle_id"));
		if (!$this->cycle_name->FldIsDetailKey) {
			$this->cycle_name->setFormValue($objForm->GetValue("x_cycle_name"));
		}
		if (!$this->cycle_interval->FldIsDetailKey) {
			$this->cycle_interval->setFormValue($objForm->GetValue("x_cycle_interval"));
		}
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->cycle_desc->FldIsDetailKey) {
			$this->cycle_desc->setFormValue($objForm->GetValue("x_cycle_desc"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->cycle_id->CurrentValue = $this->cycle_id->FormValue;
		$this->cycle_name->CurrentValue = $this->cycle_name->FormValue;
		$this->cycle_interval->CurrentValue = $this->cycle_interval->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->cycle_desc->CurrentValue = $this->cycle_desc->FormValue;
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
		$this->cycle_id->setDbValue($row['cycle_id']);
		$this->cycle_name->setDbValue($row['cycle_name']);
		$this->cycle_interval->setDbValue($row['cycle_interval']);
		$this->status_id->setDbValue($row['status_id']);
		$this->cycle_desc->setDbValue($row['cycle_desc']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['cycle_id'] = NULL;
		$row['cycle_name'] = NULL;
		$row['cycle_interval'] = NULL;
		$row['status_id'] = NULL;
		$row['cycle_desc'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->cycle_id->DbValue = $row['cycle_id'];
		$this->cycle_name->DbValue = $row['cycle_name'];
		$this->cycle_interval->DbValue = $row['cycle_interval'];
		$this->status_id->DbValue = $row['status_id'];
		$this->cycle_desc->DbValue = $row['cycle_desc'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("cycle_id")) <> "")
			$this->cycle_id->CurrentValue = $this->getKey("cycle_id"); // cycle_id
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
		// cycle_id
		// cycle_name
		// cycle_interval
		// status_id
		// cycle_desc

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// cycle_id
		$this->cycle_id->ViewValue = $this->cycle_id->CurrentValue;
		$this->cycle_id->ViewCustomAttributes = "";

		// cycle_name
		$this->cycle_name->ViewValue = $this->cycle_name->CurrentValue;
		$this->cycle_name->ViewCustomAttributes = "";

		// cycle_interval
		$this->cycle_interval->ViewValue = $this->cycle_interval->CurrentValue;
		$this->cycle_interval->ViewCustomAttributes = "";

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

		// cycle_desc
		$this->cycle_desc->ViewValue = $this->cycle_desc->CurrentValue;
		$this->cycle_desc->ViewCustomAttributes = "";

			// cycle_id
			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";
			$this->cycle_id->TooltipValue = "";

			// cycle_name
			$this->cycle_name->LinkCustomAttributes = "";
			$this->cycle_name->HrefValue = "";
			$this->cycle_name->TooltipValue = "";

			// cycle_interval
			$this->cycle_interval->LinkCustomAttributes = "";
			$this->cycle_interval->HrefValue = "";
			$this->cycle_interval->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// cycle_desc
			$this->cycle_desc->LinkCustomAttributes = "";
			$this->cycle_desc->HrefValue = "";
			$this->cycle_desc->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// cycle_id
			$this->cycle_id->EditAttrs["class"] = "form-control";
			$this->cycle_id->EditCustomAttributes = "";
			$this->cycle_id->EditValue = $this->cycle_id->CurrentValue;
			$this->cycle_id->ViewCustomAttributes = "";

			// cycle_name
			$this->cycle_name->EditAttrs["class"] = "form-control";
			$this->cycle_name->EditCustomAttributes = "";
			$this->cycle_name->EditValue = ew_HtmlEncode($this->cycle_name->CurrentValue);
			$this->cycle_name->PlaceHolder = ew_RemoveHtml($this->cycle_name->FldCaption());

			// cycle_interval
			$this->cycle_interval->EditAttrs["class"] = "form-control";
			$this->cycle_interval->EditCustomAttributes = "";
			$this->cycle_interval->EditValue = ew_HtmlEncode($this->cycle_interval->CurrentValue);
			$this->cycle_interval->PlaceHolder = ew_RemoveHtml($this->cycle_interval->FldCaption());

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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// cycle_desc
			$this->cycle_desc->EditAttrs["class"] = "form-control";
			$this->cycle_desc->EditCustomAttributes = "";
			$this->cycle_desc->EditValue = ew_HtmlEncode($this->cycle_desc->CurrentValue);
			$this->cycle_desc->PlaceHolder = ew_RemoveHtml($this->cycle_desc->FldCaption());

			// Edit refer script
			// cycle_id

			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";

			// cycle_name
			$this->cycle_name->LinkCustomAttributes = "";
			$this->cycle_name->HrefValue = "";

			// cycle_interval
			$this->cycle_interval->LinkCustomAttributes = "";
			$this->cycle_interval->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// cycle_desc
			$this->cycle_desc->LinkCustomAttributes = "";
			$this->cycle_desc->HrefValue = "";
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
		if (!$this->cycle_name->FldIsDetailKey && !is_null($this->cycle_name->FormValue) && $this->cycle_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cycle_name->FldCaption(), $this->cycle_name->ReqErrMsg));
		}
		if (!$this->cycle_desc->FldIsDetailKey && !is_null($this->cycle_desc->FormValue) && $this->cycle_desc->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cycle_desc->FldCaption(), $this->cycle_desc->ReqErrMsg));
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
		if ($this->cycle_name->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`cycle_name` = '" . ew_AdjustSql($this->cycle_name->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->cycle_name->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->cycle_name->CurrentValue, $sIdxErrMsg);
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

			// cycle_name
			$this->cycle_name->SetDbValueDef($rsnew, $this->cycle_name->CurrentValue, "", $this->cycle_name->ReadOnly);

			// cycle_interval
			$this->cycle_interval->SetDbValueDef($rsnew, $this->cycle_interval->CurrentValue, "", $this->cycle_interval->ReadOnly);

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly);

			// cycle_desc
			$this->cycle_desc->SetDbValueDef($rsnew, $this->cycle_desc->CurrentValue, "", $this->cycle_desc->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("phs_bill_cyclelist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_status_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `status_id` AS `LinkFld`, `status_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`status_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($phs_bill_cycle_edit)) $phs_bill_cycle_edit = new cphs_bill_cycle_edit();

// Page init
$phs_bill_cycle_edit->Page_Init();

// Page main
$phs_bill_cycle_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phs_bill_cycle_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fphs_bill_cycleedit = new ew_Form("fphs_bill_cycleedit", "edit");

// Validate form
fphs_bill_cycleedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_cycle_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_bill_cycle->cycle_name->FldCaption(), $phs_bill_cycle->cycle_name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cycle_desc");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_bill_cycle->cycle_desc->FldCaption(), $phs_bill_cycle->cycle_desc->ReqErrMsg)) ?>");

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
fphs_bill_cycleedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fphs_bill_cycleedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fphs_bill_cycleedit.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fphs_bill_cycleedit.Lists["x_status_id"].Data = "<?php echo $phs_bill_cycle_edit->status_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $phs_bill_cycle_edit->ShowPageHeader(); ?>
<?php
$phs_bill_cycle_edit->ShowMessage();
?>
<?php if (!$phs_bill_cycle_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($phs_bill_cycle_edit->Pager)) $phs_bill_cycle_edit->Pager = new cPrevNextPager($phs_bill_cycle_edit->StartRec, $phs_bill_cycle_edit->DisplayRecs, $phs_bill_cycle_edit->TotalRecs, $phs_bill_cycle_edit->AutoHidePager) ?>
<?php if ($phs_bill_cycle_edit->Pager->RecordCount > 0 && $phs_bill_cycle_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($phs_bill_cycle_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($phs_bill_cycle_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $phs_bill_cycle_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($phs_bill_cycle_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($phs_bill_cycle_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $phs_bill_cycle_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fphs_bill_cycleedit" id="fphs_bill_cycleedit" class="<?php echo $phs_bill_cycle_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($phs_bill_cycle_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $phs_bill_cycle_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="phs_bill_cycle">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($phs_bill_cycle_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($phs_bill_cycle->cycle_id->Visible) { // cycle_id ?>
	<div id="r_cycle_id" class="form-group">
		<label id="elh_phs_bill_cycle_cycle_id" class="<?php echo $phs_bill_cycle_edit->LeftColumnClass ?>"><?php echo $phs_bill_cycle->cycle_id->FldCaption() ?></label>
		<div class="<?php echo $phs_bill_cycle_edit->RightColumnClass ?>"><div<?php echo $phs_bill_cycle->cycle_id->CellAttributes() ?>>
<span id="el_phs_bill_cycle_cycle_id">
<span<?php echo $phs_bill_cycle->cycle_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_bill_cycle->cycle_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="phs_bill_cycle" data-field="x_cycle_id" name="x_cycle_id" id="x_cycle_id" value="<?php echo ew_HtmlEncode($phs_bill_cycle->cycle_id->CurrentValue) ?>">
<?php echo $phs_bill_cycle->cycle_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_bill_cycle->cycle_name->Visible) { // cycle_name ?>
	<div id="r_cycle_name" class="form-group">
		<label id="elh_phs_bill_cycle_cycle_name" for="x_cycle_name" class="<?php echo $phs_bill_cycle_edit->LeftColumnClass ?>"><?php echo $phs_bill_cycle->cycle_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $phs_bill_cycle_edit->RightColumnClass ?>"><div<?php echo $phs_bill_cycle->cycle_name->CellAttributes() ?>>
<span id="el_phs_bill_cycle_cycle_name">
<input type="text" data-table="phs_bill_cycle" data-field="x_cycle_name" name="x_cycle_name" id="x_cycle_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($phs_bill_cycle->cycle_name->getPlaceHolder()) ?>" value="<?php echo $phs_bill_cycle->cycle_name->EditValue ?>"<?php echo $phs_bill_cycle->cycle_name->EditAttributes() ?>>
</span>
<?php echo $phs_bill_cycle->cycle_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_bill_cycle->cycle_interval->Visible) { // cycle_interval ?>
	<div id="r_cycle_interval" class="form-group">
		<label id="elh_phs_bill_cycle_cycle_interval" for="x_cycle_interval" class="<?php echo $phs_bill_cycle_edit->LeftColumnClass ?>"><?php echo $phs_bill_cycle->cycle_interval->FldCaption() ?></label>
		<div class="<?php echo $phs_bill_cycle_edit->RightColumnClass ?>"><div<?php echo $phs_bill_cycle->cycle_interval->CellAttributes() ?>>
<span id="el_phs_bill_cycle_cycle_interval">
<input type="text" data-table="phs_bill_cycle" data-field="x_cycle_interval" name="x_cycle_interval" id="x_cycle_interval" size="30" maxlength="30" placeholder="<?php echo ew_HtmlEncode($phs_bill_cycle->cycle_interval->getPlaceHolder()) ?>" value="<?php echo $phs_bill_cycle->cycle_interval->EditValue ?>"<?php echo $phs_bill_cycle->cycle_interval->EditAttributes() ?>>
</span>
<?php echo $phs_bill_cycle->cycle_interval->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_bill_cycle->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_phs_bill_cycle_status_id" for="x_status_id" class="<?php echo $phs_bill_cycle_edit->LeftColumnClass ?>"><?php echo $phs_bill_cycle->status_id->FldCaption() ?></label>
		<div class="<?php echo $phs_bill_cycle_edit->RightColumnClass ?>"><div<?php echo $phs_bill_cycle->status_id->CellAttributes() ?>>
<span id="el_phs_bill_cycle_status_id">
<select data-table="phs_bill_cycle" data-field="x_status_id" data-value-separator="<?php echo $phs_bill_cycle->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $phs_bill_cycle->status_id->EditAttributes() ?>>
<?php echo $phs_bill_cycle->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $phs_bill_cycle->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_bill_cycle->cycle_desc->Visible) { // cycle_desc ?>
	<div id="r_cycle_desc" class="form-group">
		<label id="elh_phs_bill_cycle_cycle_desc" for="x_cycle_desc" class="<?php echo $phs_bill_cycle_edit->LeftColumnClass ?>"><?php echo $phs_bill_cycle->cycle_desc->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $phs_bill_cycle_edit->RightColumnClass ?>"><div<?php echo $phs_bill_cycle->cycle_desc->CellAttributes() ?>>
<span id="el_phs_bill_cycle_cycle_desc">
<input type="text" data-table="phs_bill_cycle" data-field="x_cycle_desc" name="x_cycle_desc" id="x_cycle_desc" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($phs_bill_cycle->cycle_desc->getPlaceHolder()) ?>" value="<?php echo $phs_bill_cycle->cycle_desc->EditValue ?>"<?php echo $phs_bill_cycle->cycle_desc->EditAttributes() ?>>
</span>
<?php echo $phs_bill_cycle->cycle_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$phs_bill_cycle_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $phs_bill_cycle_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $phs_bill_cycle_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$phs_bill_cycle_edit->IsModal) { ?>
<?php if (!isset($phs_bill_cycle_edit->Pager)) $phs_bill_cycle_edit->Pager = new cPrevNextPager($phs_bill_cycle_edit->StartRec, $phs_bill_cycle_edit->DisplayRecs, $phs_bill_cycle_edit->TotalRecs, $phs_bill_cycle_edit->AutoHidePager) ?>
<?php if ($phs_bill_cycle_edit->Pager->RecordCount > 0 && $phs_bill_cycle_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($phs_bill_cycle_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($phs_bill_cycle_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $phs_bill_cycle_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($phs_bill_cycle_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($phs_bill_cycle_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $phs_bill_cycle_edit->PageUrl() ?>start=<?php echo $phs_bill_cycle_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $phs_bill_cycle_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fphs_bill_cycleedit.Init();
</script>
<?php
$phs_bill_cycle_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$phs_bill_cycle_edit->Page_Terminate();
?>
