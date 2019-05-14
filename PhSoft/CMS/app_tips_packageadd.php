<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_tips_packageinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_tips_package_add = NULL; // Initialize page object first

class capp_tips_package_add extends capp_tips_package {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_tips_package';

	// Page object name
	var $PageObjName = 'app_tips_package_add';

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

		// Table object (app_tips_package)
		if (!isset($GLOBALS["app_tips_package"]) || get_class($GLOBALS["app_tips_package"]) == "capp_tips_package") {
			$GLOBALS["app_tips_package"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_tips_package"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_tips_package', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_tips_packagelist.php"));
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
		$this->cycle_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->pkg_order->SetVisibility();
		$this->pkg_name->SetVisibility();
		$this->pkg_price->SetVisibility();

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
		global $EW_EXPORT, $app_tips_package;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_tips_package);
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
					if ($pageName == "app_tips_packageview.php")
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
			if (@$_GET["pkg_id"] != "") {
				$this->pkg_id->setQueryStringValue($_GET["pkg_id"]);
				$this->setKey("pkg_id", $this->pkg_id->CurrentValue); // Set up key
			} else {
				$this->setKey("pkg_id", ""); // Clear key
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
					$this->Page_Terminate("app_tips_packagelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "app_tips_packagelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "app_tips_packageview.php")
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
	}

	// Load default values
	function LoadDefaultValues() {
		$this->pkg_id->CurrentValue = NULL;
		$this->pkg_id->OldValue = $this->pkg_id->CurrentValue;
		$this->cycle_id->CurrentValue = NULL;
		$this->cycle_id->OldValue = $this->cycle_id->CurrentValue;
		$this->status_id->CurrentValue = 1;
		$this->pkg_order->CurrentValue = 0;
		$this->pkg_name->CurrentValue = NULL;
		$this->pkg_name->OldValue = $this->pkg_name->CurrentValue;
		$this->pkg_price->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->cycle_id->FldIsDetailKey) {
			$this->cycle_id->setFormValue($objForm->GetValue("x_cycle_id"));
		}
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->pkg_order->FldIsDetailKey) {
			$this->pkg_order->setFormValue($objForm->GetValue("x_pkg_order"));
		}
		if (!$this->pkg_name->FldIsDetailKey) {
			$this->pkg_name->setFormValue($objForm->GetValue("x_pkg_name"));
		}
		if (!$this->pkg_price->FldIsDetailKey) {
			$this->pkg_price->setFormValue($objForm->GetValue("x_pkg_price"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->cycle_id->CurrentValue = $this->cycle_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->pkg_order->CurrentValue = $this->pkg_order->FormValue;
		$this->pkg_name->CurrentValue = $this->pkg_name->FormValue;
		$this->pkg_price->CurrentValue = $this->pkg_price->FormValue;
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
		$this->pkg_id->setDbValue($row['pkg_id']);
		$this->cycle_id->setDbValue($row['cycle_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->pkg_order->setDbValue($row['pkg_order']);
		$this->pkg_name->setDbValue($row['pkg_name']);
		$this->pkg_price->setDbValue($row['pkg_price']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['pkg_id'] = $this->pkg_id->CurrentValue;
		$row['cycle_id'] = $this->cycle_id->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['pkg_order'] = $this->pkg_order->CurrentValue;
		$row['pkg_name'] = $this->pkg_name->CurrentValue;
		$row['pkg_price'] = $this->pkg_price->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->pkg_id->DbValue = $row['pkg_id'];
		$this->cycle_id->DbValue = $row['cycle_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->pkg_order->DbValue = $row['pkg_order'];
		$this->pkg_name->DbValue = $row['pkg_name'];
		$this->pkg_price->DbValue = $row['pkg_price'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("pkg_id")) <> "")
			$this->pkg_id->CurrentValue = $this->getKey("pkg_id"); // pkg_id
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

		if ($this->pkg_price->FormValue == $this->pkg_price->CurrentValue && is_numeric(ew_StrToFloat($this->pkg_price->CurrentValue)))
			$this->pkg_price->CurrentValue = ew_StrToFloat($this->pkg_price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// pkg_id
		// cycle_id
		// status_id
		// pkg_order
		// pkg_name
		// pkg_price

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// cycle_id
		if (strval($this->cycle_id->CurrentValue) <> "") {
			$sFilterWrk = "`cycle_id`" . ew_SearchString("=", $this->cycle_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cycle_id`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_bill_cycle`";
		$sWhereWrk = "";
		$this->cycle_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cycle_id->ViewValue = $this->cycle_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cycle_id->ViewValue = $this->cycle_id->CurrentValue;
			}
		} else {
			$this->cycle_id->ViewValue = NULL;
		}
		$this->cycle_id->ViewCustomAttributes = "";

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

		// pkg_order
		$this->pkg_order->ViewValue = $this->pkg_order->CurrentValue;
		$this->pkg_order->ViewCustomAttributes = "";

		// pkg_name
		$this->pkg_name->ViewValue = $this->pkg_name->CurrentValue;
		$this->pkg_name->ViewCustomAttributes = "";

		// pkg_price
		$this->pkg_price->ViewValue = $this->pkg_price->CurrentValue;
		$this->pkg_price->ViewCustomAttributes = "";

			// cycle_id
			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";
			$this->cycle_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// pkg_order
			$this->pkg_order->LinkCustomAttributes = "";
			$this->pkg_order->HrefValue = "";
			$this->pkg_order->TooltipValue = "";

			// pkg_name
			$this->pkg_name->LinkCustomAttributes = "";
			$this->pkg_name->HrefValue = "";
			$this->pkg_name->TooltipValue = "";

			// pkg_price
			$this->pkg_price->LinkCustomAttributes = "";
			$this->pkg_price->HrefValue = "";
			$this->pkg_price->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// cycle_id
			$this->cycle_id->EditAttrs["class"] = "form-control";
			$this->cycle_id->EditCustomAttributes = "";
			if (trim(strval($this->cycle_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cycle_id`" . ew_SearchString("=", $this->cycle_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cycle_id`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_bill_cycle`";
			$sWhereWrk = "";
			$this->cycle_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cycle_id->EditValue = $arwrk;

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

			// pkg_order
			$this->pkg_order->EditAttrs["class"] = "form-control";
			$this->pkg_order->EditCustomAttributes = "";
			$this->pkg_order->EditValue = ew_HtmlEncode($this->pkg_order->CurrentValue);
			$this->pkg_order->PlaceHolder = ew_RemoveHtml($this->pkg_order->FldCaption());

			// pkg_name
			$this->pkg_name->EditAttrs["class"] = "form-control";
			$this->pkg_name->EditCustomAttributes = "";
			$this->pkg_name->EditValue = ew_HtmlEncode($this->pkg_name->CurrentValue);
			$this->pkg_name->PlaceHolder = ew_RemoveHtml($this->pkg_name->FldCaption());

			// pkg_price
			$this->pkg_price->EditAttrs["class"] = "form-control";
			$this->pkg_price->EditCustomAttributes = "";
			$this->pkg_price->EditValue = ew_HtmlEncode($this->pkg_price->CurrentValue);
			$this->pkg_price->PlaceHolder = ew_RemoveHtml($this->pkg_price->FldCaption());
			if (strval($this->pkg_price->EditValue) <> "" && is_numeric($this->pkg_price->EditValue)) $this->pkg_price->EditValue = ew_FormatNumber($this->pkg_price->EditValue, -2, -1, -2, 0);

			// Add refer script
			// cycle_id

			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// pkg_order
			$this->pkg_order->LinkCustomAttributes = "";
			$this->pkg_order->HrefValue = "";

			// pkg_name
			$this->pkg_name->LinkCustomAttributes = "";
			$this->pkg_name->HrefValue = "";

			// pkg_price
			$this->pkg_price->LinkCustomAttributes = "";
			$this->pkg_price->HrefValue = "";
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
		if (!$this->cycle_id->FldIsDetailKey && !is_null($this->cycle_id->FormValue) && $this->cycle_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cycle_id->FldCaption(), $this->cycle_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->pkg_order->FormValue)) {
			ew_AddMessage($gsFormError, $this->pkg_order->FldErrMsg());
		}
		if (!$this->pkg_name->FldIsDetailKey && !is_null($this->pkg_name->FormValue) && $this->pkg_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pkg_name->FldCaption(), $this->pkg_name->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->pkg_price->FormValue)) {
			ew_AddMessage($gsFormError, $this->pkg_price->FldErrMsg());
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
		}
		$rsnew = array();

		// cycle_id
		$this->cycle_id->SetDbValueDef($rsnew, $this->cycle_id->CurrentValue, 0, FALSE);

		// status_id
		$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, 0, strval($this->status_id->CurrentValue) == "");

		// pkg_order
		$this->pkg_order->SetDbValueDef($rsnew, $this->pkg_order->CurrentValue, 0, strval($this->pkg_order->CurrentValue) == "");

		// pkg_name
		$this->pkg_name->SetDbValueDef($rsnew, $this->pkg_name->CurrentValue, "", FALSE);

		// pkg_price
		$this->pkg_price->SetDbValueDef($rsnew, $this->pkg_price->CurrentValue, 0, strval($this->pkg_price->CurrentValue) == "");

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
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_tips_packagelist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_cycle_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cycle_id` AS `LinkFld`, `cycle_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_bill_cycle`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cycle_id` IN ({filter_value})', "t0" => "2", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cycle_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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
if (!isset($app_tips_package_add)) $app_tips_package_add = new capp_tips_package_add();

// Page init
$app_tips_package_add->Page_Init();

// Page main
$app_tips_package_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_tips_package_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fapp_tips_packageadd = new ew_Form("fapp_tips_packageadd", "add");

// Validate form
fapp_tips_packageadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_cycle_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips_package->cycle_id->FldCaption(), $app_tips_package->cycle_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_pkg_order");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_tips_package->pkg_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_pkg_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $app_tips_package->pkg_name->FldCaption(), $app_tips_package->pkg_name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_pkg_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($app_tips_package->pkg_price->FldErrMsg()) ?>");

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
fapp_tips_packageadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_tips_packageadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_tips_packageadd.Lists["x_cycle_id"] = {"LinkField":"x_cycle_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cycle_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_bill_cycle"};
fapp_tips_packageadd.Lists["x_cycle_id"].Data = "<?php echo $app_tips_package_add->cycle_id->LookupFilterQuery(FALSE, "add") ?>";
fapp_tips_packageadd.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fapp_tips_packageadd.Lists["x_status_id"].Data = "<?php echo $app_tips_package_add->status_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_tips_package_add->ShowPageHeader(); ?>
<?php
$app_tips_package_add->ShowMessage();
?>
<form name="fapp_tips_packageadd" id="fapp_tips_packageadd" class="<?php echo $app_tips_package_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_tips_package_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_tips_package_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_tips_package">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($app_tips_package_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($app_tips_package->cycle_id->Visible) { // cycle_id ?>
	<div id="r_cycle_id" class="form-group">
		<label id="elh_app_tips_package_cycle_id" for="x_cycle_id" class="<?php echo $app_tips_package_add->LeftColumnClass ?>"><?php echo $app_tips_package->cycle_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_tips_package_add->RightColumnClass ?>"><div<?php echo $app_tips_package->cycle_id->CellAttributes() ?>>
<span id="el_app_tips_package_cycle_id">
<select data-table="app_tips_package" data-field="x_cycle_id" data-value-separator="<?php echo $app_tips_package->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x_cycle_id" name="x_cycle_id"<?php echo $app_tips_package->cycle_id->EditAttributes() ?>>
<?php echo $app_tips_package->cycle_id->SelectOptionListHtml("x_cycle_id") ?>
</select>
</span>
<?php echo $app_tips_package->cycle_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_tips_package->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_app_tips_package_status_id" for="x_status_id" class="<?php echo $app_tips_package_add->LeftColumnClass ?>"><?php echo $app_tips_package->status_id->FldCaption() ?></label>
		<div class="<?php echo $app_tips_package_add->RightColumnClass ?>"><div<?php echo $app_tips_package->status_id->CellAttributes() ?>>
<span id="el_app_tips_package_status_id">
<select data-table="app_tips_package" data-field="x_status_id" data-value-separator="<?php echo $app_tips_package->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $app_tips_package->status_id->EditAttributes() ?>>
<?php echo $app_tips_package->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
<?php echo $app_tips_package->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_tips_package->pkg_order->Visible) { // pkg_order ?>
	<div id="r_pkg_order" class="form-group">
		<label id="elh_app_tips_package_pkg_order" for="x_pkg_order" class="<?php echo $app_tips_package_add->LeftColumnClass ?>"><?php echo $app_tips_package->pkg_order->FldCaption() ?></label>
		<div class="<?php echo $app_tips_package_add->RightColumnClass ?>"><div<?php echo $app_tips_package->pkg_order->CellAttributes() ?>>
<span id="el_app_tips_package_pkg_order">
<input type="text" data-table="app_tips_package" data-field="x_pkg_order" name="x_pkg_order" id="x_pkg_order" size="30" placeholder="<?php echo ew_HtmlEncode($app_tips_package->pkg_order->getPlaceHolder()) ?>" value="<?php echo $app_tips_package->pkg_order->EditValue ?>"<?php echo $app_tips_package->pkg_order->EditAttributes() ?>>
</span>
<?php echo $app_tips_package->pkg_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_tips_package->pkg_name->Visible) { // pkg_name ?>
	<div id="r_pkg_name" class="form-group">
		<label id="elh_app_tips_package_pkg_name" for="x_pkg_name" class="<?php echo $app_tips_package_add->LeftColumnClass ?>"><?php echo $app_tips_package->pkg_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $app_tips_package_add->RightColumnClass ?>"><div<?php echo $app_tips_package->pkg_name->CellAttributes() ?>>
<span id="el_app_tips_package_pkg_name">
<input type="text" data-table="app_tips_package" data-field="x_pkg_name" name="x_pkg_name" id="x_pkg_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_tips_package->pkg_name->getPlaceHolder()) ?>" value="<?php echo $app_tips_package->pkg_name->EditValue ?>"<?php echo $app_tips_package->pkg_name->EditAttributes() ?>>
</span>
<?php echo $app_tips_package->pkg_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($app_tips_package->pkg_price->Visible) { // pkg_price ?>
	<div id="r_pkg_price" class="form-group">
		<label id="elh_app_tips_package_pkg_price" for="x_pkg_price" class="<?php echo $app_tips_package_add->LeftColumnClass ?>"><?php echo $app_tips_package->pkg_price->FldCaption() ?></label>
		<div class="<?php echo $app_tips_package_add->RightColumnClass ?>"><div<?php echo $app_tips_package->pkg_price->CellAttributes() ?>>
<span id="el_app_tips_package_pkg_price">
<input type="text" data-table="app_tips_package" data-field="x_pkg_price" name="x_pkg_price" id="x_pkg_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_tips_package->pkg_price->getPlaceHolder()) ?>" value="<?php echo $app_tips_package->pkg_price->EditValue ?>"<?php echo $app_tips_package->pkg_price->EditAttributes() ?>>
</span>
<?php echo $app_tips_package->pkg_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_tips_package_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_tips_package_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $app_tips_package_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_tips_packageadd.Init();
</script>
<?php
$app_tips_package_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_tips_package_add->Page_Terminate();
?>
