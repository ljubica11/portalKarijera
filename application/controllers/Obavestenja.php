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
        if ($this->session->has_userdata('user')) {
            $tipKorisnika = $this->session->userdata('user')['tip'];
        } else {
            $tipKorisnika = "gost";
        }
        $data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiObavestenja($tipKorisnika)];
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
 
                
                $naslov = $this->input->post("naslov");
                $obav = $this->input->post("obavest");
                $vid = $this->input->post("vidljivost");
                $vidKursa = $this->input->post("kurs");
                $vidGrupe = $this->input->post("grupa");
                
                //Dodaj obavestenje u bazu:
                $idObav = $this->ObavModel->dodajObavestenje($this->session->userdata('user')['idKor'], $naslov, $obav, $vid, $vidKursa, $vidGrupe);
                if($vid == "pretraga"){
                    $this->dodajObavestenjeZaPretragu($idObav);
                    
                }
                $this->session->set_flashdata('obavestenjePostavljeno', 'Uspesno ste postavili obavestenje!');
                redirect('Obavestenja');

            

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
       $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post("odabraniKurs");
        $vidljivostGrupa = $this->input->post('odabranaGrupa');
        $this->ObavModel->dodajObavestenje($this->session->userdata('user')['idKor'], $naslov, $obavest, $vidljivost, $vidljivostKurs, $vidljivostGrupa);
        $last_id = $this->db->insert_id();
        $idOba = $last_id;
        $this->ObavModel->dodajObavestenjaGrupe($idOba, $idGru);
        redirect("Grupe/grupa/$idGru");
    }
    
    public function dodajObavestenjeZaPretragu($idObav){
        $res = $this->session->userdata('res');
            foreach ($res as $user){
                
                $this->ObavModel->dodajObavestenjeZaPretragu($idObav, $user['idKor']);
               
            }
        
    }

}
