<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_testinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_test_namegridcls.php" ?>
<?php include_once "app_test_questiongridcls.php" ?>
<?php include_once "app_test_evaluategridcls.php" ?>
<?php include_once "app_test_resultsgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_test_add = NULL; // Initialize page object first

class capp_test_add extends capp_test {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_test';

	// Page object name
	var $PageObjName = 'app_test_add';

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

		// Table object (app_test)
		if (!isset($GLOBALS["app_test"]) || get_class($GLOBALS["app_test"]) == "capp_test") {
			$GLOBALS["app_test"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_test"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_test', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("app_testlist.php"));
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
		$this->test_num->SetVisibility();
		$this->test_iname->SetVisibility();
		$this->test_price->SetVisibility();
		$this->test_image->SetVisibility();

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
				if (in_array("app_test_name", $DetailTblVar)) {

					// Process auto fill for detail table 'app_test_name'
					if (preg_match('/^fapp_test_name(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_test_name_grid"])) $GLOBALS["app_test_name_grid"] = new capp_test_name_grid;
						$GLOBALS["app_test_name_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("app_test_question", $DetailTblVar)) {

					// Process auto fill for detail table 'app_test_question'
					if (preg_match('/^fapp_test_question(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_test_question_grid"])) $GLOBALS["app_test_question_grid"] = new capp_test_question_grid;
						$GLOBALS["app_test_question_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("app_test_evaluate", $DetailTblVar)) {

					// Process auto fill for detail table 'app_test_evaluate'
					if (preg_match('/^fapp_test_evaluate(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_test_evaluate_grid"])) $GLOBALS["app_test_evaluate_grid"] = new capp_test_evaluate_grid;
						$GLOBALS["app_test_evaluate_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("app_test_results", $DetailTblVar)) {

					// Process auto fill for detail table 'app_test_results'
					if (preg_match('/^fapp_test_results(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_test_results_grid"])) $GLOBALS["app_test_results_grid"] = new capp_test_results_grid;
						$GLOBALS["app_test_results_grid"]->Page_Init();
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
		global $EW_EXPORT, $app_test;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_test);
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
					if ($pageName == "app_testview.php")
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

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
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["test_id"] != "") {
				$this->test_id->setQueryStringValue($_GET["test_id"]);
				$this->setKey("test_id", $this->test_id->CurrentValue); // Set up key
			} else {
				$this->setKey("test_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->SetupDetailParms();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("app_testlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "app_testlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "app_testview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->test_image->Upload->Index = $objForm->Index;
		$this->test_image->Upload->UploadFile();
		$this->test_image->CurrentValue = $this->test_image->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->test_id->CurrentValue = NULL;
		$this->test_id->OldValue = $this->test_id->CurrentValue;
		$this->status_id->CurrentValue = 1;
		$this->test_num->CurrentValue = 1;
		$this->test_iname->CurrentValue = NULL;
		$this->test_iname->OldValue = $this->test_iname->CurrentValue;
		$this->test_price->CurrentValue = 0.00;
		$this->test_image->Upload->DbValue = NULL;
		$this->test_image->OldValue = $this->test_image->Upload->DbValue;
		$this->test_image->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->test_num->FldIsDetailKey) {
			$this->test_num->setFormValue($objForm->GetValue("x_test_num"));
		}
		if (!$this->test_iname->FldIsDetailKey) {
			$this->test_iname->setFormValue($objForm->GetValue("x_test_iname"));
		}
		if (!$this->test_price->FldIsDetailKey) {
			$this->test_price->setFormValue($objForm->GetValue("x_test_price"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->test_num->CurrentValue = $this->test_num->FormValue;
		$this->test_iname->CurrentValue = $this->test_iname->FormValue;
		$this->test_price->CurrentValue = $this->test_price->FormValue;
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
		$this->test_id->setDbValue($row['test_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->test_num->setDbValue($row['test_num']);
		$this->test_iname->setDbValue($row['test_iname']);
		$this->test_price->setDbValue($row['test_price']);
		$this->test_image->Upload->DbValue = $row['test_image'];
		$this->test_image->setDbValue($this->test_image->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['test_id'] = $this->test_id->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['test_num'] = $this->test_num->CurrentValue;
		$row['test_iname'] = $this->test_iname->CurrentValue;
		$row['test_price'] = $this->test_price->CurrentValue;
		$row['test_image'] = $this->test_image->Upload->DbValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->test_id->DbValue = $row['test_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->test_num->DbValue = $row['test_num'];
		$this->test_iname->DbValue = $row['test_iname'];
		$this->test_price->DbValue = $row['test_price'];
		$this->test_image->Upload->DbValue = $row['test_image'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("test_id")) <> "")
			$this->test_id->CurrentValue = $this->getKey("test_id"); // test_id
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
		// Convert decimal values if posted back

		if ($this->test_price->FormValue == $this->test_price->CurrentValue && is_numeric(ew_StrToFloat($this->test_price->CurrentValue)))
			$this->test_price->CurrentValue = ew_StrToFloat($this->test_price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// test_id
		// status_id
		// test_num
		// test_iname
		// test_price
		// test_image

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// status_id
		if (strval($this->status_id->CurrentValue) <> "") {
			$sFilterWrk = "`status_id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `status_id`, `status_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
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

		// test_num
		$this->test_num->ViewValue = $this->test_num->CurrentValue;
		$this->test_num->ViewCustomAttributes = "";

		// test_iname
		$this->test_iname->ViewValue = $this->test_iname->CurrentValue;
		$this->test_iname->ViewCustomAttributes = "";

		// test_price
		$this->test_price->ViewValue = $this->test_price->CurrentValue;
		$this->test_price->ViewValue = ew_FormatCurrency($this->test_price->ViewValue, 2, -2, -2, -1);
		$this->test_price->ViewCustomAttributes = "";

		// test_image
		$this->test_image->UploadPath = '../../assets/img/testImages';
		if (!ew_Empty($this->test_image->Upload->DbValue)) {
			$this->test_image->ImageWidth = 200;
			$this->test_image->ImageHeight = 0;
			$this->test_image->ImageAlt = $this->test_image->FldAlt();
			$this->test_image->ViewValue = $this->test_image->Upload->DbValue;
		} else {
			$this->test_image->ViewValue = "";
		}
		$this->test_image->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// test_num
			$this->test_num->LinkCustomAttributes = "";
			$this->test_num->HrefValue = "";
			$this->test_num->TooltipValue = "";

			// test_iname
			$this->test_iname->LinkCustomAttributes = "";
			$this->test_iname->HrefValue = "";
			$this->test_iname->TooltipValue = "";

			// test_price
			$this->test_price->LinkCustomAttributes = "";
			$this->test_price->HrefValue = "";
			$this->test_price->TooltipValue = "";

			// test_image
			$this->test_image->LinkCustomAttributes = "";
			$this->test_image->UploadPath = '../../assets/img/testImages';
			if (!ew_Empty($this->test_image->Upload->DbValue)) {
				$this->test_image->HrefValue = ew_GetFileUploadUrl($this->test_image, $this->test_image->Upload->DbValue); // Add prefix/suffix
				$this->test_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->test_image->HrefValue = ew_FullUrl($this->test_image->HrefValue, "href");
			} else {
				$this->test_image->HrefValue = "";
			}
			$this->test_image->HrefValue2 = $this->test_image->UploadPath . $this->test_image->Upload->DbValue;
			$this->test_image->TooltipValue = "";
			if ($this->test_image->UseColorbox) {
				if (ew_Empty($this->test_image->TooltipValue))
					$this->test_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->test_image->LinkAttrs["data-rel"] = "app_test_x_test_image";
				ew_AppendClass($this->test_image->LinkAttrs["class"], "ewLightbox");
			}
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// status_id
			$this->status_id->EditAttrs["class"] = "form-control";
			$this->status_id->EditCustomAttributes = "";
			if (trim(strval($this->status_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`status_id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `status_id`, `status_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_status`";
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

			// test_num
			$this->test_num->EditAttrs["class"] = "form-control";
			$this->test_num->EditCustomAttributes = "";
			$this->test_num->EditValue = ew_HtmlEncode($this->test_num->CurrentValue);
			$this->test_num->PlaceHolder = ew_RemoveHtml($this->test_num->FldCaption());

			// test_iname
			$this->test_iname->EditAttrs["class"] = "form-control";
			$this->test_iname->EditCustomAttributes = "";
			$this->test_iname->EditValue = ew_HtmlEncode($this->test_iname->CurrentValue);
			$this->test_iname->PlaceHolder = ew_RemoveHtml($this->test_iname->FldCaption());

			// test_price
			$this->test_price->EditAttrs["class"] = "form-control";
			$this->test_price->EditCustomAttributes = "";
			$this->test_price->EditValue = ew_HtmlEncode($this->test_price->CurrentValue);
			$this->test_price->PlaceHolder = ew_RemoveHtml($this->test_price->FldCaption());
			if (strval($this->test_price->EditValue) <> "" && is_numeric($this->test_price->EditValue)) $this->test_price->EditValue = ew_FormatNumber($this->test_price->EditValue, -2, -2, -2, -1);

			// test_image
			$this->test_image->EditAttrs["class"] = "form-control";
			$this->test_image->EditCustomAttributes = "";
			$this->test_image->UploadPath = '../../assets/img/testImages';
			if (!ew_Empty($this->test_image->Upload->DbValue)) {
				$this->test_image->ImageWidth = 200;
				$this->test_image->ImageHeight = 0;
				$this->test_image->ImageAlt = $this->test_image->FldAlt();
				$this->test_image->EditValue = $this->test_image->Upload->DbValue;
			} else {
				$this->test_image->EditValue = "";
			}
			if (!ew_Empty($this->test_image->CurrentValue))
					$this->test_image->Upload->FileName = $this->test_image->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->test_image);

			// Add refer script
			// status_id

			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// test_num
			$this->test_num->LinkCustomAttributes = "";
			$this->test_num->HrefValue = "";

			// test_iname
			$this->test_iname->LinkCustomAttributes = "";
			$this->test_iname->HrefValue = "";

			// test_price
			$this->test_price->LinkCustomAttributes = "";
			$this->test_price->HrefValue = "";

			// test_image
			$this->test_image->LinkCustomAttributes = "";
			$this->test_image->UploadPath = '../../assets/img/testImages';
			if (!ew_Empty($this->test_image->Upload->DbValue)) {
				$this->test_image->HrefValue = ew_GetFileUploadUrl($this->test_image, $this->test_image->Upload->DbValue); // Add prefix/suffix
				$this->test_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->test_image->HrefValue = ew_FullUrl($this->test_image->HrefValue, "href");
			} else {
				$this->test_image->HrefValue = "";
			}
			$this->test_image->HrefValue2 = $this->test_image->UploadPath . $this->test_image->Upload->DbValue;
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
		if (!$this->test_num->FldIsDetailKey && !is_null($this->test_num->FormValue) && $this->test_num->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->test_num->FldCaption(), $this->test_num->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->test_num->FormValue)) {
			ew_AddMessage($gsFormError, $this->test_num->FldErrMsg());
		}
		if (!$this->test_iname->FldIsDetailKey && !is_null($this->test_iname->FormValue) && $this->test_iname->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->test_iname->FldCaption(), $this->test_iname->ReqErrMsg));
		}
		if (!$this->test_price->FldIsDetailKey && !is_null($this->test_price->FormValue) && $this->test_price->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->test_price->FldCaption(), $this->test_price->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->test_price->FormValue)) {
			ew_AddMessage($gsFormError, $this->test_price->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("app_test_name", $DetailTblVar) && $GLOBALS["app_test_name"]->DetailAdd) {
			if (!isset($GLOBALS["app_test_name_grid"])) $GLOBALS["app_test_name_grid"] = new capp_test_name_grid(); // get detail page object
			$GLOBALS["app_test_name_grid"]->ValidateGridForm();
		}
		if (in_array("app_test_question", $DetailTblVar) && $GLOBALS["app_test_question"]->DetailAdd) {
			if (!isset($GLOBALS["app_test_question_grid"])) $GLOBALS["app_test_question_grid"] = new capp_test_question_grid(); // get detail page object
			$GLOBALS["app_test_question_grid"]->ValidateGridForm();
		}
		if (in_array("app_test_evaluate", $DetailTblVar) && $GLOBALS["app_test_evaluate"]->DetailAdd) {
			if (!isset($GLOBALS["app_test_evaluate_grid"])) $GLOBALS["app_test_evaluate_grid"] = new capp_test_evaluate_grid(); // get detail page object
			$GLOBALS["app_test_evaluate_grid"]->ValidateGridForm();
		}
		if (in_array("app_test_results", $DetailTblVar) && $GLOBALS["app_test_results"]->DetailAdd) {
			if (!isset($GLOBALS["app_test_results_grid"])) $GLOBALS["app_test_results_grid"] = new capp_test_results_grid(); // get detail page object
			$GLOBALS["app_test_results_grid"]->ValidateGridForm();
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		if ($this->test_num->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(test_num = " . ew_AdjustSql($this->test_num->CurrentValue, $this->DBID) . ")";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->test_num->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->test_num->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($this->test_iname->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(test_iname = '" . ew_AdjustSql($this->test_iname->CurrentValue, $this->DBID) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->test_iname->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->test_iname->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
			$this->test_image->OldUploadPath = '../../assets/img/testImages';
			$this->test_image->UploadPath = $this->test_image->OldUploadPath;
		}
		$rsnew = array();

		// status_id
		$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, strval($this->status_id->CurrentValue) == "");

		// test_num
		$this->test_num->SetDbValueDef($rsnew, $this->test_num->CurrentValue, 0, strval($this->test_num->CurrentValue) == "");

		// test_iname
		$this->test_iname->SetDbValueDef($rsnew, $this->test_iname->CurrentValue, "", FALSE);

		// test_price
		$this->test_price->SetDbValueDef($rsnew, $this->test_price->CurrentValue, 0, strval($this->test_price->CurrentValue) == "");

		// test_image
		if ($this->test_image->Visible && !$this->test_image->Upload->KeepFile) {
			$this->test_image->Upload->DbValue = ""; // No need to delete old file
			if ($this->test_image->Upload->FileName == "") {
				$rsnew['test_image'] = NULL;
			} else {
				$rsnew['test_image'] = $this->test_image->Upload->FileName;
			}
		}
		if ($this->test_image->Visible && !$this->test_image->Upload->KeepFile) {
			$this->test_image->UploadPath = '../../assets/img/testImages';
			$OldFiles = ew_Empty($this->test_image->Upload->DbValue) ? array() : array($this->test_image->Upload->DbValue);
			if (!ew_Empty($this->test_image->Upload->FileName)) {
				$NewFiles = array($this->test_image->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->test_image->Upload->Index < 0) ? $this->test_image->FldVar : substr($this->test_image->FldVar, 0, 1) . $this->test_image->Upload->Index . substr($this->test_image->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->test_image->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->test_image->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->test_image->TblVar) . $file1) || file_exists($this->test_image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->test_image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->test_image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->test_image->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->test_image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->test_image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->test_image->SetDbValueDef($rsnew, $this->test_image->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
				if ($this->test_image->Visible && !$this->test_image->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->test_image->Upload->DbValue) ? array() : array($this->test_image->Upload->DbValue);
					if (!ew_Empty($this->test_image->Upload->FileName)) {
						$NewFiles = array($this->test_image->Upload->FileName);
						$NewFiles2 = array($rsnew['test_image']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->test_image->Upload->Index < 0) ? $this->test_image->FldVar : substr($this->test_image->FldVar, 0, 1) . $this->test_image->Upload->Index . substr($this->test_image->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->test_image->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->test_image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("app_test_name", $DetailTblVar) && $GLOBALS["app_test_name"]->DetailAdd) {
				$GLOBALS["app_test_name"]->test_id->setSessionValue($this->test_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["app_test_name_grid"])) $GLOBALS["app_test_name_grid"] = new capp_test_name_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "app_test_name"); // Load user level of detail table
				$AddRow = $GLOBALS["app_test_name_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["app_test_name"]->test_id->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("app_test_question", $DetailTblVar) && $GLOBALS["app_test_question"]->DetailAdd) {
				$GLOBALS["app_test_question"]->test_id->setSessionValue($this->test_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["app_test_question_grid"])) $GLOBALS["app_test_question_grid"] = new capp_test_question_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "app_test_question"); // Load user level of detail table
				$AddRow = $GLOBALS["app_test_question_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["app_test_question"]->test_id->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("app_test_evaluate", $DetailTblVar) && $GLOBALS["app_test_evaluate"]->DetailAdd) {
				$GLOBALS["app_test_evaluate"]->test_id->setSessionValue($this->test_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["app_test_evaluate_grid"])) $GLOBALS["app_test_evaluate_grid"] = new capp_test_evaluate_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "app_test_evaluate"); // Load user level of detail table
				$AddRow = $GLOBALS["app_test_evaluate_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["app_test_evaluate"]->test_id->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("app_test_results", $DetailTblVar) && $GLOBALS["app_test_results"]->DetailAdd) {
				$GLOBALS["app_test_results"]->test_id->setSessionValue($this->test_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["app_test_results_grid"])) $GLOBALS["app_test_results_grid"] = new capp_test_results_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "app_test_results"); // Load user level of detail table
				$AddRow = $GLOBALS["app_test_results_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["app_test_results"]->test_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}

		// test_image
		ew_CleanUploadTempPath($this->test_image, $this->test_image->Upload->Index);
		return $AddRow;
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
			if (in_array("app_test_name", $DetailTblVar)) {
				if (!isset($GLOBALS["app_test_name_grid"]))
					$GLOBALS["app_test_name_grid"] = new capp_test_name_grid;
				if ($GLOBALS["app_test_name_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["app_test_name_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["app_test_name_grid"]->CurrentMode = "add";
					$GLOBALS["app_test_name_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["app_test_name_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_test_name_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_test_name_grid"]->test_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_test_name_grid"]->test_id->CurrentValue = $this->test_id->CurrentValue;
					$GLOBALS["app_test_name_grid"]->test_id->setSessionValue($GLOBALS["app_test_name_grid"]->test_id->CurrentValue);
				}
			}
			if (in_array("app_test_question", $DetailTblVar)) {
				if (!isset($GLOBALS["app_test_question_grid"]))
					$GLOBALS["app_test_question_grid"] = new capp_test_question_grid;
				if ($GLOBALS["app_test_question_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["app_test_question_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["app_test_question_grid"]->CurrentMode = "add";
					$GLOBALS["app_test_question_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["app_test_question_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_test_question_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_test_question_grid"]->test_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_test_question_grid"]->test_id->CurrentValue = $this->test_id->CurrentValue;
					$GLOBALS["app_test_question_grid"]->test_id->setSessionValue($GLOBALS["app_test_question_grid"]->test_id->CurrentValue);
				}
			}
			if (in_array("app_test_evaluate", $DetailTblVar)) {
				if (!isset($GLOBALS["app_test_evaluate_grid"]))
					$GLOBALS["app_test_evaluate_grid"] = new capp_test_evaluate_grid;
				if ($GLOBALS["app_test_evaluate_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["app_test_evaluate_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["app_test_evaluate_grid"]->CurrentMode = "add";
					$GLOBALS["app_test_evaluate_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["app_test_evaluate_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_test_evaluate_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_test_evaluate_grid"]->test_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_test_evaluate_grid"]->test_id->CurrentValue = $this->test_id->CurrentValue;
					$GLOBALS["app_test_evaluate_grid"]->test_id->setSessionValue($GLOBALS["app_test_evaluate_grid"]->test_id->CurrentValue);
				}
			}
			if (in_array("app_test_results", $DetailTblVar)) {
				if (!isset($GLOBALS["app_test_results_grid"]))
					$GLOBALS["app_test_results_grid"] = new capp_test_results_grid;
				if ($GLOBALS["app_test_results_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["app_test_results_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["app_test_results_grid"]->CurrentMode = "add";
					$GLOBALS["app_test_results_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["app_test_results_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_test_results_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_test_results_grid"]->test_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_test_results_grid"]->test_id->CurrentValue = $this->test_id->CurrentValue;
					$GLOBALS["app_test_results_grid"]->test_id->setSessionValue($GLOBALS["app_test_results_grid"]->test_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_testlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_status_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `status_id` AS `LinkFld`, `status_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
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
if (!isset($app_test_add)) $app_test_add = new capp_test_add();

// Page init
$app_test_add->Page_Init();

// Page main
$app_test_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fapp_testadd = new ew_Form("fapp_testadd", "add");

// Validate form
fapp_testadd.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test->status_id->FldCaption(), $app_test->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_test_num");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test->test_num->FldCaption(), $app_test->test_num->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_test_num");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test->test_num->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_test_iname");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test->test_iname->FldCaption(), $app_test->test_iname->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_test_price");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test->test_price->FldCaption(), $app_test->test_price->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_test_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test->test_price->FldErrMsg()) ?>");

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
fapp_testadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_testadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_testadd.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_testadd.Lists["x_status_id"].Data = "<?php echo $app_test_add->status_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_test_add->ShowPageHeader(); ?>
<?php
$app_test_add->ShowMessage();
?>
<form name="fapp_testadd" id="fapp_testadd" class="<?php echo $app_test_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_test_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_test_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_test">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($app_test_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($app_test->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_app_test_status_id" for="x_status_id" class="<?php echo $app_test_add->LeftColumnClass ?>"><?php echo $app_test->status_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_test_add->RightColumnClass ?>"><div<?php echo $app_test->status_id->CellAttributes() ?>>
<span id="el_app_test_status_id">
<select data-table="app_test" data-field="x_status_id" data-value-separator="<?php echo $app_test->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $app_test->status_id->EditAttributes() ?>>
<?php echo $app_test->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $app_test->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test->test_num->Visible) { // test_num ?>
	<div id="r_test_num" class="form-group">
		<label id="elh_app_test_test_num" for="x_test_num" class="<?php echo $app_test_add->LeftColumnClass ?>"><?php echo $app_test->test_num->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_test_add->RightColumnClass ?>"><div<?php echo $app_test->test_num->CellAttributes() ?>>
<span id="el_app_test_test_num">
<input type="text" data-table="app_test" data-field="x_test_num" name="x_test_num" id="x_test_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_test->test_num->getPlaceHolder()) ?>" value="<?php echo $app_test->test_num->EditValue ?>"<?php echo $app_test->test_num->EditAttributes() ?>>
</span>
<?php echo $app_test->test_num->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test->test_iname->Visible) { // test_iname ?>
	<div id="r_test_iname" class="form-group">
		<label id="elh_app_test_test_iname" for="x_test_iname" class="<?php echo $app_test_add->LeftColumnClass ?>"><?php echo $app_test->test_iname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_test_add->RightColumnClass ?>"><div<?php echo $app_test->test_iname->CellAttributes() ?>>
<span id="el_app_test_test_iname">
<input type="text" data-table="app_test" data-field="x_test_iname" name="x_test_iname" id="x_test_iname" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_test->test_iname->getPlaceHolder()) ?>" value="<?php echo $app_test->test_iname->EditValue ?>"<?php echo $app_test->test_iname->EditAttributes() ?>>
</span>
<?php echo $app_test->test_iname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test->test_price->Visible) { // test_price ?>
	<div id="r_test_price" class="form-group">
		<label id="elh_app_test_test_price" for="x_test_price" class="<?php echo $app_test_add->LeftColumnClass ?>"><?php echo $app_test->test_price->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_test_add->RightColumnClass ?>"><div<?php echo $app_test->test_price->CellAttributes() ?>>
<span id="el_app_test_test_price">
<input type="text" data-table="app_test" data-field="x_test_price" name="x_test_price" id="x_test_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_test->test_price->getPlaceHolder()) ?>" value="<?php echo $app_test->test_price->EditValue ?>"<?php echo $app_test->test_price->EditAttributes() ?>>
</span>
<?php echo $app_test->test_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test->test_image->Visible) { // test_image ?>
	<div id="r_test_image" class="form-group">
		<label id="elh_app_test_test_image" class="<?php echo $app_test_add->LeftColumnClass ?>"><?php echo $app_test->test_image->FldCaption() ?></label>
		<div class="<?php echo $app_test_add->RightColumnClass ?>"><div<?php echo $app_test->test_image->CellAttributes() ?>>
<span id="el_app_test_test_image">
<div id="fd_x_test_image">
<span title="<?php echo $app_test->test_image->FldTitle() ? $app_test->test_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_test->test_image->ReadOnly || $app_test->test_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_test" data-field="x_test_image" name="x_test_image" id="x_test_image"<?php echo $app_test->test_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_test_image" id= "fn_x_test_image" value="<?php echo $app_test->test_image->Upload->FileName ?>">
<input type="hidden" name="fa_x_test_image" id= "fa_x_test_image" value="0">
<input type="hidden" name="fs_x_test_image" id= "fs_x_test_image" value="50">
<input type="hidden" name="fx_x_test_image" id= "fx_x_test_image" value="<?php echo $app_test->test_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_test_image" id= "fm_x_test_image" value="<?php echo $app_test->test_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_test_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $app_test->test_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("app_test_name", explode(",", $app_test->getCurrentDetailTable())) && $app_test_name->DetailAdd) {
?>
<?php if ($app_test->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_test_name", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_test_namegrid.php" ?>
<?php } ?>
<?php
	if (in_array("app_test_question", explode(",", $app_test->getCurrentDetailTable())) && $app_test_question->DetailAdd) {
?>
<?php if ($app_test->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_test_question", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_test_questiongrid.php" ?>
<?php } ?>
<?php
	if (in_array("app_test_evaluate", explode(",", $app_test->getCurrentDetailTable())) && $app_test_evaluate->DetailAdd) {
?>
<?php if ($app_test->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_test_evaluate", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_test_evaluategrid.php" ?>
<?php } ?>
<?php
	if (in_array("app_test_results", explode(",", $app_test->getCurrentDetailTable())) && $app_test_results->DetailAdd) {
?>
<?php if ($app_test->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_test_results", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_test_resultsgrid.php" ?>
<?php } ?>
<?php if (!$app_test_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_test_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_test_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_testadd.Init();
</script>
<?php
$app_test_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_test_add->Page_Terminate();
?>
