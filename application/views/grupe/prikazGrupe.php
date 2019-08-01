<!DOCTYPE html>

       <?php foreach ($grupe as $g){ ?>

<div class="centar">
    <h5><a href="#"><?php echo $g["naziv"]?></a></h5>
    <b>ID Grupe:</b> <?php $idGru =$g["idGru"]; echo $g["idGru"];?>
    <br/>
    <b>Naziv:</b> <?php echo $g["naziv"];?>
    <br/>
    <b>Opis:</b> <?php echo $g['opis'];?>
    <br/>
    <b>Broj clanova:</b><?php
    $brojClanova = $this->db->where('idGru', $idGru)->count_all_results('clanovigrupe'); 
            echo ' '.$brojClanova; ?>
    <form name='uclaniLogovanog' method='GET' action="<?php echo site_url('Grupe/uclaniLogovanog')?>">
        <input type="hidden" name='idGru' value="<?php echo $idGru; ?>">
        <input type="submit" class="btn btn-outline-primary btn-sm float-right" value='UCLANI SE'>
    </form>
 
    <form name='ispisClanova' method="POST" action="<?php echo site_url('Grupe/ispisiClanove')?>">
        <?php echo 
        "<input type='hidden' name='idGru' id='idGru' value='$idGru'>".
        "<input type='button' onclick='prikaziParametre($idGru)' class='btn btn-outline-primary btn-sm' value='prikazi parametre'>".
               
        "<input type='button'  onclick='ispis($idGru)' class='btn btn-outline-primary btn-sm' value='prikazi clanove'>";
       
                ?>
    </form>
</div>

<?php } ?>
    </body>
</html>
