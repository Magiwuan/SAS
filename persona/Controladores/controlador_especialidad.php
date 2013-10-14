<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_especialidad.php");
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
	$especialidad = new especialidad();
	$especialidad->setNom($_POST["nombre"]);
	$iespecialidad=$especialidad->iespecialidad();
	if($iespecialidad<0){
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
	echo "Error al incluir especialidad";
	}
}
?>