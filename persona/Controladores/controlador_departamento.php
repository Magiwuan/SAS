<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_departamento.php");
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
	$departamento = new departamento();
	$departamento->setNom($_POST["nombre"]);
	$iDepartamento=$departamento->iDepartamento();
	if($iDepartamento<0)
	{
	echo "Los datos se guardaron con Exito!!!";
	exit();
	}else{
      echo "Error al incluir departamento";
	}
}
?>