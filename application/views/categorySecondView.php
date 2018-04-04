<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="form-group" style="display: inline-block">
    <label for="sssKat">Kategoria:</label>
    <select class="form-control" name="Kat" id="sssKat">
        <?php echo $kategorie;?>
    </select>
</div>
<div class="form-group" style="display: inline-block">
    <label for="sssPodKat">Podkategoria:</label>
    <select class="form-control" name="podKat" id="sssPodKat">
        <?php echo $podKategorie;?>
    </select>
</div>
<script type="text/javascript">
  $(document).ready(function()
  {
      $("#sssKat").change(function()
      {
        var url="<?php echo site_url();?>/podkat/" + $( "#sssKat" ).val();
        $("#sssPodKat").load(url);
      });
    });
</script>