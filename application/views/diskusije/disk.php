 
<?php
if ($this->session->has_userdata('user')) {
    $tipKorisnika = $this->session->userdata('user')['tip'];
} else {
    $tipKorisnika = "gost";
}
?>

<?php
 // var_dump($diskusije);
if (isset($diskusije)) {

    foreach ($diskusije as $d) {

        $autor = $d['korisnik'];

        ?>

        <div class="centar">

            <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
        <b>Opis: </b><?php echo $d['opis'] ?><br/>
        <b>Autor: </b><?php echo $d['korisnik'] ?><br/>
        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
        <?php $id = $d['idDis'] ?>
        <?php echo "<a href='#' class='badge badge-primary' onclick ='postovi($id)'> <b>Pogledaj postove</b></a>" ?>
        <?php if ($d['vidljivost'] != 'autor' && $tipKorisnika != 'gost') {
            echo "<a href='#' class='badge badge-primary' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a>";
        } ?>
        <?php if($this->session->userdata('user')['korisnicko']== $autor && $d['vidljivost'] != 'autor' && $d['zaBrisanje'] != 'da')
        { echo "<a href='#' class='badge badge-primary float-right' onclick ='arhiviraj($id)'> <b>Arhiviraj</b></a><br/>" ;
        } else if ($d['zaBrisanje'] == 'da'){
           echo $msg = '<b class="float-right">' .'poslat zahtev za arhiviranje' . '</b>';
        } else if($d['vidljivost'] == 'autor'){
           
            echo '<p class="float-right">'.'arhivirano'.'</p>';
        }
        
        
         ?>
        
        



        </div>
        <?php
    }
}
?>

<?php if ($tipKorisnika != 'gost') {
    echo '  
                        
                   <div class="centar"> <input type="button" class="btn btn-primary btn-lg btn-block" onclick="prikaziFormu()" value="Zapocni novu diskusiju">
                   </div>
                           ';
}
?>




<div class="centar" id="formaDiv">
    <?php
    $ulogovani = $this->session->userdata('user')['korisnicko'];
    $kategorije = $this->DiskusijeModel->dohvatiKategorije();
    ?>
    <?php if ($tipKorisnika != 'gost') {?>

      
    
    <form name="dodajDsk" method="POST" action="<?php echo site_url("Diskusije/dodajDiskusiju") ?>">
        <table>
            <tr><td><b>Autor: </b></td><td><?php echo $ulogovani ?></td></tr>
            <tr><td><b>Naziv diskusije: </b></td><td><input type="text" name="naziv"></td></tr>
            <tr><td><b>Opis: </b></td><td><input type="text" name="opis" ></td></tr>
            <tr><td><b>Kategorija: </td><td></b>
                    <select name="kategorija">
                        <option disabled selected value="">Izaberi kategoriju</option>
    
   
    
    <?php }
if ($tipKorisnika != 'gost') {
    foreach ($kategorije as $k) {

        $idKat = $k['idKatDis'];
        $nazivKat = $k['naziv'];
        echo "<option value='$idKat'>$nazivKat</option>";
    }
}
?></select></td></tr>
<?php if ($tipKorisnika != 'gost') {
    echo ' 
                    
                    
            <tr><td><b>Nivo vidljivosti:<br> </b>   </tr></td>
        <tr><td></td><td>
        
                                <input type="radio" name="vidljivost" value="studenti">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici">Svi korisnici sajta<br>
                                <input type="radio" name="vidljivost" value="kurs" onclick="ispisiOpcije(value)">Studenti odredjenog kursa<br>
                                <div id="kurs"></div>
                                <input type="radio" name="vidljivost" value="grupa" onclick="ispisiOpcije(value)">Formirana grupa studenata<br>
                                <div id="grupa"></div>
            </td>
     

            <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
        </table>
    </form>
                    ';
}
?>


</div>