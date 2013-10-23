<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_estado.php");
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
}
//       Funcion para Registrar
function incluir(){
	$estado = new estado();
	$estado->setNom($_POST["nombre"]);
	$estado->setidPais($_POST["pais"]);
	$val_estado=$estado->valida_estado();
	if($val_estado==0){
		$iEstado=$estado->iEstado();
		if($iEstado<0){
			echo "Los datos se guardaron con Exito!";
		}else{
			echo "Error al incluir estado";
		}
	}else{
		echo "No";
	}
	
}


?>
