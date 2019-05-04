<?php

header('Access-Control-Allow-Origin: *');
?>
<?php

/**
 * (C) 2000-2019 PhSoft.
 */
class cMenu {

  var $Menu_Id = 0;
  var $Menu_PId = 0;
  var $Type_Id = 1;
  var $Status_Id = 1;
  var $Page_Id = 0;
  var $Test_Id = 0;
  var $Menu_Order = 0;
  var $Menu_Name = "";
  var $Menu_Icon = "";
  var $Menu_URL = "#";
  var $Menu_Target = "#";
  var $Menu_Page = "";
  var $aSubs = array();

  public static function getArray($nPId, $full = true, $ascDec = '') {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `menu_id`, `menu_pid`, `type_id`, `status_id`, `page_id`, `test_id`, `menu_order`, `menu_name`,'
            . ' `menu_icon`, `menu_href`, `menu_target`, `menu_page`'
            . ' FROM `phs_menu`'
            . ' WHERE (`status_id`=1 And `menu_id`!=0)';
    if ($nPId != "") {
      $sSQL .= ' AND (`menu_pid`=' . $nPId . ')';
    }
    $sSQL .= ' ORDER BY `menu_order` ' . $ascDec;
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cMenu::getFields($res, $full);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId, $full = true, $ascDec = '') {
    $cClass = new cMenu();
    $sSQL = 'SELECT `menu_id`, `menu_pid`, `type_id`, `status_id`, `page_id`, `test_id`, `menu_order`, `menu_name`,'
            . ' `menu_icon`, `menu_href`, `menu_target`, `menu_page`'
            . ' FROM `phs_menu`'
            . ' WHERE (`menu_id`="' . $nId . '")';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cMenu::getFields($res, $full, $ascDec);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res, $full = true, $ascDec = '') {
    $cClass = new cMenu();
    $cClass->Menu_Id = $res->fields("menu_id");
    $cClass->Menu_PId = $res->fields("menu_pid");
    $cClass->Type_Id = $res->fields("type_id");
    $cClass->Status_Id = $res->fields("status_id");
    $cClass->Page_Id = $res->fields("page_id");
    $cClass->Test_Id = $res->fields("test_id");
    $cClass->Menu_Order = $res->fields("menu_order");
    $cClass->Menu_Name = $res->fields("menu_name");
    $cClass->Menu_Icon = $res->fields("menu_icon");
    $cClass->Menu_URL = $res->fields("menu_href");
    $cClass->Menu_Target = $res->fields("menu_target");
    $cClass->Menu_Page = $res->fields("menu_page");
    if ($full) {
      $cClass->aSubs = cMenu::getArray($cClass->Menu_Id, $full, $ascDec);
    }
    return $cClass;
  }

  public static function renderMenu($nId, $nLang, $nMode, $full = true, $ascDec = '') {
    $rMenu = cMenu::getInstance($nId, $full, $ascDec);
    $vMenu = chr(13);
    foreach ($rMenu->aSubs as $menu) {
      $menuRef = "?l=" . $nLang . "&m=" . $menu->Menu_Id;
      if ($menu->Menu_URL != '') {
        $menuRef = $menu->Menu_URL;
      }
      $menuTarget = '';
      if ($menu->Menu_URL != '' && $menu->Menu_Target != '') {
        $menuTarget = 'target="' . $menu->Menu_Target . '"';
      }
      $menuIcon = ' ';
      if ($menu->Menu_Icon != '') {
        $menuIcon = "<i class='" . $menu->Menu_Icon . "'></i>";
      }
      $vActive = '';
      if ($nMode == $menu->Menu_Id) {
        $vActive = 'active';
      }
      if ($menu->Type_Id == 10) {
        $vMenu .= '<li class="' . $vActive . '">' . chr(13);
        $vMenu .= '  <a href="' . $menuRef . '" ' . $menuTarget . '>' . trim($menuIcon . '&nbsp;&nbsp;' . ph_DBKey($menu->Menu_Name, $nLang)) . '</a>' . chr(13);
        $vMenu .= '</li>' . chr(13);
      } elseif ($menu->Type_Id == 11) {
        $vMenu .= '<li class="dropdown dropdown-megamenu">' . chr(13);
        $vMenu .= '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">' . chr(13);
        $vMenu .= trim($menuIcon . '&nbsp;&nbsp;' . ph_DBKey($menu->Menu_Name, $nLang)) . chr(13);
        $vMenu .= '</a>' . chr(13);
        $vMenu .= '<ul class="dropdown-menu">' . chr(13);
        $vMenu .= '  <li>' . chr(13);
        $vMenu .= '    <div class="header-navigation-content">' . chr(13);
        $vMenu .= '      <div class="row">' . chr(13);
        foreach ($menu->aSubs as $sub) {
          $subRef = "?l=" . $nLang . "&m=" . $sub->Menu_Id;
          if ($sub->Menu_URL != '') {
            $subRef = $sub->Menu_URL;
          }
          $subIcon = ' ';
          if ($sub->Menu_Icon != '') {
            $subIcon = "<i class='" . $sub->Menu_Icon . "'></i>";
          }
          if (count($sub->aSubs) > 0) {
            $vMenu .= '        <div class="col-md-4 header-navigation-col">' . chr(13);
            $vMenu .= '          <h4>' . trim($subIcon . '&nbsp;&nbsp;' . ph_DBKey($sub->Menu_Name, $nLang)) . '</h4>' . chr(13);
            $vMenu .= '          <ul>' . chr(13);
            foreach ($sub->aSubs as $ssub) {
              $ssubRef = "?l=" . $nLang . "&m=" . $ssub->Menu_Id;
              if ($ssub->Menu_URL != '') {
                $ssubRef = $ssub->Menu_URL;
              }
              $menuTarget = '';
              if ($ssub->Menu_URL != '' && $ssub->Menu_Target != '') {
                $menuTarget = 'target="' . $ssub->Menu_Target . '"';
              }
              $ssubIcon = ' ';
              if ($ssub->Menu_Icon != '') {
                $ssubIcon = "<i class='" . $ssub->Menu_Icon . "'></i>";
              }
              $vMenu .= '            <li><a href="' . $ssubRef . '" ' . $menuTarget . '>' . trim($ssubIcon . '&nbsp;&nbsp;' . ph_DBKey($ssub->Menu_Name, $nLang)) . '</a></li>' . chr(13);
            }
            $vMenu .= '          </ul>' . chr(13);
            $vMenu .= '        </div>' . chr(13);
          } else {
            $menuTarget = '';
            if ($sub->Menu_URL != '' && $sub->Menu_Target != '') {
              $menuTarget = 'target="' . $sub->Menu_Target . '"';
            }
            $vMenu .= '          <li><a href="' . $subRef . '" ' . $menuTarget . '><' . trim($subIcon . '&nbsp;&nbsp;' . ph_DBKey($sub->Menu_Name, $nLang)) . '</a></li>' . chr(13);
          }
        }
        $vMenu .= '        </div>' . chr(13);
        $vMenu .= '      </div>' . chr(13);
        $vMenu .= '    </li>' . chr(13);
        $vMenu .= '  </ul>' . chr(13);
        $vMenu .= '</li>' . chr(13);
      } elseif (count($menu->aSubs) > 0) {
        $vMenu .= '<li class="dropdown">' . chr(13);
        $vMenu .= '  <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">' . chr(13);
        $vMenu .= '    ' . ph_DBKey($menu->Menu_Name, $nLang) . chr(13);
        $vMenu .= '  </a>' . chr(13);
        $vMenu .= '  <ul class="dropdown-menu">' . chr(13);
        foreach ($menu->aSubs as $sub) {
          $subRef = "?l=" . $nLang . "&m=" . $sub->Menu_Id;
          if ($sub->Menu_URL != '') {
            $subRef = $sub->Menu_URL;
          }
          $subIcon = ' ';
          if ($sub->Menu_Icon != '') {
            $subIcon = "<i class='" . $sub->Menu_Icon . "'></i>";
          }
          if (count($sub->aSubs) > 0) {
            $vMenu .= '    <li class="dropdown-submenu">' . chr(13);
            $vMenu .= '      <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">' . trim($subIcon . '&nbsp;&nbsp;' . ph_DBKey($sub->Menu_Name, $nLang)) . '<i class="fa fa-angle-right"></i></a>' . chr(13);
            $vMenu .= '        <ul class="dropdown-menu" role="menu">' . chr(13);
            foreach ($sub->aSubs as $ssub) {
              $ssubRef = "?l=" . $nLang . "&m=" . $ssub->Menu_Id;
              if ($ssub->Menu_URL != '') {
                $ssubRef = $ssub->Menu_URL;
              }
              $menuTarget = '';
              if ($ssub->Menu_URL != '' && $ssub->Menu_Target != '') {
                $menuTarget = 'target="' . $ssub->Menu_Target . '"';
              }
              $ssubIcon = ' ';
              if ($ssub->Menu_Icon != '') {
                $ssubIcon = "<i class='" . $ssub->Menu_Icon . "'></i>";
              }
              $vMenu .= '          <li><a href="' . $ssubRef . '" ' . $menuTarget . '>' . trim($ssubIcon . '&nbsp;&nbsp;' . ph_DBKey($ssub->Menu_Name, $nLang)) . '</a></li>' . chr(13);
            }
            $vMenu .= '        </ul>' . chr(13);
            $vMenu .= '      </li>' . chr(13);
          } else {
            $menuTarget = '';
            if ($sub->Menu_URL != '' && $sub->Menu_Target != '') {
              $menuTarget = 'target="' . $sub->Menu_Target . '"';
            }
            $vMenu .= '      <li><a href="' . $subRef . '" ' . $menuTarget . '>' . trim($subIcon . '&nbsp;&nbsp;' . ph_DBKey($sub->Menu_Name, $nLang)) . '</a></li>' . chr(13);
          }
        }
        $vMenu .= '  </ul>' . chr(13);
        $vMenu .= '</li>' . chr(13);
      }
    }
    return $vMenu;
  }

}
