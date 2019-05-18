<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_consultationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_consultation_search = NULL; // Initialize page object first

class capp_consultation_search extends capp_consultation {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_consultation';

	// Page object name
	var $PageObjName = 'app_consultation_search';

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

		// Table object (app_consultation)
		if (!isset($GLOBALS["app_consultation"]) || get_class($GLOBALS["app_consultation"]) == "capp_consultation") {
			$GLOBALS["app_consultation"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_consultation"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_consultation', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_consultationlist.php"));
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
		$this->user_id->SetVisibility();
		$this->cstatus_id->SetVisibility();
		$this->cat_id->SetVisibility();
		$this->cons_amount->SetVisibility();
		$this->cons_file->SetVisibility();
		$this->cons_audio->SetVisibility();
		$this->cons_message->SetVisibility();
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
		global $EW_EXPORT, $app_consultation;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_consultation);
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
					if ($pageName == "app_consultationview.php")
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
						$sSrchStr = "app_consultationlist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->user_id); // user_id
		$this->BuildSearchUrl($sSrchUrl, $this->cstatus_id); // cstatus_id
		$this->BuildSearchUrl($sSrchUrl, $this->cat_id); // cat_id
		$this->BuildSearchUrl($sSrchUrl, $this->cons_amount); // cons_amount
		$this->BuildSearchUrl($sSrchUrl, $this->cons_file); // cons_file
		$this->BuildSearchUrl($sSrchUrl, $this->cons_audio); // cons_audio
		$this->BuildSearchUrl($sSrchUrl, $this->cons_message); // cons_message
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
		// user_id

		$this->user_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_id");
		$this->user_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_id");

		// cstatus_id
		$this->cstatus_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cstatus_id");
		$this->cstatus_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cstatus_id");

		// cat_id
		$this->cat_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cat_id");
		$this->cat_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cat_id");

		// cons_amount
		$this->cons_amount->AdvancedSearch->SearchValue = $objForm->GetValue("x_cons_amount");
		$this->cons_amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cons_amount");

		// cons_file
		$this->cons_file->AdvancedSearch->SearchValue = $objForm->GetValue("x_cons_file");
		$this->cons_file->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cons_file");

		// cons_audio
		$this->cons_audio->AdvancedSearch->SearchValue = $objForm->GetValue("x_cons_audio");
		$this->cons_audio->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cons_audio");

		// cons_message
		$this->cons_message->AdvancedSearch->SearchValue = $objForm->GetValue("x_cons_message");
		$this->cons_message->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cons_message");

		// ins_datetime
		$this->ins_datetime->AdvancedSearch->SearchValue = $objForm->GetValue("x_ins_datetime");
		$this->ins_datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ins_datetime");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->cons_amount->FormValue == $this->cons_amount->CurrentValue && is_numeric(ew_StrToFloat($this->cons_amount->CurrentValue)))
			$this->cons_amount->CurrentValue = ew_StrToFloat($this->cons_amount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// cons_id
		// user_id
		// cstatus_id
		// cat_id
		// cons_amount
		// cons_file
		// cons_audio
		// cons_message
		// ins_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// user_id
		if (strval($this->user_id->CurrentValue) <> "") {
			$sFilterWrk = "`user_id`" . ew_SearchString("=", $this->user_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `user_id`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
		$sWhereWrk = "";
		$this->user_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `user_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->user_id->ViewValue = $this->user_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->user_id->ViewValue = $this->user_id->CurrentValue;
			}
		} else {
			$this->user_id->ViewValue = NULL;
		}
		$this->user_id->ViewCustomAttributes = "";

		// cstatus_id
		if (strval($this->cstatus_id->CurrentValue) <> "") {
			$sFilterWrk = "`cstatus_id`" . ew_SearchString("=", $this->cstatus_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cstatus_id`, `cstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_status`";
		$sWhereWrk = "";
		$this->cstatus_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cstatus_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cstatus_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cstatus_id->ViewValue = $this->cstatus_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cstatus_id->ViewValue = $this->cstatus_id->CurrentValue;
			}
		} else {
			$this->cstatus_id->ViewValue = NULL;
		}
		$this->cstatus_id->ViewCustomAttributes = "";

		// cat_id
		if (strval($this->cat_id->CurrentValue) <> "") {
			$sFilterWrk = "`cat_id`" . ew_SearchString("=", $this->cat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cat_id`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_category`";
		$sWhereWrk = "";
		$this->cat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cat_id->ViewValue = $this->cat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cat_id->ViewValue = $this->cat_id->CurrentValue;
			}
		} else {
			$this->cat_id->ViewValue = NULL;
		}
		$this->cat_id->ViewCustomAttributes = "";

		// cons_amount
		$this->cons_amount->ViewValue = $this->cons_amount->CurrentValue;
		$this->cons_amount->ViewCustomAttributes = "";

		// cons_file
		$this->cons_file->ViewValue = $this->cons_file->CurrentValue;
		$this->cons_file->ViewCustomAttributes = "";

		// cons_audio
		$this->cons_audio->ViewValue = $this->cons_audio->CurrentValue;
		$this->cons_audio->ViewCustomAttributes = "";

		// cons_message
		$this->cons_message->ViewValue = $this->cons_message->CurrentValue;
		$this->cons_message->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// cstatus_id
			$this->cstatus_id->LinkCustomAttributes = "";
			$this->cstatus_id->HrefValue = "";
			$this->cstatus_id->TooltipValue = "";

			// cat_id
			$this->cat_id->LinkCustomAttributes = "";
			$this->cat_id->HrefValue = "";
			$this->cat_id->TooltipValue = "";

			// cons_amount
			$this->cons_amount->LinkCustomAttributes = "";
			$this->cons_amount->HrefValue = "";
			$this->cons_amount->TooltipValue = "";

			// cons_file
			$this->cons_file->LinkCustomAttributes = "";
			$this->cons_file->HrefValue = "";
			$this->cons_file->TooltipValue = "";

			// cons_audio
			$this->cons_audio->LinkCustomAttributes = "";
			$this->cons_audio->HrefValue = "";
			$this->cons_audio->TooltipValue = "";

			// cons_message
			$this->cons_message->LinkCustomAttributes = "";
			$this->cons_message->HrefValue = "";
			$this->cons_message->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			if (trim(strval($this->user_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`user_id`" . ew_SearchString("=", $this->user_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `user_id`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_user`";
			$sWhereWrk = "";
			$this->user_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `user_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->user_id->EditValue = $arwrk;

			// cstatus_id
			$this->cstatus_id->EditAttrs["class"] = "form-control";
			$this->cstatus_id->EditCustomAttributes = "";
			if (trim(strval($this->cstatus_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cstatus_id`" . ew_SearchString("=", $this->cstatus_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cstatus_id`, `cstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation_status`";
			$sWhereWrk = "";
			$this->cstatus_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cstatus_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cstatus_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cstatus_id->EditValue = $arwrk;

			// cat_id
			$this->cat_id->EditAttrs["class"] = "form-control";
			$this->cat_id->EditCustomAttributes = "";
			if (trim(strval($this->cat_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cat_id`" . ew_SearchString("=", $this->cat_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cat_id`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation_category`";
			$sWhereWrk = "";
			$this->cat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cat_id->EditValue = $arwrk;

			// cons_amount
			$this->cons_amount->EditAttrs["class"] = "form-control";
			$this->cons_amount->EditCustomAttributes = "";
			$this->cons_amount->EditValue = ew_HtmlEncode($this->cons_amount->AdvancedSearch->SearchValue);
			$this->cons_amount->PlaceHolder = ew_RemoveHtml($this->cons_amount->FldCaption());

			// cons_file
			$this->cons_file->EditAttrs["class"] = "form-control";
			$this->cons_file->EditCustomAttributes = "";
			$this->cons_file->EditValue = ew_HtmlEncode($this->cons_file->AdvancedSearch->SearchValue);
			$this->cons_file->PlaceHolder = ew_RemoveHtml($this->cons_file->FldCaption());

			// cons_audio
			$this->cons_audio->EditAttrs["class"] = "form-control";
			$this->cons_audio->EditCustomAttributes = "";
			$this->cons_audio->EditValue = ew_HtmlEncode($this->cons_audio->AdvancedSearch->SearchValue);
			$this->cons_audio->PlaceHolder = ew_RemoveHtml($this->cons_audio->FldCaption());

			// cons_message
			$this->cons_message->EditAttrs["class"] = "form-control";
			$this->cons_message->EditCustomAttributes = "";
			$this->cons_message->EditValue = ew_HtmlEncode($this->cons_message->AdvancedSearch->SearchValue);
			$this->cons_message->PlaceHolder = ew_RemoveHtml($this->cons_message->FldCaption());

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
		if (!ew_CheckNumber($this->cons_amount->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->cons_amount->FldErrMsg());
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
		$this->user_id->AdvancedSearch->Load();
		$this->cstatus_id->AdvancedSearch->Load();
		$this->cat_id->AdvancedSearch->Load();
		$this->cons_amount->AdvancedSearch->Load();
		$this->cons_file->AdvancedSearch->Load();
		$this->cons_audio->AdvancedSearch->Load();
		$this->cons_message->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_consultationlist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_user_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `user_id` AS `LinkFld`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`user_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `user_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cstatus_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cstatus_id` AS `LinkFld`, `cstatus_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_status`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cstatus_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cstatus_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cstatus_id`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cat_id` AS `LinkFld`, `cat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation_category`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cat_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cat_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($app_consultation_search)) $app_consultation_search = new capp_consultation_search();

// Page init
$app_consultation_search->Page_Init();

// Page main
$app_consultation_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consultation_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($app_consultation_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fapp_consultationsearch = new ew_Form("fapp_consultationsearch", "search");
<?php } else { ?>
var CurrentForm = fapp_consultationsearch = new ew_Form("fapp_consultationsearch", "search");
<?php } ?>

// Form_CustomValidate event
fapp_consultationsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consultationsearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consultationsearch.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_consultationsearch.Lists["x_user_id"].Data = "<?php echo $app_consultation_search->user_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_consultationsearch.Lists["x_cstatus_id"] = {"LinkField":"x_cstatus_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cstatus_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_status"};
fapp_consultationsearch.Lists["x_cstatus_id"].Data = "<?php echo $app_consultation_search->cstatus_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_consultationsearch.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_consultationsearch.Lists["x_cat_id"].Data = "<?php echo $app_consultation_search->cat_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fapp_consultationsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_cons_amount");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_consultation->cons_amount->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_ins_datetime");
	if (elm && !ew_CheckEuroDate(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_consultation->ins_datetime->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_consultation_search->ShowPageHeader(); ?>
<?php
$app_consultation_search->ShowMessage();
?>
<form name="fapp_consultationsearch" id="fapp_consultationsearch" class="<?php echo $app_consultation_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_consultation_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_consultation_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_consultation">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($app_consultation_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($app_consultation->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label for="x_user_id" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_user_id"><?php echo $app_consultation->user_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->user_id->CellAttributes() ?>>
			<span id="el_app_consultation_user_id">
<select data-table="app_consultation" data-field="x_user_id" data-value-separator="<?php echo $app_consultation->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_consultation->user_id->EditAttributes() ?>>
<?php echo $app_consultation->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cstatus_id->Visible) { // cstatus_id ?>
	<div id="r_cstatus_id" class="form-group">
		<label for="x_cstatus_id" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_cstatus_id"><?php echo $app_consultation->cstatus_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cstatus_id" id="z_cstatus_id" value="="></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->cstatus_id->CellAttributes() ?>>
			<span id="el_app_consultation_cstatus_id">
<select data-table="app_consultation" data-field="x_cstatus_id" data-value-separator="<?php echo $app_consultation->cstatus_id->DisplayValueSeparatorAttribute() ?>" id="x_cstatus_id" name="x_cstatus_id"<?php echo $app_consultation->cstatus_id->EditAttributes() ?>>
<?php echo $app_consultation->cstatus_id->SelectOptionListHtml("x_cstatus_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cat_id->Visible) { // cat_id ?>
	<div id="r_cat_id" class="form-group">
		<label for="x_cat_id" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_cat_id"><?php echo $app_consultation->cat_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cat_id" id="z_cat_id" value="="></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->cat_id->CellAttributes() ?>>
			<span id="el_app_consultation_cat_id">
<select data-table="app_consultation" data-field="x_cat_id" data-value-separator="<?php echo $app_consultation->cat_id->DisplayValueSeparatorAttribute() ?>" id="x_cat_id" name="x_cat_id"<?php echo $app_consultation->cat_id->EditAttributes() ?>>
<?php echo $app_consultation->cat_id->SelectOptionListHtml("x_cat_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_amount->Visible) { // cons_amount ?>
	<div id="r_cons_amount" class="form-group">
		<label for="x_cons_amount" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_cons_amount"><?php echo $app_consultation->cons_amount->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cons_amount" id="z_cons_amount" value="="></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->cons_amount->CellAttributes() ?>>
			<span id="el_app_consultation_cons_amount">
<input type="text" data-table="app_consultation" data-field="x_cons_amount" name="x_cons_amount" id="x_cons_amount" size="30" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_amount->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_amount->EditValue ?>"<?php echo $app_consultation->cons_amount->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_file->Visible) { // cons_file ?>
	<div id="r_cons_file" class="form-group">
		<label for="x_cons_file" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_cons_file"><?php echo $app_consultation->cons_file->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_cons_file" id="z_cons_file" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->cons_file->CellAttributes() ?>>
			<span id="el_app_consultation_cons_file">
<input type="text" data-table="app_consultation" data-field="x_cons_file" name="x_cons_file" id="x_cons_file" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_file->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_file->EditValue ?>"<?php echo $app_consultation->cons_file->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_audio->Visible) { // cons_audio ?>
	<div id="r_cons_audio" class="form-group">
		<label for="x_cons_audio" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_cons_audio"><?php echo $app_consultation->cons_audio->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_cons_audio" id="z_cons_audio" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->cons_audio->CellAttributes() ?>>
			<span id="el_app_consultation_cons_audio">
<input type="text" data-table="app_consultation" data-field="x_cons_audio" name="x_cons_audio" id="x_cons_audio" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_audio->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_audio->EditValue ?>"<?php echo $app_consultation->cons_audio->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->cons_message->Visible) { // cons_message ?>
	<div id="r_cons_message" class="form-group">
		<label for="x_cons_message" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_cons_message"><?php echo $app_consultation->cons_message->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_cons_message" id="z_cons_message" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->cons_message->CellAttributes() ?>>
			<span id="el_app_consultation_cons_message">
<input type="text" data-table="app_consultation" data-field="x_cons_message" name="x_cons_message" id="x_cons_message" size="35" placeholder="<?php echo ew_HtmlEncode($app_consultation->cons_message->getPlaceHolder()) ?>" value="<?php echo $app_consultation->cons_message->EditValue ?>"<?php echo $app_consultation->cons_message->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consultation->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $app_consultation_search->LeftColumnClass ?>"><span id="elh_app_consultation_ins_datetime"><?php echo $app_consultation->ins_datetime->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ins_datetime" id="z_ins_datetime" value="="></p>
		</label>
		<div class="<?php echo $app_consultation_search->RightColumnClass ?>"><div<?php echo $app_consultation->ins_datetime->CellAttributes() ?>>
			<span id="el_app_consultation_ins_datetime">
<input type="text" data-table="app_consultation" data-field="x_ins_datetime" data-format="11" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_consultation->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_consultation->ins_datetime->EditValue ?>"<?php echo $app_consultation->ins_datetime->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_consultation_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_consultation_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_consultationsearch.Init();
</script>
<?php
$app_consultation_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_consultation_search->Page_Terminate();
?>
