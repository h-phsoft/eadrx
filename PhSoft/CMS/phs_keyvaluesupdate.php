<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "phs_keyvaluesinfo.php" ?>
<?php include_once "phs_keysinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$phs_keyvalues_update = NULL; // Initialize page object first

class cphs_keyvalues_update extends cphs_keyvalues {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'phs_keyvalues';

	// Page object name
	var $PageObjName = 'phs_keyvalues_update';

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

		// Table object (phs_keyvalues)
		if (!isset($GLOBALS["phs_keyvalues"]) || get_class($GLOBALS["phs_keyvalues"]) == "cphs_keyvalues") {
			$GLOBALS["phs_keyvalues"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["phs_keyvalues"];
		}

		// Table object (phs_keys)
		if (!isset($GLOBALS['phs_keys'])) $GLOBALS['phs_keys'] = new cphs_keys();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'phs_keyvalues', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("phs_keyvalueslist.php"));
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
		$this->key_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->key_value->SetVisibility();
		$this->key_rvalue->SetVisibility();
		$this->key_text->SetVisibility();

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
		global $EW_EXPORT, $phs_keyvalues;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($phs_keyvalues);
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
					if ($pageName == "phs_keyvaluesview.php")
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
			$this->Page_Terminate("phs_keyvalueslist.php"); // No records selected, return to list
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
					$this->key_id->setDbValue($this->Recordset->fields('key_id'));
					$this->lang_id->setDbValue($this->Recordset->fields('lang_id'));
					$this->key_value->setDbValue($this->Recordset->fields('key_value'));
					$this->key_rvalue->setDbValue($this->Recordset->fields('key_rvalue'));
					$this->key_text->setDbValue($this->Recordset->fields('key_text'));
				} else {
					if (!ew_CompareValue($this->key_id->DbValue, $this->Recordset->fields('key_id')))
						$this->key_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_id->DbValue, $this->Recordset->fields('lang_id')))
						$this->lang_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->key_value->DbValue, $this->Recordset->fields('key_value')))
						$this->key_value->CurrentValue = NULL;
					if (!ew_CompareValue($this->key_rvalue->DbValue, $this->Recordset->fields('key_rvalue')))
						$this->key_rvalue->CurrentValue = NULL;
					if (!ew_CompareValue($this->key_text->DbValue, $this->Recordset->fields('key_text')))
						$this->key_text->CurrentValue = NULL;
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
		$this->kval_id->CurrentValue = $sKeyFld;
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
		if (!$this->key_id->FldIsDetailKey) {
			$this->key_id->setFormValue($objForm->GetValue("x_key_id"));
		}
		$this->key_id->MultiUpdate = $objForm->GetValue("u_key_id");
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->MultiUpdate = $objForm->GetValue("u_lang_id");
		if (!$this->key_value->FldIsDetailKey) {
			$this->key_value->setFormValue($objForm->GetValue("x_key_value"));
		}
		$this->key_value->MultiUpdate = $objForm->GetValue("u_key_value");
		if (!$this->key_rvalue->FldIsDetailKey) {
			$this->key_rvalue->setFormValue($objForm->GetValue("x_key_rvalue"));
		}
		$this->key_rvalue->MultiUpdate = $objForm->GetValue("u_key_rvalue");
		if (!$this->key_text->FldIsDetailKey) {
			$this->key_text->setFormValue($objForm->GetValue("x_key_text"));
		}
		$this->key_text->MultiUpdate = $objForm->GetValue("u_key_text");
		if (!$this->kval_id->FldIsDetailKey)
			$this->kval_id->setFormValue($objForm->GetValue("x_kval_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->kval_id->CurrentValue = $this->kval_id->FormValue;
		$this->key_id->CurrentValue = $this->key_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->key_value->CurrentValue = $this->key_value->FormValue;
		$this->key_rvalue->CurrentValue = $this->key_rvalue->FormValue;
		$this->key_text->CurrentValue = $this->key_text->FormValue;
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
		$this->kval_id->setDbValue($row['kval_id']);
		$this->key_id->setDbValue($row['key_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->key_value->setDbValue($row['key_value']);
		$this->key_rvalue->setDbValue($row['key_rvalue']);
		$this->key_text->setDbValue($row['key_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['kval_id'] = NULL;
		$row['key_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['key_value'] = NULL;
		$row['key_rvalue'] = NULL;
		$row['key_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->kval_id->DbValue = $row['kval_id'];
		$this->key_id->DbValue = $row['key_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->key_value->DbValue = $row['key_value'];
		$this->key_rvalue->DbValue = $row['key_rvalue'];
		$this->key_text->DbValue = $row['key_text'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// kval_id
		// key_id
		// lang_id
		// key_value
		// key_rvalue
		// key_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// key_id
		if (strval($this->key_id->CurrentValue) <> "") {
			$sFilterWrk = "`key_id`" . ew_SearchString("=", $this->key_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `key_id`, `key_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_keys`";
		$sWhereWrk = "";
		$this->key_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->key_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `key_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->key_id->ViewValue = $this->key_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->key_id->ViewValue = $this->key_id->CurrentValue;
			}
		} else {
			$this->key_id->ViewValue = NULL;
		}
		$this->key_id->ViewCustomAttributes = "";

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

		// key_value
		$this->key_value->ViewValue = $this->key_value->CurrentValue;
		$this->key_value->ViewCustomAttributes = "";

		// key_rvalue
		$this->key_rvalue->ViewValue = $this->key_rvalue->CurrentValue;
		$this->key_rvalue->ViewCustomAttributes = "";

		// key_text
		$this->key_text->ViewValue = $this->key_text->CurrentValue;
		$this->key_text->ViewCustomAttributes = "";

			// key_id
			$this->key_id->LinkCustomAttributes = "";
			$this->key_id->HrefValue = "";
			$this->key_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// key_value
			$this->key_value->LinkCustomAttributes = "";
			$this->key_value->HrefValue = "";
			$this->key_value->TooltipValue = "";

			// key_rvalue
			$this->key_rvalue->LinkCustomAttributes = "";
			$this->key_rvalue->HrefValue = "";
			$this->key_rvalue->TooltipValue = "";

			// key_text
			$this->key_text->LinkCustomAttributes = "";
			$this->key_text->HrefValue = "";
			$this->key_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// key_id
			$this->key_id->EditAttrs["class"] = "form-control";
			$this->key_id->EditCustomAttributes = "";
			if ($this->key_id->getSessionValue() <> "") {
				$this->key_id->CurrentValue = $this->key_id->getSessionValue();
			if (strval($this->key_id->CurrentValue) <> "") {
				$sFilterWrk = "`key_id`" . ew_SearchString("=", $this->key_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `key_id`, `key_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_keys`";
			$sWhereWrk = "";
			$this->key_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->key_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `key_name`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->key_id->ViewValue = $this->key_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->key_id->ViewValue = $this->key_id->CurrentValue;
				}
			} else {
				$this->key_id->ViewValue = NULL;
			}
			$this->key_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->key_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`key_id`" . ew_SearchString("=", $this->key_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `key_id`, `key_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_keys`";
			$sWhereWrk = "";
			$this->key_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->key_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `key_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->key_id->EditValue = $arwrk;
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

			// key_value
			$this->key_value->EditAttrs["class"] = "form-control";
			$this->key_value->EditCustomAttributes = "";
			$this->key_value->EditValue = ew_HtmlEncode($this->key_value->CurrentValue);
			$this->key_value->PlaceHolder = ew_RemoveHtml($this->key_value->FldCaption());

			// key_rvalue
			$this->key_rvalue->EditAttrs["class"] = "form-control";
			$this->key_rvalue->EditCustomAttributes = "";
			$this->key_rvalue->EditValue = ew_HtmlEncode($this->key_rvalue->CurrentValue);
			$this->key_rvalue->PlaceHolder = ew_RemoveHtml($this->key_rvalue->FldCaption());

			// key_text
			$this->key_text->EditAttrs["class"] = "form-control";
			$this->key_text->EditCustomAttributes = "";
			$this->key_text->EditValue = ew_HtmlEncode($this->key_text->CurrentValue);
			$this->key_text->PlaceHolder = ew_RemoveHtml($this->key_text->FldCaption());

			// Edit refer script
			// key_id

			$this->key_id->LinkCustomAttributes = "";
			$this->key_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// key_value
			$this->key_value->LinkCustomAttributes = "";
			$this->key_value->HrefValue = "";

			// key_rvalue
			$this->key_rvalue->LinkCustomAttributes = "";
			$this->key_rvalue->HrefValue = "";

			// key_text
			$this->key_text->LinkCustomAttributes = "";
			$this->key_text->HrefValue = "";
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
		if ($this->key_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->key_value->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->key_rvalue->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->key_text->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->key_id->MultiUpdate <> "" && !$this->key_id->FldIsDetailKey && !is_null($this->key_id->FormValue) && $this->key_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->key_id->FldCaption(), $this->key_id->ReqErrMsg));
		}
		if ($this->lang_id->MultiUpdate <> "" && !$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if ($this->key_value->MultiUpdate <> "" && !$this->key_value->FldIsDetailKey && !is_null($this->key_value->FormValue) && $this->key_value->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->key_value->FldCaption(), $this->key_value->ReqErrMsg));
		}
		if ($this->key_rvalue->MultiUpdate <> "" && !$this->key_rvalue->FldIsDetailKey && !is_null($this->key_rvalue->FormValue) && $this->key_rvalue->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->key_rvalue->FldCaption(), $this->key_rvalue->ReqErrMsg));
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

			// key_id
			$this->key_id->SetDbValueDef($rsnew, $this->key_id->CurrentValue, 0, $this->key_id->ReadOnly || $this->key_id->MultiUpdate <> "1");

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly || $this->lang_id->MultiUpdate <> "1");

			// key_value
			$this->key_value->SetDbValueDef($rsnew, $this->key_value->CurrentValue, "", $this->key_value->ReadOnly || $this->key_value->MultiUpdate <> "1");

			// key_rvalue
			$this->key_rvalue->SetDbValueDef($rsnew, $this->key_rvalue->CurrentValue, "", $this->key_rvalue->ReadOnly || $this->key_rvalue->MultiUpdate <> "1");

			// key_text
			$this->key_text->SetDbValueDef($rsnew, $this->key_text->CurrentValue, NULL, $this->key_text->ReadOnly || $this->key_text->MultiUpdate <> "1");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("phs_keyvalueslist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_key_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `key_id` AS `LinkFld`, `key_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_keys`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`key_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->key_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `key_name`";
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
if (!isset($phs_keyvalues_update)) $phs_keyvalues_update = new cphs_keyvalues_update();

// Page init
$phs_keyvalues_update->Page_Init();

// Page main
$phs_keyvalues_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phs_keyvalues_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fphs_keyvaluesupdate = new ew_Form("fphs_keyvaluesupdate", "update");

// Validate form
fphs_keyvaluesupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_key_id");
			uelm = this.GetElements("u" + infix + "_key_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->key_id->FldCaption(), $phs_keyvalues->key_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_id");
			uelm = this.GetElements("u" + infix + "_lang_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->lang_id->FldCaption(), $phs_keyvalues->lang_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_key_value");
			uelm = this.GetElements("u" + infix + "_key_value");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->key_value->FldCaption(), $phs_keyvalues->key_value->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_key_rvalue");
			uelm = this.GetElements("u" + infix + "_key_rvalue");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_keyvalues->key_rvalue->FldCaption(), $phs_keyvalues->key_rvalue->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fphs_keyvaluesupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fphs_keyvaluesupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fphs_keyvaluesupdate.Lists["x_key_id"] = {"LinkField":"x_key_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_key_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_keys"};
fphs_keyvaluesupdate.Lists["x_key_id"].Data = "<?php echo $phs_keyvalues_update->key_id->LookupFilterQuery(FALSE, "update") ?>";
fphs_keyvaluesupdate.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fphs_keyvaluesupdate.Lists["x_lang_id"].Data = "<?php echo $phs_keyvalues_update->lang_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $phs_keyvalues_update->ShowPageHeader(); ?>
<?php
$phs_keyvalues_update->ShowMessage();
?>
<form name="fphs_keyvaluesupdate" id="fphs_keyvaluesupdate" class="<?php echo $phs_keyvalues_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($phs_keyvalues_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $phs_keyvalues_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="phs_keyvalues">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($phs_keyvalues_update->IsModal) ?>">
<?php foreach ($phs_keyvalues_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_phs_keyvaluesupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($phs_keyvalues->key_id->Visible) { // key_id ?>
	<div id="r_key_id" class="form-group">
		<label for="x_key_id" class="<?php echo $phs_keyvalues_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_key_id" id="u_key_id" class="ewMultiSelect" value="1"<?php echo ($phs_keyvalues->key_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_keyvalues->key_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_keyvalues_update->RightColumnClass ?>"><div<?php echo $phs_keyvalues->key_id->CellAttributes() ?>>
<?php if ($phs_keyvalues->key_id->getSessionValue() <> "") { ?>
<span id="el_phs_keyvalues_key_id">
<span<?php echo $phs_keyvalues->key_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $phs_keyvalues->key_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_key_id" name="x_key_id" value="<?php echo ew_HtmlEncode($phs_keyvalues->key_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_phs_keyvalues_key_id">
<select data-table="phs_keyvalues" data-field="x_key_id" data-value-separator="<?php echo $phs_keyvalues->key_id->DisplayValueSeparatorAttribute() ?>" id="x_key_id" name="x_key_id"<?php echo $phs_keyvalues->key_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->key_id->SelectOptionListHtml("x_key_id") ?>
</select>
</span>
<?php } ?>
<?php echo $phs_keyvalues->key_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_keyvalues->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $phs_keyvalues_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_id" id="u_lang_id" class="ewMultiSelect" value="1"<?php echo ($phs_keyvalues->lang_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_keyvalues->lang_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_keyvalues_update->RightColumnClass ?>"><div<?php echo $phs_keyvalues->lang_id->CellAttributes() ?>>
<span id="el_phs_keyvalues_lang_id">
<select data-table="phs_keyvalues" data-field="x_lang_id" data-value-separator="<?php echo $phs_keyvalues->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $phs_keyvalues->lang_id->EditAttributes() ?>>
<?php echo $phs_keyvalues->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $phs_keyvalues->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_keyvalues->key_value->Visible) { // key_value ?>
	<div id="r_key_value" class="form-group">
		<label for="x_key_value" class="<?php echo $phs_keyvalues_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_key_value" id="u_key_value" class="ewMultiSelect" value="1"<?php echo ($phs_keyvalues->key_value->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_keyvalues->key_value->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_keyvalues_update->RightColumnClass ?>"><div<?php echo $phs_keyvalues->key_value->CellAttributes() ?>>
<span id="el_phs_keyvalues_key_value">
<input type="text" data-table="phs_keyvalues" data-field="x_key_value" name="x_key_value" id="x_key_value" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_value->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_value->EditValue ?>"<?php echo $phs_keyvalues->key_value->EditAttributes() ?>>
</span>
<?php echo $phs_keyvalues->key_value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_keyvalues->key_rvalue->Visible) { // key_rvalue ?>
	<div id="r_key_rvalue" class="form-group">
		<label for="x_key_rvalue" class="<?php echo $phs_keyvalues_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_key_rvalue" id="u_key_rvalue" class="ewMultiSelect" value="1"<?php echo ($phs_keyvalues->key_rvalue->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_keyvalues->key_rvalue->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_keyvalues_update->RightColumnClass ?>"><div<?php echo $phs_keyvalues->key_rvalue->CellAttributes() ?>>
<span id="el_phs_keyvalues_key_rvalue">
<input type="text" data-table="phs_keyvalues" data-field="x_key_rvalue" name="x_key_rvalue" id="x_key_rvalue" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_rvalue->getPlaceHolder()) ?>" value="<?php echo $phs_keyvalues->key_rvalue->EditValue ?>"<?php echo $phs_keyvalues->key_rvalue->EditAttributes() ?>>
</span>
<?php echo $phs_keyvalues->key_rvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_keyvalues->key_text->Visible) { // key_text ?>
	<div id="r_key_text" class="form-group">
		<label class="<?php echo $phs_keyvalues_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_key_text" id="u_key_text" class="ewMultiSelect" value="1"<?php echo ($phs_keyvalues->key_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_keyvalues->key_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_keyvalues_update->RightColumnClass ?>"><div<?php echo $phs_keyvalues->key_text->CellAttributes() ?>>
<span id="el_phs_keyvalues_key_text">
<?php ew_AppendClass($phs_keyvalues->key_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="phs_keyvalues" data-field="x_key_text" name="x_key_text" id="x_key_text" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($phs_keyvalues->key_text->getPlaceHolder()) ?>"<?php echo $phs_keyvalues->key_text->EditAttributes() ?>><?php echo $phs_keyvalues->key_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fphs_keyvaluesupdate", "x_key_text", 35, 4, <?php echo ($phs_keyvalues->key_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $phs_keyvalues->key_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$phs_keyvalues_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $phs_keyvalues_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $phs_keyvalues_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fphs_keyvaluesupdate.Init();
</script>
<?php
$phs_keyvalues_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$phs_keyvalues_update->Page_Terminate();
?>
