<!DOCTYPE html>

<div class="centar" >DODAJ OBAVESTENJE:</div>
<div class="centar" id="obav_Forma">
    <?php
    $id = $this->session->userdata('obavestenja')['idOba'];
    //$data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiSvaObavestenja()];
    ?>
    <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
        <table>
            <tr>
                <td><b>Naslov:</b></td>
                <td><input type="text" name="naslov" value="" placeholder="Naslov obavestenja" required=""></td>
            </tr>
            <tr>
                <td><b>Tekst:</b></td>
                <td><textarea name="obavest" value="" placeholder="Unesi obavestenje" required=""></textarea></td>
            </tr>
            <tr>
                <td><b>Autor:</b></td>
                <td><?php echo $this->session->userdata('user')['korisnicko'] ?></td>
            </tr>
            <tr>
                <td><b>Vidljivost: </b></td>
                <td>
                    <select id="idVid" name="vidljivost" onchange="omoguci()">
                        <option value="korisnici">Svi korisnici</option>
                        <option value="studenti">Svi studenti</option>
                        <option value="kurs">Studenti odredjenog kursa</option>
                        <option value="grupa">Formirana grupa studenata</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <select id="idKur" name="kurs" disabled="">
                        <?php
                        $kursevi = $this->ObavModel->dohvatiSveKurseve();
                        foreach ($kursevi as $kurs) {
                            $idKurs = $kurs['idKurs'];
                            $naziv = $kurs['naziv'];
                            echo "<option value='$idKurs'>$naziv</option>";
                        }
                        ?>
                        <!--<option value="php">PHP</option>
                        <option value="java">JAVA</option>
                        <option value="linux">LINUX</option>-->
                    </select>
                </td>                            
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <select id="idGru" name="grupa" disabled="">
                        <?php
                        $grupe = $this->ObavModel->dohvatiSveGrupe();
                        foreach ($grupe as $grupa) {
                            $idGru = $grupa['idGru'];
                            $naziv = $grupa['naziv'];
                            echo "<option value='$idGru'>$naziv</option>";
                        }
                        ?>
                        <!--<option value="prva">Prva grupa</option>
                        <option value="druga">Druga grupa</option>
                        <option value="treca">Treca grupa</option>-->
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <input type="submit" value="Oglasi" class="btn btn-outline-primary">
                </td>
            </tr>

        </table>
    </form>
</div>