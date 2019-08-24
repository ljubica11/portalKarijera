<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Statistika
 *
 * @author gordan
 */
class Statistika extends CI_Controller {

    public function __construct() {
        parent::__construct();


        $this->load->model('StatistikaModel');
        $this->load->model('SifrarniciModel');
        $this->load->library('pdf');
    }

    public function index() {

        $studenti = $this->db->count_all_results('student');
        $zaposleniStudenti = $this->StatistikaModel->zaposleniStudenti();
        $nezaposleniStudenti = $this->StatistikaModel->nezaposleniStudenti();
        $phpkurs = $this->StatistikaModel->phpkurs();
        $javakurs = $this->StatistikaModel->javakurs();
        $linuxkurs = $this->StatistikaModel->linuxkurs();
        $fakulteti = $this->SifrarniciModel->dohvatiFakultete();
        $mejlLista = $this->StatistikaModel->mejlLista();
        $timKarijera = $this->StatistikaModel->mejlAdmini();
        foreach ($fakulteti as $f) {
            $idFak = $f['idFak'];
        }
        $diploma = $this->StatistikaModel->diploma($idFak);
        $zbirDiploma = $this->db->count_all_results('diploma');




        $data['middle_data'] = ['studenti' => $studenti, 'zaposleni' => $zaposleniStudenti, 'nezaposleni' => $nezaposleniStudenti,
            'phpkurs' => $phpkurs, 'javakurs' => $javakurs, 'linuxkurs' => $linuxkurs, 'diploma' => $diploma,
            'fakulteti' => $fakulteti, 'zbirDiploma' => $zbirDiploma, 'timKarijera' => $timKarijera,
            'mejlLista' => $mejlLista];
        $data['middle'] = 'middle/stats';
        $this->load->view('viewTemplate', $data);
    }

    
    public function saljiIzvestaj() {


        $studenti = $this->db->count_all_results('student');
        $zaposleniStudenti = $this->StatistikaModel->zaposleniStudenti();
        $nezaposleniStudenti = $this->StatistikaModel->nezaposleniStudenti();
        $phpkurs = $this->StatistikaModel->phpkurs();
        $javakurs = $this->StatistikaModel->javakurs();
        $linuxkurs = $this->StatistikaModel->linuxkurs();
        $fakulteti = $this->SifrarniciModel->dohvatiFakultete();
        foreach ($fakulteti as $f) {
            $idFak = $f['idFak'];
        }
        $diploma = $this->StatistikaModel->diploma($idFak);
        $zbirDiploma = $this->db->count_all_results('diploma');
        $data['middle_data'] = ['studenti' => $studenti, 'zaposleni' => $zaposleniStudenti, 'nezaposleni' => $nezaposleniStudenti,
            'phpkurs' => $phpkurs, 'javakurs' => $javakurs, 'linuxkurs' => $linuxkurs, 'diploma' => $diploma,
            'fakulteti' => $fakulteti, 'zbirDiploma' => $zbirDiploma];
        $data['middle'] = 'middle/stats';
        $this->load->view('viewTemplate', $data);

        $html = $this->load->view('middle/stats', $data, true);


        //generisem pdf fajl

        $this->load->dompdf->load_html($html);
        $this->dompdf->render();
        $pdf_filename = time() . '_' . 'stats' . '.pdf';
        $pdf_string = $this->dompdf->output();
        
         //slanje pdf fajla mejlom
        $this->load->library('Phpmailerlib');
        $Mail = $this->phpmailerlib->load();
        $mejlLista = $this->StatistikaModel->mejlLista();
        $timKarijera = $this->StatistikaModel->mejlAdmini();
        

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
        if ($this->input->get('listeMejlova') == 1) {
            foreach ($mejlLista as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
            }
        } else if ($this->input->get('listeMejlova') == 2) {

            foreach ($timKarijera as $m) {
                $mejl = $m['email'];
                $Mail->AddAddress($mejl);
            }
        }

        // $Mail->AddAddress("gordanst@gmail.com");
        $Mail->addStringAttachment($pdf_string, $pdf_filename);

    


        if ($Mail->Send(true)) {
            echo "Poruka poslata";
        } else {
            echo "Poruka nije poslata<br/>";
            echo "GRESKA: " . $Mail->ErrorInfo;
        }
    }

}
