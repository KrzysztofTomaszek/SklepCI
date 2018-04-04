<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="block">
        <div class="top">
            <ul>
                <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                <li><span class="converse"><?php echo $nazwa;?></span></li>
                <li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    </a></li>
            </ul>
        </div>
        <div class="middle">
            <a href="<?php echo site_url().'/product/'.$IDprodukty;?>">
            <img  width="320" height="256" src="<?php  echo base_url().$imageLink;?>" alt="Zdjęcie" />
            </a>
        </div>
        <div class="bottom">
            <div class="heading"></div>
            <div class="style"><b> Cena: <?php echo round(($cenaNetto+($cenaNetto*$VAT)), 2);?> zł</b></div>
            <div class="price">Cena Netto: <?php echo $cenaNetto;?> zł</div>
            <div class="info">VAT: <?php echo $VAT*100;?>%</div>
        </div>
</div>