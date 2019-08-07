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
        
        public function najnovijaVest($idVes) {
            $this->db->select('max(idVes) as idVes');
            $this->db->SUBSTRING_INDEX('(GROUP_CONCAT(`datum` ORDER BY `datum` DESC), ',', 1) AS datum');
            $this->db->SUBSTRING_INDEX('(GROUP_CONCAT(`naziv` ORDER BY `datum` DESC), ',', 1) AS naziv');
            $this->db->SUBSTRING_INDEX('(GROUP_CONCAT(`tekst` ORDER BY `datum` DESC), ',', 1) AS tekst');
            $this->db->SUBSTRING_INDEX('(GROUP_CONCAT(`autor` ORDER BY `datum` DESC), ',', 1) AS autor');
            $this->db->FROM ('vesti');
            $query = $this->db->get();
        return $query -> result_array();
        var_dump($query);

        }
    }
?>
