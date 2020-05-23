<?php
@session_start();
// $nombre= $_POST['enviador'];
// $correo=$_POST['respondera'];  
// $telefono="1234568, de contacto";
// $mensaje= $_POST['mensajeenviador'];

//----------------------------variables----------------------------------//

$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha.' '.$hora;
$totPrecioTop = $_POST['totPrecioTop'];
$totPrecioTopComp = $_POST['totPrecioTopComp'];
$totEDV = $_POST['totEDV'];
$totEDVComp = $_POST['totEDVComp'];
$totEXH = $_POST['totEXH'];
$totEXHComp = $_POST['totEXHComp'];
$datosPreTop = [];
$nombrePreTop = [];
for($i = 1; $i <= $totPrecioTop; $i++){
    $datosPreTop += [ "precio_top_$i" => $_POST["precio_top_$i"] ];
    $nombrePreTop += [ "id_prod_prec_top_$i" => $_POST["id_prod_prec_top_$i"] ];
}
$datosPreTopComp = [];
$nombrePreTopComp = [];

for($i = 1; $i <= $totPrecioTopComp; $i++){
    $datosPreTopComp += [ "precio_top_comp_$i" => $_POST["precio_top_comp_$i"] ];
    $nombrePreTopComp += [ "id_comp_prec_top_$i" => $_POST["id_comp_prec_top_$i"] ];
}
$datosEDV = [];
for($i = 1; $i <= $totEDV; $i++){
    $datosEDV += [ "radio_vis_$i" => $_POST["radio_vis_$i"] ];
    $datosEDV += [ "id_produc_prop_vis_$i" => $_POST["id_produc_prop_vis_$i"] ];
    $datosEDV += [ "id_elemento_vis_$i" => $_POST["id_elemento_vis_$i"] ];
    //falta foto
}
$productoEDVComp = [];
$elementoEDVComp = [];
for($i = 1; $i <= $totEDVComp; $i++){
    $productoEDVComp += [ "InpEdvBf2_$i" => $_POST["InpEdvBf2_$i"] ];
    $elementoEDVComp += [ "SelEdvBf2_$i" => $_POST["SelEdvBf2_$i"] ];
    //falta foto
}
$productoEXH = [];
$elementoEXH = [];
$precioEXH = [];
$radio_EXH = [];
for($i = 1; $i <= $totEXH; $i++){
    $productoEXH += [ "id_produc_prop_exh_$i" => $_POST["id_produc_prop_exh_$i"] ];
    $elementoEXH += [ "id_elemento_exh_$i" => $_POST["id_elemento_exh_$i"] ];
    $precioEXH += [ "precio_prop_$i" => $_POST["precio_prop_$i"] ];
    $radio_EXH += [ "radio_EXH_$i" => $_POST["radio_EXH_$i"] ];
    //falta foto
}
$productoEXHComp = [];
$elementoEXHComp = [];
$precioEXHComp = [];
for($i = 1; $i <= $totEXHComp; $i++){
    $productoEXHComp += [ "InpEdvBf3_$i" => $_POST["InpEdvBf3_$i"] ];
    $elementoEXHComp += [ "SelEdvBf3_$i" => $_POST["SelEdvBf3_$i"] ];
    $precioEXHComp += [ "preEdvComp_$i" => $_POST["preEdvComp_$i"] ];
    //falta foto
}
$tienda = $_POST['listatiendas'];

//--------------------------------------proceso de guardado---------------------------------------------//

$id_usuario = 'user1';
$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
if ($mysqli->connect_errno) {
  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$query = "SELECT id_tx FROM detalle_spoc ORDER BY id_tx DESC LIMIT 1"; 
$mysqli->real_query($query);
$resultado = $mysqli->use_result();
$idTx = $resultado->fetch_assoc();
$mysqli->close();
// echo $idTx;
if($idTx == NULL || $idTx == ''){
    $idTx = 1;
}else{
    $idTx = intval($idTx) + 1;
}

//----------------------------- precio top
$mensaje_top = '';
for($i = 1; $i <= $totPrecioTop; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query1 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`)  VALUES ($idTx, '$id_usuario', '$tienda', '".$nombrePreTop['id_prod_prec_top_'.$i]."', null, '".$datosPreTop['precio_top_'.$i]."', null, '$fechaActual', 'NO', null, 'SI') "; 
    // echo $query1;
    $mysqli->real_query($query1);
    $mysqli->close();
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
    $query2 = "SELECT DISTINCT configuraciones_tx.precio, configuraciones_tx.sku_cadena, configuraciones_tx.id_tienda, producto.dsc_producto, producto.sku_nestle FROM configuraciones_tx INNER JOIN producto ON producto.id = configuraciones_tx.id_producto WHERE (configuraciones_tx.id_producto = ".$nombrePreTop['id_prod_prec_top_'.$i]." AND configuraciones_tx.id_tienda = '$tienda')";
    // echo $query2;
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    if($fila['precio'] != $datosPreTop['precio_top_'.$i]){
        $diff = intval($datosPreTop['precio_top_'.$i])-intval($fila['precio']);
        $mensaje_top .= "Producto ".$fila['dsc_producto'].", detectado S/ ".$datosPreTop['precio_top_'.$i]." contra S/ ".$fila['precio']." (".$diff.") (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") &NewLine;";
    }
    // echo $query2;
    $mysqli->close();
}

for($i = 1; $i <= $totPrecioTopComp; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query3 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', ".$nombrePreTopComp['id_comp_prec_top_'.$i].", null, ".$datosPreTopComp['precio_top_comp_'.$i].", null, '$fechaActual', 'SI', null, 'SI') "; 
    $mysqli->real_query($query3);
    $mysqli->close();
}

// -------------------------Elementos de visibilidad
$mensaje_EDV = '';
for($i = 1; $i <= $totEDV; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query5 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', '".$datosEDV['id_produc_prop_vis_'.$i]."',  '".$datosEDV['id_elemento_vis_'.$i]."', null, 'ARCHIVO', '$fechaActual', 'NO', null, '".$datosEDV['radio_vis_'.$i]."') "; 
    // echo $query;
    $mysqli->real_query($query5);
    $mysqli->close();
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
    $query2 = "SELECT DISTINCT  configuraciones_tx.sku_cadena, producto.dsc_producto, producto.sku_nestle FROM configuraciones_tx INNER JOIN producto ON producto.id = configuraciones_tx.id_producto WHERE (configuraciones_tx.id_producto = ".$datosEDV['id_produc_prop_vis_'.$i]." AND configuraciones_tx.id_exhibicion = ".$datosEDV['id_elemento_vis_'.$i]." AND configuraciones_tx.id_tienda = '$tienda')";
    // echo $query2;
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    if($datosEDV['radio_vis_'.$i] == 'NO'){
        $mensaje_EDV .= "Producto ".$fila['dsc_producto']." NO encontrado (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") &NewLine;";
    }
    $mysqli->close();
}

for($i = 1; $i <= $totEDVComp; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query7 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', null,  '".$elementoEDVComp['SelEdvBf2_'.$i]."', null, 'ARCHIVO', '$fechaActual', 'SI', '".$productoEDVComp['InpEdvBf2_'.$i]."', 'SI')"; 
    // echo $query;
    $mysqli->real_query($query7);
    $mysqli->close();
}

// --------------------------------Exhibiciones
$mensaje_EXH = '';
for($i = 1; $i <= $totEXH; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query9 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', '".$productoEXH['id_produc_prop_exh_'.$i]."',  '".$elementoEXH['id_elemento_exh_'.$i]."', '".$precioEXH['precio_prop_'.$i]."', 'ARCHIVO', '$fechaActual', 'NO', null, '".$radio_EXH['radio_EXH_'.$i]."')"; 
    // echo $query;
    $mysqli->real_query($query9);
    $mysqli->close();
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
    $query2 = "SELECT DISTINCT  configuraciones_tx.sku_cadena, configuraciones_tx.precio, producto.dsc_producto, producto.sku_nestle FROM configuraciones_tx INNER JOIN producto ON producto.id = configuraciones_tx.id_producto WHERE (configuraciones_tx.id_producto = ".$productoEXH['id_produc_prop_exh_'.$i]." AND configuraciones_tx.id_exhibicion = ".$elementoEXH['id_elemento_exh_'.$i]." AND configuraciones_tx.id_tienda = '$tienda')";
    // echo $query2;
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    if($radio_EXH['radio_EXH_'.$i] == 'NO'){
        $mensaje_EXH .= "Producto ".$fila['dsc_producto']." NO encontrado (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") &NewLine;";
    }else if($radio_EXH['radio_EXH_'.$i] == 'SI' && $fila['precio'] != $precioEXH['precio_prop_'.$i]){
        $diff = intval($precioEXH['precio_prop_'.$i])-intval($fila['precio']);
        $mensaje_EXH .= "Producto ".$fila['dsc_producto'].", detectado S/ ".$precioEXH['precio_prop_'.$i]." contra S/ ".$fila['precio']." (".$diff.") (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") &NewLine;";
    }
    $mysqli->close();
}

for($i = 1; $i <= $totEXHComp; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query11 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', null, '".$elementoEXHComp['SelEdvBf3_'.$i]."',  '".$precioEXHComp['preEdvComp_'.$i]."', 'ARCHIVO', '$fechaActual', 'SI', '".$productoEXHComp['InpEdvBf3_'.$i]."', 'SI' ) "; 
    // echo $query;
    $mysqli->real_query($query11);
    $mysqli->close();
}


// $mysqli->close();


//-----------------------------------------------------envio de correo---------------------------------//

$mensaje = '';
if($mensaje_top != ''){
    $mensaje = "PRECIOS TOP: </br>".$mensaje_top."</br>";
}
if($mensaje_EDV != ''){
    $mensaje = "VISIBILIDAD: </br>".$mensaje_EDV."</br>";
}
if($mensaje_EXH != ''){
    $mensaje = "EXHIBICIONES: </br>".$mensaje_EXH."</br>";
}

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

$subbject= "ALERTAS - ".$_POST["listatiendas"];

$body="<b>Spoc:</b> ".$id_usuario."</br><b>Tienda:</b> ".$fila1['id']." | ".$fila1['dsc_tienda']." | ".$fila1['dsc_ubicacion']."</br><b>Fecha y hora:</b> ".$fechaActual."</br><b>Mensaje:</b> ".$mensaje;


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
    $mail->setFrom('jhonamg8@gmail.com', 'Jhon');
    $mail->addAddress('mirellyagv@gmail.com', 'Mirelly');     // Add a recipient
    $mail->addAddress('jhonamg8@gmail.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC($correo);
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('D:\Xampp\htdocs\spoc-v.2\assets\img\Nueva carpeta\tottus.jpg','imagen de tottus baner');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'ALERTAS - '.$fila1['dsc_tienda'];
    $mail->Body    = $body.'</br>This is the HTML message body <b>in bold!</b>';
    $mail->CharSet ='UTF-8';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if($mensaje_top != '' || $mensaje_EXH != '' || $mensaje_EDV != ''){
        $mail->send();
    }
    echo 'Message has been sent';
    echo '<script> window.history.go(-1); </script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?>