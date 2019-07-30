<!DOCTYPE html>

<div id="oglasi">
<?php foreach ($oglasi as $oglas){
                $idOgl = $oglas["idOgl"]?>

<div class="centar">
    <h5><a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl")?>"><?php echo $oglas["naslov"]?></a></h5>
    <b>Kompanija:</b> <?php echo $oglas["naziv"];?>
    <br/>
    <b>Opis posla: </b> <?php echo $oglas["opis"];?>
</div>

<?php } ?>
</div>