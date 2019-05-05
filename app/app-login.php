<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <form class="form-signin" method="post" action="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Mode-Login') . '/-2'; ?>">
            <div class="form-label-group">
              <input type="text" id="inputName" name="inputName" class="form-control" placeholder="<?php echo ph_DBKey('Nick Name', $curLang->Lang_Id); ?>" required autofocus>
              <label for="inputName"><?php echo ph_DBKey('Nick Name', $curLang->Lang_Id); ?></label>
            </div>
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo ph_DBKey('Password', $curLang->Lang_Id); ?>" required>
              <label for="inputPassword"><?php echo ph_DBKey('Password', $curLang->Lang_Id); ?></label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"><?php echo ph_DBKey('Sign in', $curLang->Lang_Id); ?></button>
            <p class="mt-3">
              <?php echo ph_DBKey("Don't have an account ? Register", $curLang->Lang_Id); ?> <a href='<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Mode-Register'); ?>'><strong style="color: #7a020c"><?php echo ph_DBKey('here', $curLang->Lang_Id); ?></strong></a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
