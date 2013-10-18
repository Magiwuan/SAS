<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_profesion.php");
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
	$profesion = new profesion();
	$profesion->setNom($_POST["nombre"]);	
	$val_profes=$profesion->valida_profesion();
	if($val_profes=='-1'){
		$iProfesion=$profesion->iProfesion();
		if($iProfesion<0){
		echo "Los datos se guardaron con Exito!!!";
		exit();
		}else{
		 echo "Error al incluir Profesión";
		}
	}else{
		echo "La profesión ya existe!";
	}
	
}
?>
