<?php
if (isset($vesti)) {
    foreach ($vesti as $v) {
        ?>

        <div class="centar">

            <b>Naziv Vesti: </b><?php echo $v['naziv']; ?></b><br/>
        <b>Autor: </b><?php echo $v['autor']; ?><br/>
        <b>Tekst: </b><?php echo $v['tekst']; ?><br/>
        <b>Datum vesti: </b><?php echo $v['datum']; ?><br/>
        <?php $id = $v['idVes']; ?>
        <br/>

        </div>


        <?php
    }
}
?>

