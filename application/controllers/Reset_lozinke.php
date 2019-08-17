<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_lozinke extends CI_Controller{
    public function index(){
       $data["middle"] = "middle/reset_lozinke";
       $data["middle_data"] = ['forma' => true];
       $this->load->view('viewTemplate', $data);
    }
    
    public function send(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("korisnicko", "Korisnicko ime", "trim|required");
        if($this->form_validation->run() == false){
            $this->index();
            return; 
        }
        $this->load->model("ResetLozinkaModel");
        $data['middle_data'] = ['forma' =>false];
        if($this->ResetLozinkaModel->sendNewPasswordMail($this->input->post('korisnicko'))){
            $data['middle_data']['mail_ok'] = true;
        }else {
            $data['middle_data']['mail_ok'] = false;
        }
        $data["middle"] = "middle/reset_lozinke";
        $this->load->view('viewTemplate', $data);
    }

}