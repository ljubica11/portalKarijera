<?php


class MY_Controller extends CI_Controller{
    
    public function __construct() {
     parent::__construct();
     
     $this->load->model('SifrarniciModel');
 }


    public function dodajNovaInteresovanja(){
        $inter = $this->input->post('inter');
        $novaInteresovanja = $this->SifrarniciModel->dodajNovaInteresovanja($inter);
        $nazivInt = $novaInteresovanja[0]['naziv']; 
        $idInt = $novaInteresovanja[0]['idInt'];
        $this->load->library ( 'parser' );
        $data = array(
        'idInt' => $idInt,
        'nazivInt' => $nazivInt
        );
        $this->parser->parse('interesovanja', $data);  
    }
    
      public function dodajNoveVestine(){
        $vestina = $this->input->post('vestina');
        $noveVestine = $this->SifrarniciModel->dodajNoveVestine($vestina);
        $nazivVes = $noveVestine[0]['naziv']; 
        $idVes = $noveVestine[0]['idVes'];
        $this->load->library ( 'parser' );
        $data = array(
        'idVes' => $idVes,
        'nazivVes' => $nazivVes
        );
        $this->parser->parse('vestine', $data);  
    }
    
      public function dodajNovoMesto($tipMesta){
        $novoMesto = $this->input->post('dodatak');
        $mesta = $this->SifrarniciModel->dodajNovoMesto($novoMesto);
        $this->load->view("selectLista", ["mesta" => $mesta, "novo" => $novoMesto, "tip" => $tipMesta]);
    }
    
      public function dodajNoviFakultet(){
        $noviFakultet = $this->input->post('dodatak');
        $fakulteti = $this->SifrarniciModel->dodajNoviFakultet($noviFakultet);
        $this->load->view("selectLista", ["fakulteti" => $fakulteti, "novo" => $noviFakultet]);

    }
    
    public function dodajNovuKompaniju(){
        $novaKompanija = $this->input->post('dodatak');
        $kompanije = $this->SifrarniciModel->dodajNovuKompaniju($novaKompanija);
        $this->load->view("selectLista", ["kompanije" => $kompanije, "novo" => $novaKompanija]);
    }
    
    public function dodajNovuPoziciju(){
        $novaPozicija = $this->input->post('dodatak');
        $pozicije = $this->SifrarniciModel->dodajNovuPoziciju($novaPozicija);
        $this->load->view("selectLista", ["pozicije" => $pozicije, "novo" => $novaPozicija]);
    }
}
