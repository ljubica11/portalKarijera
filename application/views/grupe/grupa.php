<!DOCTYPE html>

<html>

    <?php
    $idGru = $this->uri->segment(3);
    ?>
    <div class="container" style="margin-bottom: 90px">
        <div class="row">
            <div class="col-sm">
                <h4>Diskusije</h4>

                <?php
                    
                foreach ($diskusijeGrupe as $d) {
                    $idDis = $d['idDis'];
                    
                    ?>

                    <div class="postdesno">
                        <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
                        <b>Opis: </b><?php echo $d['opis'] ?><br/>
                        <b>Autor: </b><?php echo $d['korisnik'] ?><br/>
                        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
                        <a href="<?php echo site_url("Diskusije/jednaDiskusija/$idDis") ?>" target="_blank">Pogledaj diskusiju</a>
                    </div>
                <?php } ?>
                <div class="centar"> <input type='button' class="btn btn-primary btn-lg btn-block" onclick="prikaziFormu()" value='Zapocni novu diskusiju'></div>

                <div class="centar" id="formaDiv">
                    <?php
                    $ulogovani = $this->session->userdata('user')['korisnicko'];
                    ?>
                    <form name="dodajDsk"  method="POST" action="<?php echo site_url("Diskusije/dodajDiskusijuGrupe") ?>">
                        <table>
                            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
                            <tr><td><b>Naziv diskusije: </b></td><td><input type="text" class="form-control" name="naziv"></td></tr>
                            <tr><td><b>Opis: </b></td><td><input type="text" class="form-control" name="opis" ></td></tr>
                            <tr><td><b>Kategorija: </td><td></b>
                                    <select name="kategorija" class="form-control">
                                        <option disabled selected value="">Izaberi kategoriju</option>
                                        <?php
                                        foreach ($kategorije as $k) {

                                            $idKat = $k['idKatDis'];
                                            $nazivKat = $k['naziv'];
                                            echo "<option value='$idKat'>$nazivKat</option>";
                                        }
                                        ?></select></td></tr>
                             <tr><td><b>Nivo vidljivosti:<br> </b>   </tr></td>
                               <tr><td></td><td>
                                <input type="radio" name="vidljivost" value="gost">Svi posetioci sajta<br>
                                <input type="radio" name="vidljivost" value="studenti">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici" >Svi korisnici sajta<br>
                                <input type="radio" name="vidljivost" onclick="selectk()" value="kurs">Studenti odredjenog kursa<br>
                                       
                                <select name="odabraniKurs" id='vk'  class="form-control" style="display: none">  
                                                <option disabled selected value="">Odaberite kurs</option>
                                                <?php
                                                 foreach ($kursevi as $k){
                                                     $idKurs = $k['idKurs'];
                                                     $naziv = $k['naziv'];
                                                     echo "<option value='$idKurs'>$naziv</option>";
                                                 }
                                                 ?>
                                             </select>
                                <input type="radio" name="vidljivost" onclick="selectg()" value="grupa" >Formirana grupa studenata<br>
                                </div>
                <select name="odabranaGrupa" id="vg" class="form-control" style="display: none"> 
                                                <option disabled selected value="">Odaberite grupu</option>
                                                <?php
                                                     foreach ($grupa as $g){
                                                         $idGrupe = $g['idGru'];
                                                         $naziv = $g['naziv'];
                                                         echo "<option value='$idGrupe'>$naziv</option>";
                                                     }?>
                                            </select>
                                   </td></tr>
                            
                            <input type="hidden" name="idGru" value="<?php echo $idGru ?>"
                                   <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
                        </table>
                    </form>


                </div>
            </div>
            <div class="col-sm">
                <h4>Oglasi</h4>
                <?php

                if ($oglasiGrupe == null) {
                    echo "<div class='postdesno'>Trenutno nema oglasa</div>";
                } else {
                    foreach ($oglasiGrupe as $o) {
                        $idOgl = $o['idOgl'];
                        ?>
                        <div class="postdesno">
                            <b>Naslov: </b><?php echo $o['naslov'] ?></b><br/>
                            <b>Opis: </b><?php echo $o['opis'] ?><br/>
                            <b>Autor: </b><?php echo $o['naziv'] ?><br/>
                            <b>Datum postavljanja: </b><?php echo $o['vremePostavljanja'] ?><br/>
                            <a href="<?php echo site_url("Oglasi/pogledajOglas/$idOgl") ?>">Pogledaj oglas</a>
                        </div>

                    <?php }
                } ?>


            </div>
            <div class="col-sm">
                <h4>Vesti</h4>
                <?php

                foreach ($vestiGrupe as $v) {
                    $idVes = $v['idVes'];
                    ?>
                    <div class="postdesno">
                        <b>Naslov: </b><?php echo $v['naziv'] ?></b><br/>
                        <b>Tekst: </b><?php echo $v['tekst'] ?><br/>
                        <b>Autor: </b><?php echo $v['korisnicko'] ?><br/>
                        <b>Datum postavljanja: </b><?php echo $v['datum'] ?><br/>

                    </div>

                <?php }
                ?>
                <div class="centar"> <input type='button' class="btn btn-primary btn-lg btn-block " onclick="prikaziFormuV()" value='Postavi vest'></div>

                <div class="centar" id="formaDivV">
                    <form name="dodajVest" method="POST" action="<?php echo site_url("Vesti/dodajVestGrupe") ?>">
                        <table>
                            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
                            <tr><td><b>Naslov: </b></td><td><input type="text" class="form-control" name="naslov"></td></tr>
                            <tr><td><b>Tekst: </b></td><td><input type="text" class="form-control" name="tekst" ></td></tr>
                            <tr><td><b>Kategorija: </td><td></b>
                                    <select name="kategorija">
                                        <option disabled selected value="">Izaberi kategoriju</option>
                                        <?php
                                        foreach ($katVesti as $k) {

                                            $idKat = $k['idKatVesti'];
                                            $nazivKat = $k['naziv'];
                                            echo "<option value='$idKat'>$nazivKat</option>";
                                        }
                                        ?></select></td></tr><b>Nivo vidljivosti:<br> </b>   </tr></td>
                               <tr><td></td><td>
                                <input type="radio" name="vidljivost" value="gost">Svi posetioci sajta<br>
                                <input type="radio" name="vidljivost" value="studenti">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici">Svi korisnici sajta<br>
                                <input type="radio" name="vidljivost" onclick="selectvek()"value="kurs">Studenti odredjenog kursa<br>
                                       
                                <select name="odabraniKurs" id="vek" class="form-control" style="display: none">  
                                                <option disabled selected value="">Odaberite kurs</option>
                                                <?php
                                                 foreach ($kursevi as $k){
                                                     $idKurs = $k['idKurs'];
                                                     $naziv = $k['naziv'];
                                                     echo "<option value='$idKurs'>$naziv</option>";
                                                 }
                                                 ?>
                                             </select>
                                <input type="radio" name="vidljivost" onclick="selectveg() "value="grupa">Formirana grupa studenata<br>
                                </div>
                <select name="odabranaGrupa" id="veg" class="form-control" style="display: none"> 
                                                <option disabled selected value="">Odaberite grupu</option>
                                                <?php
                                                     foreach ($grupa as $g){
                                                         $idGrupe = $g['idGru'];
                                                         $naziv = $g['naziv'];
                                                         echo "<option value='$idGrupe'>$naziv</option>";
                                                     }?>
                                            </select>
                             </td></tr>
                            
                            <input type="hidden" name="idGru" value="<?php echo $idGru ?>"
                                   <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
                        </table>
                    </form>


                </div>
            </div>
            <div class="col-sm">
                <h4>Obaveštenja</h4>

                <?php
                foreach ($obavestenjaGrupe as $ob) {

                    $idOba = $ob['idOba'];
                    ?>
                    <div class="postdesno">
                        <b>Naslov: </b><?php echo $ob['naslov'] ?></b><br/>
                        <b>Tekst: </b><?php echo $ob['tekst'] ?><br/>
                        <b>Autor: </b><?php echo $ob['korisnicko'] ?><br/>
                        <b>Datum postavljanja: </b><?php echo $ob['datum'] ?><br/>

                    </div>
                    <?php
                }
                ?>
                <div class="centar"> <input type='button' class="btn btn-primary btn-lg btn-block" onclick="prikaziFormuO()" value='Postavi obaveštenje'></div>

                <div class="centar" id="formaDivO">
                    <form name="dodajObavestenja" method="POST" action="<?php echo site_url("Obavestenja/dodajObavestenjaGrupe") ?>">
                        <table>
                            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
                            <tr><td><b>Naslov: </b></td><td><input type="text"  class="form-control" name="naslov"></td></tr>
                            <tr><td><b>Tekst: </b></td><td><input type="text" class="form-control" name="tekst" ></td></tr>
                            <b>Nivo vidljivosti:<br> </b>   </tr></td>
                               <tr><td></td><td>
                                <input type="radio" name="vidljivost" value="gost">Svi posetioci sajta<br>
                                <input type="radio" name="vidljivost" value="studenti">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici">Svi korisnici sajta<br>
                                <input type="radio" name="vidljivost" onclick="selectok()" value="kurs">Studenti odredjenog kursa<br>
                                       
                                <select name="odabraniKurs" id="ok"class="form-control" style="display: none">  
                                    <option disabled selected value="">Odaberite kurs</option>
                                                <?php
                                                 foreach ($kursevi as $k){
                                                     $idKurs = $k['idKurs'];
                                                     $naziv = $k['naziv'];
                                                     echo "<option value='$idKurs'>$naziv</option>";
                                                 }
                                                 ?>
                                             </select>
                                <input type="radio" name="vidljivost" onclick="selectog()"value="grupa">Formirana grupa studenata<br>
                                </div>
                <select name="odabranaGrupa" id="og" class="form-control" style="display: none"> 
                    <option disabled selected value="" >Odaberite grupu</option>
                                                <?php
                                                     foreach ($grupa as $g){
                                                         $idGrupe = $g['idGru'];
                                                         $naziv = $g['naziv'];
                                                         echo "<option value='$idGru'>$naziv</option>";
                                                     }?>
                                            </select>
                             </td></tr>

                            <input type="hidden" name="idGru" value="<?php echo $idGru ?>"
                                   <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
                        </table>
                    </form>


                </div>

            </div>
        </div>
    </div>

</html>

<script>
   
            


    function prikaziFormu() {

        document.getElementById("formaDiv").style.display = "block";

    }

    function prikaziFormuV() {

        document.getElementById("formaDivV").style.display = "block";

    }

    function prikaziFormuO() {

        document.getElementById("formaDivO").style.display = "block";

    }
    
    function selectk() {
        document.getElementById("vk").style.display = "block";
    }
    
     function selectg() {
        document.getElementById("vg").style.display = "block";
    }
    
    function selectvek() {
        document.getElementById("vek").style.display = "block";
    }
    
     function selectveg() {
        document.getElementById("veg").style.display = "block";
    }
    function selectok() {
        document.getElementById("ok").style.display = "block";
    }
    
     function selectog() {
        document.getElementById("og").style.display = "block";
    }
    
</script>