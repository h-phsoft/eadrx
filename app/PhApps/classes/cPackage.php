<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cPackage {

  var $Pkg_Id = 0;
  var $Cycle_Id = 0;
  var $Status_Id = 1;
  var $Pkg_Order = 0;
  var $Pkg_Name = "";
  var $Pkg_Price = 0;
  var $aCats = array();

  public static function getArray($vCond = "", $full = true) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `pkg_id`, `cycle_id`, `status_id`, `pkg_order`, `pkg_name`, `pkg_price`'
            . ' FROM `app_tips_package`'
            . ' WHERE (`status_id`=1)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `pkg_order`, `pkg_name`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cPackage::getFields($res, $full);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId, $full = true) {
    $cClass = new cPackage();
    $sSQL = 'SELECT `pkg_id`, `cycle_id`, `status_id`, `pkg_order`, `pkg_name`, `pkg_price`'
            . ' FROM `app_tips_package`'
            . ' WHERE (`status_id`=1)';
    if ($nId != "") {
      $sSQL .= ' AND (`pkg_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPackage::getFields($res, $full);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res, $full = true) {
    $cClass = new cPackage();
    $cClass->Pkg_Id = $res->fields("pkg_id");
    $cClass->Cycle_Id = $res->fields("cycle_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Pkg_Order = $res->fields("pkg_order");
    $cClass->Pkg_Name = $res->fields("pkg_name");
    $cClass->Pkg_Price = $res->fields("pkg_price");
    if ($full) {
      $cClass->aCats = cPackageCategory::getArray('`pkg_id`=' . $cClass->Pkg_Id);
    }
    return $cClass;
  }

}
