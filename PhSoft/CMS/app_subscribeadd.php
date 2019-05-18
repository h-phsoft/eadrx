<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_subscribeinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_subscribe_catsgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_subscribe_add = NULL; // Initialize page object first

class capp_subscribe_add extends capp_subscribe {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_subscribe';

	// Page object name
	var $PageObjName = 'app_subscribe_add';

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

		// Table object (app_subscribe)
		if (!isset($GLOBALS["app_subscribe"]) || get_class($GLOBALS["app_subscribe"]) == "capp_subscribe") {
			$GLOBALS["app_subscribe"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_subscribe"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_subscribe', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_subscribelist.php"));
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
		$this->serv_id->SetVisibility();
		$this->user_id->SetVisibility();
		$this->cycle_id->SetVisibility();
		$this->book_id->SetVisibility();
		$this->pkg_id->SetVisibility();
		$this->tcat_id->SetVisibility();
		$this->test_id->SetVisibility();
		$this->cat_id->SetVisibility();
		$this->cons_id->SetVisibility();
		$this->subs_start->SetVisibility();
		$this->subs_end->SetVisibility();
		$this->subs_qnt->SetVisibility();
		$this->subs_price->SetVisibility();
		$this->subs_amt->SetVisibility();

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
				if (in_array("app_subscribe_cats", $DetailTblVar)) {

					// Process auto fill for detail table 'app_subscribe_cats'
					if (preg_match('/^fapp_subscribe_cats(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_subscribe_cats_grid"])) $GLOBALS["app_subscribe_cats_grid"] = new capp_subscribe_cats_grid;
						$GLOBALS["app_subscribe_cats_grid"]->Page_Init();
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
		global $EW_EXPORT, $app_subscribe;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_subscribe);
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
					if ($pageName == "app_subscribeview.php")
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
			if (@$_GET["subs_id"] != "") {
				$this->subs_id->setQueryStringValue($_GET["subs_id"]);
				$this->setKey("subs_id", $this->subs_id->CurrentValue); // Set up key
			} else {
				$this->setKey("subs_id", ""); // Clear key
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
					$this->Page_Terminate("app_subscribelist.php"); // No matching record, return to list
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
					if (ew_GetPageName($sReturnUrl) == "app_subscribelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "app_subscribeview.php")
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
	}

	// Load default values
	function LoadDefaultValues() {
		$this->subs_id->CurrentValue = NULL;
		$this->subs_id->OldValue = $this->subs_id->CurrentValue;
		$this->serv_id->CurrentValue = NULL;
		$this->serv_id->OldValue = $this->serv_id->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->cycle_id->CurrentValue = NULL;
		$this->cycle_id->OldValue = $this->cycle_id->CurrentValue;
		$this->book_id->CurrentValue = 0;
		$this->pkg_id->CurrentValue = 0;
		$this->tcat_id->CurrentValue = 0;
		$this->test_id->CurrentValue = 0;
		$this->cat_id->CurrentValue = 0;
		$this->cons_id->CurrentValue = 0;
		$this->subs_start->CurrentValue = NULL;
		$this->subs_start->OldValue = $this->subs_start->CurrentValue;
		$this->subs_end->CurrentValue = NULL;
		$this->subs_end->OldValue = $this->subs_end->CurrentValue;
		$this->subs_qnt->CurrentValue = 1;
		$this->subs_price->CurrentValue = 0;
		$this->subs_amt->CurrentValue = 0;
		$this->ins_datetime->CurrentValue = NULL;
		$this->ins_datetime->OldValue = $this->ins_datetime->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->serv_id->FldIsDetailKey) {
			$this->serv_id->setFormValue($objForm->GetValue("x_serv_id"));
		}
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		if (!$this->cycle_id->FldIsDetailKey) {
			$this->cycle_id->setFormValue($objForm->GetValue("x_cycle_id"));
		}
		if (!$this->book_id->FldIsDetailKey) {
			$this->book_id->setFormValue($objForm->GetValue("x_book_id"));
		}
		if (!$this->pkg_id->FldIsDetailKey) {
			$this->pkg_id->setFormValue($objForm->GetValue("x_pkg_id"));
		}
		if (!$this->tcat_id->FldIsDetailKey) {
			$this->tcat_id->setFormValue($objForm->GetValue("x_tcat_id"));
		}
		if (!$this->test_id->FldIsDetailKey) {
			$this->test_id->setFormValue($objForm->GetValue("x_test_id"));
		}
		if (!$this->cat_id->FldIsDetailKey) {
			$this->cat_id->setFormValue($objForm->GetValue("x_cat_id"));
		}
		if (!$this->cons_id->FldIsDetailKey) {
			$this->cons_id->setFormValue($objForm->GetValue("x_cons_id"));
		}
		if (!$this->subs_start->FldIsDetailKey) {
			$this->subs_start->setFormValue($objForm->GetValue("x_subs_start"));
			$this->subs_start->CurrentValue = ew_UnFormatDateTime($this->subs_start->CurrentValue, 0);
		}
		if (!$this->subs_end->FldIsDetailKey) {
			$this->subs_end->setFormValue($objForm->GetValue("x_subs_end"));
			$this->subs_end->CurrentValue = ew_UnFormatDateTime($this->subs_end->CurrentValue, 0);
		}
		if (!$this->subs_qnt->FldIsDetailKey) {
			$this->subs_qnt->setFormValue($objForm->GetValue("x_subs_qnt"));
		}
		if (!$this->subs_price->FldIsDetailKey) {
			$this->subs_price->setFormValue($objForm->GetValue("x_subs_price"));
		}
		if (!$this->subs_amt->FldIsDetailKey) {
			$this->subs_amt->setFormValue($objForm->GetValue("x_subs_amt"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->serv_id->CurrentValue = $this->serv_id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->cycle_id->CurrentValue = $this->cycle_id->FormValue;
		$this->book_id->CurrentValue = $this->book_id->FormValue;
		$this->pkg_id->CurrentValue = $this->pkg_id->FormValue;
		$this->tcat_id->CurrentValue = $this->tcat_id->FormValue;
		$this->test_id->CurrentValue = $this->test_id->FormValue;
		$this->cat_id->CurrentValue = $this->cat_id->FormValue;
		$this->cons_id->CurrentValue = $this->cons_id->FormValue;
		$this->subs_start->CurrentValue = $this->subs_start->FormValue;
		$this->subs_start->CurrentValue = ew_UnFormatDateTime($this->subs_start->CurrentValue, 0);
		$this->subs_end->CurrentValue = $this->subs_end->FormValue;
		$this->subs_end->CurrentValue = ew_UnFormatDateTime($this->subs_end->CurrentValue, 0);
		$this->subs_qnt->CurrentValue = $this->subs_qnt->FormValue;
		$this->subs_price->CurrentValue = $this->subs_price->FormValue;
		$this->subs_amt->CurrentValue = $this->subs_amt->FormValue;
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
		$this->subs_id->setDbValue($row['subs_id']);
		$this->serv_id->setDbValue($row['serv_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->cycle_id->setDbValue($row['cycle_id']);
		$this->book_id->setDbValue($row['book_id']);
		$this->pkg_id->setDbValue($row['pkg_id']);
		$this->tcat_id->setDbValue($row['tcat_id']);
		$this->test_id->setDbValue($row['test_id']);
		$this->cat_id->setDbValue($row['cat_id']);
		$this->cons_id->setDbValue($row['cons_id']);
		$this->subs_start->setDbValue($row['subs_start']);
		$this->subs_end->setDbValue($row['subs_end']);
		$this->subs_qnt->setDbValue($row['subs_qnt']);
		$this->subs_price->setDbValue($row['subs_price']);
		$this->subs_amt->setDbValue($row['subs_amt']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['subs_id'] = $this->subs_id->CurrentValue;
		$row['serv_id'] = $this->serv_id->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['cycle_id'] = $this->cycle_id->CurrentValue;
		$row['book_id'] = $this->book_id->CurrentValue;
		$row['pkg_id'] = $this->pkg_id->CurrentValue;
		$row['tcat_id'] = $this->tcat_id->CurrentValue;
		$row['test_id'] = $this->test_id->CurrentValue;
		$row['cat_id'] = $this->cat_id->CurrentValue;
		$row['cons_id'] = $this->cons_id->CurrentValue;
		$row['subs_start'] = $this->subs_start->CurrentValue;
		$row['subs_end'] = $this->subs_end->CurrentValue;
		$row['subs_qnt'] = $this->subs_qnt->CurrentValue;
		$row['subs_price'] = $this->subs_price->CurrentValue;
		$row['subs_amt'] = $this->subs_amt->CurrentValue;
		$row['ins_datetime'] = $this->ins_datetime->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->subs_id->DbValue = $row['subs_id'];
		$this->serv_id->DbValue = $row['serv_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->cycle_id->DbValue = $row['cycle_id'];
		$this->book_id->DbValue = $row['book_id'];
		$this->pkg_id->DbValue = $row['pkg_id'];
		$this->tcat_id->DbValue = $row['tcat_id'];
		$this->test_id->DbValue = $row['test_id'];
		$this->cat_id->DbValue = $row['cat_id'];
		$this->cons_id->DbValue = $row['cons_id'];
		$this->subs_start->DbValue = $row['subs_start'];
		$this->subs_end->DbValue = $row['subs_end'];
		$this->subs_qnt->DbValue = $row['subs_qnt'];
		$this->subs_price->DbValue = $row['subs_price'];
		$this->subs_amt->DbValue = $row['subs_amt'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("subs_id")) <> "")
			$this->subs_id->CurrentValue = $this->getKey("subs_id"); // subs_id
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

		if ($this->subs_qnt->FormValue == $this->subs_qnt->CurrentValue && is_numeric(ew_StrToFloat($this->subs_qnt->CurrentValue)))
			$this->subs_qnt->CurrentValue = ew_StrToFloat($this->subs_qnt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subs_price->FormValue == $this->subs_price->CurrentValue && is_numeric(ew_StrToFloat($this->subs_price->CurrentValue)))
			$this->subs_price->CurrentValue = ew_StrToFloat($this->subs_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subs_amt->FormValue == $this->subs_amt->CurrentValue && is_numeric(ew_StrToFloat($this->subs_amt->CurrentValue)))
			$this->subs_amt->CurrentValue = ew_StrToFloat($this->subs_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// subs_id
		// serv_id
		// user_id
		// cycle_id
		// book_id
		// pkg_id
		// tcat_id
		// test_id
		// cat_id
		// cons_id
		// subs_start
		// subs_end
		// subs_qnt
		// subs_price
		// subs_amt
		// ins_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// serv_id
		if (strval($this->serv_id->CurrentValue) <> "") {
			$sFilterWrk = "`serv_id`" . ew_SearchString("=", $this->serv_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `serv_id`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_service`";
		$sWhereWrk = "";
		$this->serv_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->serv_id->ViewValue = $this->serv_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->serv_id->ViewValue = $this->serv_id->CurrentValue;
			}
		} else {
			$this->serv_id->ViewValue = NULL;
		}
		$this->serv_id->ViewCustomAttributes = "";

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

		// cycle_id
		if (strval($this->cycle_id->CurrentValue) <> "") {
			$sFilterWrk = "`cycle_id`" . ew_SearchString("=", $this->cycle_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cycle_id`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_bill_cycle`";
		$sWhereWrk = "";
		$this->cycle_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cycle_id->ViewValue = $this->cycle_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cycle_id->ViewValue = $this->cycle_id->CurrentValue;
			}
		} else {
			$this->cycle_id->ViewValue = NULL;
		}
		$this->cycle_id->ViewCustomAttributes = "";

		// book_id
		if (strval($this->book_id->CurrentValue) <> "") {
			$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
		$sWhereWrk = "";
		$this->book_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->book_id->ViewValue = $this->book_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->book_id->ViewValue = $this->book_id->CurrentValue;
			}
		} else {
			$this->book_id->ViewValue = NULL;
		}
		$this->book_id->ViewCustomAttributes = "";

		// pkg_id
		if (strval($this->pkg_id->CurrentValue) <> "") {
			$sFilterWrk = "`pkg_id`" . ew_SearchString("=", $this->pkg_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pkg_id`, `pkg_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_package`";
		$sWhereWrk = "";
		$this->pkg_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pkg_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pkg_id->ViewValue = $this->pkg_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pkg_id->ViewValue = $this->pkg_id->CurrentValue;
			}
		} else {
			$this->pkg_id->ViewValue = NULL;
		}
		$this->pkg_id->ViewCustomAttributes = "";

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

		// test_id
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->test_id->ViewValue = $this->test_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->test_id->ViewValue = $this->test_id->CurrentValue;
			}
		} else {
			$this->test_id->ViewValue = NULL;
		}
		$this->test_id->ViewCustomAttributes = "";

		// cat_id
		if (strval($this->cat_id->CurrentValue) <> "") {
			$sFilterWrk = "`cat_id`" . ew_SearchString("=", $this->cat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cat_id`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_category`";
		$sWhereWrk = "";
		$this->cat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cat_id->ViewValue = $this->cat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cat_id->ViewValue = $this->cat_id->CurrentValue;
			}
		} else {
			$this->cat_id->ViewValue = NULL;
		}
		$this->cat_id->ViewCustomAttributes = "";

		// cons_id
		if (strval($this->cons_id->CurrentValue) <> "") {
			$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cons_id`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
		$sWhereWrk = "";
		$this->cons_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cons_id->ViewValue = $this->cons_id->CurrentValue;
			}
		} else {
			$this->cons_id->ViewValue = NULL;
		}
		$this->cons_id->ViewCustomAttributes = "";

		// subs_start
		$this->subs_start->ViewValue = $this->subs_start->CurrentValue;
		$this->subs_start->ViewValue = ew_FormatDateTime($this->subs_start->ViewValue, 0);
		$this->subs_start->ViewCustomAttributes = "";

		// subs_end
		$this->subs_end->ViewValue = $this->subs_end->CurrentValue;
		$this->subs_end->ViewValue = ew_FormatDateTime($this->subs_end->ViewValue, 0);
		$this->subs_end->ViewCustomAttributes = "";

		// subs_qnt
		$this->subs_qnt->ViewValue = $this->subs_qnt->CurrentValue;
		$this->subs_qnt->ViewCustomAttributes = "";

		// subs_price
		$this->subs_price->ViewValue = $this->subs_price->CurrentValue;
		$this->subs_price->ViewCustomAttributes = "";

		// subs_amt
		$this->subs_amt->ViewValue = $this->subs_amt->CurrentValue;
		$this->subs_amt->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

			// serv_id
			$this->serv_id->LinkCustomAttributes = "";
			$this->serv_id->HrefValue = "";
			$this->serv_id->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// cycle_id
			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";
			$this->cycle_id->TooltipValue = "";

			// book_id
			$this->book_id->LinkCustomAttributes = "";
			$this->book_id->HrefValue = "";
			$this->book_id->TooltipValue = "";

			// pkg_id
			$this->pkg_id->LinkCustomAttributes = "";
			$this->pkg_id->HrefValue = "";
			$this->pkg_id->TooltipValue = "";

			// tcat_id
			$this->tcat_id->LinkCustomAttributes = "";
			$this->tcat_id->HrefValue = "";
			$this->tcat_id->TooltipValue = "";

			// test_id
			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";
			$this->test_id->TooltipValue = "";

			// cat_id
			$this->cat_id->LinkCustomAttributes = "";
			$this->cat_id->HrefValue = "";
			$this->cat_id->TooltipValue = "";

			// cons_id
			$this->cons_id->LinkCustomAttributes = "";
			$this->cons_id->HrefValue = "";
			$this->cons_id->TooltipValue = "";

			// subs_start
			$this->subs_start->LinkCustomAttributes = "";
			$this->subs_start->HrefValue = "";
			$this->subs_start->TooltipValue = "";

			// subs_end
			$this->subs_end->LinkCustomAttributes = "";
			$this->subs_end->HrefValue = "";
			$this->subs_end->TooltipValue = "";

			// subs_qnt
			$this->subs_qnt->LinkCustomAttributes = "";
			$this->subs_qnt->HrefValue = "";
			$this->subs_qnt->TooltipValue = "";

			// subs_price
			$this->subs_price->LinkCustomAttributes = "";
			$this->subs_price->HrefValue = "";
			$this->subs_price->TooltipValue = "";

			// subs_amt
			$this->subs_amt->LinkCustomAttributes = "";
			$this->subs_amt->HrefValue = "";
			$this->subs_amt->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// serv_id
			$this->serv_id->EditAttrs["class"] = "form-control";
			$this->serv_id->EditCustomAttributes = "";
			if (trim(strval($this->serv_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`serv_id`" . ew_SearchString("=", $this->serv_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `serv_id`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_service`";
			$sWhereWrk = "";
			$this->serv_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->serv_id->EditValue = $arwrk;

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

			// cycle_id
			$this->cycle_id->EditAttrs["class"] = "form-control";
			$this->cycle_id->EditCustomAttributes = "";
			if (trim(strval($this->cycle_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cycle_id`" . ew_SearchString("=", $this->cycle_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cycle_id`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_bill_cycle`";
			$sWhereWrk = "";
			$this->cycle_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cycle_id->EditValue = $arwrk;

			// book_id
			$this->book_id->EditAttrs["class"] = "form-control";
			$this->book_id->EditCustomAttributes = "";
			if (trim(strval($this->book_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_book`";
			$sWhereWrk = "";
			$this->book_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->book_id->EditValue = $arwrk;

			// pkg_id
			$this->pkg_id->EditAttrs["class"] = "form-control";
			$this->pkg_id->EditCustomAttributes = "";
			if (trim(strval($this->pkg_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pkg_id`" . ew_SearchString("=", $this->pkg_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `pkg_id`, `pkg_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_tips_package`";
			$sWhereWrk = "";
			$this->pkg_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pkg_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pkg_id->EditValue = $arwrk;

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

			// test_id
			$this->test_id->EditAttrs["class"] = "form-control";
			$this->test_id->EditCustomAttributes = "";
			if (trim(strval($this->test_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_test`";
			$sWhereWrk = "";
			$this->test_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->test_id->EditValue = $arwrk;

			// cat_id
			$this->cat_id->EditAttrs["class"] = "form-control";
			$this->cat_id->EditCustomAttributes = "";
			if (trim(strval($this->cat_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cat_id`" . ew_SearchString("=", $this->cat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cat_id`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation_category`";
			$sWhereWrk = "";
			$this->cat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cat_id->EditValue = $arwrk;

			// cons_id
			$this->cons_id->EditAttrs["class"] = "form-control";
			$this->cons_id->EditCustomAttributes = "";
			if (trim(strval($this->cons_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cons_id`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation`";
			$sWhereWrk = "";
			$this->cons_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cons_id->EditValue = $arwrk;

			// subs_start
			$this->subs_start->EditAttrs["class"] = "form-control";
			$this->subs_start->EditCustomAttributes = "";
			$this->subs_start->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->subs_start->CurrentValue, 8));
			$this->subs_start->PlaceHolder = ew_RemoveHtml($this->subs_start->FldCaption());

			// subs_end
			$this->subs_end->EditAttrs["class"] = "form-control";
			$this->subs_end->EditCustomAttributes = "";
			$this->subs_end->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->subs_end->CurrentValue, 8));
			$this->subs_end->PlaceHolder = ew_RemoveHtml($this->subs_end->FldCaption());

			// subs_qnt
			$this->subs_qnt->EditAttrs["class"] = "form-control";
			$this->subs_qnt->EditCustomAttributes = "";
			$this->subs_qnt->EditValue = ew_HtmlEncode($this->subs_qnt->CurrentValue);
			$this->subs_qnt->PlaceHolder = ew_RemoveHtml($this->subs_qnt->FldCaption());
			if (strval($this->subs_qnt->EditValue) <> "" && is_numeric($this->subs_qnt->EditValue)) $this->subs_qnt->EditValue = ew_FormatNumber($this->subs_qnt->EditValue, -2, -1, -2, 0);

			// subs_price
			$this->subs_price->EditAttrs["class"] = "form-control";
			$this->subs_price->EditCustomAttributes = "";
			$this->subs_price->EditValue = ew_HtmlEncode($this->subs_price->CurrentValue);
			$this->subs_price->PlaceHolder = ew_RemoveHtml($this->subs_price->FldCaption());
			if (strval($this->subs_price->EditValue) <> "" && is_numeric($this->subs_price->EditValue)) $this->subs_price->EditValue = ew_FormatNumber($this->subs_price->EditValue, -2, -1, -2, 0);

			// subs_amt
			$this->subs_amt->EditAttrs["class"] = "form-control";
			$this->subs_amt->EditCustomAttributes = "";
			$this->subs_amt->EditValue = ew_HtmlEncode($this->subs_amt->CurrentValue);
			$this->subs_amt->PlaceHolder = ew_RemoveHtml($this->subs_amt->FldCaption());
			if (strval($this->subs_amt->EditValue) <> "" && is_numeric($this->subs_amt->EditValue)) $this->subs_amt->EditValue = ew_FormatNumber($this->subs_amt->EditValue, -2, -1, -2, 0);

			// Add refer script
			// serv_id

			$this->serv_id->LinkCustomAttributes = "";
			$this->serv_id->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// cycle_id
			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";

			// book_id
			$this->book_id->LinkCustomAttributes = "";
			$this->book_id->HrefValue = "";

			// pkg_id
			$this->pkg_id->LinkCustomAttributes = "";
			$this->pkg_id->HrefValue = "";

			// tcat_id
			$this->tcat_id->LinkCustomAttributes = "";
			$this->tcat_id->HrefValue = "";

			// test_id
			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";

			// cat_id
			$this->cat_id->LinkCustomAttributes = "";
			$this->cat_id->HrefValue = "";

			// cons_id
			$this->cons_id->LinkCustomAttributes = "";
			$this->cons_id->HrefValue = "";

			// subs_start
			$this->subs_start->LinkCustomAttributes = "";
			$this->subs_start->HrefValue = "";

			// subs_end
			$this->subs_end->LinkCustomAttributes = "";
			$this->subs_end->HrefValue = "";

			// subs_qnt
			$this->subs_qnt->LinkCustomAttributes = "";
			$this->subs_qnt->HrefValue = "";

			// subs_price
			$this->subs_price->LinkCustomAttributes = "";
			$this->subs_price->HrefValue = "";

			// subs_amt
			$this->subs_amt->LinkCustomAttributes = "";
			$this->subs_amt->HrefValue = "";
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
		if (!$this->subs_start->FldIsDetailKey && !is_null($this->subs_start->FormValue) && $this->subs_start->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->subs_start->FldCaption(), $this->subs_start->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->subs_start->FormValue)) {
			ew_AddMessage($gsFormError, $this->subs_start->FldErrMsg());
		}
		if (!$this->subs_end->FldIsDetailKey && !is_null($this->subs_end->FormValue) && $this->subs_end->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->subs_end->FldCaption(), $this->subs_end->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->subs_end->FormValue)) {
			ew_AddMessage($gsFormError, $this->subs_end->FldErrMsg());
		}
		if (!ew_CheckNumber($this->subs_qnt->FormValue)) {
			ew_AddMessage($gsFormError, $this->subs_qnt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->subs_price->FormValue)) {
			ew_AddMessage($gsFormError, $this->subs_price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->subs_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->subs_amt->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("app_subscribe_cats", $DetailTblVar) && $GLOBALS["app_subscribe_cats"]->DetailAdd) {
			if (!isset($GLOBALS["app_subscribe_cats_grid"])) $GLOBALS["app_subscribe_cats_grid"] = new capp_subscribe_cats_grid(); // get detail page object
			$GLOBALS["app_subscribe_cats_grid"]->ValidateGridForm();
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
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// serv_id
		$this->serv_id->SetDbValueDef($rsnew, $this->serv_id->CurrentValue, 0, strval($this->serv_id->CurrentValue) == "");

		// user_id
		$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, 0, strval($this->user_id->CurrentValue) == "");

		// cycle_id
		$this->cycle_id->SetDbValueDef($rsnew, $this->cycle_id->CurrentValue, 0, strval($this->cycle_id->CurrentValue) == "");

		// book_id
		$this->book_id->SetDbValueDef($rsnew, $this->book_id->CurrentValue, 0, strval($this->book_id->CurrentValue) == "");

		// pkg_id
		$this->pkg_id->SetDbValueDef($rsnew, $this->pkg_id->CurrentValue, 0, strval($this->pkg_id->CurrentValue) == "");

		// tcat_id
		$this->tcat_id->SetDbValueDef($rsnew, $this->tcat_id->CurrentValue, 0, strval($this->tcat_id->CurrentValue) == "");

		// test_id
		$this->test_id->SetDbValueDef($rsnew, $this->test_id->CurrentValue, 0, strval($this->test_id->CurrentValue) == "");

		// cat_id
		$this->cat_id->SetDbValueDef($rsnew, $this->cat_id->CurrentValue, 0, strval($this->cat_id->CurrentValue) == "");

		// cons_id
		$this->cons_id->SetDbValueDef($rsnew, $this->cons_id->CurrentValue, 0, strval($this->cons_id->CurrentValue) == "");

		// subs_start
		$this->subs_start->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->subs_start->CurrentValue, 0), ew_CurrentDate(), FALSE);

		// subs_end
		$this->subs_end->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->subs_end->CurrentValue, 0), ew_CurrentDate(), FALSE);

		// subs_qnt
		$this->subs_qnt->SetDbValueDef($rsnew, $this->subs_qnt->CurrentValue, 0, strval($this->subs_qnt->CurrentValue) == "");

		// subs_price
		$this->subs_price->SetDbValueDef($rsnew, $this->subs_price->CurrentValue, 0, strval($this->subs_price->CurrentValue) == "");

		// subs_amt
		$this->subs_amt->SetDbValueDef($rsnew, $this->subs_amt->CurrentValue, 0, strval($this->subs_amt->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
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
			if (in_array("app_subscribe_cats", $DetailTblVar) && $GLOBALS["app_subscribe_cats"]->DetailAdd) {
				$GLOBALS["app_subscribe_cats"]->sub_id->setSessionValue($this->subs_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["app_subscribe_cats_grid"])) $GLOBALS["app_subscribe_cats_grid"] = new capp_subscribe_cats_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "app_subscribe_cats"); // Load user level of detail table
				$AddRow = $GLOBALS["app_subscribe_cats_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["app_subscribe_cats"]->sub_id->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("app_subscribe_cats", $DetailTblVar)) {
				if (!isset($GLOBALS["app_subscribe_cats_grid"]))
					$GLOBALS["app_subscribe_cats_grid"] = new capp_subscribe_cats_grid;
				if ($GLOBALS["app_subscribe_cats_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["app_subscribe_cats_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["app_subscribe_cats_grid"]->CurrentMode = "add";
					$GLOBALS["app_subscribe_cats_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["app_subscribe_cats_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_subscribe_cats_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_subscribe_cats_grid"]->sub_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_subscribe_cats_grid"]->sub_id->CurrentValue = $this->subs_id->CurrentValue;
					$GLOBALS["app_subscribe_cats_grid"]->sub_id->setSessionValue($GLOBALS["app_subscribe_cats_grid"]->sub_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_subscribelist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_serv_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `serv_id` AS `LinkFld`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_service`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`serv_id` IN ({filter_value})', "t0" => "2", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
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
		case "x_cycle_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cycle_id` AS `LinkFld`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_bill_cycle`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cycle_id` IN ({filter_value})', "t0" => "2", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_book_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `book_id` AS `LinkFld`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`book_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_pkg_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pkg_id` AS `LinkFld`, `pkg_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_package`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pkg_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pkg_id, $sWhereWrk); // Call Lookup Selecting
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
		case "x_test_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `test_id` AS `LinkFld`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`test_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cat_id` AS `LinkFld`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_category`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cat_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cons_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cons_id` AS `LinkFld`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cons_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($app_subscribe_add)) $app_subscribe_add = new capp_subscribe_add();

// Page init
$app_subscribe_add->Page_Init();

// Page main
$app_subscribe_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_subscribe_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fapp_subscribeadd = new ew_Form("fapp_subscribeadd", "add");

// Validate form
fapp_subscribeadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_subs_start");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe->subs_start->FldCaption(), $app_subscribe->subs_start->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_subs_start");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_start->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subs_end");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe->subs_end->FldCaption(), $app_subscribe->subs_end->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_subs_end");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_end->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subs_qnt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_qnt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subs_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subs_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_amt->FldErrMsg()) ?>");

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
fapp_subscribeadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_subscribeadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_subscribeadd.Lists["x_serv_id"] = {"LinkField":"x_serv_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_serv_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_service"};
fapp_subscribeadd.Lists["x_serv_id"].Data = "<?php echo $app_subscribe_add->serv_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_subscribeadd.Lists["x_user_id"].Data = "<?php echo $app_subscribe_add->user_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_cycle_id"] = {"LinkField":"x_cycle_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cycle_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_bill_cycle"};
fapp_subscribeadd.Lists["x_cycle_id"].Data = "<?php echo $app_subscribe_add->cycle_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_subscribeadd.Lists["x_book_id"].Data = "<?php echo $app_subscribe_add->book_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_pkg_id"] = {"LinkField":"x_pkg_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pkg_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_package"};
fapp_subscribeadd.Lists["x_pkg_id"].Data = "<?php echo $app_subscribe_add->pkg_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_subscribeadd.Lists["x_tcat_id"].Data = "<?php echo $app_subscribe_add->tcat_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_subscribeadd.Lists["x_test_id"].Data = "<?php echo $app_subscribe_add->test_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_subscribeadd.Lists["x_cat_id"].Data = "<?php echo $app_subscribe_add->cat_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_subscribeadd.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_amount","x_cons_message","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_subscribeadd.Lists["x_cons_id"].Data = "<?php echo $app_subscribe_add->cons_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_subscribe_add->ShowPageHeader(); ?>
<?php
$app_subscribe_add->ShowMessage();
?>
<form name="fapp_subscribeadd" id="fapp_subscribeadd" class="<?php echo $app_subscribe_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_subscribe_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_subscribe_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_subscribe">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($app_subscribe_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
	<div id="r_serv_id" class="form-group">
		<label id="elh_app_subscribe_serv_id" for="x_serv_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->serv_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->serv_id->CellAttributes() ?>>
<span id="el_app_subscribe_serv_id">
<select data-table="app_subscribe" data-field="x_serv_id" data-value-separator="<?php echo $app_subscribe->serv_id->DisplayValueSeparatorAttribute() ?>" id="x_serv_id" name="x_serv_id"<?php echo $app_subscribe->serv_id->EditAttributes() ?>>
<?php echo $app_subscribe->serv_id->SelectOptionListHtml("x_serv_id") ?>
</select>
</span>
<?php echo $app_subscribe->serv_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label id="elh_app_subscribe_user_id" for="x_user_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->user_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->user_id->CellAttributes() ?>>
<span id="el_app_subscribe_user_id">
<select data-table="app_subscribe" data-field="x_user_id" data-value-separator="<?php echo $app_subscribe->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_subscribe->user_id->EditAttributes() ?>>
<?php echo $app_subscribe->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
<?php echo $app_subscribe->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
	<div id="r_cycle_id" class="form-group">
		<label id="elh_app_subscribe_cycle_id" for="x_cycle_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->cycle_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->cycle_id->CellAttributes() ?>>
<span id="el_app_subscribe_cycle_id">
<select data-table="app_subscribe" data-field="x_cycle_id" data-value-separator="<?php echo $app_subscribe->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x_cycle_id" name="x_cycle_id"<?php echo $app_subscribe->cycle_id->EditAttributes() ?>>
<?php echo $app_subscribe->cycle_id->SelectOptionListHtml("x_cycle_id") ?>
</select>
</span>
<?php echo $app_subscribe->cycle_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
	<div id="r_book_id" class="form-group">
		<label id="elh_app_subscribe_book_id" for="x_book_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->book_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->book_id->CellAttributes() ?>>
<span id="el_app_subscribe_book_id">
<select data-table="app_subscribe" data-field="x_book_id" data-value-separator="<?php echo $app_subscribe->book_id->DisplayValueSeparatorAttribute() ?>" id="x_book_id" name="x_book_id"<?php echo $app_subscribe->book_id->EditAttributes() ?>>
<?php echo $app_subscribe->book_id->SelectOptionListHtml("x_book_id") ?>
</select>
</span>
<?php echo $app_subscribe->book_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->pkg_id->Visible) { // pkg_id ?>
	<div id="r_pkg_id" class="form-group">
		<label id="elh_app_subscribe_pkg_id" for="x_pkg_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->pkg_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->pkg_id->CellAttributes() ?>>
<span id="el_app_subscribe_pkg_id">
<select data-table="app_subscribe" data-field="x_pkg_id" data-value-separator="<?php echo $app_subscribe->pkg_id->DisplayValueSeparatorAttribute() ?>" id="x_pkg_id" name="x_pkg_id"<?php echo $app_subscribe->pkg_id->EditAttributes() ?>>
<?php echo $app_subscribe->pkg_id->SelectOptionListHtml("x_pkg_id") ?>
</select>
</span>
<?php echo $app_subscribe->pkg_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
	<div id="r_tcat_id" class="form-group">
		<label id="elh_app_subscribe_tcat_id" for="x_tcat_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->tcat_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->tcat_id->CellAttributes() ?>>
<span id="el_app_subscribe_tcat_id">
<select data-table="app_subscribe" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x_tcat_id" name="x_tcat_id"<?php echo $app_subscribe->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe->tcat_id->SelectOptionListHtml("x_tcat_id") ?>
</select>
</span>
<?php echo $app_subscribe->tcat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
	<div id="r_test_id" class="form-group">
		<label id="elh_app_subscribe_test_id" for="x_test_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->test_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->test_id->CellAttributes() ?>>
<span id="el_app_subscribe_test_id">
<select data-table="app_subscribe" data-field="x_test_id" data-value-separator="<?php echo $app_subscribe->test_id->DisplayValueSeparatorAttribute() ?>" id="x_test_id" name="x_test_id"<?php echo $app_subscribe->test_id->EditAttributes() ?>>
<?php echo $app_subscribe->test_id->SelectOptionListHtml("x_test_id") ?>
</select>
</span>
<?php echo $app_subscribe->test_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
	<div id="r_cat_id" class="form-group">
		<label id="elh_app_subscribe_cat_id" for="x_cat_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->cat_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->cat_id->CellAttributes() ?>>
<span id="el_app_subscribe_cat_id">
<select data-table="app_subscribe" data-field="x_cat_id" data-value-separator="<?php echo $app_subscribe->cat_id->DisplayValueSeparatorAttribute() ?>" id="x_cat_id" name="x_cat_id"<?php echo $app_subscribe->cat_id->EditAttributes() ?>>
<?php echo $app_subscribe->cat_id->SelectOptionListHtml("x_cat_id") ?>
</select>
</span>
<?php echo $app_subscribe->cat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
	<div id="r_cons_id" class="form-group">
		<label id="elh_app_subscribe_cons_id" for="x_cons_id" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->cons_id->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->cons_id->CellAttributes() ?>>
<span id="el_app_subscribe_cons_id">
<select data-table="app_subscribe" data-field="x_cons_id" data-value-separator="<?php echo $app_subscribe->cons_id->DisplayValueSeparatorAttribute() ?>" id="x_cons_id" name="x_cons_id"<?php echo $app_subscribe->cons_id->EditAttributes() ?>>
<?php echo $app_subscribe->cons_id->SelectOptionListHtml("x_cons_id") ?>
</select>
</span>
<?php echo $app_subscribe->cons_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
	<div id="r_subs_start" class="form-group">
		<label id="elh_app_subscribe_subs_start" for="x_subs_start" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->subs_start->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_start->CellAttributes() ?>>
<span id="el_app_subscribe_subs_start">
<input type="text" data-table="app_subscribe" data-field="x_subs_start" name="x_subs_start" id="x_subs_start" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_start->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_start->EditValue ?>"<?php echo $app_subscribe->subs_start->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_start->ReadOnly && !$app_subscribe->subs_start->Disabled && !isset($app_subscribe->subs_start->EditAttrs["readonly"]) && !isset($app_subscribe->subs_start->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribeadd", "x_subs_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $app_subscribe->subs_start->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
	<div id="r_subs_end" class="form-group">
		<label id="elh_app_subscribe_subs_end" for="x_subs_end" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->subs_end->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_end->CellAttributes() ?>>
<span id="el_app_subscribe_subs_end">
<input type="text" data-table="app_subscribe" data-field="x_subs_end" name="x_subs_end" id="x_subs_end" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_end->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_end->EditValue ?>"<?php echo $app_subscribe->subs_end->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_end->ReadOnly && !$app_subscribe->subs_end->Disabled && !isset($app_subscribe->subs_end->EditAttrs["readonly"]) && !isset($app_subscribe->subs_end->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribeadd", "x_subs_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $app_subscribe->subs_end->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
	<div id="r_subs_qnt" class="form-group">
		<label id="elh_app_subscribe_subs_qnt" for="x_subs_qnt" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->subs_qnt->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_qnt->CellAttributes() ?>>
<span id="el_app_subscribe_subs_qnt">
<input type="text" data-table="app_subscribe" data-field="x_subs_qnt" name="x_subs_qnt" id="x_subs_qnt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_qnt->EditValue ?>"<?php echo $app_subscribe->subs_qnt->EditAttributes() ?>>
</span>
<?php echo $app_subscribe->subs_qnt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
	<div id="r_subs_price" class="form-group">
		<label id="elh_app_subscribe_subs_price" for="x_subs_price" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->subs_price->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_price->CellAttributes() ?>>
<span id="el_app_subscribe_subs_price">
<input type="text" data-table="app_subscribe" data-field="x_subs_price" name="x_subs_price" id="x_subs_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_price->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_price->EditValue ?>"<?php echo $app_subscribe->subs_price->EditAttributes() ?>>
</span>
<?php echo $app_subscribe->subs_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
	<div id="r_subs_amt" class="form-group">
		<label id="elh_app_subscribe_subs_amt" for="x_subs_amt" class="<?php echo $app_subscribe_add->LeftColumnClass ?>"><?php echo $app_subscribe->subs_amt->FldCaption() ?></label>
		<div class="<?php echo $app_subscribe_add->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_amt->CellAttributes() ?>>
<span id="el_app_subscribe_subs_amt">
<input type="text" data-table="app_subscribe" data-field="x_subs_amt" name="x_subs_amt" id="x_subs_amt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_amt->EditValue ?>"<?php echo $app_subscribe->subs_amt->EditAttributes() ?>>
</span>
<?php echo $app_subscribe->subs_amt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("app_subscribe_cats", explode(",", $app_subscribe->getCurrentDetailTable())) && $app_subscribe_cats->DetailAdd) {
?>
<?php if ($app_subscribe->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_subscribe_cats", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_subscribe_catsgrid.php" ?>
<?php } ?>
<?php if (!$app_subscribe_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_subscribe_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_subscribe_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_subscribeadd.Init();
</script>
<?php
$app_subscribe_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_subscribe_add->Page_Terminate();
?>
