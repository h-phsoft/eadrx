<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cConsultationCategory {

  var $Cat_Id;
  var $Cat_Order;
  var $Status_Id;
  var $Cat_Name;
  var $Cat_Desc;

  public static function getArray($vCond) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `cat_id`, `cat_order`, `status_id`, `cat_name`, `cat_desc`'
            . ' FROM `cpy_consultation_category`'
            . ' WHERE (`status_id`=1)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `cat_order`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cConsultationCategory::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cConsultationCategory();
    $sSQL = 'SELECT `cat_id`, `cat_order`, `status_id`, `cat_name`, `cat_desc`'
            . ' FROM `cpy_consultation_category`'
            . ' WHERE (`cat_id`="' . $nId . '")';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cConsultationCategory::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cConsultationCategory();
    $cClass->Cat_Id = $res->fields("cat_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Cat_Order = $res->fields("cat_order");
    $cClass->Cat_Name = $res->fields("cat_name");
    $cClass->Cat_Desc = $res->fields("cat_desc");
    return $cClass;
  }

}
