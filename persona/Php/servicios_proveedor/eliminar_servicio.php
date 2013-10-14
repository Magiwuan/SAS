<?php
	include_once("../../Clases/clase_servicio.php");
 	$servicio= new servicio();
 	$servicio->setidServicio($_POST['id_servicio']);
	$respuesta=$servicio->eServicio();
	if($respuesta<0){
		echo "El servicio ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>