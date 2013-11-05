<?php
include_once("../Clases/clase_proveedor.php");
$proveedor= new proveedor();		
$proveedor->setidProveedor($_GET["select"]);		
$validar=$proveedor->valida_proveedor();
	if($validar!='0'){
	$city= $proveedor->l_servicios_proveedor(); 
	foreach ($city as $ciudad) { echo $ciudad; }	
	}else{	
	$city=$proveedor->combo_error(); 
	foreach ($city as $ciudad) { echo $ciudad; }
	}
?>
