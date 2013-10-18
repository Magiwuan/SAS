<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_cobertura.php");
$ope = $_POST['ope'];
switch($ope){
  case "I":	{
	incluir();
	break;
	}
  case "B":{
	buscar();
	break;
	}
}
//       Funcion para Registrar
function incluir(){
	$cobertura = new cobertura();
	$cobertura->setDesc($_POST["descripcion"]);
	$cobertura->setTipo($_POST["tipo"]);
	$plata=str_replace("Bs ","",$_POST['monto']);
	$cobertura->setMonto($plata);
	$cobertura->setFecha_ini($_POST["fecha_inicio"]);
	$cobertura->setFecha_fin($_POST["fecha_fin"]);
	if($cobertura->iCobertura()){		
	echo "Se agregaron los Datos con exito¡¡¡¡";
	}
	else
	echo "Error al incluir cobertura";
}
?>
