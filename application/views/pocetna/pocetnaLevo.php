<!DOCTYPE html>
<div class="izmenaSlike">
                <?php 
                
//                provera da li korisnik ima fotku, ako nema izlazi mu difoltna;
//                $idKor i $tip smo poslali preko User kontrolera

                if(is_dir('./userImg/'.$idKor)== false or 
                       empty(array_diff(scandir('./userImg/'.$idKor), array('.', '..')))){
                    if($tip == "s"){?>
                    
                        <img src="<?php echo base_url();?>/userImg/basicUser.png" class="img-fluid user-img <?php if($idKor == $this->session->userdata('user')['idKor']) echo 'user-img-change'?>">
                    
                    <?php
                   }else if($tip == "k"){?>
                   
                        <img src="<?php echo base_url();?>/userImg/basicLogo.png" class="img-fluid user-img <?php if($idKor == $this->session->userdata('user')['idKor']) echo 'user-img-change'?>">
                   
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
            
                <img class="img img-fluid user-img <?php if($idKor == $this->session->userdata('user')['idKor']) echo 'user-img-change'?>" src="<?php echo base_url().'/'.$dir.'/'.$onePhoto?>">       
                    
            <?php
                }
            } if($idKor == $this->session->userdata('user')['idKor']){
            ?>
                
                <div class="middle">
                    <form name="imageForm" method="POST" action="<?php echo site_url("User/promeniSliku/$idKor")?>" enctype="multipart/form-data">
                          <input type="file" name="image" id="file-select" class="inputfile"  />
                            <label for="file-select" id="file-label">Promeni sliku</label>  
                            <br/>
                            <input type="submit" name="izmeni" value="Sacuvaj izmenu" class="btn btn-sm btn-danger" id="btn-sacuvaj">
                     </form>
                </div>
                
                
            <?php } ?>
</div>    
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



