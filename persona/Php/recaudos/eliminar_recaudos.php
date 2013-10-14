<?php
	include_once("../../Clases/clase_recaudo.php");
 	$recaudos= new recaudos();
 	$recaudos->setidRecaudo($_POST['id_recaudo']);
	$respuesta=$recaudos->eRecaudos();
	if($respuesta<0){
		echo "El Recaudo ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>