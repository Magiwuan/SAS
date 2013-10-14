<?php
	include_once("../../Clases/clase_examen.php");
 	$examen= new examen();
 	$examen->setidExamen($_POST['id_examen']);
	$respuesta=$examen->eExamen();
	if($respuesta<0){
		echo "El Examén ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>