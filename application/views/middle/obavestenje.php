

<div class="container-fluid" id="obav">
    <div class="row">
        <div id="obav" class="col-3" >
             <img src="<?php echo base_url();?>/images/mail.png" class="img-fluid">

        </div>
        <div class="col-5 <?php if(!$this->session->has_userdata('user') or $this->session->userdata('user')['tip'] =="s" ) echo 'offset-1'?>">
            <div id="obavDiv"> 

            </div>
            
             <?php            
            foreach ($obavestenja as $obavestenje) { 
                $idOba = $obavestenje['idOba']; ?>
            <div class="centar">
                <b>Naslov:<a href="#" onclick="obavAjax(<?php echo $idOba ?>)"> <?php echo $obavestenje['naslov']; ?></a></b><br>
                <b>Autor:</b> <?php echo $obavestenje['naziv']; ?><br>
                <b>Tekst:</b> <?php echo $obavestenje['tekst']; ?><br>
                 <b>Datum: </b><?php echo substr($obavestenje['datum'], 0, 10); ?><br>
                
                
                
            <?php
//                echo "<b><a href='#' onclick='obavAjax($idOba)'>" . $obavestenje['naslov'] . "</a></b><br/>";
//                echo "<div style='text-align:right'>" . substr($obavestenje['datum'], 0, 10) . "</div>";
            ?>
              
             </div>   
            <?php }
            ?>
            
            

            <div id="myModal" class="modal modal-vesti">
                <div class="modal-content modal-content-vesti">

                    <div class="modal-header modal-header-vesti">
                        <h4>Obavestenja</h4>
                        <span class="close">&times;</span>
                    </div>
                    
                    <div class="modal-body modal-body-vesti" id="modal-body">
                    </div>


                    <div class="modal-footer modal-footer-vesti">
                        <h5>Portal "Karijera"</h5>
                    </div>

                </div>
            </div>
            
            
            
        </div>
        <div class="<?php if(!$this->session->has_userdata('user') or $this->session->userdata('user')['tip'] =="s" ) echo 'col-3'; else echo 'col-4';?>">
            <?php if($this->session->userdata('user')['tip'] == "k" or $this->session->userdata('user')['tip'] == "a"){?>
            <div class="kat-vesti-naslov centar"><h5>Dodaj obavestenje</h5></div>
            <div class="centar" id="obav_Forma">
                <?php
                $id = $this->session->userdata('obavestenja')['idOba'];

                ?>
                <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
                   <b>Autor:</b> <?php echo $this->session->userdata('user')['korisnicko'] ?>
                   <br/><br/>
                   <input type="text" name="naslov" placeholder="Naslov obavestenja" class="form-control" required>
                   <br/>
                   <textarea name="obavest" placeholder="Unesi obavestenje" required class="form-control"></textarea>
                   <br/>
                   
                       
                            <?php if($this->input->get('obavPret') == 1){ ?>
                      
                            <b>Vidljivost: </b>
                              &nbsp; <input type="checkbox" name="vidljivost" value="pretraga" checked>Rezultat vase pretrage
                            
                     
                        
                            <?php } else {?>

                              <select id="idVid" name="vidljivost" onchange="omoguci()" class="form-control" required>
                                  <option value="" selected disabled>Odaberite nivo vidljivosti</option>
                                    <option value="gost">Svi i gosti</option>
                                    <option value="korisnici">Svi korisnici</option>
                                    <option value="studenti">Svi studenti</option>
                                    <option value="kurs">Studenti odredjenog kursa</option>
                                    <option value="grupa">Formirana grupa studenata</option>
                                </select> 
                            <br/>
                                <select id="idKur" name="kurs" disabled="" class="form-control">
                                    <?php
                                    $kursevi = $this->ObavModel->dohvatiSveKurseve();
                                    foreach ($kursevi as $kurs) {
                                        $idKurs = $kurs['idKurs'];
                                        $naziv = $kurs['naziv'];
                                        echo "<option value='$idKurs'>$naziv</option>";
                                    }
                                    ?>
                                   
                                </select>
                            
                                <select id="idGru" name="grupa" disabled="" class="form-control">
                                    <?php
                                    $grupe = $this->ObavModel->dohvatiSveGrupe();
                                    foreach ($grupe as $grupa) {
                                        $idGru = $grupa['idGru'];
                                        $naziv = $grupa['naziv'];
                                        echo "<option value='$idGru'>$naziv</option>";
                                    }
                                    ?>

                                </select>
                            
                      
                            <?php } ?>
                      
                                <br>
                                <input type="submit" value="Oglasi" class="btn btn-outline-primary">
                            
                </form>
            </div>
            <?php } ?>
        </div>
     
    </div>    
</div>
 <?php if ($this->session->flashdata('obavestenjePostavljeno')){
        $msg = $this->session->flashdata('obavestenjePostavljeno');
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        } ?>



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




