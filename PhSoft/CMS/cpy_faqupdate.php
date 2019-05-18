<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_faqinfo.php" ?>
<?php include_once "cpy_faq_categoryinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_faq_update = NULL; // Initialize page object first

class ccpy_faq_update extends ccpy_faq {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_faq';

	// Page object name
	var $PageObjName = 'cpy_faq_update';

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

		// Table object (cpy_faq)
		if (!isset($GLOBALS["cpy_faq"]) || get_class($GLOBALS["cpy_faq"]) == "ccpy_faq") {
			$GLOBALS["cpy_faq"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_faq"];
		}

		// Table object (cpy_faq_category)
		if (!isset($GLOBALS['cpy_faq_category'])) $GLOBALS['cpy_faq_category'] = new ccpy_faq_category();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_faq', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_faqlist.php"));
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
		$this->fcat_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->color_id->SetVisibility();
		$this->faq_order->SetVisibility();
		$this->faq_title->SetVisibility();
		$this->faq_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_faq;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_faq);
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
					if ($pageName == "cpy_faqview.php")
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
			$this->Page_Terminate("cpy_faqlist.php"); // No records selected, return to list
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
					$this->fcat_id->setDbValue($this->Recordset->fields('fcat_id'));
					$this->status_id->setDbValue($this->Recordset->fields('status_id'));
					$this->lang_id->setDbValue($this->Recordset->fields('lang_id'));
					$this->color_id->setDbValue($this->Recordset->fields('color_id'));
					$this->faq_order->setDbValue($this->Recordset->fields('faq_order'));
					$this->faq_title->setDbValue($this->Recordset->fields('faq_title'));
					$this->faq_text->setDbValue($this->Recordset->fields('faq_text'));
				} else {
					if (!ew_CompareValue($this->fcat_id->DbValue, $this->Recordset->fields('fcat_id')))
						$this->fcat_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->status_id->DbValue, $this->Recordset->fields('status_id')))
						$this->status_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->lang_id->DbValue, $this->Recordset->fields('lang_id')))
						$this->lang_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->color_id->DbValue, $this->Recordset->fields('color_id')))
						$this->color_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->faq_order->DbValue, $this->Recordset->fields('faq_order')))
						$this->faq_order->CurrentValue = NULL;
					if (!ew_CompareValue($this->faq_title->DbValue, $this->Recordset->fields('faq_title')))
						$this->faq_title->CurrentValue = NULL;
					if (!ew_CompareValue($this->faq_text->DbValue, $this->Recordset->fields('faq_text')))
						$this->faq_text->CurrentValue = NULL;
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
		$this->faq_id->CurrentValue = $sKeyFld;
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
		if (!$this->fcat_id->FldIsDetailKey) {
			$this->fcat_id->setFormValue($objForm->GetValue("x_fcat_id"));
		}
		$this->fcat_id->MultiUpdate = $objForm->GetValue("u_fcat_id");
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		$this->status_id->MultiUpdate = $objForm->GetValue("u_status_id");
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->MultiUpdate = $objForm->GetValue("u_lang_id");
		if (!$this->color_id->FldIsDetailKey) {
			$this->color_id->setFormValue($objForm->GetValue("x_color_id"));
		}
		$this->color_id->MultiUpdate = $objForm->GetValue("u_color_id");
		if (!$this->faq_order->FldIsDetailKey) {
			$this->faq_order->setFormValue($objForm->GetValue("x_faq_order"));
		}
		$this->faq_order->MultiUpdate = $objForm->GetValue("u_faq_order");
		if (!$this->faq_title->FldIsDetailKey) {
			$this->faq_title->setFormValue($objForm->GetValue("x_faq_title"));
		}
		$this->faq_title->MultiUpdate = $objForm->GetValue("u_faq_title");
		if (!$this->faq_text->FldIsDetailKey) {
			$this->faq_text->setFormValue($objForm->GetValue("x_faq_text"));
		}
		$this->faq_text->MultiUpdate = $objForm->GetValue("u_faq_text");
		if (!$this->faq_id->FldIsDetailKey)
			$this->faq_id->setFormValue($objForm->GetValue("x_faq_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->faq_id->CurrentValue = $this->faq_id->FormValue;
		$this->fcat_id->CurrentValue = $this->fcat_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->color_id->CurrentValue = $this->color_id->FormValue;
		$this->faq_order->CurrentValue = $this->faq_order->FormValue;
		$this->faq_title->CurrentValue = $this->faq_title->FormValue;
		$this->faq_text->CurrentValue = $this->faq_text->FormValue;
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
		$this->faq_id->setDbValue($row['faq_id']);
		$this->fcat_id->setDbValue($row['fcat_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->color_id->setDbValue($row['color_id']);
		$this->faq_order->setDbValue($row['faq_order']);
		$this->faq_title->setDbValue($row['faq_title']);
		$this->faq_text->setDbValue($row['faq_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['faq_id'] = NULL;
		$row['fcat_id'] = NULL;
		$row['status_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['color_id'] = NULL;
		$row['faq_order'] = NULL;
		$row['faq_title'] = NULL;
		$row['faq_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->faq_id->DbValue = $row['faq_id'];
		$this->fcat_id->DbValue = $row['fcat_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->color_id->DbValue = $row['color_id'];
		$this->faq_order->DbValue = $row['faq_order'];
		$this->faq_title->DbValue = $row['faq_title'];
		$this->faq_text->DbValue = $row['faq_text'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// faq_id
		// fcat_id
		// status_id
		// lang_id
		// color_id
		// faq_order
		// faq_title
		// faq_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// fcat_id
		if (strval($this->fcat_id->CurrentValue) <> "") {
			$sFilterWrk = "`fcat_id`" . ew_SearchString("=", $this->fcat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `fcat_id`, `fcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_faq_category`";
		$sWhereWrk = "";
		$this->fcat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->fcat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `fcat_order`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->fcat_id->ViewValue = $this->fcat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->fcat_id->ViewValue = $this->fcat_id->CurrentValue;
			}
		} else {
			$this->fcat_id->ViewValue = NULL;
		}
		$this->fcat_id->ViewCustomAttributes = "";

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

		// faq_order
		$this->faq_order->ViewValue = $this->faq_order->CurrentValue;
		$this->faq_order->ViewCustomAttributes = "";

		// faq_title
		$this->faq_title->ViewValue = $this->faq_title->CurrentValue;
		$this->faq_title->ViewCustomAttributes = "";

		// faq_text
		$this->faq_text->ViewValue = $this->faq_text->CurrentValue;
		$this->faq_text->ViewCustomAttributes = "";

			// fcat_id
			$this->fcat_id->LinkCustomAttributes = "";
			$this->fcat_id->HrefValue = "";
			$this->fcat_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// color_id
			$this->color_id->LinkCustomAttributes = "";
			$this->color_id->HrefValue = "";
			$this->color_id->TooltipValue = "";

			// faq_order
			$this->faq_order->LinkCustomAttributes = "";
			$this->faq_order->HrefValue = "";
			$this->faq_order->TooltipValue = "";

			// faq_title
			$this->faq_title->LinkCustomAttributes = "";
			$this->faq_title->HrefValue = "";
			$this->faq_title->TooltipValue = "";

			// faq_text
			$this->faq_text->LinkCustomAttributes = "";
			$this->faq_text->HrefValue = "";
			$this->faq_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// fcat_id
			$this->fcat_id->EditAttrs["class"] = "form-control";
			$this->fcat_id->EditCustomAttributes = "";
			if ($this->fcat_id->getSessionValue() <> "") {
				$this->fcat_id->CurrentValue = $this->fcat_id->getSessionValue();
			if (strval($this->fcat_id->CurrentValue) <> "") {
				$sFilterWrk = "`fcat_id`" . ew_SearchString("=", $this->fcat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `fcat_id`, `fcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_faq_category`";
			$sWhereWrk = "";
			$this->fcat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->fcat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `fcat_order`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->fcat_id->ViewValue = $this->fcat_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->fcat_id->ViewValue = $this->fcat_id->CurrentValue;
				}
			} else {
				$this->fcat_id->ViewValue = NULL;
			}
			$this->fcat_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->fcat_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`fcat_id`" . ew_SearchString("=", $this->fcat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `fcat_id`, `fcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_faq_category`";
			$sWhereWrk = "";
			$this->fcat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->fcat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `fcat_order`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->fcat_id->EditValue = $arwrk;
			}

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

			// faq_order
			$this->faq_order->EditAttrs["class"] = "form-control";
			$this->faq_order->EditCustomAttributes = "";
			$this->faq_order->EditValue = ew_HtmlEncode($this->faq_order->CurrentValue);
			$this->faq_order->PlaceHolder = ew_RemoveHtml($this->faq_order->FldCaption());

			// faq_title
			$this->faq_title->EditAttrs["class"] = "form-control";
			$this->faq_title->EditCustomAttributes = "";
			$this->faq_title->EditValue = ew_HtmlEncode($this->faq_title->CurrentValue);
			$this->faq_title->PlaceHolder = ew_RemoveHtml($this->faq_title->FldCaption());

			// faq_text
			$this->faq_text->EditAttrs["class"] = "form-control";
			$this->faq_text->EditCustomAttributes = "";
			$this->faq_text->EditValue = ew_HtmlEncode($this->faq_text->CurrentValue);
			$this->faq_text->PlaceHolder = ew_RemoveHtml($this->faq_text->FldCaption());

			// Edit refer script
			// fcat_id

			$this->fcat_id->LinkCustomAttributes = "";
			$this->fcat_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// color_id
			$this->color_id->LinkCustomAttributes = "";
			$this->color_id->HrefValue = "";

			// faq_order
			$this->faq_order->LinkCustomAttributes = "";
			$this->faq_order->HrefValue = "";

			// faq_title
			$this->faq_title->LinkCustomAttributes = "";
			$this->faq_title->HrefValue = "";

			// faq_text
			$this->faq_text->LinkCustomAttributes = "";
			$this->faq_text->HrefValue = "";
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
		if ($this->fcat_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->status_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->lang_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->color_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->faq_order->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->faq_title->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->faq_text->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->fcat_id->MultiUpdate <> "" && !$this->fcat_id->FldIsDetailKey && !is_null($this->fcat_id->FormValue) && $this->fcat_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->fcat_id->FldCaption(), $this->fcat_id->ReqErrMsg));
		}
		if ($this->status_id->MultiUpdate <> "" && !$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if ($this->lang_id->MultiUpdate <> "" && !$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if ($this->color_id->MultiUpdate <> "" && !$this->color_id->FldIsDetailKey && !is_null($this->color_id->FormValue) && $this->color_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->color_id->FldCaption(), $this->color_id->ReqErrMsg));
		}
		if ($this->faq_order->MultiUpdate <> "" && !$this->faq_order->FldIsDetailKey && !is_null($this->faq_order->FormValue) && $this->faq_order->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->faq_order->FldCaption(), $this->faq_order->ReqErrMsg));
		}
		if ($this->faq_order->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->faq_order->FormValue)) {
				ew_AddMessage($gsFormError, $this->faq_order->FldErrMsg());
			}
		}
		if ($this->faq_title->MultiUpdate <> "" && !$this->faq_title->FldIsDetailKey && !is_null($this->faq_title->FormValue) && $this->faq_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->faq_title->FldCaption(), $this->faq_title->ReqErrMsg));
		}
		if ($this->faq_text->MultiUpdate <> "" && !$this->faq_text->FldIsDetailKey && !is_null($this->faq_text->FormValue) && $this->faq_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->faq_text->FldCaption(), $this->faq_text->ReqErrMsg));
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

			// fcat_id
			$this->fcat_id->SetDbValueDef($rsnew, $this->fcat_id->CurrentValue, 0, $this->fcat_id->ReadOnly || $this->fcat_id->MultiUpdate <> "1");

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly || $this->status_id->MultiUpdate <> "1");

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly || $this->lang_id->MultiUpdate <> "1");

			// color_id
			$this->color_id->SetDbValueDef($rsnew, $this->color_id->CurrentValue, 0, $this->color_id->ReadOnly || $this->color_id->MultiUpdate <> "1");

			// faq_order
			$this->faq_order->SetDbValueDef($rsnew, $this->faq_order->CurrentValue, 0, $this->faq_order->ReadOnly || $this->faq_order->MultiUpdate <> "1");

			// faq_title
			$this->faq_title->SetDbValueDef($rsnew, $this->faq_title->CurrentValue, "", $this->faq_title->ReadOnly || $this->faq_title->MultiUpdate <> "1");

			// faq_text
			$this->faq_text->SetDbValueDef($rsnew, $this->faq_text->CurrentValue, "", $this->faq_text->ReadOnly || $this->faq_text->MultiUpdate <> "1");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_faqlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_fcat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `fcat_id` AS `LinkFld`, `fcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_faq_category`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`fcat_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->fcat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `fcat_order`";
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
if (!isset($cpy_faq_update)) $cpy_faq_update = new ccpy_faq_update();

// Page init
$cpy_faq_update->Page_Init();

// Page main
$cpy_faq_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_faq_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fcpy_faqupdate = new ew_Form("fcpy_faqupdate", "update");

// Validate form
fcpy_faqupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_fcat_id");
			uelm = this.GetElements("u" + infix + "_fcat_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->fcat_id->FldCaption(), $cpy_faq->fcat_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_status_id");
			uelm = this.GetElements("u" + infix + "_status_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->status_id->FldCaption(), $cpy_faq->status_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_lang_id");
			uelm = this.GetElements("u" + infix + "_lang_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->lang_id->FldCaption(), $cpy_faq->lang_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_color_id");
			uelm = this.GetElements("u" + infix + "_color_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->color_id->FldCaption(), $cpy_faq->color_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_faq_order");
			uelm = this.GetElements("u" + infix + "_faq_order");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->faq_order->FldCaption(), $cpy_faq->faq_order->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_faq_order");
			uelm = this.GetElements("u" + infix + "_faq_order");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_faq->faq_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_faq_title");
			uelm = this.GetElements("u" + infix + "_faq_title");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->faq_title->FldCaption(), $cpy_faq->faq_title->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_faq_text");
			uelm = this.GetElements("u" + infix + "_faq_text");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_faq->faq_text->FldCaption(), $cpy_faq->faq_text->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcpy_faqupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_faqupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_faqupdate.Lists["x_fcat_id"] = {"LinkField":"x_fcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_fcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_faq_category"};
fcpy_faqupdate.Lists["x_fcat_id"].Data = "<?php echo $cpy_faq_update->fcat_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_faqupdate.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_faqupdate.Lists["x_status_id"].Data = "<?php echo $cpy_faq_update->status_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_faqupdate.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_faqupdate.Lists["x_lang_id"].Data = "<?php echo $cpy_faq_update->lang_id->LookupFilterQuery(FALSE, "update") ?>";
fcpy_faqupdate.Lists["x_color_id"] = {"LinkField":"x_color_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_color_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_color"};
fcpy_faqupdate.Lists["x_color_id"].Data = "<?php echo $cpy_faq_update->color_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_faq_update->ShowPageHeader(); ?>
<?php
$cpy_faq_update->ShowMessage();
?>
<form name="fcpy_faqupdate" id="fcpy_faqupdate" class="<?php echo $cpy_faq_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_faq_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_faq_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_faq">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_faq_update->IsModal) ?>">
<?php foreach ($cpy_faq_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_cpy_faqupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($cpy_faq->fcat_id->Visible) { // fcat_id ?>
	<div id="r_fcat_id" class="form-group">
		<label for="x_fcat_id" class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_fcat_id" id="u_fcat_id" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->fcat_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->fcat_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->fcat_id->CellAttributes() ?>>
<?php if ($cpy_faq->fcat_id->getSessionValue() <> "") { ?>
<span id="el_cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_faq->fcat_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_fcat_id" name="x_fcat_id" value="<?php echo ew_HtmlEncode($cpy_faq->fcat_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cpy_faq_fcat_id">
<select data-table="cpy_faq" data-field="x_fcat_id" data-value-separator="<?php echo $cpy_faq->fcat_id->DisplayValueSeparatorAttribute() ?>" id="x_fcat_id" name="x_fcat_id"<?php echo $cpy_faq->fcat_id->EditAttributes() ?>>
<?php echo $cpy_faq->fcat_id->SelectOptionListHtml("x_fcat_id") ?>
</select>
</span>
<?php } ?>
<?php echo $cpy_faq->fcat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_faq->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_status_id" id="u_status_id" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->status_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->status_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->status_id->CellAttributes() ?>>
<span id="el_cpy_faq_status_id">
<select data-table="cpy_faq" data-field="x_status_id" data-value-separator="<?php echo $cpy_faq->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_faq->status_id->EditAttributes() ?>>
<?php echo $cpy_faq->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $cpy_faq->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_faq->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_id" id="u_lang_id" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->lang_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->lang_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->lang_id->CellAttributes() ?>>
<span id="el_cpy_faq_lang_id">
<select data-table="cpy_faq" data-field="x_lang_id" data-value-separator="<?php echo $cpy_faq->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $cpy_faq->lang_id->EditAttributes() ?>>
<?php echo $cpy_faq->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $cpy_faq->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_faq->color_id->Visible) { // color_id ?>
	<div id="r_color_id" class="form-group">
		<label for="x_color_id" class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_color_id" id="u_color_id" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->color_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->color_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->color_id->CellAttributes() ?>>
<span id="el_cpy_faq_color_id">
<select data-table="cpy_faq" data-field="x_color_id" data-value-separator="<?php echo $cpy_faq->color_id->DisplayValueSeparatorAttribute() ?>" id="x_color_id" name="x_color_id"<?php echo $cpy_faq->color_id->EditAttributes() ?>>
<?php echo $cpy_faq->color_id->SelectOptionListHtml("x_color_id") ?>
</select>
</span>
<?php echo $cpy_faq->color_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_faq->faq_order->Visible) { // faq_order ?>
	<div id="r_faq_order" class="form-group">
		<label for="x_faq_order" class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_faq_order" id="u_faq_order" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->faq_order->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->faq_order->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->faq_order->CellAttributes() ?>>
<span id="el_cpy_faq_faq_order">
<input type="text" data-table="cpy_faq" data-field="x_faq_order" name="x_faq_order" id="x_faq_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_order->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_order->EditValue ?>"<?php echo $cpy_faq->faq_order->EditAttributes() ?>>
</span>
<?php echo $cpy_faq->faq_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_faq->faq_title->Visible) { // faq_title ?>
	<div id="r_faq_title" class="form-group">
		<label for="x_faq_title" class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_faq_title" id="u_faq_title" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->faq_title->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->faq_title->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->faq_title->CellAttributes() ?>>
<span id="el_cpy_faq_faq_title">
<input type="text" data-table="cpy_faq" data-field="x_faq_title" name="x_faq_title" id="x_faq_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_title->getPlaceHolder()) ?>" value="<?php echo $cpy_faq->faq_title->EditValue ?>"<?php echo $cpy_faq->faq_title->EditAttributes() ?>>
</span>
<?php echo $cpy_faq->faq_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_faq->faq_text->Visible) { // faq_text ?>
	<div id="r_faq_text" class="form-group">
		<label class="<?php echo $cpy_faq_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_faq_text" id="u_faq_text" class="ewMultiSelect" value="1"<?php echo ($cpy_faq->faq_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_faq->faq_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_faq_update->RightColumnClass ?>"><div<?php echo $cpy_faq->faq_text->CellAttributes() ?>>
<span id="el_cpy_faq_faq_text">
<?php ew_AppendClass($cpy_faq->faq_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_faq" data-field="x_faq_text" name="x_faq_text" id="x_faq_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_faq->faq_text->getPlaceHolder()) ?>"<?php echo $cpy_faq->faq_text->EditAttributes() ?>><?php echo $cpy_faq->faq_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_faqupdate", "x_faq_text", 35, 8, <?php echo ($cpy_faq->faq_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $cpy_faq->faq_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$cpy_faq_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $cpy_faq_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_faq_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_faqupdate.Init();
</script>
<?php
$cpy_faq_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_faq_update->Page_Terminate();
?>
