<?php
defined('BASEPATH') or exit('no direct access');

class Registracija extends CI_Controller {
    
     public function __construct() {
        parent::__construct();
        
        $this->load->model('RegistrationModel');
        
        $this->form_validation->set_message('required', '{field} je obavezno polje');
        $this->form_validation->set_message('valid_email', 'E-mail adresa nije u ispravnom formatu');
        $this->form_validation->set_message('is_unique', 'Polje {field} mora biti jedinstveno.');
        $this->form_validation->set_message('regex_match', '{field} nije odgovarajuceg formata. ');
        $this->form_validation->set_message('matches', ' {field} i lozinka se ne poklapaju');
        $this->form_validation->set_message('exact_length', '{field} mora da sadrzi tacno {param} cifre');
    }
    
    
    public function index(){
        $data["middle_data"] = ["kursevi" => $this->RegistrationModel->dohvatiKurs(), 
                                "drzavljanstvo" => $this->RegistrationModel->dohvatiDrz(),
                                "mesta" => $this->RegistrationModel->dohvatiMesto()];
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
        $this->form_validation->set_rules('mesto', 'Mesto', 'required|numeric');
        $this->form_validation->set_rules('pin', 'Pin', 'required|numeric|exact_length[4]|is_unique[student.pin]');
        $this->form_validation->set_rules('status', 'Status', 'required|alpha');
        
        
        
        if ($this->form_validation->run() == 0) {

            $this->index();
            
        } else {

        $korisnicko= $this->input->post('korisnicko');
        $lozinka = $this->input->post('lozinka');
        $email= $this->input->post('email');
        $tip= "s";
        
        $ime= $this->input->post('ime');
        $srednjeIme = $this->input->post('srednjeIme');
        $prezime = $this->input->post('prezime');
        $datum = $this->input->post('datum');
        $pol = $this->input->post('pol');
        $drzavljanstvo = $this->input->post('drzavljanstvo');
        $telefon = $this->input->post('telefon');
        $adresa = $this->input->post('adresa');
        $mesto = $this->input->post('mesto');
        $pin = $this->input->post('pin');
        $status = $this->input->post('status');
        $kurs = $this->input->post('kurs');
        
        $this->load->model('RegistrationModel');
        $this->RegistrationModel->dodajKorisnika($korisnicko, $lozinka, $email, $tip);
        $Korisnik= $this->RegistrationModel->dohvatiId($korisnicko);
        $idKor = $Korisnik[0]['idKor'];
        $this->RegistrationModel->dodajStudenta($ime, $srednjeIme, $prezime, $datum, $pol, $drzavljanstvo, $telefon, $adresa, $mesto, $pin, $status, $kurs, $idKor);
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
        $tip= "k";
        
        $naziv = $this->input->post('naziv');
        $sediste = $this->input->post('sediste');
        $pib = $this->input->post('pib');
        $telefoni = $this->input->post('telefon');
        $opis = $this->input->post('opis');
        $oblast = $this->input->post('oblast');
        $brojzap = $this->input->post('brzaposlenih');
        $sajt = $this->input->post('sajt');
        
        $this->RegistrationModel->dodajKorisnika($korisnicko, $lozinka, $email, $tip);
        $Korisnik= $this->RegistrationModel->dohvatiId($korisnicko);
        $idKor = $Korisnik[0]['idKor'];
        $this->RegistrationModel->dodajKompaniju($naziv, $sediste, $pib, $telefoni, $opis, $oblast, $brojzap, $sajt, $idKor);
        
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
  
//    public function validUrl($url){
//       if (filter_var($url, FILTER_VALIDATE_URL)){
//          return TRUE;
//       }else {
//           var_dump($url);
//           $this->form_validation->set_message('validUrl', '{field} nije u ispravnom formatu');
//          return FALSE;  
//       }
//    }
}
    
