<div class="row my-5">
  <?php
  $aTests = cTest::getArray("`lang_id`=" . $curLang->Lang_Id);
  if (count($aTests) > 0) {
    foreach ($aTests as $test) {
      ?>
      <div class="block col-12 col-sm-12 my-3">
        <div class="block-body">
          <div class="row">
            <div class="col-12 col-sm-2 px-3">
              <img src="<?php echo ph_Setting('Path_Test_Images') . $test->Test_Image; ?>" style="width: 100%;">
            </div>
            <div class="col-12 col-sm-10 px-5">
              <div class="row">
                <div class="col-12">
                  <h3><?php echo ph_DBKey("Test Name", $curLang->Lang_Id) . ' : ' . ph_DBKey($test->Test_Name, $curLang->Lang_Id); ?></h3>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h5><?php echo ph_DBKey("Price", $curLang->Lang_Id) . ' : ' . $test->Test_Price; ?> <?php echo ph_Setting('Currency-Sign'); ?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <?php echo $test->Test_Desc; ?>
                </div>
              </div>
              <div class="row my-3">
                <div class="col-12 text-right">
                  <button id="TestRead" class="btn btn-success" data-id="<?php echo $test->Test_Id; ?>"><?php echo ph_DBKey('Previous Results', $curLang->Lang_Id); ?></button>
                  <button id="TestSubscribe" class="btn btn-info" data-id="<?php echo $test->Test_Id; ?>"><?php echo ph_DBKey('Take it', $curLang->Lang_Id) . ' ' . $test->Test_Price . ph_Setting('Currency-Sign'); ?></button>
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
