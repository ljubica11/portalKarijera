<?php


class Oglasi extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model("OglasiModel");
        $this->load->model("SifrarniciModel");  
    }

    public function index(){
        $oglasi = ["oglasi" => $this->OglasiModel->dohvatiSveOglase()];
        $gradovi = ["mesta" => $this->SifrarniciModel->dohvatiMesto()];        
        $data["middle_data"] = ["pretraga" => $this->load->view('oglasi/pretragaOglasa', $gradovi, true),
                                "oglasi" => $this->load->view('oglasi/prikazOglasa', $oglasi, true),
                                "dodaj" => $this->load->view('oglasi/dodajOglas',$gradovi, true)];
        $data["middle"] = "middle/oglasi";
        $this->load->view('viewTemplate', $data);
    }
    
    public function dohvatiOglaseKorisnika(){
        $idKor = $this->input->get('idKor');
        $oglasi = ["oglasi" => $this->OglasiModel->dohvatiOglaseKorisnika($idKor)];
        $this->load->view('oglasi/prikazOglasa', $oglasi);
    }
    
    public function dohvatiSveOglase(){
        $oglasi = ["oglasi" => $this->OglasiModel->dohvatiSveOglase()];
        $this->load->view('oglasi/prikazOglasa', $oglasi);
    }
    
    public function dodajNoviOglas(){
        
        $idKor= $this->session->userdata('user')['idKor'];
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['max_width'] = 2048;
                $config['max_height'] = 1536;
             if(!is_dir('./userImg/'.$idKor)){
                mkdir('./userImg/'.$idKor, 0777);
        }
          $config['upload_path']= './userImg/'.$idKor;
        
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('logo')){
            echo $this->upload->display_errors();
        }else{
       
        $naslov = $this->input->post('naslov');
        $pozicija = $this->input->post('pozicija');
        $grad = $this->input->post('mesto');
        $vremeIst = $this->input->post('vremeIst');
        $opis = $this->input->post('opis');
        $placanje = $this->input->post('placanje');
        $plataNiz = array_filter($this->input->post('plata'), 'strlen');
        $obavezeNiz = array_filter($this->input->post('obaveze'), 'strlen');
        $usloviNiz = array_filter($this->input->post('uslovi'), 'strlen');
        $ponudaNiz = array_filter($this->input->post('ponuda'), 'strlen');
        $plata = implode(" - ", $plataNiz);
        $obaveze = implode(";", $obavezeNiz);
        $uslovi = implode(";", $usloviNiz);
        $ponuda = implode(";", $ponudaNiz);

        $idOgl = $this->OglasiModel->dodajNoviOglas($idKor, $naslov, $grad, $vremeIst, $opis, $plata, $placanje, $obaveze, $uslovi, $ponuda, $pozicija);
        $this->pogledajOglas($idOgl);
    }
    }
    public function pogledajOglas($idOgl){
       $oglasi = $this->OglasiModel->dohvatiJedanOglas($idOgl);
       $data["middle_data"] = ["oglasi" => $oglasi];
       $data["middle"] = "middle/oglas";
       $this->load->view('viewTemplate', $data);
    }

        public function pretragaOglasa(){
            
            $rec = $this->input->post('pretraga');
            $grad = $this->input->post('grad');
            if(empty($this->OglasiModel->pretragaOglasa($rec, $grad))){
                echo "<h5>Nema oglasa</h5>";
            }else{
            $oglasi = ["oglasi" => $this->OglasiModel->pretragaOglasa($rec, $grad)];
            $this->load->view('oglasi/prikazOglasa', $oglasi);
        }
    }

    
    public function dodajMesto(){
         $this->dodajNovoMesto('mesto');
    }
}
