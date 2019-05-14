<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "app_subscribeinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$app_subscribe_search = NULL; // Initialize page object first

class capp_subscribe_search extends capp_subscribe {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_subscribe';

	// Page object name
	var $PageObjName = 'app_subscribe_search';

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

		// Table object (app_subscribe)
		if (!isset($GLOBALS["app_subscribe"]) || get_class($GLOBALS["app_subscribe"]) == "capp_subscribe") {
			$GLOBALS["app_subscribe"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["app_subscribe"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'app_subscribe', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("app_subscribelist.php"));
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
		$this->serv_id->SetVisibility();
		$this->user_id->SetVisibility();
		$this->cycle_id->SetVisibility();
		$this->book_id->SetVisibility();
		$this->tcat_id->SetVisibility();
		$this->test_id->SetVisibility();
		$this->cat_id->SetVisibility();
		$this->cons_id->SetVisibility();
		$this->subs_start->SetVisibility();
		$this->subs_end->SetVisibility();
		$this->subs_qnt->SetVisibility();
		$this->subs_price->SetVisibility();
		$this->subs_amt->SetVisibility();
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
		global $EW_EXPORT, $app_subscribe;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($app_subscribe);
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
					if ($pageName == "app_subscribeview.php")
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
						$sSrchStr = "app_subscribelist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->serv_id); // serv_id
		$this->BuildSearchUrl($sSrchUrl, $this->user_id); // user_id
		$this->BuildSearchUrl($sSrchUrl, $this->cycle_id); // cycle_id
		$this->BuildSearchUrl($sSrchUrl, $this->book_id); // book_id
		$this->BuildSearchUrl($sSrchUrl, $this->tcat_id); // tcat_id
		$this->BuildSearchUrl($sSrchUrl, $this->test_id); // test_id
		$this->BuildSearchUrl($sSrchUrl, $this->cat_id); // cat_id
		$this->BuildSearchUrl($sSrchUrl, $this->cons_id); // cons_id
		$this->BuildSearchUrl($sSrchUrl, $this->subs_start); // subs_start
		$this->BuildSearchUrl($sSrchUrl, $this->subs_end); // subs_end
		$this->BuildSearchUrl($sSrchUrl, $this->subs_qnt); // subs_qnt
		$this->BuildSearchUrl($sSrchUrl, $this->subs_price); // subs_price
		$this->BuildSearchUrl($sSrchUrl, $this->subs_amt); // subs_amt
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
		// serv_id

		$this->serv_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_serv_id");
		$this->serv_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_serv_id");

		// user_id
		$this->user_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_user_id");
		$this->user_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_id");

		// cycle_id
		$this->cycle_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cycle_id");
		$this->cycle_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cycle_id");

		// book_id
		$this->book_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_book_id");
		$this->book_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_book_id");

		// tcat_id
		$this->tcat_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_tcat_id");
		$this->tcat_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tcat_id");

		// test_id
		$this->test_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_test_id");
		$this->test_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_test_id");

		// cat_id
		$this->cat_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cat_id");
		$this->cat_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cat_id");

		// cons_id
		$this->cons_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_cons_id");
		$this->cons_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cons_id");

		// subs_start
		$this->subs_start->AdvancedSearch->SearchValue = $objForm->GetValue("x_subs_start");
		$this->subs_start->AdvancedSearch->SearchOperator = $objForm->GetValue("z_subs_start");

		// subs_end
		$this->subs_end->AdvancedSearch->SearchValue = $objForm->GetValue("x_subs_end");
		$this->subs_end->AdvancedSearch->SearchOperator = $objForm->GetValue("z_subs_end");

		// subs_qnt
		$this->subs_qnt->AdvancedSearch->SearchValue = $objForm->GetValue("x_subs_qnt");
		$this->subs_qnt->AdvancedSearch->SearchOperator = $objForm->GetValue("z_subs_qnt");

		// subs_price
		$this->subs_price->AdvancedSearch->SearchValue = $objForm->GetValue("x_subs_price");
		$this->subs_price->AdvancedSearch->SearchOperator = $objForm->GetValue("z_subs_price");

		// subs_amt
		$this->subs_amt->AdvancedSearch->SearchValue = $objForm->GetValue("x_subs_amt");
		$this->subs_amt->AdvancedSearch->SearchOperator = $objForm->GetValue("z_subs_amt");

		// ins_datetime
		$this->ins_datetime->AdvancedSearch->SearchValue = $objForm->GetValue("x_ins_datetime");
		$this->ins_datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ins_datetime");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->subs_qnt->FormValue == $this->subs_qnt->CurrentValue && is_numeric(ew_StrToFloat($this->subs_qnt->CurrentValue)))
			$this->subs_qnt->CurrentValue = ew_StrToFloat($this->subs_qnt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subs_price->FormValue == $this->subs_price->CurrentValue && is_numeric(ew_StrToFloat($this->subs_price->CurrentValue)))
			$this->subs_price->CurrentValue = ew_StrToFloat($this->subs_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subs_amt->FormValue == $this->subs_amt->CurrentValue && is_numeric(ew_StrToFloat($this->subs_amt->CurrentValue)))
			$this->subs_amt->CurrentValue = ew_StrToFloat($this->subs_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// subs_id
		// serv_id
		// user_id
		// cycle_id
		// book_id
		// tcat_id
		// test_id
		// cat_id
		// cons_id
		// subs_start
		// subs_end
		// subs_qnt
		// subs_price
		// subs_amt
		// ins_datetime

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// serv_id
		if (strval($this->serv_id->CurrentValue) <> "") {
			$sFilterWrk = "`serv_id`" . ew_SearchString("=", $this->serv_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `serv_id`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_service`";
		$sWhereWrk = "";
		$this->serv_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->serv_id->ViewValue = $this->serv_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->serv_id->ViewValue = $this->serv_id->CurrentValue;
			}
		} else {
			$this->serv_id->ViewValue = NULL;
		}
		$this->serv_id->ViewCustomAttributes = "";

		// user_id
		if (strval($this->user_id->CurrentValue) <> "") {
			$sFilterWrk = "`user_id`" . ew_SearchString("=", $this->user_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `user_id`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
		$sWhereWrk = "";
		$this->user_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// book_id
		if (strval($this->book_id->CurrentValue) <> "") {
			$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
		$sWhereWrk = "";
		$this->book_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->book_id->ViewValue = $this->book_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->book_id->ViewValue = $this->book_id->CurrentValue;
			}
		} else {
			$this->book_id->ViewValue = NULL;
		}
		$this->book_id->ViewCustomAttributes = "";

		// tcat_id
		if (strval($this->tcat_id->CurrentValue) <> "") {
			$sFilterWrk = "`tcat_id`" . ew_SearchString("=", $this->tcat_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `tcat_id`, `tcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_category`";
		$sWhereWrk = "";
		$this->tcat_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tcat_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tcat_id->ViewValue = $this->tcat_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tcat_id->ViewValue = $this->tcat_id->CurrentValue;
			}
		} else {
			$this->tcat_id->ViewValue = NULL;
		}
		$this->tcat_id->ViewCustomAttributes = "";

		// test_id
		if (strval($this->test_id->CurrentValue) <> "") {
			$sFilterWrk = "`test_id`" . ew_SearchString("=", $this->test_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `test_id`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
		$sWhereWrk = "";
		$this->test_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// cons_id
		if (strval($this->cons_id->CurrentValue) <> "") {
			$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cons_id`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
		$sWhereWrk = "";
		$this->cons_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->cons_id->ViewValue = $this->cons_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cons_id->ViewValue = $this->cons_id->CurrentValue;
			}
		} else {
			$this->cons_id->ViewValue = NULL;
		}
		$this->cons_id->ViewCustomAttributes = "";

		// subs_start
		$this->subs_start->ViewValue = $this->subs_start->CurrentValue;
		$this->subs_start->ViewValue = ew_FormatDateTime($this->subs_start->ViewValue, 0);
		$this->subs_start->ViewCustomAttributes = "";

		// subs_end
		$this->subs_end->ViewValue = $this->subs_end->CurrentValue;
		$this->subs_end->ViewValue = ew_FormatDateTime($this->subs_end->ViewValue, 0);
		$this->subs_end->ViewCustomAttributes = "";

		// subs_qnt
		$this->subs_qnt->ViewValue = $this->subs_qnt->CurrentValue;
		$this->subs_qnt->ViewCustomAttributes = "";

		// subs_price
		$this->subs_price->ViewValue = $this->subs_price->CurrentValue;
		$this->subs_price->ViewCustomAttributes = "";

		// subs_amt
		$this->subs_amt->ViewValue = $this->subs_amt->CurrentValue;
		$this->subs_amt->ViewCustomAttributes = "";

		// ins_datetime
		$this->ins_datetime->ViewValue = $this->ins_datetime->CurrentValue;
		$this->ins_datetime->ViewValue = ew_FormatDateTime($this->ins_datetime->ViewValue, 0);
		$this->ins_datetime->ViewCustomAttributes = "";

			// serv_id
			$this->serv_id->LinkCustomAttributes = "";
			$this->serv_id->HrefValue = "";
			$this->serv_id->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// cycle_id
			$this->cycle_id->LinkCustomAttributes = "";
			$this->cycle_id->HrefValue = "";
			$this->cycle_id->TooltipValue = "";

			// book_id
			$this->book_id->LinkCustomAttributes = "";
			$this->book_id->HrefValue = "";
			$this->book_id->TooltipValue = "";

			// tcat_id
			$this->tcat_id->LinkCustomAttributes = "";
			$this->tcat_id->HrefValue = "";
			$this->tcat_id->TooltipValue = "";

			// test_id
			$this->test_id->LinkCustomAttributes = "";
			$this->test_id->HrefValue = "";
			$this->test_id->TooltipValue = "";

			// cat_id
			$this->cat_id->LinkCustomAttributes = "";
			$this->cat_id->HrefValue = "";
			$this->cat_id->TooltipValue = "";

			// cons_id
			$this->cons_id->LinkCustomAttributes = "";
			$this->cons_id->HrefValue = "";
			$this->cons_id->TooltipValue = "";

			// subs_start
			$this->subs_start->LinkCustomAttributes = "";
			$this->subs_start->HrefValue = "";
			$this->subs_start->TooltipValue = "";

			// subs_end
			$this->subs_end->LinkCustomAttributes = "";
			$this->subs_end->HrefValue = "";
			$this->subs_end->TooltipValue = "";

			// subs_qnt
			$this->subs_qnt->LinkCustomAttributes = "";
			$this->subs_qnt->HrefValue = "";
			$this->subs_qnt->TooltipValue = "";

			// subs_price
			$this->subs_price->LinkCustomAttributes = "";
			$this->subs_price->HrefValue = "";
			$this->subs_price->TooltipValue = "";

			// subs_amt
			$this->subs_amt->LinkCustomAttributes = "";
			$this->subs_amt->HrefValue = "";
			$this->subs_amt->TooltipValue = "";

			// ins_datetime
			$this->ins_datetime->LinkCustomAttributes = "";
			$this->ins_datetime->HrefValue = "";
			$this->ins_datetime->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// serv_id
			$this->serv_id->EditAttrs["class"] = "form-control";
			$this->serv_id->EditCustomAttributes = "";
			if (trim(strval($this->serv_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`serv_id`" . ew_SearchString("=", $this->serv_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `serv_id`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_service`";
			$sWhereWrk = "";
			$this->serv_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->serv_id->EditValue = $arwrk;

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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->user_id->EditValue = $arwrk;

			// cycle_id
			$this->cycle_id->EditAttrs["class"] = "form-control";
			$this->cycle_id->EditCustomAttributes = "";
			if (trim(strval($this->cycle_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cycle_id`" . ew_SearchString("=", $this->cycle_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
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

			// book_id
			$this->book_id->EditAttrs["class"] = "form-control";
			$this->book_id->EditCustomAttributes = "";
			if (trim(strval($this->book_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`book_id`" . ew_SearchString("=", $this->book_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `book_id`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_book`";
			$sWhereWrk = "";
			$this->book_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->book_id->EditValue = $arwrk;

			// tcat_id
			$this->tcat_id->EditAttrs["class"] = "form-control";
			$this->tcat_id->EditCustomAttributes = "";
			if (trim(strval($this->tcat_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`tcat_id`" . ew_SearchString("=", $this->tcat_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `tcat_id`, `tcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_tips_category`";
			$sWhereWrk = "";
			$this->tcat_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tcat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tcat_id->EditValue = $arwrk;

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
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->test_id->EditValue = $arwrk;

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

			// cons_id
			$this->cons_id->EditAttrs["class"] = "form-control";
			$this->cons_id->EditCustomAttributes = "";
			if (trim(strval($this->cons_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cons_id`" . ew_SearchString("=", $this->cons_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cons_id`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `app_consultation`";
			$sWhereWrk = "";
			$this->cons_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cons_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cons_id->EditValue = $arwrk;

			// subs_start
			$this->subs_start->EditAttrs["class"] = "form-control";
			$this->subs_start->EditCustomAttributes = "";
			$this->subs_start->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->subs_start->AdvancedSearch->SearchValue, 0), 8));
			$this->subs_start->PlaceHolder = ew_RemoveHtml($this->subs_start->FldCaption());

			// subs_end
			$this->subs_end->EditAttrs["class"] = "form-control";
			$this->subs_end->EditCustomAttributes = "";
			$this->subs_end->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->subs_end->AdvancedSearch->SearchValue, 0), 8));
			$this->subs_end->PlaceHolder = ew_RemoveHtml($this->subs_end->FldCaption());

			// subs_qnt
			$this->subs_qnt->EditAttrs["class"] = "form-control";
			$this->subs_qnt->EditCustomAttributes = "";
			$this->subs_qnt->EditValue = ew_HtmlEncode($this->subs_qnt->AdvancedSearch->SearchValue);
			$this->subs_qnt->PlaceHolder = ew_RemoveHtml($this->subs_qnt->FldCaption());

			// subs_price
			$this->subs_price->EditAttrs["class"] = "form-control";
			$this->subs_price->EditCustomAttributes = "";
			$this->subs_price->EditValue = ew_HtmlEncode($this->subs_price->AdvancedSearch->SearchValue);
			$this->subs_price->PlaceHolder = ew_RemoveHtml($this->subs_price->FldCaption());

			// subs_amt
			$this->subs_amt->EditAttrs["class"] = "form-control";
			$this->subs_amt->EditCustomAttributes = "";
			$this->subs_amt->EditValue = ew_HtmlEncode($this->subs_amt->AdvancedSearch->SearchValue);
			$this->subs_amt->PlaceHolder = ew_RemoveHtml($this->subs_amt->FldCaption());

			// ins_datetime
			$this->ins_datetime->EditAttrs["class"] = "form-control";
			$this->ins_datetime->EditCustomAttributes = "";
			$this->ins_datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->ins_datetime->AdvancedSearch->SearchValue, 0), 8));
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
		if (!ew_CheckDateDef($this->subs_start->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->subs_start->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->subs_end->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->subs_end->FldErrMsg());
		}
		if (!ew_CheckNumber($this->subs_qnt->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->subs_qnt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->subs_price->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->subs_price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->subs_amt->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->subs_amt->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->ins_datetime->AdvancedSearch->SearchValue)) {
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
		$this->serv_id->AdvancedSearch->Load();
		$this->user_id->AdvancedSearch->Load();
		$this->cycle_id->AdvancedSearch->Load();
		$this->book_id->AdvancedSearch->Load();
		$this->tcat_id->AdvancedSearch->Load();
		$this->test_id->AdvancedSearch->Load();
		$this->cat_id->AdvancedSearch->Load();
		$this->cons_id->AdvancedSearch->Load();
		$this->subs_start->AdvancedSearch->Load();
		$this->subs_end->AdvancedSearch->Load();
		$this->subs_qnt->AdvancedSearch->Load();
		$this->subs_price->AdvancedSearch->Load();
		$this->subs_amt->AdvancedSearch->Load();
		$this->ins_datetime->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_subscribelist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_serv_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `serv_id` AS `LinkFld`, `serv_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_service`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`serv_id` IN ({filter_value})', "t0" => "2", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->serv_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_user_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `user_id` AS `LinkFld`, `user_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_user`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`user_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->user_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
		case "x_book_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `book_id` AS `LinkFld`, `book_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_book`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`book_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->book_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tcat_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `tcat_id` AS `LinkFld`, `tcat_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_tips_category`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`tcat_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tcat_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_test_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `test_id` AS `LinkFld`, `test_iname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_test`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`test_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->test_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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
		case "x_cons_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cons_id` AS `LinkFld`, `cons_amount` AS `DispFld`, `cons_message` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `app_consultation`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
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
if (!isset($app_subscribe_search)) $app_subscribe_search = new capp_subscribe_search();

// Page init
$app_subscribe_search->Page_Init();

// Page main
$app_subscribe_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_subscribe_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($app_subscribe_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fapp_subscribesearch = new ew_Form("fapp_subscribesearch", "search");
<?php } else { ?>
var CurrentForm = fapp_subscribesearch = new ew_Form("fapp_subscribesearch", "search");
<?php } ?>

// Form_CustomValidate event
fapp_subscribesearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_subscribesearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_subscribesearch.Lists["x_serv_id"] = {"LinkField":"x_serv_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_serv_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_service"};
fapp_subscribesearch.Lists["x_serv_id"].Data = "<?php echo $app_subscribe_search->serv_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_user_id"] = {"LinkField":"x_user_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_user_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_user"};
fapp_subscribesearch.Lists["x_user_id"].Data = "<?php echo $app_subscribe_search->user_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_cycle_id"] = {"LinkField":"x_cycle_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cycle_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_bill_cycle"};
fapp_subscribesearch.Lists["x_cycle_id"].Data = "<?php echo $app_subscribe_search->cycle_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_book_id"] = {"LinkField":"x_book_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_book_title","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_book"};
fapp_subscribesearch.Lists["x_book_id"].Data = "<?php echo $app_subscribe_search->book_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_tcat_id"] = {"LinkField":"x_tcat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tcat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_tips_category"};
fapp_subscribesearch.Lists["x_tcat_id"].Data = "<?php echo $app_subscribe_search->tcat_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_subscribesearch.Lists["x_test_id"].Data = "<?php echo $app_subscribe_search->test_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_cat_id"] = {"LinkField":"x_cat_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cat_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation_category"};
fapp_subscribesearch.Lists["x_cat_id"].Data = "<?php echo $app_subscribe_search->cat_id->LookupFilterQuery(FALSE, "search") ?>";
fapp_subscribesearch.Lists["x_cons_id"] = {"LinkField":"x_cons_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cons_amount","x_cons_message","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_consultation"};
fapp_subscribesearch.Lists["x_cons_id"].Data = "<?php echo $app_subscribe_search->cons_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fapp_subscribesearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_subs_start");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_start->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_subs_end");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_end->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_subs_qnt");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_qnt->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_subs_price");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_price->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_subs_amt");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->subs_amt->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_ins_datetime");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($app_subscribe->ins_datetime->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $app_subscribe_search->ShowPageHeader(); ?>
<?php
$app_subscribe_search->ShowMessage();
?>
<form name="fapp_subscribesearch" id="fapp_subscribesearch" class="<?php echo $app_subscribe_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_subscribe_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_subscribe_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_subscribe">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($app_subscribe_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($app_subscribe->serv_id->Visible) { // serv_id ?>
	<div id="r_serv_id" class="form-group">
		<label for="x_serv_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_serv_id"><?php echo $app_subscribe->serv_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_serv_id" id="z_serv_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->serv_id->CellAttributes() ?>>
			<span id="el_app_subscribe_serv_id">
<select data-table="app_subscribe" data-field="x_serv_id" data-value-separator="<?php echo $app_subscribe->serv_id->DisplayValueSeparatorAttribute() ?>" id="x_serv_id" name="x_serv_id"<?php echo $app_subscribe->serv_id->EditAttributes() ?>>
<?php echo $app_subscribe->serv_id->SelectOptionListHtml("x_serv_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group">
		<label for="x_user_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_user_id"><?php echo $app_subscribe->user_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->user_id->CellAttributes() ?>>
			<span id="el_app_subscribe_user_id">
<select data-table="app_subscribe" data-field="x_user_id" data-value-separator="<?php echo $app_subscribe->user_id->DisplayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $app_subscribe->user_id->EditAttributes() ?>>
<?php echo $app_subscribe->user_id->SelectOptionListHtml("x_user_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->cycle_id->Visible) { // cycle_id ?>
	<div id="r_cycle_id" class="form-group">
		<label for="x_cycle_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_cycle_id"><?php echo $app_subscribe->cycle_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cycle_id" id="z_cycle_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->cycle_id->CellAttributes() ?>>
			<span id="el_app_subscribe_cycle_id">
<select data-table="app_subscribe" data-field="x_cycle_id" data-value-separator="<?php echo $app_subscribe->cycle_id->DisplayValueSeparatorAttribute() ?>" id="x_cycle_id" name="x_cycle_id"<?php echo $app_subscribe->cycle_id->EditAttributes() ?>>
<?php echo $app_subscribe->cycle_id->SelectOptionListHtml("x_cycle_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->book_id->Visible) { // book_id ?>
	<div id="r_book_id" class="form-group">
		<label for="x_book_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_book_id"><?php echo $app_subscribe->book_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_book_id" id="z_book_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->book_id->CellAttributes() ?>>
			<span id="el_app_subscribe_book_id">
<select data-table="app_subscribe" data-field="x_book_id" data-value-separator="<?php echo $app_subscribe->book_id->DisplayValueSeparatorAttribute() ?>" id="x_book_id" name="x_book_id"<?php echo $app_subscribe->book_id->EditAttributes() ?>>
<?php echo $app_subscribe->book_id->SelectOptionListHtml("x_book_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->tcat_id->Visible) { // tcat_id ?>
	<div id="r_tcat_id" class="form-group">
		<label for="x_tcat_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_tcat_id"><?php echo $app_subscribe->tcat_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_tcat_id" id="z_tcat_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->tcat_id->CellAttributes() ?>>
			<span id="el_app_subscribe_tcat_id">
<select data-table="app_subscribe" data-field="x_tcat_id" data-value-separator="<?php echo $app_subscribe->tcat_id->DisplayValueSeparatorAttribute() ?>" id="x_tcat_id" name="x_tcat_id"<?php echo $app_subscribe->tcat_id->EditAttributes() ?>>
<?php echo $app_subscribe->tcat_id->SelectOptionListHtml("x_tcat_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->test_id->Visible) { // test_id ?>
	<div id="r_test_id" class="form-group">
		<label for="x_test_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_test_id"><?php echo $app_subscribe->test_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_test_id" id="z_test_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->test_id->CellAttributes() ?>>
			<span id="el_app_subscribe_test_id">
<select data-table="app_subscribe" data-field="x_test_id" data-value-separator="<?php echo $app_subscribe->test_id->DisplayValueSeparatorAttribute() ?>" id="x_test_id" name="x_test_id"<?php echo $app_subscribe->test_id->EditAttributes() ?>>
<?php echo $app_subscribe->test_id->SelectOptionListHtml("x_test_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->cat_id->Visible) { // cat_id ?>
	<div id="r_cat_id" class="form-group">
		<label for="x_cat_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_cat_id"><?php echo $app_subscribe->cat_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cat_id" id="z_cat_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->cat_id->CellAttributes() ?>>
			<span id="el_app_subscribe_cat_id">
<select data-table="app_subscribe" data-field="x_cat_id" data-value-separator="<?php echo $app_subscribe->cat_id->DisplayValueSeparatorAttribute() ?>" id="x_cat_id" name="x_cat_id"<?php echo $app_subscribe->cat_id->EditAttributes() ?>>
<?php echo $app_subscribe->cat_id->SelectOptionListHtml("x_cat_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->cons_id->Visible) { // cons_id ?>
	<div id="r_cons_id" class="form-group">
		<label for="x_cons_id" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_cons_id"><?php echo $app_subscribe->cons_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cons_id" id="z_cons_id" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->cons_id->CellAttributes() ?>>
			<span id="el_app_subscribe_cons_id">
<select data-table="app_subscribe" data-field="x_cons_id" data-value-separator="<?php echo $app_subscribe->cons_id->DisplayValueSeparatorAttribute() ?>" id="x_cons_id" name="x_cons_id"<?php echo $app_subscribe->cons_id->EditAttributes() ?>>
<?php echo $app_subscribe->cons_id->SelectOptionListHtml("x_cons_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_start->Visible) { // subs_start ?>
	<div id="r_subs_start" class="form-group">
		<label for="x_subs_start" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_subs_start"><?php echo $app_subscribe->subs_start->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_subs_start" id="z_subs_start" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_start->CellAttributes() ?>>
			<span id="el_app_subscribe_subs_start">
<input type="text" data-table="app_subscribe" data-field="x_subs_start" name="x_subs_start" id="x_subs_start" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_start->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_start->EditValue ?>"<?php echo $app_subscribe->subs_start->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_start->ReadOnly && !$app_subscribe->subs_start->Disabled && !isset($app_subscribe->subs_start->EditAttrs["readonly"]) && !isset($app_subscribe->subs_start->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribesearch", "x_subs_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_end->Visible) { // subs_end ?>
	<div id="r_subs_end" class="form-group">
		<label for="x_subs_end" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_subs_end"><?php echo $app_subscribe->subs_end->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_subs_end" id="z_subs_end" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_end->CellAttributes() ?>>
			<span id="el_app_subscribe_subs_end">
<input type="text" data-table="app_subscribe" data-field="x_subs_end" name="x_subs_end" id="x_subs_end" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_end->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_end->EditValue ?>"<?php echo $app_subscribe->subs_end->EditAttributes() ?>>
<?php if (!$app_subscribe->subs_end->ReadOnly && !$app_subscribe->subs_end->Disabled && !isset($app_subscribe->subs_end->EditAttrs["readonly"]) && !isset($app_subscribe->subs_end->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fapp_subscribesearch", "x_subs_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_qnt->Visible) { // subs_qnt ?>
	<div id="r_subs_qnt" class="form-group">
		<label for="x_subs_qnt" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_subs_qnt"><?php echo $app_subscribe->subs_qnt->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_subs_qnt" id="z_subs_qnt" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_qnt->CellAttributes() ?>>
			<span id="el_app_subscribe_subs_qnt">
<input type="text" data-table="app_subscribe" data-field="x_subs_qnt" name="x_subs_qnt" id="x_subs_qnt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_qnt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_qnt->EditValue ?>"<?php echo $app_subscribe->subs_qnt->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_price->Visible) { // subs_price ?>
	<div id="r_subs_price" class="form-group">
		<label for="x_subs_price" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_subs_price"><?php echo $app_subscribe->subs_price->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_subs_price" id="z_subs_price" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_price->CellAttributes() ?>>
			<span id="el_app_subscribe_subs_price">
<input type="text" data-table="app_subscribe" data-field="x_subs_price" name="x_subs_price" id="x_subs_price" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_price->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_price->EditValue ?>"<?php echo $app_subscribe->subs_price->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->subs_amt->Visible) { // subs_amt ?>
	<div id="r_subs_amt" class="form-group">
		<label for="x_subs_amt" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_subs_amt"><?php echo $app_subscribe->subs_amt->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_subs_amt" id="z_subs_amt" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->subs_amt->CellAttributes() ?>>
			<span id="el_app_subscribe_subs_amt">
<input type="text" data-table="app_subscribe" data-field="x_subs_amt" name="x_subs_amt" id="x_subs_amt" size="30" placeholder="<?php echo ew_HtmlEncode($app_subscribe->subs_amt->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->subs_amt->EditValue ?>"<?php echo $app_subscribe->subs_amt->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($app_subscribe->ins_datetime->Visible) { // ins_datetime ?>
	<div id="r_ins_datetime" class="form-group">
		<label for="x_ins_datetime" class="<?php echo $app_subscribe_search->LeftColumnClass ?>"><span id="elh_app_subscribe_ins_datetime"><?php echo $app_subscribe->ins_datetime->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ins_datetime" id="z_ins_datetime" value="="></p>
		</label>
		<div class="<?php echo $app_subscribe_search->RightColumnClass ?>"><div<?php echo $app_subscribe->ins_datetime->CellAttributes() ?>>
			<span id="el_app_subscribe_ins_datetime">
<input type="text" data-table="app_subscribe" data-field="x_ins_datetime" name="x_ins_datetime" id="x_ins_datetime" placeholder="<?php echo ew_HtmlEncode($app_subscribe->ins_datetime->getPlaceHolder()) ?>" value="<?php echo $app_subscribe->ins_datetime->EditValue ?>"<?php echo $app_subscribe->ins_datetime->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$app_subscribe_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $app_subscribe_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fapp_subscribesearch.Init();
</script>
<?php
$app_subscribe_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_subscribe_search->Page_Terminate();
?>
