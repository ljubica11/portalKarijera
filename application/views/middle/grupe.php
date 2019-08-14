<!DOCTYPE html>

<div class="container-fluid" >
    <div class="row">
        <div class="col-3 levo"> 
            <h3>Napravi grupu</h3>
            <br>
            <form name ="napraviGrupu" method="POST" action="<?php echo site_url('Grupe/napraviGrupu') ?>">
                <input type="text" name="nazivGrupe" placeholder="naziv grupe" required class="form-control">
                <input type="text" name="opisGrupe" placeholder="opis" required class="form-control">
                <input type="submit" name="napravi" id="grupe" value="napravi grupu" class="btn btn-primary  btn btn-block ">

                <?php echo $this->session->flashdata('grpmsg'); ?>

            </form>
            <br>

            <?php
            ?>
            <div id="parametri">  </div>
            
    
        </div>
        <div class="col-6" style="margin-bottom: 90px">  

<?php
echo $grupe;
?>
        </div>

        <div class="col-3">
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

    function prikaziParametre(id) {

        var idGru = id;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("parametri").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "<?php echo site_url('Grupe/parametri') ?>?idGru=" + idGru, true);
        xmlhttp.send();
    }
    
    function ispisiOpcije(value){
        
        xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                       document.getElementById(value).innerHTML = this.responseText; 
                       if(value == "kurs"){
                           document.getElementById("kursgrupe").innerHTML ="";
                       }else if(value == "grad"){
                           document.getElementById("gradgrupe").innerHTML ="";
                       }else if(value == "vestine"){
                            document.getElementById("vestinegrupe").innerHTML ="";
                       }else if(value == "fakultet"){
                           document.getElementById("fakultetgrupe").innerHTML ="";
                       }else if(value == "interesovanja"){
                           document.getElementById("interesovanjagrupe").innerHTML ="";
                       }else if(value == "status"){
                           document.getElementById("statusgrupe").innerHTML ="";
                       }
                   }
               };
            xmlhttp.open("POST", "<?php echo site_url('Grupe/ispisiOpcije'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("tip="+value);
 
   }
</script>