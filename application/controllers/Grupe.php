<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Grupe
 *
 * @author gordan
 */
class Grupe extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('GrupeModel');
        $this->load->model('SifrarniciModel');
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
        $this->load->view('grupe/clanovi', ["clanovi" => $clanovi, 'brojClanova' => $brojClanova]);
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
        $this->load->view('grupe/izborParametara', ['grupe' => $grupe, 'prebivaliste' => $prebivaliste, 'kurs' => $kurs,
            'interesovanja' => $interesovanja, 'vestine' => $vestine, 'idGru' => $idGru]);
    }
    
    /**
     * 
     * metode za dohvatanje studenata po konkretnom parametru (kurs, prebivaliste, vestine...)
     */

    public function poKursu() {

        $idGru = $this->input->post('idGru');
        $idKurs = $this->input->post('idKurs');
        $studentiKurs = $this->GrupeModel->dohvatiStudenteKurs($idKurs);
        $clanoviKurs = $this->GrupeModel->dohvatiClanove($idGru);
        $postojiClan = $clanoviKurs[0]['idKor'];

        if ($clanoviKurs == null) {
            foreach ($studentiKurs as $sk) {
                $idKor = $sk['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
            redirect('Grupe/index');
        } else {
            foreach ($studentiKurs as $sk) {
                $idKor = $sk['idKor'];
                $ime = $sk['ime'];
                if ($idKor == $postojiClan) {
                    echo 'student' . $ime . ' vec je clan ';
                } else {
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
                redirect('Grupe/index');
            }
        }
    }

    public function poGradu() {

        $idGru = $this->input->post('idGru');
        $idGra = $this->input->post('idGra');
        $studentiGrad = $this->GrupeModel->dohvatiStudenteGrad($idGra);
        $clanoviGrad = $this->GrupeModel->dohvatiClanove($idGru);
        $postojiClan = $clanoviGrad[0]['idKor'];

        if ($clanoviGrad == null) {
            foreach ($studentiGrad as $s) {
                $idKor = $s['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
            redirect('Grupe/index');
        } else {
            foreach ($studentiGrad as $s) {
                $idKor = $s['idKor'];
                $ime = $s['ime'];
                if ($idKor == $postojiClan) {
                    echo 'student' . $ime . ' vec je clan ';
                } else {
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
                redirect('Grupe/index');
            }
        }
    }

    public function poInteresovanjima() {

        $idGru = $this->input->post('idGru');
        $idInt = $this->input->post('idInt');
        $studentiInt = $this->GrupeModel->dohvatiStudenteInteresovanja($idInt);
        $clanoviInt = $this->GrupeModel->dohvatiClanove($idGru);
        $postojiClan = $clanoviInt[0]['idKor'];

        if ($clanoviInt == null) {
            foreach ($studentiInt as $si) {
                $idKor = $si['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
            redirect('Grupe/index');
        } else {
            foreach ($studentiInt as $si) {
                $idKor = $si['idKor'];
                $ime = $si['ime'];
                if ($idKor == $postojiClan) {
                    echo 'student' . $ime . ' vec je clan ';
                } else {
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
                redirect('Grupe/index');
            }
        }
    }

    public function poVestinama() {

        $idGru = $this->input->post('idGru');
        $idVes = $this->input->post('idVes');
        $studentiVestine = $this->GrupeModel->dohvatiStudenteVestine($idVes);
        $clanoviVestine = $this->GrupeModel->dohvatiClanove($idGru);
        $postojiClan = $clanoviVestine[0]['idKor'];


        if ($clanoviVestine == null) {
            foreach ($studentiVestine as $sv) {
                $idKor = $sv['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
            redirect('Grupe/index');
        } else {
            foreach ($studentiVestine as $sv) {
                $idKor = $sv['idKor'];
                $ime = $sv['ime'];
                if ($idKor == $postojiClan) {
                    echo 'student' . $ime . ' vec je clan ';
                } else {
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
                }
                redirect('Grupe/index');
            }
        }
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

}
