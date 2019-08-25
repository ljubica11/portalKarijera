<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Izvestaji
 *
 * kontroler za funkcionalnost izvestaji
 * @author gordan
 */
class Izvestaji extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('IzvestajiModel');
        $this->load->library('pdf');
    }
    
    /**
     * dohvatanje podataka o aktivnosti na sajtu po svim osnovama u cilju
     * statisticke obrade i ispisa u tabelama. Osim ispisa na stranici, generise se
     * privremeni pdf fajl za slanje izvestaja mejlom.
     */

    public function index() {



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
        $vidKursOgl = $this->IzvestajiModel->kursOglasi($datumOd, $datumDo);
        $vidGrupaOgl = $this->IzvestajiModel->grupaOglasi($datumOd, $datumDo);
        $vidSviOgl = $this->IzvestajiModel->sviOglasi($datumOd, $datumDo);
        $vidKursVes = $this->IzvestajiModel->kursVesti($datumOd, $datumDo);
        $vidGrupaVes = $this->IzvestajiModel->grupaVesti($datumOd, $datumDo);
        $vidSviVes = $this->IzvestajiModel->vestiVidljivost($datumOd, $datumDo);
        $vidPretragaVes = $this->IzvestajiModel->pretragaVesti($datumOd, $datumDo);
        $data['middle_data'] = ['brojDisk' => $brojDisk, 'datumOd' => $datumOd, 'datumDo' => $datumDo,
            'brojPostova' => $brojPostova, 'brojGrupa' => $brojGrupa, 'brojOglasa' => $brojOglasa,
            'brojVesti' => $brojVesti, 'brojObavestenja' => $brojObavestenja,
            'diskVidljivost' => $diskVidljivost, 'oglasiVidljivost' => $oglasiVidljivost,
            'vestiVidljivost' => $vestiVidljivost, 'obavestenjaVidljivost' => $obavestenjaVidljivost,
            'arhiviraneDiskusije' => $arhiviraneDiskusije, 'kursDiskusije' => $kursDiskusije,
            'grupeDiskusije' => $grupeDiskusije, 'korisniciDiskusije' => $korisniciDiskusije,
            'vidKursOgl' => $vidKursOgl, 'vidGrupaOgl' => $vidGrupaOgl, 'vidSviOgl' => $vidSviOgl,
            'vidKursVes' => $vidKursVes, 'vidGrupaVes' => $vidGrupaVes, 'vidSviVes' => $vidSviVes,
            'vidPretragaVes' => $vidPretragaVes];
        $data['middle'] = 'middle/izvestaji';
        $this->load->view('viewTemplate', $data);

        $generisano = $this->input->post('generate');

        if ($generisano) {
            $html = $this->load->view('middle/izvestaji', $data, true);
            $stream = false;
            $this->load->dompdf->load_html($html);
            $this->dompdf->render();
            $pdf_filename = time() . '_' . 'izv' . '.pdf';
            $pdf_filepath = './pdf/' . $pdf_filename;

            if ($stream) {
                $this->dompdf->stream($pdf_filename, array("Attachment" => 0));
            } else {
                $pdf_string = $this->dompdf->output();
                file_put_contents($pdf_filepath, $pdf_string);
            }
        }
    }
    
    /**
     * metoda za slanje izvestaja mejlom administratorima.
     * Slanjem mejla brise se generisani pdf fajl iz pdf foldera na serveru
     */

    public function posalji() {

      
        $dir = './pdf/';
        $fajlovi = scandir($dir, SCANDIR_SORT_DESCENDING);
        $fajlzaslanje = $fajlovi[0];

        
        $this->load->library('Phpmailerlib');
        $Mail = $this->phpmailerlib->load();     
        $mejlLista = $this->IzvestajiModel->mejlLista();


        $msg = 'Postovana/i, u prilogu izvestaj o strukturi studenata. '
                . ' Srdacan pozdrav. ' . 'Portal Karijera tim';

        $Mail->SMTPDebug = 0;
        $Mail->Mailer = 'smtp';
        $Mail->isSMTP();
        $Mail->Host = "smtp.gmail.com";
        $Mail->Port = 587;
        $Mail->SMTPSecure = "tls";
        $Mail->SMTPAuth = true;
        $Mail->Username = "karijera.online@gmail.com";
        $Mail->Password = "A123A123*";
        $Mail->SetFrom("admin-karijera.online@gmail.com");
        $Mail->Subject = 'Statistika';
        $Mail->Body = $msg;
        
           foreach ($mejlLista as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
           }
         

     
        $Mail->addAttachment($dir . $fajlzaslanje);




        if ($Mail->Send(true)) {
            echo "Poruka poslata";
            $this->load->helper('file');
            delete_files($dir);
        } else {
            echo "Poruka nije poslata<br/>";
            echo "GRESKA: " . $Mail->ErrorInfo;
        }
        $this->index();
    }

}
