<?php
if (isset($vesti)) {
    foreach ($vesti as $v) {
        $autor = $v['korisnik'];
        ?>

        <div class="centar" name="vesti">

            <b>Naslov: </b><a href="#" onclick="procitajVest(<?php echo $v['idVes']?>)"><?php echo $v['naziv']; ?></a></b><br/>
        <b>Autor: </b><?php echo $v['korisnik']; ?><br/>
        <b>Tekst: </b><?php echo $v['tekst']; ?><br/>
        <b>Datum vesti: </b><?php echo $v['datum']; ?><br/>
        <?php $id = $v['idVes']; ?>
        <br/>
        <?php
        if ($this->session->userdata('user')['korisnicko'] == $autor && $v['vidljivost'] != 'autor') {
            ?>
            <a class="btn btn-outline-primary btn-md" href="<?php echo site_url("Vesti/arhivirajVest/$id") ?>">Arhiviraj</a>
            <?php
        }
        ?>

        <?php
        if ($this->session->userdata('user')['korisnicko'] == $autor && $v['zaBrisanje'] !== 'da') {
            ?>
            <a class="btn btn-danger float-right" href="<?php echo site_url("Vesti/traziBrisanje/$id") ?>" onclick="return confirm('Da li ste sigurni da zelite da posaljete zahtev za brisanje ove vesti?')"><i class="fa fa-trash-o"></i>Obrisi vest</a>
        <?php } else if ($this->session->userdata('user')['korisnicko'] == $autor && $v['zaBrisanje'] == 'da') { ?>
            <span class="text-muted"> Poslat je zahtev za brisanje</span>
            <?php
        }
        ?>

        </div>
        <?php
    }
}
?>



