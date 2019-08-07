
<!DOCTYPE html>

        <div class="container-fluid" style="margin-bottom: 90px">
            <div class="row">
                <div class="col-3 levo">
                    <b>Kategorije: </b>
                    <br/>
                    <?php
                    foreach ($kategorije as $k) {
                        $idKatDis = $k['idKatDis'];
                        $naziv = $k['naziv'];
                       
                        echo "<a href='#' class='list-group-item list-group-item-action' onclick='diskusije($idKatDis)'>" . $k['naziv'] . "</a><br/>";
       
                    } ?>
                     <div>
                    <input type="button" onclick='prikaziFormuKat()' value="Dodaj kategoriju" class="btn btn-primary btn-lg btn-block">
                    </div>
                    
                    <div id='formaDivKat'>
                        <form name='dodajKat' method="POST" action="<?php echo site_url('Diskusije/dodajKategoriju') ?>">
                            <input type="text" name='naziv' placeholder="Naziv kategorije">
                            <input type="submit" name="dodaj" value="Dodaj" class="btn btn-primary  btn-lg btn-block">
                            
                        </form>
                    </div>
                </div>
               
                <div class="col-6">
                    <div id="diskusije">
                    <?php  foreach($diskusije as $d){
                        
                        ?>
                    
                        <div class="centar">

        <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
        <b>Opis: </b><?php echo $d['opis'] ?><br/>
        <b>Autor: </b><?php echo $d['korisnik'] ?><br/>
        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
         <?php $id = $d['idDis'] ?>
        <?php echo "<a href='#' class='badge badge-primary' onclick ='postovi($id)'> <b>Pogledaj postove</b></a>" ?>
        <?php echo "<a href='#' class='badge badge-primary' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a><br/>" ?>
                    </div> 
                        
                     <?php  }  ?>
                   
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
                        document.getElementById("diskusije").innerHTML = this.responseText;

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






























