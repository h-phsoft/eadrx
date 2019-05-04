<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_slider_trninfo.php" ?>
<?php include_once "cpy_slider_mstinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_slider_trn_list = NULL; // Initialize page object first

class ccpy_slider_trn_list extends ccpy_slider_trn {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_slider_trn';

	// Page object name
	var $PageObjName = 'cpy_slider_trn_list';

	// Grid form hidden field names
	var $FormName = 'fcpy_slider_trnlist';
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

		// Table object (cpy_slider_trn)
		if (!isset($GLOBALS["cpy_slider_trn"]) || get_class($GLOBALS["cpy_slider_trn"]) == "ccpy_slider_trn") {
			$GLOBALS["cpy_slider_trn"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_slider_trn"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cpy_slider_trnadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cpy_slider_trndelete.php";
		$this->MultiUpdateUrl = "cpy_slider_trnupdate.php";

		// Table object (cpy_slider_mst)
		if (!isset($GLOBALS['cpy_slider_mst'])) $GLOBALS['cpy_slider_mst'] = new ccpy_slider_mst();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_slider_trn', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fcpy_slider_trnlistsrch";

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
		$this->slid_id->SetVisibility();
		$this->slid_order->SetVisibility();
		$this->slid_header->SetVisibility();
		$this->slid_link->SetVisibility();
		$this->slid_label->SetVisibility();
		$this->slid_photo->SetVisibility();
		$this->slid_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_slider_trn;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_slider_trn);
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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cpy_slider_mst") {
			global $cpy_slider_mst;
			$rsmaster = $cpy_slider_mst->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cpy_slider_mstlist.php"); // Return to master page
			} else {
				$cpy_slider_mst->LoadListRowValues($rsmaster);
				$cpy_slider_mst->RowType = EW_ROWTYPE_MASTER; // Master row
				$cpy_slider_mst->RenderListRow();
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
		$this->setKey("tslid_id", ""); // Clear inline edit key
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
		if (isset($_GET["tslid_id"])) {
			$this->tslid_id->setQueryStringValue($_GET["tslid_id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("tslid_id", $this->tslid_id->CurrentValue); // Set up inline edit key
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
		if (strval($this->getKey("tslid_id")) <> strval($this->tslid_id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		if ($this->CurrentAction == "copy") {
			if (@$_GET["tslid_id"] <> "") {
				$this->tslid_id->setQueryStringValue($_GET["tslid_id"]);
				$this->setKey("tslid_id", $this->tslid_id->CurrentValue); // Set up key
			} else {
				$this->setKey("tslid_id", ""); // Clear key
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
			$this->tslid_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->tslid_id->FormValue))
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
					$sKey .= $this->tslid_id->CurrentValue;

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
		if ($objForm->HasValue("x_slid_id") && $objForm->HasValue("o_slid_id") && $this->slid_id->CurrentValue <> $this->slid_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_slid_order") && $objForm->HasValue("o_slid_order") && $this->slid_order->CurrentValue <> $this->slid_order->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_slid_header") && $objForm->HasValue("o_slid_header") && $this->slid_header->CurrentValue <> $this->slid_header->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_slid_link") && $objForm->HasValue("o_slid_link") && $this->slid_link->CurrentValue <> $this->slid_link->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_slid_label") && $objForm->HasValue("o_slid_label") && $this->slid_label->CurrentValue <> $this->slid_label->OldValue)
			return FALSE;
		if (!ew_Empty($this->slid_photo->Upload->Value))
			return FALSE;
		if ($objForm->HasValue("x_slid_text") && $objForm->HasValue("o_slid_text") && $this->slid_text->CurrentValue <> $this->slid_text->OldValue)
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
		$sFilterList = ew_Concat($sFilterList, $this->slid_id->AdvancedSearch->ToJson(), ","); // Field slid_id
		$sFilterList = ew_Concat($sFilterList, $this->slid_order->AdvancedSearch->ToJson(), ","); // Field slid_order
		$sFilterList = ew_Concat($sFilterList, $this->slid_header->AdvancedSearch->ToJson(), ","); // Field slid_header
		$sFilterList = ew_Concat($sFilterList, $this->slid_link->AdvancedSearch->ToJson(), ","); // Field slid_link
		$sFilterList = ew_Concat($sFilterList, $this->slid_label->AdvancedSearch->ToJson(), ","); // Field slid_label
		$sFilterList = ew_Concat($sFilterList, $this->slid_photo->AdvancedSearch->ToJson(), ","); // Field slid_photo
		$sFilterList = ew_Concat($sFilterList, $this->slid_text->AdvancedSearch->ToJson(), ","); // Field slid_text
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fcpy_slider_trnlistsrch", $filters);

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

		// Field slid_id
		$this->slid_id->AdvancedSearch->SearchValue = @$filter["x_slid_id"];
		$this->slid_id->AdvancedSearch->SearchOperator = @$filter["z_slid_id"];
		$this->slid_id->AdvancedSearch->SearchCondition = @$filter["v_slid_id"];
		$this->slid_id->AdvancedSearch->SearchValue2 = @$filter["y_slid_id"];
		$this->slid_id->AdvancedSearch->SearchOperator2 = @$filter["w_slid_id"];
		$this->slid_id->AdvancedSearch->Save();

		// Field slid_order
		$this->slid_order->AdvancedSearch->SearchValue = @$filter["x_slid_order"];
		$this->slid_order->AdvancedSearch->SearchOperator = @$filter["z_slid_order"];
		$this->slid_order->AdvancedSearch->SearchCondition = @$filter["v_slid_order"];
		$this->slid_order->AdvancedSearch->SearchValue2 = @$filter["y_slid_order"];
		$this->slid_order->AdvancedSearch->SearchOperator2 = @$filter["w_slid_order"];
		$this->slid_order->AdvancedSearch->Save();

		// Field slid_header
		$this->slid_header->AdvancedSearch->SearchValue = @$filter["x_slid_header"];
		$this->slid_header->AdvancedSearch->SearchOperator = @$filter["z_slid_header"];
		$this->slid_header->AdvancedSearch->SearchCondition = @$filter["v_slid_header"];
		$this->slid_header->AdvancedSearch->SearchValue2 = @$filter["y_slid_header"];
		$this->slid_header->AdvancedSearch->SearchOperator2 = @$filter["w_slid_header"];
		$this->slid_header->AdvancedSearch->Save();

		// Field slid_link
		$this->slid_link->AdvancedSearch->SearchValue = @$filter["x_slid_link"];
		$this->slid_link->AdvancedSearch->SearchOperator = @$filter["z_slid_link"];
		$this->slid_link->AdvancedSearch->SearchCondition = @$filter["v_slid_link"];
		$this->slid_link->AdvancedSearch->SearchValue2 = @$filter["y_slid_link"];
		$this->slid_link->AdvancedSearch->SearchOperator2 = @$filter["w_slid_link"];
		$this->slid_link->AdvancedSearch->Save();

		// Field slid_label
		$this->slid_label->AdvancedSearch->SearchValue = @$filter["x_slid_label"];
		$this->slid_label->AdvancedSearch->SearchOperator = @$filter["z_slid_label"];
		$this->slid_label->AdvancedSearch->SearchCondition = @$filter["v_slid_label"];
		$this->slid_label->AdvancedSearch->SearchValue2 = @$filter["y_slid_label"];
		$this->slid_label->AdvancedSearch->SearchOperator2 = @$filter["w_slid_label"];
		$this->slid_label->AdvancedSearch->Save();

		// Field slid_photo
		$this->slid_photo->AdvancedSearch->SearchValue = @$filter["x_slid_photo"];
		$this->slid_photo->AdvancedSearch->SearchOperator = @$filter["z_slid_photo"];
		$this->slid_photo->AdvancedSearch->SearchCondition = @$filter["v_slid_photo"];
		$this->slid_photo->AdvancedSearch->SearchValue2 = @$filter["y_slid_photo"];
		$this->slid_photo->AdvancedSearch->SearchOperator2 = @$filter["w_slid_photo"];
		$this->slid_photo->AdvancedSearch->Save();

		// Field slid_text
		$this->slid_text->AdvancedSearch->SearchValue = @$filter["x_slid_text"];
		$this->slid_text->AdvancedSearch->SearchOperator = @$filter["z_slid_text"];
		$this->slid_text->AdvancedSearch->SearchCondition = @$filter["v_slid_text"];
		$this->slid_text->AdvancedSearch->SearchValue2 = @$filter["y_slid_text"];
		$this->slid_text->AdvancedSearch->SearchOperator2 = @$filter["w_slid_text"];
		$this->slid_text->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->slid_id, $Default, FALSE); // slid_id
		$this->BuildSearchSql($sWhere, $this->slid_order, $Default, FALSE); // slid_order
		$this->BuildSearchSql($sWhere, $this->slid_header, $Default, FALSE); // slid_header
		$this->BuildSearchSql($sWhere, $this->slid_link, $Default, FALSE); // slid_link
		$this->BuildSearchSql($sWhere, $this->slid_label, $Default, FALSE); // slid_label
		$this->BuildSearchSql($sWhere, $this->slid_photo, $Default, FALSE); // slid_photo
		$this->BuildSearchSql($sWhere, $this->slid_text, $Default, FALSE); // slid_text

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->slid_id->AdvancedSearch->Save(); // slid_id
			$this->slid_order->AdvancedSearch->Save(); // slid_order
			$this->slid_header->AdvancedSearch->Save(); // slid_header
			$this->slid_link->AdvancedSearch->Save(); // slid_link
			$this->slid_label->AdvancedSearch->Save(); // slid_label
			$this->slid_photo->AdvancedSearch->Save(); // slid_photo
			$this->slid_text->AdvancedSearch->Save(); // slid_text
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
		$this->BuildBasicSearchSQL($sWhere, $this->slid_header, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->slid_link, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->slid_label, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->slid_photo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->slid_text, $arKeywords, $type);
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
		if ($this->slid_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slid_order->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slid_header->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slid_link->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slid_label->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slid_photo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slid_text->AdvancedSearch->IssetSession())
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
		$this->slid_id->AdvancedSearch->UnsetSession();
		$this->slid_order->AdvancedSearch->UnsetSession();
		$this->slid_header->AdvancedSearch->UnsetSession();
		$this->slid_link->AdvancedSearch->UnsetSession();
		$this->slid_label->AdvancedSearch->UnsetSession();
		$this->slid_photo->AdvancedSearch->UnsetSession();
		$this->slid_text->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->slid_id->AdvancedSearch->Load();
		$this->slid_order->AdvancedSearch->Load();
		$this->slid_header->AdvancedSearch->Load();
		$this->slid_link->AdvancedSearch->Load();
		$this->slid_label->AdvancedSearch->Load();
		$this->slid_photo->AdvancedSearch->Load();
		$this->slid_text->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->slid_id); // slid_id
			$this->UpdateSort($this->slid_order); // slid_order
			$this->UpdateSort($this->slid_header); // slid_header
			$this->UpdateSort($this->slid_link); // slid_link
			$this->UpdateSort($this->slid_label); // slid_label
			$this->UpdateSort($this->slid_photo); // slid_photo
			$this->UpdateSort($this->slid_text); // slid_text
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
				$this->slid_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->slid_id->setSort("");
				$this->slid_order->setSort("");
				$this->slid_header->setSort("");
				$this->slid_link->setSort("");
				$this->slid_label->setSort("");
				$this->slid_photo->setSort("");
				$this->slid_text->setSort("");
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
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->tslid_id->CurrentValue) . "\">";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->tslid_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->tslid_id->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ewAction ewMultiDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.fcpy_slider_trnlist,url:'" . $this->MultiDeleteUrl . "'});return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = ($Security->CanDelete());

		// Add multi update
		$item = &$option->Add("multiupdate");
		$item->Body = "<a class=\"ewAction ewMultiUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" data-table=\"cpy_slider_trn\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.fcpy_slider_trnlist,url:'" . $this->MultiUpdateUrl . "'});return false;\">" . $Language->Phrase("UpdateSelectedLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fcpy_slider_trnlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fcpy_slider_trnlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fcpy_slider_trnlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fcpy_slider_trnlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->Add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"cpy_slider_trnsrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->Add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewHighlight active\" title=\"" . $Language->Phrase("Highlight") . "\" data-caption=\"" . $Language->Phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fcpy_slider_trnlistsrch\" data-name=\"" . $this->HighlightName() . "\">" . $Language->Phrase("HighlightBtn") . "</button>";
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->slid_photo->Upload->Index = $objForm->Index;
		$this->slid_photo->Upload->UploadFile();
		$this->slid_photo->CurrentValue = $this->slid_photo->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->tslid_id->CurrentValue = NULL;
		$this->tslid_id->OldValue = $this->tslid_id->CurrentValue;
		$this->slid_id->CurrentValue = NULL;
		$this->slid_id->OldValue = $this->slid_id->CurrentValue;
		$this->slid_order->CurrentValue = 0;
		$this->slid_order->OldValue = $this->slid_order->CurrentValue;
		$this->slid_header->CurrentValue = NULL;
		$this->slid_header->OldValue = $this->slid_header->CurrentValue;
		$this->slid_link->CurrentValue = NULL;
		$this->slid_link->OldValue = $this->slid_link->CurrentValue;
		$this->slid_label->CurrentValue = NULL;
		$this->slid_label->OldValue = $this->slid_label->CurrentValue;
		$this->slid_photo->Upload->DbValue = NULL;
		$this->slid_photo->OldValue = $this->slid_photo->Upload->DbValue;
		$this->slid_text->CurrentValue = NULL;
		$this->slid_text->OldValue = $this->slid_text->CurrentValue;
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
		// slid_id

		$this->slid_id->AdvancedSearch->SearchValue = @$_GET["x_slid_id"];
		if ($this->slid_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_id->AdvancedSearch->SearchOperator = @$_GET["z_slid_id"];

		// slid_order
		$this->slid_order->AdvancedSearch->SearchValue = @$_GET["x_slid_order"];
		if ($this->slid_order->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_order->AdvancedSearch->SearchOperator = @$_GET["z_slid_order"];

		// slid_header
		$this->slid_header->AdvancedSearch->SearchValue = @$_GET["x_slid_header"];
		if ($this->slid_header->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_header->AdvancedSearch->SearchOperator = @$_GET["z_slid_header"];

		// slid_link
		$this->slid_link->AdvancedSearch->SearchValue = @$_GET["x_slid_link"];
		if ($this->slid_link->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_link->AdvancedSearch->SearchOperator = @$_GET["z_slid_link"];

		// slid_label
		$this->slid_label->AdvancedSearch->SearchValue = @$_GET["x_slid_label"];
		if ($this->slid_label->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_label->AdvancedSearch->SearchOperator = @$_GET["z_slid_label"];

		// slid_photo
		$this->slid_photo->AdvancedSearch->SearchValue = @$_GET["x_slid_photo"];
		if ($this->slid_photo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_photo->AdvancedSearch->SearchOperator = @$_GET["z_slid_photo"];

		// slid_text
		$this->slid_text->AdvancedSearch->SearchValue = @$_GET["x_slid_text"];
		if ($this->slid_text->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slid_text->AdvancedSearch->SearchOperator = @$_GET["z_slid_text"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->slid_id->FldIsDetailKey) {
			$this->slid_id->setFormValue($objForm->GetValue("x_slid_id"));
		}
		$this->slid_id->setOldValue($objForm->GetValue("o_slid_id"));
		if (!$this->slid_order->FldIsDetailKey) {
			$this->slid_order->setFormValue($objForm->GetValue("x_slid_order"));
		}
		$this->slid_order->setOldValue($objForm->GetValue("o_slid_order"));
		if (!$this->slid_header->FldIsDetailKey) {
			$this->slid_header->setFormValue($objForm->GetValue("x_slid_header"));
		}
		$this->slid_header->setOldValue($objForm->GetValue("o_slid_header"));
		if (!$this->slid_link->FldIsDetailKey) {
			$this->slid_link->setFormValue($objForm->GetValue("x_slid_link"));
		}
		$this->slid_link->setOldValue($objForm->GetValue("o_slid_link"));
		if (!$this->slid_label->FldIsDetailKey) {
			$this->slid_label->setFormValue($objForm->GetValue("x_slid_label"));
		}
		$this->slid_label->setOldValue($objForm->GetValue("o_slid_label"));
		if (!$this->slid_text->FldIsDetailKey) {
			$this->slid_text->setFormValue($objForm->GetValue("x_slid_text"));
		}
		$this->slid_text->setOldValue($objForm->GetValue("o_slid_text"));
		if (!$this->tslid_id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->tslid_id->setFormValue($objForm->GetValue("x_tslid_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->tslid_id->CurrentValue = $this->tslid_id->FormValue;
		$this->slid_id->CurrentValue = $this->slid_id->FormValue;
		$this->slid_order->CurrentValue = $this->slid_order->FormValue;
		$this->slid_header->CurrentValue = $this->slid_header->FormValue;
		$this->slid_link->CurrentValue = $this->slid_link->FormValue;
		$this->slid_label->CurrentValue = $this->slid_label->FormValue;
		$this->slid_text->CurrentValue = $this->slid_text->FormValue;
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
		$this->tslid_id->setDbValue($row['tslid_id']);
		$this->slid_id->setDbValue($row['slid_id']);
		$this->slid_order->setDbValue($row['slid_order']);
		$this->slid_header->setDbValue($row['slid_header']);
		$this->slid_link->setDbValue($row['slid_link']);
		$this->slid_label->setDbValue($row['slid_label']);
		$this->slid_photo->Upload->DbValue = $row['slid_photo'];
		$this->slid_photo->setDbValue($this->slid_photo->Upload->DbValue);
		$this->slid_text->setDbValue($row['slid_text']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['tslid_id'] = $this->tslid_id->CurrentValue;
		$row['slid_id'] = $this->slid_id->CurrentValue;
		$row['slid_order'] = $this->slid_order->CurrentValue;
		$row['slid_header'] = $this->slid_header->CurrentValue;
		$row['slid_link'] = $this->slid_link->CurrentValue;
		$row['slid_label'] = $this->slid_label->CurrentValue;
		$row['slid_photo'] = $this->slid_photo->Upload->DbValue;
		$row['slid_text'] = $this->slid_text->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->tslid_id->DbValue = $row['tslid_id'];
		$this->slid_id->DbValue = $row['slid_id'];
		$this->slid_order->DbValue = $row['slid_order'];
		$this->slid_header->DbValue = $row['slid_header'];
		$this->slid_link->DbValue = $row['slid_link'];
		$this->slid_label->DbValue = $row['slid_label'];
		$this->slid_photo->Upload->DbValue = $row['slid_photo'];
		$this->slid_text->DbValue = $row['slid_text'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("tslid_id")) <> "")
			$this->tslid_id->CurrentValue = $this->getKey("tslid_id"); // tslid_id
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// tslid_id

		$this->tslid_id->CellCssStyle = "white-space: nowrap;";

		// slid_id
		// slid_order
		// slid_header
		// slid_link
		// slid_label
		// slid_photo
		// slid_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// slid_id
		if (strval($this->slid_id->CurrentValue) <> "") {
			$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `slid_id`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_slider_mst`";
		$sWhereWrk = "";
		$this->slid_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `slid_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->slid_id->ViewValue = $this->slid_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->slid_id->ViewValue = $this->slid_id->CurrentValue;
			}
		} else {
			$this->slid_id->ViewValue = NULL;
		}
		$this->slid_id->ViewCustomAttributes = "";

		// slid_order
		$this->slid_order->ViewValue = $this->slid_order->CurrentValue;
		$this->slid_order->ViewCustomAttributes = "";

		// slid_header
		$this->slid_header->ViewValue = $this->slid_header->CurrentValue;
		$this->slid_header->ViewCustomAttributes = "";

		// slid_link
		$this->slid_link->ViewValue = $this->slid_link->CurrentValue;
		$this->slid_link->ViewCustomAttributes = "";

		// slid_label
		$this->slid_label->ViewValue = $this->slid_label->CurrentValue;
		$this->slid_label->ViewCustomAttributes = "";

		// slid_photo
		$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
		if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
			$this->slid_photo->ImageWidth = 200;
			$this->slid_photo->ImageHeight = 0;
			$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
			$this->slid_photo->ViewValue = $this->slid_photo->Upload->DbValue;
		} else {
			$this->slid_photo->ViewValue = "";
		}
		$this->slid_photo->ViewCustomAttributes = "";

		// slid_text
		$this->slid_text->ViewValue = $this->slid_text->CurrentValue;
		$this->slid_text->ViewCustomAttributes = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// slid_order
			$this->slid_order->LinkCustomAttributes = "";
			$this->slid_order->HrefValue = "";
			$this->slid_order->TooltipValue = "";
			if ($this->Export == "")
				$this->slid_order->ViewValue = $this->HighlightValue($this->slid_order);

			// slid_header
			$this->slid_header->LinkCustomAttributes = "";
			$this->slid_header->HrefValue = "";
			$this->slid_header->TooltipValue = "";
			if ($this->Export == "")
				$this->slid_header->ViewValue = $this->HighlightValue($this->slid_header);

			// slid_link
			$this->slid_link->LinkCustomAttributes = "";
			$this->slid_link->HrefValue = "";
			$this->slid_link->TooltipValue = "";
			if ($this->Export == "")
				$this->slid_link->ViewValue = $this->HighlightValue($this->slid_link);

			// slid_label
			$this->slid_label->LinkCustomAttributes = "";
			$this->slid_label->HrefValue = "";
			$this->slid_label->TooltipValue = "";
			if ($this->Export == "")
				$this->slid_label->ViewValue = $this->HighlightValue($this->slid_label);

			// slid_photo
			$this->slid_photo->LinkCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
				$this->slid_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
			} else {
				$this->slid_photo->HrefValue = "";
			}
			$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;
			$this->slid_photo->TooltipValue = "";
			if ($this->slid_photo->UseColorbox) {
				if (ew_Empty($this->slid_photo->TooltipValue))
					$this->slid_photo->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->slid_photo->LinkAttrs["data-rel"] = "cpy_slider_trn_x" . $this->RowCnt . "_slid_photo";
				ew_AppendClass($this->slid_photo->LinkAttrs["class"], "ewLightbox");
			}

			// slid_text
			$this->slid_text->LinkCustomAttributes = "";
			$this->slid_text->HrefValue = "";
			$this->slid_text->TooltipValue = "";
			if ($this->Export == "")
				$this->slid_text->ViewValue = $this->HighlightValue($this->slid_text);
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// slid_id
			$this->slid_id->EditAttrs["class"] = "form-control";
			$this->slid_id->EditCustomAttributes = "";
			if ($this->slid_id->getSessionValue() <> "") {
				$this->slid_id->CurrentValue = $this->slid_id->getSessionValue();
				$this->slid_id->OldValue = $this->slid_id->CurrentValue;
			if (strval($this->slid_id->CurrentValue) <> "") {
				$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `slid_id`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_slider_mst`";
			$sWhereWrk = "";
			$this->slid_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `slid_name`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->slid_id->ViewValue = $this->slid_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->slid_id->ViewValue = $this->slid_id->CurrentValue;
				}
			} else {
				$this->slid_id->ViewValue = NULL;
			}
			$this->slid_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->slid_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `slid_id`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_slider_mst`";
			$sWhereWrk = "";
			$this->slid_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `slid_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->slid_id->EditValue = $arwrk;
			}

			// slid_order
			$this->slid_order->EditAttrs["class"] = "form-control";
			$this->slid_order->EditCustomAttributes = "";
			$this->slid_order->EditValue = ew_HtmlEncode($this->slid_order->CurrentValue);
			$this->slid_order->PlaceHolder = ew_RemoveHtml($this->slid_order->FldCaption());

			// slid_header
			$this->slid_header->EditAttrs["class"] = "form-control";
			$this->slid_header->EditCustomAttributes = "";
			$this->slid_header->EditValue = ew_HtmlEncode($this->slid_header->CurrentValue);
			$this->slid_header->PlaceHolder = ew_RemoveHtml($this->slid_header->FldCaption());

			// slid_link
			$this->slid_link->EditAttrs["class"] = "form-control";
			$this->slid_link->EditCustomAttributes = "";
			$this->slid_link->EditValue = ew_HtmlEncode($this->slid_link->CurrentValue);
			$this->slid_link->PlaceHolder = ew_RemoveHtml($this->slid_link->FldCaption());

			// slid_label
			$this->slid_label->EditAttrs["class"] = "form-control";
			$this->slid_label->EditCustomAttributes = "";
			$this->slid_label->EditValue = ew_HtmlEncode($this->slid_label->CurrentValue);
			$this->slid_label->PlaceHolder = ew_RemoveHtml($this->slid_label->FldCaption());

			// slid_photo
			$this->slid_photo->EditAttrs["class"] = "form-control";
			$this->slid_photo->EditCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->ImageWidth = 200;
				$this->slid_photo->ImageHeight = 0;
				$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
				$this->slid_photo->EditValue = $this->slid_photo->Upload->DbValue;
			} else {
				$this->slid_photo->EditValue = "";
			}
			if (!ew_Empty($this->slid_photo->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->slid_photo->Upload->FileName = "";
					else
						$this->slid_photo->Upload->FileName = $this->slid_photo->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled) ew_RenderUploadField($this->slid_photo, $this->RowIndex);

			// slid_text
			$this->slid_text->EditAttrs["class"] = "form-control";
			$this->slid_text->EditCustomAttributes = "";
			$this->slid_text->EditValue = ew_HtmlEncode($this->slid_text->CurrentValue);
			$this->slid_text->PlaceHolder = ew_RemoveHtml($this->slid_text->FldCaption());

			// Add refer script
			// slid_id

			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";

			// slid_order
			$this->slid_order->LinkCustomAttributes = "";
			$this->slid_order->HrefValue = "";

			// slid_header
			$this->slid_header->LinkCustomAttributes = "";
			$this->slid_header->HrefValue = "";

			// slid_link
			$this->slid_link->LinkCustomAttributes = "";
			$this->slid_link->HrefValue = "";

			// slid_label
			$this->slid_label->LinkCustomAttributes = "";
			$this->slid_label->HrefValue = "";

			// slid_photo
			$this->slid_photo->LinkCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
				$this->slid_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
			} else {
				$this->slid_photo->HrefValue = "";
			}
			$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;

			// slid_text
			$this->slid_text->LinkCustomAttributes = "";
			$this->slid_text->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// slid_id
			$this->slid_id->EditAttrs["class"] = "form-control";
			$this->slid_id->EditCustomAttributes = "";
			if ($this->slid_id->getSessionValue() <> "") {
				$this->slid_id->CurrentValue = $this->slid_id->getSessionValue();
				$this->slid_id->OldValue = $this->slid_id->CurrentValue;
			if (strval($this->slid_id->CurrentValue) <> "") {
				$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `slid_id`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_slider_mst`";
			$sWhereWrk = "";
			$this->slid_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `slid_name`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->slid_id->ViewValue = $this->slid_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->slid_id->ViewValue = $this->slid_id->CurrentValue;
				}
			} else {
				$this->slid_id->ViewValue = NULL;
			}
			$this->slid_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->slid_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `slid_id`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_slider_mst`";
			$sWhereWrk = "";
			$this->slid_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `slid_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->slid_id->EditValue = $arwrk;
			}

			// slid_order
			$this->slid_order->EditAttrs["class"] = "form-control";
			$this->slid_order->EditCustomAttributes = "";
			$this->slid_order->EditValue = ew_HtmlEncode($this->slid_order->CurrentValue);
			$this->slid_order->PlaceHolder = ew_RemoveHtml($this->slid_order->FldCaption());

			// slid_header
			$this->slid_header->EditAttrs["class"] = "form-control";
			$this->slid_header->EditCustomAttributes = "";
			$this->slid_header->EditValue = ew_HtmlEncode($this->slid_header->CurrentValue);
			$this->slid_header->PlaceHolder = ew_RemoveHtml($this->slid_header->FldCaption());

			// slid_link
			$this->slid_link->EditAttrs["class"] = "form-control";
			$this->slid_link->EditCustomAttributes = "";
			$this->slid_link->EditValue = ew_HtmlEncode($this->slid_link->CurrentValue);
			$this->slid_link->PlaceHolder = ew_RemoveHtml($this->slid_link->FldCaption());

			// slid_label
			$this->slid_label->EditAttrs["class"] = "form-control";
			$this->slid_label->EditCustomAttributes = "";
			$this->slid_label->EditValue = ew_HtmlEncode($this->slid_label->CurrentValue);
			$this->slid_label->PlaceHolder = ew_RemoveHtml($this->slid_label->FldCaption());

			// slid_photo
			$this->slid_photo->EditAttrs["class"] = "form-control";
			$this->slid_photo->EditCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->ImageWidth = 200;
				$this->slid_photo->ImageHeight = 0;
				$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
				$this->slid_photo->EditValue = $this->slid_photo->Upload->DbValue;
			} else {
				$this->slid_photo->EditValue = "";
			}
			if (!ew_Empty($this->slid_photo->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->slid_photo->Upload->FileName = "";
					else
						$this->slid_photo->Upload->FileName = $this->slid_photo->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled) ew_RenderUploadField($this->slid_photo, $this->RowIndex);

			// slid_text
			$this->slid_text->EditAttrs["class"] = "form-control";
			$this->slid_text->EditCustomAttributes = "";
			$this->slid_text->EditValue = ew_HtmlEncode($this->slid_text->CurrentValue);
			$this->slid_text->PlaceHolder = ew_RemoveHtml($this->slid_text->FldCaption());

			// Edit refer script
			// slid_id

			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";

			// slid_order
			$this->slid_order->LinkCustomAttributes = "";
			$this->slid_order->HrefValue = "";

			// slid_header
			$this->slid_header->LinkCustomAttributes = "";
			$this->slid_header->HrefValue = "";

			// slid_link
			$this->slid_link->LinkCustomAttributes = "";
			$this->slid_link->HrefValue = "";

			// slid_label
			$this->slid_label->LinkCustomAttributes = "";
			$this->slid_label->HrefValue = "";

			// slid_photo
			$this->slid_photo->LinkCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
				$this->slid_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
			} else {
				$this->slid_photo->HrefValue = "";
			}
			$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;

			// slid_text
			$this->slid_text->LinkCustomAttributes = "";
			$this->slid_text->HrefValue = "";
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
		if (!$this->slid_id->FldIsDetailKey && !is_null($this->slid_id->FormValue) && $this->slid_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_id->FldCaption(), $this->slid_id->ReqErrMsg));
		}
		if (!$this->slid_order->FldIsDetailKey && !is_null($this->slid_order->FormValue) && $this->slid_order->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_order->FldCaption(), $this->slid_order->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->slid_order->FormValue)) {
			ew_AddMessage($gsFormError, $this->slid_order->FldErrMsg());
		}
		if ($this->slid_photo->Upload->FileName == "" && !$this->slid_photo->Upload->KeepFile) {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_photo->FldCaption(), $this->slid_photo->ReqErrMsg));
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
				$sThisKey .= $row['tslid_id'];
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
			$this->slid_photo->OldUploadPath = '../../assets/pages/img/frontend-slider';
			$this->slid_photo->UploadPath = $this->slid_photo->OldUploadPath;
			$rsnew = array();

			// slid_id
			$this->slid_id->SetDbValueDef($rsnew, $this->slid_id->CurrentValue, 0, $this->slid_id->ReadOnly);

			// slid_order
			$this->slid_order->SetDbValueDef($rsnew, $this->slid_order->CurrentValue, 0, $this->slid_order->ReadOnly);

			// slid_header
			$this->slid_header->SetDbValueDef($rsnew, $this->slid_header->CurrentValue, NULL, $this->slid_header->ReadOnly);

			// slid_link
			$this->slid_link->SetDbValueDef($rsnew, $this->slid_link->CurrentValue, NULL, $this->slid_link->ReadOnly);

			// slid_label
			$this->slid_label->SetDbValueDef($rsnew, $this->slid_label->CurrentValue, NULL, $this->slid_label->ReadOnly);

			// slid_photo
			if ($this->slid_photo->Visible && !$this->slid_photo->ReadOnly && !$this->slid_photo->Upload->KeepFile) {
				$this->slid_photo->Upload->DbValue = $rsold['slid_photo']; // Get original value
				if ($this->slid_photo->Upload->FileName == "") {
					$rsnew['slid_photo'] = NULL;
				} else {
					$rsnew['slid_photo'] = $this->slid_photo->Upload->FileName;
				}
			}

			// slid_text
			$this->slid_text->SetDbValueDef($rsnew, $this->slid_text->CurrentValue, NULL, $this->slid_text->ReadOnly);
			if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
				$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
				$OldFiles = ew_Empty($this->slid_photo->Upload->DbValue) ? array() : array($this->slid_photo->Upload->DbValue);
				if (!ew_Empty($this->slid_photo->Upload->FileName)) {
					$NewFiles = array($this->slid_photo->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->slid_photo->Upload->Index < 0) ? $this->slid_photo->FldVar : substr($this->slid_photo->FldVar, 0, 1) . $this->slid_photo->Upload->Index . substr($this->slid_photo->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->slid_photo->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file1) || file_exists($this->slid_photo->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->slid_photo->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file, ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->slid_photo->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->slid_photo->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->slid_photo->SetDbValueDef($rsnew, $this->slid_photo->Upload->FileName, "", $this->slid_photo->ReadOnly);
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
					if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->slid_photo->Upload->DbValue) ? array() : array($this->slid_photo->Upload->DbValue);
						if (!ew_Empty($this->slid_photo->Upload->FileName)) {
							$NewFiles = array($this->slid_photo->Upload->FileName);
							$NewFiles2 = array($rsnew['slid_photo']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->slid_photo->Upload->Index < 0) ? $this->slid_photo->FldVar : substr($this->slid_photo->FldVar, 0, 1) . $this->slid_photo->Upload->Index . substr($this->slid_photo->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->slid_photo->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// slid_photo
		ew_CleanUploadTempPath($this->slid_photo, $this->slid_photo->Upload->Index);
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
			$this->slid_photo->OldUploadPath = '../../assets/pages/img/frontend-slider';
			$this->slid_photo->UploadPath = $this->slid_photo->OldUploadPath;
		}
		$rsnew = array();

		// slid_id
		$this->slid_id->SetDbValueDef($rsnew, $this->slid_id->CurrentValue, 0, FALSE);

		// slid_order
		$this->slid_order->SetDbValueDef($rsnew, $this->slid_order->CurrentValue, 0, strval($this->slid_order->CurrentValue) == "");

		// slid_header
		$this->slid_header->SetDbValueDef($rsnew, $this->slid_header->CurrentValue, NULL, FALSE);

		// slid_link
		$this->slid_link->SetDbValueDef($rsnew, $this->slid_link->CurrentValue, NULL, FALSE);

		// slid_label
		$this->slid_label->SetDbValueDef($rsnew, $this->slid_label->CurrentValue, NULL, FALSE);

		// slid_photo
		if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
			$this->slid_photo->Upload->DbValue = ""; // No need to delete old file
			if ($this->slid_photo->Upload->FileName == "") {
				$rsnew['slid_photo'] = NULL;
			} else {
				$rsnew['slid_photo'] = $this->slid_photo->Upload->FileName;
			}
		}

		// slid_text
		$this->slid_text->SetDbValueDef($rsnew, $this->slid_text->CurrentValue, NULL, FALSE);
		if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			$OldFiles = ew_Empty($this->slid_photo->Upload->DbValue) ? array() : array($this->slid_photo->Upload->DbValue);
			if (!ew_Empty($this->slid_photo->Upload->FileName)) {
				$NewFiles = array($this->slid_photo->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->slid_photo->Upload->Index < 0) ? $this->slid_photo->FldVar : substr($this->slid_photo->FldVar, 0, 1) . $this->slid_photo->Upload->Index . substr($this->slid_photo->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->slid_photo->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file1) || file_exists($this->slid_photo->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->slid_photo->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file, ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->slid_photo->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->slid_photo->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->slid_photo->SetDbValueDef($rsnew, $this->slid_photo->Upload->FileName, "", FALSE);
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
				if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->slid_photo->Upload->DbValue) ? array() : array($this->slid_photo->Upload->DbValue);
					if (!ew_Empty($this->slid_photo->Upload->FileName)) {
						$NewFiles = array($this->slid_photo->Upload->FileName);
						$NewFiles2 = array($rsnew['slid_photo']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->slid_photo->Upload->Index < 0) ? $this->slid_photo->FldVar : substr($this->slid_photo->FldVar, 0, 1) . $this->slid_photo->Upload->Index . substr($this->slid_photo->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->slid_photo->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}

		// slid_photo
		ew_CleanUploadTempPath($this->slid_photo, $this->slid_photo->Upload->Index);
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->slid_id->AdvancedSearch->Load();
		$this->slid_order->AdvancedSearch->Load();
		$this->slid_header->AdvancedSearch->Load();
		$this->slid_link->AdvancedSearch->Load();
		$this->slid_label->AdvancedSearch->Load();
		$this->slid_photo->AdvancedSearch->Load();
		$this->slid_text->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_cpy_slider_trn\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_cpy_slider_trn',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fcpy_slider_trnlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cpy_slider_mst") {
			global $cpy_slider_mst;
			if (!isset($cpy_slider_mst)) $cpy_slider_mst = new ccpy_slider_mst;
			$rsmaster = $cpy_slider_mst->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$cpy_slider_mst;
					$cpy_slider_mst->ExportDocument($Doc, $rsmaster, 1, 1);
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
			if ($sMasterTblVar == "cpy_slider_mst") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_slid_id"] <> "") {
					$GLOBALS["cpy_slider_mst"]->slid_id->setQueryStringValue($_GET["fk_slid_id"]);
					$this->slid_id->setQueryStringValue($GLOBALS["cpy_slider_mst"]->slid_id->QueryStringValue);
					$this->slid_id->setSessionValue($this->slid_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_slider_mst"]->slid_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_slider_mst") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_slid_id"] <> "") {
					$GLOBALS["cpy_slider_mst"]->slid_id->setFormValue($_POST["fk_slid_id"]);
					$this->slid_id->setFormValue($GLOBALS["cpy_slider_mst"]->slid_id->FormValue);
					$this->slid_id->setSessionValue($this->slid_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_slider_mst"]->slid_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cpy_slider_mst") {
				if ($this->slid_id->CurrentValue == "") $this->slid_id->setSessionValue("");
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
		case "x_slid_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `slid_id` AS `LinkFld`, `slid_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_slider_mst`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`slid_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->slid_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `slid_name`";
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
if (!isset($cpy_slider_trn_list)) $cpy_slider_trn_list = new ccpy_slider_trn_list();

// Page init
$cpy_slider_trn_list->Page_Init();

// Page main
$cpy_slider_trn_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_slider_trn_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fcpy_slider_trnlist = new ew_Form("fcpy_slider_trnlist", "list");
fcpy_slider_trnlist.FormKeyCountName = '<?php echo $cpy_slider_trn_list->FormKeyCountName ?>';

// Validate form
fcpy_slider_trnlist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_slid_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_id->FldCaption(), $cpy_slider_trn->slid_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_order->FldCaption(), $cpy_slider_trn->slid_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_slider_trn->slid_order->FldErrMsg()) ?>");
			felm = this.GetElements("x" + infix + "_slid_photo");
			elm = this.GetElements("fn_x" + infix + "_slid_photo");
			if (felm && elm && !ew_HasValue(elm))
				return this.OnError(felm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_photo->FldCaption(), $cpy_slider_trn->slid_photo->ReqErrMsg)) ?>");

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
fcpy_slider_trnlist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "slid_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_order", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_header", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_link", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_label", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_photo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "slid_text", false)) return false;
	return true;
}

// Form_CustomValidate event
fcpy_slider_trnlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_slider_trnlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_slider_trnlist.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_slider_trnlist.Lists["x_slid_id"].Data = "<?php echo $cpy_slider_trn_list->slid_id->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fcpy_slider_trnlistsrch = new ew_Form("fcpy_slider_trnlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<div class="ewToolbar">
<?php if ($cpy_slider_trn_list->TotalRecs > 0 && $cpy_slider_trn_list->ExportOptions->Visible()) { ?>
<?php $cpy_slider_trn_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($cpy_slider_trn_list->SearchOptions->Visible()) { ?>
<?php $cpy_slider_trn_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($cpy_slider_trn_list->FilterOptions->Visible()) { ?>
<?php $cpy_slider_trn_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($cpy_slider_trn->Export == "") || (EW_EXPORT_MASTER_RECORD && $cpy_slider_trn->Export == "print")) { ?>
<?php
if ($cpy_slider_trn_list->DbMasterFilter <> "" && $cpy_slider_trn->getCurrentMasterTable() == "cpy_slider_mst") {
	if ($cpy_slider_trn_list->MasterRecordExists) {
?>
<?php include_once "cpy_slider_mstmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($cpy_slider_trn->CurrentAction == "gridadd") {
	$cpy_slider_trn->CurrentFilter = "0=1";
	$cpy_slider_trn_list->StartRec = 1;
	$cpy_slider_trn_list->DisplayRecs = $cpy_slider_trn->GridAddRowCount;
	$cpy_slider_trn_list->TotalRecs = $cpy_slider_trn_list->DisplayRecs;
	$cpy_slider_trn_list->StopRec = $cpy_slider_trn_list->DisplayRecs;
} else {
	$bSelectLimit = $cpy_slider_trn_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cpy_slider_trn_list->TotalRecs <= 0)
			$cpy_slider_trn_list->TotalRecs = $cpy_slider_trn->ListRecordCount();
	} else {
		if (!$cpy_slider_trn_list->Recordset && ($cpy_slider_trn_list->Recordset = $cpy_slider_trn_list->LoadRecordset()))
			$cpy_slider_trn_list->TotalRecs = $cpy_slider_trn_list->Recordset->RecordCount();
	}
	$cpy_slider_trn_list->StartRec = 1;
	if ($cpy_slider_trn_list->DisplayRecs <= 0 || ($cpy_slider_trn->Export <> "" && $cpy_slider_trn->ExportAll)) // Display all records
		$cpy_slider_trn_list->DisplayRecs = $cpy_slider_trn_list->TotalRecs;
	if (!($cpy_slider_trn->Export <> "" && $cpy_slider_trn->ExportAll))
		$cpy_slider_trn_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cpy_slider_trn_list->Recordset = $cpy_slider_trn_list->LoadRecordset($cpy_slider_trn_list->StartRec-1, $cpy_slider_trn_list->DisplayRecs);

	// Set no record found message
	if ($cpy_slider_trn->CurrentAction == "" && $cpy_slider_trn_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$cpy_slider_trn_list->setWarningMessage(ew_DeniedMsg());
		if ($cpy_slider_trn_list->SearchWhere == "0=101")
			$cpy_slider_trn_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cpy_slider_trn_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cpy_slider_trn_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($cpy_slider_trn->Export == "" && $cpy_slider_trn->CurrentAction == "") { ?>
<form name="fcpy_slider_trnlistsrch" id="fcpy_slider_trnlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($cpy_slider_trn_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fcpy_slider_trnlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cpy_slider_trn">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($cpy_slider_trn_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($cpy_slider_trn_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $cpy_slider_trn_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($cpy_slider_trn_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($cpy_slider_trn_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($cpy_slider_trn_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($cpy_slider_trn_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $cpy_slider_trn_list->ShowPageHeader(); ?>
<?php
$cpy_slider_trn_list->ShowMessage();
?>
<?php if ($cpy_slider_trn_list->TotalRecs > 0 || $cpy_slider_trn->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($cpy_slider_trn_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> cpy_slider_trn">
<?php if ($cpy_slider_trn->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($cpy_slider_trn->CurrentAction <> "gridadd" && $cpy_slider_trn->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cpy_slider_trn_list->Pager)) $cpy_slider_trn_list->Pager = new cPrevNextPager($cpy_slider_trn_list->StartRec, $cpy_slider_trn_list->DisplayRecs, $cpy_slider_trn_list->TotalRecs, $cpy_slider_trn_list->AutoHidePager) ?>
<?php if ($cpy_slider_trn_list->Pager->RecordCount > 0 && $cpy_slider_trn_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_slider_trn_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_slider_trn_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_slider_trn_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_slider_trn_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_slider_trn_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($cpy_slider_trn_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_slider_trn_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcpy_slider_trnlist" id="fcpy_slider_trnlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_slider_trn_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_slider_trn_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_slider_trn">
<?php if ($cpy_slider_trn->getCurrentMasterTable() == "cpy_slider_mst" && $cpy_slider_trn->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="cpy_slider_mst">
<input type="hidden" name="fk_slid_id" value="<?php echo $cpy_slider_trn->slid_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_cpy_slider_trn" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($cpy_slider_trn_list->TotalRecs > 0 || $cpy_slider_trn->CurrentAction == "add" || $cpy_slider_trn->CurrentAction == "copy" || $cpy_slider_trn->CurrentAction == "gridedit") { ?>
<table id="tbl_cpy_slider_trnlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$cpy_slider_trn_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cpy_slider_trn_list->RenderListOptions();

// Render list options (header, left)
$cpy_slider_trn_list->ListOptions->Render("header", "left");
?>
<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_id) == "") { ?>
		<th data-name="slid_id" class="<?php echo $cpy_slider_trn->slid_id->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_id" class="cpy_slider_trn_slid_id"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_id" class="<?php echo $cpy_slider_trn->slid_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_id) ?>',1);"><div id="elh_cpy_slider_trn_slid_id" class="cpy_slider_trn_slid_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_order) == "") { ?>
		<th data-name="slid_order" class="<?php echo $cpy_slider_trn->slid_order->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_order" class="cpy_slider_trn_slid_order"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_order->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_order" class="<?php echo $cpy_slider_trn->slid_order->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_order) ?>',1);"><div id="elh_cpy_slider_trn_slid_order" class="cpy_slider_trn_slid_order">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_order->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_order->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_order->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_header) == "") { ?>
		<th data-name="slid_header" class="<?php echo $cpy_slider_trn->slid_header->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_header" class="cpy_slider_trn_slid_header"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_header->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_header" class="<?php echo $cpy_slider_trn->slid_header->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_header) ?>',1);"><div id="elh_cpy_slider_trn_slid_header" class="cpy_slider_trn_slid_header">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_header->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_header->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_header->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_link) == "") { ?>
		<th data-name="slid_link" class="<?php echo $cpy_slider_trn->slid_link->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_link" class="cpy_slider_trn_slid_link"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_link->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_link" class="<?php echo $cpy_slider_trn->slid_link->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_link) ?>',1);"><div id="elh_cpy_slider_trn_slid_link" class="cpy_slider_trn_slid_link">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_link->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_link->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_link->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_label) == "") { ?>
		<th data-name="slid_label" class="<?php echo $cpy_slider_trn->slid_label->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_label" class="cpy_slider_trn_slid_label"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_label->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_label" class="<?php echo $cpy_slider_trn->slid_label->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_label) ?>',1);"><div id="elh_cpy_slider_trn_slid_label" class="cpy_slider_trn_slid_label">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_label->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_label->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_label->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_photo) == "") { ?>
		<th data-name="slid_photo" class="<?php echo $cpy_slider_trn->slid_photo->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_photo" class="cpy_slider_trn_slid_photo"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_photo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_photo" class="<?php echo $cpy_slider_trn->slid_photo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_photo) ?>',1);"><div id="elh_cpy_slider_trn_slid_photo" class="cpy_slider_trn_slid_photo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_photo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_photo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_photo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
	<?php if ($cpy_slider_trn->SortUrl($cpy_slider_trn->slid_text) == "") { ?>
		<th data-name="slid_text" class="<?php echo $cpy_slider_trn->slid_text->HeaderCellClass() ?>"><div id="elh_cpy_slider_trn_slid_text" class="cpy_slider_trn_slid_text"><div class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_text->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slid_text" class="<?php echo $cpy_slider_trn->slid_text->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cpy_slider_trn->SortUrl($cpy_slider_trn->slid_text) ?>',1);"><div id="elh_cpy_slider_trn_slid_text" class="cpy_slider_trn_slid_text">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cpy_slider_trn->slid_text->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cpy_slider_trn->slid_text->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cpy_slider_trn->slid_text->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cpy_slider_trn_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($cpy_slider_trn->CurrentAction == "add" || $cpy_slider_trn->CurrentAction == "copy") {
		$cpy_slider_trn_list->RowIndex = 0;
		$cpy_slider_trn_list->KeyCount = $cpy_slider_trn_list->RowIndex;
		if ($cpy_slider_trn->CurrentAction == "copy" && !$cpy_slider_trn_list->LoadRow())
			$cpy_slider_trn->CurrentAction = "add";
		if ($cpy_slider_trn->CurrentAction == "add")
			$cpy_slider_trn_list->LoadRowValues();
		if ($cpy_slider_trn->EventCancelled) // Insert failed
			$cpy_slider_trn_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$cpy_slider_trn->ResetAttrs();
		$cpy_slider_trn->RowAttrs = array_merge($cpy_slider_trn->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_cpy_slider_trn', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$cpy_slider_trn->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_slider_trn_list->RenderRow();

		// Render list options
		$cpy_slider_trn_list->RenderListOptions();
		$cpy_slider_trn_list->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_slider_trn->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_slider_trn_list->ListOptions->Render("body", "left", $cpy_slider_trn_list->RowCnt);
?>
	<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id">
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
		<td data-name="slid_order">
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
		<td data-name="slid_header">
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
		<td data-name="slid_link">
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
		<td data-name="slid_label">
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
		<td data-name="slid_photo">
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_photo" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_photo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
		<td data-name="slid_text">
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trnlist", "x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_slider_trn_list->ListOptions->Render("body", "right", $cpy_slider_trn_list->RowCnt);
?>
<script type="text/javascript">
fcpy_slider_trnlist.UpdateOpts(<?php echo $cpy_slider_trn_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($cpy_slider_trn->ExportAll && $cpy_slider_trn->Export <> "") {
	$cpy_slider_trn_list->StopRec = $cpy_slider_trn_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cpy_slider_trn_list->TotalRecs > $cpy_slider_trn_list->StartRec + $cpy_slider_trn_list->DisplayRecs - 1)
		$cpy_slider_trn_list->StopRec = $cpy_slider_trn_list->StartRec + $cpy_slider_trn_list->DisplayRecs - 1;
	else
		$cpy_slider_trn_list->StopRec = $cpy_slider_trn_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cpy_slider_trn_list->FormKeyCountName) && ($cpy_slider_trn->CurrentAction == "gridadd" || $cpy_slider_trn->CurrentAction == "gridedit" || $cpy_slider_trn->CurrentAction == "F")) {
		$cpy_slider_trn_list->KeyCount = $objForm->GetValue($cpy_slider_trn_list->FormKeyCountName);
		$cpy_slider_trn_list->StopRec = $cpy_slider_trn_list->StartRec + $cpy_slider_trn_list->KeyCount - 1;
	}
}
$cpy_slider_trn_list->RecCnt = $cpy_slider_trn_list->StartRec - 1;
if ($cpy_slider_trn_list->Recordset && !$cpy_slider_trn_list->Recordset->EOF) {
	$cpy_slider_trn_list->Recordset->MoveFirst();
	$bSelectLimit = $cpy_slider_trn_list->UseSelectLimit;
	if (!$bSelectLimit && $cpy_slider_trn_list->StartRec > 1)
		$cpy_slider_trn_list->Recordset->Move($cpy_slider_trn_list->StartRec - 1);
} elseif (!$cpy_slider_trn->AllowAddDeleteRow && $cpy_slider_trn_list->StopRec == 0) {
	$cpy_slider_trn_list->StopRec = $cpy_slider_trn->GridAddRowCount;
}

// Initialize aggregate
$cpy_slider_trn->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cpy_slider_trn->ResetAttrs();
$cpy_slider_trn_list->RenderRow();
$cpy_slider_trn_list->EditRowCnt = 0;
if ($cpy_slider_trn->CurrentAction == "edit")
	$cpy_slider_trn_list->RowIndex = 1;
if ($cpy_slider_trn->CurrentAction == "gridadd")
	$cpy_slider_trn_list->RowIndex = 0;
if ($cpy_slider_trn->CurrentAction == "gridedit")
	$cpy_slider_trn_list->RowIndex = 0;
while ($cpy_slider_trn_list->RecCnt < $cpy_slider_trn_list->StopRec) {
	$cpy_slider_trn_list->RecCnt++;
	if (intval($cpy_slider_trn_list->RecCnt) >= intval($cpy_slider_trn_list->StartRec)) {
		$cpy_slider_trn_list->RowCnt++;
		if ($cpy_slider_trn->CurrentAction == "gridadd" || $cpy_slider_trn->CurrentAction == "gridedit" || $cpy_slider_trn->CurrentAction == "F") {
			$cpy_slider_trn_list->RowIndex++;
			$objForm->Index = $cpy_slider_trn_list->RowIndex;
			if ($objForm->HasValue($cpy_slider_trn_list->FormActionName))
				$cpy_slider_trn_list->RowAction = strval($objForm->GetValue($cpy_slider_trn_list->FormActionName));
			elseif ($cpy_slider_trn->CurrentAction == "gridadd")
				$cpy_slider_trn_list->RowAction = "insert";
			else
				$cpy_slider_trn_list->RowAction = "";
		}

		// Set up key count
		$cpy_slider_trn_list->KeyCount = $cpy_slider_trn_list->RowIndex;

		// Init row class and style
		$cpy_slider_trn->ResetAttrs();
		$cpy_slider_trn->CssClass = "";
		if ($cpy_slider_trn->CurrentAction == "gridadd") {
			$cpy_slider_trn_list->LoadRowValues(); // Load default values
		} else {
			$cpy_slider_trn_list->LoadRowValues($cpy_slider_trn_list->Recordset); // Load row values
		}
		$cpy_slider_trn->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cpy_slider_trn->CurrentAction == "gridadd") // Grid add
			$cpy_slider_trn->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cpy_slider_trn->CurrentAction == "gridadd" && $cpy_slider_trn->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cpy_slider_trn_list->RestoreCurrentRowFormValues($cpy_slider_trn_list->RowIndex); // Restore form values
		if ($cpy_slider_trn->CurrentAction == "edit") {
			if ($cpy_slider_trn_list->CheckInlineEditKey() && $cpy_slider_trn_list->EditRowCnt == 0) { // Inline edit
				$cpy_slider_trn->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($cpy_slider_trn->CurrentAction == "gridedit") { // Grid edit
			if ($cpy_slider_trn->EventCancelled) {
				$cpy_slider_trn_list->RestoreCurrentRowFormValues($cpy_slider_trn_list->RowIndex); // Restore form values
			}
			if ($cpy_slider_trn_list->RowAction == "insert")
				$cpy_slider_trn->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cpy_slider_trn->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cpy_slider_trn->CurrentAction == "edit" && $cpy_slider_trn->RowType == EW_ROWTYPE_EDIT && $cpy_slider_trn->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$cpy_slider_trn_list->RestoreFormValues(); // Restore form values
		}
		if ($cpy_slider_trn->CurrentAction == "gridedit" && ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT || $cpy_slider_trn->RowType == EW_ROWTYPE_ADD) && $cpy_slider_trn->EventCancelled) // Update failed
			$cpy_slider_trn_list->RestoreCurrentRowFormValues($cpy_slider_trn_list->RowIndex); // Restore form values
		if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cpy_slider_trn_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$cpy_slider_trn->RowAttrs = array_merge($cpy_slider_trn->RowAttrs, array('data-rowindex'=>$cpy_slider_trn_list->RowCnt, 'id'=>'r' . $cpy_slider_trn_list->RowCnt . '_cpy_slider_trn', 'data-rowtype'=>$cpy_slider_trn->RowType));

		// Render row
		$cpy_slider_trn_list->RenderRow();

		// Render list options
		$cpy_slider_trn_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cpy_slider_trn_list->RowAction <> "delete" && $cpy_slider_trn_list->RowAction <> "insertdelete" && !($cpy_slider_trn_list->RowAction == "insert" && $cpy_slider_trn->CurrentAction == "F" && $cpy_slider_trn_list->EmptyRow())) {
?>
	<tr<?php echo $cpy_slider_trn->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_slider_trn_list->ListOptions->Render("body", "left", $cpy_slider_trn_list->RowCnt);
?>
	<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id"<?php echo $cpy_slider_trn->slid_id->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_id" class="cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_tslid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_tslid_id" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_tslid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->tslid_id->CurrentValue) ?>">
<input type="hidden" data-table="cpy_slider_trn" data-field="x_tslid_id" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_tslid_id" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_tslid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->tslid_id->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT || $cpy_slider_trn->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_tslid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_tslid_id" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_tslid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->tslid_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
		<td data-name="slid_order"<?php echo $cpy_slider_trn->slid_order->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_order" class="cpy_slider_trn_slid_order">
<span<?php echo $cpy_slider_trn->slid_order->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_order->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
		<td data-name="slid_header"<?php echo $cpy_slider_trn->slid_header->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_header" class="cpy_slider_trn_slid_header">
<span<?php echo $cpy_slider_trn->slid_header->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_header->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
		<td data-name="slid_link"<?php echo $cpy_slider_trn->slid_link->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_link" class="cpy_slider_trn_slid_link">
<span<?php echo $cpy_slider_trn->slid_link->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_link->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
		<td data-name="slid_label"<?php echo $cpy_slider_trn->slid_label->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_label" class="cpy_slider_trn_slid_label">
<span<?php echo $cpy_slider_trn->slid_label->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_label->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
		<td data-name="slid_photo"<?php echo $cpy_slider_trn->slid_photo->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_photo" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_photo->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_photo" class="cpy_slider_trn_slid_photo">
<span>
<?php echo ew_GetFileViewTag($cpy_slider_trn->slid_photo, $cpy_slider_trn->slid_photo->ListViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
		<td data-name="slid_text"<?php echo $cpy_slider_trn->slid_text->CellAttributes() ?>>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trnlist", "x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trnlist", "x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cpy_slider_trn_list->RowCnt ?>_cpy_slider_trn_slid_text" class="cpy_slider_trn_slid_text">
<span<?php echo $cpy_slider_trn->slid_text->ViewAttributes() ?>>
<?php echo $cpy_slider_trn->slid_text->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_slider_trn_list->ListOptions->Render("body", "right", $cpy_slider_trn_list->RowCnt);
?>
	</tr>
<?php if ($cpy_slider_trn->RowType == EW_ROWTYPE_ADD || $cpy_slider_trn->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcpy_slider_trnlist.UpdateOpts(<?php echo $cpy_slider_trn_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cpy_slider_trn->CurrentAction <> "gridadd")
		if (!$cpy_slider_trn_list->Recordset->EOF) $cpy_slider_trn_list->Recordset->MoveNext();
}
?>
<?php
	if ($cpy_slider_trn->CurrentAction == "gridadd" || $cpy_slider_trn->CurrentAction == "gridedit") {
		$cpy_slider_trn_list->RowIndex = '$rowindex$';
		$cpy_slider_trn_list->LoadRowValues();

		// Set row properties
		$cpy_slider_trn->ResetAttrs();
		$cpy_slider_trn->RowAttrs = array_merge($cpy_slider_trn->RowAttrs, array('data-rowindex'=>$cpy_slider_trn_list->RowIndex, 'id'=>'r0_cpy_slider_trn', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cpy_slider_trn->RowAttrs["class"], "ewTemplate");
		$cpy_slider_trn->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cpy_slider_trn_list->RenderRow();

		// Render list options
		$cpy_slider_trn_list->RenderListOptions();
		$cpy_slider_trn_list->StartRowCnt = 0;
?>
	<tr<?php echo $cpy_slider_trn->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cpy_slider_trn_list->ListOptions->Render("body", "left", $cpy_slider_trn_list->RowIndex);
?>
	<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
		<td data-name="slid_id">
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cpy_slider_trn_slid_id" class="form-group cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_id" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
		<td data-name="slid_order">
<span id="el$rowindex$_cpy_slider_trn_slid_order" class="form-group cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_order" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_order" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
		<td data-name="slid_header">
<span id="el$rowindex$_cpy_slider_trn_slid_header" class="form-group cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_header" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_header" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
		<td data-name="slid_link">
<span id="el$rowindex$_cpy_slider_trn_slid_link" class="form-group cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_link" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_link" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
		<td data-name="slid_label">
<span id="el$rowindex$_cpy_slider_trn_slid_label" class="form-group cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_label" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_label" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
		<td data-name="slid_photo">
<span id="el$rowindex$_cpy_slider_trn_slid_photo" class="form-group cpy_slider_trn_slid_photo">
<div id="fd_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fn_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fa_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="0">
<input type="hidden" name="fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fs_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="200">
<input type="hidden" name="fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fx_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id= "fm_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_photo" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_photo" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_photo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
		<td data-name="slid_text">
<span id="el$rowindex$_cpy_slider_trn_slid_text" class="form-group cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trnlist", "x<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="cpy_slider_trn" data-field="x_slid_text" name="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" id="o<?php echo $cpy_slider_trn_list->RowIndex ?>_slid_text" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cpy_slider_trn_list->ListOptions->Render("body", "right", $cpy_slider_trn_list->RowIndex);
?>
<script type="text/javascript">
fcpy_slider_trnlist.UpdateOpts(<?php echo $cpy_slider_trn_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($cpy_slider_trn->CurrentAction == "add" || $cpy_slider_trn->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" id="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" value="<?php echo $cpy_slider_trn_list->KeyCount ?>">
<?php } ?>
<?php if ($cpy_slider_trn->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" id="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" value="<?php echo $cpy_slider_trn_list->KeyCount ?>">
<?php echo $cpy_slider_trn_list->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_slider_trn->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" id="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" value="<?php echo $cpy_slider_trn_list->KeyCount ?>">
<?php } ?>
<?php if ($cpy_slider_trn->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" id="<?php echo $cpy_slider_trn_list->FormKeyCountName ?>" value="<?php echo $cpy_slider_trn_list->KeyCount ?>">
<?php echo $cpy_slider_trn_list->MultiSelectKey ?>
<?php } ?>
<?php if ($cpy_slider_trn->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cpy_slider_trn_list->Recordset)
	$cpy_slider_trn_list->Recordset->Close();
?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($cpy_slider_trn->CurrentAction <> "gridadd" && $cpy_slider_trn->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cpy_slider_trn_list->Pager)) $cpy_slider_trn_list->Pager = new cPrevNextPager($cpy_slider_trn_list->StartRec, $cpy_slider_trn_list->DisplayRecs, $cpy_slider_trn_list->TotalRecs, $cpy_slider_trn_list->AutoHidePager) ?>
<?php if ($cpy_slider_trn_list->Pager->RecordCount > 0 && $cpy_slider_trn_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_slider_trn_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_slider_trn_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_slider_trn_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_slider_trn_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_slider_trn_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_slider_trn_list->PageUrl() ?>start=<?php echo $cpy_slider_trn_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($cpy_slider_trn_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cpy_slider_trn_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_slider_trn_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($cpy_slider_trn_list->TotalRecs == 0 && $cpy_slider_trn->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cpy_slider_trn_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<script type="text/javascript">
fcpy_slider_trnlistsrch.FilterList = <?php echo $cpy_slider_trn_list->GetFilterList() ?>;
fcpy_slider_trnlistsrch.Init();
fcpy_slider_trnlist.Init();
</script>
<?php } ?>
<?php
$cpy_slider_trn_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cpy_slider_trn->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cpy_slider_trn_list->Page_Terminate();
?>
