<?php

if ($nId != 0) {
  $nCount = ph_GetDBValue('count(*)', '`app_subscribe`', '`user_id`=' . $nUserId . ' AND `serv_id`=1 AND `book_id`=' . $nId);
  if ($nCount <= 0) {
    $book = cBook::getInstance($nId, false);
    $sSQL = 'INSERT INTO `app_subscribe`'
            . '(`serv_id`   , `user_id`   , `cycle_id`  , `book_id`   ,'
            . ' `subs_start`, `subs_end`  ,'
            . ' `subs_qnt`  , `subs_price`, `subs_amt`'
            . ')  VALUES ('
            . ' 1, ' . $nUserId . ', 1, ' . $nId . ','
            . ' NOW(), "2099/12/31 23:59",'
            . ' 1, ' . $book->Book_Price . ', ' . $book->Book_Price . ' )';
    ph_Execute($sSQL);
  }
}
header("Location: " . $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Menu-Book') . '/' . $nId);
?>
