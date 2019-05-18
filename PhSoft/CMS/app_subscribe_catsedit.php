<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_subscribe_catsinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_subscribeinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_subscribe_cats_edit = NULL; // Initialize page object first

class capp_subscribe_cats_edit extends capp_subscribe_cats {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_subscribe_cats';

	// Page object name
	var $PageObjName = 'app_subscribe_cats_edit';

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

		// Table object (app_subscribe_cats)
		if (!isset($GLOBALS["app_subscribe_cats"]) || get_class($GLOBALS["app_subscribe_cats"]) == "capp_subscribe_cats") {
			$GLOBALS["app_subscribe_cats"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_subscribe_cats"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Table object (app_subscribe)
		if (!isset($GLOBALS['app_subscribe'])) $GLOBALS['app_subscribe'] = new capp_subscribe();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_subscribe_cats', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_subscribe_catslist.php"));
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
		$this->sub_id->SetVisibility();
		$this->tpkg_id->SetVisibility();
		$this->tcat_id->SetVisibility();

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
		global $EW_EXPORT, $app_subscribe_cats;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_subscribe_cats);
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
					if ($pageName == "app_subscribe_catsview.php")
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
			if ($objForm->HasValue("x_tsub_id")) {
				$this->tsub_id->setFormValue($objForm->GetValue("x_tsub_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["tsub_id"])) {
				$this->tsub_id->setQueryStringValue($_GET["tsub_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->tsub_id->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Set up master detail parameters
		$this->SetupMasterParms();

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("app_subscribe_catslist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->tsub_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->tsub_id->CurrentValue) == strval($this->Recordset->fields('tsub_id'))) {
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
					$this->Page_Terminate("app_subscribe_catslist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "app_subscribe_catslist.php")
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
		if (!$this->sub_id->FldIsDetailKey) {
			$this->sub_id->setFormValue($objForm->GetValue("x_sub_id"));
		}
		if (!$this->tpkg_id->FldIsDetailKey) {
			$this->tpkg_id->setFormValue($objForm->GetValue("x_tpkg_id"));
		}
		if (!$this->tcat_id->FldIsDetailKey) {
			$this->tcat_id->setFormValue($objForm->GetValue("x_tcat_id"));
		}
		if (!$this->tsub_id->FldIsDetailKey)
			$this->tsub_id->setFormValue($objForm->GetValue("x_tsub_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->tsub_id->CurrentValue = $this->tsub_id->FormValue;
		$this->sub_id->CurrentValue = $this->sub_id->FormValue;
		$this->tpkg_id->CurrentValue = $this->tpkg_id->FormValue;
		$this->tcat_id->CurrentValue = $this->tcat_id->FormValue;
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
		$this->tsub_id->setDbValue($row['tsub_id']);
		$this->sub_id->setDbValue($row['sub_id']);
		$this->tpkg_id->setDbValue($row['tpkg_id']);
		$this->tcat_id->setDbValue($row['tcat_id']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['tsub_id'] = NULL;
		$row['sub_id'] = NULL;
		$row['tpkg_id'] = NULL;
		$row['tcat_id'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->tsub_id->DbValue = $row['tsub_id'];
		$this->sub_id->DbValue = $row['sub_id'];
		$this->tpkg_id->DbValue = $row['tpkg_id'];
		$this->tcat_id->DbValue = $row['tcat_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("tsub_id")) <> "")
			$this->tsub_id->CurrentValue = $this->getKey("tsub_id"); // tsub_id
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
		// tsub_id
		// sub_id
		// tpkg_id
		// tcat_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// sub_id
		if (strval($this->sub_id->CurrentValue) <> "") {
			$sFilterWrk = "`subs_id`" . ew_SearchString("=", $this->sub_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `subs_id`, `subs_start` AS `DispFld`, `subs_end` AS `Disp2Fld`, `subs_amt` AS `Disp3Fld`, `ins_datetime` AS `Disp4Fld` FROM `app_subscribe`";
		$sWhereWrk = "";
		$this->sub_id->LookupFilters = array("df1" => "0", "df2" => "0", "df4" => "0");
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->sub_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatDateTime($rswrk->fields('DispFld'), 0);
				$arwrk[2] = ew_FormatDateTime($rswrk->fields('Disp2Fld'), 0);
				$arwrk[3] = $rswrk->fields('Disp3Fld');
				$arwrk[4] = ew_FormatDateTime($rswrk->fields('Disp4Fld'), 0);
				$this->sub_id->ViewValue = $this->sub_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->sub_id->ViewValue = $this->sub_id->CurrentValue;
			}
		} else {
			$this->sub_id->ViewValue = NULL;
		}
		$this->sub_id->ViewCustomAttributes = "";

		// tpkg_id
		$this->tpkg_id->ViewValue = $this->tpkg_id->CurrentValue;
		if (strval($this->tpkg_id->CurrentValue) <> "") {
			$sFilterWrk = "`tpkg_id`" . ew_SearchString("=", $this->tpkg_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `tpkg_id`, `pkg_name` AS `DispFld`, `tcat_name` AS `Disp2Fld`, `cycle_name` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_vtips_package`";
		$sWhereWrk = "";
		$this->tpkg_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tpkg_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$arwrk[3] = $rswrk->fields('Disp3Fld');
				$this->tpkg_id->ViewValue = $this->tpkg_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tpkg_id->ViewValue = $this->tpkg_id->CurrentValue;
			}
		} else {
			$this->tpkg_id->ViewValue = NULL;
		}
		$this->tpkg_id->ViewCustomAttributes = "";

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

			// sub_id
			$this->sub_id->LinkCustomAttributes = "";
			$this->sub_id->HrefValue = "";
			$this->sub_id->TooltipValue = "";

			// tpkg_id
			$this->tpkg_id->LinkCustomAttributes = "";
			$this->tpkg_id->HrefValue = "";
			$this->tpkg_id->TooltipValue = "";

			// tcat_id
			$this->tcat_id->LinkCustomAttributes = "";
			$this->tcat_id->HrefValue = "";
			$this->tcat_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// sub_id
			$this->sub_id->EditAttrs["class"] = "form-control";
			$this->sub_id->EditCustomAttributes = "";
			if ($this->sub_id->getSessionValue() <> "") {
				$this->sub_id->CurrentValue = $this->sub_id->getSessionValue();
			if (strval($this->sub_id->CurrentValue) <> "") {
				$sFilterWrk = "`subs_id`" . ew_SearchString("=", $this->sub_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `subs_id`, `subs_start` AS `DispFld`, `subs_end` AS `Disp2Fld`, `subs_amt` AS `Disp3Fld`, `ins_datetime` AS `Disp4Fld` FROM `app_subscribe`";
			$sWhereWrk = "";
			$this->sub_id->LookupFilters = array("df1" => "0", "df2" => "0", "df4" => "0");
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->sub_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_FormatDateTime($rswrk->fields('DispFld'), 0);
					$arwrk[2] = ew_FormatDateTime($rswrk->fields('Disp2Fld'), 0);
					$arwrk[3] = $rswrk->fields('Disp3Fld');
					$arwrk[4] = ew_FormatDateTime($rswrk->fields('Disp4Fld'), 0);
					$this->sub_id->ViewValue = $this->sub_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->sub_id->ViewValue = $this->sub_id->CurrentValue;
				}
			} else {
				$this->sub_id->ViewValue = NULL;
			}
			$this->sub_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->sub_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`subs_id`" . ew_SearchString("=", $this->sub_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `subs_id`, `subs_start` AS `DispFld`, `subs_end` AS `Disp2Fld`, `subs_amt` AS `Disp3Fld`, `ins_datetime` AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_subscribe`";
			$sWhereWrk = "";
			$this->sub_id->LookupFilters = array("df1" => "0", "df2" => "0", "df4" => "0");
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->sub_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$rowswrk = count($arwrk);
			for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
				$arwrk[$rowcntwrk][1] = ew_FormatDateTime($arwrk[$rowcntwrk][1], 0);
				$arwrk[$rowcntwrk][2] = ew_FormatDateTime($arwrk[$rowcntwrk][2], 0);
				$arwrk[$rowcntwrk][4] = ew_FormatDateTime($arwrk[$rowcntwrk][4], 0);
			}
			$this->sub_id->EditValue = $arwrk;
			}

			// tpkg_id
			$this->tpkg_id->EditAttrs["class"] = "form-control";
			$this->tpkg_id->EditCustomAttributes = "";
			$this->tpkg_id->EditValue = ew_HtmlEncode($this->tpkg_id->CurrentValue);
			if (strval($this->tpkg_id->CurrentValue) <> "") {
				$sFilterWrk = "`tpkg_id`" . ew_SearchString("=", $this->tpkg_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `tpkg_id`, `pkg_name` AS `DispFld`, `tcat_name` AS `Disp2Fld`, `cycle_name` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_vtips_package`";
			$sWhereWrk = "";
			$this->tpkg_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tpkg_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
					$arwrk[3] = ew_HtmlEncode($rswrk->fields('Disp3Fld'));
					$this->tpkg_id->EditValue = $this->tpkg_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tpkg_id->EditValue = ew_HtmlEncode($this->tpkg_id->CurrentValue);
				}
			} else {
				$this->tpkg_id->EditValue = NULL;
			}
			$this->tpkg_id->PlaceHolder = ew_RemoveHtml($this->tpkg_id->FldCaption());

			// tcat_id
			$this->tcat_id->EditAttrs["class"] = "form-control";
			$this->tcat_id->EditCustomAttributes = "";
			if (trim(strval($this->tcat_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`tcat_id`" . ew_SearchString("=", $this->tcat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `tcat_id`, `tcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_tips_category`";
			$sWhereWrk = "";
			$this->tcat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tcat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tcat_id->EditValue = $arwrk;

			// Edit refer script
			// sub_id

			$this->sub_id->LinkCustomAttributes = "";
			$this->sub_id->HrefValue = "";

			// tpkg_id
			$this->tpkg_id->LinkCustomAttributes = "";
			$this->tpkg_id->HrefValue = "";

			// tcat_id
			$this->tcat_id->LinkCustomAttributes = "";
			$this->tcat_id->HrefValue = "";
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
		if (!$this->sub_id->FldIsDetailKey && !is_null($this->sub_id->FormValue) && $this->sub_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->sub_id->FldCaption(), $this->sub_id->ReqErrMsg));
		}
		if (!$this->tpkg_id->FldIsDetailKey && !is_null($this->tpkg_id->FormValue) && $this->tpkg_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tpkg_id->FldCaption(), $this->tpkg_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->tpkg_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->tpkg_id->FldErrMsg());
		}
		if (!$this->tcat_id->FldIsDetailKey && !is_null($this->tcat_id->FormValue) && $this->tcat_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tcat_id->FldCaption(), $this->tcat_id->ReqErrMsg));
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

			// sub_id
			$this->sub_id->SetDbValueDef($rsnew, $this->sub_id->CurrentValue, 0, $this->sub_id->ReadOnly);

			// tpkg_id
			$this->tpkg_id->SetDbValueDef($rsnew, $this->tpkg_id->CurrentValue, 0, $this->tpkg_id->ReadOnly);

			// tcat_id
			$this->tcat_id->SetDbValueDef($rsnew, $this->tcat_id->CurrentValue, 0, $this->tcat_id->ReadOnly);

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

	// Set up master/detail based on QueryString
	function SetupMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "app_subscribe") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_subs_id"] <> "") {
					$GLOBALS["app_subscribe"]->subs_id->setQueryStringValue($_GET["fk_subs_id"]);
					$this->sub_id->setQueryStringValue($GLOBALS["app_subscribe"]->subs_id->QueryStringValue);
					$this->sub_id->setSessionValue($this->sub_id->QueryStringValue);
					if (!is_numeric($GLOBALS["app_subscribe"]->subs_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "app_subscribe") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_subs_id"] <> "") {
					$GLOBALS["app_subscribe"]->subs_id->setFormValue($_POST["fk_subs_id"]);
					$this->sub_id->setFormValue($GLOBALS["app_subscribe"]->subs_id->FormValue);
					$this->sub_id->setSessionValue($this->sub_id->FormValue);
					if (!is_numeric($GLOBALS["app_subscribe"]->subs_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "app_subscribe") {
				if ($this->sub_id->CurrentValue == "") $this->sub_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_subscribe_catslist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_sub_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `subs_id` AS `LinkFld`, `subs_start` AS `DispFld`, `subs_end` AS `Disp2Fld`, `subs_amt` AS `Disp3Fld`, `ins_datetime` AS `Disp4Fld` FROM `app_subscribe`";
			$sWhereWrk = "";
			$fld->LookupFilters = array("df1" => "0", "df2" => "0", "df4" => "0");
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`subs_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->sub_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tpkg_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `tpkg_id` AS `LinkFld`, `pkg_name` AS `DispFld`, `tcat_name` AS `Disp2Fld`, `cycle_name` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_vtips_package`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`tpkg_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tpkg_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tcat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `tcat_id` AS `LinkFld`, `tcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_category`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`tcat_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tcat_id, $sWhereWrk); // Call Lookup Selecting
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
		case "x_tpkg_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `tpkg_id`, `pkg_name` AS `DispFld`, `tcat_name` AS `Disp2Fld`, `cycle_name` AS `Disp3Fld` FROM `app_vtips_package`";
			$sWhereWrk = "`pkg_name` LIKE '{query_value}%' OR CONCAT(COALESCE(`pkg_name`, ''),'" . ew_ValueSeparator(1, $this->tpkg_id) . "',COALESCE(`tcat_name`,''),'" . ew_ValueSeparator(2, $this->tpkg_id) . "',COALESCE(`cycle_name`,'')) LIKE '{query_value}%'";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tpkg_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($app_subscribe_cats_edit)) $app_subscribe_cats_edit = new capp_subscribe_cats_edit();

// Page init
$app_subscribe_cats_edit->Page_Init();

// Page main
$app_subscribe_cats_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_subscribe_cats_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fapp_subscribe_catsedit = new ew_Form("fapp_subscribe_catsedit", "edit");

// Validate form
fapp_subscribe_catsedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_sub_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe_cats->sub_id->FldCaption(), $app_subscribe_cats->sub_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tpkg_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe_cats->tpkg_id->FldCaption(), $app_subscribe_cats->tpkg_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tpkg_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe_cats->tpkg_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tcat_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe_cats->tcat_id->FldCaption(), $app_subscribe_cats->tcat_id->ReqErrMsg)) ?>");

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
fapp_subscribe_catsedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_subscribe_catsedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_subscribe_catsedit.Lists["x_sub_id"] = {"LinkField":"x_subs_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_subs_start","x_subs_end","x_subs_amt","x_ins_datetime"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_subscribe"};
fapp_subscribe_catsedit.Lists["x_sub_id"].Data = "<?php echo $app_subscribe_cats_edit->sub_id->LookupFilterQuery(FALSE, "edit") ?>";
fapp_subscribe_catsedit.Lists["x_tpkg_id"] = {"LinkField":"x_tpkg_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pkg_name","x_tcat_name","x_cycle_name",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_vtips_package"};
fapp_subscribe_catsedit.Lists["x_tpkg_id"].Data = "<?php echo $app_subscribe_cats_edit->tpkg_id->LookupFilterQuery(FALSE, "edit") ?>";
fapp_subscribe_catsedit.AutoSuggests["x_tpkg_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $app_subscribe_cats_edit->tpkg_id->LookupFilterQuery(TRUE, "edit"))) ?>;
fapp_subscribe_catsedit.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_subscribe_catsedit.Lists["x_tcat_id"].Data = "<?php echo $app_subscribe_cats_edit->tcat_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_subscribe_cats_edit->ShowPageHeader(); ?>
<?php
$app_subscribe_cats_edit->ShowMessage();
?>
<?php if (!$app_subscribe_cats_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_subscribe_cats_edit->Pager)) $app_subscribe_cats_edit->Pager = new cPrevNextPager($app_subscribe_cats_edit->StartRec, $app_subscribe_cats_edit->DisplayRecs, $app_subscribe_cats_edit->TotalRecs, $app_subscribe_cats_edit->AutoHidePager) ?>
<?php if ($app_subscribe_cats_edit->Pager->RecordCount > 0 && $app_subscribe_cats_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_subscribe_cats_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_subscribe_cats_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_subscribe_cats_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_subscribe_cats_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_subscribe_cats_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_subscribe_cats_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fapp_subscribe_catsedit" id="fapp_subscribe_catsedit" class="<?php echo $app_subscribe_cats_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_subscribe_cats_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_subscribe_cats_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_subscribe_cats">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_subscribe_cats_edit->IsModal) ?>">
<?php if ($app_subscribe_cats->getCurrentMasterTable() == "app_subscribe") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="app_subscribe">
<input type="hidden" name="fk_subs_id" value="<?php echo $app_subscribe_cats->sub_id->getSessionValue() ?>">
<?php } ?>
<div class="ewEditDiv"><!-- page* -->
<?php if ($app_subscribe_cats->sub_id->Visible) { // sub_id ?>
	<div id="r_sub_id" class="form-group">
		<label id="elh_app_subscribe_cats_sub_id" for="x_sub_id" class="<?php echo $app_subscribe_cats_edit->LeftColumnClass ?>"><?php echo $app_subscribe_cats->sub_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_subscribe_cats_edit->RightColumnClass ?>"><div<?php echo $app_subscribe_cats->sub_id->CellAttributes() ?>>
<?php if ($app_subscribe_cats->sub_id->getSessionValue() <> "") { ?>
<span id="el_app_subscribe_cats_sub_id">
<span<?php echo $app_subscribe_cats->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_subscribe_cats->sub_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_sub_id" name="x_sub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->sub_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_app_subscribe_cats_sub_id">
<select data-table="app_subscribe_cats" data-field="x_sub_id" data-value-separator="<?php echo $app_subscribe_cats->sub_id->DisplayValueSeparatorAttribute() ?>" id="x_sub_id" name="x_sub_id"<?php echo $app_subscribe_cats->sub_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->sub_id->SelectOptionListHtml("x_sub_id") ?>
</select>
</span>
<?php } ?>
<?php echo $app_subscribe_cats->sub_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe_cats->tpkg_id->Visible) { // tpkg_id ?>
	<div id="r_tpkg_id" class="form-group">
		<label id="elh_app_subscribe_cats_tpkg_id" class="<?php echo $app_subscribe_cats_edit->LeftColumnClass ?>"><?php echo $app_subscribe_cats->tpkg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_subscribe_cats_edit->RightColumnClass ?>"><div<?php echo $app_subscribe_cats->tpkg_id->CellAttributes() ?>>
<span id="el_app_subscribe_cats_tpkg_id">
<?php
$wrkonchange = trim(" " . @$app_subscribe_cats->tpkg_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$app_subscribe_cats->tpkg_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_tpkg_id" style="white-space: nowrap; z-index: 8970">
	<input type="text" name="sv_x_tpkg_id" id="sv_x_tpkg_id" value="<?php echo $app_subscribe_cats->tpkg_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->getPlaceHolder()) ?>"<?php echo $app_subscribe_cats->tpkg_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tpkg_id" data-value-separator="<?php echo $app_subscribe_cats->tpkg_id->DisplayValueSeparatorAttribute() ?>" name="x_tpkg_id" id="x_tpkg_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tpkg_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fapp_subscribe_catsedit.CreateAutoSuggest({"id":"x_tpkg_id","forceSelect":false});
</script>
</span>
<?php echo $app_subscribe_cats->tpkg_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe_cats->tcat_id->Visible) { // tcat_id ?>
	<div id="r_tcat_id" class="form-group">
		<label id="elh_app_subscribe_cats_tcat_id" for="x_tcat_id" class="<?php echo $app_subscribe_cats_edit->LeftColumnClass ?>"><?php echo $app_subscribe_cats->tcat_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_subscribe_cats_edit->RightColumnClass ?>"><div<?php echo $app_subscribe_cats->tcat_id->CellAttributes() ?>>
<span id="el_app_subscribe_cats_tcat_id">
<select data-table="app_subscribe_cats" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe_cats->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x_tcat_id" name="x_tcat_id"<?php echo $app_subscribe_cats->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe_cats->tcat_id->SelectOptionListHtml("x_tcat_id") ?>
</select>
</span>
<?php echo $app_subscribe_cats->tcat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="app_subscribe_cats" data-field="x_tsub_id" name="x_tsub_id" id="x_tsub_id" value="<?php echo ew_HtmlEncode($app_subscribe_cats->tsub_id->CurrentValue) ?>">
<?php if (!$app_subscribe_cats_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_subscribe_cats_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_subscribe_cats_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$app_subscribe_cats_edit->IsModal) { ?>
<?php if (!isset($app_subscribe_cats_edit->Pager)) $app_subscribe_cats_edit->Pager = new cPrevNextPager($app_subscribe_cats_edit->StartRec, $app_subscribe_cats_edit->DisplayRecs, $app_subscribe_cats_edit->TotalRecs, $app_subscribe_cats_edit->AutoHidePager) ?>
<?php if ($app_subscribe_cats_edit->Pager->RecordCount > 0 && $app_subscribe_cats_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_subscribe_cats_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_subscribe_cats_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_subscribe_cats_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_subscribe_cats_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_subscribe_cats_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_subscribe_cats_edit->PageUrl() ?>start=<?php echo $app_subscribe_cats_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_subscribe_cats_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fapp_subscribe_catsedit.Init();
</script>
<?php
$app_subscribe_cats_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_subscribe_cats_edit->Page_Terminate();
?>
