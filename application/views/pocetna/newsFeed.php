<!DOCTYPE html>
<div id="newsFeedWrapper">
<?php if(isset($vesti) and !empty($vesti)){  ?>
<div class="noveStavkeNewsFeed">
    <span class="badge-news-feed">Najnovije vesti</span>
    <?php 
    $i = 0;
    foreach ($vesti as $vest){ ?>
    <div class="jednaStavkaNewsFeed">
        <a href="<?php echo site_url('Vesti/index')?>?idVesti=<?php echo $vest['idVes']?>" target="_blank"> <?php echo $vest['naziv'];?></a>
        <br/>
        <?php echo $vest['tekst']?>
        <br/>
        <i>Autor:</i> <?php echo $vest['korisnik']?>
    </div>
    
    <?php 
    if(++$i > 1) break;
    } ?> 
    
</div>

<?php }
        if(isset($oglasi) and !empty($oglasi)){
?>
    <div class="noveStavkeNewsFeed">
     <span class="badge-news-feed">Najnoviji oglasi</span>
     <?php
     $i = 0;
     foreach ($oglasi as $oglas){
         $vremeIst = $oglas["vremeIsticanja"];
         $date = strtotime($vremeIst);?>
     <div class="jednaStavkaNewsFeed">
         <a href="<?php echo site_url('Oglasi/pogledajOglas')?>/<?php echo $oglas['idOgl']?>" target="_blank"><?php echo $oglas['naslov'];?></a>
         <br/>
         Vreme isticanja: <?php echo date("d.m.Y", $date);?>
         <br/>
         <i>Autor</i>: <?php echo $oglas['naziv'];?>
     </div>
     
     <?php
     if(++$i > 1) break;
     }
     
     ?>
</div>
<?php } 
    if(isset($obavestenja) and !empty($obavestenja)){
?>
<div class="noveStavkeNewsFeed">
     <span class="badge-news-feed">Najnovija obavestenja</span>
     <?php 
     $i = 0;
     foreach ($obavestenja as $obavestenje){
     ?>
     <div class="jednaStavkaNewsFeed">
         <a href="<?php echo site_url('Obavestenja/index')?>?idObavestenja=<?php echo $obavestenje['idOba']?>" target="_blank"> <?php echo $obavestenje["naslov"]?></a>
         <br/>
         <?php echo $obavestenje['tekst']?>
        <br/>
        <i>Autor:</i> <?php echo $obavestenje['naziv']?>
         
     </div>
     <?php
     if(++$i > 1) break;
     } ?>  
</div>
<?php } ?>
</div>

