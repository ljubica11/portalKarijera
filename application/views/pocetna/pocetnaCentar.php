<!DOCTYPE html>
 
 
<!--            proveravamo da li smo na profilu studenta,
                ako jesmo, ispusuju se podaci za studenta     -->

                <?php  if($tip == "s"){
                    if(isset($interesovanja) and !empty($interesovanja)){
                    ?>
                <div class="centar-pocetna">
                    <div class="naslov-stavka-pocetna">
                    <b>Interesovanja</b>
                    </div>
                    <div class="sadrzaj-pocetna">
                    <?php
                   
                        foreach ($interesovanja as $interesovanje){
                            echo "-".$interesovanje['naziv']."<br/>";
                        } ?>
                    </div>
                    </div>
                    <?php
                    } if(isset($vestine) and !empty($vestine)){
                    ?>  
                <div class="centar-pocetna">
                     <div class="naslov-stavka-pocetna">
                    <b>Vestine </b>
                     </div>
                    <div class="sadrzaj-pocetna">
                    <?php
                        foreach ($vestine as $vestina){
                            echo "-".$vestina['naziv']."<br/>";
                        } ?>
                    </div>
                </div>
                    <?php
                    }if(isset($studije) and !empty($studije)){
                        ?>
                        <div class="centar-pocetna">
                             <div class="naslov-stavka-pocetna">
                            <b>Trenutne studije </b>
                             </div>
                            <div class="sadrzaj-pocetna">
                            <?php
                            echo "Fakultet: ".$studije[0]['fakultet'];
                            echo "<br/>";
                            echo "Univerzitet: ".$studije[0]['univerzitet'];
                            echo "<br/>";
                            echo "Nivo: ".$studije[0]['nivo'];
                            echo "<br/>";
                            echo "Godina studija: ".$studije[0]['godinaStudija'];
                            echo "<br/>";
                            echo "Sediste fakulteta: ".$studije[0]['grad'];

                            ?>
                            </div>
                        </div>
                    <?php }if(isset($diploma) and !empty($diploma)){  ?>        

                    <div class="centar-pocetna">
                         <div class="naslov-stavka-pocetna">
                        <b>Obrazovanje</b>
                         </div>
                        <div class="sadrzaj-pocetna">
                    <?php
                    
                        echo "Fakultet: ".$diploma[0]['naziv'];
                        echo "<br/>";
                        echo "Odsek: ".$diploma[0]['odsek'];
                        echo "<br/>";
                        echo "Nivo: ".$diploma[0]['nivo'];
                        echo "<br/>";
                        echo "Zvanje: ".$diploma[0]['zvanje'];
                        echo "<br/>";
                        echo "Godina upisa: ".$diploma[0]['godinaUpisa'];
                        echo "<br/>";
                        echo "Godina zavrsetka: ".$diploma[0]['godinaZavrsetka'];
                    
                    ?>
                        </div>
                    </div>
                    <?php } if(isset($iskustvo) and !empty($iskustvo)){?>
                <div class="centar-pocetna">
                     <div class="naslov-stavka-pocetna">
                        <b>Radno iskustvo </b>
                     </div>
                    <div class="sadrzaj-pocetna">
                    <?php
                        echo "Kompanija: ".$iskustvo[0]["kompanija"];
                        echo "<br/>";
                        echo "Grad: ".$iskustvo[0]["grad"];
                        echo "<br/>";
                        echo "Pozicija: ".$iskustvo[0]["pozicija"];
                        echo "<br/>";
                        echo "Od: ".$iskustvo[0]["od"];
                        echo "<br/>";
                        echo "Do: ".$iskustvo[0]["do"];
                ?>
                    </div>      
             </div>;
                       
<!--                       ako smo na profilu kompanije, ispisuju se podaci za kompaniju-->
                       
                  <?php  
                    }
                       }else if($tip == "k"){ ?>
                     
                <div class="centar-pocetna">
                     <div class="naslov-stavka-pocetna">
                    <b>O nama </b> 
                     </div>
                    <div class="sadrzaj-pocetna">
                    <?php
                    echo $podaciKompanija[0]['opis'];
                    ?>
                    </div>
                </div>
                <?php if(isset($oglasi) and !empty($oglasi)){ ?>
                <div class="centar-pocetna">
                     <div class="naslov-stavka-pocetna">
                    <b>Aktuleni oglasi </b>
                     </div>
                    <div class="sadrzaj-pocetna">
                    <?php
                        foreach ($oglasi as $oglas){ 
                            $idOgl = $oglas['idOgl'];
                            $vremeIst = $oglas['vremeIsticanja'];
                            $date = strtotime($vremeIst);
                            if(date('Y-m-d') <= date('Y-m-d', $date)){
                            ?>
                            - <a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl")?>"><?php echo $oglas["naslov"]?></a>
                               
                            <br/>
                    <?php 
                    }
                        }
                    ?>
                    </div>
                </div>
                <?php } if(isset($obavestenja) and !empty($obavestenja)){ ?>
                <div class="centar-pocetna">
                     <div class="naslov-stavka-pocetna">
                    <b>Aktuelna obavestenja </b>
                     </div>
                    <div class="sadrzaj-pocetna">
                    <?php
                                        foreach ($obavestenja as $obavestenje){
                                            echo "- <a href='#'>".$obavestenje['naslov']."</a><br/>";
                                        }
                    ?>
                    </div>
                </div>
                <?php
                    }
                  }
                    ?>
                


                 
