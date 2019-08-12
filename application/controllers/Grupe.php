<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Grupe
 * kontroler za funkcionalnost Grupe
 * @author gordan
 */
class Grupe extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('GrupeModel');
        $this->load->model('SifrarniciModel');
        $this->load->model('DiskusijeModel');
    }

    public function index() {
        
        $grupeData = ['grupe' => $this->GrupeModel->dohvatiGrupe()];
        $data['middle_data'] = ['grupe' => $this->load->view('grupe/prikazGrupe', $grupeData, true)];
        $data['middle'] = 'middle/grupe';
        $this->load->view('viewTemplate', $data);
    }

    public function ispisiSveGrupe() {

        $grupe = $this->GrupeModel->dohvatiGrupe();
        $this->load->library('parser');
        $this->parser->parse('grupe', ["grupe" => $grupe]);
    }

    public function ispisiClanove() {

        $idGru = $this->input->post('idGru');
        $clanovi = $this->GrupeModel->dohvatiClanove($idGru);
        $brojClanova = $this->db->where('idGru', $idGru)->count_all_results('clanovigrupe');
        $this->load->view('grupe/clanovi', ["clanovi" => $clanovi, 'brojClanova' => $brojClanova, 'idGru' => $idGru]);
    }

    public function napraviGrupu() {

        $naziv = $this->input->post('nazivGrupe');
        $opis = $this->input->post('opisGrupe');
        $this->GrupeModel->dodajNovuGrupu($naziv, $opis);
        $this->session->set_flashdata('grpmsg', 'Uspesno ste napravili grupu. Izberite kategorije i dodajte clanove');
        $this->index();
    }

    /**
     * metoda za ispisivanje razlicitih parametara po kojima dohvatamo korisnike 
     */
    public function parametri() {
        $idGru = $this->input->get('idGru');
        $grupe = $this->GrupeModel->dohvatiJednuGrupu($idGru);
        $prebivaliste = $this->SifrarniciModel->dohvatiMesto();
        $kurs = $this->SifrarniciModel->dohvatiKurs();
        $interesovanja = $this->SifrarniciModel->dohvatiInteresovanja();
        $vestine = $this->SifrarniciModel->dohvatiVestine();
        $diploma = $this->SifrarniciModel->dohvatiFakultete();
        $this->load->view('grupe/izborParametara', ['grupe' => $grupe, 'prebivaliste' => $prebivaliste, 'kurs' => $kurs,
            'interesovanja' => $interesovanja, 'vestine' => $vestine, 'diploma' => $diploma, 'idGru' => $idGru]);
    }

    /**
     * 
     * metode za dohvatanje studenata po konkretnom parametru (kurs, prebivaliste, vestine,
     * interesovanja, zavrseni fakultet...)
     */
    public function poInteresovanjima() {

        $idGru = $this->input->post('idGru');
        $idInt = $this->input->post('idInt');
        $studentiInt = $this->GrupeModel->dohvatiStudenteInteresovanja($idInt);
        foreach ($studentiInt as $si) {
            $idKor = $si['idKor'];
            $this->GrupeModel->DodajStudente($idGru, $idKor);
        }
        redirect('Grupe/index');
    }
    
    public function poFakultetu() {

        $idGru = $this->input->post('idGru');
        $idFak = $this->input->post('idFak');
        $studentiFakultet = $this->GrupeModel->dohvatiStudenteFakultet($idFak);

        foreach ($studentiFakultet as $sf) {
            $idKor = $sf['idKor'];
            $this->GrupeModel->DodajStudente($idGru, $idKor);
        }
        redirect('Grupe/index');
    }

    /**
     * 
     * metoda za ubacivanje u grupu ulogovanog korisnika
     */
    public function uclaniLogovanog() {

        $idGru = $this->input->get('idGru');
        $idKor = $this->session->userdata('user')['idKor'];
        $this->GrupeModel->DodajStudente($idGru, $idKor);
        redirect('Grupe/index');
    }

    /**
     * metoda za brisanje korisnika iz odredjene grupe
     */
    public function obrisiLogovanog() {

        $idGru = $this->input->get('idGru');
        $idKor = $this->session->userdata('user')['idKor'];
        $this->GrupeModel->obrisiStudente($idGru, $idKor);
        redirect('Grupe/index');
    }

    public function obrisiClanaGrupe() {

        $idGru = $this->input->post('idGru');
        $idKorNiz = $this->input->post('idKor');
        foreach ($idKorNiz as $idKor) {
            $this->GrupeModel->obrisiStudente($idGru, $idKor);
        }
        redirect('Grupe/index');
    }

    /**
     * metoda za prikaz grupe i ispis diskusija, oglasa i ostalih funkcionalnosti
     * u okviru odredjene grupe
     * @param type $idGru
     */
    public function grupa($idGru) {

        $this->load->model('OglasiModel');
        $this->load->model('VestiModel');
        $this->load->model('ObavModel');

        $tipKorisnika = $this->session->userdata('user')['tip'];

        $clanovi = $this->GrupeModel->dohvatiClanove($idGru);
        $diskusijeGrupe = $this->DiskusijeModel->dohvatiDiskusijeGrupe($idGru, $tipKorisnika);
        $oglasiGrupe = $this->OglasiModel->dohvatiOglaseGrupe($idGru);
        $vestiGrupe = $this->VestiModel->dohvatiVestiGrupe($idGru);
        $obavestenjaGrupe = $this->ObavModel->dohvatiObavestenjaGrupe($idGru);
        $kategorije = $this->DiskusijeModel->dohvatiKategorije();
        $katVesti = $this->VestiModel->dohvatiKategorijeVesti();

        $data['middle'] = 'grupe/grupa';
        $data['middle_data'] = ['clanovi' => $clanovi, 'diskusijeGrupe' => $diskusijeGrupe,
            'oglasiGrupe' => $oglasiGrupe, 'vestiGrupe' => $vestiGrupe,
            'obavestenjaGrupe' => $obavestenjaGrupe, 'kategorije' => $kategorije,
            'katVesti' => $katVesti];
        $this->load->view('viewTemplate', $data);
    }

    public function ispisiOpcije() {

        $tip = $this->input->post("tip");
        if ($tip == 'kursgrupe') {
            $data = ["kursevi" => $this->SifrarniciModel->dohvatiKurs()];
        } else if ($tip == 'gradgrupe') {
            $data = ['grad' => $this->SifrarniciModel->dohvatiMesto()];
        } else if ($tip == 'vestinegrupe') {
            $data = ['vestine' => $this->SifrarniciModel->dohvatiVestine()];
        } else if ($tip == 'fakultetgrupe') {
            $data = ['fakultet' => $this->SifrarniciModel->dohvatiFakultete()];
        }  else if ($tip == 'intergrupe'){
              $data = ['interesovanja' => $this->SifrarniciModel->dohvatiInteresovanja()];
        }
    
        $this->load->view('grupe/opcije', $data);
    }

    public function upitiTest() {

        $idGru = $this->input->post("idGru"); //439;
        $idKurs = $this->input->post("kurs");
        $idGra = $this->input->post("grad");
        $idVes = $this->input->post("vestine");
        $idFak = $this->input->post("fakultet");
        $idInt = $this->input->post("interesovanja");

        if (isset($idGra) && isset($idKurs) && isset($idVes) && isset($idFak) && isset($idInt)) {

            $studentiUpit = $this->GrupeModel->upiti($idGra, $idKurs, $idVes, $idFak, $idInt);


            foreach ($studentiUpit as $su) {
                $idKor = $su['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
        } else {
            if (empty($idGra)) {

                $studentiUpit = $this->GrupeModel->upitiBezGrada($idKurs, $idVes, $idFak, $idInt);

                foreach ($studentiUpit as $su) {
                    $idKor = $su['idKor'];
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
            } else if (empty($idKurs)) {
                $studentiUpit = $this->GrupeModel->upitiBezKursa($idGra, $idVes, $idFak, $idInt);

                foreach ($studentiUpit as $su) {
                    $idKor = $su['idKor'];
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
            } else if (empty($idVes)) {


                $studentiUpit = $this->GrupeModel->upitiBezVestina($idGra, $idKurs, $idFak, $idInt);
                foreach ($studentiUpit as $su) {
                    $idKor = $su['idKor'];
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
            }
        } if (isset($idGra) && empty($idKurs) && empty($idVes) && empty($idFak) && empty($idInt)) {


            $studentiGrad = $this->GrupeModel->dohvatiStudenteGrad($idGra);
            foreach ($studentiGrad as $s) {
                $idKor = $s['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
        } else {
            if (isset($idKurs) && empty($idGra) && empty($idVes)&& empty($idFak) && empty($idInt)) {
                $studentiKurs = $this->GrupeModel->dohvatiStudenteKurs($idKurs);
                foreach ($studentiKurs as $s) {
                    $idKor = $s['idKor'];
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
            } else if (isset($idVes) && empty($idKurs) && empty($idGra)&& empty($idFak) && empty($idInt)) {
                $studentiVestine = $this->GrupeModel->dohvatiStudenteVestine($idVes);

                foreach ($studentiVestine as $sv) {
                    $idKor = $sv['idKor'];
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
            }
        }


        redirect('Grupe/index');
    }

}
