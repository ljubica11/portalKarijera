  
<?php

/**
 * Description of DiskusijeModel
 * metode za pokretanje diskusija po različitim kategorijama, kreiranje diskusionih grupa, 
 * u okviru kojih se razmenjuju postovi korisnika.
 * @author gordan
 */
defined('BASEPATH') or exit('no direct access');

class DiskusijeModel extends CI_Model {

    /**
     * metoda za dohvatanje kategorija za pokretanje diskusije iz baze podataka
     * @return type array
     */
    public function dohvatiKategorije() {
        $this->db->select('sifkategorijadiskusija.*');
        $this->db->from('sifkategorijadiskusija');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje svih diskusija u zavisnosti od prava pristupa po 
     * tipu korisnika
     * @param type $tipKorisnika
     * @return type array
     */
    public function dohvatiSveDiskusije($tipKorisnika) {

        $idKor = $this->session->userdata('user')['idKor'];


        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();

        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupa = $this->db->get_compiled_select();


        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik');
        $this->db->from('diskusija');
        $this->db->join('korisnik', 'korisnik.idKor = diskusija.autor');


        if ($tipKorisnika == 'gost') {
            $this->db->where('vidljivost', 'gost');
            $this->db->order_by('diskusija.idDis', 'DESC');
        } if ($tipKorisnika == 'k') {
            $this->db->group_start();
            $this->db->where('vidljivost', 'korisnici');
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->group_end();
            $this->db->or_group_start()
                    ->where('vidljivost', 'autor')
                    ->where('autor', $idKor)
                    ->group_end();
            $this->db->order_by('diskusija.idDis', 'DESC');
        }
        if ($tipKorisnika == 's' OR $tipKorisnika == 'a') {
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'korisnici');
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'studenti');
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where("vidljivostKurs in ($whereKurs)", null, false);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where("vidljivostGrupa in ($whereGrupa)", null, false);
            $this->db->group_end();
            $this->db->or_group_start()
                    ->where('vidljivost', 'autor')
                    ->where('autor', $idKor)
                    ->group_end();
            $this->db->order_by('diskusija.idDis', 'DESC');
        
           
        }

        $query = $this->db->get();
         return $query->result_array();
    }

    /**
     * metoda za dovatanje diskusija iz baze podataka po parametru kategorija
     * @param type $idKat
     * @param type $tipKorisnika
     * @return type array
     */
    public function dohvatiDiskusije($idKat, $tipKorisnika) {

        $idKor = $this->session->userdata('user')['idKor'];

        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();

        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupa = $this->db->get_compiled_select();


        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik, sifkategorijadiskusija.idKatDis as idKat, sifkategorijadiskusija.naziv as kategorija');
        $this->db->from('diskusija');
        $this->db->join('korisnik', 'korisnik.idKor = diskusija.autor');
        $this->db->join('sifkategorijadiskusija', 'sifkategorijadiskusija.idKatDis = diskusija.kategorija');

        if ($tipKorisnika == 'gost') {
            $this->db->where('vidljivost', 'gost');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
        }
        if ($tipKorisnika == 'k') {
            $this->db->group_start();
            $this->db->where('vidljivost', 'korisnici');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->group_end();
            $this->db->or_group_start()
                    ->where('vidljivost', 'autor')
                    ->where('autor', $idKor)
                    ->group_end();
            $this->db->order_by('diskusija.idDis', 'DESC');
        }
        if ($tipKorisnika == 's') {
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'korisnici');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'studenti');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->where("vidljivostKurs in ($whereKurs)", null, false);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
            $this->db->where("vidljivostGrupa in ($whereGrupa)", null, false);
            $this->db->group_end();
            $this->db->or_group_start()
                    ->where('vidljivost', 'autor')
                    ->where('sifkategorijadiskusija.idKatDis', $idKat)
                    ->where('autor', $idKor)
                    ->group_end();
           }
        $this->db->order_by('diskusija.idDis', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dohvatiJednuDiskusiju($idDis) {

        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik')
                ->from('diskusija')
                ->join('korisnik', 'korisnik.idKor = diskusija.autor')
                ->where('diskusija.idDis', $idDis);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje diskusija u okviru odredjene grupe sa razlicitim
     * pravima pristupa u zavisnosti od tipa korisnika
     * @param type $idGru
     * @param type $tipKorisnika
     * @return type
     */
    public function dohvatiDiskusijeGrupe($idGru, $tipKorisnika) {

        $idKor = $this->session->userdata('user')['idKor'];
        
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupa = $this->db->get_compiled_select();

        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik');
        $this->db->from('diskusija');
        $this->db->join('korisnik', 'korisnik.idKor = diskusija.autor');
        $this->db->join('sadrzidiskusije', 'sadrzidiskusije.idDisk = diskusija.idDis');
        $this->db->join('grupe', 'grupe.idGru = sadrzidiskusije.idGrupe' );
         $this->db->where('grupe.idGru', $idGru);
      
        

        if ($tipKorisnika == 's') {
           
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->where('grupe.idGru', $idGru);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'korisnici');
            $this->db->where('grupe.idGru', $idGru);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'studenti');
            $this->db->where('grupe.idGru', $idGru);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where('grupe.idGru', $idGru);
            $this->db->where("vidljivostKurs in ($whereKurs)", null, false);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where('grupe.idGru', $idGru);
            $this->db->where("vidljivostGrupa in ($whereGrupa)", null, false);
            $this->db->group_end();
            $this->db->or_group_start()
                    ->where('vidljivost', 'autor')
                    ->where('grupe.idGru', $idGru)
                    ->where('autor', $idKor)
                    ->group_end();   
        }
        
        $this->db->order_by('diskusija.idDis', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje svih kreiranih grupa korisnika
     * potrebna za metodu ispisiOpcije u kontroleru Diskusije
     * @return type array
     */
    public function dohvatiGrupe() {
        $query = $this->db->get('grupe');
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje postova odredjene diskusije iz baze podataka
     * @param type $diskusija
     * @return type array
     */
    public function dohvatiPostove($diskusija) {
        $this->db->select('postdiskusija.tekst, korisnik.korisnicko as "korisnik", postdiskusija.poslatoDatum as "datum", postdiskusija.brLajkova, postdiskusija.idPos');
        $this->db->from('postdiskusija');
        $this->db->join('diskusija', 'diskusija.idDis = postdiskusija.diskusija');
        $this->db->join('korisnik', 'korisnik.idKor = postdiskusija.posiljalac');
        $this->db->where('postdiskusija.diskusija', $diskusija);
        $this->db->order_by('postdiskusija.poslatoDatum', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * medota za dohvatanje svih postova odredjenog korisnika
     * @param type $idKor
     * @return type array
     */
    public function dohvatiPostoveKorisnika($idKor) {
        $this->db->select('postdiskusija.tekst as tekst, postdiskusija.poslatoDatum as datum, diskusija.naziv as naziv');
        $this->db->from('postdiskusija');
        $this->db->join('diskusija', 'diskusija.idDis = postdiskusija.diskusija');
        $this->db->where('postdiskusija.posiljalac', $idKor);
        $this->db->group_by('postdiskusija.idPos');
        $this->db->order_by('postdiskusija.poslatoDatum', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dodavanje posta korisnika u diskusiju
     * @param type $idKor
     * @param type $idDis
     * @param type $tekst
     */
    public function dodajPost($idKor, $idDis, $tekst) {
        $this->db->set('posiljalac', $idKor);
        $this->db->set('diskusija', $idDis);
        $this->db->set('tekst', $tekst);
        $this->db->set('poslatoDatum', date("Y-m-d H:i:s"));
        $this->db->insert('postdiskusija');
    }

    /**
     * metoda za kreiranje diskusije
     * @param type $idKor
     * @param type $kategorija
     * @param type $naziv
     * @param type $opis
     * @param type $vidljivost
     * @param type $vidljivostKurs
     * @param type $vidljivostGrupa
     */
    public function dodajDiskusiju($idKor, $kategorija, $naziv, $opis, $vidljivost, $vidljivostKurs, $vidljivostGrupa, $zaBrisanje) {
        $this->db->set('autor', $idKor);
        $this->db->set('kategorija', $kategorija);
        $this->db->set('naziv', $naziv);
        $this->db->set('opis', $opis);
        $this->db->set('datum', date('Y-m-d H:i:s'));
        $this->db->set('vidljivost', $vidljivost);
        $this->db->set('vidljivostKurs', $vidljivostKurs);
        $this->db->set('vidljivostGrupa', $vidljivostGrupa);
        $this->db->set('zaBrisanje', $zaBrisanje);
        $this->db->insert('diskusija');
     
    }

    /**
     * metoda za kreiranje diskusije u okviru odredjene grupe
     * @param type $idDis
     * @param type $idGru
     */
    public function dodajDiskusijuGrupe($idDis, $idGru) {
        $this->db->set('idDisk', $idDis);
        $this->db->set('idGrupe', $idGru);
        $this->db->insert('sadrzidiskusije');
        
    }

    /**
     * metoda za dodavanje kategorije diskusije
     * @param type $naziv
     */
    public function dodajKategoriju($naziv) {
        $this->db->set('naziv', $naziv);
        $this->db->insert('sifkategorijadiskusija');
    }

    public function zaBrisanje($idDis) {

        $data = ["zaBrisanje" => "da"];
        $this->db->where("idDis", $idDis);
        $this->db->update("diskusija", $data);
    }

    public function arhivirajDiskusiju($idDis) {

        $this->db->set('vidljivost', 'autor')
                ->set('vidljivostGrupa', NULL)
                ->set('vidljivostKurs', NULL)
                ->set('zaBrisanje', NULL)
                ->where('idDis', $idDis)
                ->update('diskusija');
    }

    /**
     * metoda za dohvatanje lajkova po odredjenom postu korisnika
     * @param type $idPos
     * @return type array
     */
    public function dohvatiLajkove($idPos) {
        $this->db->select('brLajkova');
        $this->db->from('postdiskusija');
        $this->db->where('idPos', $idPos);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dodavanje korisničkih lajkova na post
     * @param type $brLajkova
     * @param type $idPos
     */
    public function dodajLajk($brLajkova, $idPos) {
        $data = array('brLajkova' => $brLajkova);
        $this->db->where('idPos', $idPos);
        $this->db->update('postdiskusija', $data);
    }

}
