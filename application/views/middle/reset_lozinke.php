<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/styleGuest.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row justify-content-center ">
		
            <div class="col-sm-5" style="height: 75vh; width: 100%">
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
                <?php
                    } else {
                        if($mail_ok){
                            echo "<p>Nova lozinka vam je poslata na mail. Vremensko trajanje nove lozinke je 60 minuta.</p>";
                        } else{
                            echo "<p>Došlo je do greške pri slanju mail-a. Molimo vas pokušajte kasnije. Hvala</p>";
                        }
                    }
                ?>
            </div>
	</div>
       