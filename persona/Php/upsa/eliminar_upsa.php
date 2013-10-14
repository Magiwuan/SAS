<?php
	include_once("../../Clases/Clase_upsa.php");
 	$upsa= new upsa();
 	$upsa->setidUpsa($_POST['id_upsa']);
	$respuesta=$upsa->eUpsa();
	if($respuesta<0){
		echo "La UPSA ha sido Eliminada!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>