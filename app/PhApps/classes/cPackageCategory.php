<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cPackageCategory {

  var $TPkg_Id = 0;
  var $Pkg_Id = 0;
  var $Cycle_Id = 0;
  var $Cycle_Name = "";
  var $Cycle_Desc = "";
  var $Status_Id = 1;
  var $Pkg_Order = 0;
  var $Pkg_Name = "";
  var $Pkg_Price = 0;
  var $TCat_Id = "";
  var $TCat_Name = "";

  public static function getArray($vCond = "") {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `tpkg_id`, `pkg_id`, `status_id`, `pkg_name`, `pkg_price`, '
            . ' `cycle_id`, `cycle_name`, `cycle_desc`, '
            . ' `tcat_id`, `tcat_name`'
            . ' FROM `app_vtips_package`'
            . ' WHERE (`status_id`=1)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `pkg_name`, `tcat_id`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cPackageCategory::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cPackageCategory();
    $sSQL = 'SELECT `tpkg_id`, `pkg_id`, `status_id`, `pkg_name`, `pkg_price`,'
            . ' `cycle_id`, `cycle_name`, `cycle_desc`, '
            . ' `tcat_id`, `tcat_name`'
            . ' FROM `app_vtips_package`'
            . ' WHERE (`status_id`=1)';
    if ($nId != "") {
      $sSQL .= ' AND (`tpkg_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPackageCategory::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cPackageCategory();
    $cClass->TPkg_Id = $res->fields("tpkg_id");
    $cClass->Pkg_Id = $res->fields("pkg_id");
    $cClass->Cycle_Id = $res->fields("cycle_id");
    $cClass->Cycle_Name = $res->fields("cycle_name");
    $cClass->Cycle_Desc = $res->fields("cycle_desc");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Pkg_Name = $res->fields("pkg_name");
    $cClass->Pkg_Price = $res->fields("pkg_price");
    $cClass->TCat_Id = $res->fields("tcat_id");
    $cClass->TCat_Name = $res->fields("tcat_name");
    return $cClass;
  }

}
