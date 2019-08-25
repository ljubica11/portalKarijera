<?php


class UserModel extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
     public function login($username, $pass){
        $this->db->where('korisnicko', $username);
        $this->db->where('lozinka', password_verify($pass));
        $this->db->where('cekaOdobrenje', null);
        $this->db->from('korisnik');
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function podaciZaStudenta($id){
        $this->db->select('ime, prezime, datum, telefon, vidljivostTelefon, adresa, vidljivostAdresa, status, sifgradovi.naziv as grad, sifdrzavljanstvo.naziv as drzavljanstvo, sifkurs.naziv as kurs');
        $this->db->from('student');
        $this->db->join('sifgradovi', 'student.mesto = sifgradovi.idGra');
        $this->db->join('sifdrzavljanstvo', 'student.drzavljanstvo = sifdrzavljanstvo.idDrz');
        $this->db->join('sifkurs', 'student.idKurs = sifkurs.idKurs');
        $this->db->where('student.idKor', $id);
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function imaInteresovanja($id){
        $this->db->select('naziv');
        $this->db->from('imainteresovanja');
        $this->db->join('sifinteresovanja', 'imainteresovanja.idInt = sifinteresovanja.idInt');
        $this->db->where('idKor', $id);
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function imaVestine($id){
        $this->db->select('naziv');
        $this->db->from('imavestine');
        $this->db->join('sifvestine', 'imavestine.idVes = sifvestine.idVes');
        $this->db->where('idKor', $id);
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function imaDiplomu($id){
        $this->db->select('odsek, godinaUpisa, godinaZavrsetka, zvanje, naziv, nivo');
        $this->db->from('diploma');
        $this->db->join('siffakulteti', 'diploma.idFak = siffakulteti.idFak');
        $this->db->where('idKor', $id);
        $this->db->where('diploma.vidljivost', null);
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function radnoIskustvo($id){
        $this->db->select('sifkompanija.naziv as kompanija, sifgradovi.naziv as grad, sifpozicija.naziv as pozicija, od, do');
        $this->db->from('zaposlenje');
        $this->db->join('sifkompanija', 'zaposlenje.kompanija = sifkompanija.idSifKo');
        $this->db->join('sifgradovi', 'zaposlenje.mesto = sifgradovi.idGra');
        $this->db->join('sifpozicija', 'zaposlenje.pozicija = sifpozicija.idPoz');
        $this->db->where('idKor', $id);
        $this->db->where('zaposlenje.vidljivost', null);
        $query=$this->db->get();
        return $query->result_array ();
        
    }
    
    public function trenutnoStudira($id){
        $this->db->select('sifuniverziteti.naziv as univerzitet, siffakulteti.naziv as fakultet, sifgradovi.naziv as grad, nivo, godinaStudija');
        $this->db->from('studije');
        $this->db->join('sifuniverziteti', 'studije.univerzitet = sifuniverziteti.idUni');
        $this->db->join('siffakulteti', 'studije.idFak = siffakulteti.idFak');
        $this->db->join('sifgradovi', 'studije.sediste = sifgradovi.idGra');
        $this->db->where('idKor', $id);
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function podaciZaKompaniju($id){
        $this->db->select('kompanija.naziv as naziv, pib, telefoni, opis, oblastDelovanja, brojZap, sajt, sifgradovi.naziv as sediste');
        $this->db->from('kompanija');
        $this->db->join('sifgradovi', 'kompanija.sediste = sifgradovi.idGra');
        $this->db->where('idKor', $id);
        $query=$this->db->get();
        return $query->result_array ();
    }
      
    public function imaObavestenja($id){
        $query = $this->db->get_where('obavestenja', array('autor' => $id));
        return $query->result_array ();
    }
    
    public function izmeniKorisnika($idKor, $korisnicko, $email){
        $this->db->set('korisnicko', $korisnicko);
        $this->db->set('email', $email);
        $this->db->where('idKor', $idKor);
        $this->db->update('korisnik');
    }
    
    public function izmeniStudenta($idKor, $ime, $prezime, $datum, $drzavljanstvo, $telefon, $adresa, $mesto, $status, $kurs){
        $data = array(
            'ime' => $ime,
            'prezime' => $prezime,
            'datum' => $datum,
            'drzavljanstvo' => $drzavljanstvo,
            'telefon' => $telefon,
            'adresa' => $adresa,
            'mesto' => $mesto,
            'status' => $status,
            'idKurs' => $kurs);

            $this->db->where('idKor', $idKor);
            $this->db->update('student', $data);
    }
    
    
    /**
     * pass hash
     * @param type $username
     * @param type $pass
     */
    public function hashstored($username, $pass){
        
     $data = ['lozinka' => password_hash($pass, PASSWORD_DEFAULT)];
     $this->db->where('korisnicko', $username);
     $this->db->update('korisnik', $data);
     
             
    } 
      
}
