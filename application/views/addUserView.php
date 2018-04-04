<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h2>Rejestracja</h2>
  <form action="<?php echo site_url();?>/registerF" method="POST">
        <div class="form-group">
          <label for="login">Login:</label>
          <input type="text" class="form-control" id="login" placeholder="Wpisz login" name="login" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="password">Hasło:</label>
          <input type="password" class="form-control" id="password" placeholder="Wpisz hasło" name="password" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="imie">Imię:</label>
          <input type="text" class="form-control" id="imie" placeholder="Wpisz swoje imię" name="imie" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="nazwisko">Nazwisko:</label>
          <input type="text" class="form-control" id="nazwisko" placeholder="Wpisz swoje nazwisko" name="nazwisko" required minlength="3">
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
          <input type="number" class="form-control" id=wiek" placeholder="Wpisz swój wiek" name="wiek" required>
        </div><br>
        <div class="form-group">
          <label for="ulica">Ulica:</label>
          <input type="text" class="form-control" id="ulica" placeholder="Wpisz swoją ulice" name="ulica" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="kod">Kod Pocztowy:</label>
          <input type="text" class="form-control" pattern="^[0-9]{2}-[0-9]{3}$" id="kod" placeholder="Wpisz swój kod pocztowy" name="kod" required >
        </div><br>
        <div class="form-group">
          <label for="poczta">Poczta:</label>
          <input type="text" class="form-control" id="poczta" placeholder="Wpisz swoją pocztę" name="poczta" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="miejscowosc">Miejscowość:</label>
          <input type="text" class="form-control" id="miejscowosc" placeholder="Wpisz swój miejscowość" name="miejscowosc" required minlength="3">
        </div><br>
        <div class="form-group">
          <label for="adres">Adres:</label>
          <input type="text" class="form-control" id="adres" placeholder="Wpisz swój adres" name="adres" required >
        </div><br>
        <div class="form-group">
            <label for="password">Województwo:</label>
            <select name="woj">
                <option value="Dolnośląskie">Dolnośląskie</option>
                <option value="Kujawsko-Pomorskie">Kujawsko-Pomorskie</option>
                <option value="Lubelskie">Lubelskie</option>
                <option value="Lubuskie">Lubuskie</option>
                <option value="Łódzkie">Łódzkie</option>
                <option value="Małopolskie">Małopolskie</option>
                <option value="Mazowieckie">Mazowieckie</option>
                <option value="Opolskie">Opolskie</option>
                <option value="Podkarpackie">Podkarpackie</option>
                <option value="Podlaskie">Podlaskie</option>
                <option value="Pomorskie">Pomorskie</option>
                <option value="Śląskie">Śląskie</option>
                <option value="Świętokrzyskie">Świętokrzyskie</option>
                <option value="Warmińsko-Mazurskie">Warmińsko-Mazurskie</option>
                <option value="Wielkopolskie">Wielkopolskie</option>
                <option value="Zachodniopomorskie">Zachodniopomorskie</option>
            </select>
        </div><br>
        <button type="submit" class="btn btn-default">Zarejestruj</button>
  </form>
</div>