<!DOCTYPE html>

<!--Ispisivanje obavestenja iz prosledjene promenljive $obavestenja-->
<div class="datum">
 Datum postavljanja: <?php echo  substr($obavestenja[0]['datum'], 0, 10); ?>
</div>
<br>
<h4><?php echo $obavestenja[0]['naslov']; ?></h4>
<br/>
<div class="sadrzaj">
    <?php echo $obavestenja[0]['tekst']; ?>
</div>
<br/>
<div class="autor">
Autor: <?php echo $obavestenja[0]['naziv'] ?>
</div>

<!--Prikazivanje dugmeta za arhiviranje-->
<?php
        $idKor = $this->session->userdata('user')['idKor'];
        if ($idKor == $obavestenja[0]['autor']) {
            $idOba = $obavestenja[0]['idOba'];
            $btnDisable = "";
            if ($obavestenja[0]['zaBrisanje'] == 'da') { ?>
                <a class="btn btn-outline-primary pull-right disabled" href="<?php echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhivirano </a>
            <?php }
            else { ?>
                <a class="btn btn-outline-primary pull-right" href="<?php echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhiviraj </a>
            <?php }
        } ?>