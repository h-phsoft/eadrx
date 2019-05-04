<?php
$aFCats = cFaqCategory::getArray('');
?>
<div class="main">
  <div class="container">
    <div class="row margin-bottom-40">
      <!-- BEGIN CONTENT -->
      <div class="col-md-12 col-sm-12">
        <h1>Frequently Asked Questions</h1>
        <div class="content-page">
          <div class="row">
            <div class="col-md-3 col-sm-3">
              <ul class="tabbable faq-tabbable">
                <?php
                $vActive = 'active';
                foreach ($aFCats as $cat) {
                  echo '<li class="' . $vActive . '"><a href="#tab_' . $cat->FCat_Id . '" data-toggle="tab">' . $cat->FCat_Name . '</a></li>';
                  $vActive = '';
                }
                ?>
              </ul>
            </div>
            <div class="col-md-9 col-sm-9">
              <div class="tab-content" style="padding:0; background: #fff;">
                <?php
                $vActive = 'active';
                foreach ($aFCats as $cat) {
                  echo '<div class="tab-pane ' . $vActive . '" id="tab_' . $cat->FCat_Id . '">';
                  echo '  <div class="panel-group" id="accordion' . $cat->FCat_Id . '">';
                  $vExpanded = 'true';
                  $vCollapse = 'collapse in';
                  foreach ($cat->aFAQs as $faq) {
                    if ($faq->Lang_Id == $nLang) {
                      echo '    <div class="panel panel-default">';
                      echo '      <div class="panel-heading">';
                      echo '        <h4 class="panel-title">';
                      echo '          <a href="#accordion_' . $faq->FAQ_Id . '" data-parent="#accordion' . $cat->FCat_Id . '" data-toggle="collapse" class="accordion-toggle" aria-expanded="' . $vExpanded . '">';
                      echo '            ' . $faq->FAQ_Title;
                      echo '          </a>';
                      echo '        </h4>';
                      echo '      </div>';
                      echo '      <div class="panel-collapse ' . $vCollapse . '" id="accordion_' . $faq->FAQ_Id . '" aria-expanded="' . $vExpanded . '">';
                      echo '        <div class="panel-body">';
                      echo '            ' . $faq->FAQ_Text;
                      echo '        </div>';
                      echo '      </div>';
                      echo '    </div>';
                      $vExpanded = 'false';
                      $vCollapse = 'collapse';
                    }
                  }
                  echo '  </div>';
                  echo '</div>';
                  $vActive = '';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
  </div>
</div>
