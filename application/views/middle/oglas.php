<!DOCTYPE html>

<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <a class="btn btn-primary" href="<?php echo site_url('Oglasi')?>">Nazad na sve oglase</a>
        </div>
        <div class="col-8 oglas-wrapper">
            <?php 
            
            foreach ($oglasi as $oglas){
                $naslov = $oglas["naslov"];
                $pozicija = $oglas["pozicija"];
                $opis = $oglas["opis"];
                $vremePost = $oglas["vremePostavljanja"];
                $vremeIst = $oglas["vremeIsticanja"];
                $uslovi = $oglas["uslovi"];
                $ponuda = $oglas["ponuda"];
                $obaveze = $oglas["obaveze"];
                $mesto = $oglas["grad"];
                $plata = $oglas["plata"];
                $placanje = $oglas["nacinPlacanja"];
                $idAutor = $oglas["autor"];
                $kompanija = $oglas["kompanija"];
                $sajt = $oglas["sajt"];
                $opisKompanije = $oglas["kopis"];
                if(is_dir('./userImg/'.$idAutor) and !empty(array_diff(scandir('./userImg/'.$idAutor), array('.', '..')))){
                    $dir= './userImg/'.$idAutor;
                     $allPhotos= scandir($dir);
                     $onlyPhotos = array_diff($allPhotos, array('.', '..'));
                      foreach($onlyPhotos as $onePhoto){ ?>
            <div class="row">
                <div class="col-6 offset-3">
                          <img class="img img-fluid" src="<?php echo base_url().'/'.$dir.'/'.$onePhoto?>">
                          <br/>
                </div>
            </div>
                          <?php
                      }
                }  
            }   
            ?>
            <div class="row">
                <div class="col-8 offset-2 naslov-oglas">
                          <h1><?php echo $naslov ?></h1>      
                          <p>Kompanija <b><?php echo $kompanija?></b> raspisuje oglas sa poziciju: </p>
                          <h3><?php echo $pozicija?></h3>
                          <h5><?php echo $mesto ?></h5>
                </div>
            </div>
                          <br/><br/>
                          <h5>Opis radnog mesta: </h5>
                          <?php echo $opis?>
                          <br/><br/>
                          <?php if(!empty($obaveze)){
                              $obavezeNiz = explode(";", $obaveze);
                              echo "<h5>Vase odgovornosti na ovom radnom mestu: </h5>";
                              foreach ($obavezeNiz as $ob){
                                  echo "- ".$ob."<br/>";
                              }
                          }
                          
                          if(!empty($uslovi)){
                              $usloviNiz = explode(";", $uslovi);
                              echo "<h5>Kvalifikacije:</h5>";
                              foreach ($usloviNiz as $usl){
                                  echo "- ".$usl."<br/>";
                              }  
                          }
                          
                          if(!empty($ponuda)){
                              $ponudaNiz = explode(";", $ponuda);
                              echo "<h5>Sta nudimo: </h5>";
                              foreach ($ponudaNiz as $pon){
                                  echo "- ".$pon."<br/>";
                              }
                          }
                          
                          if(!empty($plata)){
                              echo "<h5>Plata za ovu poziciju:</h5>";
                              echo $plata." rsd";
                              if($placanje !== "mesecno"){
                                  echo "<br/>*Plata je izrazena na".$placanje."m nivou";
                              }
                          }
                              ?>
                          <div class="row">
                          <div class="col-3 datum-oglas"><b>Oglas istice:</b> 
                              <?php $date = strtotime($vremeIst);
                                    echo date("d.m.Y", $date);?>
                          </div>
                          </div>
                <div class="row kompanija-oglas">
                    <div class="col-8 offset-2"> 
                              <h3>O kompaniji </h3>
                              <?php echo $opisKompanije; ?>
                    </div>
                </div>           
        </div>
    </div>
</div>


