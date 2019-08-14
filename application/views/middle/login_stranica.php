
            
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    
    
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
                <form class="offset-sm-1 form-inline my-2 my-lg-0" name="loginForma" method="POST" action="http://localhost/portalKarijera/index.php/registracija">
                    <button class="btn btn-outline-primary my-2 my-sm-0 btn-lg" type="submit">Registracija</button>
                </form>
                <div class="offset-sm-8"></div>
            </div>
            <div class="row">
                <div class="offset-sm-12" style="height: 250px"></div>
            </div>
        </div>
        <div class="container" id="container2">
            <div class="row">
                <div class="offset-sm-12" style="height: 15px"></div>
            </div>
            <div class="row" style="align-top">
                <div class="col-sm-2"><img src="http://localhost/portalKarijera/images/firma1.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-1"><img src="http://localhost/portalKarijera/images/firma2.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-1"><h1>ETF</h1></div>
                <div class="col-sm-2"><img src="http://localhost/portalKarijera/images/firma3.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="http://localhost/portalKarijera/images/firma4.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="http://localhost/portalKarijera/images/firma5.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="http://localhost/portalKarijera/images/firma6.png" class="img-fluid" alt="Responsive image"></div>
            </div>
        </div>
        <div class="container" id="container3">
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4" id="iskustvaNaslov">Iskustva polaznika: </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
            <div class="row" id="iskustva">
                <div class="col-sm-6">Tamara Sekularac: "Da nisam otkrila ovaj portal verovatno se nikad ne bih povezala sa danasnjim kolegama, niti bih radila na Elektrotehnickom fakultetu. Svaka cast kreatorima na izumu."</div>
                <div class="col-sm-6">Jovan Djukic: "Portal je fenomenalan. Jako koristan za mlade generacije, lakse se uspostavlja komunikacija sa poslodavcima koji umeju da prepoznaju talenat."</div>
            </div>
            </div>
        <div class="container" id="container4">
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
        <div class="container" id="container5">
            <div class="row">
                <div id="najnovije" class="slide-right col-sm-12"></div>
            </div>
        </div>
        <script>
             
            var title = ['<p>Najnovija vest:<br><br>  <?php foreach ($vest as $v){ echo ($v['tekst']); } ?></p>', 
                '<p>Najnovije obavestenje:<br><br>  <?php foreach ($obavestenje as $ob){ echo ($ob['tekst']); } ?></p>',
                '<p>Najnoviji oglas:<br><br>  <?php foreach ($oglas as $og){ echo ($og['opis']); } ?></p>',
                '<p>Najnovija diskusija:<br><br>  <?php foreach ($diskusija as $d){ echo ($d['opis']); } ?></p>'];
            var index = 0;

            function change_title() {
                var x = title[index];
                $('#najnovije').html(x);
                index++;
                if (index >= title.length) { index = 0; }
            };

            function to_change_title() {
                change_title();
                setInterval(change_title, 2000);
            };

            to_change_title();
            
        </script>
    </body>
</html>