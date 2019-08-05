<?php
/**
 * Description of Diskusije
 *
 * @author gordan
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusije extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('DiskusijeModel');
    }
    
    public function index(){
        
        $kategorije = $this->DiskusijeModel->dohvatiKategorije();
        $diskusije = ['diskusije' => $this->DiskusijeModel->dohvatiSveDiskusije()];
        $data['middle_data'] = ['kategorije' => $kategorije, 
                               $this->load->view("diskusije/disk", $diskusije, true)];
        $data['middle'] = 'middle/diskusije';
        $this->load->view('viewTemplate', $data);      
    }
   
    
    public function ispisiDiskusije(){
     $idKat = $this->input->get('id');
     $diskusije = $this->DiskusijeModel->dohvatiDiskusije($idKat);
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
        $this->ispisiPostove();
        
        
    }
    
    public function dodajDiskusiju(){
        
        
       
        $kategorija = $this->input->post('kategorija');
        $naziv = $this->input->post('naziv');
        $opis= $this->input->post('opis');
        $this->DiskusijeModel->dodajDiskusiju($this->session->userdata('user')['idKor'], $kategorija, $naziv, $opis);
        $this->index();
        
        
    }
    
    public function dodajKategoriju(){
        
        $naziv = $this->input->post('naziv');
        $this->DiskusijeModel->dodajKategoriju($naziv);
        $this->index();
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
    
