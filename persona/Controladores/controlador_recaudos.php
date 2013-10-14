<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_recaudo.php");
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
	$recaudos = new recaudos();
	$recaudos->setDescripcion($_POST["nombre"]);
	$recaudos->setTiporecaudo($_POST["tipo"]);
	$iRecaudos=$recaudos->iRecaudos();
	if($iRecaudos<0)
	{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
	echo "Error al incluir Recaudos";
	}
}


?>