<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h2>Dodawanie Towaru</h2>
  <form action="<?php echo site_url();?>/addProduktF" method="POST" enctype="multipart/form-data">
        <div class="form-group">
              <label for="name">Nazwa:</label>
              <input type="text" class="form-control" id="name" placeholder="Wpisz nazwę towaru" name="name" required minlength="3">
        </div><br>
        <div class="form-group">
            <label for="opis">Opis:</label>
            <textarea rows="10" cols="40" name="opis" class="form-control" id="opis" placeholder="Wpisz tutaj opis towaru" required></textarea>
        </div><br>
        <div class="form-group">
          <label for="zdj">Zdjęcie:</label>
          <input type="file" name="zdj" id="zdj" required><br>
        </div><br>
        <div class="form-group">
            <?php echo $category;?>
        </div><br>
        <div class="form-group">
            <label for="netto">Cena Netto:</label>
            <input type="number" class="form-control" id="netto" placeholder="Wpisz cene netto, grosze wpisz po przecinku" step="0.01" name="netto" required>
        </div><br>
        <div class="form-group">
             <label for="vat">VAT:</label>
            <input type="text" class="form-control" id="vat" placeholder="Wpisz VAT jako procent bez znaku" name="vat" size="25" pattern="[1-9][0-9]{0-1}" required maxlength="2">
        </div><br>
        <div class="form-group">
            <label for="brutto">Cena Brutto:</label>
            <input type="text" class="form-control" id="brutto" disabled step="0.01"  value="0">
        </div><br>
        <script type="text/javascript">
          $(document).ready(function()
          {
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
          <input type="number" class="form-control" id="ile" placeholder="Wpisz ilość towaru" name="ile" required minlength="1">
        </div><br>
        <button type="submit" class="btn btn-default">Dodaj</button>
  </form>
</div>