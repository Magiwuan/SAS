<?php
	include_once("../../Clases/clase_estado.php");
 	$estado= new estado();
 	$estado->setidEstado($_POST['id_estado']);
	$respuesta=$estado->eEstado();
	if($respuesta<0){
		echo "El Estado ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>