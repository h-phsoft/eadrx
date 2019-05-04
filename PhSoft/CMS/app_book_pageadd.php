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

$app_book_page_add = NULL; // Initialize page object first

class capp_book_page_add extends capp_book_page {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_book_page';

	// Page object name
	var $PageObjName = 'app_book_page_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
			if (@$_GET["bpage_id"] != "") {
				$this->bpage_id->setQueryStringValue($_GET["bpage_id"]);
				$this->setKey("bpage_id", $this->bpage_id->CurrentValue); // Set up key
			} else {
				$this->setKey("bpage_id", ""); // Clear key
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
					$this->Page_Terminate("app_book_pagelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "app_book_pagelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "app_book_pageview.php")
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
		$this->page_image->Upload->Index = $objForm->Index;
		$this->page_image->Upload->UploadFile();
		$this->page_image->CurrentValue = $this->page_image->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->bpage_id->CurrentValue = NULL;
		$this->bpage_id->OldValue = $this->bpage_id->CurrentValue;
		$this->book_id->CurrentValue = NULL;
		$this->book_id->OldValue = $this->book_id->CurrentValue;
		$this->page_num->CurrentValue = NULL;
		$this->page_num->OldValue = $this->page_num->CurrentValue;
		$this->page_image->Upload->DbValue = NULL;
		$this->page_image->OldValue = $this->page_image->Upload->DbValue;
		$this->page_image->CurrentValue = NULL; // Clear file related field
		$this->page_text->CurrentValue = NULL;
		$this->page_text->OldValue = $this->page_text->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->book_id->FldIsDetailKey) {
			$this->book_id->setFormValue($objForm->GetValue("x_book_id"));
		}
		if (!$this->page_num->FldIsDetailKey) {
			$this->page_num->setFormValue($objForm->GetValue("x_page_num"));
		}
		if (!$this->page_text->FldIsDetailKey) {
			$this->page_text->setFormValue($objForm->GetValue("x_page_text"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->book_id->CurrentValue = $this->book_id->FormValue;
		$this->page_num->CurrentValue = $this->page_num->FormValue;
		$this->page_text->CurrentValue = $this->page_text->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['bpage_id'] = $this->bpage_id->CurrentValue;
		$row['book_id'] = $this->book_id->CurrentValue;
		$row['page_num'] = $this->page_num->CurrentValue;
		$row['page_image'] = $this->page_image->Upload->DbValue;
		$row['page_text'] = $this->page_text->CurrentValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("bpage_id")) <> "")
			$this->bpage_id->CurrentValue = $this->getKey("bpage_id"); // bpage_id
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->page_image);

			// page_text
			$this->page_text->EditAttrs["class"] = "form-control";
			$this->page_text->EditCustomAttributes = "";
			$this->page_text->EditValue = ew_HtmlEncode($this->page_text->CurrentValue);
			$this->page_text->PlaceHolder = ew_RemoveHtml($this->page_text->FldCaption());

			// Add refer script
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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->book_id->FldIsDetailKey && !is_null($this->book_id->FormValue) && $this->book_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->book_id->FldCaption(), $this->book_id->ReqErrMsg));
		}
		if (!$this->page_num->FldIsDetailKey && !is_null($this->page_num->FormValue) && $this->page_num->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->page_num->FldCaption(), $this->page_num->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->page_num->FormValue)) {
			ew_AddMessage($gsFormError, $this->page_num->FldErrMsg());
		}
		if (!$this->page_text->FldIsDetailKey && !is_null($this->page_text->FormValue) && $this->page_text->FormValue == "") {
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
			$this->page_image->OldUploadPath = '../../assets/img/bookImages';
			$this->page_image->UploadPath = $this->page_image->OldUploadPath;
		}
		$rsnew = array();

		// book_id
		$this->book_id->SetDbValueDef($rsnew, $this->book_id->CurrentValue, 0, FALSE);

		// page_num
		$this->page_num->SetDbValueDef($rsnew, $this->page_num->CurrentValue, 0, FALSE);

		// page_image
		if ($this->page_image->Visible && !$this->page_image->Upload->KeepFile) {
			$this->page_image->Upload->DbValue = ""; // No need to delete old file
			if ($this->page_image->Upload->FileName == "") {
				$rsnew['page_image'] = NULL;
			} else {
				$rsnew['page_image'] = $this->page_image->Upload->FileName;
			}
		}

		// page_text
		$this->page_text->SetDbValueDef($rsnew, $this->page_text->CurrentValue, "", FALSE);
		if ($this->page_image->Visible && !$this->page_image->Upload->KeepFile) {
			$this->page_image->UploadPath = '../../assets/img/bookImages';
			$OldFiles = ew_Empty($this->page_image->Upload->DbValue) ? array() : array($this->page_image->Upload->DbValue);
			if (!ew_Empty($this->page_image->Upload->FileName)) {
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
				$this->page_image->SetDbValueDef($rsnew, $this->page_image->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
				if ($this->page_image->Visible && !$this->page_image->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->page_image->Upload->DbValue) ? array() : array($this->page_image->Upload->DbValue);
					if (!ew_Empty($this->page_image->Upload->FileName)) {
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
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}

		// page_image
		ew_CleanUploadTempPath($this->page_image, $this->page_image->Upload->Index);
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
			if ($sMasterTblVar == "app_book") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_book_id"] <> "") {
					$GLOBALS["app_book"]->book_id->setQueryStringValue($_GET["fk_book_id"]);
					$this->book_id->setQueryStringValue($GLOBALS["app_book"]->book_id->QueryStringValue);
					$this->book_id->setSessionValue($this->book_id->QueryStringValue);
					if (!is_numeric($GLOBALS["app_book"]->book_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "app_book") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_book_id"] <> "") {
					$GLOBALS["app_book"]->book_id->setFormValue($_POST["fk_book_id"]);
					$this->book_id->setFormValue($GLOBALS["app_book"]->book_id->FormValue);
					$this->book_id->setSessionValue($this->book_id->FormValue);
					if (!is_numeric($GLOBALS["app_book"]->book_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "app_book") {
				if ($this->book_id->CurrentValue == "") $this->book_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_book_pagelist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($app_book_page_add)) $app_book_page_add = new capp_book_page_add();

// Page init
$app_book_page_add->Page_Init();

// Page main
$app_book_page_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_book_page_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fapp_book_pageadd = new ew_Form("fapp_book_pageadd", "add");

// Validate form
fapp_book_pageadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_book_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->book_id->FldCaption(), $app_book_page->book_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_page_num");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->page_num->FldCaption(), $app_book_page->page_num->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_page_num");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_book_page->page_num->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_page_text");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_book_page->page_text->FldCaption(), $app_book_page->page_text->ReqErrMsg)) ?>");

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
fapp_book_pageadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_book_pageadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_book_pageadd.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_book_pageadd.Lists["x_book_id"].Data = "<?php echo $app_book_page_add->book_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_book_page_add->ShowPageHeader(); ?>
<?php
$app_book_page_add->ShowMessage();
?>
<form name="fapp_book_pageadd" id="fapp_book_pageadd" class="<?php echo $app_book_page_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_book_page_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_book_page_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_book_page">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($app_book_page_add->IsModal) ?>">
<?php if ($app_book_page->getCurrentMasterTable() == "app_book") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="app_book">
<input type="hidden" name="fk_book_id" value="<?php echo $app_book_page->book_id->getSessionValue() ?>">
<?php } ?>
<div class="ewAddDiv"><!-- page* -->
<?php if ($app_book_page->book_id->Visible) { // book_id ?>
	<div id="r_book_id" class="form-group">
		<label id="elh_app_book_page_book_id" for="x_book_id" class="<?php echo $app_book_page_add->LeftColumnClass ?>"><?php echo $app_book_page->book_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_book_page_add->RightColumnClass ?>"><div<?php echo $app_book_page->book_id->CellAttributes() ?>>
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
		<label id="elh_app_book_page_page_num" for="x_page_num" class="<?php echo $app_book_page_add->LeftColumnClass ?>"><?php echo $app_book_page->page_num->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_book_page_add->RightColumnClass ?>"><div<?php echo $app_book_page->page_num->CellAttributes() ?>>
<span id="el_app_book_page_page_num">
<input type="text" data-table="app_book_page" data-field="x_page_num" name="x_page_num" id="x_page_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_num->getPlaceHolder()) ?>" value="<?php echo $app_book_page->page_num->EditValue ?>"<?php echo $app_book_page->page_num->EditAttributes() ?>>
</span>
<?php echo $app_book_page->page_num->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_book_page->page_image->Visible) { // page_image ?>
	<div id="r_page_image" class="form-group">
		<label id="elh_app_book_page_page_image" class="<?php echo $app_book_page_add->LeftColumnClass ?>"><?php echo $app_book_page->page_image->FldCaption() ?></label>
		<div class="<?php echo $app_book_page_add->RightColumnClass ?>"><div<?php echo $app_book_page->page_image->CellAttributes() ?>>
<span id="el_app_book_page_page_image">
<div id="fd_x_page_image">
<span title="<?php echo $app_book_page->page_image->FldTitle() ? $app_book_page->page_image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($app_book_page->page_image->ReadOnly || $app_book_page->page_image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="app_book_page" data-field="x_page_image" name="x_page_image" id="x_page_image"<?php echo $app_book_page->page_image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_page_image" id= "fn_x_page_image" value="<?php echo $app_book_page->page_image->Upload->FileName ?>">
<input type="hidden" name="fa_x_page_image" id= "fa_x_page_image" value="0">
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
		<label id="elh_app_book_page_page_text" class="<?php echo $app_book_page_add->LeftColumnClass ?>"><?php echo $app_book_page->page_text->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_book_page_add->RightColumnClass ?>"><div<?php echo $app_book_page->page_text->CellAttributes() ?>>
<span id="el_app_book_page_page_text">
<?php ew_AppendClass($app_book_page->page_text->EditAttrs["class"], "editor"); ?>
<textarea data-table="app_book_page" data-field="x_page_text" name="x_page_text" id="x_page_text" cols="35" rows="8" placeholder="<?php echo ew_HtmlEncode($app_book_page->page_text->getPlaceHolder()) ?>"<?php echo $app_book_page->page_text->EditAttributes() ?>><?php echo $app_book_page->page_text->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fapp_book_pageadd", "x_page_text", 35, 8, <?php echo ($app_book_page->page_text->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $app_book_page->page_text->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_book_page_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_book_page_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_book_page_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_book_pageadd.Init();
</script>
<?php
$app_book_page_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_book_page_add->Page_Terminate();
?>
