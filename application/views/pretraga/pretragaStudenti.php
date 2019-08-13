<!DOCTYPE html>

<div class="pretraga-wrapper scroll" id="pretraga-res">
    
 <form method="GET" name="pretragaStudenataForma" class="searchForm">
  <div class="form-row">
    <div class="form-group col-6">
      <label for="ime">Ime</label>
      <input type="text" class="form-control" id="ime" placeholder="Ime" name="ime">
    </div>
    <div class="form-group col-6">
      <label for="prezime">Prezime</label>
      <input type="text" class="form-control" id="prezime" placeholder="Prezime" name="prezime">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-4">
      <label for="mesto">Prebivaliste</label>
      <select id="mesto" name="mesto" class="form-control">
          <option selected disabled value="">Izaberite grad</option> 
          <?php foreach ($gradovi as $grad){
              $idGra = $grad['idGra'];
              $naziv = $grad['naziv'];
              echo "<option value='$idGra'>$naziv</option>";
          }   ?>
      </select>
    </div>
    <div class="form-group col-4">
      <label for="fakultet">Fakultet</label>
      <select id="fakultet" class="form-control" name="fakultet">
          <option selected disabled value="">Odaberite fakultet</option>
          <?php foreach ($fakulteti as $fakultet){
              $idFak = $fakultet['idFak'];
              $naziv = $fakultet['naziv'];
              echo "<option value='$idFak'>$naziv</option>";  
          } ?>
      </select>
    </div>
    <div class="form-group col-4">
      <label for="kurs">Zavrsen kurs</label>
      <select id="kurs" class="form-control" name="kurs">
          <option selected disabled value="">Odaberite kurs</option>
          <?php foreach ($kursevi as $kurs){
              $idKurs = $kurs['idKurs'];
              $naziv = $kurs['naziv'];
              echo "<option value='$idKurs'>$naziv</option>";  
          } ?>
      </select>
    </div>
  </div>
<div class="form-row">
    <div class="form-group col-6">
      <label for="interesovanja">Interesovanja</label>
      <select id="interesovanja" class="form-control" name="interesovanja">
          <option selected disabled value="">Odaberite interesovanja</option>
          <?php foreach ($interesovanja as $int){
              $idInt = $int['idInt'];
              $naziv = $int['naziv'];
              echo "<option value='$idInt'>$naziv</option>";  
          } ?>
      </select>
    </div>
    <div class="form-group col-6">
      <label for="vestine">Vestine</label>
      <select id="vestine" class="form-control" name="vestine">
          <option selected disabled value="">Odaberite vestine</option>
          <?php foreach ($vestine as $vestina){
              $idVes = $vestina['idVes'];
              $naziv = $vestina['naziv'];
              echo "<option value='$idVes'>$naziv</option>";  
          } ?>
      </select>
    </div>   
</div>
<div class="form-row">
    <div class="col-12">
        <br/>
        <input type="button" class="btn btn-lg btn-primary btn-pretrazi" onclick="pretraziStudente()" value="Pretrazi">
    </div>
</div>
 </form>
</div>
