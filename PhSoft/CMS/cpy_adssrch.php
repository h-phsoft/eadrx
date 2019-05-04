<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_adsinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_ads_search = NULL; // Initialize page object first

class ccpy_ads_search extends ccpy_ads {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_ads';

	// Page object name
	var $PageObjName = 'cpy_ads_search';

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

		// Table object (cpy_ads)
		if (!isset($GLOBALS["cpy_ads"]) || get_class($GLOBALS["cpy_ads"]) == "ccpy_ads") {
			$GLOBALS["cpy_ads"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_ads"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_ads', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_adslist.php"));
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
		$this->repeat_id->SetVisibility();
		$this->every_id->SetVisibility();
		$this->ads_title->SetVisibility();
		$this->ads_desc->SetVisibility();
		$this->ads_sdate->SetVisibility();
		$this->ads_edate->SetVisibility();
		$this->hour_sid->SetVisibility();
		$this->hour_eid->SetVisibility();
		$this->ads_image->SetVisibility();
		$this->ads_text->SetVisibility();
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
		global $EW_EXPORT, $cpy_ads;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_ads);
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
					if ($pageName == "cpy_adsview.php")
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
						$sSrchStr = "cpy_adslist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->status_id); // status_id
		$this->BuildSearchUrl($sSrchUrl, $this->repeat_id); // repeat_id
		$this->BuildSearchUrl($sSrchUrl, $this->every_id); // every_id
		$this->BuildSearchUrl($sSrchUrl, $this->ads_title); // ads_title
		$this->BuildSearchUrl($sSrchUrl, $this->ads_desc); // ads_desc
		$this->BuildSearchUrl($sSrchUrl, $this->ads_sdate); // ads_sdate
		$this->BuildSearchUrl($sSrchUrl, $this->ads_edate); // ads_edate
		$this->BuildSearchUrl($sSrchUrl, $this->hour_sid); // hour_sid
		$this->BuildSearchUrl($sSrchUrl, $this->hour_eid); // hour_eid
		$this->BuildSearchUrl($sSrchUrl, $this->ads_image); // ads_image
		$this->BuildSearchUrl($sSrchUrl, $this->ads_text); // ads_text
		$this->BuildSearchUrl($sSrchUrl, $this->ins_datetime); // ins_datetime
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
		// status_id

		$this->status_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_status_id");
		$this->status_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status_id");

		// repeat_id
		$this->repeat_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_repeat_id");
		$this->repeat_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_repeat_id");

		// every_id
		$this->every_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_every_id");
		$this->every_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_every_id");

		// ads_title
		$this->ads_title->AdvancedSearch->SearchValue = $objForm->GetValue("x_ads_title");
		$this->ads_title->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ads_title");

		// ads_desc
		$this->ads_desc->AdvancedSearch->SearchValue = $objForm->GetValue("x_ads_desc");
		$this->ads_desc->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ads_desc");

		// ads_sdate
		$this->ads_sdate->AdvancedSearch->SearchValue = $objForm->GetValue("x_ads_sdate");
		$this->ads_sdate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ads_sdate");

		// ads_edate
		$this->ads_edate->AdvancedSearch->SearchValue = $objForm->GetValue("x_ads_edate");
		$this->ads_edate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ads_edate");

		// hour_sid
		$this->hour_sid->AdvancedSearch->SearchValue = $objForm->GetValue("x_hour_sid");
		$this->hour_sid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_hour_sid");

		// hour_eid
		$this->hour_eid->AdvancedSearch->SearchValue = $objForm->GetValue("x_hour_eid");
		$this->hour_eid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_hour_eid");

		// ads_image
		$this->ads_image->AdvancedSearch->SearchValue = $objForm->GetValue("x_ads_image");
		$this->ads_image->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ads_image");

		// ads_text
		$this->ads_text->AdvancedSearch->SearchValue = $objForm->GetValue("x_ads_text");
		$this->ads_text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ads_text");

		// ins_datetime
		$this->ins_datetime->AdvancedSearch->SearchValue = $objForm->GetValue("x_ins_datetime");
		$this->ins_datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ins_datetime");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ads_id
		// status_id
		// repeat_id
		// every_id
		// ads_title
		// ads_desc
		// ads_sdate
		// ads_edate
		// hour_sid
		// hour_eid
		// ads_image
		// ads_text
		// ins_datetime

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

		// repeat_id
		if (strval($this->repeat_id->CurrentValue) <> "") {
			$sFilterWrk = "`repeat_id`" . ew_SearchString("=", $this->repeat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `repeat_id`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_repeat`";
		$sWhereWrk = "";
		$this->repeat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `repeat_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->repeat_id->ViewValue = $this->repeat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->repeat_id->ViewValue = $this->repeat_id->CurrentValue;
			}
		} else {
			$this->repeat_id->ViewValue = NULL;
		}
		$this->repeat_id->ViewCustomAttributes = "";

		// every_id
		if (strval($this->every_id->CurrentValue) <> "") {
			$sFilterWrk = "`every_id`" . ew_SearchString("=", $this->every_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `every_id`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_every`";
		$sWhereWrk = "";
		$this->every_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `every_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->every_id->ViewValue = $this->every_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->every_id->ViewValue = $this->every_id->CurrentValue;
			}
		} else {
			$this->every_id->ViewValue = NULL;
		}
		$this->every_id->ViewCustomAttributes = "";

		// ads_title
		$this->ads_title->ViewValue = $this->ads_title->CurrentValue;
		$this->ads_title->ViewCustomAttributes = "";

		// ads_desc
		$this->ads_desc->ViewValue = $this->ads_desc->CurrentValue;
		$this->ads_desc->ViewCustomAttributes = "";

		// ads_sdate
		$this->ads_sdate->ViewValue = $this->ads_sdate->CurrentValue;
		$this->ads_sdate->ViewValue = ew_FormatDateTime($this->ads_sdate->ViewValue, 0);
		$this->ads_sdate->ViewCustomAttributes = "";

		// ads_edate
		$this->ads_edate->ViewValue = $this->ads_edate->CurrentValue;
		$this->ads_edate->ViewValue = ew_FormatDateTime($this->ads_edate->ViewValue, 0);
		$this->ads_edate->ViewCustomAttributes = "";

		// hour_sid
		if (strval($this->hour_sid->CurrentValue) <> "") {
			$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_sid->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
		$sWhereWrk = "";
		$this->hour_sid->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->hour_sid->ViewValue = $this->hour_sid->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->hour_sid->ViewValue = $this->hour_sid->CurrentValue;
			}
		} else {
			$this->hour_sid->ViewValue = NULL;
		}
		$this->hour_sid->ViewCustomAttributes = "";

		// hour_eid
		if (strval($this->hour_eid->CurrentValue) <> "") {
			$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_eid->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
		$sWhereWrk = "";
		$this->hour_eid->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->hour_eid->ViewValue = $this->hour_eid->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->hour_eid->ViewValue = $this->hour_eid->CurrentValue;
			}
		} else {
			$this->hour_eid->ViewValue = NULL;
		}
		$this->hour_eid->ViewCustomAttributes = "";

		// ads_image
		$this->ads_image->UploadPath = '../../assets/img/adsImages';
		if (!ew_Empty($this->ads_image->Upload->DbValue)) {
			$this->ads_image->ImageWidth = 200;
			$this->ads_image->ImageHeight = 0;
			$this->ads_image->ImageAlt = $this->ads_image->FldAlt();
			$this->ads_image->ViewValue = $this->ads_image->Upload->DbValue;
		} else {
			$this->ads_image->ViewValue = "";
		}
		$this->ads_image->ViewCustomAttributes = "";

		// ads_text
		$this->ads_text->ViewValue = $this->ads_text->CurrentValue;
		$this->ads_text->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// repeat_id
			$this->repeat_id->LinkCustomAttributes = "";
			$this->repeat_id->HrefValue = "";
			$this->repeat_id->TooltipValue = "";

			// every_id
			$this->every_id->LinkCustomAttributes = "";
			$this->every_id->HrefValue = "";
			$this->every_id->TooltipValue = "";

			// ads_title
			$this->ads_title->LinkCustomAttributes = "";
			$this->ads_title->HrefValue = "";
			$this->ads_title->TooltipValue = "";

			// ads_desc
			$this->ads_desc->LinkCustomAttributes = "";
			$this->ads_desc->HrefValue = "";
			$this->ads_desc->TooltipValue = "";

			// ads_sdate
			$this->ads_sdate->LinkCustomAttributes = "";
			$this->ads_sdate->HrefValue = "";
			$this->ads_sdate->TooltipValue = "";

			// ads_edate
			$this->ads_edate->LinkCustomAttributes = "";
			$this->ads_edate->HrefValue = "";
			$this->ads_edate->TooltipValue = "";

			// hour_sid
			$this->hour_sid->LinkCustomAttributes = "";
			$this->hour_sid->HrefValue = "";
			$this->hour_sid->TooltipValue = "";

			// hour_eid
			$this->hour_eid->LinkCustomAttributes = "";
			$this->hour_eid->HrefValue = "";
			$this->hour_eid->TooltipValue = "";

			// ads_image
			$this->ads_image->LinkCustomAttributes = "";
			$this->ads_image->UploadPath = '../../assets/img/adsImages';
			if (!ew_Empty($this->ads_image->Upload->DbValue)) {
				$this->ads_image->HrefValue = ew_GetFileUploadUrl($this->ads_image, $this->ads_image->Upload->DbValue); // Add prefix/suffix
				$this->ads_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->ads_image->HrefValue = ew_FullUrl($this->ads_image->HrefValue, "href");
			} else {
				$this->ads_image->HrefValue = "";
			}
			$this->ads_image->HrefValue2 = $this->ads_image->UploadPath . $this->ads_image->Upload->DbValue;
			$this->ads_image->TooltipValue = "";
			if ($this->ads_image->UseColorbox) {
				if (ew_Empty($this->ads_image->TooltipValue))
					$this->ads_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->ads_image->LinkAttrs["data-rel"] = "cpy_ads_x_ads_image";
				ew_AppendClass($this->ads_image->LinkAttrs["class"], "ewLightbox");
			}

			// ads_text
			$this->ads_text->LinkCustomAttributes = "";
			$this->ads_text->HrefValue = "";
			$this->ads_text->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

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

			// repeat_id
			$this->repeat_id->EditAttrs["class"] = "form-control";
			$this->repeat_id->EditCustomAttributes = "";
			if (trim(strval($this->repeat_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`repeat_id`" . ew_SearchString("=", $this->repeat_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `repeat_id`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_repeat`";
			$sWhereWrk = "";
			$this->repeat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `repeat_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->repeat_id->EditValue = $arwrk;

			// every_id
			$this->every_id->EditAttrs["class"] = "form-control";
			$this->every_id->EditCustomAttributes = "";
			if (trim(strval($this->every_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`every_id`" . ew_SearchString("=", $this->every_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `every_id`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_every`";
			$sWhereWrk = "";
			$this->every_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `every_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->every_id->EditValue = $arwrk;

			// ads_title
			$this->ads_title->EditAttrs["class"] = "form-control";
			$this->ads_title->EditCustomAttributes = "";
			$this->ads_title->EditValue = ew_HtmlEncode($this->ads_title->AdvancedSearch->SearchValue);
			$this->ads_title->PlaceHolder = ew_RemoveHtml($this->ads_title->FldCaption());

			// ads_desc
			$this->ads_desc->EditAttrs["class"] = "form-control";
			$this->ads_desc->EditCustomAttributes = "";
			$this->ads_desc->EditValue = ew_HtmlEncode($this->ads_desc->AdvancedSearch->SearchValue);
			$this->ads_desc->PlaceHolder = ew_RemoveHtml($this->ads_desc->FldCaption());

			// ads_sdate
			$this->ads_sdate->EditAttrs["class"] = "form-control";
			$this->ads_sdate->EditCustomAttributes = "";
			$this->ads_sdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->ads_sdate->AdvancedSearch->SearchValue, 0), 8));
			$this->ads_sdate->PlaceHolder = ew_RemoveHtml($this->ads_sdate->FldCaption());

			// ads_edate
			$this->ads_edate->EditAttrs["class"] = "form-control";
			$this->ads_edate->EditCustomAttributes = "";
			$this->ads_edate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->ads_edate->AdvancedSearch->SearchValue, 0), 8));
			$this->ads_edate->PlaceHolder = ew_RemoveHtml($this->ads_edate->FldCaption());

			// hour_sid
			$this->hour_sid->EditAttrs["class"] = "form-control";
			$this->hour_sid->EditCustomAttributes = "";
			if (trim(strval($this->hour_sid->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_sid->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_hour`";
			$sWhereWrk = "";
			$this->hour_sid->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->hour_sid->EditValue = $arwrk;

			// hour_eid
			$this->hour_eid->EditAttrs["class"] = "form-control";
			$this->hour_eid->EditCustomAttributes = "";
			if (trim(strval($this->hour_eid->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`hour_id`" . ew_SearchString("=", $this->hour_eid->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `hour_id`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_hour`";
			$sWhereWrk = "";
			$this->hour_eid->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->hour_eid->EditValue = $arwrk;

			// ads_image
			$this->ads_image->EditAttrs["class"] = "form-control";
			$this->ads_image->EditCustomAttributes = "";
			$this->ads_image->EditValue = ew_HtmlEncode($this->ads_image->AdvancedSearch->SearchValue);
			$this->ads_image->PlaceHolder = ew_RemoveHtml($this->ads_image->FldCaption());

			// ads_text
			$this->ads_text->EditAttrs["class"] = "form-control";
			$this->ads_text->EditCustomAttributes = "";
			$this->ads_text->EditValue = ew_HtmlEncode($this->ads_text->AdvancedSearch->SearchValue);
			$this->ads_text->PlaceHolder = ew_RemoveHtml($this->ads_text->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->ins_datetime->AdvancedSearch->SearchValue, 11), 11));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());
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
		if (!ew_CheckDateDef($this->ads_sdate->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->ads_sdate->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->ads_edate->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->ads_edate->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->ins_datetime->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->ins_datetime->FldErrMsg());
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
		$this->status_id->AdvancedSearch->Load();
		$this->repeat_id->AdvancedSearch->Load();
		$this->every_id->AdvancedSearch->Load();
		$this->ads_title->AdvancedSearch->Load();
		$this->ads_desc->AdvancedSearch->Load();
		$this->ads_sdate->AdvancedSearch->Load();
		$this->ads_edate->AdvancedSearch->Load();
		$this->hour_sid->AdvancedSearch->Load();
		$this->hour_eid->AdvancedSearch->Load();
		$this->ads_image->AdvancedSearch->Load();
		$this->ads_text->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_adslist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
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
		case "x_repeat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `repeat_id` AS `LinkFld`, `repeat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_repeat`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`repeat_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->repeat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `repeat_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_every_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `every_id` AS `LinkFld`, `every_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_every`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`every_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->every_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `every_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_hour_sid":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `hour_id` AS `LinkFld`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`hour_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->hour_sid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_hour_eid":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `hour_id` AS `LinkFld`, `houd_hour` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_hour`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`hour_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->hour_eid, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `hour_id`";
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
if (!isset($cpy_ads_search)) $cpy_ads_search = new ccpy_ads_search();

// Page init
$cpy_ads_search->Page_Init();

// Page main
$cpy_ads_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_ads_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($cpy_ads_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fcpy_adssearch = new ew_Form("fcpy_adssearch", "search");
<?php } else { ?>
var CurrentForm = fcpy_adssearch = new ew_Form("fcpy_adssearch", "search");
<?php } ?>

// Form_CustomValidate event
fcpy_adssearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_adssearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_adssearch.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_adssearch.Lists["x_status_id"].Data = "<?php echo $cpy_ads_search->status_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_adssearch.Lists["x_repeat_id"] = {"LinkField":"x_repeat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_repeat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_repeat"};
fcpy_adssearch.Lists["x_repeat_id"].Data = "<?php echo $cpy_ads_search->repeat_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_adssearch.Lists["x_every_id"] = {"LinkField":"x_every_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_every_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_every"};
fcpy_adssearch.Lists["x_every_id"].Data = "<?php echo $cpy_ads_search->every_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_adssearch.Lists["x_hour_sid"] = {"LinkField":"x_hour_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_houd_hour","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_hour"};
fcpy_adssearch.Lists["x_hour_sid"].Data = "<?php echo $cpy_ads_search->hour_sid->LookupFilterQuery(FALSE, "search") ?>";
fcpy_adssearch.Lists["x_hour_eid"] = {"LinkField":"x_hour_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_houd_hour","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_hour"};
fcpy_adssearch.Lists["x_hour_eid"].Data = "<?php echo $cpy_ads_search->hour_eid->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fcpy_adssearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_ads_sdate");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_ads->ads_sdate->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_ads_edate");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_ads->ads_edate->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_ins_datetime");
	if (elm && !ew_CheckEuroDate(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_ads->ins_datetime->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_ads_search->ShowPageHeader(); ?>
<?php
$cpy_ads_search->ShowMessage();
?>
<form name="fcpy_adssearch" id="fcpy_adssearch" class="<?php echo $cpy_ads_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_ads_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_ads_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_ads">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($cpy_ads_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($cpy_ads->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_status_id"><?php echo $cpy_ads->status_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status_id" id="z_status_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->status_id->CellAttributes() ?>>
			<span id="el_cpy_ads_status_id">
<select data-table="cpy_ads" data-field="x_status_id" data-value-separator="<?php echo $cpy_ads->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_ads->status_id->EditAttributes() ?>>
<?php echo $cpy_ads->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->repeat_id->Visible) { // repeat_id ?>
	<div id="r_repeat_id" class="form-group">
		<label for="x_repeat_id" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_repeat_id"><?php echo $cpy_ads->repeat_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_repeat_id" id="z_repeat_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->repeat_id->CellAttributes() ?>>
			<span id="el_cpy_ads_repeat_id">
<select data-table="cpy_ads" data-field="x_repeat_id" data-value-separator="<?php echo $cpy_ads->repeat_id->DisplayValueSeparatorAttribute() ?>" id="x_repeat_id" name="x_repeat_id"<?php echo $cpy_ads->repeat_id->EditAttributes() ?>>
<?php echo $cpy_ads->repeat_id->SelectOptionListHtml("x_repeat_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->every_id->Visible) { // every_id ?>
	<div id="r_every_id" class="form-group">
		<label for="x_every_id" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_every_id"><?php echo $cpy_ads->every_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_every_id" id="z_every_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->every_id->CellAttributes() ?>>
			<span id="el_cpy_ads_every_id">
<select data-table="cpy_ads" data-field="x_every_id" data-value-separator="<?php echo $cpy_ads->every_id->DisplayValueSeparatorAttribute() ?>" id="x_every_id" name="x_every_id"<?php echo $cpy_ads->every_id->EditAttributes() ?>>
<?php echo $cpy_ads->every_id->SelectOptionListHtml("x_every_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_title->Visible) { // ads_title ?>
	<div id="r_ads_title" class="form-group">
		<label for="x_ads_title" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ads_title"><?php echo $cpy_ads->ads_title->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ads_title" id="z_ads_title" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_title->CellAttributes() ?>>
			<span id="el_cpy_ads_ads_title">
<input type="text" data-table="cpy_ads" data-field="x_ads_title" name="x_ads_title" id="x_ads_title" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_title->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_title->EditValue ?>"<?php echo $cpy_ads->ads_title->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_desc->Visible) { // ads_desc ?>
	<div id="r_ads_desc" class="form-group">
		<label for="x_ads_desc" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ads_desc"><?php echo $cpy_ads->ads_desc->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ads_desc" id="z_ads_desc" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_desc->CellAttributes() ?>>
			<span id="el_cpy_ads_ads_desc">
<input type="text" data-table="cpy_ads" data-field="x_ads_desc" name="x_ads_desc" id="x_ads_desc" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_desc->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_desc->EditValue ?>"<?php echo $cpy_ads->ads_desc->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_sdate->Visible) { // ads_sdate ?>
	<div id="r_ads_sdate" class="form-group">
		<label for="x_ads_sdate" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ads_sdate"><?php echo $cpy_ads->ads_sdate->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ads_sdate" id="z_ads_sdate" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_sdate->CellAttributes() ?>>
			<span id="el_cpy_ads_ads_sdate">
<input type="text" data-table="cpy_ads" data-field="x_ads_sdate" name="x_ads_sdate" id="x_ads_sdate" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_sdate->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_sdate->EditValue ?>"<?php echo $cpy_ads->ads_sdate->EditAttributes() ?>>
<?php if (!$cpy_ads->ads_sdate->ReadOnly && !$cpy_ads->ads_sdate->Disabled && !isset($cpy_ads->ads_sdate->EditAttrs["readonly"]) && !isset($cpy_ads->ads_sdate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fcpy_adssearch", "x_ads_sdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_edate->Visible) { // ads_edate ?>
	<div id="r_ads_edate" class="form-group">
		<label for="x_ads_edate" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ads_edate"><?php echo $cpy_ads->ads_edate->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ads_edate" id="z_ads_edate" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_edate->CellAttributes() ?>>
			<span id="el_cpy_ads_ads_edate">
<input type="text" data-table="cpy_ads" data-field="x_ads_edate" name="x_ads_edate" id="x_ads_edate" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_edate->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_edate->EditValue ?>"<?php echo $cpy_ads->ads_edate->EditAttributes() ?>>
<?php if (!$cpy_ads->ads_edate->ReadOnly && !$cpy_ads->ads_edate->Disabled && !isset($cpy_ads->ads_edate->EditAttrs["readonly"]) && !isset($cpy_ads->ads_edate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fcpy_adssearch", "x_ads_edate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->hour_sid->Visible) { // hour_sid ?>
	<div id="r_hour_sid" class="form-group">
		<label for="x_hour_sid" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_hour_sid"><?php echo $cpy_ads->hour_sid->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_hour_sid" id="z_hour_sid" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->hour_sid->CellAttributes() ?>>
			<span id="el_cpy_ads_hour_sid">
<select data-table="cpy_ads" data-field="x_hour_sid" data-value-separator="<?php echo $cpy_ads->hour_sid->DisplayValueSeparatorAttribute() ?>" id="x_hour_sid" name="x_hour_sid"<?php echo $cpy_ads->hour_sid->EditAttributes() ?>>
<?php echo $cpy_ads->hour_sid->SelectOptionListHtml("x_hour_sid") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->hour_eid->Visible) { // hour_eid ?>
	<div id="r_hour_eid" class="form-group">
		<label for="x_hour_eid" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_hour_eid"><?php echo $cpy_ads->hour_eid->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_hour_eid" id="z_hour_eid" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->hour_eid->CellAttributes() ?>>
			<span id="el_cpy_ads_hour_eid">
<select data-table="cpy_ads" data-field="x_hour_eid" data-value-separator="<?php echo $cpy_ads->hour_eid->DisplayValueSeparatorAttribute() ?>" id="x_hour_eid" name="x_hour_eid"<?php echo $cpy_ads->hour_eid->EditAttributes() ?>>
<?php echo $cpy_ads->hour_eid->SelectOptionListHtml("x_hour_eid") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_image->Visible) { // ads_image ?>
	<div id="r_ads_image" class="form-group">
		<label class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ads_image"><?php echo $cpy_ads->ads_image->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ads_image" id="z_ads_image" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_image->CellAttributes() ?>>
			<span id="el_cpy_ads_ads_image">
<input type="text" data-table="cpy_ads" data-field="x_ads_image" name="x_ads_image" id="x_ads_image" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_image->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_image->EditValue ?>"<?php echo $cpy_ads->ads_image->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ads_text->Visible) { // ads_text ?>
	<div id="r_ads_text" class="form-group">
		<label class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ads_text"><?php echo $cpy_ads->ads_text->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ads_text" id="z_ads_text" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ads_text->CellAttributes() ?>>
			<span id="el_cpy_ads_ads_text">
<input type="text" data-table="cpy_ads" data-field="x_ads_text" name="x_ads_text" id="x_ads_text" size="35" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ads_text->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ads_text->EditValue ?>"<?php echo $cpy_ads->ads_text->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_ads->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $cpy_ads_search->LeftColumnClass ?>"><span id="elh_cpy_ads_ins_datetime"><?php echo $cpy_ads->ins_datetime->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ins_datetime" id="z_ins_datetime" value="="></p>
		</label>
		<div class="<?php echo $cpy_ads_search->RightColumnClass ?>"><div<?php echo $cpy_ads->ins_datetime->CellAttributes() ?>>
			<span id="el_cpy_ads_ins_datetime">
<input type="text" data-table="cpy_ads" data-field="x_ins_datetime" data-format="11" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($cpy_ads->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $cpy_ads->ins_datetime->EditValue ?>"<?php echo $cpy_ads->ins_datetime->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cpy_ads_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_ads_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_adssearch.Init();
</script>
<?php
$cpy_ads_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_ads_search->Page_Terminate();
?>
