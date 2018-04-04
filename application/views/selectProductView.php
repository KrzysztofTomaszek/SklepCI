<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div style="align-items: center;">
	  <h2>Wybierz produkt do edycji</h2>
	  <form action="" method="POST">
        <?php echo $kategorie;?>
        <div class="form-group" style="display: inline-block">
          <label for="produkt">Produkt:</label>
          <select class="form-control" name="produkt" id="produkt">
              <?php echo $produkty;?>
          </select>
        </div>
	  </form>
      <button onclick="loadForm()">Edytuj</button>
	</div>
    <script type="text/javascript">
        function loadForm()
        {
            var url = "<?php echo site_url();?>/editProdukt/"+$( "#produkt" ).val();
            window.location = url;
        }
        $(document).ready(function()
        {
            $("#sssPodKat").change(function()
            {
                var url="<?php echo site_url();?>/productSel/" + $( "#sssKat" ).val()+'/'+$( "#sssPodKat" ).val();
                $("#produkt").load(url);
            });
        });
        $(document).ready(function()
        {
            $("#sssKat").change(function()
            {
                var url="<?php echo site_url();?>/productSel/" + $( "#sssKat" ).val() + '/0';
                $("#produkt").load(url);
            });
        });
    </script>
    </script>