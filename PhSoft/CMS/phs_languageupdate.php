<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "phs_languageinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$phs_language_update = NULL; // Initialize page object first

class cphs_language_update extends cphs_language {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'phs_language';

	// Page object name
	var $PageObjName = 'phs_language_update';

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

		// Table object (phs_language)
		if (!isset($GLOBALS["phs_language"]) || get_class($GLOBALS["phs_language"]) == "cphs_language") {
			$GLOBALS["phs_language"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["phs_language"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'phs_language', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("phs_languagelist.php"));
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
		$this->status_id->SetVisibility();
		$this->lang_code->SetVisibility();
		$this->lang_dir->SetVisibility();
		$this->lang_name->SetVisibility();
		$this->lang_dname->SetVisibility();
		$this->lang_ccode->SetVisibility();

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
		global $EW_EXPORT, $phs_language;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($phs_language);
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
					if ($pageName == "phs_languageview.php")
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
			$this->Page_Terminate("phs_languagelist.php"); // No records selected, return to list
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
					$this->status_id->setDbValue($this->Recordset->fields('status_id'));
					$this->lang_code->setDbValue($this->Recordset->fields('lang_code'));
					$this->lang_dir->setDbValue($this->Recordset->fields('lang_dir'));
					$this->lang_name->setDbValue($this->Recordset->fields('lang_name'));
					$this->lang_dname->setDbValue($this->Recordset->fields('lang_dname'));
					$this->lang_ccode->setDbValue($this->Recordset->fields('lang_ccode'));
				} else {
					if (!ew_CompareValue($this->status_id->DbValue, $this->Recordset->fields('status_id')))
						$this->status_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_code->DbValue, $this->Recordset->fields('lang_code')))
						$this->lang_code->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_dir->DbValue, $this->Recordset->fields('lang_dir')))
						$this->lang_dir->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_name->DbValue, $this->Recordset->fields('lang_name')))
						$this->lang_name->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_dname->DbValue, $this->Recordset->fields('lang_dname')))
						$this->lang_dname->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_ccode->DbValue, $this->Recordset->fields('lang_ccode')))
						$this->lang_ccode->CurrentValue = NULL;
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
		$this->lang_id->CurrentValue = $sKeyFld;
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
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		$this->status_id->MultiUpdate = $objForm->GetValue("u_status_id");
		if (!$this->lang_code->FldIsDetailKey) {
			$this->lang_code->setFormValue($objForm->GetValue("x_lang_code"));
		}
		$this->lang_code->MultiUpdate = $objForm->GetValue("u_lang_code");
		if (!$this->lang_dir->FldIsDetailKey) {
			$this->lang_dir->setFormValue($objForm->GetValue("x_lang_dir"));
		}
		$this->lang_dir->MultiUpdate = $objForm->GetValue("u_lang_dir");
		if (!$this->lang_name->FldIsDetailKey) {
			$this->lang_name->setFormValue($objForm->GetValue("x_lang_name"));
		}
		$this->lang_name->MultiUpdate = $objForm->GetValue("u_lang_name");
		if (!$this->lang_dname->FldIsDetailKey) {
			$this->lang_dname->setFormValue($objForm->GetValue("x_lang_dname"));
		}
		$this->lang_dname->MultiUpdate = $objForm->GetValue("u_lang_dname");
		if (!$this->lang_ccode->FldIsDetailKey) {
			$this->lang_ccode->setFormValue($objForm->GetValue("x_lang_ccode"));
		}
		$this->lang_ccode->MultiUpdate = $objForm->GetValue("u_lang_ccode");
		if (!$this->lang_id->FldIsDetailKey)
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->lang_code->CurrentValue = $this->lang_code->FormValue;
		$this->lang_dir->CurrentValue = $this->lang_dir->FormValue;
		$this->lang_name->CurrentValue = $this->lang_name->FormValue;
		$this->lang_dname->CurrentValue = $this->lang_dname->FormValue;
		$this->lang_ccode->CurrentValue = $this->lang_ccode->FormValue;
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
		$this->lang_id->setDbValue($row['lang_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->lang_code->setDbValue($row['lang_code']);
		$this->lang_dir->setDbValue($row['lang_dir']);
		$this->lang_name->setDbValue($row['lang_name']);
		$this->lang_dname->setDbValue($row['lang_dname']);
		$this->lang_ccode->setDbValue($row['lang_ccode']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['lang_id'] = NULL;
		$row['status_id'] = NULL;
		$row['lang_code'] = NULL;
		$row['lang_dir'] = NULL;
		$row['lang_name'] = NULL;
		$row['lang_dname'] = NULL;
		$row['lang_ccode'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->lang_id->DbValue = $row['lang_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->lang_code->DbValue = $row['lang_code'];
		$this->lang_dir->DbValue = $row['lang_dir'];
		$this->lang_name->DbValue = $row['lang_name'];
		$this->lang_dname->DbValue = $row['lang_dname'];
		$this->lang_ccode->DbValue = $row['lang_ccode'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// lang_id
		// status_id
		// lang_code
		// lang_dir
		// lang_name
		// lang_dname
		// lang_ccode

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

		// lang_code
		$this->lang_code->ViewValue = $this->lang_code->CurrentValue;
		$this->lang_code->ViewCustomAttributes = "";

		// lang_dir
		if (strval($this->lang_dir->CurrentValue) <> "") {
			$this->lang_dir->ViewValue = $this->lang_dir->OptionCaption($this->lang_dir->CurrentValue);
		} else {
			$this->lang_dir->ViewValue = NULL;
		}
		$this->lang_dir->ViewCustomAttributes = "";

		// lang_name
		$this->lang_name->ViewValue = $this->lang_name->CurrentValue;
		$this->lang_name->ViewCustomAttributes = "";

		// lang_dname
		$this->lang_dname->ViewValue = $this->lang_dname->CurrentValue;
		$this->lang_dname->ViewCustomAttributes = "";

		// lang_ccode
		$this->lang_ccode->ViewValue = $this->lang_ccode->CurrentValue;
		$this->lang_ccode->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// lang_code
			$this->lang_code->LinkCustomAttributes = "";
			$this->lang_code->HrefValue = "";
			$this->lang_code->TooltipValue = "";

			// lang_dir
			$this->lang_dir->LinkCustomAttributes = "";
			$this->lang_dir->HrefValue = "";
			$this->lang_dir->TooltipValue = "";

			// lang_name
			$this->lang_name->LinkCustomAttributes = "";
			$this->lang_name->HrefValue = "";
			$this->lang_name->TooltipValue = "";

			// lang_dname
			$this->lang_dname->LinkCustomAttributes = "";
			$this->lang_dname->HrefValue = "";
			$this->lang_dname->TooltipValue = "";

			// lang_ccode
			$this->lang_ccode->LinkCustomAttributes = "";
			$this->lang_ccode->HrefValue = "";
			$this->lang_ccode->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// lang_code
			$this->lang_code->EditAttrs["class"] = "form-control";
			$this->lang_code->EditCustomAttributes = "";
			$this->lang_code->EditValue = ew_HtmlEncode($this->lang_code->CurrentValue);
			$this->lang_code->PlaceHolder = ew_RemoveHtml($this->lang_code->FldCaption());

			// lang_dir
			$this->lang_dir->EditAttrs["class"] = "form-control";
			$this->lang_dir->EditCustomAttributes = "";
			$this->lang_dir->EditValue = $this->lang_dir->Options(TRUE);

			// lang_name
			$this->lang_name->EditAttrs["class"] = "form-control";
			$this->lang_name->EditCustomAttributes = "";
			$this->lang_name->EditValue = ew_HtmlEncode($this->lang_name->CurrentValue);
			$this->lang_name->PlaceHolder = ew_RemoveHtml($this->lang_name->FldCaption());

			// lang_dname
			$this->lang_dname->EditAttrs["class"] = "form-control";
			$this->lang_dname->EditCustomAttributes = "";
			$this->lang_dname->EditValue = ew_HtmlEncode($this->lang_dname->CurrentValue);
			$this->lang_dname->PlaceHolder = ew_RemoveHtml($this->lang_dname->FldCaption());

			// lang_ccode
			$this->lang_ccode->EditAttrs["class"] = "form-control";
			$this->lang_ccode->EditCustomAttributes = "";
			$this->lang_ccode->EditValue = ew_HtmlEncode($this->lang_ccode->CurrentValue);
			$this->lang_ccode->PlaceHolder = ew_RemoveHtml($this->lang_ccode->FldCaption());

			// Edit refer script
			// status_id

			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// lang_code
			$this->lang_code->LinkCustomAttributes = "";
			$this->lang_code->HrefValue = "";

			// lang_dir
			$this->lang_dir->LinkCustomAttributes = "";
			$this->lang_dir->HrefValue = "";

			// lang_name
			$this->lang_name->LinkCustomAttributes = "";
			$this->lang_name->HrefValue = "";

			// lang_dname
			$this->lang_dname->LinkCustomAttributes = "";
			$this->lang_dname->HrefValue = "";

			// lang_ccode
			$this->lang_ccode->LinkCustomAttributes = "";
			$this->lang_ccode->HrefValue = "";
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
		if ($this->status_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_code->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_dir->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_name->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_dname->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_ccode->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->status_id->MultiUpdate <> "" && !$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if ($this->lang_code->MultiUpdate <> "" && !$this->lang_code->FldIsDetailKey && !is_null($this->lang_code->FormValue) && $this->lang_code->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_code->FldCaption(), $this->lang_code->ReqErrMsg));
		}
		if ($this->lang_dir->MultiUpdate <> "" && !$this->lang_dir->FldIsDetailKey && !is_null($this->lang_dir->FormValue) && $this->lang_dir->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_dir->FldCaption(), $this->lang_dir->ReqErrMsg));
		}
		if ($this->lang_name->MultiUpdate <> "" && !$this->lang_name->FldIsDetailKey && !is_null($this->lang_name->FormValue) && $this->lang_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_name->FldCaption(), $this->lang_name->ReqErrMsg));
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
		if ($this->lang_code->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`lang_code` = '" . ew_AdjustSql($this->lang_code->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->lang_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->lang_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		if ($this->lang_name->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`lang_name` = '" . ew_AdjustSql($this->lang_name->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->lang_name->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->lang_name->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
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

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly || $this->status_id->MultiUpdate <> "1");

			// lang_code
			$this->lang_code->SetDbValueDef($rsnew, $this->lang_code->CurrentValue, "", $this->lang_code->ReadOnly || $this->lang_code->MultiUpdate <> "1");

			// lang_dir
			$this->lang_dir->SetDbValueDef($rsnew, $this->lang_dir->CurrentValue, "", $this->lang_dir->ReadOnly || $this->lang_dir->MultiUpdate <> "1");

			// lang_name
			$this->lang_name->SetDbValueDef($rsnew, $this->lang_name->CurrentValue, "", $this->lang_name->ReadOnly || $this->lang_name->MultiUpdate <> "1");

			// lang_dname
			$this->lang_dname->SetDbValueDef($rsnew, $this->lang_dname->CurrentValue, NULL, $this->lang_dname->ReadOnly || $this->lang_dname->MultiUpdate <> "1");

			// lang_ccode
			$this->lang_ccode->SetDbValueDef($rsnew, $this->lang_ccode->CurrentValue, NULL, $this->lang_ccode->ReadOnly || $this->lang_ccode->MultiUpdate <> "1");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("phs_languagelist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_status_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `status_id` AS `LinkFld`, `status_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_status`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`status_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($phs_language_update)) $phs_language_update = new cphs_language_update();

// Page init
$phs_language_update->Page_Init();

// Page main
$phs_language_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phs_language_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fphs_languageupdate = new ew_Form("fphs_languageupdate", "update");

// Validate form
fphs_languageupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_status_id");
			uelm = this.GetElements("u" + infix + "_status_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_language->status_id->FldCaption(), $phs_language->status_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_code");
			uelm = this.GetElements("u" + infix + "_lang_code");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_language->lang_code->FldCaption(), $phs_language->lang_code->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_dir");
			uelm = this.GetElements("u" + infix + "_lang_dir");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_language->lang_dir->FldCaption(), $phs_language->lang_dir->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_name");
			uelm = this.GetElements("u" + infix + "_lang_name");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_language->lang_name->FldCaption(), $phs_language->lang_name->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fphs_languageupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fphs_languageupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fphs_languageupdate.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fphs_languageupdate.Lists["x_status_id"].Data = "<?php echo $phs_language_update->status_id->LookupFilterQuery(FALSE, "update") ?>";
fphs_languageupdate.Lists["x_lang_dir"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fphs_languageupdate.Lists["x_lang_dir"].Options = <?php echo json_encode($phs_language_update->lang_dir->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $phs_language_update->ShowPageHeader(); ?>
<?php
$phs_language_update->ShowMessage();
?>
<form name="fphs_languageupdate" id="fphs_languageupdate" class="<?php echo $phs_language_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($phs_language_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $phs_language_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="phs_language">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($phs_language_update->IsModal) ?>">
<?php foreach ($phs_language_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_phs_languageupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($phs_language->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $phs_language_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_status_id" id="u_status_id" class="ewMultiSelect" value="1"<?php echo ($phs_language->status_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_language->status_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_language_update->RightColumnClass ?>"><div<?php echo $phs_language->status_id->CellAttributes() ?>>
<span id="el_phs_language_status_id">
<select data-table="phs_language" data-field="x_status_id" data-value-separator="<?php echo $phs_language->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $phs_language->status_id->EditAttributes() ?>>
<?php echo $phs_language->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $phs_language->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_code->Visible) { // lang_code ?>
	<div id="r_lang_code" class="form-group">
		<label for="x_lang_code" class="<?php echo $phs_language_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_code" id="u_lang_code" class="ewMultiSelect" value="1"<?php echo ($phs_language->lang_code->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_language->lang_code->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_language_update->RightColumnClass ?>"><div<?php echo $phs_language->lang_code->CellAttributes() ?>>
<span id="el_phs_language_lang_code">
<input type="text" data-table="phs_language" data-field="x_lang_code" name="x_lang_code" id="x_lang_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_code->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_code->EditValue ?>"<?php echo $phs_language->lang_code->EditAttributes() ?>>
</span>
<?php echo $phs_language->lang_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_dir->Visible) { // lang_dir ?>
	<div id="r_lang_dir" class="form-group">
		<label for="x_lang_dir" class="<?php echo $phs_language_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_dir" id="u_lang_dir" class="ewMultiSelect" value="1"<?php echo ($phs_language->lang_dir->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_language->lang_dir->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_language_update->RightColumnClass ?>"><div<?php echo $phs_language->lang_dir->CellAttributes() ?>>
<span id="el_phs_language_lang_dir">
<select data-table="phs_language" data-field="x_lang_dir" data-value-separator="<?php echo $phs_language->lang_dir->DisplayValueSeparatorAttribute() ?>" id="x_lang_dir" name="x_lang_dir"<?php echo $phs_language->lang_dir->EditAttributes() ?>>
<?php echo $phs_language->lang_dir->SelectOptionListHtml("x_lang_dir") ?>
</select>
</span>
<?php echo $phs_language->lang_dir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_name->Visible) { // lang_name ?>
	<div id="r_lang_name" class="form-group">
		<label for="x_lang_name" class="<?php echo $phs_language_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_name" id="u_lang_name" class="ewMultiSelect" value="1"<?php echo ($phs_language->lang_name->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_language->lang_name->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_language_update->RightColumnClass ?>"><div<?php echo $phs_language->lang_name->CellAttributes() ?>>
<span id="el_phs_language_lang_name">
<input type="text" data-table="phs_language" data-field="x_lang_name" name="x_lang_name" id="x_lang_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_name->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_name->EditValue ?>"<?php echo $phs_language->lang_name->EditAttributes() ?>>
</span>
<?php echo $phs_language->lang_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_dname->Visible) { // lang_dname ?>
	<div id="r_lang_dname" class="form-group">
		<label for="x_lang_dname" class="<?php echo $phs_language_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_dname" id="u_lang_dname" class="ewMultiSelect" value="1"<?php echo ($phs_language->lang_dname->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_language->lang_dname->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_language_update->RightColumnClass ?>"><div<?php echo $phs_language->lang_dname->CellAttributes() ?>>
<span id="el_phs_language_lang_dname">
<input type="text" data-table="phs_language" data-field="x_lang_dname" name="x_lang_dname" id="x_lang_dname" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_dname->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_dname->EditValue ?>"<?php echo $phs_language->lang_dname->EditAttributes() ?>>
</span>
<?php echo $phs_language->lang_dname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_ccode->Visible) { // lang_ccode ?>
	<div id="r_lang_ccode" class="form-group">
		<label for="x_lang_ccode" class="<?php echo $phs_language_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_ccode" id="u_lang_ccode" class="ewMultiSelect" value="1"<?php echo ($phs_language->lang_ccode->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_language->lang_ccode->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_language_update->RightColumnClass ?>"><div<?php echo $phs_language->lang_ccode->CellAttributes() ?>>
<span id="el_phs_language_lang_ccode">
<input type="text" data-table="phs_language" data-field="x_lang_ccode" name="x_lang_ccode" id="x_lang_ccode" size="30" maxlength="5" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_ccode->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_ccode->EditValue ?>"<?php echo $phs_language->lang_ccode->EditAttributes() ?>>
</span>
<?php echo $phs_language->lang_ccode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$phs_language_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $phs_language_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $phs_language_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fphs_languageupdate.Init();
</script>
<?php
$phs_language_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$phs_language_update->Page_Terminate();
?>
