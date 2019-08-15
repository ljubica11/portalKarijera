
<div class="container-fluid">
    <div class="row">
        <div class="col-3 levo">
                <?php 
                
                if(is_dir('./userImg/'.$idKor)== false or 
                       empty(array_diff(scandir('./userImg/'.$idKor), array('.', '..')))){
                    if($tip == "s"){?>
                    <img src="<?php echo base_url();?>/userImg/basicUser.png" class="img-fluid">
                    <?php
                   }else if($tip == "k"){?>
                     <img src="<?php echo base_url();?>/userImg/basicLogo.png" class="img-fluid">
                       <?php
                   } if($idKor == $this->session->userdata('user')['idKor']){
                   ?>
                     
                     <form name="imageForm" method="POST" action="<?php echo site_url('User/novaSlika')?>" enctype="multipart/form-data">
                          <input type="file" name="image">
                          <input type="submit" value="Dodaj sliku" name="dodaj">
                     </form>
                  
            <?php
                   }
            }else{
                
                $dir= './userImg/'.$idKor;
                
                
                $allPhotos= scandir($dir);
                $onlyPhotos = array_diff($allPhotos, array('.', '..'));
                foreach($onlyPhotos as $onePhoto){ 
            ?>
                <img class="img img-fluid" src="<?php echo base_url().'/'.$dir.'/'.$onePhoto?>">       
                     
            <?php
                }
            }
            ?>
                
                <b>Osnovni podaci: </b>
                <br/>
                <?php
                if(isset($podaciStudent)){
                    echo $podaciStudent[0]['ime']." ".$podaciStudent[0]['prezime'];
                    echo "<br/>";
                    echo "Datum rodjenja: ".$podaciStudent[0]['datum'];
                    echo "<br/>";
                    if($podaciStudent[0]['vidljivostTelefon'] == null){
                    echo "Telefon: ".$podaciStudent[0]['telefon'];
                    echo "<br/>";
                    }
                    if($podaciStudent[0]['vidljivostAdresa'] == null){
                    echo "Adresa: ".$podaciStudent[0]['adresa'];
                    echo "<br/>";
                    }
                    echo "Grad: ".$podaciStudent[0]['grad'];
                    echo "<br/>";
                    echo "Drzavljanstvo: ".$podaciStudent[0]['drzavljanstvo'];
                    echo "<br/>";
                    echo "Status: ".$podaciStudent[0]['status'];
                    echo "<br/>";
                    echo "Kurs: ".$podaciStudent[0]['kurs'];
                }else if(isset ($podaciKompanija)){
                    echo $podaciKompanija[0]['naziv'];
                    echo "<br/>";
                    echo "Sediste: ".$podaciKompanija[0]['sediste'];
                    echo "<br/>";
                    echo "PIB: ".$podaciKompanija[0]['pib'];
                    echo "<br/>";
                    echo "Telefon: ".$podaciKompanija[0]['telefoni'];
                    echo "<br/>";
                    echo "Oblast delovanja: ".$podaciKompanija[0]['oblastDelovanja'];
                    echo "<br/>";
                    echo "Broj zaposlenih: ".$podaciKompanija[0]['brojZap'];
                    echo "<br/>";
                    echo "Sajt: <a href='http://".$podaciKompanija[0]['sajt']."'>".$podaciKompanija[0]['sajt']."</a>";
                }
                if($this->session->userdata('user')['vidljivostEmail'] == null){
                        echo "<br/>E-mail: ".$this->session->userdata('user')['email'];
                    }
                ?>

            </div>
            <div class="col-6">
                <?php if($this->session->flashdata('brisanje')){?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $this->session->flashdata('brisanje');?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                <?php } if($tip == "s"){?>
                <div class="centar">
                    <b>Interesovanja:</b>
                    <br/>
                    <?php
                    
                    if(isset($interesovanja)){
                        foreach ($interesovanja as $interesovanje){
                            echo "-".$interesovanje['naziv']."<br/>";
                        }
                    }
                    ?>  
                </div>
                <div class="centar">
                    <b>Vestine: </b>
                    <br/>
                    <?php
                    if(isset($vestine)){
                        foreach ($vestine as $vestina){
                            echo "-".$vestina['naziv']."<br/>";
                        }
                    }
                        
                        ?>
                </div>
                <div class="centar">
                    <b>Obrazovanje:</b>
                <br/>
                    <?php
                    if(isset($diploma) and !empty($diploma)){
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
                    }
                    ?>
                </div>
                <div class="centar">
                    <b>Radno iskustvo: </b>
                    <br/>
                    <?php
                    if(isset($iskustvo) and !empty($iskustvo)){
                        echo "Kompanija: ".$iskustvo[0]["kompanija"];
                        echo "<br/>";
                        echo "Grad: ".$iskustvo[0]["grad"];
                        echo "<br/>";
                        echo "Pozicija: ".$iskustvo[0]["pozicija"];
                        echo "<br/>";
                        echo "Od: ".$iskustvo[0]["od"];
                        echo "<br/>";
                        echo "Do: ".$iskustvo[0]["do"];
                    }
                    
                    if(is_dir('./CV/'.$idKor)== false or 
                       empty(array_diff(scandir('./CV/'.$idKor), array('.', '..')))){
                        if($idKor == $this->session->userdata('user')['idKor']){
                    ?>
                     <form name="cvForm" method="POST" action="<?php echo site_url('User/dodajCV')?>" enctype="multipart/form-data">
                          Dodaj CV (mora biti u PDF formatu): <input type="file" name="cv">
                          <input type="submit" value="Dodaj" name="dodaj">
                     </form>
                            
                    <?php 
                        }
                       }else{
                    ?>
                    <br/>
                    <a href="<?php echo site_url('User/procitajCV')?>">Moj CV</a>
                    
                
                <?php
                
                       }
                       echo "</div>";
                    }else if($tip == "k"){ ?>
                <div class="centar">
                    <b>Opis kompanije: </b> 
                    <br/>
                    <?php
                    echo $podaciKompanija[0]['opis'];
                    ?>
                </div>
                <div class="centar">
                    <b>Aktuleni oglasi: </b>
                    <br/>
                    <?php
                        foreach ($oglasi as $oglas){ 
                            $idOgl = $oglas['idOgl'];
                            $vremeIst = $oglas['vremeIsticanja'];
                            $date = strtotime($vremeIst);?>
                            - <a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl")?>"><?php echo $oglas["naslov"]?></a>
                                <?php if(date('Y-m-d') > date('Y-m-d', $date)){ echo " (istekao oglas)"; }?>
                            <br/>
                    <?php 
                    }
                    ?>
                </div>
                <div class="centar">
                    <b>Aktuelna obavestenja: </b>
                    <br/>
                    <?php
                                        foreach ($obavestenja as $obavestenje){
                                            echo "- <a href='#'>".$obavestenje['naslov']."</a><br/>";
                                        }
                    ?>
                </div>
                <?php
                    }
                    ?>
                
            </div>
              <div class="col-3">


                   <a class="btn" href="<?php echo site_url("User/logout")?>">Logout</a> 

              </div>
            </div>
              
        </div> 

