<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
  <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="assets/css/cssbootstrap/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/form-elements.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


    <title>PRUEBA FILE</title>
</head>
<body>
    
<form method="post"  enctype="multipart/form-data" action="auxiliarenvio.php">
    
<div class="container-fluid">
    <div class="row">
        <table class="table table-dark border-secondary">
            <tbody>
                <tr>
                    <td><label for="a1">NOMBRE:</label></td>
                    <td><label for="a2">APELLIDO:</label></td>
                    <td><label for="a3">FOTO:</label></td>
                    <td><label for="a4">PDF:</label></td>
                </tr>
                <tr>
                    <td><input class="form-control" type="text" name="a11"></td>
                    <td><input class="form-control" type="text" name="a21"></td>
                    <td>
                        <div class="custom-file">
                            <input id="a31" class="custom-file-input" type="file" name="a31">
                            <label for="a31" class="custom-file-label">FOTO</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="a41">PDF</label>
                            <input id="a41" class="form-control-file" type="file" name="a41">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>

<div class="row">
    <button class="btn btn-success" type="submit">ENVIAR</button>
</div>


<table class="table table-dark">
    <tbody>
        <tr>
            <td><label > Id:</label></td>
            <td><label >NOMBRE:</label></td>
            <td><label >APELLIDO:</label></td>
            <td><label >FOTO:</label></td>
            <td><label >PDF:</label></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>



</form>






<!-- Javascript -->
  <!-- <script src="assets/js/jquery-1.11.1.min.js"></script> -->
  <script src="assets/js/jquery.v3.5.1.js"></script>
  <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
  <script src="assets/js/jsbootstrap/bootstrap.js"></script>
  <!-- <script src="assets/js/jquery.backstretch.min.js"></script> -->
  <!-- <script src="assets/js/retina-1.1.0.min.js"></script> -->
  <!-- <script src="assets/plugins/sweetalert2/core.js"></script>
  <script src="assets/plugins/sweetalert2/sweetalert2.all.js"></script> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="assets/js/jquery.number.js"></script>
  <!-- <script src="assets/js/scripts.js"></script> -->

</body>
</html>





//------------datos tienda--------------------
 $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
if ($mysqli->connect_errno) {
  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}    
$query12 = "SELECT tienda.dsc_tienda, tienda.id, ubicacion.dsc_ubicacion FROM tienda INNER JOIN ubicacion ON tienda.id_ubicacion = ubicacion.id WHERE tienda.id = '".$_POST["listatiendas"]."'";
// echo $query2;
$mysqli->real_query($query12);
$resultado = $mysqli->use_result();
$fila1 = $resultado->fetch_assoc();
$mysqli->close();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//--------------------------------------------------mail alertas------------------------------//

$mensaje = '';
if($mensaje_top != ''){
    $mensaje .= "PRECIOS TOP: </br>".$mensaje_top."</br>";
}
if($mensaje_EDV != ''){
    $mensaje .= "VISIBILIDAD: </br>".$mensaje_EDV."</br>";
}
if($mensaje_EXH != ''){
    $mensaje .= "EXHIBICIONES: </br>".$mensaje_EXH."</br>";
}

$subbject= "ALERTAS - ".$_POST["listatiendas"];

$body="<b>Spoc:</b> ".$id_usuario."</br><b>Tienda:</b> ".$fila1['id']." | ".$fila1['dsc_tienda']." | ".$fila1['dsc_ubicacion']."</br><b>Fecha y hora:</b> ".$fechaActual."</br><b>Mensaje:</b> ".$mensaje;

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
    $mail->setFrom('jhonamg8@gmail.com', 'Jhon');
    $mail->addAddress('mirellyagv@gmail.com', 'Mirelly');     // Add a recipient
    $mail->addAddress('jhonamg8@gmail.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC($correo);
    // $mail->addBCC('bcc@example.com');

    // Attachments
    
    // $mail->addAttachment($foto_EDV_COMP);         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'ALERTAS - '.$fila1['dsc_tienda'];
    $mail->Body    = $body;
    $mail->CharSet ='UTF-8';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if($mensaje_top != '' || $mensaje_EXH != '' || $mensaje_EDV != ''){
        $mail->send();
    }
    echo 'Message has been sent';
    // echo '<script> window.history.go(-1); </script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


//-----------------------------------------------mail marketing----------------------------------------------

$mensaje2 = '';
if($mensaje_top_comp != ''){
    $mensaje2 .= "PRECIOS COMPETENCIA: </br>".$mensaje_top_comp."</br>";
}
if($mensaje_EDV_comp != ''){
    $mensaje2 .= "VISIBILIDAD: </br>".$mensaje_EDV_comp."</br>";
}
if($mensaje_EXH_comp != ''){
    $mensaje2 .= "EXHIBICIONES: </br>".$mensaje_EXH_comp."</br>";
}

$body2="<p><b>Spoc:</b> ".$id_usuario."</br><b>Tienda:</b> ".$fila1['id']." | ".$fila1['dsc_tienda']." | ".$fila1['dsc_ubicacion']."</br><b>Fecha y hora:</b> ".$fechaActual."</br><b>Mensaje:</b> ".$mensaje2."</p>";

    // Instantiation and passing `true` enables exceptions
$mail2 = new PHPMailer(true);

try {
    //Server settings
    $mail2->SMTPDebug = 0;                      // Enable verbose debug output
    $mail2->isSMTP();                                            // Send using SMTP
    $mail2->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail2->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail2->Username   = 'jhonamg8@gmail.com';                     // SMTP username
    $mail2->Password   = '01123581321345589';                               // SMTP password
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail2->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail2->setFrom('jhonamg8@gmail.com', 'Jhon');
    $mail2->addAddress('mirellyagv@gmail.com', 'Mirelly');     // Add a recipient
    $mail2->addAddress('jhonamg8@gmail.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC($correo);
    // $mail->addBCC('bcc@example.com');

    // Attachments
    $foto_EDV_COMP;
    // $mail->addAttachment('D:\Xampp\htdocs\spoc-v.2\assets\img\Nueva carpeta\tottus.jpg','imagen de tottus baner');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = 'SPOC Competencia - '.$fila1['dsc_tienda'];
    $mail2->Body    = $body2;
    $mail2->CharSet ='UTF-8';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if($mensaje_top_comp != '' || $mensaje_EXH_comp != '' || $mensaje_EDV_comp != ''){
        $mail2->send();
    }
    echo 'Message has been sent';
    // echo '<script> window.history.go(-1); </script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }







