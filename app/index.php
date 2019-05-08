<?php
if (session_id() == "") {
  session_start(); // Init session data
}
ob_start(); // Turn on output buffering
?>
<?php
$PH_BASE_PATH = '/eadrx/app/';
$PH_BASE_IMAGES_PATH = '/eadrx/';
$PH_RELATIVE_PATH = "PhApps/";
?>
<?php include_once $PH_RELATIVE_PATH . "phmysql.php" ?>
<?php include_once $PH_RELATIVE_PATH . "phfn.php" ?>
<?php include_once $PH_RELATIVE_PATH . "cpfn.php" ?>
<?php
global $dbKeys;

// Prepare Request variables
ph_PrepareGets();
ph_PreparePosts();

$nLang = '2';
$nMode = '0';
$nId = 0;
$vURL = '';
foreach ($_GET as $key => $value) {
  $vURL = $key;
}
if ($vURL !== '') {
  $nPos = strpos($vURL, '/');
  if ($nPos !== false) {
    $nLang = substr($vURL, 0, $nPos);
    $vURL = substr($vURL, $nPos + 1);
    if ($vURL !== '') {
      $nPos = strpos($vURL, '/');
      if ($nPos !== false) {
        $nMode = substr($vURL, 0, $nPos);
        $nId = substr($vURL, $nPos + 1);
      } else {
        $nMode = $vURL;
      }
    }
  } else {
    $nLang = $vURL;
  }
}
if ($nLang === '') {
  $nLang = 2;
}
$dbKeys = ph_LoadDBKeys($nLang);
ph_SetSession('CurrLang', $nLang);

if ($nMode == ph_Setting('App-Menu-Home')) {
  $nMode = 0;
}
//echo '<br><br><br><br><br><br><br><br><br>';
if ($nMode == ph_Setting('App-Mode-Login') && $nId != 0) {
  $inputName = ph_Post('inputName');
  $inputPassword = ph_Post('inputPassword');
  $nUserId = cp_Login($inputName, $inputPassword);
  if ($nUserId > 0) {
    ph_SetSession('UID', $nUserId);
    $nMode = 0;
    $nId = 0;
  }
}
if ($nMode == ph_Setting('App-Mode-Register') && $nId != 0) {
  $inputName = ph_Post('inputName');
  $inputPassword = ph_Post('inputPassword');
  $inputGender = ph_Post('inputGender');
  $nUserId = cp_RegisterUser($inputName, $inputPassword, $inputGender);
  if ($nUserId > 0) {
    ph_SetSession('UID', $nUserId);
    $nMode = 0;
    $nId = 0;
  }
}
$nUserId = ph_session("UID");
if ($nUserId == null || $nUserId == '' || $nMode == ph_Setting('App-Mode-Logout')) {
  if ($nMode != ph_Setting('App-Mode-Register')) {
    $nMode = ph_Setting('App-Mode-Login');
    echo '0<br>';
  }
  ph_SetSession('UID', '');
  echo '1<br>';
}
if ($nUserId > 0) {
  $vUserName = cp_UserName($nUserId);
}

// PhSoft Setting
$ph_Setting_SiteName = ph_Setting('Site-Name');
$ph_Setting_NavLeftMenu = ph_Setting('Nav-Left-Menu');
$ph_Setting_NavRightMenu = ph_Setting('Nav-Right-Menu');

if ($ph_Setting_SiteName == "") {
  $ph_Setting_SiteName = "Eve Adam Online";
}

$aLangs = cLang::getArray();
$curLang = cLang::getInstance($nLang);

$navLeftMenu = cMenu::getInstance($ph_Setting_NavLeftMenu);
$navRightMenu = cMenu::getInstance($ph_Setting_NavRightMenu);
$cMenu = cMenu::getInstance($nMode, false);
$vHeader = ph_DBKey($cMenu->Menu_Name, $curLang->Lang_Id);
$pageName = $cMenu->Menu_Page;
if ($pageName == '') {
  $nPage = $cMenu->Page_Id;
  $nMenuId = $nMode;
  if ($nMode == ph_Setting('App-Mode-Login')) {
    $vHeader = ph_DBKey('Login', $curLang->Lang_Id);
    $pageName = ph_Setting('App-Page-Login');
  } else if ($nMode == ph_Setting('App-Mode-Register')) {
    $vHeader = ph_DBKey('Register', $curLang->Lang_Id);
    $pageName = ph_Setting('App-Page-Register');
  } else if ($nMode == ph_Setting('App-Menu-Book')) {
    if ($nId != 0) {
      $vHeader = ph_GetDBValue('book_title', 'app_book', '(`book_id`=' . $nId . ')');
      $nPages = ph_GetDBValue('count(*)', 'app_book_page', '(`book_id`=' . $nId . ')');
    }
    $pageName = ph_Setting('App-Page-Book');
  } else if ($nMode == ph_Setting('App-Menu-Take-Test')) {
    if ($nId != 0) {
      $vHeader = ph_GetDBValue('test_name', 'app_vtest', '(`test_id`=' . $nId . ' AND `lang_id`=' . $curLang->Lang_Id . ')');
    }
    $pageName = ph_Setting('App-Page-Take-Test');
  } else if ($nMode == ph_Setting('App-Menu-Book-Subscribe')) {
    if ($nId != 0) {
      $vHeader = ph_GetDBValue('book_title', 'app_book', '(`book_id`=' . $nId . ')');
    }
    $pageName = ph_Setting('App-Page-Book-Subscribe');
  } else {
    $vHeader = ph_Setting('App-Application-Name');
    $pageName = 'app-main.php';
  }
}
?>
<!doctype html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?Php echo $curLang->Lang_Code; ?>">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php echo $ph_Setting_SiteName; ?></title>
    <?php echo ph_GetMetta(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="<?php echo $PH_BASE_PATH; ?>assets/img/favicon.ico">

    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/bootstrap/<?php echo $curLang->Lang_Dir; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/font-awesome/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/jquery/mCustomScrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/carousel/bs-carousel.js">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/css/style.css">
  </head>
  <body dir="<?php echo $curLang->Lang_Dir; ?>">
    <div class="wrapper">
      <?php include 'app-sidebar-left.php'; ?>

      <?php include 'app-sidebar-right.php'; ?>

      <!-- Page Content  -->
      <div id="content">
        <div class="container-fluid text-center shadow bg-white rounded" style="padding: 5px !important;">
          <button type="button" class="btn btn-outline-primary sidebarCollapse float-left" data-side="left">
            <i class="fas fa-align-left"></i>
          </button>
          <button type="button" class="btn btn-outline-primary sidebarCollapse float-right" data-side="right">
            <i class="fas fa-align-right"></i>
          </button>
          <div>
            <h3><?php echo $vHeader; ?></h3>
          </div>
        </div>
        <div class="container-fluid">
          <?php include $pageName; ?>
        </div>
      </div>
    </div>
    <div class="overlay"></div>

    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/bootstrap/<?php echo $curLang->Lang_Dir; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/jquery/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/jquery/jquery-paging/jquery.paging.js"></script>
    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/owl.carousel/owl.carousel.js"></script>
    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/carousel/bs-carousel.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {

        var nMode = <?php echo $nMode; ?>;
        $(".sidebar").mCustomScrollbar({
          theme: "minimal"
        });
        $('.carousel').carousel();
        $('.sidebar-dismiss').on('click', function () {
          $('.sidebar-' + $(this).data('side')).removeClass('active');
          $('.overlay').removeClass('active');
        });
        $('.overlay').on('click', function () {
          $('.sidebar').removeClass('active');
          $('.overlay').removeClass('active');
        });
        $('.sidebarCollapse').on('click', function () {
          $('.sidebar-' + $(this).data('side')).addClass('active');
          $('.overlay').addClass('active');
          $('.collapse.in').toggleClass('in');
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
<?php
if ($nMode == ph_Setting('App-Menu-Book')) {
  if ($nId != 0) {
    ?>
            $(".PhPager").paging(<?php echo $nPages; ?>, {
              format: "[< ncn >]",
              perpage: 1,
              lapping: 0,
              page: 1,
              onSelect: function (page) {
                $.post('<?php echo $PH_BASE_PATH; ?>PhApps/PhModules/app-get-Book-Page.php',
                        {
                          start: this.slice[0],
                          end: this.slice[1],
                          page: page,
                          id: <?php echo $nId; ?>,
                          pages: <?php echo $nPages; ?>
                        },
                        null).done(function (data) {
                  if (data) {
                    try {
                      var result = JSON.parse(data);
                      if (result.Status === true) {
                        $("#bookPage").html(result.Data);
                      }
                    } catch (e) {

                    }
                  }
                }).fail(function () {
                  alert("error");
                });
              }
            });
    <?php
  }
}
?>
      });
    </script>
  </body>
</html>
