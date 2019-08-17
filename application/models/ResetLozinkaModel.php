<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

 class ResetLozinkaModel extends CI_Model{
        
     public function  sendNewPasswordMail($korisnicko){
            $korisnik = $this->db->query('select idKor, email, tip, vidljivostEmail from korisnik where korisnicko= ?',[$korisnicko])->row();
           if (!$korisnik){
               return false;
           }
           $this->load->helper('string');
           $novaLozinka = random_string('alnum',15);
           $datum = date('Y-m-d H:i:s', 1+3600);
         
           $data = [
               'idKor'=>$korisnik->idKor,
               'korisnicko'=> $korisnicko,
               'email'=>$korisnik->email,
               'lozinka'=> $novaLozinka,
               'datum'=>$datum,
               'tip'=>$korisnik->tip,
               'vidljivostEmail'=>$korisnik->vidljivostEmail
               
           ];
           $this->db->replace('korisnik', $data);
           $text = '<html><body><p>Id korisnika i nova lozinka je: '. $korisnicko. " , " . $novaLozinka . '</p></body></html>';
           $this->load->library('email');
           $this->email->initialize($this->config->item('email'));
           $this->email->from('your@example.com', 'Your name');
           $this->email->to('mmmmaremmm225@gmail.com');
           $this->email->subject('Reset lozinke');
           $this->email->message($text);
           return $this->email->send();
        }
    }

