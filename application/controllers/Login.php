<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        if ($this->session->has_userdata('user')) {
            redirect('User');
        }
        
    }
    
  
    public function index(){
         $data["middle"] = "middle/login_stranica";
         $this->load->view('viewTemplate', $data);
        
        
       // $this->load->view('login_stranica');  
    }

        public function logovanje(){
            
            $username= $this->input->post('username');
            $pass= $this->input->post('pass');
            
            $this->load->model('UserModel');
            $users= $this->UserModel->login($username, $pass);
            
            if(count($users)==0){
               echo 'Pogresno korisnicko ime ili lozinka';
               echo '<br><a href="#">Zaboravili ste lozinku??</a>';
            }else{
                $user = $users[0];
                $this->session->set_userdata('user', $user);
                redirect("User");
            }
        
    }
    public function usloviKoriscenja(){
        $this->load->view('middle/usloviKoriscenja');
    }

    public function oNama(){
        $this->load->view('middle/oNama');
    }
    
    public function najnovijaVest(){
        $idVes = $this->input->get('idVes');   
        $vest = $this->GuestModel->najnovijaVest($idVes);
        $this->load->view("middle/login_stranica",  $vest);
    }
}

