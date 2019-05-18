<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cPageRowBlock {

  var $Blk_Id;
  var $Row_Id;
  var $Slid_Id;
  var $Video_Id;
  var $Status;
  var $Cols_Id;
  var $Blk_Order;
  var $Blk_Name;
  var $Blk_Header;
  var $Blk_Image;
  var $Blk_Text;
  var $Blk_SText;

  public static function getArray($vCond) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `blk_id`, `row_id`, `type_id`, `slid_id`, `video_id`, `status_id`, `cols_id`, `blk_order`, `blk_name`, `blk_header`, `blk_image`, `blk_text`, `blk_stext`'
            . ' FROM `cpy_page_row_block`'
            . ' WHERE (`status_id`=1)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `blk_order`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cPageRowBlock::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cPageRowBlock();
    $sSQL = 'SELECT `blk_id`, `row_id`, `type_id`, `slid_id`, `video_id`, `status_id`, `cols_id`, `blk_order`, `blk_name`, `blk_header`, `blk_image`, `blk_text`, `blk_stext`'
            . ' FROM `cpy_page_row_block`'
            . ' WHERE (`blk_id`="' . $nId . '")';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPageRowBlock::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cPageRowBlock();
    $cClass->Blk_Id = $res->fields("blk_id");
    $cClass->Row_Id = $res->fields("row_id");
    $cClass->Type_Id = $res->fields("type_id");
    $cClass->Slid_Id = $res->fields("slid_id");
    $cClass->Video_Id = $res->fields("video_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Cols_Id = $res->fields("cols_id");
    $cClass->Blk_Order = $res->fields("blk_order");
    $cClass->Blk_Name = $res->fields("blk_name");
    $cClass->Blk_Header = $res->fields("blk_header");
    $cClass->Blk_Image = $res->fields("blk_image");
    $cClass->Blk_Text = $res->fields("blk_text");
    $cClass->Blk_SText = $res->fields("blk_stext");
    return $cClass;
  }

}
