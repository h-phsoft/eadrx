<div class="main">
  <div class="container">
    <div class="row margin-bottom-40">
      <!-- BEGIN CONTENT -->
      <div class="col-md-12 col-sm-12">
        <h1><?php echo ph_DBKey('Get Application', $curLang->Lang_Id); ?></h1>
        <div class="content-page">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h2><?php echo ph_DBKey('Web Application', $curLang->Lang_Id); ?></h2>
              <?php echo ph_DBKeyText('Web Application', $curLang->Lang_Id); ?>
            </div>
            <div class="col-md-4 col-sm-4">
              <h2><?php echo ph_DBKey('Android', $curLang->Lang_Id); ?></h2>
              <?php echo ph_DBKeyText('Android', $curLang->Lang_Id); ?>
            </div>
            <div class="col-md-4 col-sm-4">
              <h2><?php echo ph_DBKey('Apple', $curLang->Lang_Id); ?></h2>
              <?php echo ph_DBKeyText('Apple', $curLang->Lang_Id); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
  </div>
</div>
