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
    
    public function dodajObavestenje($idKor, $naslov, $obavest, $vid){
        $podaci = [ 'naslov'=>$naslov, 'tekst'=>$obavest, 'datum'=>date('Y-m-d H:m:i'), 'autor'=>$idKor, 'vidljivost'=>$vid];
        $this->db->insert('obavestenja', $podaci);    //u tabelu obavestenja unosimo podatke koje smo uneli po ovim kriterijumima
        
    }
   
    
    /**
     *  metoda za dohvatanje obavestenja u okviru konkretne grupe
     * @param type $idGru
     * @return type array;
     */
     public function dohvatiObavestenjaGrupe($idGru){
        
        $this->db->select('obavestenja.*, korisnik.korisnicko')
                 ->from('obavestenja')
                 ->join('korisnik', 'obavestenja.autor = korisnik.idKor')
                 ->join('sadrziobavestenje', 'sadrziobavestenje.idObav = obavestenja.idOba')
                 ->where('sadrziobavestenje.idGrupe', $idGru);
        $query = $this->db->get();
        return $query->result_array();
        
     }
     
     /**
      * metoda za dodavanje obavestenja u okviru odredjene grupe korisnika
      * @param type $idOba
      * @param type $idGru
      */
     
     public function dodajObavestenjaGrupe($idOba, $idGru){
        
        $this->db->set('idObav', $idOba);
        $this->db->set('idGrupe', $idGru);
        $this->db->insert('sadrziobavestenje');
    }
}

