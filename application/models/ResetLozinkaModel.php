<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

 class ResetLozinkaModel extends CI_Model{
        
        public function  sendNewPasswordMail($korisnicko){
                $korisnik = $this->db->query('select idKor, email, tip, vidljivostEmail from korisnik where korisnicko= ?',[$korisnicko])->row();
               if (!$korisnik){
                   return false; 
    //               provera korisnika i podataka u bazi, ako nije korisnik da se vrati greska
                }
                $this->load->helper('string');
                $novaLozinka = random_string('alnum',15);
                $datum = date('Y-m-d');

                $data = array(
                    'lozinka'=> $novaLozinka,
                    'datum'=>$datum);
                $this->db->where('idKor', $korisnik->idKor);
                $this->db->update('korisnik', $data);   
     
                $text = 'Nova lozinka za korisnicko ime '. $korisnicko. " je " . $novaLozinka . '.';
                $this->load->config('email');
                $this->load->library('email');
     //           $this->email->initialize($this->config->item('email'));
                $this->email->from("admin@karijera-portal.link.in.rs", 'admin karijera-portal');
                $this->email->to($korisnik->email);
                $this->email->subject('Reset lozinke');
                $this->email->message($text);
                return $this->email->send();
     //           inicijalizacija slanja mejla sa reset lozinkom
            }
    }

