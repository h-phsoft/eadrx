<div class="row my-5">
  <?php
  $aBooks = cBook::getArray("", false);
  if (count($aBooks) > 0) {
    foreach ($aBooks as $book) {
      $bookLang = cLang::getInstance($book->Lang_Id);
      if ($nUPGrp < 0) {
        $nCount = 1;
      } else {
        $nCount = ph_GetDBValue('count(*)', '`app_subscribe`', '`user_id`=' . $nUserId . ' AND `serv_id`=1 AND `book_id`=' . $book->Book_Id);
      }
      ?>
      <div class="block col-12 col-sm-12">
        <div class="block-body">
          <div class="row">
            <div class="col-10 col-sm-2 px-5 mx-auto">
              <img src="<?php echo $PH_BASE_IMAGES_PATH . ph_Setting('Path-Book-Images') . $book->Book_Image; ?>" style="width: 100%;">
            </div>
            <div class="col-12 col-sm-10 px-5">
              <div class="row">
                <h4><?php echo ph_DBKey("Book Name", $curLang->Lang_Id) . ': ' . ph_DBKey($book->Book_Title, $curLang->Lang_Id); ?></h4>
              </div>
              <div class="row">
                <h5><?php echo ph_DBKey("Book Language", $curLang->Lang_Id) . ': ' . $bookLang->Lang_Name; ?></h5>
              </div>
              <div class="row">
                <h5><?php echo ph_DBKey("Price", $curLang->Lang_Id) . ': ' . $book->Book_Price; ?><?php echo ph_Setting('Currency-Sign'); ?></h5>
              </div>
              <div class="row">
                <div class="col-12 text-left">
                  <?php echo $book->Book_Desc; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <?php
                  if ($nCount > 0) {
                    ?>
                    <a class="btn btn-success" href="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Menu-Book') . '/' . $book->Book_Id; ?>"><?php echo ph_DBKey('Read', $curLang->Lang_Id); ?></a>
                    <?php
                  } else {
                    ?>
                    <a class="btn btn-info" href="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Menu-Book-Subscribe') . '/' . $book->Book_Id; ?>"><?php echo ph_DBKey('Purchase', $curLang->Lang_Id) . ' ' . $book->Book_Price . ph_Setting('Currency-Sign'); ?></a>
                    <?php
                  }
                  ?>
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
