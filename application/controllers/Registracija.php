<?php
defined('BASEPATH') or exit('no direct access');

class Registracija extends CI_Controller {
    
    
    public function index(){
        $data["middle"] = "middle/registracija";
        $this->load->view('viewTemplate', $data);
 
    }
    
    public function reg(){
        $korisnicko= $this->input->post('korisnicko');
        $lozinka = $this->input->post('lozinka');
        $email= $this->input->post('email');
        $tip= "s";
        
        $ime= $this->input->post('ime');
        $srednjeIme = $this->input->post('srednjeIme');
        $prezime = $this->input->post('prezime');
        $datum = $this->input->post('datum');
        $pol = $this->input->post('gridRadios');
        $drzavljanstvo = $this->input->post('drzavljanstvo');
        $telefon = $this->input->post('telefon');
        $adresa = $this->input->post('adresa');
        $mesto = $this->input->post('mesto');
        $pin = $this->input->post('pin');
        $status = $this->input->post('status');
        
        $this->load->model('RegistrationModel');
        $this->RegistrationModel->dodajKorisnika($korisnicko, $lozinka, $email, $tip);
        $Korisnik= $this->RegistrationModel->dohvatiId($korisnicko);
        $idKor = $Korisnik[0]['idKor'];
        $this->RegistrationModel->dodajStudenta($ime, $srednjeIme, $prezime, $datum, $pol, $drzavljanstvo, $telefon, $adresa, $mesto, $pin, $status, $idKor);
    }
    
}
