<?php

defined('BASEPATH') or exit('no direct access');

class VestiModel extends CI_Model {
    
    public function dohvatiKategorijeVesti() {
    $this->db->select('sifkategorijavesti.*');
    $this->db->from('sifkategorijavesti');
    $query = $this->db->get();
    return $query->result_array();            
    
    }
    
    public function dohvatiVesti($idKatVesti) {

    $this->db->from('vesti');
    $this->db->select('vesti.*, korisnik.korisnicko as korisnik, sifkategorijavesti.idKatVesti as idKat, sifkategorijavesti.naziv as kategorija');
    $this->db->join('korisnik', 'korisnik.idKor = vesti.autor');
    $this->db->join('sifkategorijavesti', 'sifkategorijavesti.idKatVesti = vesti.kategorija');
    $this->db->where('sifkategorijavesti.idKatVesti', $idKatVesti);
    $query = $this->db->get();
    return $query -> result_array();
        
    }
    
    public function dodajVest($idKor, $kategorija, $naziv, $tekst) {
        
        $this->db->set('autor', $idKor);
        $this->db->set('kategorija', $kategorija);
        $this->db->set('naziv', $naziv);
        $this->db->set('tekst', $tekst);
        $this->db->set('datum', date('Y-m-d H:m:i'));
        $this->db->insert('vesti');
        
    }
}