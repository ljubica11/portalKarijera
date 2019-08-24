<!DOCTYPE html>

       <?php foreach ($grupe as $g){ 
           $idGru = $g['idGru'];
           $ulogovani = $this->session->userdata('user')['idKor'];
           $clanovi = $this->GrupeModel->dohvatiClanove($idGru);
           $zaBrisanje = $g['zaBrisanje'];
         
           
           ?>
           
<div class="centar" >    
    <h5><a href="<?php echo site_url("Grupe/grupa/$idGru")?>"><?php echo $g["naziv"]?></a></h5>
    
    
    <b>Naziv:</b> <?php echo $g["naziv"];?>
    <br/>
    <b>Opis:</b> <?php echo $g['opis'];?>
    <br/>
    <b>Kreirana:</b> <?php echo $g['datum'];?>
    <br/>
    <b>Broj clanova:</b><?php
    $brojClanova = $this->db->where('idGru', $idGru)->count_all_results('clanovigrupe'); 
            echo ' '.$brojClanova; ?>
    
    
    <div class="form-inline mt-2"> 
        
        <div class="form-group col-md-7">
    <form name='ispisClanova' method="POST" action="<?php echo site_url('Grupe/ispisiClanove')?>">
        <?php echo 
        "<input type='hidden' name='idGru' id='idGru' value='$idGru'>".        
        "<input type='button'  onclick='ispis($idGru)' class='btn btn-outline-primary btn-sm mr-2' value='prikazi clanove'>";
       
                ?>
    </form>
       
    <form name='brisanje' action="">
        
        <?php 
        if($zaBrisanje != 'da'){
        echo 
        "<input type='hidden' name='idGru' id='idGru' value='$idGru'>".        
        "<input type='button'  onclick='traziBrisanje($idGru); window.location.reload();' class='btn btn-outline-primary btn-sm' value='zahevaj brisanje'>";
        } else if ($zaBrisanje == 'da') {
                                echo $msg = '<b>' . 'poslat zahtev za brisanje' . '</b>';
        }
                ?>
    </form>
        </div>
        <div class="form-group col-md-3 offset-2">
    <form name='uclaniLogovanog' method='GET' action="<?php echo site_url('Grupe/uclaniLogovanog')?>">

        <?php 
           if(empty($clanovi)){
                   echo " <input type='hidden' name='idGru' value='$idGru'>";
                    echo ' <input type="submit" class="btn btn-outline-primary btn-sm float-right" value="UCLANI SE">';
               } else {
           if(isset($clanovi)){
        
            $i = 0;
            foreach ($clanovi as $c){
                $idClana = $c['idKor'];
             
               
                if($ulogovani != $idClana){
                  //var_dump($idClana);
                  echo " <input type='hidden' name='idGru' value='$idGru'>";
                  echo ' <input type="submit" class="btn btn-outline-primary btn-sm float-right" value="UCLANI SE">';
              
             } if(++$i > 0) break;
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
               }
        ?>

    </form>
        </div>
    
    </div>
</div>

<?php } ?>
    </body>
</html>
