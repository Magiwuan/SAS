<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_pais.php");
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
	$pais = new pais();
	$pais->setNom($_POST["nombre"]);
	$iPais=$pais->iPais();
	$val_pais=$pais->valida_pais();
	if($val_pais=='0'){
		if($iPais<0){
			echo "Los datos se guardaron con Exito!";
		}else{
			echo "Error al incluir País";
		}
	}else{
		echo "No";
	}
}


?>
