<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <center style="padding: 3vh;">
    <div style="display: inline-block; margin-right: 5vw">
      <h1>Dodawanie </h1><br>
      <div>
        <h2>Dodawanie Kategorii</h2>
        <form method="GET" action="<?php echo site_url();?>/addKat/">
          <label for="Kat">Nazwa Kategorii:</label>
          <input type="text" id="Kat" name="Kategoria" placeholder="Wpisz nazwe kategorii" required minlength="2"><br><br>
          <button type="submit">Dodaj Kategorie</button>
        </form>
      </div>
        <br><hr><br>
      <div>
        <h2>Dodawanie Podkategorii</h2>
        <form method="GET" action="<?php echo site_url();?>/addPodKat/">
          <label for="Kat">Nazwa Kategorii:</label>
          <select name="Kategoria" id="Kat">
            <?php echo $kategorie;?>
          </select><br><br>
          <label for="PodKat">Nazwa Podkategorii:</label>
          <input type="text" id="PodKat" name="PodKategoria" placeholder="Wpisz nazwe podkategorii" required minlength="2"><br><br>
          <button type="submit">Dodaj Podkategorie</button>
        </form>
      </div>
    </div>
    <div style="display: inline-block; ">
      <h1>Edytowanie</h1>
      <div>
        <h2>Edytowanie Kategorii</h2>
        <form method="GET" action="<?php echo site_url();?>/editKat/">
          <label for="ssKat">Nazwa Kategorii:</label>
          <select name="stKategoria" id="ssKat">
            <?php echo $kategorie;?>
          </select><br><br>
          <label for="nKat">Nowa Nazwa Kategorii:</label>
          <input type="text" id="nKat" name="nKategoria" placeholder="Wpisz nazwe kategorii" required minlength="2"><br><br>
          <button type="submit">Edytuj Kategorie</button>
        </form>
      </div>
        <hr>
      <div>
        <h2>Edytowanie Podkategorii</h2>
        <form method="GET" action="<?php echo site_url();?>/editPodKat/">
          <?php echo $kategorieS;?><br><br>
          <label for="nPKat">Nowa Nazwa Podkategorii:</label>
          <input type="text" id="nPKat" name="nPodkategoria" placeholder="Wpisz nazwe podkategorii" required minlength="2"><br><br>
          <button type="submit">Edytuj Podkategorie</button>
        </form>
      </div>
    </div>
  </center>