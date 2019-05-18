<?php
if ($nUPGrp < 0) {
  $nCount = 1;
} else {
  $nCount = ph_GetDBValue('count(*)', '`app_subscribe`', '`user_id`=' . $nUserId . ' AND `serv_id`=1 AND `book_id`=' . $nId);
}
if ($nCount > 0) {
  $nFirstPage = ph_GetDBValue('min(`page_num`)', 'app_book_page', '(`book_id`=' . $nId . ')');
  $vFirstPage = ph_GetDBValue('`page_text`', 'app_book_page', '(`book_id`=' . $nId . ' AND `page_num`=' . $nFirstPage . ')');
  ?>
  <div class="row my-5">
    <div class="block col-12">
      <div class="block-body col-12">
        <div class="row">
          <div class="col-12 text-center">
            <ul class="PhPager">
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div id="bookPage">
              <?php
              echo $vFirstPage;
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <ul class="PhPager">
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>