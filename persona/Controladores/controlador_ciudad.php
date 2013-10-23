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
	$val_city=$ciudad->valida_ciudad();
	if($val_city==0){
		if($iCiudad<0){
			echo "Los datos se guardaron con Exito!";
		}else{
			echo "Error al incluir ciudad";
		}
	}else{
	 echo "No";	
	}
}
?>
