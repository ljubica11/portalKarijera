<!DOCTYPE html>
<?php if(isset($tip) and $tip == "mesto"){ ?>
<select class="form-control" name="mesto" onchange="dodajInput('mesto')" id="listamesto"> 
            <option disabled value="">Mesto</option>
              <?php 
            foreach ($mesta as $mesto){
                $naziv = $mesto["naziv"];
                $idG = $mesto["idGra"];
                if($naziv == $novo){
                    echo "<option value='$idG' selected>$naziv</option>";
                }else{
                    echo "<option value='$idG'>$naziv</option>"; 
                }
            }
            ?>
           <option class="dodaj" value="dodaj">Dodaj novo mesto</option>
</select>
<?php } else if(isset($tip) and $tip == "sediste"){ ?>
<select class="form-control" name="sediste" id="listasediste" onchange="dodajInput('sediste')">
    <option disabled value="">Sediste</option>
    <?php 
           foreach ($mesta as $mesto){
                $naziv = $mesto["naziv"];
                $idG = $mesto["idGra"];
                if($naziv == $novo){
                    echo "<option value='$idG' selected>$naziv</option>";
                }else{
                    echo "<option value='$idG'>$naziv</option>"; 
                }
            }
            ?>
    <option value="dodaj">Dodaj grad</option>
</select>
            
    
<?php } else if(isset($fakulteti)){ ?>
<select class="form-control" name="fakultet" id="listafakultet" onchange="dodajInput('fakultet')">
    <option disabled value="">Odaberite fakultet</option>
    <?php 
            foreach ($fakulteti as $fakultet){
                $naziv = $fakultet["naziv"];
                $idFak = $fakultet["idFak"];
                if($naziv == $novo){
                  echo "<option value='$idFak' selected>$naziv</option>";  
                }else{
                  echo "<option value='$idFak'>$naziv</option>";
               }
            }
            ?>
    <option value="dodaj">Dodaj fakultet</option>
</select>
<?php } else if(isset($kompanije)){ ?>
<select class="form-control" name="kompanija" id="listakompanija" onchange="dodajInput('kompanija')">
    <option disabled value="">Odaberite kompaniju</option>
    <?php 
            foreach ($kompanije as $kompanija){
                $naziv = $kompanija["naziv"];
                $idKom = $kompanija["idSifKo"];
                if($naziv == $novo){
                  echo "<option value='$idKom' selected>$naziv</option>";
                }else{
                  echo "<option value='$idKom'>$naziv</option>";
                   }
                }
                ?>
    <option value="dodaj">Dodaj kompaniju</option>
</select>

<?php } else if(isset ($pozicije)){ ?>
<select class="form-control" name="pozicija" id="listapozicija" onchange="dodajInput('pozicija')">
    <option disabled value="">Odaberite poziciju</option>
                    <?php 
                            foreach ($pozicije as $pozicija){
                                $naziv = $pozicija["naziv"];
                                $idPoz = $pozicija["idPoz"];
                                if($naziv == $novo){
                                    echo "<option value='$idPoz' selected>$naziv</option>";
                                }else{
                                echo "<option value='$idPoz'>$naziv</option>";
                                }
                            }
                            ?>
    <option value="dodaj">Dodaj poziciju</option>
</select>
<?php } ?>




