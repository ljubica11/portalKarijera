<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class ResetLozinkaModel extends CI_Model{
        
     public function  sendNewPasswordMail($korisnicko){
            $korisnik = $this->db->query('select idKor, email from korisnik where korisnicko= ?',[$korisnicko])->row();
           if (!$korisnik){
               return false;
           }
           $this->load->helper('string');
           $novaLozinka = random_string('alnum',15);
           $datum = date('Y-m-d');
           $time = time('H:i:s', 1+3600);
           $data = [
               'idKor'=>$korisnik->idKor,
               'korisnicko'=> $korisnicko,
               'email'=>$korisnik->email,
               'lozinka'=> $novaLozinka,
               'datum'=>$datum,
               'vreme' =>$time
           ];
           $this->db->replace('korisnik', $data);
           $text = '<html><body><p>Nova lozinka je: ' . $novaLozinka . '</p></body></html>';
           $this->load->library('email');
           $this->email->from('your@example.com', 'Your name');
           $this->email->to($korisnik->email);
           $this->email->subject('Reset lozinke');
           $this->email->message($text);
           return $this->email->send();
        }
    }
        
   //kor ime: mmmmaremmm225 lozinka: *123456m   
    

