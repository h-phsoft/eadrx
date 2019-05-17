<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * PhSoft Common functions
 * (C) 2000-2015 PhSoft.
 */
$PH_CLASS_PATH = "classes/";
include_once $PH_CLASS_PATH . "cLang.php";
include_once $PH_CLASS_PATH . "cGender.php";
include_once $PH_CLASS_PATH . "cCountry.php";
include_once $PH_CLASS_PATH . "cSlide.php";
include_once $PH_CLASS_PATH . "cSlider.php";
include_once $PH_CLASS_PATH . "cMenu.php";
include_once $PH_CLASS_PATH . "cNews.php";
include_once $PH_CLASS_PATH . "cPageRowBlock.php";
include_once $PH_CLASS_PATH . "cPageRow.php";
include_once $PH_CLASS_PATH . "cPage.php";
include_once $PH_CLASS_PATH . "cFaqCategory.php";
include_once $PH_CLASS_PATH . "cFaq.php";
include_once $PH_CLASS_PATH . "cBookPage.php";
include_once $PH_CLASS_PATH . "cBook.php";
include_once $PH_CLASS_PATH . "cTestQuestion.php";
include_once $PH_CLASS_PATH . "cTestEvaluate.php";
include_once $PH_CLASS_PATH . "cTest.php";
include_once $PH_CLASS_PATH . "cNotification.php";
include_once $PH_CLASS_PATH . "cTips.php";
include_once $PH_CLASS_PATH . "cPackageCategory.php";
include_once $PH_CLASS_PATH . "cPackage.php";

if (!function_exists('cp_getRandomTip')) {

  function cp_getRandomTip($nLang = 2) {
    $nMin = ph_GetDBValue('Min(`tips_id`)', '`app_tips`', '`lang_id`=' . $nLang);
    $nMax = ph_GetDBValue('Max(`tips_id`)', '`app_tips`', '`lang_id`=' . $nLang);
    $nId = rand($nMin, $nMax);
    $vTip = ph_GetDBValue('`tips_text`', '`app_tips`', '`tips_id`=' . $nId);
    return $vTip;
  }

}

if (!function_exists('cp_getDailyTip')) {

  function cp_getDailyTip($nLang = 2) {
    $nMin = ph_GetDBValue('Min(`tips_id`)', '`app_tips`', '`lang_id`=' . $nLang);
    $nMax = ph_GetDBValue('Max(`tips_id`)', '`app_tips`', '`lang_id`=' . $nLang);
    $nId = rand($nMin, $nMax);
    $tip = cTips::getInstance($nId);
    return $tip;
  }

}

if (!function_exists('cp_doLoginActions')) {

  function cp_doLoginActions($nUserId) {
    $vSQL = 'INSERT INTO app_notification_for '
            . '(`notif_id`, `user_id`, `nstatus_id`)'
            . 'SELECT `notif_id`, ' . $nUserId . ', 3'
            . ' FROM app_notification'
            . ' WHERE `for_id`=0'
            . ' AND `notif_id` NOT IN (SELECT `notif_id` FROM app_notification_for WHERE `user_id`=' . $nUserId . ')';
    ph_Execute($vSQL);
    $vSQL = 'UPDATE app_notification_for SET `nstatus_id`=3 WHERE `user_id`=' . $nUserId . ' AND `nstatus_id`<3';
    ph_Execute($vSQL);
  }

}

if (!function_exists('cp_AddLog')) {

  function cp_AddLog($vText) {
    $nInsertedId = -999;
    $nUserId = ph_session("UID");

    if ($vText != '') {
      $vText = str_replace("'", '"', $vText);
      $sSQL = "INSERT INTO `cpy_log` (`user_id`, `log_date`, `log_text`)"
              . " VALUES ("
              . "'" . $nUserId . "', NOW(), '" . $vText . "')";
      ph_Execute($sSQL);
      $nInsertedId = ph_InsertedId();
    }
    return $nInsertedId;
  }

}

if (!function_exists('cp_AddContact')) {

  function cp_AddContact($nUserId, $sSubject, $sMessage) {
    $nRegId = -999;
    if ($nUserId != '' && $sSubject != '' && $sMessage != '') {
      $sSQL = "INSERT INTO `app_contactus` ( `user_id`, `cont_subj`, `cont_msg` )"
              . " VALUES ( '" . $nUserId . "', '" . $sSubject . "', '" . $sMessage . "' )";
      ph_Execute($sSQL);
      $nRegId = ph_InsertedId();
      ph_AddLog('Subject=[' . $sSubject . '] Message=[' . $sMessage . '] Id=[' . $nRegId . ']', 'Add ContactUs');
    }
    return $nRegId;
  }

}

if (!function_exists('cp_isUserExist')) {

  function cp_isUserExist($sPhULogin) {
    $nUId = ph_GetDBValue('user_id', 'cpy_user', '(lower(`user_name`)=lower("' . $sPhULogin . '"))');
    return ($nUId != '');
  }

}

if (!function_exists('cp_RegisterUser')) {

  function cp_RegisterUser($sPhName, $sPhUPass, $nGender) {
    $nRegId = -999;
    if ($sPhUPass != '' && $sPhName != '') {
      if (!cp_isUserExist($sPhName)) {
        $sSQL = "INSERT INTO `cpy_user` ( `user_name`, `user_password`, `gend_id` )"
                . " VALUES ( '" . $sPhName . "', '" . ph_EncodePassword($sPhUPass) . "', '" . $nGender . "' )";
        ph_Execute($sSQL);
        $nRegId = ph_InsertedId();
        ph_AddLog('Name=[' . $sPhName . '] Id=[' . $nRegId . ']', 'Add User');
      }
    }
    return $nRegId;
  }

}

if (!function_exists('cp_UserName')) {

  function cp_UserName($userId) {
    $bRet = ph_GetDBValue('user_name', 'cpy_user', '(`user_id`=' . $userId . ')');
    return $bRet;
  }

}

if (!function_exists('cp_Login')) {

  function cp_Login($sPhUName, $sPhUPass) {
    $vWhere = "(`status_id`=1"
            . " AND lower(`user_name`)=lower('" . $sPhUName . "')"
            . " AND `user_password`='" . ph_EncodePassword($sPhUPass) . "')";
    $nUserId = ph_GetDBValue('user_id', 'cpy_user', $vWhere);
    if ($nUserId != '') {
      cp_doLoginActions($nUserId);
    }
    ph_AddLog('Name=[' . $sPhUName . '] Id=[' . $nUserId . ']', 'Login User');
    return $nUserId;
  }

}