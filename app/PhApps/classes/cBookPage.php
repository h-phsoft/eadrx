<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cBookPage {

  var $BPage_Id = 0;
  var $Book_Id = 0;
  var $Page_Num = 0;
  var $Page_Image = "";
  var $Page_Text = "0";

  public static function getArray($vCond) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`'
            . ' FROM `app_book_page`';
    if ($vCond != "") {
      $sSQL .= ' WHERE (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `page_num`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cBookPage::getFields($res, $full);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cBookPage();
    $sSQL = 'SELECT `bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`'
            . ' FROM `app_book_page`';
    if ($nId != "") {
      $sSQL .= ' AND (`bpage_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cBookPage::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cBookPage();
    $cClass->BPage_Id = $res->fields("bpage_id");
    $cClass->Book_Id = $res->fields("book_id");
    $cClass->Page_Num = $res->fields("page_num");
    $cClass->Page_Image = $res->fields("page_image");
    $cClass->Page_Text = $res->fields("page_text");
    return $cClass;
  }

}
