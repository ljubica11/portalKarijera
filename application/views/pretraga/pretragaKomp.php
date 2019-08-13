<!DOCTYPE html>
<div class="pretraga-wrapper scroll" id="pretraga-res-komp">
    <form method="GET" name="pretragaKompanijaForma" class="searchForm">
    <div class="form-group">
      <label for="naziv">Naziv kompanije</label>
      <input type="text" class="form-control" id="naziv" placeholder="Naziv" name="naziv">
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="sediste">Sediste</label>
                <select id="sediste" name="mesto" class="form-control">
                    <option selected disabled value="">Izaberite grad</option> 
                    <?php foreach ($gradovi as $grad){
                        $idGra = $grad['idGra'];
                        $naziv = $grad['naziv'];
                        echo "<option value='$idGra'>$naziv</option>";
                    }   ?>
                </select>
        </div>
        <div class="form-group col-6">
             <label for="oblast">Oblast delovanja</label>
              <input type="text" class="form-control" id="oblast" placeholder="Oblast delovanja" name="oblast">
        </div>
    </div>
    <div class="form-row">
    <div class="col-12">
        <br/>
        <input type="button" class="btn btn-lg btn-primary btn-pretrazi" onclick="pretraziKompanije()" value="Pretrazi">
    </div>
</div>
    </form>
</div>
