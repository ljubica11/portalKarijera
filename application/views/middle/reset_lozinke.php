
<div class="container" id="lozinkacontainer">
        <div class="row justify-content-center " id="styleres">
            <div class="offset-sm-3"></div>
            <div class="col-sm-6">
                <?php
                    if($forma){
                        echo form_open("Reset_lozinke/send");
                        echo form_fieldset("Reset lozinke");
                ?>
                <div class="form-group row">
                    <?php
                        echo form_label("Korisnicko ime", "korisnicko", array("class"=>"control-label"));
                        echo form_input(array("name"=> "korisnicko", "class"=>"form-control", "value"=> set_value("korisnicko")));
                        echo form_error("korisnicko");
                    ?>
                </div>
                <div class="form-group row">
                    <?php
                        echo form_submit("reset", "Resetuj");
                    ?>
                </div>
<!--                forma lozinke za unos korisnickog imena, klikom na dugme salje se mejl korisniku sa novom lozinkom-->
                <?php
                    } else {
                        if($mail_ok){
                            echo "<p>Nova lozinka vam je poslata na mail. Vremensko trajanje nove lozinke je 60 minuta.</p>";
                        } else{
                            echo "<p>Došlo je do greške pri slanju mail-a. Molimo vas pokušajte kasnije. Hvala</p>";
                        }
                    }
                ?>
                <img src="<?php echo base_url()?>/images/connect.jpg" style="border-style: outset;">
            </div>
            <div class="col-sm-3"></div>
	</div>
</div>     