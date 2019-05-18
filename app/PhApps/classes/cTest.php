<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cTest {

  var $NTest_Id = 0;
  var $Test_Id = 0;
  var $Lang_Id = 2;
  var $Status_Id = 1;
  var $Test_Num = 0;
  var $Test_IName = "";
  var $Test_Image = "";
  var $Test_Price = "0";
  var $Test_Name = "";
  var $aEvaluates = array();
  var $aQuestions = array();

  public static function getArray($vCond = "", $full = true) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `test_id`, `status_id`, `test_num`, `test_iname`, `test_image`, `test_price`,'
            . ' `ntest_id`, `lang_id`, `test_name`, `test_desc`'
            . ' FROM `app_vtest`'
            . ' WHERE (`status_id`=1 And `test_id`!=0)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `test_num`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cTest::getFields($res, $full);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId, $full = true) {
    $cClass = new cTest();
    $sSQL = 'SELECT `test_id`, `status_id`, `test_num`, `test_iname`, `test_image`, `test_price`,'
            . ' `ntest_id`, `lang_id`, `test_name`, `test_desc`'
            . ' FROM `app_vtest`'
            . ' WHERE (`status_id`=1 And `test_id`!=0)';
    if ($nId != "") {
      $sSQL .= ' AND (`test_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cTest::getFields($res, $full);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res, $full = true) {
    $cClass = new cTest();
    $cClass->NTest_Id = $res->fields("ntest_id");
    $cClass->Test_Id = $res->fields("test_id");
    $cClass->Lang_Id = $res->fields("lang_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Test_Num = $res->fields("test_num");
    $cClass->Test_IName = $res->fields("test_iname");
    $cClass->Test_Image = $res->fields("test_image");
    $cClass->Test_Name = $res->fields("test_name");
    $cClass->Test_Desc = $res->fields("test_desc");
    $cClass->Test_Price = $res->fields("test_price");
    if ($full) {
      $cClass->aEvaluates = cTestEvaluate::getArray('`test_id`=' . $cClass->Test_Id . ' AND `lang_id`=' . $cClass->Lang_Id);
      $cClass->aQuestions = cTestQuestion::getArray('`test_id`=' . $cClass->Test_Id . ' AND `lang_id`=' . $cClass->Lang_Id);
    }
    return $cClass;
  }

}
