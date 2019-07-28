<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <form name="obavForma" method="POST" action="<?php echo site_url('Obavestenja/dodajObavestenje') ?>">
            <input type="text" name="naslov" value="" placeholder="Naslov obavestenja"><br>
            <textarea name="obavest" value="" placeholder="Unesi obavestenje"></textarea><br>
            <input type="text" name="aut" value="" placeholder="Ime i prezime autora"><br>
            <input type="submit" name="sub" value="Oglasi">       
        </form>
        <?php
        foreach ($obavestenja as $obavestenje){
            echo $obavestenje ['tekst']."<br>";
        }
        ?>
    </body>
</html>
