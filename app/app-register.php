<?php
$aGends = cGender::getArray('');
$aCountries = cCountry::getArray('');
?>
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <form class="form-signin" method="post" action="<?php echo $PH_BASE_PATH . '?' . $nLang . '/0/-1'; ?>">
            <div class="form-label-group">
              <input type="text" id="inputName" name="inputName" class="form-control" placeholder="<?php echo ph_DBKey('Nick Name', $curLang->Lang_Id); ?>" required autofocus>
              <label for="inputName"><?php echo ph_DBKey('Nick Name', $curLang->Lang_Id); ?></label>
            </div>
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo ph_DBKey('Password', $curLang->Lang_Id); ?>" required>
              <label for="inputPassword"><?php echo ph_DBKey('Password', $curLang->Lang_Id); ?></label>
            </div>
            <div class="form-label-group">
              <?php
              if (count($aGends) > 0) {
                ?>
                <select id="inputGender" name="inputGender" class="form-control">
                  <option value="0"><?php echo ph_DBKey('Gender', $curLang->Lang_Id); ?></option>
                  <?php
                  foreach ($aGends as $gend) {
                    ?>
                    <option value="<?php echo $gend->Gend_Id; ?>"><?php echo ph_DBKey($gend->Gend_Name, $curLang->Lang_Id); ?></option>
                    <?php
                  }
                  ?>
                </select>
                <?php
              }
              ?>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase"><?php echo ph_DBKey('Register', $curLang->Lang_Id); ?></button>
            <p class="mt-3">
              <?php echo ph_DBKey('Back to', $curLang->Lang_Id); ?> <a href='<?php echo $PH_BASE_PATH . '?' . $nLang . '/'; ?>0'><strong style="color: #7a020c"><?php echo ph_DBKey('Login', $curLang->Lang_Id); ?></strong></a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
