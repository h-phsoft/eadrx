<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_slider_trninfo.php" ?>
<?php include_once "cpy_slider_mstinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_slider_trn_search = NULL; // Initialize page object first

class ccpy_slider_trn_search extends ccpy_slider_trn {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_slider_trn';

	// Page object name
	var $PageObjName = 'cpy_slider_trn_search';

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

		// Table object (cpy_slider_trn)
		if (!isset($GLOBALS["cpy_slider_trn"]) || get_class($GLOBALS["cpy_slider_trn"]) == "ccpy_slider_trn") {
			$GLOBALS["cpy_slider_trn"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_slider_trn"];
		}

		// Table object (cpy_slider_mst)
		if (!isset($GLOBALS['cpy_slider_mst'])) $GLOBALS['cpy_slider_mst'] = new ccpy_slider_mst();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_slider_trn', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_slider_trnlist.php"));
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
		$this->slid_id->SetVisibility();
		$this->slid_order->SetVisibility();
		$this->slid_header->SetVisibility();
		$this->slid_link->SetVisibility();
		$this->slid_label->SetVisibility();
		$this->slid_photo->SetVisibility();
		$this->slid_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_slider_trn;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_slider_trn);
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
					if ($pageName == "cpy_slider_trnview.php")
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
						$sSrchStr = "cpy_slider_trnlist.php" . "?" . $sSrchStr;
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
		$this->BuildSearchUrl($sSrchUrl, $this->slid_id); // slid_id
		$this->BuildSearchUrl($sSrchUrl, $this->slid_order); // slid_order
		$this->BuildSearchUrl($sSrchUrl, $this->slid_header); // slid_header
		$this->BuildSearchUrl($sSrchUrl, $this->slid_link); // slid_link
		$this->BuildSearchUrl($sSrchUrl, $this->slid_label); // slid_label
		$this->BuildSearchUrl($sSrchUrl, $this->slid_photo); // slid_photo
		$this->BuildSearchUrl($sSrchUrl, $this->slid_text); // slid_text
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
		// slid_id

		$this->slid_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_id");
		$this->slid_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_id");

		// slid_order
		$this->slid_order->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_order");
		$this->slid_order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_order");

		// slid_header
		$this->slid_header->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_header");
		$this->slid_header->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_header");

		// slid_link
		$this->slid_link->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_link");
		$this->slid_link->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_link");

		// slid_label
		$this->slid_label->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_label");
		$this->slid_label->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_label");

		// slid_photo
		$this->slid_photo->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_photo");
		$this->slid_photo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_photo");

		// slid_text
		$this->slid_text->AdvancedSearch->SearchValue = $objForm->GetValue("x_slid_text");
		$this->slid_text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_slid_text");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// tslid_id
		// slid_id
		// slid_order
		// slid_header
		// slid_link
		// slid_label
		// slid_photo
		// slid_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

		// slid_order
		$this->slid_order->ViewValue = $this->slid_order->CurrentValue;
		$this->slid_order->ViewCustomAttributes = "";

		// slid_header
		$this->slid_header->ViewValue = $this->slid_header->CurrentValue;
		$this->slid_header->ViewCustomAttributes = "";

		// slid_link
		$this->slid_link->ViewValue = $this->slid_link->CurrentValue;
		$this->slid_link->ViewCustomAttributes = "";

		// slid_label
		$this->slid_label->ViewValue = $this->slid_label->CurrentValue;
		$this->slid_label->ViewCustomAttributes = "";

		// slid_photo
		$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
		if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
			$this->slid_photo->ImageWidth = 200;
			$this->slid_photo->ImageHeight = 0;
			$this->slid_photo->ImageAlt = $this->slid_photo->FldAlt();
			$this->slid_photo->ViewValue = $this->slid_photo->Upload->DbValue;
		} else {
			$this->slid_photo->ViewValue = "";
		}
		$this->slid_photo->ViewCustomAttributes = "";

		// slid_text
		$this->slid_text->ViewValue = $this->slid_text->CurrentValue;
		$this->slid_text->ViewCustomAttributes = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// slid_order
			$this->slid_order->LinkCustomAttributes = "";
			$this->slid_order->HrefValue = "";
			$this->slid_order->TooltipValue = "";

			// slid_header
			$this->slid_header->LinkCustomAttributes = "";
			$this->slid_header->HrefValue = "";
			$this->slid_header->TooltipValue = "";

			// slid_link
			$this->slid_link->LinkCustomAttributes = "";
			$this->slid_link->HrefValue = "";
			$this->slid_link->TooltipValue = "";

			// slid_label
			$this->slid_label->LinkCustomAttributes = "";
			$this->slid_label->HrefValue = "";
			$this->slid_label->TooltipValue = "";

			// slid_photo
			$this->slid_photo->LinkCustomAttributes = "";
			$this->slid_photo->UploadPath = '../../assets/pages/img/frontend-slider';
			if (!ew_Empty($this->slid_photo->Upload->DbValue)) {
				$this->slid_photo->HrefValue = ew_GetFileUploadUrl($this->slid_photo, $this->slid_photo->Upload->DbValue); // Add prefix/suffix
				$this->slid_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->slid_photo->HrefValue = ew_FullUrl($this->slid_photo->HrefValue, "href");
			} else {
				$this->slid_photo->HrefValue = "";
			}
			$this->slid_photo->HrefValue2 = $this->slid_photo->UploadPath . $this->slid_photo->Upload->DbValue;
			$this->slid_photo->TooltipValue = "";
			if ($this->slid_photo->UseColorbox) {
				if (ew_Empty($this->slid_photo->TooltipValue))
					$this->slid_photo->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->slid_photo->LinkAttrs["data-rel"] = "cpy_slider_trn_x_slid_photo";
				ew_AppendClass($this->slid_photo->LinkAttrs["class"], "ewLightbox");
			}

			// slid_text
			$this->slid_text->LinkCustomAttributes = "";
			$this->slid_text->HrefValue = "";
			$this->slid_text->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

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

			// slid_order
			$this->slid_order->EditAttrs["class"] = "form-control";
			$this->slid_order->EditCustomAttributes = "";
			$this->slid_order->EditValue = ew_HtmlEncode($this->slid_order->AdvancedSearch->SearchValue);
			$this->slid_order->PlaceHolder = ew_RemoveHtml($this->slid_order->FldCaption());

			// slid_header
			$this->slid_header->EditAttrs["class"] = "form-control";
			$this->slid_header->EditCustomAttributes = "";
			$this->slid_header->EditValue = ew_HtmlEncode($this->slid_header->AdvancedSearch->SearchValue);
			$this->slid_header->PlaceHolder = ew_RemoveHtml($this->slid_header->FldCaption());

			// slid_link
			$this->slid_link->EditAttrs["class"] = "form-control";
			$this->slid_link->EditCustomAttributes = "";
			$this->slid_link->EditValue = ew_HtmlEncode($this->slid_link->AdvancedSearch->SearchValue);
			$this->slid_link->PlaceHolder = ew_RemoveHtml($this->slid_link->FldCaption());

			// slid_label
			$this->slid_label->EditAttrs["class"] = "form-control";
			$this->slid_label->EditCustomAttributes = "";
			$this->slid_label->EditValue = ew_HtmlEncode($this->slid_label->AdvancedSearch->SearchValue);
			$this->slid_label->PlaceHolder = ew_RemoveHtml($this->slid_label->FldCaption());

			// slid_photo
			$this->slid_photo->EditAttrs["class"] = "form-control";
			$this->slid_photo->EditCustomAttributes = "";
			$this->slid_photo->EditValue = ew_HtmlEncode($this->slid_photo->AdvancedSearch->SearchValue);
			$this->slid_photo->PlaceHolder = ew_RemoveHtml($this->slid_photo->FldCaption());

			// slid_text
			$this->slid_text->EditAttrs["class"] = "form-control";
			$this->slid_text->EditCustomAttributes = "";
			$this->slid_text->EditValue = ew_HtmlEncode($this->slid_text->AdvancedSearch->SearchValue);
			$this->slid_text->PlaceHolder = ew_RemoveHtml($this->slid_text->FldCaption());
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
		if (!ew_CheckInteger($this->slid_order->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->slid_order->FldErrMsg());
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
		$this->slid_id->AdvancedSearch->Load();
		$this->slid_order->AdvancedSearch->Load();
		$this->slid_header->AdvancedSearch->Load();
		$this->slid_link->AdvancedSearch->Load();
		$this->slid_label->AdvancedSearch->Load();
		$this->slid_photo->AdvancedSearch->Load();
		$this->slid_text->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_slider_trnlist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($cpy_slider_trn_search)) $cpy_slider_trn_search = new ccpy_slider_trn_search();

// Page init
$cpy_slider_trn_search->Page_Init();

// Page main
$cpy_slider_trn_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_slider_trn_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($cpy_slider_trn_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fcpy_slider_trnsearch = new ew_Form("fcpy_slider_trnsearch", "search");
<?php } else { ?>
var CurrentForm = fcpy_slider_trnsearch = new ew_Form("fcpy_slider_trnsearch", "search");
<?php } ?>

// Form_CustomValidate event
fcpy_slider_trnsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_slider_trnsearch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_slider_trnsearch.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_slider_trnsearch.Lists["x_slid_id"].Data = "<?php echo $cpy_slider_trn_search->slid_id->LookupFilterQuery(FALSE, "search") ?>";

// Form object for search
// Validate function for search

fcpy_slider_trnsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_slid_order");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_slider_trn->slid_order->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_slider_trn_search->ShowPageHeader(); ?>
<?php
$cpy_slider_trn_search->ShowMessage();
?>
<form name="fcpy_slider_trnsearch" id="fcpy_slider_trnsearch" class="<?php echo $cpy_slider_trn_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_slider_trn_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_slider_trn_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_slider_trn">
<input type="hidden" name="a_search" id="a_search" value="S">
<input type="hidden" name="modal" value="<?php echo intval($cpy_slider_trn_search->IsModal) ?>">
<div class="ewSearchDiv"><!-- page* -->
<?php if ($cpy_slider_trn->slid_id->Visible) { // slid_id ?>
	<div id="r_slid_id" class="form-group">
		<label for="x_slid_id" class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_id"><?php echo $cpy_slider_trn->slid_id->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_slid_id" id="z_slid_id" value="="></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_id->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_id">
<select data-table="cpy_slider_trn" data-field="x_slid_id" data-value-separator="<?php echo $cpy_slider_trn->slid_id->DisplayValueSeparatorAttribute() ?>" id="x_slid_id" name="x_slid_id"<?php echo $cpy_slider_trn->slid_id->EditAttributes() ?>>
<?php echo $cpy_slider_trn->slid_id->SelectOptionListHtml("x_slid_id") ?>
</select>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_order->Visible) { // slid_order ?>
	<div id="r_slid_order" class="form-group">
		<label for="x_slid_order" class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_order"><?php echo $cpy_slider_trn->slid_order->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_slid_order" id="z_slid_order" value="="></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_order->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_order">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_order" name="x_slid_order" id="x_slid_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_order->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_order->EditValue ?>"<?php echo $cpy_slider_trn->slid_order->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_header->Visible) { // slid_header ?>
	<div id="r_slid_header" class="form-group">
		<label for="x_slid_header" class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_header"><?php echo $cpy_slider_trn->slid_header->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_slid_header" id="z_slid_header" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_header->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_header">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_header" name="x_slid_header" id="x_slid_header" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_header->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_header->EditValue ?>"<?php echo $cpy_slider_trn->slid_header->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_link->Visible) { // slid_link ?>
	<div id="r_slid_link" class="form-group">
		<label for="x_slid_link" class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_link"><?php echo $cpy_slider_trn->slid_link->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_slid_link" id="z_slid_link" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_link->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_link">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_link" name="x_slid_link" id="x_slid_link" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_link->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_link->EditValue ?>"<?php echo $cpy_slider_trn->slid_link->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_label->Visible) { // slid_label ?>
	<div id="r_slid_label" class="form-group">
		<label for="x_slid_label" class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_label"><?php echo $cpy_slider_trn->slid_label->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_slid_label" id="z_slid_label" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_label->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_label">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_label" name="x_slid_label" id="x_slid_label" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_label->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_label->EditValue ?>"<?php echo $cpy_slider_trn->slid_label->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_photo->Visible) { // slid_photo ?>
	<div id="r_slid_photo" class="form-group">
		<label class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_photo"><?php echo $cpy_slider_trn->slid_photo->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_slid_photo" id="z_slid_photo" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_photo->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_photo">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_photo" name="x_slid_photo" id="x_slid_photo" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_photo->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_photo->EditValue ?>"<?php echo $cpy_slider_trn->slid_photo->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cpy_slider_trn->slid_text->Visible) { // slid_text ?>
	<div id="r_slid_text" class="form-group">
		<label class="<?php echo $cpy_slider_trn_search->LeftColumnClass ?>"><span id="elh_cpy_slider_trn_slid_text"><?php echo $cpy_slider_trn->slid_text->FldCaption() ?></span>
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_slid_text" id="z_slid_text" value="LIKE"></p>
		</label>
		<div class="<?php echo $cpy_slider_trn_search->RightColumnClass ?>"><div<?php echo $cpy_slider_trn->slid_text->CellAttributes() ?>>
			<span id="el_cpy_slider_trn_slid_text">
<input type="text" data-table="cpy_slider_trn" data-field="x_slid_text" name="x_slid_text" id="x_slid_text" size="35" placeholder="<?php echo ew_HtmlEncode($cpy_slider_trn->slid_text->getPlaceHolder()) ?>" value="<?php echo $cpy_slider_trn->slid_text->EditValue ?>"<?php echo $cpy_slider_trn->slid_text->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cpy_slider_trn_search->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $cpy_slider_trn_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_slider_trnsearch.Init();
</script>
<?php
$cpy_slider_trn_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_slider_trn_search->Page_Terminate();
?>
