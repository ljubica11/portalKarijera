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
    
    /**
     * metoda za ispisivanje opcija u padajucim listama za parametre po kojima dohvatamo studente
     */

    public function ispisiOpcije() {

        $tip = $this->input->post("tip");
        
         if ($tip == 'gradgrupe') {
            $data = ['grad' => $this->SifrarniciModel->dohvatiMesto()];
        } else if ($tip == 'vestinegrupe') {
            $data = ['vestine' => $this->SifrarniciModel->dohvatiVestine()];
        } else if ($tip == 'fakultetgrupe') {
            $data = ['fakultet' => $this->SifrarniciModel->dohvatiFakultete()];
        } else if ($tip == 'interesovanjagrupe'){
            $data = ['interesovanja' => $this->SifrarniciModel->dohvatiInteresovanja()];
        } else if ($tip == 'statusgrupe'){
            $data = ['status' => $this->GrupeModel->status()];
        } else if ($tip == 'grupedisk' || $tip == 'grupev' || $tip == 'grupeo'){
            $data = ['grupe' => $this->GrupeModel->dohvatiGrupe()];
        } else if ($tip == 'kursgrupe' || $tip == 'kurs' || $tip == 'kursv' || $tip = 'kurso') {
            $data = ["kursevi" => $this->SifrarniciModel->dohvatiKurs()];
        }

        $this->load->view('grupe/opcije', $data);
    }
    
    /**
     * kreiranje grupe i
     * upiti kojima pravimo grupe studenata po razlicitim parametrima
     */
    
    
    public function upiti(){
        
        $naziv = $this->input->post('nazivGrupe');
        $opis = $this->input->post('opisGrupe');
      
        $idGru = $this->GrupeModel->dodajNovuGrupu($naziv, $opis); 
        
        $idKurs = $this->input->post("kurs");
        $idGra = $this->input->post("grad");
        $idVes = $this->input->post("vestine");
        $idFak = $this->input->post("fakultet");
        $idInter = $this->input->post('interesovanja');
        $status = $this->input->post('status');
        
        $studentiUpit = $this->GrupeModel->upiti($idGra, $idKurs, $idFak, $idVes, $idInter, $status);
        
        foreach ($studentiUpit as $su) {
                    $idKor = $su['idKor'];
                    $this->GrupeModel->DodajStudente($idGru, $idKor);
        }
       redirect('Grupe/index');
        
    }
}
