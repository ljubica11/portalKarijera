<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of StatistikaModel
 *
 * @author gordan
 */
defined('BASEPATH') or exit('no direct access');

class StatistikaModel extends CI_Model {

    public function diploma($idFak) {

        $this->db->from('diploma')
                ->join('siffakulteti', 'siffakulteti.idFak = diploma.idFak')
                ->where('diploma.idFak', $idFak);

        return $this->db->count_all_results();
    }


    public function zaposleniStudenti() {

        $query = $this->db->query('select count(*) as "broj zaposlenih"
                                    from student
                                    where student.status = "zaposleni"');

        return $query->result_array();
    }

    public function nezaposleniStudenti() {

        $query = $this->db->query('select count(*) as "broj nezaposlenih"
                                    from student
                                    where student.status = "nezaposleni"');
        return $query->result_array();
    }

    public function phpkurs() {

        $this->db->select("count(*) as 'kurs' ")
                ->from('student')
                ->where('student.idKurs = 1');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function javakurs() {


        $this->db->select("count(*) as 'kurs' ")
                ->from('student')
                ->where('student.idKurs = 2');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function linuxkurs() {

        $this->db->select("count(*) as 'kurs' ")
                ->from('student')
                ->where('student.idKurs = 3');

        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function mejlLista(){
        
        $this->db->select('email','korisnicko')
                ->from('korisnik')
                ->where('tip', 'k')
                ->where('vidljivostEmail');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    public function mejlAdmini(){
        
        $this->db->select('email', 'idKor')
                ->from('korisnik')
                ->where('tip', 'a');       
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
}
