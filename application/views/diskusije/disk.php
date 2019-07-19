
            
                
                <?php
                       if(isset($diskusije)){
                         foreach ($diskusije as $d){
                            
                        ?>
                <div class="centar">
                    
                    <b>Naziv diskusije: </b><?php echo $d['naziv']?></b><br/>
                          <b>Autor: </b><?php echo $d['korisnik']?><br/>
                          <b>Opis: </b><?php echo $d['opis']?><br/>
                          <b>Datum pokretanja: </b><?php echo $d['datum']?><br/> 
                          <?php $id= $d['idDis']?>
                      <?php echo "<a href='#' onclick ='postovi($id)'> <b>Pogledaj postove</b></a><br/>" ?>
                      <?php echo "<a href='#' onclick ='dodajdiv($id)'> <b>Dodaj post</b></a><br/>" ?>
                        
                       
                </div>
                <?php }
                       }     ?>
