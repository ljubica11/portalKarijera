<?php


class Oglasi extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model("OglasiModel");
        $this->load->model("SifrarniciModel");
    }

    public function index(){
        $oglasiData = ["oglasi" => $this->OglasiModel->dohvatiSveOglase()];
        $gradoviData = ["gradovi" => $this->SifrarniciModel->dohvatiMesto()];
        
        $data["middle_data"] = ["pretraga" => $this->load->view('oglasi/pretragaOglasa', $gradoviData, true),
                                "oglasi" => $this->load->view('oglasi/prikazOglasa', $oglasiData, true)];
        $data["middle"] = "middle/oglasi";
        $this->load->view('viewTemplate', $data);
    }
    
    public function ispisiOglase(){
        $oglasi = $this->OglasiModel->dohvatiSveOglase();
        $this->load->library ( 'parser' );
        $this->parser->parse('oglasi', ["oglasi" => $oglasi]);
    }
}
