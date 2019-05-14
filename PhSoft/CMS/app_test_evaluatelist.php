<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_test_evaluateinfo.php" ?>
<?php include_once "app_testinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_test_evaluate_list = NULL; // Initialize page object first

class capp_test_evaluate_list extends capp_test_evaluate {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_test_evaluate';

	// Page object name
	var $PageObjName = 'app_test_evaluate_list';

	// Grid form hidden field names
	var $FormName = 'fapp_test_evaluatelist';
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

		// Table object (app_test_evaluate)
		if (!isset($GLOBALS["app_test_evaluate"]) || get_class($GLOBALS["app_test_evaluate"]) == "capp_test_evaluate") {
			$GLOBALS["app_test_evaluate"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_test_evaluate"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "app_test_evaluateadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "app_test_evaluatedelete.php";
		$this->MultiUpdateUrl = "app_test_evaluateupdate.php";

		// Table object (app_test)
		if (!isset($GLOBALS['app_test'])) $GLOBALS['app_test'] = new capp_test();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_test_evaluate', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fapp_test_evaluatelistsrch";

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
		// Create form object

		$objForm = new cFormObj();

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
		$this->test_id->SetVisibility();
		$this->lang_id->SetVisibility();
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

		// Set up master detail parameters
		$this->SetupMasterParms();

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
		global $EW_EXPORT, $app_test_evaluate;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_test_evaluate);
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

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($this->CurrentAction == "add" || $this->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($this->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$bGridUpdate = $this->GridUpdate();
						} else {
							$bGridUpdate = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridUpdate) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($this->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($this->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$bGridInsert = $this->GridInsert();
						} else {
							$bGridInsert = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridInsert) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
				}
			}

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

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

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
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

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
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

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "app_test") {
			global $app_test;
			$rsmaster = $app_test->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("app_testlist.php"); // Return to master page
			} else {
				$app_test->LoadListRowValues($rsmaster);
				$app_test->RowType = EW_ROWTYPE_MASTER; // Master row
				$app_test->RenderListRow();
				$rsmaster->Close();
			}
		}

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

	// Exit inline mode
	function ClearInlineMode() {
		$this->setKey("eval_id", ""); // Clear inline edit key
		$this->eval_from->FormValue = ""; // Clear form value
		$this->eval_to->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (isset($_GET["eval_id"])) {
			$this->eval_id->setQueryStringValue($_GET["eval_id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("eval_id", $this->eval_id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("eval_id")) <> strval($this->eval_id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		if ($this->CurrentAction == "copy") {
			if (@$_GET["eval_id"] <> "") {
				$this->eval_id->setQueryStringValue($_GET["eval_id"]);
				$this->setKey("eval_id", $this->eval_id->CurrentValue); // Set up key
			} else {
				$this->setKey("eval_id", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError;
		$this->LoadOldRecord(); // Load old record
		$objForm->Index = 0;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
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
		if (count($arrKeyFlds) >= 1) {
			$this->eval_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->eval_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->eval_id->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_test_id") && $objForm->HasValue("o_test_id") && $this->test_id->CurrentValue <> $this->test_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_lang_id") && $objForm->HasValue("o_lang_id") && $this->lang_id->CurrentValue <> $this->lang_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_gend_id") && $objForm->HasValue("o_gend_id") && $this->gend_id->CurrentValue <> $this->gend_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_eval_from") && $objForm->HasValue("o_eval_from") && $this->eval_from->CurrentValue <> $this->eval_from->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_eval_to") && $objForm->HasValue("o_eval_to") && $this->eval_to->CurrentValue <> $this->eval_to->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_eval_text") && $objForm->HasValue("o_eval_text") && $this->eval_text->CurrentValue <> $this->eval_text->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->test_id->AdvancedSearch->ToJson(), ","); // Field test_id
		$sFilterList = ew_Concat($sFilterList, $this->lang_id->AdvancedSearch->ToJson(), ","); // Field lang_id
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fapp_test_evaluatelistsrch", $filters);

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

		// Field test_id
		$this->test_id->AdvancedSearch->SearchValue = @$filter["x_test_id"];
		$this->test_id->AdvancedSearch->SearchOperator = @$filter["z_test_id"];
		$this->test_id->AdvancedSearch->SearchCondition = @$filter["v_test_id"];
		$this->test_id->AdvancedSearch->SearchValue2 = @$filter["y_test_id"];
		$this->test_id->AdvancedSearch->SearchOperator2 = @$filter["w_test_id"];
		$this->test_id->AdvancedSearch->Save();

		// Field lang_id
		$this->lang_id->AdvancedSearch->SearchValue = @$filter["x_lang_id"];
		$this->lang_id->AdvancedSearch->SearchOperator = @$filter["z_lang_id"];
		$this->lang_id->AdvancedSearch->SearchCondition = @$filter["v_lang_id"];
		$this->lang_id->AdvancedSearch->SearchValue2 = @$filter["y_lang_id"];
		$this->lang_id->AdvancedSearch->SearchOperator2 = @$filter["w_lang_id"];
		$this->lang_id->AdvancedSearch->Save();

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

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->test_id, $Default, FALSE); // test_id
		$this->BuildSearchSql($sWhere, $this->lang_id, $Default, FALSE); // lang_id
		$this->BuildSearchSql($sWhere, $this->gend_id, $Default, FALSE); // gend_id
		$this->BuildSearchSql($sWhere, $this->eval_from, $Default, FALSE); // eval_from
		$this->BuildSearchSql($sWhere, $this->eval_to, $Default, FALSE); // eval_to
		$this->BuildSearchSql($sWhere, $this->eval_text, $Default, FALSE); // eval_text

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->test_id->AdvancedSearch->Save(); // test_id
			$this->lang_id->AdvancedSearch->Save(); // lang_id
			$this->gend_id->AdvancedSearch->Save(); // gend_id
			$this->eval_from->AdvancedSearch->Save(); // eval_from
			$this->eval_to->AdvancedSearch->Save(); // eval_to
			$this->eval_text->AdvancedSearch->Save(); // eval_text
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = $Fld->FldParm();
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
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
		if ($this->test_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->lang_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->gend_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->eval_from->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->eval_to->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->eval_text->AdvancedSearch->IssetSession())
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

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->test_id->AdvancedSearch->UnsetSession();
		$this->lang_id->AdvancedSearch->UnsetSession();
		$this->gend_id->AdvancedSearch->UnsetSession();
		$this->eval_from->AdvancedSearch->UnsetSession();
		$this->eval_to->AdvancedSearch->UnsetSession();
		$this->eval_text->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->test_id->AdvancedSearch->Load();
		$this->lang_id->AdvancedSearch->Load();
		$this->gend_id->AdvancedSearch->Load();
		$this->eval_from->AdvancedSearch->Load();
		$this->eval_to->AdvancedSearch->Load();
		$this->eval_text->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->test_id); // test_id
			$this->UpdateSort($this->lang_id); // lang_id
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
				$this->test_id->setSort("ASC");
				$this->lang_id->setSort("ASC");
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->test_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->test_id->setSort("");
				$this->lang_id->setSort("");
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

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = ($Security->CanDelete() || $Security->CanEdit());
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

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if (($this->CurrentAction == "add" || $this->CurrentAction == "copy") && $this->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink ewInlineInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_UrlAddHash($this->PageName(), "r" . $this->RowCnt . "_" . $this->TableVar) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->eval_id->CurrentValue) . "\">";
			return;
		}

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->CanAdd()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineCopy\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->Phrase("InlineCopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->eval_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->eval_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Inline Add
		$item = &$option->Add("inlineadd");
		$item->Body = "<a class=\"ewAddEdit ewInlineAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->CanAdd());
		$item = &$option->Add("gridadd");
		$item->Body = "<a class=\"ewAddEdit ewGridAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" href=\"" . ew_HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->CanAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Add multi delete
		$item = &$option->Add("multidelete");
		$item->Body = "<a class=\"ewAction ewMultiDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.fapp_test_evaluatelist,url:'" . $this->MultiDeleteUrl . "'});return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = ($Security->CanDelete());

		// Add multi update
		$item = &$option->Add("multiupdate");
		$item->Body = "<a class=\"ewAction ewMultiUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" data-table=\"app_test_evaluate\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.fapp_test_evaluatelist,url:'" . $this->MultiUpdateUrl . "'});return false;\">" . $Language->Phrase("UpdateSelectedLink") . "</a>";
		$item->Visible = ($Security->CanEdit());

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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fapp_test_evaluatelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fapp_test_evaluatelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fapp_test_evaluatelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridadd") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;

				// Add grid insert
				$item = &$option->Add("gridinsert");
				$item->Body = "<a class=\"ewAction ewGridInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->Add("gridcancel");
				$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" title=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fapp_test_evaluatelistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->Add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"app_test_evaluatesrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->Add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewHighlight active\" title=\"" . $Language->Phrase("Highlight") . "\" data-caption=\"" . $Language->Phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fapp_test_evaluatelistsrch\" data-name=\"" . $this->HighlightName() . "\">" . $Language->Phrase("HighlightBtn") . "</button>";
		$item->Visible = ($this->SearchWhere <> "" && $this->TotalRecs > 0);

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

	// Load default values
	function LoadDefaultValues() {
		$this->eval_id->CurrentValue = NULL;
		$this->eval_id->OldValue = $this->eval_id->CurrentValue;
		$this->test_id->CurrentValue = NULL;
		$this->test_id->OldValue = $this->test_id->CurrentValue;
		$this->lang_id->CurrentValue = NULL;
		$this->lang_id->OldValue = $this->lang_id->CurrentValue;
		$this->gend_id->CurrentValue = NULL;
		$this->gend_id->OldValue = $this->gend_id->CurrentValue;
		$this->eval_from->CurrentValue = 0;
		$this->eval_from->OldValue = $this->eval_from->CurrentValue;
		$this->eval_to->CurrentValue = 99999;
		$this->eval_to->OldValue = $this->eval_to->CurrentValue;
		$this->eval_text->CurrentValue = NULL;
		$this->eval_text->OldValue = $this->eval_text->CurrentValue;
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// test_id

		$this->test_id->AdvancedSearch->SearchValue = @$_GET["x_test_id"];
		if ($this->test_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->test_id->AdvancedSearch->SearchOperator = @$_GET["z_test_id"];

		// lang_id
		$this->lang_id->AdvancedSearch->SearchValue = @$_GET["x_lang_id"];
		if ($this->lang_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->lang_id->AdvancedSearch->SearchOperator = @$_GET["z_lang_id"];

		// gend_id
		$this->gend_id->AdvancedSearch->SearchValue = @$_GET["x_gend_id"];
		if ($this->gend_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->gend_id->AdvancedSearch->SearchOperator = @$_GET["z_gend_id"];

		// eval_from
		$this->eval_from->AdvancedSearch->SearchValue = @$_GET["x_eval_from"];
		if ($this->eval_from->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->eval_from->AdvancedSearch->SearchOperator = @$_GET["z_eval_from"];

		// eval_to
		$this->eval_to->AdvancedSearch->SearchValue = @$_GET["x_eval_to"];
		if ($this->eval_to->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->eval_to->AdvancedSearch->SearchOperator = @$_GET["z_eval_to"];

		// eval_text
		$this->eval_text->AdvancedSearch->SearchValue = @$_GET["x_eval_text"];
		if ($this->eval_text->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->eval_text->AdvancedSearch->SearchOperator = @$_GET["z_eval_text"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->test_id->FldIsDetailKey) {
			$this->test_id->setFormValue($objForm->GetValue("x_test_id"));
		}
		$this->test_id->setOldValue($objForm->GetValue("o_test_id"));
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->setOldValue($objForm->GetValue("o_lang_id"));
		if (!$this->gend_id->FldIsDetailKey) {
			$this->gend_id->setFormValue($objForm->GetValue("x_gend_id"));
		}
		$this->gend_id->setOldValue($objForm->GetValue("o_gend_id"));
		if (!$this->eval_from->FldIsDetailKey) {
			$this->eval_from->setFormValue($objForm->GetValue("x_eval_from"));
		}
		$this->eval_from->setOldValue($objForm->GetValue("o_eval_from"));
		if (!$this->eval_to->FldIsDetailKey) {
			$this->eval_to->setFormValue($objForm->GetValue("x_eval_to"));
		}
		$this->eval_to->setOldValue($objForm->GetValue("o_eval_to"));
		if (!$this->eval_text->FldIsDetailKey) {
			$this->eval_text->setFormValue($objForm->GetValue("x_eval_text"));
		}
		$this->eval_text->setOldValue($objForm->GetValue("o_eval_text"));
		if (!$this->eval_id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->eval_id->setFormValue($objForm->GetValue("x_eval_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->eval_id->CurrentValue = $this->eval_id->FormValue;
		$this->test_id->CurrentValue = $this->test_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->gend_id->CurrentValue = $this->gend_id->FormValue;
		$this->eval_from->CurrentValue = $this->eval_from->FormValue;
		$this->eval_to->CurrentValue = $this->eval_to->FormValue;
		$this->eval_text->CurrentValue = $this->eval_text->FormValue;
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
		$this->eval_id->setDbValue($row['eval_id']);
		$this->test_id->setDbValue($row['test_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->gend_id->setDbValue($row['gend_id']);
		$this->eval_from->setDbValue($row['eval_from']);
		$this->eval_to->setDbValue($row['eval_to']);
		$this->eval_text->setDbValue($row['eval_text']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['eval_id'] = $this->eval_id->CurrentValue;
		$row['test_id'] = $this->test_id->CurrentValue;
		$row['lang_id'] = $this->lang_id->CurrentValue;
		$row['gend_id'] = $this->gend_id->CurrentValue;
		$row['eval_from'] = $this->eval_from->CurrentValue;
		$row['eval_to'] = $this->eval_to->CurrentValue;
		$row['eval_text'] = $this->eval_text->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->eval_id->DbValue = $row['eval_id'];
		$this->test_id->DbValue = $row['test_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->gend_id->DbValue = $row['gend_id'];
		$this->eval_from->DbValue = $row['eval_from'];
		$this->eval_to->DbValue = $row['eval_to'];
		$this->eval_text->DbValue = $row['eval_text'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
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
		if ($this->eval_from->FormValue == $this->eval_from->CurrentValue && is_numeric(ew_StrToFloat($this->eval_from->CurrentValue)))
			$this->eval_from->CurrentValue = ew_StrToFloat($this->eval_from->CurrentValue);

		// Convert decimal values if posted back
		if ($this->eval_to->FormValue == $this->eval_to->CurrentValue && is_numeric(ew_StrToFloat($this->eval_to->CurrentValue)))
			$this->eval_to->CurrentValue = ew_StrToFloat($this->eval_to->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// eval_id

		$this->eval_id->CellCssStyle = "white-space: nowrap;";

		// test_id
		// lang_id
		// gend_id
		// eval_from
		// eval_to
		// eval_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// test_id
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `test_num`";
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

		// eval_from
		$this->eval_from->ViewValue = $this->eval_from->CurrentValue;
		$this->eval_from->ViewCustomAttributes = "";

		// eval_to
		$this->eval_to->ViewValue = $this->eval_to->CurrentValue;
		$this->eval_to->ViewCustomAttributes = "";

		// eval_text
		$this->eval_text->ViewValue = $this->eval_text->CurrentValue;
		$this->eval_text->ViewCustomAttributes = "";

			// test_id
			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";
			$this->test_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";
			$this->gend_id->TooltipValue = "";

			// eval_from
			$this->eval_from->LinkCustomAttributes = "";
			$this->eval_from->HrefValue = "";
			$this->eval_from->TooltipValue = "";
			if ($this->Export == "")
				$this->eval_from->ViewValue = $this->HighlightValue($this->eval_from);

			// eval_to
			$this->eval_to->LinkCustomAttributes = "";
			$this->eval_to->HrefValue = "";
			$this->eval_to->TooltipValue = "";
			if ($this->Export == "")
				$this->eval_to->ViewValue = $this->HighlightValue($this->eval_to);

			// eval_text
			$this->eval_text->LinkCustomAttributes = "";
			$this->eval_text->HrefValue = "";
			$this->eval_text->TooltipValue = "";
			if ($this->Export == "")
				$this->eval_text->ViewValue = $this->HighlightValue($this->eval_text);
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// test_id
			$this->test_id->EditAttrs["class"] = "form-control";
			$this->test_id->EditCustomAttributes = "";
			if ($this->test_id->getSessionValue() <> "") {
				$this->test_id->CurrentValue = $this->test_id->getSessionValue();
				$this->test_id->OldValue = $this->test_id->CurrentValue;
			if (strval($this->test_id->CurrentValue) <> "") {
				$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
			$sWhereWrk = "";
			$this->test_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `test_num`";
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
			} else {
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
			$sSqlWrk .= " ORDER BY `test_num`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->test_id->EditValue = $arwrk;
			}

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

			// eval_from
			$this->eval_from->EditAttrs["class"] = "form-control";
			$this->eval_from->EditCustomAttributes = "";
			$this->eval_from->EditValue = ew_HtmlEncode($this->eval_from->CurrentValue);
			$this->eval_from->PlaceHolder = ew_RemoveHtml($this->eval_from->FldCaption());
			if (strval($this->eval_from->EditValue) <> "" && is_numeric($this->eval_from->EditValue)) {
			$this->eval_from->EditValue = ew_FormatNumber($this->eval_from->EditValue, -2, -1, -2, 0);
			$this->eval_from->OldValue = $this->eval_from->EditValue;
			}

			// eval_to
			$this->eval_to->EditAttrs["class"] = "form-control";
			$this->eval_to->EditCustomAttributes = "";
			$this->eval_to->EditValue = ew_HtmlEncode($this->eval_to->CurrentValue);
			$this->eval_to->PlaceHolder = ew_RemoveHtml($this->eval_to->FldCaption());
			if (strval($this->eval_to->EditValue) <> "" && is_numeric($this->eval_to->EditValue)) {
			$this->eval_to->EditValue = ew_FormatNumber($this->eval_to->EditValue, -2, -1, -2, 0);
			$this->eval_to->OldValue = $this->eval_to->EditValue;
			}

			// eval_text
			$this->eval_text->EditAttrs["class"] = "form-control";
			$this->eval_text->EditCustomAttributes = "";
			$this->eval_text->EditValue = ew_HtmlEncode($this->eval_text->CurrentValue);
			$this->eval_text->PlaceHolder = ew_RemoveHtml($this->eval_text->FldCaption());

			// Add refer script
			// test_id

			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";

			// eval_from
			$this->eval_from->LinkCustomAttributes = "";
			$this->eval_from->HrefValue = "";

			// eval_to
			$this->eval_to->LinkCustomAttributes = "";
			$this->eval_to->HrefValue = "";

			// eval_text
			$this->eval_text->LinkCustomAttributes = "";
			$this->eval_text->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// test_id
			$this->test_id->EditAttrs["class"] = "form-control";
			$this->test_id->EditCustomAttributes = "";
			if ($this->test_id->getSessionValue() <> "") {
				$this->test_id->CurrentValue = $this->test_id->getSessionValue();
				$this->test_id->OldValue = $this->test_id->CurrentValue;
			if (strval($this->test_id->CurrentValue) <> "") {
				$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
			$sWhereWrk = "";
			$this->test_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `test_num`";
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
			} else {
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
			$sSqlWrk .= " ORDER BY `test_num`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->test_id->EditValue = $arwrk;
			}

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

			// eval_from
			$this->eval_from->EditAttrs["class"] = "form-control";
			$this->eval_from->EditCustomAttributes = "";
			$this->eval_from->EditValue = ew_HtmlEncode($this->eval_from->CurrentValue);
			$this->eval_from->PlaceHolder = ew_RemoveHtml($this->eval_from->FldCaption());
			if (strval($this->eval_from->EditValue) <> "" && is_numeric($this->eval_from->EditValue)) {
			$this->eval_from->EditValue = ew_FormatNumber($this->eval_from->EditValue, -2, -1, -2, 0);
			$this->eval_from->OldValue = $this->eval_from->EditValue;
			}

			// eval_to
			$this->eval_to->EditAttrs["class"] = "form-control";
			$this->eval_to->EditCustomAttributes = "";
			$this->eval_to->EditValue = ew_HtmlEncode($this->eval_to->CurrentValue);
			$this->eval_to->PlaceHolder = ew_RemoveHtml($this->eval_to->FldCaption());
			if (strval($this->eval_to->EditValue) <> "" && is_numeric($this->eval_to->EditValue)) {
			$this->eval_to->EditValue = ew_FormatNumber($this->eval_to->EditValue, -2, -1, -2, 0);
			$this->eval_to->OldValue = $this->eval_to->EditValue;
			}

			// eval_text
			$this->eval_text->EditAttrs["class"] = "form-control";
			$this->eval_text->EditCustomAttributes = "";
			$this->eval_text->EditValue = ew_HtmlEncode($this->eval_text->CurrentValue);
			$this->eval_text->PlaceHolder = ew_RemoveHtml($this->eval_text->FldCaption());

			// Edit refer script
			// test_id

			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";

			// eval_from
			$this->eval_from->LinkCustomAttributes = "";
			$this->eval_from->HrefValue = "";

			// eval_to
			$this->eval_to->LinkCustomAttributes = "";
			$this->eval_to->HrefValue = "";

			// eval_text
			$this->eval_text->LinkCustomAttributes = "";
			$this->eval_text->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->test_id->FldIsDetailKey && !is_null($this->test_id->FormValue) && $this->test_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->test_id->FldCaption(), $this->test_id->ReqErrMsg));
		}
		if (!$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if (!$this->gend_id->FldIsDetailKey && !is_null($this->gend_id->FormValue) && $this->gend_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->gend_id->FldCaption(), $this->gend_id->ReqErrMsg));
		}
		if (!$this->eval_from->FldIsDetailKey && !is_null($this->eval_from->FormValue) && $this->eval_from->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->eval_from->FldCaption(), $this->eval_from->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->eval_from->FormValue)) {
			ew_AddMessage($gsFormError, $this->eval_from->FldErrMsg());
		}
		if (!$this->eval_to->FldIsDetailKey && !is_null($this->eval_to->FormValue) && $this->eval_to->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->eval_to->FldCaption(), $this->eval_to->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->eval_to->FormValue)) {
			ew_AddMessage($gsFormError, $this->eval_to->FldErrMsg());
		}
		if (!$this->eval_text->FldIsDetailKey && !is_null($this->eval_text->FormValue) && $this->eval_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->eval_text->FldCaption(), $this->eval_text->ReqErrMsg));
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['eval_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

			// test_id
			$this->test_id->SetDbValueDef($rsnew, $this->test_id->CurrentValue, 0, $this->test_id->ReadOnly);

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly);

			// gend_id
			$this->gend_id->SetDbValueDef($rsnew, $this->gend_id->CurrentValue, 0, $this->gend_id->ReadOnly);

			// eval_from
			$this->eval_from->SetDbValueDef($rsnew, $this->eval_from->CurrentValue, 0, $this->eval_from->ReadOnly);

			// eval_to
			$this->eval_to->SetDbValueDef($rsnew, $this->eval_to->CurrentValue, 0, $this->eval_to->ReadOnly);

			// eval_text
			$this->eval_text->SetDbValueDef($rsnew, $this->eval_text->CurrentValue, "", $this->eval_text->ReadOnly);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// test_id
		$this->test_id->SetDbValueDef($rsnew, $this->test_id->CurrentValue, 0, FALSE);

		// lang_id
		$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, FALSE);

		// gend_id
		$this->gend_id->SetDbValueDef($rsnew, $this->gend_id->CurrentValue, 0, FALSE);

		// eval_from
		$this->eval_from->SetDbValueDef($rsnew, $this->eval_from->CurrentValue, 0, strval($this->eval_from->CurrentValue) == "");

		// eval_to
		$this->eval_to->SetDbValueDef($rsnew, $this->eval_to->CurrentValue, 0, strval($this->eval_to->CurrentValue) == "");

		// eval_text
		$this->eval_text->SetDbValueDef($rsnew, $this->eval_text->CurrentValue, "", FALSE);

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
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->test_id->AdvancedSearch->Load();
		$this->lang_id->AdvancedSearch->Load();
		$this->gend_id->AdvancedSearch->Load();
		$this->eval_from->AdvancedSearch->Load();
		$this->eval_to->AdvancedSearch->Load();
		$this->eval_text->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_app_test_evaluate\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_app_test_evaluate',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fapp_test_evaluatelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "app_test") {
			global $app_test;
			if (!isset($app_test)) $app_test = new capp_test;
			$rsmaster = $app_test->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$app_test;
					$app_test->ExportDocument($Doc, $rsmaster, 1, 1);
					$Doc->ExportEmptyRow();
					$Doc->Table = &$this;
				}
				$Doc->SetStyle($ExportStyle); // Restore
				$rsmaster->Close();
			}
		}
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
			if ($sMasterTblVar == "app_test") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_test_id"] <> "") {
					$GLOBALS["app_test"]->test_id->setQueryStringValue($_GET["fk_test_id"]);
					$this->test_id->setQueryStringValue($GLOBALS["app_test"]->test_id->QueryStringValue);
					$this->test_id->setSessionValue($this->test_id->QueryStringValue);
					if (!is_numeric($GLOBALS["app_test"]->test_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "app_test") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_test_id"] <> "") {
					$GLOBALS["app_test"]->test_id->setFormValue($_POST["fk_test_id"]);
					$this->test_id->setFormValue($GLOBALS["app_test"]->test_id->FormValue);
					$this->test_id->setSessionValue($this->test_id->FormValue);
					if (!is_numeric($GLOBALS["app_test"]->test_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "app_test") {
				if ($this->test_id->CurrentValue == "") $this->test_id->setSessionValue("");
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_test_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `test_id` AS `LinkFld`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`test_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `test_num`";
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
if (!isset($app_test_evaluate_list)) $app_test_evaluate_list = new capp_test_evaluate_list();

// Page init
$app_test_evaluate_list->Page_Init();

// Page main
$app_test_evaluate_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_evaluate_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($app_test_evaluate->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fapp_test_evaluatelist = new ew_Form("fapp_test_evaluatelist", "list");
fapp_test_evaluatelist.FormKeyCountName = '<?php echo $app_test_evaluate_list->FormKeyCountName ?>';

// Validate form
fapp_test_evaluatelist.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_test_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->test_id->FldCaption(), $app_test_evaluate->test_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->lang_id->FldCaption(), $app_test_evaluate->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_gend_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->gend_id->FldCaption(), $app_test_evaluate->gend_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_eval_from");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->eval_from->FldCaption(), $app_test_evaluate->eval_from->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_eval_from");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_evaluate->eval_from->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_eval_to");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->eval_to->FldCaption(), $app_test_evaluate->eval_to->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_eval_to");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_evaluate->eval_to->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_eval_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_evaluate->eval_text->FldCaption(), $app_test_evaluate->eval_text->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew_Alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
fapp_test_evaluatelist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "test_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lang_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "gend_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "eval_from", false)) return false;
	if (ew_ValueChanged(fobj, infix, "eval_to", false)) return false;
	if (ew_ValueChanged(fobj, infix, "eval_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_test_evaluatelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_evaluatelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_evaluatelist.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_evaluatelist.Lists["x_test_id"].Data = "<?php echo $app_test_evaluate_list->test_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_test_evaluatelist.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_evaluatelist.Lists["x_lang_id"].Data = "<?php echo $app_test_evaluate_list->lang_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_test_evaluatelist.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_test_evaluatelist.Lists["x_gend_id"].Data = "<?php echo $app_test_evaluate_list->gend_id->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fapp_test_evaluatelistsrch = new ew_Form("fapp_test_evaluatelistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($app_test_evaluate->Export == "") { ?>
<div class="ewToolbar">
<?php if ($app_test_evaluate_list->TotalRecs > 0 && $app_test_evaluate_list->ExportOptions->Visible()) { ?>
<?php $app_test_evaluate_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($app_test_evaluate_list->SearchOptions->Visible()) { ?>
<?php $app_test_evaluate_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($app_test_evaluate_list->FilterOptions->Visible()) { ?>
<?php $app_test_evaluate_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($app_test_evaluate->Export == "") || (EW_EXPORT_MASTER_RECORD && $app_test_evaluate->Export == "print")) { ?>
<?php
if ($app_test_evaluate_list->DbMasterFilter <> "" && $app_test_evaluate->getCurrentMasterTable() == "app_test") {
	if ($app_test_evaluate_list->MasterRecordExists) {
?>
<?php include_once "app_testmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($app_test_evaluate->CurrentAction == "gridadd") {
	$app_test_evaluate->CurrentFilter = "0=1";
	$app_test_evaluate_list->StartRec = 1;
	$app_test_evaluate_list->DisplayRecs = $app_test_evaluate->GridAddRowCount;
	$app_test_evaluate_list->TotalRecs = $app_test_evaluate_list->DisplayRecs;
	$app_test_evaluate_list->StopRec = $app_test_evaluate_list->DisplayRecs;
} else {
	$bSelectLimit = $app_test_evaluate_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_test_evaluate_list->TotalRecs <= 0)
			$app_test_evaluate_list->TotalRecs = $app_test_evaluate->ListRecordCount();
	} else {
		if (!$app_test_evaluate_list->Recordset && ($app_test_evaluate_list->Recordset = $app_test_evaluate_list->LoadRecordset()))
			$app_test_evaluate_list->TotalRecs = $app_test_evaluate_list->Recordset->RecordCount();
	}
	$app_test_evaluate_list->StartRec = 1;
	if ($app_test_evaluate_list->DisplayRecs <= 0 || ($app_test_evaluate->Export <> "" && $app_test_evaluate->ExportAll)) // Display all records
		$app_test_evaluate_list->DisplayRecs = $app_test_evaluate_list->TotalRecs;
	if (!($app_test_evaluate->Export <> "" && $app_test_evaluate->ExportAll))
		$app_test_evaluate_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$app_test_evaluate_list->Recordset = $app_test_evaluate_list->LoadRecordset($app_test_evaluate_list->StartRec-1, $app_test_evaluate_list->DisplayRecs);

	// Set no record found message
	if ($app_test_evaluate->CurrentAction == "" && $app_test_evaluate_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_test_evaluate_list->setWarningMessage(ew_DeniedMsg());
		if ($app_test_evaluate_list->SearchWhere == "0=101")
			$app_test_evaluate_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_test_evaluate_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_test_evaluate_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($app_test_evaluate->Export == "" && $app_test_evaluate->CurrentAction == "") { ?>
<form name="fapp_test_evaluatelistsrch" id="fapp_test_evaluatelistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($app_test_evaluate_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fapp_test_evaluatelistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="app_test_evaluate">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($app_test_evaluate_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($app_test_evaluate_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $app_test_evaluate_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($app_test_evaluate_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($app_test_evaluate_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($app_test_evaluate_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($app_test_evaluate_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $app_test_evaluate_list->ShowPageHeader(); ?>
<?php
$app_test_evaluate_list->ShowMessage();
?>
<?php if ($app_test_evaluate_list->TotalRecs > 0 || $app_test_evaluate->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_test_evaluate_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_test_evaluate">
<?php if ($app_test_evaluate->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($app_test_evaluate->CurrentAction <> "gridadd" && $app_test_evaluate->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_test_evaluate_list->Pager)) $app_test_evaluate_list->Pager = new cPrevNextPager($app_test_evaluate_list->StartRec, $app_test_evaluate_list->DisplayRecs, $app_test_evaluate_list->TotalRecs, $app_test_evaluate_list->AutoHidePager) ?>
<?php if ($app_test_evaluate_list->Pager->RecordCount > 0 && $app_test_evaluate_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_test_evaluate_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_test_evaluate_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_test_evaluate_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_test_evaluate_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_test_evaluate_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($app_test_evaluate_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_evaluate_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fapp_test_evaluatelist" id="fapp_test_evaluatelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_test_evaluate_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_test_evaluate_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_test_evaluate">
<?php if ($app_test_evaluate->getCurrentMasterTable() == "app_test" && $app_test_evaluate->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="app_test">
<input type="hidden" name="fk_test_id" value="<?php echo $app_test_evaluate->test_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_app_test_evaluate" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($app_test_evaluate_list->TotalRecs > 0 || $app_test_evaluate->CurrentAction == "add" || $app_test_evaluate->CurrentAction == "copy" || $app_test_evaluate->CurrentAction == "gridedit") { ?>
<table id="tbl_app_test_evaluatelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_test_evaluate_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_test_evaluate_list->RenderListOptions();

// Render list options (header, left)
$app_test_evaluate_list->ListOptions->Render("header", "left");
?>
<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->test_id) == "") { ?>
		<th data-name="test_id" class="<?php echo $app_test_evaluate->test_id->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_test_id" class="app_test_evaluate_test_id"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->test_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_id" class="<?php echo $app_test_evaluate->test_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_test_evaluate->SortUrl($app_test_evaluate->test_id) ?>',1);"><div id="elh_app_test_evaluate_test_id" class="app_test_evaluate_test_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->test_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->test_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->test_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->lang_id) == "") { ?>
		<th data-name="lang_id" class="<?php echo $app_test_evaluate->lang_id->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_lang_id" class="app_test_evaluate_lang_id"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->lang_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lang_id" class="<?php echo $app_test_evaluate->lang_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_test_evaluate->SortUrl($app_test_evaluate->lang_id) ?>',1);"><div id="elh_app_test_evaluate_lang_id" class="app_test_evaluate_lang_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->lang_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->lang_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->lang_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->gend_id) == "") { ?>
		<th data-name="gend_id" class="<?php echo $app_test_evaluate->gend_id->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_gend_id" class="app_test_evaluate_gend_id"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->gend_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gend_id" class="<?php echo $app_test_evaluate->gend_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_test_evaluate->SortUrl($app_test_evaluate->gend_id) ?>',1);"><div id="elh_app_test_evaluate_gend_id" class="app_test_evaluate_gend_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->gend_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->gend_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->gend_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->eval_from) == "") { ?>
		<th data-name="eval_from" class="<?php echo $app_test_evaluate->eval_from->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_eval_from" class="app_test_evaluate_eval_from"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_from->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_from" class="<?php echo $app_test_evaluate->eval_from->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_test_evaluate->SortUrl($app_test_evaluate->eval_from) ?>',1);"><div id="elh_app_test_evaluate_eval_from" class="app_test_evaluate_eval_from">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_from->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->eval_from->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->eval_from->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->eval_to) == "") { ?>
		<th data-name="eval_to" class="<?php echo $app_test_evaluate->eval_to->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_eval_to" class="app_test_evaluate_eval_to"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_to->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_to" class="<?php echo $app_test_evaluate->eval_to->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_test_evaluate->SortUrl($app_test_evaluate->eval_to) ?>',1);"><div id="elh_app_test_evaluate_eval_to" class="app_test_evaluate_eval_to">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_to->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->eval_to->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->eval_to->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
	<?php if ($app_test_evaluate->SortUrl($app_test_evaluate->eval_text) == "") { ?>
		<th data-name="eval_text" class="<?php echo $app_test_evaluate->eval_text->HeaderCellClass() ?>"><div id="elh_app_test_evaluate_eval_text" class="app_test_evaluate_eval_text"><div class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="eval_text" class="<?php echo $app_test_evaluate->eval_text->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_test_evaluate->SortUrl($app_test_evaluate->eval_text) ?>',1);"><div id="elh_app_test_evaluate_eval_text" class="app_test_evaluate_eval_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_test_evaluate->eval_text->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($app_test_evaluate->eval_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_test_evaluate->eval_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_test_evaluate_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($app_test_evaluate->CurrentAction == "add" || $app_test_evaluate->CurrentAction == "copy") {
		$app_test_evaluate_list->RowIndex = 0;
		$app_test_evaluate_list->KeyCount = $app_test_evaluate_list->RowIndex;
		if ($app_test_evaluate->CurrentAction == "copy" && !$app_test_evaluate_list->LoadRow())
			$app_test_evaluate->CurrentAction = "add";
		if ($app_test_evaluate->CurrentAction == "add")
			$app_test_evaluate_list->LoadRowValues();
		if ($app_test_evaluate->EventCancelled) // Insert failed
			$app_test_evaluate_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$app_test_evaluate->ResetAttrs();
		$app_test_evaluate->RowAttrs = array_merge($app_test_evaluate->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_app_test_evaluate', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$app_test_evaluate->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_test_evaluate_list->RenderRow();

		// Render list options
		$app_test_evaluate_list->RenderListOptions();
		$app_test_evaluate_list->StartRowCnt = 0;
?>
	<tr<?php echo $app_test_evaluate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_evaluate_list->ListOptions->Render("body", "left", $app_test_evaluate_list->RowCnt);
?>
	<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id">
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
		<td data-name="eval_from">
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
		<td data-name="eval_to">
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
		<td data-name="eval_text">
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluatelist", "x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_evaluate_list->ListOptions->Render("body", "right", $app_test_evaluate_list->RowCnt);
?>
<script type="text/javascript">
fapp_test_evaluatelist.UpdateOpts(<?php echo $app_test_evaluate_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($app_test_evaluate->ExportAll && $app_test_evaluate->Export <> "") {
	$app_test_evaluate_list->StopRec = $app_test_evaluate_list->TotalRecs;
} else {

	// Set the last record to display
	if ($app_test_evaluate_list->TotalRecs > $app_test_evaluate_list->StartRec + $app_test_evaluate_list->DisplayRecs - 1)
		$app_test_evaluate_list->StopRec = $app_test_evaluate_list->StartRec + $app_test_evaluate_list->DisplayRecs - 1;
	else
		$app_test_evaluate_list->StopRec = $app_test_evaluate_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_test_evaluate_list->FormKeyCountName) && ($app_test_evaluate->CurrentAction == "gridadd" || $app_test_evaluate->CurrentAction == "gridedit" || $app_test_evaluate->CurrentAction == "F")) {
		$app_test_evaluate_list->KeyCount = $objForm->GetValue($app_test_evaluate_list->FormKeyCountName);
		$app_test_evaluate_list->StopRec = $app_test_evaluate_list->StartRec + $app_test_evaluate_list->KeyCount - 1;
	}
}
$app_test_evaluate_list->RecCnt = $app_test_evaluate_list->StartRec - 1;
if ($app_test_evaluate_list->Recordset && !$app_test_evaluate_list->Recordset->EOF) {
	$app_test_evaluate_list->Recordset->MoveFirst();
	$bSelectLimit = $app_test_evaluate_list->UseSelectLimit;
	if (!$bSelectLimit && $app_test_evaluate_list->StartRec > 1)
		$app_test_evaluate_list->Recordset->Move($app_test_evaluate_list->StartRec - 1);
} elseif (!$app_test_evaluate->AllowAddDeleteRow && $app_test_evaluate_list->StopRec == 0) {
	$app_test_evaluate_list->StopRec = $app_test_evaluate->GridAddRowCount;
}

// Initialize aggregate
$app_test_evaluate->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_test_evaluate->ResetAttrs();
$app_test_evaluate_list->RenderRow();
$app_test_evaluate_list->EditRowCnt = 0;
if ($app_test_evaluate->CurrentAction == "edit")
	$app_test_evaluate_list->RowIndex = 1;
if ($app_test_evaluate->CurrentAction == "gridadd")
	$app_test_evaluate_list->RowIndex = 0;
if ($app_test_evaluate->CurrentAction == "gridedit")
	$app_test_evaluate_list->RowIndex = 0;
while ($app_test_evaluate_list->RecCnt < $app_test_evaluate_list->StopRec) {
	$app_test_evaluate_list->RecCnt++;
	if (intval($app_test_evaluate_list->RecCnt) >= intval($app_test_evaluate_list->StartRec)) {
		$app_test_evaluate_list->RowCnt++;
		if ($app_test_evaluate->CurrentAction == "gridadd" || $app_test_evaluate->CurrentAction == "gridedit" || $app_test_evaluate->CurrentAction == "F") {
			$app_test_evaluate_list->RowIndex++;
			$objForm->Index = $app_test_evaluate_list->RowIndex;
			if ($objForm->HasValue($app_test_evaluate_list->FormActionName))
				$app_test_evaluate_list->RowAction = strval($objForm->GetValue($app_test_evaluate_list->FormActionName));
			elseif ($app_test_evaluate->CurrentAction == "gridadd")
				$app_test_evaluate_list->RowAction = "insert";
			else
				$app_test_evaluate_list->RowAction = "";
		}

		// Set up key count
		$app_test_evaluate_list->KeyCount = $app_test_evaluate_list->RowIndex;

		// Init row class and style
		$app_test_evaluate->ResetAttrs();
		$app_test_evaluate->CssClass = "";
		if ($app_test_evaluate->CurrentAction == "gridadd") {
			$app_test_evaluate_list->LoadRowValues(); // Load default values
		} else {
			$app_test_evaluate_list->LoadRowValues($app_test_evaluate_list->Recordset); // Load row values
		}
		$app_test_evaluate->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_test_evaluate->CurrentAction == "gridadd") // Grid add
			$app_test_evaluate->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_test_evaluate->CurrentAction == "gridadd" && $app_test_evaluate->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_test_evaluate_list->RestoreCurrentRowFormValues($app_test_evaluate_list->RowIndex); // Restore form values
		if ($app_test_evaluate->CurrentAction == "edit") {
			if ($app_test_evaluate_list->CheckInlineEditKey() && $app_test_evaluate_list->EditRowCnt == 0) { // Inline edit
				$app_test_evaluate->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($app_test_evaluate->CurrentAction == "gridedit") { // Grid edit
			if ($app_test_evaluate->EventCancelled) {
				$app_test_evaluate_list->RestoreCurrentRowFormValues($app_test_evaluate_list->RowIndex); // Restore form values
			}
			if ($app_test_evaluate_list->RowAction == "insert")
				$app_test_evaluate->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_test_evaluate->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_test_evaluate->CurrentAction == "edit" && $app_test_evaluate->RowType == EW_ROWTYPE_EDIT && $app_test_evaluate->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$app_test_evaluate_list->RestoreFormValues(); // Restore form values
		}
		if ($app_test_evaluate->CurrentAction == "gridedit" && ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT || $app_test_evaluate->RowType == EW_ROWTYPE_ADD) && $app_test_evaluate->EventCancelled) // Update failed
			$app_test_evaluate_list->RestoreCurrentRowFormValues($app_test_evaluate_list->RowIndex); // Restore form values
		if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_test_evaluate_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$app_test_evaluate->RowAttrs = array_merge($app_test_evaluate->RowAttrs, array('data-rowindex'=>$app_test_evaluate_list->RowCnt, 'id'=>'r' . $app_test_evaluate_list->RowCnt . '_app_test_evaluate', 'data-rowtype'=>$app_test_evaluate->RowType));

		// Render row
		$app_test_evaluate_list->RenderRow();

		// Render list options
		$app_test_evaluate_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_test_evaluate_list->RowAction <> "delete" && $app_test_evaluate_list->RowAction <> "insertdelete" && !($app_test_evaluate_list->RowAction == "insert" && $app_test_evaluate->CurrentAction == "F" && $app_test_evaluate_list->EmptyRow())) {
?>
	<tr<?php echo $app_test_evaluate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_evaluate_list->ListOptions->Render("body", "left", $app_test_evaluate_list->RowCnt);
?>
	<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
		<td data-name="test_id"<?php echo $app_test_evaluate->test_id->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_test_id" class="app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<?php echo $app_test_evaluate->test_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_id" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_id->CurrentValue) ?>">
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT || $app_test_evaluate->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_id" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id"<?php echo $app_test_evaluate->lang_id->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_lang_id" class="app_test_evaluate_lang_id">
<span<?php echo $app_test_evaluate->lang_id->ViewAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id"<?php echo $app_test_evaluate->gend_id->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_gend_id" class="app_test_evaluate_gend_id">
<span<?php echo $app_test_evaluate->gend_id->ViewAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
		<td data-name="eval_from"<?php echo $app_test_evaluate->eval_from->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_from" class="app_test_evaluate_eval_from">
<span<?php echo $app_test_evaluate->eval_from->ViewAttributes() ?>>
<?php echo $app_test_evaluate->eval_from->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
		<td data-name="eval_to"<?php echo $app_test_evaluate->eval_to->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_to" class="app_test_evaluate_eval_to">
<span<?php echo $app_test_evaluate->eval_to->ViewAttributes() ?>>
<?php echo $app_test_evaluate->eval_to->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
		<td data-name="eval_text"<?php echo $app_test_evaluate->eval_text->CellAttributes() ?>>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluatelist", "x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluatelist", "x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_test_evaluate_list->RowCnt ?>_app_test_evaluate_eval_text" class="app_test_evaluate_eval_text">
<span<?php echo $app_test_evaluate->eval_text->ViewAttributes() ?>>
<?php echo $app_test_evaluate->eval_text->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_evaluate_list->ListOptions->Render("body", "right", $app_test_evaluate_list->RowCnt);
?>
	</tr>
<?php if ($app_test_evaluate->RowType == EW_ROWTYPE_ADD || $app_test_evaluate->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_test_evaluatelist.UpdateOpts(<?php echo $app_test_evaluate_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_test_evaluate->CurrentAction <> "gridadd")
		if (!$app_test_evaluate_list->Recordset->EOF) $app_test_evaluate_list->Recordset->MoveNext();
}
?>
<?php
	if ($app_test_evaluate->CurrentAction == "gridadd" || $app_test_evaluate->CurrentAction == "gridedit") {
		$app_test_evaluate_list->RowIndex = '$rowindex$';
		$app_test_evaluate_list->LoadRowValues();

		// Set row properties
		$app_test_evaluate->ResetAttrs();
		$app_test_evaluate->RowAttrs = array_merge($app_test_evaluate->RowAttrs, array('data-rowindex'=>$app_test_evaluate_list->RowIndex, 'id'=>'r0_app_test_evaluate', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_test_evaluate->RowAttrs["class"], "ewTemplate");
		$app_test_evaluate->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_test_evaluate_list->RenderRow();

		// Render list options
		$app_test_evaluate_list->RenderListOptions();
		$app_test_evaluate_list->StartRowCnt = 0;
?>
	<tr<?php echo $app_test_evaluate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_test_evaluate_list->ListOptions->Render("body", "left", $app_test_evaluate_list->RowIndex);
?>
	<?php if ($app_test_evaluate->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<?php if ($app_test_evaluate->test_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<span<?php echo $app_test_evaluate->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_evaluate->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_app_test_evaluate_test_id" class="form-group app_test_evaluate_test_id">
<select data-table="app_test_evaluate" data-field="x_test_id" data-value-separator="<?php echo $app_test_evaluate->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id"<?php echo $app_test_evaluate->test_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->test_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="app_test_evaluate" data-field="x_test_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->lang_id->Visible) { // lang_id ?>
		<td data-name="lang_id">
<span id="el$rowindex$_app_test_evaluate_lang_id" class="form-group app_test_evaluate_lang_id">
<select data-table="app_test_evaluate" data-field="x_lang_id" data-value-separator="<?php echo $app_test_evaluate->lang_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id"<?php echo $app_test_evaluate->lang_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->lang_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_lang_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_lang_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->lang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->gend_id->Visible) { // gend_id ?>
		<td data-name="gend_id">
<span id="el$rowindex$_app_test_evaluate_gend_id" class="form-group app_test_evaluate_gend_id">
<select data-table="app_test_evaluate" data-field="x_gend_id" data-value-separator="<?php echo $app_test_evaluate->gend_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id"<?php echo $app_test_evaluate->gend_id->EditAttributes() ?>>
<?php echo $app_test_evaluate->gend_id->SelectOptionListHtml("x<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id") ?>
</select>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_gend_id" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_gend_id" value="<?php echo ew_HtmlEncode($app_test_evaluate->gend_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_from->Visible) { // eval_from ?>
		<td data-name="eval_from">
<span id="el$rowindex$_app_test_evaluate_eval_from" class="form-group app_test_evaluate_eval_from">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_from" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_from->EditValue ?>"<?php echo $app_test_evaluate->eval_from->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_from" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_from" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_from->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_to->Visible) { // eval_to ?>
		<td data-name="eval_to">
<span id="el$rowindex$_app_test_evaluate_eval_to" class="form-group app_test_evaluate_eval_to">
<input type="text" data-table="app_test_evaluate" data-field="x_eval_to" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->getPlaceHolder()) ?>" value="<?php echo $app_test_evaluate->eval_to->EditValue ?>"<?php echo $app_test_evaluate->eval_to->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_to" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_to" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_to->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_test_evaluate->eval_text->Visible) { // eval_text ?>
		<td data-name="eval_text">
<span id="el$rowindex$_app_test_evaluate_eval_text" class="form-group app_test_evaluate_eval_text">
<?php ew_AppendClass($app_test_evaluate->eval_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_evaluate" data-field="x_eval_text" name="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->getPlaceHolder()) ?>"<?php echo $app_test_evaluate->eval_text->EditAttributes() ?>><?php echo $app_test_evaluate->eval_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_evaluatelist", "x<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text", 35, 8, <?php echo ($app_test_evaluate->eval_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="app_test_evaluate" data-field="x_eval_text" name="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" id="o<?php echo $app_test_evaluate_list->RowIndex ?>_eval_text" value="<?php echo ew_HtmlEncode($app_test_evaluate->eval_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_test_evaluate_list->ListOptions->Render("body", "right", $app_test_evaluate_list->RowIndex);
?>
<script type="text/javascript">
fapp_test_evaluatelist.UpdateOpts(<?php echo $app_test_evaluate_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($app_test_evaluate->CurrentAction == "add" || $app_test_evaluate->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" id="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" value="<?php echo $app_test_evaluate_list->KeyCount ?>">
<?php } ?>
<?php if ($app_test_evaluate->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" id="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" value="<?php echo $app_test_evaluate_list->KeyCount ?>">
<?php echo $app_test_evaluate_list->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_evaluate->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" id="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" value="<?php echo $app_test_evaluate_list->KeyCount ?>">
<?php } ?>
<?php if ($app_test_evaluate->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" id="<?php echo $app_test_evaluate_list->FormKeyCountName ?>" value="<?php echo $app_test_evaluate_list->KeyCount ?>">
<?php echo $app_test_evaluate_list->MultiSelectKey ?>
<?php } ?>
<?php if ($app_test_evaluate->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($app_test_evaluate_list->Recordset)
	$app_test_evaluate_list->Recordset->Close();
?>
<?php if ($app_test_evaluate->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($app_test_evaluate->CurrentAction <> "gridadd" && $app_test_evaluate->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_test_evaluate_list->Pager)) $app_test_evaluate_list->Pager = new cPrevNextPager($app_test_evaluate_list->StartRec, $app_test_evaluate_list->DisplayRecs, $app_test_evaluate_list->TotalRecs, $app_test_evaluate_list->AutoHidePager) ?>
<?php if ($app_test_evaluate_list->Pager->RecordCount > 0 && $app_test_evaluate_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_test_evaluate_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_test_evaluate_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_test_evaluate_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_test_evaluate_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_test_evaluate_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_test_evaluate_list->PageUrl() ?>start=<?php echo $app_test_evaluate_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($app_test_evaluate_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_test_evaluate_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_evaluate_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($app_test_evaluate_list->TotalRecs == 0 && $app_test_evaluate->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_test_evaluate_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_test_evaluate->Export == "") { ?>
<script type="text/javascript">
fapp_test_evaluatelistsrch.FilterList = <?php echo $app_test_evaluate_list->GetFilterList() ?>;
fapp_test_evaluatelistsrch.Init();
fapp_test_evaluatelist.Init();
</script>
<?php } ?>
<?php
$app_test_evaluate_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($app_test_evaluate->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$app_test_evaluate_list->Page_Terminate();
?>
