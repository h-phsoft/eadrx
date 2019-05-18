<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_vtest_evaluateinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_vtest_evaluate_list = NULL; // Initialize page object first

class capp_vtest_evaluate_list extends capp_vtest_evaluate {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_vtest_evaluate';

	// Page object name
	var $PageObjName = 'app_vtest_evaluate_list';

	// Grid form hidden field names
	var $FormName = 'fapp_vtest_evaluatelist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Table object (app_vtest_evaluate)
		if (!isset($GLOBALS["app_vtest_evaluate"]) || get_class($GLOBALS["app_vtest_evaluate"]) == "capp_vtest_evaluate") {
			$GLOBALS["app_vtest_evaluate"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_vtest_evaluate"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "app_vtest_evaluateadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "app_vtest_evaluatedelete.php";
		$this->MultiUpdateUrl = "app_vtest_evaluateupdate.php";

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_vtest_evaluate', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fapp_vtest_evaluatelistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
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
		// Get export parameters

		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} elseif (@$_GET["cmd"] == "json") {
			$this->Export = $_GET["cmd"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->test_num->SetVisibility();
		$this->test_iname->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->test_price->SetVisibility();
		$this->test_image->SetVisibility();
		$this->test_name->SetVisibility();
		$this->test_desc->SetVisibility();
		$this->gend_id->SetVisibility();
		$this->eval_from->SetVisibility();
		$this->eval_to->SetVisibility();
		$this->eval_text->SetVisibility();

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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
		global $EW_EXPORT, $app_vtest_evaluate;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_vtest_evaluate);
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 3) {
			$this->test_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->test_id->FormValue))
				return FALSE;
			$this->ntest_id->setFormValue($arrKeyFlds[1]);
			if (!is_numeric($this->ntest_id->FormValue))
				return FALSE;
			$this->eval_id->setFormValue($arrKeyFlds[2]);
			if (!is_numeric($this->eval_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->test_num->AdvancedSearch->ToJson(), ","); // Field test_num
		$sFilterList = ew_Concat($sFilterList, $this->test_iname->AdvancedSearch->ToJson(), ","); // Field test_iname
		$sFilterList = ew_Concat($sFilterList, $this->lang_id->AdvancedSearch->ToJson(), ","); // Field lang_id
		$sFilterList = ew_Concat($sFilterList, $this->status_id->AdvancedSearch->ToJson(), ","); // Field status_id
		$sFilterList = ew_Concat($sFilterList, $this->test_price->AdvancedSearch->ToJson(), ","); // Field test_price
		$sFilterList = ew_Concat($sFilterList, $this->test_image->AdvancedSearch->ToJson(), ","); // Field test_image
		$sFilterList = ew_Concat($sFilterList, $this->test_name->AdvancedSearch->ToJson(), ","); // Field test_name
		$sFilterList = ew_Concat($sFilterList, $this->test_desc->AdvancedSearch->ToJson(), ","); // Field test_desc
		$sFilterList = ew_Concat($sFilterList, $this->gend_id->AdvancedSearch->ToJson(), ","); // Field gend_id
		$sFilterList = ew_Concat($sFilterList, $this->eval_from->AdvancedSearch->ToJson(), ","); // Field eval_from
		$sFilterList = ew_Concat($sFilterList, $this->eval_to->AdvancedSearch->ToJson(), ","); // Field eval_to
		$sFilterList = ew_Concat($sFilterList, $this->eval_text->AdvancedSearch->ToJson(), ","); // Field eval_text
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "fapp_vtest_evaluatelistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field test_num
		$this->test_num->AdvancedSearch->SearchValue = @$filter["x_test_num"];
		$this->test_num->AdvancedSearch->SearchOperator = @$filter["z_test_num"];
		$this->test_num->AdvancedSearch->SearchCondition = @$filter["v_test_num"];
		$this->test_num->AdvancedSearch->SearchValue2 = @$filter["y_test_num"];
		$this->test_num->AdvancedSearch->SearchOperator2 = @$filter["w_test_num"];
		$this->test_num->AdvancedSearch->Save();

		// Field test_iname
		$this->test_iname->AdvancedSearch->SearchValue = @$filter["x_test_iname"];
		$this->test_iname->AdvancedSearch->SearchOperator = @$filter["z_test_iname"];
		$this->test_iname->AdvancedSearch->SearchCondition = @$filter["v_test_iname"];
		$this->test_iname->AdvancedSearch->SearchValue2 = @$filter["y_test_iname"];
		$this->test_iname->AdvancedSearch->SearchOperator2 = @$filter["w_test_iname"];
		$this->test_iname->AdvancedSearch->Save();

		// Field lang_id
		$this->lang_id->AdvancedSearch->SearchValue = @$filter["x_lang_id"];
		$this->lang_id->AdvancedSearch->SearchOperator = @$filter["z_lang_id"];
		$this->lang_id->AdvancedSearch->SearchCondition = @$filter["v_lang_id"];
		$this->lang_id->AdvancedSearch->SearchValue2 = @$filter["y_lang_id"];
		$this->lang_id->AdvancedSearch->SearchOperator2 = @$filter["w_lang_id"];
		$this->lang_id->AdvancedSearch->Save();

		// Field status_id
		$this->status_id->AdvancedSearch->SearchValue = @$filter["x_status_id"];
		$this->status_id->AdvancedSearch->SearchOperator = @$filter["z_status_id"];
		$this->status_id->AdvancedSearch->SearchCondition = @$filter["v_status_id"];
		$this->status_id->AdvancedSearch->SearchValue2 = @$filter["y_status_id"];
		$this->status_id->AdvancedSearch->SearchOperator2 = @$filter["w_status_id"];
		$this->status_id->AdvancedSearch->Save();

		// Field test_price
		$this->test_price->AdvancedSearch->SearchValue = @$filter["x_test_price"];
		$this->test_price->AdvancedSearch->SearchOperator = @$filter["z_test_price"];
		$this->test_price->AdvancedSearch->SearchCondition = @$filter["v_test_price"];
		$this->test_price->AdvancedSearch->SearchValue2 = @$filter["y_test_price"];
		$this->test_price->AdvancedSearch->SearchOperator2 = @$filter["w_test_price"];
		$this->test_price->AdvancedSearch->Save();

		// Field test_image
		$this->test_image->AdvancedSearch->SearchValue = @$filter["x_test_image"];
		$this->test_image->AdvancedSearch->SearchOperator = @$filter["z_test_image"];
		$this->test_image->AdvancedSearch->SearchCondition = @$filter["v_test_image"];
		$this->test_image->AdvancedSearch->SearchValue2 = @$filter["y_test_image"];
		$this->test_image->AdvancedSearch->SearchOperator2 = @$filter["w_test_image"];
		$this->test_image->AdvancedSearch->Save();

		// Field test_name
		$this->test_name->AdvancedSearch->SearchValue = @$filter["x_test_name"];
		$this->test_name->AdvancedSearch->SearchOperator = @$filter["z_test_name"];
		$this->test_name->AdvancedSearch->SearchCondition = @$filter["v_test_name"];
		$this->test_name->AdvancedSearch->SearchValue2 = @$filter["y_test_name"];
		$this->test_name->AdvancedSearch->SearchOperator2 = @$filter["w_test_name"];
		$this->test_name->AdvancedSearch->Save();

		// Field test_desc
		$this->test_desc->AdvancedSearch->SearchValue = @$filter["x_test_desc"];
		$this->test_desc->AdvancedSearch->SearchOperator = @$filter["z_test_desc"];
		$this->test_desc->AdvancedSearch->SearchCondition = @$filter["v_test_desc"];
		$this->test_desc->AdvancedSearch->SearchValue2 = @$filter["y_test_desc"];
		$this->test_desc->AdvancedSearch->SearchOperator2 = @$filter["w_test_desc"];
		$this->test_desc->AdvancedSearch->Save();

		// Field gend_id
		$this->gend_id->AdvancedSearch->SearchValue = @$filter["x_gend_id"];
		$this->gend_id->AdvancedSearch->SearchOperator = @$filter["z_gend_id"];
		$this->gend_id->AdvancedSearch->SearchCondition = @$filter["v_gend_id"];
		$this->gend_id->AdvancedSearch->SearchValue2 = @$filter["y_gend_id"];
		$this->gend_id->AdvancedSearch->SearchOperator2 = @$filter["w_gend_id"];
		$this->gend_id->AdvancedSearch->Save();

		// Field eval_from
		$this->eval_from->AdvancedSearch->SearchValue = @$filter["x_eval_from"];
		$this->eval_from->AdvancedSearch->SearchOperator = @$filter["z_eval_from"];
		$this->eval_from->AdvancedSearch->SearchCondition = @$filter["v_eval_from"];
		$this->eval_from->AdvancedSearch->SearchValue2 = @$filter["y_eval_from"];
		$this->eval_from->AdvancedSearch->SearchOperator2 = @$filter["w_eval_from"];
		$this->eval_from->AdvancedSearch->Save();

		// Field eval_to
		$this->eval_to->AdvancedSearch->SearchValue = @$filter["x_eval_to"];
		$this->eval_to->AdvancedSearch->SearchOperator = @$filter["z_eval_to"];
		$this->eval_to->AdvancedSearch->SearchCondition = @$filter["v_eval_to"];
		$this->eval_to->AdvancedSearch->SearchValue2 = @$filter["y_eval_to"];
		$this->eval_to->AdvancedSearch->SearchOperator2 = @$filter["w_eval_to"];
		$this->eval_to->AdvancedSearch->Save();

		// Field eval_text
		$this->eval_text->AdvancedSearch->SearchValue = @$filter["x_eval_text"];
		$this->eval_text->AdvancedSearch->SearchOperator = @$filter["z_eval_text"];
		$this->eval_text->AdvancedSearch->SearchCondition = @$filter["v_eval_text"];
		$this->eval_text->AdvancedSearch->SearchValue2 = @$filter["y_eval_text"];
		$this->eval_text->AdvancedSearch->SearchOperator2 = @$filter["w_eval_text"];
		$this->eval_text->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->test_iname, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->test_image, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->test_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->test_desc, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->eval_text, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->test_num); // test_num
			$this->UpdateSort($this->test_iname); // test_iname
			$this->UpdateSort($this->lang_id); // lang_id
			$this->UpdateSort($this->status_id); // status_id
			$this->UpdateSort($this->test_price); // test_price
			$this->UpdateSort($this->test_image); // test_image
			$this->UpdateSort($this->test_name); // test_name
			$this->UpdateSort($this->test_desc); // test_desc
			$this->UpdateSort($this->gend_id); // gend_id
			$this->UpdateSort($this->eval_from); // eval_from
			$this->UpdateSort($this->eval_to); // eval_to
			$this->UpdateSort($this->eval_text); // eval_text
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
				$this->lang_id->setSort("ASC");
				$this->test_num->setSort("ASC");
				$this->gend_id->setSort("ASC");
				$this->eval_from->setSort("ASC");
				$this->eval_to->setSort("ASC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->test_num->setSort("");
				$this->test_iname->setSort("");
				$this->lang_id->setSort("");
				$this->status_id->setSort("");
				$this->test_price->setSort("");
				$this->test_image->setSort("");
				$this->test_name->setSort("");
				$this->test_desc->setSort("");
				$this->gend_id->setSort("");
				$this->eval_from->setSort("");
				$this->eval_to->setSort("");
				$this->eval_text->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->test_id->CurrentValue . $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"] . $this->ntest_id->CurrentValue . $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"] . $this->eval_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fapp_vtest_evaluatelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fapp_vtest_evaluatelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fapp_vtest_evaluatelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fapp_vtest_evaluatelistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->test_id->setDbValue($row['test_id']);
		$this->ntest_id->setDbValue($row['ntest_id']);
		$this->eval_id->setDbValue($row['eval_id']);
		$this->test_num->setDbValue($row['test_num']);
		$this->test_iname->setDbValue($row['test_iname']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->test_price->setDbValue($row['test_price']);
		$this->test_image->Upload->DbValue = $row['test_image'];
		$this->test_image->setDbValue($this->test_image->Upload->DbValue);
		$this->test_name->setDbValue($row['test_name']);
		$this->test_desc->setDbValue($row['test_desc']);
		$this->gend_id->setDbValue($row['gend_id']);
		$this->eval_from->setDbValue($row['eval_from']);
		$this->eval_to->setDbValue($row['eval_to']);
		$this->eval_text->setDbValue($row['eval_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['test_id'] = NULL;
		$row['ntest_id'] = NULL;
		$row['eval_id'] = NULL;
		$row['test_num'] = NULL;
		$row['test_iname'] = NULL;
		$row['lang_id'] = NULL;
		$row['status_id'] = NULL;
		$row['test_price'] = NULL;
		$row['test_image'] = NULL;
		$row['test_name'] = NULL;
		$row['test_desc'] = NULL;
		$row['gend_id'] = NULL;
		$row['eval_from'] = NULL;
		$row['eval_to'] = NULL;
		$row['eval_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->test_id->DbValue = $row['test_id'];
		$this->ntest_id->DbValue = $row['ntest_id'];
		$this->eval_id->DbValue = $row['eval_id'];
		$this->test_num->DbValue = $row['test_num'];
		$this->test_iname->DbValue = $row['test_iname'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->test_price->DbValue = $row['test_price'];
		$this->test_image->Upload->DbValue = $row['test_image'];
		$this->test_name->DbValue = $row['test_name'];
		$this->test_desc->DbValue = $row['test_desc'];
		$this->gend_id->DbValue = $row['gend_id'];
		$this->eval_from->DbValue = $row['eval_from'];
		$this->eval_to->DbValue = $row['eval_to'];
		$this->eval_text->DbValue = $row['eval_text'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("test_id")) <> "")
			$this->test_id->CurrentValue = $this->getKey("test_id"); // test_id
		else
			$bValidKey = FALSE;
		if (strval($this->getKey("ntest_id")) <> "")
			$this->ntest_id->CurrentValue = $this->getKey("ntest_id"); // ntest_id
		else
			$bValidKey = FALSE;
		if (strval($this->getKey("eval_id")) <> "")
			$this->eval_id->CurrentValue = $this->getKey("eval_id"); // eval_id
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->test_price->FormValue == $this->test_price->CurrentValue && is_numeric(ew_StrToFloat($this->test_price->CurrentValue)))
			$this->test_price->CurrentValue = ew_StrToFloat($this->test_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->eval_from->FormValue == $this->eval_from->CurrentValue && is_numeric(ew_StrToFloat($this->eval_from->CurrentValue)))
			$this->eval_from->CurrentValue = ew_StrToFloat($this->eval_from->CurrentValue);

		// Convert decimal values if posted back
		if ($this->eval_to->FormValue == $this->eval_to->CurrentValue && is_numeric(ew_StrToFloat($this->eval_to->CurrentValue)))
			$this->eval_to->CurrentValue = ew_StrToFloat($this->eval_to->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// test_id

		$this->test_id->CellCssStyle = "white-space: nowrap;";

		// ntest_id
		$this->ntest_id->CellCssStyle = "white-space: nowrap;";

		// eval_id
		$this->eval_id->CellCssStyle = "white-space: nowrap;";

		// test_num
		// test_iname
		// lang_id
		// status_id
		// test_price
		// test_image
		// test_name
		// test_desc
		// gend_id
		// eval_from
		// eval_to
		// eval_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// test_num
		$this->test_num->ViewValue = $this->test_num->CurrentValue;
		$this->test_num->ViewCustomAttributes = "";

		// test_iname
		$this->test_iname->ViewValue = $this->test_iname->CurrentValue;
		$this->test_iname->ViewCustomAttributes = "";

		// lang_id
		if (strval($this->lang_id->CurrentValue) <> "") {
			$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `lang_id`, `lang_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
		$sWhereWrk = "";
		$this->lang_id->LookupFilters = array();
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

		// test_price
		$this->test_price->ViewValue = $this->test_price->CurrentValue;
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

		// test_name
		$this->test_name->ViewValue = $this->test_name->CurrentValue;
		$this->test_name->ViewCustomAttributes = "";

		// test_desc
		$this->test_desc->ViewValue = $this->test_desc->CurrentValue;
		$this->test_desc->ViewCustomAttributes = "";

		// gend_id
		if (strval($this->gend_id->CurrentValue) <> "") {
			$sFilterWrk = "`gend_id`" . ew_SearchString("=", $this->gend_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `gend_id`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_gender`";
		$sWhereWrk = "";
		$this->gend_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// eval_from
		$this->eval_from->ViewValue = $this->eval_from->CurrentValue;
		$this->eval_from->ViewCustomAttributes = "";

		// eval_to
		$this->eval_to->ViewValue = $this->eval_to->CurrentValue;
		$this->eval_to->ViewCustomAttributes = "";

		// eval_text
		$this->eval_text->ViewValue = $this->eval_text->CurrentValue;
		$this->eval_text->ViewCustomAttributes = "";

			// test_num
			$this->test_num->LinkCustomAttributes = "";
			$this->test_num->HrefValue = "";
			$this->test_num->TooltipValue = "";

			// test_iname
			$this->test_iname->LinkCustomAttributes = "";
			$this->test_iname->HrefValue = "";
			$this->test_iname->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

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
				$this->test_image->LinkAttrs["data-rel"] = "app_vtest_evaluate_x" . $this->RowCnt . "_test_image";
				ew_AppendClass($this->test_image->LinkAttrs["class"], "ewLightbox");
			}

			// test_name
			$this->test_name->LinkCustomAttributes = "";
			$this->test_name->HrefValue = "";
			$this->test_name->TooltipValue = "";

			// test_desc
			$this->test_desc->LinkCustomAttributes = "";
			$this->test_desc->HrefValue = "";
			$this->test_desc->TooltipValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";
			$this->gend_id->TooltipValue = "";

			// eval_from
			$this->eval_from->LinkCustomAttributes = "";
			$this->eval_from->HrefValue = "";
			$this->eval_from->TooltipValue = "";

			// eval_to
			$this->eval_to->LinkCustomAttributes = "";
			$this->eval_to->HrefValue = "";
			$this->eval_to->TooltipValue = "";

			// eval_text
			$this->eval_text->LinkCustomAttributes = "";
			$this->eval_text->HrefValue = "";
			$this->eval_text->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = FALSE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_app_vtest_evaluate\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_app_vtest_evaluate',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fapp_vtest_evaluatelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->ListRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		$Doc->Export();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_vtest_evaluate_list)) $app_vtest_evaluate_list = new capp_vtest_evaluate_list();

// Page init
$app_vtest_evaluate_list->Page_Init();

// Page main
$app_vtest_evaluate_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_vtest_evaluate_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($app_vtest_evaluate->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fapp_vtest_evaluatelist = new ew_Form("fapp_vtest_evaluatelist", "list");
fapp_vtest_evaluatelist.FormKeyCountName = '<?php echo $app_vtest_evaluate_list->FormKeyCountName ?>';

// Form_CustomValidate event
fapp_vtest_evaluatelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_vtest_evaluatelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_vtest_evaluatelist.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_vtest_evaluatelist.Lists["x_lang_id"].Data = "<?php echo $app_vtest_evaluate_list->lang_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_vtest_evaluatelist.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_vtest_evaluatelist.Lists["x_status_id"].Data = "<?php echo $app_vtest_evaluate_list->status_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_vtest_evaluatelist.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_vtest_evaluatelist.Lists["x_gend_id"].Data = "<?php echo $app_vtest_evaluate_list->gend_id->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fapp_vtest_evaluatelistsrch = new ew_Form("fapp_vtest_evaluatelistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($app_vtest_evaluate->Export == "") { ?>
<div class="ewToolbar">
<?php if ($app_vtest_evaluate_list->TotalRecs > 0 && $app_vtest_evaluate_list->ExportOptions->Visible()) { ?>
<?php $app_vtest_evaluate_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($app_vtest_evaluate_list->SearchOptions->Visible()) { ?>
<?php $app_vtest_evaluate_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($app_vtest_evaluate_list->FilterOptions->Visible()) { ?>
<?php $app_vtest_evaluate_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $app_vtest_evaluate_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_vtest_evaluate_list->TotalRecs <= 0)
			$app_vtest_evaluate_list->TotalRecs = $app_vtest_evaluate->ListRecordCount();
	} else {
		if (!$app_vtest_evaluate_list->Recordset && ($app_vtest_evaluate_list->Recordset = $app_vtest_evaluate_list->LoadRecordset()))
			$app_vtest_evaluate_list->TotalRecs = $app_vtest_evaluate_list->Recordset->RecordCount();
	}
	$app_vtest_evaluate_list->StartRec = 1;
	if ($app_vtest_evaluate_list->DisplayRecs <= 0 || ($app_vtest_evaluate->Export <> "" && $app_vtest_evaluate->ExportAll)) // Display all records
		$app_vtest_evaluate_list->DisplayRecs = $app_vtest_evaluate_list->TotalRecs;
	if (!($app_vtest_evaluate->Export <> "" && $app_vtest_evaluate->ExportAll))
		$app_vtest_evaluate_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$app_vtest_evaluate_list->Recordset = $app_vtest_evaluate_list->LoadRecordset($app_vtest_evaluate_list->StartRec-1, $app_vtest_evaluate_list->DisplayRecs);

	// Set no record found message
	if ($app_vtest_evaluate->CurrentAction == "" && $app_vtest_evaluate_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_vtest_evaluate_list->setWarningMessage(ew_DeniedMsg());
		if ($app_vtest_evaluate_list->SearchWhere == "0=101")
			$app_vtest_evaluate_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_vtest_evaluate_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$app_vtest_evaluate_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($app_vtest_evaluate->Export == "" && $app_vtest_evaluate->CurrentAction == "") { ?>
<form name="fapp_vtest_evaluatelistsrch" id="fapp_vtest_evaluatelistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($app_vtest_evaluate_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fapp_vtest_evaluatelistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="app_vtest_evaluate">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($app_vtest_evaluate_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($app_vtest_evaluate_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $app_vtest_evaluate_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($app_vtest_evaluate_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($app_vtest_evaluate_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($app_vtest_evaluate_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($app_vtest_evaluate_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $app_vtest_evaluate_list->ShowPageHeader(); ?>
<?php
$app_vtest_evaluate_list->ShowMessage();
?>
<?php if ($app_vtest_evaluate_list->TotalRecs > 0 || $app_vtest_evaluate->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_vtest_evaluate_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_vtest_evaluate">
<?php if ($app_vtest_evaluate->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($app_vtest_evaluate->CurrentAction <> "gridadd" && $app_vtest_evaluate->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_vtest_evaluate_list->Pager)) $app_vtest_evaluate_list->Pager = new cPrevNextPager($app_vtest_evaluate_list->StartRec, $app_vtest_evaluate_list->DisplayRecs, $app_vtest_evaluate_list->TotalRecs, $app_vtest_evaluate_list->AutoHidePager) ?>
<?php if ($app_vtest_evaluate_list->Pager->RecordCount > 0 && $app_vtest_evaluate_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_vtest_evaluate_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_vtest_evaluate_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_vtest_evaluate_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_vtest_evaluate_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_vtest_evaluate_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($app_vtest_evaluate_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_vtest_evaluate_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fapp_vtest_evaluatelist" id="fapp_vtest_evaluatelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_vtest_evaluate_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_vtest_evaluate_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_vtest_evaluate">
<div id="gmp_app_vtest_evaluate" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($app_vtest_evaluate_list->TotalRecs > 0 || $app_vtest_evaluate->CurrentAction == "gridedit") { ?>
<table id="tbl_app_vtest_evaluatelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_vtest_evaluate_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_vtest_evaluate_list->RenderListOptions();

// Render list options (header, left)
$app_vtest_evaluate_list->ListOptions->Render("header", "left");
?>
<?php if ($app_vtest_evaluate->test_num->Visible) { // test_num ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_num) == "") { ?>
		<th data-name="test_num" class="<?php echo $app_vtest_evaluate->test_num->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_test_num" class="app_vtest_evaluate_test_num"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_num->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_num" class="<?php echo $app_vtest_evaluate->test_num->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_num) ?>',1);"><div id="elh_app_vtest_evaluate_test_num" class="app_vtest_evaluate_test_num">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_num->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->test_num->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->test_num->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->test_iname->Visible) { // test_iname ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_iname) == "") { ?>
		<th data-name="test_iname" class="<?php echo $app_vtest_evaluate->test_iname->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_test_iname" class="app_vtest_evaluate_test_iname"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_iname->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_iname" class="<?php echo $app_vtest_evaluate->test_iname->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_iname) ?>',1);"><div id="elh_app_vtest_evaluate_test_iname" class="app_vtest_evaluate_test_iname">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_iname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->test_iname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->test_iname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->lang_id->Visible) { // lang_id ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_vtest_evaluate->lang_id->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_lang_id" class="app_vtest_evaluate_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_vtest_evaluate->lang_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->lang_id) ?>',1);"><div id="elh_app_vtest_evaluate_lang_id" class="app_vtest_evaluate_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->status_id->Visible) { // status_id ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $app_vtest_evaluate->status_id->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_status_id" class="app_vtest_evaluate_status_id"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $app_vtest_evaluate->status_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->status_id) ?>',1);"><div id="elh_app_vtest_evaluate_status_id" class="app_vtest_evaluate_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->test_price->Visible) { // test_price ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_price) == "") { ?>
		<th data-name="test_price" class="<?php echo $app_vtest_evaluate->test_price->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_test_price" class="app_vtest_evaluate_test_price"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_price" class="<?php echo $app_vtest_evaluate->test_price->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_price) ?>',1);"><div id="elh_app_vtest_evaluate_test_price" class="app_vtest_evaluate_test_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->test_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->test_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->test_image->Visible) { // test_image ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_image) == "") { ?>
		<th data-name="test_image" class="<?php echo $app_vtest_evaluate->test_image->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_test_image" class="app_vtest_evaluate_test_image"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_image->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_image" class="<?php echo $app_vtest_evaluate->test_image->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_image) ?>',1);"><div id="elh_app_vtest_evaluate_test_image" class="app_vtest_evaluate_test_image">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_image->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->test_image->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->test_image->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->test_name->Visible) { // test_name ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_name) == "") { ?>
		<th data-name="test_name" class="<?php echo $app_vtest_evaluate->test_name->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_test_name" class="app_vtest_evaluate_test_name"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_name" class="<?php echo $app_vtest_evaluate->test_name->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_name) ?>',1);"><div id="elh_app_vtest_evaluate_test_name" class="app_vtest_evaluate_test_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->test_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->test_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->test_desc->Visible) { // test_desc ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_desc) == "") { ?>
		<th data-name="test_desc" class="<?php echo $app_vtest_evaluate->test_desc->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_test_desc" class="app_vtest_evaluate_test_desc"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_desc->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_desc" class="<?php echo $app_vtest_evaluate->test_desc->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->test_desc) ?>',1);"><div id="elh_app_vtest_evaluate_test_desc" class="app_vtest_evaluate_test_desc">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->test_desc->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->test_desc->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->test_desc->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->gend_id->Visible) { // gend_id ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->gend_id) == "") { ?>
		<th data-name="gend_id" class="<?php echo $app_vtest_evaluate->gend_id->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_gend_id" class="app_vtest_evaluate_gend_id"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->gend_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gend_id" class="<?php echo $app_vtest_evaluate->gend_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->gend_id) ?>',1);"><div id="elh_app_vtest_evaluate_gend_id" class="app_vtest_evaluate_gend_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->gend_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->gend_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->gend_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->eval_from->Visible) { // eval_from ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->eval_from) == "") { ?>
		<th data-name="eval_from" class="<?php echo $app_vtest_evaluate->eval_from->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_eval_from" class="app_vtest_evaluate_eval_from"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->eval_from->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_from" class="<?php echo $app_vtest_evaluate->eval_from->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->eval_from) ?>',1);"><div id="elh_app_vtest_evaluate_eval_from" class="app_vtest_evaluate_eval_from">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->eval_from->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->eval_from->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->eval_from->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->eval_to->Visible) { // eval_to ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->eval_to) == "") { ?>
		<th data-name="eval_to" class="<?php echo $app_vtest_evaluate->eval_to->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_eval_to" class="app_vtest_evaluate_eval_to"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->eval_to->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_to" class="<?php echo $app_vtest_evaluate->eval_to->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->eval_to) ?>',1);"><div id="elh_app_vtest_evaluate_eval_to" class="app_vtest_evaluate_eval_to">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->eval_to->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->eval_to->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->eval_to->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_vtest_evaluate->eval_text->Visible) { // eval_text ?>
	<?php if ($app_vtest_evaluate->SortUrl($app_vtest_evaluate->eval_text) == "") { ?>
		<th data-name="eval_text" class="<?php echo $app_vtest_evaluate->eval_text->HeaderCellClass() ?>"><div id="elh_app_vtest_evaluate_eval_text" class="app_vtest_evaluate_eval_text"><div class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->eval_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_text" class="<?php echo $app_vtest_evaluate->eval_text->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_vtest_evaluate->SortUrl($app_vtest_evaluate->eval_text) ?>',1);"><div id="elh_app_vtest_evaluate_eval_text" class="app_vtest_evaluate_eval_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_vtest_evaluate->eval_text->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($app_vtest_evaluate->eval_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_vtest_evaluate->eval_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_vtest_evaluate_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($app_vtest_evaluate->ExportAll && $app_vtest_evaluate->Export <> "") {
	$app_vtest_evaluate_list->StopRec = $app_vtest_evaluate_list->TotalRecs;
} else {

	// Set the last record to display
	if ($app_vtest_evaluate_list->TotalRecs > $app_vtest_evaluate_list->StartRec + $app_vtest_evaluate_list->DisplayRecs - 1)
		$app_vtest_evaluate_list->StopRec = $app_vtest_evaluate_list->StartRec + $app_vtest_evaluate_list->DisplayRecs - 1;
	else
		$app_vtest_evaluate_list->StopRec = $app_vtest_evaluate_list->TotalRecs;
}
$app_vtest_evaluate_list->RecCnt = $app_vtest_evaluate_list->StartRec - 1;
if ($app_vtest_evaluate_list->Recordset && !$app_vtest_evaluate_list->Recordset->EOF) {
	$app_vtest_evaluate_list->Recordset->MoveFirst();
	$bSelectLimit = $app_vtest_evaluate_list->UseSelectLimit;
	if (!$bSelectLimit && $app_vtest_evaluate_list->StartRec > 1)
		$app_vtest_evaluate_list->Recordset->Move($app_vtest_evaluate_list->StartRec - 1);
} elseif (!$app_vtest_evaluate->AllowAddDeleteRow && $app_vtest_evaluate_list->StopRec == 0) {
	$app_vtest_evaluate_list->StopRec = $app_vtest_evaluate->GridAddRowCount;
}

// Initialize aggregate
$app_vtest_evaluate->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_vtest_evaluate->ResetAttrs();
$app_vtest_evaluate_list->RenderRow();
while ($app_vtest_evaluate_list->RecCnt < $app_vtest_evaluate_list->StopRec) {
	$app_vtest_evaluate_list->RecCnt++;
	if (intval($app_vtest_evaluate_list->RecCnt) >= intval($app_vtest_evaluate_list->StartRec)) {
		$app_vtest_evaluate_list->RowCnt++;

		// Set up key count
		$app_vtest_evaluate_list->KeyCount = $app_vtest_evaluate_list->RowIndex;

		// Init row class and style
		$app_vtest_evaluate->ResetAttrs();
		$app_vtest_evaluate->CssClass = "";
		if ($app_vtest_evaluate->CurrentAction == "gridadd") {
		} else {
			$app_vtest_evaluate_list->LoadRowValues($app_vtest_evaluate_list->Recordset); // Load row values
		}
		$app_vtest_evaluate->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$app_vtest_evaluate->RowAttrs = array_merge($app_vtest_evaluate->RowAttrs, array('data-rowindex'=>$app_vtest_evaluate_list->RowCnt, 'id'=>'r' . $app_vtest_evaluate_list->RowCnt . '_app_vtest_evaluate', 'data-rowtype'=>$app_vtest_evaluate->RowType));

		// Render row
		$app_vtest_evaluate_list->RenderRow();

		// Render list options
		$app_vtest_evaluate_list->RenderListOptions();
?>
	<tr<?php echo $app_vtest_evaluate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_vtest_evaluate_list->ListOptions->Render("body", "left", $app_vtest_evaluate_list->RowCnt);
?>
	<?php if ($app_vtest_evaluate->test_num->Visible) { // test_num ?>
		<td data-name="test_num"<?php echo $app_vtest_evaluate->test_num->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_test_num" class="app_vtest_evaluate_test_num">
<span<?php echo $app_vtest_evaluate->test_num->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->test_num->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->test_iname->Visible) { // test_iname ?>
		<td data-name="test_iname"<?php echo $app_vtest_evaluate->test_iname->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_test_iname" class="app_vtest_evaluate_test_iname">
<span<?php echo $app_vtest_evaluate->test_iname->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->test_iname->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_vtest_evaluate->lang_id->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_lang_id" class="app_vtest_evaluate_lang_id">
<span<?php echo $app_vtest_evaluate->lang_id->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->lang_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $app_vtest_evaluate->status_id->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_status_id" class="app_vtest_evaluate_status_id">
<span<?php echo $app_vtest_evaluate->status_id->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->status_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->test_price->Visible) { // test_price ?>
		<td data-name="test_price"<?php echo $app_vtest_evaluate->test_price->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_test_price" class="app_vtest_evaluate_test_price">
<span<?php echo $app_vtest_evaluate->test_price->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->test_price->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->test_image->Visible) { // test_image ?>
		<td data-name="test_image"<?php echo $app_vtest_evaluate->test_image->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_test_image" class="app_vtest_evaluate_test_image">
<span>
<?php echo ew_GetFileViewTag($app_vtest_evaluate->test_image, $app_vtest_evaluate->test_image->ListViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->test_name->Visible) { // test_name ?>
		<td data-name="test_name"<?php echo $app_vtest_evaluate->test_name->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_test_name" class="app_vtest_evaluate_test_name">
<span<?php echo $app_vtest_evaluate->test_name->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->test_name->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->test_desc->Visible) { // test_desc ?>
		<td data-name="test_desc"<?php echo $app_vtest_evaluate->test_desc->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_test_desc" class="app_vtest_evaluate_test_desc">
<span<?php echo $app_vtest_evaluate->test_desc->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->test_desc->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id"<?php echo $app_vtest_evaluate->gend_id->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_gend_id" class="app_vtest_evaluate_gend_id">
<span<?php echo $app_vtest_evaluate->gend_id->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->gend_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->eval_from->Visible) { // eval_from ?>
		<td data-name="eval_from"<?php echo $app_vtest_evaluate->eval_from->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_eval_from" class="app_vtest_evaluate_eval_from">
<span<?php echo $app_vtest_evaluate->eval_from->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->eval_from->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->eval_to->Visible) { // eval_to ?>
		<td data-name="eval_to"<?php echo $app_vtest_evaluate->eval_to->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_eval_to" class="app_vtest_evaluate_eval_to">
<span<?php echo $app_vtest_evaluate->eval_to->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->eval_to->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_vtest_evaluate->eval_text->Visible) { // eval_text ?>
		<td data-name="eval_text"<?php echo $app_vtest_evaluate->eval_text->CellAttributes() ?>>
<span id="el<?php echo $app_vtest_evaluate_list->RowCnt ?>_app_vtest_evaluate_eval_text" class="app_vtest_evaluate_eval_text">
<span<?php echo $app_vtest_evaluate->eval_text->ViewAttributes() ?>>
<?php echo $app_vtest_evaluate->eval_text->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_vtest_evaluate_list->ListOptions->Render("body", "right", $app_vtest_evaluate_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($app_vtest_evaluate->CurrentAction <> "gridadd")
		$app_vtest_evaluate_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($app_vtest_evaluate->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($app_vtest_evaluate_list->Recordset)
	$app_vtest_evaluate_list->Recordset->Close();
?>
<?php if ($app_vtest_evaluate->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($app_vtest_evaluate->CurrentAction <> "gridadd" && $app_vtest_evaluate->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_vtest_evaluate_list->Pager)) $app_vtest_evaluate_list->Pager = new cPrevNextPager($app_vtest_evaluate_list->StartRec, $app_vtest_evaluate_list->DisplayRecs, $app_vtest_evaluate_list->TotalRecs, $app_vtest_evaluate_list->AutoHidePager) ?>
<?php if ($app_vtest_evaluate_list->Pager->RecordCount > 0 && $app_vtest_evaluate_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_vtest_evaluate_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_vtest_evaluate_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_vtest_evaluate_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_vtest_evaluate_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_vtest_evaluate_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_vtest_evaluate_list->PageUrl() ?>start=<?php echo $app_vtest_evaluate_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($app_vtest_evaluate_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_vtest_evaluate_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_vtest_evaluate_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($app_vtest_evaluate_list->TotalRecs == 0 && $app_vtest_evaluate->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_vtest_evaluate_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_vtest_evaluate->Export == "") { ?>
<script type="text/javascript">
fapp_vtest_evaluatelistsrch.FilterList = <?php echo $app_vtest_evaluate_list->GetFilterList() ?>;
fapp_vtest_evaluatelistsrch.Init();
fapp_vtest_evaluatelist.Init();
</script>
<?php } ?>
<?php
$app_vtest_evaluate_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($app_vtest_evaluate->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$app_vtest_evaluate_list->Page_Terminate();
?>
