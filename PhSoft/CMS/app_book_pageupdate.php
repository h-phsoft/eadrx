<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_book_pageinfo.php" ?>
<?php include_once "app_bookinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_book_page_update = NULL; // Initialize page object first

class capp_book_page_update extends capp_book_page {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_book_page';

	// Page object name
	var $PageObjName = 'app_book_page_update';

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

		// Table object (app_book_page)
		if (!isset($GLOBALS["app_book_page"]) || get_class($GLOBALS["app_book_page"]) == "capp_book_page") {
			$GLOBALS["app_book_page"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_book_page"];
		}

		// Table object (app_book)
		if (!isset($GLOBALS['app_book'])) $GLOBALS['app_book'] = new capp_book();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_book_page', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_book_pagelist.php"));
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
		$this->book_id->SetVisibility();
		$this->page_num->SetVisibility();
		$this->page_image->SetVisibility();
		$this->page_text->SetVisibility();

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
		global $EW_EXPORT, $app_book_page;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_book_page);
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
					if ($pageName == "app_book_pageview.php")
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
			$this->Page_Terminate("app_book_pagelist.php"); // No records selected, return to list
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
					$this->book_id->setDbValue($this->Recordset->fields('book_id'));
					$this->page_num->setDbValue($this->Recordset->fields('page_num'));
					$this->page_text->setDbValue($this->Recordset->fields('page_text'));
				} else {
					if (!ew_CompareValue($this->book_id->DbValue, $this->Recordset->fields('book_id')))
						$this->book_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->page_num->DbValue, $this->Recordset->fields('page_num')))
						$this->page_num->CurrentValue = NULL;
					if (!ew_CompareValue($this->page_text->DbValue, $this->Recordset->fields('page_text')))
						$this->page_text->CurrentValue = NULL;
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
		$this->bpage_id->CurrentValue = $sKeyFld;
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
		$this->page_image->Upload->Index = $objForm->Index;
		$this->page_image->Upload->UploadFile();
		$this->page_image->CurrentValue = $this->page_image->Upload->FileName;
		$this->page_image->MultiUpdate = $objForm->GetValue("u_page_image");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->book_id->FldIsDetailKey) {
			$this->book_id->setFormValue($objForm->GetValue("x_book_id"));
		}
		$this->book_id->MultiUpdate = $objForm->GetValue("u_book_id");
		if (!$this->page_num->FldIsDetailKey) {
			$this->page_num->setFormValue($objForm->GetValue("x_page_num"));
		}
		$this->page_num->MultiUpdate = $objForm->GetValue("u_page_num");
		if (!$this->page_text->FldIsDetailKey) {
			$this->page_text->setFormValue($objForm->GetValue("x_page_text"));
		}
		$this->page_text->MultiUpdate = $objForm->GetValue("u_page_text");
		if (!$this->bpage_id->FldIsDetailKey)
			$this->bpage_id->setFormValue($objForm->GetValue("x_bpage_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->bpage_id->CurrentValue = $this->bpage_id->FormValue;
		$this->book_id->CurrentValue = $this->book_id->FormValue;
		$this->page_num->CurrentValue = $this->page_num->FormValue;
		$this->page_text->CurrentValue = $this->page_text->FormValue;
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
		$this->bpage_id->setDbValue($row['bpage_id']);
		$this->book_id->setDbValue($row['book_id']);
		$this->page_num->setDbValue($row['page_num']);
		$this->page_image->Upload->DbValue = $row['page_image'];
		$this->page_image->setDbValue($this->page_image->Upload->DbValue);
		$this->page_text->setDbValue($row['page_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['bpage_id'] = NULL;
		$row['book_id'] = NULL;
		$row['page_num'] = NULL;
		$row['page_image'] = NULL;
		$row['page_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->bpage_id->DbValue = $row['bpage_id'];
		$this->book_id->DbValue = $row['book_id'];
		$this->page_num->DbValue = $row['page_num'];
		$this->page_image->Upload->DbValue = $row['page_image'];
		$this->page_text->DbValue = $row['page_text'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// bpage_id
		// book_id
		// page_num
		// page_image
		// page_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// book_id
		if (strval($this->book_id->CurrentValue) <> "") {
			$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
		$sWhereWrk = "";
		$this->book_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `book_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->book_id->ViewValue = $this->book_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->book_id->ViewValue = $this->book_id->CurrentValue;
			}
		} else {
			$this->book_id->ViewValue = NULL;
		}
		$this->book_id->ViewCustomAttributes = "";

		// page_num
		$this->page_num->ViewValue = $this->page_num->CurrentValue;
		$this->page_num->ViewCustomAttributes = "";

		// page_image
		$this->page_image->UploadPath = '../../assets/img/bookImages';
		if (!ew_Empty($this->page_image->Upload->DbValue)) {
			$this->page_image->ImageWidth = 200;
			$this->page_image->ImageHeight = 0;
			$this->page_image->ImageAlt = $this->page_image->FldAlt();
			$this->page_image->ViewValue = $this->page_image->Upload->DbValue;
		} else {
			$this->page_image->ViewValue = "";
		}
		$this->page_image->ViewCustomAttributes = "";

		// page_text
		$this->page_text->ViewValue = $this->page_text->CurrentValue;
		$this->page_text->ViewCustomAttributes = "";

			// book_id
			$this->book_id->LinkCustomAttributes = "";
			$this->book_id->HrefValue = "";
			$this->book_id->TooltipValue = "";

			// page_num
			$this->page_num->LinkCustomAttributes = "";
			$this->page_num->HrefValue = "";
			$this->page_num->TooltipValue = "";

			// page_image
			$this->page_image->LinkCustomAttributes = "";
			$this->page_image->UploadPath = '../../assets/img/bookImages';
			if (!ew_Empty($this->page_image->Upload->DbValue)) {
				$this->page_image->HrefValue = ew_GetFileUploadUrl($this->page_image, $this->page_image->Upload->DbValue); // Add prefix/suffix
				$this->page_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->page_image->HrefValue = ew_FullUrl($this->page_image->HrefValue, "href");
			} else {
				$this->page_image->HrefValue = "";
			}
			$this->page_image->HrefValue2 = $this->page_image->UploadPath . $this->page_image->Upload->DbValue;
			$this->page_image->TooltipValue = "";
			if ($this->page_image->UseColorbox) {
				if (ew_Empty($this->page_image->TooltipValue))
					$this->page_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->page_image->LinkAttrs["data-rel"] = "app_book_page_x_page_image";
				ew_AppendClass($this->page_image->LinkAttrs["class"], "ewLightbox");
			}

			// page_text
			$this->page_text->LinkCustomAttributes = "";
			$this->page_text->HrefValue = "";
			$this->page_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// book_id
			$this->book_id->EditAttrs["class"] = "form-control";
			$this->book_id->EditCustomAttributes = "";
			if ($this->book_id->getSessionValue() <> "") {
				$this->book_id->CurrentValue = $this->book_id->getSessionValue();
			if (strval($this->book_id->CurrentValue) <> "") {
				$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
			$sWhereWrk = "";
			$this->book_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `book_id`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->book_id->ViewValue = $this->book_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->book_id->ViewValue = $this->book_id->CurrentValue;
				}
			} else {
				$this->book_id->ViewValue = NULL;
			}
			$this->book_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->book_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_book`";
			$sWhereWrk = "";
			$this->book_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `book_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->book_id->EditValue = $arwrk;
			}

			// page_num
			$this->page_num->EditAttrs["class"] = "form-control";
			$this->page_num->EditCustomAttributes = "";
			$this->page_num->EditValue = ew_HtmlEncode($this->page_num->CurrentValue);
			$this->page_num->PlaceHolder = ew_RemoveHtml($this->page_num->FldCaption());

			// page_image
			$this->page_image->EditAttrs["class"] = "form-control";
			$this->page_image->EditCustomAttributes = "";
			$this->page_image->UploadPath = '../../assets/img/bookImages';
			if (!ew_Empty($this->page_image->Upload->DbValue)) {
				$this->page_image->ImageWidth = 200;
				$this->page_image->ImageHeight = 0;
				$this->page_image->ImageAlt = $this->page_image->FldAlt();
				$this->page_image->EditValue = $this->page_image->Upload->DbValue;
			} else {
				$this->page_image->EditValue = "";
			}
			if (!ew_Empty($this->page_image->CurrentValue))
					$this->page_image->Upload->FileName = $this->page_image->CurrentValue;

			// page_text
			$this->page_text->EditAttrs["class"] = "form-control";
			$this->page_text->EditCustomAttributes = "";
			$this->page_text->EditValue = ew_HtmlEncode($this->page_text->CurrentValue);
			$this->page_text->PlaceHolder = ew_RemoveHtml($this->page_text->FldCaption());

			// Edit refer script
			// book_id

			$this->book_id->LinkCustomAttributes = "";
			$this->book_id->HrefValue = "";

			// page_num
			$this->page_num->LinkCustomAttributes = "";
			$this->page_num->HrefValue = "";

			// page_image
			$this->page_image->LinkCustomAttributes = "";
			$this->page_image->UploadPath = '../../assets/img/bookImages';
			if (!ew_Empty($this->page_image->Upload->DbValue)) {
				$this->page_image->HrefValue = ew_GetFileUploadUrl($this->page_image, $this->page_image->Upload->DbValue); // Add prefix/suffix
				$this->page_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->page_image->HrefValue = ew_FullUrl($this->page_image->HrefValue, "href");
			} else {
				$this->page_image->HrefValue = "";
			}
			$this->page_image->HrefValue2 = $this->page_image->UploadPath . $this->page_image->Upload->DbValue;

			// page_text
			$this->page_text->LinkCustomAttributes = "";
			$this->page_text->HrefValue = "";
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
		if ($this->book_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->page_num->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->page_image->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->page_text->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->book_id->MultiUpdate <> "" && !$this->book_id->FldIsDetailKey && !is_null($this->book_id->FormValue) && $this->book_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->book_id->FldCaption(), $this->book_id->ReqErrMsg));
		}
		if ($this->page_num->MultiUpdate <> "" && !$this->page_num->FldIsDetailKey && !is_null($this->page_num->FormValue) && $this->page_num->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->page_num->FldCaption(), $this->page_num->ReqErrMsg));
		}
		if ($this->page_num->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->page_num->FormValue)) {
				ew_AddMessage($gsFormError, $this->page_num->FldErrMsg());
			}
		}
		if ($this->page_text->MultiUpdate <> "" && !$this->page_text->FldIsDetailKey && !is_null($this->page_text->FormValue) && $this->page_text->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->page_text->FldCaption(), $this->page_text->ReqErrMsg));
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
			$this->page_image->OldUploadPath = '../../assets/img/bookImages';
			$this->page_image->UploadPath = $this->page_image->OldUploadPath;
			$rsnew = array();

			// book_id
			$this->book_id->SetDbValueDef($rsnew, $this->book_id->CurrentValue, 0, $this->book_id->ReadOnly || $this->book_id->MultiUpdate <> "1");

			// page_num
			$this->page_num->SetDbValueDef($rsnew, $this->page_num->CurrentValue, 0, $this->page_num->ReadOnly || $this->page_num->MultiUpdate <> "1");

			// page_image
			if ($this->page_image->Visible && !$this->page_image->ReadOnly && strval($this->page_image->MultiUpdate) == "1" && !$this->page_image->Upload->KeepFile) {
				$this->page_image->Upload->DbValue = $rsold['page_image']; // Get original value
				if ($this->page_image->Upload->FileName == "") {
					$rsnew['page_image'] = NULL;
				} else {
					$rsnew['page_image'] = $this->page_image->Upload->FileName;
				}
			}

			// page_text
			$this->page_text->SetDbValueDef($rsnew, $this->page_text->CurrentValue, "", $this->page_text->ReadOnly || $this->page_text->MultiUpdate <> "1");
			if ($this->page_image->Visible && !$this->page_image->Upload->KeepFile) {
				$this->page_image->UploadPath = '../../assets/img/bookImages';
				$OldFiles = ew_Empty($this->page_image->Upload->DbValue) ? array() : array($this->page_image->Upload->DbValue);
				if (!ew_Empty($this->page_image->Upload->FileName) && $this->UpdateCount == 1) {
					$NewFiles = array($this->page_image->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->page_image->Upload->Index < 0) ? $this->page_image->FldVar : substr($this->page_image->FldVar, 0, 1) . $this->page_image->Upload->Index . substr($this->page_image->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->page_image->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->page_image->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->page_image->TblVar) . $file1) || file_exists($this->page_image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->page_image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->page_image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->page_image->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->page_image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->page_image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->page_image->SetDbValueDef($rsnew, $this->page_image->Upload->FileName, NULL, $this->page_image->ReadOnly || $this->page_image->MultiUpdate <> "1");
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
					if ($this->page_image->Visible && !$this->page_image->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->page_image->Upload->DbValue) ? array() : array($this->page_image->Upload->DbValue);
						if (!ew_Empty($this->page_image->Upload->FileName) && $this->UpdateCount == 1) {
							$NewFiles = array($this->page_image->Upload->FileName);
							$NewFiles2 = array($rsnew['page_image']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->page_image->Upload->Index < 0) ? $this->page_image->FldVar : substr($this->page_image->FldVar, 0, 1) . $this->page_image->Upload->Index . substr($this->page_image->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->page_image->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->page_image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// page_image
		ew_CleanUploadTempPath($this->page_image, $this->page_image->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_book_pagelist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_book_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `book_id` AS `LinkFld`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`book_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `book_id`";
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
if (!isset($app_book_page_update)) $app_book_page_update = new capp_book_page_update();

// Page init
$app_book_page_update->Page_Init();

// Page main
$app_book_page_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_book_page_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fapp_book_pageupdate = new ew_Form("fapp_book_pageupdate", "update");

// Validate form
fapp_book_pageupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_book_id");
			uelm = this.GetElements("u" + infix + "_book_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->book_id->FldCaption(), $app_book_page->book_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_page_num");
			uelm = this.GetElements("u" + infix + "_page_num");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->page_num->FldCaption(), $app_book_page->page_num->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_page_num");
			uelm = this.GetElements("u" + infix + "_page_num");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_book_page->page_num->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_page_text");
			uelm = this.GetElements("u" + infix + "_page_text");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->page_text->FldCaption(), $app_book_page->page_text->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fapp_book_pageupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_book_pageupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_book_pageupdate.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_book_pageupdate.Lists["x_book_id"].Data = "<?php echo $app_book_page_update->book_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_book_page_update->ShowPageHeader(); ?>
<?php
$app_book_page_update->ShowMessage();
?>
<form name="fapp_book_pageupdate" id="fapp_book_pageupdate" class="<?php echo $app_book_page_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_book_page_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_book_page_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_book_page">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($app_book_page_update->IsModal) ?>">
<?php foreach ($app_book_page_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_app_book_pageupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($app_book_page->book_id->Visible) { // book_id ?>
	<div id="r_book_id" class="form-group">
		<label for="x_book_id" class="<?php echo $app_book_page_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_book_id" id="u_book_id" class="ewMultiSelect" value="1"<?php echo ($app_book_page->book_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book_page->book_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_page_update->RightColumnClass ?>"><div<?php echo $app_book_page->book_id->CellAttributes() ?>>
<?php if ($app_book_page->book_id->getSessionValue() <> "") { ?>
<span id="el_app_book_page_book_id">
<span<?php echo $app_book_page->book_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $app_book_page->book_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_book_id" name="x_book_id" value="<?php echo ew_HtmlEncode($app_book_page->book_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_app_book_page_book_id">
<select data-table="app_book_page" data-field="x_book_id" data-value-separator="<?php echo $app_book_page->book_id->DisplayValueSeparatorAttribute() ?>" id="x_book_id" name="x_book_id"<?php echo $app_book_page->book_id->EditAttributes() ?>>
<?php echo $app_book_page->book_id->SelectOptionListHtml("x_book_id") ?>
</select>
</span>
<?php } ?>
<?php echo $app_book_page->book_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book_page->page_num->Visible) { // page_num ?>
	<div id="r_page_num" class="form-group">
		<label for="x_page_num" class="<?php echo $app_book_page_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_page_num" id="u_page_num" class="ewMultiSelect" value="1"<?php echo ($app_book_page->page_num->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book_page->page_num->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_page_update->RightColumnClass ?>"><div<?php echo $app_book_page->page_num->CellAttributes() ?>>
<span id="el_app_book_page_page_num">
<input type="text" data-table="app_book_page" data-field="x_page_num" name="x_page_num" id="x_page_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_num->getPlaceHolder()) ?>" value="<?php echo $app_book_page->page_num->EditValue ?>"<?php echo $app_book_page->page_num->EditAttributes() ?>>
</span>
<?php echo $app_book_page->page_num->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book_page->page_image->Visible) { // page_image ?>
	<div id="r_page_image" class="form-group">
		<label class="<?php echo $app_book_page_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_page_image" id="u_page_image" class="ewMultiSelect" value="1"<?php echo ($app_book_page->page_image->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book_page->page_image->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_page_update->RightColumnClass ?>"><div<?php echo $app_book_page->page_image->CellAttributes() ?>>
<span id="el_app_book_page_page_image">
<div id="fd_x_page_image">
<span title="<?php echo $app_book_page->page_image->FldTitle() ? $app_book_page->page_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_book_page->page_image->ReadOnly || $app_book_page->page_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_book_page" data-field="x_page_image" name="x_page_image" id="x_page_image"<?php echo $app_book_page->page_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_page_image" id= "fn_x_page_image" value="<?php echo $app_book_page->page_image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_page_image"] == "0") { ?>
<input type="hidden" name="fa_x_page_image" id= "fa_x_page_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_page_image" id= "fa_x_page_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_page_image" id= "fs_x_page_image" value="200">
<input type="hidden" name="fx_x_page_image" id= "fx_x_page_image" value="<?php echo $app_book_page->page_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_page_image" id= "fm_x_page_image" value="<?php echo $app_book_page->page_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_page_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $app_book_page->page_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book_page->page_text->Visible) { // page_text ?>
	<div id="r_page_text" class="form-group">
		<label class="<?php echo $app_book_page_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_page_text" id="u_page_text" class="ewMultiSelect" value="1"<?php echo ($app_book_page->page_text->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $app_book_page->page_text->FldCaption() ?></label></div></label>
		<div class="<?php echo $app_book_page_update->RightColumnClass ?>"><div<?php echo $app_book_page->page_text->CellAttributes() ?>>
<span id="el_app_book_page_page_text">
<?php ew_AppendClass($app_book_page->page_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_book_page" data-field="x_page_text" name="x_page_text" id="x_page_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_text->getPlaceHolder()) ?>"<?php echo $app_book_page->page_text->EditAttributes() ?>><?php echo $app_book_page->page_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_book_pageupdate", "x_page_text", 35, 8, <?php echo ($app_book_page->page_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $app_book_page->page_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$app_book_page_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $app_book_page_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_book_page_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_book_pageupdate.Init();
</script>
<?php
$app_book_page_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_book_page_update->Page_Terminate();
?>
