
<!DOCTYPE html>

<div class="container-fluid">
    <div class="row">
        <div class="col-3" >
            <b class="p-0 bg-info">Vesti: </b>
            <br/>
            <?php
            foreach ($kategorije as $k) {
                $idKatVesti = $k['idKatVesti'];

                echo "<a href='#' onclick='vesti($idKatVesti)'>" . $k['naziv'] . "</a><br/>";
            }
            ?>
            <div class="centar">
                <h6>DODAVANJE NOVE KATEGORIJE VESTI:</h6>
            </div>

            <div class="centar">
                <form name="forma_kat_vesti" method="POST" action="dodajKategorijuVesti">
                    <input type="text" name="novakatvesti" placeholder="Polje za unos..." ><br>
                    <input type="submit" value="Dodaj Kategoriju" class="btn btn-outline-primary">
                </form>

            </div>
        </div>
        <div class="col-6">
            <div id="vesti">
                <?php foreach ($sveVesti as $sv) { ?>

                    <div class="centar">
                        <b>Naziv: <?php echo $sv['naziv']; ?></b><br>
                        <b>Autor: <?php echo $sv['korisnik']; ?></b><br>
                        <b>Tekst: <?php echo $sv['tekst']; ?></b><br>
                        <b>Datum: <?php echo $sv['datum']; ?></b><br>
                        <br>
                    </div>
                <?php } ?>

            </div>


        </div>

        <div class="col-3">

            <div class="centar" >DODAVANJE VESTI:</div>
            <div class="centar" id="formavesti">
                <?php
                $ulogovani = $this->session->userdata('user')['korisnicko'];
                $kategorija = $this->VestiModel->dohvatiKategorijeVesti()

                ?>
                <form name="forma_vesti" method="POST" action="<?php echo site_url('Vesti/dodajVest') ?>">
                    <table>
                        <tr>
                            <td><b>Autor:</b></td>
                            <td><?php echo $ulogovani ?></td>
                        </tr>
                        <tr>
                            <td><b>Naziv:</b></td>
                            <td><input type="text" name="naziv"></td>
                        </tr>
                        <tr>
                            <td><b>Tekst:</b></td>
                            <td><textarea name="tekst"></textarea></td>
                        </tr>
                        <tr>

                            <td>Kategorija:</td>

                            <td>
                                <select name="kategorija">
                                    <option value="" selected disabled>Izaberi kategoriju vesti</option>
                                    <?php

                                        foreach ($kategorije as $k){
                                            $idKatVesti = $k['idKatVesti'];
                                            $nazivKat = $k['naziv'];
                                            echo "<option value='$idKatVesti'>$nazivKat</option>";
                                        }
                                    ?>
                                </select>


                            </td>
                        </tr>
                        <tr>
                            <td> Nivo vidljivosti:</td>
                            <td> 
                                <input type="radio" name="vidljivost" value="studenti" id="1">Svi i gosti<br>
                                <input type="radio" name="vidljivost" value="studenti" id="2">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici" id="3">Svi korisnici sajta (ukljucujuci i kompanije)<br>
                                <input type="radio" name="vidljivost" value="kurs" onclick="ispisiOpcije(value)" id="4">Studenti odredjenog kursa<br>
                                <div id="kurs"></div>
                                <input type="radio" name="vidljivost" value="grupa" onclick="ispisiOpcije(value)" id="5">Formirana grupa studenata<br>
                                <div id="grupa"></div>
                                 <?php if($this->input->get('vesPret') == 1){
                                    echo "<input type='radio' name='vidljivost' value='pretraga' checked>Rezultat pretrage";
                                }?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Dodaj vest" class="btn btn-outline-primary">
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
        </div>
    </div>
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
<?php } ?>
    </script>
</div>


                </form>


            </div>
        </div>
    </div>


