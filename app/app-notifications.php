<?php
$aNotifs = cNotification::getUserNotifications($nUserId);
?>
<?php
foreach ($aNotifs as $notif) {
  ?>
  <div class="row my-3 mx-5">
    <div class="block col-12 col-sm-12">
      <div class="block-body text-center">
        <div class="block-title"><h5><?php echo $notif->Notif_Title; ?></h5></div>
        <div class="block-text my-3 text-justify-last-center"><?php echo $notif->Notif_Text; ?></div>
        <div class="block-footer text-left"><?php echo $notif->Ins_Datetime; ?></div>
      </div>
    </div>
  </div>
  <?php
}
?>
