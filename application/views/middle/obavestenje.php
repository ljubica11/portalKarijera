

<div class="container-fluid">
    <div class="row">
        <div class="col-3" >
            <b class="p-0 bg-info">Obavestenja: </b>
            <br>
                <?php
                foreach ($obavestenja as $obavestenje){
                    echo $obavestenje ['tekst']."<br>";
                }
                ?>
        </div>
        <div class="col-6">
            <div id="obavestenja"> </div>            
        </div>
        <div class="col-3">
            <div class="centar" >DODAJ OBAVESTENJE:</div>
            <div class="centar" id="obav_Forma">
                <?php
                $id = $this->session->userdata('obavestenja')['idOba'];
                $data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiObavestenje()];
                ?>
                <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
                    <table>
                        
                        <tr>
                            <td><b>Naslov:</b></td>
                            <td><input type="text" name="naslov" value="" placeholder="Naslov obavestenja"></td>
                        </tr>
                        <tr>
                            <td><b>Tekst:</b></td>
                            <td><textarea name="obavest" value="" placeholder="Unesi obavestenje"></textarea></td>
                        </tr>
                        <tr>
                            <td><b>Autor:</b></td>
                            <td><?php echo $this->session->userdata('user')['korisnicko'] ?></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Oglasi" class="btn btn-outline-primary">
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
            
        </div>
               <!-- <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
                    <input type="text" name="naslov" value="" placeholder="Naslov obavestenja"><br>
                    <textarea name="obavest" value="" placeholder="Unesi obavestenje"></textarea><br>
                    <input type="text" name="aut" value="" placeholder="Ime i prezime autora"><br>
                    <input type="submit" name="sub" value="Oglasi">       
                </form>
               -->
    </div>    
</div>
<script>

        function obavestenja(id) {

            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("obavestenja").innerHTML = this.responseText;

                }
            }
            xmlhttp.open("GET", "<?php echo site_url('Obavestenja/dodajObavestenje') ?>?id=" + id, true);
            xmlhttp.send();
        }

    </script>

        
    

