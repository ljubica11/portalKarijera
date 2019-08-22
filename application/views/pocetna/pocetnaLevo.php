<!DOCTYPE html>

                <?php 
                
//                provera da li korisnik ima fotku, ako nema izlazi mu difoltna;
//                $idKor i $tip smo poslali preko User kontrolera

                if(is_dir('./userImg/'.$idKor)== false or 
                       empty(array_diff(scandir('./userImg/'.$idKor), array('.', '..')))){
                    if($tip == "s"){?>
                    
                        <img src="<?php echo base_url();?>/userImg/basicUser.png" class="img-fluid">
                    
                    <?php
                   }else if($tip == "k"){?>
                   
                        <img src="<?php echo base_url();?>/userImg/basicLogo.png" class="img-fluid">
                   
                       <?php
                       
//                       provera da li je je ulogovani korisnik na svom profilu ili na tudjem;
//                       ako je na svom, a nema ubacenu fotku, nudi mu se opcija za dodavanje slike;
                       
                   } if($idKor == $this->session->userdata('user')['idKor']){
                   ?>
                     
                     <form name="imageForm" method="POST" action="<?php echo site_url('User/novaSlika')?>" enctype="multipart/form-data">
                          <input type="file" name="image">
                          <input type="submit" value="Dodaj sliku" name="dodaj">
                     </form>
                  
            <?php
                   }
            }else{
                
//                ako ima sliku,onda se prikazuje njegova slika;
//                slika nije upisana u bazi;
                
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
                
                <?php
                if(isset($podaciStudent)){
                    echo "<div class='imeKorisnik'><h4>".$podaciStudent[0]['ime']." ".$podaciStudent[0]['prezime']."</h4></div>";
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
                    echo "<div class='imeKorisnik'><h4>".$podaciKompanija[0]['naziv']."</h4></div>";
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
                if($idKor == $this->session->userdata('user')['idKor'] and $tip == "s"){
                ?>
                <br/> <a href="<?php echo site_url('User/formaIzmenaPodataka')?>/<?php echo $idKor ?>" class="btn btn-small btn-primary" title="Izmeni podatke" target="_blank"><i class="fa fa-edit"></i></a>
                <?php } ?>



