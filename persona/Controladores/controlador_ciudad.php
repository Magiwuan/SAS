<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_ciudad.php");
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
	$ciudad = new ciudad();
	$ciudad->setNom($_POST["nombre"]);
	$ciudad->setidEstado($_POST["estado"]);
	$iCiudad=$ciudad->iCiudad();
	if($iCiudad<0)
	{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
	echo "Error al incluir ciudad";
	}
	
}
?>