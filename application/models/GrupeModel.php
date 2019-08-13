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
     * @return type array
     */
    public function dodajNovuGrupu($naziv, $opis) {

        $data = ['naziv' => $naziv, 'opis' => $opis];
        $this->db->insert('grupe', $data);
        $query = $this->db->get('grupe');
        return $query->result_array();
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
    
    /**
     * metode za dohvatanje stuudenta po cetiri parametra uz and uslov
     * @param type $idGra
     * @param type $idKurs
     * @param type $idVes
     * @param type $idFak
     * @return type array
     */

    public function upiti($idGra, $idKurs, $idVes, $idFak) {


        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
                ->join('imavestine', 'imavestine.idKor = student.idKor')
                ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('imavestine.idVes', $idVes)
                ->where('student.mesto', $idGra)
                ->where('student.idKurs', $idKurs)
                ->where('siffakulteti.idFak', $idFak);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function upitiBezGrada($idVes, $idKurs, $idFak) {



        $this->db->select('student.*')
                ->from('student')
                ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
                ->join('imavestine', 'imavestine.idKor = student.idKor')
                ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('imavestine.idVes', $idVes)
                ->where('student.idKurs', $idKurs)
                ->where('siffakulteti.idFak', $idFak);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function upitiBezKursa($idGra, $idVes, $idFak) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('imavestine', 'imavestine.idKor = student.idKor')
                ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('imavestine.idVes', $idVes)
                ->where('student.mesto', $idGra)
                ->where('siffakulteti.idFak', $idFak);


        $query = $this->db->get();
        return $query->result_array();
    }

    public function upitiBezVestina($idGra, $idKurs, $idFak) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('student.mesto', $idGra)
                ->where('student.idKurs', $idKurs)
                ->where('siffakulteti.idFak', $idFak);


        $query = $this->db->get();
        return $query->result_array();
    }

    public function upitiBezFakulteta($idGra, $idKurs, $idVes) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
                ->join('imavestine', 'imavestine.idKor = student.idKor')
                ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
                ->where('student.mesto', $idGra)
                ->where('student.idKurs', $idKurs)
                ->where('imavestine.idVes', $idVes);


        $query = $this->db->get();
        return $query->result_array();
    }

    public function VestineFakultet($idVes, $idFak) {

        $this->db->select('student.*')
                ->from('student')
                ->join('imavestine', 'imavestine.idKor = student.idKor')
                ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('imavestine.idVes', $idVes)
                ->where('siffakulteti.idFak', $idFak);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function KursFakultet($idKurs, $idFak) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('student.idKurs', $idKurs)
                ->where('siffakulteti.idFak', $idFak);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function KursVestine($idKurs, $idVes) {

        $this->db->select('student.*')
        ->from('student')
        ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
        ->join('imavestine', 'imavestine.idKor = student.idKor')
        ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
        ->where('student.idKurs', $idKurs)
        ->where('imavestine.idVes', $idVes);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GradFakultet($idGra, $idFak) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('diploma', 'diploma.idKor = student.idKor')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('student.mesto', $idGra)
                ->where('siffakulteti.idFak', $idFak);



        $query = $this->db->get();
        return $query->result_array();
    }

    public function GradVestine($idGra, $idVes) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('imavestine', 'imavestine.idKor = student.idKor')
                ->join('sifvestine', 'imavestine.idVes = sifvestine.idVes')
                ->where('student.mesto', $idGra)
                ->where('imavestine.idVes', $idVes);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function GradKurs($idGra, $idKurs) {

        $this->db->select('student.*')
                ->from('student')
                ->join('sifgradovi', 'sifgradovi.idGra = student.mesto')
                ->join('sifkurs', 'sifkurs.idKurs = student.idKurs')
                ->where('student.mesto', $idGra)
                ->where('student.idKurs', $idKurs);

        $query = $this->db->get();
        return $query->result_array();
    }

}
