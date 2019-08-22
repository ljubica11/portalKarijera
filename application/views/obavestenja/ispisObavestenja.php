<!DOCTYPE html>

<?php foreach ($obavestenja as $obavestenje) {?>
    <div class='centar'>
        <b> Naslov: </b> <?php echo $obavestenje['naslov']; ?> <br>
        <b> Tekst: </b> <?php echo $obavestenje['tekst']; ?> <br>
        <b> Datum: </b> <?php echo  substr($obavestenje['datum'], 0, 10); ?> <br>
        <b> Autor: </b> <?php echo $this->session->userdata('user')['korisnicko']; ?> <br>
        <?php $idOba = $obavestenje['idOba']; ?>
        <a class="btn btn-outline-primary pull-right" href="<?php echo site_url('Obavestenja/arhivirajObavestenje/'.$idOba); ?>"> Arhiviraj </a>
        <!--<a href='#' onclick='arhiObav(8)'> Arhiviraj </a>-->
        <!--<button class="btn btn-outline-primary pull-right" onclick="<?php echo site_url('Obavestenja/arhivirajObavestenje(8)'); ?>">Arhiviraj</button>-->
        <!--<button class="btn btn-outline-primary pull-right" onclick="arhiObav">Arhiviraj</button>-->
        <!--<input type='button' class="btn btn-outline-primary pull-right" onclick="arhiObav(<?php echo $obavestenje['idOba']; ?>)">Arhiviraj</button>-->
    </div>
<?php }?>
<!--
<script>
    function arhiObav() {
        alert('cavo!');
        //$this->Obavestenja->arhivirajObavestenje($idOba);
    }
</script>-->