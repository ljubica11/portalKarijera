<?php


class Oglasi extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model("OglasiModel");
        $this->load->model("SifrarniciModel");  
    }

    public function index(){
        if($this->session->has_userdata('user')){
        $tipKorisnika = $this->session->userdata('user')['tip'];

        }else{
            $tipKorisnika = "gost";

        }
//        $tipKorisnika=[];
        $oglasi = ["oglasi" => $this->OglasiModel->dohvatiSveOglase($tipKorisnika)];
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
        $tip = "k";
        $oglasi = ["oglasi" => $this->OglasiModel->dohvatiSveOglase($tip)];
        $this->load->view('oglasi/prikazOglasa', $oglasi);
    }
    
    public function dodajNoviOglas(){
        
        $idKor= $this->session->userdata('user')['idKor'];
        if(isset($_FILES['logo'])){ 
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
        $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post('odabraniKurs');
        $vidljivostGrupa = $this->input->post('odabranaGrupa');
        

        $idOgl = $this->OglasiModel->dodajNoviOglas($idKor, $naslov, $grad, $vremeIst, $opis, $plata, $placanje, $obaveze, $uslovi, $ponuda, $pozicija, $vidljivost, $vidljivostGrupa, $vidljivostKurs);
        if($vidljivost == "pretraga"){
            $this->dodajOglasZaPretragu($idOgl);
        }else if($vidljivost == "grupa"){
            $this->OglasiModel->dodajOglasZaGrupu($idOgl, $vidljivostGrupa);
        }
        redirect("Oglasi/pogledajOglas/$idOgl");
    }
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
        $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post('odabraniKurs');
        $vidljivostGrupa = $this->input->post('odabranaGrupa');

        $idOgl = $this->OglasiModel->dodajNoviOglas($idKor, $naslov, $grad, $vremeIst, $opis, $plata, $placanje, $obaveze, $uslovi, $ponuda, $pozicija, $vidljivost, $vidljivostGrupa, $vidljivostKurs);
        if($vidljivost == "pretraga"){
            $this->dodajOglasZaPretragu($idOgl);
        }else if($vidljivost == "grupa"){
             $this->OglasiModel->dodajOglasZaGrupu($idOgl, $vidljivostGrupa);
        }
        redirect("Oglasi/pogledajOglas/$idOgl");

    }
    }
    
    public function dodajOglasZaPretragu($idOgl){
        $res = $this->session->userdata('res');
            foreach ($res as $user){
                
                $this->OglasiModel->dodajOglasZaPretragu($idOgl, $user['idKor']);
               
            }
    }

    public function pogledajOglas($idOgl){
       $oglasi = $this->OglasiModel->dohvatiJedanOglas($idOgl);
       $data["middle_data"] = ["oglasi" => $oglasi];
       $data["middle"] = "middle/oglas";
       $this->load->view('viewTemplate', $data);
    }

        public function pretragaOglasa(){
            $tip = $this->input->post('tip');
            $rec = $this->input->post('pretraga');
            $grad = $this->input->post('grad');
            if(empty($this->OglasiModel->pretragaOglasa($rec, $grad, $tip))){
                echo "<h5>Nema oglasa</h5>";
            }else{
            $oglasi = ["oglasi" => $this->OglasiModel->pretragaOglasa($rec, $grad, $tip)];
            $this->load->view('oglasi/prikazOglasa', $oglasi);
        }
            
//            $res = $this->OglasiModel->pretragaOglasa($rec, $grad, $tip);
//            var_dump($res);
    }

    
    public function dodajMesto(){
         $this->dodajNovoMesto('mesto');
    }
    
    public function traziBrisanje($idOgl){
        $this->OglasiModel->traziBrisanje($idOgl);
        $this->session->set_flashdata('brisanje', 'Poslat je zahtev za brisanje oglasa administratoru. Vas oglas ce uskoro biti obrisan sa sajta.');
        redirect("Oglasi");
    }
    
    public function dohvatiOpcije(){
        $tip = $this->input->post("tip");
        if($tip == 'kurs'){
            $podaci = ["kursevi" => $this->SifrarniciModel->dohvatiKurs()]; 
        }else if($tip == 'grupa'){
            $podaci = ["grupe" => $this->OglasiModel->dohvatiGrupe()];
        }
        $this->load->view('oglasi/dodatneOpcije', $podaci);
    }
  
}
