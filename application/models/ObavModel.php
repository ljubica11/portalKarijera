<?php

class ObavModel extends CI_Model { 

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Funkcija za iscitavanje cele tabele odredjenog naziva
     * @param string $tabela
     * @return array
     */
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

    /**
     * Funkcija za iscitavanje obavestenja odredjenog id-ja
     * @param int $idOba
     * @return array
     */
    public function dohvatiObavestenje($idOba) {
        $this->db->select('obavestenja.*, kompanija.naziv as naziv');
        $this->db->from('obavestenja');
        $this->db->join('kompanija', 'obavestenja.autor = kompanija.idKor');
        $this->db->where('idOba', $idOba); // kolona 'idOba' iz baze da je jednaka prosledjenom argumentu $idOba
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funkcija za iscitavanje svih obavestenja uzimajuci na koja ulogovani korisnik ima pravo (definisano novoom vidljivosti)
     * @param string $tipKorisnika
     * @return array
     */
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
        if ($tipKorisnika == "gost") {
            $this->db->where('vidljivost', 'gost');
        }
        if ($tipKorisnika == "k") {
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->or_where('vidljivost', 'autor');
            $this->db->or_where('obavestenja.autor', $idKor);
        }
        if ($tipKorisnika == "s") {
            $this->db->where('vidljivost', 'gost');
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
        $this->db->order_by('datum', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funkcija za iscitavanje svih obavestenja odredjenog autora
     * @param int $idKor autor obavestenja
     * @return array
     */
    public function dohvatiObavestenjaKorisnika($idKor) {
        $this->db->select('obavestenja.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('obavestenja');
        $this->db->join('kompanija', 'obavestenja.autor = kompanija.idKor');
        $this->db->where('obavestenja.autor', $idKor);
        $this->db->order_by('vremePostavljanja', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funkcija za dodavanje obavestenja u bazu na osnovu prosledjenih podataka
     * @param int $idKor
     * @param string $naslov
     * @param string $obavest
     * @param string $vid
     * @param int $vidKurs
     * @param int $vidGrupa
     * @return boolean
     */
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
     * Funkcija za dohvatanje obavestenja u okviru konkretne grupe
     * @param int $idGru
     * @return array
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
     * Funkcija za dodavanje obavestenja u okviru odredjene grupe korisnika
     * @param int $idOba
     * @param int $idGru
     */
    public function dodajObavestenjaGrupe($idOba, $idGru) {

        $this->db->set('idObav', $idOba);
        $this->db->set('idGrupe', $idGru);
        $this->db->insert('sadrziobavestenje');
    }

    /**
     * Funkcija za dodavanje obavestenje korisnicima koji su rezultati pretrage
     * @param int $idObav
     * @param int $idKor
     */
    public function dodajObavestenjeZaPretragu($idObav, $idKor) {
        $data = [
            "idObav" => $idObav,
            "idKor" => $idKor
        ];

        $this->db->insert("vidiobavestenje", $data);
    }

    public function arhivirajObavestenje($idObav) {
        $data = ['zaBrisanje' => 'da', 'vidljivost' => 'autor'];
        $this->db->where('idOba', $idObav);
        $this->db->update('obavestenja', $data);
    }

    /**
     * Funkcija za dohvatanje korisnickih mejlova
     * @param int $idGru
     * @return array
     */
    public function mejlListaGrupe($idGru) {

        $this->db->select('email', 'korisnicko')
                ->from('korisnik')
                ->join('clanovigrupe', 'clanovigrupe.idKor = korisnik.idKor')
                ->join('grupe', 'clanovigrupe.idGru = grupe.idGru')
                ->where('tip', 's')
                ->where('vidljivostEmail')
                ->where('grupe.IdGru', $idGru);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funkcija za iscitavanje mail-ova svih korisnika, clanova odredjenog kursa
     * @param int $idKurs
     * @return array
     */
    public function mejlListaKurs($idKurs) {

        $this->db->select('email', 'korisnicko')
                ->from('korisnik')
                ->join('student', 'student.idKor = korisnik.idKor')
                ->join('sifkurs', 'student.idKurs = sifkurs.idKurs')
                ->where('vidljivostEmail')
                ->where('student.IdKurs', $idKurs);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funkcija za iscitavanje mail-ova svih studenata
     * @return array
     */
    public function mejlListaStudenti() {

        $this->db->select('email', 'korisnicko')
                ->from('korisnik')
                ->where('tip', 's')
                ->where('vidljivostEmail');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funkcija za iscitavanje mail-ova svih korisnika
     * @return array
     */
    public function mejlListaSvi() {

        $this->db->select('email', 'korisnicko')
                ->from('korisnik')
                ->where('vidljivostEmail');
        $query = $this->db->get();
        return $query->result_array();
    }

}
