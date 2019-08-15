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
        $kategorijeVesti = $this->VestiModel->dohvatiKategorijeVesti();
        $sveVesti = $this->VestiModel->dohvatiSveVesti();
        $data = [];
        $data['middle'] = 'middle/vesti';  // strana vesti u view-u - napraviti
        $data['middle_data'] = ['kategorije' => $kategorijeVesti, 'sveVesti' => $sveVesti];
        $this->load->view('viewTemplate', $data);
    }

    public function ispisiVesti() {

        $idKatVesti = $this->input->get('id');
        $vesti = $this->VestiModel->dohvatiVesti($idKatVesti);
        $this->load->view("vesti/prikazVesti", ["vesti" => $vesti]);
    }

    public function dodajVest() {

        $kategorija = $this->input->post('kategorija');
        $naziv = $this->input->post('naziv');
        $tekst = $this->input->post('tekst');
        $this->VestiModel->dodajVest($this->session->userdata('user')['idKor'], $kategorija, $naziv, $tekst);
        $this->index();
    }

    /**
     * metoda za dodavanje vesti u okviru odredjene gurpe
     */
    public function dodajVestGrupe() {


        $idGru = $this->input->post('idGru');
        $kategorija = $this->input->post('kategorija');
        $naslov = $this->input->post('naslov');
        $tekst = $this->input->post('tekst');
        $this->VestiModel->dodajVest($this->session->userdata('user')['idKor'], $kategorija, $naslov, $tekst);
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

}

