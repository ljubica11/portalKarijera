<?php

/**
 * Description of Izvestaji
 *
 * @author gordan
 */
class Izvestaji extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
        
        $this->load->model('IzvestajiModel');
    }
    
    public function index(){
        
         
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojDisk = $this->IzvestajiModel->brojDiskusija($datumOd, $datumDo);
        $brojPostova = $this->IzvestajiModel->brojPostova($datumOd, $datumDo);
        $brojGrupa = $this->IzvestajiModel->brojGrupa($datumOd, $datumDo);
        $brojOglasa = $this->IzvestajiModel->brojOglasa($datumOd, $datumDo);
        $brojVesti = $this->IzvestajiModel->brojVesti($datumOd, $datumDo);
        $brojObavestenja = $this->IzvestajiModel->brojObavestenja($datumOd, $datumDo);
        $diskVidljivost = $this->IzvestajiModel->diskusijeVidljivost($datumOd, $datumDo);
        $oglasiVidljivost = $this->IzvestajiModel->oglasiVidljivost($datumOd, $datumDo);
        $vestiVidljivost = $this->IzvestajiModel->vestiVidljivost($datumOd, $datumDo);
        $obavestenjaVidljivost = $this->IzvestajiModel->obavestenjaVidljivost($datumOd, $datumDo);
        $data['middle_data'] = ['brojDisk' => $brojDisk, 'datumOd' => $datumOd, 'datumDo'=> $datumDo,
                               'brojPostova' => $brojPostova, 'brojGrupa' => $brojGrupa, 'brojOglasa' => $brojOglasa,
                                'brojVesti' => $brojVesti, 'brojObavestenja' => $brojObavestenja,
                                'diskVidljivost' => $diskVidljivost, 'oglasiVidljivost' => $oglasiVidljivost,
                                'vestiVidljivost' => $vestiVidljivost, 'obavestenjaVidljivost' => $obavestenjaVidljivost];
        $data['middle'] = 'middle/izvestaji';
        $this->load->view('viewTemplate', $data);
    }
    
    public function izvestajDiskusije(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojDisk = $this->IzvestajiModel->brojDiskusija($datumOd, $datumDo);
        $data['middle_data'] = ['brojDisk' => $brojDisk, 'datumOd' => $datumOd, 'datumDo'=> $datumDo];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
                
    }
    
    public function izvestajPostovi(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojPostova = $this->IzvestajiModel->brojPostova($datumOd, $datumDo);
        $data['middle_data'] = ['brojPostova' => $brojPostova, 'datumOd' => $datumOd, 'datumDo'=> $datumDo];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
        
    }
    
    public function izvestajGrupe(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojGrupa = $this->IzvestajiModel->brojGrupa($datumOd, $datumDo);
        $data['middle_data'] = ['brojGrupa' => $brojGrupa, 'datumOd' => $datumOd, 'datumDo'=> $datumDo];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
        
    }
    
    
    public function izvestajOglasi(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojOglasa = $this->IzvestajiModel->brojOglasa($datumOd, $datumDo);
        $data['middle_data'] = ['brojOglasa' => $brojOglasa, 'datumOd' => $datumOd, 'datumDo'=> $datumDo];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
        
    }
    
    
    public function izvestajVesti(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojVesti = $this->IzvestajiModel->brojVesti($datumOd, $datumDo);
        $data['middle_data'] = ['brojGrupa' => $brojVesti, 'datumOd' => $datumOd, 'datumDo'=> $datumDo];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
        
    }
    
    
    public function izvestajObavestenja(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $brojObavestenja = $this->IzvestajiModel->brojObavestenja($datumOd, $datumDo);
        $data['middle_data'] = ['brojObavestenja' => $brojObavestenja, 'datumOd' => $datumOd, 'datumDo'=> $datumDo];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
        
    }
    
    public function diskusijeVidljivost(){
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $diskVidljivost = $this->IzvestajiModel->diskusijeVidljivost($datumOd, $datumDo);
        $data['middle_data'] = ['diskVidljivost' => $diskVidljivost];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
     }
     
      public function oglasiVidljivost(){
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $oglasiVidljivost = $this->IzvestajiModel->oglasiVidljivost($datumOd, $datumDo);
        $data['middle_data'] = ['oglasiVidljivost' => $oglasiVidljivost];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
     }
      public function vestiVidljivost(){
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $vestiVidljivost = $this->IzvestajiModel->vestiVidljivost($datumOd, $datumDo);
        $data['middle_data'] = ['vestiVidljivost' => $vestiVidljivost];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
     }
     
      public function obavestenjaVidljivost(){
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $obavestenjaVidljivost = $this->IzvestajiModel->obavestenjaVidljivost($datumOd, $datumDo);
        $data['middle_data'] = ['obavestenjaVidljivost' => $obavestenjaVidljivost];
        $data['middle'] = 'middle/izvestaji';
        $this->index();
     }
}
