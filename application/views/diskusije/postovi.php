

 <div id='wrapper'></div>
     <?php
                 
                 
                    foreach($postovi as $p){
                        
                        ?>
                   <div class="postdesno">
                  <?php  echo $p['korisnik'].': '.$p['tekst'].'<br> '.$p['datum'].'<br>'
                    
                    
                    .'</div>';
                    }
                   
                
                   ?>
