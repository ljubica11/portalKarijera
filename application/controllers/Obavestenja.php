<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Obavestenja extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
         $this->load->model('ObavModel');
    }
    
        public function index(){
            //$this->load->model('ObavModel');
            $id= $this->session->userdata('obavestenja')['idOba'];
            $data["middle_data"] = ["obavestenja" => $this->ObavModel->dohvatiObavestenje()]; 
                                
            $data["middle"] = "middle/obavestenje";
            $this->load->view('viewTemplate', $data);
    }
    
        public function dodajObavestenje(){
          /*  if($this->session->has_userdata('korisnik')){ //ukoliko je neko ko se ulogovao kompanija, tj. ima povlastice koje se odnose na kompaniju 
            
                $tip=$this->session->userdata('korisnik')->tip; 
            
                if ($tip == 's') {
                    echo "Nije moguce postaviti obavestenje";
                }
                else {*/
                
                    $naslov = $this->input->post ("naslov");
                    $obavest = $this->input->post ("obavest");
                    //$dat = $this->input->post ("dat");
                    $vidljivost = $this->input->post ("vidljivost");                    

                    $this->ObavModel->dodajObavestenje ($this->session->userdata('user')['idKor'], $naslov, $obavest, $vidljivost);
                    $this->index();
                    
        }
    }   
           /* else {//slucaj da lice nije ulogovano
                $this->load->view( 'login_stranica' ); 
            }*/
            
        
   
    
    
    

