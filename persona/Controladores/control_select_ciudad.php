<?php
include_once("../Clases/clase_ciudad.php");
$ciudad= new ciudad();		
$ciudad->setidEstado($_GET["select"]);		
$validar=$ciudad->Verificar_est();
	if($validar!='-1'){
	$city= $ciudad->combo(); 
	foreach ($city as $ciudad) { echo $ciudad; }	
	}else{	
	$city=$ciudad->combo_error(); 
	foreach ($city as $ciudad) { echo $ciudad; }
	}
?>