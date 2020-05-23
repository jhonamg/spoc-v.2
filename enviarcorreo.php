<?php
$nombre= $_POST['enviador'];
$correo=$_POST['respondera'];  
$telefono="1234568, de contacto";
$mensaje= $_POST['mensajeenviador'];
// $subbject= "ALERTAS - ".$_POST["listatiendas"];

$body="Nombre: ".$nombre . "</br>Correo: ".$correo . "</br>Telefono: ".$telefono . "</br>Mensaje: ".$mensaje;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jhonamg8@gmail.com';                     // SMTP username
    $mail->Password   = '01123581321345589';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('jhonamg8@gmail.com', $nombre);
    $mail->addAddress('mirellyagv@gmail.com', 'Cosita rica');     // Add a recipient
    $mail->addAddress('jhonamg8@gmail.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC($correo);
    // $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment('D:\Xampp\htdocs\spoc-v.2\assets\img\Nueva carpeta\tottus.jpg','imagen de tottus baner');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'administración';
    $mail->Body    = $body.'</br>This is the HTML message body <b>in bold!</b>';
    $mail->CharSet ='UTF-8';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    echo '<script> window.history.go(-1); </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>