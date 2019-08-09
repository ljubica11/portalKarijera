<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Grupe
 *kontroler za funkcionalnost Grupe
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
    
    public function poFakultetu() {

        $idGru = $this->input->post('idGru');
        $idFak = $this->input->post('idFak');
        $studentiFakultet= $this->GrupeModel->dohvatiStudenteFakultet($idFak);
        $clanoviFakultet = $this->GrupeModel->dohvatiClanove($idGru);
        $postojiClan = $clanoviFakultet[0]['idKor'];


        if ($clanoviFakultet == null) {
            foreach ($studentiFakultet as $sf) {
                $idKor = $sf['idKor'];
                $this->GrupeModel->DodajStudente($idGru, $idKor);
            }
            redirect('Grupe/index');
        } else {
            foreach ($studentiFakultet as $sf) {
                $idKor = $sf['idKor'];
                $ime = $sf['ime'];
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
    
    /**
     * metoda za brisanje korisnika iz odredjene grupe
     */
    
    public function obrisiLogovanog(){
        
        $idGru = $this->input->get('idGru');
        $idKor = $this->session->userdata('user')['idKor'];
        $this->GrupeModel->obrisiStudente($idGru, $idKor);
        redirect('Grupe/index');
    }
    public function obrisiClanaGrupe(){
        
        $idGru= $this->input->post('idGru');
        $idKorNiz = $this->input->post('idKor');
        foreach($idKorNiz as $idKor){
        $this->GrupeModel->obrisiStudente($idGru, $idKor);
        }
        redirect('Grupe/index');
    }


    
    /**
     * metoda za prikaz grupe i ispis diskusija, oglasa i ostalih funkcionalnosti
     * u okviru odredjene grupe
     * @param type $idGru
     */
    public function grupa($idGru){
        
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

}
