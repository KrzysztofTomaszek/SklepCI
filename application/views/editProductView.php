<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <h2>Edytowanie Towaru</h2>
    <form action="<?php echo site_url();?>/editProduktF" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <input type="text" name="IDproduktu" value="<?php echo $tab['IDprodukty'];?>" required style="visibility: hidden;">
            <input type="text" name="nameS" value="<?php echo $tab['nazwa'];?>" required style="visibility: hidden;">
        </div>
        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input type="text" class="form-control" id="name" value="<?php echo $tab['nazwa'];?>" placeholder="Wpisz nazwę towaru" name="name" required minlength="3">
        </div><br>
        <div class="form-group">
            <label for="opis">Opis:</label>
            <textarea rows="10" cols="40" name="opis" class="form-control" id="opis"  placeholder="Wpisz tutaj opis towaru" required><?php echo $tab['opisProduktu']?></textarea>
        </div><br>
        <div class="form-group">
            <label for="zdj">Zdjęcie:</label>
            <img width="480" height="384" src="<?php  echo base_url().$tab['imageLink'];?>">
            <input type="file" name="zdj" id="zdj"><br>
        </div><br>
        <div class="form-group">
            <?php echo $category;?>
        </div><br>
        <div class="form-group">
            <label for="netto">Cena Netto:</label>
            <input type="number" class="form-control" id="netto" value="<?php echo $tab['cenaNetto'];?>" placeholder="Wpisz cene netto" name="netto" step="0.01" required>
        </div><br>
        <div class="form-group">
            <label for="vat">VAT:</label>
            <input type="text" class="form-control" id="vat" placeholder="Wpisz VAT jako procent bez znaku" value="<?php echo $tab['VAT']?>" name="vat" size="25" pattern="[1-9][0-9]{0-1}" required maxlength="2">
        </div><br>
        <div class="form-group">
            <label for="brutto">Cena Brutto:</label>
            <input type="text" class="form-control" id="brutto" disabled step="0.01"  value="0">
        </div><br>
        <script type="text/javascript">
          $(document).ready(function()
          {
            $("#brutto").val(Number((parseFloat($("#netto").val())+ parseFloat(($("#netto").val()*($("#vat").val()/100)))).toFixed(2)));
            
            $("#vat").keyup(function()
            {
              var brutto= parseFloat($("#netto").val())+ parseFloat(($("#netto").val()*($("#vat").val()/100)));
              $("#brutto").val(Number((brutto).toFixed(2)));
            });

            $("#netto").keyup(function()
            {
              var brutto= parseFloat($("#netto").val())+ parseFloat(($("#netto").val()*($("#vat").val()/100)));          
              $("#brutto").val(Number((brutto).toFixed(2)));
            });
            $("#vat").change(function()
            {
              var brutto= parseFloat($("#netto").val())+ parseFloat(($("#netto").val()*($("#vat").val()/100)));
              $("#brutto").val(Number((brutto).toFixed(2)));
            });

            $("#netto").change(function()
            {
              var brutto= parseFloat($("#netto").val())+ parseFloat(($("#netto").val()*($("#vat").val()/100)));
              $("#brutto").val(Number((brutto).toFixed(2)));
            });
          });
        </script>
        <div class="form-group">
            <label for="ile">Ilosć:</label>
            <input type="number" class="form-control" id="ile" value="<?php echo $tab['ilosc_cala'];?>" placeholder="Wpisz ilość towaru" name="ile" required minlength="1">
        </div><br>
        <div class="form-group">
            <label for="ile">Ilosć Zarezerwowana:</label>
            <input type="number" class="form-control" id="ileZar" value="<?php echo $tab['ilosc_zarezerwowana'];?>" placeholder="Wpisz ilość towaru zarezerwowanego" name="ileZar" required minlength="1">
        </div><br>
        <button type="submit" class="btn btn-default">Edytuj</button>
    </form>
</div>
</div>