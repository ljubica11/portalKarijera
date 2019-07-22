 


<?php
//var_dump($diskusije);
if (isset($diskusije)) {
    foreach ($diskusije as $d) {
        ?>
        <div class="centar">

        <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
        <b>Opis: </b><?php echo $d['opis'] ?><br/>
        <b>Autor: </b><?php echo $d['korisnik'] ?><br/>
        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
        <?php $id = $d['idDis'] ?>
        <?php echo "<a href='#' onclick ='postovi($id)'> <b>Pogledaj postove</b></a>" ?>
        <?php echo "<a href='#' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a><br/>" ?>



        </div>
        <?php
    }
}
?>


<div class="centar"> <input type='button' onclick="prikaziFormu()" value='Zapocni novu diskusiju'></div>


<div class="centar" id="formaDiv">
    <?php
    $ulogovani = $this->session->userdata('user')['korisnicko'];
    $kategorije = $this->DiskusijeModel->dohvatiKategorije();
    ?>
    <form name="dodajDsk" method="POST" action="<?php echo site_url("Diskusije/dodajDiskusiju") ?>">
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

            <tr><td></td><td><input type="submit" value="dodaj"></td></tr>
        </table>
    </form>


</div>