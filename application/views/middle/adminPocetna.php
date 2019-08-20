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
            <div class="row">
                <div class="col-10 offset-1" id="resDiv">
<!--                    <input type="button" value="Klik" onclick="dohvatiBrojZahtevaReg()">-->
                </div>
            </div>
            
        </div>
        
        <div class="col-3 desno-admin">
            <h4>Zahtevi <i class="fa fa-folder-open"></i></h4>
            <div class="zahteviNaziv" onclick="prikaziRegZahteve()">Registracije 
                <div class="notif" id="notifReg"></div>
            </div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('oglasi')">Oglasi</div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('vesti')">Vesti</div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('obavestenja')">Obavestenja</div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('grupe')">Grupe</div>
            <div class="zahteviNaziv" onclick="prikaziZahteveZaBrisanje('diskusije')">Diskusije</div>
        </div>
            
        
    </div>
</div>
<script>
    function prikaziSifrarnik(tip){
         xmlhttp=new XMLHttpRequest();
               xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                      document.getElementById("resDiv").innerHTML = this.responseText;  
                   }
               };
          xmlhttp.open("GET", "<?php echo site_url('Admin/prikaziSifrarnik'); ?>/"+tip, true);
          xmlhttp.send();      
    }
    
    function obrisiStavku(id, tip){
         var del = confirm('Da li ste sigurni da zelite da obrisete ovu stavku?');
         if(del){
         xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("resDiv").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST", "<?php echo site_url('Admin/obrisiStavku'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&tip="+tip);
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
    
    function sacuvajIzmenu(tip, id){
        var izmena = document.getElementById("izmeni"+tip+id).value;
        xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("resDiv").innerHTML = this.responseText;
                    alert("Izmena je sacuvana");
                }
            };
            xmlhttp.open("POST", "<?php echo site_url('Admin/izmeniStavku'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&tip="+tip+"&izmena="+izmena);
 
    }
    
    function dodajStavku(tip){
       var dodatak = document.getElementById("dodatakStavka").value;
        xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("resDiv").innerHTML = this.responseText;
                    alert("Stavka je dodata");
                }
            };
            xmlhttp.open("POST", "<?php echo site_url('Admin/dodajStavku'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("tip="+tip+"&dodatak="+dodatak); 
    }
    
    function prikaziRegZahteve(){
        xmlhttp=new XMLHttpRequest();
               xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                      document.getElementById("resDiv").innerHTML = this.responseText;  
                   }
               };
          xmlhttp.open("GET", "<?php echo site_url('Admin/prikaziZahteveRegistracija'); ?>", true);
          xmlhttp.send();      
    }
    
    function odobriRegistraciju(id, mejl){
        xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("resDiv").innerHTML = this.responseText;
                    alert("Registracija je odobrena");
                }
            };
            xmlhttp.open("POST", "<?php echo site_url('Admin/odobriRegistraciju'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&mejl="+mejl); 
        
    }
    
       function zabraniRegistraciju(id, mejl){
        xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("resDiv").innerHTML = this.responseText;
                    alert("Registracija je zabranjena");
                }
            };
            xmlhttp.open("POST", "<?php echo site_url('Admin/zabraniRegistraciju'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&mejl="+mejl); 
        
    }
    
    setInterval(dohvatiBrojZahtevaReg, 30000);
    
    function dohvatiBrojZahtevaReg(){
        xmlhttp=new XMLHttpRequest();
               xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                      document.getElementById("notifReg").innerHTML = this.responseText;  
                   }
               };
          xmlhttp.open("GET", "<?php echo site_url('Admin/brojZahtevaReg'); ?>", true);
          xmlhttp.send();      
    }
   


   
    </script>