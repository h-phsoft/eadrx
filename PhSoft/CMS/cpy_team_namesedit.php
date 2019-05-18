<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_team_namesinfo.php" ?>
<?php include_once "cpy_teaminfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_team_names_edit = NULL; // Initialize page object first

class ccpy_team_names_edit extends ccpy_team_names {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_team_names';

	// Page object name
	var $PageObjName = 'cpy_team_names_edit';

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

		// Table object (cpy_team_names)
		if (!isset($GLOBALS["cpy_team_names"]) || get_class($GLOBALS["cpy_team_names"]) == "ccpy_team_names") {
			$GLOBALS["cpy_team_names"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_team_names"];
		}

		// Table object (cpy_team)
		if (!isset($GLOBALS['cpy_team'])) $GLOBALS['cpy_team'] = new ccpy_team();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_team_names', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_team_nameslist.php"));
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
		$this->teamn_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->teamn_id->Visible = FALSE;
		$this->team_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->team_name->SetVisibility();
		$this->team_title->SetVisibility();
		$this->team_position->SetVisibility();
		$this->team_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_team_names;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_team_names);
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
					if ($pageName == "cpy_team_namesview.php")
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
			if ($objForm->HasValue("x_teamn_id")) {
				$this->teamn_id->setFormValue($objForm->GetValue("x_teamn_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["teamn_id"])) {
				$this->teamn_id->setQueryStringValue($_GET["teamn_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->teamn_id->CurrentValue = NULL;
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
			$this->Page_Terminate("cpy_team_nameslist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->teamn_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->teamn_id->CurrentValue) == strval($this->Recordset->fields('teamn_id'))) {
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
					$this->Page_Terminate("cpy_team_nameslist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "cpy_team_nameslist.php")
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
		if (!$this->teamn_id->FldIsDetailKey)
			$this->teamn_id->setFormValue($objForm->GetValue("x_teamn_id"));
		if (!$this->team_id->FldIsDetailKey) {
			$this->team_id->setFormValue($objForm->GetValue("x_team_id"));
		}
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		if (!$this->team_name->FldIsDetailKey) {
			$this->team_name->setFormValue($objForm->GetValue("x_team_name"));
		}
		if (!$this->team_title->FldIsDetailKey) {
			$this->team_title->setFormValue($objForm->GetValue("x_team_title"));
		}
		if (!$this->team_position->FldIsDetailKey) {
			$this->team_position->setFormValue($objForm->GetValue("x_team_position"));
		}
		if (!$this->team_text->FldIsDetailKey) {
			$this->team_text->setFormValue($objForm->GetValue("x_team_text"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->teamn_id->CurrentValue = $this->teamn_id->FormValue;
		$this->team_id->CurrentValue = $this->team_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->team_name->CurrentValue = $this->team_name->FormValue;
		$this->team_title->CurrentValue = $this->team_title->FormValue;
		$this->team_position->CurrentValue = $this->team_position->FormValue;
		$this->team_text->CurrentValue = $this->team_text->FormValue;
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
		$this->teamn_id->setDbValue($row['teamn_id']);
		$this->team_id->setDbValue($row['team_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->team_name->setDbValue($row['team_name']);
		$this->team_title->setDbValue($row['team_title']);
		$this->team_position->setDbValue($row['team_position']);
		$this->team_text->setDbValue($row['team_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['teamn_id'] = NULL;
		$row['team_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['team_name'] = NULL;
		$row['team_title'] = NULL;
		$row['team_position'] = NULL;
		$row['team_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->teamn_id->DbValue = $row['teamn_id'];
		$this->team_id->DbValue = $row['team_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->team_name->DbValue = $row['team_name'];
		$this->team_title->DbValue = $row['team_title'];
		$this->team_position->DbValue = $row['team_position'];
		$this->team_text->DbValue = $row['team_text'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("teamn_id")) <> "")
			$this->teamn_id->CurrentValue = $this->getKey("teamn_id"); // teamn_id
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
		// teamn_id
		// team_id
		// lang_id
		// team_name
		// team_title
		// team_position
		// team_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// teamn_id
		$this->teamn_id->ViewValue = $this->teamn_id->CurrentValue;
		$this->teamn_id->ViewCustomAttributes = "";

		// team_id
		if (strval($this->team_id->CurrentValue) <> "") {
			$sFilterWrk = "`team_id`" . ew_SearchString("=", $this->team_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `team_id`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_team`";
		$sWhereWrk = "";
		$this->team_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `team_order`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->team_id->ViewValue = $this->team_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->team_id->ViewValue = $this->team_id->CurrentValue;
			}
		} else {
			$this->team_id->ViewValue = NULL;
		}
		$this->team_id->ViewCustomAttributes = "";

		// lang_id
		if (strval($this->lang_id->CurrentValue) <> "") {
			$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `lang_id`, `lang_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
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

		// team_name
		$this->team_name->ViewValue = $this->team_name->CurrentValue;
		$this->team_name->ViewCustomAttributes = "";

		// team_title
		$this->team_title->ViewValue = $this->team_title->CurrentValue;
		$this->team_title->ViewCustomAttributes = "";

		// team_position
		$this->team_position->ViewValue = $this->team_position->CurrentValue;
		$this->team_position->ViewCustomAttributes = "";

		// team_text
		$this->team_text->ViewValue = $this->team_text->CurrentValue;
		$this->team_text->ViewCustomAttributes = "";

			// teamn_id
			$this->teamn_id->LinkCustomAttributes = "";
			$this->teamn_id->HrefValue = "";
			$this->teamn_id->TooltipValue = "";

			// team_id
			$this->team_id->LinkCustomAttributes = "";
			$this->team_id->HrefValue = "";
			$this->team_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// team_name
			$this->team_name->LinkCustomAttributes = "";
			$this->team_name->HrefValue = "";
			$this->team_name->TooltipValue = "";

			// team_title
			$this->team_title->LinkCustomAttributes = "";
			$this->team_title->HrefValue = "";
			$this->team_title->TooltipValue = "";

			// team_position
			$this->team_position->LinkCustomAttributes = "";
			$this->team_position->HrefValue = "";
			$this->team_position->TooltipValue = "";

			// team_text
			$this->team_text->LinkCustomAttributes = "";
			$this->team_text->HrefValue = "";
			$this->team_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// teamn_id
			$this->teamn_id->EditAttrs["class"] = "form-control";
			$this->teamn_id->EditCustomAttributes = "";
			$this->teamn_id->EditValue = $this->teamn_id->CurrentValue;
			$this->teamn_id->ViewCustomAttributes = "";

			// team_id
			$this->team_id->EditAttrs["class"] = "form-control";
			$this->team_id->EditCustomAttributes = "";
			if ($this->team_id->getSessionValue() <> "") {
				$this->team_id->CurrentValue = $this->team_id->getSessionValue();
			if (strval($this->team_id->CurrentValue) <> "") {
				$sFilterWrk = "`team_id`" . ew_SearchString("=", $this->team_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `team_id`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_team`";
			$sWhereWrk = "";
			$this->team_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `team_order`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->team_id->ViewValue = $this->team_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->team_id->ViewValue = $this->team_id->CurrentValue;
				}
			} else {
				$this->team_id->ViewValue = NULL;
			}
			$this->team_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->team_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`team_id`" . ew_SearchString("=", $this->team_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `team_id`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_team`";
			$sWhereWrk = "";
			$this->team_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `team_order`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->team_id->EditValue = $arwrk;
			}

			// lang_id
			$this->lang_id->EditAttrs["class"] = "form-control";
			$this->lang_id->EditCustomAttributes = "";
			if (trim(strval($this->lang_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `lang_id`, `lang_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_language`";
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

			// team_name
			$this->team_name->EditAttrs["class"] = "form-control";
			$this->team_name->EditCustomAttributes = "";
			$this->team_name->EditValue = ew_HtmlEncode($this->team_name->CurrentValue);
			$this->team_name->PlaceHolder = ew_RemoveHtml($this->team_name->FldCaption());

			// team_title
			$this->team_title->EditAttrs["class"] = "form-control";
			$this->team_title->EditCustomAttributes = "";
			$this->team_title->EditValue = ew_HtmlEncode($this->team_title->CurrentValue);
			$this->team_title->PlaceHolder = ew_RemoveHtml($this->team_title->FldCaption());

			// team_position
			$this->team_position->EditAttrs["class"] = "form-control";
			$this->team_position->EditCustomAttributes = "";
			$this->team_position->EditValue = ew_HtmlEncode($this->team_position->CurrentValue);
			$this->team_position->PlaceHolder = ew_RemoveHtml($this->team_position->FldCaption());

			// team_text
			$this->team_text->EditAttrs["class"] = "form-control";
			$this->team_text->EditCustomAttributes = "";
			$this->team_text->EditValue = ew_HtmlEncode($this->team_text->CurrentValue);
			$this->team_text->PlaceHolder = ew_RemoveHtml($this->team_text->FldCaption());

			// Edit refer script
			// teamn_id

			$this->teamn_id->LinkCustomAttributes = "";
			$this->teamn_id->HrefValue = "";

			// team_id
			$this->team_id->LinkCustomAttributes = "";
			$this->team_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// team_name
			$this->team_name->LinkCustomAttributes = "";
			$this->team_name->HrefValue = "";

			// team_title
			$this->team_title->LinkCustomAttributes = "";
			$this->team_title->HrefValue = "";

			// team_position
			$this->team_position->LinkCustomAttributes = "";
			$this->team_position->HrefValue = "";

			// team_text
			$this->team_text->LinkCustomAttributes = "";
			$this->team_text->HrefValue = "";
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
		if (!$this->team_id->FldIsDetailKey && !is_null($this->team_id->FormValue) && $this->team_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_id->FldCaption(), $this->team_id->ReqErrMsg));
		}
		if (!$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if (!$this->team_name->FldIsDetailKey && !is_null($this->team_name->FormValue) && $this->team_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_name->FldCaption(), $this->team_name->ReqErrMsg));
		}
		if (!$this->team_title->FldIsDetailKey && !is_null($this->team_title->FormValue) && $this->team_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_title->FldCaption(), $this->team_title->ReqErrMsg));
		}
		if (!$this->team_position->FldIsDetailKey && !is_null($this->team_position->FormValue) && $this->team_position->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_position->FldCaption(), $this->team_position->ReqErrMsg));
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

			// team_id
			$this->team_id->SetDbValueDef($rsnew, $this->team_id->CurrentValue, 0, $this->team_id->ReadOnly);

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly);

			// team_name
			$this->team_name->SetDbValueDef($rsnew, $this->team_name->CurrentValue, "", $this->team_name->ReadOnly);

			// team_title
			$this->team_title->SetDbValueDef($rsnew, $this->team_title->CurrentValue, "", $this->team_title->ReadOnly);

			// team_position
			$this->team_position->SetDbValueDef($rsnew, $this->team_position->CurrentValue, "", $this->team_position->ReadOnly);

			// team_text
			$this->team_text->SetDbValueDef($rsnew, $this->team_text->CurrentValue, NULL, $this->team_text->ReadOnly);

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
			if ($sMasterTblVar == "cpy_team") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_team_id"] <> "") {
					$GLOBALS["cpy_team"]->team_id->setQueryStringValue($_GET["fk_team_id"]);
					$this->team_id->setQueryStringValue($GLOBALS["cpy_team"]->team_id->QueryStringValue);
					$this->team_id->setSessionValue($this->team_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_team"]->team_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_team") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_team_id"] <> "") {
					$GLOBALS["cpy_team"]->team_id->setFormValue($_POST["fk_team_id"]);
					$this->team_id->setFormValue($GLOBALS["cpy_team"]->team_id->FormValue);
					$this->team_id->setSessionValue($this->team_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_team"]->team_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cpy_team") {
				if ($this->team_id->CurrentValue == "") $this->team_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_team_nameslist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_team_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `team_id` AS `LinkFld`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_team`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`team_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `team_order`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_lang_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `lang_id` AS `LinkFld`, `lang_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
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
if (!isset($cpy_team_names_edit)) $cpy_team_names_edit = new ccpy_team_names_edit();

// Page init
$cpy_team_names_edit->Page_Init();

// Page main
$cpy_team_names_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_team_names_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fcpy_team_namesedit = new ew_Form("fcpy_team_namesedit", "edit");

// Validate form
fcpy_team_namesedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_team_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_id->FldCaption(), $cpy_team_names->team_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lang_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->lang_id->FldCaption(), $cpy_team_names->lang_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_team_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_name->FldCaption(), $cpy_team_names->team_name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_team_title");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_title->FldCaption(), $cpy_team_names->team_title->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_team_position");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team_names->team_position->FldCaption(), $cpy_team_names->team_position->ReqErrMsg)) ?>");

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
fcpy_team_namesedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_team_namesedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_team_namesedit.Lists["x_team_id"] = {"LinkField":"x_team_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_team_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_team"};
fcpy_team_namesedit.Lists["x_team_id"].Data = "<?php echo $cpy_team_names_edit->team_id->LookupFilterQuery(FALSE, "edit") ?>";
fcpy_team_namesedit.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_team_namesedit.Lists["x_lang_id"].Data = "<?php echo $cpy_team_names_edit->lang_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_team_names_edit->ShowPageHeader(); ?>
<?php
$cpy_team_names_edit->ShowMessage();
?>
<?php if (!$cpy_team_names_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cpy_team_names_edit->Pager)) $cpy_team_names_edit->Pager = new cPrevNextPager($cpy_team_names_edit->StartRec, $cpy_team_names_edit->DisplayRecs, $cpy_team_names_edit->TotalRecs, $cpy_team_names_edit->AutoHidePager) ?>
<?php if ($cpy_team_names_edit->Pager->RecordCount > 0 && $cpy_team_names_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_team_names_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_team_names_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_team_names_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_team_names_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_team_names_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_team_names_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcpy_team_namesedit" id="fcpy_team_namesedit" class="<?php echo $cpy_team_names_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_team_names_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_team_names_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_team_names">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_team_names_edit->IsModal) ?>">
<?php if ($cpy_team_names->getCurrentMasterTable() == "cpy_team") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="cpy_team">
<input type="hidden" name="fk_team_id" value="<?php echo $cpy_team_names->team_id->getSessionValue() ?>">
<?php } ?>
<div class="ewEditDiv"><!-- page* -->
<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
	<div id="r_teamn_id" class="form-group">
		<label id="elh_cpy_team_names_teamn_id" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->teamn_id->FldCaption() ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->teamn_id->CellAttributes() ?>>
<span id="el_cpy_team_names_teamn_id">
<span<?php echo $cpy_team_names->teamn_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->teamn_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cpy_team_names" data-field="x_teamn_id" name="x_teamn_id" id="x_teamn_id" value="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->CurrentValue) ?>">
<?php echo $cpy_team_names->teamn_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
	<div id="r_team_id" class="form-group">
		<label id="elh_cpy_team_names_team_id" for="x_team_id" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->team_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_id->CellAttributes() ?>>
<?php if ($cpy_team_names->team_id->getSessionValue() <> "") { ?>
<span id="el_cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_team_names->team_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_team_id" name="x_team_id" value="<?php echo ew_HtmlEncode($cpy_team_names->team_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cpy_team_names_team_id">
<select data-table="cpy_team_names" data-field="x_team_id" data-value-separator="<?php echo $cpy_team_names->team_id->DisplayValueSeparatorAttribute() ?>" id="x_team_id" name="x_team_id"<?php echo $cpy_team_names->team_id->EditAttributes() ?>>
<?php echo $cpy_team_names->team_id->SelectOptionListHtml("x_team_id") ?>
</select>
</span>
<?php } ?>
<?php echo $cpy_team_names->team_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label id="elh_cpy_team_names_lang_id" for="x_lang_id" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->lang_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->lang_id->CellAttributes() ?>>
<span id="el_cpy_team_names_lang_id">
<select data-table="cpy_team_names" data-field="x_lang_id" data-value-separator="<?php echo $cpy_team_names->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $cpy_team_names->lang_id->EditAttributes() ?>>
<?php echo $cpy_team_names->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $cpy_team_names->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
	<div id="r_team_name" class="form-group">
		<label id="elh_cpy_team_names_team_name" for="x_team_name" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->team_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_name->CellAttributes() ?>>
<span id="el_cpy_team_names_team_name">
<input type="text" data-table="cpy_team_names" data-field="x_team_name" name="x_team_name" id="x_team_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_name->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_name->EditValue ?>"<?php echo $cpy_team_names->team_name->EditAttributes() ?>>
</span>
<?php echo $cpy_team_names->team_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
	<div id="r_team_title" class="form-group">
		<label id="elh_cpy_team_names_team_title" for="x_team_title" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->team_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_title->CellAttributes() ?>>
<span id="el_cpy_team_names_team_title">
<input type="text" data-table="cpy_team_names" data-field="x_team_title" name="x_team_title" id="x_team_title" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_title->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_title->EditValue ?>"<?php echo $cpy_team_names->team_title->EditAttributes() ?>>
</span>
<?php echo $cpy_team_names->team_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
	<div id="r_team_position" class="form-group">
		<label id="elh_cpy_team_names_team_position" for="x_team_position" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->team_position->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_position->CellAttributes() ?>>
<span id="el_cpy_team_names_team_position">
<input type="text" data-table="cpy_team_names" data-field="x_team_position" name="x_team_position" id="x_team_position" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_position->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_position->EditValue ?>"<?php echo $cpy_team_names->team_position->EditAttributes() ?>>
</span>
<?php echo $cpy_team_names->team_position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
	<div id="r_team_text" class="form-group">
		<label id="elh_cpy_team_names_team_text" class="<?php echo $cpy_team_names_edit->LeftColumnClass ?>"><?php echo $cpy_team_names->team_text->FldCaption() ?></label>
		<div class="<?php echo $cpy_team_names_edit->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_text->CellAttributes() ?>>
<span id="el_cpy_team_names_team_text">
<?php ew_AppendClass($cpy_team_names->team_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_team_names" data-field="x_team_text" name="x_team_text" id="x_team_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_text->getPlaceHolder()) ?>"<?php echo $cpy_team_names->team_text->EditAttributes() ?>><?php echo $cpy_team_names->team_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_team_namesedit", "x_team_text", 35, 8, <?php echo ($cpy_team_names->team_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $cpy_team_names->team_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cpy_team_names_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_team_names_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_team_names_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$cpy_team_names_edit->IsModal) { ?>
<?php if (!isset($cpy_team_names_edit->Pager)) $cpy_team_names_edit->Pager = new cPrevNextPager($cpy_team_names_edit->StartRec, $cpy_team_names_edit->DisplayRecs, $cpy_team_names_edit->TotalRecs, $cpy_team_names_edit->AutoHidePager) ?>
<?php if ($cpy_team_names_edit->Pager->RecordCount > 0 && $cpy_team_names_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_team_names_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_team_names_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_team_names_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_team_names_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_team_names_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_team_names_edit->PageUrl() ?>start=<?php echo $cpy_team_names_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_team_names_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fcpy_team_namesedit.Init();
</script>
<?php
$cpy_team_names_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_team_names_edit->Page_Terminate();
?>
