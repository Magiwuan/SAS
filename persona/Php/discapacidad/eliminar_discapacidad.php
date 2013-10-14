<?php
	include_once("../../Clases/clase_discapacidad.php");
 	$discapacidad= new discapacidad();
 	$discapacidad->setidDiscapacidad($_POST['id_discapacidad']);
	$respuesta=$discapacidad->eDiscapacidad();
	if($respuesta<0){
		echo "La Discapacidad ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>