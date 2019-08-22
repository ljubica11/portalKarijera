<?php

/**
 * Description of GrupeModel
 * metode za dohvatanje korisnika po različitim šifrarnicima za potrebe funkcionalnosti "Grupe",
 * kreiranje grupa i dodavanje korisnika po različitim parametrima
 * @author gordan
 */
defined('BASEPATH') or exit('no direct access');

class GrupeModel extends CI_Model {

    /**
     * metoda za dohvatanje studenata po mestu prebivalista
     * 
     * @param type $idGra
     * @return type array
     */
    public function dohvatiStudenteGrad($idGra) {

        $this->db->select('student.*');
        $this->db->from('student');
        $this->db->join('sifgradovi', 'sifgradovi.idGra = student.mesto');
        $this->db->where('student.mesto', $idGra);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje studenata po zavrsenom kursu
     * @param type $idKurs
     * @return type array
     */
    public function dohvatiStudenteKurs($idKurs) {

        $this->db->select('student.*');
        $this->db->from('student');
        $this->db->join('sifkurs', 'sifkurs.idKurs = student.idKurs');
        $this->db->where('student.idKurs', $idKurs);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * 
     * metoda za dohvatanje studenata po vestinama
     * @param type $idVes
     * @return type array
     * 
     */
    public function dohvatiStudenteVestine($idVes) {

        $this->db->select('student.*');
        $this->db->from('student');
        $this->db->join('imavestine', 'imavestine.idKor = student.idKor');
        $this->db->join('sifvestine', 'imavestine.idVes = sifvestine.idVes');
        $this->db->where('imavestine.idVes', $idVes);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje studenata po interesovanjima
     * @param type $idInt
     * @return type array
     */
    public function dohvatiStudenteInteresovanja($idInt) {

        $this->db->select('student.*');
        $this->db->from('student');
        $this->db->join('imainteresovanja', 'imainteresovanja.idKor = student.idKor');
        $this->db->join('sifinteresovanja', 'sifinteresovanja.idInt = imainteresovanja.idInt');
        $this->db->where('imainteresovanja.idInt', $idInt);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * metoda za dohvatanje studenata po zavrsenim studijama
     * @param type $idFak
     * @return type array
     */
    public function dohvatiStudenteFakultet($idFak) {

        $this->db->select('student.*');
        $this->db->from('student');
        $this->db->join('diploma', 'diploma.idKor = student.idKor');
        $this->db->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak');
        $this->db->where('siffakulteti.idFak', $idFak);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * 
     * dohvatanje svih grupa iz baze
     * @return type array
     */
    public function dohvatiGrupe() {

        $this->db->select('grupe.*');
        $this->db->from('grupe');
        $this->db->order_by('idGru', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * dohvatanje jedne odredjene grupe
     * @param type $idGru
     * @return type array
     */
    public function dohvatiJednuGrupu($idGru) {

        $this->db->select('grupe.*');
        $this->db->from('grupe');
        $this->db->where('idGru', $idGru);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * dohvatanje svih clanova odredjene grupe
     * @param type $idGru
     * @return type array
     */
    public function dohvatiClanove($idGru) {

        $this->db->select('clanovigrupe.idKor, student.ime, student.prezime');
        $this->db->from('clanovigrupe');
        $this->db->join('student', 'student.idKor = clanovigrupe.idKor');
        $this->db->where('clanovigrupe.idGru', $idGru);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * dodavanje grupe u bazu podataka
     * @param type $naziv
     * @param type $opis
     * @return type 
     */
    public function dodajNovuGrupu($naziv, $opis, $zaBrisanje) {

        $data = ['naziv' => $naziv, 'opis' => $opis, 'datum' => date('Y-m-d H:m:i'), 'zaBrisanje' => $zaBrisanje];
        $this->db->insert('grupe', $data);
       
        return $maxIdGrupe = $this->db->insert_id();
    }

    /**
     * dodavanje studenta u grupu uz proveru da li je vec clan grupe
     * @param type $idGru
     * @param type $idKor
     */
    public function dodajStudente($idGru, $idKor) {

        $query = $this->db->get_where('clanovigrupe', ['idGru' => $idGru, 'idKor' => $idKor]);
        $count = $query->num_rows();
        if ($count == 0) {
            $data = ['idGru' => $idGru,
                'idKor' => $idKor];


            $this->db->insert('clanovigrupe', $data);
        }
    }

    /**
     * brisanje korisnika iz grupe
     * @param type $idGru
     * @param type $idKor
     */
    public function obrisiStudente($idGru, $idKor) {

        $data = ['idGru' => $idGru, 'idKor' => $idKor];
        $this->db->delete('clanovigrupe', $data);
    }

    public function dohvatiStudenta($idKor) {

        $this->db->select('student.*')
                ->from('student')
                ->where('idKor', $idKor);
        $query = $this->db->get();
        return $query->result_array();
    }
     
    public function status(){
        
        $this->db->select('status')
                          ->from('student');
        $query = $this->db->get();
        return $query ->result_array;
        
        
    }
    
    public function upiti($grad, $kurs, $fakultet, $vestine, $interesovanja, $status){
        
        $this->db->select('ime, prezime, student.idKor as idKor');
        $this->db->from('student');
    
        if(!empty($grad)){
            $this->db->where('mesto', $grad);   
        }
        if(!empty($fakultet)){
            $this->db->from('diploma');
            $this->db->where("diploma.idFak", $fakultet);
            $this->db->where("student.idKor = diploma.idKor");
            $this->db->where("diploma.vidljivost", NULL);
        }
        if(!empty($kurs)){
            $this->db->where('idKurs', $kurs);
        }
   
        if(!empty($vestine)){
            $this->db->from('imavestine');
            $this->db->where('imavestine.idVes', $vestine);
            $this->db->where("student.idKor = imavestine.idKor");
        }
        if(!empty($interesovanja)){
           $this->db->from('imainteresovanja');
           $this->db->where('imainteresovanja.idInt', $interesovanja);
           $this->db->where("student.idKor = imainteresovanja.idKor");
        }
        if(!empty($status)){
            $this->db->where('status', $status);
        }
        
        $query=$this->db->get();
        return $query->result_array ();
    }
    
      public function zaBrisanje($idGru) {

        $data = ["zaBrisanje" => "da"];
        $this->db->where("idGru", $idGru);
        $this->db->update("grupe", $data);
    }

    

}
