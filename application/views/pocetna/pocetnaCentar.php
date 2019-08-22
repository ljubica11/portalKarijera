<!DOCTYPE html>
 
                
<!--            kad kompanija posalje zahtev za brisanje oglasa, vraca se na pocetnu stranu
                i izlazi im poruka da je poslat zahtev za brisanje oglasa;
                mozda je bilo pametnije da ova poruka izlazi na strani sa oglasima -->
                
                <?php if($this->session->flashdata('brisanje')){?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $this->session->flashdata('brisanje');?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>

<!--            proveravamo da li smo na profilu studenta,
                ako jesmo, ispusuju se podaci za studenta     -->

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
                    
//                    ako korisnik nema ubacen CV i ako je ulogovani korisnik na svom profilu
//                    nudi mu se opcija da doda CV
                    
                    
                    
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
                        
//                        ako korisnik ima CV, imamo link za citanje CV-a
                        
                       }else{
                    ?>
                    <br/>
                    <a href="<?php echo site_url('User/procitajCV')?>">Moj CV</a>
                    
                
                <?php
                
                       }
                       echo "</div>";
                       
//                       ako smo na profilu kompanije, ispisuju se podaci za kompaniju
                       
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
                


                 
