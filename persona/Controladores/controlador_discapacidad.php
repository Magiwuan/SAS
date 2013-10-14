<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_discapacidad.php");
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
	$discapacidad = new discapacidad();
	$discapacidad->setNom($_POST["nombre"]);
	$iDiscapacidad=$discapacidad->iDiscapacidad();
	if($iDiscapacidad<0)
{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
    echo "Error al incluir discapacidad";
	}
	
}
?>