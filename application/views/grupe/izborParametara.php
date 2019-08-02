<!DOCTYPE html>



<div id="parametri"> 

    <?php
    /*
    foreach ($grupe as $g) {
        echo $g['idGru'];
        $idGru = $g['idGru'];
    }
   
    foreach($prebivaliste as $p){
        echo $p['idGra'];
    }
    
    foreach($kurs as $k){
        echo $k['idKurs'];
    }
    foreach ($interesovanja as $inter){
        echo $inter['idInt'].' ';
        
    }
    foreach ($vestine as $v){
        echo $v['idVes'];
    }
    */
    
    ?>
    <h5>Izaberi parametre</h5>


    <form name="izaberiMesto" method="POST" action="<?php echo site_url('Grupe/poGradu') ?>">
        <select name="idGra">
            <option disabled selected value="">Izaberi prebivaliste studenta</option>
            <?php
            foreach ($prebivaliste as $p) {
                $naziv = $p["naziv"];
                $idGra = $p["idGra"];

                echo "<option value='$idGra'>$naziv</option>";
            }


            echo
            "<input type ='hidden' name='idGru' value=$idGru>" .
            "<input type='submit' name='izborMesta' value='dodaj'   class='btn btn-outline-primary btn-sm'>"
            ?>   </select> 
    </form>


    <form name="izaberiKurs" method="POST" action="<?php echo site_url('Grupe/poKursu') ?>">
        <select name="idKurs">
            <option disabled selected value="">Izaberi kurs studenta</option>
            <?php
            foreach ($kurs as $k) {
                $naziv = $k["naziv"];
                $idKurs = $k["idKurs"];

                echo "<option value='$idKurs'>$naziv</option>";
            }
            echo
            "<input type ='hidden' name='idGru' value=$idGru>" .
            "<input type='submit' name='izborKursa' value='dodaj' class='btn btn-outline-primary btn-sm'>"
            ?>

        </select>
    </form>

    <form name="izaberiInteresovanja" method="POST" action="<?php echo site_url('Grupe/poInteresovanjima') ?>">
        <select name="idInter">
                <option disabled selected value="">Izaberi interesovanje</option>
                    <?php
                    foreach ($interesovanja as $inter) {
                        $naziv = $inter["naziv"];
                        $idInt = $inter["idInt"];

                        echo "<option value='$idInt'>$naziv</option>";
                    }
                     echo
            "<input type ='hidden' name='idGru' value=$idGru>" .
            "<input type='submit' name='izborInteresovanja' value='dodaj' class='btn btn-outline-primary btn-sm'>"
            ?>
                    
            
        </select>
    </form>
    
    <form name="izaberiVestine" method="POST" action="<?php echo site_url('Grupe/poVestinama') ?>">
        <select name="idVes">
            <option disabled selected value="">Izaberi vestine</option>
            <?php
            foreach ($vestine as $v) {
                $naziv = $v["naziv"];
                $idVes = $v["idVes"];

                echo "<option value='$idVes'>$naziv</option>";
            }


            echo
            "<input type ='hidden' name='idGru' value=$idGru>" .
            "<input type='submit' name='izborMesta' value='dodaj'   class='btn btn-outline-primary btn-sm'>"
            ?>   </select> 
    </form>
    
    <form name="izaberiFakultet" method="POST" action="<?php echo site_url('Grupe/poFakultetu') ?>">
        <select name="idFak">
            <option disabled selected value="">Završene studije</option>
            <?php
            foreach ($diploma as $d) {
                $naziv = $d["naziv"];
                $idFak = $d["idFak"];

                echo "<option value='$idFak'>$naziv</option>";
            }


            echo
            "<input type ='hidden' name='idGru' value=$idGru>" .
            "<input type='submit' name='izborFakulteta' value='dodaj'   class='btn btn-outline-primary btn-sm'>"
            ?>   </select> 
    </form>

</div>

</div>