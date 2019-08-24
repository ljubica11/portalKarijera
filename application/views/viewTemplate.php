<?php
if($this->session->user == null){
    $this->load->view("headers/guestHeader");
    $this->load->view($middle, $middle_data ?? []);
    $this->load->view("footers/guestFooter");
} else if($this->session->userdata('user')['tip']=="s"){
    $this->load->view("headers/studentHeader");
    $this->load->view($middle, $middle_data ?? []);
    $this->load->view("footers/userFooter",["tip" => "student"]);
} else if($this->session->userdata('user')['tip']== "k"){
    $this->load->view("headers/kompHeader");
    $this->load->view($middle, $middle_data ?? []);
    $this->load->view("footers/userFooter",["tip" => "kompanija"]);
}else if($this->session->userdata('user')['tip']== "a"){
    $this->load->view("headers/adminHeader");
    $this->load->view($middle, $middle_data ?? []);
    $this->load->view("footers/userFooter", ["tip" => "admin"]);
}



