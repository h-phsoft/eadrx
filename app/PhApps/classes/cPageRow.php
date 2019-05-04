<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2018 PhSoft.
 */
class cPageRow {

  var $Row_Id;
  var $Page_Id;
  var $Lang_Id;
  var $Status_Id;
  var $Color_Id;
  var $Row_Order;
  var $Row_Name;
  var $Row_SText;
  var $aBlocks = array();

  public static function getArray($nPageId) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `row_id`, `page_id`, `lang_id`, `status_id`, `color_id`, `row_order`, `row_name`, `row_stext`'
            . ' FROM `cpy_page_row`'
            . ' WHERE (`status_id`=1)';
    if ($nPageId != "") {
      $sSQL .= ' AND (`page_id`="' . $nPageId . '")';
    }
    $sSQL .= ' ORDER BY `row_order`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cPageRow::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cPage();
    $sSQL = 'SELECT `row_id`, `page_id`, `lang_id`, `status_id`, `color_id`, `row_order`, `row_name`, `row_stext`'
            . ' FROM `cpy_page_row`'
            . ' WHERE (`row_id`="' . $nId . '")';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPageRow::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cPageRow();
    $cClass->Row_Id = $res->fields("row_id");
    $cClass->Page_Id = $res->fields("page_id");
    $cClass->Lang_Id = $res->fields("lang_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Color_Id = $res->fields("color_id");
    $cClass->Row_Order = $res->fields("row_order");
    $cClass->Row_Name = $res->fields("row_name");
    $cClass->Row_Stext = $res->fields("row_stext");
    $cClass->aBlocks = cPageRowBlock::getArray("row_id='" . $cClass->Row_Id . "'");
    return $cClass;
  }

}
