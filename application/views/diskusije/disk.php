 
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
        $vidljivost = $d['vidljivost'];
        $zaBrisanje = $d['zaBrisanje'];
        $id = $d['idDis'];
        $brojPostova = $this->DiskusijeModel->brojPostova($id);
        $poslednjiId = $this->DiskusijeModel->poslednjiId($id);
                    foreach ($poslednjiId as $last){
                        $lastOne = $last['poslatoDatum'];
                    }
        ?>

        <div class="centar">
            <div class="diskusije">
        <b>Naziv diskusije: </b><?php echo $d['naziv'] ?></b><br/>
        <b>Opis: </b><?php echo $d['opis'] ?><br/>
        <b>Autor: </b><?php echo $d['korisnik'] ?><br/>
        <b>Datum pokretanja: </b><?php echo $d['datum'] ?><br/> 
        <b>Broj postova: </b><?php echo $brojPostova?></br>
        <b>Poslednji post: </b><?php if($brojPostova !=0){echo $lastOne;}?><br>
        
        
        <?php echo "<a href='#' class='badge badge-primary' onclick ='postovi($id)'> <b>Pogledaj postove</b></a>" ?>
        <?php if ($d['vidljivost'] != 'autor' && $tipKorisnika != 'gost') {
            echo "<a href='#' class='badge badge-primary' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a>";
        } ?>
       <?php if($this->session->userdata('user')['korisnicko'] == $autor && $vidljivost != 'autor' && $zaBrisanje != 'da')
        { echo "<a href='#' class='badge badge-primary float-right' onclick ='arhiviraj($id) window.location.reload()'> <b>Arhiviraj</b></a><br/>" ;
        } else if ( $zaBrisanje == 'da'&& $tipKorisnika != 'gost'){
           echo $msg = '<b class="float-right">' .'poslat zahtev za brisanje' . '</b>';
        } else if( $vidljivost == 'autor'&& $tipKorisnika != 'gost'){
            echo "<a href='#' class='badge badge-primary' onclick ='traziBrisanje($id) window.location.reload()'> <b>Zahtevaj brisanje</b></a><br/>";
            echo '<b class="float-right">'.'arhivirano'.'</b>';
        }?>
        
        
       
        
        

            </div>

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
     ?>
                    
                    
            <tr><td><b>Nivo vidljivosti:<br> </b>   </tr></td>
        <tr><td></td><td>    
                <?php if($tipKorisnika != 'k' AND $tipKorisnika == 's'){?>
                                <input type="radio" name="vidljivost" value="gost">Svi posetioci sajta<br>
                                <input type="radio" name="vidljivost" value="studenti">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici">Svi korisnici sajta<br>
                                <input type="radio" name="vidljivost" value="kurs" onclick="ispisiOpcije(value)">Studenti odredjenog kursa<br>
                                <div id="kurs"></div>
                                <input type="radio" name="vidljivost" value="grupa" onclick="ispisiOpcije(value)">Formirana grupa studenata<br>
                                <div id="grupa"></div>
                <?php } else if($tipKorisnika == 'k'){ ?>
                    
                                <input type="radio" name="vidljivost" value="gost" >Svi posetioci sajta<br>
                                <input type="radio" name="vidljivost" value="korisnici">Svi korisnici sajta<br>
                
                <?php }?>
            </td>
     

            <tr><td></td><td><input type="submit" value="dodaj" class="btn btn-outline-primary"></td></tr>
        </table>
    </form>
                   
  <?php  }?>


</div>