<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/styleGuest.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title></title>
    </head>
    <body backround="pozadinaPocetna3.jpg" style="background: url('images/pozadinaPocetna3')">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><img src="images/logo.png" width="90" height="60" title="Logo" alt="Logo" />Portal Karijera</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="search" class="form-inline my-2 my-lg-0" name="searchIcon">
                    <form action="guestHeader.php" class="form-popup" id="myForm" style="display:none; position: relative; top: 10%">
                        <input type="text" placeholder="Pretraga" name="search" required onclick="">
                    </form>
                </li>
                <li class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-primary my-2 my-sm-0 open-button  ">
                        <img src="images/search.png" width="18" height="18" onclick="otvoriSearch()"></button>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('vesti')?>">Vesti<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('diskusije')?>">Diskusije</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('oglasi')?>">Oglasi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('registracija')?>">Registracija</a>
                </li>
              </ul>
                <form class="form-inline my-2 my-lg-0" name="loginForma" method="POST" action="<?php echo site_url('Login/logovanje')?>">
                    <input class="form-control mr-sm-2" type="text" value="Korisnicko ime">
                    <input class="form-control mr-sm-2" type="text" value="Lozinka">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
                </form>
            </div> 
        </nav>
        <script>
            function otvoriSearch() {
                document.getElementById("myForm").style.display = "block";
            } 
        </script>
    </body>
</html>
        
        
