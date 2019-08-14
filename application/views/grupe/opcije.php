<!DOCTYPE html>
<?php  
  
?>
<?php if(isset($kursevi)){ ?>
<select name="kurs" class="form-control">  
    <option disabled selected value="">Odaberite kurs</option>
    <?php
     foreach ($kursevi as $k){
         $idKurs = $k['idKurs'];
         $naziv = $k['naziv'];
         echo "<option value='$idKurs'>$naziv</option>";
     }
     ?>
</select>

<?php } else if(isset($grad)){ ?>
<select name="grad" class="form-control">  
    <option disabled selected value="">Odaberite grad</option>
    <?php
         foreach ($grad as $g){
             $idGra = $g['idGra'];
             $naziv = $g['naziv'];
             echo "<option value='$idGra'>$naziv</option>";
         }?>
</select>
<?php } else if(isset ($vestine)){ ?>
<select name="vestine" class="form-control">  
    <option disabled selected value="">Odaberite veštinu</option>
    <?php
         foreach ($vestine as $v){
             $idVes = $v['idVes'];
             $naziv = $v['naziv'];
             echo "<option value='$idVes'>$naziv</option>";
         }?>
</select>
<?php } else if(isset ($fakultet)){ ?>
<select name="fakultet" class="form-control">  
    <option disabled selected value="">Odaberite fakultet</option>
    <?php
         foreach ($fakultet as $f){
             $idFak = $f['idFak'];
             $naziv = $f['naziv'];
             echo "<option value='$idFak'>$naziv</option>";
         }?>
</select>
<?php } else if(isset ($interesovanja)){ ?>
<select name="interesovanja" class="form-control">  
    <option disabled selected value="">Odaberite interesovanje</option>
    <?php
         foreach ($interesovanja as $inter){
             $idInt = $inter['idInt'];
             $naziv = $inter['naziv'];
             echo "<option value='$idInt'>$naziv</option>";
         }?>
</select>
<?php } 