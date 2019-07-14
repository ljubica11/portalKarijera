<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    
    public function index(){
        
        $this->load->model('UserModel');
        $id= $this->session->userdata('user')['idKor'];
        $tip= $this->session->userdata('user')['tip'];
        
        if($tip == 's'){
            $data['podaci']= $this->UserModel->podaciZaStudenta($id);
            $data['interesovanja'] = $this->UserModel->imaInteresovanja($id);
            $data['vestine'] = $this->UserModel->imaVestine($id);
            $data['studira'] = $this->UserModel->trenutnoStudira($id);
            $data['diploma'] = $this->UserModel->imaDiplomu($id);
            $data['iskustvo'] = $this->UserModel->radnoIskustvo($id);
            $this->load->view('pocetna', $data);
        }else if($tip == 'k'){
            $data['podaci']= $this->UserModel->podaciZaKompaniju($id);
            $this->load->view('pocetna', $data);
        }
    }
    
     public function logout(){
          $this->session->sess_destroy();
          redirect("Login");
      }
    
}
