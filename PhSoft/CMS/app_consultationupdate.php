<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_consultationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_consult_assigngridcls.php" ?>
<?php include_once "app_consult_answergridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_consultation_update = NULL; // Initialize page object first

class capp_consultation_update extends capp_consultation {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_consultation';

	// Page object name
	var $PageObjName = 'app_consultation_update';

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

		// Table object (app_consultation)
		if (!isset($GLOBALS["app_consultation"]) || get_class($GLOBALS["app_consultation"]) == "capp_consultation") {
			$GLOBALS["app_consultation"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_consultation"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_consultation', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_consultationlist.php"));
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
		$this->cstatus_id->SetVisibility();
		$this->cat_id->SetVisibility();
		$this->cons_amount->SetVisibility();
		$this->cons_file->SetVisibility();
		$this->cons_audio->SetVisibility();
		$this->cons_message->SetVisibility();
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

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("app_consult_assign", $DetailTblVar)) {

					// Process auto fill for detail table 'app_consult_assign'
					if (preg_match('/^fapp_consult_assign(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_consult_assign_grid"])) $GLOBALS["app_consult_assign_grid"] = new capp_consult_assign_grid;
						$GLOBALS["app_consult_assign_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("app_consult_answer", $DetailTblVar)) {

					// Process auto fill for detail table 'app_consult_answer'
					if (preg_match('/^fapp_consult_answer(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_consult_answer_grid"])) $GLOBALS["app_consult_answer_grid"] = new capp_consult_answer_grid;
						$GLOBALS["app_consult_answer_grid"]->Page_Init();
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
		global $EW_EXPORT, $app_consultation;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_consultation);
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
					if ($pageName == "app_consultationview.php")
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
			$this->Page_Terminate("app_consultationlist.php"); // No records selected, return to list
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
					$this->user_id->setDbValue($this->Recordset->fields('user_id'));
					$this->cstatus_id->setDbValue($this->Recordset->fields('cstatus_id'));
					$this->cat_id->setDbValue($this->Recordset->fields('cat_id'));
					$this->cons_amount->setDbValue($this->Recordset->fields('cons_amount'));
					$this->cons_file->setDbValue($this->Recordset->fields('cons_file'));
					$this->cons_audio->setDbValue($this->Recordset->fields('cons_audio'));
					$this->cons_message->setDbValue($this->Recordset->fields('cons_message'));
					$this->ins_datetime->setDbValue($this->Recordset->fields('ins_datetime'));
				} else {
					if (!ew_CompareValue($this->user_id->DbValue, $this->Recordset->fields('user_id')))
						$this->user_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->cstatus_id->DbValue, $this->Recordset->fields('cstatus_id')))
						$this->cstatus_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->cat_id->DbValue, $this->Recordset->fields('cat_id')))
						$this->cat_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->cons_amount->DbValue, $this->Recordset->fields('cons_amount')))
						$this->cons_amount->CurrentValue = NULL;
					if (!ew_CompareValue($this->cons_file->DbValue, $this->Recordset->fields('cons_file')))
						$this->cons_file->CurrentValue = NULL;
					if (!ew_CompareValue($this->cons_audio->DbValue, $this->Recordset->fields('cons_audio')))
						$this->cons_audio->CurrentValue = NULL;
					if (!ew_CompareValue($this->cons_message->DbValue, $this->Recordset->fields('cons_message')))
						$this->cons_message->CurrentValue = NULL;
					if (!ew_CompareValue($this->ins_datetime->DbValue, $this->Recordset->fields('ins_datetime')))
						$this->ins_datetime->CurrentValue = NULL;
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
		$this->cons_id->CurrentValue = $sKeyFld;
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
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		$this->user_id->MultiUpdate = $objForm->GetValue("u_user_id");
		if (!$this->cstatus_id->FldIsDetailKey) {
			$this->cstatus_id->setFormValue($objForm->GetValue("x_cstatus_id"));
		}
		$this->cstatus_id->MultiUpdate = $objForm->GetValue("u_cstatus_id");
		if (!$this->cat_id->FldIsDetailKey) {
			$this->cat_id->setFormValue($objForm->GetValue("x_cat_id"));
		}
		$this->cat_id->MultiUpdate = $objForm->GetValue("u_cat_id");
		if (!$this->cons_amount->FldIsDetailKey) {
			$this->cons_amount->setFormValue($objForm->GetValue("x_cons_amount"));
		}
		$this->cons_amount->MultiUpdate = $objForm->GetValue("u_cons_amount");
		if (!$this->cons_file->FldIsDetailKey) {
			$this->cons_file->setFormValue($objForm->GetValue("x_cons_file"));
		}
		$this->cons_file->MultiUpdate = $objForm->GetValue("u_cons_file");
		if (!$this->cons_audio->FldIsDetailKey) {
			$this->cons_audio->setFormValue($objForm->GetValue("x_cons_audio"));
		}
		$this->cons_audio->MultiUpdate = $objForm->GetValue("u_cons_audio");
		if (!$this->cons_message->FldIsDetailKey) {
			$this->cons_message->setFormValue($objForm->GetValue("x_cons_message"));
		}
		$this->cons_message->MultiUpdate = $objForm->GetValue("u_cons_message");
		if (!$this->ins_datetime->FldIsDetailKey) {
			$this->ins_datetime->setFormValue($objForm->GetValue("x_ins_datetime"));
			$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11);
		}
		$this->ins_datetime->MultiUpdate = $objForm->GetValue("u_ins_datetime");
		if (!$this->cons_id->FldIsDetailKey)
			$this->cons_id->setFormValue($objForm->GetValue("x_cons_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->cons_id->CurrentValue = $this->cons_id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->cstatus_id->CurrentValue = $this->cstatus_id->FormValue;
		$this->cat_id->CurrentValue = $this->cat_id->FormValue;
		$this->cons_amount->CurrentValue = $this->cons_amount->FormValue;
		$this->cons_file->CurrentValue = $this->cons_file->FormValue;
		$this->cons_audio->CurrentValue = $this->cons_audio->FormValue;
		$this->cons_message->CurrentValue = $this->cons_message->FormValue;
		$this->ins_datetime->CurrentValue = $this->ins_datetime->FormValue;
		$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11);
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
		$this->cons_id->setDbValue($row['cons_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->cstatus_id->setDbValue($row['cstatus_id']);
		$this->cat_id->setDbValue($row['cat_id']);
		$this->cons_amount->setDbValue($row['cons_amount']);
		$this->cons_file->setDbValue($row['cons_file']);
		$this->cons_audio->setDbValue($row['cons_audio']);
		$this->cons_message->setDbValue($row['cons_message']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['cons_id'] = NULL;
		$row['user_id'] = NULL;
		$row['cstatus_id'] = NULL;
		$row['cat_id'] = NULL;
		$row['cons_amount'] = NULL;
		$row['cons_file'] = NULL;
		$row['cons_audio'] = NULL;
		$row['cons_message'] = NULL;
		$row['ins_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->cons_id->DbValue = $row['cons_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->cstatus_id->DbValue = $row['cstatus_id'];
		$this->cat_id->DbValue = $row['cat_id'];
		$this->cons_amount->DbValue = $row['cons_amount'];
		$this->cons_file->DbValue = $row['cons_file'];
		$this->cons_audio->DbValue = $row['cons_audio'];
		$this->cons_message->DbValue = $row['cons_message'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->cons_amount->FormValue == $this->cons_amount->CurrentValue && is_numeric(ew_StrToFloat($this->cons_amount->CurrentValue)))
			$this->cons_amount->CurrentValue = ew_StrToFloat($this->cons_amount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// cons_id
		// user_id
		// cstatus_id
		// cat_id
		// cons_amount
		// cons_file
		// cons_audio
		// cons_message
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

		// cstatus_id
		if (strval($this->cstatus_id->CurrentValue) <> "") {
			$sFilterWrk = "`cstatus_id`" . ew_SearchString("=", $this->cstatus_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cstatus_id`, `cstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_status`";
		$sWhereWrk = "";
		$this->cstatus_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cstatus_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cstatus_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cstatus_id->ViewValue = $this->cstatus_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cstatus_id->ViewValue = $this->cstatus_id->CurrentValue;
			}
		} else {
			$this->cstatus_id->ViewValue = NULL;
		}
		$this->cstatus_id->ViewCustomAttributes = "";

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

		// cons_amount
		$this->cons_amount->ViewValue = $this->cons_amount->CurrentValue;
		$this->cons_amount->ViewCustomAttributes = "";

		// cons_file
		$this->cons_file->ViewValue = $this->cons_file->CurrentValue;
		$this->cons_file->ViewCustomAttributes = "";

		// cons_audio
		$this->cons_audio->ViewValue = $this->cons_audio->CurrentValue;
		$this->cons_audio->ViewCustomAttributes = "";

		// cons_message
		$this->cons_message->ViewValue = $this->cons_message->CurrentValue;
		$this->cons_message->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// cstatus_id
			$this->cstatus_id->LinkCustomAttributes = "";
			$this->cstatus_id->HrefValue = "";
			$this->cstatus_id->TooltipValue = "";

			// cat_id
			$this->cat_id->LinkCustomAttributes = "";
			$this->cat_id->HrefValue = "";
			$this->cat_id->TooltipValue = "";

			// cons_amount
			$this->cons_amount->LinkCustomAttributes = "";
			$this->cons_amount->HrefValue = "";
			$this->cons_amount->TooltipValue = "";

			// cons_file
			$this->cons_file->LinkCustomAttributes = "";
			$this->cons_file->HrefValue = "";
			$this->cons_file->TooltipValue = "";

			// cons_audio
			$this->cons_audio->LinkCustomAttributes = "";
			$this->cons_audio->HrefValue = "";
			$this->cons_audio->TooltipValue = "";

			// cons_message
			$this->cons_message->LinkCustomAttributes = "";
			$this->cons_message->HrefValue = "";
			$this->cons_message->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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

			// cstatus_id
			$this->cstatus_id->EditAttrs["class"] = "form-control";
			$this->cstatus_id->EditCustomAttributes = "";
			if (trim(strval($this->cstatus_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cstatus_id`" . ew_SearchString("=", $this->cstatus_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cstatus_id`, `cstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation_status`";
			$sWhereWrk = "";
			$this->cstatus_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cstatus_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cstatus_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cstatus_id->EditValue = $arwrk;

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

			// cons_amount
			$this->cons_amount->EditAttrs["class"] = "form-control";
			$this->cons_amount->EditCustomAttributes = "";
			$this->cons_amount->EditValue = ew_HtmlEncode($this->cons_amount->CurrentValue);
			$this->cons_amount->PlaceHolder = ew_RemoveHtml($this->cons_amount->FldCaption());
			if (strval($this->cons_amount->EditValue) <> "" && is_numeric($this->cons_amount->EditValue)) $this->cons_amount->EditValue = ew_FormatNumber($this->cons_amount->EditValue, -2, -1, -2, 0);

			// cons_file
			$this->cons_file->EditAttrs["class"] = "form-control";
			$this->cons_file->EditCustomAttributes = "";
			$this->cons_file->EditValue = ew_HtmlEncode($this->cons_file->CurrentValue);
			$this->cons_file->PlaceHolder = ew_RemoveHtml($this->cons_file->FldCaption());

			// cons_audio
			$this->cons_audio->EditAttrs["class"] = "form-control";
			$this->cons_audio->EditCustomAttributes = "";
			$this->cons_audio->EditValue = ew_HtmlEncode($this->cons_audio->CurrentValue);
			$this->cons_audio->PlaceHolder = ew_RemoveHtml($this->cons_audio->FldCaption());

			// cons_message
			$this->cons_message->EditAttrs["class"] = "form-control";
			$this->cons_message->EditCustomAttributes = "";
			$this->cons_message->EditValue = ew_HtmlEncode($this->cons_message->CurrentValue);
			$this->cons_message->PlaceHolder = ew_RemoveHtml($this->cons_message->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ins_datetime->CurrentValue, 11));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

			// Edit refer script
			// user_id

			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// cstatus_id
			$this->cstatus_id->LinkCustomAttributes = "";
			$this->cstatus_id->HrefValue = "";

			// cat_id
			$this->cat_id->LinkCustomAttributes = "";
			$this->cat_id->HrefValue = "";

			// cons_amount
			$this->cons_amount->LinkCustomAttributes = "";
			$this->cons_amount->HrefValue = "";

			// cons_file
			$this->cons_file->LinkCustomAttributes = "";
			$this->cons_file->HrefValue = "";

			// cons_audio
			$this->cons_audio->LinkCustomAttributes = "";
			$this->cons_audio->HrefValue = "";

			// cons_message
			$this->cons_message->LinkCustomAttributes = "";
			$this->cons_message->HrefValue = "";

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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($this->user_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->cstatus_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->cat_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->cons_amount->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->cons_file->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->cons_audio->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->cons_message->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->ins_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->user_id->MultiUpdate <> "" && !$this->user_id->FldIsDetailKey && !is_null($this->user_id->FormValue) && $this->user_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_id->FldCaption(), $this->user_id->ReqErrMsg));
		}
		if ($this->cstatus_id->MultiUpdate <> "" && !$this->cstatus_id->FldIsDetailKey && !is_null($this->cstatus_id->FormValue) && $this->cstatus_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cstatus_id->FldCaption(), $this->cstatus_id->ReqErrMsg));
		}
		if ($this->cat_id->MultiUpdate <> "" && !$this->cat_id->FldIsDetailKey && !is_null($this->cat_id->FormValue) && $this->cat_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cat_id->FldCaption(), $this->cat_id->ReqErrMsg));
		}
		if ($this->cons_amount->MultiUpdate <> "" && !$this->cons_amount->FldIsDetailKey && !is_null($this->cons_amount->FormValue) && $this->cons_amount->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cons_amount->FldCaption(), $this->cons_amount->ReqErrMsg));
		}
		if ($this->cons_amount->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->cons_amount->FormValue)) {
				ew_AddMessage($gsFormError, $this->cons_amount->FldErrMsg());
			}
		}
		if ($this->cons_message->MultiUpdate <> "" && !$this->cons_message->FldIsDetailKey && !is_null($this->cons_message->FormValue) && $this->cons_message->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cons_message->FldCaption(), $this->cons_message->ReqErrMsg));
		}
		if ($this->ins_datetime->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($this->ins_datetime->FormValue)) {
				ew_AddMessage($gsFormError, $this->ins_datetime->FldErrMsg());
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

			// user_id
			$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly || $this->user_id->MultiUpdate <> "1");

			// cstatus_id
			$this->cstatus_id->SetDbValueDef($rsnew, $this->cstatus_id->CurrentValue, 0, $this->cstatus_id->ReadOnly || $this->cstatus_id->MultiUpdate <> "1");

			// cat_id
			$this->cat_id->SetDbValueDef($rsnew, $this->cat_id->CurrentValue, 0, $this->cat_id->ReadOnly || $this->cat_id->MultiUpdate <> "1");

			// cons_amount
			$this->cons_amount->SetDbValueDef($rsnew, $this->cons_amount->CurrentValue, 0, $this->cons_amount->ReadOnly || $this->cons_amount->MultiUpdate <> "1");

			// cons_file
			$this->cons_file->SetDbValueDef($rsnew, $this->cons_file->CurrentValue, NULL, $this->cons_file->ReadOnly || $this->cons_file->MultiUpdate <> "1");

			// cons_audio
			$this->cons_audio->SetDbValueDef($rsnew, $this->cons_audio->CurrentValue, NULL, $this->cons_audio->ReadOnly || $this->cons_audio->MultiUpdate <> "1");

			// cons_message
			$this->cons_message->SetDbValueDef($rsnew, $this->cons_message->CurrentValue, "", $this->cons_message->ReadOnly || $this->cons_message->MultiUpdate <> "1");

			// ins_datetime
			$this->ins_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11), NULL, $this->ins_datetime->ReadOnly || $this->ins_datetime->MultiUpdate <> "1");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_consultationlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
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
		case "x_cstatus_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cstatus_id` AS `LinkFld`, `cstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_status`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cstatus_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cstatus_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cstatus_id`";
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
if (!isset($app_consultation_update)) $app_consultation_update = new capp_consultation_update();

// Page init
$app_consultation_update->Page_Init();

// Page main
$app_consultation_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consultation_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fapp_consultationupdate = new ew_Form("fapp_consultationupdate", "update");

// Validate form
fapp_consultationupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_user_id");
			uelm = this.GetElements("u" + infix + "_user_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation->user_id->FldCaption(), $app_consultation->user_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_cstatus_id");
			uelm = this.GetElements("u" + infix + "_cstatus_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation->cstatus_id->FldCaption(), $app_consultation->cstatus_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_cat_id");
			uelm = this.GetElements("u" + infix + "_cat_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation->cat_id->FldCaption(), $app_consultation->cat_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_cons_amount");
			uelm = this.GetElements("u" + infix + "_cons_amount");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation->cons_amount->FldCaption(), $app_consultation->cons_amount->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_cons_amount");
			uelm = this.GetElements("u" + infix + "_cons_amount");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_consultation->cons_amount->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_cons_message");
			uelm = this.GetElements("u" + infix + "_cons_message");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation->cons_message->FldCaption(), $app_consultation->cons_message->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_ins_datetime");
			uelm = this.GetElements("u" + infix + "_ins_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_consultation->ins_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_consultationupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consultationupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consultationupdate.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_consultationupdate.Lists["x_user_id"].Data = "<?php echo $app_consultation_update->user_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_consultationupdate.Lists["x_cstatus_id"] = {"LinkField":"x_cstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_status"};
fapp_consultationupdate.Lists["x_cstatus_id"].Data = "<?php echo $app_consultation_update->cstatus_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_consultationupdate.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_consultationupdate.Lists["x_cat_id"].Data = "<?php echo $app_consultation_update->cat_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_consultation_update->ShowPageHeader(); ?>
<?php
$app_consultation_update->ShowMessage();
?>
<form name="fapp_consultationupdate" id="fapp_consultationupdate" class="<?php echo $app_consultation_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_consultation_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_consultation_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_consultation">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_consultation_update->IsModal) ?>">
<?php foreach ($app_consultation_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_app_consultationupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($app_consultation->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label for="x_user_id" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_user_id" id="u_user_id" class="ewMultiSelect" value="1"<?php echo ($app_consultation->user_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->user_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->user_id->CellAttributes() ?>>
<span id="el_app_consultation_user_id">
<select data-table="app_consultation" data-field="x_user_id" data-value-separator="<?php echo $app_consultation->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_consultation->user_id->EditAttributes() ?>>
<?php echo $app_consultation->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
<?php echo $app_consultation->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cstatus_id->Visible) { // cstatus_id ?>
	<div id="r_cstatus_id" class="form-group">
		<label for="x_cstatus_id" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cstatus_id" id="u_cstatus_id" class="ewMultiSelect" value="1"<?php echo ($app_consultation->cstatus_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->cstatus_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->cstatus_id->CellAttributes() ?>>
<span id="el_app_consultation_cstatus_id">
<select data-table="app_consultation" data-field="x_cstatus_id" data-value-separator="<?php echo $app_consultation->cstatus_id->DisplayValueSeparatorAttribute() ?>" id="x_cstatus_id" name="x_cstatus_id"<?php echo $app_consultation->cstatus_id->EditAttributes() ?>>
<?php echo $app_consultation->cstatus_id->SelectOptionListHtml("x_cstatus_id") ?>
</select>
</span>
<?php echo $app_consultation->cstatus_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cat_id->Visible) { // cat_id ?>
	<div id="r_cat_id" class="form-group">
		<label for="x_cat_id" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cat_id" id="u_cat_id" class="ewMultiSelect" value="1"<?php echo ($app_consultation->cat_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->cat_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->cat_id->CellAttributes() ?>>
<span id="el_app_consultation_cat_id">
<select data-table="app_consultation" data-field="x_cat_id" data-value-separator="<?php echo $app_consultation->cat_id->DisplayValueSeparatorAttribute() ?>" id="x_cat_id" name="x_cat_id"<?php echo $app_consultation->cat_id->EditAttributes() ?>>
<?php echo $app_consultation->cat_id->SelectOptionListHtml("x_cat_id") ?>
</select>
</span>
<?php echo $app_consultation->cat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_amount->Visible) { // cons_amount ?>
	<div id="r_cons_amount" class="form-group">
		<label for="x_cons_amount" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cons_amount" id="u_cons_amount" class="ewMultiSelect" value="1"<?php echo ($app_consultation->cons_amount->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->cons_amount->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->cons_amount->CellAttributes() ?>>
<span id="el_app_consultation_cons_amount">
<input type="text" data-table="app_consultation" data-field="x_cons_amount" name="x_cons_amount" id="x_cons_amount" size="30" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_amount->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_amount->EditValue ?>"<?php echo $app_consultation->cons_amount->EditAttributes() ?>>
</span>
<?php echo $app_consultation->cons_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_file->Visible) { // cons_file ?>
	<div id="r_cons_file" class="form-group">
		<label for="x_cons_file" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cons_file" id="u_cons_file" class="ewMultiSelect" value="1"<?php echo ($app_consultation->cons_file->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->cons_file->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->cons_file->CellAttributes() ?>>
<span id="el_app_consultation_cons_file">
<input type="text" data-table="app_consultation" data-field="x_cons_file" name="x_cons_file" id="x_cons_file" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_file->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_file->EditValue ?>"<?php echo $app_consultation->cons_file->EditAttributes() ?>>
</span>
<?php echo $app_consultation->cons_file->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_audio->Visible) { // cons_audio ?>
	<div id="r_cons_audio" class="form-group">
		<label for="x_cons_audio" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cons_audio" id="u_cons_audio" class="ewMultiSelect" value="1"<?php echo ($app_consultation->cons_audio->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->cons_audio->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->cons_audio->CellAttributes() ?>>
<span id="el_app_consultation_cons_audio">
<input type="text" data-table="app_consultation" data-field="x_cons_audio" name="x_cons_audio" id="x_cons_audio" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_audio->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_audio->EditValue ?>"<?php echo $app_consultation->cons_audio->EditAttributes() ?>>
</span>
<?php echo $app_consultation->cons_audio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_message->Visible) { // cons_message ?>
	<div id="r_cons_message" class="form-group">
		<label for="x_cons_message" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_cons_message" id="u_cons_message" class="ewMultiSelect" value="1"<?php echo ($app_consultation->cons_message->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->cons_message->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->cons_message->CellAttributes() ?>>
<span id="el_app_consultation_cons_message">
<textarea data-table="app_consultation" data-field="x_cons_message" name="x_cons_message" id="x_cons_message" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_message->getPlaceHolder()) ?>"<?php echo $app_consultation->cons_message->EditAttributes() ?>><?php echo $app_consultation->cons_message->EditValue ?></textarea>
</span>
<?php echo $app_consultation->cons_message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $app_consultation_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_ins_datetime" id="u_ins_datetime" class="ewMultiSelect" value="1"<?php echo ($app_consultation->ins_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_consultation->ins_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_consultation_update->RightColumnClass ?>"><div<?php echo $app_consultation->ins_datetime->CellAttributes() ?>>
<span id="el_app_consultation_ins_datetime">
<input type="text" data-table="app_consultation" data-field="x_ins_datetime" data-format="11" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_consultation->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_consultation->ins_datetime->EditValue ?>"<?php echo $app_consultation->ins_datetime->EditAttributes() ?>>
</span>
<?php echo $app_consultation->ins_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$app_consultation_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $app_consultation_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_consultation_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_consultationupdate.Init();
</script>
<?php
$app_consultation_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_consultation_update->Page_Terminate();
?>
