<?php
	include_once("../../Clases/clase_especialidad.php");
 	$especialidad= new especialidad();
 	$especialidad->setidespecialidad($_POST['id_especialidad']);
	$respuesta=$especialidad->eespecialidad();
	if($respuesta<0){
		echo "La Especialidad ha sido Eliminada!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>