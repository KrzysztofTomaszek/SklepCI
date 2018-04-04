<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <h2><?php echo $error;?></h2>
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Ilość</th>
                    <th class="text-center">Cena</th>
                    <th class="text-center">Suma</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                    <?php echo $content;?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Koszt towarów</h5></td>
                        <td class="text-right"><h5><strong><?php echo round($kosztTow, 2);?> zł</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Koszt wysyłki</h5></td>
                        <td class="text-right"><h5><strong><?php echo round($kosztWys, 2);?> zł</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Sumaryczny koszt kupna</h3></td>
                        <td class="text-right"><h3><strong><?php echo round($kosztSum, 2);  ?> zł</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        </td>
                        <td>
                            <a href="<?php echo site_url();?>/checkout">
                                <button type="button" class="btn btn-success">
                                    Kupuj <span class="glyphicon glyphicon-play"></span>
                                </button>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>