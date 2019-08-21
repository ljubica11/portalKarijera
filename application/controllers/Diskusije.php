<?php
/**
 * Description of Diskusije
 * kontroler za funckionalnost Diskusije
 * @author gordan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Diskusije extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('DiskusijeModel');
        $this->load->model('SifrarniciModel');
        
    }
    
    public function index(){
        
        $tipKorisnika = $this->session->userdata('user')['tip'];
        $idKat = $this->input->get('id');
        $kategorije = $this->DiskusijeModel->dohvatiKategorije();
        $diskusije = ['diskusije' => $this->DiskusijeModel->dohvatiDiskusije($idKat, $tipKorisnika)];
        $sveDiskusije = ['sveDiskusije' => $this->DiskusijeModel->dohvatiSveDiskusije($tipKorisnika)];
        $data['middle_data'] = ['kategorije' => $kategorije, 
                               $this->load->view("diskusije/disk", $diskusije, true),
                               $this->load->view("diskusije/disk", $sveDiskusije, true)];
        $data['middle'] = 'middle/diskusije';
        $this->load->view('viewTemplate', $data);      
    }
   
    
   public function ispisiDiskusije(){
    
     $idKat = $this->input->get('id');
     $tipKorisnika = $this->session->userdata('user')['tip'];
     $diskusije = $this->DiskusijeModel->dohvatiDiskusije($idKat, $tipKorisnika);
     $this->load->view("diskusije/disk", ["diskusije" => $diskusije]);
        
    }
    
    public function jednaDiskusija($idDis){
        
        $diskusija =  $this->DiskusijeModel->dohvatiJednuDiskusiju($idDis);
        $data["middle_data"] = ["diskusija" => $diskusija];
        $data["middle"] = "diskusije/diskusija";
        $this->load->view('viewTemplate', $data);
      
        
    }
    
    public function ispisiPostove(){
        
        $diskusija = $this->input->get('id');
        $postovi = $this->DiskusijeModel->dohvatiPostove($diskusija);
        $this->load->view('diskusije/postovi', ['postovi' => $postovi]);
    }
    
    public function dodajPost(){
        
        $idDis = $this->input->post('idDis');
        $tekst = $this->input->post('tekst');
        $this->DiskusijeModel->dodajPost($this->session->userdata('user')['idKor'], $idDis, $tekst);
        $postovi = $this->DiskusijeModel->dohvatiPostove($idDis);
        foreach($postovi as $p){
             
             $idPos = $p['idPos'];
   
  
    
            echo  '<div class="postdesno"><div class="porAut">'. $p['korisnik'] . ':</div>'. '<div class="poruka">'. $p['tekst'] . '</div>'.
                  '<div class="porDatum">Poslato:'.'  '.$p['datum'] .'</div>'.
                  "<input type='button' class='btn btn-outline-primary btn-sm' value='svidjanje' onclick='lajk($idPos)'>".
                  '<span><div id="brLajkova'.$idPos.'">'.'<i class="far fa-thumbs-up"></i>' .$p['brLajkova'].'</span></div></div>';
}
    }
       
             
    
    
    public function dodajDiskusiju(){
        
        $kategorija = $this->input->post('kategorija');
        $naziv = $this->input->post('naziv');
        $opis= $this->input->post('opis');
        $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post('odabraniKurs');
        $vidljivostGrupa = $this->input->post('odabranaGrupa');
        $zaBrisanje = null;
        $this->DiskusijeModel->dodajDiskusiju($this->session->userdata('user')['idKor'], $kategorija, $naziv, $opis,
                $vidljivost, $vidljivostKurs, $vidljivostGrupa, $zaBrisanje);
        $this->index();
        
        
    }
     public function dodajDiskusijuGrupe(){
        
        
        $idGru = $this->input->post('idGru');
        $kategorija = $this->input->post('kategorija');
        $naziv = $this->input->post('naziv');
        $opis = $this->input->post('opis');
        $vidljivost = $this->input->post('vidljivost');
        $vidljivostKurs = $this->input->post('odabraniKurs');
        $vidljivostGrupa = $this->input->post('odabranaGrupa');
        $zaBrisanje = null;
        $this->DiskusijeModel->dodajDiskusiju($this->session->userdata('user')['idKor'], $kategorija, $naziv, $opis,
                $vidljivost, $vidljivostKurs, $vidljivostGrupa, $zaBrisanje);
        $last_id = $this->db->insert_id();
        $idDis = $last_id;
        $this->DiskusijeModel->dodajDiskusijuGrupe($idDis, $idGru);
        $this->jednaDiskusija($idDis);
    }
    
    /**
     * metoda potrebna za ispis opcija u padajucim listama
     */
    public function ispisiOpcije(){
        
        $tip = $this->input->post("tip");
        if($tip == 'kurs'){
            $data = ["kursevi" => $this->SifrarniciModel->dohvatiKurs()]; 
        }else if($tip == 'grupa'){
            $data = ["grupe" => $this->DiskusijeModel->dohvatiGrupe()];
        }else if($tip == 'grad'){
            $data = ['grad' => $this->SifrarniciModel->dohvatiMesto()];
        }
        $this->load->view('diskusije/opcije', $data);
    }
    
    public function dodajKategoriju(){
        
        $naziv = $this->input->post('naziv');
        $this->DiskusijeModel->dodajKategoriju($naziv);
        $this->index();
    }
    
    public function arhivirajDiskusiju(){
        
        $idDis = $this->input->get('idDis');
        $this->DiskusijeModel->arhivirajDiskusiju($idDis);
        echo 'arhivirana';
        }
        
        public function traziBrisanje(){
            
        $idDis = $this->input->get('idDis');    
        $this->DiskusijeModel->zaBrisanje($idDis);
        $this->session->set_flashdata('arhiviranje', 'Poslat je zahtev za arhiviranje');
        redirect('index');
        
    }
    
    public function lajkPost(){
        
        $idPos = $this->input->get('idPos');
        $lajkovi = $this->DiskusijeModel->dohvatiLajkove($idPos);
        $brLajkova = $lajkovi[0]['brLajkova'];
        $brLajkova++;
        $this->DiskusijeModel->dodajLajk($brLajkova, $idPos);
        echo $brLajkova;
        }
    }
    
