<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<tr>
    <td class="col-sm-8 col-md-6">
        <div class="media">
            <a class="thumbnail pull-left" href="<?php echo site_url().'/product/'.$IDprodukty;?>"> <img class="media-object" src="<?php echo base_url().$imageLink;?>" style="width: 72px; height: 72px;"> </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="<?php echo site_url().'/product/'.$IDprodukty;?>"><?php echo $nazwa;?></a></h4>
                <span>Kategoria: </span><span class="text-success"><strong><?php echo $nazwaKategorii;?></strong></span>
                <h5 class="media-heading"> Podkategoria: <a href="<?php echo site_url().'/categoryPage/'.$IDkategoria.'/'.$IDpodkategoria.'/1';?>"><?php echo $nazwaPodkategorii;?></a></h5>
            </div>
        </div>
    </td>
    <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $iloscElementow;?></strong></td>
    <td class="col-sm-1 col-md-1 text-center"><strong><?php  echo round(($cenaNetto+($cenaNetto*$VAT)), 2);?></strong></td>
    <td class="col-sm-1 col-md-1 text-center"><strong><?php  echo $iloscElementow*round(($cenaNetto+($cenaNetto*$VAT)), 2);?></strong></td>
    <td class="col-sm-1 col-md-1"></td>
</tr>