<!DOCTYPE html>
<div class="infoStudije">
Podaci o fakultetu
<br/>

<select name="univerzitet">
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
<select name="fakultet" id="listafakultet" onchange="dodajInput('fakultet')">
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
<div id="selectsediste">
<select name="sediste" id="listasediste" onchange="dodajInput('sediste')">
    <option disabled selected value="">Sediste fakulteta</option>
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
Nivo studija: 
<br/>
<input type="radio" name="nivo" value="osnovne">Osnovne akademske studije<br>
<input type="radio" name="nivo" value="master">Master akademske studije<br>
<input type="radio" name="nivo" value="specijalisticke">Specijalisticke akademske studije<br>
<input type="radio" name="nivo" value="doktorske">Doktorske akademske studije<br>
<input type="radio" name="nivo" value="strukovne">Strukovne studije<br>

<input type="number" name="godinaStudija" placeholder="Godina studija">
<br/>
</div>

 
    
    