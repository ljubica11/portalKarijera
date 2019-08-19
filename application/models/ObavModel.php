<?php

class ObavModel extends CI_Model { // ovaj model cemo koristiti da izvucemo podatke iz baze

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    public function dohvati($tabela) {
        $this->db->select('*');
        $this->db->from($tabela);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dohvatiSvaObavestenja() {
        return $this->dohvati('obavestenja'); // dohvatamo tabelu obavestenja
    }

    public function dohvatiSveKurseve() {
        return $this->dohvati('sifkurs');
    }

    public function dohvatiSveGrupe() {
        return $this->dohvati('grupe');
    }

    public function dohvatiObavestenje($idOba) {
        
        $this->db->select('obavestenja.*, kompanija.naziv as naziv');
        $this->db->from('obavestenja');
        $this->db->join('kompanija', 'obavestenja.autor = kompanija.idKor');
        //$this->db->join('');
        //$this->db->join('');
        $this->db->where('idOba', $idOba); // kolona 'idOba' iz baze da je jednaka prosledjenom argumentu $idOba
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dohvatiObavestenja($tipKorisnika) {
        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();
        $this->db->select('idObav')->from('vidiobavestenje')->where('idKor', $idKor);
        $wherePretraga = $this->db->get_compiled_select();

        $this->db->select('obavestenja.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('obavestenja');
        $this->db->join('kompanija', 'obavestenja.autor = kompanija.idKor');
        $this->db->where('vidljivost', 'gost');
        if($tipKorisnika == "k"){
            $this->db->or_where('vidljivost', 'korisnici');
        }
        if ($tipKorisnika == "s") {
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->or_where('vidljivost', 'studenti');
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where("vidljivostKurs in ($whereKurs)", NULL, FALSE);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where("vidljivostGrupa in ($whereGrupe)", NULL, FALSE);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'pretraga');
            $this->db->where("idOba in ($wherePretraga)", NULL, FALSE);
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dohvatiObavestenjaKorisnika($idKor) {
        $this->db->select('obavestenja.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('obavestenja');
        $this->db->join('kompanija', 'obavestenja.autor = kompanija.idKor');
        $this->db->where('obavestenja.autor', $idKor);
        $this->db->order_by('vremePostavljanja', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dodajObavestenje($idKor, $naslov, $obavest, $vid, $vidKurs, $vidGrupa) {
        $podaci = [
            'naslov' => $naslov,
            'tekst' => $obavest,
            'datum' => date('Y-m-d H:m:i'),
            'autor' => $idKor,
            'vidljivost' => $vid,
            "vidljivostKurs" => $vidKurs,
            "vidljivostGrupa" => $vidGrupa
        ];
        $this->db->insert('obavestenja', $podaci);    //u tabelu obavestenja unosimo podatke koje smo uneli po ovim kriterijumima
        return $idObav = $this->db->insert_id();
    }

    /**
     *  metoda za dohvatanje obavestenja u okviru konkretne grupe
     * @param type $idGru
     * @return type array;
     */
    public function dohvatiObavestenjaGrupe($idGru) {

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
    public function dodajObavestenjaGrupe($idOba, $idGru) {

        $this->db->set('idObav', $idOba);
        $this->db->set('idGrupe', $idGru);
        $this->db->insert('sadrziobavestenje');
    }
    
    public function dodajObavestenjeZaPretragu($idObav, $idKor){
        $data = [
            "idObav" => $idObav,
            "idKor" => $idKor
        ];
        
        $this->db->insert("vidiobavestenje", $data);
    }

}
