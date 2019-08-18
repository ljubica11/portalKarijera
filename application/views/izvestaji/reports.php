<?php

?>
 <h5>Oglasi po pravima pristupa</h5>
        <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
             
  <thead>
    <tr>
      <th scope="col">Vidljivi svima</th>
      <th scope="col">Vidljivi grupama</th>
      <th scope="col">Vidljivi kursevima</th>
      <th scope="col">Ukupno</th>
    </tr>
     </thead>
  <tbody>

    
      <td><?php if(isset($vidSviOgl)){echo count($vidSviOgl);}?></td>
      <td><?php if(isset($vidGrupaOgl)){echo count($vidGrupaOgl);}?></td>
      <td><?php if(isset($vidKursOgl)) {echo count($vidKursOgl);}?></td>
      <td><?php if(isset($vidiSviOgl) or isset($vidGrupaOgl) or isset($vidKursOgl)){ echo (count($vidGrupaOgl)+ count($vidKursOgl)+ count($vidSviOgl));}?></td>
      
     
    </tr>
  
  </tbody>
        </table>