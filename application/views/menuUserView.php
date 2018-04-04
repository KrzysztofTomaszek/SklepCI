<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">Sklep Dobrej Nadzieii</a>
        </div>
        <ul class="nav navbar-nav">
            <li>
                <form id="katForm" action="<?php echo site_url(); ?>/categoryPageLG" method="get" style="padding-top: 2vh">
                    <?php echo $category;?>
                    <button style="color: white;background-color: #999999;border-color: #999999;" class="btn" type="submit">Wyświetl Produkty</button>
                </form>
            </li>
            <li><a href="<?php echo site_url().'/status'?>">Moje Zamówienia</a></li>
            <li><a href="<?php echo site_url().'/edit'?>">Edytuj Dane</a></li>
            <li><a href="<?php echo site_url().'/cart';?>">Koszyk</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url().'/logout'?>"><span class="glyphicon glyphicon-log-out"></span>Wyloguj</a></li>
        </ul>
    </div>
</nav>
