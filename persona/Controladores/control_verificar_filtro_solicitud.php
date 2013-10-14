<?php
	include_once("../clases/clase_solicitud_medicina.php");
	include_once("../clases/clase_titular.php");
 	$titular= new titular();
	$sMedicina= new sMedicina();

	$titular->setCed($_POST['buscar']);
	$result=$titular->verificar();	
	if($result){
		$result = $titular->sig_tupla($result);
			if($result==''){
			echo "No";
			exit();
			}	
		$idTitular = $result["id_titular"];
	}				
	$sMedicina->setidTitular($_POST['buscar']);
	$sMedicina->setOrden($_POST['ordenar_por']);
	$resp=$sMedicina->sql();
// Si la Consulta Retorna -1 Envia un mensaje de Error.
	if($resp=='-1'){
		echo "No";
	}	
?>