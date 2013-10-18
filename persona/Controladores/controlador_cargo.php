<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_cargo.php");
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
	$cargo = new cargo();
	$cargo->setNom($_POST["nombre"]);
	$val_cargo=$cargo->valida_cargo();
	$iCargo=$cargo->iCargo();
	if($val_cargo=='-1'){
		if($iCargo<0){
		echo "Los datos se guardaron con Exito!!!";
		exit();
		}else{
		echo "Error al incluir cargo";
		}
	}else{
		echo "El cargo ya existe!";
	}
}


?>