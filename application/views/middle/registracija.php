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
       <form name="regStu" id="regStuForm" method="POST" action="<?php echo site_url('Registracija/regStu') ?>">
                       
        <input name="korisnicko" type="text" value="<?php echo set_value('korisnicko') ?>" placeholder="Korisnicko ime"><?php echo form_error('korisnicko') ?> <br/>
        <input name="ime" type="text" value="<?php echo set_value('ime') ?>" placeholder="Ime"><?php echo form_error('ime') ?> <br/>
        <input name="srednjeIme" type="text" value="<?php echo set_value('srednjeIme') ?>" placeholder="Srednje ime"><?php echo form_error('srednjeIme') ?> <br/>
        <input name="prezime" type="text" value="<?php echo set_value('prezime') ?>" placeholder="Prezime"><?php echo form_error('prezime') ?> <br/>
        <input type="radio" name="pol" value="m" checked>
        Muski
        <input type="radio" name="pol" value="z">
        Zenski<br/>
        <select name="kurs">
            <option disabled selected value="">Kurs koji ste zavrsili</option>
            <?php 
            foreach ($kursevi as $kurs){
                $naziv = $kurs["naziv"];
                $idK = $kurs["idKurs"];
                echo "<option value='$idK'>$naziv</option>";
            }
            ?>
        </select> <br/> <?php echo form_error('kurs');?>   
        <select name="drzavljanstvo">
            <option disabled selected value="">Drzavljanstvo</option>
            <?php 
            foreach ($drzavljanstvo as $drz){
                $naziv = $drz["naziv"];
                $idD = $drz["idDrz"];
                echo "<option value='$idD'>$naziv</option>";
            }
            ?>
        </select><br/> <?php echo form_error('drzavljanstvo');?>
        <input name="telefon" type="text" value="<?php echo set_value('telefon') ?>" placeholder="broj telefona"><?php echo form_error('telefon') ?> <br/>
        <input name="adresa" type="text" value="<?php echo set_value('adresa') ?>" placeholder="Adresa"><?php echo form_error('adresa') ?> <br/>
        <div id="selectmesto">
        <select name="mesto" onchange="dodajInput('mesto')" id="listamesto"> 
            <option disabled selected value="">Mesto</option>
              <?php 
            foreach ($mesta as $mesto){
                $naziv = $mesto["naziv"];
                $idG = $mesto["idGra"];
                echo "<option value='$idG'>$naziv</option>";
            }
            ?>
           <option class="dodaj" value="dodaj">Dodaj novo mesto</option>
           </select>
        </div>
        <div id="mesto">
        </div> 
        <?php echo form_error('mesto');?>
        <input name="pin" type="text" value="<?php echo set_value('pin') ?>"  placeholder="PIN"><?php echo form_error('pin') ?> <br/>
        <select name="status" id="st" onchange="formaZaStudije()">
            <option disabled selected value="">Trenutni status</option>
            <option value="student">Student</option>
            <option value="nezaposleni">Nezaposleni</option>
            <option value="zaposleni">Zaposleni</option>   
        </select><br/><?php echo form_error('status');?>
        <div id="res">
        </div>
        <input name="lozinka" type="password"  placeholder="Lozinka"><?php echo form_error('lozinka') ?> <br/>
        <input name="ponLozinka" type="password"  placeholder="Ponovi lozinku"><?php echo form_error('ponLozinka') ?> <br/>
        <input type="email" name="email"  placeholder="E-mail" value="<?php echo set_value('email') ?>"><?php echo form_error('email') ?> <br/>
        <input type="date" name="datum"  placeholder="datum rodjenja" value="<?php echo set_value('datum') ?>"> <?php echo form_error('datum') ?>  <br/>
        <input type="submit"  name="reg" value="Registruj se" class="btn btn-primary">  
        </form>
    </div>
    <div id="Kompanija" class="tabcontent overflow-auto">
         <h4>Pronadjite najbolje studente za vas posao</h4>
    <form name="regKom" method="POST" action="<?php echo site_url('Registracija/regKomp') ?>">
            <input type="text" name="naziv" value="<?php echo set_value('naziv') ?>" placeholder="Naziv"><?php echo form_error('naziv') ?>
            <br/>
            <select name="sediste"> 
                <option disabled selected value="">Sediste</option>
            <?php 
            foreach ($mesta as $mesto){
                $naziv = $mesto["naziv"];
                $idG = $mesto["idGra"];
                echo "<option value='$idG'>$naziv</option>";
            }
            ?>
        </select><br/><?php echo form_error('sediste') ?>
            
            <input type="number" name="pib" value="<?php echo set_value('pib') ?>" placeholder="PIB"><?php echo form_error('pib') ?>
            <br/>
            <input type="text" name="telefon" value="<?php echo set_value('telefon') ?>" placeholder="Telefon"><?php echo form_error('telefon') ?>
            <br/>
            <input type="email" name="email" value="<?php echo set_value('email') ?>" placeholder="Email"><?php echo form_error('telefon') ?>
            <br/>
            <textarea name="opis" placeholder="Opis vase kompanije"><?php echo set_value('opis'); ?> </textarea><?php echo form_error('opis') ?>
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

   function formaZaStudije(){
       var st = document.getElementById("st");
       var status = st.options[st.selectedIndex].value;
       if(status === "student"){
             xmlhttp=new XMLHttpRequest();
               xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                       document.getElementById("res").innerHTML = this.responseText; 
                   }
               };
               xmlhttp.open("GET", "<?php echo site_url('Registracija/podaciStudije')?>", true);
               xmlhttp.send(); 
       }else{
           document.getElementById("res").innerHTML = "";
       }  
   }
   
       function dodajInput(inputDiv){
       var selectLista = document.getElementById("lista"+inputDiv);
       var odabranaOpcija = selectLista.options[selectLista.selectedIndex].value;
             if(odabranaOpcija == "dodaj"){
           document.getElementById(inputDiv).innerHTML = "<div class='addInput'><input type='text' id='dodatakZaSifrarnik' placeholder='Dodaj novo'><input type='button' class='btn btn-sm' value='Dodaj' onclick=\"dodajUSifrarnik(\'" + inputDiv + "\')\"></div>";
       }  else{
           document.getElementById(inputDiv).innerHTML="";
       }
   }
   
   function dodajUSifrarnik(tip){
       var dodatakZaSifrarnik = document.getElementById("dodatakZaSifrarnik").value;
        xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById(tip).innerHTML ="";
                    document.getElementById("select"+tip).innerHTML=this.responseText;
                }
            };
            xmlhttp.open("POST", "<?php echo site_url('Registracija/izmeniSifrarnik'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("dodatak="+dodatakZaSifrarnik+"&tip="+tip);
   }
</script>
    
</body>

