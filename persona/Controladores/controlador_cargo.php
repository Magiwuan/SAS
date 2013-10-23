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
	$val_car=$cargo->valida_cargo();
	if($val_car=='0'){
		$iCargo=$cargo->iCargo();
		if($iCargo<0){
		echo "Los datos se guardaron con Exito!";
		}else{
		echo "Error al incluir cargo";
		}
	}else{
		echo "No";
	}
}


?>
