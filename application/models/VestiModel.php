<?php

defined('BASEPATH') or exit('no direct access');

class VestiModel extends CI_Model {

    public function dohvatiKategorijeVesti() {
        $this->db->select('sifkategorijavesti.*');
        $this->db->from('sifkategorijavesti');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dohvatiVesti($idKatVesti) {

        $this->db->from('vesti');
        $this->db->select('vesti.*, korisnik.korisnicko as korisnik, sifkategorijavesti.idKatVesti as idKat, sifkategorijavesti.naziv as kategorija');
        $this->db->join('korisnik', 'korisnik.idKor = vesti.autor');
        $this->db->join('sifkategorijavesti', 'sifkategorijavesti.idKatVesti = vesti.kategorija');
        $this->db->where('sifkategorijavesti.idKatVesti', $idKatVesti);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda kojom dohvatamo sve vesti u okviru kreirane grupe korisnika
     * @param type $idGru
     * @return type
     */
    public function dohvatiVestiGrupe($idGru) {

        $this->db->select('vesti.*, korisnik.korisnicko')
                ->from('vesti')
                ->join('korisnik', 'vesti.autor = korisnik.idKor')
                ->join('sadrzivesti', 'sadrzivesti.idVest = vesti.idVes')
                ->where('sadrzivesti.idGrupa', $idGru);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dohvatiJednuVest($idVes) {

        $this->db->select('vesti.*, korisnik.korisnicko as korisnik')
                ->from('vesti')
                ->join('korisnik', 'korisnik.idKor = vesti.autor')
                ->where('vesti.idVes', $idVes);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dodajVest($idKor, $kategorija, $naziv, $tekst) {

        $this->db->set('autor', $idKor);
        $this->db->set('kategorija', $kategorija);
        $this->db->set('naziv', $naziv);
        $this->db->set('tekst', $tekst);
        $this->db->set('datum', date('Y-m-d H:m:i'));
        $this->db->insert('vesti');
    }

    /**
     *
     * metoda za dodavanje vesti u okviru odredjene grupe korisnika
     * @param type $idVes
     * @param type $idGru
     */
    public function dodajVestGrupe($idVes, $idGru) {

        $this->db->set('idVest', $idVes);
        $this->db->set('idGrupa', $idGru);
        $this->db->insert('sadrzivesti');
    }

    public function dodajKategorijuVesti($nova_kategorija) {

        $this->db->set('naziv', $nova_kategorija);
        $this->db->insert('sifkategorijavesti');
    }

    public function dohvatiSveVesti() {

        $this->db->select('vesti.*, korisnik.korisnicko as korisnik');
        $this->db->from('vesti');
        $this->db->join('korisnik', 'korisnik.idKor = vesti.autor');
        $this->db->order_by('idVes', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
