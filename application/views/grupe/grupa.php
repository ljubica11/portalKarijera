<!DOCTYPE html>

<html>

    <?php
    //  echo 'test';
    // var_dump($clanovi);
    //var_dump($diskusijeGrupe);
    //  foreach($diskusijeGrupe as $dg){
    // }
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
                        <b>Autor: </b><?php echo $d['korisnicko'] ?><br/>
                        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
                        <a href="<?php echo site_url("Diskusije/jednaDiskusija/$idDis") ?>" target="_blank">Pogledaj diskusiju</a>
                    </div>
<?php } ?>
                <div class="centar"> <input type='button' class="btn btn-primary btn-lg btn-block" onclick="prikaziFormu()" value='Zapocni novu diskusiju'></div>

                <div class="centar" id="formaDiv">
<?php
$ulogovani = $this->session->userdata('user')['korisnicko'];
?>
                    <form name="dodajDsk" method="POST" action="<?php echo site_url("Diskusije/dodajDiskusijuGrupe") ?>">
                        <table>
                            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
                            <tr><td><b>Naziv diskusije: </b></td><td><input type="text" name="naziv"></td></tr>
                            <tr><td><b>Opis: </b></td><td><input type="text" name="opis" ></td></tr>
                            <tr><td><b>Kategorija: </td><td></b>
                    <select name="kategorija">
                        <option disabled selected value="">Izaberi kategoriju</option>
                        <?php
                        foreach ($kategorije as $k) {

                            $idKat = $k['idKatDis'];
                            $nazivKat = $k['naziv'];
                            echo "<option value='$idKat'>$nazivKat</option>";
                        }
                        ?></select></td></tr>

                            
                            
                            
                            
                            <input type="hidden" name="idGru" value="<?php echo $idGru ?>"
                            <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
                        </table>
                    </form>


                </div>
            </div>
            <div class="col-sm">
                <h4>Oglasi</h4>
<?php
//   var_dump($oglasiGrupe);
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

<?php } ?>


            </div>
            <div class="col-sm">
                <h4>Vesti</h4>
<?php
// var_dump($vestiGrupe);
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
           <div class="centar"> <input type='button' class="btn btn-primary btn-lg btn-block" onclick="prikaziFormuV()" value='Postavi vest'></div>

                <div class="centar" id="formaDivV">
<form name="dodajVest" method="POST" action="<?php echo site_url("Vesti/dodajVestGrupe") ?>">
                        <table>
                            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
                            <tr><td><b>Naslov: </b></td><td><input type="text" name="naslov"></td></tr>
                            <tr><td><b>Tekst: </b></td><td><input type="text" name="tekst" ></td></tr>
                            <tr><td><b>Kategorija: </td><td></b>
                    <select name="kategorija">
                        <option disabled selected value="">Izaberi kategoriju</option>
                        <?php
                        foreach ($katVesti as $k) {

                            $idKat = $k['idKatVesti'];
                            $nazivKat = $k['naziv'];
                            echo "<option value='$idKat'>$nazivKat</option>";
                        }
                        ?></select></td></tr>

                            
                            
                            
                            
                            <input type="hidden" name="idGru" value="<?php echo $idGru ?>"
                            <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
                        </table>
                    </form>


                    </div>
            </div>
            <div class="col-sm">
                <h4>Obaveštenja</h4>

<?php
// var_dump($obavestenjaGrupe);
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
</script>