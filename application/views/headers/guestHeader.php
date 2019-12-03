<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="http://localhost/portalKarijera/css/styleGuest.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/2dd4f4a4ca.js"></script>
  <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">
  <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css"
    media="all">
  <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
  <title></title>
</head>

<body style="background-color: #e6e6e6">
  <nav class="navbar navbar-expand-lg navbar-light" id="header">
    <a class="navbar-brand"
      href="<?php echo site_url('Login')?>"><img
        id="brand-image"
        src="<?php echo base_url()?>//images/logo.png" width="90"
        height="60" title="Logo" alt="Logo">PortalKarijera</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link"
            href="<?php echo base_url()?>index.php/obavestenja">Obaveštenja<span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="<?php echo base_url()?>index.php/vesti">Vesti<span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="<?php echo base_url()?>index.php/diskusije">Diskusije</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="<?php echo base_url()?>index.php/oglasi">Oglasi</a>
        </li>
        <li class="nav-item">

          <a class="nav-link"
            href="<?php echo base_url()?>index.php/registracija">Registracija</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" name="loginForma" method="POST"
        action="<?php echo site_url('Login/logovanje')?>">
        <input class="form-control mr-sm-2" type="text" placeholder="Korisnicko ime" name="username">
        <input class="form-control mr-sm-2" type="password" placeholder="Lozinka" name="pass">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Login</button>
      </form>
    </div>
  </nav>