<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Grupe
 * 
 * kontroler za funkcionalnost Grupe
 * 
 * formiranje grupa studenata po razlicitim parametrima i pravima pristupa 
 * po izboru korisnika. U okviru svake od grupa kreiraju se diskusije, obavestenja
 * i vesti sa pravima vidljivosti po izboru korisnika. U svakoj grupi se izlistavaju
 * oglasi kompanija vidljivi toj grupi.
 * . 
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

    /**
     * ispisivanje clanova odredjene grupe.
     * Na stranici se u listi korisnika generise i link ka njihovim profilima.
     */
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
        if ($idKor == null) {
            redirect('Registracija/index');
        } else {
            $this->GrupeModel->DodajStudente($idGru, $idKor);
        }
        redirect('Grupe/index');
    }

    /**
     * metoda za brisanje ulogovanog korisnika iz odredjene grupe
     */
    public function obrisiLogovanog() {

        $idGru = $this->input->get('idGru');
        $idKor = $this->session->userdata('user')['idKor'];
        $this->GrupeModel->obrisiStudente($idGru, $idKor);
        redirect('Grupe/index');
    }

    /**
     * brisanje clan(ov)a iz grupe
     */
    public function obrisiClanaGrupe() {

        $idGru = $this->input->post('idGru');
        $idKorArr = $this->input->post('idKor');
        foreach ($idKorArr as $idKor) {
            $this->GrupeModel->obrisiStudente($idGru, $idKor);
        }
        $this->output->enable_profiler(FALSE);

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
        $kursevi = $this->SifrarniciModel->dohvatiKurs();
        $grupa = $this->GrupeModel->dohvatiGrupe();

        $data['middle'] = 'grupe/grupa';
        $data['middle_data'] = ['clanovi' => $clanovi, 'diskusijeGrupe' => $diskusijeGrupe,
            'oglasiGrupe' => $oglasiGrupe, 'vestiGrupe' => $vestiGrupe,
            'obavestenjaGrupe' => $obavestenjaGrupe, 'kategorije' => $kategorije,
            'katVesti' => $katVesti, 'kursevi' => $kursevi, 'grupa' => $grupa];
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
        } else if ($tip == 'interesovanjagrupe') {
            $data = ['interesovanja' => $this->SifrarniciModel->dohvatiInteresovanja()];
        } else if ($tip == 'statusgrupe') {
            $data = ['status' => $this->GrupeModel->status()];
        } else if ($tip == 'grupag') {
            $data = ['grupa' => $this->GrupeModel->dohvatiGrupe()];
        } else if ($tip == 'kursgrupe' OR $tip == 'kursg') {
            $data = ["kursevi" => $this->SifrarniciModel->dohvatiKurs()];
        }

        $this->load->view('grupe/opcije', $data);
    }

    /**
     * kreiranje grupe i
     * upiti kojima pravimo grupe studenata po razlicitim parametrima
     */
    public function upiti() {

        $naziv = $this->input->post('nazivGrupe');
        $opis = $this->input->post('opisGrupe');
        $zaBrisanje = null;


        $idGru = $this->GrupeModel->dodajNovuGrupu($naziv, $opis, $zaBrisanje);

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
        $this->output->enable_profiler(FALSE);
        redirect('Grupe/index');
    }

    /**
     * zahtev korisnika adminu za brisanjem grupe
     */
    public function traziBrisanje() {

        $idGru = $this->input->post('idGru');
        $this->GrupeModel->zaBrisanje($idGru);
    }

}
