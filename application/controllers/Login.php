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
         $this->load->model('GuestModel');      
         $data['middle_data']=['vest'=>$this->GuestModel->najnovijaVest(),
             'obavestenje'=>$this->GuestModel->najnovijeObavestenje(),
             'oglas'=>$this->GuestModel->najnovijiOglas(), 
             'diskusija'=>$this->GuestModel->najnovijaDiskusija()];      
         $this->load->view('viewTemplate', $data); 
         // $this->load->view('login_stranica');  
    }

   
            
            
        public function logovanje(){
            
            
            $this->load->model('UserModel');
            $username= $this->input->post('username');
            $pass= $this->input->post('pass');
            
//           if (password_needs_rehash($pass, PASSWORD_DEFAULT)) {
//             $this->UserModel->hashstored($username, $pass);
//        }
             $users= $this->UserModel->loginNovo($username, $pass);
             var_dump($users);
             
             if($users == FALSE){
                 redirect("Reset_lozinke");
             }else{
                 $this->session->set_userdata('user', $users);
                  redirect("User");
//                 var_dump($users);
             }
        
    }
    public function usloviKoriscenja(){
        $this->load->view('middle/usloviKoriscenja');
    }

    public function oNama(){
        $this->load->view('middle/oNama');
    }
   
}


