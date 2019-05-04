<?php
$PH_BASE_PATH = "/eadrx/";
$PH_RELATIVE_PATH = "app/PhApps/";
?>
<?php include_once $PH_RELATIVE_PATH . "phmysql.php" ?>
<?php include_once $PH_RELATIVE_PATH . "phfn.php" ?>
<?php include_once $PH_RELATIVE_PATH . "cpfn.php" ?>
<?php
global $dbKeys, $nPhCurrentLang;

// Prepare Request variables
ph_PrepareGets();
ph_PreparePosts();

// PhSoft Setting
$ph_Setting_SiteName = ph_Setting('Site-Name');

$ph_Setting_DispHeader = ph_Setting('Disp-Header');
$ph_Setting_DispPreHeader = ph_Setting('Disp-PreHeader');
$ph_Setting_Disp_TLeftMenu = ph_Setting('Disp-Top-Left-Menu');
$ph_Setting_Disp_TRightMenu = ph_Setting('Disp-Top-Right-Menu');
$ph_Setting_TLeftMenu = ph_Setting('Top-Left-Menu');
$ph_Setting_TRightMenu = ph_Setting('Top-Right-Menu');
$ph_Setting_DispLangs = ph_Setting('Disp-Langs');

$ph_Setting_MainMenu = ph_Setting('Main-Menu');
$ph_Setting_HomeMenu = ph_Setting('Home-Menu');
$ph_Setting_DispTSearch = ph_Setting('Disp-Menu-Search');

$ph_Setting_DispSlider = ph_Setting('Disp-Slider');
$ph_Setting_DefSlider = ph_Setting('Default-Slider');

$ph_Setting_DispFooter = ph_Setting('Disp-Footer');
$ph_Setting_DispPreFooter = ph_Setting('Disp-PreFooter');

$ph_Setting_Facebook = ph_Setting('Disp-Facebook');
$ph_URL_Facebook = ph_Setting('URL-facebook');

if ($ph_Setting_SiteName == "") {
  $ph_Setting_SiteName = "Eve Adam Online";
}

$nLang = ph_Get('l');
if ($nLang == '') {
  $nLang = ph_Post('l');
}
if ($nLang == '') {
  $nLang = 2;
}
$dbKeys = ph_LoadDBKeys($nLang);

$nMode = intval(ph_Get('m'));
if ($nMode == '') {
  $nMode = intval(ph_Post('m'));
}
if ($nMode == '') {
  $nMode = $ph_Setting_HomeMenu;
}

$nId = ph_Get('i');
if ($nId == '') {
  $nId = ph_Post('i');
}
if ($nId == '') {
  $nId = 0;
}
$cSlider = cSlider::getInstanceByName($ph_Setting_DefSlider);
$vSlider = cSlider::renderSlider($cSlider, $cSlider->Slid_Id);
$curLang = cLang::getInstance($nLang);
$vLangs = '';
if ($ph_Setting_DispLangs == 1) {
  $vLangs = cLang::renderLangs($curLang);
}
$tlMenu = cMenu::renderMenu($ph_Setting_TLeftMenu, $nLang, $nMode);
$trMenu = cMenu::renderMenu($ph_Setting_TRightMenu, $nLang, $nMode);
$vAscDesc = '';
if (strtolower($curLang->Lang_Dir) == 'rtl') {
  $vAscDesc = 'DESC';
}
$mainMenu = cMenu::renderMenu($ph_Setting_MainMenu, $nLang, $nMode, true, $vAscDesc);
$pageName = ph_GetDBValue('menu_page', 'phs_menu', 'menu_id="' . $nMode . '"');
if ($pageName == '') {
  $nPage = ph_GetDBValue('page_id', 'phs_menu', 'menu_id="' . $nMode . '"');
  $nMenuId = $nMode;
  $pageName = 'page-page.php';
//  switch ($nMode) {
//    case 101:
//    case 131:
//      $nPage = ph_GetDBValue('page_id', 'phs_menu', 'menu_id="' . $nMode . '"');
//      $nMenuId = $nMode;
//      $pageName = 'page-page.php';
//      break;
//    default:
//      $pageName = 'page-main.php';
//      break;
//  }
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?Php echo $curLang->Lang_Code; ?>">
  <!--<![endif]-->

  <!-- Head BEGIN -->
  <head>
    <meta charset="utf-8">
    <title><?php echo $ph_Setting_SiteName; ?></title>
    <?php echo ph_GetMetta(); ?>

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Fonts START -->
    <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all">-->
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/bootstrap/css/bootstrap-<?php echo strtolower($curLang->Lang_Dir); ?>.css">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/pages/css/animate.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/plugins/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/pages/scripts/bs-carousel.js/">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/pages/css/components.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/pages/css/slider.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/corporate/css/style.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/corporate/css/style-responsive.css">
    <link rel="stylesheet" href="<?php echo $PH_BASE_PATH; ?>assets/corporate/css/themes/custom.css" id="style-color">
    <!-- Theme styles END -->
  </head>
  <!-- Head END -->

  <!-- Body BEGIN -->
  <body class="corporate" dir="<?php echo $curLang->Lang_Dir; ?>">
    <?php
    if ($ph_Setting_DispPreHeader == 1) {
      ?>
      <!-- BEGIN TOP BAR -->
      <div class="pre-header">
        <div class="container">
          <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info text-left pull-left">
              <?php
              if ($ph_Setting_Disp_TLeftMenu == 1) {
                ?>
                <ul class="list-unstyled list-inline">
                  <?php echo $tlMenu; ?>
                  <?php echo $vLangs; ?>
                </ul>
                <?php
              }
              ?>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav text-right pull-right">
              <?php
              if ($ph_Setting_Disp_TRightMenu == 1) {
                ?>
                <ul class="list-unstyled list-inline">
                  <?php echo $trMenu; ?>
                </ul>
                <?php
              }
              ?>
            </div>
            <!-- END TOP BAR MENU -->
          </div>
        </div>
      </div>
      <!-- END TOP BAR -->
      <?php
    }
    ?>
    <?php
    if ($ph_Setting_DispHeader == 1) {
      ?>
      <!-- BEGIN HEADER -->
      <div class="header">
        <div class="container">
          <a class="site-logo pull-left" href="index.php">
            <img src="<?php echo $PH_BASE_PATH; ?>assets/corporate/img/logos/ae-logoE1.svg" alt="<?php echo $ph_Setting_SiteName; ?>">
          </a>
          <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
          <!-- BEGIN NAVIGATION -->
          <div class="header-navigation pull-right font-transform-inherit">
            <ul>
              <?php echo $mainMenu; ?>
              <?php
              if ($ph_Setting_DispTSearch == 1) {
                ?>
                <!-- BEGIN TOP SEARCH -->
                <li class="menu-search">
                  <span class="sep"></span>
                  <i class="fa fa-search search-btn"></i>
                  <div class="search-box">
                    <form action="#">
                      <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                      </div>
                    </form>
                  </div>
                </li>
                <!-- END TOP SEARCH -->
                <?php
              }
              ?>
            </ul>
          </div>
          <!-- END NAVIGATION -->
        </div>
      </div>
      <!-- Header END -->
      <?php
    }
    ?>

    <?php include $pageName; ?>

    <?php
    if ($ph_Setting_DispPreFooter == 1) {
      ?>
      <!-- BEGIN PRE-FOOTER -->
      <div class="pre-footer">
        <div class="container">
          <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-8 col-sm-6 pre-footer-col">
              <h2><?php echo ph_DBKey('About us', $curLang->Lang_Id); ?></h2>
              <?php echo ph_DBKeyText('About us', $curLang->Lang_Id); ?>
            </div>
            <!-- END BOTTOM ABOUT BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
              <h2><?php echo ph_DBKey('Our Contacts', $curLang->Lang_Id); ?></h2>
              <?php echo ph_DBKeyText('Our Contacts', $curLang->Lang_Id); ?>
            </div>
            <!-- END BOTTOM CONTACTS -->
          </div>
        </div>
      </div>
      <!-- END PRE-FOOTER -->
      <?php
    }
    ?>
    <?php
    if ($ph_Setting_DispFooter == 1) {
      ?>
      <!-- BEGIN FOOTER -->
      <div class="footer">
        <div class="container">
          <div class="row">
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-4 col-sm-4 padding-top-10">
              <?php echo date('Y'); ?> © <?php echo $ph_Setting_SiteName; ?>. <?php echo ph_DBKey('ALL Rights Reserved.', $curLang->Lang_Id); ?>.
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN PAYMENTS -->
            <div class="col-md-4 col-sm-4">
              <ul class="social-footer list-unstyled list-inline pull-right">
                <li><a href="javascript:;"><i class="fab fa-facebook"></i></a></li>
                <li><a href="javascript:;"><i class="fab fa-instagram"></i></a></li>
                <li><a href="javascript:;"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="javascript:;"><i class="fab fa-twitter"></i></a></li>
              </ul>
            </div>
            <!-- END PAYMENTS -->
            <!-- BEGIN POWERED -->
            <div class="col-md-4 col-sm-4 text-right">
              <p class="powered"><?php echo ph_DBKey('Powered by:', $curLang->Lang_Id); ?></p>
            </div>
            <!-- END POWERED -->
          </div>
        </div>
      </div>
      <!-- END FOOTER -->
      <?php
    }
    ?>

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="<?php echo $PH_BASE_PATH; ?>assets/plugins/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/plugins/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/plugins/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/corporate/scripts/back-to-top.js"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script><!-- pop up -->
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/plugins/owl.carousel/owl.carousel.min.js"></script><!-- slider for products -->

    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/corporate/scripts/layout.js"></script>
    <script type="text/javascript" src="<?php echo $PH_BASE_PATH; ?>assets/pages/scripts/bs-carousel.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function () {
        Layout.init();
        Layout.initOWL();
        Layout.initTwitter();
        Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
        Layout.initNavScrolling();
        $('.carousel').carousel();
        $('.newsBtn').click(function () {
          var nSYear = $(this).data('syear');
          var nEYear = $(this).data('eyear');
          var id = $(this).data('id');
          $.ajax({
            type: 'POST',
            async: false,
            url: 'PhApps/PhModules/phNews.php',
            data: {
              "nSYear": nSYear,
              "nEYear": nEYear
            },
            success: function (data) {
              try {
                var oRet = JSON.parse(data);
                if (oRet.Status === true) {
                  var slider = '';
                  var vOL = '';
                  var vInner = '';
                  var vActive = 'active';
                  for (var i = 0; i < oRet.Data.length; i++) {
                    vOL += '<li data-target="#newsSlider' + id + '" data-slide-to="' + i + '" class="' + vActive + '"></li>';
                    vInner += '<div class="carousel-item ' + vActive + '">'
                            + '  <div class="container">'
                            + '    <div class="row">'
                            + '      <div class="col-12 col-sm-6 p-5">'
                            + '        <h5>' + oRet.Data[i].News_Title + '</h5>'
                            + '        <div>' + oRet.Data[i].News_Text + '</div>'
                            + '      </div>'
                            + '      <div class="col-12 col-sm-6 p-5">'
                            + '        <img class="newsimage" data-id="' + oRet.Data[i].News_Id + '" style="width: 100%" src="<?php echo $PH_BASE_PATH; ?>assets/pages/img/newsImages/' + oRet.Data[i].News_Image + '">'
                            + '      </div>'
                            + '    </div>'
                            + '  </div>'
                            + '</div>';
                    vActive = '';
                  }
                  slider = '<ol id="newsOL' + id + '" class="carousel-indicators">'
                          + vOL
                          + '</ol>'
                          + '<div id="newsInner' + id + '" class="carousel-inner w-100">'
                          + vInner
                          + '  <a class="carousel-control-prev" href="#newsSlider' + id + '" role="button" data-slide="prev">'
                          + '    <span class="carousel-control-prev-icon" aria-hidden="true"></span>'
                          + '    <span class="sr-only">Previous</span>'
                          + '  </a>'
                          + '  <a class="carousel-control-next" href="#newsSlider' + id + '" role="button" data-slide="next">'
                          + '    <span class="carousel-control-next-icon" aria-hidden="true"></span>'
                          + '    <span class="sr-only">Next</span>'
                          + '  </a>'
                          + '</div>';
                  $('#newsSlider' + id).html(slider);
                  $('.newsimage').click(function () {
                    getGallery($(this).data('id'));
                  });
                }
              } catch (ex) {
              }
            },
            error: function (data) {
            }
          });
        });
        $('.ph-menu-link').click(function () {
          var params = {
            mode: $(this).data('mode'),
            page: $(this).data('page'),
            menu: $(this).data('mid')
          };
          $.redirect("index.php", params, 'POST');
        });
        $('.newsimage').click(function () {
          getGallery($(this).data('id'));
        });
      });
      function getGallery(nId) {
        $.ajax({
          type: 'POST',
          async: false,
          url: '<?php echo $PH_BASE_PATH; ?>assets/app/PhApps/PhModules/phNImages.php',
          data: {
            "nId": nId
          },
          success: function (data) {
            var oRet = JSON.parse(data);
            if (oRet.Status === true) {
              $.fancybox.open(oRet.Data, {
                nextEffect: 'none',
                prevEffect: 'none',
                padding: 0,
                playSpeed: 500,
                loop: true,
                autoSize: true,
                autoResize: true,
                aspectRatio: true,
                helpers: {
                  title: {
                    type: 'over'
                  },
                  thumbs: {
                    width: 75,
                    height: 50,
                    source: function (item) {
                      return item.href;
                    }
                  }
                }
              });
            }
          },
          error: function (data) {
          }
        });
      }
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
  </body>
  <!-- END BODY -->
</html>