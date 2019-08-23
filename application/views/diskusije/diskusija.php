

<div class="container">
    <div class="row">
        <div class="col-sm">
            <?php

            if (isset($diskusija)) {
                foreach ($diskusija as $d) {
                    ?>
                    <div class="centar">

                        <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
                        <b>Opis: </b><?php echo $d['opis'] ?><br/>
                        <b>Autor: </b><?php echo $d['korisnik'] ?><br/>
                        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
                        <?php $id = $d['idDis'] ?>
                        <?php echo "<a href='#' class='badge badge-primary' onclick ='postovigrupa($id)'> <b>Pogledaj postove</b></a>" ?>
                        <?php echo "<a href='#' class='badge badge-primary' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a><br/>" ?>



                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-sm">
             <div id='wrapper'></div>
                    <div id="postovigrupa"></div>
        </div>
    </div>
</div> 

<script>
    function postovigrupa(id) {

                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("postovigrupa").innerHTML = this.responseText;

                    }
                }
                xmlhttp.open("GET", "<?php echo site_url('Diskusije/ispisiPostove') ?>?id=" + id, true);
                xmlhttp.send();
            }
            
             function dodajpost(id) {

                var tekst = document.getElementById('novipost').value;
                var idDis = id;


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                       document.getElementById("novipost").value ="";
                        document.getElementById("postovigrupa").innerHTML = this.responseText;
                    }
                };

                xhttp.open("POST", "<?php echo site_url('Diskusije/dodajPost'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idDis=" + idDis + "&tekst=" + tekst);
            }


            function dodajdiv(id) {
                document.getElementById('wrapper').innerHTML += '<div class="postdesno" id="wrapper">\n\
              <input type="text" id="novipost" class="form-control" width="90%">\n\
              <input type="button" class="btn btn-outline-primary btn-sm" name="Posalji" value="Posalji" onclick="dodajpost(' + id + '); postovi(id); cleartext()" id="idDis" class="btn btn-primary"></div>';

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