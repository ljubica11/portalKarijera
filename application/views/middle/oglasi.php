<!DOCTYPE html>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 levo"> 
          <?php echo $pretraga; ?>
        </div>
        
        <div class="col-6">  
            <?php  if($this->session->userdata('user')['tip'] == "k"){
                    $idKor = $this->session->userdata('user')['idKor'];
                    
                    echo $dodaj;
            ?>

            
                <input type="button" id="mojiOglasi" value="Moji oglasi" class="btn btn-primary" onclick="mojiOglasi(<?php echo $idKor ?>)">
                <input type="button" id="dodajOglas" value="Dodaj oglas" class="btn btn-primary" onclick="dodajOglas(<?php echo $idKor ?>)"> 
            <?php }  echo $oglasi; ?> 
        </div>
        
        <div class="col-3">
        </div>
            
        </div>
    </div>


<script>
   
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
            xmlhttp.open("POST", "<?php echo site_url('Oglasi/dohvatiOpcije'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("tip="+value);
   }
    
    function pretraziOglase(tip){
       var rec = document.getElementById("pretragaPoslova").value;
       var selectLista = document.getElementById("grad");
       var grad = selectLista.options[selectLista.selectedIndex].value;
       xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){ 
                       document.getElementById("oglasi").innerHTML = this.responseText; 
                       document.getElementById("pretragaPoslova").value = "";
                   }
               };
            xmlhttp.open("POST", "<?php echo site_url('Oglasi/pretragaOglasa'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("pretraga="+rec+"&grad="+grad+"&tip="+tip);
   }
   
    function mojiOglasi(idKor){ 
    
        var dugme = document.getElementById("mojiOglasi");
             xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                       dugme.value = "Svi oglasi";
                       dugme.setAttribute( "onClick", "sviOglasi()" );
                       document.getElementById("oglasi").innerHTML = this.responseText; 
                       
                   }
               };
               xmlhttp.open("GET", "<?php echo site_url('Oglasi/dohvatiOglaseKorisnika')?>?idKor="+idKor, true);
               xmlhttp.send(); 
          
   }
   
   function sviOglasi(){
       var dugme = document.getElementById("mojiOglasi");
        xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                       dugme.value = "Moji oglasi";
                       dugme.setAttribute( "onClick", "mojiOglasi(<?php echo $this->session->userdata('user')['idKor']?>)" );
                       document.getElementById("oglasi").innerHTML = this.responseText; 
                       
                   }
               };
               xmlhttp.open("GET", "<?php echo site_url('Oglasi/dohvatiSveOglase')?>", true);
               xmlhttp.send(); 
          
   }
   
   function dodajInput(inputDiv){
       var selectLista = document.getElementById("lista"+inputDiv);
       var odabranaOpcija = selectLista.options[selectLista.selectedIndex].value;
             if(odabranaOpcija == "dodaj"){
           document.getElementById(inputDiv).innerHTML = "<div class='addInput'><input type='text' id='dodatakZaSifrarnik' placeholder='Dodaj novo'><input type='button' class='btn btn-sm btn-info' value='Dodaj' onclick=\"dodajUSifrarnik(\'" + inputDiv + "\')\"></div>";
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
            xmlhttp.open("POST", "<?php echo site_url('Oglasi/dodajMesto'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("dodatak="+dodatakZaSifrarnik+"&tip="+tip);
   }
   
   function dodajInputOglasi(div){
       document.getElementById(div).innerHTML += "<input type='text' name='"+div+"[]' class='form-control obaveze'><br/>";
   }
   
   // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("dodajOglas");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
   
   
 
    </script>
