<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/gallery.css">
    <div class="container">
        <div class="row">
            <div class="col-md-20">
                <div class="panel panel-default  panel--styled">
                    <div class="panel-body">
                        <div class="col-md-12 panelTop">
                            <div class="col-md-4">
                                <img class="img-responsive" src="<?php echo base_url().$imageLink;?> " alt=""/>
                            </div>
                            <div class="col-md-8">
                                <h2><?php echo $nazwa;?></h2>
                                <p><?php echo $opisProduktu;?></p>
                            </div>
                        </div>

                        <div class="col-md-12 panelBottom">
                            <div class="col-md-4 text-center">
                                <?php echo $buy;?>
                            </div>
                            <div class="col-md-4 text-left">
                                <h3>Cena: <span class="itemPrice"><?php echo round(($cenaNetto+($cenaNetto*$VAT)), 2); ?> zł</span></h3>
                                <h6>Cena Netto: <?php echo $cenaNetto;?> zł</h6>
                                <h6>VAT: <?php echo $VAT*100;?>%</h6>
                            </div>
                            <div class="col-md-4 text-left">
                                <h3>Pozostało: <span class="itemPrice"><?php echo  $ilosc_cala-$ilosc_zarezerwowana;?> </span> sztuk</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>