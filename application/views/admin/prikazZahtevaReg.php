<!DOCTYPE html>
<h4>Zahtevi za registraciju</h4>
<div class="zahtevi-registracija scroll">
    <?php foreach ($zahtevi as $zahtev){?>
    
    <div class="jedan-zahtev">
        <div class="div-group">
            <div class="labela-zahtev">
                Naziv
            </div>
           
                <?php echo $zahtev["naziv"];?>
            
        </div> 
        <div class="div-group">
            <div class="labela-zahtev">
                Sediste
            </div>
            
                <?php echo $zahtev["sediste"];?>
            
        </div> 
         <div class="div-group">
            <div class="labela-zahtev">
                PIB
            </div>
            
                <?php echo $zahtev["pib"];?>
            
        </div> 
        <div class="div-group">
            <div class="labela-zahtev">
                Telefon
            </div>
           
                <?php echo $zahtev["telefoni"];?>
            
        </div>
         <div class="div-group-opis">
            <div class="labela-zahtev-opis">
                Opis kompanije
            </div>
           
                <?php echo $zahtev["opis"];?>
            
        </div>
        <div class="div-group">
            <div class="labela-zahtev">
                Oblast delovanja
            </div>
            
                <?php echo $zahtev["oblastDelovanja"];?>
            
        </div>
        <div class="div-group">
            <div class="labela-zahtev">
                Broj zaposlenih
            </div>
           
                <?php echo $zahtev["brojZap"];?>
            
        </div>
        <div class="div-group">
            <div class="labela-zahtev">
                Sajt kompanije
            </div>
            
                <?php echo $zahtev["sajt"];?>
            
        </div>
        <div class="div-group">
            <div class="labela-zahtev">
                Korisnicko ime
            </div>
           
                <?php echo $zahtev["korisnicko"];?>
            
        </div>
        <div class="div-group">
            <div class="labela-zahtev">
                Email
            </div>
            
                <?php echo $zahtev["email"];?>
            
        </div>
        <div class="row">
            <div class="col-6 offset-3 text-center">
                <input type="button" value="Odobri" class="btn btn-success" onclick="odobriRegistraciju(<?php echo $zahtev['idKor'].",'".$zahtev['email']."'"?>)">
                <input type="button" value="Zabrani" class="btn btn-danger ml-3" onclick="zabraniRegistraciju(<?php echo $zahtev['idKor'].",'".$zahtev['email']."'"?>)">
            </div>
        </div>
        
    </div>
    
    
    
    
    
    <?php } ?>
</div>