

<div class="container-fluid" id="obav">
    <div class="row">
        <div id="obav" class="col-3" >
            <h3 class="font-italic"> Obaveštenja: </h3>       
            <?php            
            foreach ($obavestenja as $obavestenje) { 
                $idOba = $obavestenje['idOba']; ?>
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
                $idOba = $obavestenje['idOba']; ?>
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

            <div id="myModal" class="modal">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4>Obavestenja</h4>
                        <span class="close">&times;</span>
                    </div>
                    
                    <div class="modal-body" id="modal-body">
                    </div>


                    <div class="modal-footer">
                        <h5>Portal "Karijera"</h5>
                    </div>

                </div>
            </div>
            
            
            
        </div>
        <div class="col-3">
            <?php if($this->session->userdata('user')['tip'] == "k"){?>
            <div class="centar" >DODAJ OBAVESTENJE:</div>
            <div class="centar" id="obav_Forma">
                <?php
                $id = $this->session->userdata('obavestenja')['idOba'];
                //$data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiSvaObavestenja()];
                ?>
                <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
                    <table>
                        <tr>
                            <td><b>Naslov:</b></td>
                            <td><input type="text" name="naslov" value="" placeholder="Naslov obavestenja" required=""></td>
                        </tr>
                        <tr>
                            <td><b>Tekst:</b></td>
                            <td><textarea name="obavest" value="" placeholder="Unesi obavestenje" required=""></textarea></td>
                        </tr>
                        <tr>
                            <td><b>Autor:</b></td>
                            <td><?php echo $this->session->userdata('user')['korisnicko'] ?></td>
                        </tr>
                            <?php if($this->input->get('obavPret') == 1){ ?>
                        <tr>
                             <td><b>Vidljivost: </b></td>
                             <td> &nbsp; <input type="checkbox" name="vidljivost" value="pretraga" checked>Rezultat vase pretrage</td>
                            
                        </tr>
                        
                            <?php } else {?>
                        <tr>
                            <td><b>Vidljivost: </b></td>
                            <td>
                                <select id="idVid" name="vidljivost" onchange="omoguci()">
                                    <option value="gost">Svi i gosti</option>
                                    <option value="korisnici">Svi korisnici</option>
                                    <option value="studenti">Svi studenti</option>
                                    <option value="kurs">Studenti odredjenog kursa</option>
                                    <option value="grupa">Formirana grupa studenata</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <select id="idKur" name="kurs" disabled="">
                                    <?php
                                    $kursevi = $this->ObavModel->dohvatiSveKurseve();
                                    foreach ($kursevi as $kurs) {
                                        $idKurs = $kurs['idKurs'];
                                        $naziv = $kurs['naziv'];
                                        echo "<option value='$idKurs'>$naziv</option>";
                                    }
                                    ?>
                                    <!--<option value="php">PHP</option>
                                    <option value="java">JAVA</option>
                                    <option value="linux">LINUX</option>-->
                                </select>
                            </td>                            
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <select id="idGru" name="grupa" disabled="">
                                    <?php
                                    $grupe = $this->ObavModel->dohvatiSveGrupe();
                                    foreach ($grupe as $grupa) {
                                        $idGru = $grupa['idGru'];
                                        $naziv = $grupa['naziv'];
                                        echo "<option value='$idGru'>$naziv</option>";
                                    }
                                    ?>
                                    <!--<option value="prva">Prva grupa</option>
                                    <option value="druga">Druga grupa</option>
                                    <option value="treca">Treca grupa</option>-->
                                </select>
                            </td>
                        </tr>
                            <?php } ?>
                        <tr>
                            <td>
                                <br>
                                <input type="submit" value="Oglasi" class="btn btn-outline-primary">
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
            <?php } ?>
        </div>
               <!-- <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
                    <input type="text" name="naslov" value="" placeholder="Naslov obavestenja"><br>
                    <textarea name="obavest" value="" placeholder="Unesi obavestenje"></textarea><br>
                    <input type="text" name="aut" value="" placeholder="Ime i prezime autora"><br>
                    <input type="submit" name="sub" value="Oglasi">       
                </form>
        -->
    </div>    
</div>
 <?php if ($this->session->flashdata('obavestenjePostavljeno')){
        $msg = $this->session->flashdata('obavestenjePostavljeno');
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        } ?>

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
    
     <?php if($this->input->get('idObavestenja')!== null){?>
      
    window.onload = function() {
        obavAjax(<?php echo $this->input->get('idObavestenja')?>);
      };
      
     <?php } ?>
    
    
    
    function obavAjax(id) {
        var modal = document.getElementById("myModal");  
        modal.style.display = "block";

        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("modal-body").innerHTML = this.responseText;

            }
        };
        xmlhttp.open("GET", "<?php echo site_url('Obavestenja/ispisiObavestenja') ?>?id=" + id, true);
        xmlhttp.send();
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




