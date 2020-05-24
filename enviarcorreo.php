<?php
@session_start();
// $nombre= $_POST['enviador'];
// $correo=$_POST['respondera'];  
// $telefono="1234568, de contacto";
// $mensaje= $_POST['mensajeenviador'];
//----------------------------variables----------------------------------//

$dir_subida = 'assets/img/';
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
    // $nombrefoto="'prop_vis_".$i."'";
    $datosEDV += [ "radio_vis_$i" => $_POST["radio_vis_$i"] ];
    $datosEDV += [ "id_produc_prop_vis_$i" => $_POST["id_produc_prop_vis_$i"] ];
    $datosEDV += [ "id_elemento_vis_$i" => $_POST["id_elemento_vis_$i"] ];
    $datosEDV += [ "foto_vis_$i" => $_FILES['prop_vis_'.$i]['name'] ]; //-----------------aqui foto
    $datosEDV += [ "foto_vis_temp_$i" => $_FILES['prop_vis_'.$i]['tmp_name'] ];

}
$productoEDVComp = [];
$elementoEDVComp = [];
$fotoEDVComp = [];
for($i = 1; $i <= $totEDVComp; $i++){
    // $nombrefotoEDVComp= "'carga_".$i."'";
    $productoEDVComp += [ "InpEdvBf2_$i" => $_POST["InpEdvBf2_$i"] ];
    $elementoEDVComp += [ "SelEdvBf2_$i" => $_POST["SelEdvBf2_$i"] ];
    $fotoEDVComp += [ "foto_vis_comp_$i" => $_FILES['carga_'.$i]['name'] ]; ///-----------------aqui foto
    $fotoEDVComp += [ "foto_vis_comp_temp_$i" => $_FILES['carga_'.$i]['tmp_name'] ];
}
$productoEXH = [];
$elementoEXH = [];
$precioEXH = [];
$radio_EXH = [];
$foto_EXH = [];
for($i = 1; $i <= $totEXH; $i++){
    $productoEXH += [ "id_produc_prop_exh_$i" => $_POST["id_produc_prop_exh_$i"] ];
    $elementoEXH += [ "id_elemento_exh_$i" => $_POST["id_elemento_exh_$i"] ];
    $precioEXH += [ "precio_prop_$i" => $_POST["precio_prop_$i"] ];
    $radio_EXH += [ "radio_EXH_$i" => $_POST["radio_EXH_$i"] ];
    $foto_EXH += [ "foto_exh_$i" => $_FILES['prop2_EXH_'.$i]['name'] ]; ///-----------------aqui foto
    $foto_EXH += [ "foto_exh_temp_$i" => $_FILES['prop2_EXH_'.$i]['tmp_name'] ];
    
}
$productoEXHComp = [];
$elementoEXHComp = [];
$precioEXHComp = [];
$foto_EXHComp = [];
for($i = 1; $i <= $totEXHComp; $i++){
    $productoEXHComp += [ "InpEdvBf3_$i" => $_POST["InpEdvBf3_$i"] ];
    $elementoEXHComp += [ "SelEdvBf3_$i" => $_POST["SelEdvBf3_$i"] ];
    $precioEXHComp += [ "preEdvComp_$i" => $_POST["preEdvComp_$i"] ];
    $foto_EXHComp += [ "foto_exh_Comp_$i" => $_FILES['carga2_'.$i]['name'] ]; //-----------------aqui foto
    $foto_EXHComp += [ "foto_exh_Comp_temp_$i" => $_FILES['carga2_'.$i]['tmp_name'] ];
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
    $mysqli->real_query($query1);
    $mysqli->close();

    //----------------------------correo

    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
    $query2 = "SELECT DISTINCT configuraciones_tx.precio, configuraciones_tx.sku_cadena, configuraciones_tx.id_tienda, producto.dsc_producto, producto.sku_nestle FROM configuraciones_tx INNER JOIN producto ON producto.id = configuraciones_tx.id_producto WHERE (configuraciones_tx.id_producto = ".$nombrePreTop['id_prod_prec_top_'.$i]." AND configuraciones_tx.id_tienda = '$tienda')";
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    if($fila['precio'] != $datosPreTop['precio_top_'.$i]){
        $diff = intval($datosPreTop['precio_top_'.$i])-intval($fila['precio']);
        $mensaje_top .= "Producto ".$fila['dsc_producto'].", detectado S/ ".$datosPreTop['precio_top_'.$i]." contra S/ ".$fila['precio']." (".$diff.") (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") </br>";
    }
    $mysqli->close();
}

$mensaje_top_comp = '';
for($i = 1; $i <= $totPrecioTopComp; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $query3 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', ".$nombrePreTopComp['id_comp_prec_top_'.$i].", null, ".$datosPreTopComp['precio_top_comp_'.$i].", null, '$fechaActual', 'SI', null, 'SI') "; 
    $mysqli->real_query($query3);
    $mysqli->close();

    //----------------------------correo

    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
    $query2 = "SELECT  dsc_competencia FROM competencia  WHERE id = ".$nombrePreTopComp['id_comp_prec_top_'.$i];
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    $mensaje_top_comp .= "Producto ".$fila['dsc_competencia'].", detectado S/ ".$datosPreTopComp['precio_top_comp_'.$i]." </br>";
    $mysqli->close();
}

// -------------------------Elementos de visibilidad
$mensaje_EDV = '';
for($i = 1; $i <= $totEDV; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    //////////////////variables para transformacion del img//////////////////////////
    $nombre_foto_correo = 'EDV'.$id_usuario.'_'.$fecha.'_'.$i.'.jpg'; ///<---AQUI ES LA VARIABLE QUE RENOMBRA EL ARCHIVO .JPG///
    $direc_img_en_bd = $dir_subida.$nombre_foto_correo;  ///<---DIRECCION DEFINITIVA DEL IMG EN LA BD


    $nombre_archivo= $datosEDV['foto_vis_'.$i];            ///<---NAME DEL ELEMNTO IMG EN EL DISPOSITIVO/////////
    $nombre_archivo_temp= $datosEDV['foto_vis_temp_'.$i];  ///<---NAME DE UBICACION TEMPORAL DEL ELEMENTO IMG EN EL DISPOSITIVO////


    $fichero_subido = $dir_subida.basename($nombre_archivo); ///<---LA UBICACION DEFINITIVA DEL IMG CON EL NOMBRE VIEJO DEL DISPOSITIVO

    ///////////CArga del file img en la bd//////////////////
    if (move_uploaded_file($nombre_archivo_temp, $fichero_subido)) {                   ///<---SUBIDA DE LA IMG DESDE EL DISPOSITIVO A LA BD///
        rename ( $fichero_subido , $direc_img_en_bd );                              /////<----AQUI LA FUNCION QUE RENOMBRA EL ARCHIVO IMG EN LA BD.
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }

    echo 'Más información de depuración:';
    print_r($_FILES);
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





    $query5 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', '".$datosEDV['id_produc_prop_vis_'.$i]."',  '".$datosEDV['id_elemento_vis_'.$i]."', null, '$direc_img_en_bd', '$fechaActual', 'NO', null, '".$datosEDV['radio_vis_'.$i]."') "; 
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
        $mensaje_EDV .= "Producto ".$fila['dsc_producto']." NO encontrado (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") </br>";
    }
    $mysqli->close();
}

$mensaje_EDV_comp = '';
$foto_EDV_COMP= '';
for($i = 1; $i <= $totEDVComp; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    //////////////////variables para transformacion del img//////////////////////////
    $nombre_foto_correo = 'EDV_COMP_'.$id_usuario.'_'.$fecha.'_'.$i.'.jpg'; ///<---AQUI ES LA VARIABLE QUE RENOMBRA EL ARCHIVO .JPG///
    $direc_img_en_bd = $dir_subida.$nombre_foto_correo;  ///<---DIRECCION DEFINITIVA DEL IMG EN LA BD


    $nombre_archivo= $fotoEDVComp['foto_vis_comp_'.$i];            ///<---NAME DEL ELEMNTO IMG EN EL DISPOSITIVO/////////
    $nombre_archivo_temp= $fotoEDVComp['foto_vis_comp_temp_'.$i];  ///<---NAME DE UBICACION TEMPORAL DEL ELEMENTO IMG EN EL DISPOSITIVO////

    $fichero_subido = $dir_subida.basename($nombre_archivo); ///<---LA UBICACION DEFINITIVA DEL IMG CON EL NOMBRE VIEJO DEL DISPOSITIVO
    // echo'</br>';
    // print_r($nombre_archivo_temp);
    // echo'</br>';
    // print_r($fichero_subido);
    // echo'</br>';
    // print_r($direc_img_en_bd);
    // echo'</br>';
    // print_r($nombre_foto_correo);
    // echo'</br>';
    ///////////CArga del file img en la bd//////////////////
    if (move_uploaded_file( $nombre_archivo_temp, $fichero_subido)) {                   ///<---SUBIDA DE LA IMG DESDE EL DISPOSITIVO A LA BD///
        rename ( $fichero_subido , $direc_img_en_bd );                              /////<----AQUI LA FUNCION QUE RENOMBRA EL ARCHIVO IMG EN LA BD.
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }
    
    // $foto_EDV_COMP .= $mail2->addAttachment('$direc_img_en_bd');
    echo '</br> Más información de depuración:';
    print_r($_FILES);
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $query7 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', null,  '".$elementoEDVComp['SelEdvBf2_'.$i]."', null, '$direc_img_en_bd', '$fechaActual', 'SI', '".$productoEDVComp['InpEdvBf2_'.$i]."', 'SI')"; 
    // echo $query;
    $mysqli->real_query($query7);
    $mysqli->close();

    //----------------------------correo

    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
    $query2 = "SELECT  dsc_exhibicion FROM exhibiciones WHERE id = ".$elementoEDVComp['SelEdvBf2_'.$i];
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    $mensaje_EDV_comp .= "Detectado ".$fila['dsc_exhibicion']." de ".$productoEDVComp['InpEdvBf2_'.$i].", (Ref. <b>".$nombre_foto_correo."</b>) </br>";
    $mysqli->close();
}

// --------------------------------Exhibiciones
$mensaje_EXH = '';
for($i = 1; $i <= $totEXH; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    //////////////////variables para transformacion del img//////////////////////////
    $nombre_foto_correo = 'EXH_'.$id_usuario.'_'.$fecha.'_'.$i.'.jpg'; ///<---AQUI ES LA VARIABLE QUE RENOMBRA EL ARCHIVO .JPG///
    $direc_img_en_bd = $dir_subida.$nombre_foto_correo;  ///<---DIRECCION DEFINITIVA DEL IMG EN LA BD


    $nombre_archivo= $foto_EXH['foto_exh_'.$i];            ///<---NAME DEL ELEMNTO IMG EN EL DISPOSITIVO/////////
    $nombre_archivo_temp= $foto_EXH['foto_exh_temp_'.$i];  ///<---NAME DE UBICACION TEMPORAL DEL ELEMENTO IMG EN EL DISPOSITIVO////

    $fichero_subido = $dir_subida.basename($nombre_archivo); ///<---LA UBICACION DEFINITIVA DEL IMG CON EL NOMBRE VIEJO DEL DISPOSITIVO

    ///////////CArga del file img en la bd//////////////////
    if (move_uploaded_file($nombre_archivo_temp, $fichero_subido)) {                   ///<---SUBIDA DE LA IMG DESDE EL DISPOSITIVO A LA BD///
        rename ( $fichero_subido , $direc_img_en_bd );                              /////<----AQUI LA FUNCION QUE RENOMBRA EL ARCHIVO IMG EN LA BD.
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }

    echo 'Más información de depuración:';
    print_r($_FILES);
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $query9 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', '".$productoEXH['id_produc_prop_exh_'.$i]."',  '".$elementoEXH['id_elemento_exh_'.$i]."', '".$precioEXH['precio_prop_'.$i]."', '$direc_img_en_bd', '$fechaActual', 'NO', null, '".$radio_EXH['radio_EXH_'.$i]."')"; 
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
        $mensaje_EXH .= "Producto ".$fila['dsc_producto']." NO encontrado (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") </br>";
    }else if($radio_EXH['radio_EXH_'.$i] == 'SI' && $fila['precio'] != $precioEXH['precio_prop_'.$i]){
        $diff = intval($precioEXH['precio_prop_'.$i])-intval($fila['precio']);
        $mensaje_EXH .= "Producto ".$fila['dsc_producto'].", detectado S/ ".$precioEXH['precio_prop_'.$i]." contra S/ ".$fila['precio']." (".$diff.") (Ref:  SKU Nestle: ".$fila['sku_nestle'].", SKU Cadena: ".$fila['sku_cadena'].") </br>";
    }
    $mysqli->close();
}

$mensaje_EXH_comp = '';
for($i = 1; $i <= $totEXHComp; $i++){
    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    //////////////////variables para transformacion del img//////////////////////////
    $nombre_foto_correo = 'EXH_COMP_'.$id_usuario.'_'.$fecha.'_'.$i.'.jpg'; ///<---AQUI ES LA VARIABLE QUE RENOMBRA EL ARCHIVO .JPG///
    $direc_img_en_bd = $dir_subida.$nombre_foto_correo;  ///<---DIRECCION DEFINITIVA DEL IMG EN LA BD


    $nombre_archivo= $foto_EXHComp['foto_exh_Comp_'.$i];            ///<---NAME DEL ELEMNTO IMG EN EL DISPOSITIVO/////////
    $nombre_archivo_temp= $foto_EXHComp['foto_exh_Comp_temp_'.$i];  ///<---NAME DE UBICACION TEMPORAL DEL ELEMENTO IMG EN EL DISPOSITIVO////

    $fichero_subido = $dir_subida.basename($nombre_archivo); ///<---LA UBICACION DEFINITIVA DEL IMG CON EL NOMBRE VIEJO DEL DISPOSITIVO

    ///////////CArga del file img en la bd//////////////////
    if (move_uploaded_file($nombre_archivo_temp, $fichero_subido)) {                   ///<---SUBIDA DE LA IMG DESDE EL DISPOSITIVO A LA BD///
        rename ( $fichero_subido , $direc_img_en_bd );                              /////<----AQUI LA FUNCION QUE RENOMBRA EL ARCHIVO IMG EN LA BD.
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }

    echo 'Más información de depuración:';
    print_r($_FILES);
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $query11 = "INSERT INTO `detalle_spoc`(`id_tx`, `id_usuario`, `id_tienda`, `id_producto`, `id_exhibicion`, `precio`, `foto`, `fecha_carga`, `flg_competencia`, `dsc_competencia`, `flg_existe`) VALUES ($idTx, '$id_usuario', '$tienda', null, '".$elementoEXHComp['SelEdvBf3_'.$i]."',  '".$precioEXHComp['preEdvComp_'.$i]."', '$direc_img_en_bd', '$fechaActual', 'SI', '".$productoEXHComp['InpEdvBf3_'.$i]."', 'SI' ) "; 
    // echo $query;
    $mysqli->real_query($query11);
    $mysqli->close();

    //----------------------------correo

    $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
    if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }    
     $query2 = "SELECT  dsc_exhibicion FROM exhibiciones WHERE id = ".$elementoEXHComp['SelEdvBf3_'.$i];
    $mysqli->real_query($query2);
    $resultado = $mysqli->use_result();
    $fila = $resultado->fetch_assoc();
    $mensaje_EXH_comp .=  "Detectado ".$fila['dsc_exhibicion']." de ".$productoEXHComp['InpEdvBf3_'.$i].", precio S/ ".$precioEXHComp['preEdvComp_'.$i].", (Ref. <b>".$nombre_foto_correo."</b>) </br>";
    $mysqli->close();


}

//-----------------------------------------------------envio de correo---------------------------------//

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
    for($i = 1; $i <= $totEDVComp ; $i++){
        $mail2->addAttachment($dir_subida.'EDV_COMP_'.$id_usuario.'_'.$fecha.'_'.$i.'.jpg');
    }
    for($i = 1; $i <= $totEXHComp ; $i++){
        $mail2->addAttachment($dir_subida.'EXH_COMP_'.$id_usuario.'_'.$fecha.'_'.$i.'.jpg');
    }
    //$foto_EDV_COMP;
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

?>