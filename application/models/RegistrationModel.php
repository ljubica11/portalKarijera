<?php

class RegistrationModel extends CI_Model{
    
    public function dodajKorisnika($korisnicko, $lozinka, $email, $vidEmail, $tip, $cekaOdobrenje){
        $data = [
            "korisnicko" => $korisnicko,
            "lozinka" => $lozinka,
            "email" => $email,
            "vidljivostEmail" => $vidEmail,
            "tip" => $tip,
            "cekaOdobrenje" => $cekaOdobrenje
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
    
    public function dodajStudenta($ime, $srednjeIme, $prezime, $datum, $pol, $drzavljanstvo, $telefon, $adresa, $mesto, $pin, $status, $kurs, $idKor, $vidAdresa, $vidTel){
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
            "idKurs" => $kurs,
            "vidljivostTelefon" => $vidTel,
            "vidljivostAdresa" => $vidAdresa
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
            "idKor" => $idKor  
        ];
        
        $this->db->insert("kompanija", $data);
    }
    
    public function dodajInteresovanjaZaKorisnika($idKor, $jednoInteresovanje){
       
        $data = ["idKor" => $idKor, "idInt" => $jednoInteresovanje];
        $this->db->insert("imainteresovanja", $data);
    }
    
    
    public function dodajVestineZaKorisnika($idKor, $jednaVestina){
        $data = ["idKor" => $idKor, "idVes" => $jednaVestina];
        $this->db->insert("imavestine", $data); 
    }
    
    public function dodajStudije($idKor, $univerzitet, $fakultet, $sedisteFak, $nivo, $godinaStu){
        $data = [
            "idKor" => $idKor,
            "univerzitet" => $univerzitet,
            "sediste" => $sedisteFak,
            "nivo" => $nivo,
            "godinaStudija" => $godinaStu,
            "idFak" => $fakultet   
        ];
        
        $this->db->insert("studije", $data);
    }
    
    public function dodajDiplomuZaKorisnika($idKor, $idFak, $odsek, $zvanje, $nivo, $godUpisa, $godZavrsetka, $vidljivost){
        $data= [
            "idKor" => $idKor,
            "odsek" => $odsek,
            "nivo" => $nivo,
            "godinaUpisa" => $godUpisa,
            "godinaZavrsetka" => $godZavrsetka,
            "zvanje" => $zvanje,
            "idFak" => $idFak,
            "vidljivost" => $vidljivost
        ];
        
        $this->db->insert("diploma", $data);
    }
    
    public function dodajIskustvoZaKorisnika($idKor, $kompanija, $mesto, $pozicija, $od, $do, $vidljivost){
        $data =[
            "idKor" => $idKor,
            "kompanija" => $kompanija,
            "mesto" => $mesto,
            "pozicija" => $pozicija,
            "od" => $od,
            "do" => $do,
            "vidljivost" => $vidljivost
        ];
        
        $this->db->insert("zaposlenje", $data);
    }

}
