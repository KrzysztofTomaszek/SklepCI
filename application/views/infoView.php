<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
  echo $header;
  echo $menu;
?>
  <center style="padding: 3vh;">
    <?php echo $content;?>
    <br><a href="<?php echo site_url();?>"><button class="btn btn-info">Na Stronę Główną</button></a>
  </center> 
<?php echo $footer;?>