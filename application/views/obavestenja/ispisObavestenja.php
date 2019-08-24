<!--<!DOCTYPE html>


<?php foreach ($obavestenja as $obavestenje) {?>
    <div class='centar'>
        <b> Naslov: </b> <?php //echo $obavestenje['naslov']; ?> <br>
        <b> Tekst: </b> <?php //echo $obavestenje['tekst']; ?> <br>
        <b> Datum: </b> <?php //echo  substr($obavestenje['datum'], 0, 10); ?> <br>
        <b> Autor: </b> <?php //echo $this->session->userdata('user')['korisnicko']; ?> <br>
        <?php
//        $idKor = $this->session->userdata('user')['idKor'];
//        if ($idKor == $obavestenje['autor']) {
//            $idOba = $obavestenje['idOba'];
//            $btnDisable = "";
//            if ($obavestenje['zaBrisanje'] == 'da') { ?>
                <a class="btn btn-outline-primary pull-right disabled" href="<?php //echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhivirano </a>
            <?php //}
            //else { ?>
                <a class="btn btn-outline-primary pull-right" href="<?php //echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhiviraj </a>
            <?php //}
        //} ?>
        
        Neuspeli pokusaji arhiviranja
        <a href='#' onclick='arhiObav(8)'> Arhiviraj </a>
        <button class="btn btn-outline-primary pull-right" onclick="<?php// echo site_url('Obavestenja/arhivirajObavestenje(8)'); ?>">Arhiviraj</button>
        <button class="btn btn-outline-primary pull-right" onclick="arhiObav">Arhiviraj</button>
        <input type='button' class="btn btn-outline-primary pull-right" onclick="arhiObav(<?php //echo $obavestenje['idOba']; ?>)">Arhiviraj</button>
    </div>
<?php }?>

<script>
    function arhiObav() {
        alert('cavo!');
        //$this->Obavestenja->arhivirajObavestenje($idOba);
    }
</script>
-->
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

<?php
        $idKor = $this->session->userdata('user')['idKor'];
        if ($idKor == $obavestenje['autor']) {
            $idOba = $obavestenje['idOba'];
            $btnDisable = "";
            if ($obavestenje['zaBrisanje'] == 'da') { ?>
                <a class="btn btn-outline-primary pull-right disabled" href="<?php echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhivirano </a>
            <?php }
            else { ?>
                <a class="btn btn-outline-primary pull-right" href="<?php echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhiviraj </a>
            <?php }
        } ?>

