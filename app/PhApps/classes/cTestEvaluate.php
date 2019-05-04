<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cTestEvaluate {

  var $Eval_Id = 0;
  var $NTest_Id = 0;
  var $Test_Id = 0;
  var $Lang_Id = 2;
  var $Gend_Id = 0;
  var $Status_Id = 1;
  var $Test_Num = 0;
  var $Test_IName = "";
  var $Test_Image = "";
  var $Test_Price = "0";
  var $Test_Name = "";
  var $Eval_From = "";
  var $Eval_To = "";
  var $Eval_Text = "";

  public static function getArray($vCond = "") {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `test_id`, `status_id`, `test_num`, `test_iname`, `test_image`, `test_price`,'
            . ' `ntest_id`, `lang_id`, `test_name`, `test_desc`, `gend_id`, `eval_id`, `eval_from`, `eval_to`, `eval_text`'
            . ' FROM `app_vtest_evaluate`'
            . ' WHERE (`status_id`=1 And `test_id`!=0 AND )';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `test_num`, `gend_id`, `eval_from`, `eval_to`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cTestEvaluate::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cTestEvaluate();
    $sSQL = 'SELECT `test_id`, `status_id`, `test_num`, `test_iname`, `test_image`, `test_price`,'
            . ' `ntest_id`, `lang_id`, `test_name`, `test_desc`, `gend_id`, `eval_id`, `eval_from`, `eval_to`, `eval_text`'
            . ' FROM `app_vtest_evaluate`'
            . ' WHERE (`status_id`=1 And `test_id`!=0 AND )';
    if ($nId != "") {
      $sSQL .= ' AND (`eval_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cTestEvaluate::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cTestEvaluate();
    $cClass->Eval_Id = $res->fields("eval_id");
    $cClass->NTest_Id = $res->fields("ntest_id");
    $cClass->Test_Id = $res->fields("test_id");
    $cClass->Lang_Id = $res->fields("lang_id");
    $cClass->Gend_Id = $res->fields("gend_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Test_Num = $res->fields("test_num");
    $cClass->Test_IName = $res->fields("test_iname");
    $cClass->Test_Image = $res->fields("test_image");
    $cClass->Test_Name = $res->fields("test_name");
    $cClass->Test_Desc = $res->fields("test_desc");
    $cClass->Test_Price = $res->fields("test_price");
    $cClass->Eval_From = $res->fields("eval_from");
    $cClass->Eval_To = $res->fields("eval_to");
    $cClass->Eval_Text = $res->fields("eval_text");
    return $cClass;
  }

}
