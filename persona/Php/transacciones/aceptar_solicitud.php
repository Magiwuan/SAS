<?php
	include_once("../../Clases/clase_solicitud_medicina.php");
 	$sMedicina= new sMedicina();
	$sMedicina->setcodHoja($_POST['cod_hoja']);
	$resp=$sMedicina->solicitudAceptada();
	if($resp<0){
		echo "Aceptada!";
		exit();
	}else{
	 echo "Ha Ocurrido un Error";
	 exit();	
	}
?>