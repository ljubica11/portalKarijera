<!DOCTYPE html>

            
         <table class='table table-striped shadow-lg p-3 mb-5 bg-white rounded position-sticky'>
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
       
               echo
   " <tr>
      <th scope='row'></th>
      <td>$ime</td>
      <td>$prezime</td>
      
    </tr>";
       
       }?>
</table>
          
   
        
 

