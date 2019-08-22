
<div class="container-fluid">
    <div class="row">
        <div class="col-3 levo">
       <?php echo $osnovniPodaci; ?>

            </div>
            <div class="col-5" id="centarPocetna">
       <?php echo $dodatniPodaci; ?>       
  
            </div> 
            <div class="col-4 desno">
                  <div id="feed-res">
<!--                  ovde se ispisuju najnovije vesti, obavestenja i oglasi-->
                  </div>
                  
            </div>
        </div> 
</div>
    
    <script>
        setInterval(newsFeed, 100000);  //funkcija se izvrsana na svakih 100 sekundi
    
        window.onload = function() {   //funkcija se takodje izvrsava svaki put kad se ucita stranica
            newsFeed();
          };


//          funkcija za dohvatanje najnovijih vesti, obavestenja i oglasa

        function newsFeed(){
            var tip = <?php echo "'".$this->session->userdata('user')['tip']."'"; ?>;
            xmlhttp=new XMLHttpRequest();
               xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                      document.getElementById("feed-res").innerHTML = this.responseText;  
                   }
               };
          xmlhttp.open("GET", "<?php echo site_url('User/dohvatiNoveStavke'); ?>/"+tip, true);
          xmlhttp.send();    
        }
        
        function izmeniPodatke(id){
            xmlhttp=new XMLHttpRequest();
               xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                      document.getElementById("centarPocetna").innerHTML = this.responseText;  
                   }
               };
          xmlhttp.open("GET", "<?php echo site_url('User/formaIzmenaPodataka'); ?>/"+id, true);
          xmlhttp.send();   
        }
        
      function dodajInput(inputDiv){
       var selectLista = document.getElementById("lista"+inputDiv);
       var odabranaOpcija = selectLista.options[selectLista.selectedIndex].value;
             if(odabranaOpcija == "dodaj"){
           document.getElementById(inputDiv).innerHTML = "<div class='addInput'><input type='text' id='dodatakZaSifrarnik' placeholder='Dodaj novo' class='form-control'><input type='button' class='btn btn-sm btn-primary' value='Dodaj' onclick=\"dodajUSifrarnik(\'" + inputDiv + "\')\"></div>";
       }  else{
           document.getElementById(inputDiv).innerHTML="";
       }
   }
   
   document.getElementById("file-select").onchange = function() {

    dohvatiPutanjuFajla();

};

function dohvatiPutanjuFajla(){

    var celaPutanja = document.getElementById("file-select").value;
    var imeFajla = celaPutanja.split("\\").pop();
   
    document.getElementById("file-label").innerHTML = imeFajla;
    document.getElementById("btn-sacuvaj").style.display = "block";

}
        
        
        
        </script>

