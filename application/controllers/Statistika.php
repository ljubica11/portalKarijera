<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Statistika
 *
 * kontroler za funkcionalnost statistika
 * Statisticka obrada podataka o registrovanin studentima i generisanje izvestaja
 * za slanje kompanijama
 *
 * @author gordan
 */
class Statistika extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('StatistikaModel');
        $this->load->model('SifrarniciModel');
        $this->load->library('pdf');
    }
    
    /*
     * dohvatanje upita iz modela potrebnih za statisticku obradu i ispis na stranici
     */

    public function index()
    {
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
    
    /**
     * generisanje pdf fajla sa statistickim izvestajem koji se smesta
     * u attachment e-mail poruke. Slanje emailom po listama,
     * kompanijama ili administratorama.
     *
     */

    
    public function saljiIzvestaj()
    {
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

       
        //generisem pdf fajl
               
        $this->load->config('email');
        $this->load->library('email');
      
        $mejlLista = $this->StatistikaModel->mejlLista();
        $timKarijera = $this->StatistikaModel->mejlAdmini();
    

        $this->load->dompdf->load_html($html);
        $this->dompdf->render();
        $pdf_filename = time() . '_' . 'stats' . '.pdf';
        $file = base_url().'pdf/'.$pdf_filename;
        
        //slanje pdf fajla mejlom

        $msg = 'Postovana/i, u prilogu izvestaj o strukturi studenata. '
                . ' Srdacan pozdrav. ' . 'Portal Karijera tim';
        
        if ($this->input->get('listeMejlova') == 1) {
            foreach ($mejlLista as $m) {
                $mejl = $m['email'];
                $this->email->from("admin@karijera-portal.link.in.rs", 'admin karijera-portal');
                $this->email->to($mejl);
                $this->email->message($msg);
                $this->email->subject('Statistika - Karijera Portal');
                $this->email->attach($file);
                $this->email->send();
            }
        } elseif ($this->input->get('listeMejlova') == 2) {
            foreach ($timKarijera as $m) {
                $mejl = $m['email'];
                $this->email->to($mejl);
                $this->email->from("admin@karijera-portal.link.in.rs", 'admin karijera-portal');
                $this->email->to($mejl);
                $this->email->message($msg);
                $this->email->subject('Statistika - Karijera Portal');
                $this->email->attach($file);
                $this->email->send();
            }
        }
    
    
       /*  if ) {
            echo 'Poruka poslata.';
        } else {
            show_error($this->email->print_debugger());
        } */
    }
}
