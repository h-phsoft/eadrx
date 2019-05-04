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

$app_test_question_view = NULL; // Initialize page object first

class capp_test_question_view extends capp_test_question {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'app_test_question';

	// Page object name
	var $PageObjName = 'app_test_question_view';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		$KeyUrl = "";
		if (@$_GET["qstn_id"] <> "") {
			$this->RecKey["qstn_id"] = $_GET["qstn_id"];
			$KeyUrl .= "&amp;qstn_id=" . urlencode($this->RecKey["qstn_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (app_test)
		if (!isset($GLOBALS['app_test'])) $GLOBALS['app_test'] = new capp_test();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
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
		if (!$Security->CanView()) {
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
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $RecCnt;
	var $RecKey = array();
	var $IsModal = FALSE;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $gbSkipHeaderFooter, $EW_EXPORT;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Set up master/detail parameters
		$this->SetupMasterParms();
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["qstn_id"] <> "") {
				$this->qstn_id->setQueryStringValue($_GET["qstn_id"]);
				$this->RecKey["qstn_id"] = $this->qstn_id->QueryStringValue;
			} elseif (@$_POST["qstn_id"] <> "") {
				$this->qstn_id->setFormValue($_POST["qstn_id"]);
				$this->RecKey["qstn_id"] = $this->qstn_id->FormValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("app_test_questionlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetupStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($this->qstn_id->CurrentValue) == strval($this->Recordset->fields('qstn_id'))) {
								$this->setStartRecordNumber($this->StartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->StartRec++;
								$this->Recordset->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "app_test_questionlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "app_test_questionlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Edit
		$item = &$option->Add("edit");
		$editcaption = ew_HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->EditUrl) . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->CanEdit());

		// Copy
		$item = &$option->Add("copy");
		$copycaption = ew_HtmlTitle($Language->Phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,btn:'AddBtn',url:'" . ew_HtmlEncode($this->CopyUrl) . "'});\">" . $Language->Phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl <> "" && $Security->CanAdd());

		// Delete
		$item = &$option->Add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew_ConfirmDelete(this);\" class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddQuery($this->DeleteUrl, "a_delete=1")) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->CanDelete());

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->qstn_id->setDbValue($row['qstn_id']);
		$this->test_id->setDbValue($row['test_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->gend_id->setDbValue($row['gend_id']);
		$this->qstn_num->setDbValue($row['qstn_num']);
		$this->qstn_text->setDbValue($row['qstn_text']);
		$this->qstn_ansr1->setDbValue($row['qstn_ansr1']);
		$this->qstn_val1->setDbValue($row['qstn_val1']);
		$this->qstn_rep1->setDbValue($row['qstn_rep1']);
		$this->qstn_ansr2->setDbValue($row['qstn_ansr2']);
		$this->qstn_val2->setDbValue($row['qstn_val2']);
		$this->qstn_rep2->setDbValue($row['qstn_rep2']);
		$this->qstn_ansr3->setDbValue($row['qstn_ansr3']);
		$this->qstn_val3->setDbValue($row['qstn_val3']);
		$this->qstn_rep3->setDbValue($row['qstn_rep3']);
		$this->qstn_ansr4->setDbValue($row['qstn_ansr4']);
		$this->qstn_val4->setDbValue($row['qstn_val4']);
		$this->qstn_rep4->setDbValue($row['qstn_rep4']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['qstn_id'] = NULL;
		$row['test_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['gend_id'] = NULL;
		$row['qstn_num'] = NULL;
		$row['qstn_text'] = NULL;
		$row['qstn_ansr1'] = NULL;
		$row['qstn_val1'] = NULL;
		$row['qstn_rep1'] = NULL;
		$row['qstn_ansr2'] = NULL;
		$row['qstn_val2'] = NULL;
		$row['qstn_rep2'] = NULL;
		$row['qstn_ansr3'] = NULL;
		$row['qstn_val3'] = NULL;
		$row['qstn_rep3'] = NULL;
		$row['qstn_ansr4'] = NULL;
		$row['qstn_val4'] = NULL;
		$row['qstn_rep4'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->qstn_id->DbValue = $row['qstn_id'];
		$this->test_id->DbValue = $row['test_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->gend_id->DbValue = $row['gend_id'];
		$this->qstn_num->DbValue = $row['qstn_num'];
		$this->qstn_text->DbValue = $row['qstn_text'];
		$this->qstn_ansr1->DbValue = $row['qstn_ansr1'];
		$this->qstn_val1->DbValue = $row['qstn_val1'];
		$this->qstn_rep1->DbValue = $row['qstn_rep1'];
		$this->qstn_ansr2->DbValue = $row['qstn_ansr2'];
		$this->qstn_val2->DbValue = $row['qstn_val2'];
		$this->qstn_rep2->DbValue = $row['qstn_rep2'];
		$this->qstn_ansr3->DbValue = $row['qstn_ansr3'];
		$this->qstn_val3->DbValue = $row['qstn_val3'];
		$this->qstn_rep3->DbValue = $row['qstn_rep3'];
		$this->qstn_ansr4->DbValue = $row['qstn_ansr4'];
		$this->qstn_val4->DbValue = $row['qstn_val4'];
		$this->qstn_rep4->DbValue = $row['qstn_rep4'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetupMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "app_test") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_test_id"] <> "") {
					$GLOBALS["app_test"]->test_id->setQueryStringValue($_GET["fk_test_id"]);
					$this->test_id->setQueryStringValue($GLOBALS["app_test"]->test_id->QueryStringValue);
					$this->test_id->setSessionValue($this->test_id->QueryStringValue);
					if (!is_numeric($GLOBALS["app_test"]->test_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "app_test") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_test_id"] <> "") {
					$GLOBALS["app_test"]->test_id->setFormValue($_POST["fk_test_id"]);
					$this->test_id->setFormValue($GLOBALS["app_test"]->test_id->FormValue);
					$this->test_id->setSessionValue($this->test_id->FormValue);
					if (!is_numeric($GLOBALS["app_test"]->test_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "app_test") {
				if ($this->test_id->CurrentValue == "") $this->test_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("app_test_questionlist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($app_test_question_view)) $app_test_question_view = new capp_test_question_view();

// Page init
$app_test_question_view->Page_Init();

// Page main
$app_test_question_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_test_question_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fapp_test_questionview = new ew_Form("fapp_test_questionview", "view");

// Form_CustomValidate event
fapp_test_questionview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fapp_test_questionview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapp_test_questionview.Lists["x_test_id"] = {"LinkField":"x_test_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_test_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"app_test"};
fapp_test_questionview.Lists["x_test_id"].Data = "<?php echo $app_test_question_view->test_id->LookupFilterQuery(FALSE, "view") ?>";
fapp_test_questionview.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fapp_test_questionview.Lists["x_lang_id"].Data = "<?php echo $app_test_question_view->lang_id->LookupFilterQuery(FALSE, "view") ?>";
fapp_test_questionview.Lists["x_gend_id"] = {"LinkField":"x_gend_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_gend_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_gender"};
fapp_test_questionview.Lists["x_gend_id"].Data = "<?php echo $app_test_question_view->gend_id->LookupFilterQuery(FALSE, "view") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $app_test_question_view->ExportOptions->Render("body") ?>
<?php
	foreach ($app_test_question_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $app_test_question_view->ShowPageHeader(); ?>
<?php
$app_test_question_view->ShowMessage();
?>
<?php if (!$app_test_question_view->IsModal) { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($app_test_question_view->Pager)) $app_test_question_view->Pager = new cPrevNextPager($app_test_question_view->StartRec, $app_test_question_view->DisplayRecs, $app_test_question_view->TotalRecs, $app_test_question_view->AutoHidePager) ?>
<?php if ($app_test_question_view->Pager->RecordCount > 0 && $app_test_question_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_test_question_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_test_question_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_test_question_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_test_question_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_test_question_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_test_question_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fapp_test_questionview" id="fapp_test_questionview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($app_test_question_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $app_test_question_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_test_question">
<input type="hidden" name="modal" value="<?php echo intval($app_test_question_view->IsModal) ?>">
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($app_test_question->test_id->Visible) { // test_id ?>
	<tr id="r_test_id">
		<td class="col-sm-2"><span id="elh_app_test_question_test_id"><?php echo $app_test_question->test_id->FldCaption() ?></span></td>
		<td data-name="test_id"<?php echo $app_test_question->test_id->CellAttributes() ?>>
<span id="el_app_test_question_test_id">
<span<?php echo $app_test_question->test_id->ViewAttributes() ?>>
<?php echo $app_test_question->test_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->lang_id->Visible) { // lang_id ?>
	<tr id="r_lang_id">
		<td class="col-sm-2"><span id="elh_app_test_question_lang_id"><?php echo $app_test_question->lang_id->FldCaption() ?></span></td>
		<td data-name="lang_id"<?php echo $app_test_question->lang_id->CellAttributes() ?>>
<span id="el_app_test_question_lang_id">
<span<?php echo $app_test_question->lang_id->ViewAttributes() ?>>
<?php echo $app_test_question->lang_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->gend_id->Visible) { // gend_id ?>
	<tr id="r_gend_id">
		<td class="col-sm-2"><span id="elh_app_test_question_gend_id"><?php echo $app_test_question->gend_id->FldCaption() ?></span></td>
		<td data-name="gend_id"<?php echo $app_test_question->gend_id->CellAttributes() ?>>
<span id="el_app_test_question_gend_id">
<span<?php echo $app_test_question->gend_id->ViewAttributes() ?>>
<?php echo $app_test_question->gend_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_num->Visible) { // qstn_num ?>
	<tr id="r_qstn_num">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_num"><?php echo $app_test_question->qstn_num->FldCaption() ?></span></td>
		<td data-name="qstn_num"<?php echo $app_test_question->qstn_num->CellAttributes() ?>>
<span id="el_app_test_question_qstn_num">
<span<?php echo $app_test_question->qstn_num->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_num->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_text->Visible) { // qstn_text ?>
	<tr id="r_qstn_text">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_text"><?php echo $app_test_question->qstn_text->FldCaption() ?></span></td>
		<td data-name="qstn_text"<?php echo $app_test_question->qstn_text->CellAttributes() ?>>
<span id="el_app_test_question_qstn_text">
<span<?php echo $app_test_question->qstn_text->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_text->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_ansr1->Visible) { // qstn_ansr1 ?>
	<tr id="r_qstn_ansr1">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_ansr1"><?php echo $app_test_question->qstn_ansr1->FldCaption() ?></span></td>
		<td data-name="qstn_ansr1"<?php echo $app_test_question->qstn_ansr1->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr1">
<span<?php echo $app_test_question->qstn_ansr1->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_val1->Visible) { // qstn_val1 ?>
	<tr id="r_qstn_val1">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_val1"><?php echo $app_test_question->qstn_val1->FldCaption() ?></span></td>
		<td data-name="qstn_val1"<?php echo $app_test_question->qstn_val1->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val1">
<span<?php echo $app_test_question->qstn_val1->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_rep1->Visible) { // qstn_rep1 ?>
	<tr id="r_qstn_rep1">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_rep1"><?php echo $app_test_question->qstn_rep1->FldCaption() ?></span></td>
		<td data-name="qstn_rep1"<?php echo $app_test_question->qstn_rep1->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep1">
<span<?php echo $app_test_question->qstn_rep1->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_ansr2->Visible) { // qstn_ansr2 ?>
	<tr id="r_qstn_ansr2">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_ansr2"><?php echo $app_test_question->qstn_ansr2->FldCaption() ?></span></td>
		<td data-name="qstn_ansr2"<?php echo $app_test_question->qstn_ansr2->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr2">
<span<?php echo $app_test_question->qstn_ansr2->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_val2->Visible) { // qstn_val2 ?>
	<tr id="r_qstn_val2">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_val2"><?php echo $app_test_question->qstn_val2->FldCaption() ?></span></td>
		<td data-name="qstn_val2"<?php echo $app_test_question->qstn_val2->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val2">
<span<?php echo $app_test_question->qstn_val2->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_rep2->Visible) { // qstn_rep2 ?>
	<tr id="r_qstn_rep2">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_rep2"><?php echo $app_test_question->qstn_rep2->FldCaption() ?></span></td>
		<td data-name="qstn_rep2"<?php echo $app_test_question->qstn_rep2->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep2">
<span<?php echo $app_test_question->qstn_rep2->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_ansr3->Visible) { // qstn_ansr3 ?>
	<tr id="r_qstn_ansr3">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_ansr3"><?php echo $app_test_question->qstn_ansr3->FldCaption() ?></span></td>
		<td data-name="qstn_ansr3"<?php echo $app_test_question->qstn_ansr3->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr3">
<span<?php echo $app_test_question->qstn_ansr3->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_val3->Visible) { // qstn_val3 ?>
	<tr id="r_qstn_val3">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_val3"><?php echo $app_test_question->qstn_val3->FldCaption() ?></span></td>
		<td data-name="qstn_val3"<?php echo $app_test_question->qstn_val3->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val3">
<span<?php echo $app_test_question->qstn_val3->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_rep3->Visible) { // qstn_rep3 ?>
	<tr id="r_qstn_rep3">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_rep3"><?php echo $app_test_question->qstn_rep3->FldCaption() ?></span></td>
		<td data-name="qstn_rep3"<?php echo $app_test_question->qstn_rep3->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep3">
<span<?php echo $app_test_question->qstn_rep3->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_ansr4->Visible) { // qstn_ansr4 ?>
	<tr id="r_qstn_ansr4">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_ansr4"><?php echo $app_test_question->qstn_ansr4->FldCaption() ?></span></td>
		<td data-name="qstn_ansr4"<?php echo $app_test_question->qstn_ansr4->CellAttributes() ?>>
<span id="el_app_test_question_qstn_ansr4">
<span<?php echo $app_test_question->qstn_ansr4->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_ansr4->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_val4->Visible) { // qstn_val4 ?>
	<tr id="r_qstn_val4">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_val4"><?php echo $app_test_question->qstn_val4->FldCaption() ?></span></td>
		<td data-name="qstn_val4"<?php echo $app_test_question->qstn_val4->CellAttributes() ?>>
<span id="el_app_test_question_qstn_val4">
<span<?php echo $app_test_question->qstn_val4->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_val4->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_test_question->qstn_rep4->Visible) { // qstn_rep4 ?>
	<tr id="r_qstn_rep4">
		<td class="col-sm-2"><span id="elh_app_test_question_qstn_rep4"><?php echo $app_test_question->qstn_rep4->FldCaption() ?></span></td>
		<td data-name="qstn_rep4"<?php echo $app_test_question->qstn_rep4->CellAttributes() ?>>
<span id="el_app_test_question_qstn_rep4">
<span<?php echo $app_test_question->qstn_rep4->ViewAttributes() ?>>
<?php echo $app_test_question->qstn_rep4->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$app_test_question_view->IsModal) { ?>
<?php if (!isset($app_test_question_view->Pager)) $app_test_question_view->Pager = new cPrevNextPager($app_test_question_view->StartRec, $app_test_question_view->DisplayRecs, $app_test_question_view->TotalRecs, $app_test_question_view->AutoHidePager) ?>
<?php if ($app_test_question_view->Pager->RecordCount > 0 && $app_test_question_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($app_test_question_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($app_test_question_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $app_test_question_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($app_test_question_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($app_test_question_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $app_test_question_view->PageUrl() ?>start=<?php echo $app_test_question_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $app_test_question_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fapp_test_questionview.Init();
</script>
<?php
$app_test_question_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_test_question_view->Page_Terminate();
?>
