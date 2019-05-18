<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_page_rowinfo.php" ?>
<?php include_once "cpy_pageinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "cpy_page_row_blockgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_page_row_add = NULL; // Initialize page object first

class ccpy_page_row_add extends ccpy_page_row {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_page_row';

	// Page object name
	var $PageObjName = 'cpy_page_row_add';

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

		// Table object (cpy_page_row)
		if (!isset($GLOBALS["cpy_page_row"]) || get_class($GLOBALS["cpy_page_row"]) == "ccpy_page_row") {
			$GLOBALS["cpy_page_row"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_page_row"];
		}

		// Table object (cpy_page)
		if (!isset($GLOBALS['cpy_page'])) $GLOBALS['cpy_page'] = new ccpy_page();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_page_row', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_page_rowlist.php"));
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
		$this->page_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->color_id->SetVisibility();
		$this->slid_id->SetVisibility();
		$this->row_order->SetVisibility();
		$this->row_name->SetVisibility();
		$this->row_stext->SetVisibility();

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
				if (in_array("cpy_page_row_block", $DetailTblVar)) {

					// Process auto fill for detail table 'cpy_page_row_block'
					if (preg_match('/^fcpy_page_row_block(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["cpy_page_row_block_grid"])) $GLOBALS["cpy_page_row_block_grid"] = new ccpy_page_row_block_grid;
						$GLOBALS["cpy_page_row_block_grid"]->Page_Init();
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
		global $EW_EXPORT, $cpy_page_row;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_page_row);
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
					if ($pageName == "cpy_page_rowview.php")
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

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["row_id"] != "") {
				$this->row_id->setQueryStringValue($_GET["row_id"]);
				$this->setKey("row_id", $this->row_id->CurrentValue); // Set up key
			} else {
				$this->setKey("row_id", ""); // Clear key
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
					$this->Page_Terminate("cpy_page_rowlist.php"); // No matching record, return to list
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
					if (ew_GetPageName($sReturnUrl) == "cpy_page_rowlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "cpy_page_rowview.php")
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
		$this->row_id->CurrentValue = NULL;
		$this->row_id->OldValue = $this->row_id->CurrentValue;
		$this->page_id->CurrentValue = NULL;
		$this->page_id->OldValue = $this->page_id->CurrentValue;
		$this->lang_id->CurrentValue = 1;
		$this->status_id->CurrentValue = 1;
		$this->color_id->CurrentValue = 0;
		$this->slid_id->CurrentValue = 0;
		$this->row_order->CurrentValue = 0;
		$this->row_name->CurrentValue = NULL;
		$this->row_name->OldValue = $this->row_name->CurrentValue;
		$this->row_stext->CurrentValue = NULL;
		$this->row_stext->OldValue = $this->row_stext->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->page_id->FldIsDetailKey) {
			$this->page_id->setFormValue($objForm->GetValue("x_page_id"));
		}
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->color_id->FldIsDetailKey) {
			$this->color_id->setFormValue($objForm->GetValue("x_color_id"));
		}
		if (!$this->slid_id->FldIsDetailKey) {
			$this->slid_id->setFormValue($objForm->GetValue("x_slid_id"));
		}
		if (!$this->row_order->FldIsDetailKey) {
			$this->row_order->setFormValue($objForm->GetValue("x_row_order"));
		}
		if (!$this->row_name->FldIsDetailKey) {
			$this->row_name->setFormValue($objForm->GetValue("x_row_name"));
		}
		if (!$this->row_stext->FldIsDetailKey) {
			$this->row_stext->setFormValue($objForm->GetValue("x_row_stext"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->page_id->CurrentValue = $this->page_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->color_id->CurrentValue = $this->color_id->FormValue;
		$this->slid_id->CurrentValue = $this->slid_id->FormValue;
		$this->row_order->CurrentValue = $this->row_order->FormValue;
		$this->row_name->CurrentValue = $this->row_name->FormValue;
		$this->row_stext->CurrentValue = $this->row_stext->FormValue;
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
		$this->row_id->setDbValue($row['row_id']);
		$this->page_id->setDbValue($row['page_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->color_id->setDbValue($row['color_id']);
		$this->slid_id->setDbValue($row['slid_id']);
		$this->row_order->setDbValue($row['row_order']);
		$this->row_name->setDbValue($row['row_name']);
		$this->row_stext->setDbValue($row['row_stext']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['row_id'] = $this->row_id->CurrentValue;
		$row['page_id'] = $this->page_id->CurrentValue;
		$row['lang_id'] = $this->lang_id->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['color_id'] = $this->color_id->CurrentValue;
		$row['slid_id'] = $this->slid_id->CurrentValue;
		$row['row_order'] = $this->row_order->CurrentValue;
		$row['row_name'] = $this->row_name->CurrentValue;
		$row['row_stext'] = $this->row_stext->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->row_id->DbValue = $row['row_id'];
		$this->page_id->DbValue = $row['page_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->color_id->DbValue = $row['color_id'];
		$this->slid_id->DbValue = $row['slid_id'];
		$this->row_order->DbValue = $row['row_order'];
		$this->row_name->DbValue = $row['row_name'];
		$this->row_stext->DbValue = $row['row_stext'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("row_id")) <> "")
			$this->row_id->CurrentValue = $this->getKey("row_id"); // row_id
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
		// row_id
		// page_id
		// lang_id
		// status_id
		// color_id
		// slid_id
		// row_order
		// row_name
		// row_stext

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// page_id
		if (strval($this->page_id->CurrentValue) <> "") {
			$sFilterWrk = "`page_id`" . ew_SearchString("=", $this->page_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `page_id`, `page_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page`";
		$sWhereWrk = "";
		$this->page_id->LookupFilters = array("dx1" => '`page_name`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->page_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `page_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->page_id->ViewValue = $this->page_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->page_id->ViewValue = $this->page_id->CurrentValue;
			}
		} else {
			$this->page_id->ViewValue = NULL;
		}
		$this->page_id->ViewCustomAttributes = "";

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

		// color_id
		if (strval($this->color_id->CurrentValue) <> "") {
			$sFilterWrk = "`color_id`" . ew_SearchString("=", $this->color_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `color_id`, `color_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_color`";
		$sWhereWrk = "";
		$this->color_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->color_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `color_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->color_id->ViewValue = $this->color_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->color_id->ViewValue = $this->color_id->CurrentValue;
			}
		} else {
			$this->color_id->ViewValue = NULL;
		}
		$this->color_id->ViewCustomAttributes = "";

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

		// row_order
		$this->row_order->ViewValue = $this->row_order->CurrentValue;
		$this->row_order->ViewCustomAttributes = "";

		// row_name
		$this->row_name->ViewValue = $this->row_name->CurrentValue;
		$this->row_name->ViewCustomAttributes = "";

		// row_stext
		$this->row_stext->ViewValue = $this->row_stext->CurrentValue;
		$this->row_stext->ViewCustomAttributes = "";

			// page_id
			$this->page_id->LinkCustomAttributes = "";
			$this->page_id->HrefValue = "";
			$this->page_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// color_id
			$this->color_id->LinkCustomAttributes = "";
			$this->color_id->HrefValue = "";
			$this->color_id->TooltipValue = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// row_order
			$this->row_order->LinkCustomAttributes = "";
			$this->row_order->HrefValue = "";
			$this->row_order->TooltipValue = "";

			// row_name
			$this->row_name->LinkCustomAttributes = "";
			$this->row_name->HrefValue = "";
			$this->row_name->TooltipValue = "";

			// row_stext
			$this->row_stext->LinkCustomAttributes = "";
			$this->row_stext->HrefValue = "";
			$this->row_stext->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// page_id
			$this->page_id->EditCustomAttributes = "";
			if ($this->page_id->getSessionValue() <> "") {
				$this->page_id->CurrentValue = $this->page_id->getSessionValue();
			if (strval($this->page_id->CurrentValue) <> "") {
				$sFilterWrk = "`page_id`" . ew_SearchString("=", $this->page_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `page_id`, `page_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page`";
			$sWhereWrk = "";
			$this->page_id->LookupFilters = array("dx1" => '`page_name`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->page_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `page_name`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->page_id->ViewValue = $this->page_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->page_id->ViewValue = $this->page_id->CurrentValue;
				}
			} else {
				$this->page_id->ViewValue = NULL;
			}
			$this->page_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->page_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`page_id`" . ew_SearchString("=", $this->page_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `page_id`, `page_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_page`";
			$sWhereWrk = "";
			$this->page_id->LookupFilters = array("dx1" => '`page_name`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->page_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `page_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->page_id->ViewValue = $this->page_id->DisplayValue($arwrk);
			} else {
				$this->page_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->page_id->EditValue = $arwrk;
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

			// color_id
			$this->color_id->EditAttrs["class"] = "form-control";
			$this->color_id->EditCustomAttributes = "";
			if (trim(strval($this->color_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`color_id`" . ew_SearchString("=", $this->color_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `color_id`, `color_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_color`";
			$sWhereWrk = "";
			$this->color_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->color_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `color_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->color_id->EditValue = $arwrk;

			// slid_id
			$this->slid_id->EditAttrs["class"] = "form-control";
			$this->slid_id->EditCustomAttributes = "";
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

			// row_order
			$this->row_order->EditAttrs["class"] = "form-control";
			$this->row_order->EditCustomAttributes = "";
			$this->row_order->EditValue = ew_HtmlEncode($this->row_order->CurrentValue);
			$this->row_order->PlaceHolder = ew_RemoveHtml($this->row_order->FldCaption());

			// row_name
			$this->row_name->EditAttrs["class"] = "form-control";
			$this->row_name->EditCustomAttributes = "";
			$this->row_name->EditValue = ew_HtmlEncode($this->row_name->CurrentValue);
			$this->row_name->PlaceHolder = ew_RemoveHtml($this->row_name->FldCaption());

			// row_stext
			$this->row_stext->EditAttrs["class"] = "form-control";
			$this->row_stext->EditCustomAttributes = "";
			$this->row_stext->EditValue = ew_HtmlEncode($this->row_stext->CurrentValue);
			$this->row_stext->PlaceHolder = ew_RemoveHtml($this->row_stext->FldCaption());

			// Add refer script
			// page_id

			$this->page_id->LinkCustomAttributes = "";
			$this->page_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// color_id
			$this->color_id->LinkCustomAttributes = "";
			$this->color_id->HrefValue = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";

			// row_order
			$this->row_order->LinkCustomAttributes = "";
			$this->row_order->HrefValue = "";

			// row_name
			$this->row_name->LinkCustomAttributes = "";
			$this->row_name->HrefValue = "";

			// row_stext
			$this->row_stext->LinkCustomAttributes = "";
			$this->row_stext->HrefValue = "";
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
		if (!$this->page_id->FldIsDetailKey && !is_null($this->page_id->FormValue) && $this->page_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->page_id->FldCaption(), $this->page_id->ReqErrMsg));
		}
		if (!$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if (!$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if (!$this->color_id->FldIsDetailKey && !is_null($this->color_id->FormValue) && $this->color_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->color_id->FldCaption(), $this->color_id->ReqErrMsg));
		}
		if (!$this->slid_id->FldIsDetailKey && !is_null($this->slid_id->FormValue) && $this->slid_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_id->FldCaption(), $this->slid_id->ReqErrMsg));
		}
		if (!$this->row_order->FldIsDetailKey && !is_null($this->row_order->FormValue) && $this->row_order->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->row_order->FldCaption(), $this->row_order->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->row_order->FormValue)) {
			ew_AddMessage($gsFormError, $this->row_order->FldErrMsg());
		}
		if (!$this->row_name->FldIsDetailKey && !is_null($this->row_name->FormValue) && $this->row_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->row_name->FldCaption(), $this->row_name->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("cpy_page_row_block", $DetailTblVar) && $GLOBALS["cpy_page_row_block"]->DetailAdd) {
			if (!isset($GLOBALS["cpy_page_row_block_grid"])) $GLOBALS["cpy_page_row_block_grid"] = new ccpy_page_row_block_grid(); // get detail page object
			$GLOBALS["cpy_page_row_block_grid"]->ValidateGridForm();
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

		// page_id
		$this->page_id->SetDbValueDef($rsnew, $this->page_id->CurrentValue, 0, FALSE);

		// lang_id
		$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, strval($this->lang_id->CurrentValue) == "");

		// status_id
		$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, strval($this->status_id->CurrentValue) == "");

		// color_id
		$this->color_id->SetDbValueDef($rsnew, $this->color_id->CurrentValue, 0, strval($this->color_id->CurrentValue) == "");

		// slid_id
		$this->slid_id->SetDbValueDef($rsnew, $this->slid_id->CurrentValue, 0, strval($this->slid_id->CurrentValue) == "");

		// row_order
		$this->row_order->SetDbValueDef($rsnew, $this->row_order->CurrentValue, 0, strval($this->row_order->CurrentValue) == "");

		// row_name
		$this->row_name->SetDbValueDef($rsnew, $this->row_name->CurrentValue, "", FALSE);

		// row_stext
		$this->row_stext->SetDbValueDef($rsnew, $this->row_stext->CurrentValue, NULL, FALSE);

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
			if (in_array("cpy_page_row_block", $DetailTblVar) && $GLOBALS["cpy_page_row_block"]->DetailAdd) {
				$GLOBALS["cpy_page_row_block"]->row_id->setSessionValue($this->row_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["cpy_page_row_block_grid"])) $GLOBALS["cpy_page_row_block_grid"] = new ccpy_page_row_block_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "cpy_page_row_block"); // Load user level of detail table
				$AddRow = $GLOBALS["cpy_page_row_block_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["cpy_page_row_block"]->row_id->setSessionValue(""); // Clear master key if insert failed
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
			if ($sMasterTblVar == "cpy_page") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_page_id"] <> "") {
					$GLOBALS["cpy_page"]->page_id->setQueryStringValue($_GET["fk_page_id"]);
					$this->page_id->setQueryStringValue($GLOBALS["cpy_page"]->page_id->QueryStringValue);
					$this->page_id->setSessionValue($this->page_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_page"]->page_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_page") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_page_id"] <> "") {
					$GLOBALS["cpy_page"]->page_id->setFormValue($_POST["fk_page_id"]);
					$this->page_id->setFormValue($GLOBALS["cpy_page"]->page_id->FormValue);
					$this->page_id->setSessionValue($this->page_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_page"]->page_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "cpy_page") {
				if ($this->page_id->CurrentValue == "") $this->page_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
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
			if (in_array("cpy_page_row_block", $DetailTblVar)) {
				if (!isset($GLOBALS["cpy_page_row_block_grid"]))
					$GLOBALS["cpy_page_row_block_grid"] = new ccpy_page_row_block_grid;
				if ($GLOBALS["cpy_page_row_block_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["cpy_page_row_block_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["cpy_page_row_block_grid"]->CurrentMode = "add";
					$GLOBALS["cpy_page_row_block_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["cpy_page_row_block_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cpy_page_row_block_grid"]->setStartRecordNumber(1);
					$GLOBALS["cpy_page_row_block_grid"]->row_id->FldIsDetailKey = TRUE;
					$GLOBALS["cpy_page_row_block_grid"]->row_id->CurrentValue = $this->row_id->CurrentValue;
					$GLOBALS["cpy_page_row_block_grid"]->row_id->setSessionValue($GLOBALS["cpy_page_row_block_grid"]->row_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_page_rowlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_page_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `page_id` AS `LinkFld`, `page_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`page_name`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`page_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->page_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `page_name`";
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
		case "x_color_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `color_id` AS `LinkFld`, `color_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_color`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`color_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->color_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `color_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_page_row_add)) $cpy_page_row_add = new ccpy_page_row_add();

// Page init
$cpy_page_row_add->Page_Init();

// Page main
$cpy_page_row_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_page_row_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fcpy_page_rowadd = new ew_Form("fcpy_page_rowadd", "add");

// Validate form
fcpy_page_rowadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_page_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->page_id->FldCaption(), $cpy_page_row->page_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->lang_id->FldCaption(), $cpy_page_row->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->status_id->FldCaption(), $cpy_page_row->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_color_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->color_id->FldCaption(), $cpy_page_row->color_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->slid_id->FldCaption(), $cpy_page_row->slid_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_row_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->row_order->FldCaption(), $cpy_page_row->row_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_row_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_page_row->row_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_row_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row->row_name->FldCaption(), $cpy_page_row->row_name->ReqErrMsg)) ?>");

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
fcpy_page_rowadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_page_rowadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_page_rowadd.Lists["x_page_id"] = {"LinkField":"x_page_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_page_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_page"};
fcpy_page_rowadd.Lists["x_page_id"].Data = "<?php echo $cpy_page_row_add->page_id->LookupFilterQuery(FALSE, "add") ?>";
fcpy_page_rowadd.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_page_rowadd.Lists["x_lang_id"].Data = "<?php echo $cpy_page_row_add->lang_id->LookupFilterQuery(FALSE, "add") ?>";
fcpy_page_rowadd.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_page_rowadd.Lists["x_status_id"].Data = "<?php echo $cpy_page_row_add->status_id->LookupFilterQuery(FALSE, "add") ?>";
fcpy_page_rowadd.Lists["x_color_id"] = {"LinkField":"x_color_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_color_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_color"};
fcpy_page_rowadd.Lists["x_color_id"].Data = "<?php echo $cpy_page_row_add->color_id->LookupFilterQuery(FALSE, "add") ?>";
fcpy_page_rowadd.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_page_rowadd.Lists["x_slid_id"].Data = "<?php echo $cpy_page_row_add->slid_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_page_row_add->ShowPageHeader(); ?>
<?php
$cpy_page_row_add->ShowMessage();
?>
<form name="fcpy_page_rowadd" id="fcpy_page_rowadd" class="<?php echo $cpy_page_row_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_page_row_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_page_row_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_page_row">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($cpy_page_row_add->IsModal) ?>">
<?php if ($cpy_page_row->getCurrentMasterTable() == "cpy_page") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="cpy_page">
<input type="hidden" name="fk_page_id" value="<?php echo $cpy_page_row->page_id->getSessionValue() ?>">
<?php } ?>
<div class="ewAddDiv"><!-- page* -->
<?php if ($cpy_page_row->page_id->Visible) { // page_id ?>
	<div id="r_page_id" class="form-group">
		<label id="elh_cpy_page_row_page_id" for="x_page_id" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->page_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->page_id->CellAttributes() ?>>
<?php if ($cpy_page_row->page_id->getSessionValue() <> "") { ?>
<span id="el_cpy_page_row_page_id">
<span<?php echo $cpy_page_row->page_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row->page_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_page_id" name="x_page_id" value="<?php echo ew_HtmlEncode($cpy_page_row->page_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cpy_page_row_page_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_page_id"><?php echo (strval($cpy_page_row->page_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row->page_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row->page_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_page_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row->page_id->ReadOnly || $cpy_page_row->page_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row" data-field="x_page_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row->page_id->DisplayValueSeparatorAttribute() ?>" name="x_page_id" id="x_page_id" value="<?php echo $cpy_page_row->page_id->CurrentValue ?>"<?php echo $cpy_page_row->page_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $cpy_page_row->page_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label id="elh_cpy_page_row_lang_id" for="x_lang_id" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->lang_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->lang_id->CellAttributes() ?>>
<span id="el_cpy_page_row_lang_id">
<select data-table="cpy_page_row" data-field="x_lang_id" data-value-separator="<?php echo $cpy_page_row->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $cpy_page_row->lang_id->EditAttributes() ?>>
<?php echo $cpy_page_row->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $cpy_page_row->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_cpy_page_row_status_id" for="x_status_id" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->status_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->status_id->CellAttributes() ?>>
<span id="el_cpy_page_row_status_id">
<select data-table="cpy_page_row" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_page_row->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $cpy_page_row->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->color_id->Visible) { // color_id ?>
	<div id="r_color_id" class="form-group">
		<label id="elh_cpy_page_row_color_id" for="x_color_id" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->color_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->color_id->CellAttributes() ?>>
<span id="el_cpy_page_row_color_id">
<select data-table="cpy_page_row" data-field="x_color_id" data-value-separator="<?php echo $cpy_page_row->color_id->DisplayValueSeparatorAttribute() ?>" id="x_color_id" name="x_color_id"<?php echo $cpy_page_row->color_id->EditAttributes() ?>>
<?php echo $cpy_page_row->color_id->SelectOptionListHtml("x_color_id") ?>
</select>
</span>
<?php echo $cpy_page_row->color_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->slid_id->Visible) { // slid_id ?>
	<div id="r_slid_id" class="form-group">
		<label id="elh_cpy_page_row_slid_id" for="x_slid_id" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->slid_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->slid_id->CellAttributes() ?>>
<span id="el_cpy_page_row_slid_id">
<select data-table="cpy_page_row" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row->slid_id->DisplayValueSeparatorAttribute() ?>" id="x_slid_id" name="x_slid_id"<?php echo $cpy_page_row->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row->slid_id->SelectOptionListHtml("x_slid_id") ?>
</select>
</span>
<?php echo $cpy_page_row->slid_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->row_order->Visible) { // row_order ?>
	<div id="r_row_order" class="form-group">
		<label id="elh_cpy_page_row_row_order" for="x_row_order" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->row_order->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->row_order->CellAttributes() ?>>
<span id="el_cpy_page_row_row_order">
<input type="text" data-table="cpy_page_row" data-field="x_row_order" name="x_row_order" id="x_row_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_order->EditValue ?>"<?php echo $cpy_page_row->row_order->EditAttributes() ?>>
</span>
<?php echo $cpy_page_row->row_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->row_name->Visible) { // row_name ?>
	<div id="r_row_name" class="form-group">
		<label id="elh_cpy_page_row_row_name" for="x_row_name" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->row_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->row_name->CellAttributes() ?>>
<span id="el_cpy_page_row_row_name">
<input type="text" data-table="cpy_page_row" data-field="x_row_name" name="x_row_name" id="x_row_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row->row_name->EditValue ?>"<?php echo $cpy_page_row->row_name->EditAttributes() ?>>
</span>
<?php echo $cpy_page_row->row_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row->row_stext->Visible) { // row_stext ?>
	<div id="r_row_stext" class="form-group">
		<label id="elh_cpy_page_row_row_stext" for="x_row_stext" class="<?php echo $cpy_page_row_add->LeftColumnClass ?>"><?php echo $cpy_page_row->row_stext->FldCaption() ?></label>
		<div class="<?php echo $cpy_page_row_add->RightColumnClass ?>"><div<?php echo $cpy_page_row->row_stext->CellAttributes() ?>>
<span id="el_cpy_page_row_row_stext">
<textarea data-table="cpy_page_row" data-field="x_row_stext" name="x_row_stext" id="x_row_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row->row_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row->row_stext->EditAttributes() ?>><?php echo $cpy_page_row->row_stext->EditValue ?></textarea>
</span>
<?php echo $cpy_page_row->row_stext->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("cpy_page_row_block", explode(",", $cpy_page_row->getCurrentDetailTable())) && $cpy_page_row_block->DetailAdd) {
?>
<?php if ($cpy_page_row->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("cpy_page_row_block", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cpy_page_row_blockgrid.php" ?>
<?php } ?>
<?php if (!$cpy_page_row_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_page_row_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_page_row_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_page_rowadd.Init();
</script>
<?php
$cpy_page_row_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_page_row_add->Page_Terminate();
?>
