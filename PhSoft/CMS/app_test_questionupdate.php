<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_test_questioninfo.php" ?>
<?php include_once "app_testinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_test_question_update = NULL; // Initialize page object first

class capp_test_question_update extends capp_test_question {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_test_question';

	// Page object name
	var $PageObjName = 'app_test_question_update';

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

		// Table object (app_test_question)
		if (!isset($GLOBALS["app_test_question"]) || get_class($GLOBALS["app_test_question"]) == "capp_test_question") {
			$GLOBALS["app_test_question"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_test_question"];
		}

		// Table object (app_test)
		if (!isset($GLOBALS['app_test'])) $GLOBALS['app_test'] = new capp_test();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_test_question', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_test_questionlist.php"));
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
		$this->test_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->gend_id->SetVisibility();
		$this->qstn_num->SetVisibility();
		$this->qstn_text->SetVisibility();
		$this->qstn_ansr1->SetVisibility();
		$this->qstn_val1->SetVisibility();
		$this->qstn_rep1->SetVisibility();
		$this->qstn_ansr2->SetVisibility();
		$this->qstn_val2->SetVisibility();
		$this->qstn_rep2->SetVisibility();
		$this->qstn_ansr3->SetVisibility();
		$this->qstn_val3->SetVisibility();
		$this->qstn_rep3->SetVisibility();
		$this->qstn_ansr4->SetVisibility();
		$this->qstn_val4->SetVisibility();
		$this->qstn_rep4->SetVisibility();

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
		global $EW_EXPORT, $app_test_question;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_test_question);
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
					if ($pageName == "app_test_questionview.php")
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
	var $FormClassName = "form-horizontal ewForm ewUpdateForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $RecKeys;
	var $Disabled;
	var $Recordset;
	var $UpdateCount = 0;

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
		$this->FormClassName = "ewForm ewUpdateForm form-horizontal";

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		if (@$_POST["a_update"] <> "") {

			// Get action
			$this->CurrentAction = $_POST["a_update"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->LoadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->Page_Terminate("app_test_questionlist.php"); // No records selected, return to list
		switch ($this->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		$this->CurrentFilter = $this->GetKeyFilter();

		// Load recordset
		if ($this->Recordset = $this->LoadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->test_id->setDbValue($this->Recordset->fields('test_id'));
					$this->lang_id->setDbValue($this->Recordset->fields('lang_id'));
					$this->gend_id->setDbValue($this->Recordset->fields('gend_id'));
					$this->qstn_num->setDbValue($this->Recordset->fields('qstn_num'));
					$this->qstn_text->setDbValue($this->Recordset->fields('qstn_text'));
					$this->qstn_ansr1->setDbValue($this->Recordset->fields('qstn_ansr1'));
					$this->qstn_val1->setDbValue($this->Recordset->fields('qstn_val1'));
					$this->qstn_rep1->setDbValue($this->Recordset->fields('qstn_rep1'));
					$this->qstn_ansr2->setDbValue($this->Recordset->fields('qstn_ansr2'));
					$this->qstn_val2->setDbValue($this->Recordset->fields('qstn_val2'));
					$this->qstn_rep2->setDbValue($this->Recordset->fields('qstn_rep2'));
					$this->qstn_ansr3->setDbValue($this->Recordset->fields('qstn_ansr3'));
					$this->qstn_val3->setDbValue($this->Recordset->fields('qstn_val3'));
					$this->qstn_rep3->setDbValue($this->Recordset->fields('qstn_rep3'));
					$this->qstn_ansr4->setDbValue($this->Recordset->fields('qstn_ansr4'));
					$this->qstn_val4->setDbValue($this->Recordset->fields('qstn_val4'));
					$this->qstn_rep4->setDbValue($this->Recordset->fields('qstn_rep4'));
				} else {
					if (!ew_CompareValue($this->test_id->DbValue, $this->Recordset->fields('test_id')))
						$this->test_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_id->DbValue, $this->Recordset->fields('lang_id')))
						$this->lang_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->gend_id->DbValue, $this->Recordset->fields('gend_id')))
						$this->gend_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_num->DbValue, $this->Recordset->fields('qstn_num')))
						$this->qstn_num->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_text->DbValue, $this->Recordset->fields('qstn_text')))
						$this->qstn_text->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_ansr1->DbValue, $this->Recordset->fields('qstn_ansr1')))
						$this->qstn_ansr1->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_val1->DbValue, $this->Recordset->fields('qstn_val1')))
						$this->qstn_val1->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_rep1->DbValue, $this->Recordset->fields('qstn_rep1')))
						$this->qstn_rep1->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_ansr2->DbValue, $this->Recordset->fields('qstn_ansr2')))
						$this->qstn_ansr2->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_val2->DbValue, $this->Recordset->fields('qstn_val2')))
						$this->qstn_val2->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_rep2->DbValue, $this->Recordset->fields('qstn_rep2')))
						$this->qstn_rep2->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_ansr3->DbValue, $this->Recordset->fields('qstn_ansr3')))
						$this->qstn_ansr3->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_val3->DbValue, $this->Recordset->fields('qstn_val3')))
						$this->qstn_val3->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_rep3->DbValue, $this->Recordset->fields('qstn_rep3')))
						$this->qstn_rep3->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_ansr4->DbValue, $this->Recordset->fields('qstn_ansr4')))
						$this->qstn_ansr4->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_val4->DbValue, $this->Recordset->fields('qstn_val4')))
						$this->qstn_val4->CurrentValue = NULL;
					if (!ew_CompareValue($this->qstn_rep4->DbValue, $this->Recordset->fields('qstn_rep4')))
						$this->qstn_rep4->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->MoveNext();
			}
			$this->Recordset->Close();
		}
	}

	// Set up key value
	function SetupKeyValues($key) {
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$this->qstn_id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $Language;
		$conn = &$this->Connection();
		$conn->BeginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->GetKeyFilter();
		$sSql = $this->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->RecKeys as $key) {
			if ($this->SetupKeyValues($key)) {
				$sThisKey = $key;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				break; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
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
		if (!$this->test_id->FldIsDetailKey) {
			$this->test_id->setFormValue($objForm->GetValue("x_test_id"));
		}
		$this->test_id->MultiUpdate = $objForm->GetValue("u_test_id");
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->MultiUpdate = $objForm->GetValue("u_lang_id");
		if (!$this->gend_id->FldIsDetailKey) {
			$this->gend_id->setFormValue($objForm->GetValue("x_gend_id"));
		}
		$this->gend_id->MultiUpdate = $objForm->GetValue("u_gend_id");
		if (!$this->qstn_num->FldIsDetailKey) {
			$this->qstn_num->setFormValue($objForm->GetValue("x_qstn_num"));
		}
		$this->qstn_num->MultiUpdate = $objForm->GetValue("u_qstn_num");
		if (!$this->qstn_text->FldIsDetailKey) {
			$this->qstn_text->setFormValue($objForm->GetValue("x_qstn_text"));
		}
		$this->qstn_text->MultiUpdate = $objForm->GetValue("u_qstn_text");
		if (!$this->qstn_ansr1->FldIsDetailKey) {
			$this->qstn_ansr1->setFormValue($objForm->GetValue("x_qstn_ansr1"));
		}
		$this->qstn_ansr1->MultiUpdate = $objForm->GetValue("u_qstn_ansr1");
		if (!$this->qstn_val1->FldIsDetailKey) {
			$this->qstn_val1->setFormValue($objForm->GetValue("x_qstn_val1"));
		}
		$this->qstn_val1->MultiUpdate = $objForm->GetValue("u_qstn_val1");
		if (!$this->qstn_rep1->FldIsDetailKey) {
			$this->qstn_rep1->setFormValue($objForm->GetValue("x_qstn_rep1"));
		}
		$this->qstn_rep1->MultiUpdate = $objForm->GetValue("u_qstn_rep1");
		if (!$this->qstn_ansr2->FldIsDetailKey) {
			$this->qstn_ansr2->setFormValue($objForm->GetValue("x_qstn_ansr2"));
		}
		$this->qstn_ansr2->MultiUpdate = $objForm->GetValue("u_qstn_ansr2");
		if (!$this->qstn_val2->FldIsDetailKey) {
			$this->qstn_val2->setFormValue($objForm->GetValue("x_qstn_val2"));
		}
		$this->qstn_val2->MultiUpdate = $objForm->GetValue("u_qstn_val2");
		if (!$this->qstn_rep2->FldIsDetailKey) {
			$this->qstn_rep2->setFormValue($objForm->GetValue("x_qstn_rep2"));
		}
		$this->qstn_rep2->MultiUpdate = $objForm->GetValue("u_qstn_rep2");
		if (!$this->qstn_ansr3->FldIsDetailKey) {
			$this->qstn_ansr3->setFormValue($objForm->GetValue("x_qstn_ansr3"));
		}
		$this->qstn_ansr3->MultiUpdate = $objForm->GetValue("u_qstn_ansr3");
		if (!$this->qstn_val3->FldIsDetailKey) {
			$this->qstn_val3->setFormValue($objForm->GetValue("x_qstn_val3"));
		}
		$this->qstn_val3->MultiUpdate = $objForm->GetValue("u_qstn_val3");
		if (!$this->qstn_rep3->FldIsDetailKey) {
			$this->qstn_rep3->setFormValue($objForm->GetValue("x_qstn_rep3"));
		}
		$this->qstn_rep3->MultiUpdate = $objForm->GetValue("u_qstn_rep3");
		if (!$this->qstn_ansr4->FldIsDetailKey) {
			$this->qstn_ansr4->setFormValue($objForm->GetValue("x_qstn_ansr4"));
		}
		$this->qstn_ansr4->MultiUpdate = $objForm->GetValue("u_qstn_ansr4");
		if (!$this->qstn_val4->FldIsDetailKey) {
			$this->qstn_val4->setFormValue($objForm->GetValue("x_qstn_val4"));
		}
		$this->qstn_val4->MultiUpdate = $objForm->GetValue("u_qstn_val4");
		if (!$this->qstn_rep4->FldIsDetailKey) {
			$this->qstn_rep4->setFormValue($objForm->GetValue("x_qstn_rep4"));
		}
		$this->qstn_rep4->MultiUpdate = $objForm->GetValue("u_qstn_rep4");
		if (!$this->qstn_id->FldIsDetailKey)
			$this->qstn_id->setFormValue($objForm->GetValue("x_qstn_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->qstn_id->CurrentValue = $this->qstn_id->FormValue;
		$this->test_id->CurrentValue = $this->test_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->gend_id->CurrentValue = $this->gend_id->FormValue;
		$this->qstn_num->CurrentValue = $this->qstn_num->FormValue;
		$this->qstn_text->CurrentValue = $this->qstn_text->FormValue;
		$this->qstn_ansr1->CurrentValue = $this->qstn_ansr1->FormValue;
		$this->qstn_val1->CurrentValue = $this->qstn_val1->FormValue;
		$this->qstn_rep1->CurrentValue = $this->qstn_rep1->FormValue;
		$this->qstn_ansr2->CurrentValue = $this->qstn_ansr2->FormValue;
		$this->qstn_val2->CurrentValue = $this->qstn_val2->FormValue;
		$this->qstn_rep2->CurrentValue = $this->qstn_rep2->FormValue;
		$this->qstn_ansr3->CurrentValue = $this->qstn_ansr3->FormValue;
		$this->qstn_val3->CurrentValue = $this->qstn_val3->FormValue;
		$this->qstn_rep3->CurrentValue = $this->qstn_rep3->FormValue;
		$this->qstn_ansr4->CurrentValue = $this->qstn_ansr4->FormValue;
		$this->qstn_val4->CurrentValue = $this->qstn_val4->FormValue;
		$this->qstn_rep4->CurrentValue = $this->qstn_rep4->FormValue;
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
		$this->qstn_id->setDbValue($row['qstn_id']);
		$this->test_id->setDbValue($row['test_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->gend_id->setDbValue($row['gend_id']);
		$this->qstn_num->setDbValue($row['qstn_num']);
		$this->qstn_text->setDbValue($row['qstn_text']);
		$this->qstn_ansr1->setDbValue($row['qstn_ansr1']);
		$this->qstn_val1->setDbValue($row['qstn_val1']);
		$this->qstn_rep1->setDbValue($row['qstn_rep1']);
		$this->qstn_ansr2->setDbValue($row['qstn_ansr2']);
		$this->qstn_val2->setDbValue($row['qstn_val2']);
		$this->qstn_rep2->setDbValue($row['qstn_rep2']);
		$this->qstn_ansr3->setDbValue($row['qstn_ansr3']);
		$this->qstn_val3->setDbValue($row['qstn_val3']);
		$this->qstn_rep3->setDbValue($row['qstn_rep3']);
		$this->qstn_ansr4->setDbValue($row['qstn_ansr4']);
		$this->qstn_val4->setDbValue($row['qstn_val4']);
		$this->qstn_rep4->setDbValue($row['qstn_rep4']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['qstn_id'] = NULL;
		$row['test_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['gend_id'] = NULL;
		$row['qstn_num'] = NULL;
		$row['qstn_text'] = NULL;
		$row['qstn_ansr1'] = NULL;
		$row['qstn_val1'] = NULL;
		$row['qstn_rep1'] = NULL;
		$row['qstn_ansr2'] = NULL;
		$row['qstn_val2'] = NULL;
		$row['qstn_rep2'] = NULL;
		$row['qstn_ansr3'] = NULL;
		$row['qstn_val3'] = NULL;
		$row['qstn_rep3'] = NULL;
		$row['qstn_ansr4'] = NULL;
		$row['qstn_val4'] = NULL;
		$row['qstn_rep4'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->qstn_id->DbValue = $row['qstn_id'];
		$this->test_id->DbValue = $row['test_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->gend_id->DbValue = $row['gend_id'];
		$this->qstn_num->DbValue = $row['qstn_num'];
		$this->qstn_text->DbValue = $row['qstn_text'];
		$this->qstn_ansr1->DbValue = $row['qstn_ansr1'];
		$this->qstn_val1->DbValue = $row['qstn_val1'];
		$this->qstn_rep1->DbValue = $row['qstn_rep1'];
		$this->qstn_ansr2->DbValue = $row['qstn_ansr2'];
		$this->qstn_val2->DbValue = $row['qstn_val2'];
		$this->qstn_rep2->DbValue = $row['qstn_rep2'];
		$this->qstn_ansr3->DbValue = $row['qstn_ansr3'];
		$this->qstn_val3->DbValue = $row['qstn_val3'];
		$this->qstn_rep3->DbValue = $row['qstn_rep3'];
		$this->qstn_ansr4->DbValue = $row['qstn_ansr4'];
		$this->qstn_val4->DbValue = $row['qstn_val4'];
		$this->qstn_rep4->DbValue = $row['qstn_rep4'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->qstn_val1->FormValue == $this->qstn_val1->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val1->CurrentValue)))
			$this->qstn_val1->CurrentValue = ew_StrToFloat($this->qstn_val1->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qstn_val2->FormValue == $this->qstn_val2->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val2->CurrentValue)))
			$this->qstn_val2->CurrentValue = ew_StrToFloat($this->qstn_val2->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qstn_val3->FormValue == $this->qstn_val3->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val3->CurrentValue)))
			$this->qstn_val3->CurrentValue = ew_StrToFloat($this->qstn_val3->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qstn_val4->FormValue == $this->qstn_val4->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val4->CurrentValue)))
			$this->qstn_val4->CurrentValue = ew_StrToFloat($this->qstn_val4->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// qstn_id
		// test_id
		// lang_id
		// gend_id
		// qstn_num
		// qstn_text
		// qstn_ansr1
		// qstn_val1
		// qstn_rep1
		// qstn_ansr2
		// qstn_val2
		// qstn_rep2
		// qstn_ansr3
		// qstn_val3
		// qstn_rep3
		// qstn_ansr4
		// qstn_val4
		// qstn_rep4

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

		// qstn_num
		$this->qstn_num->ViewValue = $this->qstn_num->CurrentValue;
		$this->qstn_num->ViewCustomAttributes = "";

		// qstn_text
		$this->qstn_text->ViewValue = $this->qstn_text->CurrentValue;
		$this->qstn_text->ViewCustomAttributes = "";

		// qstn_ansr1
		$this->qstn_ansr1->ViewValue = $this->qstn_ansr1->CurrentValue;
		$this->qstn_ansr1->ViewCustomAttributes = "";

		// qstn_val1
		$this->qstn_val1->ViewValue = $this->qstn_val1->CurrentValue;
		$this->qstn_val1->ViewCustomAttributes = "";

		// qstn_rep1
		$this->qstn_rep1->ViewValue = $this->qstn_rep1->CurrentValue;
		$this->qstn_rep1->ViewCustomAttributes = "";

		// qstn_ansr2
		$this->qstn_ansr2->ViewValue = $this->qstn_ansr2->CurrentValue;
		$this->qstn_ansr2->ViewCustomAttributes = "";

		// qstn_val2
		$this->qstn_val2->ViewValue = $this->qstn_val2->CurrentValue;
		$this->qstn_val2->ViewCustomAttributes = "";

		// qstn_rep2
		$this->qstn_rep2->ViewValue = $this->qstn_rep2->CurrentValue;
		$this->qstn_rep2->ViewCustomAttributes = "";

		// qstn_ansr3
		$this->qstn_ansr3->ViewValue = $this->qstn_ansr3->CurrentValue;
		$this->qstn_ansr3->ViewCustomAttributes = "";

		// qstn_val3
		$this->qstn_val3->ViewValue = $this->qstn_val3->CurrentValue;
		$this->qstn_val3->ViewCustomAttributes = "";

		// qstn_rep3
		$this->qstn_rep3->ViewValue = $this->qstn_rep3->CurrentValue;
		$this->qstn_rep3->ViewCustomAttributes = "";

		// qstn_ansr4
		$this->qstn_ansr4->ViewValue = $this->qstn_ansr4->CurrentValue;
		$this->qstn_ansr4->ViewCustomAttributes = "";

		// qstn_val4
		$this->qstn_val4->ViewValue = $this->qstn_val4->CurrentValue;
		$this->qstn_val4->ViewValue = ew_FormatNumber($this->qstn_val4->ViewValue, 2, -2, -2, -2);
		$this->qstn_val4->ViewCustomAttributes = "";

		// qstn_rep4
		$this->qstn_rep4->ViewValue = $this->qstn_rep4->CurrentValue;
		$this->qstn_rep4->ViewCustomAttributes = "";

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

			// qstn_num
			$this->qstn_num->LinkCustomAttributes = "";
			$this->qstn_num->HrefValue = "";
			$this->qstn_num->TooltipValue = "";

			// qstn_text
			$this->qstn_text->LinkCustomAttributes = "";
			$this->qstn_text->HrefValue = "";
			$this->qstn_text->TooltipValue = "";

			// qstn_ansr1
			$this->qstn_ansr1->LinkCustomAttributes = "";
			$this->qstn_ansr1->HrefValue = "";
			$this->qstn_ansr1->TooltipValue = "";

			// qstn_val1
			$this->qstn_val1->LinkCustomAttributes = "";
			$this->qstn_val1->HrefValue = "";
			$this->qstn_val1->TooltipValue = "";

			// qstn_rep1
			$this->qstn_rep1->LinkCustomAttributes = "";
			$this->qstn_rep1->HrefValue = "";
			$this->qstn_rep1->TooltipValue = "";

			// qstn_ansr2
			$this->qstn_ansr2->LinkCustomAttributes = "";
			$this->qstn_ansr2->HrefValue = "";
			$this->qstn_ansr2->TooltipValue = "";

			// qstn_val2
			$this->qstn_val2->LinkCustomAttributes = "";
			$this->qstn_val2->HrefValue = "";
			$this->qstn_val2->TooltipValue = "";

			// qstn_rep2
			$this->qstn_rep2->LinkCustomAttributes = "";
			$this->qstn_rep2->HrefValue = "";
			$this->qstn_rep2->TooltipValue = "";

			// qstn_ansr3
			$this->qstn_ansr3->LinkCustomAttributes = "";
			$this->qstn_ansr3->HrefValue = "";
			$this->qstn_ansr3->TooltipValue = "";

			// qstn_val3
			$this->qstn_val3->LinkCustomAttributes = "";
			$this->qstn_val3->HrefValue = "";
			$this->qstn_val3->TooltipValue = "";

			// qstn_rep3
			$this->qstn_rep3->LinkCustomAttributes = "";
			$this->qstn_rep3->HrefValue = "";
			$this->qstn_rep3->TooltipValue = "";

			// qstn_ansr4
			$this->qstn_ansr4->LinkCustomAttributes = "";
			$this->qstn_ansr4->HrefValue = "";
			$this->qstn_ansr4->TooltipValue = "";

			// qstn_val4
			$this->qstn_val4->LinkCustomAttributes = "";
			$this->qstn_val4->HrefValue = "";
			$this->qstn_val4->TooltipValue = "";

			// qstn_rep4
			$this->qstn_rep4->LinkCustomAttributes = "";
			$this->qstn_rep4->HrefValue = "";
			$this->qstn_rep4->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// test_id
			$this->test_id->EditAttrs["class"] = "form-control";
			$this->test_id->EditCustomAttributes = "";
			if ($this->test_id->getSessionValue() <> "") {
				$this->test_id->CurrentValue = $this->test_id->getSessionValue();
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

			// qstn_num
			$this->qstn_num->EditAttrs["class"] = "form-control";
			$this->qstn_num->EditCustomAttributes = "";
			$this->qstn_num->EditValue = ew_HtmlEncode($this->qstn_num->CurrentValue);
			$this->qstn_num->PlaceHolder = ew_RemoveHtml($this->qstn_num->FldCaption());

			// qstn_text
			$this->qstn_text->EditAttrs["class"] = "form-control";
			$this->qstn_text->EditCustomAttributes = "";
			$this->qstn_text->EditValue = ew_HtmlEncode($this->qstn_text->CurrentValue);
			$this->qstn_text->PlaceHolder = ew_RemoveHtml($this->qstn_text->FldCaption());

			// qstn_ansr1
			$this->qstn_ansr1->EditAttrs["class"] = "form-control";
			$this->qstn_ansr1->EditCustomAttributes = "";
			$this->qstn_ansr1->EditValue = ew_HtmlEncode($this->qstn_ansr1->CurrentValue);
			$this->qstn_ansr1->PlaceHolder = ew_RemoveHtml($this->qstn_ansr1->FldCaption());

			// qstn_val1
			$this->qstn_val1->EditAttrs["class"] = "form-control";
			$this->qstn_val1->EditCustomAttributes = "";
			$this->qstn_val1->EditValue = ew_HtmlEncode($this->qstn_val1->CurrentValue);
			$this->qstn_val1->PlaceHolder = ew_RemoveHtml($this->qstn_val1->FldCaption());
			if (strval($this->qstn_val1->EditValue) <> "" && is_numeric($this->qstn_val1->EditValue)) $this->qstn_val1->EditValue = ew_FormatNumber($this->qstn_val1->EditValue, -2, -1, -2, 0);

			// qstn_rep1
			$this->qstn_rep1->EditAttrs["class"] = "form-control";
			$this->qstn_rep1->EditCustomAttributes = "";
			$this->qstn_rep1->EditValue = ew_HtmlEncode($this->qstn_rep1->CurrentValue);
			$this->qstn_rep1->PlaceHolder = ew_RemoveHtml($this->qstn_rep1->FldCaption());

			// qstn_ansr2
			$this->qstn_ansr2->EditAttrs["class"] = "form-control";
			$this->qstn_ansr2->EditCustomAttributes = "";
			$this->qstn_ansr2->EditValue = ew_HtmlEncode($this->qstn_ansr2->CurrentValue);
			$this->qstn_ansr2->PlaceHolder = ew_RemoveHtml($this->qstn_ansr2->FldCaption());

			// qstn_val2
			$this->qstn_val2->EditAttrs["class"] = "form-control";
			$this->qstn_val2->EditCustomAttributes = "";
			$this->qstn_val2->EditValue = ew_HtmlEncode($this->qstn_val2->CurrentValue);
			$this->qstn_val2->PlaceHolder = ew_RemoveHtml($this->qstn_val2->FldCaption());
			if (strval($this->qstn_val2->EditValue) <> "" && is_numeric($this->qstn_val2->EditValue)) $this->qstn_val2->EditValue = ew_FormatNumber($this->qstn_val2->EditValue, -2, -1, -2, 0);

			// qstn_rep2
			$this->qstn_rep2->EditAttrs["class"] = "form-control";
			$this->qstn_rep2->EditCustomAttributes = "";
			$this->qstn_rep2->EditValue = ew_HtmlEncode($this->qstn_rep2->CurrentValue);
			$this->qstn_rep2->PlaceHolder = ew_RemoveHtml($this->qstn_rep2->FldCaption());

			// qstn_ansr3
			$this->qstn_ansr3->EditAttrs["class"] = "form-control";
			$this->qstn_ansr3->EditCustomAttributes = "";
			$this->qstn_ansr3->EditValue = ew_HtmlEncode($this->qstn_ansr3->CurrentValue);
			$this->qstn_ansr3->PlaceHolder = ew_RemoveHtml($this->qstn_ansr3->FldCaption());

			// qstn_val3
			$this->qstn_val3->EditAttrs["class"] = "form-control";
			$this->qstn_val3->EditCustomAttributes = "";
			$this->qstn_val3->EditValue = ew_HtmlEncode($this->qstn_val3->CurrentValue);
			$this->qstn_val3->PlaceHolder = ew_RemoveHtml($this->qstn_val3->FldCaption());
			if (strval($this->qstn_val3->EditValue) <> "" && is_numeric($this->qstn_val3->EditValue)) $this->qstn_val3->EditValue = ew_FormatNumber($this->qstn_val3->EditValue, -2, -1, -2, 0);

			// qstn_rep3
			$this->qstn_rep3->EditAttrs["class"] = "form-control";
			$this->qstn_rep3->EditCustomAttributes = "";
			$this->qstn_rep3->EditValue = ew_HtmlEncode($this->qstn_rep3->CurrentValue);
			$this->qstn_rep3->PlaceHolder = ew_RemoveHtml($this->qstn_rep3->FldCaption());

			// qstn_ansr4
			$this->qstn_ansr4->EditAttrs["class"] = "form-control";
			$this->qstn_ansr4->EditCustomAttributes = "";
			$this->qstn_ansr4->EditValue = ew_HtmlEncode($this->qstn_ansr4->CurrentValue);
			$this->qstn_ansr4->PlaceHolder = ew_RemoveHtml($this->qstn_ansr4->FldCaption());

			// qstn_val4
			$this->qstn_val4->EditAttrs["class"] = "form-control";
			$this->qstn_val4->EditCustomAttributes = "";
			$this->qstn_val4->EditValue = ew_HtmlEncode($this->qstn_val4->CurrentValue);
			$this->qstn_val4->PlaceHolder = ew_RemoveHtml($this->qstn_val4->FldCaption());
			if (strval($this->qstn_val4->EditValue) <> "" && is_numeric($this->qstn_val4->EditValue)) $this->qstn_val4->EditValue = ew_FormatNumber($this->qstn_val4->EditValue, -2, -2, -2, -2);

			// qstn_rep4
			$this->qstn_rep4->EditAttrs["class"] = "form-control";
			$this->qstn_rep4->EditCustomAttributes = "";
			$this->qstn_rep4->EditValue = ew_HtmlEncode($this->qstn_rep4->CurrentValue);
			$this->qstn_rep4->PlaceHolder = ew_RemoveHtml($this->qstn_rep4->FldCaption());

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

			// qstn_num
			$this->qstn_num->LinkCustomAttributes = "";
			$this->qstn_num->HrefValue = "";

			// qstn_text
			$this->qstn_text->LinkCustomAttributes = "";
			$this->qstn_text->HrefValue = "";

			// qstn_ansr1
			$this->qstn_ansr1->LinkCustomAttributes = "";
			$this->qstn_ansr1->HrefValue = "";

			// qstn_val1
			$this->qstn_val1->LinkCustomAttributes = "";
			$this->qstn_val1->HrefValue = "";

			// qstn_rep1
			$this->qstn_rep1->LinkCustomAttributes = "";
			$this->qstn_rep1->HrefValue = "";

			// qstn_ansr2
			$this->qstn_ansr2->LinkCustomAttributes = "";
			$this->qstn_ansr2->HrefValue = "";

			// qstn_val2
			$this->qstn_val2->LinkCustomAttributes = "";
			$this->qstn_val2->HrefValue = "";

			// qstn_rep2
			$this->qstn_rep2->LinkCustomAttributes = "";
			$this->qstn_rep2->HrefValue = "";

			// qstn_ansr3
			$this->qstn_ansr3->LinkCustomAttributes = "";
			$this->qstn_ansr3->HrefValue = "";

			// qstn_val3
			$this->qstn_val3->LinkCustomAttributes = "";
			$this->qstn_val3->HrefValue = "";

			// qstn_rep3
			$this->qstn_rep3->LinkCustomAttributes = "";
			$this->qstn_rep3->HrefValue = "";

			// qstn_ansr4
			$this->qstn_ansr4->LinkCustomAttributes = "";
			$this->qstn_ansr4->HrefValue = "";

			// qstn_val4
			$this->qstn_val4->LinkCustomAttributes = "";
			$this->qstn_val4->HrefValue = "";

			// qstn_rep4
			$this->qstn_rep4->LinkCustomAttributes = "";
			$this->qstn_rep4->HrefValue = "";
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
		$lUpdateCnt = 0;
		if ($this->test_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->gend_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_num->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_text->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_ansr1->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_val1->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_rep1->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_ansr2->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_val2->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_rep2->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_ansr3->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_val3->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_rep3->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_ansr4->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_val4->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->qstn_rep4->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->test_id->MultiUpdate <> "" && !$this->test_id->FldIsDetailKey && !is_null($this->test_id->FormValue) && $this->test_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->test_id->FldCaption(), $this->test_id->ReqErrMsg));
		}
		if ($this->lang_id->MultiUpdate <> "" && !$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if ($this->gend_id->MultiUpdate <> "" && !$this->gend_id->FldIsDetailKey && !is_null($this->gend_id->FormValue) && $this->gend_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->gend_id->FldCaption(), $this->gend_id->ReqErrMsg));
		}
		if ($this->qstn_num->MultiUpdate <> "" && !$this->qstn_num->FldIsDetailKey && !is_null($this->qstn_num->FormValue) && $this->qstn_num->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_num->FldCaption(), $this->qstn_num->ReqErrMsg));
		}
		if ($this->qstn_num->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->qstn_num->FormValue)) {
				ew_AddMessage($gsFormError, $this->qstn_num->FldErrMsg());
			}
		}
		if ($this->qstn_text->MultiUpdate <> "" && !$this->qstn_text->FldIsDetailKey && !is_null($this->qstn_text->FormValue) && $this->qstn_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_text->FldCaption(), $this->qstn_text->ReqErrMsg));
		}
		if ($this->qstn_ansr1->MultiUpdate <> "" && !$this->qstn_ansr1->FldIsDetailKey && !is_null($this->qstn_ansr1->FormValue) && $this->qstn_ansr1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_ansr1->FldCaption(), $this->qstn_ansr1->ReqErrMsg));
		}
		if ($this->qstn_val1->MultiUpdate <> "" && !$this->qstn_val1->FldIsDetailKey && !is_null($this->qstn_val1->FormValue) && $this->qstn_val1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_val1->FldCaption(), $this->qstn_val1->ReqErrMsg));
		}
		if ($this->qstn_val1->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->qstn_val1->FormValue)) {
				ew_AddMessage($gsFormError, $this->qstn_val1->FldErrMsg());
			}
		}
		if ($this->qstn_rep1->MultiUpdate <> "" && !$this->qstn_rep1->FldIsDetailKey && !is_null($this->qstn_rep1->FormValue) && $this->qstn_rep1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_rep1->FldCaption(), $this->qstn_rep1->ReqErrMsg));
		}
		if ($this->qstn_ansr2->MultiUpdate <> "" && !$this->qstn_ansr2->FldIsDetailKey && !is_null($this->qstn_ansr2->FormValue) && $this->qstn_ansr2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_ansr2->FldCaption(), $this->qstn_ansr2->ReqErrMsg));
		}
		if ($this->qstn_val2->MultiUpdate <> "" && !$this->qstn_val2->FldIsDetailKey && !is_null($this->qstn_val2->FormValue) && $this->qstn_val2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_val2->FldCaption(), $this->qstn_val2->ReqErrMsg));
		}
		if ($this->qstn_val2->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->qstn_val2->FormValue)) {
				ew_AddMessage($gsFormError, $this->qstn_val2->FldErrMsg());
			}
		}
		if ($this->qstn_rep2->MultiUpdate <> "" && !$this->qstn_rep2->FldIsDetailKey && !is_null($this->qstn_rep2->FormValue) && $this->qstn_rep2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->qstn_rep2->FldCaption(), $this->qstn_rep2->ReqErrMsg));
		}
		if ($this->qstn_val3->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->qstn_val3->FormValue)) {
				ew_AddMessage($gsFormError, $this->qstn_val3->FldErrMsg());
			}
		}
		if ($this->qstn_val4->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->qstn_val4->FormValue)) {
				ew_AddMessage($gsFormError, $this->qstn_val4->FldErrMsg());
			}
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

			// test_id
			$this->test_id->SetDbValueDef($rsnew, $this->test_id->CurrentValue, 0, $this->test_id->ReadOnly || $this->test_id->MultiUpdate <> "1");

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly || $this->lang_id->MultiUpdate <> "1");

			// gend_id
			$this->gend_id->SetDbValueDef($rsnew, $this->gend_id->CurrentValue, 0, $this->gend_id->ReadOnly || $this->gend_id->MultiUpdate <> "1");

			// qstn_num
			$this->qstn_num->SetDbValueDef($rsnew, $this->qstn_num->CurrentValue, 0, $this->qstn_num->ReadOnly || $this->qstn_num->MultiUpdate <> "1");

			// qstn_text
			$this->qstn_text->SetDbValueDef($rsnew, $this->qstn_text->CurrentValue, "", $this->qstn_text->ReadOnly || $this->qstn_text->MultiUpdate <> "1");

			// qstn_ansr1
			$this->qstn_ansr1->SetDbValueDef($rsnew, $this->qstn_ansr1->CurrentValue, "", $this->qstn_ansr1->ReadOnly || $this->qstn_ansr1->MultiUpdate <> "1");

			// qstn_val1
			$this->qstn_val1->SetDbValueDef($rsnew, $this->qstn_val1->CurrentValue, 0, $this->qstn_val1->ReadOnly || $this->qstn_val1->MultiUpdate <> "1");

			// qstn_rep1
			$this->qstn_rep1->SetDbValueDef($rsnew, $this->qstn_rep1->CurrentValue, "", $this->qstn_rep1->ReadOnly || $this->qstn_rep1->MultiUpdate <> "1");

			// qstn_ansr2
			$this->qstn_ansr2->SetDbValueDef($rsnew, $this->qstn_ansr2->CurrentValue, "", $this->qstn_ansr2->ReadOnly || $this->qstn_ansr2->MultiUpdate <> "1");

			// qstn_val2
			$this->qstn_val2->SetDbValueDef($rsnew, $this->qstn_val2->CurrentValue, 0, $this->qstn_val2->ReadOnly || $this->qstn_val2->MultiUpdate <> "1");

			// qstn_rep2
			$this->qstn_rep2->SetDbValueDef($rsnew, $this->qstn_rep2->CurrentValue, "", $this->qstn_rep2->ReadOnly || $this->qstn_rep2->MultiUpdate <> "1");

			// qstn_ansr3
			$this->qstn_ansr3->SetDbValueDef($rsnew, $this->qstn_ansr3->CurrentValue, NULL, $this->qstn_ansr3->ReadOnly || $this->qstn_ansr3->MultiUpdate <> "1");

			// qstn_val3
			$this->qstn_val3->SetDbValueDef($rsnew, $this->qstn_val3->CurrentValue, NULL, $this->qstn_val3->ReadOnly || $this->qstn_val3->MultiUpdate <> "1");

			// qstn_rep3
			$this->qstn_rep3->SetDbValueDef($rsnew, $this->qstn_rep3->CurrentValue, NULL, $this->qstn_rep3->ReadOnly || $this->qstn_rep3->MultiUpdate <> "1");

			// qstn_ansr4
			$this->qstn_ansr4->SetDbValueDef($rsnew, $this->qstn_ansr4->CurrentValue, NULL, $this->qstn_ansr4->ReadOnly || $this->qstn_ansr4->MultiUpdate <> "1");

			// qstn_val4
			$this->qstn_val4->SetDbValueDef($rsnew, $this->qstn_val4->CurrentValue, NULL, $this->qstn_val4->ReadOnly || $this->qstn_val4->MultiUpdate <> "1");

			// qstn_rep4
			$this->qstn_rep4->SetDbValueDef($rsnew, $this->qstn_rep4->CurrentValue, NULL, $this->qstn_rep4->ReadOnly || $this->qstn_rep4->MultiUpdate <> "1");

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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_test_questionlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_test_question_update)) $app_test_question_update = new capp_test_question_update();

// Page init
$app_test_question_update->Page_Init();

// Page main
$app_test_question_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_question_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fapp_test_questionupdate = new ew_Form("fapp_test_questionupdate", "update");

// Validate form
fapp_test_questionupdate.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		ew_Alert(ewLanguage.Phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_test_id");
			uelm = this.GetElements("u" + infix + "_test_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->test_id->FldCaption(), $app_test_question->test_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_id");
			uelm = this.GetElements("u" + infix + "_lang_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->lang_id->FldCaption(), $app_test_question->lang_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_gend_id");
			uelm = this.GetElements("u" + infix + "_gend_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->gend_id->FldCaption(), $app_test_question->gend_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_num");
			uelm = this.GetElements("u" + infix + "_qstn_num");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_num->FldCaption(), $app_test_question->qstn_num->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_num");
			uelm = this.GetElements("u" + infix + "_qstn_num");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_num->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_text");
			uelm = this.GetElements("u" + infix + "_qstn_text");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_text->FldCaption(), $app_test_question->qstn_text->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_ansr1");
			uelm = this.GetElements("u" + infix + "_qstn_ansr1");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_ansr1->FldCaption(), $app_test_question->qstn_ansr1->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_val1");
			uelm = this.GetElements("u" + infix + "_qstn_val1");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_val1->FldCaption(), $app_test_question->qstn_val1->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_val1");
			uelm = this.GetElements("u" + infix + "_qstn_val1");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val1->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_rep1");
			uelm = this.GetElements("u" + infix + "_qstn_rep1");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_rep1->FldCaption(), $app_test_question->qstn_rep1->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_ansr2");
			uelm = this.GetElements("u" + infix + "_qstn_ansr2");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_ansr2->FldCaption(), $app_test_question->qstn_ansr2->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_val2");
			uelm = this.GetElements("u" + infix + "_qstn_val2");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_val2->FldCaption(), $app_test_question->qstn_val2->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_val2");
			uelm = this.GetElements("u" + infix + "_qstn_val2");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_rep2");
			uelm = this.GetElements("u" + infix + "_qstn_rep2");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_test_question->qstn_rep2->FldCaption(), $app_test_question->qstn_rep2->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_qstn_val3");
			uelm = this.GetElements("u" + infix + "_qstn_val3");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val3->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qstn_val4");
			uelm = this.GetElements("u" + infix + "_qstn_val4");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val4->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_test_questionupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_questionupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_questionupdate.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_questionupdate.Lists["x_test_id"].Data = "<?php echo $app_test_question_update->test_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_test_questionupdate.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_questionupdate.Lists["x_lang_id"].Data = "<?php echo $app_test_question_update->lang_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_test_questionupdate.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_test_questionupdate.Lists["x_gend_id"].Data = "<?php echo $app_test_question_update->gend_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_test_question_update->ShowPageHeader(); ?>
<?php
$app_test_question_update->ShowMessage();
?>
<form name="fapp_test_questionupdate" id="fapp_test_questionupdate" class="<?php echo $app_test_question_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_test_question_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_test_question_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_test_question">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_test_question_update->IsModal) ?>">
<?php foreach ($app_test_question_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_app_test_questionupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($app_test_question->test_id->Visible) { // test_id ?>
	<div id="r_test_id" class="form-group">
		<label for="x_test_id" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_test_id" id="u_test_id" class="ewMultiSelect" value="1"<?php echo ($app_test_question->test_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->test_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->test_id->CellAttributes() ?>>
<?php if ($app_test_question->test_id->getSessionValue() <> "") { ?>
<span id="el_app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_test_question->test_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_test_id" name="x_test_id" value="<?php echo ew_HtmlEncode($app_test_question->test_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_app_test_question_test_id">
<select data-table="app_test_question" data-field="x_test_id" data-value-separator="<?php echo $app_test_question->test_id->DisplayValueSeparatorAttribute() ?>" id="x_test_id" name="x_test_id"<?php echo $app_test_question->test_id->EditAttributes() ?>>
<?php echo $app_test_question->test_id->SelectOptionListHtml("x_test_id") ?>
</select>
</span>
<?php } ?>
<?php echo $app_test_question->test_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_id" id="u_lang_id" class="ewMultiSelect" value="1"<?php echo ($app_test_question->lang_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->lang_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->lang_id->CellAttributes() ?>>
<span id="el_app_test_question_lang_id">
<select data-table="app_test_question" data-field="x_lang_id" data-value-separator="<?php echo $app_test_question->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $app_test_question->lang_id->EditAttributes() ?>>
<?php echo $app_test_question->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $app_test_question->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->gend_id->Visible) { // gend_id ?>
	<div id="r_gend_id" class="form-group">
		<label for="x_gend_id" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_gend_id" id="u_gend_id" class="ewMultiSelect" value="1"<?php echo ($app_test_question->gend_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->gend_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->gend_id->CellAttributes() ?>>
<span id="el_app_test_question_gend_id">
<select data-table="app_test_question" data-field="x_gend_id" data-value-separator="<?php echo $app_test_question->gend_id->DisplayValueSeparatorAttribute() ?>" id="x_gend_id" name="x_gend_id"<?php echo $app_test_question->gend_id->EditAttributes() ?>>
<?php echo $app_test_question->gend_id->SelectOptionListHtml("x_gend_id") ?>
</select>
</span>
<?php echo $app_test_question->gend_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_num->Visible) { // qstn_num ?>
	<div id="r_qstn_num" class="form-group">
		<label for="x_qstn_num" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_num" id="u_qstn_num" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_num->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_num->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_num->CellAttributes() ?>>
<span id="el_app_test_question_qstn_num">
<input type="text" data-table="app_test_question" data-field="x_qstn_num" name="x_qstn_num" id="x_qstn_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_num->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_num->EditValue ?>"<?php echo $app_test_question->qstn_num->EditAttributes() ?>>
</span>
<?php echo $app_test_question->qstn_num->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_text->Visible) { // qstn_text ?>
	<div id="r_qstn_text" class="form-group">
		<label class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_text" id="u_qstn_text" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_text->CellAttributes() ?>>
<span id="el_app_test_question_qstn_text">
<?php ew_AppendClass($app_test_question->qstn_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_text" name="x_qstn_text" id="x_qstn_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_text->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_text->EditAttributes() ?>><?php echo $app_test_question->qstn_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questionupdate", "x_qstn_text", 35, 4, <?php echo ($app_test_question->qstn_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $app_test_question->qstn_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr1->Visible) { // qstn_ansr1 ?>
	<div id="r_qstn_ansr1" class="form-group">
		<label class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_ansr1" id="u_qstn_ansr1" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_ansr1->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_ansr1->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr1->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr1">
<?php ew_AppendClass($app_test_question->qstn_ansr1->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_test_question" data-field="x_qstn_ansr1" name="x_qstn_ansr1" id="x_qstn_ansr1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr1->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr1->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_test_questionupdate", "x_qstn_ansr1", 35, 2, <?php echo ($app_test_question->qstn_ansr1->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $app_test_question->qstn_ansr1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val1->Visible) { // qstn_val1 ?>
	<div id="r_qstn_val1" class="form-group">
		<label for="x_qstn_val1" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_val1" id="u_qstn_val1" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_val1->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_val1->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val1->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val1">
<input type="text" data-table="app_test_question" data-field="x_qstn_val1" name="x_qstn_val1" id="x_qstn_val1" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val1->EditValue ?>"<?php echo $app_test_question->qstn_val1->EditAttributes() ?>>
</span>
<?php echo $app_test_question->qstn_val1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep1->Visible) { // qstn_rep1 ?>
	<div id="r_qstn_rep1" class="form-group">
		<label for="x_qstn_rep1" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_rep1" id="u_qstn_rep1" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_rep1->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_rep1->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep1->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep1">
<textarea data-table="app_test_question" data-field="x_qstn_rep1" name="x_qstn_rep1" id="x_qstn_rep1" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep1->EditAttributes() ?>><?php echo $app_test_question->qstn_rep1->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_rep1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr2->Visible) { // qstn_ansr2 ?>
	<div id="r_qstn_ansr2" class="form-group">
		<label for="x_qstn_ansr2" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_ansr2" id="u_qstn_ansr2" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_ansr2->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_ansr2->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr2->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr2">
<textarea data-table="app_test_question" data-field="x_qstn_ansr2" name="x_qstn_ansr2" id="x_qstn_ansr2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr2->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr2->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_ansr2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val2->Visible) { // qstn_val2 ?>
	<div id="r_qstn_val2" class="form-group">
		<label for="x_qstn_val2" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_val2" id="u_qstn_val2" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_val2->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_val2->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val2->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val2">
<input type="text" data-table="app_test_question" data-field="x_qstn_val2" name="x_qstn_val2" id="x_qstn_val2" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val2->EditValue ?>"<?php echo $app_test_question->qstn_val2->EditAttributes() ?>>
</span>
<?php echo $app_test_question->qstn_val2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep2->Visible) { // qstn_rep2 ?>
	<div id="r_qstn_rep2" class="form-group">
		<label for="x_qstn_rep2" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_rep2" id="u_qstn_rep2" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_rep2->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_rep2->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep2->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep2">
<textarea data-table="app_test_question" data-field="x_qstn_rep2" name="x_qstn_rep2" id="x_qstn_rep2" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep2->EditAttributes() ?>><?php echo $app_test_question->qstn_rep2->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_rep2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr3->Visible) { // qstn_ansr3 ?>
	<div id="r_qstn_ansr3" class="form-group">
		<label for="x_qstn_ansr3" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_ansr3" id="u_qstn_ansr3" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_ansr3->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_ansr3->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr3->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr3">
<textarea data-table="app_test_question" data-field="x_qstn_ansr3" name="x_qstn_ansr3" id="x_qstn_ansr3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr3->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr3->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_ansr3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val3->Visible) { // qstn_val3 ?>
	<div id="r_qstn_val3" class="form-group">
		<label for="x_qstn_val3" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_val3" id="u_qstn_val3" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_val3->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_val3->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val3->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val3">
<input type="text" data-table="app_test_question" data-field="x_qstn_val3" name="x_qstn_val3" id="x_qstn_val3" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val3->EditValue ?>"<?php echo $app_test_question->qstn_val3->EditAttributes() ?>>
</span>
<?php echo $app_test_question->qstn_val3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep3->Visible) { // qstn_rep3 ?>
	<div id="r_qstn_rep3" class="form-group">
		<label for="x_qstn_rep3" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_rep3" id="u_qstn_rep3" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_rep3->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_rep3->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep3->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep3">
<textarea data-table="app_test_question" data-field="x_qstn_rep3" name="x_qstn_rep3" id="x_qstn_rep3" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep3->EditAttributes() ?>><?php echo $app_test_question->qstn_rep3->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_rep3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr4->Visible) { // qstn_ansr4 ?>
	<div id="r_qstn_ansr4" class="form-group">
		<label for="x_qstn_ansr4" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_ansr4" id="u_qstn_ansr4" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_ansr4->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_ansr4->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr4->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr4">
<textarea data-table="app_test_question" data-field="x_qstn_ansr4" name="x_qstn_ansr4" id="x_qstn_ansr4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_ansr4->EditAttributes() ?>><?php echo $app_test_question->qstn_ansr4->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_ansr4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val4->Visible) { // qstn_val4 ?>
	<div id="r_qstn_val4" class="form-group">
		<label for="x_qstn_val4" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_val4" id="u_qstn_val4" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_val4->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_val4->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val4->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val4">
<input type="text" data-table="app_test_question" data-field="x_qstn_val4" name="x_qstn_val4" id="x_qstn_val4" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val4->EditValue ?>"<?php echo $app_test_question->qstn_val4->EditAttributes() ?>>
</span>
<?php echo $app_test_question->qstn_val4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep4->Visible) { // qstn_rep4 ?>
	<div id="r_qstn_rep4" class="form-group">
		<label for="x_qstn_rep4" class="<?php echo $app_test_question_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_qstn_rep4" id="u_qstn_rep4" class="ewMultiSelect" value="1"<?php echo ($app_test_question->qstn_rep4->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_test_question->qstn_rep4->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_test_question_update->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep4->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep4">
<textarea data-table="app_test_question" data-field="x_qstn_rep4" name="x_qstn_rep4" id="x_qstn_rep4" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->getPlaceHolder()) ?>"<?php echo $app_test_question->qstn_rep4->EditAttributes() ?>><?php echo $app_test_question->qstn_rep4->EditValue ?></textarea>
</span>
<?php echo $app_test_question->qstn_rep4->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$app_test_question_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $app_test_question_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_test_question_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_test_questionupdate.Init();
</script>
<?php
$app_test_question_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_test_question_update->Page_Terminate();
?>
