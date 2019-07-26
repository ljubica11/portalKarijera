<!DOCTYPE html>
<?php foreach ($oglasi as $oglas){ ?>

<div class="centar">
    <h5><a href="#"><?php echo $oglas["naslov"]?></a></h5>
    <b>Kompanija:</b> <?php echo $oglas["naziv"];?>
    <br/>
    <b>Opis posla:</b> <?php echo $oglas["tekst"];?>
</div>

<?php } ?>