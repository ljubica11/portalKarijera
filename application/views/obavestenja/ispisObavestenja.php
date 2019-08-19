<!DOCTYPE html>

<?php foreach ($obavestenja as $obavestenje) {?>
    <div class='centar'>
        <b> Naslov: </b> <?php echo $obavestenje['naslov']; ?> <br>
        <b> Tekst: </b> <?php echo $obavestenje['tekst']; ?> <br>
        <b> Datum: </b> <?php echo  substr($obavestenje['datum'], 0, 10); ?> <br>
        <b> Autor: </b> <?php echo $obavestenje['naziv'] ?> <br>
        <button type="submit" class="btn btn-outline-primary pull-right" >Arhiviraj</button>
    </div>
<?php }?>