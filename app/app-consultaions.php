<div class="row my-5">
  <?php
  $aConsCats = cConsultationCategory::getArray("");
  if (count($aConsCats) > 0) {
    foreach ($aConsCats as $cat) {
      $catLang = cLang::getInstance($cat->Lang_Id);
      ?>
      <div class="block col-12 col-sm-12">
        <div class="block-body">
          <div class="row">
            <div class="col-12 col-sm-12 px-5">
              <div class="row">
                <h3><?php echo ph_DBKey($cat->Book_Title, $curLang->Lang_Id); ?></h3>
              </div>
              <div class="row">
                <h4><?php echo ph_DBKey("Book Language", $curLang->Lang_Id) . ': ' . $catLang->Lang_Name; ?></h4>
              </div>
              <div class="row">
                <h5><?php echo ph_DBKey("Price", $curLang->Lang_Id) . ': ' . $cat->Book_Price; ?><?php echo ph_Setting('Currency-Sign'); ?></h5>
              </div>
              <div class="row">
                <div class="col-12 text-left">
                  <?php echo $cat->Book_Desc; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <a class="btn btn-success" href="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Menu-Book') . '/' . $cat->Book_Id; ?>"><?php echo ph_DBKey('Read', $curLang->Lang_Id); ?></a>
                  <a class="btn btn-info" href="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Menu-Book-Subscribe') . '/' . $cat->Book_Id; ?>"><?php echo ph_DBKey('Subscribe', $curLang->Lang_Id) . ' ' . $cat->Book_Price . ph_Setting('Currency-Sign'); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
  }
  ?>
</div>
