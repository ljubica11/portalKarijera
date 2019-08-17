<?php

?>
<form name="izvDisk" method="POST" action="<?php echo site_url('Izvestaji/izvestajDiskusije')?>">
Od <input type="date" name="datumOd"><br>
Do <input type="date" name="datumDo">
<input type ="submit" name="generate" value="generate">
</form>
<?php 


  
?>
<table class="table"> 
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Broj diskusija</th>
      <th scope="col">.</th>
      <th scope="col">.</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><?php echo count($brojDisk) ?></td>
      <td></td>
      <td></td>
    </tr>
    
  </tbody>
</table>