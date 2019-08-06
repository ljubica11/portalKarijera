<?php


class OglasiModel extends CI_Model{
    
       public function dohvatiSveOglase($tipKorisnika){
        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();

        $this->db->select('oglasi.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
        $this->db->where('vidljivost', 'korisnici');
            if($tipKorisnika == "s"){
            $this->db->or_where('vidljivost', 'studenti');  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where("vidljivostKurs in ($whereKurs)",  NULL, FALSE);
            $this->db->group_end();  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where("vidljivostGrupa in ($whereGrupe)", NULL, FALSE);
            $this->db->group_end();
        }
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

        public function dodajNoviOglas($idKor, $naslov, $grad, $vremeIst, $opis, $plata, $placanje, $obaveze, $uslovi, $ponuda, $pozicija, $vidljivost, $vidljivostGrupa, $vidljivostKurs){
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
            "pozicija" => $pozicija,
            "vidljivost" => $vidljivost,
            "vidljivostKurs" => $vidljivostKurs,
            "vidljivostGrupa" => $vidljivostGrupa
        ];
        
        $this->db->insert("oglasi", $data);
        return $noviIdOgl = $this->db->insert_id();
    }
    
    public function pretragaOglasa($rec, $grad, $tip){
        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();

        $this->db->select('naslov, vremeIsticanja, idOgl, oglasi.opis, kompanija.naziv');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
        $this->db->group_start();
        $this->db->where('vidljivost', 'korisnici');
            if($tip == "s"){
            $this->db->or_where('vidljivost', 'studenti');  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where("vidljivostKurs in ($whereKurs)",  NULL, FALSE);
            $this->db->group_end();  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where("vidljivostGrupa in ($whereGrupe)", NULL, FALSE);
            $this->db->group_end();
            $this->db->group_end();
            }
            if(!empty($rec) and empty($grad)){
                $this->db->like('kompanija.naziv', $rec);
                $this->db->or_like('pozicija', $rec);  
                $this->db->order_by('vremePostavljanja', 'DESC');
            }else if(empty ($rec) and !empty ($grad)){
                $this->db->where('oglasi.mesto', $grad);
                $this->db->order_by('vremePostavljanja', 'DESC');
            }else{
                $this->db->where('oglasi.mesto', $grad);
                $this->db->like('kompanija.naziv', $rec);
                $this->db->or_like('pozicija', $rec);  
                $this->db->order_by('vremePostavljanja', 'DESC');
            }

        $query=$this->db->get();
        return $query->result_array ();
    }      
    
    public function traziBrisanje($idOgl){
        $data = ["zaBrisanje" => "da"];
        $this->db->where("idOgl", $idOgl);
        $this->db->update("oglasi", $data);
        
    }
    

    public function dohvatiGrupe(){
        $query = $this->db->get('grupe');
        return $query->result_array();
    }
    
}
