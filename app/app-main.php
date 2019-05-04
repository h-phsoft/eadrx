<?php
if (ph_Setting('APP-DISP-FreeTips') == 1) {
  ?>
  <div class="row my-3">
    <div class="block col-12 col-sm-12">
      <div class="block-body text-center">
        <h5 class="block-title">Tip of the day</h5>
        <div class="block-text">You will die s o o o o o o o o o o o o o o o o o n n n n n n n n n n n n n n</div>
      </div>
    </div>
  </div>
  <?php
}
if (ph_Setting('APP-DISP-ADS') == 1) {
  $sSQL = 'SELECT ALL '
          . '`ads_id`  , `status_id`, `repeat_id`, `every_id` , `ads_title`,'
          . '`ads_desc`, `ads_text` , `ads_image`, `ads_sdate`, `ads_edate`,'
          . '`hour_sid`, `hour_eid` , `ins_datetime`'
          . ' FROM `cpy_ads`'
          . ' WHERE (`status_id`=1)'
          . ' ORDER BY `ads_id`';
  $res = ph_Execute($sSQL);
  if ($res != '') {
    $vId = 'mainSlider';
    ?>
    <div class="row my-3">
      <div class="block col-12 col-sm-12">
        <div class="block-body">
          <div id="<?php echo $vId; ?>" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php
              $vActive0 = "class='active'";
              $nIdx = 0;
              while (!$res->EOF) {
                ?>
                <li data-target="#<?php echo $vId; ?>" data-slide-to="<?php echo $nIdx; ?>" <?php echo $vActive0; ?>></li>
                <?php
                $nIdx++;
                $vActive0 = "";
                $res->MoveNext();
              }
              $res->MoveFirst();
              ?>
            </ol>
            <div class="carousel-inner">
              <?php
              $vActive1 = "active";
              while (!$res->EOF) {
                ?>
                <div class="carousel-item <?php echo $vActive1; ?>">
                  <img class="d-block w-100" src="<?php echo ph_Setting('Path-Ads-Images') . $res->fields("ads_image"); ?>" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <?php
                    /*
                      if ($res->fields("ads_title") != '') {
                      ?>
                      <h2><?php echo $res->fields("ads_title"); ?></h2>
                      <?php
                      }
                      if ($res->fields("ads_text") != '') {
                      ?>
                      <p><?php echo $res->fields("ads_text"); ?></p>
                      <?php
                      }
                     */
                    ?>
                  </div>
                </div>
                <?php
                $vActive1 = "";
                $res->MoveNext();
              }
              $res->Close();
              ?>
            </div>
            <a class="carousel-control-prev" href="#<?php echo $vId; ?>" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#<?php echo $vId; ?>" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
}