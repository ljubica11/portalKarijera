<!DOCTYPE html>

<?php if(isset($kursevi)){ ?>
<select name="odabraniKurs">  
    <option disabled selected value="">Odaberite kurs</option>
    <?php
     foreach ($kursevi as $kurs){
         $idKurs = $kurs['idKurs'];
         $naziv = $kurs['naziv'];
         echo "<option value='$idKurs'>$naziv</option>";
     }
     ?>
</select>
<?php }else if(isset($grupe)){ ?>
<select name="odabranaGrupa">  
    <option disabled selected value="">Odaberite grupu</option>
    <?php
         foreach ($grupe as $grupa){
             $idGru = $grupa['idGru'];
             $naziv = $grupa['naziv'];
             echo "<option value='$idGru'>$naziv</option>";
         }?>
</select>
<?php } else if(isset($grad)){ ?>
<select name="odabraniGrad">  
    <option disabled selected value="">Odaberite grupu</option>
    <?php
         foreach ($grad as $g){
             $idGra = $g['idGra'];
             $naziv = $g['naziv'];
             echo "<option value='$idGra'>$naziv</option>";
         }?>
</select>
<?php } 

