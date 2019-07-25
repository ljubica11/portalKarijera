<?php


class SifrarniciModel extends CI_Model{
    
    public function dohvatiKurs(){
        $query = $this->db->get('sifkurs');
        return $query->result_array();
    }
    
    public function dohvatiDrz(){
        $query = $this->db->get('sifdrzavljanstvo');
        return $query->result_array();
    }
    
    public function dohvatiMesto(){
        $query = $this->db->get('sifgradovi');
        return $query->result_array();
    }
    
    public function dohvatiInteresovanja(){
        $query = $this->db->get('sifinteresovanja');
        return $query->result_array();
    }
    
    public function dohvatiVestine(){
        $query = $this->db->get('sifvestine');
        return $query->result_array();
    }
    
    public function dohvatiFakultete(){
        $query = $this->db->get('siffakulteti');
        return $query->result_array();
    }
    
    public function dohvatiUniverzitete(){
        $query = $this->db->get('sifuniverziteti');
        return $query->result_array();
    }
    
    public function dohvatiPozicije(){
        $query = $this->db->get('sifpozicija');
        return $query->result_array();
    }   
    
    public function dohvatiKompanije(){
        $query = $this->db->get('sifkompanija');
        return $query->result_array();
    }


    public function dodajNovaInteresovanja($inter){
        $data = ["naziv" => $inter];
        $this->db->insert("sifinteresovanja", $data);
        $query = $this->db->get_where('sifinteresovanja', array('naziv' => $inter));
        return $query->result_array();
    }
    
       public function dodajNoveVestine($vestina){
        $data = ["naziv" => $vestina];
        $this->db->insert("sifvestine", $data);
        $query = $this->db->get_where('sifvestine', array('naziv' => $vestina));
        return $query->result_array();
    }
    
     public function dodajNovoMesto($novoMesto){
        $data = ["naziv" => $novoMesto];
        $this->db->insert("sifgradovi", $data);
        $query = $this->db->get('sifgradovi');
        return $query->result_array();
    }
    
    public function dodajNoviFakultet($noviFakultet){
        $data = ["naziv" => $noviFakultet];
        $this->db->insert("siffakulteti", $data);
        $query = $this->db->get("siffakulteti");
        return $query->result_array();
    }
    
    public function dodajNovuKompaniju($novaKompanija){
        $data = ["naziv" => $novaKompanija];
        $this->db->insert('sifkompanija', $data);
        $query = $this->db->get("sifkompanija");
        return $query->result_array();
    }
    
    public function dodajNovuPoziciju($novaPozicija){
        $data = ["naziv" => $novaPozicija];
        $this->db->insert('sifpozicija', $data);
        $query = $this->db->get("sifpozicija");
        return $query->result_array();
    }
}
