<?php

defined('BASEPATH') or exit('no direct access');

class Vesti extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('VestiModel');
    }

    public function index() {

        if ($this->session->has_userdata('user')) {
            $tipKorisnika = $this->session->userdata('user')['tip'];
        } else {
            $tipKorisnika = "gost";
        }

        $kategorijeVesti = $this->VestiModel->dohvatiKategorijeVesti();
        $sveVesti = $this->VestiModel->dohvatiSveVesti($tipKorisnika);
        $data = [];
        $data['middle'] = 'middle/vesti';  // strana vesti u view-u - napraviti
        $data['middle_data'] = ['kategorije' => $kategorijeVesti, 'sveVesti' => $sveVesti];
        $this->load->view('viewTemplate', $data);
    }

    public function ispisiVesti() {

        if ($this->session->has_userdata('user')) {
            $tipKorisnika = $this->session->userdata('user')['tip'];
        } else {
            $tipKorisnika = "gost";
        }
        $idKatVesti = $this->input->get('id');
        $vesti = $this->VestiModel->dohvatiVesti($idKatVesti, $tipKorisnika);
        $this->load->view("vesti/prikazVesti", ["vesti" => $vesti]);
    }

    public function dodajVest() {

        $kategorija = $this->input->post('kategorija');
        $naziv = $this->input->post('naziv');
        $tekst = $this->input->post('tekst');
        $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post('odabraniKurs');
        $vidljivostGrupa = $this->input->post('odabranaGrupa');
        $idVes = $this->VestiModel->dodajVest($this->session->userdata('user')['idKor'], $kategorija, $naziv, $tekst, $vidljivost, $vidljivostGrupa, $vidljivostKurs);
        if ($vidljivost == "pretraga") {
            $this->dodajVestZaPretragu($idVes);
        }else if($vidljivost == "grupa"){
            $this->VestiModel->dodajVestGrupe($idVes, $vidljivostGrupa);
        }
        redirect('Vesti');
    }

    /**
     * metoda za dodavanje vesti u okviru odredjene gurpe
     */
    public function dodajVestGrupe() {


        $idGru = $this->input->post('idGru');
        $kategorija = $this->input->post('kategorija');
        $naslov = $this->input->post('naslov');
        $tekst = $this->input->post('tekst');
        $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post("kurs");
        $vidljivostGrupa = $this->input->post('grupe');
        $this->VestiModel->dodajVest($this->session->userdata('user')['idKor'], $kategorija, $naslov, $tekst, $vidljivost, $vidljivostGrupa, $vidljivostKurs);
        $last_id = $this->db->insert_id();
        $idVes = $last_id;
        $this->VestiModel->dodajVestGrupe($idVes, $idGru);
        redirect("Grupe/grupa/$idGru");
    }

    public function dodajKategorijuVesti() {
        $nova_kategorija = $this->input->post('novakatvesti');
        $this->VestiModel->dodajKategorijuVesti($nova_kategorija);
        $this->index();
    }

    public function dodajVestZaPretragu($idVes) {
        $res = $this->session->userdata('res');
        foreach ($res as $user) {

            $this->VestiModel->dodajVestZaPretragu($idVes, $user['idKor']);
        }
    }

    public function arhivirajVest($idVes) {

        $this->VestiModel->arhivirajVest($idVes);
        $this->session->set_flashdata("poruka", "Uspesno ste arhivirali vest. Sada je mozete videti samo vi u odeljku 'Moje vesti'");
        redirect("Vesti/index");
    }
    
    public function dohvatiJednuVest($idVes){
        $data = ["vest" => $this->VestiModel->dohvatiJednuVest($idVes)];
        $this->load->view('vesti/jednaVest', $data);

    }

    public function traziBrisanje($idVes) {

        $this->VestiModel->traziBrisanje($idVes);
        $this->session->set_flashdata('poruka', 'Poslat je zahtev za brisanje vesti administratoru. Vasa vest ce uskoro biti obrisana sa sajta.');
        redirect("Vesti/index");
    }
    
    public function dohvatiVestiAutora($idKor){
        $vesti= $this->VestiModel->dohvatiVestiAutora($idKor);
        if(empty($vesti)){
            echo "<h4>Nema vesti</h4>";
        }else{
        $this->load->view("vesti/prikazVesti", ["vesti" => $vesti]);
        }
    }

}
