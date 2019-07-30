<?php


class OglasiModel extends CI_Model{
    
    public function dohvatiSveOglase(){
        $this->db->select('oglasi.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
        $this->db->order_by('vremePostavljanja', 'DESC');
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function dohvatiOglaseKorisnika($idKor){
        $this->db->select('oglasi.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
        $this->db->where('oglasi.autor', $idKor);
        $this->db->order_by('vremePostavljanja', 'DESC');
        $query=$this->db->get();
        return $query->result_array ();
    }
    
    public function dohvatiJedanOglas($idOgl){
        $this->db->select('oglasi.*, sifgradovi.naziv as grad, kompanija.naziv as kompanija, kompanija.sajt as sajt, kompanija.opis as kopis');
        $this->db->from('oglasi');
        $this->db->join('sifgradovi', 'oglasi.mesto = sifgradovi.idGra');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor', 'left');
        $this->db->where('idOgl', $idOgl);
        $query=$this->db->get();
        return $query->result_array ();
    }

        public function dodajNoviOglas($idKor, $naslov, $grad, $vremeIst, $opis, $plata, $placanje, $obaveze, $uslovi, $ponuda, $pozicija){
        $data = [
            "naslov" => $naslov,
            "vremePostavljanja" =>  date("Y-m-d H:i:s"),
            "vremeIsticanja" => $vremeIst,
            "autor" => $idKor,
            "opis" => $opis,
            "uslovi" => $uslovi,
            "ponuda" => $ponuda,
            "obaveze" => $obaveze,
            "plata" => $plata,
            "nacinPlacanja" => $placanje,
            "mesto" => $grad,
            "pozicija" => $pozicija
        ];
        
        $this->db->insert("oglasi", $data);
        return $noviIdOgl = $this->db->insert_id();
    }
    
    public function pretragaOglasa($rec, $grad){
        if(!empty($rec) and empty($grad)){
            $this->db->select('naslov, idOgl, oglasi.opis, kompanija.naziv ');
            $this->db->from('oglasi');
            $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor', 'left');
            $this->db->like('kompanija.naziv', $rec);
            $this->db->or_like('pozicija', $rec);    
            $query=$this->db->get();
            return $query->result_array ();
        }else if(empty ($rec) and !empty ($grad)){
            $this->db->select('naslov, idOgl, oglasi.opis, kompanija.naziv ');
            $this->db->from('oglasi');
            $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor', 'left');
            $this->db->where('oglasi.mesto', $grad);
            $query=$this->db->get();
            return $query->result_array ();
        }else{
            $this->db->select('naslov, idOgl, oglasi.opis, kompanija.naziv ');
            $this->db->from('oglasi');
            $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor', 'left');
            $this->db->where('oglasi.mesto', $grad);
            $this->db->like('kompanija.naziv', $rec);
            $this->db->or_like('pozicija', $rec);    
            $query=$this->db->get();
            return $query->result_array ();
                    
        }
    }
    
 
   
}
