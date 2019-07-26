<!DOCTYPE html>

<h4> Pretraga </h4>
            <form name="pretragaPoslovaForma" method="GET" action="<?php echo site_url('Oglasi/pretraga')?>">
                <input type="text" name="pretraga" id="pretragaPoslova" class="form-control" placeholder="Kompanija, pozicija ili kljucna rec">
                <br/>
                <select name="grad" class="form-control">
                    <option disabled selected value="">Odaberite grad</option>
                    <?php
                        foreach ($gradovi as $grad){
                            $naziv = $grad["naziv"];
                            $idGra = $grad["idGra"];
                            echo "<option value='$idGra'>$naziv</option>";
                        }
                    ?>
                    
                </select>
                <input type="submit" name="pretrazi" value="Pretrazi" class="btn btn-lg btn-primary btn-search-job" >
            </form>