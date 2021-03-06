<?php

/**
 * Description of izvestajiModel
 *
 * model za funkcionalnost izvestaji
 * metode za dohvatanje iz baze svih tabela vezanih za korisnicke aktivnosti 
 * na sajtu u cilju njihove statisticke obrade i generisanja izvestaja
 * 
 * @author gordan
 */
class IzvestajiModel extends CI_Model {

    public function brojDiskusija($datumOd, $datumDo) {

        $this->db->select('diskusija.idDis')
                ->from('diskusija');


        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function brojPostova($datumOd, $datumDo) {

        $this->db->select('postdiskusija.idPos')
                ->from('postdiskusija');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('poslatoDatum >=', $datumOd);
            $this->db->where('poslatoDatum <=', $datumDo);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function brojGrupa($datumOd, $datumDo) {

        $this->db->select('grupe.idGru')
                ->from('grupe');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function brojOglasa($datumOd, $datumDo) {

        $this->db->select('oglasi.idOgl')
                ->from('oglasi');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('vremePostavljanja <=', $datumDo);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function brojVesti($datumOd, $datumDo) {

        $this->db->select('vesti.idVes')
                ->from('vesti');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function brojObavestenja($datumOd, $datumDo) {

        $this->db->select('obavestenja.idOba')
                ->from('obavestenja');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function diskusijeVidljivost($datumOd, $datumDo) {

        $this->db->select('diskusija.idDis')
                ->from('diskusija');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('diskusija.vidljivost');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function oglasiVidljivost($datumOd, $datumDo) {

        $this->db->select('oglasi.idOgl')
                ->from('oglasi');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('oglasi.vidljivost');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function vestiVidljivost($datumOd, $datumDo) {

        $this->db->select('vesti.idVes')
                ->from('vesti');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vesti.vidljivost');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
     public function obavestenjaVidljivost($datumOd, $datumDo) {

        $this->db->select('obavestenja.idOba')
                ->from('obavestenja');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('obavestenja.vidljivost');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    public function arhiviraneDiskusije($datumOd, $datumDo){
        
         $this->db->select('idDis')
                ->from('diskusija');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vidljivost', 'autor');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
    public function kursDiskusije($datumOd, $datumDo){
        
         $this->db->select('idDis')
                ->from('diskusija');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vidljivostKurs is NOT NULL', NULL, FALSE);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
    public function grupeDiskusije($datumOd, $datumDo){
        
         $this->db->select('idDis')
                ->from('diskusija');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vidljivostGrupa is NOT NULL', NULL, FALSE);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
     public function korisniciDiskusije($datumOd, $datumDo){
        
         $this->db->select('idDis')
                ->from('diskusija');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vidljivost', 'korisnici');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
    public function kursOglasi($datumOd, $datumDo){
        
        $this->db->select('oglasi.idOgl')
                ->from('oglasi');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('oglasi.vidljivost', 'kurs');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
    public function grupaOglasi($datumOd, $datumDo){
        
        $this->db->select('oglasi.idOgl')
                ->from('oglasi');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('oglasi.vidljivost', 'grupa');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
     public function sviOglasi($datumOd, $datumDo){
        
        $this->db->select('oglasi.idOgl')
                ->from('oglasi');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('vremePostavljanja >=', $datumOd);
            $this->db->where('oglasi.vidljivost');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
     public function kursVesti($datumOd, $datumDo) {

        $this->db->select('vesti.idVes')
                ->from('vesti');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vesti.vidljivostKurs is NOT NULL', NULL, FALSE);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
     public function grupaVesti($datumOd, $datumDo) {

        $this->db->select('vesti.idVes')
                ->from('vesti');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vesti.vidljivostGrupa is NOT NULL', NULL, FALSE);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
    public function pretragaVesti($datumOd, $datumDo) {

        $this->db->select('vesti.idVes')
                ->from('vesti');
        if (!empty($datumOd) AND ! empty($datumDo)) {
            $this->db->where('datum >=', $datumOd);
            $this->db->where('datum <=', $datumDo);
            $this->db->where('vesti.vidljivost', 'pretraga');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    
    /**
     * email lista administratora sajta
     * @return type array
     */
    
     public function mejlAdmini(){
        
        $this->db->select('email')
                ->from('korisnik')
                ->where('tip', 'a');       
        $query = $this->db->get();
        return $query->result_array();
    }
    
   
}
