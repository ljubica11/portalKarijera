<?php

class ObavModel extends CI_Model { // ovaj model cemo koristiti da izvucemo podatke iz baze
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function dohvatiObavestenje(){
        $query = $this->db->query('select * from obavestenja');
        return $query->result_array();
    }
    
    public function dodajObavestenje($idKor, $naslov, $obavest, $aut, $vid){
        $podaci = ['idOba'=>$idKor, 'naslov'=>$naslov, 'tekst'=>$obavest, 'datum'=>date('Y-m-d H:m:i'), 'autor'=>$aut, 'vidljivost'=>$vid];
        $this->db->insert('obavestenja', $podaci);    //u tabelu obavestenja unosimo podatke koje smo uneli po ovim kriterijumima
        
    }
}

