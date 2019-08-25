<?php

/**
 * Description of VestiModel
 * metode za dohvatanje i brisanje kategorija i vesti po razlicitim kriterijumima i
 * nivoima pristupa
 */
defined('BASEPATH') or exit('no direct access');

class VestiModel extends CI_Model {

    /**
     * metoda za dohvatanje kategorija za pokretanje vesti iz baze podataka
     * @return type array
     */
    public function dohvatiKategorijeVesti() {
        $this->db->select('sifkategorijavesti.*');
        $this->db->from('sifkategorijavesti');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje vesti u zavisnosti od prava pristupa po
     * tipu korisnika i kategoriji vesti
     * @param type $idKatVesti
     * @param type $tipKorisnika
     * @return type array
     */
    public function dohvatiVesti($idKatVesti, $tipKorisnika) {

        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();
        $this->db->select('idVes')->from('vidivest')->where('idKor', $idKor);
        $wherePretraga = $this->db->get_compiled_select();

        $this->db->from('vesti');
        $this->db->select('vesti.*, korisnik.korisnicko as korisnik, sifkategorijavesti.idKatVesti as idKat, sifkategorijavesti.naziv as kategorija');
        $this->db->join('korisnik', 'korisnik.idKor = vesti.autor');
        $this->db->join('sifkategorijavesti', 'sifkategorijavesti.idKatVesti = vesti.kategorija');
        $this->db->where('sifkategorijavesti.idKatVesti', $idKatVesti);
        if ($tipKorisnika == "gost") {
            $this->db->where('vidljivost', 'gost');
        }
        if ($tipKorisnika == "k") {
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->group_end();
        }

        if ($tipKorisnika == "s") {
            $this->db->group_start();
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
            $this->db->where("idVes in ($wherePretraga)", NULL, FALSE);
            $this->db->group_end();
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda kojom dohvatamo sve vesti u okviru kreirane grupe korisnika
     * @param type $idGru
     * @return type array
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

    /**
     * metoda kojom dohvatamo vest koja je selektovana i otvara se u posebnom prozoru
     * @param type $idVes
     * @return type array
     */
    public function dohvatiJednuVest($idVes) {

        $this->db->select('vesti.*, korisnik.korisnicko as korisnik')
                ->from('vesti')
                ->join('korisnik', 'korisnik.idKor = vesti.autor')
                ->where('vesti.idVes', $idVes);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda kojom korisnik dodaje novu vest
     * @param type $idKor
     * @param type $kategorija
     * @param type $naziv
     * @param type $tekst
     * @param type $vidljivost
     * @param type $vidljivostGrupa
     * @param type $vidljivostKurs
     * @return type array
     */
    public function dodajVest($idKor, $kategorija, $naziv, $tekst, $vidljivost, $vidljivostGrupa, $vidljivostKurs) {

        $this->db->set('autor', $idKor);
        $this->db->set('kategorija', $kategorija);
        $this->db->set('naziv', $naziv);
        $this->db->set('tekst', $tekst);
        $this->db->set('datum', date('Y-m-d H:m:i'));
        $this->db->set('vidljivost', $vidljivost);
        $this->db->set('vidljivostKurs', $vidljivostKurs);
        $this->db->set('vidljivostGrupa', $vidljivostGrupa);
        $this->db->insert('vesti');
        return $idVes = $this->db->insert_id();
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

    /**
     *
     * metoda za dodavanje nove kategorije na strani administratora
     * @param type $nova_kategorija
     */
    public function dodajKategorijuVesti($nova_kategorija) {

        $this->db->set('naziv', $nova_kategorija);
        $this->db->insert('sifkategorijavesti');
    }

    /**
     * metoda za dohvatanje svih vesti u zavisnosti od prava pristupa po
     * tipu korisnika
     * @param type $tipKorisnika
     * @return type array
     */
    public function dohvatiSveVesti($tipKorisnika) {

        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();
        $this->db->select('idVes')->from('vidivest')->where('idKor', $idKor);
        $wherePretraga = $this->db->get_compiled_select();

        $this->db->select('vesti.*, korisnik.korisnicko as korisnik');
        $this->db->from('vesti');
        $this->db->join('korisnik', 'korisnik.idKor = vesti.autor');
        if ($tipKorisnika == "gost") {
            $this->db->where('vidljivost', 'gost');
        }
        if ($tipKorisnika == "k") {
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->group_end();
        }
        if ($tipKorisnika == "s") {
            $this->db->group_start();
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
            $this->db->where("idVes in ($wherePretraga)", NULL, FALSE);
            $this->db->group_end();
            $this->db->group_end();
        }

        $this->db->order_by('idVes', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dodajVestZaPretragu($idVes, $idKor) {
        $data = [
            "idVes" => $idVes,
            "idKor" => $idKor
        ];

        $this->db->insert("vidivest", $data);
    }

    /**
     * metoda za arhiviranje vesti kojom vest postaje vidljiva samo autoru
     * @param type $idVes
     */
    public function arhivirajVest($idVes) {

        $this->db->set('vidljivost', 'autor')
                ->set('vidljivostGrupa', NULL)
                ->set('vidljivostKurs', NULL)
                ->where('idVes', $idVes)
                ->update('vesti');
    }

    /**
     * metoda kojom se salje zahtev za brisanje vesti administratoru
     * @param type $idVes
     */
    public function traziBrisanje($idVes) {
        $data = ["zaBrisanje" => "da"];
        $this->db->where("idVes", $idVes);
        $this->db->update("vesti", $data);
    }

    /**
     * metoda kojom se dohvataju sve vesti ciji je autor ulogovani korisnik
     */
    public function dohvatiVestiAutora($idKor) {
        $this->db->select('vesti.*, korisnik.korisnicko as korisnik');
        $this->db->from('vesti');
        $this->db->join('korisnik', 'korisnik.idKor = vesti.autor');
        $this->db->where('autor', $idKor);
        $this->db->order_by('datum', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
