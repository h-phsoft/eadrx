<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "phs_permsinfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$phs_perms_update = NULL; // Initialize page object first

class cphs_perms_update extends cphs_perms {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'phs_perms';

	// Page object name
	var $PageObjName = 'phs_perms_update';

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

		// Table object (phs_perms)
		if (!isset($GLOBALS["phs_perms"]) || get_class($GLOBALS["phs_perms"]) == "cphs_perms") {
			$GLOBALS["phs_perms"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["phs_perms"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'phs_perms', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("phs_permslist.php"));
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
		$this->pgrp_id->SetVisibility();
		$this->perm_table->SetVisibility();
		$this->perm_perm->SetVisibility();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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
		global $EW_EXPORT, $phs_perms;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($phs_perms);
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
					if ($pageName == "phs_permsview.php")
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
	var $FormClassName = "form-horizontal ewForm ewUpdateForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $RecKeys;
	var $Disabled;
	var $Recordset;
	var $UpdateCount = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewUpdateForm form-horizontal";

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		if (@$_POST["a_update"] <> "") {

			// Get action
			$this->CurrentAction = $_POST["a_update"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->LoadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->Page_Terminate("phs_permslist.php"); // No records selected, return to list
		switch ($this->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		$this->CurrentFilter = $this->GetKeyFilter();

		// Load recordset
		if ($this->Recordset = $this->LoadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->pgrp_id->setDbValue($this->Recordset->fields('pgrp_id'));
					$this->perm_table->setDbValue($this->Recordset->fields('perm_table'));
					$this->perm_perm->setDbValue($this->Recordset->fields('perm_perm'));
				} else {
					if (!ew_CompareValue($this->pgrp_id->DbValue, $this->Recordset->fields('pgrp_id')))
						$this->pgrp_id->CurrentValue = NULL;
					if (!ew_CompareValue($this->perm_table->DbValue, $this->Recordset->fields('perm_table')))
						$this->perm_table->CurrentValue = NULL;
					if (!ew_CompareValue($this->perm_perm->DbValue, $this->Recordset->fields('perm_perm')))
						$this->perm_perm->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->MoveNext();
			}
			$this->Recordset->Close();
		}
	}

	// Set up key value
	function SetupKeyValues($key) {
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$this->perm_id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $Language;
		$conn = &$this->Connection();
		$conn->BeginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->GetKeyFilter();
		$sSql = $this->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->RecKeys as $key) {
			if ($this->SetupKeyValues($key)) {
				$sThisKey = $key;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				break; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pgrp_id->FldIsDetailKey) {
			$this->pgrp_id->setFormValue($objForm->GetValue("x_pgrp_id"));
		}
		$this->pgrp_id->MultiUpdate = $objForm->GetValue("u_pgrp_id");
		if (!$this->perm_table->FldIsDetailKey) {
			$this->perm_table->setFormValue($objForm->GetValue("x_perm_table"));
		}
		$this->perm_table->MultiUpdate = $objForm->GetValue("u_perm_table");
		if (!$this->perm_perm->FldIsDetailKey) {
			$this->perm_perm->setFormValue($objForm->GetValue("x_perm_perm"));
		}
		$this->perm_perm->MultiUpdate = $objForm->GetValue("u_perm_perm");
		if (!$this->perm_id->FldIsDetailKey)
			$this->perm_id->setFormValue($objForm->GetValue("x_perm_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->perm_id->CurrentValue = $this->perm_id->FormValue;
		$this->pgrp_id->CurrentValue = $this->pgrp_id->FormValue;
		$this->perm_table->CurrentValue = $this->perm_table->FormValue;
		$this->perm_perm->CurrentValue = $this->perm_perm->FormValue;
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
		$this->perm_id->setDbValue($row['perm_id']);
		$this->pgrp_id->setDbValue($row['pgrp_id']);
		$this->perm_table->setDbValue($row['perm_table']);
		$this->perm_perm->setDbValue($row['perm_perm']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['perm_id'] = NULL;
		$row['pgrp_id'] = NULL;
		$row['perm_table'] = NULL;
		$row['perm_perm'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->perm_id->DbValue = $row['perm_id'];
		$this->pgrp_id->DbValue = $row['pgrp_id'];
		$this->perm_table->DbValue = $row['perm_table'];
		$this->perm_perm->DbValue = $row['perm_perm'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// perm_id
		// pgrp_id
		// perm_table
		// perm_perm

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pgrp_id
		if (strval($this->pgrp_id->CurrentValue) <> "") {
			$sFilterWrk = "`pgrp_id`" . ew_SearchString("=", $this->pgrp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pgrp_id`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_pgroup`";
		$sWhereWrk = "";
		$this->pgrp_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `pgrp_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pgrp_id->ViewValue = $this->pgrp_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pgrp_id->ViewValue = $this->pgrp_id->CurrentValue;
			}
		} else {
			$this->pgrp_id->ViewValue = NULL;
		}
		$this->pgrp_id->ViewCustomAttributes = "";

		// perm_table
		$this->perm_table->ViewValue = $this->perm_table->CurrentValue;
		$this->perm_table->ViewCustomAttributes = "";

		// perm_perm
		$this->perm_perm->ViewValue = $this->perm_perm->CurrentValue;
		$this->perm_perm->ViewCustomAttributes = "";

			// pgrp_id
			$this->pgrp_id->LinkCustomAttributes = "";
			$this->pgrp_id->HrefValue = "";
			$this->pgrp_id->TooltipValue = "";

			// perm_table
			$this->perm_table->LinkCustomAttributes = "";
			$this->perm_table->HrefValue = "";
			$this->perm_table->TooltipValue = "";

			// perm_perm
			$this->perm_perm->LinkCustomAttributes = "";
			$this->perm_perm->HrefValue = "";
			$this->perm_perm->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// pgrp_id
			$this->pgrp_id->EditAttrs["class"] = "form-control";
			$this->pgrp_id->EditCustomAttributes = "";
			if (trim(strval($this->pgrp_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pgrp_id`" . ew_SearchString("=", $this->pgrp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `pgrp_id`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `phs_pgroup`";
			$sWhereWrk = "";
			$this->pgrp_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pgrp_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pgrp_id->EditValue = $arwrk;

			// perm_table
			$this->perm_table->EditAttrs["class"] = "form-control";
			$this->perm_table->EditCustomAttributes = "";
			$this->perm_table->EditValue = ew_HtmlEncode($this->perm_table->CurrentValue);
			$this->perm_table->PlaceHolder = ew_RemoveHtml($this->perm_table->FldCaption());

			// perm_perm
			$this->perm_perm->EditAttrs["class"] = "form-control";
			$this->perm_perm->EditCustomAttributes = "";
			$this->perm_perm->EditValue = ew_HtmlEncode($this->perm_perm->CurrentValue);
			$this->perm_perm->PlaceHolder = ew_RemoveHtml($this->perm_perm->FldCaption());

			// Edit refer script
			// pgrp_id

			$this->pgrp_id->LinkCustomAttributes = "";
			$this->pgrp_id->HrefValue = "";

			// perm_table
			$this->perm_table->LinkCustomAttributes = "";
			$this->perm_table->HrefValue = "";

			// perm_perm
			$this->perm_perm->LinkCustomAttributes = "";
			$this->perm_perm->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($this->pgrp_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->perm_table->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->perm_perm->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->pgrp_id->MultiUpdate <> "" && !$this->pgrp_id->FldIsDetailKey && !is_null($this->pgrp_id->FormValue) && $this->pgrp_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pgrp_id->FldCaption(), $this->pgrp_id->ReqErrMsg));
		}
		if ($this->perm_table->MultiUpdate <> "" && !$this->perm_table->FldIsDetailKey && !is_null($this->perm_table->FormValue) && $this->perm_table->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->perm_table->FldCaption(), $this->perm_table->ReqErrMsg));
		}
		if ($this->perm_perm->MultiUpdate <> "" && !$this->perm_perm->FldIsDetailKey && !is_null($this->perm_perm->FormValue) && $this->perm_perm->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->perm_perm->FldCaption(), $this->perm_perm->ReqErrMsg));
		}
		if ($this->perm_perm->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->perm_perm->FormValue)) {
				ew_AddMessage($gsFormError, $this->perm_perm->FldErrMsg());
			}
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// pgrp_id
			$this->pgrp_id->SetDbValueDef($rsnew, $this->pgrp_id->CurrentValue, 0, $this->pgrp_id->ReadOnly || $this->pgrp_id->MultiUpdate <> "1");

			// perm_table
			$this->perm_table->SetDbValueDef($rsnew, $this->perm_table->CurrentValue, "", $this->perm_table->ReadOnly || $this->perm_table->MultiUpdate <> "1");

			// perm_perm
			$this->perm_perm->SetDbValueDef($rsnew, $this->perm_perm->CurrentValue, 0, $this->perm_perm->ReadOnly || $this->perm_perm->MultiUpdate <> "1");

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("phs_permslist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_pgrp_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pgrp_id` AS `LinkFld`, `pgrp_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `phs_pgroup`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pgrp_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pgrp_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pgrp_name`";
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
if (!isset($phs_perms_update)) $phs_perms_update = new cphs_perms_update();

// Page init
$phs_perms_update->Page_Init();

// Page main
$phs_perms_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phs_perms_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fphs_permsupdate = new ew_Form("fphs_permsupdate", "update");

// Validate form
fphs_permsupdate.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		ew_Alert(ewLanguage.Phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_pgrp_id");
			uelm = this.GetElements("u" + infix + "_pgrp_id");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_perms->pgrp_id->FldCaption(), $phs_perms->pgrp_id->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_perm_table");
			uelm = this.GetElements("u" + infix + "_perm_table");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_perms->perm_table->FldCaption(), $phs_perms->perm_table->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_perm_perm");
			uelm = this.GetElements("u" + infix + "_perm_perm");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $phs_perms->perm_perm->FldCaption(), $phs_perms->perm_perm->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_perm_perm");
			uelm = this.GetElements("u" + infix + "_perm_perm");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($phs_perms->perm_perm->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fphs_permsupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fphs_permsupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fphs_permsupdate.Lists["x_pgrp_id"] = {"LinkField":"x_pgrp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pgrp_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"phs_pgroup"};
fphs_permsupdate.Lists["x_pgrp_id"].Data = "<?php echo $phs_perms_update->pgrp_id->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $phs_perms_update->ShowPageHeader(); ?>
<?php
$phs_perms_update->ShowMessage();
?>
<form name="fphs_permsupdate" id="fphs_permsupdate" class="<?php echo $phs_perms_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($phs_perms_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $phs_perms_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="phs_perms">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($phs_perms_update->IsModal) ?>">
<?php foreach ($phs_perms_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_phs_permsupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($phs_perms->pgrp_id->Visible) { // pgrp_id ?>
	<div id="r_pgrp_id" class="form-group">
		<label for="x_pgrp_id" class="<?php echo $phs_perms_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_pgrp_id" id="u_pgrp_id" class="ewMultiSelect" value="1"<?php echo ($phs_perms->pgrp_id->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_perms->pgrp_id->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_perms_update->RightColumnClass ?>"><div<?php echo $phs_perms->pgrp_id->CellAttributes() ?>>
<span id="el_phs_perms_pgrp_id">
<select data-table="phs_perms" data-field="x_pgrp_id" data-value-separator="<?php echo $phs_perms->pgrp_id->DisplayValueSeparatorAttribute() ?>" id="x_pgrp_id" name="x_pgrp_id"<?php echo $phs_perms->pgrp_id->EditAttributes() ?>>
<?php echo $phs_perms->pgrp_id->SelectOptionListHtml("x_pgrp_id") ?>
</select>
</span>
<?php echo $phs_perms->pgrp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_perms->perm_table->Visible) { // perm_table ?>
	<div id="r_perm_table" class="form-group">
		<label for="x_perm_table" class="<?php echo $phs_perms_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_perm_table" id="u_perm_table" class="ewMultiSelect" value="1"<?php echo ($phs_perms->perm_table->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_perms->perm_table->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_perms_update->RightColumnClass ?>"><div<?php echo $phs_perms->perm_table->CellAttributes() ?>>
<span id="el_phs_perms_perm_table">
<input type="text" data-table="phs_perms" data-field="x_perm_table" name="x_perm_table" id="x_perm_table" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($phs_perms->perm_table->getPlaceHolder()) ?>" value="<?php echo $phs_perms->perm_table->EditValue ?>"<?php echo $phs_perms->perm_table->EditAttributes() ?>>
</span>
<?php echo $phs_perms->perm_table->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($phs_perms->perm_perm->Visible) { // perm_perm ?>
	<div id="r_perm_perm" class="form-group">
		<label for="x_perm_perm" class="<?php echo $phs_perms_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_perm_perm" id="u_perm_perm" class="ewMultiSelect" value="1"<?php echo ($phs_perms->perm_perm->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $phs_perms->perm_perm->FldCaption() ?></label></div></label>
		<div class="<?php echo $phs_perms_update->RightColumnClass ?>"><div<?php echo $phs_perms->perm_perm->CellAttributes() ?>>
<span id="el_phs_perms_perm_perm">
<input type="text" data-table="phs_perms" data-field="x_perm_perm" name="x_perm_perm" id="x_perm_perm" size="30" placeholder="<?php echo ew_HtmlEncode($phs_perms->perm_perm->getPlaceHolder()) ?>" value="<?php echo $phs_perms->perm_perm->EditValue ?>"<?php echo $phs_perms->perm_perm->EditAttributes() ?>>
</span>
<?php echo $phs_perms->perm_perm->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$phs_perms_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $phs_perms_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $phs_perms_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fphs_permsupdate.Init();
</script>
<?php
$phs_perms_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$phs_perms_update->Page_Terminate();
?>
