<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "phs_languageinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$phs_language_search = NULL; // Initialize page object first

class cphs_language_search extends cphs_language {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'phs_language';

	// Page object name
	var $PageObjName = 'phs_language_search';

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

		// Table object (phs_language)
		if (!isset($GLOBALS["phs_language"]) || get_class($GLOBALS["phs_language"]) == "cphs_language") {
			$GLOBALS["phs_language"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["phs_language"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'phs_language', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("phs_languagelist.php"));
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
		$this->lang_code->SetVisibility();
		$this->lang_dir->SetVisibility();
		$this->lang_name->SetVisibility();
		$this->lang_dname->SetVisibility();
		$this->lang_ccode->SetVisibility();

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
		global $EW_EXPORT, $phs_language;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($phs_language);
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
					if ($pageName == "phs_languageview.php")
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
						$sSrchStr = "phs_languagelist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->lang_code); // lang_code
		$this->BuildSearchUrl($sSrchUrl, $this->lang_dir); // lang_dir
		$this->BuildSearchUrl($sSrchUrl, $this->lang_name); // lang_name
		$this->BuildSearchUrl($sSrchUrl, $this->lang_dname); // lang_dname
		$this->BuildSearchUrl($sSrchUrl, $this->lang_ccode); // lang_ccode
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

		// lang_code
		$this->lang_code->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_code");
		$this->lang_code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_code");

		// lang_dir
		$this->lang_dir->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_dir");
		$this->lang_dir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_dir");

		// lang_name
		$this->lang_name->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_name");
		$this->lang_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_name");

		// lang_dname
		$this->lang_dname->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_dname");
		$this->lang_dname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_dname");

		// lang_ccode
		$this->lang_ccode->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_ccode");
		$this->lang_ccode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_ccode");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// lang_id
		// status_id
		// lang_code
		// lang_dir
		// lang_name
		// lang_dname
		// lang_ccode

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

		// lang_code
		$this->lang_code->ViewValue = $this->lang_code->CurrentValue;
		$this->lang_code->ViewCustomAttributes = "";

		// lang_dir
		if (strval($this->lang_dir->CurrentValue) <> "") {
			$this->lang_dir->ViewValue = $this->lang_dir->OptionCaption($this->lang_dir->CurrentValue);
		} else {
			$this->lang_dir->ViewValue = NULL;
		}
		$this->lang_dir->ViewCustomAttributes = "";

		// lang_name
		$this->lang_name->ViewValue = $this->lang_name->CurrentValue;
		$this->lang_name->ViewCustomAttributes = "";

		// lang_dname
		$this->lang_dname->ViewValue = $this->lang_dname->CurrentValue;
		$this->lang_dname->ViewCustomAttributes = "";

		// lang_ccode
		$this->lang_ccode->ViewValue = $this->lang_ccode->CurrentValue;
		$this->lang_ccode->ViewCustomAttributes = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// lang_code
			$this->lang_code->LinkCustomAttributes = "";
			$this->lang_code->HrefValue = "";
			$this->lang_code->TooltipValue = "";

			// lang_dir
			$this->lang_dir->LinkCustomAttributes = "";
			$this->lang_dir->HrefValue = "";
			$this->lang_dir->TooltipValue = "";

			// lang_name
			$this->lang_name->LinkCustomAttributes = "";
			$this->lang_name->HrefValue = "";
			$this->lang_name->TooltipValue = "";

			// lang_dname
			$this->lang_dname->LinkCustomAttributes = "";
			$this->lang_dname->HrefValue = "";
			$this->lang_dname->TooltipValue = "";

			// lang_ccode
			$this->lang_ccode->LinkCustomAttributes = "";
			$this->lang_ccode->HrefValue = "";
			$this->lang_ccode->TooltipValue = "";
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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// lang_code
			$this->lang_code->EditAttrs["class"] = "form-control";
			$this->lang_code->EditCustomAttributes = "";
			$this->lang_code->EditValue = ew_HtmlEncode($this->lang_code->AdvancedSearch->SearchValue);
			$this->lang_code->PlaceHolder = ew_RemoveHtml($this->lang_code->FldCaption());

			// lang_dir
			$this->lang_dir->EditAttrs["class"] = "form-control";
			$this->lang_dir->EditCustomAttributes = "";
			$this->lang_dir->EditValue = $this->lang_dir->Options(TRUE);

			// lang_name
			$this->lang_name->EditAttrs["class"] = "form-control";
			$this->lang_name->EditCustomAttributes = "";
			$this->lang_name->EditValue = ew_HtmlEncode($this->lang_name->AdvancedSearch->SearchValue);
			$this->lang_name->PlaceHolder = ew_RemoveHtml($this->lang_name->FldCaption());

			// lang_dname
			$this->lang_dname->EditAttrs["class"] = "form-control";
			$this->lang_dname->EditCustomAttributes = "";
			$this->lang_dname->EditValue = ew_HtmlEncode($this->lang_dname->AdvancedSearch->SearchValue);
			$this->lang_dname->PlaceHolder = ew_RemoveHtml($this->lang_dname->FldCaption());

			// lang_ccode
			$this->lang_ccode->EditAttrs["class"] = "form-control";
			$this->lang_ccode->EditCustomAttributes = "";
			$this->lang_ccode->EditValue = ew_HtmlEncode($this->lang_ccode->AdvancedSearch->SearchValue);
			$this->lang_ccode->PlaceHolder = ew_RemoveHtml($this->lang_ccode->FldCaption());
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
		$this->lang_code->AdvancedSearch->Load();
		$this->lang_dir->AdvancedSearch->Load();
		$this->lang_name->AdvancedSearch->Load();
		$this->lang_dname->AdvancedSearch->Load();
		$this->lang_ccode->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("phs_languagelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($phs_language_search)) $phs_language_search = new cphs_language_search();

// Page init
$phs_language_search->Page_Init();

// Page main
$phs_language_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phs_language_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($phs_language_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fphs_languagesearch = new ew_Form("fphs_languagesearch", "search");
<?php } else { ?>
var CurrentForm = fphs_languagesearch = new ew_Form("fphs_languagesearch", "search");
<?php } ?>

// Form_CustomValidate event
fphs_languagesearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fphs_languagesearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fphs_languagesearch.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fphs_languagesearch.Lists["x_status_id"].Data = "<?php echo $phs_language_search->status_id->LookupFilterQuery(FALSE, "search") ?>";
fphs_languagesearch.Lists["x_lang_dir"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fphs_languagesearch.Lists["x_lang_dir"].Options = <?php echo json_encode($phs_language_search->lang_dir->Options()) ?>;

// Form object for search
// Validate function for search

fphs_languagesearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $phs_language_search->ShowPageHeader(); ?>
<?php
$phs_language_search->ShowMessage();
?>
<form name="fphs_languagesearch" id="fphs_languagesearch" class="<?php echo $phs_language_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($phs_language_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $phs_language_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="phs_language">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($phs_language_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($phs_language->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group">
		<label for="x_status_id" class="<?php echo $phs_language_search->LeftColumnClass ?>"><span id="elh_phs_language_status_id"><?php echo $phs_language->status_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status_id" id="z_status_id" value="="></p>
		</label>
		<div class="<?php echo $phs_language_search->RightColumnClass ?>"><div<?php echo $phs_language->status_id->CellAttributes() ?>>
			<span id="el_phs_language_status_id">
<select data-table="phs_language" data-field="x_status_id" data-value-separator="<?php echo $phs_language->status_id->DisplayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $phs_language->status_id->EditAttributes() ?>>
<?php echo $phs_language->status_id->SelectOptionListHtml("x_status_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_code->Visible) { // lang_code ?>
	<div id="r_lang_code" class="form-group">
		<label for="x_lang_code" class="<?php echo $phs_language_search->LeftColumnClass ?>"><span id="elh_phs_language_lang_code"><?php echo $phs_language->lang_code->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lang_code" id="z_lang_code" value="LIKE"></p>
		</label>
		<div class="<?php echo $phs_language_search->RightColumnClass ?>"><div<?php echo $phs_language->lang_code->CellAttributes() ?>>
			<span id="el_phs_language_lang_code">
<input type="text" data-table="phs_language" data-field="x_lang_code" name="x_lang_code" id="x_lang_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_code->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_code->EditValue ?>"<?php echo $phs_language->lang_code->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_dir->Visible) { // lang_dir ?>
	<div id="r_lang_dir" class="form-group">
		<label for="x_lang_dir" class="<?php echo $phs_language_search->LeftColumnClass ?>"><span id="elh_phs_language_lang_dir"><?php echo $phs_language->lang_dir->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lang_dir" id="z_lang_dir" value="LIKE"></p>
		</label>
		<div class="<?php echo $phs_language_search->RightColumnClass ?>"><div<?php echo $phs_language->lang_dir->CellAttributes() ?>>
			<span id="el_phs_language_lang_dir">
<select data-table="phs_language" data-field="x_lang_dir" data-value-separator="<?php echo $phs_language->lang_dir->DisplayValueSeparatorAttribute() ?>" id="x_lang_dir" name="x_lang_dir"<?php echo $phs_language->lang_dir->EditAttributes() ?>>
<?php echo $phs_language->lang_dir->SelectOptionListHtml("x_lang_dir") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_name->Visible) { // lang_name ?>
	<div id="r_lang_name" class="form-group">
		<label for="x_lang_name" class="<?php echo $phs_language_search->LeftColumnClass ?>"><span id="elh_phs_language_lang_name"><?php echo $phs_language->lang_name->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lang_name" id="z_lang_name" value="LIKE"></p>
		</label>
		<div class="<?php echo $phs_language_search->RightColumnClass ?>"><div<?php echo $phs_language->lang_name->CellAttributes() ?>>
			<span id="el_phs_language_lang_name">
<input type="text" data-table="phs_language" data-field="x_lang_name" name="x_lang_name" id="x_lang_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_name->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_name->EditValue ?>"<?php echo $phs_language->lang_name->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_dname->Visible) { // lang_dname ?>
	<div id="r_lang_dname" class="form-group">
		<label for="x_lang_dname" class="<?php echo $phs_language_search->LeftColumnClass ?>"><span id="elh_phs_language_lang_dname"><?php echo $phs_language->lang_dname->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lang_dname" id="z_lang_dname" value="LIKE"></p>
		</label>
		<div class="<?php echo $phs_language_search->RightColumnClass ?>"><div<?php echo $phs_language->lang_dname->CellAttributes() ?>>
			<span id="el_phs_language_lang_dname">
<input type="text" data-table="phs_language" data-field="x_lang_dname" name="x_lang_dname" id="x_lang_dname" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_dname->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_dname->EditValue ?>"<?php echo $phs_language->lang_dname->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($phs_language->lang_ccode->Visible) { // lang_ccode ?>
	<div id="r_lang_ccode" class="form-group">
		<label for="x_lang_ccode" class="<?php echo $phs_language_search->LeftColumnClass ?>"><span id="elh_phs_language_lang_ccode"><?php echo $phs_language->lang_ccode->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lang_ccode" id="z_lang_ccode" value="LIKE"></p>
		</label>
		<div class="<?php echo $phs_language_search->RightColumnClass ?>"><div<?php echo $phs_language->lang_ccode->CellAttributes() ?>>
			<span id="el_phs_language_lang_ccode">
<input type="text" data-table="phs_language" data-field="x_lang_ccode" name="x_lang_ccode" id="x_lang_ccode" size="30" maxlength="5" placeholder="<?php echo ew_HtmlEncode($phs_language->lang_ccode->getPlaceHolder()) ?>" value="<?php echo $phs_language->lang_ccode->EditValue ?>"<?php echo $phs_language->lang_ccode->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$phs_language_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $phs_language_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fphs_languagesearch.Init();
</script>
<?php
$phs_language_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$phs_language_search->Page_Terminate();
?>
