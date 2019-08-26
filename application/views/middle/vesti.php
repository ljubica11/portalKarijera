
<!DOCTYPE html>

<div class="container-fluid" id="ves">
    <div class="row">
        <div class="col-3" >
            <div class="kat-vesti-naslov centar"><h5>Kategorije vesti</h5> </div>
            <?php
            foreach ($kategorije as $k) {
                $idKatVesti = $k['idKatVesti']; ?>
            <div class="centar kat-vesti" onclick="vesti(<?php echo $idKatVesti ?>)">
                <?php echo "<b>".$k['naziv']."</b>" ?>
            </div>
           <?php
             }
            ?>

        <?php if($this->session->has_userdata('user')){
        $idKor = $this->session->userdata('user')['idKor']; ?>
        <a href="#" class="btn btn-primary btn-lg btn-mojeVesti" onclick="mojeVesti(<?php echo $idKor ?>)">Moje vesti</a>
        <?php } ?>
        </div>
        <div class="col-5">
            
            <div id="myModal" class="modal modal-vesti">
                <div class="modal-content modal-content-vesti">

                    <div class="modal-header modal-header-vesti">
                        <h4>Vesti</h4>
                        <span class="close">&times;</span>
                    </div>
                    
                    <div class="modal-body modal-body-vesti" id="modal-body">
                    </div>


                    <div class="modal-footer modal-footer-vesti">
                        <h5>Portal "Karijera"</h5>
                    </div>

                </div>
            </div>
            
            <div id="vesti">
                <?php foreach ($sveVesti as $sv) { ?>

                    <div class="centar">
                        <b>Naslov:<a href="#" onclick="procitajVest(<?php echo $sv['idVes']?>)"> <?php echo $sv['naziv']; ?></a></b><br>
                        <b>Autor:</b> <?php echo $sv['korisnik']; ?><br>
                        <b>Tekst:</b> <?php echo $sv['tekst']; ?><br>
                        <b>Datum:</b> <?php echo $sv['datum']; ?><br>
                        <br>
                    </div>
                <?php } ?>

            </div>


        </div>

        <div class="col-4">
            <?php if($this->session->has_userdata('user')){?>
            <div class="kat-vesti-naslov centar" ><h5>Dodavanje vesti</h5></div>
            <div class="centar" id="formavesti">
                <?php
                $ulogovani = $this->session->userdata('user')['korisnicko'];
                $kategorija = $this->VestiModel->dohvatiKategorijeVesti()

                ?>
                <form name="forma_vesti" method="POST" action="<?php echo site_url('Vesti/dodajVest') ?>">
                    
                        
                            <b>Autor: </b>
                            <?php echo $ulogovani ?>
                            <br/><br/>
                            <input type="text" name="naziv" class="form-control" placeholder="Naslov">
                            <br/>
                            <textarea name="tekst" class="form-control" placeholder="Tekst vesti"></textarea>
                            <br/>
                                <select name="kategorija" class="form-control">
                                    <option value="" selected disabled>Izaberi kategoriju vesti</option>
                                    <?php

                                        foreach ($kategorije as $k){
                                            $idKatVesti = $k['idKatVesti'];
                                            $nazivKat = $k['naziv'];
                                            echo "<option value='$idKatVesti'>$nazivKat</option>";
                                        }
                                    ?>

                                </select>
                                <br/>
                                <b>Ko moze da vidi ovu vest?</b>
                                <br/>
                                <input type="radio" name="vidljivost" value="gost" id="1"> Svi i gosti<br>
                                <input type="radio" name="vidljivost" value="studenti" id="2"> Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici" id="3"> Svi korisnici sajta (ukljucujuci i kompanije)<br>
                                <input type="radio" name="vidljivost" value="kurs" onclick="ispisiOpcije(value)" id="4"> Studenti određenog kursa<br>
                                <div id="kurs"></div>
                                <input type="radio" name="vidljivost" value="grupa" onclick="ispisiOpcije(value)" id="5"> Formirana grupa studenata<br>
                                <div id="grupa"></div>
                                 <?php if($this->input->get('vesPret') == 1){
                                    echo "<input type='radio' name='vidljivost' value='pretraga' checked>Rezultat pretrage";
                                }?>
                                <br/>
                                <input type="submit" value="Dodaj vest" class="btn btn-outline-primary">
                            

                </form>
            </div>
            <?php } ?>
        </div>
    </div>
    
     <?php if ($this->session->flashdata('poruka')){
        $msg = $this->session->flashdata('poruka');
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        } ?>
    
    <script>
        function vesti(id){
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("vesti").innerHTML = this.responseText;
                 
                }
            }
            xmlhttp.open("GET", "<?php echo site_url('Vesti/ispisiVesti') ?>?id="+id, true);
            xmlhttp.send();
        }
        
        function ispisiOpcije(value){
        xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                   if(this.readyState==4&&this.status==200){
                       document.getElementById(value).innerHTML = this.responseText; 
                       if(value == "kurs"){
                           document.getElementById("grupa").innerHTML ="";
                       }else if(value == "grupa"){
                           document.getElementById("kurs").innerHTML ="";
                       }
                   }
               };
            xmlhttp.open("POST", "<?php echo site_url('Oglasi/dohvatiOpcije'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("tip="+value);
   }
   
   <?php if($this->input->get('vesPret')!== null){?>
    
if(<?php echo $this->input->get('vesPret')?> == 1){
    document.getElementById("1").disabled=true;
    document.getElementById("2").disabled=true;
    document.getElementById("3").disabled=true;
    document.getElementById("4").disabled=true;
    document.getElementById("5").disabled=true;
    }
    <?php } if($this->input->get('idVesti')!== null){?>
      
    window.onload = function() {
        procitajVest(<?php echo $this->input->get('idVesti')?>);
      };
    <?php } ?>    
    function procitajVest(id){
        var modal = document.getElementById("myModal");  
        modal.style.display = "block";
        xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("modal-body").innerHTML = this.responseText;
                    
                }
            };
            xmlhttp.open("GET", "<?php echo site_url('Vesti/dohvatiJednuVest') ?>/"+id, true);
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

function mojeVesti(idKor){
   xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("vesti").innerHTML = this.responseText;
                 
                }
            }
            xmlhttp.open("GET", "<?php echo site_url('Vesti/dohvatiVestiAutora') ?>/"+idKor, true);
            xmlhttp.send(); 
}
    

    </script>
</div>


                </form>


            </div>
        </div>
    </div>


