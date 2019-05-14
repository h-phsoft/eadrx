<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cBook {

  var $Book_Id = 0;
  var $Lang_Id = 2;
  var $Status_Id = 1;
  var $Book_Title = "";
  var $Book_Desc = "";
  var $Book_Image = "";
  var $Book_Price = 0;
  var $aPages = array();

  public static function getArray($vCond = "", $full = true) {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `book_id`, `lang_id`, `status_id`, `book_title`, `book_desc`, `book_image`, `book_price`'
            . ' FROM `app_book`'
            . ' WHERE (`status_id`=1 And `book_id`!=0)';
    if ($vCond != "") {
      $sSQL .= ' AND (' . $vCond . ')';
    }
    $sSQL .= ' ORDER BY `ins_datetime` DESC';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cBook::getFields($res, $full);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId, $full = true) {
    $cClass = new cBook();
    $sSQL = 'SELECT `book_id`, `lang_id`, `status_id`, `book_title`, `book_desc`, `book_image`, `book_price`'
            . ' FROM `app_book`'
            . ' WHERE (`status_id`=1 And `book_id`!=0)';
    if ($nId != "") {
      $sSQL .= ' AND (`book_id`=' . $nId . ')';
    }
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cBook::getFields($res, $full);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res, $full = true) {
    $cClass = new cBook();
    $cClass->Book_Id = $res->fields("book_id");
    $cClass->Lang_Id = $res->fields("lang_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Book_Title = $res->fields("book_title");
    $cClass->Book_Desc = $res->fields("book_desc");
    $cClass->Book_Image = $res->fields("book_image");
    $cClass->Book_Price = $res->fields("book_price");
    if ($full) {
      $cClass->aPages = cBookPage::getArray('`book_id`=' . $cClass->Book_Id);
    }
    return $cClass;
  }

}
