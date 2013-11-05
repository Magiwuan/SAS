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
	$val_espe=$especialidad->valida_especialidad();
	if($val_espe=='0'){
		if($iespecialidad<0){
			echo "Los datos se guardaron con Exito!";	
		}else{
			echo "Error al incluir especialidad";
		}
	}else{
		echo "No";
	}
}
?>
