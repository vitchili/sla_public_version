<?php
require_once(__DIR__ . '/../../Configs/PHPMailer/src/PHPMailer.php');
require_once(__DIR__ . '/../../Configs/PHPMailer/src/SMTP.php');
require_once(__DIR__ . '/../../Configs/PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DisparoEmail{
    function __construct(){
        
       
    }
    function enviarEmail($envolvidos, $titulo, $mensagem){
        error_reporting(0);
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; // $mail->SMTPDebug = SMTP::DEBUG_SERVER; para quando vc quiser debugar e ver se nao está enviando
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pimenta.aquicob@gmail.com';
            $mail->Password = 'pimenta285';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
         
            $mail->setFrom('pimenta.aquicob@gmail.com');
            foreach($envolvidos as $cadaEnvolvido){
                $mail->addAddress($cadaEnvolvido);
            }
            $mail->isHTML(true);
            $mail->Subject = $titulo;
            $mail->Body = $mensagem;
            $mail->AltBody = $mensagem;
            if($mail->send()) {
                var_dump('Email enviado com sucesso');
            } else {
                var_dump('Email nao enviado');
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }

   
}