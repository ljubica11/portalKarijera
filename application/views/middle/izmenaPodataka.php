<!DOCTYPE html>
<div class="container-fluid">
    <div class="row">

        <div class="col-6 offset-3">
        <div class="izmenaPodatakaForma">
        <?php foreach ($podaci as $podatak){ ?>
            <form method="POST" action="<?php echo site_url('User/izmeniPodatke')?>" class="formaReg">
                Korisničko ime:

                             <input class="form-control" name="korisnicko" type="text" value="<?php echo $this->session->userdata('user')['korisnicko'] ?>"> <?php echo form_error('korisnicko') ?> <br/>
                             <input type="hidden" name="originalKorisnicko" value="<?php echo $this->session->userdata('user')['korisnicko'] ?>">
                             Ime:
                             <input class="form-control" name="ime" type="text" value="<?php echo $podatak['ime'] ?>"><?php echo form_error('ime') ?> <br/>
                             Prezime:
                             <input class="form-control" name="prezime" type="text" value="<?php echo $podatak['prezime'] ?>"><?php echo form_error('prezime') ?> <br/>
                             Kurs koji ste završili:
                             <select class="form-control" name="kurs">
                                 <?php 
                                 foreach ($kursevi as $kurs){
                                     $naziv = $kurs["naziv"];
                                     $idK = $kurs["idKurs"];
                                     if($podatak["kurs"] == $naziv){
                                         echo "<option value='$idK' selected>$naziv</option>";
                                     }else{
                                     echo "<option value='$idK'>$naziv</option>";
                                     }
                                 }
                                 ?>
                             </select> <br/> <?php echo form_error('kurs');?>   
                             Državljanstvo:
                             <select class="form-control" name="drzavljanstvo">
                                 <?php 
                                 foreach ($drzavljanstvo as $drz){
                                     $naziv = $drz["naziv"];
                                     $idD = $drz["idDrz"];
                                     if($podatak["drzavljanstvo"] == $naziv){
                                         echo "<option value='$idD' selected>$naziv</option>";
                                     }else{
                                     echo "<option value='$idD'>$naziv</option>";
                                     }
                                 }
                                 ?>
                             </select><br/> <?php echo form_error('drzavljanstvo');?>
                             Broj telefona:
                             <input class="form-control" name="telefon" type="text" value="<?php echo $podatak['telefon'] ?>" ><?php echo form_error('telefon') ?> <br/>  
                             Adresa:
                             <input class="form-control" name="adresa" type="text" value="<?php echo $podatak['adresa'] ?>" ><?php echo form_error('adresa') ?> <br/>
                             Mesto stanovanja:
                             <div id="selectmesto">
                             <select class="form-control" name="mesto" onchange="dodajInput('mesto')" id="listamesto"> 
                                   <?php 
                                 foreach ($mesta as $mesto){
                                     $naziv = $mesto["naziv"];
                                     $idG = $mesto["idGra"];
                                     if($podatak["grad"] == $naziv){
                                        echo "<option value='$idG' selected>$naziv</option>"; 
                                     }else{
                                     echo "<option value='$idG'>$naziv</option>";
                                     }
                                 }
                                 ?>
                                <option class="dodaj" value="dodaj">Dodaj novo mesto</option>
                                </select>
                             </div>
                             <div id="mesto">
                             </div> <br/>
                             <?php echo form_error('mesto');?>
                             Trenutni status:
                             <select class="form-control" name="status">
                                 <option value="student">Student</option>
                                 <option value="nezaposleni">Nezaposleni</option>
                                 <option value="zaposleni">Zaposleni</option>   
                             </select><br/><?php echo form_error('status');?>

                            E-mail:
                             <input class="form-control" type="email" name="email"  value="<?php echo $this->session->userdata('user')['email'] ?>"><?php echo form_error('email') ?><br/>
                             <input type="hidden" name="originalEmail" value="<?php echo $this->session->userdata('user')['email'] ?>">

                             Datum rođenja: 
                                <input class="form-control" type="date" name="datum"  value="<?php echo $podatak["datum"] ?>"> 

                             <?php echo form_error('datum') ?>  <br/>
                             <div class="form-row">
                                 <div class="col-10 offset-1 text-center">
                             <input type="submit"  name="izmenaPodataka" value="Sacuvaj izmene" class="btn btn-success btn-lg">  
                             <a href="<?php echo site_url('User')?>" class="btn btn-lg btn-danger">Odustani</a>
                                 </div>
                             </div>
                             </form>

                    <?php } ?>
            </div>
        </div>
   </div>
</div>
