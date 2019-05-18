<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_consult_answerinfo.php" ?>
<?php include_once "app_consultationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_consult_answer_add = NULL; // Initialize page object first

class capp_consult_answer_add extends capp_consult_answer {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_consult_answer';

	// Page object name
	var $PageObjName = 'app_consult_answer_add';

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

		// Table object (app_consult_answer)
		if (!isset($GLOBALS["app_consult_answer"]) || get_class($GLOBALS["app_consult_answer"]) == "capp_consult_answer") {
			$GLOBALS["app_consult_answer"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_consult_answer"];
		}

		// Table object (app_consultation)
		if (!isset($GLOBALS['app_consultation'])) $GLOBALS['app_consultation'] = new capp_consultation();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_consult_answer', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_consult_answerlist.php"));
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
		$this->user_id->SetVisibility();
		$this->cons_id->SetVisibility();
		$this->answer_file->SetVisibility();
		$this->answer_audio->SetVisibility();
		$this->answer_text->SetVisibility();

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
		global $EW_EXPORT, $app_consult_answer;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_consult_answer);
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
					if ($pageName == "app_consult_answerview.php")
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
			if (@$_GET["answer_id"] != "") {
				$this->answer_id->setQueryStringValue($_GET["answer_id"]);
				$this->setKey("answer_id", $this->answer_id->CurrentValue); // Set up key
			} else {
				$this->setKey("answer_id", ""); // Clear key
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
					$this->Page_Terminate("app_consult_answerlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "app_consult_answerlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "app_consult_answerview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
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
		$this->answer_id->CurrentValue = NULL;
		$this->answer_id->OldValue = $this->answer_id->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->cons_id->CurrentValue = NULL;
		$this->cons_id->OldValue = $this->cons_id->CurrentValue;
		$this->answer_file->CurrentValue = NULL;
		$this->answer_file->OldValue = $this->answer_file->CurrentValue;
		$this->answer_audio->CurrentValue = NULL;
		$this->answer_audio->OldValue = $this->answer_audio->CurrentValue;
		$this->answer_text->CurrentValue = NULL;
		$this->answer_text->OldValue = $this->answer_text->CurrentValue;
		$this->ins_datetime->CurrentValue = NULL;
		$this->ins_datetime->OldValue = $this->ins_datetime->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		if (!$this->cons_id->FldIsDetailKey) {
			$this->cons_id->setFormValue($objForm->GetValue("x_cons_id"));
		}
		if (!$this->answer_file->FldIsDetailKey) {
			$this->answer_file->setFormValue($objForm->GetValue("x_answer_file"));
		}
		if (!$this->answer_audio->FldIsDetailKey) {
			$this->answer_audio->setFormValue($objForm->GetValue("x_answer_audio"));
		}
		if (!$this->answer_text->FldIsDetailKey) {
			$this->answer_text->setFormValue($objForm->GetValue("x_answer_text"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->cons_id->CurrentValue = $this->cons_id->FormValue;
		$this->answer_file->CurrentValue = $this->answer_file->FormValue;
		$this->answer_audio->CurrentValue = $this->answer_audio->FormValue;
		$this->answer_text->CurrentValue = $this->answer_text->FormValue;
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
		$this->answer_id->setDbValue($row['answer_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->cons_id->setDbValue($row['cons_id']);
		$this->answer_file->setDbValue($row['answer_file']);
		$this->answer_audio->setDbValue($row['answer_audio']);
		$this->answer_text->setDbValue($row['answer_text']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['answer_id'] = $this->answer_id->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['cons_id'] = $this->cons_id->CurrentValue;
		$row['answer_file'] = $this->answer_file->CurrentValue;
		$row['answer_audio'] = $this->answer_audio->CurrentValue;
		$row['answer_text'] = $this->answer_text->CurrentValue;
		$row['ins_datetime'] = $this->ins_datetime->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->answer_id->DbValue = $row['answer_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->cons_id->DbValue = $row['cons_id'];
		$this->answer_file->DbValue = $row['answer_file'];
		$this->answer_audio->DbValue = $row['answer_audio'];
		$this->answer_text->DbValue = $row['answer_text'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("answer_id")) <> "")
			$this->answer_id->CurrentValue = $this->getKey("answer_id"); // answer_id
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
		// answer_id
		// user_id
		// cons_id
		// answer_file
		// answer_audio
		// answer_text
		// ins_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// user_id
		if (strval($this->user_id->CurrentValue) <> "") {
			$sFilterWrk = "`user_id`" . ew_SearchString("=", $this->user_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `user_id`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
		$sWhereWrk = "";
		$this->user_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `user_name`";
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

		// cons_id
		if (strval($this->cons_id->CurrentValue) <> "") {
			$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cons_id`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
		$sWhereWrk = "";
		$this->cons_id->LookupFilters = array("dx1" => '`cons_message`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cons_id->ViewValue = $this->cons_id->CurrentValue;
			}
		} else {
			$this->cons_id->ViewValue = NULL;
		}
		$this->cons_id->ViewCustomAttributes = "";

		// answer_file
		$this->answer_file->ViewValue = $this->answer_file->CurrentValue;
		$this->answer_file->ViewCustomAttributes = "";

		// answer_audio
		$this->answer_audio->ViewValue = $this->answer_audio->CurrentValue;
		$this->answer_audio->ViewCustomAttributes = "";

		// answer_text
		$this->answer_text->ViewValue = $this->answer_text->CurrentValue;
		$this->answer_text->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// cons_id
			$this->cons_id->LinkCustomAttributes = "";
			$this->cons_id->HrefValue = "";
			$this->cons_id->TooltipValue = "";

			// answer_file
			$this->answer_file->LinkCustomAttributes = "";
			$this->answer_file->HrefValue = "";
			$this->answer_file->TooltipValue = "";

			// answer_audio
			$this->answer_audio->LinkCustomAttributes = "";
			$this->answer_audio->HrefValue = "";
			$this->answer_audio->TooltipValue = "";

			// answer_text
			$this->answer_text->LinkCustomAttributes = "";
			$this->answer_text->HrefValue = "";
			$this->answer_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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
			$sSqlWrk .= " ORDER BY `user_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->user_id->EditValue = $arwrk;

			// cons_id
			$this->cons_id->EditCustomAttributes = "";
			if ($this->cons_id->getSessionValue() <> "") {
				$this->cons_id->CurrentValue = $this->cons_id->getSessionValue();
			if (strval($this->cons_id->CurrentValue) <> "") {
				$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `cons_id`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
			$sWhereWrk = "";
			$this->cons_id->LookupFilters = array("dx1" => '`cons_message`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->cons_id->ViewValue = $this->cons_id->CurrentValue;
				}
			} else {
				$this->cons_id->ViewValue = NULL;
			}
			$this->cons_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->cons_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cons_id`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation`";
			$sWhereWrk = "";
			$this->cons_id->LookupFilters = array("dx1" => '`cons_message`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
			} else {
				$this->cons_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cons_id->EditValue = $arwrk;
			}

			// answer_file
			$this->answer_file->EditAttrs["class"] = "form-control";
			$this->answer_file->EditCustomAttributes = "";
			$this->answer_file->EditValue = ew_HtmlEncode($this->answer_file->CurrentValue);
			$this->answer_file->PlaceHolder = ew_RemoveHtml($this->answer_file->FldCaption());

			// answer_audio
			$this->answer_audio->EditAttrs["class"] = "form-control";
			$this->answer_audio->EditCustomAttributes = "";
			$this->answer_audio->EditValue = ew_HtmlEncode($this->answer_audio->CurrentValue);
			$this->answer_audio->PlaceHolder = ew_RemoveHtml($this->answer_audio->FldCaption());

			// answer_text
			$this->answer_text->EditAttrs["class"] = "form-control";
			$this->answer_text->EditCustomAttributes = "";
			$this->answer_text->EditValue = ew_HtmlEncode($this->answer_text->CurrentValue);
			$this->answer_text->PlaceHolder = ew_RemoveHtml($this->answer_text->FldCaption());

			// Add refer script
			// user_id

			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// cons_id
			$this->cons_id->LinkCustomAttributes = "";
			$this->cons_id->HrefValue = "";

			// answer_file
			$this->answer_file->LinkCustomAttributes = "";
			$this->answer_file->HrefValue = "";

			// answer_audio
			$this->answer_audio->LinkCustomAttributes = "";
			$this->answer_audio->HrefValue = "";

			// answer_text
			$this->answer_text->LinkCustomAttributes = "";
			$this->answer_text->HrefValue = "";
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
		if (!$this->user_id->FldIsDetailKey && !is_null($this->user_id->FormValue) && $this->user_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_id->FldCaption(), $this->user_id->ReqErrMsg));
		}
		if (!$this->cons_id->FldIsDetailKey && !is_null($this->cons_id->FormValue) && $this->cons_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cons_id->FldCaption(), $this->cons_id->ReqErrMsg));
		}
		if (!$this->answer_text->FldIsDetailKey && !is_null($this->answer_text->FormValue) && $this->answer_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->answer_text->FldCaption(), $this->answer_text->ReqErrMsg));
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

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// user_id
		$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, 0, FALSE);

		// cons_id
		$this->cons_id->SetDbValueDef($rsnew, $this->cons_id->CurrentValue, 0, FALSE);

		// answer_file
		$this->answer_file->SetDbValueDef($rsnew, $this->answer_file->CurrentValue, NULL, FALSE);

		// answer_audio
		$this->answer_audio->SetDbValueDef($rsnew, $this->answer_audio->CurrentValue, NULL, FALSE);

		// answer_text
		$this->answer_text->SetDbValueDef($rsnew, $this->answer_text->CurrentValue, "", FALSE);

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
			if ($sMasterTblVar == "app_consultation") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_cons_id"] <> "") {
					$GLOBALS["app_consultation"]->cons_id->setQueryStringValue($_GET["fk_cons_id"]);
					$this->cons_id->setQueryStringValue($GLOBALS["app_consultation"]->cons_id->QueryStringValue);
					$this->cons_id->setSessionValue($this->cons_id->QueryStringValue);
					if (!is_numeric($GLOBALS["app_consultation"]->cons_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "app_consultation") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_cons_id"] <> "") {
					$GLOBALS["app_consultation"]->cons_id->setFormValue($_POST["fk_cons_id"]);
					$this->cons_id->setFormValue($GLOBALS["app_consultation"]->cons_id->FormValue);
					$this->cons_id->setSessionValue($this->cons_id->FormValue);
					if (!is_numeric($GLOBALS["app_consultation"]->cons_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "app_consultation") {
				if ($this->cons_id->CurrentValue == "") $this->cons_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_consult_answerlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_user_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `user_id` AS `LinkFld`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`user_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `user_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cons_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cons_id` AS `LinkFld`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`cons_message`');
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
if (!isset($app_consult_answer_add)) $app_consult_answer_add = new capp_consult_answer_add();

// Page init
$app_consult_answer_add->Page_Init();

// Page main
$app_consult_answer_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consult_answer_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fapp_consult_answeradd = new ew_Form("fapp_consult_answeradd", "add");

// Validate form
fapp_consult_answeradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_user_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consult_answer->user_id->FldCaption(), $app_consult_answer->user_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cons_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consult_answer->cons_id->FldCaption(), $app_consult_answer->cons_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_answer_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consult_answer->answer_text->FldCaption(), $app_consult_answer->answer_text->ReqErrMsg)) ?>");

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
fapp_consult_answeradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consult_answeradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consult_answeradd.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_consult_answeradd.Lists["x_user_id"].Data = "<?php echo $app_consult_answer_add->user_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_consult_answeradd.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_message","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_consult_answeradd.Lists["x_cons_id"].Data = "<?php echo $app_consult_answer_add->cons_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_consult_answer_add->ShowPageHeader(); ?>
<?php
$app_consult_answer_add->ShowMessage();
?>
<form name="fapp_consult_answeradd" id="fapp_consult_answeradd" class="<?php echo $app_consult_answer_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_consult_answer_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_consult_answer_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_consult_answer">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($app_consult_answer_add->IsModal) ?>">
<?php if ($app_consult_answer->getCurrentMasterTable() == "app_consultation") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="app_consultation">
<input type="hidden" name="fk_cons_id" value="<?php echo $app_consult_answer->cons_id->getSessionValue() ?>">
<?php } ?>
<div class="ewAddDiv"><!-- page* -->
<?php if ($app_consult_answer->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label id="elh_app_consult_answer_user_id" for="x_user_id" class="<?php echo $app_consult_answer_add->LeftColumnClass ?>"><?php echo $app_consult_answer->user_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_consult_answer_add->RightColumnClass ?>"><div<?php echo $app_consult_answer->user_id->CellAttributes() ?>>
<span id="el_app_consult_answer_user_id">
<select data-table="app_consult_answer" data-field="x_user_id" data-value-separator="<?php echo $app_consult_answer->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_consult_answer->user_id->EditAttributes() ?>>
<?php echo $app_consult_answer->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
<?php echo $app_consult_answer->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->cons_id->Visible) { // cons_id ?>
	<div id="r_cons_id" class="form-group">
		<label id="elh_app_consult_answer_cons_id" for="x_cons_id" class="<?php echo $app_consult_answer_add->LeftColumnClass ?>"><?php echo $app_consult_answer->cons_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_consult_answer_add->RightColumnClass ?>"><div<?php echo $app_consult_answer->cons_id->CellAttributes() ?>>
<?php if ($app_consult_answer->cons_id->getSessionValue() <> "") { ?>
<span id="el_app_consult_answer_cons_id">
<span<?php echo $app_consult_answer->cons_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_consult_answer->cons_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_cons_id" name="x_cons_id" value="<?php echo ew_HtmlEncode($app_consult_answer->cons_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_app_consult_answer_cons_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_cons_id"><?php echo (strval($app_consult_answer->cons_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $app_consult_answer->cons_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($app_consult_answer->cons_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_cons_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($app_consult_answer->cons_id->ReadOnly || $app_consult_answer->cons_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="app_consult_answer" data-field="x_cons_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $app_consult_answer->cons_id->DisplayValueSeparatorAttribute() ?>" name="x_cons_id" id="x_cons_id" value="<?php echo $app_consult_answer->cons_id->CurrentValue ?>"<?php echo $app_consult_answer->cons_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $app_consult_answer->cons_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->answer_file->Visible) { // answer_file ?>
	<div id="r_answer_file" class="form-group">
		<label id="elh_app_consult_answer_answer_file" for="x_answer_file" class="<?php echo $app_consult_answer_add->LeftColumnClass ?>"><?php echo $app_consult_answer->answer_file->FldCaption() ?></label>
		<div class="<?php echo $app_consult_answer_add->RightColumnClass ?>"><div<?php echo $app_consult_answer->answer_file->CellAttributes() ?>>
<span id="el_app_consult_answer_answer_file">
<input type="text" data-table="app_consult_answer" data-field="x_answer_file" name="x_answer_file" id="x_answer_file" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->answer_file->getPlaceHolder()) ?>" value="<?php echo $app_consult_answer->answer_file->EditValue ?>"<?php echo $app_consult_answer->answer_file->EditAttributes() ?>>
</span>
<?php echo $app_consult_answer->answer_file->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->answer_audio->Visible) { // answer_audio ?>
	<div id="r_answer_audio" class="form-group">
		<label id="elh_app_consult_answer_answer_audio" for="x_answer_audio" class="<?php echo $app_consult_answer_add->LeftColumnClass ?>"><?php echo $app_consult_answer->answer_audio->FldCaption() ?></label>
		<div class="<?php echo $app_consult_answer_add->RightColumnClass ?>"><div<?php echo $app_consult_answer->answer_audio->CellAttributes() ?>>
<span id="el_app_consult_answer_answer_audio">
<input type="text" data-table="app_consult_answer" data-field="x_answer_audio" name="x_answer_audio" id="x_answer_audio" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->answer_audio->getPlaceHolder()) ?>" value="<?php echo $app_consult_answer->answer_audio->EditValue ?>"<?php echo $app_consult_answer->answer_audio->EditAttributes() ?>>
</span>
<?php echo $app_consult_answer->answer_audio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->answer_text->Visible) { // answer_text ?>
	<div id="r_answer_text" class="form-group">
		<label id="elh_app_consult_answer_answer_text" class="<?php echo $app_consult_answer_add->LeftColumnClass ?>"><?php echo $app_consult_answer->answer_text->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_consult_answer_add->RightColumnClass ?>"><div<?php echo $app_consult_answer->answer_text->CellAttributes() ?>>
<span id="el_app_consult_answer_answer_text">
<?php ew_AppendClass($app_consult_answer->answer_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_consult_answer" data-field="x_answer_text" name="x_answer_text" id="x_answer_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->answer_text->getPlaceHolder()) ?>"<?php echo $app_consult_answer->answer_text->EditAttributes() ?>><?php echo $app_consult_answer->answer_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_consult_answeradd", "x_answer_text", 35, 4, <?php echo ($app_consult_answer->answer_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $app_consult_answer->answer_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_consult_answer_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_consult_answer_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_consult_answer_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_consult_answeradd.Init();
</script>
<?php
$app_consult_answer_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_consult_answer_add->Page_Terminate();
?>
