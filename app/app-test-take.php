<div class="row my-5">
  <?php
  echo ph_GetDBValue('test_name', 'app_vtest', '(`test_id`=' . $nId . ' AND `lang_id`=' . $curLang->Lang_Id . ')');
  ?>
</div>
