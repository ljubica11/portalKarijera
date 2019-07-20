

 <div id='wrapper'></div>
     <?php
                 //   var_dump($this->session->userdata('user')['idKor']);
                    //var_dump($tekst);
                 
                    foreach($postovi as $p){
                        
                        ?>
                   <div class="postdesno">
                  <?php  echo $p['korisnik'].': '.$p['tekst'].'<br> '.$p['datum'].'<br>'
                    
                    
                    .'</div>';
                    }
                   
                
                   ?>
