<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_medicamento.php");
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
	$medicamento = new medicamento();
	$medicamento->setNom($_POST["nombre"]);
	$medicamento->setPres($_POST["presentacion"]);
	$medicamento->setComp($_POST["componente"]);
	$iMedicamento=$medicamento->iMedicamento();
	if($iMedicamento<0)
	{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
    echo "Error al incluir medicamento";
	}
}


?>