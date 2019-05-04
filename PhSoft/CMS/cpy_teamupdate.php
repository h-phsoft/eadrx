<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cpy_teaminfo.php" ?>
<?php include_once "phs_usersinfo.php" ?>
<?php include_once "cpy_team_namesgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cpy_team_update = NULL; // Initialize page object first

class ccpy_team_update extends ccpy_team {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{0D45E216-03EA-4B51-B419-4F1A34666877}';

	// Table name
	var $TableName = 'cpy_team';

	// Page object name
	var $PageObjName = 'cpy_team_update';

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

		// Table object (cpy_team)
		if (!isset($GLOBALS["cpy_team"]) || get_class($GLOBALS["cpy_team"]) == "ccpy_team") {
			$GLOBALS["cpy_team"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cpy_team"];
		}

		// Table object (phs_users)
		if (!isset($GLOBALS['phs_users'])) $GLOBALS['phs_users'] = new cphs_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cpy_team', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("cpy_teamlist.php"));
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
		$this->team_iname->SetVisibility();
		$this->team_order->SetVisibility();
		$this->team_photo->SetVisibility();

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

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("cpy_team_names", $DetailTblVar)) {

					// Process auto fill for detail table 'cpy_team_names'
					if (preg_match('/^fcpy_team_names(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["cpy_team_names_grid"])) $GLOBALS["cpy_team_names_grid"] = new ccpy_team_names_grid;
						$GLOBALS["cpy_team_names_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
			}
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
		global $EW_EXPORT, $cpy_team;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cpy_team);
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
					if ($pageName == "cpy_teamview.php")
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
			$this->Page_Terminate("cpy_teamlist.php"); // No records selected, return to list
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
					$this->team_iname->setDbValue($this->Recordset->fields('team_iname'));
					$this->team_order->setDbValue($this->Recordset->fields('team_order'));
				} else {
					if (!ew_CompareValue($this->team_iname->DbValue, $this->Recordset->fields('team_iname')))
						$this->team_iname->CurrentValue = NULL;
					if (!ew_CompareValue($this->team_order->DbValue, $this->Recordset->fields('team_order')))
						$this->team_order->CurrentValue = NULL;
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
		$this->team_id->CurrentValue = $sKeyFld;
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
		$this->team_photo->Upload->Index = $objForm->Index;
		$this->team_photo->Upload->UploadFile();
		$this->team_photo->CurrentValue = $this->team_photo->Upload->FileName;
		$this->team_photo->MultiUpdate = $objForm->GetValue("u_team_photo");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->team_iname->FldIsDetailKey) {
			$this->team_iname->setFormValue($objForm->GetValue("x_team_iname"));
		}
		$this->team_iname->MultiUpdate = $objForm->GetValue("u_team_iname");
		if (!$this->team_order->FldIsDetailKey) {
			$this->team_order->setFormValue($objForm->GetValue("x_team_order"));
		}
		$this->team_order->MultiUpdate = $objForm->GetValue("u_team_order");
		if (!$this->team_id->FldIsDetailKey)
			$this->team_id->setFormValue($objForm->GetValue("x_team_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->team_id->CurrentValue = $this->team_id->FormValue;
		$this->team_iname->CurrentValue = $this->team_iname->FormValue;
		$this->team_order->CurrentValue = $this->team_order->FormValue;
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
		$this->team_id->setDbValue($row['team_id']);
		$this->team_iname->setDbValue($row['team_iname']);
		$this->team_order->setDbValue($row['team_order']);
		$this->team_photo->Upload->DbValue = $row['team_photo'];
		$this->team_photo->setDbValue($this->team_photo->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['team_id'] = NULL;
		$row['team_iname'] = NULL;
		$row['team_order'] = NULL;
		$row['team_photo'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->team_id->DbValue = $row['team_id'];
		$this->team_iname->DbValue = $row['team_iname'];
		$this->team_order->DbValue = $row['team_order'];
		$this->team_photo->Upload->DbValue = $row['team_photo'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// team_id
		// team_iname
		// team_order
		// team_photo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// team_iname
		$this->team_iname->ViewValue = $this->team_iname->CurrentValue;
		$this->team_iname->ViewCustomAttributes = "";

		// team_order
		$this->team_order->ViewValue = $this->team_order->CurrentValue;
		$this->team_order->ViewCustomAttributes = "";

		// team_photo
		$this->team_photo->UploadPath = '../../assets/corporate/img/teamImages';
		if (!ew_Empty($this->team_photo->Upload->DbValue)) {
			$this->team_photo->ImageWidth = 200;
			$this->team_photo->ImageHeight = 0;
			$this->team_photo->ImageAlt = $this->team_photo->FldAlt();
			$this->team_photo->ViewValue = $this->team_photo->Upload->DbValue;
		} else {
			$this->team_photo->ViewValue = "";
		}
		$this->team_photo->ViewCustomAttributes = "";

			// team_iname
			$this->team_iname->LinkCustomAttributes = "";
			$this->team_iname->HrefValue = "";
			$this->team_iname->TooltipValue = "";

			// team_order
			$this->team_order->LinkCustomAttributes = "";
			$this->team_order->HrefValue = "";
			$this->team_order->TooltipValue = "";

			// team_photo
			$this->team_photo->LinkCustomAttributes = "";
			$this->team_photo->UploadPath = '../../assets/corporate/img/teamImages';
			if (!ew_Empty($this->team_photo->Upload->DbValue)) {
				$this->team_photo->HrefValue = ew_GetFileUploadUrl($this->team_photo, $this->team_photo->Upload->DbValue); // Add prefix/suffix
				$this->team_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->team_photo->HrefValue = ew_FullUrl($this->team_photo->HrefValue, "href");
			} else {
				$this->team_photo->HrefValue = "";
			}
			$this->team_photo->HrefValue2 = $this->team_photo->UploadPath . $this->team_photo->Upload->DbValue;
			$this->team_photo->TooltipValue = "";
			if ($this->team_photo->UseColorbox) {
				if (ew_Empty($this->team_photo->TooltipValue))
					$this->team_photo->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->team_photo->LinkAttrs["data-rel"] = "cpy_team_x_team_photo";
				ew_AppendClass($this->team_photo->LinkAttrs["class"], "ewLightbox");
			}
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// team_iname
			$this->team_iname->EditAttrs["class"] = "form-control";
			$this->team_iname->EditCustomAttributes = "";
			$this->team_iname->EditValue = ew_HtmlEncode($this->team_iname->CurrentValue);
			$this->team_iname->PlaceHolder = ew_RemoveHtml($this->team_iname->FldCaption());

			// team_order
			$this->team_order->EditAttrs["class"] = "form-control";
			$this->team_order->EditCustomAttributes = "";
			$this->team_order->EditValue = ew_HtmlEncode($this->team_order->CurrentValue);
			$this->team_order->PlaceHolder = ew_RemoveHtml($this->team_order->FldCaption());

			// team_photo
			$this->team_photo->EditAttrs["class"] = "form-control";
			$this->team_photo->EditCustomAttributes = "";
			$this->team_photo->UploadPath = '../../assets/corporate/img/teamImages';
			if (!ew_Empty($this->team_photo->Upload->DbValue)) {
				$this->team_photo->ImageWidth = 200;
				$this->team_photo->ImageHeight = 0;
				$this->team_photo->ImageAlt = $this->team_photo->FldAlt();
				$this->team_photo->EditValue = $this->team_photo->Upload->DbValue;
			} else {
				$this->team_photo->EditValue = "";
			}
			if (!ew_Empty($this->team_photo->CurrentValue))
					$this->team_photo->Upload->FileName = $this->team_photo->CurrentValue;

			// Edit refer script
			// team_iname

			$this->team_iname->LinkCustomAttributes = "";
			$this->team_iname->HrefValue = "";

			// team_order
			$this->team_order->LinkCustomAttributes = "";
			$this->team_order->HrefValue = "";

			// team_photo
			$this->team_photo->LinkCustomAttributes = "";
			$this->team_photo->UploadPath = '../../assets/corporate/img/teamImages';
			if (!ew_Empty($this->team_photo->Upload->DbValue)) {
				$this->team_photo->HrefValue = ew_GetFileUploadUrl($this->team_photo, $this->team_photo->Upload->DbValue); // Add prefix/suffix
				$this->team_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->team_photo->HrefValue = ew_FullUrl($this->team_photo->HrefValue, "href");
			} else {
				$this->team_photo->HrefValue = "";
			}
			$this->team_photo->HrefValue2 = $this->team_photo->UploadPath . $this->team_photo->Upload->DbValue;
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
		if ($this->team_iname->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->team_order->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->team_photo->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->team_iname->MultiUpdate <> "" && !$this->team_iname->FldIsDetailKey && !is_null($this->team_iname->FormValue) && $this->team_iname->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_iname->FldCaption(), $this->team_iname->ReqErrMsg));
		}
		if ($this->team_order->MultiUpdate <> "" && !$this->team_order->FldIsDetailKey && !is_null($this->team_order->FormValue) && $this->team_order->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_order->FldCaption(), $this->team_order->ReqErrMsg));
		}
		if ($this->team_order->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->team_order->FormValue)) {
				ew_AddMessage($gsFormError, $this->team_order->FldErrMsg());
			}
		}
		if ($this->team_photo->MultiUpdate <> "" && $this->team_photo->Upload->FileName == "" && !$this->team_photo->Upload->KeepFile) {
			ew_AddMessage($gsFormError, str_replace("%s", $this->team_photo->FldCaption(), $this->team_photo->ReqErrMsg));
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
		if ($this->team_iname->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`team_iname` = '" . ew_AdjustSql($this->team_iname->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->team_iname->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->team_iname->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
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
			$this->team_photo->OldUploadPath = '../../assets/corporate/img/teamImages';
			$this->team_photo->UploadPath = $this->team_photo->OldUploadPath;
			$rsnew = array();

			// team_iname
			$this->team_iname->SetDbValueDef($rsnew, $this->team_iname->CurrentValue, "", $this->team_iname->ReadOnly || $this->team_iname->MultiUpdate <> "1");

			// team_order
			$this->team_order->SetDbValueDef($rsnew, $this->team_order->CurrentValue, 0, $this->team_order->ReadOnly || $this->team_order->MultiUpdate <> "1");

			// team_photo
			if ($this->team_photo->Visible && !$this->team_photo->ReadOnly && strval($this->team_photo->MultiUpdate) == "1" && !$this->team_photo->Upload->KeepFile) {
				$this->team_photo->Upload->DbValue = $rsold['team_photo']; // Get original value
				if ($this->team_photo->Upload->FileName == "") {
					$rsnew['team_photo'] = NULL;
				} else {
					$rsnew['team_photo'] = $this->team_photo->Upload->FileName;
				}
			}
			if ($this->team_photo->Visible && !$this->team_photo->Upload->KeepFile) {
				$this->team_photo->UploadPath = '../../assets/corporate/img/teamImages';
				$OldFiles = ew_Empty($this->team_photo->Upload->DbValue) ? array() : array($this->team_photo->Upload->DbValue);
				if (!ew_Empty($this->team_photo->Upload->FileName) && $this->UpdateCount == 1) {
					$NewFiles = array($this->team_photo->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->team_photo->Upload->Index < 0) ? $this->team_photo->FldVar : substr($this->team_photo->FldVar, 0, 1) . $this->team_photo->Upload->Index . substr($this->team_photo->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->team_photo->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->team_photo->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->team_photo->TblVar) . $file1) || file_exists($this->team_photo->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->team_photo->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->team_photo->TblVar) . $file, ew_UploadTempPath($fldvar, $this->team_photo->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->team_photo->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->team_photo->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->team_photo->SetDbValueDef($rsnew, $this->team_photo->Upload->FileName, "", $this->team_photo->ReadOnly || $this->team_photo->MultiUpdate <> "1");
				}
			}

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
					if ($this->team_photo->Visible && !$this->team_photo->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->team_photo->Upload->DbValue) ? array() : array($this->team_photo->Upload->DbValue);
						if (!ew_Empty($this->team_photo->Upload->FileName) && $this->UpdateCount == 1) {
							$NewFiles = array($this->team_photo->Upload->FileName);
							$NewFiles2 = array($rsnew['team_photo']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->team_photo->Upload->Index < 0) ? $this->team_photo->FldVar : substr($this->team_photo->FldVar, 0, 1) . $this->team_photo->Upload->Index . substr($this->team_photo->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->team_photo->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->team_photo->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$NewFiles = array();
						}
					}
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

		// team_photo
		ew_CleanUploadTempPath($this->team_photo, $this->team_photo->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("cpy_teamlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
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
if (!isset($cpy_team_update)) $cpy_team_update = new ccpy_team_update();

// Page init
$cpy_team_update->Page_Init();

// Page main
$cpy_team_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cpy_team_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fcpy_teamupdate = new ew_Form("fcpy_teamupdate", "update");

// Validate form
fcpy_teamupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_team_iname");
			uelm = this.GetElements("u" + infix + "_team_iname");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team->team_iname->FldCaption(), $cpy_team->team_iname->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_team_order");
			uelm = this.GetElements("u" + infix + "_team_order");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team->team_order->FldCaption(), $cpy_team->team_order->ReqErrMsg)) ?>");
			}
			elm = this.GetElements("x" + infix + "_team_order");
			uelm = this.GetElements("u" + infix + "_team_order");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cpy_team->team_order->FldErrMsg()) ?>");
			felm = this.GetElements("x" + infix + "_team_photo");
			elm = this.GetElements("fn_x" + infix + "_team_photo");
			uelm = this.GetElements("u" + infix + "_team_photo");
			if (uelm && uelm.checked) {
				if (felm && elm && !ew_HasValue(elm))
					return this.OnError(felm, "<?php echo ew_JsEncode2(str_replace("%s", $cpy_team->team_photo->FldCaption(), $cpy_team->team_photo->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcpy_teamupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcpy_teamupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $cpy_team_update->ShowPageHeader(); ?>
<?php
$cpy_team_update->ShowMessage();
?>
<form name="fcpy_teamupdate" id="fcpy_teamupdate" class="<?php echo $cpy_team_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cpy_team_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cpy_team_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cpy_team">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($cpy_team_update->IsModal) ?>">
<?php foreach ($cpy_team_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_cpy_teamupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($cpy_team->team_iname->Visible) { // team_iname ?>
	<div id="r_team_iname" class="form-group">
		<label for="x_team_iname" class="<?php echo $cpy_team_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_team_iname" id="u_team_iname" class="ewMultiSelect" value="1"<?php echo ($cpy_team->team_iname->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_team->team_iname->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_team_update->RightColumnClass ?>"><div<?php echo $cpy_team->team_iname->CellAttributes() ?>>
<span id="el_cpy_team_team_iname">
<input type="text" data-table="cpy_team" data-field="x_team_iname" name="x_team_iname" id="x_team_iname" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cpy_team->team_iname->getPlaceHolder()) ?>" value="<?php echo $cpy_team->team_iname->EditValue ?>"<?php echo $cpy_team->team_iname->EditAttributes() ?>>
</span>
<?php echo $cpy_team->team_iname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team->team_order->Visible) { // team_order ?>
	<div id="r_team_order" class="form-group">
		<label for="x_team_order" class="<?php echo $cpy_team_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_team_order" id="u_team_order" class="ewMultiSelect" value="1"<?php echo ($cpy_team->team_order->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_team->team_order->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_team_update->RightColumnClass ?>"><div<?php echo $cpy_team->team_order->CellAttributes() ?>>
<span id="el_cpy_team_team_order">
<input type="text" data-table="cpy_team" data-field="x_team_order" name="x_team_order" id="x_team_order" size="30" placeholder="<?php echo ew_HtmlEncode($cpy_team->team_order->getPlaceHolder()) ?>" value="<?php echo $cpy_team->team_order->EditValue ?>"<?php echo $cpy_team->team_order->EditAttributes() ?>>
</span>
<?php echo $cpy_team->team_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cpy_team->team_photo->Visible) { // team_photo ?>
	<div id="r_team_photo" class="form-group">
		<label class="<?php echo $cpy_team_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_team_photo" id="u_team_photo" class="ewMultiSelect" value="1"<?php echo ($cpy_team->team_photo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $cpy_team->team_photo->FldCaption() ?></label></div></label>
		<div class="<?php echo $cpy_team_update->RightColumnClass ?>"><div<?php echo $cpy_team->team_photo->CellAttributes() ?>>
<span id="el_cpy_team_team_photo">
<div id="fd_x_team_photo">
<span title="<?php echo $cpy_team->team_photo->FldTitle() ? $cpy_team->team_photo->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($cpy_team->team_photo->ReadOnly || $cpy_team->team_photo->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cpy_team" data-field="x_team_photo" name="x_team_photo" id="x_team_photo"<?php echo $cpy_team->team_photo->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_team_photo" id= "fn_x_team_photo" value="<?php echo $cpy_team->team_photo->Upload->FileName ?>">
<?php if (@$_POST["fa_x_team_photo"] == "0") { ?>
<input type="hidden" name="fa_x_team_photo" id= "fa_x_team_photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_team_photo" id= "fa_x_team_photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x_team_photo" id= "fs_x_team_photo" value="255">
<input type="hidden" name="fx_x_team_photo" id= "fx_x_team_photo" value="<?php echo $cpy_team->team_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_team_photo" id= "fm_x_team_photo" value="<?php echo $cpy_team->team_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_team_photo" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $cpy_team->team_photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$cpy_team_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $cpy_team_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $cpy_team_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fcpy_teamupdate.Init();
</script>
<?php
$cpy_team_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cpy_team_update->Page_Terminate();
?>
