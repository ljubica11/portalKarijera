<?php


class Pretraga extends MY_Controller{
    
        public function __construct() {
        parent::__construct();
        
        $this->load->model("PretragaModel");
        $this->load->model("SifrarniciModel");
        }

    public function index(){
        
        $podaciZaPretraguStud = ["gradovi" => $this->SifrarniciModel->dohvatiMesto(),
                                "interesovanja" => $this->SifrarniciModel->dohvatiInteresovanja(),
                                "vestine" => $this->SifrarniciModel->dohvatiVestine(),
                                "kursevi" => $this->SifrarniciModel->dohvatiKurs(),
                                "fakulteti" => $this->SifrarniciModel->dohvatiFakultete()];
        
        $podaciZaPretraguKomp = ["gradovi" => $this->SifrarniciModel->dohvatiMesto()];

        $data["middle"] = "middle/pretraga";
        $data["middle_data"] = ["pretragaStud" => $this->load->view('pretraga/pretragaStudenti', $podaciZaPretraguStud, true),
                                "pretragaKomp" => $this->load->view('pretraga/pretragaKomp', $podaciZaPretraguKomp, true)]; 
        $this->load->view('viewTemplate', $data);
    }
    
    public function pretraziStudente(){
        $ime = $this->input->post('ime');
        $prezime = $this->input->post('prezime');
        $mesto = $this->input->post('mesto');
        $faks = $this->input->post('faks');
        $kurs = $this->input->post('kurs');
        $int = $this->input->post('int');
        $ves = $this->input->post('ves');
        $rezultat = $this->PretragaModel->pretragaStudenata($ime, $prezime, $mesto, $faks, $kurs, $int, $ves);
        if(empty($rezultat)){
            echo "<h5>Nema rezultata</h5>";
        }else{
            $podaci = ["podaci" => $rezultat,
                       "tip" => 'student'];
            $this->load->view('pretraga/prikazRezultata', $podaci);
        }
    }
    
    public function pretraziKompanije(){
        $naziv = $this->input->post('naziv');
        $oblast = $this->input->post('oblast');
        $mesto = $this->input->post('mesto');
        $rezultat = $this->PretragaModel->pretragaKompanija($naziv, $oblast, $mesto);
        if(empty($rezultat)){
            echo "<h5>Nema rezultata</h5>";
        }else{
            $podaci = ["podaci" => $rezultat,
                        "tip" => 'kompanija'];
            $this->load->view('pretraga/prikazRezultata', $podaci);
        }
    }
   
}
