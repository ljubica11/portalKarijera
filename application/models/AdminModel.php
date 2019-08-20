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
}
