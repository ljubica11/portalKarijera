<?php

class RegistrationModel extends CI_Model{
    
    public function dodajKorisnika($korisnicko, $lozinka, $email, $tip){
        $data = [
            "korisnicko" => $korisnicko,
            "lozinka" => $lozinka,
            "email" => $email,
            "tip" => $tip 
        ];
        
        
        $this->db->insert ( "korisnik", $data );
    }
    
    public function dohvatiId($korisnicko){
        $this->db->select('idKor');
        $this->db->where('korisnicko', $korisnicko);
        $this->db->from('korisnik');
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function dodajStudenta($ime, $srednjeIme, $prezime, $datum, $pol, $drzavljanstvo, $telefon, $adresa, $mesto, $pin, $status, $idKor){
        $data = [
            "ime" => $ime,
            "srednjeIme" => $srednjeIme,
            "prezime" => $prezime,
            "datum" => $datum,
            "pol" => $pol,
            "drzavljanstvo" => $drzavljanstvo,
            "telefon" => $telefon,
            "adresa" => $adresa,
            "mesto" => $mesto,
            "pin" => $pin,
            "status" => $status,
            "idKor" => $idKor
        ];
        
        $this->db->insert("student", $data);
        
    }
}
