<?php

defined('BASEPATH') or exit('no direct access');

class VestiModel extends CI_Model {

    public function dohvatiKategorijeVesti() {
        $this->db->select('sifkategorijavesti.*');
        $this->db->from('sifkategorijavesti');
        $query = $this->db->get();
        return $query->result_array();
    }

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
        $this->db->group_start();
        $this->db->where('vidljivost', 'gost');

        if ($tipKorisnika == "k") {
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
            $this->db->where("idVes in ($wherePretraga)", NULL, FALSE);
            $this->db->group_end();
        }
        $this->db->group_end();
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

    public function dodajKategorijuVesti($nova_kategorija) {

        $this->db->set('naziv', $nova_kategorija);
        $this->db->insert('sifkategorijavesti');
    }

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
        $this->db->where('vidljivost', 'gost');
        if ($tipKorisnika == "k") {
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
            $this->db->where("idVes in ($wherePretraga)", NULL, FALSE);
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

    public function arhivirajVest($idVes) {

        $this->db->set('vidljivost', 'autor')
                ->set('vidljivostGrupa', NULL)
                ->set('vidljivostKurs', NULL)
                ->where('idVes', $idVes)
                ->update('vesti');
    }

    public function traziBrisanje($idVes) {
        $data = ["zaBrisanje" => "da"];
        $this->db->where("idVes", $idVes);
        $this->db->update("vesti", $data);
    }

}
