<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="containerReg">
            <div class="row">
                <div class="col-sm-10 offset-sm-2" >


                    <?php echo form_error(); ?>
                    <?php echo $err ?? '' ?>
                    <form name="reg" method="POST" action="<?php echo site_url('Registracija/reg') ?>" >
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 offset-sm-1 col-form-label">Username</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <div class="input-group mb-2">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input name="korisnicko" type="text" value="<?php echo set_value('korisnicko') ?>" class="form-control" id="inlineFormInputGroup" placeholder="Korisnicko"><?php echo form_error('korisnicko') ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Ime</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="ime" type="text" value="<?php echo set_value('ime') ?>" class="form-control" id="inputPassword3" placeholder="Ime"><?php echo form_error('ime') ?> 
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">srednje ime</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="serdnjeIme" type="text" value="<?php echo set_value('srednjeIme') ?>" class="form-control" id="inputPassword3" placeholder="srednje ime"> 
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Prezime</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="prezime" type="text" value="<?php echo set_value('prezime') ?>" class="form-control" id="inputPassword3" placeholder="Prezime"><?php echo form_error('prezime') ?> 
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Prezime</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="pol" type="radio" value="<?php echo set_value('pol') ?>" class="form-control" id="inputPassword3" placeholder="M">
                                    <input name="pol" type="radio" value="<?php echo set_value('pol') ?>" class="form-control" id="inputPassword3" placeholder="Z">
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Drzavljanstvo</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="drzavljanstvo" type="text" value="<?php echo set_value('drzavljanstvo') ?>" class="form-control" id="inputPassword3" placeholder="Drzavljanstvo"><?php echo form_error('drzavljanstvo') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Telefon</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="telefon" type="text" value="<?php echo set_value('telefon') ?>" class="form-control" id="inputPassword3" placeholder="Prezime"><?php echo form_error('telefon') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Adresa</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="adresa" type="text" value="<?php echo set_value('adresa') ?>" class="form-control" id="inputPassword3" placeholder="Adresa"><?php echo form_error('adresa') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Mesto</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="mesto" type="text" value="<?php echo set_value('mesto') ?>" class="form-control" id="inputPassword3" placeholder="Mesto"><?php echo form_error('mesto') ?> 
                                </div>

                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">PIN</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="pin" type="text" value="<?php echo set_value('pin') ?>" class="form-control" id="inputPassword3" placeholder="PIN"><?php echo form_error('pin') ?> 
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Status</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="status" type="text" value="<?php echo set_value('status') ?>" class="form-control" id="inputPassword3" placeholder="Status"><?php echo form_error('status') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Lozinka</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="lozinka" type="password" class="form-control" id="inputPassword3" placeholder="Lozinka"><?php echo form_error('lozinka') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Ponovljena Lozinka</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input name="ponLozinka" type="password" class="form-control" id="inputPassword3" placeholder="Ponovi lozinku"><?php echo form_error('ponLozinka') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Email</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input type="email" name="email" class="form-control" id="inputPassword3" placeholder="E-mail" value="<?php echo set_value('email') ?>"><?php echo form_error('email') ?> <?php echo form_error('email') ?> 
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2  offset-sm-1 col-form-label">Datum</label>
                            <div class="col-sm-5 col-sm-5">
                                <div class="col-sm-5 col-sm-5">
                                    <input type="date" name="datum" class="form-control" id="inputPassword3" placeholder="datum rodjenja" value="<?php echo set_value('datum') ?>"> <?php echo form_error('datum') ?>  
                                </div>

                            </div>
                        </div>




                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-7">
                                <input type="submit"  name="reg" value="Register" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </body>
</html>
