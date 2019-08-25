<?php

//kontroler za sve funkcionalnosti administratora

class Admin extends MY_Controller{
    
     public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('user')) {
            redirect('Login');
        }else if($this->session->userdata('user')['tip'] !== "a"){
            redirect('User');
        }
        
        $this->load->model('AdminModel');
    }
    
    
//    metoda za dohvatanje odgovarajucih sifrarnikau skladu sa proslednjenim tipom 
    //dobijeni podaci se prosledjuju na stranicu za ispisivanje sifrarnika
    public function prikaziSifrarnik($tip){

        
         if($tip == 'mesto'){
            $data = ["data" => $this->SifrarniciModel->dohvatiMesto(),
                    "tip" => $tip,
                    "naslov" => "Mesta"];
        }else if($tip == 'drz'){
            $data = ["data" => $this->SifrarniciModel->dohvatiDrz(),
                    "tip" => $tip,
                    "naslov" => "Drzavljanstva"];
        }else if($tip == 'faks'){
            $data = ["data" => $this->SifrarniciModel->dohvatiFakultete(),
                    "tip" => $tip,
                    "naslov" => "Fakulteti"];
        }else if($tip == 'komp'){
            $data = ["data" => $this->SifrarniciModel->dohvatiKompanije(),
                    "tip" => $tip,
                    "naslov" => "Kompanije"];
        }else if($tip == 'poz'){
            $data = ["data" => $this->SifrarniciModel->dohvatiPozicije(),
                    "tip" => $tip,
                    "naslov" => "Radne pozicije"];
        }else if($tip == 'inter'){
            $data = ["data" => $this->SifrarniciModel->dohvatiInteresovanja(),
                    "tip" => $tip,
                    "naslov" => "Interesovanja"];
        }else if($tip == 'ves'){
            $data = ["data" => $this->SifrarniciModel->dohvatiVestine(),
                    "tip" => $tip,
                    "naslov" => "Vestine"];
        }else if($tip == 'katves'){
            $data = ["data" => $this->SifrarniciModel->dohvatiKategorijeVesti(),
                    "tip" => $tip,
                    "naslov" => "Kategorije vesti"];
        }else if($tip == 'katdis'){
            $data = ["data" => $this->SifrarniciModel->dohvatiKategorijeDiskusija(),
                    "tip" => $tip,
                    "naslov" => "Kategorije diskusija"];
        }
         $this->load->view("admin/prikazSifrarnikaTest", $data);
    }
    
    
    // metoda za brisanje stavki iz odgovarajucih sifrarnika, u skladu sa proslednjenim tipom
    public function obrisiStavku(){
        $id = $this->input->post('id');
        $tip = $this->input->post('tip');
        if($tip == "mesto"){
            $this->SifrarniciModel->obrisiMesto($id);
        } else if($tip == "drz"){
            $this->SifrarniciModel->obrisiDrzavljanstvo($id);   
        } else if($tip == "faks"){
            $this->SifrarniciModel->obrisiFakultet($id);
        } else if ($tip == "komp"){
            $this->SifrarniciModel->obrisiKompaniju($id);
        } else if($tip == "poz"){
            $this->SifrarniciModel->obrisiPoziciju($id);
        } else if($tip == "inter"){
            $this->SifrarniciModel->obrisiInteresovanje($id);
        } else if($tip == "ves"){
            $this->SifrarniciModel->obrisiVestinu($id);
        } else if($tip == "katves"){
            $this->SifrarniciModel->obrisiKatVesti($id);
        } else if($tip == "katdis"){
             $this->SifrarniciModel->obrisiKatDiskusije($id);
        }
        $this->prikaziSifrarnik($tip);
    }
    
    
    // metoda za izmenu stavki u sifrarnicima u skladu sa prosledjenim tipom
    public function izmeniStavku(){
        $tip = $this->input->post('tip');
        $id = $this->input->post('id');
        $izmena = $this->input->post('izmena');
        
        if($tip == "mesto"){
            $this->SifrarniciModel->izmeniMesto($id, $izmena);
        } else if($tip == "drz"){
            $this->SifrarniciModel->izmeniDrzavljanstvo($id, $izmena);   
        } else if($tip == "faks"){
            $this->SifrarniciModel->izmeniFakultet($id, $izmena);
        } else if ($tip == "komp"){
            $this->SifrarniciModel->izmeniKompaniju($id, $izmena);
        } else if($tip == "poz"){
            $this->SifrarniciModel->izmeniPoziciju($id, $izmena);
        } else if($tip == "inter"){
            $this->SifrarniciModel->izmeniInteresovanje($id, $izmena);
        } else if($tip == "ves"){
            $this->SifrarniciModel->izmeniVestinu($id, $izmena);
        } else if($tip == "katves"){
            $this->SifrarniciModel->izmeniKatVesti($id, $izmena);
        } else if($tip == "katdis"){
             $this->SifrarniciModel->izmeniKatDiskusije($id, $izmena);
        }
        
        $this->prikaziSifrarnik($tip);
    }
    
    
    // metoda za dodavanje novih stavki u sifrarnike u skladu sa, pogadjate, proslednjenim tipom
    public function dodajStavku(){
        $this->load->model('VestiModel');
        $this->load->model('DiskusijeModel');
        
        $tip = $this->input->post('tip');
        $dodatak = $this->input->post('dodatak');
        
        if($tip == "mesto"){
            $this->SifrarniciModel->dodajNovoMesto($dodatak);
        } else if($tip == "drz"){
            $this->SifrarniciModel->dodajDrzavljanstvo($dodatak);   
        } else if($tip == "faks"){
            $this->SifrarniciModel->dodajNoviFakultet($dodatak);
        } else if ($tip == "komp"){
            $this->SifrarniciModel->dodajNovuKompaniju($dodatak);
        } else if($tip == "poz"){
            $this->SifrarniciModel->dodajNovuPoziciju($dodatak);
        } else if($tip == "inter"){
            $this->SifrarniciModel->dodajNovaInteresovanja($dodatak);
        } else if($tip == "ves"){
            $this->SifrarniciModel->dodajNoveVestine($dodatak);
        } else if($tip == "katves"){
            $this->VestiModel->dodajKategorijuVesti($dodatak);
        } else if($tip == "katdis"){
             $this->DiskusijeModel->dodajKategoriju($dodatak);
        }
        
        $this->prikaziSifrarnik($tip);
    }
    
    // metoda prikaz zahteva za registraciju (registracije kompanija koje admin jos nije odobrio)
    public function prikaziZahteveRegistracija(){

        
        $data = ["zahtevi" => $this->AdminModel->prikaziZahteveRegistracija()];
        if(empty($data["zahtevi"])){
            echo "<h4>Nema novih zahteva</h4>";
        }else{
        $this->load->view("admin/prikazZahtevaReg", $data);
        }

       
    }
    
    //metoda za odobravanje registracije
    public function odobriRegistraciju(){
        $id = $this->input->post('id');
        $mejl = $this->input->post('mejl');
        $this->AdminModel->odobriRegistraciju($id);
        $this->prikaziZahteveRegistracija();
        $msg = "Poštovani, vaša registracija na portalu 'Karijera' je odobrena.";
        $this->posaljiMejl($msg, $mejl);
        
    }
    
    //metoda za zabranu registracije i brisanje te kompanije iz baze
    public function zabraniRegistraciju(){
       $id = $this->input->post('id');
       $mejl = $this->input->post('mejl');
       $this->AdminModel->zabraniRegistraciju($id);
       $this->prikaziZahteveRegistracija();
       $msg = "Poštovani, vaša registracija na portalu 'Karijera' nije odobrena.";
       $poruka = $this->posaljiMejl($msg, $mejl); 
       echo $poruka;
    }
    
    //metoda za slanje mejla kompaniji nakon sto joj je registracija prohvacena ili odbijena
    public function posaljiMejl($msg, $mejl){
        $this->load->library('Phpmailerlib');
        $Mail = $this->phpmailerlib->load();

        $Mail->SMTPDebug = 0;
        $Mail->Mailer = 'smtp';
        $Mail->isSMTP();
        $Mail->Host = "smtp.gmail.com";
        $Mail->Port = 587;
        $Mail->SMTPSecure = "tls";
        $Mail->SMTPAuth = true;
        $Mail->Username = "karijera.online@gmail.com";
        $Mail->Password = "A123A123*";
        $Mail->SetFrom("admin-karijera.online@gmail.com");
        $Mail->Subject = 'Statistika';
        $Mail->Body = $msg;
        $Mail->AddAddress($mejl);
//        $Mail->Send();
        
        if ($Mail->Send(true)) {
            $poruka = "Mejl je poslat.";
            return $poruka;
        } else {
            echo "Poruka nije poslata<br/>";
            echo "GRESKA: " . $Mail->ErrorInfo;
        }
        
    }
    

    
    //metoda za dohvatanje broja zahteva za brisanje, u skladu sa proslednjenim tipom
    public function zahteviZaBrisanje($tip){
        if($tip == "oglasi"){
            $data = ["oglasi" => $this->AdminModel->zahteviZaBrisanjeOglasa()];
        }else if($tip == "vesti"){
            $data = ["vesti" => $this->AdminModel->zahteviZaBrisanjeVesti()];
        }else if($tip == "obavestenja"){
            $data = ["obav" => $this->AdminModel->zahteviZaBrisanjeObav()];
        }else if ($tip == "grupe"){
            $data = ["grupe" => $this->AdminModel->zahteviZaBrisanjeGrupa()];
        }else if($tip == "diskusije"){
            $data = ["disk" => $this->AdminModel->zahteviZaBrisanjeDisk()];
        }
         $this->load->view("admin/prikazZahtevaZaBrisanje", $data);
        
    }
    
    
    // metoda za brisanje zahteva
    public function obrisiZahtev(){
        $tip = $this->input->post('tip');
        $id = $this->input->post('id');
        
        if($tip == "oglasi"){
            $this->AdminModel->obrisiOglas($id);
        }else if($tip == "vesti"){
            $this->AdminModel->obrisiVest($id);
        }else if($tip == "obavestenja"){
            $this->AdminModel->obrisiObav($id);
        }else if ($tip == "grupe"){
            $this->AdminModel->obrisiGrupu($id);
        }else if($tip == "diskusije"){
            $this->AdminModel->obrisiDisk($id);
        }
        redirect("Admin/zahteviZaBrisanje/$tip");    
    }
    
    // metoda za dohvatanje broja zahteva za registraciju, tj za brisanje iz baze;
    public function brojZahteva($tip){

        if($tip == "registracija"){
            $broj = $this->AdminModel->dohvatiBrojZahtevaReg();
        }else{
            $broj = $this->AdminModel->dohvatiBrojZahteva($tip);
        }    
                
        if($broj === 0){
           return ""; 
        } else{
            $data = ["broj" => $broj];
            $this->load->view('admin/notifikacije', $data);
        }
    }
}
