<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require '../../app/testinclude.php';
require '../../app/PHPmailer/Exception.php';
require '../../app/PHPmailer/PHPMailer.php';
require '../../app/PHPmailer/SMTP.php';


/**
 * Esta funcion es la que envia los mails
 * @param string $destinatrio
 * @param string $subject
 * @param string $cuerpo
 */
function enviarMail($destinatario, $subject, $cuerpo){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;    //para los mensajes ¿hay q poner esto a cero?     //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'espaalfood.es';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'gestionpueblonuevo@espaalfood.es';                     //SMTP username
        $mail->Password   = 'hola2022_';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('gestionpueblonuevo@espaalfood.es', 'Espaal Food');
        $mail->addAddress($destinatario, '');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('gestionpueblonuevo@espaalfood.es', 'Espaal Food');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $cuerpo;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
