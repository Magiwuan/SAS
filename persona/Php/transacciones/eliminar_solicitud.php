<?php
	include_once("../../Clases/clase_solicitud_medicina.php");
 	$sMedicina= new sMedicina();
	$sMedicina->setidSolicitud($_POST['id_solicitud']);
	$sMedicina->setMotivo($_POST['e']);
	$resp=$sMedicina->eSolicitud();
	if($resp<0){
		echo "Eliminado!";
		exit();
	}else{
	 echo "Ha Ocurrido un Error";
	 exit();	
	}
?>