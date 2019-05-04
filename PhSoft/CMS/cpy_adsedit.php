<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_adsinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_ads_edit = NULL; // Initialize page object first

class ccpy_ads_edit extends ccpy_ads {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_ads';

	// Page object name
	var $PageObjName = 'cpy_ads_edit';

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

		// Table object (cpy_ads)
		if (!isset($GLOBALS["cpy_ads"]) || get_class($GLOBALS["cpy_ads"]) == "ccpy_ads") {
			$GLOBALS["cpy_ads"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_ads"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_ads', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_adslist.php"));
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
		$this->status_id->SetVisibility();
		$this->repeat_id->SetVisibility();
		$this->every_id->SetVisibility();
		$this->ads_title->SetVisibility();
		$this->ads_desc->SetVisibility();
		$this->ads_sdate->SetVisibility();
		$this->ads_edate->SetVisibility();
		$this->hour_sid->SetVisibility();
		$this->hour_eid->SetVisibility();
		$this->ads_image->SetVisibility();
		$this->ads_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_ads;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_ads);
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
					if ($pageName == "cpy_adsview.php")
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
			if ($objForm->HasValue("x_ads_id")) {
				$this->ads_id->setFormValue($objForm->GetValue("x_ads_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["ads_id"])) {
				$this->ads_id->setQueryStringValue($_GET["ads_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->ads_id->CurrentValue = NULL;
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
			$this->Page_Terminate("cpy_adslist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->ads_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->ads_id->CurrentValue) == strval($this->Recordset->fields('ads_id'))) {
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
					$this->Page_Terminate("cpy_adslist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "cpy_adslist.php")
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
		$this->ads_image->Upload->Index = $objForm->Index;
		$this->ads_image->Upload->UploadFile();
		$this->ads_image->CurrentValue = $this->ads_image->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->repeat_id->FldIsDetailKey) {
			$this->repeat_id->setFormValue($objForm->GetValue("x_repeat_id"));
		}
		if (!$this->every_id->FldIsDetailKey) {
			$this->every_id->setFormValue($objForm->GetValue("x_every_id"));
		}
		if (!$this->ads_title->FldIsDetailKey) {
			$this->ads_title->setFormValue($objForm->GetValue("x_ads_title"));
		}
		if (!$this->ads_desc->FldIsDetailKey) {
			$this->ads_desc->setFormValue($objForm->GetValue("x_ads_desc"));
		}
		if (!$this->ads_sdate->FldIsDetailKey) {
			$this->ads_sdate->setFormValue($objForm->GetValue("x_ads_sdate"));
			$this->ads_sdate->CurrentValue = ew_UnFormatDateTime($this->ads_sdate->CurrentValue, 0);
		}
		if (!$this->ads_edate->FldIsDetailKey) {
			$this->ads_edate->setFormValue($objForm->GetValue("x_ads_edate"));
			$this->ads_edate->CurrentValue = ew_UnFormatDateTime($this->ads_edate->CurrentValue, 0);
		}
		if (!$this->hour_sid->FldIsDetailKey) {
			$this->hour_sid->setFormValue($objForm->GetValue("x_hour_sid"));
		}
		if (!$this->hour_eid->FldIsDetailKey) {
			$this->hour_eid->setFormValue($objForm->GetValue("x_hour_eid"));
		}
		if (!$this->ads_text->FldIsDetailKey) {
			$this->ads_text->setFormValue($objForm->GetValue("x_ads_text"));
		}
		if (!$this->ads_id->FldIsDetailKey)
			$this->ads_id->setFormValue($objForm->GetValue("x_ads_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->ads_id->CurrentValue = $this->ads_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->repeat_id->CurrentValue = $this->repeat_id->FormValue;
		$this->every_id->CurrentValue = $this->every_id->FormValue;
		$this->ads_title->CurrentValue = $this->ads_title->FormValue;
		$this->ads_desc->CurrentValue = $this->ads_desc->FormValue;
		$this->ads_sdate->CurrentValue = $this->ads_sdate->FormValue;
		$this->ads_sdate->CurrentValue = ew_UnFormatDateTime($this->ads_sdate->CurrentValue, 0);
		$this->ads_edate->CurrentValue = $this->ads_edate->FormValue;
		$this->ads_edate->CurrentValue = ew_UnFormatDateTime($this->ads_edate->CurrentValue, 0);
		$this->hour_sid->CurrentValue = $this->hour_sid->FormValue;
		$this->hour_eid->CurrentValue = $this->hour_eid->FormValue;
		$this->ads_text->CurrentValue = $this->ads_text->FormValue;
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
		$this->ads_id->setDbValue($row['ads_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->repeat_id->setDbValue($row['repeat_id']);
		$this->every_id->setDbValue($row['every_id']);
		$this->ads_title->setDbValue($row['ads_title']);
		$this->ads_desc->setDbValue($row['ads_desc']);
		$this->ads_sdate->setDbValue($row['ads_sdate']);
		$this->ads_edate->setDbValue($row['ads_edate']);
		$this->hour_sid->setDbValue($row['hour_sid']);
		$this->hour_eid->setDbValue($row['hour_eid']);
		$this->ads_image->Upload->DbValue = $row['ads_image'];
		$this->ads_image->setDbValue($this->ads_image->Upload->DbValue);
		$this->ads_text->setDbValue($row['ads_text']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['ads_id'] = NULL;
		$row['status_id'] = NULL;
		$row['repeat_id'] = NULL;
		$row['every_id'] = NULL;
		$row['ads_title'] = NULL;
		$row['ads_desc'] = NULL;
		$row['ads_sdate'] = NULL;
		$row['ads_edate'] = NULL;
		$row['hour_sid'] = NULL;
		$row['hour_eid'] = NULL;
		$row['ads_image'] = NULL;
		$row['ads_text'] = NULL;
		$row['ins_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ads_id->DbValue = $row['ads_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->repeat_id->DbValue = $row['repeat_id'];
		$this->every_id->DbValue = $row['every_id'];
		$this->ads_title->DbValue = $row['ads_title'];
		$this->ads_desc->DbValue = $row['ads_desc'];
		$this->ads_sdate->DbValue = $row['ads_sdate'];
		$this->ads_edate->DbValue = $row['ads_edate'];
		$this->hour_sid->DbValue = $row['hour_sid'];
		$this->hour_eid->DbValue = $row['hour_eid'];
		$this->ads_image->Upload->DbValue = $row['ads_image'];
		$this->ads_text->DbValue = $row['ads_text'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("ads_id")) <> "")
			$this->ads_id->CurrentValue = $this->getKey("ads_id"); // ads_id
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
		// ads_id
		// status_id
		// repeat_id
		// every_id
		// ads_title
		// ads_desc
		// ads_sdate
		// ads_edate
		// hour_sid
		// hour_eid
		// ads_image
		// ads_text
		// ins_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

		// repeat_id
		if (strval($this->repeat_id->CurrentValue) <> "") {
			$sFilterWrk = "`repeat_id`" . ew_SearchString("=", $this->repeat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `repeat_id`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_repeat`";
		$sWhereWrk = "";
		$this->repeat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `repeat_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->repeat_id->ViewValue = $this->repeat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->repeat_id->ViewValue = $this->repeat_id->CurrentValue;
			}
		} else {
			$this->repeat_id->ViewValue = NULL;
		}
		$this->repeat_id->ViewCustomAttributes = "";

		// every_id
		if (strval($this->every_id->CurrentValue) <> "") {
			$sFilterWrk = "`every_id`" . ew_SearchString("=", $this->every_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `every_id`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_every`";
		$sWhereWrk = "";
		$this->every_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `every_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->every_id->ViewValue = $this->every_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->every_id->ViewValue = $this->every_id->CurrentValue;
			}
		} else {
			$this->every_id->ViewValue = NULL;
		}
		$this->every_id->ViewCustomAttributes = "";

		// ads_title
		$this->ads_title->ViewValue = $this->ads_title->CurrentValue;
		$this->ads_title->ViewCustomAttributes = "";

		// ads_desc
		$this->ads_desc->ViewValue = $this->ads_desc->CurrentValue;
		$this->ads_desc->ViewCustomAttributes = "";

		// ads_sdate
		$this->ads_sdate->ViewValue = $this->ads_sdate->CurrentValue;
		$this->ads_sdate->ViewValue = ew_FormatDateTime($this->ads_sdate->ViewValue, 0);
		$this->ads_sdate->ViewCustomAttributes = "";

		// ads_edate
		$this->ads_edate->ViewValue = $this->ads_edate->CurrentValue;
		$this->ads_edate->ViewValue = ew_FormatDateTime($this->ads_edate->ViewValue, 0);
		$this->ads_edate->ViewCustomAttributes = "";

		// hour_sid
		if (strval($this->hour_sid->CurrentValue) <> "") {
			$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_sid->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
		$sWhereWrk = "";
		$this->hour_sid->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->hour_sid->ViewValue = $this->hour_sid->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->hour_sid->ViewValue = $this->hour_sid->CurrentValue;
			}
		} else {
			$this->hour_sid->ViewValue = NULL;
		}
		$this->hour_sid->ViewCustomAttributes = "";

		// hour_eid
		if (strval($this->hour_eid->CurrentValue) <> "") {
			$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_eid->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
		$sWhereWrk = "";
		$this->hour_eid->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->hour_eid->ViewValue = $this->hour_eid->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->hour_eid->ViewValue = $this->hour_eid->CurrentValue;
			}
		} else {
			$this->hour_eid->ViewValue = NULL;
		}
		$this->hour_eid->ViewCustomAttributes = "";

		// ads_image
		$this->ads_image->UploadPath = '../../assets/img/adsImages';
		if (!ew_Empty($this->ads_image->Upload->DbValue)) {
			$this->ads_image->ImageWidth = 200;
			$this->ads_image->ImageHeight = 0;
			$this->ads_image->ImageAlt = $this->ads_image->FldAlt();
			$this->ads_image->ViewValue = $this->ads_image->Upload->DbValue;
		} else {
			$this->ads_image->ViewValue = "";
		}
		$this->ads_image->ViewCustomAttributes = "";

		// ads_text
		$this->ads_text->ViewValue = $this->ads_text->CurrentValue;
		$this->ads_text->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// repeat_id
			$this->repeat_id->LinkCustomAttributes = "";
			$this->repeat_id->HrefValue = "";
			$this->repeat_id->TooltipValue = "";

			// every_id
			$this->every_id->LinkCustomAttributes = "";
			$this->every_id->HrefValue = "";
			$this->every_id->TooltipValue = "";

			// ads_title
			$this->ads_title->LinkCustomAttributes = "";
			$this->ads_title->HrefValue = "";
			$this->ads_title->TooltipValue = "";

			// ads_desc
			$this->ads_desc->LinkCustomAttributes = "";
			$this->ads_desc->HrefValue = "";
			$this->ads_desc->TooltipValue = "";

			// ads_sdate
			$this->ads_sdate->LinkCustomAttributes = "";
			$this->ads_sdate->HrefValue = "";
			$this->ads_sdate->TooltipValue = "";

			// ads_edate
			$this->ads_edate->LinkCustomAttributes = "";
			$this->ads_edate->HrefValue = "";
			$this->ads_edate->TooltipValue = "";

			// hour_sid
			$this->hour_sid->LinkCustomAttributes = "";
			$this->hour_sid->HrefValue = "";
			$this->hour_sid->TooltipValue = "";

			// hour_eid
			$this->hour_eid->LinkCustomAttributes = "";
			$this->hour_eid->HrefValue = "";
			$this->hour_eid->TooltipValue = "";

			// ads_image
			$this->ads_image->LinkCustomAttributes = "";
			$this->ads_image->UploadPath = '../../assets/img/adsImages';
			if (!ew_Empty($this->ads_image->Upload->DbValue)) {
				$this->ads_image->HrefValue = ew_GetFileUploadUrl($this->ads_image, $this->ads_image->Upload->DbValue); // Add prefix/suffix
				$this->ads_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->ads_image->HrefValue = ew_FullUrl($this->ads_image->HrefValue, "href");
			} else {
				$this->ads_image->HrefValue = "";
			}
			$this->ads_image->HrefValue2 = $this->ads_image->UploadPath . $this->ads_image->Upload->DbValue;
			$this->ads_image->TooltipValue = "";
			if ($this->ads_image->UseColorbox) {
				if (ew_Empty($this->ads_image->TooltipValue))
					$this->ads_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->ads_image->LinkAttrs["data-rel"] = "cpy_ads_x_ads_image";
				ew_AppendClass($this->ads_image->LinkAttrs["class"], "ewLightbox");
			}

			// ads_text
			$this->ads_text->LinkCustomAttributes = "";
			$this->ads_text->HrefValue = "";
			$this->ads_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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

			// repeat_id
			$this->repeat_id->EditAttrs["class"] = "form-control";
			$this->repeat_id->EditCustomAttributes = "";
			if (trim(strval($this->repeat_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`repeat_id`" . ew_SearchString("=", $this->repeat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `repeat_id`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_repeat`";
			$sWhereWrk = "";
			$this->repeat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `repeat_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->repeat_id->EditValue = $arwrk;

			// every_id
			$this->every_id->EditAttrs["class"] = "form-control";
			$this->every_id->EditCustomAttributes = "";
			if (trim(strval($this->every_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`every_id`" . ew_SearchString("=", $this->every_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `every_id`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_every`";
			$sWhereWrk = "";
			$this->every_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `every_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->every_id->EditValue = $arwrk;

			// ads_title
			$this->ads_title->EditAttrs["class"] = "form-control";
			$this->ads_title->EditCustomAttributes = "";
			$this->ads_title->EditValue = ew_HtmlEncode($this->ads_title->CurrentValue);
			$this->ads_title->PlaceHolder = ew_RemoveHtml($this->ads_title->FldCaption());

			// ads_desc
			$this->ads_desc->EditAttrs["class"] = "form-control";
			$this->ads_desc->EditCustomAttributes = "";
			$this->ads_desc->EditValue = ew_HtmlEncode($this->ads_desc->CurrentValue);
			$this->ads_desc->PlaceHolder = ew_RemoveHtml($this->ads_desc->FldCaption());

			// ads_sdate
			$this->ads_sdate->EditAttrs["class"] = "form-control";
			$this->ads_sdate->EditCustomAttributes = "";
			$this->ads_sdate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ads_sdate->CurrentValue, 8));
			$this->ads_sdate->PlaceHolder = ew_RemoveHtml($this->ads_sdate->FldCaption());

			// ads_edate
			$this->ads_edate->EditAttrs["class"] = "form-control";
			$this->ads_edate->EditCustomAttributes = "";
			$this->ads_edate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ads_edate->CurrentValue, 8));
			$this->ads_edate->PlaceHolder = ew_RemoveHtml($this->ads_edate->FldCaption());

			// hour_sid
			$this->hour_sid->EditAttrs["class"] = "form-control";
			$this->hour_sid->EditCustomAttributes = "";
			if (trim(strval($this->hour_sid->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_sid->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_hour`";
			$sWhereWrk = "";
			$this->hour_sid->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->hour_sid->EditValue = $arwrk;

			// hour_eid
			$this->hour_eid->EditAttrs["class"] = "form-control";
			$this->hour_eid->EditCustomAttributes = "";
			if (trim(strval($this->hour_eid->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_eid->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_hour`";
			$sWhereWrk = "";
			$this->hour_eid->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->hour_eid->EditValue = $arwrk;

			// ads_image
			$this->ads_image->EditAttrs["class"] = "form-control";
			$this->ads_image->EditCustomAttributes = "";
			$this->ads_image->UploadPath = '../../assets/img/adsImages';
			if (!ew_Empty($this->ads_image->Upload->DbValue)) {
				$this->ads_image->ImageWidth = 200;
				$this->ads_image->ImageHeight = 0;
				$this->ads_image->ImageAlt = $this->ads_image->FldAlt();
				$this->ads_image->EditValue = $this->ads_image->Upload->DbValue;
			} else {
				$this->ads_image->EditValue = "";
			}
			if (!ew_Empty($this->ads_image->CurrentValue))
					$this->ads_image->Upload->FileName = $this->ads_image->CurrentValue;
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->ads_image);

			// ads_text
			$this->ads_text->EditAttrs["class"] = "form-control";
			$this->ads_text->EditCustomAttributes = "";
			$this->ads_text->EditValue = ew_HtmlEncode($this->ads_text->CurrentValue);
			$this->ads_text->PlaceHolder = ew_RemoveHtml($this->ads_text->FldCaption());

			// Edit refer script
			// status_id

			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// repeat_id
			$this->repeat_id->LinkCustomAttributes = "";
			$this->repeat_id->HrefValue = "";

			// every_id
			$this->every_id->LinkCustomAttributes = "";
			$this->every_id->HrefValue = "";

			// ads_title
			$this->ads_title->LinkCustomAttributes = "";
			$this->ads_title->HrefValue = "";

			// ads_desc
			$this->ads_desc->LinkCustomAttributes = "";
			$this->ads_desc->HrefValue = "";

			// ads_sdate
			$this->ads_sdate->LinkCustomAttributes = "";
			$this->ads_sdate->HrefValue = "";

			// ads_edate
			$this->ads_edate->LinkCustomAttributes = "";
			$this->ads_edate->HrefValue = "";

			// hour_sid
			$this->hour_sid->LinkCustomAttributes = "";
			$this->hour_sid->HrefValue = "";

			// hour_eid
			$this->hour_eid->LinkCustomAttributes = "";
			$this->hour_eid->HrefValue = "";

			// ads_image
			$this->ads_image->LinkCustomAttributes = "";
			$this->ads_image->UploadPath = '../../assets/img/adsImages';
			if (!ew_Empty($this->ads_image->Upload->DbValue)) {
				$this->ads_image->HrefValue = ew_GetFileUploadUrl($this->ads_image, $this->ads_image->Upload->DbValue); // Add prefix/suffix
				$this->ads_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->ads_image->HrefValue = ew_FullUrl($this->ads_image->HrefValue, "href");
			} else {
				$this->ads_image->HrefValue = "";
			}
			$this->ads_image->HrefValue2 = $this->ads_image->UploadPath . $this->ads_image->Upload->DbValue;

			// ads_text
			$this->ads_text->LinkCustomAttributes = "";
			$this->ads_text->HrefValue = "";
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
		if (!$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if (!$this->repeat_id->FldIsDetailKey && !is_null($this->repeat_id->FormValue) && $this->repeat_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->repeat_id->FldCaption(), $this->repeat_id->ReqErrMsg));
		}
		if (!$this->every_id->FldIsDetailKey && !is_null($this->every_id->FormValue) && $this->every_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->every_id->FldCaption(), $this->every_id->ReqErrMsg));
		}
		if (!$this->ads_title->FldIsDetailKey && !is_null($this->ads_title->FormValue) && $this->ads_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ads_title->FldCaption(), $this->ads_title->ReqErrMsg));
		}
		if (!$this->ads_desc->FldIsDetailKey && !is_null($this->ads_desc->FormValue) && $this->ads_desc->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ads_desc->FldCaption(), $this->ads_desc->ReqErrMsg));
		}
		if (!$this->ads_sdate->FldIsDetailKey && !is_null($this->ads_sdate->FormValue) && $this->ads_sdate->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ads_sdate->FldCaption(), $this->ads_sdate->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->ads_sdate->FormValue)) {
			ew_AddMessage($gsFormError, $this->ads_sdate->FldErrMsg());
		}
		if (!$this->ads_edate->FldIsDetailKey && !is_null($this->ads_edate->FormValue) && $this->ads_edate->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ads_edate->FldCaption(), $this->ads_edate->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->ads_edate->FormValue)) {
			ew_AddMessage($gsFormError, $this->ads_edate->FldErrMsg());
		}
		if (!$this->hour_sid->FldIsDetailKey && !is_null($this->hour_sid->FormValue) && $this->hour_sid->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->hour_sid->FldCaption(), $this->hour_sid->ReqErrMsg));
		}
		if (!$this->hour_eid->FldIsDetailKey && !is_null($this->hour_eid->FormValue) && $this->hour_eid->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->hour_eid->FldCaption(), $this->hour_eid->ReqErrMsg));
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
			$this->ads_image->OldUploadPath = '../../assets/img/adsImages';
			$this->ads_image->UploadPath = $this->ads_image->OldUploadPath;
			$rsnew = array();

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly);

			// repeat_id
			$this->repeat_id->SetDbValueDef($rsnew, $this->repeat_id->CurrentValue, 0, $this->repeat_id->ReadOnly);

			// every_id
			$this->every_id->SetDbValueDef($rsnew, $this->every_id->CurrentValue, 0, $this->every_id->ReadOnly);

			// ads_title
			$this->ads_title->SetDbValueDef($rsnew, $this->ads_title->CurrentValue, "", $this->ads_title->ReadOnly);

			// ads_desc
			$this->ads_desc->SetDbValueDef($rsnew, $this->ads_desc->CurrentValue, "", $this->ads_desc->ReadOnly);

			// ads_sdate
			$this->ads_sdate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ads_sdate->CurrentValue, 0), ew_CurrentDate(), $this->ads_sdate->ReadOnly);

			// ads_edate
			$this->ads_edate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ads_edate->CurrentValue, 0), ew_CurrentDate(), $this->ads_edate->ReadOnly);

			// hour_sid
			$this->hour_sid->SetDbValueDef($rsnew, $this->hour_sid->CurrentValue, 0, $this->hour_sid->ReadOnly);

			// hour_eid
			$this->hour_eid->SetDbValueDef($rsnew, $this->hour_eid->CurrentValue, 0, $this->hour_eid->ReadOnly);

			// ads_image
			if ($this->ads_image->Visible && !$this->ads_image->ReadOnly && !$this->ads_image->Upload->KeepFile) {
				$this->ads_image->Upload->DbValue = $rsold['ads_image']; // Get original value
				if ($this->ads_image->Upload->FileName == "") {
					$rsnew['ads_image'] = NULL;
				} else {
					$rsnew['ads_image'] = $this->ads_image->Upload->FileName;
				}
			}

			// ads_text
			$this->ads_text->SetDbValueDef($rsnew, $this->ads_text->CurrentValue, NULL, $this->ads_text->ReadOnly);
			if ($this->ads_image->Visible && !$this->ads_image->Upload->KeepFile) {
				$this->ads_image->UploadPath = '../../assets/img/adsImages';
				$OldFiles = ew_Empty($this->ads_image->Upload->DbValue) ? array() : array($this->ads_image->Upload->DbValue);
				if (!ew_Empty($this->ads_image->Upload->FileName)) {
					$NewFiles = array($this->ads_image->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->ads_image->Upload->Index < 0) ? $this->ads_image->FldVar : substr($this->ads_image->FldVar, 0, 1) . $this->ads_image->Upload->Index . substr($this->ads_image->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->ads_image->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->ads_image->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->ads_image->TblVar) . $file1) || file_exists($this->ads_image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->ads_image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->ads_image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->ads_image->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->ads_image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->ads_image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->ads_image->SetDbValueDef($rsnew, $this->ads_image->Upload->FileName, NULL, $this->ads_image->ReadOnly);
				}
			}

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
					if ($this->ads_image->Visible && !$this->ads_image->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->ads_image->Upload->DbValue) ? array() : array($this->ads_image->Upload->DbValue);
						if (!ew_Empty($this->ads_image->Upload->FileName)) {
							$NewFiles = array($this->ads_image->Upload->FileName);
							$NewFiles2 = array($rsnew['ads_image']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->ads_image->Upload->Index < 0) ? $this->ads_image->FldVar : substr($this->ads_image->FldVar, 0, 1) . $this->ads_image->Upload->Index . substr($this->ads_image->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->ads_image->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->ads_image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$NewFiles = array();
						}
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

		// ads_image
		ew_CleanUploadTempPath($this->ads_image, $this->ads_image->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_adslist.php"), "", $this->TableVar, TRUE);
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
			$sSqlWrk .= " ORDER BY `status_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_repeat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `repeat_id` AS `LinkFld`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_repeat`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`repeat_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `repeat_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_every_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `every_id` AS `LinkFld`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_every`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`every_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `every_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_hour_sid":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `hour_id` AS `LinkFld`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`hour_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_hour_eid":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `hour_id` AS `LinkFld`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`hour_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
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
if (!isset($cpy_ads_edit)) $cpy_ads_edit = new ccpy_ads_edit();

// Page init
$cpy_ads_edit->Page_Init();

// Page main
$cpy_ads_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_ads_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fcpy_adsedit = new ew_Form("fcpy_adsedit", "edit");

// Validate form
fcpy_adsedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->status_id->FldCaption(), $cpy_ads->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_repeat_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->repeat_id->FldCaption(), $cpy_ads->repeat_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_every_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->every_id->FldCaption(), $cpy_ads->every_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ads_title");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->ads_title->FldCaption(), $cpy_ads->ads_title->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ads_desc");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->ads_desc->FldCaption(), $cpy_ads->ads_desc->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ads_sdate");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->ads_sdate->FldCaption(), $cpy_ads->ads_sdate->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ads_sdate");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_ads->ads_sdate->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ads_edate");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->ads_edate->FldCaption(), $cpy_ads->ads_edate->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ads_edate");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_ads->ads_edate->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_hour_sid");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->hour_sid->FldCaption(), $cpy_ads->hour_sid->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_hour_eid");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_ads->hour_eid->FldCaption(), $cpy_ads->hour_eid->ReqErrMsg)) ?>");

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
fcpy_adsedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_adsedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_adsedit.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_adsedit.Lists["x_status_id"].Data = "<?php echo $cpy_ads_edit->status_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_adsedit.Lists["x_repeat_id"] = {"LinkField":"x_repeat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_repeat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_repeat"};
fcpy_adsedit.Lists["x_repeat_id"].Data = "<?php echo $cpy_ads_edit->repeat_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_adsedit.Lists["x_every_id"] = {"LinkField":"x_every_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_every_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_every"};
fcpy_adsedit.Lists["x_every_id"].Data = "<?php echo $cpy_ads_edit->every_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_adsedit.Lists["x_hour_sid"] = {"LinkField":"x_hour_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_houd_hour","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_hour"};
fcpy_adsedit.Lists["x_hour_sid"].Data = "<?php echo $cpy_ads_edit->hour_sid->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_adsedit.Lists["x_hour_eid"] = {"LinkField":"x_hour_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_houd_hour","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_hour"};
fcpy_adsedit.Lists["x_hour_eid"].Data = "<?php echo $cpy_ads_edit->hour_eid->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_ads_edit->ShowPageHeader(); ?>
<?php
$cpy_ads_edit->ShowMessage();
?>
<?php if (!$cpy_ads_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cpy_ads_edit->Pager)) $cpy_ads_edit->Pager = new cPrevNextPager($cpy_ads_edit->StartRec, $cpy_ads_edit->DisplayRecs, $cpy_ads_edit->TotalRecs, $cpy_ads_edit->AutoHidePager) ?>
<?php if ($cpy_ads_edit->Pager->RecordCount > 0 && $cpy_ads_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_ads_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_ads_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_ads_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_ads_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_ads_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_ads_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcpy_adsedit" id="fcpy_adsedit" class="<?php echo $cpy_ads_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_ads_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_ads_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_ads">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_ads_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($cpy_ads->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_cpy_ads_status_id" for="x_status_id" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->status_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->status_id->CellAttributes() ?>>
<span id="el_cpy_ads_status_id">
<select data-table="cpy_ads" data-field="x_status_id" data-value-separator="<?php echo $cpy_ads->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_ads->status_id->EditAttributes() ?>>
<?php echo $cpy_ads->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $cpy_ads->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->repeat_id->Visible) { // repeat_id ?>
	<div id="r_repeat_id" class="form-group">
		<label id="elh_cpy_ads_repeat_id" for="x_repeat_id" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->repeat_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->repeat_id->CellAttributes() ?>>
<span id="el_cpy_ads_repeat_id">
<select data-table="cpy_ads" data-field="x_repeat_id" data-value-separator="<?php echo $cpy_ads->repeat_id->DisplayValueSeparatorAttribute() ?>" id="x_repeat_id" name="x_repeat_id"<?php echo $cpy_ads->repeat_id->EditAttributes() ?>>
<?php echo $cpy_ads->repeat_id->SelectOptionListHtml("x_repeat_id") ?>
</select>
</span>
<?php echo $cpy_ads->repeat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->every_id->Visible) { // every_id ?>
	<div id="r_every_id" class="form-group">
		<label id="elh_cpy_ads_every_id" for="x_every_id" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->every_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->every_id->CellAttributes() ?>>
<span id="el_cpy_ads_every_id">
<select data-table="cpy_ads" data-field="x_every_id" data-value-separator="<?php echo $cpy_ads->every_id->DisplayValueSeparatorAttribute() ?>" id="x_every_id" name="x_every_id"<?php echo $cpy_ads->every_id->EditAttributes() ?>>
<?php echo $cpy_ads->every_id->SelectOptionListHtml("x_every_id") ?>
</select>
</span>
<?php echo $cpy_ads->every_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_title->Visible) { // ads_title ?>
	<div id="r_ads_title" class="form-group">
		<label id="elh_cpy_ads_ads_title" for="x_ads_title" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->ads_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_title->CellAttributes() ?>>
<span id="el_cpy_ads_ads_title">
<input type="text" data-table="cpy_ads" data-field="x_ads_title" name="x_ads_title" id="x_ads_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_title->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_title->EditValue ?>"<?php echo $cpy_ads->ads_title->EditAttributes() ?>>
</span>
<?php echo $cpy_ads->ads_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_desc->Visible) { // ads_desc ?>
	<div id="r_ads_desc" class="form-group">
		<label id="elh_cpy_ads_ads_desc" for="x_ads_desc" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->ads_desc->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_desc->CellAttributes() ?>>
<span id="el_cpy_ads_ads_desc">
<input type="text" data-table="cpy_ads" data-field="x_ads_desc" name="x_ads_desc" id="x_ads_desc" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_desc->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_desc->EditValue ?>"<?php echo $cpy_ads->ads_desc->EditAttributes() ?>>
</span>
<?php echo $cpy_ads->ads_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_sdate->Visible) { // ads_sdate ?>
	<div id="r_ads_sdate" class="form-group">
		<label id="elh_cpy_ads_ads_sdate" for="x_ads_sdate" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->ads_sdate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_sdate->CellAttributes() ?>>
<span id="el_cpy_ads_ads_sdate">
<input type="text" data-table="cpy_ads" data-field="x_ads_sdate" name="x_ads_sdate" id="x_ads_sdate" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_sdate->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_sdate->EditValue ?>"<?php echo $cpy_ads->ads_sdate->EditAttributes() ?>>
<?php if (!$cpy_ads->ads_sdate->ReadOnly && !$cpy_ads->ads_sdate->Disabled && !isset($cpy_ads->ads_sdate->EditAttrs["readonly"]) && !isset($cpy_ads->ads_sdate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fcpy_adsedit", "x_ads_sdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $cpy_ads->ads_sdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_edate->Visible) { // ads_edate ?>
	<div id="r_ads_edate" class="form-group">
		<label id="elh_cpy_ads_ads_edate" for="x_ads_edate" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->ads_edate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_edate->CellAttributes() ?>>
<span id="el_cpy_ads_ads_edate">
<input type="text" data-table="cpy_ads" data-field="x_ads_edate" name="x_ads_edate" id="x_ads_edate" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_edate->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_edate->EditValue ?>"<?php echo $cpy_ads->ads_edate->EditAttributes() ?>>
<?php if (!$cpy_ads->ads_edate->ReadOnly && !$cpy_ads->ads_edate->Disabled && !isset($cpy_ads->ads_edate->EditAttrs["readonly"]) && !isset($cpy_ads->ads_edate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fcpy_adsedit", "x_ads_edate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $cpy_ads->ads_edate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->hour_sid->Visible) { // hour_sid ?>
	<div id="r_hour_sid" class="form-group">
		<label id="elh_cpy_ads_hour_sid" for="x_hour_sid" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->hour_sid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->hour_sid->CellAttributes() ?>>
<span id="el_cpy_ads_hour_sid">
<select data-table="cpy_ads" data-field="x_hour_sid" data-value-separator="<?php echo $cpy_ads->hour_sid->DisplayValueSeparatorAttribute() ?>" id="x_hour_sid" name="x_hour_sid"<?php echo $cpy_ads->hour_sid->EditAttributes() ?>>
<?php echo $cpy_ads->hour_sid->SelectOptionListHtml("x_hour_sid") ?>
</select>
</span>
<?php echo $cpy_ads->hour_sid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->hour_eid->Visible) { // hour_eid ?>
	<div id="r_hour_eid" class="form-group">
		<label id="elh_cpy_ads_hour_eid" for="x_hour_eid" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->hour_eid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->hour_eid->CellAttributes() ?>>
<span id="el_cpy_ads_hour_eid">
<select data-table="cpy_ads" data-field="x_hour_eid" data-value-separator="<?php echo $cpy_ads->hour_eid->DisplayValueSeparatorAttribute() ?>" id="x_hour_eid" name="x_hour_eid"<?php echo $cpy_ads->hour_eid->EditAttributes() ?>>
<?php echo $cpy_ads->hour_eid->SelectOptionListHtml("x_hour_eid") ?>
</select>
</span>
<?php echo $cpy_ads->hour_eid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_image->Visible) { // ads_image ?>
	<div id="r_ads_image" class="form-group">
		<label id="elh_cpy_ads_ads_image" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->ads_image->FldCaption() ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_image->CellAttributes() ?>>
<span id="el_cpy_ads_ads_image">
<div id="fd_x_ads_image">
<span title="<?php echo $cpy_ads->ads_image->FldTitle() ? $cpy_ads->ads_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_ads->ads_image->ReadOnly || $cpy_ads->ads_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_ads" data-field="x_ads_image" name="x_ads_image" id="x_ads_image"<?php echo $cpy_ads->ads_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_ads_image" id= "fn_x_ads_image" value="<?php echo $cpy_ads->ads_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_ads_image"] == "0") { ?>
<input type="hidden" name="fa_x_ads_image" id= "fa_x_ads_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_ads_image" id= "fa_x_ads_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_ads_image" id= "fs_x_ads_image" value="200">
<input type="hidden" name="fx_x_ads_image" id= "fx_x_ads_image" value="<?php echo $cpy_ads->ads_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ads_image" id= "fm_x_ads_image" value="<?php echo $cpy_ads->ads_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ads_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $cpy_ads->ads_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_text->Visible) { // ads_text ?>
	<div id="r_ads_text" class="form-group">
		<label id="elh_cpy_ads_ads_text" class="<?php echo $cpy_ads_edit->LeftColumnClass ?>"><?php echo $cpy_ads->ads_text->FldCaption() ?></label>
		<div class="<?php echo $cpy_ads_edit->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_text->CellAttributes() ?>>
<span id="el_cpy_ads_ads_text">
<?php ew_AppendClass($cpy_ads->ads_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_ads" data-field="x_ads_text" name="x_ads_text" id="x_ads_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_text->getPlaceHolder()) ?>"<?php echo $cpy_ads->ads_text->EditAttributes() ?>><?php echo $cpy_ads->ads_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_adsedit", "x_ads_text", 35, 8, <?php echo ($cpy_ads->ads_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $cpy_ads->ads_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="cpy_ads" data-field="x_ads_id" name="x_ads_id" id="x_ads_id" value="<?php echo ew_HtmlEncode($cpy_ads->ads_id->CurrentValue) ?>">
<?php if (!$cpy_ads_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_ads_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_ads_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$cpy_ads_edit->IsModal) { ?>
<?php if (!isset($cpy_ads_edit->Pager)) $cpy_ads_edit->Pager = new cPrevNextPager($cpy_ads_edit->StartRec, $cpy_ads_edit->DisplayRecs, $cpy_ads_edit->TotalRecs, $cpy_ads_edit->AutoHidePager) ?>
<?php if ($cpy_ads_edit->Pager->RecordCount > 0 && $cpy_ads_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_ads_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_ads_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_ads_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_ads_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_ads_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_ads_edit->PageUrl() ?>start=<?php echo $cpy_ads_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_ads_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fcpy_adsedit.Init();
</script>
<?php
$cpy_ads_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_ads_edit->Page_Terminate();
?>
