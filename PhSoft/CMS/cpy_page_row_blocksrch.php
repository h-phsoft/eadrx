<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_page_row_blockinfo.php" ?>
<?php include_once "cpy_page_rowinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_page_row_block_search = NULL; // Initialize page object first

class ccpy_page_row_block_search extends ccpy_page_row_block {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_page_row_block';

	// Page object name
	var $PageObjName = 'cpy_page_row_block_search';

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

		// Table object (cpy_page_row_block)
		if (!isset($GLOBALS["cpy_page_row_block"]) || get_class($GLOBALS["cpy_page_row_block"]) == "ccpy_page_row_block") {
			$GLOBALS["cpy_page_row_block"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_page_row_block"];
		}

		// Table object (cpy_page_row)
		if (!isset($GLOBALS['cpy_page_row'])) $GLOBALS['cpy_page_row'] = new ccpy_page_row();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_page_row_block', TRUE);

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("cpy_page_row_blocklist.php"));
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
		$this->row_id->SetVisibility();
		$this->type_id->SetVisibility();
		$this->slid_id->SetVisibility();
		$this->video_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->cols_id->SetVisibility();
		$this->blk_order->SetVisibility();
		$this->blk_name->SetVisibility();
		$this->blk_header->SetVisibility();
		$this->blk_image->SetVisibility();
		$this->blk_stext->SetVisibility();
		$this->blk_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_page_row_block;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_page_row_block);
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
					if ($pageName == "cpy_page_row_blockview.php")
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
	var $FormClassName = "form-horizontal ewForm ewSearchForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError;
		global $gbSkipHeaderFooter;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = $objForm->GetValue("a_search");
			switch ($this->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $this->UrlParm($sSrchStr);
						$sSrchStr = "cpy_page_row_blocklist.php" . "?" . $sSrchStr;
						$this->Page_Terminate($sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$this->RowType = EW_ROWTYPE_SEARCH;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Build advanced search
	function BuildAdvancedSearch() {
		$sSrchUrl = "";
		$this->BuildSearchUrl($sSrchUrl, $this->row_id); // row_id
		$this->BuildSearchUrl($sSrchUrl, $this->type_id); // type_id
		$this->BuildSearchUrl($sSrchUrl, $this->slid_id); // slid_id
		$this->BuildSearchUrl($sSrchUrl, $this->video_id); // video_id
		$this->BuildSearchUrl($sSrchUrl, $this->status_id); // status_id
		$this->BuildSearchUrl($sSrchUrl, $this->cols_id); // cols_id
		$this->BuildSearchUrl($sSrchUrl, $this->blk_order); // blk_order
		$this->BuildSearchUrl($sSrchUrl, $this->blk_name); // blk_name
		$this->BuildSearchUrl($sSrchUrl, $this->blk_header); // blk_header
		$this->BuildSearchUrl($sSrchUrl, $this->blk_image); // blk_image
		$this->BuildSearchUrl($sSrchUrl, $this->blk_stext); // blk_stext
		$this->BuildSearchUrl($sSrchUrl, $this->blk_text); // blk_text
		if ($sSrchUrl <> "") $sSrchUrl .= "&";
		$sSrchUrl .= "cmd=search";
		return $sSrchUrl;
	}

	// Build search URL
	function BuildSearchUrl(&$Url, &$Fld, $OprOnly=FALSE) {
		global $objForm;
		$sWrk = "";
		$FldParm = $Fld->FldParm();
		$FldVal = $objForm->GetValue("x_$FldParm");
		$FldOpr = $objForm->GetValue("z_$FldParm");
		$FldCond = $objForm->GetValue("v_$FldParm");
		$FldVal2 = $objForm->GetValue("y_$FldParm");
		$FldOpr2 = $objForm->GetValue("w_$FldParm");
		$FldVal = $FldVal;
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $FldVal2;
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($FldOpr == "BETWEEN") {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal) && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			}
		} else {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal));
			if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL" || ($FldOpr <> "" && $OprOnly && ew_IsValidOpr($FldOpr, $lFldDataType))) {
				$sWrk = "z_" . $FldParm . "=" . urlencode($FldOpr);
			}
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&w_" . $FldParm . "=" . urlencode($FldOpr2);
			} elseif ($FldOpr2 == "IS NULL" || $FldOpr2 == "IS NOT NULL" || ($FldOpr2 <> "" && $OprOnly && ew_IsValidOpr($FldOpr2, $lFldDataType))) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "w_" . $FldParm . "=" . urlencode($FldOpr2);
			}
		}
		if ($sWrk <> "") {
			if ($Url <> "") $Url .= "&";
			$Url .= $sWrk;
		}
	}

	function SearchValueIsNumeric($Fld, $Value) {
		if (ew_IsFloatFormat($Fld->FldType)) $Value = ew_StrToFloat($Value);
		return is_numeric($Value);
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// row_id

		$this->row_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_row_id");
		$this->row_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_row_id");

		// type_id
		$this->type_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_type_id");
		$this->type_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_type_id");

		// slid_id
		$this->slid_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_id");
		$this->slid_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_id");

		// video_id
		$this->video_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_video_id");
		$this->video_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_video_id");

		// status_id
		$this->status_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_status_id");
		$this->status_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status_id");

		// cols_id
		$this->cols_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cols_id");
		$this->cols_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cols_id");

		// blk_order
		$this->blk_order->AdvancedSearch->SearchValue = $objForm->GetValue("x_blk_order");
		$this->blk_order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blk_order");

		// blk_name
		$this->blk_name->AdvancedSearch->SearchValue = $objForm->GetValue("x_blk_name");
		$this->blk_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blk_name");

		// blk_header
		$this->blk_header->AdvancedSearch->SearchValue = $objForm->GetValue("x_blk_header");
		$this->blk_header->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blk_header");

		// blk_image
		$this->blk_image->AdvancedSearch->SearchValue = $objForm->GetValue("x_blk_image");
		$this->blk_image->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blk_image");

		// blk_stext
		$this->blk_stext->AdvancedSearch->SearchValue = $objForm->GetValue("x_blk_stext");
		$this->blk_stext->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blk_stext");

		// blk_text
		$this->blk_text->AdvancedSearch->SearchValue = $objForm->GetValue("x_blk_text");
		$this->blk_text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blk_text");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// blk_id
		// row_id
		// type_id
		// slid_id
		// video_id
		// status_id
		// cols_id
		// blk_order
		// blk_name
		// blk_header
		// blk_image
		// blk_stext
		// blk_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		if (strval($this->row_id->CurrentValue) <> "") {
			$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
		$sWhereWrk = "";
		$this->row_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->row_id->ViewValue = $this->row_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->row_id->ViewValue = $this->row_id->CurrentValue;
			}
		} else {
			$this->row_id->ViewValue = NULL;
		}
		$this->row_id->ViewCustomAttributes = "";

		// type_id
		if (strval($this->type_id->CurrentValue) <> "") {
			$sFilterWrk = "`type_id`" . ew_SearchString("=", $this->type_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `type_id`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_block_type`";
		$sWhereWrk = "";
		$this->type_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `type_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->type_id->ViewValue = $this->type_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->type_id->ViewValue = $this->type_id->CurrentValue;
			}
		} else {
			$this->type_id->ViewValue = NULL;
		}
		$this->type_id->ViewCustomAttributes = "";

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

		// video_id
		if (strval($this->video_id->CurrentValue) <> "") {
			$sFilterWrk = "`video_id`" . ew_SearchString("=", $this->video_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `video_id`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_video`";
		$sWhereWrk = "";
		$this->video_id->LookupFilters = array("dx1" => '`video_name`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `video_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->video_id->ViewValue = $this->video_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->video_id->ViewValue = $this->video_id->CurrentValue;
			}
		} else {
			$this->video_id->ViewValue = NULL;
		}
		$this->video_id->ViewCustomAttributes = "";

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

		// cols_id
		if (strval($this->cols_id->CurrentValue) <> "") {
			$sFilterWrk = "`cols_id`" . ew_SearchString("=", $this->cols_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cols_id`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_cols`";
		$sWhereWrk = "";
		$this->cols_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cols_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cols_id->ViewValue = $this->cols_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cols_id->ViewValue = $this->cols_id->CurrentValue;
			}
		} else {
			$this->cols_id->ViewValue = NULL;
		}
		$this->cols_id->ViewCustomAttributes = "";

		// blk_order
		$this->blk_order->ViewValue = $this->blk_order->CurrentValue;
		$this->blk_order->ViewCustomAttributes = "";

		// blk_name
		$this->blk_name->ViewValue = $this->blk_name->CurrentValue;
		$this->blk_name->ViewCustomAttributes = "";

		// blk_header
		$this->blk_header->ViewValue = $this->blk_header->CurrentValue;
		$this->blk_header->ViewCustomAttributes = "";

		// blk_image
		$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
		if (!ew_Empty($this->blk_image->Upload->DbValue)) {
			$this->blk_image->ImageWidth = 200;
			$this->blk_image->ImageHeight = 0;
			$this->blk_image->ImageAlt = $this->blk_image->FldAlt();
			$this->blk_image->ViewValue = $this->blk_image->Upload->DbValue;
		} else {
			$this->blk_image->ViewValue = "";
		}
		$this->blk_image->ViewCustomAttributes = "";

		// blk_stext
		$this->blk_stext->ViewValue = $this->blk_stext->CurrentValue;
		$this->blk_stext->ViewCustomAttributes = "";

		// blk_text
		$this->blk_text->ViewValue = $this->blk_text->CurrentValue;
		$this->blk_text->ViewCustomAttributes = "";

			// row_id
			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";
			$this->row_id->TooltipValue = "";

			// type_id
			$this->type_id->LinkCustomAttributes = "";
			$this->type_id->HrefValue = "";
			$this->type_id->TooltipValue = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// video_id
			$this->video_id->LinkCustomAttributes = "";
			$this->video_id->HrefValue = "";
			$this->video_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// cols_id
			$this->cols_id->LinkCustomAttributes = "";
			$this->cols_id->HrefValue = "";
			$this->cols_id->TooltipValue = "";

			// blk_order
			$this->blk_order->LinkCustomAttributes = "";
			$this->blk_order->HrefValue = "";
			$this->blk_order->TooltipValue = "";

			// blk_name
			$this->blk_name->LinkCustomAttributes = "";
			$this->blk_name->HrefValue = "";
			$this->blk_name->TooltipValue = "";

			// blk_header
			$this->blk_header->LinkCustomAttributes = "";
			$this->blk_header->HrefValue = "";
			$this->blk_header->TooltipValue = "";

			// blk_image
			$this->blk_image->LinkCustomAttributes = "";
			$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
			if (!ew_Empty($this->blk_image->Upload->DbValue)) {
				$this->blk_image->HrefValue = ew_GetFileUploadUrl($this->blk_image, $this->blk_image->Upload->DbValue); // Add prefix/suffix
				$this->blk_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->blk_image->HrefValue = ew_FullUrl($this->blk_image->HrefValue, "href");
			} else {
				$this->blk_image->HrefValue = "";
			}
			$this->blk_image->HrefValue2 = $this->blk_image->UploadPath . $this->blk_image->Upload->DbValue;
			$this->blk_image->TooltipValue = "";
			if ($this->blk_image->UseColorbox) {
				if (ew_Empty($this->blk_image->TooltipValue))
					$this->blk_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->blk_image->LinkAttrs["data-rel"] = "cpy_page_row_block_x_blk_image";
				ew_AppendClass($this->blk_image->LinkAttrs["class"], "ewLightbox");
			}

			// blk_stext
			$this->blk_stext->LinkCustomAttributes = "";
			$this->blk_stext->HrefValue = "";
			$this->blk_stext->TooltipValue = "";

			// blk_text
			$this->blk_text->LinkCustomAttributes = "";
			$this->blk_text->HrefValue = "";
			$this->blk_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// row_id
			$this->row_id->EditAttrs["class"] = "form-control";
			$this->row_id->EditCustomAttributes = "";
			if (trim(strval($this->row_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_page_row`";
			$sWhereWrk = "";
			$this->row_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->row_id->EditValue = $arwrk;

			// type_id
			$this->type_id->EditAttrs["class"] = "form-control";
			$this->type_id->EditCustomAttributes = "";
			if (trim(strval($this->type_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`type_id`" . ew_SearchString("=", $this->type_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `type_id`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_block_type`";
			$sWhereWrk = "";
			$this->type_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `type_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->type_id->EditValue = $arwrk;

			// slid_id
			$this->slid_id->EditAttrs["class"] = "form-control";
			$this->slid_id->EditCustomAttributes = "";
			if (trim(strval($this->slid_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`slid_id`" . ew_SearchString("=", $this->slid_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
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

			// video_id
			$this->video_id->EditCustomAttributes = "";
			if (trim(strval($this->video_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`video_id`" . ew_SearchString("=", $this->video_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `video_id`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_video`";
			$sWhereWrk = "";
			$this->video_id->LookupFilters = array("dx1" => '`video_name`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `video_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->video_id->AdvancedSearch->ViewValue = $this->video_id->DisplayValue($arwrk);
			} else {
				$this->video_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->video_id->EditValue = $arwrk;

			// status_id
			$this->status_id->EditAttrs["class"] = "form-control";
			$this->status_id->EditCustomAttributes = "";
			if (trim(strval($this->status_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`status_id`" . ew_SearchString("=", $this->status_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
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

			// cols_id
			$this->cols_id->EditAttrs["class"] = "form-control";
			$this->cols_id->EditCustomAttributes = "";
			if (trim(strval($this->cols_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cols_id`" . ew_SearchString("=", $this->cols_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cols_id`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_cols`";
			$sWhereWrk = "";
			$this->cols_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cols_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cols_id->EditValue = $arwrk;

			// blk_order
			$this->blk_order->EditAttrs["class"] = "form-control";
			$this->blk_order->EditCustomAttributes = "";
			$this->blk_order->EditValue = ew_HtmlEncode($this->blk_order->AdvancedSearch->SearchValue);
			$this->blk_order->PlaceHolder = ew_RemoveHtml($this->blk_order->FldCaption());

			// blk_name
			$this->blk_name->EditAttrs["class"] = "form-control";
			$this->blk_name->EditCustomAttributes = "";
			$this->blk_name->EditValue = ew_HtmlEncode($this->blk_name->AdvancedSearch->SearchValue);
			$this->blk_name->PlaceHolder = ew_RemoveHtml($this->blk_name->FldCaption());

			// blk_header
			$this->blk_header->EditAttrs["class"] = "form-control";
			$this->blk_header->EditCustomAttributes = "";
			$this->blk_header->EditValue = ew_HtmlEncode($this->blk_header->AdvancedSearch->SearchValue);
			$this->blk_header->PlaceHolder = ew_RemoveHtml($this->blk_header->FldCaption());

			// blk_image
			$this->blk_image->EditAttrs["class"] = "form-control";
			$this->blk_image->EditCustomAttributes = "";
			$this->blk_image->EditValue = ew_HtmlEncode($this->blk_image->AdvancedSearch->SearchValue);
			$this->blk_image->PlaceHolder = ew_RemoveHtml($this->blk_image->FldCaption());

			// blk_stext
			$this->blk_stext->EditAttrs["class"] = "form-control";
			$this->blk_stext->EditCustomAttributes = "";
			$this->blk_stext->EditValue = ew_HtmlEncode($this->blk_stext->AdvancedSearch->SearchValue);
			$this->blk_stext->PlaceHolder = ew_RemoveHtml($this->blk_stext->FldCaption());

			// blk_text
			$this->blk_text->EditAttrs["class"] = "form-control";
			$this->blk_text->EditCustomAttributes = "";
			$this->blk_text->EditValue = ew_HtmlEncode($this->blk_text->AdvancedSearch->SearchValue);
			$this->blk_text->PlaceHolder = ew_RemoveHtml($this->blk_text->FldCaption());
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($this->blk_order->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->blk_order->FldErrMsg());
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->row_id->AdvancedSearch->Load();
		$this->type_id->AdvancedSearch->Load();
		$this->slid_id->AdvancedSearch->Load();
		$this->video_id->AdvancedSearch->Load();
		$this->status_id->AdvancedSearch->Load();
		$this->cols_id->AdvancedSearch->Load();
		$this->blk_order->AdvancedSearch->Load();
		$this->blk_name->AdvancedSearch->Load();
		$this->blk_header->AdvancedSearch->Load();
		$this->blk_image->AdvancedSearch->Load();
		$this->blk_stext->AdvancedSearch->Load();
		$this->blk_text->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_page_row_blocklist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_row_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `row_id` AS `LinkFld`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`row_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `row_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_type_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `type_id` AS `LinkFld`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_block_type`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`type_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `type_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
		case "x_video_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `video_id` AS `LinkFld`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_video`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`video_name`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`video_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `video_name`";
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
		case "x_cols_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cols_id` AS `LinkFld`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_cols`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cols_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cols_id`";
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
if (!isset($cpy_page_row_block_search)) $cpy_page_row_block_search = new ccpy_page_row_block_search();

// Page init
$cpy_page_row_block_search->Page_Init();

// Page main
$cpy_page_row_block_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_page_row_block_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($cpy_page_row_block_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fcpy_page_row_blocksearch = new ew_Form("fcpy_page_row_blocksearch", "search");
<?php } else { ?>
var CurrentForm = fcpy_page_row_blocksearch = new ew_Form("fcpy_page_row_blocksearch", "search");
<?php } ?>

// Form_CustomValidate event
fcpy_page_row_blocksearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_page_row_blocksearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_page_row_blocksearch.Lists["x_row_id"] = {"LinkField":"x_row_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_row_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_page_row"};
fcpy_page_row_blocksearch.Lists["x_row_id"].Data = "<?php echo $cpy_page_row_block_search->row_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_page_row_blocksearch.Lists["x_type_id"] = {"LinkField":"x_type_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_type_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_block_type"};
fcpy_page_row_blocksearch.Lists["x_type_id"].Data = "<?php echo $cpy_page_row_block_search->type_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_page_row_blocksearch.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_page_row_blocksearch.Lists["x_slid_id"].Data = "<?php echo $cpy_page_row_block_search->slid_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_page_row_blocksearch.Lists["x_video_id"] = {"LinkField":"x_video_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_video_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_video"};
fcpy_page_row_blocksearch.Lists["x_video_id"].Data = "<?php echo $cpy_page_row_block_search->video_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_page_row_blocksearch.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_page_row_blocksearch.Lists["x_status_id"].Data = "<?php echo $cpy_page_row_block_search->status_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_page_row_blocksearch.Lists["x_cols_id"] = {"LinkField":"x_cols_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cols_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_cols"};
fcpy_page_row_blocksearch.Lists["x_cols_id"].Data = "<?php echo $cpy_page_row_block_search->cols_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fcpy_page_row_blocksearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_blk_order");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_page_row_block->blk_order->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_page_row_block_search->ShowPageHeader(); ?>
<?php
$cpy_page_row_block_search->ShowMessage();
?>
<form name="fcpy_page_row_blocksearch" id="fcpy_page_row_blocksearch" class="<?php echo $cpy_page_row_block_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_page_row_block_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_page_row_block_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_page_row_block">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($cpy_page_row_block_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($cpy_page_row_block->row_id->Visible) { // row_id ?>
	<div id="r_row_id" class="form-group">
		<label for="x_row_id" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_row_id"><?php echo $cpy_page_row_block->row_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_row_id" id="z_row_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->row_id->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_row_id">
<select data-table="cpy_page_row_block" data-field="x_row_id" data-value-separator="<?php echo $cpy_page_row_block->row_id->DisplayValueSeparatorAttribute() ?>" id="x_row_id" name="x_row_id"<?php echo $cpy_page_row_block->row_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->SelectOptionListHtml("x_row_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->type_id->Visible) { // type_id ?>
	<div id="r_type_id" class="form-group">
		<label for="x_type_id" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_type_id"><?php echo $cpy_page_row_block->type_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_type_id" id="z_type_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->type_id->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_type_id">
<select data-table="cpy_page_row_block" data-field="x_type_id" data-value-separator="<?php echo $cpy_page_row_block->type_id->DisplayValueSeparatorAttribute() ?>" id="x_type_id" name="x_type_id"<?php echo $cpy_page_row_block->type_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->SelectOptionListHtml("x_type_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->slid_id->Visible) { // slid_id ?>
	<div id="r_slid_id" class="form-group">
		<label for="x_slid_id" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_slid_id"><?php echo $cpy_page_row_block->slid_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_slid_id" id="z_slid_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->slid_id->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_slid_id">
<select data-table="cpy_page_row_block" data-field="x_slid_id" data-value-separator="<?php echo $cpy_page_row_block->slid_id->DisplayValueSeparatorAttribute() ?>" id="x_slid_id" name="x_slid_id"<?php echo $cpy_page_row_block->slid_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->SelectOptionListHtml("x_slid_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->video_id->Visible) { // video_id ?>
	<div id="r_video_id" class="form-group">
		<label for="x_video_id" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_video_id"><?php echo $cpy_page_row_block->video_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_video_id" id="z_video_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->video_id->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_video_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_video_id"><?php echo (strval($cpy_page_row_block->video_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $cpy_page_row_block->video_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($cpy_page_row_block->video_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_video_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($cpy_page_row_block->video_id->ReadOnly || $cpy_page_row_block->video_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="cpy_page_row_block" data-field="x_video_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cpy_page_row_block->video_id->DisplayValueSeparatorAttribute() ?>" name="x_video_id" id="x_video_id" value="<?php echo $cpy_page_row_block->video_id->AdvancedSearch->SearchValue ?>"<?php echo $cpy_page_row_block->video_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_status_id"><?php echo $cpy_page_row_block->status_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status_id" id="z_status_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->status_id->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_status_id">
<select data-table="cpy_page_row_block" data-field="x_status_id" data-value-separator="<?php echo $cpy_page_row_block->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_page_row_block->status_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->cols_id->Visible) { // cols_id ?>
	<div id="r_cols_id" class="form-group">
		<label for="x_cols_id" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_cols_id"><?php echo $cpy_page_row_block->cols_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cols_id" id="z_cols_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->cols_id->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_cols_id">
<select data-table="cpy_page_row_block" data-field="x_cols_id" data-value-separator="<?php echo $cpy_page_row_block->cols_id->DisplayValueSeparatorAttribute() ?>" id="x_cols_id" name="x_cols_id"<?php echo $cpy_page_row_block->cols_id->EditAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->SelectOptionListHtml("x_cols_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_order->Visible) { // blk_order ?>
	<div id="r_blk_order" class="form-group">
		<label for="x_blk_order" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_blk_order"><?php echo $cpy_page_row_block->blk_order->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_blk_order" id="z_blk_order" value="="></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_order->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_blk_order">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_order" name="x_blk_order" id="x_blk_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_order->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_order->EditValue ?>"<?php echo $cpy_page_row_block->blk_order->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_name->Visible) { // blk_name ?>
	<div id="r_blk_name" class="form-group">
		<label for="x_blk_name" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_blk_name"><?php echo $cpy_page_row_block->blk_name->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_blk_name" id="z_blk_name" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_name->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_blk_name">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_name" name="x_blk_name" id="x_blk_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_name->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_name->EditValue ?>"<?php echo $cpy_page_row_block->blk_name->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_header->Visible) { // blk_header ?>
	<div id="r_blk_header" class="form-group">
		<label for="x_blk_header" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_blk_header"><?php echo $cpy_page_row_block->blk_header->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_blk_header" id="z_blk_header" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_header->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_blk_header">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_header" name="x_blk_header" id="x_blk_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_header->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_header->EditValue ?>"<?php echo $cpy_page_row_block->blk_header->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_image->Visible) { // blk_image ?>
	<div id="r_blk_image" class="form-group">
		<label class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_blk_image"><?php echo $cpy_page_row_block->blk_image->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_blk_image" id="z_blk_image" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_image->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_blk_image">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_image" name="x_blk_image" id="x_blk_image" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_image->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_image->EditValue ?>"<?php echo $cpy_page_row_block->blk_image->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_stext->Visible) { // blk_stext ?>
	<div id="r_blk_stext" class="form-group">
		<label for="x_blk_stext" class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_blk_stext"><?php echo $cpy_page_row_block->blk_stext->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_blk_stext" id="z_blk_stext" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_stext->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_blk_stext">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_stext" name="x_blk_stext" id="x_blk_stext" size="35" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_stext->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_stext->EditValue ?>"<?php echo $cpy_page_row_block->blk_stext->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_page_row_block->blk_text->Visible) { // blk_text ?>
	<div id="r_blk_text" class="form-group">
		<label class="<?php echo $cpy_page_row_block_search->LeftColumnClass ?>"><span id="elh_cpy_page_row_block_blk_text"><?php echo $cpy_page_row_block->blk_text->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_blk_text" id="z_blk_text" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_page_row_block_search->RightColumnClass ?>"><div<?php echo $cpy_page_row_block->blk_text->CellAttributes() ?>>
			<span id="el_cpy_page_row_block_blk_text">
<input type="text" data-table="cpy_page_row_block" data-field="x_blk_text" name="x_blk_text" id="x_blk_text" size="35" placeholder="<?php echo ew_HtmlEncode($cpy_page_row_block->blk_text->getPlaceHolder()) ?>" value="<?php echo $cpy_page_row_block->blk_text->EditValue ?>"<?php echo $cpy_page_row_block->blk_text->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cpy_page_row_block_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_page_row_block_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_page_row_blocksearch.Init();
</script>
<?php
$cpy_page_row_block_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_page_row_block_search->Page_Terminate();
?>
