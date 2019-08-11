<!DOCTYPE html>

<h4> Pretraga </h4>
           <form name="pretragaPoslovaForma" method="GET"> 
               <input type="text" name="pretraga" id="pretragaPoslova" class="form-control" placeholder="Kompanija ili pozicija">
                <div id="predlozi"></div>
                    
                <br/>
                <select name="grad" class="form-control" id="grad">
                    <option disabled selected value="">Odaberite grad</option>
                    <?php
                    $tip = $this->session->userdata('user')['tip'];
                       foreach ($mesta as $mesto){
                                        $naziv = $mesto["naziv"];
                                        $idG = $mesto["idGra"];
                                        echo "<option value='$idG'>$naziv</option>";
                                    }
                    ?>
                    
                </select>
                <input type="button" name="pretrazi" value="Pretrazi" class="btn btn-lg btn-primary btn-search-job" onclick="pretraziOglase(<?php echo "'".$tip."'"?>)">
            </form> 