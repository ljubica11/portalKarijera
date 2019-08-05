<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" 
        content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>
        <?php if ($this->session->flashdata('msg') !== null) { 
            $msg = $this->session->flashdata('msg');
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }?>
        <div class="container" id="container1">
            <div class="row">
                <div class="offset-sm-12" style="height: 50px"></div>
            </div>
            <div class="row">
                <div class="offset-sm-1 col-sm-3 text-white">
                    <h1>Povezivanje studenata i</h1>
                </div>
                <div class="offset-sm-8"></div>
            </div>
            <div class="row">
                <div class="offset-sm-1 col-sm-3 text-white">
                    <h1>kompanija radi ubrzanja inovacija</h1>
                </div>
                <div class="offset-sm-8"></div>
            </div>
            <div class="row">
                <div class="offset-sm-12" style="height: 50px"></div>
            </div>
            <div class="row">
                <div class="offset-sm-1 col-sm-3 btn btn-outline-success btn-lg" type="submit">
                   <a class="nav-link" href="<?php echo site_url('registracija')?>">Registracija</a>
                </div>
                <div class="offset-sm-8"></div>
            </div>
            <div class="row">
                <div class="offset-sm-12" style="height: 250px"></div>
            </div>
        </div>
        <div class="container" id="container2">
            <div class="row">
                <div class="offset-sm-12" style="height: 20px"></div>
            </div>
            <div class="row" style="align-top">
                <div class="col-sm-2"><img src="<?php echo base_url('/images/firma1.png')?>" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-1"><img src="<?php echo base_url('/images/firma2.png')?>" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-1"><h1>ETF</h1></div>
                <div class="col-sm-2"><img src="<?php echo base_url('/images/firma3.png')?>" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="<?php echo base_url('/images/firma4.png')?>" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="<?php echo base_url('/images/firma5.png')?>" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="<?php echo base_url('/images/firma6.png')?>" class="img-fluid" alt="Responsive image"></div>
            </div>
        </div>
        <div class="container" id="container3">
            <div class="row">
                <div class="offset-sm-12" style="height: 60px"></div>
            </div>
            <div class="row">
                <div class="offset-sm-2 col-sm-8">
                    <h2>Mi spajamo zajednice studenata i poslodavaca</h2>
                </div>
                <div class="offset-sm-2"></div>
                <p>
                    Portal Karijera je vodeca srpska platforma za pronalazenje poslova i prakse za
                    univerzitete i studente. Nas fokus je na povezivanju studentskih talenata sa preduzetnistvom
                    i inovativnim kompanijama radi ostvarivanja znacajnog poboljsanja poslovnog procesa.
                    <br><br>
                    Nasa platforma je zasnovana na algoritmu koji spaja studente sa poslovima prema njihovim
                    vestinama, studijama i interesovanjima, i preporucuje odgovarajuce studente kompanijama.
                    <br><br>
                    Kao istrazivaci i analiticari podataka,kroz jedinsstveni uvid u podatke i prognoze, pruzamo
                    podrsku inovacionom sistemu, kroz identifikovanje i predvidjanje potrebnih poslovnih vestina,
                    spajanje narastajucih industrija i novih trzisnih prilika.
                    <br><br>
                    Ovi podaci ce pomoci studentima i kompanijama da se prilagode i upravljaju trzisnim poslovnim
                    promenama, obezbedjujuci zdrav rast i odrziv biznis.
                    
                </p>
            </div>
        </div>
        <div class="container" id="container4">
            <div class="row">
                <div class="main slide-right col-sm-12">
                    <p>Posle dvadesetak sekundi menja se poruka.</p>
                </div>
            </div>
        </div>
        <script>
            var title = ['<p>Kada zavrsimo vesti diskusije i oglase.</p>','<p>Ovde ce se ispisivati i menjati poruke</p>','<p>Za sad je ovo samo proba.</p>'];
            var index = 0;

            function change_title() {
                var x = title[index];
                $('.main').html(x);
                index++;
                if (index >= title.length) { index = 0; }
            };

            function change_left() {
                $('div').removeClass('slide-right').addClass('slide-left');
            }

            function change_right() {
                $('div').removeClass('slide-left').addClass('slide-right');
                change_title();
            }

            function to_left() {
            setInterval(change_left, 10000);
            };

            function to_right() {
                setInterval(change_right, 20000);
            };

            to_left();
            to_right();
        </script>

    </body>
</html>
   
