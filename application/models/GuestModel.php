<?php

    class GuestModel extends CI_Model{
    
        public function __construct() {
            parent::__construct();

            $this->load->database();
        }

         public function uslovi(){
             $this->load->view('Login/usloviKoriscenja');
        }
        
         public function onama(){
             $this->load->view('Login/oNama');
        }
        
        public function najnovijaVest() {
            $this->db->select('tekst');
            $this->db->from('vesti');
            $this->db->order_by('datum', 'DESC');
            $this->db->limit(1);
            $query=$this->db->get();
            return $query->result_array();   
            }
            
         public function najnovijeObavestenje() {
            $this->db->select('tekst');
            $this->db->from('obavestenja');
            $this->db->order_by('datum', 'DESC');
            $this->db->limit(1);
            $query=$this->db->get();
            return $query->result_array();           
            }
       
        public function najnovijiOglas() {
            $this->db->select('opis');
            $this->db->from('oglasi');
            $this->db->order_by('vremePostavljanja', 'DESC');
            $this->db->limit(1);
            $query=$this->db->get();
            return $query->result_array();   
        }
        
        public function najnovijaDiskusija() {
            $this->db->select('opis');
            $this->db->from('diskusija');
            $this->db->order_by('datum', 'DESC');
            $this->db->limit(1);
            $query=$this->db->get();
            return $query->result_array();
            
        }
    }
        
        
    
