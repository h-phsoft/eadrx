<?php

if ($nId != 0) {
  $pkg = cPackage::getInstance($nId, false);
  $vCucleInterval = ph_GetDBValue('`cycle_interval`', '`phs_bill_cycle`', '`cycle_id`=' . $pkg->Cycle_Id);
  $sSQL = 'INSERT INTO `app_subscribe`'
          . '(`serv_id`   , `user_id`   , `cycle_id`, `pkg_id`   ,'
          . ' `subs_start`, `subs_end`  ,'
          . ' `subs_qnt`  , `subs_price`, `subs_amt`'
          . ')  VALUES ('
          . ' 2, ' . $nUserId . ', ' . $pkg->Cycle_Id . ', ' . $nId . ','
          . ' NOW(), Date_Add(NOW(), INTERVAL ' . $vCucleInterval . '),'
          . ' 1, ' . $pkg->Pkg_Price . ', ' . $pkg->Pkg_Price . ' )';
  ph_Execute($sSQL);
  $nSubsId = ph_InsertedId();
  foreach ($pkg->aCats as $cat) {
    $sSQL = 'INSERT INTO `app_subscribe_cats`'
            . '(`sub_id`, `tpkg_id`, `tcat_id`)'
            . ' VALUES '
            . '(' . $nSubsId . ', ' . $cat->TPkg_Id . ', ' . $cat->TCat_Id . ')';
    ph_Execute($sSQL);
  }
}
//header("Location: " . $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Menu-Tips'));
?>
