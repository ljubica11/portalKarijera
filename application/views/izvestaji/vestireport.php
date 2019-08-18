<?php ?>

 <h5>Vesti po pravima pristupa</h5>
        <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
             
  <thead>
    <tr>
      <th scope="col">Vidljivi svima</th>
      <th scope="col">Vidljivi grupama</th>
      <th scope="col">Vidljivi kursevima</th>
       <th scope="col">Vidljivost pretraga</th>
      <th scope="col">Ukupno</th>
    </tr>
     </thead>
  <tbody>

    
      <td><?php if(isset($vidSviVes)){echo count($vidSviVes);}?></td>
      <td><?php if(isset($vidGrupaVes)){echo count($vidGrupaVes);}?></td>
      <td><?php if(isset($vidKursVes)) {echo count($vidKursVes);}?></td>
      <td><?php if(isset($vidPretragaVes)) {echo count($vidPretragaVes);}?></td>
      <td><?php if(isset($vidiSviVes) or isset($vidGrupaVes) or isset($vidKursVes)){ echo(count($vidGrupaVes)+ count($vidKursVes)+ count($vidSviVes) + count($vidPretragaVes));}?></td>
      
     
    </tr>
  
  </tbody>
        </table>

