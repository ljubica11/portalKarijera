<!DOCTYPE html>

<?php foreach ($obavestenja as $obavestenje) {?>
    <div class='centar'>
        <b> Naslov: </b> <?php echo $obavestenje['naslov']; ?> <br>
        <b> Tekst: </b> <?php echo $obavestenje['tekst']; ?> <br>
        <b> Datum: </b> <?php echo $obavestenje['datum']; ?> <br>
        <b> Autor: </b> <?php echo  $obavestenje['autor']; ?> <br>
    </div>
<?php }?>