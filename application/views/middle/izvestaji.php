<?php

foreach($zaposleni as $z){
    $brojZaposlenih = $z['broj zaposlenih'];
}
foreach($nezaposleni as $n){
    $brojNezaposlenih = $n['broj nezaposlenih'];
}
     
     
    foreach($phpkurs as $p){
        $phpovci = $p['kurs'];
        }
        foreach ($javakurs as $j){
            $javashi = $j['kurs'];
        }
        foreach ($linuxkurs as $l) {
            $linuxashi = $l['kurs'];
        }
  
  
?>
  
  <div class="container">
 
  <div class="row">
    <div class="col-6 col-sm">
        <div class="stats">
            <h5>Struktura studenata po zaposlenosti</h5>
        <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
             
  <thead>
    <tr>
      <th scope="col">Studenti</th>
      <th scope="col">Zaposleni</th>
      <th scope="col">Nezaposleni</th>
      <th scope="col">Na studijama</th>
      <th scope="col">Ukupno</th>
    </tr>
     </thead>
  <tbody>
    <tr>
      <th scope="row">ukupno</th>
      <td><?php echo $brojZaposlenih?></td>
      <td><?php echo $brojNezaposlenih?></td>
      <td><?php echo $studenti - $brojZaposlenih - $brojNezaposlenih ?></td>
      <td><?php echo $studenti ?></td>
    </tr>
    <tr>
      <th scope="row">%</th>
      <td><?php echo $procZap = round(($brojZaposlenih/$studenti)*100, 2) ?></td>
      <td><?php echo $procNezap = round(($brojNezaposlenih/$studenti)*100, 2) ?></td>
      <td><?php echo $procStudira = (100 - $procZap - $procNezap) ?></td>
      <td>100</td>
    </tr>
  </tbody>
</table>
       
  
 
    </div>
        <div class="stats">
            <h5>Struktura studenata po završenom kursu</h5>
        <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
             
  <thead>
    <tr>
      <th scope="col">Studenti</th>
      <th scope="col">PHP</th>
      <th scope="col">Java</th>
      <th scope="col">Linux</th>
      <th scope="col">Ukupno</th>
    </tr>
     </thead>
  <tbody>
    <tr>
      <th scope="row">ukupno</th>
      <td><?php echo $phpovci ?></td>
      <td><?php echo $javashi  ?></td>
      <td><?php echo $linuxashi ?></td>
      <td><?php echo $studenti ?></td>
    </tr>
    <tr>
      <th scope="row">%</th>
      <td><?php echo $procPhp = round(($phpovci/$studenti)*100, 2) ?></td>
      <td><?php  echo $procJava = round(($javashi/$studenti)*100, 2) ?></td>
      <td><?php echo $procLinux = (100 - $procPhp - $procJava) ?></td>
      <td>100</td>
    </tr>
  </tbody>
</table>
       
  
 
    </div>
        
        </div>
 
        
       
    <div class="col-6 col-sm">
        
        <div class="stats"> 
             <h5>Struktura studenata po završenim fakultetima</h5>
       <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
             
  <thead>
    <tr>
      <th scope="col">Naziv fakulteta</th>
      <th scope="col">Broj studenata</th>
      <th scope="col">%</th> 
    </tr> 
  </thead>
  <?php 
   foreach($fakulteti as $f){
          $idFak=$f['idFak'];
          $naziv = $f['naziv'];
         $broj = $this->StatistikaModel->diploma($idFak);
         
  ?>
  <tbody>
  <tr>
     
      <td><?php echo $naziv ?></td>
      <td><?php echo $broj  ?></td>
      <td><?php echo $procDiploma = round(($broj/$zbirDiploma)*100, 2) ?></td>
      
    </tr>
    </tbody>
   <?php }?>
    <tr>
        <th>Ukupno</th>
        <td><?php echo $zbirDiploma ?></td>
        <td><?php echo '100';?></td>
    </tr>
       </table>       
         
      </div>      
   
  
</div>
          
  </div>
  </div>