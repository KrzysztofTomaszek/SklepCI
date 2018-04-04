<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div>
    <h4>Transakcja numer <?php echo $numerTrans;?></h4>
</div>
<form action="<?php echo site_url().'/editStatusF/'.$statusID;?>?>" method="get" id="statusNr<?php echo $numerTrans;?>User<?php echo $user;?>Form">
    <label>Status transakcji:</label>
    <select class="form-control" style="width: 20vw;" <?php echo $disable;?> id="statusNr<?php echo $numerTrans;?>User<?php echo $user;?>" name="statusN">
        <?php echo $status;?>
    </select>
</form>
<script>
    $(document).ready(function(){
        $( "#statusNr<?php echo $numerTrans;?>User<?php echo $user;?>").change(function () {
            $( "#statusNr<?php echo $numerTrans;?>User<?php echo $user;?>Form").submit();
        });
    });
</script>
<h6>Data aktualizacji statusu: <?php echo $data;?></h6>
<br>
<button class="btn btn-primary" style="display: inline;" onclick="szczegoly<?php echo $numerTrans.$user;?>W()" id="szczegoly<?php echo $numerTrans.$user;?>W">Więcej szczegółów transakcji</button>
<button class="btn btn-primary" style="display: none;" onclick="szczegoly<?php echo $numerTrans.$user;?>M()" id="szczegoly<?php echo $numerTrans.$user;?>M">Mniej szczegółów transakcji</button>
<script>
    function szczegoly<?php echo $numerTrans.$user;?>W()
    {
        $("#szczegoly<?php echo $numerTrans.$user;?>ID").css("display","inline");
        $("#szczegoly<?php echo $numerTrans.$user;?>W").css("display","none");
        $("#szczegoly<?php echo $numerTrans.$user;?>M").css("display","inline");
    }
    function szczegoly<?php echo $numerTrans.$user;?>M()
    {
        $("#szczegoly<?php echo $numerTrans.$user;?>ID").css("display","none");
        $("#szczegoly<?php echo $numerTrans.$user;?>W").css("display","inline");
        $("#szczegoly<?php echo $numerTrans.$user;?>M").css("display","none");
    }
</script>
<div style="display: none;" id="szczegoly<?php echo $numerTrans.$user;?>ID">
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