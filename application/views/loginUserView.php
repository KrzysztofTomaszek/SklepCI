<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div style="align-items: center;">
	  <h2>Logowanie</h2>
	  <form action="<?php echo site_url();?>/loginF" method="POST">
	    <div>
	      <label for="login">Login:</label>
	      <input type="text" class="form-control" id="login" placeholder="Wpisz login" name="login" minlength="3" required>
	    </div><br>
	    <div>
	      <label for="password">Hasło:</label>
	      <input type="password" class="form-control" id="password" placeholder="Wpisz hasło" name="password" minlength="3" required>
	    </div>  <br>
	    <button type="submit">Zaloguj</button>
	  </form>
	</div>