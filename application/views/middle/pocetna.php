<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        
      <div class="container-fluid">
          <div class="row">
            <div class="col-3 levo">
                <b>Osnovni podaci: </b>
                <br/>
                <?php
                if(isset($podaci)){
                echo $podaci[0]['ime']." ".$podaci[0]['prezime'];
                echo "<br/>";
                echo "Datum rodjenja: ".$podaci[0]['datum'];
                echo "<br/>";
                echo "Telefon: ".$podaci[0]['telefon'];
                echo "<br/>";
                echo "Adresa: ".$podaci[0]['adresa'];
                echo "<br/>";
                echo "Grad: ".$podaci[0]['grad'];
                echo "<br/>";
                echo "Drzavljanstvo: ".$podaci[0]['drzavljanstvo'];
                echo "<br/>";
                echo "Status: ".$podaci[0]['status'];
                echo "<br/>";
                echo "Kurs: ".$podaci[0]['kurs'];
                }
                ?>
            </div>
            <div class="col-6">
                <div class="centar">
                    <b>Interesovanja:</b>
                    <br/>
                    <?php
                    
                    if(isset($interesovanja)){
                        foreach ($interesovanja as $interesovanje){
                            echo "-".$interesovanje['naziv']."<br/>";
                        }
                    }
                    ?>  
                </div>
                <div class="centar">
                    <b>Vestine: </b>
                    <br/>
                    <?php
                    if(isset($vestine)){
                        foreach ($vestine as $vestina){
                            echo "-".$vestina['naziv']."<br/>";
                        }
                    }
                        
                        ?>
                </div>
                <div class="centar">
                    <b>Obrazovanje:</b>
                <br/>
                    <?php
                    if(isset($diploma)){
                        echo "Fakultet: ".$diploma[0]['naziv'];
                        echo "<br/>";
                        echo "Odsek: ".$diploma[0]['odsek'];
                        echo "<br/>";
                        echo "Nivo: ".$diploma[0]['nivo'];
                        echo "<br/>";
                        echo "Zvanje: ".$diploma[0]['zvanje'];
                        echo "<br/>";
                        echo "Godina upisa: ".$diploma[0]['godinaUpisa'];
                        echo "<br/>";
                        echo "Godina zavrsetka: ".$diploma[0]['godinaZavrsetka'];
                    }
                    
                    //ovde treba da se doda jos da ispisuje i radno iskustvo, i studije, ako trenutno studira i tako dalje...
                    ?>
                </div>
            
            </div>
              <div class="col-3">
                   <a class="btn" href="<?php echo site_url("User/logout")?>">Logout</a> 
              </div>
          </div>
        </div> 
    </body>

