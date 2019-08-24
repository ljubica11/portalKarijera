<!DOCTYPE html>

<div class="container-fluid" >
    <div class="row">
        <div class="col-3 levo col-sm-3"> 
            <div class='formaGrupe form-check'>
            <h3>Napravi grupu</h3>
            <br>
            <form name ="napraviGrupu" method="POST" action="<?php echo site_url('Grupe/upiti') ?>">
                <input type="text" name="nazivGrupe" placeholder="naziv grupe" required class="form-control">
                <input type="text" name="opisGrupe" placeholder="opis" required class="form-control">
                 
                <input  type="checkbox"  name="upiti[]" value="kursgrupe" onclick="ispisiOpcije(value)">Po kursu<br>
                <div id="kursgrupe"> </div>
                <input  type="checkbox" name="upiti[]" value="gradgrupe" onclick="ispisiOpcije(value)">Po gradu<br>
                <div id="gradgrupe"></div>
                <input type="checkbox" name="upiti[]" value="fakultetgrupe"onclick="ispisiOpcije(value)">Po fakultetu<br>
                <div id="fakultetgrupe"></div>
                <input  type="checkbox" name="upiti[]" value="vestinegrupe"onclick="ispisiOpcije(value)">Po vestinama<br>
                <div id="vestinegrupe"></div>
                <input type="checkbox" name="upiti[]" value="interesovanjagrupe"onclick="ispisiOpcije(value)">Po interesovanjima<br>
                <div id="interesovanjagrupe"></div>
                <input type="checkbox" name="upiti[]" value="statusgrupe"onclick="ispisiOpcije(value)">Po statusu<br>
                <div id="statusgrupe"></div>
             
                <input type="submit" name="napravi" id="grupe" value="napravi grupu" class="btn btn-primary  btn btn-block ">

                

            </form>
            </div>
            <br>

            <?php
            ?>
           

        </div>
        <div class="col-6 col-sm-6" style="margin-bottom: 90px">  

            <?php
            echo $grupe;
            ?>
        </div>

        <div class="col-3 col-sm-3">
            <div id="clanoviGrupe"> </div>

        </div>

    </div>
</div>
<script>

    function ispis(id) {

        var idGru = id;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("clanoviGrupe").innerHTML = this.responseText;
            }
        };

        xhttp.open("POST", "<?php echo site_url('Grupe/ispisiClanove'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("idGru=" + idGru);
    }

    function ispisiOpcije(value) {

        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(value).innerHTML = this.responseText;
                if (value == "kurs") {
                    document.getElementById("kursgrupe").innerHTML = "";
                } else if (value == "grad") {
                    document.getElementById("gradgrupe").innerHTML = "";
                } else if (value == "vestine") {
                    document.getElementById("vestinegrupe").innerHTML = "";
                } else if (value == "fakultet") {
                    document.getElementById("fakultetgrupe").innerHTML = "";
                } else if (value == "interesovanja") {
                    document.getElementById("interesovanjagrupe").innerHTML = "";
                } else if (value == "status") {
                    document.getElementById("statusgrupe").innerHTML = "";
                }
            }
        };
        xmlhttp.open("POST", "<?php echo site_url('Grupe/ispisiOpcije'); ?>", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("tip=" + value);

    }
    
    
    function traziBrisanje(id) {


        var idGru = id;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            
        };

        xhttp.open("POST", "<?php echo site_url('Grupe/traziBrisanje'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("idGru=" + idGru);
    }
</script>