

<div class="container">
    <div class="row">
        <div class="col-sm">
            <?php
//var_dump($diskusije);
            if (isset($diskusija)) {
                foreach ($diskusija as $d) {
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
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-sm">
             <div id='wrapper'></div>
                    <div id="postovi"></div>
        </div>
    </div>
</div> 

<script>
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