
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <b class="p-0 bg-info">Vesti</b>
            <br/>
            <?php 
                foreach ($kategorije as $k){
                    $idKatVesti = $k['idKatVesti'];
                    echo "<a href='#' onclick='vesti($idKatVesti)'>" . $k['naziv'] . "</a><br/>";
                }
            ?>
        </div>
        <div class="col-6">
            <div id="vesti"></div>
        </div>
        <div class="col-3">
            <div class="centar">DODAVANJE VESTI: </div>
            <div class="centar" id="formavesti">
                <?php
                    $ulogovani = $this->session->userdata('user')['korisnicko'];
                    $kategorije = $this->VestiModel->dohvatiKategorijeVesti()
                ?>
                <form name="forma_vesti" method="POST" action="<?php echo site_url('Vesti/dodajVest') ?>">
                    <table>
                        <tr>
                            <td><b>Autor:</b></td>
                            <td><?php echo $ulogovani ?></td>
                        </tr>
                        <tr>
                            <td><b>Naziv:</b></td>
                            <td><input type="text" name="naziv"></td>
                        </tr>
                        <tr>
                            <td><b>Tekst:</b></td>
                            <td><textarea name="tekst"></textarea></td>
                        </tr>
                        <tr>
                            <td>Kategorija:</td>
                            <td>
                                <select name="kategorija">
                                    <option value="" selected disabled>Izaberi kategoriju vesti</option>
                                    <?php
                                        foreach ($kategorije as $k){
                                            $idKatVesti = $k['idKatVesti'];
                                            $nazivKat = $k['naziv'];
                                            echo "<option value='$idKatVesti'>$nazivKat</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Dodaj vest" class="btn btn-outline-primary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script>
        function vesti(id){
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("vesti").innerHTML = this.responseText;
                 
                }
            }
            xmlhttp.open("GET", "<?php echo site_url('Vesti/ispisiVesti') ?>?id="+id, true);
            xmlhttp.send();
        }
    </script>
</div>

