<?php

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
    
    
    public function prikaziSifrarnik($tip){
//        $tip = $this->input->get('tip');
        
         if($tip == 'mesto'){
            $data = ["data" => $this->SifrarniciModel->dohvatiMesto(),
                    "tip" => $tip,
                    "naslov" => "Mesta"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'drz'){
            $data = ["data" => $this->SifrarniciModel->dohvatiDrz(),
                    "tip" => $tip,
                    "naslov" => "Drzavljanstva"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'faks'){
            $data = ["data" => $this->SifrarniciModel->dohvatiFakultete(),
                    "tip" => $tip,
                    "naslov" => "Fakulteti"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'komp'){
            $data = ["data" => $this->SifrarniciModel->dohvatiKompanije(),
                    "tip" => $tip,
                    "naslov" => "Kompanije"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'poz'){
            $data = ["data" => $this->SifrarniciModel->dohvatiPozicije(),
                    "tip" => $tip,
                    "naslov" => "Radne pozicije"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'inter'){
            $data = ["data" => $this->SifrarniciModel->dohvatiInteresovanja(),
                    "tip" => $tip,
                    "naslov" => "Interesovanja"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'ves'){
            $data = ["data" => $this->SifrarniciModel->dohvatiVestine(),
                    "tip" => $tip,
                    "naslov" => "Vestine"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'katves'){
            $data = ["data" => $this->SifrarniciModel->dohvatiKategorijeVesti(),
                    "tip" => $tip,
                    "naslov" => "Kategorije vesti"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }else if($tip == 'katdis'){
            $data = ["data" => $this->SifrarniciModel->dohvatiKategorijeDiskusija(),
                    "tip" => $tip,
                    "naslov" => "Kategorije diskusija"];
            $this->load->view("admin/prikazSifrarnikaTest", $data);
        }
        
    }
    
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
    
    public function prikaziZahteveRegistracija(){

        
        $data = ["zahtevi" => $this->AdminModel->prikaziZahteveRegistracija()];
        if(empty($data["zahtevi"])){
            echo "<h4>Nema novih zahteva</h4>";
        }else{
        $this->load->view("admin/prikazZahtevaReg", $data);
        }

       
    }
    
    public function odobriRegistraciju(){
        $id = $this->input->post('id');
        $mejl = $this->input->post('mejl');
        $this->AdminModel->odobriRegistraciju($id);
        $this->prikaziZahteveRegistracija();
        $msg = "Poštovani, vaša registracija na portalu 'Karijera' je odobrena.";
        $this->posaljiMejl($msg, $mejl);
        
    }
    
    public function zabraniRegistraciju(){
       $id = $this->input->post('id');
       $mejl = $this->input->post('mejl');
       $this->AdminModel->zabraniRegistraciju($id);
       $this->prikaziZahteveRegistracija();
       $msg = "Poštovani, vaša registracija na portalu 'Karijera' nije odobrena.";
       $poruka = $this->posaljiMejl($msg, $mejl); 
       echo $poruka;
    }
    
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
    
    public function brojZahtevaReg(){
        $broj = $this->AdminModel->dohvatiBrojZahtevaReg();
        if($broj === 0){
           return ""; 
        } else{
            $data = ["broj" => $broj];
            $this->load->view('admin/notifikacije', $data);
        }
    }
}
