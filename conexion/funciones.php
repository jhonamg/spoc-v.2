<?php
@session_start();
require_once "funciones.controlador.php";
require_once "funciones.modelo.php";
class Funciones{
	public function ajaxListaDistrito(){
		$respuesta = ControladorFunciones::ctrMostrarDistrito();
		echo json_encode($respuesta);
	}//function ajaxListaDistrito
	public function ajaxListaTiendas(){
		$respuesta = ControladorFunciones::ctrMostrarTiendas();
		echo json_encode($respuesta);
	}//function ajaxListaTiendas
	public function ajaxListaStg4Propios(){
		$respuesta = ControladorFunciones::ctrMostrarStg4Propios();
		echo json_encode($respuesta);
	}//function ajaxListaStg4Propios
	public function ajaxListaStg4Comp(){
		$respuesta = ControladorFunciones::ctrMostrarStg4Comp();
		echo json_encode($respuesta);
	}//function ajaxListaStg4Comp
	public function ajaxListaStg5Prop(){
		$respuesta = ControladorFunciones::ctrMostrarStg5Prop();
		echo json_encode($respuesta);
	}//function ajaxListaStg5Prop
	public function ajaxListaStg6Prop(){
		$respuesta = ControladorFunciones::ctrMostrarStg6Prop();
		echo json_encode($respuesta);
	}//function ajaxListaStg6Prop
	public function ajaxGuardar(){
		$respuesta = ControladorFunciones::ctrGuardar();
		echo json_encode($respuesta);
	}//function ajaxGuardar
}//class Funciones
/*=============================================
ACCIONES
=============================================*/
if(isset($_POST["entrada"]) && $_POST["entrada"] == 'verDistrito'){
	$cliente = new Funciones();
	$cliente -> ajaxListaDistrito();	
}else if(isset($_POST["entrada"]) && $_POST["entrada"] == 'verTiendas'){
	$cliente = new Funciones();
	$cliente -> ajaxListaTiendas();
}else if(isset($_POST["entrada"]) && $_POST["entrada"] == 'stg4Propios'){
	$cliente = new Funciones();
	$cliente -> ajaxListaStg4Propios();
}else if(isset($_POST["entrada"]) && $_POST["entrada"] == 'stg4Comp'){
	$cliente = new Funciones();
	$cliente -> ajaxListaStg4Comp();
}else if(isset($_POST["entrada"]) && $_POST["entrada"] == 'stg5Prop'){
	$cliente = new Funciones();
	$cliente -> ajaxListaStg5Prop();
}else if(isset($_POST["entrada"]) && $_POST["entrada"] == 'stg6Prop'){
	$cliente = new Funciones();
	$cliente -> ajaxListaStg6Prop();
}else if(isset($_POST["entrada"]) && $_POST["entrada"] == 'guardar'){
	$cliente = new Funciones();
	$cliente -> ajaxGuardar();
}

