<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/styleAdmin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="https://kit.fontawesome.com/2dd4f4a4ca.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <title></title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo site_url('User')?>">Portal Karijera</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url("Vesti/index") ?>">Vesti</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url("Obavestenja/index");?>">Obaveštenja</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url("Diskusije/index")?>">Diskusije</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('Oglasi');?>">Oglasi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url("Grupe/index")?>">Grupe</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url("Izvestaji/index")?>">Izvestaji</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url("Statistika/index")?>">Statistika</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('Pretraga');?>">Pretraga sajta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo site_url("User/logout")?>">Logout</a> 
                </li>
              </ul>
                
            </div> 
        </nav>

