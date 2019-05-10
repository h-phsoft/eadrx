<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cTips {

  var $TCat_Id = 0;
  var $CStatus_Id = 1;
  var $TCat_Name = "";
  var $Tips_Id = 0;
  var $Lang_Id = 2;
  var $Status_Id = 1;
  var $Tips_Text = "";
  var $Ins_Datetime = "";

  public static function getArray($vCond = "") {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `tcat_id`, `cstatus_id`, `tcat_name`, `tips_id`, `status_id`, `lang_id`, `tips_text`, `ins_datetime`,'
            . ' FROM `app_vtips`'
            . ' WHERE (`cstatus_id`=1 AND `status_id`=1 AND `tcat_id`!=0)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `tcat_id`, `lang_id`, `tips_id`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cTips::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cTips();
    $sSQL = 'SELECT `tcat_id`, `cstatus_id`, `tcat_name`, `tips_id`, `status_id`, `lang_id`, `tips_text`, `ins_datetime`,'
            . ' FROM `app_vtips`'
            . ' WHERE (`cstatus_id`=1 AND `status_id`=1)';
    if ($nId != "") {
      $sSQL .= ' AND (`tips_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cTips::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cTips();
    $cClass->TCat_Id = $res->fields("tcat_id");
    $cClass->CStatus_Id = $res->fields("cstatus_id");
    $cClass->TCat_Name = $res->fields("tcat_name");
    $cClass->Tips_Id = $res->fields("tips_id");
    $cClass->Lang_Id = $res->fields("lang_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Tips_Text = $res->fields("tips_text");
    $cClass->Ins_Datetime = $res->fields("ins_datetime");
    return $cClass;
  }

}
