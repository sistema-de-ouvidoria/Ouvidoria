<?php
namespace Ouvidoria\model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once('phpMailer/PHPMailer.php'); //chama a classe de onde você a colocou.
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

class Email
{
    public function enviarEmail(string $emailDestino, string $assunto, string $texto){
        $mail = new PHPMailer(); // instancia a classe PHPMailer

        $mail->IsSMTP();

        //configuração do gmail
        $mail->Port = '465'; //porta usada pelo gmail.
        $mail->Host = 'smtp.gmail.com';
        $mail->IsHTML(true);
        $mail->Mailer = 'smtp';
        $mail->SMTPSecure = 'ssl';


        //$mail->SMTPDebug = 2;//Debug do PHPMailer


        //configuração do usuário do gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'no.reply.ouvidoriacg@gmail.com'; // usuario gmail.
        $mail->Password = 'CS1G3TADS'; // senha do email.

        $mail->SingleTo = true;

        // configuração do email a ver enviado.
        $mail->From = "no.reply.ouvidoriacg@gmail.com";
        $mail->FromName = "Ouvidoria de Campo Grande";

        $mail->addAddress($emailDestino); // email do destinatario.
        $mail->Subject = utf8_decode($assunto);
        $mail->Body = utf8_decode($texto."<br><br><br><br><br><br><i>Está é uma mensagem automática.</i>");
        if(!$mail->Send())
            echo "Erro ao enviar Email:" . $mail->ErrorInfo;
    }

}
?>