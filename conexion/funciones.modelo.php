<?php
@session_start();
class ModeloFunciones{
	static public function conexion(){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		return $mysqli;
	}//function conexion

	static public function mdlMostrardistrito(){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT dsc_ubicacion, id FROM ubicacion"; 

		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrardistrito

	static public function mdlMostrarTiendas($distrito){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT dsc_tienda, id FROM tienda WHERE id_ubicacion = ".$distrito. " AND id_banner = ".$_SESSION['banner']; 
		// echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrarTiendas

	static public function mdlMostrarStg4Propios($tienda){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT DISTINCT configuraciones_tx.id_producto, producto.dsc_producto FROM configuraciones_tx INNER JOIN producto ON configuraciones_tx.id_producto = producto.id WHERE configuraciones_tx.id_banner = ".$_SESSION['banner']; 
		// echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrarStg4Propios

	static public function mdlMostrarStg4Comp($tienda){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT DISTINCT dsc_competencia, id FROM competencia WHERE id_banner = ".$_SESSION['banner']; 
		// echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrarStg4Comp

	static public function mdlMostrarStg5Prop($tienda){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT producto.dsc_producto, producto.id AS id_producto, exhibiciones.id AS id_exhibicion, exhibiciones.dsc_exhibicion FROM configuraciones_tx INNER JOIN producto ON producto.id = configuraciones_tx.id_producto INNER JOIN exhibiciones ON exhibiciones.id = configuraciones_tx.id_exhibicion WHERE exhibiciones.tipo = 'EDV' AND configuraciones_tx.id_tienda = ".$tienda; 
		// echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrarStg5Prop

	static public function mdlMostrarStg6Prop($tienda){
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT producto.dsc_producto, producto.id AS id_producto, exhibiciones.id AS id_exhibicion, exhibiciones.dsc_exhibicion FROM configuraciones_tx INNER JOIN producto ON producto.id = configuraciones_tx.id_producto INNER JOIN exhibiciones ON exhibiciones.id = configuraciones_tx.id_exhibicion WHERE exhibiciones.tipo = 'EXH' AND configuraciones_tx.id_tienda = ".$tienda; 
		// echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrarStg6Prop

	static public function mdlGuardar($tienda, $fechaActual, $totPrecioTop, $totPrecioTopComp, $totEDV, $totEDVComp, $totEXH, $totEXHComp, $datosPreTop, $nombrePreTop, $datosPreTopComp, $nombrePreTopComp, $datosEDV, $productoEDVComp, $elementoEDVComp, $productoEXH, $elementoEXH, $precioEXH, $productoEXHComp, $elementoEXHComp, $precioEXHComp){
		$id_usuario = 'user1';
		$mysqli = new mysqli("localhost", "root", "", "spoc_bd");
		if ($mysqli->connect_errno) {
		  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT id_tx FROM detalle_spoc ORDER BY id_tx DESC LIMIT 1"; 
		// echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		$idTx = $resultado->fetch_assoc();
		if($idTx == null || $idTx == ''){
			$idTx = 1;
		}else{
			$idTx = $idTx + 1;
		}
		
		//----------------------------- precio top
		for($i = 1; $i <= $totPrecioTop; $i++){
			$query = "INSERT INTO detalle_spoc (id_tx', 'id_usuario', 'id_tienda', 'id_producto', 'id_exhibicion', 'precio', 'foto', 'fecha_carga', 'flg_competencia', 'dsc_competencia', 'flg_existe') VALUES ($idTx, $id_usuario, $tienda, ".$nombrePreTop['id_prod_prec_top_'.$i].", null, ".$datosPreTop['precio_top_'.$i].", null, $fechaActual, 'NO', null, 'SI') "; 
			// echo $query;
			$mysqli->real_query($query);
		}

		for($i = 1; $i <= $totPrecioTopComp; $i++){
			$query = "INSERT INTO detalle_spoc (id_tx', 'id_usuario', 'id_tienda', 'id_producto', 'id_exhibicion', 'precio', 'foto', 'fecha_carga', 'flg_competencia', 'dsc_competencia', 'flg_existe') VALUES ($idTx, $id_usuario, $tienda, ".$nombrePreTopComp['id_comp_prec_top_'.$i].", null, ".$datosPreTopComp['precio_top_comp_'.$i].", null, $fechaActual, 'SI', null, 'SI') "; 
			// echo $query;
			$mysqli->real_query($query);
		}

		// -------------------------Elementos de visibilidad
		for($i = 1; $i <= $totEDV; $i++){
			$query = "INSERT INTO detalle_spoc (id_tx', 'id_usuario', 'id_tienda', 'id_producto', 'id_exhibicion', 'precio', 'foto', 'fecha_carga', 'flg_competencia', 'dsc_competencia', 'flg_existe') VALUES ($idTx, $id_usuario, $tienda, ".$datosEDV['id_produc_prop_vis_'.$i].",  ".$datosEDV['id_elemento_vis_'.$i].", null, 'ARCHIVO', $fechaActual, 'NO', null, ".$datosEDV['radio_vis_'.$i]." ) "; 
			// echo $query;
			$mysqli->real_query($query);
		}

		for($i = 1; $i <= $totEDVComp; $i++){
			$query = "INSERT INTO detalle_spoc (id_tx', 'id_usuario', 'id_tienda', 'id_producto', 'id_exhibicion', 'precio', 'foto', 'fecha_carga', 'flg_competencia', 'dsc_competencia', 'flg_existe') VALUES ($idTx, $id_usuario, $tienda, null,  ".$elementoEDVComp['SelEdvBf2_'.$i].", null, 'ARCHIVO', $fechaActual, 'SI', ".$productoEDVComp['InpEdvBf2_'.$i].", 'SI' ) "; 
			// echo $query;
			$mysqli->real_query($query);
		}

		// --------------------------------Exhibiciones
		for($i = 1; $i <= $totEXH; $i++){
			$query = "INSERT INTO detalle_spoc (id_tx', 'id_usuario', 'id_tienda', 'id_producto', 'id_exhibicion', 'precio', 'foto', 'fecha_carga', 'flg_competencia', 'dsc_competencia', 'flg_existe') VALUES ($idTx, $id_usuario, $tienda, ".$productoEXH['id_produc_prop_exh_'.$i].",  ".$elementoEXH['id_elemento_exh_'.$i].", ".$precioEXH['precio_prop_'.$i].", 'ARCHIVO', $fechaActual, 'NO', null, ".$radio_EXH['radio_EXH_'.$i]." ) "; 
			// echo $query;
			$mysqli->real_query($query);
		}

		for($i = 1; $i <= $totEXHComp; $i++){
			$query = "INSERT INTO detalle_spoc (id_tx', 'id_usuario', 'id_tienda', 'id_producto', 'id_exhibicion', 'precio', 'foto', 'fecha_carga', 'flg_competencia', 'dsc_competencia', 'flg_existe') VALUES ($idTx, $id_usuario, $tienda, null,  ".$elementoEXHComp['SelEdvBf3_'.$i].",  ".$precioEXHComp['preEdvComp_'.$i].", 'ARCHIVO', $fechaActual, 'SI', ".$productoEXHComp['InpEdvBf3_'.$i].", 'SI' ) "; 
			// echo $query;
			$mysqli->real_query($query);
		}

		// $datos = array();
		// while ($fila = $resultado->fetch_assoc()) {
		//     $datos[] =  $fila;
		// }

		// return $datos;
		$mysqli->close();
	}//function mdlGuardar
}//class ModeloFunciones
?>