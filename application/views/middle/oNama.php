<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/styleGuest.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container-fluid" id="oNama">
        <div class="row">
            <div class="col-sm-5">
                <a href="<?php echo base_url() ?>"><img
                        src="<?php echo base_url() ?>/images/strelicalevo.png"
                        id="strelicaLevo"></a><a
                    href="<?php echo base_url() ?>">Početna
                    stranica</a>
            </div>
            <div class="col-sm-2" id="naslovOnama">
                <h1>NAS TIM</h1>
            </div>
            <div class="col-sm-5">
                <?php if (!$this->session->has_userdata('user')) { ?>
                <a id="uslkor"
                    href="<?php echo base_url() ?>index.php/Login/usloviKoriscenja">Uslovi
                    korišćenja</a><a
                    href="<?php echo base_url() ?>index.php/Login/usloviKoriscenja"><img
                        src="<?php echo base_url() ?>/images/strelicadesno.png"
                        id="strelicaDesno"></a>
                <?php } else { ?>
                <a id="uslkor"
                    href="<?php echo base_url() ?>index.php/User/usloviKoriscenja">Uslovi
                    korišćenja</a><a
                    href="<?php echo base_url() ?>index.php/User/usloviKoriscenja"><img
                        src="<?php echo base_url() ?>/images/strelicadesno.png"
                        id="strelicaDesno"></a>'
                <?php } ?>
                <!--                    Ako je gost onda je putanja preko Login kontrolora, a ako je korisnik ili admin onda je preko User kontrolora-->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4"><img
                    src="<?php echo base_url()?>images/ljuba.jpg"
                    style="width: 100%; border-style: double;" class="img-fluid"></div>
            <div class="col-sm-4">
                <p></p>Gđica Ljubica Krstić<p></p>
                <p></p>Vođa portala. Bivši novinar sve dok nije shvatila da je rođeni talenat za PHP kodiranje. Uvek
                optimistična kada je najpotrebnije. Ako Vam je potrebna ideja ili pak realizacija iste ona je prava
                osoba za to. Ne voli dosadne poslove, tako da baze podataka joj ne pominjite, moraće da zapali cigaru.
            </div>
            <div class="col-sm-3">
                <p></p>
                <p></p>060/670-53-51<p></p>
                <p></p>ljubica.krstic@karijera-portal.link.in.rs
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <p></p>Gdin Gordan Stojković<p></p>
                <p></p>Najlakše ga je opisati uz jednu reč, a to je: vizionar. Svaki problem je njemu izazov i ne
                odustaje dok ne dođe do rešenja. Ponekad mu se dešava da sanja načine rešavanja problema. Samo mu dajte
                zadatak i posmatrajte njegovu magiju.
            </div>
            <div class="col-sm-4"><img
                    src="<?php echo base_url()?>images/gogi.jpg"
                    style="width: 100%; border-style: double;" class="img-fluid"></div>
            <div class="col-sm-3">
                <p></p>
                <p></p>063/140-59-71<p></p>
                <p></p>gordan.stojkovic@karijera-portal.link.in.rs
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4"><img
                    src="<?php echo base_url()?>images/zoka.jpg"
                    style=" width: 100%; border-style: double;" class="img-fluid"></div>
            <div class="col-sm-4">
                <p></p>Gđica Zorana Trifunović<p></p>
                <p></p>Uvek vesela i nasmejana zrači pozitivizmom gde god da se nađe. Najviše voli da se šali na svoj
                račun. Vrednica, uvek voljna da uči, a kao što se vidi i na slici, voli ekstremne sportove. Voli dosadne
                poslove (kao što su baze podataka), pa se lepo dopunjuje sa Ljubicom.
            </div>
            <div class="col-sm-3">
                <p></p>
                <p></p>064/828-5685<p></p>
                <p></p>zorana.trifunovic@karijera-portal.link.in.rs
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <p></p>Gdin Saša Đekić<p></p>
                <p></p>Ćutljiv član naše ekipe. Ali, ispod Mire sto đavola vire. Kad progovori, to obično bude nešto
                pametno, ako naravno nije šala u pitanju. Vredan i predan poslu kada ga nešto zanima u stanju je da
                istražuje dok ne iskopa sve što može o tome.
            </div>
            <div class="col-sm-4"><img
                    src="<?php echo base_url()?>images/sasa.jpg"
                    style="width: 100%; border-style: double;" class="img-fluid"></div>
            <div class="col-sm-3">
                <p></p>
                <p></p>063/833-55-77 <p></p>
                <p></p> sasa.djekic@karijera-portal.link.in.rs
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4"><img
                    src="<?php echo base_url()?>images/sanja.jpg"
                    style="width: 100%; border-style: double;" class="img-fluid"></div>
            <div class="col-sm-4">
                <p></p>Gđica Sanja Kordić<p></p>
                <p></p>Kreativni član našeg tima, zadužen za vizuelnu stranu portala. Iskreno, bez koga pauze u radu ne
                bi bilo, jer su ovi naši članovi pravi štreberi. Dakle zadužena za traženje pauze, pre svega.
            </div>
            <div class="col-sm-3">
                <p></p>
                <p></p>064/257-44-23 <p></p>
                <p></p> sanja.kordic@karijera-portal.link.in.rs
            </div>
        </div>
        <div class="row">
            <div class="offset-sm-12"></div>
        </div>
        <div class="row">
            <div class="offset-sm-4"></div>
            <div class="col-sm-4" id="target">Za sve dodatne informacije kontaktirajte nas na mail:</div>
            <div class="offset-sm-4"></div>
        </div>
        <div class="row">
            <div class="offset-sm-4"></div>
            <div class="col-sm-4" id="mejl">admin@karijera-portal.link.in.rs</div>
            <div class="offset-sm-4"></div>
        </div>
    </div>
</body>

</html>