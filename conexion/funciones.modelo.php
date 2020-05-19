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
		$query = "SELECT DISTINCT dsc_competencia FROM competencia WHERE id_banner = ".$_SESSION['banner']; 
		echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();

		$datos = array();
		while ($fila = $resultado->fetch_assoc()) {
		    $datos[] =  $fila;
		}

		return $datos;
		$mysqli->close();
	}//function mdlMostrarStg4Comp
}//class ModeloFunciones
?>