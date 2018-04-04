<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div>
    <h3>Użytkownik: <?php echo $user->login;?></h3>
    <h4>Ilość transakcji: <?php echo $numerTrans;?></h4>
</div>
<button class="btn btn-primary" style="display: inline;" onclick="szczegolyUser<?php echo $user->IDuzytkownicy;?>W()" id="szczegolyUser<?php echo $user->IDuzytkownicy;?>W">Wyświetl dane użytkownika</button>
<button class="btn btn-primary" style="display: none;" onclick="szczegolyUser<?php echo $user->IDuzytkownicy;?>M()" id="szczegolyUser<?php echo $user->IDuzytkownicy;?>M">Schowaj dane użytkownika</button>
<br>
<script>
    function szczegolyUser<?php echo $user->IDuzytkownicy;?>W()
    {
        $("#szczegolyUser<?php echo $user->IDuzytkownicy;?>ID").css("display","inline");
        $("#szczegolyUser<?php echo $user->IDuzytkownicy;?>W").css("display","none");
        $("#szczegolyUser<?php echo $user->IDuzytkownicy;?>M").css("display","inline");
    }
    function szczegolyUser<?php echo $user->IDuzytkownicy;?>M()
    {
        $("#szczegolyUser<?php echo $user->IDuzytkownicy;?>ID").css("display","none");
        $("#szczegolyUser<?php echo $user->IDuzytkownicy;?>W").css("display","inline");
        $("#szczegolyUser<?php echo $user->IDuzytkownicy;?>M").css("display","none");
    }
</script>
<br>
<div style="display: none;" id="szczegolyUser<?php echo $user->IDuzytkownicy;?>ID">
    <div class="container">
        <div class="row">
            <div class="col-md-5" style="margin-left: 15%">
                <div class="panel panel-default" style="margin-left: 5vw">
                    <div class="panel-body">
                        <div class="box box-info">
                            <div class="col-sm-5  tital " >Imię:</div><div class="col-sm-7"><?php echo $user->imie;?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5  tital " >Nazwisko:</div><div class="col-sm-7"> <?php echo $user->nazwisko;?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5  tital " >Ulica:</div><div class="col-sm-7"><?php echo $user->ulica;?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5  tital " >Kod Pocztowy:</div><div class="col-sm-7"><?php echo $user->kodPocztowy;?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 tital " >Poczta:</div><div class="col-sm-7"><?php echo $user->poczta;?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 tital " >Miejscowość:</div><div class="col-sm-7"><?php echo $user->miejscowosc;?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5  tital " >Adres:</div><div class="col-sm-7"><?php echo $user->adres;?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<button class="btn btn-primary" style="display: inline;" onclick="szczegolyTrans<?php echo $user->IDtransakcje;?>W()" id="szczegolyTrans<?php echo $user->IDtransakcje;?>W">Wyświetl transakcje</button>
<button class="btn btn-primary" style="display: none;" onclick="szczegolyTrans<?php echo $user->IDtransakcje;?>M()" id="szczegolyTrans<?php echo $user->IDtransakcje;?>M">Schowaj transakcje</button>
<script>
    function szczegolyTrans<?php echo $user->IDtransakcje;?>W()
    {
        $("#szczegolyTrans<?php echo $user->IDtransakcje;?>ID").css("display","inline");
        $("#szczegolyTrans<?php echo $user->IDtransakcje;?>W").css("display","none");
        $("#szczegolyTrans<?php echo $user->IDtransakcje;?>M").css("display","inline");
    }
    function szczegolyTrans<?php echo $user->IDtransakcje;?>M()
    {
        $("#szczegolyTrans<?php echo $user->IDtransakcje;?>ID").css("display","none");
        $("#szczegolyTrans<?php echo $user->IDtransakcje;?>W").css("display","inline");
        $("#szczegolyTrans<?php echo $user->IDtransakcje;?>M").css("display","none");
    }
</script>
<div style="display: none;" id="szczegolyTrans<?php echo $user->IDtransakcje;?>ID">
    <?php echo $content;?>
</div>
<br><br>