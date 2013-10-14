<?php
	include_once("../../Clases/clase_profesion.php");
 	$profesion= new profesion();
 	$profesion->setidProfesion($_POST['id_profesion']);
	$respuesta=$profesion->eProfesion();
	if($respuesta<0){
		echo "La Profesión ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>