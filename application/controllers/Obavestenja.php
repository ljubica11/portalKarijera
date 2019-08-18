<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obavestenja extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('ObavModel');
    }

    public function index() {
        //$this->load->model('ObavModel');
        //$id= $this->session->userdata('obavestenja')['idOba'];
        $data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiObavestenja()
        ];
        $data["middle"] = "middle/obavestenje";
        $this->load->view('viewTemplate', $data);
    }

    public function ispisiObavestenja() {
        $idOba = $this->input->get('id');
        $obavestenja = ['obavestenja' => $this->ObavModel->dohvatiObavestenje($idOba)];
        echo $this->load->view('obavestenja/ispisObavestenja', $obavestenja, true);
        /* $obavestenja = $this->ObavModel->dohvatiObavestenje($idOba);
          foreach ($obavestenja as $obavestenje){
          echo "<div class='centar'>";
          echo "<b> Naslov: </b>".$obavestenje['naslov']."<br>";
          echo "<b> Tekst: </b>".$obavestenje['tekst']."<br>";
          echo "<b> Datum: </b>".$obavestenje['datum']."<br>";
          echo "<b> Autor: </b>".$obavestenje['autor'];
          echo "</div>";
          } */
    }

    public function dodajObavestenje() {
        if ($this->session->has_userdata('user')) { //ukoliko postoji neki ulogovan korisnik 
            if ($this->session->userdata('user')['tip'] == 'k') { // i ukoliko njegova promenljiva 'tip' ima vrednost 'k',
                //Ocitaj obavestenje iz forme
                $naslov = $this->input->post("naslov");
                $obavest = $this->input->post("obavest");
                //$dat = $this->input->post ("dat");
                $vidljivost = $this->input->post("vidljivost");

                //Dodaj obavestenje u bazu:
                $this->ObavModel->dodajObavestenje($this->session->userdata('user')['idKor'], $naslov, $obavest, $vidljivost);
                $this->index();
            } else {
                echo "Nije moguce postaviti obavestenje";
            }
        }

        /* else {//slucaj da lice nije ulogovano
          $this->load->view( 'login_stranica' );
          } */

        /**
         * metoda za dodavanje obavestenja u okviru funkcionalnosti Grupe
         */
    }

    public function dodajObavestenjaGrupe() {

        $idGru = $this->input->post('idGru');
        $naslov = $this->input->post('naslov');
        $obavest = $this->input->post('tekst');
        $vidljivost = 3;
        $this->ObavModel->dodajObavestenje($this->session->userdata('user')['idKor'], $naslov, $obavest, $vidljivost);
        $last_id = $this->db->insert_id();
        $idOba = $last_id;
        $this->ObavModel->dodajObavestenjaGrupe($idOba, $idGru);
        redirect("Grupe/grupa/$idGru");
    }

}
