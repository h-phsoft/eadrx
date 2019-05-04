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

$cpy_team_names_delete = NULL; // Initialize page object first

class ccpy_team_names_delete extends ccpy_team_names {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_team_names';

	// Page object name
	var $PageObjName = 'cpy_team_names_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("cpy_team_nameslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in cpy_team_names class, cpy_team_namesinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("cpy_team_nameslist.php"); // Return to list
			}
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
		$this->teamn_id->setDbValue($row['teamn_id']);
		$this->team_id->setDbValue($row['team_id']);
		$this->lang_id->setDbValue($row['lang_id']);
		$this->team_name->setDbValue($row['team_name']);
		$this->team_title->setDbValue($row['team_title']);
		$this->team_position->setDbValue($row['team_position']);
		$this->team_text->setDbValue($row['team_text']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['teamn_id'] = NULL;
		$row['team_id'] = NULL;
		$row['lang_id'] = NULL;
		$row['team_name'] = NULL;
		$row['team_title'] = NULL;
		$row['team_position'] = NULL;
		$row['team_text'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->teamn_id->DbValue = $row['teamn_id'];
		$this->team_id->DbValue = $row['team_id'];
		$this->lang_id->DbValue = $row['lang_id'];
		$this->team_name->DbValue = $row['team_name'];
		$this->team_title->DbValue = $row['team_title'];
		$this->team_position->DbValue = $row['team_position'];
		$this->team_text->DbValue = $row['team_text'];
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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['teamn_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
			if ($sMasterTblVar == "cpy_team") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_team_id"] <> "") {
					$GLOBALS["cpy_team"]->team_id->setQueryStringValue($_GET["fk_team_id"]);
					$this->team_id->setQueryStringValue($GLOBALS["cpy_team"]->team_id->QueryStringValue);
					$this->team_id->setSessionValue($this->team_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cpy_team"]->team_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cpy_team") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_team_id"] <> "") {
					$GLOBALS["cpy_team"]->team_id->setFormValue($_POST["fk_team_id"]);
					$this->team_id->setFormValue($GLOBALS["cpy_team"]->team_id->FormValue);
					$this->team_id->setSessionValue($this->team_id->FormValue);
					if (!is_numeric($GLOBALS["cpy_team"]->team_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "cpy_team") {
				if ($this->team_id->CurrentValue == "") $this->team_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_team_nameslist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cpy_team_names_delete)) $cpy_team_names_delete = new ccpy_team_names_delete();

// Page init
$cpy_team_names_delete->Page_Init();

// Page main
$cpy_team_names_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_team_names_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fcpy_team_namesdelete = new ew_Form("fcpy_team_namesdelete", "delete");

// Form_CustomValidate event
fcpy_team_namesdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_team_namesdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcpy_team_namesdelete.Lists["x_team_id"] = {"LinkField":"x_team_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_team_iname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cpy_team"};
fcpy_team_namesdelete.Lists["x_team_id"].Data = "<?php echo $cpy_team_names_delete->team_id->LookupFilterQuery(FALSE, "delete") ?>";
fcpy_team_namesdelete.Lists["x_lang_id"] = {"LinkField":"x_lang_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_lang_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_language"};
fcpy_team_namesdelete.Lists["x_lang_id"].Data = "<?php echo $cpy_team_names_delete->lang_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_team_names_delete->ShowPageHeader(); ?>
<?php
$cpy_team_names_delete->ShowMessage();
?>
<form name="fcpy_team_namesdelete" id="fcpy_team_namesdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_team_names_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_team_names_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_team_names">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cpy_team_names_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
		<th class="<?php echo $cpy_team_names->teamn_id->HeaderCellClass() ?>"><span id="elh_cpy_team_names_teamn_id" class="cpy_team_names_teamn_id"><?php echo $cpy_team_names->teamn_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
		<th class="<?php echo $cpy_team_names->team_id->HeaderCellClass() ?>"><span id="elh_cpy_team_names_team_id" class="cpy_team_names_team_id"><?php echo $cpy_team_names->team_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
		<th class="<?php echo $cpy_team_names->lang_id->HeaderCellClass() ?>"><span id="elh_cpy_team_names_lang_id" class="cpy_team_names_lang_id"><?php echo $cpy_team_names->lang_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
		<th class="<?php echo $cpy_team_names->team_name->HeaderCellClass() ?>"><span id="elh_cpy_team_names_team_name" class="cpy_team_names_team_name"><?php echo $cpy_team_names->team_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
		<th class="<?php echo $cpy_team_names->team_title->HeaderCellClass() ?>"><span id="elh_cpy_team_names_team_title" class="cpy_team_names_team_title"><?php echo $cpy_team_names->team_title->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
		<th class="<?php echo $cpy_team_names->team_position->HeaderCellClass() ?>"><span id="elh_cpy_team_names_team_position" class="cpy_team_names_team_position"><?php echo $cpy_team_names->team_position->FldCaption() ?></span></th>
<?php } ?>
<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
		<th class="<?php echo $cpy_team_names->team_text->HeaderCellClass() ?>"><span id="elh_cpy_team_names_team_text" class="cpy_team_names_team_text"><?php echo $cpy_team_names->team_text->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cpy_team_names_delete->RecCnt = 0;
$i = 0;
while (!$cpy_team_names_delete->Recordset->EOF) {
	$cpy_team_names_delete->RecCnt++;
	$cpy_team_names_delete->RowCnt++;

	// Set row properties
	$cpy_team_names->ResetAttrs();
	$cpy_team_names->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cpy_team_names_delete->LoadRowValues($cpy_team_names_delete->Recordset);

	// Render row
	$cpy_team_names_delete->RenderRow();
?>
	<tr<?php echo $cpy_team_names->RowAttributes() ?>>
<?php if ($cpy_team_names->teamn_id->Visible) { // teamn_id ?>
		<td<?php echo $cpy_team_names->teamn_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_teamn_id" class="cpy_team_names_teamn_id">
<span<?php echo $cpy_team_names->teamn_id->ViewAttributes() ?>>
<?php echo $cpy_team_names->teamn_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_team_names->team_id->Visible) { // team_id ?>
		<td<?php echo $cpy_team_names->team_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_team_id" class="cpy_team_names_team_id">
<span<?php echo $cpy_team_names->team_id->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_team_names->lang_id->Visible) { // lang_id ?>
		<td<?php echo $cpy_team_names->lang_id->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_lang_id" class="cpy_team_names_lang_id">
<span<?php echo $cpy_team_names->lang_id->ViewAttributes() ?>>
<?php echo $cpy_team_names->lang_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_team_names->team_name->Visible) { // team_name ?>
		<td<?php echo $cpy_team_names->team_name->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_team_name" class="cpy_team_names_team_name">
<span<?php echo $cpy_team_names->team_name->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_team_names->team_title->Visible) { // team_title ?>
		<td<?php echo $cpy_team_names->team_title->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_team_title" class="cpy_team_names_team_title">
<span<?php echo $cpy_team_names->team_title->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_title->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_team_names->team_position->Visible) { // team_position ?>
		<td<?php echo $cpy_team_names->team_position->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_team_position" class="cpy_team_names_team_position">
<span<?php echo $cpy_team_names->team_position->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_position->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cpy_team_names->team_text->Visible) { // team_text ?>
		<td<?php echo $cpy_team_names->team_text->CellAttributes() ?>>
<span id="el<?php echo $cpy_team_names_delete->RowCnt ?>_cpy_team_names_team_text" class="cpy_team_names_team_text">
<span<?php echo $cpy_team_names->team_text->ViewAttributes() ?>>
<?php echo $cpy_team_names->team_text->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cpy_team_names_delete->Recordset->MoveNext();
}
$cpy_team_names_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_team_names_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fcpy_team_namesdelete.Init();
</script>
<?php
$cpy_team_names_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_team_names_delete->Page_Terminate();
?>
