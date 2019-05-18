<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_test_questioninfo.php" ?>
<?php include_once "app_testinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_test_question_search = NULL; // Initialize page object first

class capp_test_question_search extends capp_test_question {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_test_question';

	// Page object name
	var $PageObjName = 'app_test_question_search';

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

		// Table object (app_test_question)
		if (!isset($GLOBALS["app_test_question"]) || get_class($GLOBALS["app_test_question"]) == "capp_test_question") {
			$GLOBALS["app_test_question"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_test_question"];
		}

		// Table object (app_test)
		if (!isset($GLOBALS['app_test'])) $GLOBALS['app_test'] = new capp_test();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_test_question', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_test_questionlist.php"));
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
		$this->test_id->SetVisibility();
		$this->lang_id->SetVisibility();
		$this->gend_id->SetVisibility();
		$this->qstn_num->SetVisibility();
		$this->qstn_text->SetVisibility();
		$this->qstn_ansr1->SetVisibility();
		$this->qstn_val1->SetVisibility();
		$this->qstn_rep1->SetVisibility();
		$this->qstn_ansr2->SetVisibility();
		$this->qstn_val2->SetVisibility();
		$this->qstn_rep2->SetVisibility();
		$this->qstn_ansr3->SetVisibility();
		$this->qstn_val3->SetVisibility();
		$this->qstn_rep3->SetVisibility();
		$this->qstn_ansr4->SetVisibility();
		$this->qstn_val4->SetVisibility();
		$this->qstn_rep4->SetVisibility();

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
		global $EW_EXPORT, $app_test_question;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_test_question);
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
					if ($pageName == "app_test_questionview.php")
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
						$sSrchStr = "app_test_questionlist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->test_id); // test_id
		$this->BuildSearchUrl($sSrchUrl, $this->lang_id); // lang_id
		$this->BuildSearchUrl($sSrchUrl, $this->gend_id); // gend_id
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_num); // qstn_num
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_text); // qstn_text
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_ansr1); // qstn_ansr1
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_val1); // qstn_val1
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_rep1); // qstn_rep1
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_ansr2); // qstn_ansr2
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_val2); // qstn_val2
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_rep2); // qstn_rep2
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_ansr3); // qstn_ansr3
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_val3); // qstn_val3
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_rep3); // qstn_rep3
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_ansr4); // qstn_ansr4
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_val4); // qstn_val4
		$this->BuildSearchUrl($sSrchUrl, $this->qstn_rep4); // qstn_rep4
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
		// test_id

		$this->test_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_test_id");
		$this->test_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_test_id");

		// lang_id
		$this->lang_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_lang_id");
		$this->lang_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_lang_id");

		// gend_id
		$this->gend_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_gend_id");
		$this->gend_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_gend_id");

		// qstn_num
		$this->qstn_num->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_num");
		$this->qstn_num->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_num");

		// qstn_text
		$this->qstn_text->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_text");
		$this->qstn_text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_text");

		// qstn_ansr1
		$this->qstn_ansr1->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_ansr1");
		$this->qstn_ansr1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_ansr1");

		// qstn_val1
		$this->qstn_val1->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_val1");
		$this->qstn_val1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_val1");

		// qstn_rep1
		$this->qstn_rep1->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_rep1");
		$this->qstn_rep1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_rep1");

		// qstn_ansr2
		$this->qstn_ansr2->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_ansr2");
		$this->qstn_ansr2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_ansr2");

		// qstn_val2
		$this->qstn_val2->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_val2");
		$this->qstn_val2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_val2");

		// qstn_rep2
		$this->qstn_rep2->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_rep2");
		$this->qstn_rep2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_rep2");

		// qstn_ansr3
		$this->qstn_ansr3->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_ansr3");
		$this->qstn_ansr3->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_ansr3");

		// qstn_val3
		$this->qstn_val3->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_val3");
		$this->qstn_val3->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_val3");

		// qstn_rep3
		$this->qstn_rep3->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_rep3");
		$this->qstn_rep3->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_rep3");

		// qstn_ansr4
		$this->qstn_ansr4->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_ansr4");
		$this->qstn_ansr4->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_ansr4");

		// qstn_val4
		$this->qstn_val4->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_val4");
		$this->qstn_val4->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_val4");

		// qstn_rep4
		$this->qstn_rep4->AdvancedSearch->SearchValue = $objForm->GetValue("x_qstn_rep4");
		$this->qstn_rep4->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qstn_rep4");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->qstn_val1->FormValue == $this->qstn_val1->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val1->CurrentValue)))
			$this->qstn_val1->CurrentValue = ew_StrToFloat($this->qstn_val1->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qstn_val2->FormValue == $this->qstn_val2->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val2->CurrentValue)))
			$this->qstn_val2->CurrentValue = ew_StrToFloat($this->qstn_val2->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qstn_val3->FormValue == $this->qstn_val3->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val3->CurrentValue)))
			$this->qstn_val3->CurrentValue = ew_StrToFloat($this->qstn_val3->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qstn_val4->FormValue == $this->qstn_val4->CurrentValue && is_numeric(ew_StrToFloat($this->qstn_val4->CurrentValue)))
			$this->qstn_val4->CurrentValue = ew_StrToFloat($this->qstn_val4->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// qstn_id
		// test_id
		// lang_id
		// gend_id
		// qstn_num
		// qstn_text
		// qstn_ansr1
		// qstn_val1
		// qstn_rep1
		// qstn_ansr2
		// qstn_val2
		// qstn_rep2
		// qstn_ansr3
		// qstn_val3
		// qstn_rep3
		// qstn_ansr4
		// qstn_val4
		// qstn_rep4

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// test_id
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `test_num`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->test_id->ViewValue = $this->test_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->test_id->ViewValue = $this->test_id->CurrentValue;
			}
		} else {
			$this->test_id->ViewValue = NULL;
		}
		$this->test_id->ViewCustomAttributes = "";

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

		// qstn_num
		$this->qstn_num->ViewValue = $this->qstn_num->CurrentValue;
		$this->qstn_num->ViewCustomAttributes = "";

		// qstn_text
		$this->qstn_text->ViewValue = $this->qstn_text->CurrentValue;
		$this->qstn_text->ViewCustomAttributes = "";

		// qstn_ansr1
		$this->qstn_ansr1->ViewValue = $this->qstn_ansr1->CurrentValue;
		$this->qstn_ansr1->ViewCustomAttributes = "";

		// qstn_val1
		$this->qstn_val1->ViewValue = $this->qstn_val1->CurrentValue;
		$this->qstn_val1->ViewCustomAttributes = "";

		// qstn_rep1
		$this->qstn_rep1->ViewValue = $this->qstn_rep1->CurrentValue;
		$this->qstn_rep1->ViewCustomAttributes = "";

		// qstn_ansr2
		$this->qstn_ansr2->ViewValue = $this->qstn_ansr2->CurrentValue;
		$this->qstn_ansr2->ViewCustomAttributes = "";

		// qstn_val2
		$this->qstn_val2->ViewValue = $this->qstn_val2->CurrentValue;
		$this->qstn_val2->ViewCustomAttributes = "";

		// qstn_rep2
		$this->qstn_rep2->ViewValue = $this->qstn_rep2->CurrentValue;
		$this->qstn_rep2->ViewCustomAttributes = "";

		// qstn_ansr3
		$this->qstn_ansr3->ViewValue = $this->qstn_ansr3->CurrentValue;
		$this->qstn_ansr3->ViewCustomAttributes = "";

		// qstn_val3
		$this->qstn_val3->ViewValue = $this->qstn_val3->CurrentValue;
		$this->qstn_val3->ViewCustomAttributes = "";

		// qstn_rep3
		$this->qstn_rep3->ViewValue = $this->qstn_rep3->CurrentValue;
		$this->qstn_rep3->ViewCustomAttributes = "";

		// qstn_ansr4
		$this->qstn_ansr4->ViewValue = $this->qstn_ansr4->CurrentValue;
		$this->qstn_ansr4->ViewCustomAttributes = "";

		// qstn_val4
		$this->qstn_val4->ViewValue = $this->qstn_val4->CurrentValue;
		$this->qstn_val4->ViewValue = ew_FormatNumber($this->qstn_val4->ViewValue, 2, -2, -2, -2);
		$this->qstn_val4->ViewCustomAttributes = "";

		// qstn_rep4
		$this->qstn_rep4->ViewValue = $this->qstn_rep4->CurrentValue;
		$this->qstn_rep4->ViewCustomAttributes = "";

			// test_id
			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";
			$this->test_id->TooltipValue = "";

			// lang_id
			$this->lang_id->LinkCustomAttributes = "";
			$this->lang_id->HrefValue = "";
			$this->lang_id->TooltipValue = "";

			// gend_id
			$this->gend_id->LinkCustomAttributes = "";
			$this->gend_id->HrefValue = "";
			$this->gend_id->TooltipValue = "";

			// qstn_num
			$this->qstn_num->LinkCustomAttributes = "";
			$this->qstn_num->HrefValue = "";
			$this->qstn_num->TooltipValue = "";

			// qstn_text
			$this->qstn_text->LinkCustomAttributes = "";
			$this->qstn_text->HrefValue = "";
			$this->qstn_text->TooltipValue = "";

			// qstn_ansr1
			$this->qstn_ansr1->LinkCustomAttributes = "";
			$this->qstn_ansr1->HrefValue = "";
			$this->qstn_ansr1->TooltipValue = "";

			// qstn_val1
			$this->qstn_val1->LinkCustomAttributes = "";
			$this->qstn_val1->HrefValue = "";
			$this->qstn_val1->TooltipValue = "";

			// qstn_rep1
			$this->qstn_rep1->LinkCustomAttributes = "";
			$this->qstn_rep1->HrefValue = "";
			$this->qstn_rep1->TooltipValue = "";

			// qstn_ansr2
			$this->qstn_ansr2->LinkCustomAttributes = "";
			$this->qstn_ansr2->HrefValue = "";
			$this->qstn_ansr2->TooltipValue = "";

			// qstn_val2
			$this->qstn_val2->LinkCustomAttributes = "";
			$this->qstn_val2->HrefValue = "";
			$this->qstn_val2->TooltipValue = "";

			// qstn_rep2
			$this->qstn_rep2->LinkCustomAttributes = "";
			$this->qstn_rep2->HrefValue = "";
			$this->qstn_rep2->TooltipValue = "";

			// qstn_ansr3
			$this->qstn_ansr3->LinkCustomAttributes = "";
			$this->qstn_ansr3->HrefValue = "";
			$this->qstn_ansr3->TooltipValue = "";

			// qstn_val3
			$this->qstn_val3->LinkCustomAttributes = "";
			$this->qstn_val3->HrefValue = "";
			$this->qstn_val3->TooltipValue = "";

			// qstn_rep3
			$this->qstn_rep3->LinkCustomAttributes = "";
			$this->qstn_rep3->HrefValue = "";
			$this->qstn_rep3->TooltipValue = "";

			// qstn_ansr4
			$this->qstn_ansr4->LinkCustomAttributes = "";
			$this->qstn_ansr4->HrefValue = "";
			$this->qstn_ansr4->TooltipValue = "";

			// qstn_val4
			$this->qstn_val4->LinkCustomAttributes = "";
			$this->qstn_val4->HrefValue = "";
			$this->qstn_val4->TooltipValue = "";

			// qstn_rep4
			$this->qstn_rep4->LinkCustomAttributes = "";
			$this->qstn_rep4->HrefValue = "";
			$this->qstn_rep4->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// test_id
			$this->test_id->EditAttrs["class"] = "form-control";
			$this->test_id->EditCustomAttributes = "";
			if (trim(strval($this->test_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_test`";
			$sWhereWrk = "";
			$this->test_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `test_num`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->test_id->EditValue = $arwrk;

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

			// qstn_num
			$this->qstn_num->EditAttrs["class"] = "form-control";
			$this->qstn_num->EditCustomAttributes = "";
			$this->qstn_num->EditValue = ew_HtmlEncode($this->qstn_num->AdvancedSearch->SearchValue);
			$this->qstn_num->PlaceHolder = ew_RemoveHtml($this->qstn_num->FldCaption());

			// qstn_text
			$this->qstn_text->EditAttrs["class"] = "form-control";
			$this->qstn_text->EditCustomAttributes = "";
			$this->qstn_text->EditValue = ew_HtmlEncode($this->qstn_text->AdvancedSearch->SearchValue);
			$this->qstn_text->PlaceHolder = ew_RemoveHtml($this->qstn_text->FldCaption());

			// qstn_ansr1
			$this->qstn_ansr1->EditAttrs["class"] = "form-control";
			$this->qstn_ansr1->EditCustomAttributes = "";
			$this->qstn_ansr1->EditValue = ew_HtmlEncode($this->qstn_ansr1->AdvancedSearch->SearchValue);
			$this->qstn_ansr1->PlaceHolder = ew_RemoveHtml($this->qstn_ansr1->FldCaption());

			// qstn_val1
			$this->qstn_val1->EditAttrs["class"] = "form-control";
			$this->qstn_val1->EditCustomAttributes = "";
			$this->qstn_val1->EditValue = ew_HtmlEncode($this->qstn_val1->AdvancedSearch->SearchValue);
			$this->qstn_val1->PlaceHolder = ew_RemoveHtml($this->qstn_val1->FldCaption());

			// qstn_rep1
			$this->qstn_rep1->EditAttrs["class"] = "form-control";
			$this->qstn_rep1->EditCustomAttributes = "";
			$this->qstn_rep1->EditValue = ew_HtmlEncode($this->qstn_rep1->AdvancedSearch->SearchValue);
			$this->qstn_rep1->PlaceHolder = ew_RemoveHtml($this->qstn_rep1->FldCaption());

			// qstn_ansr2
			$this->qstn_ansr2->EditAttrs["class"] = "form-control";
			$this->qstn_ansr2->EditCustomAttributes = "";
			$this->qstn_ansr2->EditValue = ew_HtmlEncode($this->qstn_ansr2->AdvancedSearch->SearchValue);
			$this->qstn_ansr2->PlaceHolder = ew_RemoveHtml($this->qstn_ansr2->FldCaption());

			// qstn_val2
			$this->qstn_val2->EditAttrs["class"] = "form-control";
			$this->qstn_val2->EditCustomAttributes = "";
			$this->qstn_val2->EditValue = ew_HtmlEncode($this->qstn_val2->AdvancedSearch->SearchValue);
			$this->qstn_val2->PlaceHolder = ew_RemoveHtml($this->qstn_val2->FldCaption());

			// qstn_rep2
			$this->qstn_rep2->EditAttrs["class"] = "form-control";
			$this->qstn_rep2->EditCustomAttributes = "";
			$this->qstn_rep2->EditValue = ew_HtmlEncode($this->qstn_rep2->AdvancedSearch->SearchValue);
			$this->qstn_rep2->PlaceHolder = ew_RemoveHtml($this->qstn_rep2->FldCaption());

			// qstn_ansr3
			$this->qstn_ansr3->EditAttrs["class"] = "form-control";
			$this->qstn_ansr3->EditCustomAttributes = "";
			$this->qstn_ansr3->EditValue = ew_HtmlEncode($this->qstn_ansr3->AdvancedSearch->SearchValue);
			$this->qstn_ansr3->PlaceHolder = ew_RemoveHtml($this->qstn_ansr3->FldCaption());

			// qstn_val3
			$this->qstn_val3->EditAttrs["class"] = "form-control";
			$this->qstn_val3->EditCustomAttributes = "";
			$this->qstn_val3->EditValue = ew_HtmlEncode($this->qstn_val3->AdvancedSearch->SearchValue);
			$this->qstn_val3->PlaceHolder = ew_RemoveHtml($this->qstn_val3->FldCaption());

			// qstn_rep3
			$this->qstn_rep3->EditAttrs["class"] = "form-control";
			$this->qstn_rep3->EditCustomAttributes = "";
			$this->qstn_rep3->EditValue = ew_HtmlEncode($this->qstn_rep3->AdvancedSearch->SearchValue);
			$this->qstn_rep3->PlaceHolder = ew_RemoveHtml($this->qstn_rep3->FldCaption());

			// qstn_ansr4
			$this->qstn_ansr4->EditAttrs["class"] = "form-control";
			$this->qstn_ansr4->EditCustomAttributes = "";
			$this->qstn_ansr4->EditValue = ew_HtmlEncode($this->qstn_ansr4->AdvancedSearch->SearchValue);
			$this->qstn_ansr4->PlaceHolder = ew_RemoveHtml($this->qstn_ansr4->FldCaption());

			// qstn_val4
			$this->qstn_val4->EditAttrs["class"] = "form-control";
			$this->qstn_val4->EditCustomAttributes = "";
			$this->qstn_val4->EditValue = ew_HtmlEncode($this->qstn_val4->AdvancedSearch->SearchValue);
			$this->qstn_val4->PlaceHolder = ew_RemoveHtml($this->qstn_val4->FldCaption());

			// qstn_rep4
			$this->qstn_rep4->EditAttrs["class"] = "form-control";
			$this->qstn_rep4->EditCustomAttributes = "";
			$this->qstn_rep4->EditValue = ew_HtmlEncode($this->qstn_rep4->AdvancedSearch->SearchValue);
			$this->qstn_rep4->PlaceHolder = ew_RemoveHtml($this->qstn_rep4->FldCaption());
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
		if (!ew_CheckInteger($this->qstn_num->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->qstn_num->FldErrMsg());
		}
		if (!ew_CheckNumber($this->qstn_val1->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->qstn_val1->FldErrMsg());
		}
		if (!ew_CheckNumber($this->qstn_val2->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->qstn_val2->FldErrMsg());
		}
		if (!ew_CheckNumber($this->qstn_val3->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->qstn_val3->FldErrMsg());
		}
		if (!ew_CheckNumber($this->qstn_val4->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->qstn_val4->FldErrMsg());
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
		$this->test_id->AdvancedSearch->Load();
		$this->lang_id->AdvancedSearch->Load();
		$this->gend_id->AdvancedSearch->Load();
		$this->qstn_num->AdvancedSearch->Load();
		$this->qstn_text->AdvancedSearch->Load();
		$this->qstn_ansr1->AdvancedSearch->Load();
		$this->qstn_val1->AdvancedSearch->Load();
		$this->qstn_rep1->AdvancedSearch->Load();
		$this->qstn_ansr2->AdvancedSearch->Load();
		$this->qstn_val2->AdvancedSearch->Load();
		$this->qstn_rep2->AdvancedSearch->Load();
		$this->qstn_ansr3->AdvancedSearch->Load();
		$this->qstn_val3->AdvancedSearch->Load();
		$this->qstn_rep3->AdvancedSearch->Load();
		$this->qstn_ansr4->AdvancedSearch->Load();
		$this->qstn_val4->AdvancedSearch->Load();
		$this->qstn_rep4->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_test_questionlist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_test_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `test_id` AS `LinkFld`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`test_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `test_num`";
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
if (!isset($app_test_question_search)) $app_test_question_search = new capp_test_question_search();

// Page init
$app_test_question_search->Page_Init();

// Page main
$app_test_question_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_question_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($app_test_question_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fapp_test_questionsearch = new ew_Form("fapp_test_questionsearch", "search");
<?php } else { ?>
var CurrentForm = fapp_test_questionsearch = new ew_Form("fapp_test_questionsearch", "search");
<?php } ?>

// Form_CustomValidate event
fapp_test_questionsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_questionsearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_questionsearch.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_questionsearch.Lists["x_test_id"].Data = "<?php echo $app_test_question_search->test_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_test_questionsearch.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_questionsearch.Lists["x_lang_id"].Data = "<?php echo $app_test_question_search->lang_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_test_questionsearch.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_test_questionsearch.Lists["x_gend_id"].Data = "<?php echo $app_test_question_search->gend_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fapp_test_questionsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_qstn_num");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_num->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_qstn_val1");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val1->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_qstn_val2");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val2->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_qstn_val3");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val3->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_qstn_val4");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_test_question->qstn_val4->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_test_question_search->ShowPageHeader(); ?>
<?php
$app_test_question_search->ShowMessage();
?>
<form name="fapp_test_questionsearch" id="fapp_test_questionsearch" class="<?php echo $app_test_question_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_test_question_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_test_question_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_test_question">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($app_test_question_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($app_test_question->test_id->Visible) { // test_id ?>
	<div id="r_test_id" class="form-group">
		<label for="x_test_id" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_test_id"><?php echo $app_test_question->test_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_test_id" id="z_test_id" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->test_id->CellAttributes() ?>>
			<span id="el_app_test_question_test_id">
<select data-table="app_test_question" data-field="x_test_id" data-value-separator="<?php echo $app_test_question->test_id->DisplayValueSeparatorAttribute() ?>" id="x_test_id" name="x_test_id"<?php echo $app_test_question->test_id->EditAttributes() ?>>
<?php echo $app_test_question->test_id->SelectOptionListHtml("x_test_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->lang_id->Visible) { // lang_id ?>
	<div id="r_lang_id" class="form-group">
		<label for="x_lang_id" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_lang_id"><?php echo $app_test_question->lang_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_lang_id" id="z_lang_id" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->lang_id->CellAttributes() ?>>
			<span id="el_app_test_question_lang_id">
<select data-table="app_test_question" data-field="x_lang_id" data-value-separator="<?php echo $app_test_question->lang_id->DisplayValueSeparatorAttribute() ?>" id="x_lang_id" name="x_lang_id"<?php echo $app_test_question->lang_id->EditAttributes() ?>>
<?php echo $app_test_question->lang_id->SelectOptionListHtml("x_lang_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->gend_id->Visible) { // gend_id ?>
	<div id="r_gend_id" class="form-group">
		<label for="x_gend_id" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_gend_id"><?php echo $app_test_question->gend_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_gend_id" id="z_gend_id" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->gend_id->CellAttributes() ?>>
			<span id="el_app_test_question_gend_id">
<select data-table="app_test_question" data-field="x_gend_id" data-value-separator="<?php echo $app_test_question->gend_id->DisplayValueSeparatorAttribute() ?>" id="x_gend_id" name="x_gend_id"<?php echo $app_test_question->gend_id->EditAttributes() ?>>
<?php echo $app_test_question->gend_id->SelectOptionListHtml("x_gend_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_num->Visible) { // qstn_num ?>
	<div id="r_qstn_num" class="form-group">
		<label for="x_qstn_num" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_num"><?php echo $app_test_question->qstn_num->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_qstn_num" id="z_qstn_num" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_num->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_num">
<input type="text" data-table="app_test_question" data-field="x_qstn_num" name="x_qstn_num" id="x_qstn_num" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_num->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_num->EditValue ?>"<?php echo $app_test_question->qstn_num->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_text->Visible) { // qstn_text ?>
	<div id="r_qstn_text" class="form-group">
		<label class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_text"><?php echo $app_test_question->qstn_text->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_text" id="z_qstn_text" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_text->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_text">
<input type="text" data-table="app_test_question" data-field="x_qstn_text" name="x_qstn_text" id="x_qstn_text" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_text->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_text->EditValue ?>"<?php echo $app_test_question->qstn_text->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr1->Visible) { // qstn_ansr1 ?>
	<div id="r_qstn_ansr1" class="form-group">
		<label class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_ansr1"><?php echo $app_test_question->qstn_ansr1->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_ansr1" id="z_qstn_ansr1" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr1->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_ansr1">
<input type="text" data-table="app_test_question" data-field="x_qstn_ansr1" name="x_qstn_ansr1" id="x_qstn_ansr1" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_ansr1->EditValue ?>"<?php echo $app_test_question->qstn_ansr1->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val1->Visible) { // qstn_val1 ?>
	<div id="r_qstn_val1" class="form-group">
		<label for="x_qstn_val1" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_val1"><?php echo $app_test_question->qstn_val1->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_qstn_val1" id="z_qstn_val1" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val1->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_val1">
<input type="text" data-table="app_test_question" data-field="x_qstn_val1" name="x_qstn_val1" id="x_qstn_val1" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val1->EditValue ?>"<?php echo $app_test_question->qstn_val1->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep1->Visible) { // qstn_rep1 ?>
	<div id="r_qstn_rep1" class="form-group">
		<label for="x_qstn_rep1" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_rep1"><?php echo $app_test_question->qstn_rep1->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_rep1" id="z_qstn_rep1" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep1->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_rep1">
<input type="text" data-table="app_test_question" data-field="x_qstn_rep1" name="x_qstn_rep1" id="x_qstn_rep1" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep1->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_rep1->EditValue ?>"<?php echo $app_test_question->qstn_rep1->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr2->Visible) { // qstn_ansr2 ?>
	<div id="r_qstn_ansr2" class="form-group">
		<label for="x_qstn_ansr2" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_ansr2"><?php echo $app_test_question->qstn_ansr2->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_ansr2" id="z_qstn_ansr2" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr2->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_ansr2">
<input type="text" data-table="app_test_question" data-field="x_qstn_ansr2" name="x_qstn_ansr2" id="x_qstn_ansr2" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_ansr2->EditValue ?>"<?php echo $app_test_question->qstn_ansr2->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val2->Visible) { // qstn_val2 ?>
	<div id="r_qstn_val2" class="form-group">
		<label for="x_qstn_val2" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_val2"><?php echo $app_test_question->qstn_val2->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_qstn_val2" id="z_qstn_val2" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val2->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_val2">
<input type="text" data-table="app_test_question" data-field="x_qstn_val2" name="x_qstn_val2" id="x_qstn_val2" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val2->EditValue ?>"<?php echo $app_test_question->qstn_val2->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep2->Visible) { // qstn_rep2 ?>
	<div id="r_qstn_rep2" class="form-group">
		<label for="x_qstn_rep2" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_rep2"><?php echo $app_test_question->qstn_rep2->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_rep2" id="z_qstn_rep2" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep2->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_rep2">
<input type="text" data-table="app_test_question" data-field="x_qstn_rep2" name="x_qstn_rep2" id="x_qstn_rep2" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep2->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_rep2->EditValue ?>"<?php echo $app_test_question->qstn_rep2->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr3->Visible) { // qstn_ansr3 ?>
	<div id="r_qstn_ansr3" class="form-group">
		<label for="x_qstn_ansr3" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_ansr3"><?php echo $app_test_question->qstn_ansr3->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_ansr3" id="z_qstn_ansr3" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr3->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_ansr3">
<input type="text" data-table="app_test_question" data-field="x_qstn_ansr3" name="x_qstn_ansr3" id="x_qstn_ansr3" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_ansr3->EditValue ?>"<?php echo $app_test_question->qstn_ansr3->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val3->Visible) { // qstn_val3 ?>
	<div id="r_qstn_val3" class="form-group">
		<label for="x_qstn_val3" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_val3"><?php echo $app_test_question->qstn_val3->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_qstn_val3" id="z_qstn_val3" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val3->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_val3">
<input type="text" data-table="app_test_question" data-field="x_qstn_val3" name="x_qstn_val3" id="x_qstn_val3" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val3->EditValue ?>"<?php echo $app_test_question->qstn_val3->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep3->Visible) { // qstn_rep3 ?>
	<div id="r_qstn_rep3" class="form-group">
		<label for="x_qstn_rep3" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_rep3"><?php echo $app_test_question->qstn_rep3->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_rep3" id="z_qstn_rep3" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep3->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_rep3">
<input type="text" data-table="app_test_question" data-field="x_qstn_rep3" name="x_qstn_rep3" id="x_qstn_rep3" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep3->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_rep3->EditValue ?>"<?php echo $app_test_question->qstn_rep3->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_ansr4->Visible) { // qstn_ansr4 ?>
	<div id="r_qstn_ansr4" class="form-group">
		<label for="x_qstn_ansr4" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_ansr4"><?php echo $app_test_question->qstn_ansr4->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_ansr4" id="z_qstn_ansr4" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_ansr4->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_ansr4">
<input type="text" data-table="app_test_question" data-field="x_qstn_ansr4" name="x_qstn_ansr4" id="x_qstn_ansr4" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_ansr4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_ansr4->EditValue ?>"<?php echo $app_test_question->qstn_ansr4->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_val4->Visible) { // qstn_val4 ?>
	<div id="r_qstn_val4" class="form-group">
		<label for="x_qstn_val4" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_val4"><?php echo $app_test_question->qstn_val4->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_qstn_val4" id="z_qstn_val4" value="="></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_val4->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_val4">
<input type="text" data-table="app_test_question" data-field="x_qstn_val4" name="x_qstn_val4" id="x_qstn_val4" size="30" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_val4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_val4->EditValue ?>"<?php echo $app_test_question->qstn_val4->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_test_question->qstn_rep4->Visible) { // qstn_rep4 ?>
	<div id="r_qstn_rep4" class="form-group">
		<label for="x_qstn_rep4" class="<?php echo $app_test_question_search->LeftColumnClass ?>"><span id="elh_app_test_question_qstn_rep4"><?php echo $app_test_question->qstn_rep4->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_qstn_rep4" id="z_qstn_rep4" value="LIKE"></p>
		</label>
		<div class="<?php echo $app_test_question_search->RightColumnClass ?>"><div<?php echo $app_test_question->qstn_rep4->CellAttributes() ?>>
			<span id="el_app_test_question_qstn_rep4">
<input type="text" data-table="app_test_question" data-field="x_qstn_rep4" name="x_qstn_rep4" id="x_qstn_rep4" size="35" placeholder="<?php echo ew_HtmlEncode($app_test_question->qstn_rep4->getPlaceHolder()) ?>" value="<?php echo $app_test_question->qstn_rep4->EditValue ?>"<?php echo $app_test_question->qstn_rep4->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_test_question_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_test_question_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_test_questionsearch.Init();
</script>
<?php
$app_test_question_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_test_question_search->Page_Terminate();
?>
