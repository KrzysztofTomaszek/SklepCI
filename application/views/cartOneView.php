<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<tr>
    <td class="col-sm-8 col-md-6">
        <div class="media">
            <a class="thumbnail pull-left" href="<?php echo site_url().'/product/'.$IDprodukty;?>"> <img class="media-object" src="<?php echo base_url().$imageLink;?>" style="width: 72px; height: 72px;"> </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="<?php echo site_url().'/product/'.$IDprodukty;?>#"><?php echo $nazwa;?></a></h4>
                <span>Kategoria: </span><span class="text-success"><strong><?php echo $nazwaKategorii;?></strong></span>
                <h5 class="media-heading"> Podkategoria: <a href="<?php echo site_url().'/categoryPage/'.$IDkategoria.'/'.$IDpodkategoria.'/1';?>"><?php echo $nazwaPodkategorii;?></a></h5>
            </div>
        </div>
    </td>
    <td class="col-sm-1 col-md-1" style="text-align: center">
        <form action="<?php echo site_url();?>/cartAct/<?php echo $IDprodukty;?>" method="post" id="form<?php echo $IDprodukty;?>">
        <input type="number" style="width: 4em;" class="form-control" min="0" id="ilosc<?php echo $IDprodukty;?>" name="ilosc" value="<?php echo $iloscElementow;?>"">
        </form>
        <script>
            $(document).ready(function(){
                $( "#ilosc<?php echo $IDprodukty;?>" ).change(function ()
                {
                    if($( "#ilosc<?php echo $IDprodukty;?>" ).val()>=0)
                    {
                        $( "#form<?php echo $IDprodukty;?>" ).submit();
                    }
                    else
                    {
                        alert('Nie możesz włożyć do koszyka ujemnej ilości.')
                    }

                });
            });
        </script>
    </td>
    <td class="col-sm-1 col-md-1 text-center"><strong><?php  echo round(($cenaNetto+($cenaNetto*$VAT)), 2);?></strong></td>
    <td class="col-sm-1 col-md-1 text-center"><strong><?php  echo $iloscElementow*round(($cenaNetto+($cenaNetto*$VAT)), 2);?></strong></td>
    <td class="col-sm-1 col-md-1">
        <a href="<?php echo site_url();?>/cartRemove/<?php echo $IDprodukty;?>">
            <button type="button" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span> Usuń
            </button>
        </a>
    </td>
</tr>