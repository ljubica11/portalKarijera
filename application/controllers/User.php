<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    
    public function index(){
        
        $this->load->model('UserModel');
        $id= $this->session->userdata('user')['idKor'];
        $tip= $this->session->userdata('user')['tip'];
        
        if($tip == 's'){
            $data = [];
            $data["middle_data"] = ["podaci" => $this->UserModel->podaciZaStudenta($id),
                                    "interesovanja" => $this->UserModel->imaInteresovanja($id),
                                    "vestine" => $this->UserModel->imaVestine($id),
                                    "diploma" => $this->UserModel->imaDiplomu($id),
                                    "iskustvo" => $this->UserModel->radnoIskustvo($id)];
            $data["middle"] = "middle/pocetna";
            $this->load->view('viewTemplate', $data);
           
            
        }else if($tip == 'k'){
            $data['middle_data']= $this->UserModel->podaciZaKompaniju($id);
            $data["middle"] = "middle/pocetna";
            $this->load->view('viewTemplate', $data);
            
        }
    }
    
     public function logout(){
          $this->session->sess_destroy();
          redirect("Login");
      }
    
}
