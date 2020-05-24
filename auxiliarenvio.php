<?php
@session_start();
$dir_subida = 'assets/img/';
$fecha = date('Y-m-d');
// $hora = date('H:i:s');
$nombre=$_POST['a11'];
$apellido=$_POST['a21'];
// $foto=$_FILES['a31'];/// attr name="a11".... del file imagen
$pdf=$_FILES['a31']['name'];

$nombre_foto_correo= $nombre.'_'.$fecha.'.jpg'; ///<---AQUI ES LA VARIABLE QUE RENOMBRA EL ARCHIVO .JPG///

$datosuser= $dir_subida.$nombre_foto_correo;

// ejeplo de subida de file//////////////////////////////



$nombre_archivo= $_FILES['a31']['name'];

$fichero_subido = $dir_subida.basename($_FILES['a31']['name']);

echo '<pre>';


      if($_FILES['a31']['size']>10000000){
        echo"solo se permiten archivos menores a 10MB.";
        // echo"<a href='pruebadefile.php'>VOLVER</a>";
        exit;
    }

 /////equivalente///// if(move_uploaded_file($_FILES['a31']['tmp_name'],$dir_subida.$nombre_archivo))


if (move_uploaded_file($_FILES['a31']['tmp_name'], $fichero_subido)) {
    rename ( $fichero_subido , $datosuser );                              /////<----AQUI LA FUNCION QUE RENOMBRA EL ARCHIVO IMG EN LA BD.
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}

echo 'Más información de depuración:';
print_r($_FILES);

/////////////////////////////////////////////////////////////////

// if (is_uploaded_file($_FILES['a31']['tmp_name'])) {
//     echo "Archivo ". $_FILES['a31']['name'] ." subido con éxtio.\n";
//     echo "Monstrar contenido\n";
//     // readfile($_FILES['a31']['tmp_name']);
//  } else {
//     echo "Posible ataque del archivo subido: ";
//     echo "nombre del archivo '". $_FILES['a31']['tmp_name'] . "'.";
//  }

//////////////////////////////////////////////////////////////////////////////




//--------------------------------------proceso de guardado---------------------------------------------//

// $id_usuario = 'user1';
$mysqli = new mysqli('localhost', 'root', '', 'prueba_bd');
if ($mysqli->connect_errno) {
    echo "Error: Unable to connect to MySQL.";
    echo "Debugging errno: " . mysqli_connect_errno();
    echo "Debugging error: " . mysqli_connect_error();
    exit;
}
// if ($mysqli->connect_errno) {
//   echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

// }

$query="INSERT INTO `tablaprueba`(`nombre_usuario`, `apellido_usuario`, `foto_img`, `pdf_img`) VALUES ('$nombre', '$apellido', '$fichero_subido',  '$datosuser')";

// $query = "SELECT id_tx FROM detalle_spoc ORDER BY id_tx DESC LIMIT 1"; 
echo $query;


$query1="SELECT * FROM `tablaprueba` ORDER BY 1 DESC";




$mysqli->real_query($query);
$mysqli->close();


// $mysqli->real_query($query);


// $resultado = $mysqli->use_result();

// mysqli_close($mysqli);

// $idTx = $resultado->fetch_assoc();



// // echo $idTx;
// if($idTx == NULL || $idTx == ''){
//     $idTx = 1;
// }else{
//     $idTx = intval($idTx) + 1;
// }

// //----------------------------- precio top
// for($i = 1; $i <= $totPrecioTop; $i++){
//     $query1 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`)  VALUES ($idTx, '$id_usuario', '$tienda', '".$nombrePreTop['id_prod_prec_top_'.$i]."', null, '".$datosPreTop['precio_top_'.$i]."', null, '$fechaActual', 'NO', null, 'SI') "; 
//     echo $query1;
//     $mysqli->real_query($query1);
//     if (!$mysqli->query($query1)) {
//         printf("Código de error: %d\n", $mysqli->errno);
//     }
//     $mysqli->next_result();
//     $query2 = "SELECT configuraciones_tx.precio, configuraciones_tx.sku_cadena, configuraciones_tx.id_tienda FROM configuraciones_tx WHERE (configuraciones_tx.id_producto = ".$nombrePreTop['id_prod_prec_top_'.$i]." AND configuraciones_tx.id_tienda = $tienda AND configuraciones_tx.precio != ".$datosPreTop['precio_top_'.$i].")";
//     // echo $query2;
// }

// for($i = 1; $i <= $totPrecioTopComp; $i++){
//     $query3 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', ".$nombrePreTopComp['id_comp_prec_top_'.$i].", null, ".$datosPreTopComp['precio_top_comp_'.$i].", null, '$fechaActual', 'SI', null, 'SI') "; 
//     $mysqli->real_query($query3);
// }




// // $nombre= $_POST['enviador'];
// // $correo=$_POST['respondera'];  
// // $telefono="1234568, de contacto";
// // $mensaje= $_POST['mensajeenviador'];

// //----------------------------variables----------------------------------//

// $fecha = date('Y-m-d');
// $hora = date('H:i:s');
// $fechaActual = $fecha.' '.$hora;
// $totPrecioTop = $_POST['totPrecioTop'];
// $totPrecioTopComp = $_POST['totPrecioTopComp'];
// $totEDV = $_POST['totEDV'];
// $totEDVComp = $_POST['totEDVComp'];
// $totEXH = $_POST['totEXH'];
// $totEXHComp = $_POST['totEXHComp'];
// $datosPreTop = [];
// $nombrePreTop = [];
// for($i = 1; $i <= $totPrecioTop; $i++){
//     $datosPreTop += [ "precio_top_$i" => $_POST["precio_top_$i"] ];
//     $nombrePreTop += [ "id_prod_prec_top_$i" => $_POST["id_prod_prec_top_$i"] ];
// }
// $datosPreTopComp = [];
// $nombrePreTopComp = [];

// for($i = 1; $i <= $totPrecioTopComp; $i++){
//     $datosPreTopComp += [ "precio_top_comp_$i" => $_POST["precio_top_comp_$i"] ];
//     $nombrePreTopComp += [ "id_comp_prec_top_$i" => $_POST["id_comp_prec_top_$i"] ];
// }
// $datosEDV = [];
// for($i = 1; $i <= $totEDV; $i++){
//     $datosEDV += [ "radio_vis_$i" => $_POST["radio_vis_$i"] ];
//     $datosEDV += [ "id_produc_prop_vis_$i" => $_POST["id_produc_prop_vis_$i"] ];
//     $datosEDV += [ "id_elemento_vis_$i" => $_POST["id_elemento_vis_$i"] ];
//     //falta foto
// }
// $productoEDVComp = [];
// $elementoEDVComp = [];
// for($i = 1; $i <= $totEDVComp; $i++){
//     $productoEDVComp += [ "InpEdvBf2_$i" => $_POST["InpEdvBf2_$i"] ];
//     $elementoEDVComp += [ "SelEdvBf2_$i" => $_POST["SelEdvBf2_$i"] ];
//     //falta foto
// }
// $productoEXH = [];
// $elementoEXH = [];
// $precioEXH = [];
// $radio_EXH = [];
// for($i = 1; $i <= $totEXH; $i++){
//     $productoEXH += [ "id_produc_prop_exh_$i" => $_POST["id_produc_prop_exh_$i"] ];
//     $elementoEXH += [ "id_elemento_exh_$i" => $_POST["id_elemento_exh_$i"] ];
//     $precioEXH += [ "precio_prop_$i" => $_POST["precio_prop_$i"] ];
//     $radio_EXH += [ "radio_EXH_$i" => $_POST["radio_EXH_$i"] ];
//     //falta foto
// }
// $productoEXHComp = [];
// $elementoEXHComp = [];
// $precioEXHComp = [];
// for($i = 1; $i <= $totEXHComp; $i++){
//     $productoEXHComp += [ "InpEdvBf3_$i" => $_POST["InpEdvBf3_$i"] ];
//     $elementoEXHComp += [ "SelEdvBf3_$i" => $_POST["SelEdvBf3_$i"] ];
//     $precioEXHComp += [ "preEdvComp_$i" => $_POST["preEdvComp_$i"] ];
//     //falta foto
// }
// $tienda = $_POST['listatiendas'];

// //--------------------------------------proceso de guardado---------------------------------------------//

// $id_usuario = 'user1';
// $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
// if ($mysqli->connect_errno) {
//   echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
// }
// $query = "SELECT id_tx FROM detalle_spoc ORDER BY id_tx DESC LIMIT 1"; 
// echo $query;
// $mysqli->real_query($query);
// $resultado = $mysqli->use_result();
// $idTx = $resultado->fetch_assoc();
// // echo $idTx;
// if($idTx == NULL || $idTx == ''){
//     $idTx = 1;
// }else{
//     $idTx = intval($idTx) + 1;
// }

// //----------------------------- precio top
// for($i = 1; $i <= $totPrecioTop; $i++){
//     $query1 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`)  VALUES ($idTx, '$id_usuario', '$tienda', '".$nombrePreTop['id_prod_prec_top_'.$i]."', null, '".$datosPreTop['precio_top_'.$i]."', null, '$fechaActual', 'NO', null, 'SI') "; 
//     echo $query1;
//     $mysqli->real_query($query1);
//     if (!$mysqli->query($query1)) {
//         printf("Código de error: %d\n", $mysqli->errno);
//     }
//     $mysqli->next_result();
//     $query2 = "SELECT configuraciones_tx.precio, configuraciones_tx.sku_cadena, configuraciones_tx.id_tienda FROM configuraciones_tx WHERE (configuraciones_tx.id_producto = ".$nombrePreTop['id_prod_prec_top_'.$i]." AND configuraciones_tx.id_tienda = $tienda AND configuraciones_tx.precio != ".$datosPreTop['precio_top_'.$i].")";
//     // echo $query2;
// }

// for($i = 1; $i <= $totPrecioTopComp; $i++){
//     $query3 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', ".$nombrePreTopComp['id_comp_prec_top_'.$i].", null, ".$datosPreTopComp['precio_top_comp_'.$i].", null, '$fechaActual', 'SI', null, 'SI') "; 
//     $mysqli->real_query($query3);
// }

// // -------------------------Elementos de visibilidad
// for($i = 1; $i <= $totEDV; $i++){
//     $query5 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', '".$datosEDV['id_produc_prop_vis_'.$i]."',  '".$datosEDV['id_elemento_vis_'.$i]."', null, 'ARCHIVO', '$fechaActual', 'NO', null, '".$datosEDV['radio_vis_'.$i]."') "; 
//     // echo $query;
//     $mysqli->real_query($query5);
// }

// for($i = 1; $i <= $totEDVComp; $i++){
//     $query7 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', null,  '".$elementoEDVComp['SelEdvBf2_'.$i]."', null, 'ARCHIVO', '$fechaActual', 'SI', '".$productoEDVComp['InpEdvBf2_'.$i]."', 'SI')"; 
//     // echo $query;
//     $mysqli->real_query($query7);
// }

// // --------------------------------Exhibiciones
// for($i = 1; $i <= $totEXH; $i++){
//     $query9 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', '".$productoEXH['id_produc_prop_exh_'.$i]."',  '".$elementoEXH['id_elemento_exh_'.$i]."', '".$precioEXH['precio_prop_'.$i]."', 'ARCHIVO', '$fechaActual', 'NO', null, '".$radio_EXH['radio_EXH_'.$i]."')"; 
//     // echo $query;
//     $mysqli->real_query($query9);
// }

// for($i = 1; $i <= $totEXHComp; $i++){
//     $query11 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', null, '".$elementoEXHComp['SelEdvBf3_'.$i]."',  '".$precioEXHComp['preEdvComp_'.$i]."', 'ARCHIVO', '$fechaActual', 'SI', '".$productoEXHComp['InpEdvBf3_'.$i]."', 'SI' ) "; 
//     // echo $query;
//     $mysqli->real_query($query11);
// }

// // $datos = array();
// // while ($fila = $resultado->fetch_assoc()) {
// //     $datos[] =  $fila;
// // }

// // return $datos;

// $mysqli->close();


//-----------------------------------------------------envio de correo---------------------------------//

// $subbject= "ALERTAS - ".$_POST["listatiendas"];

// $body="Nombre: ".$nombre . "</br>Correo: ".$correo . "</br>Telefono: ".$telefono . "</br>Mensaje: ".$mensaje;


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/Exception.php';
// require 'PHPMailer/PHPMailer.php';
// require 'PHPMailer/SMTP.php';

// // Instantiation and passing `true` enables exceptions
// $mail = new PHPMailer(true);

// try {
//     //Server settings
//     $mail->SMTPDebug = 0;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'jhonamg8@gmail.com';                     // SMTP username
//     $mail->Password   = '01123581321345589';                               // SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//     //Recipients
//     $mail->setFrom('jhonamg8@gmail.com', $nombre);
//     $mail->addAddress('mirellyagv@gmail.com', 'Mirelly');     // Add a recipient
//     $mail->addAddress('jhonamg8@gmail.com');               // Name is optional
//     // $mail->addReplyTo('info@example.com', 'Information');
//     // $mail->addCC($correo);
//     // $mail->addBCC('bcc@example.com');

//     // Attachments
//     $mail->addAttachment('D:\Xampp\htdocs\spoc-v.2\assets\img\Nueva carpeta\tottus.jpg','imagen de tottus baner');         // Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'administración';
//     $mail->Body    = $body.'</br>This is the HTML message body <b>in bold!</b>';
//     $mail->CharSet ='UTF-8';
//     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
//     echo '<script> window.history.go(-1); </script>';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }

?>