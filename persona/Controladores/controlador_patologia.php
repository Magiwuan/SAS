<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_patologia.php");
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
	$patologia = new patologia();
	$patologia->setNom($_POST["nombre"]);
	$val_pat=$patologia->valida_patologia();
	if($val_pat=='0'){
		$ipatologia=$patologia->ipatologia();
		if($ipatologia<0){
			echo "Los datos se guardaron con Exito!";
		}else{
			echo "Error al incluir patologia";
		}
	}else{
		echo "No";
	}
}
?>
