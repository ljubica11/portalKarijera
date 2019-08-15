<!DOCTYPE html>



<div id="parametri"> 

    <h5>Izaberi parametre</h5>



    <div id="upitiForma">
        <form name="upitiSpajanje" method="POST" action="<?php echo site_url('Grupe/upiti') ?>">

            <input type="checkbox"  name="upiti[]" value="kursgrupe" onclick="ispisiOpcije(value)">Po kursu<br>
            <div id="kursgrupe"> </div>
            <input type="checkbox" name="upiti[]" value="gradgrupe" onclick="ispisiOpcije(value)">Po gradu<br>
            <div id="gradgrupe"></div>
            <input type="checkbox" name="upiti[]" value="fakultetgrupe"onclick="ispisiOpcije(value)">Po fakultetu<br>
            <div id="fakultetgrupe"></div>
            <input type="checkbox" name="upiti[]" value="vestinegrupe"onclick="ispisiOpcije(value)">Po vestinama<br>
            <div id="vestinegrupe"></div>
            <input type="checkbox" name="upiti[]" value="interesovanjagrupe"onclick="ispisiOpcije(value)">Po interesovanjima<br>
            <div id="interesovanjagrupe"></div>
            <input type="checkbox" name="upiti[]" value="statusgrupe"onclick="ispisiOpcije(value)">Po statusu<br>
            <div id="statusgrupe"></div>
           
            <?php
            echo
            "<input type ='hidden' name='idGru' value=$idGru>" .
            "<input type='submit' name='opcije' value='dodaj' class='btn btn-outline-primary btn-sm'>"
            ?>

        </form>
    </div>   


</div>