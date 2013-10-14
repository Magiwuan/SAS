<?php
	include_once("../../Clases/clase_cobertura.php");
 	$cobertura= new cobertura();
 	$cobertura->setidCobertura($_POST['id_cobertura']);
	$respuesta=$cobertura->eCobertura();
	if($respuesta<0){
		echo "Eliminado !";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>