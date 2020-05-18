<?php
@session_start();
class ControladorFunciones{
	static public function ctrMostrarDistrito(){
		$_SESSION['banner'] = $_POST['banner'];
		$respuesta = ModeloFunciones::mdlMostrardistrito();
		return $respuesta;
	}//function ctrMostrarDistrito
	static public function ctrMostrarTiendas(){
		$distrito = $_POST['distrito'];
		$respuesta = ModeloFunciones::mdlMostrarTiendas($distrito);
		return $respuesta;
	}//function ctrMostrarTiendas
	static public function ctrMostrarStg4Propios(){
		$tienda = $_POST['tienda'];
		$respuesta = ModeloFunciones::mdlMostrarStg4Propios($tienda);
		return $respuesta;
	}//function ctrMostrarStg4Propios
	static public function ctrMostrarStg4Comp(){
		$tienda = $_POST['tienda'];
		$respuesta = ModeloFunciones::mdlMostrarStg4Comp($tienda);
		return $respuesta;
	}//function ctrMostrarStg4Propios
}//class ControladorFunciones
?>