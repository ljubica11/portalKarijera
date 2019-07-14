<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    
  
    public function index(){
        $this->load->view('login_stranica');  
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
                redirect('User');
            }
        
    }
    
}
