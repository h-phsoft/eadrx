<?php

header("Access-Control-Allow-Origin: *");
?>
<?php

/**
 * (C) 2000-2018 PhSoft.
 */
class cSlider {

  var $Slid_Id = -999;
  var $Slid_Name;
  var $Slid_Rem;
  var $SType_Id = 1;
  var $SCols_Id = 1;
  var $aSlides = array();

  public static function getArray($vWhere = '') {
    $aArray = array();
    $nIdx = 0;
    $sSQL = 'SELECT `slid_id`, `slid_name`, `slid_rem`, `stype_id`, `scols_id`'
            . ' FROM `cpy_slider_mst`';
    if ($vWhere != "") {
      $sSQL .= ' WHERE (' . $vWhere . ')';
    }
    $sSQL .= ' ORDER BY `slid_name`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cSlider::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstanceByName($vName) {
    $cClass = new cSlider();
    $sSQL = 'SELECT `slid_id`, `slid_name`, `slid_rem`, `stype_id`, `scols_id`'
            . ' FROM `cpy_slider_mst`'
            . ' WHERE (UPPER(`slid_name`)=UPPER("' . $vName . '"))';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cSlider::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getInstanceById($nId) {
    $cClass = new cSlider();
    $sSQL = 'SELECT `slid_id`, `slid_name`, `slid_rem`, `stype_id`, `scols_id`'
            . ' FROM `cpy_slider_mst`'
            . ' WHERE (`slid_id`="' . $nId . '")';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cSlider::getFields($res);
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cSlider();
    $cClass->Slid_Id = $res->fields("slid_id");
    $cClass->SType_Id = $res->fields("stype_id");
    $cClass->SCols_Id = $res->fields("scols_id");
    $cClass->Slid_Name = $res->fields("slid_name");
    $cClass->Slid_Rem = $res->fields("slid_rem");
    $cClass->aSlides = cSlide::getArray($cClass->Slid_Id);
    return $cClass;
  }

  public static function renderOWLSlider($cSlider, $vId, $nLang = 2) {
    $vSlider = chr(13);
    $vSlider .= '<div id="' . $vId . '" class="owl-carousel owl-carousel' . $cSlider->SCols_Id . '">' . chr(13);
    foreach ($cSlider->aSlides as $slide) {
      $vSlider .= '  <div class="recent-work-item">' . chr(13);
      $vSlider .= '    <em>' . chr(13);
      $vSlider .= '      <img src="assets/pages/img/works/' . $slide->Slid_Photo . '" alt="' . $slide->Slid_Header . '" class="img-responsive">' . chr(13);
      if ($slide->Slid_Link != '') {
        $vSlider .= '      <a href="?l=' . $nLang . '&' . $slide->Slid_Link . '"><i class="fa fa-link"></i></a>' . chr(13);
      } else {
        $vSlider .= '      <a href="?l=' . $nLang . '"><i class="fa fa-link"></i></a>' . chr(13);
      }
      $vSlider .= '      <a href="assets/pages/img/works/' . $slide->Slid_Photo . '" class="fancybox-button" title="' . $slide->Slid_Header . '" data-rel="fancybox-button"><i class="fa fa-search"></i></a>' . chr(13);
      $vSlider .= '    </em>' . chr(13);
      $vSlider .= '    <a class="recent-work-description" href="javascript:;">' . chr(13);
      $vSlider .= '      <strong>' . $slide->Slid_Header . '</strong>' . chr(13);
      $vSlider .= '      <b>' . $slide->Slid_Text . '</b>' . chr(13);
      $vSlider .= '    </a>' . chr(13);
      $vSlider .= '  </div>' . chr(13);
    }
    $vSlider .= '</div>' . chr(13);
    return $vSlider;
  }

  public static function renderSlider($cSlider, $vId) {
    $vSlider = chr(13);
    $vSlider .= '<div id="' . $vId . '" class="carousel slide carousel-slider">' . chr(13);
    $vSlider .= '  <ol class="carousel-indicators carousel-indicators-frontend">' . chr(13);
    $vActive0 = "class='active'";
    $nIdx = 0;
    foreach ($cSlider->aSlides as $slide) {
      $vSlider .= '    <li data-target="#' . $vId . '" data-slide-to="' . $nIdx . '" ' . $vActive0 . '></li>' . chr(13);
      $nIdx++;
      $vActive0 = "";
    }
    $vSlider .= '  </ol>' . chr(13);
    $vSlider .= '  <div class="carousel-inner" role="listbox">' . chr(13);
    $vActive1 = "active";
    foreach ($cSlider->aSlides as $slide) {
      $vSlider .= '    <div class="item ' . $vActive1 . '" style="background: url(assets/pages/img/frontend-slider/' . $slide->Slid_Photo . '); background-size: cover !important; background-position: center center !important;">' . chr(13);
      $vSlider .= '      <div class="container">' . chr(13);
      $vSlider .= '        <div class="carousel-position-six text-uppercase text-center">' . chr(13);
      if ($slide->Slid_Header != '') {
        $vSlider .= '          <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">' . $slide->Slid_Header . '</h2>' . chr(13);
      }
      if ($slide->Slid_Text != '') {
        $vSlider .= '          <p class="carousel-subtitle-v5 margin-bottom-30" data-animation="animated fadeInDown">' . $slide->Slid_Text . '</p>' . chr(13);
      }
      if ($slide->Slid_Link != '') {
        $vSlider .= '          <a class="carousel-btn-green" href="' . $slide->Slid_Link . '" data-animation="animated fadeInUp">' . $slide->Slid_Label . '</a>' . chr(13);
      }
      $vSlider .= '        </div>' . chr(13);
      $vSlider .= '      </div>' . chr(13);
      $vSlider .= '    </div>' . chr(13);
      $vActive1 = "";
    }
    $vSlider .= '  </div>' . chr(13);
    $vSlider .= '  <a class="left carousel-control carousel-control-shop carousel-control-frontend" href="#' . $vId . '" role="button" data-slide="prev">' . chr(13);
    $vSlider .= '    <i class="fa fa-angle-left" aria-hidden="true"></i>' . chr(13);
    $vSlider .= '  </a>' . chr(13);
    $vSlider .= '  <a class="right carousel-control carousel-control-shop carousel-control-frontend" href="#' . $vId . '" role="button" data-slide="next">' . chr(13);
    $vSlider .= '    <i class="fa fa-angle-right" aria-hidden="true"></i>' . chr(13);
    $vSlider .= '  </a>' . chr(13);
    $vSlider .= '</div>' . chr(13);
    return $vSlider;
  }

}
