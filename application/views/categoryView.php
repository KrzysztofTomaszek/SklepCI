<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="form-group" style="display: inline-block">
    <label for="sKat">Kategoria:</label>
    <select class="form-control" name="Kat" id="sKat">
        <?php echo $kategorie;?>
    </select>
</div>
<div class="form-group" style="display: inline-block">
    <label for="sPodKat">Podkategoria:</label>
    <select class="form-control" name="podKat" id="sPodKat">
        <?php echo $podKategorie;?>
    </select>
</div>
<script type="text/javascript">
  $(document).ready(function()
  {
      $("#sKat").change(function()
      {
        var url="<?php echo site_url();?>/podkat/" + $( "#sKat" ).val();
        $("#sPodKat").load(url);
      });
    });
</script>