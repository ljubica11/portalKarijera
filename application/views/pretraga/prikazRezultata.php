<!DOCTYPE html>
<?php if($this->session->userdata('user')['tip'] == 'k' and $tip == "student"){ ?>
<a href="<?php echo site_url('Oglasi/index')?>?ogl=1">Dodaj oglas</a>&nbsp;&nbsp;
<a href="<?php echo site_url('Obavestenja/index')?>?obavPret=1">Dodaj obavestenje</a>&nbsp;&nbsp;
<?php } if($tip == "student"){ ?>
<a href="#" onclick="prikaziDodavanjeGrupe()">Dodaj grupu</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo site_url('Vesti/index')?>?vesPret=1">Dodaj vest</a>&nbsp;&nbsp;



<div id="dodavanjeGrupeDiv">
    <form name="kreiraj" method="POST" action="<?php echo site_url('Pretraga/dodajClanove') ?>">
         <div class="form-row">
              <div class="col">
                <input type="text" name="nazivGrupe" placeholder="Naziv grupe" class="form-control">
              </div>
              <div class="col">
                <input type="text" name="opisGrupe" placeholder="Opis grupe" class="form-control">
             </div>
             <div class="col">
                <input type="submit" value='Napravi' class="btn btn-primary">
             </div>
         </div>
    </form>  
</div>
<?php

$res = array('res' => $podaci);
$this->session->set_userdata($res);


foreach ($podaci as $user){ 
    $idKor = $user['idKor'];?>
        <div class="pretraga-rezultat-student">
            <?php 
                if(is_dir('./userImg/'.$idKor)== false or 
                       empty(array_diff(scandir('./userImg/'.$idKor), array('.', '..')))){
                            if($tip == 'student'){ ?>
                       <img src="<?php echo base_url();?>/userImg/basicUser.png" class="user-img-pretraga">
           <?php }else if($tip == 'kompanija'){?>
                        <img src="<?php echo base_url();?>/userImg/basicLogo.png" class="user-img-pretraga">
           <?php }
                       }else{
                
                $dir= './userImg/'.$idKor;
                $allPhotos= scandir($dir);
                $onlyPhotos = array_diff($allPhotos, array('.', '..'));
                foreach($onlyPhotos as $onePhoto){ 
            ?>
                <img class="user-img-pretraga" src="<?php echo base_url().'/'.$dir.'/'.$onePhoto?>"> 
                <?php
                }
            }
            if($tip == 'student'){
            ?>
            <a href="<?php echo site_url('User/index')?>?id=<?php echo $idKor ?>&tip=s" target="_blank"><?php echo $user['ime']." ".$user['prezime']?></a>
            <?php } else if($tip == 'kompanija'){?>
             <a href="<?php echo site_url('User/index')?>?id=<?php echo $idKor ?>&tip=k" target="_blank"><?php echo $user['naziv']?></a>
            <?php } ?>
        </div>


<?php } ?>


