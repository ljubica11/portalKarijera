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
        $korisniciDiskusije = $this->IzvestajiModel->korisniciDiskusije($datumOd, $datumDo);
        $vidOglData = ['vidKursOgl' => $this->IzvestajiModel->kursOglasi($datumOd, $datumDo),
                      "vidGrupaOgl" => $this->IzvestajiModel->grupaOglasi($datumOd, $datumDo),
                       "vidSviOgl" => $this->IzvestajiModel->sviOglasi($datumOd, $datumDo)];
        $vidVesData = ['vidKursVes' => $this->IzvestajiModel->kursVesti($datumOd, $datumDo),
                        'vidGrupaVes' =>  $this->IzvestajiModel->grupaVesti($datumOd, $datumDo),
                        'vidSviVes' => $this->IzvestajiModel->vestiVidljivost($datumOd, $datumDo),
                        'vidPretragaVes' => $this->IzvestajiModel->pretragaVesti($datumOd, $datumDo)];
        $data['middle_data'] = ['brojDisk' => $brojDisk, 'datumOd' => $datumOd, 'datumDo'=> $datumDo,
                               'brojPostova' => $brojPostova, 'brojGrupa' => $brojGrupa, 'brojOglasa' => $brojOglasa,
                                'brojVesti' => $brojVesti, 'brojObavestenja' => $brojObavestenja,
                                'diskVidljivost' => $diskVidljivost, 'oglasiVidljivost' => $oglasiVidljivost,
                                'vestiVidljivost' => $vestiVidljivost, 'obavestenjaVidljivost' => $obavestenjaVidljivost,
                                'arhiviraneDiskusije' => $arhiviraneDiskusije, 'kursDiskusije' => $kursDiskusije,
                                'grupeDiskusije' => $grupeDiskusije, 'korisniciDiskusije' => $korisniciDiskusije,
                                'detaljiOglasi' => $this->load->view('izvestaji/reports', $vidOglData, true),
                                'detaljiVesti' => $this->load->view('izvestaji/vestireport', $vidVesData, true)];
        $data['middle'] = 'middle/izvestaji';
        $this->load->view('viewTemplate', $data);
    }
    
    public function detaljiOglasi(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $vidKursOgl = $this->IzvestajiModel->kursOglasi($datumOd, $datumDo);
        $vidGrupaOgl = $this->IzvestajiModel->grupaOglasi($datumOd, $datumDo);
        $vidSviOgl = $this->IzvestajiModel->sviOglasi($datumOd, $datumDo);
        $this->load->library('parser');
        $this->parser->parse('detaljiOglasi', ["vidKursOgl" => $vidKursOgl, "vidGrupaOgl" => $vidGrupaOgl, 'vidSviOgl', $vidSviOgl]);
        
    }
    
    public function detaljiVesti(){
        
        $datumOd = $this->input->post('datumOd');
        $datumDo = $this->input->post('datumDo');
        $vidKursVes = $this->IzvestajiModel->kursVesti($datumOd, $datumDo);
        $vidGrupaVes = $this->IzvestajiModel->grupaVesti($datumOd, $datumDo);
        $vidSviVes = $this->IzvestajiModel->vestiVidljivost($datumOd, $datumDo);
        $vidPretragaVes = $this->IzvestajiModel->pretragaVesti($datumOd, $datumDo);
        $this->load->library('parser');
        $this->parser->parse('detaljiVesti', ['vidKursVes' => $vidKursVes, 'vidGrupaVes' => $vidGrupaVes, 
                             'vidSviVes' => $vidSviVes, 'vidPretragaVes' => $vidPretragaVes ]);
        
    }
    
}