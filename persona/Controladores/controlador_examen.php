<?php
//--------------------------------------------------------------------
// Llamado a la clase a usarse
//--------------------------------------------------------------------
include_once("../Clases/clase_examen.php");
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
//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
function incluir(){
	$examen = new examen();
	$examen->setDescripcion($_POST["nombre"]);
	$examen->setTipoexamen($_POST["tipo"]);
	$iExamen=$examen->iExamen();
	if($iExamen<0)
	{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
	echo "Error al incluir Examen";
	}
}


?>