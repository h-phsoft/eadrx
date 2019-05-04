<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_userinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_user_search = NULL; // Initialize page object first

class ccpy_user_search extends ccpy_user {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_user';

	// Page object name
	var $PageObjName = 'cpy_user_search';

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

		// Table object (cpy_user)
		if (!isset($GLOBALS["cpy_user"]) || get_class($GLOBALS["cpy_user"]) == "ccpy_user") {
			$GLOBALS["cpy_user"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_user"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_user', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_userlist.php"));
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
		$this->cntry_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->pgrp_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->gend_id->SetVisibility();
		$this->user_name->SetVisibility();
		$this->user_email->SetVisibility();
		$this->user_password->SetVisibility();
		$this->user_mobile->SetVisibility();
		$this->user_token->SetVisibility();
		$this->ins_datetime->SetVisibility();
		$this->upd_datetime->SetVisibility();

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
		global $EW_EXPORT, $cpy_user;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_user);
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
					if ($pageName == "cpy_userview.php")
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
						$sSrchStr = "cpy_userlist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->cntry_id); // cntry_id
		$this->BuildSearchUrl($sSrchUrl, $this->lang_id); // lang_id
		$this->BuildSearchUrl($sSrchUrl, $this->pgrp_id); // pgrp_id
		$this->BuildSearchUrl($sSrchUrl, $this->status_id); // status_id
		$this->BuildSearchUrl($sSrchUrl, $this->gend_id); // gend_id
		$this->BuildSearchUrl($sSrchUrl, $this->user_name); // user_name
		$this->BuildSearchUrl($sSrchUrl, $this->user_email); // user_email
		$this->BuildSearchUrl($sSrchUrl, $this->user_password); // user_password
		$this->BuildSearchUrl($sSrchUrl, $this->user_mobile); // user_mobile
		$this->BuildSearchUrl($sSrchUrl, $this->user_token); // user_token
		$this->BuildSearchUrl($sSrchUrl, $this->ins_datetime); // ins_datetime
		$this->BuildSearchUrl($sSrchUrl, $this->upd_datetime); // upd_datetime
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
		// cntry_id

		$this->cntry_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cntry_id");
		$this->cntry_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cntry_id");

		// lang_id
		$this->lang_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_id");
		$this->lang_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_id");

		// pgrp_id
		$this->pgrp_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_pgrp_id");
		$this->pgrp_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pgrp_id");

		// status_id
		$this->status_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_status_id");
		$this->status_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status_id");

		// gend_id
		$this->gend_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_gend_id");
		$this->gend_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_gend_id");

		// user_name
		$this->user_name->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_name");
		$this->user_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_name");

		// user_email
		$this->user_email->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_email");
		$this->user_email->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_email");

		// user_password
		$this->user_password->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_password");
		$this->user_password->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_password");

		// user_mobile
		$this->user_mobile->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_mobile");
		$this->user_mobile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_mobile");

		// user_token
		$this->user_token->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_token");
		$this->user_token->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_token");

		// ins_datetime
		$this->ins_datetime->AdvancedSearch->SearchValue = $objForm->GetValue("x_ins_datetime");
		$this->ins_datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ins_datetime");

		// upd_datetime
		$this->upd_datetime->AdvancedSearch->SearchValue = $objForm->GetValue("x_upd_datetime");
		$this->upd_datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_upd_datetime");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// user_id
		// cntry_id
		// lang_id
		// pgrp_id
		// status_id
		// gend_id
		// user_name
		// user_email
		// user_password
		// user_mobile
		// user_token
		// ins_datetime
		// upd_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// cntry_id
		if (strval($this->cntry_id->CurrentValue) <> "") {
			$sFilterWrk = "`cntry_id`" . ew_SearchString("=", $this->cntry_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cntry_id`, `cntry_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_country`";
		$sWhereWrk = "";
		$this->cntry_id->LookupFilters = array();
		$lookuptblfilter = "`status_id`=1";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cntry_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cntry_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cntry_id->ViewValue = $this->cntry_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cntry_id->ViewValue = $this->cntry_id->CurrentValue;
			}
		} else {
			$this->cntry_id->ViewValue = NULL;
		}
		$this->cntry_id->ViewCustomAttributes = "";

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

		// pgrp_id
		if (strval($this->pgrp_id->CurrentValue) <> "") {
			$sFilterWrk = "`pgrp_id`" . ew_SearchString("=", $this->pgrp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pgrp_id`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_pgroup`";
		$sWhereWrk = "";
		$this->pgrp_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `pgrp_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pgrp_id->ViewValue = $this->pgrp_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pgrp_id->ViewValue = $this->pgrp_id->CurrentValue;
			}
		} else {
			$this->pgrp_id->ViewValue = NULL;
		}
		$this->pgrp_id->ViewCustomAttributes = "";

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

		// gend_id
		if (strval($this->gend_id->CurrentValue) <> "") {
			$sFilterWrk = "`gend_id`" . ew_SearchString("=", $this->gend_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `gend_id`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_gender`";
		$sWhereWrk = "";
		$this->gend_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `gend_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->gend_id->ViewValue = $this->gend_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->gend_id->ViewValue = $this->gend_id->CurrentValue;
			}
		} else {
			$this->gend_id->ViewValue = NULL;
		}
		$this->gend_id->ViewCustomAttributes = "";

		// user_name
		$this->user_name->ViewValue = $this->user_name->CurrentValue;
		$this->user_name->ViewCustomAttributes = "";

		// user_email
		$this->user_email->ViewValue = $this->user_email->CurrentValue;
		$this->user_email->ViewCustomAttributes = "";

		// user_password
		$this->user_password->ViewValue = $this->user_password->CurrentValue;
		$this->user_password->ViewCustomAttributes = "";

		// user_mobile
		$this->user_mobile->ViewValue = $this->user_mobile->CurrentValue;
		$this->user_mobile->ViewCustomAttributes = "";

		// user_token
		$this->user_token->ViewValue = $this->user_token->CurrentValue;
		$this->user_token->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

		// upd_datetime
		$this->upd_datetime->ViewValue = $this->upd_datetime->CurrentValue;
		$this->upd_datetime->ViewValue = ew_FormatDateTime($this->upd_datetime->ViewValue, 0);
		$this->upd_datetime->ViewCustomAttributes = "";

			// cntry_id
			$this->cntry_id->LinkCustomAttributes = "";
			$this->cntry_id->HrefValue = "";
			$this->cntry_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// pgrp_id
			$this->pgrp_id->LinkCustomAttributes = "";
			$this->pgrp_id->HrefValue = "";
			$this->pgrp_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";
			$this->gend_id->TooltipValue = "";

			// user_name
			$this->user_name->LinkCustomAttributes = "";
			$this->user_name->HrefValue = "";
			$this->user_name->TooltipValue = "";

			// user_email
			$this->user_email->LinkCustomAttributes = "";
			$this->user_email->HrefValue = "";
			$this->user_email->TooltipValue = "";

			// user_password
			$this->user_password->LinkCustomAttributes = "";
			$this->user_password->HrefValue = "";
			$this->user_password->TooltipValue = "";

			// user_mobile
			$this->user_mobile->LinkCustomAttributes = "";
			$this->user_mobile->HrefValue = "";
			$this->user_mobile->TooltipValue = "";

			// user_token
			$this->user_token->LinkCustomAttributes = "";
			$this->user_token->HrefValue = "";
			$this->user_token->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";

			// upd_datetime
			$this->upd_datetime->LinkCustomAttributes = "";
			$this->upd_datetime->HrefValue = "";
			$this->upd_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// cntry_id
			$this->cntry_id->EditAttrs["class"] = "form-control";
			$this->cntry_id->EditCustomAttributes = "";
			if (trim(strval($this->cntry_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cntry_id`" . ew_SearchString("=", $this->cntry_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cntry_id`, `cntry_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_country`";
			$sWhereWrk = "";
			$this->cntry_id->LookupFilters = array();
			$lookuptblfilter = "`status_id`=1";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cntry_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cntry_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cntry_id->EditValue = $arwrk;

			// lang_id
			$this->lang_id->EditAttrs["class"] = "form-control";
			$this->lang_id->EditCustomAttributes = "";
			if (trim(strval($this->lang_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
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

			// pgrp_id
			$this->pgrp_id->EditAttrs["class"] = "form-control";
			$this->pgrp_id->EditCustomAttributes = "";
			if (trim(strval($this->pgrp_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pgrp_id`" . ew_SearchString("=", $this->pgrp_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `pgrp_id`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_pgroup`";
			$sWhereWrk = "";
			$this->pgrp_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pgrp_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pgrp_id->EditValue = $arwrk;

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

			// gend_id
			$this->gend_id->EditAttrs["class"] = "form-control";
			$this->gend_id->EditCustomAttributes = "";
			if (trim(strval($this->gend_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`gend_id`" . ew_SearchString("=", $this->gend_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `gend_id`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_gender`";
			$sWhereWrk = "";
			$this->gend_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `gend_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->gend_id->EditValue = $arwrk;

			// user_name
			$this->user_name->EditAttrs["class"] = "form-control";
			$this->user_name->EditCustomAttributes = "";
			$this->user_name->EditValue = ew_HtmlEncode($this->user_name->AdvancedSearch->SearchValue);
			$this->user_name->PlaceHolder = ew_RemoveHtml($this->user_name->FldCaption());

			// user_email
			$this->user_email->EditAttrs["class"] = "form-control";
			$this->user_email->EditCustomAttributes = "";
			$this->user_email->EditValue = ew_HtmlEncode($this->user_email->AdvancedSearch->SearchValue);
			$this->user_email->PlaceHolder = ew_RemoveHtml($this->user_email->FldCaption());

			// user_password
			$this->user_password->EditAttrs["class"] = "form-control";
			$this->user_password->EditCustomAttributes = "";
			$this->user_password->EditValue = ew_HtmlEncode($this->user_password->AdvancedSearch->SearchValue);
			$this->user_password->PlaceHolder = ew_RemoveHtml($this->user_password->FldCaption());

			// user_mobile
			$this->user_mobile->EditAttrs["class"] = "form-control";
			$this->user_mobile->EditCustomAttributes = "";
			$this->user_mobile->EditValue = ew_HtmlEncode($this->user_mobile->AdvancedSearch->SearchValue);
			$this->user_mobile->PlaceHolder = ew_RemoveHtml($this->user_mobile->FldCaption());

			// user_token
			$this->user_token->EditAttrs["class"] = "form-control";
			$this->user_token->EditCustomAttributes = "";
			$this->user_token->EditValue = ew_HtmlEncode($this->user_token->AdvancedSearch->SearchValue);
			$this->user_token->PlaceHolder = ew_RemoveHtml($this->user_token->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->ins_datetime->AdvancedSearch->SearchValue, 0), 8));
			$this->ins_datetime->PlaceHolder = ew_RemoveHtml($this->ins_datetime->FldCaption());

			// upd_datetime
			$this->upd_datetime->EditAttrs["class"] = "form-control";
			$this->upd_datetime->EditCustomAttributes = "";
			$this->upd_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->upd_datetime->AdvancedSearch->SearchValue, 0), 8));
			$this->upd_datetime->PlaceHolder = ew_RemoveHtml($this->upd_datetime->FldCaption());
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
		if (!ew_CheckDateDef($this->ins_datetime->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->ins_datetime->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->upd_datetime->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->upd_datetime->FldErrMsg());
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
		$this->cntry_id->AdvancedSearch->Load();
		$this->lang_id->AdvancedSearch->Load();
		$this->pgrp_id->AdvancedSearch->Load();
		$this->status_id->AdvancedSearch->Load();
		$this->gend_id->AdvancedSearch->Load();
		$this->user_name->AdvancedSearch->Load();
		$this->user_email->AdvancedSearch->Load();
		$this->user_password->AdvancedSearch->Load();
		$this->user_mobile->AdvancedSearch->Load();
		$this->user_token->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
		$this->upd_datetime->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_userlist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_cntry_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cntry_id` AS `LinkFld`, `cntry_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_country`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`status_id`=1";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cntry_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cntry_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cntry_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
		case "x_pgrp_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pgrp_id` AS `LinkFld`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_pgroup`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pgrp_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pgrp_id`";
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
		case "x_gend_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `gend_id` AS `LinkFld`, `gend_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_gender`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`gend_id` IN ({filter_value})', "t0" => "16", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->gend_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `gend_id`";
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
if (!isset($cpy_user_search)) $cpy_user_search = new ccpy_user_search();

// Page init
$cpy_user_search->Page_Init();

// Page main
$cpy_user_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_user_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($cpy_user_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fcpy_usersearch = new ew_Form("fcpy_usersearch", "search");
<?php } else { ?>
var CurrentForm = fcpy_usersearch = new ew_Form("fcpy_usersearch", "search");
<?php } ?>

// Form_CustomValidate event
fcpy_usersearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_usersearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_usersearch.Lists["x_cntry_id"] = {"LinkField":"x_cntry_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cntry_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_country"};
fcpy_usersearch.Lists["x_cntry_id"].Data = "<?php echo $cpy_user_search->cntry_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_usersearch.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_usersearch.Lists["x_lang_id"].Data = "<?php echo $cpy_user_search->lang_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_usersearch.Lists["x_pgrp_id"] = {"LinkField":"x_pgrp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pgrp_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_pgroup"};
fcpy_usersearch.Lists["x_pgrp_id"].Data = "<?php echo $cpy_user_search->pgrp_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_usersearch.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_usersearch.Lists["x_status_id"].Data = "<?php echo $cpy_user_search->status_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_usersearch.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fcpy_usersearch.Lists["x_gend_id"].Data = "<?php echo $cpy_user_search->gend_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fcpy_usersearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_ins_datetime");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_user->ins_datetime->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_upd_datetime");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_user->upd_datetime->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_user_search->ShowPageHeader(); ?>
<?php
$cpy_user_search->ShowMessage();
?>
<form name="fcpy_usersearch" id="fcpy_usersearch" class="<?php echo $cpy_user_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_user_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_user_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_user">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($cpy_user_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($cpy_user->cntry_id->Visible) { // cntry_id ?>
	<div id="r_cntry_id" class="form-group">
		<label for="x_cntry_id" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_cntry_id"><?php echo $cpy_user->cntry_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cntry_id" id="z_cntry_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->cntry_id->CellAttributes() ?>>
			<span id="el_cpy_user_cntry_id">
<select data-table="cpy_user" data-field="x_cntry_id" data-value-separator="<?php echo $cpy_user->cntry_id->DisplayValueSeparatorAttribute() ?>" id="x_cntry_id" name="x_cntry_id"<?php echo $cpy_user->cntry_id->EditAttributes() ?>>
<?php echo $cpy_user->cntry_id->SelectOptionListHtml("x_cntry_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_lang_id"><?php echo $cpy_user->lang_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_lang_id" id="z_lang_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->lang_id->CellAttributes() ?>>
			<span id="el_cpy_user_lang_id">
<select data-table="cpy_user" data-field="x_lang_id" data-value-separator="<?php echo $cpy_user->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $cpy_user->lang_id->EditAttributes() ?>>
<?php echo $cpy_user->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->pgrp_id->Visible) { // pgrp_id ?>
	<div id="r_pgrp_id" class="form-group">
		<label for="x_pgrp_id" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_pgrp_id"><?php echo $cpy_user->pgrp_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pgrp_id" id="z_pgrp_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->pgrp_id->CellAttributes() ?>>
			<span id="el_cpy_user_pgrp_id">
<select data-table="cpy_user" data-field="x_pgrp_id" data-value-separator="<?php echo $cpy_user->pgrp_id->DisplayValueSeparatorAttribute() ?>" id="x_pgrp_id" name="x_pgrp_id"<?php echo $cpy_user->pgrp_id->EditAttributes() ?>>
<?php echo $cpy_user->pgrp_id->SelectOptionListHtml("x_pgrp_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_status_id"><?php echo $cpy_user->status_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status_id" id="z_status_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->status_id->CellAttributes() ?>>
			<span id="el_cpy_user_status_id">
<select data-table="cpy_user" data-field="x_status_id" data-value-separator="<?php echo $cpy_user->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $cpy_user->status_id->EditAttributes() ?>>
<?php echo $cpy_user->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->gend_id->Visible) { // gend_id ?>
	<div id="r_gend_id" class="form-group">
		<label for="x_gend_id" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_gend_id"><?php echo $cpy_user->gend_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_gend_id" id="z_gend_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->gend_id->CellAttributes() ?>>
			<span id="el_cpy_user_gend_id">
<select data-table="cpy_user" data-field="x_gend_id" data-value-separator="<?php echo $cpy_user->gend_id->DisplayValueSeparatorAttribute() ?>" id="x_gend_id" name="x_gend_id"<?php echo $cpy_user->gend_id->EditAttributes() ?>>
<?php echo $cpy_user->gend_id->SelectOptionListHtml("x_gend_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_name->Visible) { // user_name ?>
	<div id="r_user_name" class="form-group">
		<label for="x_user_name" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_user_name"><?php echo $cpy_user->user_name->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user_name" id="z_user_name" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->user_name->CellAttributes() ?>>
			<span id="el_cpy_user_user_name">
<input type="text" data-table="cpy_user" data-field="x_user_name" name="x_user_name" id="x_user_name" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_name->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_name->EditValue ?>"<?php echo $cpy_user->user_name->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_email->Visible) { // user_email ?>
	<div id="r_user_email" class="form-group">
		<label for="x_user_email" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_user_email"><?php echo $cpy_user->user_email->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user_email" id="z_user_email" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->user_email->CellAttributes() ?>>
			<span id="el_cpy_user_user_email">
<input type="text" data-table="cpy_user" data-field="x_user_email" name="x_user_email" id="x_user_email" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_email->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_email->EditValue ?>"<?php echo $cpy_user->user_email->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_password->Visible) { // user_password ?>
	<div id="r_user_password" class="form-group">
		<label for="x_user_password" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_user_password"><?php echo $cpy_user->user_password->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user_password" id="z_user_password" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->user_password->CellAttributes() ?>>
			<span id="el_cpy_user_user_password">
<input type="text" data-table="cpy_user" data-field="x_user_password" name="x_user_password" id="x_user_password" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_password->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_password->EditValue ?>"<?php echo $cpy_user->user_password->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_mobile->Visible) { // user_mobile ?>
	<div id="r_user_mobile" class="form-group">
		<label for="x_user_mobile" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_user_mobile"><?php echo $cpy_user->user_mobile->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user_mobile" id="z_user_mobile" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->user_mobile->CellAttributes() ?>>
			<span id="el_cpy_user_user_mobile">
<input type="text" data-table="cpy_user" data-field="x_user_mobile" name="x_user_mobile" id="x_user_mobile" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_mobile->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_mobile->EditValue ?>"<?php echo $cpy_user->user_mobile->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->user_token->Visible) { // user_token ?>
	<div id="r_user_token" class="form-group">
		<label for="x_user_token" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_user_token"><?php echo $cpy_user->user_token->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user_token" id="z_user_token" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->user_token->CellAttributes() ?>>
			<span id="el_cpy_user_user_token">
<input type="text" data-table="cpy_user" data-field="x_user_token" name="x_user_token" id="x_user_token" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_user->user_token->getPlaceHolder()) ?>" value="<?php echo $cpy_user->user_token->EditValue ?>"<?php echo $cpy_user->user_token->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_ins_datetime"><?php echo $cpy_user->ins_datetime->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ins_datetime" id="z_ins_datetime" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->ins_datetime->CellAttributes() ?>>
			<span id="el_cpy_user_ins_datetime">
<input type="text" data-table="cpy_user" data-field="x_ins_datetime" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($cpy_user->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $cpy_user->ins_datetime->EditValue ?>"<?php echo $cpy_user->ins_datetime->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_user->upd_datetime->Visible) { // upd_datetime ?>
	<div id="r_upd_datetime" class="form-group">
		<label for="x_upd_datetime" class="<?php echo $cpy_user_search->LeftColumnClass ?>"><span id="elh_cpy_user_upd_datetime"><?php echo $cpy_user->upd_datetime->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_upd_datetime" id="z_upd_datetime" value="="></p>
		</label>
		<div class="<?php echo $cpy_user_search->RightColumnClass ?>"><div<?php echo $cpy_user->upd_datetime->CellAttributes() ?>>
			<span id="el_cpy_user_upd_datetime">
<input type="text" data-table="cpy_user" data-field="x_upd_datetime" name="x_upd_datetime" id="x_upd_datetime" placeholder="<?php echo ew_HtmlEncode($cpy_user->upd_datetime->getPlaceHolder()) ?>" value="<?php echo $cpy_user->upd_datetime->EditValue ?>"<?php echo $cpy_user->upd_datetime->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cpy_user_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_user_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_usersearch.Init();
</script>
<?php
$cpy_user_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_user_search->Page_Terminate();
?>
