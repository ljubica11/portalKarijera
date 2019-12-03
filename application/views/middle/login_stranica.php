
            
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
                    <form class="offset-sm-1 form-inline my-2 my-lg-0" name="loginForma" method="POST" action="<?php echo base_url()?>index.php/registracija">
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
                <div class="col-sm-2"><img src="<?php echo base_url()?>/images/firma1.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-1"><img src="<?php echo base_url()?>/images/firma2.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-1"><h1>ETF</h1></div>
                <div class="col-sm-2"><img src="<?php echo base_url()?>/images/firma3.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="<?php echo base_url()?>/images/firma4.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="<?php echo base_url()?>/images/firma5.png" class="img-fluid" alt="Responsive image"></div>
                <div class="col-sm-2"><img src="<?php echo base_url()?>/images/firma6.png" class="img-fluid" alt="Responsive image"></div>
            </div>
        </div>
        <div class="container" id="container3">
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center" id="iskustvaNaslov">Iskustva polaznika </div> 
                <div class="col-sm-4"></div>
            </div>
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
            <div class="row" id="iskustva">
                <div class="col-1">
                    <img src="<?php echo base_url()?>/images/tamara.jpg" class="img-fluid img-korisnici">
                </div>
                <div class="col-5">
                    <b>Tamara Šekularac:</b> "Prolazak kroz IT preobuku i pronalaženje ovog portala me je izbavilo tmurne budućnosti u trafici na okretnici u Žarkovu, u kojoj sam godinama pre toga radila . Danas imam sjajan posao, sve zahvaljujući portalu Karijera!"
                </div>
                
                <div class="col-1">
                    <img src="<?php echo base_url()?>/images/jovan.jpg" class="img-fluid img-korisnici">
                </div>
                <div class="col-5">
                    <b>Jovan Đukic:</b> "Moj život se u potpunosti promenio od kad sam prvi put došao na ovaj sajt. Za početak, više ne moram da ustajem u četiri ujutro svakog dana, jer sam zahvaljujući kontaktima sa portala Karijera konačno dao otkaz u pekari i našao dobar posao."    
                </div>
            </div>
            </div>
        <div class="container" id="container4">
            <div class="row">
                <div class="offset-sm-12" style="height: 40px"></div>
            </div>
            <div class="row">
                <div class="offset-sm-2 col-sm-8">
                    <h2>Mi spajamo zajednice studenata i poslodavaca</h2>
                </div>
                <div class="offset-sm-2"></div>
                <p>
                    Portal Karijera je vodeća srpska platforma za pronalaženje poslova i prakse za
                    univerzitete i studente. Naš fokus je na povezivanju studentskih talenata sa preduzetništvom
                    i inovativnim kompanijama radi ostvarivanja značajnog poboljšanja poslovnog procesa.
                    <br><br>
                    Naša platforma je zasnovana na algoritmu koji spaja studente sa poslovima prema njihovim
                    veštinama, studijama i interesovanjima, i preporučuje odgovarajuće studente kompanijama.
                    <br><br>
                    Kao istraživači i analiticari podataka,kroz jedinsstveni uvid u podatke i prognoze, pružamo
                    podršku inovacionom sistemu, kroz identifikovanje i predviđanje potrebnih poslovnih veština,
                    spajanje narastajućih industrija i novih tržišnih prilika.
                    <br><br>
                    Ovi podaci će pomoći studentima i kompanijama da se prilagode i upravljaju tržisnim poslovnim
                    promenama, obezbeđujuci zdrav rast i održiv biznis.                   
                </p>
            </div>
        </div>
        <div class="container" id="container5">
            <div class="row">
                <div id="najnovije" class="slide-right col-sm-12"></div>
            </div>
        </div>
        
         <div id="myModal" class="modal modal-login">
                <div class="modal-content modal-content-login">

                    <div class="modal-header modal-header-login">
                        <h4>Login</h4>
                        <span class="close">&times;</span>
                    </div>
                    
                    <div class="modal-body modal-body-login" id="modal-body">
                        Pogrešno korisničko ime i/ili lozinka. Pokušajte ponovo. 
                        <br/><br/>
                        <form  name="loginForma" method="POST" action="<?php echo site_url('Login/logovanje')?>">
                            <div class="form-row">
                                <div class="col-8 offset-2">
                                    <input class="form-control" type="text" name="username" value="<?php echo $this->session->flashdata('login_username')?>">
                            <br/>
                            <input class="form-control" type="password" placeholder="Lozinka" name="pass">
                            <small><a href="<?php echo site_url('Reset_lozinke')?>">Zaboravili ste lozinku?</a></small>
                                
                                </div>
                            </div>
                            <br/>
                            <button class="btn btn-outline-primary" type="submit">Login</button>
                        </form>
                        
                    </div>


                    <div class="modal-footer modal-footer-vesti">
                        <h5>Portal "Karijera"</h5>
                    </div>

                </div>
            </div>
        
        
        
        <?php if ($this->session->flashdata('msg')){
        $msg = $this->session->flashdata('msg');
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        } ?>
        <!--Listanje najnovijih vesti, obavestenja, diskusija i oglasa vidljivih gostu-->
        <script>
             
            var title = ['<p><u><b>Najnovija vest:</b></u><br>  <?php foreach ($vest as $v){ echo ($v['tekst']); } ?></p>', 
                '<p><u><b>Najnovije obavestenje:</b></u><br>  <?php foreach ($obavestenje as $ob){ echo ($ob['tekst']); } ?></p>',
                '<p><u><b>Najnoviji oglas:</b></u><br> <?php foreach ($oglas as $og){ echo ($og['opis']); } ?></p>',
                '<p><u><b>Najnovija diskusija:</b></u><br> <?php foreach ($diskusija as $d){ echo ($d['opis']); } ?></p>'];
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
            //pozvano menjanje najnovijih vesti,obavestenja, oglasa i diskusija, definisano menjanje na 2000
            <?php if($this->session->flashdata('login_username')){ ?>
            document.getElementById("myModal").style.display = "block";
            <?php } ?>
            
            var span = document.getElementsByClassName("close")[0];

            var modal = document.getElementById("myModal");    

            span.onclick = function() {
              modal.style.display = "none";
            };

            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            };
        </script>
    </body>
</html>
