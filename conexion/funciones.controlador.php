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
	}//function ctrMostrarStg4Comp
	static public function ctrMostrarStg5Prop(){
		$tienda = $_POST['tienda'];
		$respuesta = ModeloFunciones::mdlMostrarStg5Prop($tienda);
		return $respuesta;
	}//function ctrMostrarStg5Prop
	static public function ctrMostrarStg6Prop(){
		$tienda = $_POST['tienda'];
		$respuesta = ModeloFunciones::mdlMostrarStg6Prop($tienda);
		return $respuesta;
	}//function ctrMostrarStg6Prop
	static public function ctrGuardar(){
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
		for($i = 1; $i <= $totPrecioTop; $i++){
			$datosPreTop += [ "precio_top_$i" => $_POST["precio_top_$i"] ];
		}
		$datosPreTopComp = [];
		for($i = 1; $i <= $totPrecioTopComp; $i++){
			$datosPreTopComp += [ "precio_top_comp_$i" => $_POST["precio_top_comp_$i"] ];
		}
		$datosEDV = [];
		for($i = 1; $i <= $totEDV; $i++){
			$datosEDV += [ "radio_vis_$i" => $_POST["radio_vis_$i"] ];
			//falta foto
		}
		$productoEDVComp = [];
		$elementoEDVComp = [];
		for($i = 1; $i <= $totEDVComp; $i++){
			$productoEDVComp += [ "InpEdvBf2_$i" => $_POST["InpEdvBf2_$i"] ];
			$elementoEDVComp += [ "SelEdvBf2_$i" => $_POST["SelEdvBf2_$i"] ];
		}
		$datosEXH = [];
		for($i = 1; $i <= $totEXH; $i++){
			$datosEXH += [ "precio_top_comp_$i" => $_POST["precio_top_comp_$i"] ];
		}
		$datosEXHComp = [];
		for($i = 1; $i <= $totEXHComp; $i++){
			$datosEXHComp += [ "precio_top_comp_$i" => $_POST["precio_top_comp_$i"] ];
		}
		$tienda = $_POST['listatiendas'];
		$respuesta = ModeloFunciones::mdlGuardar($tienda);
		return $respuesta;
	}//function ctrGuardar
}//class ControladorFunciones
?>