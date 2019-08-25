<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obavestenja extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('ObavModel');
        $this->load->library('pdf');
    }
    /**
     * Default metoda za prikazivanje stranice obavestenja
     */
    public function index() {
        if ($this->session->has_userdata('user')) {
            $tipKorisnika = $this->session->userdata('user')['tip'];
        } else {
            $tipKorisnika = "gost";
        }
        //Iscitavanje obavestenja iz baze
        $data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiObavestenja($tipKorisnika)];
        $data["middle"] = "middle/obavestenje";
        
        //Pozivanje viewTamplate sa obavestenjima kao podacima
        $this->load->view('viewTemplate', $data);
    }
    /**
     * Funkcija za ispisivanje jednog obavestenja preko Ajax-a
     */
    public function ispisiObavestenja() {
        //Iscitavanje id obavestenja metodom get
        $idOba = $this->input->get('id');
        
        //Iscitavanje obavestenja iz baze
        $obavestenja = ['obavestenja' => $this->ObavModel->dohvatiObavestenje($idOba)];
        
        //Ispisivanje obavestenja pozivanjem metode iz view-a
        echo $this->load->view('obavestenja/ispisObavestenja', $obavestenja, true);
        
    }
    
    /**
     * Funkcija kontrolera za dodavanje obavestenja u bazu
     */
    public function dodajObavestenje() {
        
        //Ocitavanje input polja forme (iz view-a)
        $naslov = $this->input->post("naslov");
        $obav = $this->input->post("obavest");
        $vid = $this->input->post("vidljivost");
        $vidKursa = $this->input->post("kurs");
        $vidGrupe = $this->input->post("grupa");

        //Dodaj obavestenje u bazu (Pozivanje metode modela)
        $idObav = $this->ObavModel->dodajObavestenje($this->session->userdata('user')['idKor'], $naslov, $obav, $vid, $vidKursa, $vidGrupe);
        if ($vid == "pretraga") {
            $this->dodajObavestenjeZaPretragu($idObav);
        } else if ($vid == "grupa") {
            $this->ObavModel->dodajObavestenjaGrupe($idObav, $vidGrupe);
        }
        $this->session->set_flashdata('obavestenjePostavljeno', 'Uspesno ste postavili obavestenje!');
        redirect('Obavestenja');
    }

    /**
     * Funkcija za dodavanje obavestenja u okviru funkcionalnosti Grupe
     */
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
    
    /**
     * Funkcija za dodavanje obavestenja na osnovu odredjene pretrage korisnika
     * @param int $idObav
     */
    public function dodajObavestenjeZaPretragu($idObav) {
        $res = $this->session->userdata('res');
        foreach ($res as $user) {
            $this->ObavModel->dodajObavestenjeZaPretragu($idObav, $user['idKor']);
        }
    }
    
    /**
     * Funkcija za arhiviranje odredjenog obavestenja
     * @param int $idObav
     */
    public function arhivirajObavestenje($idObav) {
        $this->ObavModel->arhivirajObavestenje($idObav);
        $this->session->set_flashdata('brisanjeObav', 'Poslat je zahtev za brisanje obavestenja administratoru. Vase obavestenje ce uskoro biti obrisano sa sajta.');
        redirect("User");
    }

    /**
     * Funkcija za slanje obavestenja na mail
     */
    public function saljiMejl() {
        $this->load->library('Phpmailerlib');
        $Mail = $this->phpmailerlib->load();

        $idOba = $this->input->get('idOba');
        $obavestenja = $this->ObavModel->dohvatiObavestenje($idOba);

        foreach ($obavestenja as $o) {
            $vidljivost = $o['vidljivost'];
            $vidljivostKurs = $o['vidljivostKurs'];
            $vidljivostGrupa = $o['vidljivostGrupa'];
            $autor = $o['naslov'];
            $naslov = $o['naziv'];
            $tekst = $o['tekst'];
        }

        $idGru = $vidljivostGrupa;
        $idKurs = $vidljivostKurs;

        $mejlListaGrupe = $this->ObavModel->mejlListaGrupe($idGru);
        $mejlListaKurs = $this->ObavModel->mejlListaKurs($idKurs);
        $mejlListaStudenti = $this->ObavModel->mejlListaStudenti();
        $mejlListaSvi = $this->ObavModel->mejlListaSvi();
        
        $msg = 'Postovana/i, ' . $tekst
                . ' Srdacan pozdrav. ' . $naslov . ' Powered by Portal Karijera tim';

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
        $Mail->Subject = 'Obavestenje ' . $naslov;
        $Mail->Body = $msg;

        if ($vidljivost) {

            foreach ($mejlListaSvi as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
            }
        } else

        if ($vidljivost) {
            $Mail->AddAddress('office@gmshops.co.rs');
            foreach ($mejlListaStudenti as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
            }
        } else
        if ($vidljivostKurs) {
            $Mail->AddAddress('online@gmshops.co.rs');
            foreach ($mejlListaKurs as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
            }
        } else

        if ($vidljivostGrupa) {
            foreach ($mejlListaGrupe as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
            }
        }
        if ($Mail->Send(true)) {
            echo "Poruka poslata";
        } else {
            echo "Poruka nije poslata<br/>";
            echo "GRESKA: " . $Mail->ErrorInfo;
        }
        //  $this->output->enable_profiler(TRUE);
        $this->index();
    }

}
