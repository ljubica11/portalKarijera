<!DOCTYPE html>

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