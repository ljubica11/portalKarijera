<?php


class OglasiModel extends CI_Model{
    
    public function dohvatiSveOglase(){
        $this->db->select('oglasi.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
        $query=$this->db->get();
        return $query->result_array ();
    }
   
}
