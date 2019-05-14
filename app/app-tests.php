<div class="row my-5">
  <?php
  $aTests = cTest::getArray("`lang_id`=" . $curLang->Lang_Id);
  if (count($aTests) > 0) {
    foreach ($aTests as $test) {
      $nCount = ph_GetDBValue('count(*)', '`app_subscribe`', '`user_id`=' . $nUserId . ' AND `serv_id`=4 AND `test_id`=' . $test->Test_Id);
      ?>
      <div class="block col-12 col-sm-12 my-3">
        <div class="block-body">
          <div class="row">
            <div class="col-8 col-sm-2 px-3 mx-auto">
              <img src="<?php echo $PH_BASE_IMAGES_PATH . ph_Setting('Path-Test-Images') . $test->Test_Image; ?>" style="width: 100%;">
            </div>
            <div class="col-12 col-sm-10 px-5">
              <div class="row">
                <div class="col-12">
                  <h4><?php echo ph_DBKey("Test Name", $curLang->Lang_Id) . ': ' . ph_DBKey($test->Test_Name, $curLang->Lang_Id); ?></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h5><?php echo ph_DBKey("Price", $curLang->Lang_Id) . ': ' . $test->Test_Price; ?><?php echo ph_Setting('Currency-Sign'); ?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <?php echo $test->Test_Desc; ?>
                </div>
              </div>
              <div class="row my-3">
                <div class="col-12 text-right">
                  <?php
                  if ($nCount > 0) {
                    ?>
                    <a class="btn btn-success" href="?<?php echo $nLang . '/' . ph_Setting('App-Menu-Test') . '/' . $test->Test_Id; ?>"><?php echo ph_DBKey('Results', $curLang->Lang_Id); ?></a>
                    <?php
                  }
                  ?>
                  <a class="btn btn-info" href="?<?php echo $nLang . '/' . ph_Setting('App-Menu-Take-Test') . '/' . $test->Test_Id; ?>"><?php echo ph_DBKey('Take test', $curLang->Lang_Id) . ' ' . $test->Test_Price . ph_Setting('Currency-Sign'); ?></a>
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
