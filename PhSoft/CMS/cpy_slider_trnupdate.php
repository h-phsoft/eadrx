<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_slider_trninfo.php" ?>
<?php include_once "cpy_slider_mstinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_slider_trn_update = NULL; // Initialize page object first

class ccpy_slider_trn_update extends ccpy_slider_trn {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_slider_trn';

	// Page object name
	var $PageObjName = 'cpy_slider_trn_update';

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

		// Table object (cpy_slider_trn)
		if (!isset($GLOBALS["cpy_slider_trn"]) || get_class($GLOBALS["cpy_slider_trn"]) == "ccpy_slider_trn") {
			$GLOBALS["cpy_slider_trn"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_slider_trn"];
		}

		// Table object (cpy_slider_mst)
		if (!isset($GLOBALS['cpy_slider_mst'])) $GLOBALS['cpy_slider_mst'] = new ccpy_slider_mst();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_slider_trn', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_slider_trnlist.php"));
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
		$this->slid_id->SetVisibility();
		$this->slid_order->SetVisibility();
		$this->slid_header->SetVisibility();
		$this->slid_link->SetVisibility();
		$this->slid_label->SetVisibility();
		$this->slid_photo->SetVisibility();
		$this->slid_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_slider_trn;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_slider_trn);
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
					if ($pageName == "cpy_slider_trnview.php")
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
			$this->Page_Terminate("cpy_slider_trnlist.php"); // No records selected, return to list
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
					$this->slid_id->setDbValue($this->Recordset->fields('slid_id'));
					$this->slid_order->setDbValue($this->Recordset->fields('slid_order'));
					$this->slid_header->setDbValue($this->Recordset->fields('slid_header'));
					$this->slid_link->setDbValue($this->Recordset->fields('slid_link'));
					$this->slid_label->setDbValue($this->Recordset->fields('slid_label'));
					$this->slid_text->setDbValue($this->Recordset->fields('slid_text'));
				} else {
					if (!ew_CompareValue($this->slid_id->DbValue, $this->Recordset->fields('slid_id')))
						$this->slid_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->slid_order->DbValue, $this->Recordset->fields('slid_order')))
						$this->slid_order->CurrentValue = NULL;
					if (!ew_CompareValue($this->slid_header->DbValue, $this->Recordset->fields('slid_header')))
						$this->slid_header->CurrentValue = NULL;
					if (!ew_CompareValue($this->slid_link->DbValue, $this->Recordset->fields('slid_link')))
						$this->slid_link->CurrentValue = NULL;
					if (!ew_CompareValue($this->slid_label->DbValue, $this->Recordset->fields('slid_label')))
						$this->slid_label->CurrentValue = NULL;
					if (!ew_CompareValue($this->slid_text->DbValue, $this->Recordset->fields('slid_text')))
						$this->slid_text->CurrentValue = NULL;
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
		$this->tslid_id->CurrentValue = $sKeyFld;
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
		$this->slid_photo->Upload->Index = $objForm->Index;
		$this->slid_photo->Upload->UploadFile();
		$this->slid_photo->CurrentValue = $this->slid_photo->Upload->FileName;
		$this->slid_photo->MultiUpdate = $objForm->GetValue("u_slid_photo");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->slid_id->FldIsDetailKey) {
			$this->slid_id->setFormValue($objForm->GetValue("x_slid_id"));
		}
		$this->slid_id->MultiUpdate = $objForm->GetValue("u_slid_id");
		if (!$this->slid_order->FldIsDetailKey) {
			$this->slid_order->setFormValue($objForm->GetValue("x_slid_order"));
		}
		$this->slid_order->MultiUpdate = $objForm->GetValue("u_slid_order");
		if (!$this->slid_header->FldIsDetailKey) {
			$this->slid_header->setFormValue($objForm->GetValue("x_slid_header"));
		}
		$this->slid_header->MultiUpdate = $objForm->GetValue("u_slid_header");
		if (!$this->slid_link->FldIsDetailKey) {
			$this->slid_link->setFormValue($objForm->GetValue("x_slid_link"));
		}
		$this->slid_link->MultiUpdate = $objForm->GetValue("u_slid_link");
		if (!$this->slid_label->FldIsDetailKey) {
			$this->slid_label->setFormValue($objForm->GetValue("x_slid_label"));
		}
		$this->slid_label->MultiUpdate = $objForm->GetValue("u_slid_label");
		if (!$this->slid_text->FldIsDetailKey) {
			$this->slid_text->setFormValue($objForm->GetValue("x_slid_text"));
		}
		$this->slid_text->MultiUpdate = $objForm->GetValue("u_slid_text");
		if (!$this->tslid_id->FldIsDetailKey)
			$this->tslid_id->setFormValue($objForm->GetValue("x_tslid_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->tslid_id->CurrentValue = $this->tslid_id->FormValue;
		$this->slid_id->CurrentValue = $this->slid_id->FormValue;
		$this->slid_order->CurrentValue = $this->slid_order->FormValue;
		$this->slid_header->CurrentValue = $this->slid_header->FormValue;
		$this->slid_link->CurrentValue = $this->slid_link->FormValue;
		$this->slid_label->CurrentValue = $this->slid_label->FormValue;
		$this->slid_text->CurrentValue = $this->slid_text->FormValue;
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
		$this->tslid_id->setDbValue($row['tslid_id']);
		$this->slid_id->setDbValue($row['slid_id']);
		$this->slid_order->setDbValue($row['slid_order']);
		$this->slid_header->setDbValue($row['slid_header']);
		$this->slid_link->setDbValue($row['slid_link']);
		$this->slid_label->setDbValue($row['slid_label']);
		$this->slid_photo->Upload->DbValue = $row['slid_photo'];
		$this->slid_photo->setDbValue($this->slid_photo->Upload->DbValue);
		$this->slid_text->setDbValue($row['slid_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['tslid_id'] = NULL;
		$row['slid_id'] = NULL;
		$row['slid_order'] = NULL;
		$row['slid_header'] = NULL;
		$row['slid_link'] = NULL;
		$row['slid_label'] = NULL;
		$row['slid_photo'] = NULL;
		$row['slid_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->tslid_id->DbValue = $row['tslid_id'];
		$this->slid_id->DbValue = $row['slid_id'];
		$this->slid_order->DbValue = $row['slid_order'];
		$this->slid_header->DbValue = $row['slid_header'];
		$this->slid_link->DbValue = $row['slid_link'];
		$this->slid_label->DbValue = $row['slid_label'];
		$this->slid_photo->Upload->DbValue = $row['slid_photo'];
		$this->slid_text->DbValue = $row['slid_text'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// tslid_id
		// slid_id
		// slid_order
		// slid_header
		// slid_link
		// slid_label
		// slid_photo
		// slid_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

		// slid_order
		$this->slid_order->ViewValue = $this->slid_order->CurrentValue;
		$this->slid_order->ViewCustomAttributes = "";

		// slid_header
		$this->slid_header->ViewValue = $this->slid_header->CurrentValue;
		$this->slid_header->ViewCustomAttributes = "";

		// slid_link
		$this->slid_link->ViewValue = $this->slid_link->CurrentValue;
		$this->slid_link->ViewCustomAttributes = "";

		// slid_label
		$this->slid_label->ViewValue = $this->slid_label->CurrentValue;
		$this->slid_label->ViewCustomAttributes = "";

		// slid_photo
		$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
		if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
			$this->slid_photo->ImageWidth = 200;
			$this->slid_photo->ImageHeight = 0;
			$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
			$this->slid_photo->ViewValue = $this->slid_photo->Upload->DbValue;
		} else {
			$this->slid_photo->ViewValue = "";
		}
		$this->slid_photo->ViewCustomAttributes = "";

		// slid_text
		$this->slid_text->ViewValue = $this->slid_text->CurrentValue;
		$this->slid_text->ViewCustomAttributes = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// slid_order
			$this->slid_order->LinkCustomAttributes = "";
			$this->slid_order->HrefValue = "";
			$this->slid_order->TooltipValue = "";

			// slid_header
			$this->slid_header->LinkCustomAttributes = "";
			$this->slid_header->HrefValue = "";
			$this->slid_header->TooltipValue = "";

			// slid_link
			$this->slid_link->LinkCustomAttributes = "";
			$this->slid_link->HrefValue = "";
			$this->slid_link->TooltipValue = "";

			// slid_label
			$this->slid_label->LinkCustomAttributes = "";
			$this->slid_label->HrefValue = "";
			$this->slid_label->TooltipValue = "";

			// slid_photo
			$this->slid_photo->LinkCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
				$this->slid_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
			} else {
				$this->slid_photo->HrefValue = "";
			}
			$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;
			$this->slid_photo->TooltipValue = "";
			if ($this->slid_photo->UseColorbox) {
				if (ew_Empty($this->slid_photo->TooltipValue))
					$this->slid_photo->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->slid_photo->LinkAttrs["data-rel"] = "cpy_slider_trn_x_slid_photo";
				ew_AppendClass($this->slid_photo->LinkAttrs["class"], "ewLightbox");
			}

			// slid_text
			$this->slid_text->LinkCustomAttributes = "";
			$this->slid_text->HrefValue = "";
			$this->slid_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// slid_id
			$this->slid_id->EditAttrs["class"] = "form-control";
			$this->slid_id->EditCustomAttributes = "";
			if ($this->slid_id->getSessionValue() <> "") {
				$this->slid_id->CurrentValue = $this->slid_id->getSessionValue();
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
			} else {
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
			}

			// slid_order
			$this->slid_order->EditAttrs["class"] = "form-control";
			$this->slid_order->EditCustomAttributes = "";
			$this->slid_order->EditValue = ew_HtmlEncode($this->slid_order->CurrentValue);
			$this->slid_order->PlaceHolder = ew_RemoveHtml($this->slid_order->FldCaption());

			// slid_header
			$this->slid_header->EditAttrs["class"] = "form-control";
			$this->slid_header->EditCustomAttributes = "";
			$this->slid_header->EditValue = ew_HtmlEncode($this->slid_header->CurrentValue);
			$this->slid_header->PlaceHolder = ew_RemoveHtml($this->slid_header->FldCaption());

			// slid_link
			$this->slid_link->EditAttrs["class"] = "form-control";
			$this->slid_link->EditCustomAttributes = "";
			$this->slid_link->EditValue = ew_HtmlEncode($this->slid_link->CurrentValue);
			$this->slid_link->PlaceHolder = ew_RemoveHtml($this->slid_link->FldCaption());

			// slid_label
			$this->slid_label->EditAttrs["class"] = "form-control";
			$this->slid_label->EditCustomAttributes = "";
			$this->slid_label->EditValue = ew_HtmlEncode($this->slid_label->CurrentValue);
			$this->slid_label->PlaceHolder = ew_RemoveHtml($this->slid_label->FldCaption());

			// slid_photo
			$this->slid_photo->EditAttrs["class"] = "form-control";
			$this->slid_photo->EditCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->ImageWidth = 200;
				$this->slid_photo->ImageHeight = 0;
				$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
				$this->slid_photo->EditValue = $this->slid_photo->Upload->DbValue;
			} else {
				$this->slid_photo->EditValue = "";
			}
			if (!ew_Empty($this->slid_photo->CurrentValue))
					$this->slid_photo->Upload->FileName = $this->slid_photo->CurrentValue;

			// slid_text
			$this->slid_text->EditAttrs["class"] = "form-control";
			$this->slid_text->EditCustomAttributes = "";
			$this->slid_text->EditValue = ew_HtmlEncode($this->slid_text->CurrentValue);
			$this->slid_text->PlaceHolder = ew_RemoveHtml($this->slid_text->FldCaption());

			// Edit refer script
			// slid_id

			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";

			// slid_order
			$this->slid_order->LinkCustomAttributes = "";
			$this->slid_order->HrefValue = "";

			// slid_header
			$this->slid_header->LinkCustomAttributes = "";
			$this->slid_header->HrefValue = "";

			// slid_link
			$this->slid_link->LinkCustomAttributes = "";
			$this->slid_link->HrefValue = "";

			// slid_label
			$this->slid_label->LinkCustomAttributes = "";
			$this->slid_label->HrefValue = "";

			// slid_photo
			$this->slid_photo->LinkCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
				$this->slid_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
			} else {
				$this->slid_photo->HrefValue = "";
			}
			$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;

			// slid_text
			$this->slid_text->LinkCustomAttributes = "";
			$this->slid_text->HrefValue = "";
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
		if ($this->slid_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->slid_order->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->slid_header->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->slid_link->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->slid_label->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->slid_photo->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->slid_text->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->slid_id->MultiUpdate <> "" && !$this->slid_id->FldIsDetailKey && !is_null($this->slid_id->FormValue) && $this->slid_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_id->FldCaption(), $this->slid_id->ReqErrMsg));
		}
		if ($this->slid_order->MultiUpdate <> "" && !$this->slid_order->FldIsDetailKey && !is_null($this->slid_order->FormValue) && $this->slid_order->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_order->FldCaption(), $this->slid_order->ReqErrMsg));
		}
		if ($this->slid_order->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->slid_order->FormValue)) {
				ew_AddMessage($gsFormError, $this->slid_order->FldErrMsg());
			}
		}
		if ($this->slid_photo->MultiUpdate <> "" && $this->slid_photo->Upload->FileName == "" && !$this->slid_photo->Upload->KeepFile) {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slid_photo->FldCaption(), $this->slid_photo->ReqErrMsg));
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
			$this->slid_photo->OldUploadPath = '../../assets/pages/img/frontend-slider';
			$this->slid_photo->UploadPath = $this->slid_photo->OldUploadPath;
			$rsnew = array();

			// slid_id
			$this->slid_id->SetDbValueDef($rsnew, $this->slid_id->CurrentValue, 0, $this->slid_id->ReadOnly || $this->slid_id->MultiUpdate <> "1");

			// slid_order
			$this->slid_order->SetDbValueDef($rsnew, $this->slid_order->CurrentValue, 0, $this->slid_order->ReadOnly || $this->slid_order->MultiUpdate <> "1");

			// slid_header
			$this->slid_header->SetDbValueDef($rsnew, $this->slid_header->CurrentValue, NULL, $this->slid_header->ReadOnly || $this->slid_header->MultiUpdate <> "1");

			// slid_link
			$this->slid_link->SetDbValueDef($rsnew, $this->slid_link->CurrentValue, NULL, $this->slid_link->ReadOnly || $this->slid_link->MultiUpdate <> "1");

			// slid_label
			$this->slid_label->SetDbValueDef($rsnew, $this->slid_label->CurrentValue, NULL, $this->slid_label->ReadOnly || $this->slid_label->MultiUpdate <> "1");

			// slid_photo
			if ($this->slid_photo->Visible && !$this->slid_photo->ReadOnly && strval($this->slid_photo->MultiUpdate) == "1" && !$this->slid_photo->Upload->KeepFile) {
				$this->slid_photo->Upload->DbValue = $rsold['slid_photo']; // Get original value
				if ($this->slid_photo->Upload->FileName == "") {
					$rsnew['slid_photo'] = NULL;
				} else {
					$rsnew['slid_photo'] = $this->slid_photo->Upload->FileName;
				}
			}

			// slid_text
			$this->slid_text->SetDbValueDef($rsnew, $this->slid_text->CurrentValue, NULL, $this->slid_text->ReadOnly || $this->slid_text->MultiUpdate <> "1");
			if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
				$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
				$OldFiles = ew_Empty($this->slid_photo->Upload->DbValue) ? array() : array($this->slid_photo->Upload->DbValue);
				if (!ew_Empty($this->slid_photo->Upload->FileName) && $this->UpdateCount == 1) {
					$NewFiles = array($this->slid_photo->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->slid_photo->Upload->Index < 0) ? $this->slid_photo->FldVar : substr($this->slid_photo->FldVar, 0, 1) . $this->slid_photo->Upload->Index . substr($this->slid_photo->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->slid_photo->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file1) || file_exists($this->slid_photo->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->slid_photo->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file, ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->slid_photo->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->slid_photo->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->slid_photo->SetDbValueDef($rsnew, $this->slid_photo->Upload->FileName, "", $this->slid_photo->ReadOnly || $this->slid_photo->MultiUpdate <> "1");
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
					if ($this->slid_photo->Visible && !$this->slid_photo->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->slid_photo->Upload->DbValue) ? array() : array($this->slid_photo->Upload->DbValue);
						if (!ew_Empty($this->slid_photo->Upload->FileName) && $this->UpdateCount == 1) {
							$NewFiles = array($this->slid_photo->Upload->FileName);
							$NewFiles2 = array($rsnew['slid_photo']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->slid_photo->Upload->Index < 0) ? $this->slid_photo->FldVar : substr($this->slid_photo->FldVar, 0, 1) . $this->slid_photo->Upload->Index . substr($this->slid_photo->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->slid_photo->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->slid_photo->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// slid_photo
		ew_CleanUploadTempPath($this->slid_photo, $this->slid_photo->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_slider_trnlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($cpy_slider_trn_update)) $cpy_slider_trn_update = new ccpy_slider_trn_update();

// Page init
$cpy_slider_trn_update->Page_Init();

// Page main
$cpy_slider_trn_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_slider_trn_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fcpy_slider_trnupdate = new ew_Form("fcpy_slider_trnupdate", "update");

// Validate form
fcpy_slider_trnupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_slid_id");
			uelm = this.GetElements("u" + infix + "_slid_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_id->FldCaption(), $cpy_slider_trn->slid_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_slid_order");
			uelm = this.GetElements("u" + infix + "_slid_order");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_order->FldCaption(), $cpy_slider_trn->slid_order->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_slid_order");
			uelm = this.GetElements("u" + infix + "_slid_order");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_slider_trn->slid_order->FldErrMsg()) ?>");
			felm = this.GetElements("x" + infix + "_slid_photo");
			elm = this.GetElements("fn_x" + infix + "_slid_photo");
			uelm = this.GetElements("u" + infix + "_slid_photo");
			if (uelm && uelm.checked) {
				if (felm && elm && !ew_HasValue(elm))
					return this.OnError(felm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_slider_trn->slid_photo->FldCaption(), $cpy_slider_trn->slid_photo->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcpy_slider_trnupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_slider_trnupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_slider_trnupdate.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_slider_trnupdate.Lists["x_slid_id"].Data = "<?php echo $cpy_slider_trn_update->slid_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_slider_trn_update->ShowPageHeader(); ?>
<?php
$cpy_slider_trn_update->ShowMessage();
?>
<form name="fcpy_slider_trnupdate" id="fcpy_slider_trnupdate" class="<?php echo $cpy_slider_trn_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_slider_trn_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_slider_trn_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_slider_trn">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_slider_trn_update->IsModal) ?>">
<?php foreach ($cpy_slider_trn_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_cpy_slider_trnupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
	<div id="r_slid_id" class="form-group">
		<label for="x_slid_id" class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_id" id="u_slid_id" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_id->CellAttributes() ?>>
<?php if ($cpy_slider_trn->slid_id->getSessionValue() <> "") { ?>
<span id="el_cpy_slider_trn_slid_id">
<span<?php echo $cpy_slider_trn->slid_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cpy_slider_trn->slid_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_slid_id" name="x_slid_id" value="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x_slid_id" name="x_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x_slid_id") ?>
</select>
</span>
<?php } ?>
<?php echo $cpy_slider_trn->slid_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
	<div id="r_slid_order" class="form-group">
		<label for="x_slid_order" class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_order" id="u_slid_order" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_order->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_order->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_order->CellAttributes() ?>>
<span id="el_cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x_slid_order" id="x_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
<?php echo $cpy_slider_trn->slid_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
	<div id="r_slid_header" class="form-group">
		<label for="x_slid_header" class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_header" id="u_slid_header" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_header->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_header->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_header->CellAttributes() ?>>
<span id="el_cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x_slid_header" id="x_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
<?php echo $cpy_slider_trn->slid_header->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
	<div id="r_slid_link" class="form-group">
		<label for="x_slid_link" class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_link" id="u_slid_link" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_link->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_link->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_link->CellAttributes() ?>>
<span id="el_cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x_slid_link" id="x_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
<?php echo $cpy_slider_trn->slid_link->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
	<div id="r_slid_label" class="form-group">
		<label for="x_slid_label" class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_label" id="u_slid_label" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_label->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_label->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_label->CellAttributes() ?>>
<span id="el_cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x_slid_label" id="x_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
<?php echo $cpy_slider_trn->slid_label->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
	<div id="r_slid_photo" class="form-group">
		<label class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_photo" id="u_slid_photo" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_photo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_photo->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_photo->CellAttributes() ?>>
<span id="el_cpy_slider_trn_slid_photo">
<div id="fd_x_slid_photo">
<span title="<?php echo $cpy_slider_trn->slid_photo->FldTitle() ? $cpy_slider_trn->slid_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_slider_trn->slid_photo->ReadOnly || $cpy_slider_trn->slid_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_slider_trn" data-field="x_slid_photo" name="x_slid_photo" id="x_slid_photo"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_slid_photo" id= "fn_x_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->Upload->FileName ?>">
<?php if (@$_POST["fa_x_slid_photo"] == "0") { ?>
<input type="hidden" name="fa_x_slid_photo" id= "fa_x_slid_photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_slid_photo" id= "fa_x_slid_photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x_slid_photo" id= "fs_x_slid_photo" value="200">
<input type="hidden" name="fx_x_slid_photo" id= "fx_x_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_slid_photo" id= "fm_x_slid_photo" value="<?php echo $cpy_slider_trn->slid_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_slid_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $cpy_slider_trn->slid_photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
	<div id="r_slid_text" class="form-group">
		<label class="<?php echo $cpy_slider_trn_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_slid_text" id="u_slid_text" class="ewMultiSelect" value="1"<?php echo ($cpy_slider_trn->slid_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_slider_trn->slid_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_slider_trn_update->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_text->CellAttributes() ?>>
<span id="el_cpy_slider_trn_slid_text">
<?php ew_AppendClass($cpy_slider_trn->slid_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_slider_trn" data-field="x_slid_text" name="x_slid_text" id="x_slid_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>><?php echo $cpy_slider_trn->slid_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_slider_trnupdate", "x_slid_text", 35, 8, <?php echo ($cpy_slider_trn->slid_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $cpy_slider_trn->slid_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$cpy_slider_trn_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $cpy_slider_trn_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_slider_trn_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_slider_trnupdate.Init();
</script>
<?php
$cpy_slider_trn_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_slider_trn_update->Page_Terminate();
?>
