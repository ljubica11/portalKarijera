<?php



class OglasiModel extends CI_Model{
    
       public function dohvatiSveOglase($tipKorisnika){
        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();
        $this->db->select('idOgl')->from('vidioglas')->where('idKor', $idKor);
        $wherePretraga = $this->db->get_compiled_select();
        $whereVreme = "vremeIsticanja >= CURRENT_DATE()";

        $this->db->select('oglasi.*, kompanija.naziv, kompanija.sajt');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
        if($tipKorisnika !== "a"){
            $this->db->where($whereVreme);
        }
        if($tipKorisnika == "gost"){
            $this->db->where('vidljivost', 'gost');
        }if($tipKorisnika == "k"){
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->group_end();
        }
            if($tipKorisnika == "s"){
            $this->db->group_start();   
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->or_where('vidljivost', 'studenti');  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where("vidljivostKurs in ($whereKurs)",  NULL, FALSE);
            $this->db->group_end();  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where("vidljivostGrupa in ($whereGrupe)", NULL, FALSE);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'pretraga');
            $this->db->where("idOgl in ($wherePretraga)", NULL, FALSE);
            $this->db->group_end();
            $this->db->group_end();
        }
        $this->db->order_by('idOgl', 'DESC');
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
    
    /**
     * Metoda za dohvatanje oglasa po kreiranim grupama korisnika
     * @param type $idGru
     * @return type array
     */
    public function dohvatiOglaseGrupe($idGru){
        
        $this->db->select('oglasi.*, kompanija.naziv')
                 ->from('oglasi')
                 ->join('kompanija', 'oglasi.autor = kompanija.idKor', 'left')
                 ->join('sadrzioglas', 'sadrzioglas.idOgl = oglasi.idOgl')
                 ->where('sadrzioglas.idGru', $idGru);
        $query = $this->db->get();
        return $query->result_array();
        
        
        
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
    
    public function dodajOglasZaPretragu($idOgl, $idKor){
        $data = [
            "idOgl" => $idOgl,
            "idKor" => $idKor
        ];
        
        $this->db->insert("vidioglas", $data);
    }

        public function pretragaOglasa($rec, $grad, $tip){
        $idKor = $this->session->userdata('user')['idKor'];
        $this->db->select('idKurs')->from('student')->where('idKor', $idKor);
        $whereKurs = $this->db->get_compiled_select();
        $this->db->select('idGru')->from('clanovigrupe')->where('idKor', $idKor);
        $whereGrupe = $this->db->get_compiled_select();
        $this->db->select('idOgl')->from('vidioglas')->where('idKor', $idKor);
        $wherePretraga = $this->db->get_compiled_select();

        $this->db->select('naslov, vremeIsticanja, idOgl, oglasi.opis, kompanija.naziv');
        $this->db->from('oglasi');
        $this->db->join('kompanija', 'oglasi.autor = kompanija.idKor');
//        $this->db->group_start();
        if($tip == "gost"){
            $this->db->where('vidljivost', 'gost');
        }if($tip == "k"){
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->group_end();
        }
            if($tip == "s"){
            $this->db->group_start();
            $this->db->where('vidljivost', 'gost');
            $this->db->or_where('vidljivost', 'korisnici');
            $this->db->or_where('vidljivost', 'studenti');  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'kurs');
            $this->db->where("vidljivostKurs in ($whereKurs)",  NULL, FALSE);
            $this->db->group_end();  
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'grupa');
            $this->db->where("vidljivostGrupa in ($whereGrupe)", NULL, FALSE);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('vidljivost', 'pretraga');
            $this->db->where("idOgl in ($wherePretraga)", NULL, FALSE);
            $this->db->group_end();
            $this->db->group_end();
            
            }
//            $this->db->group_end();
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
    
    public function dodajOglasZaGrupu($idOgl, $idGru){
        $data = [
            "idOgl" => $idOgl,
            "idGru" => $idGru
        ];
        
        $this->db->insert("sadrzioglas", $data);
    }
}
