<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div>
    <h3>Transakcja numer <?php echo $numerTrans;?></h3>
    <h4>Status transakcji: <?php echo $opisTrans;?></h4>
    <h4>Data aktualizacji statusu: <?php echo $data;?></h4>
</div>
<button class="btn btn-primary" style="display: inline;" onclick="szczegoly<?php echo $numerTrans;?>W()" id="szczegoly<?php echo $numerTrans;?>W">Więcej szczegółów transakcji</button>
<button class="btn btn-primary" style="display: none;" onclick="szczegoly<?php echo $numerTrans;?>M()" id="szczegoly<?php echo $numerTrans;?>M">Mniej szczegółów transakcji</button>
<script>
    function szczegoly<?php echo $numerTrans;?>W()
    {
        $("#szczegoly<?php echo $numerTrans;?>ID").css("display","inline");
        $("#szczegoly<?php echo $numerTrans;?>W").css("display","none");
        $("#szczegoly<?php echo $numerTrans;?>M").css("display","inline");
    }
    function szczegoly<?php echo $numerTrans;?>M()
    {
        $("#szczegoly<?php echo $numerTrans;?>ID").css("display","none");
        $("#szczegoly<?php echo $numerTrans;?>W").css("display","inline");
        $("#szczegoly<?php echo $numerTrans;?>M").css("display","none");
    }
</script>
<div style="display: none;" id="szczegoly<?php echo $numerTrans;?>ID">
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
        </tbody>
    </table>
</div>
<br><br>