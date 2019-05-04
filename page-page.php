<?php
$cPage = cPage::getInstance($nPage);
$nBlocks = count($cPage->aRows);
if ($cPage->Slider != '' && $cPage->Slid_Id != 0) {
  $vSlider = cSlider::renderSlider($cPage->Slider, $cPage->Slid_Id);
  echo '<div class="page-slider margin-bottom-40">' . chr(13);
  echo '  ' . $vSlider . chr(13);
  echo '</div>' . chr(13);
}
?>
<div class="main">
  <div class="container">
    <?php
    if ($nBlocks > 0) {
      $vBGColor = "";
      $vFGColor = "";
      foreach ($cPage->aRows as $pageRow) {
        if ($pageRow->Lang_Id == $nLang) {
          $vBGColor = "";
          $vFGColor = "";
          if ($pageRow->Color_Id != '0') {
            $vBColor = ph_GetDBValue("color_bcolor", "phs_color", "color_id='" . $pageRow->Color_Id . "'");
            if ($vBColor != '') {
              $vBGColor = 'background-color: ' . $vBColor . ';';
            }
            $vFColor = ph_GetDBValue("color_fcolor", "phs_color", "color_id='" . $pageRow->Color_Id . "'");
            if ($vFColor != '') {
              $vFGColor = 'color: ' . $vFColor . ';';
            }
          }
          ?>
          <section class="text-center container-fluid" style="margin-top: 25px; <?php echo $vBGColor; ?> <?php echo $vFGColor; ?>">
            <div class="row recent-work margin-bottom-20">
              <?php
              if (count($pageRow->aBlocks) > 0) {
                foreach ($pageRow->aBlocks as $cBlock) {
                  $nBlkType = $cBlock->Type_Id;
                  ?>
                  <div class='<?php echo ph_GetDBValue("cols_value", "phs_cols", "cols_id='" . $cBlock->Cols_Id . "'"); ?>' style="line-height: 2;">
                    <?php
                    if ($nBlkType == 1) {
                      // Text
                      if ($cBlock->Blk_Header != '') {
                        echo '<div>';
                        echo '<h4 class="block-header">' . $cBlock->Blk_Header . '</h4>' . chr(13);
                        echo '</div>';
                      }
                      echo '<div class="text-justify">';
                      echo $cBlock->Blk_Text . chr(13);
                      echo '</div>';
                    } elseif ($nBlkType == 2) {
                      // Slider
                      if ($pageRow->Slid_Id != '' && $pageRow->Slid_Id != 0) {
                        $cSlider = cSlider::getInstanceById($pageRow->Slid_Id);
                        $vSlider = cSlider::renderSlider($cSlider, $cSlider->Slid_Id, $curLang->Lang_Id);
                        echo $vSlider . chr(13);
                      }
                    } elseif ($nBlkType == 3) {
                      // OWL Slider
                      if ($cBlock->Slid_Id != '' && $cBlock->Slid_Id != 0) {
                        $cSlider = cSlider::getInstanceById($cBlock->Slid_Id);
                        $vSlider = cSlider::renderOWLSlider($cSlider, $cSlider->Slid_Id, $curLang->Lang_Id);
                        echo $vSlider . chr(13);
                      }
                    } elseif ($nBlkType == 4) {
                      // Image
                      if ($cBlock->Blk_Image) {
                        ?>
                        <img src="<?php echo $PH_BASE_PATH; ?>assets/pages/img/pageImages/<?php echo $cBlock->Blk_Image; ?>" style="width: 100%">
                        <?php
                      }
                    } elseif ($nBlkType == 5) {
                      // News
                      $latestActive = '';
                      $year1Active = '';
                      $year2Active = '';
                      $earlierActive = '';
                      $cYear = date("Y");
                      $aNews = cNews::getArray("YEAR(`news_date`)=" . $cYear);
                      $nCountNews = count($aNews);
                      if ($nCountNews > 0) {
                        $latestActive = 'active';
                      } else {
                        $aNews = cNews::getArray("YEAR(`news_date`)=" . ($cYear - 1));
                        $nCountNews = count($aNews);
                        if ($nCountNews > 0) {
                          $year1Active = 'active';
                        } else {
                          $aNews = cNews::getArray("YEAR(`news_date`)=" . ($cYear - 2));
                          $nCountNews = count($aNews);
                          if ($nCountNews > 0) {
                            $year2Active = 'active';
                          } else {
                            $aNews = cNews::getArray("YEAR(`news_date`) BETWEEN " . ($cYear - 5) . " AND " . ($cYear - 3));
                            $nCountNews = count($aNews);
                            if ($nCountNews > 0) {
                              $earlierActive = 'active';
                            }
                          }
                        }
                      }
                      if ($nCountNews > 0) {
                        ?>
                        <div class="row">
                          <div class="col-12 col-md-7 col-12 d-flex justify-content-end">
                            <h1 class="news-title">NEWS & ACTIVITIES</h1>
                          </div>
                          <div class="col-12 col-md-5 col-12 d-flex justify-content-end px-6">
                            <div class="d-flex align-items-center">
                              <div class="newsBtn d-inline p-1 btn btn-sm bg-news <?php echo $latestActive; ?> text-white mr-1" data-id="<?php echo $pageRow->Row_Id; ?>" data-syear="<?php echo $cYear; ?>" data-eyear="<?php echo $cYear; ?>">latest</div>
                              <div class="newsBtn d-inline p-1 btn btn-sm bg-news <?php echo $year1Active; ?> text-white mr-1" data-id="<?php echo $pageRow->Row_Id; ?>"  data-syear="<?php echo $cYear - 1; ?>" data-eyear="<?php echo $cYear - 1; ?>"><?php echo $cYear - 1; ?></div>
                              <div class="newsBtn d-inline p-1 btn btn-sm bg-news <?php echo $year2Active; ?> text-white mr-1" data-id="<?php echo $pageRow->Row_Id; ?>"  data-syear="<?php echo $cYear - 2; ?>" data-eyear="<?php echo $cYear - 2; ?>"><?php echo $cYear - 2; ?></div>
                              <div class="newsBtn d-inline p-1 btn btn-sm bg-news <?php echo $earlierActive; ?> text-white mr-1" data-id="<?php echo $pageRow->Row_Id; ?>"  data-syear="<?php echo $cYear - 5; ?>" data-eyear="<?php echo $cYear - 3; ?>">earlier</div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div id="logger"></div>
                          <div id="newsSlider<?php echo $pageRow->Row_Id; ?>" class="carousel slide w-100" style="min-height: 60vh;" data-ride="carousel">
                            <ol id="newsOL<?php echo $pageRow->Row_Id; ?>" class="carousel-indicators">
                              <?php
                              $vActive = "active";
                              for ($index1 = 0; $index1 < $nCountNews; $index1++) {
                                ?>
                                <li data-target="#newsSlider<?php echo $pageRow->Row_Id; ?>" data-slide-to="<?php echo $index1; ?>" class="<?php echo $vActive; ?>"></li>
                                <?php
                                $vActive = "";
                              }
                              ?>
                            </ol>
                            <div id="newsInner<?php echo $pageRow->Row_Id; ?>" class="carousel-inner w-100">
                              <?php
                              $vActive = "active";
                              foreach ($aNews as $news) {
                                ?>
                                <div class="carousel-item <?php echo $vActive; ?>">
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-12 col-md-6 p-5">
                                        <h5><?php echo $news->News_Title; ?></h5>
                                        <div class="text-justify" style="line-height: 2;">
                                          <?php echo $news->News_Text; ?>
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-6 p-5">
                                        <img class="newsimage" data-id="<?php echo $news->News_Id; ?>" style="width: 100%" src="<?php echo $PH_BASE_PATH; ?>assets/pages/img/newsImages/<?php echo $news->News_Image; ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $vActive = "";
                              }
                              ?>
                              <a class="carousel-control-prev" href="#newsSlider<?php echo $pageRow->Row_Id; ?>" role="button" data-slide="prev" style="width: 5% !important;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#newsSlider<?php echo $pageRow->Row_Id; ?>" role="button" data-slide="next" style="width: 5% !important;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                    } elseif ($nBlkType == 6) {
                      // Tips
                      ?>
                      <div class='quote-v1'>
                        <h5 class="qheader"><?php echo ph_DBKey('Tip of the day', $curLang->Lang_Id); ?></h5>
                        <div>
                          <span class="text-justify"><?php echo cp_getRandomTip($nLang); ?></span>
                        </div>
                      </div>
                      <?php
                    } elseif ($nBlkType == 7) {
                      // Video
                      if ($cBlock->Video_Id != 0) {
                        $vURL = ph_GetDBValue("video_url", "cpy_video", "video_id='" . $cBlock->Video_Id . "'");
                        if ($vURL != null && $vURL != '' && $vURL != '#') {
                          ?>
                          <video width="100%" controls autoplay>
                            <source src="<?php echo $vURL; ?>" type="video/mp4">
                          </video>
                          <?php
                        }
                      }
                    } elseif ($nBlkType == 8) {
                      // Key Value
                      ?>
                      <h4><?php echo ph_DBKey($cBlock->Blk_Header, $curLang->Lang_Id); ?></h4>
                      <?php
                    } elseif ($nBlkType == 9) {
                      // Key Text
                      ?>
                      <div class="<?php echo (strtoupper($curLang->Lang_Dir) == 'LTR' ? 'text-left' : 'text-right') ?>">
                        <?php echo ph_DBKeyText($cBlock->Blk_Header, $curLang->Lang_Id); ?>
                      </div>
                      <?php
                    } elseif ($nBlkType == 10) {
                      // Key Full
                      ?>
                      <h4><?php echo ph_DBKey($cBlock->Blk_Header, $curLang->Lang_Id); ?></h4>
                      <div class="<?php echo (strtoupper($curLang->Lang_Dir) == 'LTR' ? 'text-left' : 'text-right') ?>">
                        <?php echo ph_DBKeyText($cBlock->Blk_Header, $curLang->Lang_Id); ?>
                      </div>
                      <?php
                    } elseif ($nBlkType == 11) {
                      // Text With Image
                      if ($cBlock->Blk_Header != '') {
                        ?>
                        <div class="col-12">
                          <h4 class="block-header"><?php echo $cBlock->Blk_Header; ?></h4>
                        </div>
                        <?php
                      }
                      if ($cBlock->Blk_Image) {
                        ?>
                        <div class="col-12 col-sm-2">
                          <img src="<?php echo $PH_BASE_PATH; ?>assets/pages/img/pageImages/<?php echo $cBlock->Blk_Image; ?>" style="width: 100%">
                        </div>
                        <div class="col-12 col-sm-10 text-justify">
                          <?php echo $cBlock->Blk_Text; ?>
                        </div>
                        <?php
                      } else {
                        ?>
                        <div class="col-12 text-justify">
                          <?php echo $cBlock->Blk_Text; ?>
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <?php
                }
              }
              ?>
            </div>
          </section>
          <?php
        }
      }
    }
    ?>
  </div>
</div>
