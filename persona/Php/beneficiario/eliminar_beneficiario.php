<?php
	include_once("../../Clases/clase_beneficiario.php");
 	$beneficiario= new beneficiario();
 	$beneficiario->setidBeneficiario($_POST['id_beneficiario']);
	$respuesta=$beneficiario->eBeneficiario();
	if($respuesta<0){
		echo "Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>