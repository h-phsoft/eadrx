<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_team_namesinfo.php" ?>
<?php include_once "cpy_teaminfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_team_names_search = NULL; // Initialize page object first

class ccpy_team_names_search extends ccpy_team_names {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_team_names';

	// Page object name
	var $PageObjName = 'cpy_team_names_search';

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

		// Table object (cpy_team_names)
		if (!isset($GLOBALS["cpy_team_names"]) || get_class($GLOBALS["cpy_team_names"]) == "ccpy_team_names") {
			$GLOBALS["cpy_team_names"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_team_names"];
		}

		// Table object (cpy_team)
		if (!isset($GLOBALS['cpy_team'])) $GLOBALS['cpy_team'] = new ccpy_team();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_team_names', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_team_nameslist.php"));
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
		$this->teamn_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->teamn_id->Visible = FALSE;
		$this->team_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->team_name->SetVisibility();
		$this->team_title->SetVisibility();
		$this->team_position->SetVisibility();
		$this->team_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_team_names;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_team_names);
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
					if ($pageName == "cpy_team_namesview.php")
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
						$sSrchStr = "cpy_team_nameslist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->teamn_id); // teamn_id
		$this->BuildSearchUrl($sSrchUrl, $this->team_id); // team_id
		$this->BuildSearchUrl($sSrchUrl, $this->lang_id); // lang_id
		$this->BuildSearchUrl($sSrchUrl, $this->team_name); // team_name
		$this->BuildSearchUrl($sSrchUrl, $this->team_title); // team_title
		$this->BuildSearchUrl($sSrchUrl, $this->team_position); // team_position
		$this->BuildSearchUrl($sSrchUrl, $this->team_text); // team_text
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
		// teamn_id

		$this->teamn_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_teamn_id");
		$this->teamn_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_teamn_id");

		// team_id
		$this->team_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_team_id");
		$this->team_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_team_id");

		// lang_id
		$this->lang_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_id");
		$this->lang_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_id");

		// team_name
		$this->team_name->AdvancedSearch->SearchValue = $objForm->GetValue("x_team_name");
		$this->team_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_team_name");

		// team_title
		$this->team_title->AdvancedSearch->SearchValue = $objForm->GetValue("x_team_title");
		$this->team_title->AdvancedSearch->SearchOperator = $objForm->GetValue("z_team_title");

		// team_position
		$this->team_position->AdvancedSearch->SearchValue = $objForm->GetValue("x_team_position");
		$this->team_position->AdvancedSearch->SearchOperator = $objForm->GetValue("z_team_position");

		// team_text
		$this->team_text->AdvancedSearch->SearchValue = $objForm->GetValue("x_team_text");
		$this->team_text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_team_text");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// teamn_id
		// team_id
		// lang_id
		// team_name
		// team_title
		// team_position
		// team_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// teamn_id
		$this->teamn_id->ViewValue = $this->teamn_id->CurrentValue;
		$this->teamn_id->ViewCustomAttributes = "";

		// team_id
		if (strval($this->team_id->CurrentValue) <> "") {
			$sFilterWrk = "`team_id`" . ew_SearchString("=", $this->team_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `team_id`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_team`";
		$sWhereWrk = "";
		$this->team_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `team_order`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->team_id->ViewValue = $this->team_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->team_id->ViewValue = $this->team_id->CurrentValue;
			}
		} else {
			$this->team_id->ViewValue = NULL;
		}
		$this->team_id->ViewCustomAttributes = "";

		// lang_id
		if (strval($this->lang_id->CurrentValue) <> "") {
			$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `lang_id`, `lang_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
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

		// team_name
		$this->team_name->ViewValue = $this->team_name->CurrentValue;
		$this->team_name->ViewCustomAttributes = "";

		// team_title
		$this->team_title->ViewValue = $this->team_title->CurrentValue;
		$this->team_title->ViewCustomAttributes = "";

		// team_position
		$this->team_position->ViewValue = $this->team_position->CurrentValue;
		$this->team_position->ViewCustomAttributes = "";

		// team_text
		$this->team_text->ViewValue = $this->team_text->CurrentValue;
		$this->team_text->ViewCustomAttributes = "";

			// teamn_id
			$this->teamn_id->LinkCustomAttributes = "";
			$this->teamn_id->HrefValue = "";
			$this->teamn_id->TooltipValue = "";

			// team_id
			$this->team_id->LinkCustomAttributes = "";
			$this->team_id->HrefValue = "";
			$this->team_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// team_name
			$this->team_name->LinkCustomAttributes = "";
			$this->team_name->HrefValue = "";
			$this->team_name->TooltipValue = "";

			// team_title
			$this->team_title->LinkCustomAttributes = "";
			$this->team_title->HrefValue = "";
			$this->team_title->TooltipValue = "";

			// team_position
			$this->team_position->LinkCustomAttributes = "";
			$this->team_position->HrefValue = "";
			$this->team_position->TooltipValue = "";

			// team_text
			$this->team_text->LinkCustomAttributes = "";
			$this->team_text->HrefValue = "";
			$this->team_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// teamn_id
			$this->teamn_id->EditAttrs["class"] = "form-control";
			$this->teamn_id->EditCustomAttributes = "";
			$this->teamn_id->EditValue = ew_HtmlEncode($this->teamn_id->AdvancedSearch->SearchValue);
			$this->teamn_id->PlaceHolder = ew_RemoveHtml($this->teamn_id->FldCaption());

			// team_id
			$this->team_id->EditAttrs["class"] = "form-control";
			$this->team_id->EditCustomAttributes = "";
			if (trim(strval($this->team_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`team_id`" . ew_SearchString("=", $this->team_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `team_id`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cpy_team`";
			$sWhereWrk = "";
			$this->team_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `team_order`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->team_id->EditValue = $arwrk;

			// lang_id
			$this->lang_id->EditAttrs["class"] = "form-control";
			$this->lang_id->EditCustomAttributes = "";
			if (trim(strval($this->lang_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`lang_id`" . ew_SearchString("=", $this->lang_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `lang_id`, `lang_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_language`";
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

			// team_name
			$this->team_name->EditAttrs["class"] = "form-control";
			$this->team_name->EditCustomAttributes = "";
			$this->team_name->EditValue = ew_HtmlEncode($this->team_name->AdvancedSearch->SearchValue);
			$this->team_name->PlaceHolder = ew_RemoveHtml($this->team_name->FldCaption());

			// team_title
			$this->team_title->EditAttrs["class"] = "form-control";
			$this->team_title->EditCustomAttributes = "";
			$this->team_title->EditValue = ew_HtmlEncode($this->team_title->AdvancedSearch->SearchValue);
			$this->team_title->PlaceHolder = ew_RemoveHtml($this->team_title->FldCaption());

			// team_position
			$this->team_position->EditAttrs["class"] = "form-control";
			$this->team_position->EditCustomAttributes = "";
			$this->team_position->EditValue = ew_HtmlEncode($this->team_position->AdvancedSearch->SearchValue);
			$this->team_position->PlaceHolder = ew_RemoveHtml($this->team_position->FldCaption());

			// team_text
			$this->team_text->EditAttrs["class"] = "form-control";
			$this->team_text->EditCustomAttributes = "";
			$this->team_text->EditValue = ew_HtmlEncode($this->team_text->AdvancedSearch->SearchValue);
			$this->team_text->PlaceHolder = ew_RemoveHtml($this->team_text->FldCaption());
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
		if (!ew_CheckInteger($this->teamn_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->teamn_id->FldErrMsg());
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
		$this->teamn_id->AdvancedSearch->Load();
		$this->team_id->AdvancedSearch->Load();
		$this->lang_id->AdvancedSearch->Load();
		$this->team_name->AdvancedSearch->Load();
		$this->team_title->AdvancedSearch->Load();
		$this->team_position->AdvancedSearch->Load();
		$this->team_text->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_team_nameslist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_team_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `team_id` AS `LinkFld`, `team_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_team`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`team_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->team_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `team_order`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_lang_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `lang_id` AS `LinkFld`, `lang_id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_language`";
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
if (!isset($cpy_team_names_search)) $cpy_team_names_search = new ccpy_team_names_search();

// Page init
$cpy_team_names_search->Page_Init();

// Page main
$cpy_team_names_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_team_names_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($cpy_team_names_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fcpy_team_namessearch = new ew_Form("fcpy_team_namessearch", "search");
<?php } else { ?>
var CurrentForm = fcpy_team_namessearch = new ew_Form("fcpy_team_namessearch", "search");
<?php } ?>

// Form_CustomValidate event
fcpy_team_namessearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_team_namessearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_team_namessearch.Lists["x_team_id"] = {"LinkField":"x_team_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_team_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_team"};
fcpy_team_namessearch.Lists["x_team_id"].Data = "<?php echo $cpy_team_names_search->team_id->LookupFilterQuery(FALSE, "search") ?>";
fcpy_team_namessearch.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_team_namessearch.Lists["x_lang_id"].Data = "<?php echo $cpy_team_names_search->lang_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fcpy_team_namessearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_teamn_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_team_names->teamn_id->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_team_names_search->ShowPageHeader(); ?>
<?php
$cpy_team_names_search->ShowMessage();
?>
<form name="fcpy_team_namessearch" id="fcpy_team_namessearch" class="<?php echo $cpy_team_names_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_team_names_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_team_names_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_team_names">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($cpy_team_names_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
	<div id="r_teamn_id" class="form-group">
		<label for="x_teamn_id" class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_teamn_id"><?php echo $cpy_team_names->teamn_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_teamn_id" id="z_teamn_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->teamn_id->CellAttributes() ?>>
			<span id="el_cpy_team_names_teamn_id">
<input type="text" data-table="cpy_team_names" data-field="x_teamn_id" name="x_teamn_id" id="x_teamn_id" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->teamn_id->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->teamn_id->EditValue ?>"<?php echo $cpy_team_names->teamn_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
	<div id="r_team_id" class="form-group">
		<label for="x_team_id" class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_team_id"><?php echo $cpy_team_names->team_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_team_id" id="z_team_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_id->CellAttributes() ?>>
			<span id="el_cpy_team_names_team_id">
<select data-table="cpy_team_names" data-field="x_team_id" data-value-separator="<?php echo $cpy_team_names->team_id->DisplayValueSeparatorAttribute() ?>" id="x_team_id" name="x_team_id"<?php echo $cpy_team_names->team_id->EditAttributes() ?>>
<?php echo $cpy_team_names->team_id->SelectOptionListHtml("x_team_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_lang_id"><?php echo $cpy_team_names->lang_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_lang_id" id="z_lang_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->lang_id->CellAttributes() ?>>
			<span id="el_cpy_team_names_lang_id">
<select data-table="cpy_team_names" data-field="x_lang_id" data-value-separator="<?php echo $cpy_team_names->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $cpy_team_names->lang_id->EditAttributes() ?>>
<?php echo $cpy_team_names->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
	<div id="r_team_name" class="form-group">
		<label for="x_team_name" class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_team_name"><?php echo $cpy_team_names->team_name->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_team_name" id="z_team_name" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_name->CellAttributes() ?>>
			<span id="el_cpy_team_names_team_name">
<input type="text" data-table="cpy_team_names" data-field="x_team_name" name="x_team_name" id="x_team_name" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_name->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_name->EditValue ?>"<?php echo $cpy_team_names->team_name->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
	<div id="r_team_title" class="form-group">
		<label for="x_team_title" class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_team_title"><?php echo $cpy_team_names->team_title->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_team_title" id="z_team_title" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_title->CellAttributes() ?>>
			<span id="el_cpy_team_names_team_title">
<input type="text" data-table="cpy_team_names" data-field="x_team_title" name="x_team_title" id="x_team_title" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_title->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_title->EditValue ?>"<?php echo $cpy_team_names->team_title->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
	<div id="r_team_position" class="form-group">
		<label for="x_team_position" class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_team_position"><?php echo $cpy_team_names->team_position->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_team_position" id="z_team_position" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_position->CellAttributes() ?>>
			<span id="el_cpy_team_names_team_position">
<input type="text" data-table="cpy_team_names" data-field="x_team_position" name="x_team_position" id="x_team_position" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_position->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_position->EditValue ?>"<?php echo $cpy_team_names->team_position->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
	<div id="r_team_text" class="form-group">
		<label class="<?php echo $cpy_team_names_search->LeftColumnClass ?>"><span id="elh_cpy_team_names_team_text"><?php echo $cpy_team_names->team_text->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_team_text" id="z_team_text" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_team_names_search->RightColumnClass ?>"><div<?php echo $cpy_team_names->team_text->CellAttributes() ?>>
			<span id="el_cpy_team_names_team_text">
<input type="text" data-table="cpy_team_names" data-field="x_team_text" name="x_team_text" id="x_team_text" size="35" placeholder="<?php echo ew_HtmlEncode($cpy_team_names->team_text->getPlaceHolder()) ?>" value="<?php echo $cpy_team_names->team_text->EditValue ?>"<?php echo $cpy_team_names->team_text->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cpy_team_names_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_team_names_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_team_namessearch.Init();
</script>
<?php
$cpy_team_names_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_team_names_search->Page_Terminate();
?>
