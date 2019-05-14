<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_subscribeinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_subscribe_list = NULL; // Initialize page object first

class capp_subscribe_list extends capp_subscribe {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_subscribe';

	// Page object name
	var $PageObjName = 'app_subscribe_list';

	// Grid form hidden field names
	var $FormName = 'fapp_subscribelist';
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

		// Table object (app_subscribe)
		if (!isset($GLOBALS["app_subscribe"]) || get_class($GLOBALS["app_subscribe"]) == "capp_subscribe") {
			$GLOBALS["app_subscribe"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_subscribe"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "app_subscribeadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "app_subscribedelete.php";
		$this->MultiUpdateUrl = "app_subscribeupdate.php";

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fapp_subscribelistsrch";

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
		$this->serv_id->SetVisibility();
		$this->user_id->SetVisibility();
		$this->cycle_id->SetVisibility();
		$this->book_id->SetVisibility();
		$this->tcat_id->SetVisibility();
		$this->test_id->SetVisibility();
		$this->cat_id->SetVisibility();
		$this->cons_id->SetVisibility();
		$this->subs_start->SetVisibility();
		$this->subs_end->SetVisibility();
		$this->subs_qnt->SetVisibility();
		$this->subs_price->SetVisibility();
		$this->subs_amt->SetVisibility();
		$this->ins_datetime->SetVisibility();

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
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

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

	// Exit inline mode
	function ClearInlineMode() {
		$this->setKey("subs_id", ""); // Clear inline edit key
		$this->subs_qnt->FormValue = ""; // Clear form value
		$this->subs_price->FormValue = ""; // Clear form value
		$this->subs_amt->FormValue = ""; // Clear form value
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
		if (isset($_GET["subs_id"])) {
			$this->subs_id->setQueryStringValue($_GET["subs_id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("subs_id", $this->subs_id->CurrentValue); // Set up inline edit key
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
		if (strval($this->getKey("subs_id")) <> strval($this->subs_id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		if ($this->CurrentAction == "copy") {
			if (@$_GET["subs_id"] <> "") {
				$this->subs_id->setQueryStringValue($_GET["subs_id"]);
				$this->setKey("subs_id", $this->subs_id->CurrentValue); // Set up key
			} else {
				$this->setKey("subs_id", ""); // Clear key
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
			$this->subs_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->subs_id->FormValue))
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
					$sKey .= $this->subs_id->CurrentValue;

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
		if ($objForm->HasValue("x_serv_id") && $objForm->HasValue("o_serv_id") && $this->serv_id->CurrentValue <> $this->serv_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_user_id") && $objForm->HasValue("o_user_id") && $this->user_id->CurrentValue <> $this->user_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cycle_id") && $objForm->HasValue("o_cycle_id") && $this->cycle_id->CurrentValue <> $this->cycle_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_book_id") && $objForm->HasValue("o_book_id") && $this->book_id->CurrentValue <> $this->book_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tcat_id") && $objForm->HasValue("o_tcat_id") && $this->tcat_id->CurrentValue <> $this->tcat_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_test_id") && $objForm->HasValue("o_test_id") && $this->test_id->CurrentValue <> $this->test_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cat_id") && $objForm->HasValue("o_cat_id") && $this->cat_id->CurrentValue <> $this->cat_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cons_id") && $objForm->HasValue("o_cons_id") && $this->cons_id->CurrentValue <> $this->cons_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subs_start") && $objForm->HasValue("o_subs_start") && $this->subs_start->CurrentValue <> $this->subs_start->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subs_end") && $objForm->HasValue("o_subs_end") && $this->subs_end->CurrentValue <> $this->subs_end->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subs_qnt") && $objForm->HasValue("o_subs_qnt") && $this->subs_qnt->CurrentValue <> $this->subs_qnt->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subs_price") && $objForm->HasValue("o_subs_price") && $this->subs_price->CurrentValue <> $this->subs_price->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subs_amt") && $objForm->HasValue("o_subs_amt") && $this->subs_amt->CurrentValue <> $this->subs_amt->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_ins_datetime") && $objForm->HasValue("o_ins_datetime") && $this->ins_datetime->CurrentValue <> $this->ins_datetime->OldValue)
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
		$sFilterList = ew_Concat($sFilterList, $this->serv_id->AdvancedSearch->ToJson(), ","); // Field serv_id
		$sFilterList = ew_Concat($sFilterList, $this->user_id->AdvancedSearch->ToJson(), ","); // Field user_id
		$sFilterList = ew_Concat($sFilterList, $this->cycle_id->AdvancedSearch->ToJson(), ","); // Field cycle_id
		$sFilterList = ew_Concat($sFilterList, $this->book_id->AdvancedSearch->ToJson(), ","); // Field book_id
		$sFilterList = ew_Concat($sFilterList, $this->tcat_id->AdvancedSearch->ToJson(), ","); // Field tcat_id
		$sFilterList = ew_Concat($sFilterList, $this->test_id->AdvancedSearch->ToJson(), ","); // Field test_id
		$sFilterList = ew_Concat($sFilterList, $this->cat_id->AdvancedSearch->ToJson(), ","); // Field cat_id
		$sFilterList = ew_Concat($sFilterList, $this->cons_id->AdvancedSearch->ToJson(), ","); // Field cons_id
		$sFilterList = ew_Concat($sFilterList, $this->subs_start->AdvancedSearch->ToJson(), ","); // Field subs_start
		$sFilterList = ew_Concat($sFilterList, $this->subs_end->AdvancedSearch->ToJson(), ","); // Field subs_end
		$sFilterList = ew_Concat($sFilterList, $this->subs_qnt->AdvancedSearch->ToJson(), ","); // Field subs_qnt
		$sFilterList = ew_Concat($sFilterList, $this->subs_price->AdvancedSearch->ToJson(), ","); // Field subs_price
		$sFilterList = ew_Concat($sFilterList, $this->subs_amt->AdvancedSearch->ToJson(), ","); // Field subs_amt
		$sFilterList = ew_Concat($sFilterList, $this->ins_datetime->AdvancedSearch->ToJson(), ","); // Field ins_datetime
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fapp_subscribelistsrch", $filters);

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

		// Field serv_id
		$this->serv_id->AdvancedSearch->SearchValue = @$filter["x_serv_id"];
		$this->serv_id->AdvancedSearch->SearchOperator = @$filter["z_serv_id"];
		$this->serv_id->AdvancedSearch->SearchCondition = @$filter["v_serv_id"];
		$this->serv_id->AdvancedSearch->SearchValue2 = @$filter["y_serv_id"];
		$this->serv_id->AdvancedSearch->SearchOperator2 = @$filter["w_serv_id"];
		$this->serv_id->AdvancedSearch->Save();

		// Field user_id
		$this->user_id->AdvancedSearch->SearchValue = @$filter["x_user_id"];
		$this->user_id->AdvancedSearch->SearchOperator = @$filter["z_user_id"];
		$this->user_id->AdvancedSearch->SearchCondition = @$filter["v_user_id"];
		$this->user_id->AdvancedSearch->SearchValue2 = @$filter["y_user_id"];
		$this->user_id->AdvancedSearch->SearchOperator2 = @$filter["w_user_id"];
		$this->user_id->AdvancedSearch->Save();

		// Field cycle_id
		$this->cycle_id->AdvancedSearch->SearchValue = @$filter["x_cycle_id"];
		$this->cycle_id->AdvancedSearch->SearchOperator = @$filter["z_cycle_id"];
		$this->cycle_id->AdvancedSearch->SearchCondition = @$filter["v_cycle_id"];
		$this->cycle_id->AdvancedSearch->SearchValue2 = @$filter["y_cycle_id"];
		$this->cycle_id->AdvancedSearch->SearchOperator2 = @$filter["w_cycle_id"];
		$this->cycle_id->AdvancedSearch->Save();

		// Field book_id
		$this->book_id->AdvancedSearch->SearchValue = @$filter["x_book_id"];
		$this->book_id->AdvancedSearch->SearchOperator = @$filter["z_book_id"];
		$this->book_id->AdvancedSearch->SearchCondition = @$filter["v_book_id"];
		$this->book_id->AdvancedSearch->SearchValue2 = @$filter["y_book_id"];
		$this->book_id->AdvancedSearch->SearchOperator2 = @$filter["w_book_id"];
		$this->book_id->AdvancedSearch->Save();

		// Field tcat_id
		$this->tcat_id->AdvancedSearch->SearchValue = @$filter["x_tcat_id"];
		$this->tcat_id->AdvancedSearch->SearchOperator = @$filter["z_tcat_id"];
		$this->tcat_id->AdvancedSearch->SearchCondition = @$filter["v_tcat_id"];
		$this->tcat_id->AdvancedSearch->SearchValue2 = @$filter["y_tcat_id"];
		$this->tcat_id->AdvancedSearch->SearchOperator2 = @$filter["w_tcat_id"];
		$this->tcat_id->AdvancedSearch->Save();

		// Field test_id
		$this->test_id->AdvancedSearch->SearchValue = @$filter["x_test_id"];
		$this->test_id->AdvancedSearch->SearchOperator = @$filter["z_test_id"];
		$this->test_id->AdvancedSearch->SearchCondition = @$filter["v_test_id"];
		$this->test_id->AdvancedSearch->SearchValue2 = @$filter["y_test_id"];
		$this->test_id->AdvancedSearch->SearchOperator2 = @$filter["w_test_id"];
		$this->test_id->AdvancedSearch->Save();

		// Field cat_id
		$this->cat_id->AdvancedSearch->SearchValue = @$filter["x_cat_id"];
		$this->cat_id->AdvancedSearch->SearchOperator = @$filter["z_cat_id"];
		$this->cat_id->AdvancedSearch->SearchCondition = @$filter["v_cat_id"];
		$this->cat_id->AdvancedSearch->SearchValue2 = @$filter["y_cat_id"];
		$this->cat_id->AdvancedSearch->SearchOperator2 = @$filter["w_cat_id"];
		$this->cat_id->AdvancedSearch->Save();

		// Field cons_id
		$this->cons_id->AdvancedSearch->SearchValue = @$filter["x_cons_id"];
		$this->cons_id->AdvancedSearch->SearchOperator = @$filter["z_cons_id"];
		$this->cons_id->AdvancedSearch->SearchCondition = @$filter["v_cons_id"];
		$this->cons_id->AdvancedSearch->SearchValue2 = @$filter["y_cons_id"];
		$this->cons_id->AdvancedSearch->SearchOperator2 = @$filter["w_cons_id"];
		$this->cons_id->AdvancedSearch->Save();

		// Field subs_start
		$this->subs_start->AdvancedSearch->SearchValue = @$filter["x_subs_start"];
		$this->subs_start->AdvancedSearch->SearchOperator = @$filter["z_subs_start"];
		$this->subs_start->AdvancedSearch->SearchCondition = @$filter["v_subs_start"];
		$this->subs_start->AdvancedSearch->SearchValue2 = @$filter["y_subs_start"];
		$this->subs_start->AdvancedSearch->SearchOperator2 = @$filter["w_subs_start"];
		$this->subs_start->AdvancedSearch->Save();

		// Field subs_end
		$this->subs_end->AdvancedSearch->SearchValue = @$filter["x_subs_end"];
		$this->subs_end->AdvancedSearch->SearchOperator = @$filter["z_subs_end"];
		$this->subs_end->AdvancedSearch->SearchCondition = @$filter["v_subs_end"];
		$this->subs_end->AdvancedSearch->SearchValue2 = @$filter["y_subs_end"];
		$this->subs_end->AdvancedSearch->SearchOperator2 = @$filter["w_subs_end"];
		$this->subs_end->AdvancedSearch->Save();

		// Field subs_qnt
		$this->subs_qnt->AdvancedSearch->SearchValue = @$filter["x_subs_qnt"];
		$this->subs_qnt->AdvancedSearch->SearchOperator = @$filter["z_subs_qnt"];
		$this->subs_qnt->AdvancedSearch->SearchCondition = @$filter["v_subs_qnt"];
		$this->subs_qnt->AdvancedSearch->SearchValue2 = @$filter["y_subs_qnt"];
		$this->subs_qnt->AdvancedSearch->SearchOperator2 = @$filter["w_subs_qnt"];
		$this->subs_qnt->AdvancedSearch->Save();

		// Field subs_price
		$this->subs_price->AdvancedSearch->SearchValue = @$filter["x_subs_price"];
		$this->subs_price->AdvancedSearch->SearchOperator = @$filter["z_subs_price"];
		$this->subs_price->AdvancedSearch->SearchCondition = @$filter["v_subs_price"];
		$this->subs_price->AdvancedSearch->SearchValue2 = @$filter["y_subs_price"];
		$this->subs_price->AdvancedSearch->SearchOperator2 = @$filter["w_subs_price"];
		$this->subs_price->AdvancedSearch->Save();

		// Field subs_amt
		$this->subs_amt->AdvancedSearch->SearchValue = @$filter["x_subs_amt"];
		$this->subs_amt->AdvancedSearch->SearchOperator = @$filter["z_subs_amt"];
		$this->subs_amt->AdvancedSearch->SearchCondition = @$filter["v_subs_amt"];
		$this->subs_amt->AdvancedSearch->SearchValue2 = @$filter["y_subs_amt"];
		$this->subs_amt->AdvancedSearch->SearchOperator2 = @$filter["w_subs_amt"];
		$this->subs_amt->AdvancedSearch->Save();

		// Field ins_datetime
		$this->ins_datetime->AdvancedSearch->SearchValue = @$filter["x_ins_datetime"];
		$this->ins_datetime->AdvancedSearch->SearchOperator = @$filter["z_ins_datetime"];
		$this->ins_datetime->AdvancedSearch->SearchCondition = @$filter["v_ins_datetime"];
		$this->ins_datetime->AdvancedSearch->SearchValue2 = @$filter["y_ins_datetime"];
		$this->ins_datetime->AdvancedSearch->SearchOperator2 = @$filter["w_ins_datetime"];
		$this->ins_datetime->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->serv_id, $Default, FALSE); // serv_id
		$this->BuildSearchSql($sWhere, $this->user_id, $Default, FALSE); // user_id
		$this->BuildSearchSql($sWhere, $this->cycle_id, $Default, FALSE); // cycle_id
		$this->BuildSearchSql($sWhere, $this->book_id, $Default, FALSE); // book_id
		$this->BuildSearchSql($sWhere, $this->tcat_id, $Default, FALSE); // tcat_id
		$this->BuildSearchSql($sWhere, $this->test_id, $Default, FALSE); // test_id
		$this->BuildSearchSql($sWhere, $this->cat_id, $Default, FALSE); // cat_id
		$this->BuildSearchSql($sWhere, $this->cons_id, $Default, FALSE); // cons_id
		$this->BuildSearchSql($sWhere, $this->subs_start, $Default, FALSE); // subs_start
		$this->BuildSearchSql($sWhere, $this->subs_end, $Default, FALSE); // subs_end
		$this->BuildSearchSql($sWhere, $this->subs_qnt, $Default, FALSE); // subs_qnt
		$this->BuildSearchSql($sWhere, $this->subs_price, $Default, FALSE); // subs_price
		$this->BuildSearchSql($sWhere, $this->subs_amt, $Default, FALSE); // subs_amt
		$this->BuildSearchSql($sWhere, $this->ins_datetime, $Default, FALSE); // ins_datetime

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->serv_id->AdvancedSearch->Save(); // serv_id
			$this->user_id->AdvancedSearch->Save(); // user_id
			$this->cycle_id->AdvancedSearch->Save(); // cycle_id
			$this->book_id->AdvancedSearch->Save(); // book_id
			$this->tcat_id->AdvancedSearch->Save(); // tcat_id
			$this->test_id->AdvancedSearch->Save(); // test_id
			$this->cat_id->AdvancedSearch->Save(); // cat_id
			$this->cons_id->AdvancedSearch->Save(); // cons_id
			$this->subs_start->AdvancedSearch->Save(); // subs_start
			$this->subs_end->AdvancedSearch->Save(); // subs_end
			$this->subs_qnt->AdvancedSearch->Save(); // subs_qnt
			$this->subs_price->AdvancedSearch->Save(); // subs_price
			$this->subs_amt->AdvancedSearch->Save(); // subs_amt
			$this->ins_datetime->AdvancedSearch->Save(); // ins_datetime
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

	// Check if search parm exists
	function CheckSearchParms() {
		if ($this->serv_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->user_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->cycle_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->book_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tcat_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->test_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->cat_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->cons_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->subs_start->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->subs_end->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->subs_qnt->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->subs_price->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->subs_amt->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->ins_datetime->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->serv_id->AdvancedSearch->UnsetSession();
		$this->user_id->AdvancedSearch->UnsetSession();
		$this->cycle_id->AdvancedSearch->UnsetSession();
		$this->book_id->AdvancedSearch->UnsetSession();
		$this->tcat_id->AdvancedSearch->UnsetSession();
		$this->test_id->AdvancedSearch->UnsetSession();
		$this->cat_id->AdvancedSearch->UnsetSession();
		$this->cons_id->AdvancedSearch->UnsetSession();
		$this->subs_start->AdvancedSearch->UnsetSession();
		$this->subs_end->AdvancedSearch->UnsetSession();
		$this->subs_qnt->AdvancedSearch->UnsetSession();
		$this->subs_price->AdvancedSearch->UnsetSession();
		$this->subs_amt->AdvancedSearch->UnsetSession();
		$this->ins_datetime->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->serv_id->AdvancedSearch->Load();
		$this->user_id->AdvancedSearch->Load();
		$this->cycle_id->AdvancedSearch->Load();
		$this->book_id->AdvancedSearch->Load();
		$this->tcat_id->AdvancedSearch->Load();
		$this->test_id->AdvancedSearch->Load();
		$this->cat_id->AdvancedSearch->Load();
		$this->cons_id->AdvancedSearch->Load();
		$this->subs_start->AdvancedSearch->Load();
		$this->subs_end->AdvancedSearch->Load();
		$this->subs_qnt->AdvancedSearch->Load();
		$this->subs_price->AdvancedSearch->Load();
		$this->subs_amt->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->serv_id); // serv_id
			$this->UpdateSort($this->user_id); // user_id
			$this->UpdateSort($this->cycle_id); // cycle_id
			$this->UpdateSort($this->book_id); // book_id
			$this->UpdateSort($this->tcat_id); // tcat_id
			$this->UpdateSort($this->test_id); // test_id
			$this->UpdateSort($this->cat_id); // cat_id
			$this->UpdateSort($this->cons_id); // cons_id
			$this->UpdateSort($this->subs_start); // subs_start
			$this->UpdateSort($this->subs_end); // subs_end
			$this->UpdateSort($this->subs_qnt); // subs_qnt
			$this->UpdateSort($this->subs_price); // subs_price
			$this->UpdateSort($this->subs_amt); // subs_amt
			$this->UpdateSort($this->ins_datetime); // ins_datetime
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
				$this->serv_id->setSort("ASC");
				$this->user_id->setSort("ASC");
				$this->cycle_id->setSort("ASC");
				$this->ins_datetime->setSort("DESC");
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
				$this->serv_id->setSort("");
				$this->user_id->setSort("");
				$this->cycle_id->setSort("");
				$this->book_id->setSort("");
				$this->tcat_id->setSort("");
				$this->test_id->setSort("");
				$this->cat_id->setSort("");
				$this->cons_id->setSort("");
				$this->subs_start->setSort("");
				$this->subs_end->setSort("");
				$this->subs_qnt->setSort("");
				$this->subs_price->setSort("");
				$this->subs_amt->setSort("");
				$this->ins_datetime->setSort("");
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
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->subs_id->CurrentValue) . "\">";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->subs_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->subs_id->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ewAction ewMultiDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.fapp_subscribelist,url:'" . $this->MultiDeleteUrl . "'});return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = ($Security->CanDelete());

		// Add multi update
		$item = &$option->Add("multiupdate");
		$item->Body = "<a class=\"ewAction ewMultiUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" data-table=\"app_subscribe\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.fapp_subscribelist,url:'" . $this->MultiUpdateUrl . "'});return false;\">" . $Language->Phrase("UpdateSelectedLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fapp_subscribelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fapp_subscribelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fapp_subscribelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->Add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"app_subscribesrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->Add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewHighlight active\" title=\"" . $Language->Phrase("Highlight") . "\" data-caption=\"" . $Language->Phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fapp_subscribelistsrch\" data-name=\"" . $this->HighlightName() . "\">" . $Language->Phrase("HighlightBtn") . "</button>";
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
		$this->subs_id->CurrentValue = NULL;
		$this->subs_id->OldValue = $this->subs_id->CurrentValue;
		$this->serv_id->CurrentValue = NULL;
		$this->serv_id->OldValue = $this->serv_id->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->cycle_id->CurrentValue = NULL;
		$this->cycle_id->OldValue = $this->cycle_id->CurrentValue;
		$this->book_id->CurrentValue = 0;
		$this->book_id->OldValue = $this->book_id->CurrentValue;
		$this->tcat_id->CurrentValue = 0;
		$this->tcat_id->OldValue = $this->tcat_id->CurrentValue;
		$this->test_id->CurrentValue = 0;
		$this->test_id->OldValue = $this->test_id->CurrentValue;
		$this->cat_id->CurrentValue = 0;
		$this->cat_id->OldValue = $this->cat_id->CurrentValue;
		$this->cons_id->CurrentValue = 0;
		$this->cons_id->OldValue = $this->cons_id->CurrentValue;
		$this->subs_start->CurrentValue = NULL;
		$this->subs_start->OldValue = $this->subs_start->CurrentValue;
		$this->subs_end->CurrentValue = NULL;
		$this->subs_end->OldValue = $this->subs_end->CurrentValue;
		$this->subs_qnt->CurrentValue = 1;
		$this->subs_qnt->OldValue = $this->subs_qnt->CurrentValue;
		$this->subs_price->CurrentValue = 0;
		$this->subs_price->OldValue = $this->subs_price->CurrentValue;
		$this->subs_amt->CurrentValue = 0;
		$this->subs_amt->OldValue = $this->subs_amt->CurrentValue;
		$this->ins_datetime->CurrentValue = NULL;
		$this->ins_datetime->OldValue = $this->ins_datetime->CurrentValue;
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// serv_id

		$this->serv_id->AdvancedSearch->SearchValue = @$_GET["x_serv_id"];
		if ($this->serv_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->serv_id->AdvancedSearch->SearchOperator = @$_GET["z_serv_id"];

		// user_id
		$this->user_id->AdvancedSearch->SearchValue = @$_GET["x_user_id"];
		if ($this->user_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->user_id->AdvancedSearch->SearchOperator = @$_GET["z_user_id"];

		// cycle_id
		$this->cycle_id->AdvancedSearch->SearchValue = @$_GET["x_cycle_id"];
		if ($this->cycle_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->cycle_id->AdvancedSearch->SearchOperator = @$_GET["z_cycle_id"];

		// book_id
		$this->book_id->AdvancedSearch->SearchValue = @$_GET["x_book_id"];
		if ($this->book_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->book_id->AdvancedSearch->SearchOperator = @$_GET["z_book_id"];

		// tcat_id
		$this->tcat_id->AdvancedSearch->SearchValue = @$_GET["x_tcat_id"];
		if ($this->tcat_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tcat_id->AdvancedSearch->SearchOperator = @$_GET["z_tcat_id"];

		// test_id
		$this->test_id->AdvancedSearch->SearchValue = @$_GET["x_test_id"];
		if ($this->test_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->test_id->AdvancedSearch->SearchOperator = @$_GET["z_test_id"];

		// cat_id
		$this->cat_id->AdvancedSearch->SearchValue = @$_GET["x_cat_id"];
		if ($this->cat_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->cat_id->AdvancedSearch->SearchOperator = @$_GET["z_cat_id"];

		// cons_id
		$this->cons_id->AdvancedSearch->SearchValue = @$_GET["x_cons_id"];
		if ($this->cons_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->cons_id->AdvancedSearch->SearchOperator = @$_GET["z_cons_id"];

		// subs_start
		$this->subs_start->AdvancedSearch->SearchValue = @$_GET["x_subs_start"];
		if ($this->subs_start->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->subs_start->AdvancedSearch->SearchOperator = @$_GET["z_subs_start"];

		// subs_end
		$this->subs_end->AdvancedSearch->SearchValue = @$_GET["x_subs_end"];
		if ($this->subs_end->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->subs_end->AdvancedSearch->SearchOperator = @$_GET["z_subs_end"];

		// subs_qnt
		$this->subs_qnt->AdvancedSearch->SearchValue = @$_GET["x_subs_qnt"];
		if ($this->subs_qnt->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->subs_qnt->AdvancedSearch->SearchOperator = @$_GET["z_subs_qnt"];

		// subs_price
		$this->subs_price->AdvancedSearch->SearchValue = @$_GET["x_subs_price"];
		if ($this->subs_price->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->subs_price->AdvancedSearch->SearchOperator = @$_GET["z_subs_price"];

		// subs_amt
		$this->subs_amt->AdvancedSearch->SearchValue = @$_GET["x_subs_amt"];
		if ($this->subs_amt->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->subs_amt->AdvancedSearch->SearchOperator = @$_GET["z_subs_amt"];

		// ins_datetime
		$this->ins_datetime->AdvancedSearch->SearchValue = @$_GET["x_ins_datetime"];
		if ($this->ins_datetime->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->ins_datetime->AdvancedSearch->SearchOperator = @$_GET["z_ins_datetime"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->serv_id->FldIsDetailKey) {
			$this->serv_id->setFormValue($objForm->GetValue("x_serv_id"));
		}
		$this->serv_id->setOldValue($objForm->GetValue("o_serv_id"));
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		$this->user_id->setOldValue($objForm->GetValue("o_user_id"));
		if (!$this->cycle_id->FldIsDetailKey) {
			$this->cycle_id->setFormValue($objForm->GetValue("x_cycle_id"));
		}
		$this->cycle_id->setOldValue($objForm->GetValue("o_cycle_id"));
		if (!$this->book_id->FldIsDetailKey) {
			$this->book_id->setFormValue($objForm->GetValue("x_book_id"));
		}
		$this->book_id->setOldValue($objForm->GetValue("o_book_id"));
		if (!$this->tcat_id->FldIsDetailKey) {
			$this->tcat_id->setFormValue($objForm->GetValue("x_tcat_id"));
		}
		$this->tcat_id->setOldValue($objForm->GetValue("o_tcat_id"));
		if (!$this->test_id->FldIsDetailKey) {
			$this->test_id->setFormValue($objForm->GetValue("x_test_id"));
		}
		$this->test_id->setOldValue($objForm->GetValue("o_test_id"));
		if (!$this->cat_id->FldIsDetailKey) {
			$this->cat_id->setFormValue($objForm->GetValue("x_cat_id"));
		}
		$this->cat_id->setOldValue($objForm->GetValue("o_cat_id"));
		if (!$this->cons_id->FldIsDetailKey) {
			$this->cons_id->setFormValue($objForm->GetValue("x_cons_id"));
		}
		$this->cons_id->setOldValue($objForm->GetValue("o_cons_id"));
		if (!$this->subs_start->FldIsDetailKey) {
			$this->subs_start->setFormValue($objForm->GetValue("x_subs_start"));
			$this->subs_start->CurrentValue = ew_UnFormatDateTime($this->subs_start->CurrentValue, 0);
		}
		$this->subs_start->setOldValue($objForm->GetValue("o_subs_start"));
		if (!$this->subs_end->FldIsDetailKey) {
			$this->subs_end->setFormValue($objForm->GetValue("x_subs_end"));
			$this->subs_end->CurrentValue = ew_UnFormatDateTime($this->subs_end->CurrentValue, 0);
		}
		$this->subs_end->setOldValue($objForm->GetValue("o_subs_end"));
		if (!$this->subs_qnt->FldIsDetailKey) {
			$this->subs_qnt->setFormValue($objForm->GetValue("x_subs_qnt"));
		}
		$this->subs_qnt->setOldValue($objForm->GetValue("o_subs_qnt"));
		if (!$this->subs_price->FldIsDetailKey) {
			$this->subs_price->setFormValue($objForm->GetValue("x_subs_price"));
		}
		$this->subs_price->setOldValue($objForm->GetValue("o_subs_price"));
		if (!$this->subs_amt->FldIsDetailKey) {
			$this->subs_amt->setFormValue($objForm->GetValue("x_subs_amt"));
		}
		$this->subs_amt->setOldValue($objForm->GetValue("o_subs_amt"));
		if (!$this->ins_datetime->FldIsDetailKey) {
			$this->ins_datetime->setFormValue($objForm->GetValue("x_ins_datetime"));
			$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0);
		}
		$this->ins_datetime->setOldValue($objForm->GetValue("o_ins_datetime"));
		if (!$this->subs_id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->subs_id->setFormValue($objForm->GetValue("x_subs_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->subs_id->CurrentValue = $this->subs_id->FormValue;
		$this->serv_id->CurrentValue = $this->serv_id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->cycle_id->CurrentValue = $this->cycle_id->FormValue;
		$this->book_id->CurrentValue = $this->book_id->FormValue;
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
		$this->ins_datetime->CurrentValue = $this->ins_datetime->FormValue;
		$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0);
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
		$this->subs_id->setDbValue($row['subs_id']);
		$this->serv_id->setDbValue($row['serv_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->cycle_id->setDbValue($row['cycle_id']);
		$this->book_id->setDbValue($row['book_id']);
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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

		$this->subs_id->CellCssStyle = "white-space: nowrap;";

		// serv_id
		// user_id
		// cycle_id
		// book_id
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
			if ($this->Export == "")
				$this->subs_qnt->ViewValue = $this->HighlightValue($this->subs_qnt);

			// subs_price
			$this->subs_price->LinkCustomAttributes = "";
			$this->subs_price->HrefValue = "";
			$this->subs_price->TooltipValue = "";
			if ($this->Export == "")
				$this->subs_price->ViewValue = $this->HighlightValue($this->subs_price);

			// subs_amt
			$this->subs_amt->LinkCustomAttributes = "";
			$this->subs_amt->HrefValue = "";
			$this->subs_amt->TooltipValue = "";
			if ($this->Export == "")
				$this->subs_amt->ViewValue = $this->HighlightValue($this->subs_amt);

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";
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
			if (strval($this->subs_qnt->EditValue) <> "" && is_numeric($this->subs_qnt->EditValue)) {
			$this->subs_qnt->EditValue = ew_FormatNumber($this->subs_qnt->EditValue, -2, -1, -2, 0);
			$this->subs_qnt->OldValue = $this->subs_qnt->EditValue;
			}

			// subs_price
			$this->subs_price->EditAttrs["class"] = "form-control";
			$this->subs_price->EditCustomAttributes = "";
			$this->subs_price->EditValue = ew_HtmlEncode($this->subs_price->CurrentValue);
			$this->subs_price->PlaceHolder = ew_RemoveHtml($this->subs_price->FldCaption());
			if (strval($this->subs_price->EditValue) <> "" && is_numeric($this->subs_price->EditValue)) {
			$this->subs_price->EditValue = ew_FormatNumber($this->subs_price->EditValue, -2, -1, -2, 0);
			$this->subs_price->OldValue = $this->subs_price->EditValue;
			}

			// subs_amt
			$this->subs_amt->EditAttrs["class"] = "form-control";
			$this->subs_amt->EditCustomAttributes = "";
			$this->subs_amt->EditValue = ew_HtmlEncode($this->subs_amt->CurrentValue);
			$this->subs_amt->PlaceHolder = ew_RemoveHtml($this->subs_amt->FldCaption());
			if (strval($this->subs_amt->EditValue) <> "" && is_numeric($this->subs_amt->EditValue)) {
			$this->subs_amt->EditValue = ew_FormatNumber($this->subs_amt->EditValue, -2, -1, -2, 0);
			$this->subs_amt->OldValue = $this->subs_amt->EditValue;
			}

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ins_datetime->CurrentValue, 8));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

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

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
			if (strval($this->subs_qnt->EditValue) <> "" && is_numeric($this->subs_qnt->EditValue)) {
			$this->subs_qnt->EditValue = ew_FormatNumber($this->subs_qnt->EditValue, -2, -1, -2, 0);
			$this->subs_qnt->OldValue = $this->subs_qnt->EditValue;
			}

			// subs_price
			$this->subs_price->EditAttrs["class"] = "form-control";
			$this->subs_price->EditCustomAttributes = "";
			$this->subs_price->EditValue = ew_HtmlEncode($this->subs_price->CurrentValue);
			$this->subs_price->PlaceHolder = ew_RemoveHtml($this->subs_price->FldCaption());
			if (strval($this->subs_price->EditValue) <> "" && is_numeric($this->subs_price->EditValue)) {
			$this->subs_price->EditValue = ew_FormatNumber($this->subs_price->EditValue, -2, -1, -2, 0);
			$this->subs_price->OldValue = $this->subs_price->EditValue;
			}

			// subs_amt
			$this->subs_amt->EditAttrs["class"] = "form-control";
			$this->subs_amt->EditCustomAttributes = "";
			$this->subs_amt->EditValue = ew_HtmlEncode($this->subs_amt->CurrentValue);
			$this->subs_amt->PlaceHolder = ew_RemoveHtml($this->subs_amt->FldCaption());
			if (strval($this->subs_amt->EditValue) <> "" && is_numeric($this->subs_amt->EditValue)) {
			$this->subs_amt->EditValue = ew_FormatNumber($this->subs_amt->EditValue, -2, -1, -2, 0);
			$this->subs_amt->OldValue = $this->subs_amt->EditValue;
			}

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ins_datetime->CurrentValue, 8));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

			// Edit refer script
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

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
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
		if (!$this->serv_id->FldIsDetailKey && !is_null($this->serv_id->FormValue) && $this->serv_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->serv_id->FldCaption(), $this->serv_id->ReqErrMsg));
		}
		if (!$this->user_id->FldIsDetailKey && !is_null($this->user_id->FormValue) && $this->user_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_id->FldCaption(), $this->user_id->ReqErrMsg));
		}
		if (!$this->cycle_id->FldIsDetailKey && !is_null($this->cycle_id->FormValue) && $this->cycle_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cycle_id->FldCaption(), $this->cycle_id->ReqErrMsg));
		}
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
		if (!$this->ins_datetime->FldIsDetailKey && !is_null($this->ins_datetime->FormValue) && $this->ins_datetime->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ins_datetime->FldCaption(), $this->ins_datetime->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->ins_datetime->FormValue)) {
			ew_AddMessage($gsFormError, $this->ins_datetime->FldErrMsg());
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
				$sThisKey .= $row['subs_id'];
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

			// serv_id
			$this->serv_id->SetDbValueDef($rsnew, $this->serv_id->CurrentValue, 0, $this->serv_id->ReadOnly);

			// user_id
			$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly);

			// cycle_id
			$this->cycle_id->SetDbValueDef($rsnew, $this->cycle_id->CurrentValue, 0, $this->cycle_id->ReadOnly);

			// book_id
			$this->book_id->SetDbValueDef($rsnew, $this->book_id->CurrentValue, 0, $this->book_id->ReadOnly);

			// tcat_id
			$this->tcat_id->SetDbValueDef($rsnew, $this->tcat_id->CurrentValue, 0, $this->tcat_id->ReadOnly);

			// test_id
			$this->test_id->SetDbValueDef($rsnew, $this->test_id->CurrentValue, 0, $this->test_id->ReadOnly);

			// cat_id
			$this->cat_id->SetDbValueDef($rsnew, $this->cat_id->CurrentValue, 0, $this->cat_id->ReadOnly);

			// cons_id
			$this->cons_id->SetDbValueDef($rsnew, $this->cons_id->CurrentValue, 0, $this->cons_id->ReadOnly);

			// subs_start
			$this->subs_start->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->subs_start->CurrentValue, 0), ew_CurrentDate(), $this->subs_start->ReadOnly);

			// subs_end
			$this->subs_end->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->subs_end->CurrentValue, 0), ew_CurrentDate(), $this->subs_end->ReadOnly);

			// subs_qnt
			$this->subs_qnt->SetDbValueDef($rsnew, $this->subs_qnt->CurrentValue, 0, $this->subs_qnt->ReadOnly);

			// subs_price
			$this->subs_price->SetDbValueDef($rsnew, $this->subs_price->CurrentValue, 0, $this->subs_price->ReadOnly);

			// subs_amt
			$this->subs_amt->SetDbValueDef($rsnew, $this->subs_amt->CurrentValue, 0, $this->subs_amt->ReadOnly);

			// ins_datetime
			$this->ins_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0), ew_CurrentDate(), $this->ins_datetime->ReadOnly);

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

		// serv_id
		$this->serv_id->SetDbValueDef($rsnew, $this->serv_id->CurrentValue, 0, FALSE);

		// user_id
		$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, 0, FALSE);

		// cycle_id
		$this->cycle_id->SetDbValueDef($rsnew, $this->cycle_id->CurrentValue, 0, FALSE);

		// book_id
		$this->book_id->SetDbValueDef($rsnew, $this->book_id->CurrentValue, 0, strval($this->book_id->CurrentValue) == "");

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

		// ins_datetime
		$this->ins_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 0), ew_CurrentDate(), FALSE);

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
		$this->serv_id->AdvancedSearch->Load();
		$this->user_id->AdvancedSearch->Load();
		$this->cycle_id->AdvancedSearch->Load();
		$this->book_id->AdvancedSearch->Load();
		$this->tcat_id->AdvancedSearch->Load();
		$this->test_id->AdvancedSearch->Load();
		$this->cat_id->AdvancedSearch->Load();
		$this->cons_id->AdvancedSearch->Load();
		$this->subs_start->AdvancedSearch->Load();
		$this->subs_end->AdvancedSearch->Load();
		$this->subs_qnt->AdvancedSearch->Load();
		$this->subs_price->AdvancedSearch->Load();
		$this->subs_amt->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_app_subscribe\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_app_subscribe',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fapp_subscribelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
if (!isset($app_subscribe_list)) $app_subscribe_list = new capp_subscribe_list();

// Page init
$app_subscribe_list->Page_Init();

// Page main
$app_subscribe_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_subscribe_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($app_subscribe->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fapp_subscribelist = new ew_Form("fapp_subscribelist", "list");
fapp_subscribelist.FormKeyCountName = '<?php echo $app_subscribe_list->FormKeyCountName ?>';

// Validate form
fapp_subscribelist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_serv_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe->serv_id->FldCaption(), $app_subscribe->serv_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_user_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe->user_id->FldCaption(), $app_subscribe->user_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cycle_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe->cycle_id->FldCaption(), $app_subscribe->cycle_id->ReqErrMsg)) ?>");
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
			elm = this.GetElements("x" + infix + "_ins_datetime");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_subscribe->ins_datetime->FldCaption(), $app_subscribe->ins_datetime->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ins_datetime");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->ins_datetime->FldErrMsg()) ?>");

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
fapp_subscribelist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "serv_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "user_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cycle_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "book_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tcat_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "test_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cat_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cons_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subs_start", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subs_end", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subs_qnt", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subs_price", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subs_amt", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ins_datetime", false)) return false;
	return true;
}

// Form_CustomValidate event
fapp_subscribelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_subscribelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_subscribelist.Lists["x_serv_id"] = {"LinkField":"x_serv_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_serv_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_service"};
fapp_subscribelist.Lists["x_serv_id"].Data = "<?php echo $app_subscribe_list->serv_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_subscribelist.Lists["x_user_id"].Data = "<?php echo $app_subscribe_list->user_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_cycle_id"] = {"LinkField":"x_cycle_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cycle_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_bill_cycle"};
fapp_subscribelist.Lists["x_cycle_id"].Data = "<?php echo $app_subscribe_list->cycle_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_subscribelist.Lists["x_book_id"].Data = "<?php echo $app_subscribe_list->book_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_subscribelist.Lists["x_tcat_id"].Data = "<?php echo $app_subscribe_list->tcat_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_subscribelist.Lists["x_test_id"].Data = "<?php echo $app_subscribe_list->test_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_subscribelist.Lists["x_cat_id"].Data = "<?php echo $app_subscribe_list->cat_id->LookupFilterQuery(FALSE, "list") ?>";
fapp_subscribelist.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_amount","x_cons_message","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_subscribelist.Lists["x_cons_id"].Data = "<?php echo $app_subscribe_list->cons_id->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fapp_subscribelistsrch = new ew_Form("fapp_subscribelistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($app_subscribe->Export == "") { ?>
<div class="ewToolbar">
<?php if ($app_subscribe_list->TotalRecs > 0 && $app_subscribe_list->ExportOptions->Visible()) { ?>
<?php $app_subscribe_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($app_subscribe_list->SearchOptions->Visible()) { ?>
<?php $app_subscribe_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($app_subscribe_list->FilterOptions->Visible()) { ?>
<?php $app_subscribe_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
if ($app_subscribe->CurrentAction == "gridadd") {
	$app_subscribe->CurrentFilter = "0=1";
	$app_subscribe_list->StartRec = 1;
	$app_subscribe_list->DisplayRecs = $app_subscribe->GridAddRowCount;
	$app_subscribe_list->TotalRecs = $app_subscribe_list->DisplayRecs;
	$app_subscribe_list->StopRec = $app_subscribe_list->DisplayRecs;
} else {
	$bSelectLimit = $app_subscribe_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($app_subscribe_list->TotalRecs <= 0)
			$app_subscribe_list->TotalRecs = $app_subscribe->ListRecordCount();
	} else {
		if (!$app_subscribe_list->Recordset && ($app_subscribe_list->Recordset = $app_subscribe_list->LoadRecordset()))
			$app_subscribe_list->TotalRecs = $app_subscribe_list->Recordset->RecordCount();
	}
	$app_subscribe_list->StartRec = 1;
	if ($app_subscribe_list->DisplayRecs <= 0 || ($app_subscribe->Export <> "" && $app_subscribe->ExportAll)) // Display all records
		$app_subscribe_list->DisplayRecs = $app_subscribe_list->TotalRecs;
	if (!($app_subscribe->Export <> "" && $app_subscribe->ExportAll))
		$app_subscribe_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$app_subscribe_list->Recordset = $app_subscribe_list->LoadRecordset($app_subscribe_list->StartRec-1, $app_subscribe_list->DisplayRecs);

	// Set no record found message
	if ($app_subscribe->CurrentAction == "" && $app_subscribe_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$app_subscribe_list->setWarningMessage(ew_DeniedMsg());
		if ($app_subscribe_list->SearchWhere == "0=101")
			$app_subscribe_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$app_subscribe_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$app_subscribe_list->RenderOtherOptions();
?>
<?php $app_subscribe_list->ShowPageHeader(); ?>
<?php
$app_subscribe_list->ShowMessage();
?>
<?php if ($app_subscribe_list->TotalRecs > 0 || $app_subscribe->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($app_subscribe_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> app_subscribe">
<?php if ($app_subscribe->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($app_subscribe->CurrentAction <> "gridadd" && $app_subscribe->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_subscribe_list->Pager)) $app_subscribe_list->Pager = new cPrevNextPager($app_subscribe_list->StartRec, $app_subscribe_list->DisplayRecs, $app_subscribe_list->TotalRecs, $app_subscribe_list->AutoHidePager) ?>
<?php if ($app_subscribe_list->Pager->RecordCount > 0 && $app_subscribe_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_subscribe_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_subscribe_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_subscribe_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_subscribe_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_subscribe_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_subscribe_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($app_subscribe_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_subscribe_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_subscribe_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_subscribe_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_subscribe_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fapp_subscribelist" id="fapp_subscribelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_subscribe_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_subscribe_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_subscribe">
<div id="gmp_app_subscribe" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($app_subscribe_list->TotalRecs > 0 || $app_subscribe->CurrentAction == "add" || $app_subscribe->CurrentAction == "copy" || $app_subscribe->CurrentAction == "gridedit") { ?>
<table id="tbl_app_subscribelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$app_subscribe_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$app_subscribe_list->RenderListOptions();

// Render list options (header, left)
$app_subscribe_list->ListOptions->Render("header", "left");
?>
<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->serv_id) == "") { ?>
		<th data-name="serv_id" class="<?php echo $app_subscribe->serv_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_serv_id" class="app_subscribe_serv_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->serv_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="serv_id" class="<?php echo $app_subscribe->serv_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->serv_id) ?>',1);"><div id="elh_app_subscribe_serv_id" class="app_subscribe_serv_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->serv_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->serv_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->serv_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $app_subscribe->user_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_user_id" class="app_subscribe_user_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->user_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $app_subscribe->user_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->user_id) ?>',1);"><div id="elh_app_subscribe_user_id" class="app_subscribe_user_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->user_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->user_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->user_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->cycle_id) == "") { ?>
		<th data-name="cycle_id" class="<?php echo $app_subscribe->cycle_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_cycle_id" class="app_subscribe_cycle_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->cycle_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cycle_id" class="<?php echo $app_subscribe->cycle_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->cycle_id) ?>',1);"><div id="elh_app_subscribe_cycle_id" class="app_subscribe_cycle_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->cycle_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->cycle_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->cycle_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->book_id) == "") { ?>
		<th data-name="book_id" class="<?php echo $app_subscribe->book_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_book_id" class="app_subscribe_book_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->book_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="book_id" class="<?php echo $app_subscribe->book_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->book_id) ?>',1);"><div id="elh_app_subscribe_book_id" class="app_subscribe_book_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->book_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->book_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->book_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->tcat_id) == "") { ?>
		<th data-name="tcat_id" class="<?php echo $app_subscribe->tcat_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_tcat_id" class="app_subscribe_tcat_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->tcat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tcat_id" class="<?php echo $app_subscribe->tcat_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->tcat_id) ?>',1);"><div id="elh_app_subscribe_tcat_id" class="app_subscribe_tcat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->tcat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->tcat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->tcat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->test_id) == "") { ?>
		<th data-name="test_id" class="<?php echo $app_subscribe->test_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_test_id" class="app_subscribe_test_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->test_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="test_id" class="<?php echo $app_subscribe->test_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->test_id) ?>',1);"><div id="elh_app_subscribe_test_id" class="app_subscribe_test_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->test_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->test_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->test_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->cat_id) == "") { ?>
		<th data-name="cat_id" class="<?php echo $app_subscribe->cat_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_cat_id" class="app_subscribe_cat_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->cat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_id" class="<?php echo $app_subscribe->cat_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->cat_id) ?>',1);"><div id="elh_app_subscribe_cat_id" class="app_subscribe_cat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->cat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->cat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->cat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->cons_id) == "") { ?>
		<th data-name="cons_id" class="<?php echo $app_subscribe->cons_id->HeaderCellClass() ?>"><div id="elh_app_subscribe_cons_id" class="app_subscribe_cons_id"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->cons_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cons_id" class="<?php echo $app_subscribe->cons_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->cons_id) ?>',1);"><div id="elh_app_subscribe_cons_id" class="app_subscribe_cons_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->cons_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->cons_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->cons_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->subs_start) == "") { ?>
		<th data-name="subs_start" class="<?php echo $app_subscribe->subs_start->HeaderCellClass() ?>"><div id="elh_app_subscribe_subs_start" class="app_subscribe_subs_start"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_start->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subs_start" class="<?php echo $app_subscribe->subs_start->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->subs_start) ?>',1);"><div id="elh_app_subscribe_subs_start" class="app_subscribe_subs_start">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_start->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->subs_start->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->subs_start->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->subs_end) == "") { ?>
		<th data-name="subs_end" class="<?php echo $app_subscribe->subs_end->HeaderCellClass() ?>"><div id="elh_app_subscribe_subs_end" class="app_subscribe_subs_end"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_end->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subs_end" class="<?php echo $app_subscribe->subs_end->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->subs_end) ?>',1);"><div id="elh_app_subscribe_subs_end" class="app_subscribe_subs_end">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_end->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->subs_end->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->subs_end->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->subs_qnt) == "") { ?>
		<th data-name="subs_qnt" class="<?php echo $app_subscribe->subs_qnt->HeaderCellClass() ?>"><div id="elh_app_subscribe_subs_qnt" class="app_subscribe_subs_qnt"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_qnt->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subs_qnt" class="<?php echo $app_subscribe->subs_qnt->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->subs_qnt) ?>',1);"><div id="elh_app_subscribe_subs_qnt" class="app_subscribe_subs_qnt">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_qnt->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->subs_qnt->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->subs_qnt->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->subs_price) == "") { ?>
		<th data-name="subs_price" class="<?php echo $app_subscribe->subs_price->HeaderCellClass() ?>"><div id="elh_app_subscribe_subs_price" class="app_subscribe_subs_price"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subs_price" class="<?php echo $app_subscribe->subs_price->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->subs_price) ?>',1);"><div id="elh_app_subscribe_subs_price" class="app_subscribe_subs_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->subs_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->subs_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->subs_amt) == "") { ?>
		<th data-name="subs_amt" class="<?php echo $app_subscribe->subs_amt->HeaderCellClass() ?>"><div id="elh_app_subscribe_subs_amt" class="app_subscribe_subs_amt"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_amt->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subs_amt" class="<?php echo $app_subscribe->subs_amt->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->subs_amt) ?>',1);"><div id="elh_app_subscribe_subs_amt" class="app_subscribe_subs_amt">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->subs_amt->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->subs_amt->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->subs_amt->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
	<?php if ($app_subscribe->SortUrl($app_subscribe->ins_datetime) == "") { ?>
		<th data-name="ins_datetime" class="<?php echo $app_subscribe->ins_datetime->HeaderCellClass() ?>"><div id="elh_app_subscribe_ins_datetime" class="app_subscribe_ins_datetime"><div class="ewTableHeaderCaption"><?php echo $app_subscribe->ins_datetime->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ins_datetime" class="<?php echo $app_subscribe->ins_datetime->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $app_subscribe->SortUrl($app_subscribe->ins_datetime) ?>',1);"><div id="elh_app_subscribe_ins_datetime" class="app_subscribe_ins_datetime">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $app_subscribe->ins_datetime->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($app_subscribe->ins_datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($app_subscribe->ins_datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_subscribe_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($app_subscribe->CurrentAction == "add" || $app_subscribe->CurrentAction == "copy") {
		$app_subscribe_list->RowIndex = 0;
		$app_subscribe_list->KeyCount = $app_subscribe_list->RowIndex;
		if ($app_subscribe->CurrentAction == "copy" && !$app_subscribe_list->LoadRow())
			$app_subscribe->CurrentAction = "add";
		if ($app_subscribe->CurrentAction == "add")
			$app_subscribe_list->LoadRowValues();
		if ($app_subscribe->EventCancelled) // Insert failed
			$app_subscribe_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$app_subscribe->ResetAttrs();
		$app_subscribe->RowAttrs = array_merge($app_subscribe->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_app_subscribe', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$app_subscribe->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_subscribe_list->RenderRow();

		// Render list options
		$app_subscribe_list->RenderListOptions();
		$app_subscribe_list->StartRowCnt = 0;
?>
	<tr<?php echo $app_subscribe->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_subscribe_list->ListOptions->Render("body", "left", $app_subscribe_list->RowCnt);
?>
	<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
		<td data-name="serv_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_serv_id" class="form-group app_subscribe_serv_id">
<select data-table="app_subscribe" data-field="x_serv_id" data-value-separator="<?php echo $app_subscribe->serv_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id"<?php echo $app_subscribe->serv_id->EditAttributes() ?>>
<?php echo $app_subscribe->serv_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_serv_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_serv_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_serv_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_serv_id" value="<?php echo ew_HtmlEncode($app_subscribe->serv_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_user_id" class="form-group app_subscribe_user_id">
<select data-table="app_subscribe" data-field="x_user_id" data-value-separator="<?php echo $app_subscribe->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_user_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_user_id"<?php echo $app_subscribe->user_id->EditAttributes() ?>>
<?php echo $app_subscribe->user_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_user_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_user_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_user_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_subscribe->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
		<td data-name="cycle_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cycle_id" class="form-group app_subscribe_cycle_id">
<select data-table="app_subscribe" data-field="x_cycle_id" data-value-separator="<?php echo $app_subscribe->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id"<?php echo $app_subscribe->cycle_id->EditAttributes() ?>>
<?php echo $app_subscribe->cycle_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cycle_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" value="<?php echo ew_HtmlEncode($app_subscribe->cycle_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
		<td data-name="book_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_book_id" class="form-group app_subscribe_book_id">
<select data-table="app_subscribe" data-field="x_book_id" data-value-separator="<?php echo $app_subscribe->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_book_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_book_id"<?php echo $app_subscribe->book_id->EditAttributes() ?>>
<?php echo $app_subscribe->book_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_book_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_book_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_book_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_subscribe->book_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_tcat_id" class="form-group app_subscribe_tcat_id">
<select data-table="app_subscribe" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id"<?php echo $app_subscribe->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_tcat_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe->tcat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_test_id" class="form-group app_subscribe_test_id">
<select data-table="app_subscribe" data-field="x_test_id" data-value-separator="<?php echo $app_subscribe->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_test_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_test_id"<?php echo $app_subscribe->test_id->EditAttributes() ?>>
<?php echo $app_subscribe->test_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_test_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_test_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_test_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_subscribe->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
		<td data-name="cat_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cat_id" class="form-group app_subscribe_cat_id">
<select data-table="app_subscribe" data-field="x_cat_id" data-value-separator="<?php echo $app_subscribe->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id"<?php echo $app_subscribe->cat_id->EditAttributes() ?>>
<?php echo $app_subscribe->cat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cat_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cat_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_subscribe->cat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
		<td data-name="cons_id">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cons_id" class="form-group app_subscribe_cons_id">
<select data-table="app_subscribe" data-field="x_cons_id" data-value-separator="<?php echo $app_subscribe->cons_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id"<?php echo $app_subscribe->cons_id->EditAttributes() ?>>
<?php echo $app_subscribe->cons_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cons_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cons_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cons_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_subscribe->cons_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
		<td data-name="subs_start">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_start" class="form-group app_subscribe_subs_start">
<input type="text" data-table="app_subscribe" data-field="x_subs_start" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_start->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_start->EditValue ?>"<?php echo $app_subscribe->subs_start->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_start->ReadOnly && !$app_subscribe->subs_start->Disabled && !isset($app_subscribe->subs_start->EditAttrs["readonly"]) && !isset($app_subscribe->subs_start->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_start" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_start" value="<?php echo ew_HtmlEncode($app_subscribe->subs_start->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
		<td data-name="subs_end">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_end" class="form-group app_subscribe_subs_end">
<input type="text" data-table="app_subscribe" data-field="x_subs_end" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_end->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_end->EditValue ?>"<?php echo $app_subscribe->subs_end->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_end->ReadOnly && !$app_subscribe->subs_end->Disabled && !isset($app_subscribe->subs_end->EditAttrs["readonly"]) && !isset($app_subscribe->subs_end->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_end" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_end" value="<?php echo ew_HtmlEncode($app_subscribe->subs_end->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
		<td data-name="subs_qnt">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_qnt" class="form-group app_subscribe_subs_qnt">
<input type="text" data-table="app_subscribe" data-field="x_subs_qnt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_qnt->EditValue ?>"<?php echo $app_subscribe->subs_qnt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_qnt" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" value="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
		<td data-name="subs_price">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_price" class="form-group app_subscribe_subs_price">
<input type="text" data-table="app_subscribe" data-field="x_subs_price" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_price->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_price->EditValue ?>"<?php echo $app_subscribe->subs_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_price" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_price" value="<?php echo ew_HtmlEncode($app_subscribe->subs_price->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
		<td data-name="subs_amt">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_amt" class="form-group app_subscribe_subs_amt">
<input type="text" data-table="app_subscribe" data-field="x_subs_amt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_amt->EditValue ?>"<?php echo $app_subscribe->subs_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_amt" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" value="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime">
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_ins_datetime" class="form-group app_subscribe_ins_datetime">
<input type="text" data-table="app_subscribe" data-field="x_ins_datetime" name="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->ins_datetime->EditValue ?>"<?php echo $app_subscribe->ins_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_ins_datetime" name="o<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="o<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_subscribe_list->ListOptions->Render("body", "right", $app_subscribe_list->RowCnt);
?>
<script type="text/javascript">
fapp_subscribelist.UpdateOpts(<?php echo $app_subscribe_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($app_subscribe->ExportAll && $app_subscribe->Export <> "") {
	$app_subscribe_list->StopRec = $app_subscribe_list->TotalRecs;
} else {

	// Set the last record to display
	if ($app_subscribe_list->TotalRecs > $app_subscribe_list->StartRec + $app_subscribe_list->DisplayRecs - 1)
		$app_subscribe_list->StopRec = $app_subscribe_list->StartRec + $app_subscribe_list->DisplayRecs - 1;
	else
		$app_subscribe_list->StopRec = $app_subscribe_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($app_subscribe_list->FormKeyCountName) && ($app_subscribe->CurrentAction == "gridadd" || $app_subscribe->CurrentAction == "gridedit" || $app_subscribe->CurrentAction == "F")) {
		$app_subscribe_list->KeyCount = $objForm->GetValue($app_subscribe_list->FormKeyCountName);
		$app_subscribe_list->StopRec = $app_subscribe_list->StartRec + $app_subscribe_list->KeyCount - 1;
	}
}
$app_subscribe_list->RecCnt = $app_subscribe_list->StartRec - 1;
if ($app_subscribe_list->Recordset && !$app_subscribe_list->Recordset->EOF) {
	$app_subscribe_list->Recordset->MoveFirst();
	$bSelectLimit = $app_subscribe_list->UseSelectLimit;
	if (!$bSelectLimit && $app_subscribe_list->StartRec > 1)
		$app_subscribe_list->Recordset->Move($app_subscribe_list->StartRec - 1);
} elseif (!$app_subscribe->AllowAddDeleteRow && $app_subscribe_list->StopRec == 0) {
	$app_subscribe_list->StopRec = $app_subscribe->GridAddRowCount;
}

// Initialize aggregate
$app_subscribe->RowType = EW_ROWTYPE_AGGREGATEINIT;
$app_subscribe->ResetAttrs();
$app_subscribe_list->RenderRow();
$app_subscribe_list->EditRowCnt = 0;
if ($app_subscribe->CurrentAction == "edit")
	$app_subscribe_list->RowIndex = 1;
if ($app_subscribe->CurrentAction == "gridadd")
	$app_subscribe_list->RowIndex = 0;
if ($app_subscribe->CurrentAction == "gridedit")
	$app_subscribe_list->RowIndex = 0;
while ($app_subscribe_list->RecCnt < $app_subscribe_list->StopRec) {
	$app_subscribe_list->RecCnt++;
	if (intval($app_subscribe_list->RecCnt) >= intval($app_subscribe_list->StartRec)) {
		$app_subscribe_list->RowCnt++;
		if ($app_subscribe->CurrentAction == "gridadd" || $app_subscribe->CurrentAction == "gridedit" || $app_subscribe->CurrentAction == "F") {
			$app_subscribe_list->RowIndex++;
			$objForm->Index = $app_subscribe_list->RowIndex;
			if ($objForm->HasValue($app_subscribe_list->FormActionName))
				$app_subscribe_list->RowAction = strval($objForm->GetValue($app_subscribe_list->FormActionName));
			elseif ($app_subscribe->CurrentAction == "gridadd")
				$app_subscribe_list->RowAction = "insert";
			else
				$app_subscribe_list->RowAction = "";
		}

		// Set up key count
		$app_subscribe_list->KeyCount = $app_subscribe_list->RowIndex;

		// Init row class and style
		$app_subscribe->ResetAttrs();
		$app_subscribe->CssClass = "";
		if ($app_subscribe->CurrentAction == "gridadd") {
			$app_subscribe_list->LoadRowValues(); // Load default values
		} else {
			$app_subscribe_list->LoadRowValues($app_subscribe_list->Recordset); // Load row values
		}
		$app_subscribe->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($app_subscribe->CurrentAction == "gridadd") // Grid add
			$app_subscribe->RowType = EW_ROWTYPE_ADD; // Render add
		if ($app_subscribe->CurrentAction == "gridadd" && $app_subscribe->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$app_subscribe_list->RestoreCurrentRowFormValues($app_subscribe_list->RowIndex); // Restore form values
		if ($app_subscribe->CurrentAction == "edit") {
			if ($app_subscribe_list->CheckInlineEditKey() && $app_subscribe_list->EditRowCnt == 0) { // Inline edit
				$app_subscribe->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($app_subscribe->CurrentAction == "gridedit") { // Grid edit
			if ($app_subscribe->EventCancelled) {
				$app_subscribe_list->RestoreCurrentRowFormValues($app_subscribe_list->RowIndex); // Restore form values
			}
			if ($app_subscribe_list->RowAction == "insert")
				$app_subscribe->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$app_subscribe->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($app_subscribe->CurrentAction == "edit" && $app_subscribe->RowType == EW_ROWTYPE_EDIT && $app_subscribe->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$app_subscribe_list->RestoreFormValues(); // Restore form values
		}
		if ($app_subscribe->CurrentAction == "gridedit" && ($app_subscribe->RowType == EW_ROWTYPE_EDIT || $app_subscribe->RowType == EW_ROWTYPE_ADD) && $app_subscribe->EventCancelled) // Update failed
			$app_subscribe_list->RestoreCurrentRowFormValues($app_subscribe_list->RowIndex); // Restore form values
		if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) // Edit row
			$app_subscribe_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$app_subscribe->RowAttrs = array_merge($app_subscribe->RowAttrs, array('data-rowindex'=>$app_subscribe_list->RowCnt, 'id'=>'r' . $app_subscribe_list->RowCnt . '_app_subscribe', 'data-rowtype'=>$app_subscribe->RowType));

		// Render row
		$app_subscribe_list->RenderRow();

		// Render list options
		$app_subscribe_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($app_subscribe_list->RowAction <> "delete" && $app_subscribe_list->RowAction <> "insertdelete" && !($app_subscribe_list->RowAction == "insert" && $app_subscribe->CurrentAction == "F" && $app_subscribe_list->EmptyRow())) {
?>
	<tr<?php echo $app_subscribe->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_subscribe_list->ListOptions->Render("body", "left", $app_subscribe_list->RowCnt);
?>
	<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
		<td data-name="serv_id"<?php echo $app_subscribe->serv_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_serv_id" class="form-group app_subscribe_serv_id">
<select data-table="app_subscribe" data-field="x_serv_id" data-value-separator="<?php echo $app_subscribe->serv_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id"<?php echo $app_subscribe->serv_id->EditAttributes() ?>>
<?php echo $app_subscribe->serv_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_serv_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_serv_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_serv_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_serv_id" value="<?php echo ew_HtmlEncode($app_subscribe->serv_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_serv_id" class="form-group app_subscribe_serv_id">
<select data-table="app_subscribe" data-field="x_serv_id" data-value-separator="<?php echo $app_subscribe->serv_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id"<?php echo $app_subscribe->serv_id->EditAttributes() ?>>
<?php echo $app_subscribe->serv_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_serv_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_serv_id" class="app_subscribe_serv_id">
<span<?php echo $app_subscribe->serv_id->ViewAttributes() ?>>
<?php echo $app_subscribe->serv_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_id" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_id" value="<?php echo ew_HtmlEncode($app_subscribe->subs_id->CurrentValue) ?>">
<input type="hidden" data-table="app_subscribe" data-field="x_subs_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_id" value="<?php echo ew_HtmlEncode($app_subscribe->subs_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT || $app_subscribe->CurrentMode == "edit") { ?>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_id" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_id" value="<?php echo ew_HtmlEncode($app_subscribe->subs_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $app_subscribe->user_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_user_id" class="form-group app_subscribe_user_id">
<select data-table="app_subscribe" data-field="x_user_id" data-value-separator="<?php echo $app_subscribe->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_user_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_user_id"<?php echo $app_subscribe->user_id->EditAttributes() ?>>
<?php echo $app_subscribe->user_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_user_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_user_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_user_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_subscribe->user_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_user_id" class="form-group app_subscribe_user_id">
<select data-table="app_subscribe" data-field="x_user_id" data-value-separator="<?php echo $app_subscribe->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_user_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_user_id"<?php echo $app_subscribe->user_id->EditAttributes() ?>>
<?php echo $app_subscribe->user_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_user_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_user_id" class="app_subscribe_user_id">
<span<?php echo $app_subscribe->user_id->ViewAttributes() ?>>
<?php echo $app_subscribe->user_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
		<td data-name="cycle_id"<?php echo $app_subscribe->cycle_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cycle_id" class="form-group app_subscribe_cycle_id">
<select data-table="app_subscribe" data-field="x_cycle_id" data-value-separator="<?php echo $app_subscribe->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id"<?php echo $app_subscribe->cycle_id->EditAttributes() ?>>
<?php echo $app_subscribe->cycle_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cycle_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" value="<?php echo ew_HtmlEncode($app_subscribe->cycle_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cycle_id" class="form-group app_subscribe_cycle_id">
<select data-table="app_subscribe" data-field="x_cycle_id" data-value-separator="<?php echo $app_subscribe->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id"<?php echo $app_subscribe->cycle_id->EditAttributes() ?>>
<?php echo $app_subscribe->cycle_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cycle_id" class="app_subscribe_cycle_id">
<span<?php echo $app_subscribe->cycle_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cycle_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
		<td data-name="book_id"<?php echo $app_subscribe->book_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_book_id" class="form-group app_subscribe_book_id">
<select data-table="app_subscribe" data-field="x_book_id" data-value-separator="<?php echo $app_subscribe->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_book_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_book_id"<?php echo $app_subscribe->book_id->EditAttributes() ?>>
<?php echo $app_subscribe->book_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_book_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_book_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_book_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_subscribe->book_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_book_id" class="form-group app_subscribe_book_id">
<select data-table="app_subscribe" data-field="x_book_id" data-value-separator="<?php echo $app_subscribe->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_book_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_book_id"<?php echo $app_subscribe->book_id->EditAttributes() ?>>
<?php echo $app_subscribe->book_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_book_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_book_id" class="app_subscribe_book_id">
<span<?php echo $app_subscribe->book_id->ViewAttributes() ?>>
<?php echo $app_subscribe->book_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id"<?php echo $app_subscribe->tcat_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_tcat_id" class="form-group app_subscribe_tcat_id">
<select data-table="app_subscribe" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id"<?php echo $app_subscribe->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_tcat_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe->tcat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_tcat_id" class="form-group app_subscribe_tcat_id">
<select data-table="app_subscribe" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id"<?php echo $app_subscribe->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_tcat_id" class="app_subscribe_tcat_id">
<span<?php echo $app_subscribe->tcat_id->ViewAttributes() ?>>
<?php echo $app_subscribe->tcat_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
		<td data-name="test_id"<?php echo $app_subscribe->test_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_test_id" class="form-group app_subscribe_test_id">
<select data-table="app_subscribe" data-field="x_test_id" data-value-separator="<?php echo $app_subscribe->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_test_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_test_id"<?php echo $app_subscribe->test_id->EditAttributes() ?>>
<?php echo $app_subscribe->test_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_test_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_test_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_test_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_subscribe->test_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_test_id" class="form-group app_subscribe_test_id">
<select data-table="app_subscribe" data-field="x_test_id" data-value-separator="<?php echo $app_subscribe->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_test_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_test_id"<?php echo $app_subscribe->test_id->EditAttributes() ?>>
<?php echo $app_subscribe->test_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_test_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_test_id" class="app_subscribe_test_id">
<span<?php echo $app_subscribe->test_id->ViewAttributes() ?>>
<?php echo $app_subscribe->test_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
		<td data-name="cat_id"<?php echo $app_subscribe->cat_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cat_id" class="form-group app_subscribe_cat_id">
<select data-table="app_subscribe" data-field="x_cat_id" data-value-separator="<?php echo $app_subscribe->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id"<?php echo $app_subscribe->cat_id->EditAttributes() ?>>
<?php echo $app_subscribe->cat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cat_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cat_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_subscribe->cat_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cat_id" class="form-group app_subscribe_cat_id">
<select data-table="app_subscribe" data-field="x_cat_id" data-value-separator="<?php echo $app_subscribe->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id"<?php echo $app_subscribe->cat_id->EditAttributes() ?>>
<?php echo $app_subscribe->cat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cat_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cat_id" class="app_subscribe_cat_id">
<span<?php echo $app_subscribe->cat_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cat_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
		<td data-name="cons_id"<?php echo $app_subscribe->cons_id->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cons_id" class="form-group app_subscribe_cons_id">
<select data-table="app_subscribe" data-field="x_cons_id" data-value-separator="<?php echo $app_subscribe->cons_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id"<?php echo $app_subscribe->cons_id->EditAttributes() ?>>
<?php echo $app_subscribe->cons_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cons_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cons_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cons_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_subscribe->cons_id->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cons_id" class="form-group app_subscribe_cons_id">
<select data-table="app_subscribe" data-field="x_cons_id" data-value-separator="<?php echo $app_subscribe->cons_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id"<?php echo $app_subscribe->cons_id->EditAttributes() ?>>
<?php echo $app_subscribe->cons_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cons_id") ?>
</select>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_cons_id" class="app_subscribe_cons_id">
<span<?php echo $app_subscribe->cons_id->ViewAttributes() ?>>
<?php echo $app_subscribe->cons_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
		<td data-name="subs_start"<?php echo $app_subscribe->subs_start->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_start" class="form-group app_subscribe_subs_start">
<input type="text" data-table="app_subscribe" data-field="x_subs_start" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_start->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_start->EditValue ?>"<?php echo $app_subscribe->subs_start->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_start->ReadOnly && !$app_subscribe->subs_start->Disabled && !isset($app_subscribe->subs_start->EditAttrs["readonly"]) && !isset($app_subscribe->subs_start->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_start" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_start" value="<?php echo ew_HtmlEncode($app_subscribe->subs_start->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_start" class="form-group app_subscribe_subs_start">
<input type="text" data-table="app_subscribe" data-field="x_subs_start" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_start->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_start->EditValue ?>"<?php echo $app_subscribe->subs_start->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_start->ReadOnly && !$app_subscribe->subs_start->Disabled && !isset($app_subscribe->subs_start->EditAttrs["readonly"]) && !isset($app_subscribe->subs_start->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_start" class="app_subscribe_subs_start">
<span<?php echo $app_subscribe->subs_start->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_start->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
		<td data-name="subs_end"<?php echo $app_subscribe->subs_end->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_end" class="form-group app_subscribe_subs_end">
<input type="text" data-table="app_subscribe" data-field="x_subs_end" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_end->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_end->EditValue ?>"<?php echo $app_subscribe->subs_end->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_end->ReadOnly && !$app_subscribe->subs_end->Disabled && !isset($app_subscribe->subs_end->EditAttrs["readonly"]) && !isset($app_subscribe->subs_end->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_end" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_end" value="<?php echo ew_HtmlEncode($app_subscribe->subs_end->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_end" class="form-group app_subscribe_subs_end">
<input type="text" data-table="app_subscribe" data-field="x_subs_end" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_end->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_end->EditValue ?>"<?php echo $app_subscribe->subs_end->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_end->ReadOnly && !$app_subscribe->subs_end->Disabled && !isset($app_subscribe->subs_end->EditAttrs["readonly"]) && !isset($app_subscribe->subs_end->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_end" class="app_subscribe_subs_end">
<span<?php echo $app_subscribe->subs_end->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_end->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
		<td data-name="subs_qnt"<?php echo $app_subscribe->subs_qnt->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_qnt" class="form-group app_subscribe_subs_qnt">
<input type="text" data-table="app_subscribe" data-field="x_subs_qnt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_qnt->EditValue ?>"<?php echo $app_subscribe->subs_qnt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_qnt" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" value="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_qnt" class="form-group app_subscribe_subs_qnt">
<input type="text" data-table="app_subscribe" data-field="x_subs_qnt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_qnt->EditValue ?>"<?php echo $app_subscribe->subs_qnt->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_qnt" class="app_subscribe_subs_qnt">
<span<?php echo $app_subscribe->subs_qnt->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_qnt->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
		<td data-name="subs_price"<?php echo $app_subscribe->subs_price->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_price" class="form-group app_subscribe_subs_price">
<input type="text" data-table="app_subscribe" data-field="x_subs_price" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_price->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_price->EditValue ?>"<?php echo $app_subscribe->subs_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_price" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_price" value="<?php echo ew_HtmlEncode($app_subscribe->subs_price->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_price" class="form-group app_subscribe_subs_price">
<input type="text" data-table="app_subscribe" data-field="x_subs_price" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_price->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_price->EditValue ?>"<?php echo $app_subscribe->subs_price->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_price" class="app_subscribe_subs_price">
<span<?php echo $app_subscribe->subs_price->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_price->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
		<td data-name="subs_amt"<?php echo $app_subscribe->subs_amt->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_amt" class="form-group app_subscribe_subs_amt">
<input type="text" data-table="app_subscribe" data-field="x_subs_amt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_amt->EditValue ?>"<?php echo $app_subscribe->subs_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_amt" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" value="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_amt" class="form-group app_subscribe_subs_amt">
<input type="text" data-table="app_subscribe" data-field="x_subs_amt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_amt->EditValue ?>"<?php echo $app_subscribe->subs_amt->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_subs_amt" class="app_subscribe_subs_amt">
<span<?php echo $app_subscribe->subs_amt->ViewAttributes() ?>>
<?php echo $app_subscribe->subs_amt->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime"<?php echo $app_subscribe->ins_datetime->CellAttributes() ?>>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_ins_datetime" class="form-group app_subscribe_ins_datetime">
<input type="text" data-table="app_subscribe" data-field="x_ins_datetime" name="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->ins_datetime->EditValue ?>"<?php echo $app_subscribe->ins_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_ins_datetime" name="o<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="o<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->OldValue) ?>">
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_ins_datetime" class="form-group app_subscribe_ins_datetime">
<input type="text" data-table="app_subscribe" data-field="x_ins_datetime" name="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->ins_datetime->EditValue ?>"<?php echo $app_subscribe->ins_datetime->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $app_subscribe_list->RowCnt ?>_app_subscribe_ins_datetime" class="app_subscribe_ins_datetime">
<span<?php echo $app_subscribe->ins_datetime->ViewAttributes() ?>>
<?php echo $app_subscribe->ins_datetime->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_subscribe_list->ListOptions->Render("body", "right", $app_subscribe_list->RowCnt);
?>
	</tr>
<?php if ($app_subscribe->RowType == EW_ROWTYPE_ADD || $app_subscribe->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fapp_subscribelist.UpdateOpts(<?php echo $app_subscribe_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($app_subscribe->CurrentAction <> "gridadd")
		if (!$app_subscribe_list->Recordset->EOF) $app_subscribe_list->Recordset->MoveNext();
}
?>
<?php
	if ($app_subscribe->CurrentAction == "gridadd" || $app_subscribe->CurrentAction == "gridedit") {
		$app_subscribe_list->RowIndex = '$rowindex$';
		$app_subscribe_list->LoadRowValues();

		// Set row properties
		$app_subscribe->ResetAttrs();
		$app_subscribe->RowAttrs = array_merge($app_subscribe->RowAttrs, array('data-rowindex'=>$app_subscribe_list->RowIndex, 'id'=>'r0_app_subscribe', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($app_subscribe->RowAttrs["class"], "ewTemplate");
		$app_subscribe->RowType = EW_ROWTYPE_ADD;

		// Render row
		$app_subscribe_list->RenderRow();

		// Render list options
		$app_subscribe_list->RenderListOptions();
		$app_subscribe_list->StartRowCnt = 0;
?>
	<tr<?php echo $app_subscribe->RowAttributes() ?>>
<?php

// Render list options (body, left)
$app_subscribe_list->ListOptions->Render("body", "left", $app_subscribe_list->RowIndex);
?>
	<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
		<td data-name="serv_id">
<span id="el$rowindex$_app_subscribe_serv_id" class="form-group app_subscribe_serv_id">
<select data-table="app_subscribe" data-field="x_serv_id" data-value-separator="<?php echo $app_subscribe->serv_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_serv_id"<?php echo $app_subscribe->serv_id->EditAttributes() ?>>
<?php echo $app_subscribe->serv_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_serv_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_serv_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_serv_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_serv_id" value="<?php echo ew_HtmlEncode($app_subscribe->serv_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<span id="el$rowindex$_app_subscribe_user_id" class="form-group app_subscribe_user_id">
<select data-table="app_subscribe" data-field="x_user_id" data-value-separator="<?php echo $app_subscribe->user_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_user_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_user_id"<?php echo $app_subscribe->user_id->EditAttributes() ?>>
<?php echo $app_subscribe->user_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_user_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_user_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_user_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_user_id" value="<?php echo ew_HtmlEncode($app_subscribe->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
		<td data-name="cycle_id">
<span id="el$rowindex$_app_subscribe_cycle_id" class="form-group app_subscribe_cycle_id">
<select data-table="app_subscribe" data-field="x_cycle_id" data-value-separator="<?php echo $app_subscribe->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id"<?php echo $app_subscribe->cycle_id->EditAttributes() ?>>
<?php echo $app_subscribe->cycle_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cycle_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cycle_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cycle_id" value="<?php echo ew_HtmlEncode($app_subscribe->cycle_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
		<td data-name="book_id">
<span id="el$rowindex$_app_subscribe_book_id" class="form-group app_subscribe_book_id">
<select data-table="app_subscribe" data-field="x_book_id" data-value-separator="<?php echo $app_subscribe->book_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_book_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_book_id"<?php echo $app_subscribe->book_id->EditAttributes() ?>>
<?php echo $app_subscribe->book_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_book_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_book_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_book_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_book_id" value="<?php echo ew_HtmlEncode($app_subscribe->book_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
		<td data-name="tcat_id">
<span id="el$rowindex$_app_subscribe_tcat_id" class="form-group app_subscribe_tcat_id">
<select data-table="app_subscribe" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id"<?php echo $app_subscribe->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe->tcat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_tcat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_tcat_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_tcat_id" value="<?php echo ew_HtmlEncode($app_subscribe->tcat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
		<td data-name="test_id">
<span id="el$rowindex$_app_subscribe_test_id" class="form-group app_subscribe_test_id">
<select data-table="app_subscribe" data-field="x_test_id" data-value-separator="<?php echo $app_subscribe->test_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_test_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_test_id"<?php echo $app_subscribe->test_id->EditAttributes() ?>>
<?php echo $app_subscribe->test_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_test_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_test_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_test_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_test_id" value="<?php echo ew_HtmlEncode($app_subscribe->test_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
		<td data-name="cat_id">
<span id="el$rowindex$_app_subscribe_cat_id" class="form-group app_subscribe_cat_id">
<select data-table="app_subscribe" data-field="x_cat_id" data-value-separator="<?php echo $app_subscribe->cat_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cat_id"<?php echo $app_subscribe->cat_id->EditAttributes() ?>>
<?php echo $app_subscribe->cat_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cat_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cat_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cat_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cat_id" value="<?php echo ew_HtmlEncode($app_subscribe->cat_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
		<td data-name="cons_id">
<span id="el$rowindex$_app_subscribe_cons_id" class="form-group app_subscribe_cons_id">
<select data-table="app_subscribe" data-field="x_cons_id" data-value-separator="<?php echo $app_subscribe->cons_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id" name="x<?php echo $app_subscribe_list->RowIndex ?>_cons_id"<?php echo $app_subscribe->cons_id->EditAttributes() ?>>
<?php echo $app_subscribe->cons_id->SelectOptionListHtml("x<?php echo $app_subscribe_list->RowIndex ?>_cons_id") ?>
</select>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_cons_id" name="o<?php echo $app_subscribe_list->RowIndex ?>_cons_id" id="o<?php echo $app_subscribe_list->RowIndex ?>_cons_id" value="<?php echo ew_HtmlEncode($app_subscribe->cons_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
		<td data-name="subs_start">
<span id="el$rowindex$_app_subscribe_subs_start" class="form-group app_subscribe_subs_start">
<input type="text" data-table="app_subscribe" data-field="x_subs_start" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_start" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_start->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_start->EditValue ?>"<?php echo $app_subscribe->subs_start->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_start->ReadOnly && !$app_subscribe->subs_start->Disabled && !isset($app_subscribe->subs_start->EditAttrs["readonly"]) && !isset($app_subscribe->subs_start->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_start" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_start" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_start" value="<?php echo ew_HtmlEncode($app_subscribe->subs_start->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
		<td data-name="subs_end">
<span id="el$rowindex$_app_subscribe_subs_end" class="form-group app_subscribe_subs_end">
<input type="text" data-table="app_subscribe" data-field="x_subs_end" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_end" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_end->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_end->EditValue ?>"<?php echo $app_subscribe->subs_end->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_end->ReadOnly && !$app_subscribe->subs_end->Disabled && !isset($app_subscribe->subs_end->EditAttrs["readonly"]) && !isset($app_subscribe->subs_end->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribelist", "x<?php echo $app_subscribe_list->RowIndex ?>_subs_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_end" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_end" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_end" value="<?php echo ew_HtmlEncode($app_subscribe->subs_end->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
		<td data-name="subs_qnt">
<span id="el$rowindex$_app_subscribe_subs_qnt" class="form-group app_subscribe_subs_qnt">
<input type="text" data-table="app_subscribe" data-field="x_subs_qnt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_qnt->EditValue ?>"<?php echo $app_subscribe->subs_qnt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_qnt" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_qnt" value="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
		<td data-name="subs_price">
<span id="el$rowindex$_app_subscribe_subs_price" class="form-group app_subscribe_subs_price">
<input type="text" data-table="app_subscribe" data-field="x_subs_price" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_price->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_price->EditValue ?>"<?php echo $app_subscribe->subs_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_price" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_price" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_price" value="<?php echo ew_HtmlEncode($app_subscribe->subs_price->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
		<td data-name="subs_amt">
<span id="el$rowindex$_app_subscribe_subs_amt" class="form-group app_subscribe_subs_amt">
<input type="text" data-table="app_subscribe" data-field="x_subs_amt" name="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="x<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_amt->EditValue ?>"<?php echo $app_subscribe->subs_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_subs_amt" name="o<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" id="o<?php echo $app_subscribe_list->RowIndex ?>_subs_amt" value="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
		<td data-name="ins_datetime">
<span id="el$rowindex$_app_subscribe_ins_datetime" class="form-group app_subscribe_ins_datetime">
<input type="text" data-table="app_subscribe" data-field="x_ins_datetime" name="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="x<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->ins_datetime->EditValue ?>"<?php echo $app_subscribe->ins_datetime->EditAttributes() ?>>
</span>
<input type="hidden" data-table="app_subscribe" data-field="x_ins_datetime" name="o<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" id="o<?php echo $app_subscribe_list->RowIndex ?>_ins_datetime" value="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_subscribe_list->ListOptions->Render("body", "right", $app_subscribe_list->RowIndex);
?>
<script type="text/javascript">
fapp_subscribelist.UpdateOpts(<?php echo $app_subscribe_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($app_subscribe->CurrentAction == "add" || $app_subscribe->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $app_subscribe_list->FormKeyCountName ?>" id="<?php echo $app_subscribe_list->FormKeyCountName ?>" value="<?php echo $app_subscribe_list->KeyCount ?>">
<?php } ?>
<?php if ($app_subscribe->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $app_subscribe_list->FormKeyCountName ?>" id="<?php echo $app_subscribe_list->FormKeyCountName ?>" value="<?php echo $app_subscribe_list->KeyCount ?>">
<?php echo $app_subscribe_list->MultiSelectKey ?>
<?php } ?>
<?php if ($app_subscribe->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $app_subscribe_list->FormKeyCountName ?>" id="<?php echo $app_subscribe_list->FormKeyCountName ?>" value="<?php echo $app_subscribe_list->KeyCount ?>">
<?php } ?>
<?php if ($app_subscribe->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $app_subscribe_list->FormKeyCountName ?>" id="<?php echo $app_subscribe_list->FormKeyCountName ?>" value="<?php echo $app_subscribe_list->KeyCount ?>">
<?php echo $app_subscribe_list->MultiSelectKey ?>
<?php } ?>
<?php if ($app_subscribe->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($app_subscribe_list->Recordset)
	$app_subscribe_list->Recordset->Close();
?>
<?php if ($app_subscribe->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($app_subscribe->CurrentAction <> "gridadd" && $app_subscribe->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_subscribe_list->Pager)) $app_subscribe_list->Pager = new cPrevNextPager($app_subscribe_list->StartRec, $app_subscribe_list->DisplayRecs, $app_subscribe_list->TotalRecs, $app_subscribe_list->AutoHidePager) ?>
<?php if ($app_subscribe_list->Pager->RecordCount > 0 && $app_subscribe_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_subscribe_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_subscribe_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_subscribe_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_subscribe_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_subscribe_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_subscribe_list->PageUrl() ?>start=<?php echo $app_subscribe_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_subscribe_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($app_subscribe_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_subscribe_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_subscribe_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_subscribe_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_subscribe_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($app_subscribe_list->TotalRecs == 0 && $app_subscribe->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($app_subscribe_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($app_subscribe->Export == "") { ?>
<script type="text/javascript">
fapp_subscribelistsrch.FilterList = <?php echo $app_subscribe_list->GetFilterList() ?>;
fapp_subscribelistsrch.Init();
fapp_subscribelist.Init();
</script>
<?php } ?>
<?php
$app_subscribe_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($app_subscribe->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$app_subscribe_list->Page_Terminate();
?>
