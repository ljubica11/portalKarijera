<!DOCTYPE html>

<div id="oglasi">
<?php foreach ($oglasi as $oglas){
                $idOgl = $oglas["idOgl"]?>

<div class="centar">
    <h5><a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl")?>"><?php echo $oglas["naslov"]?></a></h5>
    <b>Kompanija:</b> <?php echo $oglas["naziv"];?>
    <br/>
    <b>Opis posla: </b> <?php echo $oglas["opis"];?>
    <?php 
     $vremeIst = $oglas["vremeIsticanja"];
     $date = strtotime($vremeIst);
             if(date('Y-m-d') > date('Y-m-d', $date)){
                 echo "<div class='istekao-oglas'><b>Oglas je istekao</b></div>";
             }
    ?>

</div>

<?php } ?>
</div>