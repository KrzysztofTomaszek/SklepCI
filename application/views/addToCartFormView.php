<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form action="<?php echo site_url().'/addToCart/'.$IDprodukty?>" method="get" id="dodForm">
    <label for="ile">Ile sztuk:</label>
    <input type="number" id="ile" name="ile" placeholder="Podaj ilość sztuk" value="1" min="1" max="<?php echo  $ilosc_cala-$ilosc_zarezerwowana;?>"><br><br>
    <script>
        $(document).ready(function(){
            $( "#dodBut" ).click(function ()
            {
                if($( "#ile" ).val()>0)
                {
                   if($( "#ile" ).val()<=<?php echo  $ilosc_cala-$ilosc_zarezerwowana;?> )
                    {
                        $( "#dodForm" ).submit();
                    }
                    else
                    {
                        alert('Nie możesz włożyć do koszyka większej ilości niż jest dostępna.')
                    }
                }
                else
                {
                    alert('Nie możesz włożyć do koszyka niczego lub ujemnej ilości.')
                }              


            });
        });
    </script>
    <button id='dodBut' class="btn btn-lg btn-add-to-cart" type="button"><span class="glyphicon glyphicon-shopping-cart"></span>Do Koszyka</button>
</form>