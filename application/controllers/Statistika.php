<?php

/**
 * Description of Statistika
 *
 * @author gordan
 */
class Statistika extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
      
        $this->load->model('StatistikaModel');
        $this->load->model('SifrarniciModel');
    }
    
    public function index(){
        
        $studenti = $this->db->count_all_results('student');
        $zaposleniStudenti = $this->StatistikaModel->zaposleniStudenti();
        $nezaposleniStudenti = $this->StatistikaModel->nezaposleniStudenti(); 
        $phpkurs = $this->StatistikaModel->phpkurs();
        $javakurs = $this->StatistikaModel->javakurs();
        $linuxkurs = $this->StatistikaModel->linuxkurs();
        $fakulteti = $this->SifrarniciModel->dohvatiFakultete();
        foreach($fakulteti as $f){
            $idFak = $f['idFak'];
            }
        $diploma = $this->StatistikaModel->diploma($idFak);
        $zbirDiploma = $this->db->count_all_results('diploma');
        
        
       
    
        $data['middle_data'] = ['studenti' => $studenti, 'zaposleni' => $zaposleniStudenti, 'nezaposleni' => $nezaposleniStudenti,
                                'phpkurs' => $phpkurs, 'javakurs' => $javakurs, 'linuxkurs' => $linuxkurs, 'diploma' => $diploma,
                                'fakulteti' => $fakulteti, 'zbirDiploma' => $zbirDiploma];
        $data['middle'] = 'middle/izvestaji';
        $this->load->view('viewTemplate', $data);
    }
    
}
