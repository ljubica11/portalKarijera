<!DOCTYPE html>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 levo-admin">
            <h4>Sifrarnici <i class="fa fa-book"></i></h4>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('mesto')">Mesta</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('drz')">Drzavljanstva</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('faks')">Fakulteti</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('komp')">Kompanije</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('poz')">Pozicije</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('inter')">Interesovanja</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('ves')">Vestine</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('katves')">Kategorije vesti</div>
            <div class="sifrarniciNaziv" onclick="prikaziSifrarnik('katdis')">Kategorije diskusija</div>
        </div>
        
        <div class="col-6">
            
            <div id="myModal" class="modal modal-disk">
                <div class="modal-content modal-content-disk">

                    <div class="modal-header modal-header-disk">
                        <h4>Postovi diskusije</h4>
                        <span class="close">&times;</span>
                    </div>
                    
                    <div class="modal-body modal-body-disk" id="modal-body">
                    </div>


                    <div class="modal-footer modal-footer-disk">
                        <h5>Portal "Karijera"</h5>
                    </div>

                </div>
            </div>
            

            <div class="row">
                <div class="col-10 offset-1" id="resDiv">
                    
                </div>
            </div>
            
        </div>
        
        <div class="col-3 desno-admin">
            <h4>Zahtevi <i class="fa fa-folder-open"></i></h4>
            <div class="zahteviNaziv" onclick="prikaziRegZahteve()">Registracije 
                <div class="notif" id="registracija"></div>
            </div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('oglasi')">Oglasi
            <div class="notif" id="oglasi"></div>
            </div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('vesti')">Vesti
            <div class="notif" id="vesti"></div>
            </div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('obavestenja')">Obavestenja
            <div class="notif" id="obavestenja"></div>
            </div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('grupe')">Grupe
            <div class="notif" id="grupe"></div>
            </div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('diskusije')">Diskusije
            <div class="notif" id="diskusija"></div>
            </div>
        </div>
            
        
    </div>
    <input type="hidden" id="broj">
</div>
<script>
    function sendGet ( elementID, url, callback ) {
	xmlhttp=new XMLHttpRequest ( );
	xmlhttp.onreadystatechange = function ( ) {
	   if ( this.readyState == 4 && this.status == 200 ) {
	      document.getElementById( elementID ).innerHTML = this.responseText;  
	      if ( callback != null ) {
	    	callback ( );  	
	      }
	   }
	};
	xmlhttp.open ( "GET", url, true );
	xmlhttp.send ( );      
}

    function sendPost ( elementID, url, parameters, callback ){
	xmlhttp=new XMLHttpRequest ( );
	xmlhttp.onreadystatechange=function ( ) {
		if ( this.readyState == 4 && this.status == 200){
		    document.getElementById ( elementID ).innerHTML = this.responseText;
		    if ( callback != null ) {
		    	callback ( );
		    }
		}
	};
	xmlhttp.open ( "POST", url, true );
	xmlhttp.setRequestHeader ( "Content-type", "application/x-www-form-urlencoded" );
	xmlhttp.send ( parameters ); 
}
    
    function prikaziSifrarnik(tip) {
	sendGet("resDiv", "<?php echo site_url('Admin/prikaziSifrarnik'); ?>/"+tip, null );
    }

    
    function sacuvajIzmenu(tip, id ) {
         var izmena = document.getElementById("izmeni"+tip+id).value;
            sendPost ( "resDiv", "<?php echo site_url('Admin/izmeniStavku'); ?>",
		"id="+id+"&tip="+tip+"&izmena="+izmena,
		function() { alert ( "Izmena je sacuvana!" ); }
	);
}
    
     function obrisiStavku(id, tip){
          var del = confirm('Da li ste sigurni da zelite da obrisete ovu stavku?');
         if(del){
            sendPost("resDiv", "<?php echo site_url('Admin/obrisiStavku'); ?>",
                   "id="+id+"&tip="+tip, function(){ alert("Stavka je obrisana!");} );
         }
     }
    
    function dodajStavku(tip){
     var dodatak = document.getElementById("dodatakStavka").value;
     sendPost("resDiv", "<?php echo site_url('Admin/dodajStavku'); ?>",
            "tip="+tip+"&dodatak="+dodatak, function(){alert("Stavka je dodata!");});
    }
    
    function prikaziRegZahteve(){
        sendGet("resDiv", "<?php echo site_url('Admin/prikaziZahteveRegistracija'); ?>", null );
    }
    
    
    function odobriRegistraciju(id, mejl){
        sendPost("resDiv", "<?php echo site_url('Admin/odobriRegistraciju'); ?>", 
                "id="+id+"&mejl="+mejl, function(){alert("Registracija je odobrena");});
    }
    
    function zabraniRegistraciju(id, mejl){
        sendPost("resDiv", "<?php echo site_url('Admin/zabraniRegistraciju'); ?>", 
                "id="+id+"&mejl="+mejl, function(){alert("Registracija je zabranjena");});
    }
    
    function prikaziZahteveZaBrisanje(tip){
        sendGet("resDiv", "<?php echo site_url('Admin/zahteviZaBrisanje'); ?>/"+tip, null);
    }
    
    function prikaziPostoveDisk(id){
        var modal = document.getElementById("myModal");  
        modal.style.display = "block";
        sendGet("modal-body", "<?php echo site_url('Diskusije/ispisiPostove') ?>?id="+id, null);
    }
    
    function obrisiZahtev(tip, id){
       var del = confirm('Da li ste sigurni da zelite da obrisete ovu stavku?');
         if(del){
             sendPost("resDiv", "<?php echo site_url('Admin/obrisiZahtev'); ?>",
                      "tip="+tip+"&id="+id, function(){alert("Obrisano.");});
         }
    }
    
    function izmeniStavku(id){
        document.getElementById("izmenaSifrarnikaInput"+id).style.display = "inline-block";
        document.getElementById(id).style.display = "none";

    }
    
    function odustani(id){
         document.getElementById("izmenaSifrarnikaInput"+id).style.display = "none";
         document.getElementById(id).style.display = "inline-block";
    }
    
       window.onload = function(){
        dohvatiBroj();
    };
    
    
    setInterval(dohvatiBroj, 10000);
    
    
    function dohvatiBroj(){
        var nazivi = ["oglasi", "vesti", "obavestenja", "grupe", "diskusija", "registracija"];
        for(i = 0; i < nazivi.length; i++){
        sendGet(nazivi[i], "<?php echo site_url('Admin/brojZahteva');?>/"+nazivi[i], null);
        }
    }
    
 
var span = document.getElementsByClassName("close")[0];

var modal = document.getElementById("myModal");    

span.onclick = function() {
  modal.style.display = "none";
};

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};


   
    </script>