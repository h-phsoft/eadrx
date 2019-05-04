<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cTestQuestion {

  var $Qstn_Id = 0;
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
  var $Qstn_Num = 0;
  var $Qstn_Text = "";
  var $Qstn_Answer1 = "";
  var $Qstn_Reply1 = "";
  var $Qstn_Value1 = "";
  var $Qstn_Answer2 = "";
  var $Qstn_Reply2 = "";
  var $Qstn_Value2 = "";
  var $Qstn_Answer3 = "";
  var $Qstn_Reply3 = "";
  var $Qstn_Value3 = "";
  var $Qstn_Answer4 = "";
  var $Qstn_Reply4 = "";
  var $Qstn_Value4 = "";

  public static function getArray($vCond = "") {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `test_id`, `status_id`, `test_num`, `test_iname`, `test_image`, `test_price`,'
            . ' `ntest_id`, `lang_id`, `test_name`, `test_desc`, `gend_id`, `qstn_id`, `qstn_num`,'
            . ' `qstn_text`,'
            . ' `qstn_ansr1`, `qstn_rep1`, `qstn_val1`, `qstn_ansr2`, `qstn_rep2`, `qstn_val2`, '
            . ' `qstn_ansr3`, `qstn_rep3`, `qstn_val3`, `qstn_ansr4`, `qstn_rep4`, `qstn_val4` '
            . ' FROM `app_vtest_question`'
            . ' WHERE (`status_id`=1 And `test_id`!=0 AND )';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `test_num`, `gend_id`, `qstn_num`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cTestQuestion::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cTestQuestion();
    $sSQL = 'SELECT `test_id`, `status_id`, `test_num`, `test_iname`, `test_image`, `test_price`,'
            . ' `ntest_id`, `lang_id`, `test_name`, `test_desc`, `gend_id`, `qstn_id`, `qstn_num`,'
            . ' `qstn_text`,'
            . ' `qstn_ansr1`, `qstn_rep1`, `qstn_val1`, '
            . ' `qstn_ansr2`, `qstn_rep2`, `qstn_val2`, '
            . ' `qstn_ansr3`, `qstn_rep3`, `qstn_val3`, '
            . ' `qstn_ansr4`, `qstn_rep4`, `qstn_val4` '
            . ' FROM `app_vtest_question`'
            . ' WHERE (`status_id`=1 And `test_id`!=0 AND )';
    if ($nId != "") {
      $sSQL .= ' AND (`qstn_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cTestQuestion::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cTestQuestion();
    $cClass->Qstn_Id = $res->fields("qstn_id");
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
    $cClass->Qstn_Num = $res->fields("qstn_num");
    $cClass->Qstn_Text = $res->fields("qstn_text");
    $cClass->Qstn_Answer1 = $res->fields("qstn_ansr1");
    $cClass->Qstn_Reply1 = $res->fields("qstn_rep1");
    $cClass->Qstn_Value1 = $res->fields("qstn_val1");
    $cClass->Qstn_Answer2 = $res->fields("qstn_ansr2");
    $cClass->Qstn_Reply2 = $res->fields("qstn_rep2");
    $cClass->Qstn_Value2 = $res->fields("qstn_val2");
    $cClass->Qstn_Answer3 = $res->fields("qstn_ansr3");
    $cClass->Qstn_Reply3 = $res->fields("qstn_rep3");
    $cClass->Qstn_Value3 = $res->fields("qstn_val3");
    $cClass->Qstn_Answer4 = $res->fields("qstn_ansr4");
    $cClass->Qstn_Reply4 = $res->fields("qstn_rep4");
    $cClass->Qstn_Value4 = $res->fields("qstn_val4");
    return $cClass;
  }

}
