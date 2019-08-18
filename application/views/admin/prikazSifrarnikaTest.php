<!DOCTYPE html>
<?php echo "<h4>".$naslov."</h4>" ?>
<div class="prikazResSifrarnici scroll">
    <?php
    foreach ($data as $podatak){ 
        $res = array_values($podatak);
        
        $id = $res[0];
        $naziv = $res[1];
    ?>
    
    <div class="sifrarnikStavka" id="<?php echo $id ?>">
        <?php echo $naziv ?>
        <button type="button" title="Obrisi stavku" class="btn btn-sm btn-light" onclick="obrisiStavku(<?php echo $id.",'".$tip."'" ?>)"><i class="fa fa-trash-o"></i></button>
        <button type="button" title="Izmeni stavku" class="btn btn-sm btn-light" onclick="izmeniStavku(<?php echo $id ?>)"><i class="fa fa-edit"></i></button>
    </div>
    
    <div class="sifrarnikStavka izmenaSifrarnikaInput" id="izmenaSifrarnikaInput<?php echo $id ?>">
        <input type='text' value="<?php echo $naziv ?>" class='izmenaStavke' id="izmeni<?php echo $tip; echo $id?>">
        <button title='Sacuvaj izmenu' class='btn btn-sm btn-light' onclick="sacuvajIzmenu(<?php echo "'".$tip."',".$id?>)"><i class='fa fa-check-square-o'></i></button>
        <button title="Odustani od izmene" class="btn btn-sm btn-light" onclick="odustani(<?php echo $id ?>)"><i class="fa fa-times-rectangle-o"></i></button>
    </div>
    
    <?php
    }
    ?>
</div>  
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Dodaj novu stavku" id="dodatakStavka">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="dodajStavku(<?php echo "'".$tip."'"; ?>)">Dodaj</button>
        </div>
</div>



