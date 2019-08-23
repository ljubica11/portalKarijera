<!DOCTYPE html>

<?php if(isset($oglasi)){ 
    if(!empty($oglasi)){ 
    echo "<h4>Zahtevi za brisanje oglasa</h4>";
                foreach ($oglasi as $oglas){
                    $vremeIst = $oglas["vremeIsticanja"];
                    $date = strtotime($vremeIst);
                    $idOgl = $oglas["idOgl"];?>
    
<div class="jedan-zahtev">
    
     <div class="div-group">
            <div class="labela-zahtev">
                Kompanija
            </div>
                <?php echo $oglas["kompanija"];?>
     </div> 
     <div class="div-group">
            <div class="labela-zahtev">
                Naslov oglasa
            </div>
                <?php echo $oglas["naslov"];?>
     </div> 
    <div class="div-group">
            <div class="labela-zahtev">
                Pozicija
            </div>
                <?php echo $oglas["pozicija"];?>
     </div> 
    <div class="div-group">
            <div class="labela-zahtev">
                Oglas istekao
            </div>
                <?php echo date("d.m.Y", $date);?>
     </div>
    <small> <a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl")?>" target="_blank">Pogledaj ceo oglas</a> </small>
    <div class="row">
            <div class="col-6 offset-3 text-center">
    <input type="button" value="Obrisi oglas" class="btn btn-danger" onclick="obrisiZahtev('oglasi', <?php echo $idOgl ?>)">
            </div>
    </div>

</div>


        <?php }
    } else echo "<h4>Nema novih zahteva</h4>";
        } else if(isset ($vesti)){
            if(!empty ($vesti)){
           echo "<h4>Zahtevi za brisanje vesti</h4>";  
        foreach ($vesti as $vest){?>
        <div class="jedan-zahtev">
            <div class="div-group">
                <div class="labela-zahtev">
                    Autor
                </div>
                    <?php echo $vest["korisnik"];?>
            </div> 
            <div class="div-group">
                <div class="labela-zahtev">
                    Naslov
                </div>
                    <?php echo $vest["naziv"];?>
            </div> 
            <div class="div-group-opis">
                <div class="labela-zahtev-opis">
                    Tekst vesti
                </div>
                    <?php echo $vest["tekst"];?>
            </div>
            <small> <a href="<?php echo site_url('Vesti/index')?>?idVesti=<?php echo $vest['idVes']?>" target="_blank">Pogledaj celu vest</a> </small>
            <div class="row">
                <div class="col-6 offset-3 text-center">
                    <input type="button" value="Obrisi vest" class="btn btn-danger" onclick="obrisiZahtev('vesti', <?php echo $vest['idVes'] ?>)">
                </div>
            </div>

        </div>    


       <?php  }
        } else echo "<h4>Nema novih zahteva</h4>";
       } else if(isset ($obav)){ 
           if(!empty ($obav)){ 
            echo "<h4>Zahtevi za brisanje obavestenja</h4>";  
            foreach ($obav as $obavestenje){ ?>
            <div class="jedan-zahtev">
                <div class="div-group">
                    <div class="labela-zahtev">
                        Autor
                    </div>
                        <?php echo $obavestenje["naziv"];?>
                </div> 
                <div class="div-group">
                    <div class="labela-zahtev">
                        Naslov
                    </div>
                        <?php echo $obavestenje["naslov"];?>
                </div>
                <div class="div-group-opis">
                    <div class="labela-zahtev-opis">
                        Tekst obavestenja
                    </div>
                        <?php echo $obavestenje["tekst"];?>
                </div>
            <small> <a href="<?php echo site_url('Obavestenja/index')?>?idObavestenja=<?php echo $obavestenje['idOba']?>" target="_blank">Pogledaj celo obavestenje</a> </small>
            <div class="row">
                <div class="col-6 offset-3 text-center">
                    <input type="button" value="Obrisi obavestenje" class="btn btn-danger" onclick="obrisiZahtev('obavestenja', <?php echo  $obavestenje['idOba'] ?>)">
                </div>
            </div>
                
                
                
            </div>


            <?php } 
           } else echo "<h4>Nema novih zahteva</h4>";
       } else if(isset ($grupe)){ 
           if(!empty ($grupe)){
           echo "<h4>Zahtevi za brisanje grupa</h4>";
       foreach ($grupe as $grupa){
           $idGru = $grupa["idGru"];?>
        <div class="jedan-zahtev">
            <div class="div-group">
                <div class="labela-zahtev">
                    Naziv grupe
                </div>
                <?php echo $grupa["naziv"];?>
            </div> 
            <div class="div-group">
                <div class="labela-zahtev">
                    Opis grupe
                </div>
                <?php echo $grupa["opis"];?>
            </div> 
            <small> <a href="<?php echo site_url("Grupe/grupa/$idGru")?>" target="_blank">Pogledaj grupu</a> </small>
            <div class="row">
                <div class="col-6 offset-3 text-center">
                    <input type="button" value="Obrisi grupu" class="btn btn-danger" onclick="obrisiZahtev('grupe', <?php echo $idGru ?>)">
                </div>
            </div>
            
        </div>

        <?php  }
           } else echo "<h4>Nema novih zahteva</h4>";
       } else if(isset ($disk)){
            if(!empty ($disk)){
           echo "<h4>Zahtevi za brisanje diskusija</h4>";
           foreach ($disk as $diskusija){ 
               $idDisk = $diskusija["idDis"];?>
    <div class="jedan-zahtev">
        <div class="div-group">
            <div class="labela-zahtev">
               Autor
            </div>
            <?php echo $diskusija["korisnik"];?>
        </div> 
        <div class="div-group">
            <div class="labela-zahtev">
               Naziv
            </div>
            <?php echo $diskusija["naziv"];?>
        </div>
        <div class="div-group">
            <div class="labela-zahtev">
               Opis
            </div>
            <?php echo $diskusija["opis"];?>
        </div>
        <small> <a href="#" onclick="prikaziPostoveDisk(<?php echo $idDisk ?>)">Pogledaj postove diskusije</a> </small>
            <div class="row">
                <div class="col-6 offset-3 text-center">
                    <input type="button" value="Obrisi diskusiju" class="btn btn-danger" onclick="obrisiZahtev('diskusije', <?php echo $idDisk ?>)">
                </div>
            </div>

    </div> 


           <?php }
            } else echo "<h4>Nema novih zahteva</h4>";
       }
?>
