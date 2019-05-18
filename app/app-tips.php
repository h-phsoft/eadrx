<?php
if (ph_Setting('APP-DISP-FreeTips') == 1) {
  $tip = cp_getDailyTip($nLang);
  ?>
  <div class="row my-3">
    <div class="block col-12 col-sm-12">
      <div class="block-body text-center px-5">
        <h5 class="block-title"><?php echo $tip->TCat_Name; ?></h5>
        <div class="block-text text-justify-last-center p-2"><?php echo $tip->Tips_Text; ?></div>
      </div>
    </div>
  </div>
  <?php
}
?>
<div class = "row my-5">
  <?php
  $aPkgs = cPackage::getArray();
  if (count($aPkgs) > 0) {
    foreach ($aPkgs as $pkg) {
      $vCycle = ph_GetDBValue('cycle_name', '`phs_bill_cycle`', '`cycle_id`=' . $pkg->Cycle_Id);
      ?>
      <div class="block col-12 col-sm-12 my-3">
        <div class="block-body">
          <div class="row">
            <div class="col-12 px-5">
              <div class="row">
                <div class="col-12">
                  <span class="block-title"><?php echo ph_DBKey("Package Name", $curLang->Lang_Id) . ': '; ?></span><span class="block-text"><?php echo ph_DBKey($pkg->Pkg_Name, $curLang->Lang_Id); ?></span>
                  <br/>
                  <span class="block-title"><?php echo ph_DBKey("Price", $curLang->Lang_Id) . ': '; ?></span><span class="block-text"><?php echo $pkg->Pkg_Price; ?><?php echo ph_Setting('Currency-Sign'); ?></span>
                  <br/>
                  <span class="block-title"><?php echo ph_DBKey("Duration", $curLang->Lang_Id) . ': '; ?></span><span class="block-text"><?php echo ph_DBKey($vCycle, $curLang->Lang_Id); ?></span>
                </div>
              </div>
              <?php
              if (count($pkg->aCats) > 1) {
                ?>
                <div class="row">
                  <div class="col-12 col-sm-1">
                    <span class="block-title"><?php echo ph_DBKey("Categories", $curLang->Lang_Id) . ': '; ?></span>
                  </div>
                  <div class="col-12 col-sm-11">
                    <?php
                    foreach ($pkg->aCats as $cat) {
                      ?>
                      <span class="block-text"><?php echo ph_DBKey($cat->TCat_Name, $curLang->Lang_Id); ?></span>
                      <br/>
                      <?php
                    }
                    ?>
                  </div>
                </div>
                <?php
              }
              ?>
              <div class="row my-3">
                <div class="col-12 text-right">
                  <a class="btn btn-info" href="?<?php echo $nLang . '/' . ph_Setting('App-Menu-Tips-Subscribe') . '/' . $pkg->Pkg_Id; ?>"><?php echo ph_DBKey('Subscribe', $curLang->Lang_Id) . ' ' . $pkg->Pkg_Price . ph_Setting('Currency-Sign'); ?></a>
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
