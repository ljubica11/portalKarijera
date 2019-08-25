<!DOCTYPE html>
<div class="infoStudije">
Podaci o fakultetu
<br/>

<select class="form-control" name="univerzitet">
     <option disabled selected value="">Odaberite univerzitet</option>
     <?php 
            foreach ($univerziteti as $uni){
                $naziv = $uni["naziv"];
                $idUni = $uni["idUni"];
                echo "<option value='$idUni'>$naziv</option>";
            }
            ?>
</select>

<br/>
<div id="selectfakultet">
<select class="form-control" name="fakultet" id="listafakultet" onchange="dodajInput('fakultet')">
    <option disabled selected value="">Odaberite fakultet</option>
    <?php 
            foreach ($fakulteti as $fakultet){
                $naziv = $fakultet["naziv"];
                $idFak = $fakultet["idFak"];
                echo "<option value='$idFak'>$naziv</option>";
            }
            ?>
    <option value="dodaj">Dodaj fakultet</option>
</select>
</div>
<div id="fakultet">   
</div>
<br/>
<div id="selectsediste">
<select class="form-control" name="sediste" id="listasediste" onchange="dodajInput('sediste')">
    <option disabled selected value="">Sedište fakulteta</option>
    <?php 
            foreach ($gradovi as $grad){
                $naziv = $grad["naziv"];
                $idGra = $grad["idGra"];
                echo "<option value='$idGra'>$naziv</option>";
            }
            ?>
    <option value="dodaj">Dodaj grad</option>
</select>
</div>
<div id="sediste">  
</div>
<br/>
<div class="text-left">
<b>Nivo studija: </b><br/>
<input type="radio" name="nivo" value="osnovne">Osnovne akademske studije<br>
<input type="radio" name="nivo" value="master">Master akademske studije<br>
<input type="radio" name="nivo" value="specijalisticke">Specijalističke akademske studije<br>
<input type="radio" name="nivo" value="doktorske">Doktorske akademske studije<br>
<input type="radio" name="nivo" value="strukovne">Strukovne studije<br>
</div>
<br/>
<input class="form-control" type="number" name="godinaStudija" placeholder="Godina studija">
<br/>
</div>

 
    
    