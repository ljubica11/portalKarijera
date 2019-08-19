<!DOCTYPE html>

                <div id="myModal" class="modal">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h2>Postavite oglas u nekoliko lakih koraka!</h2>
                        <span class="close">&times;</span>
                      
                    </div>
                      <div class="modal-body" id="dodavanjeOglasa">
                          <form name="dodajOglasForma" method="POST" action="<?php echo site_url('Oglasi/dodajNoviOglas')?>" class="regForm" enctype="multipart/form-data">
                            <h5> Naslov oglasa * </h5>
                            <input placeholder="Primer: Junior PHP developer" class="form-control naslov" name="naslov" required>
                            <h5> Grad u kom se obavlja posao *</h5>
                            <div id="selectmesto">
                                <select name="mesto" onchange="dodajInput('mesto')" id="listamesto" class="form-control mesto" required> 
                                    <option disabled selected value="">Mesto</option>
                                      <?php 
                                    foreach ($mesta as $mesto){
                                        $naziv = $mesto["naziv"];
                                        $idG = $mesto["idGra"];
                                        echo "<option value='$idG'>$naziv</option>";
                                    }
                                    ?>
                                   <option class="dodaj" value="dodaj">Dodaj novo mesto</option>
                                   </select>
                             </div>
                             <div id="mesto">
                             </div> 
                            <h5>Vreme isticanja *</h5>
                                Odaberite datum do kog zelite da oglas bude istaknut
                                <input type="date" name="vremeIst" class="form-control vreme" required>
                            <h5>Pozicija *</h5>
                                Navedite tacnu poziciju za koju trazite kandidata
                                <input type="text" name="pozicija" class="form-control pozicija" required>
                               <?php
                                $idKor = $this->session->userdata('user')['idKor'];
                                if(is_dir('./userImg/'.$idKor)== false or 
                                       empty(array_diff(scandir('./userImg/'.$idKor), array('.', '..')))){?>
                                <h5>Logo vase kompanije *</h5>
                                <input type="file" name="logo" id="fileToUpload">
                                       <?php } ?>
                                <br/>
                            <h5>Opis posla *</h5>
                                Unesite opis posla, kompanije, radne etike, atmosfere i ostalih stvari koje bi mogle da zainteresuju najbolje kandidate za vas posao. 
                                <textarea class="form-control opis" name="opis" required></textarea>
                            <h5>Ko moze da vidi vas oglas? *</h5>
                                Odaberite nivo vidljivosti oglasa. <br/>
                                <input type="radio" name="vidljivost" value="studenti" id="1">Svi studenti<br>
                                <input type="radio" name="vidljivost" value="korisnici" id="2">Svi korisnici sajta (ukljucujuci i druge kompanije)<br>
                                <input type="radio" name="vidljivost" value="kurs" onclick="ispisiOpcije(value)" id="3">Studenti odredjenog kursa<br>
                                <div id="kurs"></div>
                                <input type="radio" name="vidljivost" value="grupa" onclick="ispisiOpcije(value)" id="4">Formirana grupa studenata<br>
                                <div id="grupa"></div>
                                <?php if($this->input->get('ogl') == 1){
                                    echo "<input type='radio' name='vidljivost' value='pretraga' checked>Rezultat pretrage";
                                }?>
                            <h5>Ponudjena plata u dinarima (opciono) </h5>
                            <div class="input-group plata-input">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="">Od</span>
                                </div>
                                <input type="number" class="form-control plata" placeholder="Primer: 50.000" name="plata[]">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Do</span>
                                </div>
                                <input type="number" class="form-control plata" placeholder="Primer: 60.000" name="plata[]">
                                <select name="placanje" class="placanje">
                                    <option value="dnevno">Dnevno</option>
                                    <option value="nedeljno">Nedeljno</option>
                                    <option value="mesecno" selected>Mesecno</option>
                                    <option value="godisnje">Godisnje</option>
                                </select>
                              </div>
                            <br/>
                            *Napomena: Naredna polja nisu obavezna, ali vam preporucujemo da ih popunite zbog brzeg i lakseg pronalazenja idealnih kandidata.
                            <h5>Obaveze i odgovornosti kandidata</h5>
                                Unesite po stavkama sta tacno podrazumeva ova pozicija. Trudite se da sto konkretnije opisete radne zadatke koje ce kandidat obavljati na ovoj poziciji.<br/>
                                <input type="text" name="obaveze[]"class="form-control obaveze" placeholder="Primer: Obrada podataka i priprema izvestaja..."><br/>
                                <input type="text" name="obaveze[]"class="form-control obaveze" placeholder="Primer: Rad sa klijentima..."><br/>
                                <input type="text" name="obaveze[]"class="form-control obaveze" placeholder="Primer: Terenski rad..."><br/>
                                <div id="obaveze"></div>
                                <input type="button" name="dodajObavezu" value="Dodaj jos obaveza +" onclick="dodajInputOglasi('obaveze')" class="btn btn-small btn-secondary"><br/>
                            <h5>Pozeljne sposobnosti i iskustvo</h5>
                                Unesite sve stavke koje ocekujete od idealnog kandidata (obrazovanje, radno iskustvo, vestine, interesovanja...)<br/>
                                <input type="text" name="uslovi[]" class="form-control uslovi" placeholder="Primer: Dve godine radnog iskustva..."><br/>
                                <input type="text" name="uslovi[]" class="form-control uslovi" placeholder="Primer: Poznavanje rada na racunaru..."><br/>
                                <input type="text" name="uslovi[]" class="form-control uslovi" placeholder="Primer: Diploma odrednjenog fakulteta..."><br/>
                                <div id="uslovi"></div>
                                <input type="button" name="dodajUslov" value="Dodaj jos uslova +" onclick="dodajInputOglasi('uslovi')" class="btn btn-small btn-secondary">
                            <h5>Prednosti ovog radnog mesta</h5>
                                Unesite sve povoljnosti ove radne pozicije (mogucnost napredovanja, rad sa iskusnim mentorima, putovanja, konkurentna plata...)<br/>
                                <input type="text" name="ponuda[]" class="form-control ponuda" placeholder="Primer: Obezbedjena obuka na radnom mestu..."><br/>
                                <input type="text" name="ponuda[]" class="form-control ponuda" placeholder="Primer: Napredovanje na poslu..."><br/>
                                <input type="text" name="ponuda[]" class="form-control ponuda" placeholder="Primer: Mogucnost putovanja..."><br/>
                                <div id="ponuda"></div>
                                <input type="button" name="dodajPonudu" value="Dodaj jos ponuda +" onclick="dodajInputOglasi('ponuda')" class="btn btn-small btn-secondary"><br/><br/>
                                
                                <input type="submit" name="dodajOglasDugme" value="Postavi oglas" class="btn btn-lg btn-primary">
                        </form>
                         
                      </div>  
                                        
                    <div class="modal-footer">
                        <h5>Portal "Karijera"</h5>
                    </div>
                  </div>
                </div>