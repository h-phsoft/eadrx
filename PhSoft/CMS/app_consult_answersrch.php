<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_consult_answerinfo.php" ?>
<?php include_once "app_consultationinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_consult_answer_search = NULL; // Initialize page object first

class capp_consult_answer_search extends capp_consult_answer {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_consult_answer';

	// Page object name
	var $PageObjName = 'app_consult_answer_search';

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

		// Table object (app_consult_answer)
		if (!isset($GLOBALS["app_consult_answer"]) || get_class($GLOBALS["app_consult_answer"]) == "capp_consult_answer") {
			$GLOBALS["app_consult_answer"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_consult_answer"];
		}

		// Table object (app_consultation)
		if (!isset($GLOBALS['app_consultation'])) $GLOBALS['app_consultation'] = new capp_consultation();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_consult_answer', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_consult_answerlist.php"));
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
		$this->cons_id->SetVisibility();
		$this->answer_file->SetVisibility();
		$this->answer_audio->SetVisibility();
		$this->answer_text->SetVisibility();
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
		global $EW_EXPORT, $app_consult_answer;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_consult_answer);
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
					if ($pageName == "app_consult_answerview.php")
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
						$sSrchStr = "app_consult_answerlist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->cons_id); // cons_id
		$this->BuildSearchUrl($sSrchUrl, $this->answer_file); // answer_file
		$this->BuildSearchUrl($sSrchUrl, $this->answer_audio); // answer_audio
		$this->BuildSearchUrl($sSrchUrl, $this->answer_text); // answer_text
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

		// cons_id
		$this->cons_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cons_id");
		$this->cons_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cons_id");

		// answer_file
		$this->answer_file->AdvancedSearch->SearchValue = $objForm->GetValue("x_answer_file");
		$this->answer_file->AdvancedSearch->SearchOperator = $objForm->GetValue("z_answer_file");

		// answer_audio
		$this->answer_audio->AdvancedSearch->SearchValue = $objForm->GetValue("x_answer_audio");
		$this->answer_audio->AdvancedSearch->SearchOperator = $objForm->GetValue("z_answer_audio");

		// answer_text
		$this->answer_text->AdvancedSearch->SearchValue = $objForm->GetValue("x_answer_text");
		$this->answer_text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_answer_text");

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
		// answer_id
		// user_id
		// cons_id
		// answer_file
		// answer_audio
		// answer_text
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

		// cons_id
		if (strval($this->cons_id->CurrentValue) <> "") {
			$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cons_id`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
		$sWhereWrk = "";
		$this->cons_id->LookupFilters = array("dx1" => '`cons_message`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cons_id->ViewValue = $this->cons_id->CurrentValue;
			}
		} else {
			$this->cons_id->ViewValue = NULL;
		}
		$this->cons_id->ViewCustomAttributes = "";

		// answer_file
		$this->answer_file->ViewValue = $this->answer_file->CurrentValue;
		$this->answer_file->ViewCustomAttributes = "";

		// answer_audio
		$this->answer_audio->ViewValue = $this->answer_audio->CurrentValue;
		$this->answer_audio->ViewCustomAttributes = "";

		// answer_text
		$this->answer_text->ViewValue = $this->answer_text->CurrentValue;
		$this->answer_text->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 11);
		$this->ins_datetime->ViewCustomAttributes = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// cons_id
			$this->cons_id->LinkCustomAttributes = "";
			$this->cons_id->HrefValue = "";
			$this->cons_id->TooltipValue = "";

			// answer_file
			$this->answer_file->LinkCustomAttributes = "";
			$this->answer_file->HrefValue = "";
			$this->answer_file->TooltipValue = "";

			// answer_audio
			$this->answer_audio->LinkCustomAttributes = "";
			$this->answer_audio->HrefValue = "";
			$this->answer_audio->TooltipValue = "";

			// answer_text
			$this->answer_text->LinkCustomAttributes = "";
			$this->answer_text->HrefValue = "";
			$this->answer_text->TooltipValue = "";

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

			// cons_id
			$this->cons_id->EditCustomAttributes = "";
			if (trim(strval($this->cons_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cons_id`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation`";
			$sWhereWrk = "";
			$this->cons_id->LookupFilters = array("dx1" => '`cons_message`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->cons_id->AdvancedSearch->ViewValue = $this->cons_id->DisplayValue($arwrk);
			} else {
				$this->cons_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cons_id->EditValue = $arwrk;

			// answer_file
			$this->answer_file->EditAttrs["class"] = "form-control";
			$this->answer_file->EditCustomAttributes = "";
			$this->answer_file->EditValue = ew_HtmlEncode($this->answer_file->AdvancedSearch->SearchValue);
			$this->answer_file->PlaceHolder = ew_RemoveHtml($this->answer_file->FldCaption());

			// answer_audio
			$this->answer_audio->EditAttrs["class"] = "form-control";
			$this->answer_audio->EditCustomAttributes = "";
			$this->answer_audio->EditValue = ew_HtmlEncode($this->answer_audio->AdvancedSearch->SearchValue);
			$this->answer_audio->PlaceHolder = ew_RemoveHtml($this->answer_audio->FldCaption());

			// answer_text
			$this->answer_text->EditAttrs["class"] = "form-control";
			$this->answer_text->EditCustomAttributes = "";
			$this->answer_text->EditValue = ew_HtmlEncode($this->answer_text->AdvancedSearch->SearchValue);
			$this->answer_text->PlaceHolder = ew_RemoveHtml($this->answer_text->FldCaption());

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
		$this->cons_id->AdvancedSearch->Load();
		$this->answer_file->AdvancedSearch->Load();
		$this->answer_audio->AdvancedSearch->Load();
		$this->answer_text->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_consult_answerlist.php"), "", $this->TableVar, TRUE);
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
		case "x_cons_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cons_id` AS `LinkFld`, `cons_message` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`cons_message`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cons_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($app_consult_answer_search)) $app_consult_answer_search = new capp_consult_answer_search();

// Page init
$app_consult_answer_search->Page_Init();

// Page main
$app_consult_answer_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_consult_answer_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($app_consult_answer_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fapp_consult_answersearch = new ew_Form("fapp_consult_answersearch", "search");
<?php } else { ?>
var CurrentForm = fapp_consult_answersearch = new ew_Form("fapp_consult_answersearch", "search");
<?php } ?>

// Form_CustomValidate event
fapp_consult_answersearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_consult_answersearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_consult_answersearch.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_consult_answersearch.Lists["x_user_id"].Data = "<?php echo $app_consult_answer_search->user_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_consult_answersearch.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_message","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_consult_answersearch.Lists["x_cons_id"].Data = "<?php echo $app_consult_answer_search->cons_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fapp_consult_answersearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_ins_datetime");
	if (elm && !ew_CheckEuroDate(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_consult_answer->ins_datetime->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_consult_answer_search->ShowPageHeader(); ?>
<?php
$app_consult_answer_search->ShowMessage();
?>
<form name="fapp_consult_answersearch" id="fapp_consult_answersearch" class="<?php echo $app_consult_answer_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_consult_answer_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_consult_answer_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_consult_answer">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($app_consult_answer_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($app_consult_answer->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label for="x_user_id" class="<?php echo $app_consult_answer_search->LeftColumnClass ?>"><span id="elh_app_consult_answer_user_id"><?php echo $app_consult_answer->user_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></p>
		</label>
		<div class="<?php echo $app_consult_answer_search->RightColumnClass ?>"><div<?php echo $app_consult_answer->user_id->CellAttributes() ?>>
			<span id="el_app_consult_answer_user_id">
<select data-table="app_consult_answer" data-field="x_user_id" data-value-separator="<?php echo $app_consult_answer->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_consult_answer->user_id->EditAttributes() ?>>
<?php echo $app_consult_answer->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->cons_id->Visible) { // cons_id ?>
	<div id="r_cons_id" class="form-group">
		<label for="x_cons_id" class="<?php echo $app_consult_answer_search->LeftColumnClass ?>"><span id="elh_app_consult_answer_cons_id"><?php echo $app_consult_answer->cons_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cons_id" id="z_cons_id" value="="></p>
		</label>
		<div class="<?php echo $app_consult_answer_search->RightColumnClass ?>"><div<?php echo $app_consult_answer->cons_id->CellAttributes() ?>>
			<span id="el_app_consult_answer_cons_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_cons_id"><?php echo (strval($app_consult_answer->cons_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $app_consult_answer->cons_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($app_consult_answer->cons_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_cons_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($app_consult_answer->cons_id->ReadOnly || $app_consult_answer->cons_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="app_consult_answer" data-field="x_cons_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $app_consult_answer->cons_id->DisplayValueSeparatorAttribute() ?>" name="x_cons_id" id="x_cons_id" value="<?php echo $app_consult_answer->cons_id->AdvancedSearch->SearchValue ?>"<?php echo $app_consult_answer->cons_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->answer_file->Visible) { // answer_file ?>
	<div id="r_answer_file" class="form-group">
		<label for="x_answer_file" class="<?php echo $app_consult_answer_search->LeftColumnClass ?>"><span id="elh_app_consult_answer_answer_file"><?php echo $app_consult_answer->answer_file->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_answer_file" id="z_answer_file" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_consult_answer_search->RightColumnClass ?>"><div<?php echo $app_consult_answer->answer_file->CellAttributes() ?>>
			<span id="el_app_consult_answer_answer_file">
<input type="text" data-table="app_consult_answer" data-field="x_answer_file" name="x_answer_file" id="x_answer_file" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->answer_file->getPlaceHolder()) ?>" value="<?php echo $app_consult_answer->answer_file->EditValue ?>"<?php echo $app_consult_answer->answer_file->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->answer_audio->Visible) { // answer_audio ?>
	<div id="r_answer_audio" class="form-group">
		<label for="x_answer_audio" class="<?php echo $app_consult_answer_search->LeftColumnClass ?>"><span id="elh_app_consult_answer_answer_audio"><?php echo $app_consult_answer->answer_audio->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_answer_audio" id="z_answer_audio" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_consult_answer_search->RightColumnClass ?>"><div<?php echo $app_consult_answer->answer_audio->CellAttributes() ?>>
			<span id="el_app_consult_answer_answer_audio">
<input type="text" data-table="app_consult_answer" data-field="x_answer_audio" name="x_answer_audio" id="x_answer_audio" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->answer_audio->getPlaceHolder()) ?>" value="<?php echo $app_consult_answer->answer_audio->EditValue ?>"<?php echo $app_consult_answer->answer_audio->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->answer_text->Visible) { // answer_text ?>
	<div id="r_answer_text" class="form-group">
		<label class="<?php echo $app_consult_answer_search->LeftColumnClass ?>"><span id="elh_app_consult_answer_answer_text"><?php echo $app_consult_answer->answer_text->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_answer_text" id="z_answer_text" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_consult_answer_search->RightColumnClass ?>"><div<?php echo $app_consult_answer->answer_text->CellAttributes() ?>>
			<span id="el_app_consult_answer_answer_text">
<input type="text" data-table="app_consult_answer" data-field="x_answer_text" name="x_answer_text" id="x_answer_text" size="35" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->answer_text->getPlaceHolder()) ?>" value="<?php echo $app_consult_answer->answer_text->EditValue ?>"<?php echo $app_consult_answer->answer_text->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_consult_answer->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $app_consult_answer_search->LeftColumnClass ?>"><span id="elh_app_consult_answer_ins_datetime"><?php echo $app_consult_answer->ins_datetime->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ins_datetime" id="z_ins_datetime" value="="></p>
		</label>
		<div class="<?php echo $app_consult_answer_search->RightColumnClass ?>"><div<?php echo $app_consult_answer->ins_datetime->CellAttributes() ?>>
			<span id="el_app_consult_answer_ins_datetime">
<input type="text" data-table="app_consult_answer" data-field="x_ins_datetime" data-format="11" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_consult_answer->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_consult_answer->ins_datetime->EditValue ?>"<?php echo $app_consult_answer->ins_datetime->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_consult_answer_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_consult_answer_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_consult_answersearch.Init();
</script>
<?php
$app_consult_answer_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_consult_answer_search->Page_Terminate();
?>
