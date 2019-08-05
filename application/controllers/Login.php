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
                echo "Nekorektni podaci!";
            }else{
                $user = $users[0];
                $this->session->set_userdata('user', $user);
                redirect("User");
            }
        
    }
    public function uslovi(){
        $this->load->view('uslovi_koriscenja');
    }
    
}
