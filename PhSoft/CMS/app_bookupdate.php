<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_bookinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_book_pagegridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_book_update = NULL; // Initialize page object first

class capp_book_update extends capp_book {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_book';

	// Page object name
	var $PageObjName = 'app_book_update';

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

		// Table object (app_book)
		if (!isset($GLOBALS["app_book"]) || get_class($GLOBALS["app_book"]) == "capp_book") {
			$GLOBALS["app_book"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_book"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_book', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_booklist.php"));
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
		$this->lang_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->book_title->SetVisibility();
		$this->book_price->SetVisibility();
		$this->book_image->SetVisibility();
		$this->book_desc->SetVisibility();
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
				if (in_array("app_book_page", $DetailTblVar)) {

					// Process auto fill for detail table 'app_book_page'
					if (preg_match('/^fapp_book_page(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_book_page_grid"])) $GLOBALS["app_book_page_grid"] = new capp_book_page_grid;
						$GLOBALS["app_book_page_grid"]->Page_Init();
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
		global $EW_EXPORT, $app_book;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_book);
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
					if ($pageName == "app_bookview.php")
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
			$this->Page_Terminate("app_booklist.php"); // No records selected, return to list
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
					$this->lang_id->setDbValue($this->Recordset->fields('lang_id'));
					$this->status_id->setDbValue($this->Recordset->fields('status_id'));
					$this->book_title->setDbValue($this->Recordset->fields('book_title'));
					$this->book_price->setDbValue($this->Recordset->fields('book_price'));
					$this->book_desc->setDbValue($this->Recordset->fields('book_desc'));
					$this->ins_datetime->setDbValue($this->Recordset->fields('ins_datetime'));
				} else {
					if (!ew_CompareValue($this->lang_id->DbValue, $this->Recordset->fields('lang_id')))
						$this->lang_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->status_id->DbValue, $this->Recordset->fields('status_id')))
						$this->status_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->book_title->DbValue, $this->Recordset->fields('book_title')))
						$this->book_title->CurrentValue = NULL;
					if (!ew_CompareValue($this->book_price->DbValue, $this->Recordset->fields('book_price')))
						$this->book_price->CurrentValue = NULL;
					if (!ew_CompareValue($this->book_desc->DbValue, $this->Recordset->fields('book_desc')))
						$this->book_desc->CurrentValue = NULL;
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
		$this->book_id->CurrentValue = $sKeyFld;
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
		$this->book_image->Upload->Index = $objForm->Index;
		$this->book_image->Upload->UploadFile();
		$this->book_image->CurrentValue = $this->book_image->Upload->FileName;
		$this->book_image->MultiUpdate = $objForm->GetValue("u_book_image");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->lang_id->FldIsDetailKey) {
			$this->lang_id->setFormValue($objForm->GetValue("x_lang_id"));
		}
		$this->lang_id->MultiUpdate = $objForm->GetValue("u_lang_id");
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		$this->status_id->MultiUpdate = $objForm->GetValue("u_status_id");
		if (!$this->book_title->FldIsDetailKey) {
			$this->book_title->setFormValue($objForm->GetValue("x_book_title"));
		}
		$this->book_title->MultiUpdate = $objForm->GetValue("u_book_title");
		if (!$this->book_price->FldIsDetailKey) {
			$this->book_price->setFormValue($objForm->GetValue("x_book_price"));
		}
		$this->book_price->MultiUpdate = $objForm->GetValue("u_book_price");
		if (!$this->book_desc->FldIsDetailKey) {
			$this->book_desc->setFormValue($objForm->GetValue("x_book_desc"));
		}
		$this->book_desc->MultiUpdate = $objForm->GetValue("u_book_desc");
		if (!$this->ins_datetime->FldIsDetailKey) {
			$this->ins_datetime->setFormValue($objForm->GetValue("x_ins_datetime"));
			$this->ins_datetime->CurrentValue = ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11);
		}
		$this->ins_datetime->MultiUpdate = $objForm->GetValue("u_ins_datetime");
		if (!$this->book_id->FldIsDetailKey)
			$this->book_id->setFormValue($objForm->GetValue("x_book_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->book_id->CurrentValue = $this->book_id->FormValue;
		$this->lang_id->CurrentValue = $this->lang_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->book_title->CurrentValue = $this->book_title->FormValue;
		$this->book_price->CurrentValue = $this->book_price->FormValue;
		$this->book_desc->CurrentValue = $this->book_desc->FormValue;
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
		$this->book_id->setDbValue($row['book_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->book_title->setDbValue($row['book_title']);
		$this->book_price->setDbValue($row['book_price']);
		$this->book_image->Upload->DbValue = $row['book_image'];
		$this->book_image->setDbValue($this->book_image->Upload->DbValue);
		$this->book_desc->setDbValue($row['book_desc']);
		$this->ins_datetime->setDbValue($row['ins_datetime']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['book_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['status_id'] = NULL;
		$row['book_title'] = NULL;
		$row['book_price'] = NULL;
		$row['book_image'] = NULL;
		$row['book_desc'] = NULL;
		$row['ins_datetime'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->book_id->DbValue = $row['book_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->book_title->DbValue = $row['book_title'];
		$this->book_price->DbValue = $row['book_price'];
		$this->book_image->Upload->DbValue = $row['book_image'];
		$this->book_desc->DbValue = $row['book_desc'];
		$this->ins_datetime->DbValue = $row['ins_datetime'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->book_price->FormValue == $this->book_price->CurrentValue && is_numeric(ew_StrToFloat($this->book_price->CurrentValue)))
			$this->book_price->CurrentValue = ew_StrToFloat($this->book_price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// book_id
		// lang_id
		// status_id
		// book_title
		// book_price
		// book_image
		// book_desc
		// ins_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

		// book_title
		$this->book_title->ViewValue = $this->book_title->CurrentValue;
		$this->book_title->ViewCustomAttributes = "";

		// book_price
		$this->book_price->ViewValue = $this->book_price->CurrentValue;
		$this->book_price->ViewValue = ew_FormatCurrency($this->book_price->ViewValue, 2, -2, -2, -1);
		$this->book_price->ViewCustomAttributes = "";

		// book_image
		$this->book_image->UploadPath = '../../assets/img/bookImages';
		if (!ew_Empty($this->book_image->Upload->DbValue)) {
			$this->book_image->ImageWidth = 200;
			$this->book_image->ImageHeight = 0;
			$this->book_image->ImageAlt = $this->book_image->FldAlt();
			$this->book_image->ViewValue = $this->book_image->Upload->DbValue;
		} else {
			$this->book_image->ViewValue = "";
		}
		$this->book_image->ViewCustomAttributes = "";

		// book_desc
		$this->book_desc->ViewValue = $this->book_desc->CurrentValue;
		$this->book_desc->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// book_title
			$this->book_title->LinkCustomAttributes = "";
			$this->book_title->HrefValue = "";
			$this->book_title->TooltipValue = "";

			// book_price
			$this->book_price->LinkCustomAttributes = "";
			$this->book_price->HrefValue = "";
			$this->book_price->TooltipValue = "";

			// book_image
			$this->book_image->LinkCustomAttributes = "";
			$this->book_image->UploadPath = '../../assets/img/bookImages';
			if (!ew_Empty($this->book_image->Upload->DbValue)) {
				$this->book_image->HrefValue = ew_GetFileUploadUrl($this->book_image, $this->book_image->Upload->DbValue); // Add prefix/suffix
				$this->book_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->book_image->HrefValue = ew_FullUrl($this->book_image->HrefValue, "href");
			} else {
				$this->book_image->HrefValue = "";
			}
			$this->book_image->HrefValue2 = $this->book_image->UploadPath . $this->book_image->Upload->DbValue;
			$this->book_image->TooltipValue = "";
			if ($this->book_image->UseColorbox) {
				if (ew_Empty($this->book_image->TooltipValue))
					$this->book_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->book_image->LinkAttrs["data-rel"] = "app_book_x_book_image";
				ew_AppendClass($this->book_image->LinkAttrs["class"], "ewLightbox");
			}

			// book_desc
			$this->book_desc->LinkCustomAttributes = "";
			$this->book_desc->HrefValue = "";
			$this->book_desc->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// book_title
			$this->book_title->EditAttrs["class"] = "form-control";
			$this->book_title->EditCustomAttributes = "";
			$this->book_title->EditValue = ew_HtmlEncode($this->book_title->CurrentValue);
			$this->book_title->PlaceHolder = ew_RemoveHtml($this->book_title->FldCaption());

			// book_price
			$this->book_price->EditAttrs["class"] = "form-control";
			$this->book_price->EditCustomAttributes = "";
			$this->book_price->EditValue = ew_HtmlEncode($this->book_price->CurrentValue);
			$this->book_price->PlaceHolder = ew_RemoveHtml($this->book_price->FldCaption());
			if (strval($this->book_price->EditValue) <> "" && is_numeric($this->book_price->EditValue)) $this->book_price->EditValue = ew_FormatNumber($this->book_price->EditValue, -2, -2, -2, -1);

			// book_image
			$this->book_image->EditAttrs["class"] = "form-control";
			$this->book_image->EditCustomAttributes = "";
			$this->book_image->UploadPath = '../../assets/img/bookImages';
			if (!ew_Empty($this->book_image->Upload->DbValue)) {
				$this->book_image->ImageWidth = 200;
				$this->book_image->ImageHeight = 0;
				$this->book_image->ImageAlt = $this->book_image->FldAlt();
				$this->book_image->EditValue = $this->book_image->Upload->DbValue;
			} else {
				$this->book_image->EditValue = "";
			}
			if (!ew_Empty($this->book_image->CurrentValue))
					$this->book_image->Upload->FileName = $this->book_image->CurrentValue;

			// book_desc
			$this->book_desc->EditAttrs["class"] = "form-control";
			$this->book_desc->EditCustomAttributes = "";
			$this->book_desc->EditValue = ew_HtmlEncode($this->book_desc->CurrentValue);
			$this->book_desc->PlaceHolder = ew_RemoveHtml($this->book_desc->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ins_datetime->CurrentValue, 11));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

			// Edit refer script
			// lang_id

			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// book_title
			$this->book_title->LinkCustomAttributes = "";
			$this->book_title->HrefValue = "";

			// book_price
			$this->book_price->LinkCustomAttributes = "";
			$this->book_price->HrefValue = "";

			// book_image
			$this->book_image->LinkCustomAttributes = "";
			$this->book_image->UploadPath = '../../assets/img/bookImages';
			if (!ew_Empty($this->book_image->Upload->DbValue)) {
				$this->book_image->HrefValue = ew_GetFileUploadUrl($this->book_image, $this->book_image->Upload->DbValue); // Add prefix/suffix
				$this->book_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->book_image->HrefValue = ew_FullUrl($this->book_image->HrefValue, "href");
			} else {
				$this->book_image->HrefValue = "";
			}
			$this->book_image->HrefValue2 = $this->book_image->UploadPath . $this->book_image->Upload->DbValue;

			// book_desc
			$this->book_desc->LinkCustomAttributes = "";
			$this->book_desc->HrefValue = "";

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
		if ($this->lang_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->status_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->book_title->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->book_price->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->book_image->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->book_desc->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->ins_datetime->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->lang_id->MultiUpdate <> "" && !$this->lang_id->FldIsDetailKey && !is_null($this->lang_id->FormValue) && $this->lang_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lang_id->FldCaption(), $this->lang_id->ReqErrMsg));
		}
		if ($this->status_id->MultiUpdate <> "" && !$this->status_id->FldIsDetailKey && !is_null($this->status_id->FormValue) && $this->status_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->status_id->FldCaption(), $this->status_id->ReqErrMsg));
		}
		if ($this->book_title->MultiUpdate <> "" && !$this->book_title->FldIsDetailKey && !is_null($this->book_title->FormValue) && $this->book_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->book_title->FldCaption(), $this->book_title->ReqErrMsg));
		}
		if ($this->book_price->MultiUpdate <> "" && !$this->book_price->FldIsDetailKey && !is_null($this->book_price->FormValue) && $this->book_price->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->book_price->FldCaption(), $this->book_price->ReqErrMsg));
		}
		if ($this->book_price->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->book_price->FormValue)) {
				ew_AddMessage($gsFormError, $this->book_price->FldErrMsg());
			}
		}
		if ($this->book_image->MultiUpdate <> "" && $this->book_image->Upload->FileName == "" && !$this->book_image->Upload->KeepFile) {
			ew_AddMessage($gsFormError, str_replace("%s", $this->book_image->FldCaption(), $this->book_image->ReqErrMsg));
		}
		if ($this->book_desc->MultiUpdate <> "" && !$this->book_desc->FldIsDetailKey && !is_null($this->book_desc->FormValue) && $this->book_desc->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->book_desc->FldCaption(), $this->book_desc->ReqErrMsg));
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
			$this->book_image->OldUploadPath = '../../assets/img/bookImages';
			$this->book_image->UploadPath = $this->book_image->OldUploadPath;
			$rsnew = array();

			// lang_id
			$this->lang_id->SetDbValueDef($rsnew, $this->lang_id->CurrentValue, 0, $this->lang_id->ReadOnly || $this->lang_id->MultiUpdate <> "1");

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly || $this->status_id->MultiUpdate <> "1");

			// book_title
			$this->book_title->SetDbValueDef($rsnew, $this->book_title->CurrentValue, "", $this->book_title->ReadOnly || $this->book_title->MultiUpdate <> "1");

			// book_price
			$this->book_price->SetDbValueDef($rsnew, $this->book_price->CurrentValue, 0, $this->book_price->ReadOnly || $this->book_price->MultiUpdate <> "1");

			// book_image
			if ($this->book_image->Visible && !$this->book_image->ReadOnly && strval($this->book_image->MultiUpdate) == "1" && !$this->book_image->Upload->KeepFile) {
				$this->book_image->Upload->DbValue = $rsold['book_image']; // Get original value
				if ($this->book_image->Upload->FileName == "") {
					$rsnew['book_image'] = NULL;
				} else {
					$rsnew['book_image'] = $this->book_image->Upload->FileName;
				}
			}

			// book_desc
			$this->book_desc->SetDbValueDef($rsnew, $this->book_desc->CurrentValue, "", $this->book_desc->ReadOnly || $this->book_desc->MultiUpdate <> "1");

			// ins_datetime
			$this->ins_datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ins_datetime->CurrentValue, 11), NULL, $this->ins_datetime->ReadOnly || $this->ins_datetime->MultiUpdate <> "1");
			if ($this->book_image->Visible && !$this->book_image->Upload->KeepFile) {
				$this->book_image->UploadPath = '../../assets/img/bookImages';
				$OldFiles = ew_Empty($this->book_image->Upload->DbValue) ? array() : array($this->book_image->Upload->DbValue);
				if (!ew_Empty($this->book_image->Upload->FileName) && $this->UpdateCount == 1) {
					$NewFiles = array($this->book_image->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->book_image->Upload->Index < 0) ? $this->book_image->FldVar : substr($this->book_image->FldVar, 0, 1) . $this->book_image->Upload->Index . substr($this->book_image->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->book_image->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->book_image->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->book_image->TblVar) . $file1) || file_exists($this->book_image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->book_image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->book_image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->book_image->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->book_image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->book_image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->book_image->SetDbValueDef($rsnew, $this->book_image->Upload->FileName, "", $this->book_image->ReadOnly || $this->book_image->MultiUpdate <> "1");
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
					if ($this->book_image->Visible && !$this->book_image->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->book_image->Upload->DbValue) ? array() : array($this->book_image->Upload->DbValue);
						if (!ew_Empty($this->book_image->Upload->FileName) && $this->UpdateCount == 1) {
							$NewFiles = array($this->book_image->Upload->FileName);
							$NewFiles2 = array($rsnew['book_image']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->book_image->Upload->Index < 0) ? $this->book_image->FldVar : substr($this->book_image->FldVar, 0, 1) . $this->book_image->Upload->Index . substr($this->book_image->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->book_image->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->book_image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// book_image
		ew_CleanUploadTempPath($this->book_image, $this->book_image->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_booklist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($app_book_update)) $app_book_update = new capp_book_update();

// Page init
$app_book_update->Page_Init();

// Page main
$app_book_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_book_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fapp_bookupdate = new ew_Form("fapp_bookupdate", "update");

// Validate form
fapp_bookupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_lang_id");
			uelm = this.GetElements("u" + infix + "_lang_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book->lang_id->FldCaption(), $app_book->lang_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_status_id");
			uelm = this.GetElements("u" + infix + "_status_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book->status_id->FldCaption(), $app_book->status_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_book_title");
			uelm = this.GetElements("u" + infix + "_book_title");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book->book_title->FldCaption(), $app_book->book_title->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_book_price");
			uelm = this.GetElements("u" + infix + "_book_price");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book->book_price->FldCaption(), $app_book->book_price->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_book_price");
			uelm = this.GetElements("u" + infix + "_book_price");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_book->book_price->FldErrMsg()) ?>");
			felm = this.GetElements("x" + infix + "_book_image");
			elm = this.GetElements("fn_x" + infix + "_book_image");
			uelm = this.GetElements("u" + infix + "_book_image");
			if (uelm && uelm.checked) {
				if (felm && elm && !ew_HasValue(elm))
					return this.OnError(felm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book->book_image->FldCaption(), $app_book->book_image->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_book_desc");
			uelm = this.GetElements("u" + infix + "_book_desc");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book->book_desc->FldCaption(), $app_book->book_desc->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_ins_datetime");
			uelm = this.GetElements("u" + infix + "_ins_datetime");
			if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_book->ins_datetime->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_bookupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_bookupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_bookupdate.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_bookupdate.Lists["x_lang_id"].Data = "<?php echo $app_book_update->lang_id->LookupFilterQuery(FALSE, "update") ?>";
fapp_bookupdate.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_bookupdate.Lists["x_status_id"].Data = "<?php echo $app_book_update->status_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_book_update->ShowPageHeader(); ?>
<?php
$app_book_update->ShowMessage();
?>
<form name="fapp_bookupdate" id="fapp_bookupdate" class="<?php echo $app_book_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_book_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_book_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_book">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_book_update->IsModal) ?>">
<?php foreach ($app_book_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_app_bookupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($app_book->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_lang_id" id="u_lang_id" class="ewMultiSelect" value="1"<?php echo ($app_book->lang_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->lang_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->lang_id->CellAttributes() ?>>
<span id="el_app_book_lang_id">
<select data-table="app_book" data-field="x_lang_id" data-value-separator="<?php echo $app_book->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $app_book->lang_id->EditAttributes() ?>>
<?php echo $app_book->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
<?php echo $app_book->lang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_status_id" id="u_status_id" class="ewMultiSelect" value="1"<?php echo ($app_book->status_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->status_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->status_id->CellAttributes() ?>>
<span id="el_app_book_status_id">
<select data-table="app_book" data-field="x_status_id" data-value-separator="<?php echo $app_book->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $app_book->status_id->EditAttributes() ?>>
<?php echo $app_book->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $app_book->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book->book_title->Visible) { // book_title ?>
	<div id="r_book_title" class="form-group">
		<label for="x_book_title" class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_book_title" id="u_book_title" class="ewMultiSelect" value="1"<?php echo ($app_book->book_title->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->book_title->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->book_title->CellAttributes() ?>>
<span id="el_app_book_book_title">
<input type="text" data-table="app_book" data-field="x_book_title" name="x_book_title" id="x_book_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_book->book_title->getPlaceHolder()) ?>" value="<?php echo $app_book->book_title->EditValue ?>"<?php echo $app_book->book_title->EditAttributes() ?>>
</span>
<?php echo $app_book->book_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book->book_price->Visible) { // book_price ?>
	<div id="r_book_price" class="form-group">
		<label for="x_book_price" class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_book_price" id="u_book_price" class="ewMultiSelect" value="1"<?php echo ($app_book->book_price->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->book_price->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->book_price->CellAttributes() ?>>
<span id="el_app_book_book_price">
<input type="text" data-table="app_book" data-field="x_book_price" name="x_book_price" id="x_book_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_book->book_price->getPlaceHolder()) ?>" value="<?php echo $app_book->book_price->EditValue ?>"<?php echo $app_book->book_price->EditAttributes() ?>>
</span>
<?php echo $app_book->book_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book->book_image->Visible) { // book_image ?>
	<div id="r_book_image" class="form-group">
		<label class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_book_image" id="u_book_image" class="ewMultiSelect" value="1"<?php echo ($app_book->book_image->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->book_image->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->book_image->CellAttributes() ?>>
<span id="el_app_book_book_image">
<div id="fd_x_book_image">
<span title="<?php echo $app_book->book_image->FldTitle() ? $app_book->book_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_book->book_image->ReadOnly || $app_book->book_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_book" data-field="x_book_image" name="x_book_image" id="x_book_image"<?php echo $app_book->book_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_book_image" id= "fn_x_book_image" value="<?php echo $app_book->book_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_book_image"] == "0") { ?>
<input type="hidden" name="fa_x_book_image" id= "fa_x_book_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_book_image" id= "fa_x_book_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_book_image" id= "fs_x_book_image" value="150">
<input type="hidden" name="fx_x_book_image" id= "fx_x_book_image" value="<?php echo $app_book->book_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_book_image" id= "fm_x_book_image" value="<?php echo $app_book->book_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_book_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $app_book->book_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book->book_desc->Visible) { // book_desc ?>
	<div id="r_book_desc" class="form-group">
		<label class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_book_desc" id="u_book_desc" class="ewMultiSelect" value="1"<?php echo ($app_book->book_desc->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->book_desc->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->book_desc->CellAttributes() ?>>
<span id="el_app_book_book_desc">
<?php ew_AppendClass($app_book->book_desc->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_book" data-field="x_book_desc" name="x_book_desc" id="x_book_desc" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_book->book_desc->getPlaceHolder()) ?>"<?php echo $app_book->book_desc->EditAttributes() ?>><?php echo $app_book->book_desc->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_bookupdate", "x_book_desc", 35, 8, <?php echo ($app_book->book_desc->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $app_book->book_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $app_book_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_ins_datetime" id="u_ins_datetime" class="ewMultiSelect" value="1"<?php echo ($app_book->ins_datetime->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book->ins_datetime->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_update->RightColumnClass ?>"><div<?php echo $app_book->ins_datetime->CellAttributes() ?>>
<span id="el_app_book_ins_datetime">
<input type="text" data-table="app_book" data-field="x_ins_datetime" data-format="11" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_book->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_book->ins_datetime->EditValue ?>"<?php echo $app_book->ins_datetime->EditAttributes() ?>>
</span>
<?php echo $app_book->ins_datetime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$app_book_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $app_book_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_book_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_bookupdate.Init();
</script>
<?php
$app_book_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_book_update->Page_Terminate();
?>
