<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$default = NULL; // Initialize page object first

class cdefault {

	// Page ID
	var $PageID = 'default';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Page object name
	var $PageObjName = 'default';

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
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect();

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
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
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $Breadcrumb;
		$Breadcrumb = new cBreadcrumb();

		// If session expired, show session expired message
		if (@$_GET["expired"] == "1")
			$this->setFailureMessage($Language->Phrase("SessionExpired"));
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // Load User Level
		if ($Security->AllowList(CurrentProjectID() . 'cpy_news'))
		$this->Page_Terminate("cpy_newslist.php"); // Exit and go to default page
		if ($Security->AllowList(CurrentProjectID() . 'app_book'))
			$this->Page_Terminate("app_booklist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_book_page'))
			$this->Page_Terminate("app_book_pagelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_consultation_category'))
			$this->Page_Terminate("app_consultation_categorylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_consultation_category_name'))
			$this->Page_Terminate("app_consultation_category_namelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_consultation'))
			$this->Page_Terminate("app_consultationlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_consult_assign'))
			$this->Page_Terminate("app_consult_assignlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_consult_answer'))
			$this->Page_Terminate("app_consult_answerlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_consultation_status'))
			$this->Page_Terminate("app_consultation_statuslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_test'))
			$this->Page_Terminate("app_testlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_test_name'))
			$this->Page_Terminate("app_test_namelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_test_evaluate'))
			$this->Page_Terminate("app_test_evaluatelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_test_question'))
			$this->Page_Terminate("app_test_questionlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_test_results'))
			$this->Page_Terminate("app_test_resultslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_tips'))
			$this->Page_Terminate("app_tipslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_tips_category'))
			$this->Page_Terminate("app_tips_categorylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_notification'))
			$this->Page_Terminate("app_notificationlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_notification_for'))
			$this->Page_Terminate("app_notification_forlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_notification_status'))
			$this->Page_Terminate("app_notification_statuslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_notif_for'))
			$this->Page_Terminate("app_notif_forlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_notif_status'))
			$this->Page_Terminate("app_notif_statuslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_ads'))
			$this->Page_Terminate("cpy_adslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_faq'))
			$this->Page_Terminate("cpy_faqlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_faq_category'))
			$this->Page_Terminate("cpy_faq_categorylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_news_images'))
			$this->Page_Terminate("cpy_news_imageslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_page'))
			$this->Page_Terminate("cpy_pagelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_page_row'))
			$this->Page_Terminate("cpy_page_rowlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_page_row_block'))
			$this->Page_Terminate("cpy_page_row_blocklist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_vteam'))
			$this->Page_Terminate("cpy_vteamlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_pgroup'))
			$this->Page_Terminate("cpy_pgrouplist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_slider_mst'))
			$this->Page_Terminate("cpy_slider_mstlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_slider_trn'))
			$this->Page_Terminate("cpy_slider_trnlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_team'))
			$this->Page_Terminate("cpy_teamlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_team_names'))
			$this->Page_Terminate("cpy_team_nameslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_user'))
			$this->Page_Terminate("cpy_userlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_video'))
			$this->Page_Terminate("cpy_videolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_log'))
			$this->Page_Terminate("cpy_loglist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_block_type'))
			$this->Page_Terminate("phs_block_typelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_color'))
			$this->Page_Terminate("phs_colorlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_cols'))
			$this->Page_Terminate("phs_colslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_country'))
			$this->Page_Terminate("phs_countrylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_every'))
			$this->Page_Terminate("phs_everylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_gender'))
			$this->Page_Terminate("phs_genderlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_bill_cycle'))
			$this->Page_Terminate("phs_bill_cyclelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_hour'))
			$this->Page_Terminate("phs_hourlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_keys'))
			$this->Page_Terminate("phs_keyslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_keyvalues'))
			$this->Page_Terminate("phs_keyvalueslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_language'))
			$this->Page_Terminate("phs_languagelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_menu'))
			$this->Page_Terminate("phs_menulist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_menu_type'))
			$this->Page_Terminate("phs_menu_typelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_vkeys'))
			$this->Page_Terminate("phs_vkeyslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vbook'))
			$this->Page_Terminate("app_vbooklist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vtest'))
			$this->Page_Terminate("app_vtestlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vtest_evaluate'))
			$this->Page_Terminate("app_vtest_evaluatelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vtest_question'))
			$this->Page_Terminate("app_vtest_questionlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_metta'))
			$this->Page_Terminate("phs_mettalist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_perms'))
			$this->Page_Terminate("phs_permslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_pgroup'))
			$this->Page_Terminate("phs_pgrouplist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_repeat'))
			$this->Page_Terminate("phs_repeatlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_setting'))
			$this->Page_Terminate("phs_settinglist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_slider_cols'))
			$this->Page_Terminate("phs_slider_colslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vcons_cat'))
			$this->Page_Terminate("app_vcons_catlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_slider_type'))
			$this->Page_Terminate("phs_slider_typelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_status'))
			$this->Page_Terminate("phs_statuslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_users'))
			$this->Page_Terminate("phs_userslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'phs_log'))
			$this->Page_Terminate("phs_loglist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_service'))
			$this->Page_Terminate("app_servicelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vtips'))
			$this->Page_Terminate("app_vtipslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vtips_package'))
			$this->Page_Terminate("app_vtips_packagelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_subscribe'))
			$this->Page_Terminate("app_subscribelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_subscribe_cats'))
			$this->Page_Terminate("app_subscribe_catslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_tips_package'))
			$this->Page_Terminate("app_tips_packagelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_tips_pkg_cat'))
			$this->Page_Terminate("app_tips_pkg_catlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_vcontactus'))
			$this->Page_Terminate("app_vcontactuslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cpy_vuser'))
			$this->Page_Terminate("cpy_vuserlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'app_contactus'))
			$this->Page_Terminate("app_contactuslist.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage(ew_DeniedMsg() . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($default)) $default = new cdefault();

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
