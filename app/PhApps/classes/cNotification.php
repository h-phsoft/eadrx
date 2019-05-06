<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cNotification {

  var $Notif_Id = 0;
  var $Lang_Id = 2;
  var $For_Id = 0;
  var $Status_Id = 1;
  var $Notif_Title = "";
  var $Notif_Text = "";
  var $Ins_Datetime = "";

  public static function getArray($vCond = "") {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `notif_id`, `lang_id`, `for_id`, `nstatus_id`, `notif_title`, `notif_text`, `ins_datetime`'
            . ' FROM `app_notification`';
    if ($vCond != "") {
      $sSQL .= ' WHERE (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `ins_datetime`, `notif_id`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cNotification::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getUserNotifications($nUserId) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `notif_id`, `lang_id`, `for_id`, `nstatus_id`, `notif_title`, `notif_text`, `ins_datetime`'
            . 'FROM '
            . '(SELECT `notif_id`, `lang_id`, `for_id`, `nstatus_id`, `notif_title`, `notif_text`, `ins_datetime`'
            . '   FROM `app_notification`'
            . '  WHERE (`for_id`=1 '
            . '    AND `notif_id` NOT IN (SELECT `notif_id` FROM app_notification_for WHERE `user_id`=' . $nUserId . ')'
            . '        )'
            . ' UNION ALL '
            . ' SELECT `n`.`notif_id`, `lang_id`, `for_id`, `n`.`nstatus_id`, `notif_title`, `notif_text`, `ins_datetime`'
            . '   FROM `app_notification` AS `n`, app_notification_for AS `f`'
            . '  WHERE (`f`.`notif_id`=`n`.`notif_id`)'
            . '    AND `user_id`=' . $nUserId
            . ') AS `SS`'
            . ' ORDER BY `ins_datetime` DESC';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cNotification::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cNotification();
    $sSQL = 'SELECT `notif_id`, `lang_id`, `for_id`, `nstatus_id`, `notif_title`, `notif_text`, `ins_datetime`'
            . ' FROM `app_notification`';
    if ($nId != "") {
      $sSQL .= ' WHERE (`notif_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cNotification::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cNotification();
    $cClass->Notif_Id = $res->fields("notif_id");
    $cClass->Lang_Id = $res->fields("lang_id");
    $cClass->For_Id = $res->fields("for_id");
    $cClass->Status_Id = $res->fields("nstatus_id");
    $cClass->Notif_Title = $res->fields("notif_title");
    $cClass->Notif_Text = $res->fields("notif_text");
    $cClass->Ins_Datetime = $res->fields("ins_datetime");
    return $cClass;
  }

}
