<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('user')) {
            redirect('Login');
        }
        
    }
    
    public function index(){
        $idKor = $this->input->get('id');
        $tipKor = $this->input->get('tip');
        $this->load->model('UserModel');
        $this->load->model('OglasiModel');
        $this->load->model('SifrarniciModel');
        if($idKor){
            $id = $idKor;
        }else{
        $id= $this->session->userdata('user')['idKor'];
        }
        if($tipKor){
            $tip = $tipKor;
        }else{
        $tip= $this->session->userdata('user')['tip'];
        }
        if($tip == 's'){
            $dataLevo = ["podaciStudent" => $this->UserModel->podaciZaStudenta($id),
                        "idKor" => $id,
                        "tip" => $tip ];
            
            $dataCentar = ["interesovanja" => $this->UserModel->imaInteresovanja($id),
                           "vestine" => $this->UserModel->imaVestine($id),
                           "studije" => $this->UserModel->trenutnoStudira($id),
                           "diploma" => $this->UserModel->imaDiplomu($id),
                           "iskustvo" => $this->UserModel->radnoIskustvo($id),
                           "idKor" => $id,
                           "tip" => $tip];
            
            
            $data["middle_data"] = ["osnovniPodaci" => $this->load->view('pocetna/pocetnaLevo', $dataLevo, true),
                                    "dodatniPodaci" => $this->load->view('pocetna/pocetnaCentar', $dataCentar, true)];
            
            $data["middle"] = "middle/pocetna";
            
            $this->load->view('viewTemplate', $data);
           
            
        }else if($tip == 'k'){
            
            $dataLevo = ["podaciKompanija" => $this->UserModel->podaciZaKompaniju($id),
                        "idKor" => $id,
                        "tip" => $tip];
            
            $dataCentar = ["podaciKompanija" => $this->UserModel->podaciZaKompaniju($id),
                           "oglasi" => $this->OglasiModel->dohvatiOglaseKorisnika($id),
                           "obavestenja" => $this->UserModel->imaObavestenja($id),
                           "idKor" => $id,
                           "tip" => $tip];
            
            
            $data['middle_data']= ["osnovniPodaci" => $this->load->view('pocetna/pocetnaLevo', $dataLevo, true),
                                   "dodatniPodaci" => $this->load->view('pocetna/pocetnaCentar', $dataCentar, true)];
            
            $data["middle"] = "middle/pocetna";
            $this->load->view('viewTemplate', $data);
            
        }else if($tip == 'a'){
            
            $data["middle"] = "middle/adminPocetna";
            $this->load->view('viewTemplate', $data);
        }
    }
    
     public function logout(){
          $this->session->sess_destroy();
          redirect("Login");
      }
      

      public function novaSlika(){
          
          $idKor= $this->session->userdata('user')['idKor'];
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['max_width'] = 2048;
                $config['max_height'] = 1536;
          //$config= $this->config->item('upload');
             if(!is_dir('./userImg/'.$idKor)){
                mkdir('./userImg/'.$idKor, 0777);
        }
          $config['upload_path']= './userImg/'.$idKor;
        
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('image')){
            echo $this->upload->display_errors();
        }else{
            redirect('User');
      }
    
    }
    
    public function promeniSliku($idKor){
        if(is_dir('./userImg/'.$idKor)== false or empty(array_diff(scandir('./userImg/'.$idKor), array('.', '..')))){
            $this->novaSlika();
        }else{
           $this->load->helper('file');
           delete_files('./userImg/'.$idKor);
           $this->novaSlika();
        }
    }

        public function dodajCV(){
            $idKor= $this->session->userdata('user')['idKor'];
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '1000';
            
            if(!is_dir('./CV/'.$idKor)){
                mkdir('./CV/'.$idKor, 0777);
        }
          $config['upload_path']= './CV/'.$idKor;
          $this->load->library('upload', $config);
          if(!$this->upload->do_upload('cv')){
              $this->index();
              echo $this->upload->display_errors();
          }else{
              $upload_data = $this->upload->data();
              echo $upload_data["file_type"];
               redirect('User');
          }

        }
        
        
        public function procitajCV($idKor){
            $dir = './CV/'.$idKor;
            $allCV= scandir($dir);
                $onlyCV = array_diff($allCV, array('.', '..'));
                foreach($onlyCV as $oneCV){
                    $file = $dir.'/'.$oneCV;
                    $filename= $oneCV;
                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline; filename="' . $filename . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($file));
                    header('Accept-Ranges: bytes');
                    readfile($file);
                    
                }
        }
        
        public function dohvatiNoveStavke($tip){
            $this->load->model('OglasiModel');
            $this->load->model('VestiModel');
            $this->load->model('ObavModel');
            
            $data = ["oglasi" => $this->OglasiModel->dohvatiSveOglase($tip),
                    "vesti" => $this->VestiModel->dohvatiSveVesti($tip),
                    "obavestenja" => $this->ObavModel->dohvatiObavestenja($tip)];
            $this->load->view('pocetna/newsFeed', $data);
        }
        
        public function formaIzmenaPodataka($id){
            $this->load->model('UserModel');
            $this->load->model('SifrarniciModel');
            $data["middle_data"] = ["podaci" => $this->UserModel->podaciZaStudenta($id),
                                    "kursevi" => $this->SifrarniciModel->dohvatiKurs(), 
                                    "drzavljanstvo" => $this->SifrarniciModel->dohvatiDrz(),
                                     "mesta" => $this->SifrarniciModel->dohvatiMesto()];
            $data["middle"] = "middle/izmenaPodataka";
            
            $this->load->view('viewTemplate', $data);
        }
        
        public function izmeniPodatke(){
            $this->load->model('UserModel');

            $this->form_validation->set_message('required', '{field} je obavezno polje');
            $this->form_validation->set_message('valid_email', 'E-mail adresa nije u ispravnom formatu');
            $this->form_validation->set_message('is_unique', 'Polje {field} mora biti jedinstveno.');
            $this->form_validation->set_message('regex_match', '{field} nije odgovarajuceg formata. ');
            $this->form_validation->set_message('matches', ' {field} i lozinka se ne poklapaju');
            $this->form_validation->set_message('exact_length', '{field} mora da sadrzi tacno {param} cifre');  
            
            if($this->input->post("korisnicko") == $this->input->post("originalKorisnicko")){
              $this->form_validation->set_rules('korisnicko', 'Korisnicko ime', 'required|min_length[3]');  
            }else{
            $this->form_validation->set_rules('korisnicko', 'Korisnicko ime', 'required|is_unique[korisnik.korisnicko]|min_length[3]');
            }
            if($this->input->post('email') == $this->input->post('originalEmail')){
               $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email'); 
            }else{
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[korisnik.email]');
            }
            $this->form_validation->set_rules('ime', 'Ime', 'required');
            $this->form_validation->set_rules('prezime', 'Prezime', 'required');
            $this->form_validation->set_rules('datum', 'Datum rodjenja', 'required|callback_validateAge[18]');
            $this->form_validation->set_rules('drzavljanstvo', 'Državljanstvo', 'required|numeric');
            $this->form_validation->set_rules('kurs', 'Kurs', 'required|numeric');
            $this->form_validation->set_rules('telefon', 'Telefon', 'required|regex_match[/^\d{3}\/?\d{6,7}$/]');
            $this->form_validation->set_rules('adresa', 'Adresa', 'required');
            $this->form_validation->set_rules('mesto', 'Mesto', 'required|alpha_numeric');
            $this->form_validation->set_rules('status', 'Status', 'required|alpha');
            
            if ($this->form_validation->run() == 0) {
                $this->formaIzmenaPodataka($this->session->userdata('user')['idKor']);
            }else{
                $idKor = $this->session->userdata('user')['idKor'];
                $korisnicko= $this->input->post('korisnicko');
                $email= $this->input->post('email');

                $ime= $this->input->post('ime');
                $prezime = $this->input->post('prezime');
                $datum = $this->input->post('datum');
                $drzavljanstvo = $this->input->post('drzavljanstvo');
                $telefon = $this->input->post('telefon');
                $adresa = $this->input->post('adresa');
                $mesto = $this->input->post('mesto');
                $status = $this->input->post('status');
                $kurs = $this->input->post('kurs');
                
                $this->UserModel->izmeniKorisnika($idKor, $korisnicko, $email);
                $this->UserModel->izmeniStudenta($idKor, $ime, $prezime, $datum, $drzavljanstvo, $telefon, $adresa, $mesto, $status, $kurs);
                
                redirect('User');
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
        
   
}
