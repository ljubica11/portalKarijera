<?php


class AdminModel extends CI_Model{
    
    
    public function prikaziZahteveRegistracija(){
        $this->db->select('korisnik.*, kompanija.*, sifgradovi.naziv as sediste');
        $this->db->from('korisnik');
        $this->db->join('kompanija', 'korisnik.idKor = kompanija.idKor');
        $this->db->join('sifgradovi', 'kompanija.sediste = sifgradovi.idGra');
        $this->db->where("cekaOdobrenje = 'da'");
        
        $query=$this->db->get();
        return $query->result_array ();
        
    }
    
    public function odobriRegistraciju($id){
        $this->db->set('cekaOdobrenje', null);
        $this->db->where('idKor', $id);
        $this->db->update('korisnik');
    }
    
    public function zabraniRegistraciju($id){
        $this->db->where('idKor', $id);
        $this->db->delete('korisnik');
    }
    
    public function dohvatiBrojZahtevaReg(){
        $this->db->where('cekaOdobrenje', 'da');
        $this->db->from('korisnik');
        return $this->db->count_all_results();
    }
    
    public function zahteviZaBrisanjeOglasa(){
        $this->db->select('oglasi.*, sifgradovi.naziv as grad, kompanija.naziv as kompanija, kompanija.sajt as sajt, kompanija.opis as kopis');
        $this->db->from('oglasi');
        $this->db->join('sifgradovi', 'oglasi.mesto = sifgradovi.idGra');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor', 'left');
        $this->db->where("zaBrisanje = 'da'");
        $query=$this->db->get();
        return $query->result_array (); 
    }
    
    public function zahteviZaBrisanjeVesti(){
        $this->db->select('vesti.*, korisnik.korisnicko as korisnik')
                ->from('vesti')
                ->join('korisnik', 'korisnik.idKor = vesti.autor')
                ->where("zaBrisanje = 'da'");
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function zahteviZaBrisanjeObav(){
        $this->db->select('obavestenja.*, kompanija.naziv as naziv');
        $this->db->from('obavestenja');
        $this->db->join('kompanija', 'obavestenja.autor = kompanija.idKor');
        $this->db->where("zaBrisanje = 'da'"); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function zahteviZaBrisanjeGrupa(){
        $this->db->select('grupe.*');
        $this->db->from('grupe');
        $this->db->where("zaBrisanje = 'da'");
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function zahteviZaBrisanjeDisk(){
        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik')
                ->from('diskusija')
                ->join('korisnik', 'korisnik.idKor = diskusija.autor')
                ->where("zaBrisanje = 'da'");
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function obrisiOglas($id){
        $this->db->where('idOgl', $id);
        $this->db->delete('oglasi');
    }
    
    public function obrisiVest($id){
        $this->db->where('idVes', $id);
        $this->db->delete('vesti');
    }
    
    public function obrisiObav($id){
        $this->db->where('idOba', $id);
        $this->db->delete('obavestenja');
    }
    
    public function obrisiGrupu($id){
        $this->db->where('idGru', $id);
        $this->db->delete('grupe');
    }
    
    public function obrisiDisk($id){
        $this->db->where('idDis', $id);
        $this->db->delete('diskusija');
    }
}
