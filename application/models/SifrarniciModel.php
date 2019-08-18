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
    
    
    public function dohvatiKategorijeVesti(){
        $query = $this->db->get('sifkategorijavesti');
        return $query->result_array();
    }
    
    public function dohvatiKategorijeDiskusija(){
      $query = $this->db->get('sifkategorijadiskusija');
      return $query->result_array();
    }
    
    public function obrisiMesto($id){
        $this->db->where('idGra', $id);
        $this->db->delete('sifgradovi');
    }
    
    public function obrisiDrzavljanstvo($id){
        $this->db->where('idDrz', $id);
        $this->db->delete('sifdrzavljanstvo');
    }
    
    public function obrisiFakultet($id){
        $this->db->where('idFak', $id);
        $this->db->delete('siffakulteti');
    }
    
    public function obrisiKompaniju($id){
        $this->db->where('idSifKo', $id);
        $this->db->delete('sifkompanija');
    }
    
    public function obrisiPoziciju($id){
        $this->db->where('idPoz', $id);
        $this->db->delete('sifpozicija');
    }
    
    public function obrisiInteresovanje($id){
        $this->db->where('idInt', $id);
        $this->db->delete('sifinteresovanja');
    }
    
    public function obrisiVestinu($id){
        $this->db->where('idVes', $id);
        $this->db->delete('sifvestine');
    }
    
    public function obrisiKatVesti($id){
        $this->db->where('idKatVesti', $id);
        $this->db->delete('sifkategorijavesti');
    }
    
    public function obrisiKatDiskusije($id){
        $this->db->where('idKatDis', $id);
        $this->db->delete('sifkategorijadiskusija');
    }
    
    public function izmeniMesto($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idGra', $id);
        $this->db->update('sifgradovi');
    }
    
    public function izmeniDrzavljanstvo($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idDrz', $id);
        $this->db->update('sifdrzavljanstvo');    
        
    }
    
    public function izmeniFakultet($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idFak', $id);
        $this->db->update('siffakulteti');    
    }
    
    public function izmeniKompaniju($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idSifKo', $id);
        $this->db->update('sifkompanija');
    }
    
    public function izmeniPoziciju($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idPoz', $id);
        $this->db->update('sifpozicija');
    }
    
    public function izmeniInteresovanje($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idInt', $id);
        $this->db->update('sifinteresovanja');
    }
    
    public function izmeniVestinu($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idVes', $id);
        $this->db->update('sifvestine');
    }
    
    public function izmeniKatVesti($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idKatVesti', $id);
        $this->db->update('sifkategorijavesti');
    }
    
    public function izmeniKatDiskusije($id, $izmena){
        $this->db->set('naziv', $izmena);
        $this->db->where('idKatDis', $id);
        $this->db->update('sifkategorijadiskusija');
    }
    
    public function dodajDrzavljanstvo($drz){
        $data = ["naziv" => $drz];
        $this->db->insert('sifdrzavljanstvo', $data);
    }
}
