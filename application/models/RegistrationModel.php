<?php

class RegistrationModel extends CI_Model{
    
    public function dohvatiKurs(){
        $query = $this->db->get('sifkurs');
        return $query->result_array();
    }
    
    public function dohvatiDrz(){
        $query = $this->db->get('sifdrzavljanstvo');
        return $query->result_array();
    }
    
    public function dohvatiMesto(){
        $query = $this->db->get('sifgradovi');
        return $query->result_array();
    }
    
    public function dohvatiInteresovanja(){
        $query = $this->db->get('sifinteresovanja');
        return $query->result_array();
    }

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
    
    public function dodajStudenta($ime, $srednjeIme, $prezime, $datum, $pol, $drzavljanstvo, $telefon, $adresa, $mesto, $pin, $status, $kurs, $idKor){
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
            "idKor" => $idKor,
            "idKurs" => $kurs
        ];
        
        $this->db->insert("student", $data);
        
    }
    
    public function dodajKompaniju($naziv, $sediste, $pib, $telefoni, $opis, $oblast, $brojzap, $sajt, $idKor){
        $data = [
            "naziv" => $naziv,
            "sediste" => $sediste,
            "pib" => $pib,
            "telefoni" => $telefoni,
            "opis" => $opis,
            "oblastDelovanja" => $oblast,
            "brojZap" => $brojzap,
            "sajt" => $sajt,
            "idKor" => $idKor,  
        ];
        
        $this->db->insert("kompanija", $data);
    }
    
    public function dodajInteresovanjaZaKorisnika($idKor, $jednoInteresovanje){
       
        $data = ["idKor" => $idKor, "idInt" => $jednoInteresovanje];
        $this->db->insert("imainteresovanja", $data);
    }
    
    public function dodajNovaInteresovanja($inter){
        $data = ["naziv" => $inter];
        $this->db->insert("sifinteresovanja", $data);
        $query = $this->db->get_where('sifinteresovanja', array('naziv' => $inter));
        return $query->result_array();
    }
}
