
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>

        <div class="container-fluid" style="margin-bottom: 50px">
            <div class="row">
                <div class="col-3 levo">
                    <b>Kategorije: </b>
                    <br/>
                    <?php
                    foreach ($kategorije as $k) {
                        $idKatDis = $k['idKatDis'];

                        //var_dump($idKatDis);
                        echo "<a href='#' onclick='diskusije($idKatDis)'>" . $k['naziv'] . "</a><br/>";
                    }
                    ?>
                     <div>
                    <input type="button" onclick='prikaziFormuKat()' value="Dodaj kategoriju">
                    </div>
                    
                    <div id='formaDiv'>
                        <form name='dodajKat' method="POST" action="<?php echo site_url('Diskusije/dodajKategoriju') ?>">
                            Naziv kategorije: <input type="text" name='naziv'>
                            <input type="submit" name="dodaj" value="Dodaj">
                            
                        </form>
                    </div>
                </div>
               
                <div class="col-6">
                    <div id="diskusije"> </div>
                </div>
                <div class="col-3">
                    <div id='wrapper'></div>
                    <div id="postovi"></div>
                    <br><br>

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
              <input type="button" name="Posalji" value="Posalji" onclick="dodajpost(' + id + '); cleartext()" id="idDis" class="btn btn-primary"></div>';

            }

            function prikaziFormu() {

                document.getElementById("formaDiv").style.display = "block";

            }
            
            function prikaziFormuKat(){
                
                document.getElementById("formaDiv").style.display = "block";
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

        </script>


    </body>
</html>





























