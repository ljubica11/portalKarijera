<?php

class PretragaModel extends CI_Model{
    
    public function pretragaStudenata($ime, $prezime, $mesto, $faks, $kurs, $int, $ves){
       
        $this->db->select('ime, prezime, student.idKor as idKor');
        $this->db->from('student');
        if(!empty($ime)){
            $this->db->like('ime', $ime);
        }
        if(!empty($prezime)){
            $this->db->like('prezime', $prezime);
        }
        if(!empty($mesto)){
            $this->db->where('mesto', $mesto);   
        }
        if(!empty($faks)){
            $this->db->from('diploma');
            $this->db->where("diploma.idFak", $faks);
            $this->db->where("student.idKor = diploma.idKor");
        }
        if(!empty($kurs)){
            $this->db->where('idKurs', $kurs);
        }
        if(!empty($int)){
            $this->db->from('imainteresovanja');
            $this->db->where('imainteresovanja.idInt', $int);
            $this->db->where("student.idKor = imainteresovanja.idKor");
        }
        if(!empty($ves)){
            $this->db->from('imavestine');
            $this->db->where('imavestine.idVes', $ves);
            $this->db->where("student.idKor = imavestine.idKor");
        }
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function pretragaKompanija($naziv, $oblast, $mesto){
        $this->db->select('naziv, idKor');
        $this->db->from('kompanija');
        if(!empty($naziv)){
            $this->db->like('naziv', $naziv);
        }
        if(!empty($oblast)){
            $this->db->like('oblastDelovanja', $oblast);
        }
        if(!empty($mesto)){
            $this->db->where('sediste', $mesto);
        }
        $query=$this->db->get();
        return $query->result_array ();
    }
   
}
