<!DOCTYPE html>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 levo"> 
            <h3>Napravi grupu</h3>
            <br>
            <form name ="napraviGrupu" method="POST" action="<?php echo site_url('Grupe/napraviGrupu') ?>">
                <input type="text" name="nazivGrupe" placeholder="naziv grupe" required class="form-control form-control-sm">
                <input type="text" name="opisGrupe" placeholder="opis" required class="form-control form-control-sm">
                <input type="submit" name="napravi" id="grupe" value="napravi grupu" class="btn btn-primary  btn-sm btn-block ">

                <?php echo $this->session->flashdata('grpmsg'); ?>

            </form>
            <br>

            <?php
            ?>
            <div id="parametri">  </div>

        </div>
        <?php
        ?>


        <div class="col-6">  

<?php
echo $grupe;
?>
        </div>

        <div class="col-3">
            <div id='studenti'></div>
<?php
?>



        </div>

    </div>
</div>
<script>

    function ispis(id) {

        var idGru = id;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("studenti").innerHTML = this.responseText;
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

</script>