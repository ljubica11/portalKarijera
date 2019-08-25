<!DOCTYPE html>

<div class="wrapper">
    <div class="regwrapper">
        <div class="tabInfo">
            <?php 
            if(isset($interesovanja)){
                echo "<h4> Vaša interesovanja </h4>";
            }else if(isset($vestine)){
                echo "<h4> Vaše vestine </h4>";
            }else if(isset ($fakulteti)){
                echo "<h4> Podaci o završenim studijama </h4>";
            }else if(isset ($kompanije)){
                echo "<h4>Radno iskustvo</h4>";
            }
            ?>
        </div>
        <div class="tabcontentInfo overflow-auto scroll">
            
            <?php if(isset($interesovanja)){?>
            
            
<!--            <div class="naslovReg"><h4> Vasa interesovanja </h4></div>-->
            <form class="dodatneInfoForma" name="formaInteresovanja" method="POST" action="<?php echo site_url('Registracija/dodajInteresovanjaZaKorisnika');?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                <?php foreach ($interesovanja as $interesovanje){
                    $idInt = $interesovanje['idInt'];
                    $nazivInt = $interesovanje['naziv'];              
                   echo "<label for='$idInt' class='btn btn-primary'>$nazivInt <input type='checkbox' name='int[]' value='$idInt' id='$idInt' class='badgebox'><span class='badge'>&check;</span></label><br/>";
                
                }
                ?>
                <div id="dodataInteresovanja">
                </div>
                <br/><br/>
                Vasa interesovanja nisu na listi? Dodajte ih!
                <br>
                <div class='form-row'>
                    <div class='col-6 offset-3'>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Dodaj interesovanje" aria-label="Recipient's username" aria-describedby="basic-addon2" name='novoInt' id="novoInteresovanje">
                            <div class="input-group-append">
                              <button class="btn btn-primary" name='dodajNovoInt' onclick="dodajInt()" type="button">Dodaj</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <br/><br/>
                <input type="submit" name='dalje' value="Dalje" class='nextButton btn btn-primary btn-lg'>
            </form>
            
            
            <?php } else if(isset ($vestine)){ ?>
            
            
<!--            <div class="naslovReg"><h4> Vase vestine: </h4></div>-->
            <form class="dodatneInfoForma" name="formaVestine" method="POST" action="<?php echo site_url('Registracija/dodajVestineZaKorisnika');?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                <?php foreach ($vestine as $vestina){
                    $idVes = $vestina['idVes'];
                    $nazivVes = $vestina['naziv'];
//                    echo "<input type='checkbox' name='ves[]' value='$idVes'>$nazivVes<br/>";
                    
                     echo "<label for='$idVes' class='btn btn-primary'>$nazivVes <input type='checkbox' name='ves[]' value='$idVes' id='$idVes' class='badgebox'><span class='badge'>&check;</span></label><br/>";
                }
                ?>
                <div id="dodateVestine">
                </div>
                <br/><br/>
                Vaše veštine nisu na listi? Dodajte ih!
                <br>
                
                <div class='form-row'>
                    <div class='col-6 offset-3'>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='novaVes' id="novaVestina" placeholder="Dodaj vestine">
                            <div class="input-group-append">
                              <button class="btn btn-primary" name='dodajNovuVes' onclick="dodajVes()" type="button">Dodaj</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
<!--                <input type='text' name='novaVes' id="novaVestina" placeholder="Dodaj vestine">
                <input type="button" name='dodajNovuVes' value="Dodaj" onclick="dodajVes()">-->
                <br/><br/>
                <input type="submit" name='dalje' value="Dalje" class='nextButton btn btn-primary btn-lg'>
            </form>
             
             
            <?php     
                 }else if(isset($fakulteti)){
            ?>
             
           Ovde mozete da ostavite podatke o stečenoj diplomi. Ukoliko nemate diplomu ili još uvek studirate, pređite na sledeći korak.
             <br/>
             <div class="form-row">
                 <div class="col-6 offset-3">
             <form class="dodatneInfoForma" name="diplomaForma" method="POST" action="<?php echo site_url('Registracija/dodajDiplomuZaKorisnika') ?>">
                 <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                 <div id="selectfakultet"> 
                 <select class="form-control" name="fakultet" id="listafakultet" onchange="dodajInput('fakultet')">
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
                 <br/><input class="form-control" type="text" name="odsek" placeholder="Odsek">
                 <br/>
                 <div class="text-left">
                     <b>Nivo studija: </b>
                <br/>
                <input type="radio" name="nivo" value="osnovne"> Osnovne akademske studije<br>
                <input type="radio" name="nivo" value="master"> Master akademske studije<br>
                <input type="radio" name="nivo" value="specijalisticke"> Specijalističke akademske studije<br>
                <input type="radio" name="nivo" value="doktorske"> Doktorske akademske studije<br>
                <input type="radio" name="nivo" value="strukovne"> Strukovne studije<br><br/>
                 </div>
                <input class="form-control" type="number" name="godUpisa" placeholder="Godina upisa">
                <br/>
                <input class="form-control" type="number" name="godZavrsetka" placeholder="Godina zavrsetka">
                <br/>
                <input class="form-control" type="text" name="zvanje" placeholder="Steceno zvanje">
                <br/>
                <input type="checkbox" name="vidDipl" value="1">Ne želim da ovaj podatak bude javan
                <br/><br/>
                <input type="submit" name="dalje" value="Dalje" class='nextButton btn btn-primary btn-lg'>
             </form>
             </div>
             </div>
             
             
             <?php
                 }else if(isset($kompanije)){
             ?>
             
         Ovde možete ostaviti podatke o ranijem ili trenutnom radnom angažmanu. 
         <br/>
         *Sajt prihvata samo <b>JEDNO</b> radno iskustvo, tako da - birajte pažljivo šta ćete napisati. 
         <div class="form-row">
                 <div class="col-6 offset-3">
            <form class="dodatneInfoForma" name="iskustvoForma" method="POST" action="<?php echo site_url('Registracija/dodajIskustvoZaKorisnika')?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
            <div id="selectkompanija"> 
                 <select class="form-control" name="kompanija" id="listakompanija" onchange="dodajInput('kompanija')">
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
                <br/>
            <div id="selectpozicija"> 
                 <select class="form-control" name="pozicija" id="listapozicija" onchange="dodajInput('pozicija')">
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
                <br/>
            <div id="selectsediste">
            <select class="form-control" name="sediste" id="listasediste" onchange="dodajInput('sediste')">
                <option disabled selected value="">Sedište</option>
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
            <br/>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">Početak radnog odnosa:</span>
                </div>
                <input type="date" class="form-control" name="od">
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3">Kraj radnog odnosa:</span>
                </div>
                <input class="form-control" type="date" name="do">
            </div>
            
            
            
<!--            Pocetak radnog odnosa: <input class="form-control" type="date" name="od">
            <br/>
            Kraj radnog odnosa: <input class="form-control" type="date" name="do">-->
           
            <input type="checkbox" name="vidRad" value="1">Ne želim da ovaj podatak bude javan          
            <br/><br/>
            <input type="submit" name="dalje" value="Zavrsi registraciju" class='nextButton btn btn-primary btn-lg'>
            </form> 
                 </div>
         </div>
             
                 <?php }?>
            
    </div>
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
           document.getElementById(inputDiv).innerHTML = "<div class='addInput'><input type='text' class='form-control' id='dodatakZaSifrarnik' placeholder='Dodaj novo'><input type='button' class='btn btn-primary btn-sm' value='Dodaj' onclick=\"dodajUSifrarnik(\'" + inputDiv + "\')\"></div>";
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