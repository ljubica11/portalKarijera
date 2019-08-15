<!DOCTYPE html>

<div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-1 pretraga-container">
            <div class="row">
                <div class="col-4">
                    <img src="<?php echo base_url();?>/images/search2" class="img-fluid">
                </div>
                <div class="col-7 offset-1" id="pretraga-pocetni-div">
                    Napredna pretraga portala "Karijera" vam olaksava pronalazenje studenata ili kompanija prema vasim krijerijumima. 
                    Ovo je idealan nacin da se povezete sa drugim studentima, upoznate sa uslovima rada u raznim kompanijama, pronadjete savrsene kandidate za vas posao ili jednostavno steknete nova poznanstva.
                    <br/><br/><br/>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4>Zapocnite pretragu!</h4>
                       
            <br/>
                            <input type="button" class="btn-pretraga btn btn-primary" value="Pretraga studenata" id="pretraga-stud-btn">
                            <input type="button" class="btn-pretraga btn btn-primary" value="Pretraga kompanija" id="pretraga-komp-btn">
                        </div>
                    </div>
                </div>
                <div class="col-7 offset-1">
                               <div id="pretraga-stud-div">
                                <?php echo $pretragaStud?>
                               </div>

                               <div id="pretraga-komp-div">
                                 <?php echo $pretragaKomp; ?>
                               </div>
                </div>
            
        </div>
    </div>
</div>
</div>

<script>
    
var stud = document.getElementById("pretraga-stud-div");
var komp = document.getElementById("pretraga-komp-div");
var pocetniDiv = document.getElementById("pretraga-pocetni-div");
var btnStud = document.getElementById("pretraga-stud-btn");
var btnKomp = document.getElementById("pretraga-komp-btn");

btnStud.onclick = function() {
  stud.style.display = "block";
  komp.style.display = "none";
  pocetniDiv.style.display = "none";
};
btnKomp.onclick = function() {
  komp.style.display = "block";
  stud.style.display = "none";
  pocetniDiv.style.display = "none";
};   

function pretraziStudente(){
       var ime = document.getElementById("ime").value;
       var prezime = document.getElementById("prezime").value;
       var selectMesto = document.getElementById("mesto");
       var mesto = selectMesto.options[selectMesto.selectedIndex].value;
       var selectFaks = document.getElementById("fakultet");
       var faks = selectFaks.options[selectFaks.selectedIndex].value;
       var selectKurs = document.getElementById("kurs");
       var kurs = selectKurs.options[selectKurs.selectedIndex].value;
       var selectInt = document.getElementById("interesovanja");
       var int = selectInt.options[selectInt.selectedIndex].value;
       var selectVes = document.getElementById("vestine");
       var ves = selectVes.options[selectVes.selectedIndex].value;
       if((ime == "")&&(prezime == "")&&(mesto == "")&&(faks == "")&&(kurs == "")&&(int == "")&&(ves == "")){
           return;
       }
       xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){ 
                       document.getElementById("pretraga-res").innerHTML = this.responseText; 

                   }
               };
            xmlhttp.open("POST", "<?php echo site_url('Pretraga/pretraziStudente'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("ime="+ime+"&prezime="+prezime+"&mesto="+mesto+"&faks="+faks+"&kurs="+kurs+"&int="+int+"&ves="+ves);
}

function pretraziKompanije(){
    var naziv = document.getElementById("naziv").value;
    var oblast = document.getElementById("oblast").value;
    var selectGrad = document.getElementById("sediste");
    var grad = selectGrad.options[selectGrad.selectedIndex].value;
    if((naziv == "")&&(oblast == "")&&(grad == "")){
        return;
    }
    xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){ 
                       document.getElementById("pretraga-res-komp").innerHTML = this.responseText; 

                   }
               };
            xmlhttp.open("POST", "<?php echo site_url('Pretraga/pretraziKompanije'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("naziv="+naziv+"&oblast="+oblast+"&mesto="+grad);
}


function prikaziDodavanjeGrupe(){
    document.getElementById("dodavanjeGrupeDiv").style.display = "block";
}
    </script>