<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_page_row_blockinfo.php" ?>
<?php include_once "cpy_page_rowinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_page_row_block_view = NULL; // Initialize page object first

class ccpy_page_row_block_view extends ccpy_page_row_block {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_page_row_block';

	// Page object name
	var $PageObjName = 'cpy_page_row_block_view';

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

		// Table object (cpy_page_row_block)
		if (!isset($GLOBALS["cpy_page_row_block"]) || get_class($GLOBALS["cpy_page_row_block"]) == "ccpy_page_row_block") {
			$GLOBALS["cpy_page_row_block"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_page_row_block"];
		}
		$KeyUrl = "";
		if (@$_GET["blk_id"] <> "") {
			$this->RecKey["blk_id"] = $_GET["blk_id"];
			$KeyUrl .= "&amp;blk_id=" . urlencode($this->RecKey["blk_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (cpy_page_row)
		if (!isset($GLOBALS['cpy_page_row'])) $GLOBALS['cpy_page_row'] = new ccpy_page_row();

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_page_row_block', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_page_row_blocklist.php"));
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
		$this->row_id->SetVisibility();
		$this->type_id->SetVisibility();
		$this->slid_id->SetVisibility();
		$this->video_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->cols_id->SetVisibility();
		$this->blk_order->SetVisibility();
		$this->blk_name->SetVisibility();
		$this->blk_header->SetVisibility();
		$this->blk_image->SetVisibility();
		$this->blk_stext->SetVisibility();
		$this->blk_text->SetVisibility();

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
		global $EW_EXPORT, $cpy_page_row_block;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_page_row_block);
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
					if ($pageName == "cpy_page_row_blockview.php")
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
			if (@$_GET["blk_id"] <> "") {
				$this->blk_id->setQueryStringValue($_GET["blk_id"]);
				$this->RecKey["blk_id"] = $this->blk_id->QueryStringValue;
			} elseif (@$_POST["blk_id"] <> "") {
				$this->blk_id->setFormValue($_POST["blk_id"]);
				$this->RecKey["blk_id"] = $this->blk_id->FormValue;
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
						$this->Page_Terminate("cpy_page_row_blocklist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetupStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($this->blk_id->CurrentValue) == strval($this->Recordset->fields('blk_id'))) {
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
						$sReturnUrl = "cpy_page_row_blocklist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "cpy_page_row_blocklist.php"; // Not page request, return to list
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
		$this->blk_id->setDbValue($row['blk_id']);
		$this->row_id->setDbValue($row['row_id']);
		$this->type_id->setDbValue($row['type_id']);
		$this->slid_id->setDbValue($row['slid_id']);
		$this->video_id->setDbValue($row['video_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->cols_id->setDbValue($row['cols_id']);
		$this->blk_order->setDbValue($row['blk_order']);
		$this->blk_name->setDbValue($row['blk_name']);
		$this->blk_header->setDbValue($row['blk_header']);
		$this->blk_image->Upload->DbValue = $row['blk_image'];
		$this->blk_image->setDbValue($this->blk_image->Upload->DbValue);
		$this->blk_stext->setDbValue($row['blk_stext']);
		$this->blk_text->setDbValue($row['blk_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['blk_id'] = NULL;
		$row['row_id'] = NULL;
		$row['type_id'] = NULL;
		$row['slid_id'] = NULL;
		$row['video_id'] = NULL;
		$row['status_id'] = NULL;
		$row['cols_id'] = NULL;
		$row['blk_order'] = NULL;
		$row['blk_name'] = NULL;
		$row['blk_header'] = NULL;
		$row['blk_image'] = NULL;
		$row['blk_stext'] = NULL;
		$row['blk_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->blk_id->DbValue = $row['blk_id'];
		$this->row_id->DbValue = $row['row_id'];
		$this->type_id->DbValue = $row['type_id'];
		$this->slid_id->DbValue = $row['slid_id'];
		$this->video_id->DbValue = $row['video_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->cols_id->DbValue = $row['cols_id'];
		$this->blk_order->DbValue = $row['blk_order'];
		$this->blk_name->DbValue = $row['blk_name'];
		$this->blk_header->DbValue = $row['blk_header'];
		$this->blk_image->Upload->DbValue = $row['blk_image'];
		$this->blk_stext->DbValue = $row['blk_stext'];
		$this->blk_text->DbValue = $row['blk_text'];
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// blk_id
		// row_id
		// type_id
		// slid_id
		// video_id
		// status_id
		// cols_id
		// blk_order
		// blk_name
		// blk_header
		// blk_image
		// blk_stext
		// blk_text

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		if (strval($this->row_id->CurrentValue) <> "") {
			$sFilterWrk = "`row_id`" . ew_SearchString("=", $this->row_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `row_id`, `row_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_page_row`";
		$sWhereWrk = "";
		$this->row_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->row_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `row_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->row_id->ViewValue = $this->row_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->row_id->ViewValue = $this->row_id->CurrentValue;
			}
		} else {
			$this->row_id->ViewValue = NULL;
		}
		$this->row_id->ViewCustomAttributes = "";

		// type_id
		if (strval($this->type_id->CurrentValue) <> "") {
			$sFilterWrk = "`type_id`" . ew_SearchString("=", $this->type_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `type_id`, `type_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_block_type`";
		$sWhereWrk = "";
		$this->type_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->type_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `type_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->type_id->ViewValue = $this->type_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->type_id->ViewValue = $this->type_id->CurrentValue;
			}
		} else {
			$this->type_id->ViewValue = NULL;
		}
		$this->type_id->ViewCustomAttributes = "";

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

		// video_id
		if (strval($this->video_id->CurrentValue) <> "") {
			$sFilterWrk = "`video_id`" . ew_SearchString("=", $this->video_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `video_id`, `video_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cpy_video`";
		$sWhereWrk = "";
		$this->video_id->LookupFilters = array("dx1" => '`video_name`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->video_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `video_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->video_id->ViewValue = $this->video_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->video_id->ViewValue = $this->video_id->CurrentValue;
			}
		} else {
			$this->video_id->ViewValue = NULL;
		}
		$this->video_id->ViewCustomAttributes = "";

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

		// cols_id
		if (strval($this->cols_id->CurrentValue) <> "") {
			$sFilterWrk = "`cols_id`" . ew_SearchString("=", $this->cols_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cols_id`, `cols_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_cols`";
		$sWhereWrk = "";
		$this->cols_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cols_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `cols_id`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cols_id->ViewValue = $this->cols_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cols_id->ViewValue = $this->cols_id->CurrentValue;
			}
		} else {
			$this->cols_id->ViewValue = NULL;
		}
		$this->cols_id->ViewCustomAttributes = "";

		// blk_order
		$this->blk_order->ViewValue = $this->blk_order->CurrentValue;
		$this->blk_order->ViewCustomAttributes = "";

		// blk_name
		$this->blk_name->ViewValue = $this->blk_name->CurrentValue;
		$this->blk_name->ViewCustomAttributes = "";

		// blk_header
		$this->blk_header->ViewValue = $this->blk_header->CurrentValue;
		$this->blk_header->ViewCustomAttributes = "";

		// blk_image
		$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
		if (!ew_Empty($this->blk_image->Upload->DbValue)) {
			$this->blk_image->ImageWidth = 200;
			$this->blk_image->ImageHeight = 0;
			$this->blk_image->ImageAlt = $this->blk_image->FldAlt();
			$this->blk_image->ViewValue = $this->blk_image->Upload->DbValue;
		} else {
			$this->blk_image->ViewValue = "";
		}
		$this->blk_image->ViewCustomAttributes = "";

		// blk_stext
		$this->blk_stext->ViewValue = $this->blk_stext->CurrentValue;
		$this->blk_stext->ViewCustomAttributes = "";

		// blk_text
		$this->blk_text->ViewValue = $this->blk_text->CurrentValue;
		$this->blk_text->ViewCustomAttributes = "";

			// row_id
			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";
			$this->row_id->TooltipValue = "";

			// type_id
			$this->type_id->LinkCustomAttributes = "";
			$this->type_id->HrefValue = "";
			$this->type_id->TooltipValue = "";

			// slid_id
			$this->slid_id->LinkCustomAttributes = "";
			$this->slid_id->HrefValue = "";
			$this->slid_id->TooltipValue = "";

			// video_id
			$this->video_id->LinkCustomAttributes = "";
			$this->video_id->HrefValue = "";
			$this->video_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// cols_id
			$this->cols_id->LinkCustomAttributes = "";
			$this->cols_id->HrefValue = "";
			$this->cols_id->TooltipValue = "";

			// blk_order
			$this->blk_order->LinkCustomAttributes = "";
			$this->blk_order->HrefValue = "";
			$this->blk_order->TooltipValue = "";

			// blk_name
			$this->blk_name->LinkCustomAttributes = "";
			$this->blk_name->HrefValue = "";
			$this->blk_name->TooltipValue = "";

			// blk_header
			$this->blk_header->LinkCustomAttributes = "";
			$this->blk_header->HrefValue = "";
			$this->blk_header->TooltipValue = "";

			// blk_image
			$this->blk_image->LinkCustomAttributes = "";
			$this->blk_image->UploadPath = '../../assets/pages/img/pageImages';
			if (!ew_Empty($this->blk_image->Upload->DbValue)) {
				$this->blk_image->HrefValue = ew_GetFileUploadUrl($this->blk_image, $this->blk_image->Upload->DbValue); // Add prefix/suffix
				$this->blk_image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->blk_image->HrefValue = ew_FullUrl($this->blk_image->HrefValue, "href");
			} else {
				$this->blk_image->HrefValue = "";
			}
			$this->blk_image->HrefValue2 = $this->blk_image->UploadPath . $this->blk_image->Upload->DbValue;
			$this->blk_image->TooltipValue = "";
			if ($this->blk_image->UseColorbox) {
				if (ew_Empty($this->blk_image->TooltipValue))
					$this->blk_image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->blk_image->LinkAttrs["data-rel"] = "cpy_page_row_block_x_blk_image";
				ew_AppendClass($this->blk_image->LinkAttrs["class"], "ewLightbox");
			}

			// blk_stext
			$this->blk_stext->LinkCustomAttributes = "";
			$this->blk_stext->HrefValue = "";
			$this->blk_stext->TooltipValue = "";

			// blk_text
			$this->blk_text->LinkCustomAttributes = "";
			$this->blk_text->HrefValue = "";
			$this->blk_text->TooltipValue = "";
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
			if ($sMasterTblVar == "cpy_page_row") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_row_id"] <> "") {
					$GLOBALS["cpy_page_row"]->row_id->setQueryStringValue($_GET["fk_row_id"]);
					$this->row_id->setQueryStringValue($GLOBALS["cpy_page_row"]->row_id->QueryStringValue);
					$this->row_id->setSessionValue($this->row_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_page_row"]->row_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_page_row") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_row_id"] <> "") {
					$GLOBALS["cpy_page_row"]->row_id->setFormValue($_POST["fk_row_id"]);
					$this->row_id->setFormValue($GLOBALS["cpy_page_row"]->row_id->FormValue);
					$this->row_id->setSessionValue($this->row_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_page_row"]->row_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cpy_page_row") {
				if ($this->row_id->CurrentValue == "") $this->row_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_page_row_blocklist.php"), "", $this->TableVar, TRUE);
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
if (!isset($cpy_page_row_block_view)) $cpy_page_row_block_view = new ccpy_page_row_block_view();

// Page init
$cpy_page_row_block_view->Page_Init();

// Page main
$cpy_page_row_block_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_page_row_block_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcpy_page_row_blockview = new ew_Form("fcpy_page_row_blockview", "view");

// Form_CustomValidate event
fcpy_page_row_blockview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_page_row_blockview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_page_row_blockview.Lists["x_row_id"] = {"LinkField":"x_row_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_row_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_page_row"};
fcpy_page_row_blockview.Lists["x_row_id"].Data = "<?php echo $cpy_page_row_block_view->row_id->LookupFilterQuery(FALSE, "view") ?>";
fcpy_page_row_blockview.Lists["x_type_id"] = {"LinkField":"x_type_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_type_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_block_type"};
fcpy_page_row_blockview.Lists["x_type_id"].Data = "<?php echo $cpy_page_row_block_view->type_id->LookupFilterQuery(FALSE, "view") ?>";
fcpy_page_row_blockview.Lists["x_slid_id"] = {"LinkField":"x_slid_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_slid_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_slider_mst"};
fcpy_page_row_blockview.Lists["x_slid_id"].Data = "<?php echo $cpy_page_row_block_view->slid_id->LookupFilterQuery(FALSE, "view") ?>";
fcpy_page_row_blockview.Lists["x_video_id"] = {"LinkField":"x_video_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_video_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_video"};
fcpy_page_row_blockview.Lists["x_video_id"].Data = "<?php echo $cpy_page_row_block_view->video_id->LookupFilterQuery(FALSE, "view") ?>";
fcpy_page_row_blockview.Lists["x_status_id"] = {"LinkField":"x_status_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_status_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_status"};
fcpy_page_row_blockview.Lists["x_status_id"].Data = "<?php echo $cpy_page_row_block_view->status_id->LookupFilterQuery(FALSE, "view") ?>";
fcpy_page_row_blockview.Lists["x_cols_id"] = {"LinkField":"x_cols_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_cols_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_cols"};
fcpy_page_row_blockview.Lists["x_cols_id"].Data = "<?php echo $cpy_page_row_block_view->cols_id->LookupFilterQuery(FALSE, "view") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $cpy_page_row_block_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cpy_page_row_block_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $cpy_page_row_block_view->ShowPageHeader(); ?>
<?php
$cpy_page_row_block_view->ShowMessage();
?>
<?php if (!$cpy_page_row_block_view->IsModal) { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cpy_page_row_block_view->Pager)) $cpy_page_row_block_view->Pager = new cPrevNextPager($cpy_page_row_block_view->StartRec, $cpy_page_row_block_view->DisplayRecs, $cpy_page_row_block_view->TotalRecs, $cpy_page_row_block_view->AutoHidePager) ?>
<?php if ($cpy_page_row_block_view->Pager->RecordCount > 0 && $cpy_page_row_block_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_page_row_block_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_page_row_block_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_page_row_block_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_page_row_block_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_page_row_block_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_page_row_block_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcpy_page_row_blockview" id="fcpy_page_row_blockview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_page_row_block_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_page_row_block_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_page_row_block">
<input type="hidden" name="modal" value="<?php echo intval($cpy_page_row_block_view->IsModal) ?>">
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($cpy_page_row_block->row_id->Visible) { // row_id ?>
	<tr id="r_row_id">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_row_id"><?php echo $cpy_page_row_block->row_id->FldCaption() ?></span></td>
		<td data-name="row_id"<?php echo $cpy_page_row_block->row_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_row_id">
<span<?php echo $cpy_page_row_block->row_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->row_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->type_id->Visible) { // type_id ?>
	<tr id="r_type_id">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_type_id"><?php echo $cpy_page_row_block->type_id->FldCaption() ?></span></td>
		<td data-name="type_id"<?php echo $cpy_page_row_block->type_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_type_id">
<span<?php echo $cpy_page_row_block->type_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->type_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->slid_id->Visible) { // slid_id ?>
	<tr id="r_slid_id">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_slid_id"><?php echo $cpy_page_row_block->slid_id->FldCaption() ?></span></td>
		<td data-name="slid_id"<?php echo $cpy_page_row_block->slid_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_slid_id">
<span<?php echo $cpy_page_row_block->slid_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->slid_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->video_id->Visible) { // video_id ?>
	<tr id="r_video_id">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_video_id"><?php echo $cpy_page_row_block->video_id->FldCaption() ?></span></td>
		<td data-name="video_id"<?php echo $cpy_page_row_block->video_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_video_id">
<span<?php echo $cpy_page_row_block->video_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->video_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->status_id->Visible) { // status_id ?>
	<tr id="r_status_id">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_status_id"><?php echo $cpy_page_row_block->status_id->FldCaption() ?></span></td>
		<td data-name="status_id"<?php echo $cpy_page_row_block->status_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_status_id">
<span<?php echo $cpy_page_row_block->status_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->status_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->cols_id->Visible) { // cols_id ?>
	<tr id="r_cols_id">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_cols_id"><?php echo $cpy_page_row_block->cols_id->FldCaption() ?></span></td>
		<td data-name="cols_id"<?php echo $cpy_page_row_block->cols_id->CellAttributes() ?>>
<span id="el_cpy_page_row_block_cols_id">
<span<?php echo $cpy_page_row_block->cols_id->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->cols_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->blk_order->Visible) { // blk_order ?>
	<tr id="r_blk_order">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_blk_order"><?php echo $cpy_page_row_block->blk_order->FldCaption() ?></span></td>
		<td data-name="blk_order"<?php echo $cpy_page_row_block->blk_order->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_order">
<span<?php echo $cpy_page_row_block->blk_order->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_order->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->blk_name->Visible) { // blk_name ?>
	<tr id="r_blk_name">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_blk_name"><?php echo $cpy_page_row_block->blk_name->FldCaption() ?></span></td>
		<td data-name="blk_name"<?php echo $cpy_page_row_block->blk_name->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_name">
<span<?php echo $cpy_page_row_block->blk_name->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_name->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->blk_header->Visible) { // blk_header ?>
	<tr id="r_blk_header">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_blk_header"><?php echo $cpy_page_row_block->blk_header->FldCaption() ?></span></td>
		<td data-name="blk_header"<?php echo $cpy_page_row_block->blk_header->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_header">
<span<?php echo $cpy_page_row_block->blk_header->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_header->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->blk_image->Visible) { // blk_image ?>
	<tr id="r_blk_image">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_blk_image"><?php echo $cpy_page_row_block->blk_image->FldCaption() ?></span></td>
		<td data-name="blk_image"<?php echo $cpy_page_row_block->blk_image->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_image">
<span>
<?php echo ew_GetFileViewTag($cpy_page_row_block->blk_image, $cpy_page_row_block->blk_image->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->blk_stext->Visible) { // blk_stext ?>
	<tr id="r_blk_stext">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_blk_stext"><?php echo $cpy_page_row_block->blk_stext->FldCaption() ?></span></td>
		<td data-name="blk_stext"<?php echo $cpy_page_row_block->blk_stext->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_stext">
<span<?php echo $cpy_page_row_block->blk_stext->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_stext->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cpy_page_row_block->blk_text->Visible) { // blk_text ?>
	<tr id="r_blk_text">
		<td class="col-sm-2"><span id="elh_cpy_page_row_block_blk_text"><?php echo $cpy_page_row_block->blk_text->FldCaption() ?></span></td>
		<td data-name="blk_text"<?php echo $cpy_page_row_block->blk_text->CellAttributes() ?>>
<span id="el_cpy_page_row_block_blk_text">
<span<?php echo $cpy_page_row_block->blk_text->ViewAttributes() ?>>
<?php echo $cpy_page_row_block->blk_text->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cpy_page_row_block_view->IsModal) { ?>
<?php if (!isset($cpy_page_row_block_view->Pager)) $cpy_page_row_block_view->Pager = new cPrevNextPager($cpy_page_row_block_view->StartRec, $cpy_page_row_block_view->DisplayRecs, $cpy_page_row_block_view->TotalRecs, $cpy_page_row_block_view->AutoHidePager) ?>
<?php if ($cpy_page_row_block_view->Pager->RecordCount > 0 && $cpy_page_row_block_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cpy_page_row_block_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cpy_page_row_block_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cpy_page_row_block_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cpy_page_row_block_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cpy_page_row_block_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cpy_page_row_block_view->PageUrl() ?>start=<?php echo $cpy_page_row_block_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cpy_page_row_block_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
fcpy_page_row_blockview.Init();
</script>
<?php
$cpy_page_row_block_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_page_row_block_view->Page_Terminate();
?>
