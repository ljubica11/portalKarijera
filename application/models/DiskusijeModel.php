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
    
    public function dohvatiKategorije(){
        
       $this->db->select('sifkategorijadiskusija.*');
       $this->db->from('sifkategorijadiskusija');
       $query = $this->db->get();
       return $query -> result_array();
        
    }
    
    public function dohvatiSveDiskusije(){
        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik')
                ->from('diskusija')
                ->join('korisnik', 'korisnik.idKor = diskusija.autor')
                ->order_by('diskusija.idDis', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
                
    }
    
    /**
     * metoda za dovatanje diskusija iz baze podataka
     * @param type $idKat
     * @return type array
     */

    public function dohvatiDiskusije($idKat) {

        $this->db->from('diskusija');
        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik, sifkategorijadiskusija.idKatDis as idKat, sifkategorijadiskusija.naziv as kategorija');
        $this->db->join('korisnik', 'korisnik.idKor = diskusija.autor');
        $this->db->join('sifkategorijadiskusija', 'sifkategorijadiskusija.idKatDis = diskusija.kategorija');
        $this->db->where('sifkategorijadiskusija.idKatDis', $idKat);
        $query = $this->db->get();
        return $query -> result_array();
            
    }
    
    public function dohvatiJednuDiskusiju($idDis){
        
        $this->db->select('diskusija.*, korisnik.korisnicko as korisnik')
                ->from('diskusija')
                ->join('korisnik', 'korisnik.idKor = diskusija.autor')
                ->where('diskusija.idDis', $idDis);
        $query = $this->db->get();
        return $query -> result_array();
    }

        /**
      * metoda za dohvatanje diskusija u okviru odredjene grupe
      * @param type $idGru
      * @return type
      */
    public function dohvatiDiskusijeGrupe($idGru){
        
        $this->db->select('diskusija.*, korisnik.korisnicko');
        $this->db->from('diskusija');
        $this->db->join('korisnik', 'korisnik.idKor = diskusija.autor');
        $this->db->join('sadrzidiskusije', 'sadrzidiskusije.idDisk = diskusija.idDis');
        $this->db->where('sadrzidiskusije.idGrupe', $idGru);
        $query = $this->db->get();
        return $query ->result_array();
    }

        /**
     * metoda za dohvatanje postova odredjene diskusije iz baze podataka
     * @param type $diskusija
     * @return type array
     */
    public function dohvatiPostove($diskusija){
        
        $this->db->select('postdiskusija.tekst, korisnik.korisnicko as "korisnik", postdiskusija.poslatoDatum as "datum", postdiskusija.brLajkova, postdiskusija.idPos');
        $this->db->from('postdiskusija');
        $this->db->join('diskusija', 'diskusija.idDis = postdiskusija.diskusija');
        $this->db->join('sifkategorijadiskusija', 'sifkategorijadiskusija.idKatDis = diskusija.kategorija');
        $this->db->join('korisnik', 'korisnik.idKor = postdiskusija.posiljalac');
        $this->db->where('postdiskusija.diskusija', $diskusija);
        $this->db->order_by('postdiskusija.poslatoDatum', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
      
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
        return $query -> result_array();
     
    }
    
    /**
     * metoda za dodavanje posta korisnika u diskusiju
     * @param type $idKor
     * @param type $idDis
     * @param type $tekst
     */
    
    public function dodajPost($idKor, $idDis, $tekst ){
         
        $this->db->set('posiljalac', $idKor);
        $this->db->set('diskusija', $idDis);
        $this->db->set('tekst', $tekst);
        $this->db->set('poslatoDatum', date("Y-m-d H:i:s"));
        $this->db->insert('postdiskusija');
         
    }
    
    /**
     * metoda za kreiranje diskusione grupe po odredjenoj kategoriji
     * @param type $idKor
     * @param type $kategorija
     * @param type $naziv
     * @param type $opis
     */
    public function dodajDiskusiju($idKor, $kategorija, $naziv, $opis){
        
        $this->db->set('autor', $idKor);
        $this->db->set('kategorija', $kategorija);
        $this->db->set('naziv', $naziv);
        $this->db->set('opis', $opis);
        $this->db->set('datum', date('Y-m-d H:i:s'));
        $this->db->insert('diskusija');
                
    }
    
    /**
     * metoda za kreiranje diskusije u okviru odredjene grupe
     * @param type $idDisk
     * @param type $idGrupe
     */
    public function dodajDiskusijuGrupe($idDisk, $idGrupe){
        
        $this->db->set('idDisk', $idDisk);
        $this->db->set('idGrupe', $idGrupe);
        $this->db->insert('sadrzidiskusije');
    }
    
    /**
     * metoda za dodavanje kategorije diskusije
     * @param type $naziv
     */
    
    public function dodajKategoriju($naziv){
        
        $this->db->set('naziv', $naziv);
        $this->db->insert('sifkategorijadiskusija');
    }
    
    /**
     * metoda za dohvatanje lajkova po odredjenom postu korisnika
     * @param type $idPos
     * @return type array
     */
    public function dohvatiLajkove($idPos){
        
        $this->db->select('brLajkova');
        $this->db->from('postdiskusija');
        $this->db->where('idPos', $idPos);
        $query = $this->db->get();
        return $query -> result_array();
               
    }
    
    /**
     * metoda za dodavanje korisničkih lajkova na post
     * @param type $brLajkova
     * @param type $idPos
     */


    public function dodajLajk($brLajkova, $idPos){
        
        $data = array('brLajkova' => $brLajkova);
        $this->db->where('idPos', $idPos);
        $this->db->update('postdiskusija', $data);
           
    }

}
