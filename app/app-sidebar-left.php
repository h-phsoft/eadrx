<nav class="sidebar sidebar-left">
  <div class="sidebar-dismiss sidebar-dismiss-left" data-side="left">
    <i class="fas fa-arrow-left"></i>
  </div>
  <div class="sidebar-header">
    <?php echo $vUserName; ?>
  </div>
  <ul class="list-unstyled components">
    <?php
    foreach ($navLeftMenu->aSubs as $menu) {
      if (count($menu->aSubs) > 0) {
        ?>
        <li>
          <a class="dropdown-toggle" href="#Submenu<?php echo $menu->Menu_Id; ?>" data-toggle="collapse" aria-expanded="false">
            <i class="<?php echo $menu->Menu_Icon; ?>"></i>
            <?php echo ph_DBKey($menu->Menu_Name, $curLang->Lang_Id); ?>
          </a>
          <ul class="collapse list-unstyled" id="Submenu<?php echo $menu->Menu_Id; ?>">
            <?php
            foreach ($menu->aSubs as $sMenu) {
              $menuTarget = '';
              if ($sMenu->Menu_Target != '') {
                $menuTarget = 'target="' . $sMenu->Menu_Target . '"';
              }
              ?>
              <li>
                <a class="menu-item" href="<?php echo ($sMenu->Menu_URL == '' ? $PH_BASE_PATH . '?' . $nLang . '/' . $sMenu->Menu_Id : $sMenu->Menu_URL); ?>" <?php echo $menuTarget; ?>>
                  <i class="<?php echo $sMenu->Menu_Icon; ?>"></i>
                  <?php echo ph_DBKey($sMenu->Menu_Name, $curLang->Lang_Id); ?>
                </a>
              </li>
              <?php
            }
            ?>
          </ul>
        </li>
        <?php
      } else {
        $menuTarget = '';
        if ($menu->Menu_Target != '') {
          $menuTarget = 'target="' . $menu->Menu_Target . '"';
        }
        ?>
        <li>
          <a class="menu-item active-menu" href="<?php echo ($menu->Menu_URL == '' ? $PH_BASE_PATH . '?' . $nLang . '/' . $menu->Menu_Id : $menu->Menu_URL); ?>" <?php echo $menuTarget; ?>>
            <i class="<?php echo $menu->Menu_Icon; ?>"></i>
            <?php echo ph_DBKey($menu->Menu_Name, $curLang->Lang_Id); ?>
          </a>
        </li>
        <?php
      }
    }
    ?>
  </ul>
  <hr>
  <ul class="list-unstyled components">
    <li>
      <?php
      if ($nUserId > 0) {
        ?>
        <a href="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Mode-Logout'); ?>" class="">
          <i class="fas fa-sign-out-alt"></i>
          <?php echo ph_DBKey('Logout', $curLang->Lang_Id); ?>
        </a>
        <?php
      }
      ?>
    </li>
  </ul>
</nav>
