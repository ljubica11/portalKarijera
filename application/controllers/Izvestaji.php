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
        $arhiviraneDiskusije = $this->IzvestajiModel->arhiviraneDiskusije($datumOd, $datumDo);
        $kursDiskusije = $this->IzvestajiModel->kursDiskusije($datumOd, $datumDo);
        $grupeDiskusije = $this->IzvestajiModel->grupeDiskusije($datumOd, $datumDo);
        $korisniciDiskusije = $this->IzvestajiModel->grupeDiskusije($datumOd, $datumDo);
        $data['middle_data'] = ['brojDisk' => $brojDisk, 'datumOd' => $datumOd, 'datumDo'=> $datumDo,
                               'brojPostova' => $brojPostova, 'brojGrupa' => $brojGrupa, 'brojOglasa' => $brojOglasa,
                                'brojVesti' => $brojVesti, 'brojObavestenja' => $brojObavestenja,
                                'diskVidljivost' => $diskVidljivost, 'oglasiVidljivost' => $oglasiVidljivost,
                                'vestiVidljivost' => $vestiVidljivost, 'obavestenjaVidljivost' => $obavestenjaVidljivost,
                                'arhiviraneDiskusije' => $arhiviraneDiskusije, 'kursDiskusije' => $kursDiskusije,
                                'grupeDiskusije' => $grupeDiskusije, 'korisniciDiskusije' => $korisniciDiskusije ];
        $data['middle'] = 'middle/izvestaji';
        $this->load->view('viewTemplate', $data);
    }
    
}