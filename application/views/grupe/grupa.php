<!DOCTYPE html>

<html>
 
        <?php
      //  echo 'test';
   //     var_dump($clanovi);
       // var_dump($diskusijeGrupe);
        ?>
        <div class="container">
  <div class="row">
    <div class="col-sm">
        <h4>Diskusije</h4>
        
       <?php 
              
       foreach($diskusijeGrupe as $d){
           $idDis = $d['idDis'];
           
           ?>
        
        <div class="postdesno">
        <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
        <b>Opis: </b><?php echo $d['opis'] ?><br/>
        <b>Autor: </b><?php echo $d['korisnicko'] ?><br/>
        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
        <a href="<?php echo site_url("Diskusije/jednaDiskusija/$idDis")?>">Pogledaj diskusiju</a>
        </div>
       <?php }?>
    </div>
    <div class="col-sm">
     <h4>Oglasi</h4>
     <?php
        //   var_dump($oglasiGrupe);
      foreach($oglasiGrupe as $o){
          $idOgl = $o['idOgl'];
          
      ?>
       <div class="postdesno">
        <b>Naslov: </b><?php echo $o['naslov'] ?></b><br/>
        <b>Opis: </b><?php echo $o['opis'] ?><br/>
        <b>Autor: </b><?php echo $o['naziv'] ?><br/>
        <b>Datum postavljanja: </b><?php echo $o['vremePostavljanja'] ?><br/>
        <a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl")?>">Pogledaj oglas</a>
        </div>
     
      <?php } ?>
        
        
    </div>
    <div class="col-sm">
      <h4>Vesti</h4>
        
        
        
    </div>
     <div class="col-sm">
      <h4>Obaveštenja</h4>
        
        
    </div>
  </div>
</div>

</html>
