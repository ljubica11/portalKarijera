<!DOCTYPE html>

       <?php foreach ($grupe as $g){ 
           $idGru = $g['idGru'];
           $ulogovani = $this->session->userdata('user')['idKor'];
           $clanovi = $this->GrupeModel->dohvatiClanove($idGru);
           
           
           ?>
           
<div class="centar">    
    <h5><a href="#"><?php echo $g["naziv"]?></a></h5>
    <b>ID Grupe:</b> <?php echo $idGru;?>
    <br/>
    <b>Naziv:</b> <?php echo $g["naziv"];?>
    <br/>
    <b>Opis:</b> <?php echo $g['opis'];?>
    <br/>
    <b>Broj clanova:</b><?php
    $brojClanova = $this->db->where('idGru', $idGru)->count_all_results('clanovigrupe'); 
            echo ' '.$brojClanova; ?>
    <form name='uclaniLogovanog' method='GET' action="<?php echo site_url('Grupe/uclaniLogovanog')?>">

        <?php 
           if(empty($clanovi)){
                   echo " <input type='hidden' name='idGru' value='$idGru'>";
                    echo ' <input type="submit" class="btn btn-outline-primary btn-sm float-right" value="UCLANI SE">';
               } else {
           if(isset($clanovi)){
          
           $idClana = $clanovi[0]['idKor'];
                if($ulogovani != $idClana){
                    echo " <input type='hidden' name='idGru' value='$idGru'>";
                    echo ' <input type="submit" class="btn btn-outline-primary btn-sm float-right" value="UCLANI SE">';
                }
           } 
               
           }
        ?>

    </form>
    
    <form name="obrisiLogovanog" method="GET" action="<?php echo site_url('Grupe/obrisiLogovanog')?>">
       
        <?php 
            
            foreach ($clanovi as $c){
                $idClana = $c['idKor'];
            
                if($ulogovani === $idClana){
                    echo " <input type='hidden' name='idGru' value='$idGru'>";
                    echo ' <input type="submit" class="btn btn-outline-primary btn-sm float-right" value="NAPUSTI GRUPU">';
              }
            }
        ?>

    </form>
 
    <form name='ispisClanova' method="POST" action="<?php echo site_url('Grupe/ispisiClanove')?>">
        <?php echo 
        "<input type='hidden' name='idGru' id='idGru' value='$idGru'>".
        "<input type='button' onclick='prikaziParametre($idGru)' class='btn btn-outline-primary btn-sm' value='prikazi parametre'>".
               
        "<input type='button'  onclick='ispis($idGru)' class='btn btn-outline-primary btn-sm' value='prikazi clanove'>";
       
                ?>
    </form>
</div>

<?php } ?>
    </body>
</html>
