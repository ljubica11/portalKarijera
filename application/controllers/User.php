<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('user')) {
            redirect('Login');
        }
        
    }
    
    public function index(){
        $idKor = $this->input->get('id');
        $tipKor = $this->input->get('tip');
        $this->load->model('UserModel');
        $this->load->model('OglasiModel');
        if($idKor){
            $id = $idKor;
        }else{
        $id= $this->session->userdata('user')['idKor'];
        }
        if($tipKor){
            $tip = $tipKor;
        }else{
        $tip= $this->session->userdata('user')['tip'];
        }
        if($tip == 's'){
            $data = [];
            $data["middle_data"] = ["podaciStudent" => $this->UserModel->podaciZaStudenta($id),
                                    "interesovanja" => $this->UserModel->imaInteresovanja($id),
                                    "vestine" => $this->UserModel->imaVestine($id),
                                    "diploma" => $this->UserModel->imaDiplomu($id),
                                    "iskustvo" => $this->UserModel->radnoIskustvo($id),
                                    "idKor" => $id,
                                    "tip" => $tip];
            $data["middle"] = "middle/pocetna";
            $this->load->view('viewTemplate', $data);
           
            
        }else if($tip == 'k'){
            $data['middle_data']= ["podaciKompanija" => $this->UserModel->podaciZaKompaniju($id),
                                   "oglasi" => $this->OglasiModel->dohvatiOglaseKorisnika($id),
                                   "obavestenja" => $this->UserModel->imaObavestenja($id),
                                   "idKor" => $id,
                                   "tip" => $tip];
            $data["middle"] = "middle/pocetna";
            $this->load->view('viewTemplate', $data);
            
        }
    }
    
     public function logout(){
          $this->session->sess_destroy();
          redirect("Login");
      }
      

      public function novaSlika(){
          
          $idKor= $this->session->userdata('user')['idKor'];
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['max_width'] = 2048;
                $config['max_height'] = 1536;
          //$config= $this->config->item('upload');
             if(!is_dir('./userImg/'.$idKor)){
                mkdir('./userImg/'.$idKor, 0777);
        }
          $config['upload_path']= './userImg/'.$idKor;
        
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('image')){
            echo $this->upload->display_errors();
        }else{
            $this->index();
      }
    
    }
    
        public function dodajCV(){
            $idKor= $this->session->userdata('user')['idKor'];
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '1000';
            
            if(!is_dir('./CV/'.$idKor)){
                mkdir('./CV/'.$idKor, 0777);
        }
          $config['upload_path']= './CV/'.$idKor;
          $this->load->library('upload', $config);
          if(!$this->upload->do_upload('cv')){
              $this->index();
              echo $this->upload->display_errors();
          }else{
              $upload_data = $this->upload->data();
              echo $upload_data["file_type"];
               $this->index();
          }

        }
        
//        public function dohvatiCV(){
//            $idKor= $this->session->userdata('user')['idKor'];
//            $dir = './CV/'.$idKor;
//            $this->load->helper('download');
//            $allCV= scandir($dir);
//                $onlyCV = array_diff($allCV, array('.', '..'));
//                foreach($onlyCV as $oneCV){
//                    force_download($dir.'/'.$oneCV, null);
//                }
//            
//        }
        
        public function procitajCV(){
            $idKor= $this->session->userdata('user')['idKor'];
            $dir = './CV/'.$idKor;
            $allCV= scandir($dir);
                $onlyCV = array_diff($allCV, array('.', '..'));
                foreach($onlyCV as $oneCV){
                    $file = $dir.'/'.$oneCV;
                    $filename= $oneCV;
                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline; filename="' . $filename . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($file));
                    header('Accept-Ranges: bytes');
                    readfile($file);
                    
                }
        }
        
}
