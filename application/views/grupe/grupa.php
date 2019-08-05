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
    <?php
     // var_dump($vestiGrupe);
        foreach($vestiGrupe as $v){
            $idVes = $v['idVes'];
            ?>
      <div class="postdesno">
        <b>Naslov: </b><?php echo $v['naziv'] ?></b><br/>
        <b>Tekst: </b><?php echo $v['tekst'] ?><br/>
        <b>Autor: </b><?php echo $v['korisnicko'] ?><br/>
        <b>Datum postavljanja: </b><?php echo $v['datum'] ?><br/>
       
        </div>
        
      <?php }
    
    ?>
        
        
        
    </div>
     <div class="col-sm">
      <h4>Obaveštenja</h4>
        
      <?php 
     // var_dump($obavestenjaGrupe);
      foreach($obavestenjaGrupe as $ob){
          
          $idOba = $ob['idOba'];
          ?>
       <div class="postdesno">
        <b>Naslov: </b><?php echo $ob['naslov'] ?></b><br/>
        <b>Tekst: </b><?php echo $ob['tekst'] ?><br/>
        <b>Autor: </b><?php echo $ob['korisnicko'] ?><br/>
        <b>Datum postavljanja: </b><?php echo $ob['datum'] ?><br/>
       
        </div>
       <?php   
      }
      ?>
        
    </div>
  </div>
</div>

</html>
