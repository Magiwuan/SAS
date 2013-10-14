<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_servicio.php");
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
  case "M":	{	
  	modificar();
	break;
	}
  case "zzz":{
	break;
	}
}
//       Funcion para Registrar
function incluir(){
	$servicio = new servicio();
	$servicio->setNom($_POST["nombre"]);
	$servicio->setDescripcion($_POST["descripcion"]);
	$iServicio=$servicio->iServicio();
	if($iServicio<0)
	{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
	echo "Error al incluir Servicio";
	}
}
?>