

 <div id='wrapper'></div>
     <?php
                    
                  // <div class="postdesno" id="wrapper"> <input type="text" id='novipost' class="form-control" width="90%"></div> 
                   
                    foreach($postovi as $p){
                        
                        ?>
                   <div class="postdesno">
                  <?php  echo $p['korisnik'].': '.$p['tekst'].'<br> '.$p['datum'].'<br>'
                    
                    
                    .'</div>';
                    }
                   
                
                   ?>
