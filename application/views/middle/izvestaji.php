<?php //var_dump($vidKursOgl);  ?>
<div class="container">

    <div class="row">
        <div class="col-9 offset-3 stats">
            <form class="form-inline" name="izvDisk" id="formaIzv" method="POST" action="<?php echo site_url('Izvestaji/index') ?>">

                Od &nbsp; <input type="date" name="datumOd" class="form-control" > 
                &nbsp;   Do  &nbsp;<input type="date" name="datumDo" class="form-control" >
                &nbsp; <input type ="submit" name="generate" value="Generiši izveštaj" class="btn btn-primary">


            </form>
            <form class="float-right" method="POST" action="<?php echo site_url('Izvestaji/posalji') ?>">
                <input type ="submit" name="sendMail" value="Pošalji izveštaj" class="btn btn-primary">
            </form>
        </div>
        <div class="col-6 col-sm">
            <div class="stats">




                <table class="table table-striped table-bordered shadow-lg p-3 mb-5">
                    <thead>
                    <h5>  Izveštaj za period:  <?php
                        if (isset($datumOd) AND isset($datumDo)) {
                            echo ' od ' . $datumOd . ' do ' . $datumDo;
                        }
                        ?></h5>
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
                            <td><?php
                        if (isset($brojDisk)) {
                            echo count($brojDisk);
                        }
                        ?></td>
                            <td><?php
                                if (isset($diskVidljivost)) {
                                    if (count($brojDisk) == 0) {
                                        echo 0;
                                    } else {
                                        echo $procVid = round((count($diskVidljivost) / count($brojDisk)) * 100, 2);
                                        ?></td>
                                    <td><?php
                                        echo 100 - $procVid;
                                    }
                                } else {
                                    ?></td><td></td><?php } ?>
                        </tr>
                        <tr>
                            <th scope="row">Postovi</th>                           
                            <td><?php
                            if (isset($brojPostova)) {
                                echo count($brojPostova);
                            }
                                ?></td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="row">Grupe</th>                           
                            <td><?php
                                if (isset($brojGrupa)) {
                                    echo count($brojGrupa);
                                }
                                ?></td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="row">Oglasi</th>                           
                            <td><?php
                                if (isset($brojOglasa)) {
                                    echo count($brojOglasa);
                                }
                                ?></td>
                            <td><?php
                                if (isset($oglasiVidljivost)) {
                                    if (count($brojOglasa) == 0) {
                                        echo 0;
                                    } else {
                                        echo $procVidOgl = round((count($oglasiVidljivost) / count($brojOglasa)) * 100, 2);
                                        ?></td>
                                    <td><?php
                                echo 100 - $procVidOgl;
                            }
                        } else {
                                    ?></td><td></td><?php } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Vesti</th>                           
                            <td><?php
                                if (isset($brojVesti)) {
                                    echo count($brojVesti);
                                }
                                ?></td>
                            <td><?php
                                if (isset($vestiVidljivost)) {
                                    if (count($brojVesti) == 0) {
                                        echo 0;
                                    } else {
                                        echo $procVidVesti = round((count($vestiVidljivost) / count($brojVesti)) * 100, 2);
                                        ?></td>
                                    <td><?php
                                        echo 100 - $procVidVesti;
                                    }
                                } else {
                                    ?></td><td></td><?php } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Obaveštenja</th>                           
                            <td><?php
                                if (isset($brojObavestenja)) {
                                    echo count($brojObavestenja);
                                }
                                ?></td>
                            <td><?php
                                if (isset($obavestenjaVidljivost)) {
                                    if (count($brojObavestenja) == 0) {
                                        echo 0;
                                    } else {
                                        echo $procVidObav = round((count($obavestenjaVidljivost) / count($brojObavestenja)) * 100, 2);
                                        ?></td>
                                    <td><?php
                                        echo 100 - $procVidObav;
                                    }
                                } else {
                                    ?></td><td></td><?php } ?></td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-6 col-sm">
            <div class="stats">
                <h5>Diskusije po pravima pristupa</h5>
                <table class="table table-striped table-bordered shadow-lg p-3 mb-5">

                    <thead>
                        <tr>
                            <th scope="col">Vidljive svima</th>
                            <th scope="col">Vidljive grupama</th>
                            <th scope="col">Vidljive kursevima</th>
                            <th scope="col">Vidljive korisnicima</th>
                            <th scope="col">Arhivirane</th>
                            <th scope="col">Ukupno</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td><?php
                                if (isset($diskVidljivost)) {
                                    echo count($diskVidljivost);
                                }
                                ?></td>
                            <td><?php
                                if (isset($grupeDiskusije)) {
                                    echo count($grupeDiskusije);
                                }
                                ?></td>
                            <td><?php
                                if (isset($kursDiskusije)) {
                                    echo count($kursDiskusije);
                                }
                                ?></td>
                            <td><?php
                        if (isset($korisniciDiskusije)) {
                            echo count($korisniciDiskusije);
                        }
                        ?></td>
                            <td><?php
                        if (isset($arhiviraneDiskusije)) {
                            echo count($arhiviraneDiskusije);
                        }
                        ?></td>
                            <td><?php
                        if (isset($brojDisk)) {
                            echo count($brojDisk);
                        }
                        ?></td>
                        </tr>
                        <tr>
                    </tbody>
                </table>

                <h5>Oglasi po pravima pristupa</h5>
                <table class="table table-striped table-bordered shadow-lg p-3 mb-5">

                    <thead>
                        <tr>
                            <th scope="col">Vidljivi svima</th>
                            <th scope="col">Vidljivi grupama</th>
                            <th scope="col">Vidljivi kursevima</th>
                            <th scope="col">Ukupno</th>
                        </tr>
                    </thead>
                    <tbody>


                    <td><?php
                        if (isset($vidSviOgl)) {
                            echo count($vidSviOgl);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidGrupaOgl)) {
                            echo count($vidGrupaOgl);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidKursOgl)) {
                            echo count($vidKursOgl);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidiSviOgl) or isset($vidGrupaOgl) or isset($vidKursOgl)) {
                            echo (count($vidGrupaOgl) + count($vidKursOgl) + count($vidSviOgl));
                        }
                        ?></td>


                    </tr>

                    </tbody>
                </table>


                <h5>Vesti po pravima pristupa</h5>
                <table class="table table-striped table-bordered shadow-lg p-3 mb-5">

                    <thead>
                        <tr>
                            <th scope="col">Vidljivi svima</th>
                            <th scope="col">Vidljivi grupama</th>
                            <th scope="col">Vidljivi kursevima</th>
                            <th scope="col">Vidljivost pretraga</th>
                            <th scope="col">Ukupno</th>
                        </tr>
                    </thead>
                    <tbody>


                    <td><?php
                        if (isset($vidSviVes)) {
                            echo count($vidSviVes);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidGrupaVes)) {
                            echo count($vidGrupaVes);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidKursVes)) {
                            echo count($vidKursVes);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidPretragaVes)) {
                            echo count($vidPretragaVes);
                        }
                        ?></td>
                    <td><?php
                        if (isset($vidiSviVes) or isset($vidGrupaVes) or isset($vidKursVes)) {
                            echo(count($vidGrupaVes) + count($vidKursVes) + count($vidSviVes) + count($vidPretragaVes));
                        }
                        ?></td>


                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
