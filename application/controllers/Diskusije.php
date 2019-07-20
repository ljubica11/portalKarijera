<?php

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
        $data = [];
        $data['middle_data'] = ['kategorije' => $kategorije];
        $data['middle'] = 'middle/diskusije';
        $this->load->view('viewTemplate', $data);
       
        
    }
   
    
    public function ispisiDiskusije(){
     $idKat = $this->input->get('id');
     $diskusije = $this->DiskusijeModel->dohvatiDiskusije($idKat);
     $this->load->view("diskusije/disk", ["diskusije" => $diskusije]);
        
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
       // $this->ispisiPostove();
        
        
    }
}