<!DOCTYPE html>

      <form name="del" method="POST" action="<?php echo site_url('Grupe/obrisiClanaGrupe')?>">      
         <table class='table table-striped shadow-lg p-3 mb-5 bg-white rounded position-sticky'>
             
                 <input type="hidden" name="idGru" value="<?php echo $idGru?>">
  <thead class='thead-dark'>
   <tr>
      <th scope='col'></th>
      <th scope='col'>Ime</th>
      <th scope='col'>Prezime</th>
     
    </tr>
  </thead>
  <tbody>
      <?php 
       foreach($clanovi as $c){
           $ime = $c['ime'];
           $prezime = $c['prezime'];
           $idKor = $c['idKor'];
           
            ?>
               
   <tr>


        <th scope='row'><input type='checkbox' name='idKor[]' value=value=' <?php echo $idKor ?>'></th>
        <td><a href="<?php echo site_url('User/index')?>?id=<?php echo $idKor ?>" target="_blank"><?php echo $ime ?></td></a>
        <td><a href="<?php echo site_url('User/index')?>?id=<?php echo $idKor ?>" target="_blank"><?php echo $prezime?></td></a>

    </tr>
 <?php       }?>
    <tr>
        <th scope='row'></th>
        <td></td>
        <td><input type="submit" name="delete" value="Obrisi clana"></td>
    </tr>
      
       
    
</table>
    </form>            
   
        


