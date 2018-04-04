<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h2>Edycja Danych</h2>
  <form action="<?php echo site_url();?>/editF" method="POST">
      <div class="form-group">
          <input type="text" name="userID" value="<?php echo $userID?>" required style="visibility: hidden;">
          <input type="text" name="loginS" value="<?php echo $tab['login']?>" required style="visibility: hidden;">
      </div>
        <div class="form-group">
          <label for="login">Login:</label>
          <input type="text" class="form-control" value="<?php echo $tab['login']?>" id="login" placeholder="Wpisz login" name="login" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="passwordS">Hasło Stare:</label>
          <input type="password" class="form-control" id="passwordS" placeholder="Wpisz hasło" name="passwordS" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="passwordN">Hasło Nowe:</label>
          <input type="password" class="form-control" id="passwordN" placeholder="Wpisz hasło" name="passwordN" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="imie">Imię:</label>
          <input type="text" class="form-control" value="<?php echo $tab['imie']?>" id="imie" placeholder="Wpisz swoje imię" name="imie" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="nazwisko">Nazwisko:</label>
          <input type="text" class="form-control" value="<?php echo $tab['nazwisko']?>" id="nazwisko" placeholder="Wpisz swoje nazwisko" name="nazwisko" required minlength="3">
        </div><br>
        <div class="form-group">
            <label for="plec">Płeć:</label>
            <select id="plec" name="plec">
                <option value="m">Mężczyzna</option>
                <option value="k">Kobieta</option>
            </select>
        </div><br>
        <div class="form-group">
          <label for="wiek">Wiek:</label>
          <input type="number" class="form-control" value="<?php echo $tab['wiek']?>" id=wiek" placeholder="Wpisz swój wiek" name="wiek" required>
        </div><br>
        <div class="form-group">
          <label for="ulica">Ulica:</label>
          <input type="text" class="form-control" value="<?php echo $tab['ulica']?>" id="ulica" placeholder="Wpisz swoją ulice" name="ulica" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="kod">Kod Pocztowy:</label>
          <input type="text" class="form-control" value="<?php echo $tab['kodPocztowy']?>" pattern="^[0-9]{2}-[0-9]{3}$" id="kod" placeholder="Wpisz swój kod pocztowy" name="kod" required >
        </div><br>
        <div class="form-group">
          <label for="poczta">Poczta:</label>
          <input type="text" class="form-control" value="<?php echo $tab['poczta']?>" id="poczta" placeholder="Wpisz swoją pocztę" name="poczta" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="miejscowosc">Miejscowość:</label>
          <input type="text" class="form-control" value="<?php echo $tab['miejscowosc']?>" id="miejscowosc" placeholder="Wpisz swój miejscowość" name="miejscowosc" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="adres">Adres:</label>
          <input type="text" class="form-control" value="<?php echo $tab['adres']?>" id="adres" placeholder="Wpisz swój adres" name="adres" required >
        </div><br>
        <div class="form-group">
            <label for="woj">Województwo:</label>
            <input type="text" class="form-control" value="<?php echo $tab['wojewodztwo']?>" id="woj" placeholder="Wojewodztwo" name="woj" required minlength="3">
        </div><br>
        <button type="submit" class="btn btn-default">Edytuj</button>
  </form>
</div>