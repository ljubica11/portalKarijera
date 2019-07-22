<?php

defined('BASEPATH') or exit('no direct access');

class DiskusijeModel extends CI_Model {
    
    
    public function dohvatiKategorije(){
        
       $this->db->select('sifkategorijadiskusija.*');
       $this->db->from('sifkategorijadiskusija');
       $query = $this->db->get();
       return $query -> result_array();
        
    }

    public function dohvatiDiskusije($idKat) {


        $this->db->from('diskusija');
        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik, sifkategorijadiskusija.idKatDis as idKat, sifkategorijadiskusija.naziv as kategorija');
        $this->db->join('korisnik', 'korisnik.idKor = diskusija.autor');
        $this->db->join('sifkategorijadiskusija', 'sifkategorijadiskusija.idKatDis = diskusija.kategorija');
        $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
        $query = $this->db->get();
        return $query -> result_array();
        
        
    }
    
    public function dohvatiPostove($diskusija){
        
        $this->db->select('postdiskusija.tekst, korisnik.korisnicko as "korisnik", postdiskusija.poslatoDatum as "datum"');
        $this->db->from('postdiskusija');
        $this->db->join('diskusija', 'diskusija.idDis = postdiskusija.diskusija');
        $this->db->join('sifkategorijadiskusija', 'sifkategorijadiskusija.idKatDis = diskusija.kategorija');
        $this->db->join('korisnik', 'korisnik.idKor = postdiskusija.posiljalac');
        $this->db->where('postdiskusija.diskusija', $diskusija);
        $this->db->order_by('postdiskusija.poslatoDatum', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
        
        
        
        
    }

    public function dohvatiPostoveKorisnika($idKor) {
        
        
        $this->db->select('postdiskusija.tekst as tekst, postdiskusija.poslatoDatum as datum, diskusija.naziv as naziv');
        $this->db->from('postdiskusija');
        
        $this->db->join('diskusija', 'diskusija.idDis = postdiskusija.diskusija');
        $this->db->where('postdiskusija.posiljalac', $idKor);
        $this->db->group_by('postdiskusija.idPos');
        $this->db->order_by('postdiskusija.poslatoDatum', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
        
        
        
    }
    
    public function dodajPost($idKor, $idDis, $tekst ){
         
        $this->db->set('posiljalac', $idKor);
        $this->db->set('diskusija', $idDis);
        $this->db->set('tekst', $tekst);
        $this->db->set('poslatoDatum', date("Y-m-d H:i:s"));
        $this->db->insert('postdiskusija');
         
    }
    
    public function dodajDiskusiju($idKor, $kategorija, $naziv, $opis){
        
        $this->db->set('autor', $idKor);
        $this->db->set('kategorija', $kategorija);
        $this->db->set('naziv', $naziv);
        $this->db->set('opis', $opis);
        $this->db->set('datum', date('Y-m-d H:i:s'));
        $this->db->insert('diskusija');
                
    }
    
    public function dodajKategoriju($naziv){
        
        $this->db->set('naziv', $naziv);
        $this->db->insert('sifkategorijadiskusija');
    }

}
