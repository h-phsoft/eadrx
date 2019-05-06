<?php
if (ph_Setting('APP-DISP-FreeTips') == 1) {
  ?>
  <div class="row my-3">
    <div class="block col-12 col-sm-12">
      <div class="block-body text-center px-5">
        <h5 class="block-title">Tip of the day</h5>
        <div class="block-text text-justify-last-center"><?php echo cp_getDailyTip($nLang); ?></div>
      </div>
    </div>
  </div>
  <?php
}
