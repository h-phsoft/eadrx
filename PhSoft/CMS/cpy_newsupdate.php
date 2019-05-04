<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_newsinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "cpy_news_imagesgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_news_update = NULL; // Initialize page object first

class ccpy_news_update extends ccpy_news {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_news';

	// Page object name
	var $PageObjName = 'cpy_news_update';

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

		// Table object (cpy_news)
		if (!isset($GLOBALS["cpy_news"]) || get_class($GLOBALS["cpy_news"]) == "ccpy_news") {
			$GLOBALS["cpy_news"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_news"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_news', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_newslist.php"));
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
		$this->news_date->SetVisibility();
		$this->news_title->SetVisibility();
		$this->news_image->SetVisibility();
		$this->news_stext->SetVisibility();
		$this->news_text->SetVisibility();

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
				if (in_array("cpy_news_images", $DetailTblVar)) {

					// Process auto fill for detail table 'cpy_news_images'
					if (preg_match('/^fcpy_news_images(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["cpy_news_images_grid"])) $GLOBALS["cpy_news_images_grid"] = new ccpy_news_images_grid;
						$GLOBALS["cpy_news_images_grid"]->Page_Init();
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
		global $EW_EXPORT, $cpy_news;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_news);
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
					if ($pageName == "cpy_newsview.php")
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
			$this->Page_Terminate("cpy_newslist.php"); // No records selected, return to list
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
					$this->news_date->setDbValue($this->Recordset->fields('news_date'));
					$this->news_title->setDbValue($this->Recordset->fields('news_title'));
					$this->news_stext->setDbValue($this->Recordset->fields('news_stext'));
					$this->news_text->setDbValue($this->Recordset->fields('news_text'));
				} else {
					if (!ew_CompareValue($this->status_id->DbValue, $this->Recordset->fields('status_id')))
						$this->status_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->news_date->DbValue, $this->Recordset->fields('news_date')))
						$this->news_date->CurrentValue = NULL;
					if (!ew_CompareValue($this->news_title->DbValue, $this->Recordset->fields('news_title')))
						$this->news_title->CurrentValue = NULL;
					if (!ew_CompareValue($this->news_stext->DbValue, $this->Recordset->fields('news_stext')))
						$this->news_stext->CurrentValue = NULL;
					if (!ew_CompareValue($this->news_text->DbValue, $this->Recordset->fields('news_text')))
						$this->news_text->CurrentValue = NULL;
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
		$this->news_id->CurrentValue = $sKeyFld;
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
		$this->news_image->Upload->Index = $objForm->Index;
		$this->news_image->Upload->UploadFile();
		$this->news_image->CurrentValue = $this->news_image->Upload->FileName;
		$this->news_image->MultiUpdate = $objForm->GetValue("u_news_image");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		$this->status_id->MultiUpdate = $objForm->GetValue("u_status_id");
		if (!$this->news_date->FldIsDetailKey) {
			$this->news_date->setFormValue($objForm->GetValue("x_news_date"));
			$this->news_date->CurrentValue = ew_UnFormatDateTime($this->news_date->CurrentValue, 0);
		}
		$this->news_date->MultiUpdate = $objForm->GetValue("u_news_date");
		if (!$this->news_title->FldIsDetailKey) {
			$this->news_title->setFormValue($objForm->GetValue("x_news_title"));
		}
		$this->news_title->MultiUpdate = $objForm->GetValue("u_news_title");
		if (!$this->news_stext->FldIsDetailKey) {
			$this->news_stext->setFormValue($objForm->GetValue("x_news_stext"));
		}
		$this->news_stext->MultiUpdate = $objForm->GetValue("u_news_stext");
		if (!$this->news_text->FldIsDetailKey) {
			$this->news_text->setFormValue($objForm->GetValue("x_news_text"));
		}
		$this->news_text->MultiUpdate = $objForm->GetValue("u_news_text");
		if (!$this->news_id->FldIsDetailKey)
			$this->news_id->setFormValue($objForm->GetValue("x_news_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->news_id->CurrentValue = $this->news_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->news_date->CurrentValue = $this->news_date->FormValue;
		$this->news_date->CurrentValue = ew_UnFormatDateTime($this->news_date->CurrentValue, 0);
		$this->news_title->CurrentValue = $this->news_title->FormValue;
		$this->news_stext->CurrentValue = $this->news_stext->FormValue;
		$this->news_text->CurrentValue = $this->news_text->FormValue;
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
		$this->news_id->setDbValue($row['news_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->news_date->setDbValue($row['news_date']);
		$this->news_title->setDbValue($row['news_title']);
		$this->news_image->Upload->DbValue = $row['news_image'];
		$this->news_image->setDbValue($this->news_image->Upload->DbValue);
		$this->news_stext->setDbValue($row['news_stext']);
		$this->news_text->setDbValue($row['news_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['news_id'] = NULL;
		$row['status_id'] = NULL;
		$row['news_date'] = NULL;
		$row['news_title'] = NULL;
		$row['news_image'] = NULL;
		$row['news_stext'] = NULL;
		$row['news_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->news_id->DbValue = $row['news_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->news_date->DbValue = $row['news_date'];
		$this->news_title->DbValue = $row['news_title'];
		$this->news_image->Upload->DbValue = $row['news_image'];
		$this->news_stext->DbValue = $row['news_stext'];
		$this->news_text->DbValue = $row['news_text'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// news_id
		// status_id
		// news_date
		// news_title
		// news_image
		// news_stext
		// news_text

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

		// news_date
		$this->news_date->ViewValue = $this->news_date->CurrentValue;
		$this->news_date->ViewValue = ew_FormatDateTime($this->news_date->ViewValue, 0);
		$this->news_date->ViewCustomAttributes = "";

		// news_title
		$this->news_title->ViewValue = $this->news_title->CurrentValue;
		$this->news_title->ViewCustomAttributes = "";

		// news_image
		$this->news_image->UploadPath = '../../assets/img/newsImages';
		if (!ew_Empty($this->news_image->Upload->DbValue)) {
			$this->news_image->ImageWidth = 200;
			$this->news_image->ImageHeight = 0;
			$this->news_image->ImageAlt = $this->news_image->FldAlt();
			$this->news_image->ViewValue = $this->news_image->Upload->DbValue;
		} else {
			$this->news_image->ViewValue = "";
		}
		$this->news_image->ViewCustomAttributes = "";

		// news_stext
		$this->news_stext->ViewValue = $this->news_stext->CurrentValue;
		$this->news_stext->ViewCustomAttributes = "";

		// news_text
		$this->news_text->ViewValue = $this->news_text->CurrentValue;
		$this->news_text->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// news_date
			$this->news_date->LinkCustomAttributes = "";
			$this->news_date->HrefValue = "";
			$this->news_date->TooltipValue = "";

			// news_title
			$this->news_title->LinkCustomAttributes = "";
			$this->news_title->HrefValue = "";
			$this->news_title->TooltipValue = "";

			// news_image
			$this->news_image->LinkCustomAttributes = "";
			$this->news_image->UploadPath = '../../assets/img/newsImages';
			if (!ew_Empty($this->news_image->Upload->DbValue)) {
				$this->news_image->HrefValue = ew_GetFileUploadUrl($this->news_image, $this->news_image->Upload->DbValue); // Add prefix/suffix
				$this->news_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->news_image->HrefValue = ew_FullUrl($this->news_image->HrefValue, "href");
			} else {
				$this->news_image->HrefValue = "";
			}
			$this->news_image->HrefValue2 = $this->news_image->UploadPath . $this->news_image->Upload->DbValue;
			$this->news_image->TooltipValue = "";
			if ($this->news_image->UseColorbox) {
				if (ew_Empty($this->news_image->TooltipValue))
					$this->news_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->news_image->LinkAttrs["data-rel"] = "cpy_news_x_news_image";
				ew_AppendClass($this->news_image->LinkAttrs["class"], "ewLightbox");
			}

			// news_stext
			$this->news_stext->LinkCustomAttributes = "";
			$this->news_stext->HrefValue = "";
			$this->news_stext->TooltipValue = "";

			// news_text
			$this->news_text->LinkCustomAttributes = "";
			$this->news_text->HrefValue = "";
			$this->news_text->TooltipValue = "";
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
			$sSqlWrk .= " ORDER BY `status_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// news_date
			$this->news_date->EditAttrs["class"] = "form-control";
			$this->news_date->EditCustomAttributes = "";
			$this->news_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->news_date->CurrentValue, 8));
			$this->news_date->PlaceHolder = ew_RemoveHtml($this->news_date->FldCaption());

			// news_title
			$this->news_title->EditAttrs["class"] = "form-control";
			$this->news_title->EditCustomAttributes = "";
			$this->news_title->EditValue = ew_HtmlEncode($this->news_title->CurrentValue);
			$this->news_title->PlaceHolder = ew_RemoveHtml($this->news_title->FldCaption());

			// news_image
			$this->news_image->EditAttrs["class"] = "form-control";
			$this->news_image->EditCustomAttributes = "";
			$this->news_image->UploadPath = '../../assets/img/newsImages';
			if (!ew_Empty($this->news_image->Upload->DbValue)) {
				$this->news_image->ImageWidth = 200;
				$this->news_image->ImageHeight = 0;
				$this->news_image->ImageAlt = $this->news_image->FldAlt();
				$this->news_image->EditValue = $this->news_image->Upload->DbValue;
			} else {
				$this->news_image->EditValue = "";
			}
			if (!ew_Empty($this->news_image->CurrentValue))
					$this->news_image->Upload->FileName = $this->news_image->CurrentValue;

			// news_stext
			$this->news_stext->EditAttrs["class"] = "form-control";
			$this->news_stext->EditCustomAttributes = "";
			$this->news_stext->EditValue = ew_HtmlEncode($this->news_stext->CurrentValue);
			$this->news_stext->PlaceHolder = ew_RemoveHtml($this->news_stext->FldCaption());

			// news_text
			$this->news_text->EditAttrs["class"] = "form-control";
			$this->news_text->EditCustomAttributes = "";
			$this->news_text->EditValue = ew_HtmlEncode($this->news_text->CurrentValue);
			$this->news_text->PlaceHolder = ew_RemoveHtml($this->news_text->FldCaption());

			// Edit refer script
			// status_id

			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// news_date
			$this->news_date->LinkCustomAttributes = "";
			$this->news_date->HrefValue = "";

			// news_title
			$this->news_title->LinkCustomAttributes = "";
			$this->news_title->HrefValue = "";

			// news_image
			$this->news_image->LinkCustomAttributes = "";
			$this->news_image->UploadPath = '../../assets/img/newsImages';
			if (!ew_Empty($this->news_image->Upload->DbValue)) {
				$this->news_image->HrefValue = ew_GetFileUploadUrl($this->news_image, $this->news_image->Upload->DbValue); // Add prefix/suffix
				$this->news_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->news_image->HrefValue = ew_FullUrl($this->news_image->HrefValue, "href");
			} else {
				$this->news_image->HrefValue = "";
			}
			$this->news_image->HrefValue2 = $this->news_image->UploadPath . $this->news_image->Upload->DbValue;

			// news_stext
			$this->news_stext->LinkCustomAttributes = "";
			$this->news_stext->HrefValue = "";

			// news_text
			$this->news_text->LinkCustomAttributes = "";
			$this->news_text->HrefValue = "";
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
		if ($this->news_date->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->news_title->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->news_image->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->news_stext->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->news_text->MultiUpdate == "1") $lUpdateCnt++;
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
		if ($this->news_date->MultiUpdate <> "" && !$this->news_date->FldIsDetailKey && !is_null($this->news_date->FormValue) && $this->news_date->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->news_date->FldCaption(), $this->news_date->ReqErrMsg));
		}
		if ($this->news_date->MultiUpdate <> "") {
			if (!ew_CheckDateDef($this->news_date->FormValue)) {
				ew_AddMessage($gsFormError, $this->news_date->FldErrMsg());
			}
		}
		if ($this->news_title->MultiUpdate <> "" && !$this->news_title->FldIsDetailKey && !is_null($this->news_title->FormValue) && $this->news_title->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->news_title->FldCaption(), $this->news_title->ReqErrMsg));
		}
		if ($this->news_image->MultiUpdate <> "" && $this->news_image->Upload->FileName == "" && !$this->news_image->Upload->KeepFile) {
			ew_AddMessage($gsFormError, str_replace("%s", $this->news_image->FldCaption(), $this->news_image->ReqErrMsg));
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
			$this->news_image->OldUploadPath = '../../assets/img/newsImages';
			$this->news_image->UploadPath = $this->news_image->OldUploadPath;
			$rsnew = array();

			// status_id
			$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, $this->status_id->ReadOnly || $this->status_id->MultiUpdate <> "1");

			// news_date
			$this->news_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->news_date->CurrentValue, 0), ew_CurrentDate(), $this->news_date->ReadOnly || $this->news_date->MultiUpdate <> "1");

			// news_title
			$this->news_title->SetDbValueDef($rsnew, $this->news_title->CurrentValue, "", $this->news_title->ReadOnly || $this->news_title->MultiUpdate <> "1");

			// news_image
			if ($this->news_image->Visible && !$this->news_image->ReadOnly && strval($this->news_image->MultiUpdate) == "1" && !$this->news_image->Upload->KeepFile) {
				$this->news_image->Upload->DbValue = $rsold['news_image']; // Get original value
				if ($this->news_image->Upload->FileName == "") {
					$rsnew['news_image'] = NULL;
				} else {
					$rsnew['news_image'] = $this->news_image->Upload->FileName;
				}
			}

			// news_stext
			$this->news_stext->SetDbValueDef($rsnew, $this->news_stext->CurrentValue, NULL, $this->news_stext->ReadOnly || $this->news_stext->MultiUpdate <> "1");

			// news_text
			$this->news_text->SetDbValueDef($rsnew, $this->news_text->CurrentValue, NULL, $this->news_text->ReadOnly || $this->news_text->MultiUpdate <> "1");
			if ($this->news_image->Visible && !$this->news_image->Upload->KeepFile) {
				$this->news_image->UploadPath = '../../assets/img/newsImages';
				$OldFiles = ew_Empty($this->news_image->Upload->DbValue) ? array() : array($this->news_image->Upload->DbValue);
				if (!ew_Empty($this->news_image->Upload->FileName) && $this->UpdateCount == 1) {
					$NewFiles = array($this->news_image->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->news_image->Upload->Index < 0) ? $this->news_image->FldVar : substr($this->news_image->FldVar, 0, 1) . $this->news_image->Upload->Index . substr($this->news_image->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->news_image->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->news_image->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->news_image->TblVar) . $file1) || file_exists($this->news_image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->news_image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->news_image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->news_image->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->news_image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->news_image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->news_image->SetDbValueDef($rsnew, $this->news_image->Upload->FileName, "", $this->news_image->ReadOnly || $this->news_image->MultiUpdate <> "1");
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
					if ($this->news_image->Visible && !$this->news_image->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->news_image->Upload->DbValue) ? array() : array($this->news_image->Upload->DbValue);
						if (!ew_Empty($this->news_image->Upload->FileName) && $this->UpdateCount == 1) {
							$NewFiles = array($this->news_image->Upload->FileName);
							$NewFiles2 = array($rsnew['news_image']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->news_image->Upload->Index < 0) ? $this->news_image->FldVar : substr($this->news_image->FldVar, 0, 1) . $this->news_image->Upload->Index . substr($this->news_image->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->news_image->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->news_image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// news_image
		ew_CleanUploadTempPath($this->news_image, $this->news_image->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_newslist.php"), "", $this->TableVar, TRUE);
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
			$sSqlWrk .= " ORDER BY `status_id`";
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
if (!isset($cpy_news_update)) $cpy_news_update = new ccpy_news_update();

// Page init
$cpy_news_update->Page_Init();

// Page main
$cpy_news_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_news_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fcpy_newsupdate = new ew_Form("fcpy_newsupdate", "update");

// Validate form
fcpy_newsupdate.Validate = function() {
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
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_news->status_id->FldCaption(), $cpy_news->status_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_news_date");
			uelm = this.GetElements("u" + infix + "_news_date");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_news->news_date->FldCaption(), $cpy_news->news_date->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_news_date");
			uelm = this.GetElements("u" + infix + "_news_date");
			if (uelm && uelm.checked && elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_news->news_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_news_title");
			uelm = this.GetElements("u" + infix + "_news_title");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_news->news_title->FldCaption(), $cpy_news->news_title->ReqErrMsg)) ?>");
			}
			felm = this.GetElements("x" + infix + "_news_image");
			elm = this.GetElements("fn_x" + infix + "_news_image");
			uelm = this.GetElements("u" + infix + "_news_image");
			if (uelm && uelm.checked) {
				if (felm && elm && !ew_HasValue(elm))
					return this.OnError(felm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_news->news_image->FldCaption(), $cpy_news->news_image->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcpy_newsupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_newsupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_newsupdate.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_newsupdate.Lists["x_status_id"].Data = "<?php echo $cpy_news_update->status_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_news_update->ShowPageHeader(); ?>
<?php
$cpy_news_update->ShowMessage();
?>
<form name="fcpy_newsupdate" id="fcpy_newsupdate" class="<?php echo $cpy_news_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_news_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_news_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_news">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_news_update->IsModal) ?>">
<?php foreach ($cpy_news_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_cpy_newsupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($cpy_news->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $cpy_news_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_status_id" id="u_status_id" class="ewMultiSelect" value="1"<?php echo ($cpy_news->status_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_news->status_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_news_update->RightColumnClass ?>"><div<?php echo $cpy_news->status_id->CellAttributes() ?>>
<span id="el_cpy_news_status_id">
<select data-table="cpy_news" data-field="x_status_id" data-value-separator="<?php echo $cpy_news->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_news->status_id->EditAttributes() ?>>
<?php echo $cpy_news->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $cpy_news->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_news->news_date->Visible) { // news_date ?>
	<div id="r_news_date" class="form-group">
		<label for="x_news_date" class="<?php echo $cpy_news_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_news_date" id="u_news_date" class="ewMultiSelect" value="1"<?php echo ($cpy_news->news_date->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_news->news_date->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_news_update->RightColumnClass ?>"><div<?php echo $cpy_news->news_date->CellAttributes() ?>>
<span id="el_cpy_news_news_date">
<input type="text" data-table="cpy_news" data-field="x_news_date" name="x_news_date" id="x_news_date" placeholder="<?php echo ew_HtmlEncode($cpy_news->news_date->getPlaceHolder()) ?>" value="<?php echo $cpy_news->news_date->EditValue ?>"<?php echo $cpy_news->news_date->EditAttributes() ?>>
<?php if (!$cpy_news->news_date->ReadOnly && !$cpy_news->news_date->Disabled && !isset($cpy_news->news_date->EditAttrs["readonly"]) && !isset($cpy_news->news_date->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fcpy_newsupdate", "x_news_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $cpy_news->news_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_news->news_title->Visible) { // news_title ?>
	<div id="r_news_title" class="form-group">
		<label for="x_news_title" class="<?php echo $cpy_news_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_news_title" id="u_news_title" class="ewMultiSelect" value="1"<?php echo ($cpy_news->news_title->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_news->news_title->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_news_update->RightColumnClass ?>"><div<?php echo $cpy_news->news_title->CellAttributes() ?>>
<span id="el_cpy_news_news_title">
<input type="text" data-table="cpy_news" data-field="x_news_title" name="x_news_title" id="x_news_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_news->news_title->getPlaceHolder()) ?>" value="<?php echo $cpy_news->news_title->EditValue ?>"<?php echo $cpy_news->news_title->EditAttributes() ?>>
</span>
<?php echo $cpy_news->news_title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_news->news_image->Visible) { // news_image ?>
	<div id="r_news_image" class="form-group">
		<label class="<?php echo $cpy_news_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_news_image" id="u_news_image" class="ewMultiSelect" value="1"<?php echo ($cpy_news->news_image->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_news->news_image->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_news_update->RightColumnClass ?>"><div<?php echo $cpy_news->news_image->CellAttributes() ?>>
<span id="el_cpy_news_news_image">
<div id="fd_x_news_image">
<span title="<?php echo $cpy_news->news_image->FldTitle() ? $cpy_news->news_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_news->news_image->ReadOnly || $cpy_news->news_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_news" data-field="x_news_image" name="x_news_image" id="x_news_image"<?php echo $cpy_news->news_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_news_image" id= "fn_x_news_image" value="<?php echo $cpy_news->news_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_news_image"] == "0") { ?>
<input type="hidden" name="fa_x_news_image" id= "fa_x_news_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_news_image" id= "fa_x_news_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_news_image" id= "fs_x_news_image" value="200">
<input type="hidden" name="fx_x_news_image" id= "fx_x_news_image" value="<?php echo $cpy_news->news_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_news_image" id= "fm_x_news_image" value="<?php echo $cpy_news->news_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_news_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $cpy_news->news_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_news->news_stext->Visible) { // news_stext ?>
	<div id="r_news_stext" class="form-group">
		<label for="x_news_stext" class="<?php echo $cpy_news_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_news_stext" id="u_news_stext" class="ewMultiSelect" value="1"<?php echo ($cpy_news->news_stext->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_news->news_stext->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_news_update->RightColumnClass ?>"><div<?php echo $cpy_news->news_stext->CellAttributes() ?>>
<span id="el_cpy_news_news_stext">
<textarea data-table="cpy_news" data-field="x_news_stext" name="x_news_stext" id="x_news_stext" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($cpy_news->news_stext->getPlaceHolder()) ?>"<?php echo $cpy_news->news_stext->EditAttributes() ?>><?php echo $cpy_news->news_stext->EditValue ?></textarea>
</span>
<?php echo $cpy_news->news_stext->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_news->news_text->Visible) { // news_text ?>
	<div id="r_news_text" class="form-group">
		<label class="<?php echo $cpy_news_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_news_text" id="u_news_text" class="ewMultiSelect" value="1"<?php echo ($cpy_news->news_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_news->news_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_news_update->RightColumnClass ?>"><div<?php echo $cpy_news->news_text->CellAttributes() ?>>
<span id="el_cpy_news_news_text">
<?php ew_AppendClass($cpy_news->news_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="cpy_news" data-field="x_news_text" name="x_news_text" id="x_news_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($cpy_news->news_text->getPlaceHolder()) ?>"<?php echo $cpy_news->news_text->EditAttributes() ?>><?php echo $cpy_news->news_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fcpy_newsupdate", "x_news_text", 35, 8, <?php echo ($cpy_news->news_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $cpy_news->news_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$cpy_news_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $cpy_news_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_news_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_newsupdate.Init();
</script>
<?php
$cpy_news_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_news_update->Page_Terminate();
?>
