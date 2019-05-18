<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2018 PhSoft.
 */
class cPage {

  var $Page_Id;
  var $Page_Name;
  var $Status_Id;
  var $Slid_Id;
  var $Page_SText;
  var $Page_Desc;
  var $Slider;
  var $aRows = array();

  public static function getArray($vCond) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `page_id`, `page_name`, `status_id`, `slid_id`, `page_stext`, `page_desc`'
            . ' FROM `cpy_page`'
            . ' WHERE (`status_id`=1)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `page_id`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cPage::getFields($res, true);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cPage();
    $sSQL = 'SELECT `page_id`, `page_name`, `status_id`, `slid_id`, `page_stext`, `page_desc`'
            . ' FROM `cpy_page`'
            . ' WHERE (`page_id`="' . $nId . '")';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPage::getFields($res, true);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res, $full = true) {
    $cClass = new cPage();
    $cClass->Page_Id = $res->fields("page_id");
    $cClass->Slid_Id = $res->fields("slid_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Page_Name = $res->fields("page_name");
    $cClass->Page_SText = $res->fields("page_stext");
    $cClass->Page_Desc = $res->fields("page_desc");
    if ($full) {
      $cClass->Slider = cSlider::getInstanceById($cClass->Slid_Id);
      $cClass->aRows = cPageRow::getArray($cClass->Page_Id);
    }
    return $cClass;
  }

}
