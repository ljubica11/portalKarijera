<?php 



?>

<div class="container">

    <div class="row">
        <div class="col-6 col-sm">
            <div class="stats">



                <form class="form-inline" name="izvDisk" id="formaIzv" method="POST" action="">

                    Od &nbsp; <input type="date" name="datumOd" class="form-control" > 
                    &nbsp;   Do  &nbsp;<input type="date" name="datumDo" class="form-control" >
                    &nbsp; <input type ="submit" name="generate" value="Generiši izveštaj" class="btn btn-primary">

                </form>
                <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
                    <thead>
                    <h5>  Izveštaj za period:  <?php echo $datumOd . ' do ' . $datumDo ?></h5>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Ukupno</th>
                        <th scope="col">Vidljivo svima (%)</th>
                        <th scope="col">Ograničena vidljivost (%)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Diskusije</th>
                            <td><?php if (isset($brojDisk)){ echo count($brojDisk); }?></td>
                            <td><?php if (isset($diskVidljivost)) { if(count($brojDisk) !=0 or count($diskVidljivost) !=0){
                            echo $procVid = round((count($diskVidljivost)/count($brojDisk))*100, 2) ; ?></td>
                            <td><?php echo 100 - $procVid;}}?></td>
                        </tr>
                        <tr>
                            <th scope="row">Postovi</th>                           
                            <td><?php if (isset($brojPostova)) {echo count($brojPostova);} ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Grupe</th>                           
                            <td><?php if (isset($brojGrupa)) {echo count($brojGrupa);} ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Oglasi</th>                           
                            <td><?php if (isset($brojOglasa)) {echo count($brojOglasa);} ?></td>
                            <td><?php if (isset($oglasiVidljivost)) { if(count($oglasiVidljivost) != 0 or count($brojOglasa) != 0){
                            echo $procVidOgl = round((count($oglasiVidljivost)/count($brojOglasa))*100, 2) ; ?></td>
                            <td><?php echo 100 - $procVidOgl; }}?></td>
                        </tr>
                        <tr>
                            <th scope="row">Vesti</th>                           
                            <td><?php if (isset($brojVesti)){ echo count($brojVesti);} ?></td>
                            <td><?php if (isset($vestiVidljivost)) {if(!empty($vestiVidljivost) or !empty($brojVesti)){
                            echo $procVidVesti = round((count($vestiVidljivost)/count($brojVesti))*100, 2) ;?></td>
                            <td><?php echo 100 - $procVidVesti; }} ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Obaveštenja</th>                           
                            <td><?php if (isset($brojObavestenja)) {echo count($brojObavestenja);} ?></td>
                            <td><?php if (isset($obavestenjaVidljivost)) {if(!empty($brojObavestenja)or!empty($obavestenjaVidljivost)){
                            echo $procVidObav = round((count($obavestenjaVidljivost)/count($brojObavestenja))*100, 2);  ?></td>
                            <td><?php echo 100 - $procVidObav; }}?></td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6 col-sm">

        </div>
    </div>
</div>

<script>
form=document.getElementById("formaIzv");
function askForSave() {
        form.action="<?php echo site_url('Izvestaji/izvestajDiskusije')?>";
        form.action="<?php echo site_url('Izvestaji/izvestajPostovi')?>";
        form.action="<?php echo site_url('Izvestaji/izvestajGrupe')?>";
        form.action="<?php echo site_url('Izvestaji/izvestajOglasi')?>";
        form.action="<?php echo site_url('Izvestaji/izvestajVesti')?>";
        form.action="<?php echo site_url('Izvestaji/izvestajObavestenja')?>";
        form.action="<?php echo site_url('Izvestaji/diskusijeVidljivost')?>";
        form.action="<?php echo site_url('Izvestaji/oglasiVidljivost')?>";
        form.action="<?php echo site_url('Izvestaji/vestiVidljivost')?>";
        form.action="<?php echo site_url('Izvestaji/obavestenjaVidljivost')?>";
        form.submit();
}


 
</script>