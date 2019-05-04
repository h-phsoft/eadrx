<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_page_row_blockinfo.php" ?>
<?php include_once "cpy_page_rowinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_page_row_block_edit = NULL; // Initialize page object first

class ccpy_page_row_block_edit extends ccpy_page_row_block {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_page_row_block';

	// Page object name
	var $PageObjName = 'cpy_page_row_block_edit';

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

		// Table object (cpy_page_row_block)
		if (!isset($GLOBALS["cpy_page_row_block"]) || get_class($GLOBALS["cpy_page_row_block"]) == "ccpy_page_row_block") {
			$GLOBALS["cpy_page_row_block"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_page_row_block"];
		}

		// Table object (cpy_page_row)
		if (!isset($GLOBALS['cpy_page_row'])) $GLOBALS['cpy_page_row'] = new ccpy_page_row();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_page_row_block', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_page_row_blocklist.php"));
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
		$this->row_id->SetVisibility();
		$this->type_id->SetVisibility();
		$this->slid_id->SetVisibility();
		$this->video_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->cols_id->SetVisibility();
		$this->blk_order->SetVisibility();
		$this->blk_name->SetVisibility();
		$this->blk_header->SetVisibility();
		$this->blk_image->SetVisibility();
		$this->blk_stext->SetVisibility();
		$this->blk_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_page_row_block;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_page_row_block);
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
					if ($pageName == "cpy_page_row_blockview.php")
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
			if ($objForm->HasValue("x_blk_id")) {
				$this->blk_id->setFormValue($objForm->GetValue("x_blk_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["blk_id"])) {
				$this->blk_id->setQueryStringValue($_GET["blk_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->blk_id->CurrentValue = NULL;
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
			$this->Page_Terminate("cpy_page_row_blocklist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->blk_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->blk_id->CurrentValue) == strval($this->Recordset->fields('blk_id'))) {
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
					$this->Page_Terminate("cpy_page_row_blocklist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "cpy_page_row_blocklist.php")
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
		$this->blk_image->Upload->Index = $objForm->Index;
		$this->blk_image->Upload->UploadFile();
		$this->blk_image->CurrentValue = $this->blk_image->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->row_id->FldIsDetailKey) {
			$this->row_id->setFormValue($objForm->GetValue("x_row_id"));
		}
		if (!$this->type_id->FldIsDetailKey) {
			$this->type_id->setFormValue($objForm->GetValue("x_type_id"));
		}
		if (!$this->slid_id->FldIsDetailKey) {
			$this->slid_id->setFormValue($objForm->GetValue("x_slid_id"));
		}
		if (!$this->video_id->FldIsDetailKey) {
			$this->video_id->setFormValue($objForm->GetValue("x_video_id"));
		}
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->cols_id->FldIsDetailKey) {
			$this->cols_id->setFormValue($objForm->GetValue("x_cols_id"));
		}
		if (!$this->blk_order->FldIsDetailKey) {
			$this->blk_order->setFormValue($objForm->GetValue("x_blk_order"));
		}
		if (!$this->blk_name->FldIsDetailKey) {
			$this->blk_name->setFormValue($objForm->GetValue("x_blk_name"));
		}
		if (!$this->blk_header->FldIsDetailKey) {
			$this->blk_header->setFormValue($objForm->GetValue("x_blk_header"));
		}
		if (!$this->blk_stext->FldIsDetailKey) {
			$this->blk_stext->setFormValue($objForm->GetValue("x_blk_stext"));
		}
		if (!$this->blk_text->FldIsDetailKey) {
			$this->blk_text->setFormValue($objForm->GetValue("x_blk_text"));
		}
		if (!$this->blk_id->FldIsDetailKey)
			$this->blk_id->setFormValue($objForm->GetValue("x_blk_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->blk_id->CurrentValue = $this->blk_id->FormValue;
		$this->row_id->CurrentValue = $this->row_id->FormValue;
		$this->type_id->CurrentValue = $this->type_id->FormValue;
		$this->slid_id->CurrentValue = $this->slid_id->FormValue;
		$this->video_id->CurrentValue = $this->video_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->cols_id->CurrentValue = $this->cols_id->FormValue;
		$this->blk_order->CurrentValue = $this->blk_order->FormValue;
		$this->blk_name->CurrentValue = $this->blk_name->FormValue;
		$this->blk_header->CurrentValue = $this->blk_header->FormValue;
		$this->blk_stext->CurrentValue = $this->blk_stext->FormValue;
		$this->blk_text->CurrentValue = $this->blk_text->FormValue;
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
		$this->blk_id->setDbValue($row['blk_id']);
		$this->row_id->setDbValue($row['row_id']);
		$this->type_id->setDbValue($row['type_id']);
		$this->slid_id->setDbValue($row['slid_id']);
		$this->video_id->setDbValue($row['video_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->cols_id->setDbValue($row['cols_id']);
		$this->blk_order->setDbValue($row['blk_order']);
		$this->blk_name->setDbValue($row['blk_name']);
		$this->blk_header->setDbValue($row['blk_header']);
		$this->blk_image->Upload->DbValue = $row['blk_image'];
		$this->blk_image->setDbValue($this->blk_image->Upload->DbValue);
		$this->blk_stext->setDbValue($row['blk_stext']);
		$this->blk_text->setDbValue($row['blk_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['blk_id'] = NULL;
		$row['row_id'] = NULL;
		$row['type_id'] = NULL;
		$row['slid_id'] = NULL;
		$row['video_id'] = NULL;
		$row['status_id'] = NULL;
		$row['cols_id'] = NULL;
		$row['blk_order'] = NULL;
		$row['blk_name'] = NULL;
		$row['blk_header'] = NULL;
		$row['blk_image'] = NULL;
		$row['blk_stext'] = NULL;
		$row['blk_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->blk_id->DbValue = $row['blk_id'];
		$this->row_id->DbValue = $row['row_id'];
		$this->type_id->DbValue = $row['type_id'];
		$this->slid_id->DbValue = $row['slid_id'];
		$this->video_id->DbValue = $row['video_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->cols_id->DbValue = $row['cols_id'];
		$this->blk_order->DbValue = $row['blk_order'];
		$this->blk_name->DbValue = $row['blk_name'];
		$this->blk_header->DbValue = $row['blk_header'];
		$this->blk_image->Upload->DbValue = $row['blk_image'];
		$this->blk_stext->DbValue = $row['blk_stext'];
		$this->blk_text->DbValue = $row['blk_text'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("blk_id")) <> "")
			$this->blk_id->CurrentValue = $this->getKey("blk_id"); // blk_id
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
		// blk_id
		// row_id
		// type_id
		// slid_id
		// video_id
		// status_id
		// cols_id
		// blk_order
		// blk_name
		// blk_header
		// blk_image
		// blk_stext
		// blk_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		if (strval($this->row_id->CurrentValue) <> "") {
			$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
		$sWhereWrk = "";
		$this->row_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->row_id->ViewValue = $this->row_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->row_id->ViewValue = $this->row_id->CurrentValue;
			}
		} else {
			$this->row_id->ViewValue = NULL;
		}
		$this->row_id->ViewCustomAttributes = "";

		// type_id
		if (strval($this->type_id->CurrentValue) <> "") {
			$sFilterWrk = "`type_id`" . ew_SearchString("=", $this->type_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `type_id`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_block_type`";
		$sWhereWrk = "";
		$this->type_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `type_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->type_id->ViewValue = $this->type_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->type_id->ViewValue = $this->type_id->CurrentValue;
			}
		} else {
			$this->type_id->ViewValue = NULL;
		}
		$this->type_id->ViewCustomAttributes = "";

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

		// video_id
		if (strval($this->video_id->CurrentValue) <> "") {
			$sFilterWrk = "`video_id`" . ew_SearchString("=", $this->video_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `video_id`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_video`";
		$sWhereWrk = "";
		$this->video_id->LookupFilters = array("dx1" => '`video_name`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `video_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->video_id->ViewValue = $this->video_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->video_id->ViewValue = $this->video_id->CurrentValue;
			}
		} else {
			$this->video_id->ViewValue = NULL;
		}
		$this->video_id->ViewCustomAttributes = "";

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

		// cols_id
		if (strval($this->cols_id->CurrentValue) <> "") {
			$sFilterWrk = "`cols_id`" . ew_SearchString("=", $this->cols_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cols_id`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_cols`";
		$sWhereWrk = "";
		$this->cols_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cols_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cols_id->ViewValue = $this->cols_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cols_id->ViewValue = $this->cols_id->CurrentValue;
			}
		} else {
			$this->cols_id->ViewValue = NULL;
		}
		$this->cols_id->ViewCustomAttributes = "";

		// blk_order
		$this->blk_order->ViewValue = $this->blk_order->CurrentValue;
		$this->blk_order->ViewCustomAttributes = "";

		// blk_name
		$this->blk_name->ViewValue = $this->blk_name->CurrentValue;
		$this->blk_name->ViewCustomAttributes = "";

		// blk_header
		$this->blk_header->ViewValue = $this->blk_header->CurrentValue;
		$this->blk_header->ViewCustomAttributes = "";

		// blk_image
		$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
		if (!ew_Empty($this->blk_image->Upload->DbValue)) {
			$this->blk_image->ImageWidth = 200;
			$this->blk_image->ImageHeight = 0;
			$this->blk_image->ImageAlt = $this->blk_image->FldAlt();
			$this->blk_image->ViewValue = $this->blk_image->Upload->DbValue;
		} else {
			$this->blk_image->ViewValue = "";
		}
		$this->blk_image->ViewCustomAttributes = "";

		// blk_stext
		$this->blk_stext->ViewValue = $this->blk_stext->CurrentValue;
		$this->blk_stext->ViewCustomAttributes = "";

		// blk_text
		$this->blk_text->ViewValue = $this->blk_text->CurrentValue;
		$this->blk_text->ViewCustomAttributes = "";

			// row_id
			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";
			$this->row_id->TooltipValue = "";

			// type_id
			$this->type_id->LinkCustomAttributes = "";
			$this->type_id->HrefValue = "";
			$this->type_id->TooltipValue = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// video_id
			$this->video_id->LinkCustomAttributes = "";
			$this->video_id->HrefValue = "";
			$this->video_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// cols_id
			$this->cols_id->LinkCustomAttributes = "";
			$this->cols_id->HrefValue = "";
			$this->cols_id->TooltipValue = "";

			// blk_order
			$this->blk_order->LinkCustomAttributes = "";
			$this->blk_order->HrefValue = "";
			$this->blk_order->TooltipValue = "";

			// blk_name
			$this->blk_name->LinkCustomAttributes = "";
			$this->blk_name->HrefValue = "";
			$this->blk_name->TooltipValue = "";

			// blk_header
			$this->blk_header->LinkCustomAttributes = "";
			$this->blk_header->HrefValue = "";
			$this->blk_header->TooltipValue = "";

			// blk_image
			$this->blk_image->LinkCustomAttributes = "";
			$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
			if (!ew_Empty($this->blk_image->Upload->DbValue)) {
				$this->blk_image->HrefValue = ew_GetFileUploadUrl($this->blk_image, $this->blk_image->Upload->DbValue); // Add prefix/suffix
				$this->blk_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->blk_image->HrefValue = ew_FullUrl($this->blk_image->HrefValue, "href");
			} else {
				$this->blk_image->HrefValue = "";
			}
			$this->blk_image->HrefValue2 = $this->blk_image->UploadPath . $this->blk_image->Upload->DbValue;
			$this->blk_image->TooltipValue = "";
			if ($this->blk_image->UseColorbox) {
				if (ew_Empty($this->blk_image->TooltipValue))
					$this->blk_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->blk_image->LinkAttrs["data-rel"] = "cpy_page_row_block_x_blk_image";
				ew_AppendClass($this->blk_image->LinkAttrs["class"], "ewLightbox");
			}

			// blk_stext
			$this->blk_stext->LinkCustomAttributes = "";
			$this->blk_stext->HrefValue = "";
			$this->blk_stext->TooltipValue = "";

			// blk_text
			$this->blk_text->LinkCustomAttributes = "";
			$this->blk_text->HrefValue = "";
			$this->blk_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// row_id
			$this->row_id->EditAttrs["class"] = "form-control";
			$this->row_id->EditCustomAttributes = "";
			if ($this->row_id->getSessionValue() <> "") {
				$this->row_id->CurrentValue = $this->row_id->getSessionValue();
			if (strval($this->row_id->CurrentValue) <> "") {
				$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
			$sWhereWrk = "";
			$this->row_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `row_name`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->row_id->ViewValue = $this->row_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->row_id->ViewValue = $this->row_id->CurrentValue;
				}
			} else {
				$this->row_id->ViewValue = NULL;
			}
			$this->row_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->row_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_page_row`";
			$sWhereWrk = "";
			$this->row_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->row_id->EditValue = $arwrk;
			}

			// type_id
			$this->type_id->EditAttrs["class"] = "form-control";
			$this->type_id->EditCustomAttributes = "";
			if (trim(strval($this->type_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`type_id`" . ew_SearchString("=", $this->type_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `type_id`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_block_type`";
			$sWhereWrk = "";
			$this->type_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `type_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->type_id->EditValue = $arwrk;

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

			// video_id
			$this->video_id->EditCustomAttributes = "";
			if (trim(strval($this->video_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`video_id`" . ew_SearchString("=", $this->video_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `video_id`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_video`";
			$sWhereWrk = "";
			$this->video_id->LookupFilters = array("dx1" => '`video_name`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `video_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->video_id->ViewValue = $this->video_id->DisplayValue($arwrk);
			} else {
				$this->video_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->video_id->EditValue = $arwrk;

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

			// cols_id
			$this->cols_id->EditAttrs["class"] = "form-control";
			$this->cols_id->EditCustomAttributes = "";
			if (trim(strval($this->cols_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cols_id`" . ew_SearchString("=", $this->cols_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cols_id`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_cols`";
			$sWhereWrk = "";
			$this->cols_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cols_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cols_id->EditValue = $arwrk;

			// blk_order
			$this->blk_order->EditAttrs["class"] = "form-control";
			$this->blk_order->EditCustomAttributes = "";
			$this->blk_order->EditValue = ew_HtmlEncode($this->blk_order->CurrentValue);
			$this->blk_order->PlaceHolder = ew_RemoveHtml($this->blk_order->FldCaption());

			// blk_name
			$this->blk_name->EditAttrs["class"] = "form-control";
			$this->blk_name->EditCustomAttributes = "";
			$this->blk_name->EditValue = ew_HtmlEncode($this->blk_name->CurrentValue);
			$this->blk_name->PlaceHolder = ew_RemoveHtml($this->blk_name->FldCaption());

			// blk_header
			$this->blk_header->EditAttrs["class"] = "form-control";
			$this->blk_header->EditCustomAttributes = "";
			$this->blk_header->EditValue = ew_HtmlEncode($this->blk_header->CurrentValue);
			$this->blk_header->PlaceHolder = ew_RemoveHtml($this->blk_header->FldCaption());

			// blk_image
			$this->blk_image->EditAttrs["class"] = "form-control";
			$this->blk_image->EditCustomAttributes = "";
			$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
			if (!ew_Empty($this->blk_image->Upload->DbValue)) {
				$this->blk_image->ImageWidth = 200;
				$this->blk_image->ImageHeight = 0;
				$this->blk_image->ImageAlt = $this->blk_image->FldAlt();
				$this->blk_image->EditValue = $this->blk_image->Upload->DbValue;
			} else {
				$this->blk_image->EditValue = "";
			}
			if (!ew_Empty($this->blk_image->CurrentValue))
					$this->blk_image->Upload->FileName = $this->blk_image->CurrentValue;
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->blk_image);

			// blk_stext
			$this->blk_stext->EditAttrs["class"] = "form-control";
			$this->blk_stext->EditCustomAttributes = "";
			$this->blk_stext->EditValue = ew_HtmlEncode($this->blk_stext->CurrentValue);
			$this->blk_stext->PlaceHolder = ew_RemoveHtml($this->blk_stext->FldCaption());

			// blk_text
			$this->blk_text->EditAttrs["class"] = "form-control";
			$this->blk_text->EditCustomAttributes = "";
			$this->blk_text->EditValue = ew_HtmlEncode($this->blk_text->CurrentValue);
			$this->blk_text->PlaceHolder = ew_RemoveHtml($this->blk_text->FldCaption());

			// Edit refer script
			// row_id

			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";

			// type_id
			$this->type_id->LinkCustomAttributes = "";
			$this->type_id->HrefValue = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";

			// video_id
			$this->video_id->LinkCustomAttributes = "";
			$this->video_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// cols_id
			$this->cols_id->LinkCustomAttributes = "";
			$this->cols_id->HrefValue = "";

			// blk_order
			$this->blk_order->LinkCustomAttributes = "";
			$this->blk_order->HrefValue = "";

			// blk_name
			$this->blk_name->LinkCustomAttributes = "";
			$this->blk_name->HrefValue = "";

			// blk_header
			$this->blk_header->LinkCustomAttributes = "";
			$this->blk_header->HrefValue = "";

			// blk_image
			$this->blk_image->LinkCustomAttributes = "";
			$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
			if (!ew_Empty($this->blk_image->Upload->DbValue)) {
				$this->blk_image->HrefValue = ew_GetFileUploadUrl($this->blk_image, $this->blk_image->Upload->DbValue); // Add prefix/suffix
				$this->blk_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->blk_image->HrefValue = ew_FullUrl($this->blk_image->HrefValue, "href");
			} else {
				$this->blk_image->HrefValue = "";
			}
			$this->blk_image->HrefValue2 = $this->blk_image->UploadPath . $this->blk_image->Upload->DbValue;

			// blk_stext
			$this->blk_stext->LinkCustomAttributes = "";
			$this->blk_stext->HrefValue = "";

			// blk_text
			$this->blk_text->LinkCustomAttributes = "";
			$this->blk_text->HrefValue = "";
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
		if (!$this->row_id->FldIsDetailKey && !is_null($this->row_id->FormValue) && $this->row_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->row_id->FldCaption(), $this->row_id->ReqErrMsg));
		}
		if (!$this->type_id->FldIsDetailKey && !is_null($this->type_id->FormValue) && $this->type_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->type_id->FldCaption(), $this->type_id->ReqErrMsg));
		}
		if (!$this->slid_id->FldIsDetailKey && !is_null($this->slid_id->FormValue) && $this->slid_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_id->FldCaption(), $this->slid_id->ReqErrMsg));
		}
		if (!$this->video_id->FldIsDetailKey && !is_null($this->video_id->FormValue) && $this->video_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->video_id->FldCaption(), $this->video_id->ReqErrMsg));
		}
		if (!$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if (!$this->cols_id->FldIsDetailKey && !is_null($this->cols_id->FormValue) && $this->cols_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cols_id->FldCaption(), $this->cols_id->ReqErrMsg));
		}
		if (!$this->blk_order->FldIsDetailKey && !is_null($this->blk_order->FormValue) && $this->blk_order->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->blk_order->FldCaption(), $this->blk_order->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->blk_order->FormValue)) {
			ew_AddMessage($gsFormError, $this->blk_order->FldErrMsg());
		}
		if (!$this->blk_name->FldIsDetailKey && !is_null($this->blk_name->FormValue) && $this->blk_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->blk_name->FldCaption(), $this->blk_name->ReqErrMsg));
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
			$this->blk_image->OldUploadPath = '../../assets/pages/img/pageImages';
			$this->blk_image->UploadPath = $this->blk_image->OldUploadPath;
			$rsnew = array();

			// row_id
			$this->row_id->SetDbValueDef($rsnew, $this->row_id->CurrentValue, 0, $this->row_id->ReadOnly);

			// type_id
			$this->type_id->SetDbValueDef($rsnew, $this->type_id->CurrentValue, 0, $this->type_id->ReadOnly);

			// slid_id
			$this->slid_id->SetDbValueDef($rsnew, $this->slid_id->CurrentValue, 0, $this->slid_id->ReadOnly);

			// video_id
			$this->video_id->SetDbValueDef($rsnew, $this->video_id->CurrentValue, 0, $this->video_id->ReadOnly);

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly);

			// cols_id
			$this->cols_id->SetDbValueDef($rsnew, $this->cols_id->CurrentValue, 0, $this->cols_id->ReadOnly);

			// blk_order
			$this->blk_order->SetDbValueDef($rsnew, $this->blk_order->CurrentValue, 0, $this->blk_order->ReadOnly);

			// blk_name
			$this->blk_name->SetDbValueDef($rsnew, $this->blk_name->CurrentValue, "", $this->blk_name->ReadOnly);

			// blk_header
			$this->blk_header->SetDbValueDef($rsnew, $this->blk_header->CurrentValue, NULL, $this->blk_header->ReadOnly);

			// blk_image
			if ($this->blk_image->Visible && !$this->blk_image->ReadOnly && !$this->blk_image->Upload->KeepFile) {
				$this->blk_image->Upload->DbValue = $rsold['blk_image']; // Get original value
				if ($this->blk_image->Upload->FileName == "") {
					$rsnew['blk_image'] = NULL;
				} else {
					$rsnew['blk_image'] = $this->blk_image->Upload->FileName;
				}
			}

			// blk_stext
			$this->blk_stext->SetDbValueDef($rsnew, $this->blk_stext->CurrentValue, NULL, $this->blk_stext->ReadOnly);

			// blk_text
			$this->blk_text->SetDbValueDef($rsnew, $this->blk_text->CurrentValue, NULL, $this->blk_text->ReadOnly);
			if ($this->blk_image->Visible && !$this->blk_image->Upload->KeepFile) {
				$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
				$OldFiles = ew_Empty($this->blk_image->Upload->DbValue) ? array() : array($this->blk_image->Upload->DbValue);
				if (!ew_Empty($this->blk_image->Upload->FileName)) {
					$NewFiles = array($this->blk_image->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->blk_image->Upload->Index < 0) ? $this->blk_image->FldVar : substr($this->blk_image->FldVar, 0, 1) . $this->blk_image->Upload->Index . substr($this->blk_image->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->blk_image->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->blk_image->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->blk_image->TblVar) . $file1) || file_exists($this->blk_image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->blk_image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->blk_image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->blk_image->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->blk_image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->blk_image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->blk_image->SetDbValueDef($rsnew, $this->blk_image->Upload->FileName, NULL, $this->blk_image->ReadOnly);
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
					if ($this->blk_image->Visible && !$this->blk_image->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->blk_image->Upload->DbValue) ? array() : array($this->blk_image->Upload->DbValue);
						if (!ew_Empty($this->blk_image->Upload->FileName)) {
							$NewFiles = array($this->blk_image->Upload->FileName);
							$NewFiles2 = array($rsnew['blk_image']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->blk_image->Upload->Index < 0) ? $this->blk_image->FldVar : substr($this->blk_image->FldVar, 0, 1) . $this->blk_image->Upload->Index . substr($this->blk_image->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->blk_image->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->blk_image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// blk_image
		ew_CleanUploadTempPath($this->blk_image, $this->blk_image->Upload->Index);
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
			if ($sMasterTblVar == "cpy_page_row") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_row_id"] <> "") {
					$GLOBALS["cpy_page_row"]->row_id->setQueryStringValue($_GET["fk_row_id"]);
					$this->row_id->setQueryStringValue($GLOBALS["cpy_page_row"]->row_id->QueryStringValue);
					$this->row_id->setSessionValue($this->row_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_page_row"]->row_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_page_row") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_row_id"] <> "") {
					$GLOBALS["cpy_page_row"]->row_id->setFormValue($_POST["fk_row_id"]);
					$this->row_id->setFormValue($GLOBALS["cpy_page_row"]->row_id->FormValue);
					$this->row_id->setSessionValue($this->row_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_page_row"]->row_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cpy_page_row") {
				if ($this->row_id->CurrentValue == "") $this->row_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_page_row_blocklist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_row_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `row_id` AS `LinkFld`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`row_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `row_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_type_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `type_id` AS `LinkFld`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_block_type`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`type_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `type_id`";
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
		case "x_video_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `video_id` AS `LinkFld`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_video`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`video_name`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`video_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `video_name`";
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
		case "x_cols_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cols_id` AS `LinkFld`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_cols`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cols_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cols_id`";
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
if (!isset($cpy_page_row_block_edit)) $cpy_page_row_block_edit = new ccpy_page_row_block_edit();

// Page init
$cpy_page_row_block_edit->Page_Init();

// Page main
$cpy_page_row_block_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_page_row_block_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fcpy_page_row_blockedit = new ew_Form("fcpy_page_row_blockedit", "edit");

// Validate form
fcpy_page_row_blockedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_row_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->row_id->FldCaption(), $cpy_page_row_block->row_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_type_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->type_id->FldCaption(), $cpy_page_row_block->type_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_slid_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->slid_id->FldCaption(), $cpy_page_row_block->slid_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_video_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->video_id->FldCaption(), $cpy_page_row_block->video_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_status_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->status_id->FldCaption(), $cpy_page_row_block->status_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cols_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->cols_id->FldCaption(), $cpy_page_row_block->cols_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_blk_order");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->blk_order->FldCaption(), $cpy_page_row_block->blk_order->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_blk_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_page_row_block->blk_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_blk_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_page_row_block->blk_name->FldCaption(), $cpy_page_row_block->blk_name->ReqErrMsg)) ?>");

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
fcpy_page_row_blockedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_page_row_blockedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_page_row_blockedit.Lists["x_row_id"] = {"LinkField":"x_row_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_row_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_page_row"};
fcpy_page_row_blockedit.Lists["x_row_id"].Data = "<?php echo $cpy_page_row_block_edit->row_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_page_row_blockedit.Lists["x_type_id"] = {"LinkField":"x_type_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_type_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_block_type"};
fcpy_page_row_blockedit.Lists["x_type_id"].Data = "<?php echo $cpy_page_row_block_edit->type_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_page_row_blockedit.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_page_row_blockedit.Lists["x_slid_id"].Data = "<?php echo $cpy_page_row_block_edit->slid_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_page_row_blockedit.Lists["x_video_id"] = {"LinkField":"x_video_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_video_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_video"};
fcpy_page_row_blockedit.Lists["x_video_id"].Data = "<?php echo $cpy_page_row_block_edit->video_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_page_row_blockedit.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_page_row_blockedit.Lists["x_status_id"].Data = "<?php echo $cpy_page_row_block_edit->status_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_page_row_blockedit.Lists["x_cols_id"] = {"LinkField":"x_cols_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cols_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_cols"};
fcpy_page_row_blockedit.Lists["x_cols_id"].Data = "<?php echo $cpy_page_row_block_edit->cols_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_page_row_block_edit->ShowPageHeader(); ?>
<?php
$cpy_page_row_block_edit->ShowMessage();
?>
<?php if (!$cpy_page_row_block_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cpy_page_row_block_edit->Pager)) $cpy_page_row_block_edit->Pager = new cPrevNextPager($cpy_page_row_block_edit->StartRec, $cpy_page_row_block_edit->DisplayRecs, $cpy_page_row_block_edit->TotalRecs, $cpy_page_row_block_edit->AutoHidePager) ?>
<?php if ($cpy_page_row_block_edit->Pager->RecordCount > 0 && $cpy_page_row_block_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_page_row_block_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_page_row_block_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_page_row_block_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_page_row_block_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_page_row_block_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_page_row_block_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcpy_page_row_blockedit" id="fcpy_page_row_blockedit" class="<?php echo $cpy_page_row_block_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_page_row_block_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_page_row_block_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_page_row_block">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_page_row_block_edit->IsModal) ?>">
<?php if ($cpy_page_row_block->getCurrentMasterTable() == "cpy_page_row") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="cpy_page_row">
<input type="hidden" name="fk_row_id" value="<?php echo $cpy_page_row_block->row_id->getSessionValue() ?>">
<?php } ?>
<div class="ewEditDiv"><!-- page* -->
<?php if ($cpy_page_row_block->row_id->Visible) { // row_id ?>
	<div id="r_row_id" class="form-group">
		<label id="elh_cpy_page_row_block_row_id" for="x_row_id" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->row_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->row_id->CellAttributes() ?>>
<?php if ($cpy_page_row_block->row_id->getSessionValue() <> "") { ?>
<span id="el_cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_page_row_block->row_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_row_id" name="x_row_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->row_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cpy_page_row_block_row_id">
<select data-table="cpy_page_row_block" data-field="x_row_id" data-value-separator="<?php echo $cpy_page_row_block->row_id->DisplayValueSeparatorAttribute() ?>" id="x_row_id" name="x_row_id"<?php echo $cpy_page_row_block->row_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->SelectOptionListHtml("x_row_id") ?>
</select>
</span>
<?php } ?>
<?php echo $cpy_page_row_block->row_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->type_id->Visible) { // type_id ?>
	<div id="r_type_id" class="form-group">
		<label id="elh_cpy_page_row_block_type_id" for="x_type_id" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->type_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->type_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_type_id">
<select data-table="cpy_page_row_block" data-field="x_type_id" data-value-separator="<?php echo $cpy_page_row_block->type_id->DisplayValueSeparatorAttribute() ?>" id="x_type_id" name="x_type_id"<?php echo $cpy_page_row_block->type_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->SelectOptionListHtml("x_type_id") ?>
</select>
</span>
<?php echo $cpy_page_row_block->type_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->slid_id->Visible) { // slid_id ?>
	<div id="r_slid_id" class="form-group">
		<label id="elh_cpy_page_row_block_slid_id" for="x_slid_id" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->slid_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->slid_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_slid_id">
<select data-table="cpy_page_row_block" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row_block->slid_id->DisplayValueSeparatorAttribute() ?>" id="x_slid_id" name="x_slid_id"<?php echo $cpy_page_row_block->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->SelectOptionListHtml("x_slid_id") ?>
</select>
</span>
<?php echo $cpy_page_row_block->slid_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->video_id->Visible) { // video_id ?>
	<div id="r_video_id" class="form-group">
		<label id="elh_cpy_page_row_block_video_id" for="x_video_id" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->video_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->video_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_video_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_video_id"><?php echo (strval($cpy_page_row_block->video_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row_block->video_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row_block->video_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_video_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row_block->video_id->ReadOnly || $cpy_page_row_block->video_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row_block->video_id->DisplayValueSeparatorAttribute() ?>" name="x_video_id" id="x_video_id" value="<?php echo $cpy_page_row_block->video_id->CurrentValue ?>"<?php echo $cpy_page_row_block->video_id->EditAttributes() ?>>
</span>
<?php echo $cpy_page_row_block->video_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_cpy_page_row_block_status_id" for="x_status_id" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->status_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->status_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_status_id">
<select data-table="cpy_page_row_block" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row_block->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_page_row_block->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $cpy_page_row_block->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->cols_id->Visible) { // cols_id ?>
	<div id="r_cols_id" class="form-group">
		<label id="elh_cpy_page_row_block_cols_id" for="x_cols_id" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->cols_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->cols_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_cols_id">
<select data-table="cpy_page_row_block" data-field="x_cols_id" data-value-separator="<?php echo $cpy_page_row_block->cols_id->DisplayValueSeparatorAttribute() ?>" id="x_cols_id" name="x_cols_id"<?php echo $cpy_page_row_block->cols_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->SelectOptionListHtml("x_cols_id") ?>
</select>
</span>
<?php echo $cpy_page_row_block->cols_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_order->Visible) { // blk_order ?>
	<div id="r_blk_order" class="form-group">
		<label id="elh_cpy_page_row_block_blk_order" for="x_blk_order" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->blk_order->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_order->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_order">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_order" name="x_blk_order" id="x_blk_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_order->EditValue ?>"<?php echo $cpy_page_row_block->blk_order->EditAttributes() ?>>
</span>
<?php echo $cpy_page_row_block->blk_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_name->Visible) { // blk_name ?>
	<div id="r_blk_name" class="form-group">
		<label id="elh_cpy_page_row_block_blk_name" for="x_blk_name" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->blk_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_name->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_name">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_name" name="x_blk_name" id="x_blk_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_name->EditValue ?>"<?php echo $cpy_page_row_block->blk_name->EditAttributes() ?>>
</span>
<?php echo $cpy_page_row_block->blk_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_header->Visible) { // blk_header ?>
	<div id="r_blk_header" class="form-group">
		<label id="elh_cpy_page_row_block_blk_header" for="x_blk_header" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->blk_header->FldCaption() ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_header->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_header">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_header" name="x_blk_header" id="x_blk_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_header->EditValue ?>"<?php echo $cpy_page_row_block->blk_header->EditAttributes() ?>>
</span>
<?php echo $cpy_page_row_block->blk_header->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_image->Visible) { // blk_image ?>
	<div id="r_blk_image" class="form-group">
		<label id="elh_cpy_page_row_block_blk_image" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->blk_image->FldCaption() ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_image->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_image">
<div id="fd_x_blk_image">
<span title="<?php echo $cpy_page_row_block->blk_image->FldTitle() ? $cpy_page_row_block->blk_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_page_row_block->blk_image->ReadOnly || $cpy_page_row_block->blk_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_page_row_block" data-field="x_blk_image" name="x_blk_image" id="x_blk_image"<?php echo $cpy_page_row_block->blk_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_blk_image" id= "fn_x_blk_image" value="<?php echo $cpy_page_row_block->blk_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_blk_image"] == "0") { ?>
<input type="hidden" name="fa_x_blk_image" id= "fa_x_blk_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_blk_image" id= "fa_x_blk_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_blk_image" id= "fs_x_blk_image" value="200">
<input type="hidden" name="fx_x_blk_image" id= "fx_x_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_blk_image" id= "fm_x_blk_image" value="<?php echo $cpy_page_row_block->blk_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_blk_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $cpy_page_row_block->blk_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_stext->Visible) { // blk_stext ?>
	<div id="r_blk_stext" class="form-group">
		<label id="elh_cpy_page_row_block_blk_stext" for="x_blk_stext" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->blk_stext->FldCaption() ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_stext->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_stext">
<textarea data-table="cpy_page_row_block" data-field="x_blk_stext" name="x_blk_stext" id="x_blk_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->getPlaceHolder()) ?>"<?php echo $cpy_page_row_block->blk_stext->EditAttributes() ?>><?php echo $cpy_page_row_block->blk_stext->EditValue ?></textarea>
</span>
<?php echo $cpy_page_row_block->blk_stext->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_text->Visible) { // blk_text ?>
	<div id="r_blk_text" class="form-group">
		<label id="elh_cpy_page_row_block_blk_text" class="<?php echo $cpy_page_row_block_edit->LeftColumnClass ?>"><?php echo $cpy_page_row_block->blk_text->FldCaption() ?></label>
		<div class="<?php echo $cpy_page_row_block_edit->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_text->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_text">
<?php ew_AppendClass($cpy_page_row_block->blk_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_page_row_block" data-field="x_blk_text" name="x_blk_text" id="x_blk_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_text->getPlaceHolder()) ?>"<?php echo $cpy_page_row_block->blk_text->EditAttributes() ?>><?php echo $cpy_page_row_block->blk_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_page_row_blockedit", "x_blk_text", 35, 8, <?php echo ($cpy_page_row_block->blk_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $cpy_page_row_block->blk_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="cpy_page_row_block" data-field="x_blk_id" name="x_blk_id" id="x_blk_id" value="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_id->CurrentValue) ?>">
<?php if (!$cpy_page_row_block_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_page_row_block_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_page_row_block_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$cpy_page_row_block_edit->IsModal) { ?>
<?php if (!isset($cpy_page_row_block_edit->Pager)) $cpy_page_row_block_edit->Pager = new cPrevNextPager($cpy_page_row_block_edit->StartRec, $cpy_page_row_block_edit->DisplayRecs, $cpy_page_row_block_edit->TotalRecs, $cpy_page_row_block_edit->AutoHidePager) ?>
<?php if ($cpy_page_row_block_edit->Pager->RecordCount > 0 && $cpy_page_row_block_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_page_row_block_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_page_row_block_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_page_row_block_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_page_row_block_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_page_row_block_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_page_row_block_edit->PageUrl() ?>start=<?php echo $cpy_page_row_block_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_page_row_block_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fcpy_page_row_blockedit.Init();
</script>
<?php
$cpy_page_row_block_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_page_row_block_edit->Page_Terminate();
?>
