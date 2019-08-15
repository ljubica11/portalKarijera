<!DOCTYPE html>

<div class="wrapper">
    <div class="regwrapper">
        <div class="tabcontentInfo overflow-auto">
            
            <?php if(isset($interesovanja)){?>
            
            
            <h4> Vasa interesovanja: </h4>
            <form name="formaInteresovanja" method="POST" action="<?php echo site_url('Registracija/dodajInteresovanjaZaKorisnika');?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                <?php foreach ($interesovanja as $interesovanje){
                    $idInt = $interesovanje['idInt'];
                    $nazivInt = $interesovanje['naziv'];
                    echo "<input type='checkbox' name='int[]' value='$idInt'>$nazivInt<br/>";
                }
                ?>
                <div id="dodataInteresovanja">
                </div>
                <br/><br/>
                Vasa interesovanja nisu na listi? Dodajte ih!
                <br>
                <input type='text' name='novoInt' id="novoInteresovanje" placeholder="Dodaj interesovanje">
                <input type="button" name='dodajNovoInt' value="Dodaj" onclick="dodajInt()">
                <br/><br/>
                <input type="submit" name='dalje' value="Dalje" class='nextButton'>
            </form>
            
            
            <?php } else if(isset ($vestine)){ ?>
            
            
             <h4> Vase vestine: </h4>
            <form name="formaVestine" method="POST" action="<?php echo site_url('Registracija/dodajVestineZaKorisnika');?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                <?php foreach ($vestine as $vestina){
                    $idVes = $vestina['idVes'];
                    $nazivVes = $vestina['naziv'];
                    echo "<input type='checkbox' name='ves[]' value='$idVes'>$nazivVes<br/>";
                }
                ?>
                <div id="dodateVestine">
                </div>
                <br/><br/>
                Vase vestine nisu na listi? Dodajte ih!
                <br>
                <input type='text' name='novaVes' id="novaVestina" placeholder="Dodaj vestine">
                <input type="button" name='dodajNovuVes' value="Dodaj" onclick="dodajVes()">
                <br/><br/>
                <input type="submit" name='dalje' value="Dalje" class='nextButton'>
            </form>
             
             
            <?php     
                 }else if(isset($fakulteti)){
            ?>
             
             
             <h4> Podaci o zavrsenim studijama </h4>
             Ovde mozete da ostavite podatke o stecenoj diplomi. Ukoliko nemate diplomu ili jos uvek studirate, predjite na sledeci korak.
             <br/><br/>
             <form name="diplomaForma" method="POST" action="<?php echo site_url('Registracija/dodajDiplomuZaKorisnika') ?>">
                 <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                 Fakultet koji ste zavrsili: <br/>
                 <div id="selectfakultet"> 
                 <select name="fakultet" id="listafakultet" onchange="dodajInput('fakultet')">
                    <option disabled selected value="">Odaberite fakultet</option>
                    <?php 
                            foreach ($fakulteti as $fakultet){
                                $naziv = $fakultet["naziv"];
                                $idFak = $fakultet["idFak"];
                                echo "<option value='$idFak'>$naziv</option>";
                            }
                            ?>
                    <option value="dodaj">Dodaj fakultet</option>
                 </select>
                </div>
                <div id="fakultet">   
                </div>
                 <input type="text" name="odsek" placeholder="Odsek">
                 <br/>
                 Nivo studija: 
                <br/>
                <input type="radio" name="nivo" value="osnovne">Osnovne akademske studije<br>
                <input type="radio" name="nivo" value="master">Master akademske studije<br>
                <input type="radio" name="nivo" value="specijalisticke">Specijalisticke akademske studije<br>
                <input type="radio" name="nivo" value="doktorske">Doktorske akademske studije<br>
                <input type="radio" name="nivo" value="strukovne">Strukovne studije<br>
                <input type="number" name="godUpisa" placeholder="Godina upisa">
                <br/>
                <input type="number" name="godZavrsetka" placeholder="Godina zavrsetka">
                <br/>
                <input type="text" name="zvanje" placeholder="Steceno zvanje">
                <br/>
                <input type="checkbox" name="vidDipl" value="1">Ne zelim da ovaj podatak bude javan
                <br/><br/>
                <input type="submit" name="dalje" value="Dalje" class='nextButton'>
             </form>
             
             
             <?php
                 }else if(isset($kompanije)){
             ?>
             
         
             <h4>Radno iskustvo</h4>
            <br/><br/>
            <form name="iskustvoForma" method="POST" action="<?php echo site_url('Registracija/dodajIskustvoZaKorisnika')?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
            Kompanija:<br/>
            <div id="selectkompanija"> 
                 <select name="kompanija" id="listakompanija" onchange="dodajInput('kompanija')">
                    <option disabled selected value="">Odaberite kompaniju</option>
                    <?php 
                            foreach ($kompanije as $kompanija){
                                $naziv = $kompanija["naziv"];
                                $idKom = $kompanija["idSifKo"];
                                echo "<option value='$idKom'>$naziv</option>";
                            }
                            ?>
                    <option value="dodaj">Dodaj kompaniju</option>
                 </select>
                </div>
                <div id="kompanija">   
                </div>
            Pozicija:<br/>
            <div id="selectpozicija"> 
                 <select name="pozicija" id="listapozicija" onchange="dodajInput('pozicija')">
                    <option disabled selected value="">Odaberite poziciju</option>
                    <?php 
                            foreach ($pozicije as $pozicija){
                                $naziv = $pozicija["naziv"];
                                $idPoz = $pozicija["idPoz"];
                                echo "<option value='$idPoz'>$naziv</option>";
                            }
                            ?>
                    <option value="dodaj">Dodaj poziciju</option>
                 </select>
                </div>
                <div id="pozicija">   
                </div>
            Sediste kompanije:
            <div id="selectsediste">
            <select name="sediste" id="listasediste" onchange="dodajInput('sediste')">
                <option disabled selected value="">Sediste</option>
                <?php 
                        foreach ($gradovi as $grad){
                            $naziv = $grad["naziv"];
                            $idGra = $grad["idGra"];
                            echo "<option value='$idGra'>$naziv</option>";
                        }
                        ?>
                <option value="dodaj">Dodaj grad</option>
            </select>
            </div>
            <div id="sediste">  
            </div>
            Pocetak radnog odnosa: <input type="date" name="od">
            <br/>
            Kraj radnog odnosa: <input type="date" name="do">
            <br/><br/>
            <input type="checkbox" name="vidRad" value="1">Ne zelim da ovaj podatak bude javan          
            <br/><br/>
            <input type="submit" name="dalje" value="Zavrsi registraciju" class="nextButton">
            </form> 
             
                 <?php }?>
            
    </div>
</div>

    <script>
    function dodajInt(){
            inter = document.getElementById("novoInteresovanje").value;
            novaInt = document.getElementById("dodataInteresovanja");
            console.log(novaInt.innerHTML);
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("novoInteresovanje").value ="";
                    novaInt.innerHTML+=this.responseText;
                    //document.getElementById("dodataInteresovanja").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("POST", "<?php echo site_url('Registracija/dodajNovaInteresovanjaReg'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("inter="+inter);
  
        }
        
    function dodajVes(){
            vestina = document.getElementById("novaVestina").value;
            novaVes = document.getElementById("dodateVestine");
            console.log(novaVes.innerHTML);
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("novaVestina").value ="";
                    novaVes.innerHTML+=this.responseText;
                }
            }
            xmlhttp.open("POST", "<?php echo site_url('Registracija/dodajNoveVestineReg'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("vestina="+vestina);
        
        
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