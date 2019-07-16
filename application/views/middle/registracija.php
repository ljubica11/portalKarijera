<!DOCTYPE html>

<div class="wrapper">
    <div class="regwrapper">
<div class="tab">
  <button class="tablinks" onclick="openReg(event, 'Student')" id="defaultOpen">Student</button>
  <button class="tablinks" onclick="openReg(event, 'Kompanija')">Kompanija</button>
</div>   


    <?php echo form_error(); ?>
    <?php echo $err ?? '' ?>

    <div id="Student" class="tabcontent overflow-auto">
        <h4>Povezite se sa drugim studentima i inovativnim kompanijama</h4>
       <form name="regStu" method="POST" action="<?php echo site_url('Registracija/reg') ?>" >
                       
        <input name="korisnicko" type="text" value="<?php echo set_value('korisnicko') ?>" placeholder="Korisnicko ime"><?php echo form_error('korisnicko') ?> <br/>
        <input name="ime" type="text" value="<?php echo set_value('ime') ?>" placeholder="Ime"><?php echo form_error('ime') ?> <br/>
        <input name="prezime" type="text" value="<?php echo set_value('prezime') ?>" placeholder="Prezime"><?php echo form_error('prezime') ?> <br/>
        <input type="radio" name="gridRadios" value="m" checked>
        Muski
        <input type="radio" name="gridRadios" value="z">
        Zenski<br/>
        <input name ="kurs" type="text" value="<?php echo set_value('kurs') ?>" placeholder="Kurs"><?php echo form_error('drzavljanstvo') ?> <br/>
        <input name="drzavljanstvo" type="text" value="<?php echo set_value('drzavljanstvo') ?>" placeholder="Drzavljanstvo"><?php echo form_error('drzavljanstvo') ?> <br/>
        <input name="telefon" type="text" value="<?php echo set_value('telefon') ?>" placeholder="broj telefona"><?php echo form_error('telefon') ?> <br/>
        <input name="adresa" type="text" value="<?php echo set_value('adresa') ?>" placeholder="Adresa"><?php echo form_error('adresa') ?> <br/>
        <input name="mesto" type="text" value="<?php echo set_value('mesto') ?>"  placeholder="Mesto"><?php echo form_error('mesto') ?> <br/>
        <input name="pin" type="text" value="<?php echo set_value('pin') ?>"  placeholder="PIN"><?php echo form_error('pin') ?> <br/>
        <input name="status" type="text" value="<?php echo set_value('status') ?>"  placeholder="Status"><?php echo form_error('status') ?> <br/>
        <input name="lozinka" type="password"  placeholder="Lozinka"><?php echo form_error('lozinka') ?> <br/>
        <input name="ponLozinka" type="password"  placeholder="Ponovi lozinku"><?php echo form_error('ponLozinka') ?> <br/>
        <input type="email" name="email"  placeholder="E-mail" value="<?php echo set_value('email') ?>"><?php echo form_error('email') ?> <?php echo form_error('email') ?> <br/>
        <input type="date" name="datum"  placeholder="datum rodjenja" value="<?php echo set_value('datum') ?>"> <?php echo form_error('datum') ?>  <br/>
        <input type="submit"  name="reg" value="Registruj se" class="btn btn-primary">
                           
        </form>
    </div>
    <div id="Kompanija" class="tabcontent overflow-auto">
         <h4>Pronadjite najbolje studente za vas posao</h4>
    <form name="regKom" method="POST" action="<?php echo site_url('Registracija/reg') ?>">
            <input type="text" name="naziv" value="<?php echo set_value('naziv') ?>" placeholder="Naziv"><?php echo form_error('naziv') ?>
            <br/>
            <input type="text" name="adresa" value="<?php echo set_value('adresa') ?>" placeholder="Adresa sedista"><?php echo form_error('adresa') ?>
            <br/>
            <input type="text" name="mesto" value="<?php echo set_value('mesto') ?>" placeholder="Mesto"><?php echo form_error('mesto') ?>
            <br/>
            <input type="number" name="pib" value="<?php echo set_value('pib') ?>" placeholder="PIB"><?php echo form_error('pib') ?>
            <br/>
            <input type="text" name="telefon" value="<?php echo set_value('telefon') ?>" placeholder="Telefon"><?php echo form_error('telefon') ?>
            <br/>
            <input type="email" name="email" value="<?php echo set_value('email') ?>" placeholder="Email"><?php echo form_error('telefon') ?>
            <br/>
            <textarea name="opis" placeholder="Opis vase kompanije"></textarea>
            <br/>
            <input type="text" name="oblast" value="<?php echo set_value('oblast') ?>" placeholder="Oblast delovanja"><?php echo form_error('oblast') ?>
            <br/>
            <input type="number" name="brzaposlenih" value="<?php echo set_value('brzaposlenih') ?>" placeholder="Broj zaposlenih"><?php echo form_error('brzaposlenih') ?>
            <br/>
            <input type="text" name="sajt" value="<?php echo set_value('sajt') ?>" placeholder="Veb adresa sajta"><?php echo form_error('sajt') ?>
            <br/>
            <input type="text" name="korisnicko" value="<?php echo set_value('korisnicko')?>" placeholder="Odaberite korisnicko ime"><?php echo form_error('korisnicko') ?>
            <br/>
            <input type="password" name="lozinka" placeholder="Sifra"><?php echo form_error('lozinka') ?>
            <br/>
            <input type="password" name="ponlozinka" placeholder="Potvrdite sifru"><?php echo form_error('ponlozinka') ?>
            <br/>
            <input type="submit"  name="reg" value="Registruj se" class="btn btn-primary">
    </form>
    </div>
   </div>
</div>
<script>
 function openReg(evt, regName) {
  
 var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(regName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();
    
</script>
    
</body>

