<?php
if (isset($vesti)) {
    foreach ($vesti as $v) {
        ?>

        <div class="centar">

            <b>Naziv Vesti: </b><a href="#" onclick="procitajVest(<?php echo $v['idVes']?>)"><?php echo $v['naziv']; ?></a></b><br/>
        <b>Autor: </b><?php echo $v['korisnik']; ?><br/>
        <b>Tekst: </b><?php echo $v['tekst']; ?><br/>
        <b>Datum vesti: </b><?php echo $v['datum']; ?><br/>
        <?php $id = $v['idVes']; ?>
        <br/>

        </div>


        <?php
    }
}
?>

