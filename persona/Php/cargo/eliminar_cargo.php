<?php
	include_once("../../Clases/clase_cargo.php");
 	$cargo= new cargo();
 	$cargo->setidCargo($_POST['id_cargo']);
	$respuesta=$cargo->eCargo();
	if($respuesta<0){
		echo "El ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>