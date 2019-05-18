<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_consultation_categoryinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "app_consultation_category_namegridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_consultation_category_add = NULL; // Initialize page object first

class capp_consultation_category_add extends capp_consultation_category {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_consultation_category';

	// Page object name
	var $PageObjName = 'app_consultation_category_add';

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

		// Table object (app_consultation_category)
		if (!isset($GLOBALS["app_consultation_category"]) || get_class($GLOBALS["app_consultation_category"]) == "capp_consultation_category") {
			$GLOBALS["app_consultation_category"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_consultation_category"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_consultation_category', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_consultation_categorylist.php"));
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
		$this->cat_order->SetVisibility();
		$this->cat_name->SetVisibility();
		$this->cat_Price->SetVisibility();

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
				if (in_array("app_consultation_category_name", $DetailTblVar)) {

					// Process auto fill for detail table 'app_consultation_category_name'
					if (preg_match('/^fapp_consultation_category_name(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["app_consultation_category_name_grid"])) $GLOBALS["app_consultation_category_name_grid"] = new capp_consultation_category_name_grid;
						$GLOBALS["app_consultation_category_name_grid"]->Page_Init();
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
		global $EW_EXPORT, $app_consultation_category;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_consultation_category);
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
					if ($pageName == "app_consultation_categoryview.php")
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

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["cat_id"] != "") {
				$this->cat_id->setQueryStringValue($_GET["cat_id"]);
				$this->setKey("cat_id", $this->cat_id->CurrentValue); // Set up key
			} else {
				$this->setKey("cat_id", ""); // Clear key
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

		// Set up detail parameters
		$this->SetupDetailParms();

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
					$this->Page_Terminate("app_consultation_categorylist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "app_consultation_categorylist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "app_consultation_categoryview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetupDetailParms();
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
	}

	// Load default values
	function LoadDefaultValues() {
		$this->cat_id->CurrentValue = NULL;
		$this->cat_id->OldValue = $this->cat_id->CurrentValue;
		$this->status_id->CurrentValue = NULL;
		$this->status_id->OldValue = $this->status_id->CurrentValue;
		$this->cat_order->CurrentValue = 0;
		$this->cat_name->CurrentValue = NULL;
		$this->cat_name->OldValue = $this->cat_name->CurrentValue;
		$this->cat_Price->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->cat_order->FldIsDetailKey) {
			$this->cat_order->setFormValue($objForm->GetValue("x_cat_order"));
		}
		if (!$this->cat_name->FldIsDetailKey) {
			$this->cat_name->setFormValue($objForm->GetValue("x_cat_name"));
		}
		if (!$this->cat_Price->FldIsDetailKey) {
			$this->cat_Price->setFormValue($objForm->GetValue("x_cat_Price"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->cat_order->CurrentValue = $this->cat_order->FormValue;
		$this->cat_name->CurrentValue = $this->cat_name->FormValue;
		$this->cat_Price->CurrentValue = $this->cat_Price->FormValue;
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
		$this->cat_id->setDbValue($row['cat_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->cat_order->setDbValue($row['cat_order']);
		$this->cat_name->setDbValue($row['cat_name']);
		$this->cat_Price->setDbValue($row['cat_Price']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['cat_id'] = $this->cat_id->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['cat_order'] = $this->cat_order->CurrentValue;
		$row['cat_name'] = $this->cat_name->CurrentValue;
		$row['cat_Price'] = $this->cat_Price->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->cat_id->DbValue = $row['cat_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->cat_order->DbValue = $row['cat_order'];
		$this->cat_name->DbValue = $row['cat_name'];
		$this->cat_Price->DbValue = $row['cat_Price'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("cat_id")) <> "")
			$this->cat_id->CurrentValue = $this->getKey("cat_id"); // cat_id
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
		// Convert decimal values if posted back

		if ($this->cat_Price->FormValue == $this->cat_Price->CurrentValue && is_numeric(ew_StrToFloat($this->cat_Price->CurrentValue)))
			$this->cat_Price->CurrentValue = ew_StrToFloat($this->cat_Price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// cat_id
		// status_id
		// cat_order
		// cat_name
		// cat_Price

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// cat_id
		$this->cat_id->ViewValue = $this->cat_id->CurrentValue;
		$this->cat_id->ViewCustomAttributes = "";

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

		// cat_order
		$this->cat_order->ViewValue = $this->cat_order->CurrentValue;
		$this->cat_order->ViewCustomAttributes = "";

		// cat_name
		$this->cat_name->ViewValue = $this->cat_name->CurrentValue;
		$this->cat_name->ViewCustomAttributes = "";

		// cat_Price
		$this->cat_Price->ViewValue = $this->cat_Price->CurrentValue;
		$this->cat_Price->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// cat_order
			$this->cat_order->LinkCustomAttributes = "";
			$this->cat_order->HrefValue = "";
			$this->cat_order->TooltipValue = "";

			// cat_name
			$this->cat_name->LinkCustomAttributes = "";
			$this->cat_name->HrefValue = "";
			$this->cat_name->TooltipValue = "";

			// cat_Price
			$this->cat_Price->LinkCustomAttributes = "";
			$this->cat_Price->HrefValue = "";
			$this->cat_Price->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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

			// cat_order
			$this->cat_order->EditAttrs["class"] = "form-control";
			$this->cat_order->EditCustomAttributes = "";
			$this->cat_order->EditValue = ew_HtmlEncode($this->cat_order->CurrentValue);
			$this->cat_order->PlaceHolder = ew_RemoveHtml($this->cat_order->FldCaption());

			// cat_name
			$this->cat_name->EditAttrs["class"] = "form-control";
			$this->cat_name->EditCustomAttributes = "";
			$this->cat_name->EditValue = ew_HtmlEncode($this->cat_name->CurrentValue);
			$this->cat_name->PlaceHolder = ew_RemoveHtml($this->cat_name->FldCaption());

			// cat_Price
			$this->cat_Price->EditAttrs["class"] = "form-control";
			$this->cat_Price->EditCustomAttributes = "";
			$this->cat_Price->EditValue = ew_HtmlEncode($this->cat_Price->CurrentValue);
			$this->cat_Price->PlaceHolder = ew_RemoveHtml($this->cat_Price->FldCaption());
			if (strval($this->cat_Price->EditValue) <> "" && is_numeric($this->cat_Price->EditValue)) $this->cat_Price->EditValue = ew_FormatNumber($this->cat_Price->EditValue, -2, -1, -2, 0);

			// Add refer script
			// status_id

			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// cat_order
			$this->cat_order->LinkCustomAttributes = "";
			$this->cat_order->HrefValue = "";

			// cat_name
			$this->cat_name->LinkCustomAttributes = "";
			$this->cat_name->HrefValue = "";

			// cat_Price
			$this->cat_Price->LinkCustomAttributes = "";
			$this->cat_Price->HrefValue = "";
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
		if (!ew_CheckInteger($this->cat_order->FormValue)) {
			ew_AddMessage($gsFormError, $this->cat_order->FldErrMsg());
		}
		if (!$this->cat_name->FldIsDetailKey && !is_null($this->cat_name->FormValue) && $this->cat_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cat_name->FldCaption(), $this->cat_name->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->cat_Price->FormValue)) {
			ew_AddMessage($gsFormError, $this->cat_Price->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("app_consultation_category_name", $DetailTblVar) && $GLOBALS["app_consultation_category_name"]->DetailAdd) {
			if (!isset($GLOBALS["app_consultation_category_name_grid"])) $GLOBALS["app_consultation_category_name_grid"] = new capp_consultation_category_name_grid(); // get detail page object
			$GLOBALS["app_consultation_category_name_grid"]->ValidateGridForm();
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
		if ($this->cat_name->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(cat_name = '" . ew_AdjustSql($this->cat_name->CurrentValue, $this->DBID) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->cat_name->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->cat_name->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// status_id
		$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, strval($this->status_id->CurrentValue) == "");

		// cat_order
		$this->cat_order->SetDbValueDef($rsnew, $this->cat_order->CurrentValue, 0, strval($this->cat_order->CurrentValue) == "");

		// cat_name
		$this->cat_name->SetDbValueDef($rsnew, $this->cat_name->CurrentValue, "", FALSE);

		// cat_Price
		$this->cat_Price->SetDbValueDef($rsnew, $this->cat_Price->CurrentValue, 0, strval($this->cat_Price->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
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

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("app_consultation_category_name", $DetailTblVar) && $GLOBALS["app_consultation_category_name"]->DetailAdd) {
				$GLOBALS["app_consultation_category_name"]->cat_id->setSessionValue($this->cat_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["app_consultation_category_name_grid"])) $GLOBALS["app_consultation_category_name_grid"] = new capp_consultation_category_name_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "app_consultation_category_name"); // Load user level of detail table
				$AddRow = $GLOBALS["app_consultation_category_name_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["app_consultation_category_name"]->cat_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("app_consultation_category_name", $DetailTblVar)) {
				if (!isset($GLOBALS["app_consultation_category_name_grid"]))
					$GLOBALS["app_consultation_category_name_grid"] = new capp_consultation_category_name_grid;
				if ($GLOBALS["app_consultation_category_name_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["app_consultation_category_name_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["app_consultation_category_name_grid"]->CurrentMode = "add";
					$GLOBALS["app_consultation_category_name_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["app_consultation_category_name_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["app_consultation_category_name_grid"]->setStartRecordNumber(1);
					$GLOBALS["app_consultation_category_name_grid"]->cat_id->FldIsDetailKey = TRUE;
					$GLOBALS["app_consultation_category_name_grid"]->cat_id->CurrentValue = $this->cat_id->CurrentValue;
					$GLOBALS["app_consultation_category_name_grid"]->cat_id->setSessionValue($GLOBALS["app_consultation_category_name_grid"]->cat_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_consultation_categorylist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($app_consultation_category_add)) $app_consultation_category_add = new capp_consultation_category_add();

// Page init
$app_consultation_category_add->Page_Init();

// Page main
$app_consultation_category_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consultation_category_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fapp_consultation_categoryadd = new ew_Form("fapp_consultation_categoryadd", "add");

// Validate form
fapp_consultation_categoryadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_cat_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_consultation_category->cat_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_cat_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_consultation_category->cat_name->FldCaption(), $app_consultation_category->cat_name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cat_Price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_consultation_category->cat_Price->FldErrMsg()) ?>");

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
fapp_consultation_categoryadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consultation_categoryadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consultation_categoryadd.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_consultation_categoryadd.Lists["x_status_id"].Data = "<?php echo $app_consultation_category_add->status_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_consultation_category_add->ShowPageHeader(); ?>
<?php
$app_consultation_category_add->ShowMessage();
?>
<form name="fapp_consultation_categoryadd" id="fapp_consultation_categoryadd" class="<?php echo $app_consultation_category_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_consultation_category_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_consultation_category_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_consultation_category">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($app_consultation_category_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($app_consultation_category->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_app_consultation_category_status_id" for="x_status_id" class="<?php echo $app_consultation_category_add->LeftColumnClass ?>"><?php echo $app_consultation_category->status_id->FldCaption() ?></label>
		<div class="<?php echo $app_consultation_category_add->RightColumnClass ?>"><div<?php echo $app_consultation_category->status_id->CellAttributes() ?>>
<span id="el_app_consultation_category_status_id">
<select data-table="app_consultation_category" data-field="x_status_id" data-value-separator="<?php echo $app_consultation_category->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $app_consultation_category->status_id->EditAttributes() ?>>
<?php echo $app_consultation_category->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $app_consultation_category->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation_category->cat_order->Visible) { // cat_order ?>
	<div id="r_cat_order" class="form-group">
		<label id="elh_app_consultation_category_cat_order" for="x_cat_order" class="<?php echo $app_consultation_category_add->LeftColumnClass ?>"><?php echo $app_consultation_category->cat_order->FldCaption() ?></label>
		<div class="<?php echo $app_consultation_category_add->RightColumnClass ?>"><div<?php echo $app_consultation_category->cat_order->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_order">
<input type="text" data-table="app_consultation_category" data-field="x_cat_order" name="x_cat_order" id="x_cat_order" size="30" placeholder="<?php echo ew_HtmlEncode($app_consultation_category->cat_order->getPlaceHolder()) ?>" value="<?php echo $app_consultation_category->cat_order->EditValue ?>"<?php echo $app_consultation_category->cat_order->EditAttributes() ?>>
</span>
<?php echo $app_consultation_category->cat_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation_category->cat_name->Visible) { // cat_name ?>
	<div id="r_cat_name" class="form-group">
		<label id="elh_app_consultation_category_cat_name" for="x_cat_name" class="<?php echo $app_consultation_category_add->LeftColumnClass ?>"><?php echo $app_consultation_category->cat_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_consultation_category_add->RightColumnClass ?>"><div<?php echo $app_consultation_category->cat_name->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_name">
<input type="text" data-table="app_consultation_category" data-field="x_cat_name" name="x_cat_name" id="x_cat_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation_category->cat_name->getPlaceHolder()) ?>" value="<?php echo $app_consultation_category->cat_name->EditValue ?>"<?php echo $app_consultation_category->cat_name->EditAttributes() ?>>
</span>
<?php echo $app_consultation_category->cat_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_consultation_category->cat_Price->Visible) { // cat_Price ?>
	<div id="r_cat_Price" class="form-group">
		<label id="elh_app_consultation_category_cat_Price" for="x_cat_Price" class="<?php echo $app_consultation_category_add->LeftColumnClass ?>"><?php echo $app_consultation_category->cat_Price->FldCaption() ?></label>
		<div class="<?php echo $app_consultation_category_add->RightColumnClass ?>"><div<?php echo $app_consultation_category->cat_Price->CellAttributes() ?>>
<span id="el_app_consultation_category_cat_Price">
<input type="text" data-table="app_consultation_category" data-field="x_cat_Price" name="x_cat_Price" id="x_cat_Price" size="30" placeholder="<?php echo ew_HtmlEncode($app_consultation_category->cat_Price->getPlaceHolder()) ?>" value="<?php echo $app_consultation_category->cat_Price->EditValue ?>"<?php echo $app_consultation_category->cat_Price->EditAttributes() ?>>
</span>
<?php echo $app_consultation_category->cat_Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("app_consultation_category_name", explode(",", $app_consultation_category->getCurrentDetailTable())) && $app_consultation_category_name->DetailAdd) {
?>
<?php if ($app_consultation_category->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("app_consultation_category_name", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "app_consultation_category_namegrid.php" ?>
<?php } ?>
<?php if (!$app_consultation_category_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_consultation_category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_consultation_category_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_consultation_categoryadd.Init();
</script>
<?php
$app_consultation_category_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_consultation_category_add->Page_Terminate();
?>
