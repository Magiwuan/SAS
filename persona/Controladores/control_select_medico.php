<?php
include_once("../Clases/clase_proveedor.php");
$proveedor= new proveedor();

$proveedor->setidProveedor($_GET["select"]);
$resul=$proveedor->Verificar_combo();
if($resul!='-1'){
$seleccionado= $proveedor->combo(); 
	foreach ($seleccionado as $select) { echo $select; }	
}else{
	$seleccionado= $proveedor->combo_error(); 
	foreach ($seleccionado as $select) { echo $select; }	
}
	
?>