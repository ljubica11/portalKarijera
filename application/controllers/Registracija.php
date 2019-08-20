<?php
defined('BASEPATH') or exit('no direct access');

class Registracija extends MY_Controller {
    
     public function __construct() { 
        parent::__construct();
        
         if ($this->session->has_userdata('user')) {
            redirect('User');
        }
        
        $this->load->model('RegistrationModel');
        $this->load->model('SifrarniciModel');
        
        $this->form_validation->set_message('required', '{field} je obavezno polje');
        $this->form_validation->set_message('valid_email', 'E-mail adresa nije u ispravnom formatu');
        $this->form_validation->set_message('is_unique', 'Polje {field} mora biti jedinstveno.');
        $this->form_validation->set_message('regex_match', '{field} nije odgovarajuceg formata. ');
        $this->form_validation->set_message('matches', ' {field} i lozinka se ne poklapaju');
        $this->form_validation->set_message('exact_length', '{field} mora da sadrzi tacno {param} cifre');     
    }
    
    
    public function index(){
        $data["middle_data"] = ["kursevi" => $this->SifrarniciModel->dohvatiKurs(), 
                                "drzavljanstvo" => $this->SifrarniciModel->dohvatiDrz(),
                                "mesta" => $this->SifrarniciModel->dohvatiMesto()];
        $data["middle"] = "middle/registracija";
        $this->load->view('viewTemplate', $data);
 
    }
    
    public function regStu(){
        
        $this->form_validation->set_rules('korisnicko', 'Korisnicko ime', 'required|is_unique[korisnik.korisnicko]|min_length[3]');
        $this->form_validation->set_rules('lozinka', 'Lozinka', 'required|callback_valid_password');
        $this->form_validation->set_rules('ponLozinka', 'Potvrda lozinke', 'required|matches[lozinka]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[korisnik.email]');
        $this->form_validation->set_rules('ime', 'Ime', 'required');
        $this->form_validation->set_rules('srednjeIme', 'Srednje ime', 'required');
        $this->form_validation->set_rules('prezime', 'Prezime', 'required');
        $this->form_validation->set_rules('datum', 'Datum rodjenja', 'required|callback_validateAge[18]');
        $this->form_validation->set_rules('drzavljanstvo', 'Državljanstvo', 'required|numeric');
        $this->form_validation->set_rules('kurs', 'Kurs', 'required|numeric');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required|regex_match[/^\d{3}\/?\d{6,7}$/]');
        $this->form_validation->set_rules('adresa', 'Adresa', 'required');
        $this->form_validation->set_rules('mesto', 'Mesto', 'required|alpha_numeric');
        $this->form_validation->set_rules('pin', 'Pin', 'required|numeric|exact_length[4]|is_unique[student.pin]');
        $this->form_validation->set_rules('status', 'Status', 'required|alpha');
        
        
        
        if ($this->form_validation->run() == 0) {

            $this->index();
            
        } else {

        $korisnicko= $this->input->post('korisnicko');
        $lozinka = $this->input->post('lozinka');
        $email= $this->input->post('email');
        $vidEmail = $this->input->post('vidEmail');
        $tip= "s";
        $cekaOdobrenje = null;
        
        $ime= $this->input->post('ime');
        $srednjeIme = $this->input->post('srednjeIme');
        $prezime = $this->input->post('prezime');
        $datum = $this->input->post('datum');
        $pol = $this->input->post('pol');
        $drzavljanstvo = $this->input->post('drzavljanstvo');
        $telefon = $this->input->post('telefon');
        $vidTel = $this->input->post('vidTel');
        $adresa = $this->input->post('adresa');
        $vidAdresa = $this->input->post('vidAdresa');
        $mesto = $this->input->post('mesto');
        $pin = $this->input->post('pin');
        $status = $this->input->post('status');
        $kurs = $this->input->post('kurs');
        
        $univerzitet = $this->input->post('univerzitet');
        $fakultet = $this->input->post('fakultet');
        $sedisteFak = $this->input->post('sediste');
        $nivo = $this->input->post('nivo');
        $godinaStu = $this->input->post('godinaStudija');
        
        $this->load->model('RegistrationModel');
        $this->RegistrationModel->dodajKorisnika($korisnicko, $lozinka, $email, $vidEmail, $tip, $cekaOdobrenje);
        $Korisnik= $this->RegistrationModel->dohvatiId($korisnicko);
        $idKor = $Korisnik[0]['idKor'];
        $this->RegistrationModel->dodajStudenta($ime, $srednjeIme, $prezime, $datum, $pol, $drzavljanstvo, $telefon, $adresa, $mesto, $pin, $status, $kurs, $idKor, $vidAdresa, $vidTel);
        if($fakultet !== null){
        $this->RegistrationModel->dodajStudije($idKor, $univerzitet, $fakultet, $sedisteFak, $nivo, $godinaStu);
        }
        $this->dodatneInfo($idKor, "int");
     }
    }
    public function regKomp(){
        
        $this->form_validation->set_rules('korisnicko', 'Korisnicko ime', 'required|is_unique[korisnik.korisnicko]|min_length[3]');
        $this->form_validation->set_rules('lozinka', 'Lozinka', 'required|callback_valid_password');
        $this->form_validation->set_rules('ponlozinka', 'Potvrda lozinke', 'required|matches[lozinka]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[korisnik.email]');
        $this->form_validation->set_rules('naziv', 'Naziv', 'required|is_unique[kompanija.naziv]');
        $this->form_validation->set_rules('sediste', 'Sediste', 'required|numeric');
        $this->form_validation->set_rules('pib', 'PIB', 'required|numeric|exact_length[9]|is_unique[kompanija.pib]');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required|regex_match[/^\d{3}\/?\d{6,7}$/]');
        $this->form_validation->set_rules('opis', 'Opis', 'required|max_length[45]');
        $this->form_validation->set_rules('oblast', 'Oblast', 'required');
        $this->form_validation->set_rules('brzaposlenih', 'Broj zaposlenih', 'required|numeric');
        $this->form_validation->set_rules('sajt', 'Sajt', 'required');
        
         if ($this->form_validation->run() == 0) {

            $this->index();
            
        } else {
        
        
        $korisnicko= $this->input->post('korisnicko');
        $lozinka = $this->input->post('lozinka');
        $email= $this->input->post('email');
        $vidEmail = null;
        $tip= "k";
        $cekaOdobrenje = "da";
        
        $naziv = $this->input->post('naziv');
        $sediste = $this->input->post('sediste');
        $pib = $this->input->post('pib');
        $telefoni = $this->input->post('telefon');
        $opis = $this->input->post('opis');
        $oblast = $this->input->post('oblast');
        $brojzap = $this->input->post('brzaposlenih');
        $sajt = $this->input->post('sajt');
        
        $this->RegistrationModel->dodajKorisnika($korisnicko, $lozinka, $email, $vidEmail, $tip, $cekaOdobrenje);
        $Korisnik= $this->RegistrationModel->dohvatiId($korisnicko);
        $idKor = $Korisnik[0]['idKor'];
        $this->RegistrationModel->dodajKompaniju($naziv, $sediste, $pib, $telefoni, $opis, $oblast, $brojzap, $sajt, $idKor);
        $this->session->set_flashdata('msg', 'Zahtev za registraciju je poslat. Bicete obavesteni putem mejla kada vam registracija bude odobrena.');
        redirect('Login');
        
     }
    }
    
    public function valid_password($password = ''){
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', '{field} je obavezna. ');
			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} mora da sadrži bar jedno malo slovo.');
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} mora da sadrži bar jedno veliko slovo.');
			return FALSE;
		}
		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} mora da sadrži bar jednu cifru.');
			return FALSE;
		}
		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} mora da sadrži bar jedan specijalni karakter:' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
			return FALSE;
		}
		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', '{field} mora da bude duža od 4 karaktera.');
			return FALSE;
		}
		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', '{field} mora da bude kraća od 33 karaktera.');
			return FALSE;
		}
		return TRUE;
	}
        
        public function validateAge($birthday, $age) {

        if (is_string($birthday)) {
            $birthday = strtotime($birthday); 
        }
        if (time() - $birthday < $age * 31536000) {
            $this->form_validation->set_message('validateAge', 'Morate biti stariji od 18.');
            return false;
        }
        return true;
    }
    
    
    public function dodatneInfo($idKor, $tip){
        if($tip == "int"){     
        $data["middle_data"] = ["interesovanja" => $this->SifrarniciModel->dohvatiInteresovanja(),
                                "idKor" => $idKor];
        }else if($tip == "ves"){
         $data["middle_data"] = ["vestine" => $this->SifrarniciModel->dohvatiVestine(),
                                "idKor" => $idKor];   
        }else if($tip == "dipl"){
            $data["middle_data"] = ["fakulteti" => $this->SifrarniciModel->dohvatiFakultete(),
                                 "idKor" => $idKor];
        }else if($tip == "rad"){
            $data["middle_data"] = ["kompanije" => $this->SifrarniciModel->dohvatiKompanije(),
                                    "pozicije" => $this->SifrarniciModel->dohvatiPozicije(),
                                    "gradovi" => $this->SifrarniciModel->dohvatiMesto(),
                                    "idKor" => $idKor];
        }
        $data["middle"] = "middle/dodatneInformacije";
        $this->load->view('viewTemplate', $data); 
    }
    
        public function dodajInteresovanjaZaKorisnika(){
        $idKor = $this->input->post('idKor');
        if($this->input->post('int')!== null){
        $listaInteresovanja = $this->input->post('int');
        foreach ($listaInteresovanja as $jednoInteresovanje){
        $this->RegistrationModel->dodajInteresovanjaZaKorisnika($idKor, $jednoInteresovanje);
            }
        }
        $this->dodatneInfo($idKor, "ves");
        
    }
    
    public function dodajNovaInteresovanjaReg(){
        $this->dodajNovaInteresovanja();
    }

    
    public function dodajVestineZaKorisnika(){
        $idKor = $this->input->post('idKor');
        if($this->input->post('ves')!== null){
        $listaVestina = $this->input->post('ves');
        foreach ($listaVestina as $jednaVestina){
        $this->RegistrationModel->dodajVestineZaKorisnika($idKor, $jednaVestina);
            }
        }
        $this->dodatneInfo($idKor, "dipl");
        
    }
    
    public function dodajDiplomuZaKorisnika(){
         $idKor = $this->input->post('idKor');
         $idFak = $this->input->post('fakultet');
         $odsek = $this->input->post('odsek');
         $zvanje = $this->input->post('zvanje');
         $nivo = $this->input->post('nivo');
         $godUpisa = $this->input->post('godUpisa');
         $godZavrsetka = $this->input->post('godZavrsetka');
         $vidljivost = $this->input->post('vidDipl');
         if($idFak !== null){
         $this->RegistrationModel->dodajDiplomuZaKorisnika($idKor, $idFak, $odsek, $zvanje, $nivo, $godUpisa, $godZavrsetka, $vidljivost);
         }
         $this->dodatneInfo($idKor, "rad");
    }
    
    public function dodajIskustvoZaKorisnika(){
        $idKor = $this->input->post('idKor');
        $kompanija = $this->input->post('kompanija');
        $mesto = $this->input->post('sediste');
        $pozicija = $this->input->post('pozicija');
        $od = $this->input->post('od');
        $do = $this->input->post('do');
        $vidljivost = $this->input->post('vidRad');
        if($kompanija !== null){
            $this->RegistrationModel->dodajIskustvoZaKorisnika($idKor, $kompanija, $mesto, $pozicija, $od, $do, $vidljivost);
        }
        $this->session->set_flashdata('msg', 'Uspesno ste se registrovali! Ulogujte se i zapocnite nezaboravno iskustvo na portalu Karijera!');
        redirect('Login'); 
    }
    
    public function dodajNoveVestineReg(){
        $this->dodajNoveVestine();
        
    }

    
    public function podaciStudije(){
        $gradovi = $this->SifrarniciModel->dohvatiMesto();
        $fakulteti = $this->SifrarniciModel->dohvatiFakultete();
        $univerziteti = $this->SifrarniciModel->dohvatiUniverzitete();
        $this->load->view("formaStudije", ["gradovi" => $gradovi, "fakulteti" => $fakulteti, "univerziteti" => $univerziteti]);
    }
    
    
    public function izmeniSifrarnik(){
        if($this->input->post('tip') == 'mesto'){
            $this->dodajNovoMesto('mesto');
        }else if($this->input->post('tip') == 'sediste'){
            $this->dodajNovoMesto('sediste');
        }else if($this->input->post('tip') == 'fakultet'){
            $this->dodajNoviFakultet();
        }else if($this->input->post('tip') == 'kompanija'){
            $this->dodajNovuKompaniju();
        }else if($this->input->post('tip') == 'pozicija'){
            $this->dodajNovuPoziciju();
        }
    }
    
}
    
