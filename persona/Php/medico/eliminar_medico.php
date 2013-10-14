<?php
	include_once("../../Clases/clase_medico.php");
 	$medico= new medico();
 	$medico->setidMedico($_POST['id_medico']);
	$respuesta=$medico->eMedico();
	if($respuesta<0){
		echo "El Médico fue Eliminado!";
		exit();
	}else{
	 echo "Ha Ocurrido un Error";
	 exit();	
	}
?>