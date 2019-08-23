

<div class="container-fluid">
    <div class="row">
        <div id="obav" class="col-3" >
            <h3 class="font-italic"> Obaveštenja: </h3>       
            <?php
            foreach ($obavestenja as $obavestenje) {
                $idOba = $obavestenje['idOba'];
                ?>
                <div class="centar">
                    <?php
                    echo "<b><a href='#' onclick='obavAjax($idOba)'>" . $obavestenje['naslov'] . "</a></b><br/>";
                    echo "<div style='text-align:right'>" . substr($obavestenje['datum'], 0, 10) . "</div>";
                    ?>
                </div>   
            <?php }
            ?>



            <!--<?php
            foreach ($obavestenja as $obavestenje) {
                $idOba = $obavestenje['idOba'];
                ?>
                     <div class="centar">
                <?php
                echo "<a href='#' onclick='obavAjax($idOba)'>" . $obavestenje['naslov'] . "</a><br/>";
                ?>
                    </div>
            <?php }
            ?>-->

            <!-- <div class="centar" >
                <h4 class="modal-title"><?php echo $obavestenje['naslov'] ?></h4>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#z<?php echo $obavestenje['idOba'] ?>">Detaljnije</button>
                
                 <div class="modal fade" id="z<?php echo $obavestenje['idOba'] ?>" role="dialog">
                     <div class="modal-dialog">
                         
            <!-- Modal content-->
            <!-- <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"><?php echo $obavestenje['naslov'] ?></h4> 
                 </div>
                 
                 <div class="modal-body">
                     <p><?php echo $obavestenje['tekst'] ?></p>
                 </div>
                 
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
             </div>
            
         </div>
     </div>
       
 </div> -->
            <!-- <?php ?> -->

            <!--<b  class="p-0 bg-info">Obavestenja: </b>
            <br>
            <?php foreach ($obavestenja as $obavestenje) { ?>
                             <div class="card">
                                 <div class="card-header">
                                     <a class="collapsed card-link" data-toggle="collapse" data-parent="#obav" href="#<?php echo $obavestenje['idOba'] ?>">
                <?php echo $obavestenje['naslov'] ?>
                                     </a>
                                 </div>
                                 <div id="<?php echo $obavestenje['idOba'] ?>" class="collapse show">
                                     <div class="card-body">
                <?php echo $obavestenje['tekst'] ?>
                                     </div>
                                 </div>
                             </div>
            <?php } ?>-->
        </div>
        <div class="col-6">
            <div id="obavDiv"> 

            </div>
        </div>
        <div class="col-3">
            <!--<?php $middle_data["dodavanjeObavestenja"]; ?>-->
            <?php
                if ($this->session->has_userdata('user')) {
                    $tipKorisnika = $this->session->userdata('user')['tip'];
                } else {
                    $tipKorisnika = "gost";
                }
                if ($tipKorisnika == 'k') {
                    $this->view("obavestenja/dodavanjeObavestenja");
                }
            ?>
        </div>
    </div>
</div>
<!--<script>
var prilagodi = function () {
    if ($("#kurs").is(":selected")) {
        $("#kursevi").removeAttr("disabled");
    }
    else {
        $("#kursevi").prop('disabled', 'disabled');
    }
};

$(prilagodi);
$("#kurs").change(prilagodi);
</script>-->

<script>
    function omoguci() {
        $v = document.getElementById("idVid").value;
        document.getElementById("idKur").disabled = true;
        document.getElementById("idGru").disabled = true;
        if ($v == "kurs") {
            document.getElementById("idKur").disabled = false;
        }
        if ($v == "grupa") {
            document.getElementById("idGru").disabled = false;
        }
    }
    function arhiObav() {
        alert("cavo!");
        //$this->Obavestenja->arhivirajObavestenje($idOba);
    }
    function obavAjax(id) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("obavDiv").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "<?php echo site_url('Obavestenja/ispisiObavestenja') ?>?id=" + id, true);
        xmlhttp.send();
    }
    /*
     function arhiObav(idObav) {
     echo "hejhej";
     xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function () {
     if (this.readyState == 4 && this.status == 200) {
     document.getElementById("obavDiv").innerHTML = "aloo";//this.responseText;
     }
     };
     xmlhttp.open("GET", "<?php echo site_url('Obavestenja/arhivirajObavestenja') ?>?idObav=" + idObav, true);
     xmlhttp.send();
     }
     function arhiObav($idOba) {
     echo 'alo!'
     $this->Obavestenja->arhivirajObavestenje($idOba);
     }
     */


</script>




