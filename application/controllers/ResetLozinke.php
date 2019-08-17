 <?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');

class ResetLozinke extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }  
    
    public function resetovanje(){
        if ($this->session->has_userdata('user')) {
                
                use 'PHPMailer\PHPMailer\PHPMailer';
                use 'PHPMailer\PHPMailer\Exception';
                use 'PHPMailer\PHPMailer\SMTP';

                require("C:\wamp64\www\application\PHPMailer/src/Exception.php"); 
            require("C:\wamp64\www\application\PHPMailer/src/PHPMailer.php"); 
                require("C:\wamp64\www\application\PHPMailer/src/SMTP.php");
                require("C:\wamp64\www\application\PHPMailer/src/OAuth.php");
                require("C:\wamp64\www\application\PHPMailer/src/POP3.php"); 

            $mail = new PHPMailer(); 
                try {
                $mail->SMTPDebug = 2;
                $mail->Mailer = 'smtp';
                $mail->isSMTP();
                $mail->Host="smtp.gmail.com";
                $mail->Port=587;
                $mail->SMTPSecure="tls";
                $mail->SMTPAuth = true;
                $mail->Username="admportalkarijera@gmail.com";
                $mail->Password="A123123*";
                $mail->SetFrom("admportalkarijera@gmail.com");
                $mail->Subject = "Tekst naslova poruke";
                $mail->Body = "Sadrzaj poruke";
                $mail->AddAddress("ADRESA_KOME_SALJETE@gmail.com");

            if($mail->Send(true))
               echo "Poruka poslata";
            else { 
                echo "Poruka nije poslata<br/>"; 
                echo "GRESKA: " . $mail->ErrorInfo;
            }

                } catch (Exception $e) {
                        echo("GRESKA: " . $mail -> ErrorInfo);
                        die();
                }
        }
   
    