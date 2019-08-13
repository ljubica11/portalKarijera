<!DOCTYPE html>
<?php   
    if($this->session->has_userdata('user')){
        $tipKorisnika = $this->session->userdata('user')['tip'];
        }else{
            $tipKorisnika = "gost";         
        }
 
        ?>

        <div class="container-fluid" style="margin-bottom: 90px">
            <div class="row">
                <div class="col-3 levo">
                    <b>Kategorije: </b>
                    <br/>
                    <?php
                    foreach ($kategorije as $k) {
                        $idKatDis = $k['idKatDis'];
                        $naziv = $k['naziv'];
                       
                        echo "<div class='list-group' id='myList' role='tablist'><a href='#' class='list-group-item list-group-item-action text-center' id='list-$idKatDis-list' role='tab' aria-controls='$idKatDis' onclick='diskusije($idKatDis), sakrijDiv()'>" . $k['naziv'] . "</a></div><br/>";
       
                    } ?>
                    
                    
                    <?php 
                    if($tipKorisnika != 'gost'){
                        echo ' 
                    
                    
                    <div>
                    <input type="button" onclick="prikaziFormuKat()" value="Dodaj kategoriju" class="btn btn-primary btn-lg btn-block">
                    </div>
                    
                       ';}?>
                    
                    <?php if($tipKorisnika != 'gost'){?>
                         
                            
                    <div id="formaDivKat">
                        <form name="dodajKat" method="POST" action="<?php echo site_url('Diskusije/dodajKategoriju')?>" >
                            <input type="text" name="naziv" placeholder="Naziv kategorije">
                            <input type="submit" name="dodaj" value="Dodaj" class="btn btn-primary  btn-lg btn-block">
                            
                        </form>
                    
                    
                   
                </div>
                    <?php  } ?>
                </div>
               
                <div class="col-6">
                    <div id="diskusijePoKategoriji"></div>
                    <div id="diskusije"> 
                    <?php  foreach($sveDiskusije as $s){
                        $autor = $s['korisnik'];
                        ?>
                    
                        <div class="centar">

        <b>Naziv diskusije: </b><?php echo $s['naziv'] ?></b><br/>
        <b>Opis: </b><?php echo $s['opis'] ?><br/>
        <b>Autor: </b><?php echo $s['korisnik'] ?><br/>
        <b>Datum pokretanja: </b><?php echo $s['datum'] ?><br/> 
         <?php $id = $s['idDis'] ?>
        <?php echo "<a href='#' class='badge badge-primary' onclick ='postovi($id)'> <b>Pogledaj postove</b></a>" ?>
        <?php if($s['vidljivost'] != 'autor' && $tipKorisnika != 'gost'){ echo "<a href='#' class='badge badge-primary' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a>" ;}?>
        <?php if($this->session->userdata('user')['korisnicko']== $autor && $s['vidljivost'] != 'autor'){ echo "<a href='#' class='badge badge-primary float-right' onclick ='arhiviraj($id)'> <b>Arhiviraj</b></a><br/>" ;}?>
                    </div> 
                        
                     <?php  }  ?>
                        <?php if($tipKorisnika != 'gost'){
                            echo '  
                        }
                   <div class="centar"> <input type="button" class="btn btn-primary btn-lg btn-block" onclick="prikaziFormu()" value="Zapocni novu diskusiju">
                   </div>
                        ';}  ?>
                </div>
                    
                    
                    <div class="centar" id="formaDiv">
    <?php
    $ulogovani = $this->session->userdata('user')['korisnicko'];
    $kategorije = $this->DiskusijeModel->dohvatiKategorije();
    ?>
    <?php if($tipKorisnika != 'gost') { ?>
        
       
    
    <form name="dodajDsk" method="POST" action="<?php echo site_url("Diskusije/dodajDiskusiju")?> " >
        <table>
            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
            <tr><td><b>Naziv diskusije: </b></td><td><input type="text" name="naziv"></td></tr>
            <tr><td><b>Opis: </b></td><td><input type="text" name="opis" ></td></tr>
            <tr><td><b>Kategorija: </td><td></b>
                    <select name="kategorija">
                        <option disabled selected value="">Izaberi kategoriju</option>
  
    <?php } if($tipKorisnika != 'gost'){
                        foreach ($kategorije as $k) {
                            $idKat = $k['idKatDis'];
                            $nazivKat = $k['naziv'];
                            echo "<option value='$idKat'>$nazivKat</option>";
                        }
                        } ?></select></td></tr>
                    <?php if($tipKorisnika != 'gost'){?>
                       
                    
                    
            <tr><td><b>Nivo vidljivosti:<br> </b>   </tr></td>
        <tr><td></td><td>
        
                                <input type="radio" name="vidljivost" value="studenti">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici">Svi korisnici sajta<br>
                                <input type="radio" name="vidljivost" value="kurs" onclick="ispisiOpcije(value)">Studenti odredjenog kursa<br>
                                <div id="kurs"></div>
                                <input type="radio" name="vidljivost" value="grupa" onclick="ispisiOpcije(value)">Formirana grupa studenata<br>
                                <div id="grupa"></div>
            </td>
     

            <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
        </table>
    </form>
                   
                    <?php }?>
</div>
                    
                </div>      
                
                
                <div class="col-3">
                    <div id='wrapper'></div>
                    <div id="postovi"></div>
                    <br><br>

                </div>

            </div>
        </div> 

           
        </div>
        </div>



        <script>
            function diskusije(id) {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("diskusijePoKategoriji").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("GET", "<?php echo site_url('Diskusije/ispisiDiskusije') ?>?id=" + id, true);
                xmlhttp.send();
            }
            
             function ispisiOpcije(value){
        xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                       document.getElementById(value).innerHTML = this.responseText; 
                       if(value == "kurs"){
                           document.getElementById("grupa").innerHTML ="";
                       }else if(value == "grupa"){
                           document.getElementById("kurs").innerHTML ="";
                       }
                   }
               };
            xmlhttp.open("POST", "<?php echo site_url('Diskusije/ispisiOpcije'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("tip="+value);
   }
            
       
            function postovi(id) {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("postovi").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("GET", "<?php echo site_url('Diskusije/ispisiPostove') ?>?id=" + id, true);
                xmlhttp.send();
            }
            function dodajdiv(id) {
                document.getElementById('wrapper').innerHTML += '<div class="postdesno" id="wrapper">\n\
              <input type="text" id="novipost" class="form-control" width="90%">\n\
              <input type="button" class="btn btn-outline-primary btn-sm" name="Posalji" value="Posalji" onclick="dodajpost(' + id + '); cleartext()" id="idDis" class="btn btn-primary"></div>';
            }
            function prikaziFormu() {
                document.getElementById("formaDiv").style.display = "block";
            }
            
            function prikaziFormuKat(){
                
                document.getElementById("formaDivKat").style.display = "block";
            }
            
            function sakrijDiv(){
                
                document.getElementById("diskusije").style.display = "none";
            }
            function dodajpost(id) {
                var tekst = document.getElementById('novipost').value;
                var idDis = id;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        //document.getElementById("novipost").value ="";
                        document.getElementById("postovi").innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "<?php echo site_url('Diskusije/dodajPost'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idDis=" + idDis + "&tekst=" + tekst);
            }
            function cleartext() {
                document.getElementById("novipost").value = '';
            }
            
            function arhiviraj(id){
                
       
     xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function(){
       
     }
          xmlhttp.open('GET', "<?php echo site_url('Diskusije/arhivirajDiskusiju') ?>?idDis=" + id, true);
          xmlhttp.send();
                
                
    }
            
         function lajk(idPos){
     
     
     xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function(){
         if(this.readyState == 4 && this.status == 200 ){
             document.getElementById('brLajkova' + idPos).innerHTML = (this.responseText);
             
         }
     }
          xmlhttp.open('GET', "<?php echo site_url('Diskusije/lajkPost') ?>?idPos=" + idPos, true);
          xmlhttp.send();
     
     
    
 }
        </script>
























