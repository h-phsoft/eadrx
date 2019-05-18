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

$cpy_faq_delete = NULL; // Initialize page object first

class ccpy_faq_delete extends ccpy_faq {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_faq';

	// Page object name
	var $PageObjName = 'cpy_faq_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("cpy_faqlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in cpy_faq class, cpy_faqinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("cpy_faqlist.php"); // Return to list
			}
		}
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

		$this->faq_id->CellCssStyle = "white-space: nowrap;";

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['faq_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
			if ($sMasterTblVar == "cpy_faq_category") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_fcat_id"] <> "") {
					$GLOBALS["cpy_faq_category"]->fcat_id->setQueryStringValue($_GET["fk_fcat_id"]);
					$this->fcat_id->setQueryStringValue($GLOBALS["cpy_faq_category"]->fcat_id->QueryStringValue);
					$this->fcat_id->setSessionValue($this->fcat_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_faq_category"]->fcat_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_faq_category") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_fcat_id"] <> "") {
					$GLOBALS["cpy_faq_category"]->fcat_id->setFormValue($_POST["fk_fcat_id"]);
					$this->fcat_id->setFormValue($GLOBALS["cpy_faq_category"]->fcat_id->FormValue);
					$this->fcat_id->setSessionValue($this->fcat_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_faq_category"]->fcat_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cpy_faq_category") {
				if ($this->fcat_id->CurrentValue == "") $this->fcat_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_faqlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_faq_delete)) $cpy_faq_delete = new ccpy_faq_delete();

// Page init
$cpy_faq_delete->Page_Init();

// Page main
$cpy_faq_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_faq_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fcpy_faqdelete = new ew_Form("fcpy_faqdelete", "delete");

// Form_CustomValidate event
fcpy_faqdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_faqdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_faqdelete.Lists["x_fcat_id"] = {"LinkField":"x_fcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_fcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_faq_category"};
fcpy_faqdelete.Lists["x_fcat_id"].Data = "<?php echo $cpy_faq_delete->fcat_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_faqdelete.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_faqdelete.Lists["x_status_id"].Data = "<?php echo $cpy_faq_delete->status_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_faqdelete.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_faqdelete.Lists["x_lang_id"].Data = "<?php echo $cpy_faq_delete->lang_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_faqdelete.Lists["x_color_id"] = {"LinkField":"x_color_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_color_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_color"};
fcpy_faqdelete.Lists["x_color_id"].Data = "<?php echo $cpy_faq_delete->color_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_faq_delete->ShowPageHeader(); ?>
<?php
$cpy_faq_delete->ShowMessage();
?>
<form name="fcpy_faqdelete" id="fcpy_faqdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_faq_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_faq_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_faq">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cpy_faq_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($cpy_faq->fcat_id->Visible) { // fcat_id ?>
		<th class="<?php echo $cpy_faq->fcat_id->HeaderCellClass() ?>"><span id="elh_cpy_faq_fcat_id" class="cpy_faq_fcat_id"><?php echo $cpy_faq->fcat_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_faq->status_id->Visible) { // status_id ?>
		<th class="<?php echo $cpy_faq->status_id->HeaderCellClass() ?>"><span id="elh_cpy_faq_status_id" class="cpy_faq_status_id"><?php echo $cpy_faq->status_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_faq->lang_id->Visible) { // lang_id ?>
		<th class="<?php echo $cpy_faq->lang_id->HeaderCellClass() ?>"><span id="elh_cpy_faq_lang_id" class="cpy_faq_lang_id"><?php echo $cpy_faq->lang_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_faq->color_id->Visible) { // color_id ?>
		<th class="<?php echo $cpy_faq->color_id->HeaderCellClass() ?>"><span id="elh_cpy_faq_color_id" class="cpy_faq_color_id"><?php echo $cpy_faq->color_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_faq->faq_order->Visible) { // faq_order ?>
		<th class="<?php echo $cpy_faq->faq_order->HeaderCellClass() ?>"><span id="elh_cpy_faq_faq_order" class="cpy_faq_faq_order"><?php echo $cpy_faq->faq_order->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_faq->faq_title->Visible) { // faq_title ?>
		<th class="<?php echo $cpy_faq->faq_title->HeaderCellClass() ?>"><span id="elh_cpy_faq_faq_title" class="cpy_faq_faq_title"><?php echo $cpy_faq->faq_title->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_faq->faq_text->Visible) { // faq_text ?>
		<th class="<?php echo $cpy_faq->faq_text->HeaderCellClass() ?>"><span id="elh_cpy_faq_faq_text" class="cpy_faq_faq_text"><?php echo $cpy_faq->faq_text->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cpy_faq_delete->RecCnt = 0;
$i = 0;
while (!$cpy_faq_delete->Recordset->EOF) {
	$cpy_faq_delete->RecCnt++;
	$cpy_faq_delete->RowCnt++;

	// Set row properties
	$cpy_faq->ResetAttrs();
	$cpy_faq->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cpy_faq_delete->LoadRowValues($cpy_faq_delete->Recordset);

	// Render row
	$cpy_faq_delete->RenderRow();
?>
	<tr<?php echo $cpy_faq->RowAttributes() ?>>
<?php if ($cpy_faq->fcat_id->Visible) { // fcat_id ?>
		<td<?php echo $cpy_faq->fcat_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_fcat_id" class="cpy_faq_fcat_id">
<span<?php echo $cpy_faq->fcat_id->ViewAttributes() ?>>
<?php echo $cpy_faq->fcat_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_faq->status_id->Visible) { // status_id ?>
		<td<?php echo $cpy_faq->status_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_status_id" class="cpy_faq_status_id">
<span<?php echo $cpy_faq->status_id->ViewAttributes() ?>>
<?php echo $cpy_faq->status_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_faq->lang_id->Visible) { // lang_id ?>
		<td<?php echo $cpy_faq->lang_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_lang_id" class="cpy_faq_lang_id">
<span<?php echo $cpy_faq->lang_id->ViewAttributes() ?>>
<?php echo $cpy_faq->lang_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_faq->color_id->Visible) { // color_id ?>
		<td<?php echo $cpy_faq->color_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_color_id" class="cpy_faq_color_id">
<span<?php echo $cpy_faq->color_id->ViewAttributes() ?>>
<?php echo $cpy_faq->color_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_faq->faq_order->Visible) { // faq_order ?>
		<td<?php echo $cpy_faq->faq_order->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_faq_order" class="cpy_faq_faq_order">
<span<?php echo $cpy_faq->faq_order->ViewAttributes() ?>>
<?php echo $cpy_faq->faq_order->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_faq->faq_title->Visible) { // faq_title ?>
		<td<?php echo $cpy_faq->faq_title->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_faq_title" class="cpy_faq_faq_title">
<span<?php echo $cpy_faq->faq_title->ViewAttributes() ?>>
<?php echo $cpy_faq->faq_title->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_faq->faq_text->Visible) { // faq_text ?>
		<td<?php echo $cpy_faq->faq_text->CellAttributes() ?>>
<span id="el<?php echo $cpy_faq_delete->RowCnt ?>_cpy_faq_faq_text" class="cpy_faq_faq_text">
<span<?php echo $cpy_faq->faq_text->ViewAttributes() ?>>
<?php echo $cpy_faq->faq_text->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cpy_faq_delete->Recordset->MoveNext();
}
$cpy_faq_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_faq_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fcpy_faqdelete.Init();
</script>
<?php
$cpy_faq_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_faq_delete->Page_Terminate();
?>
