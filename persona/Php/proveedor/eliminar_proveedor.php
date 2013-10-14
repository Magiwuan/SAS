<?php
	include_once("../../Clases/clase_proveedor.php");
 	$proveedor= new proveedor();
 	$proveedor->setidProveedor($_POST['id_proveedor']);
	$respuesta=$proveedor->eProveedor();
	if($respuesta<0){
		exit();
	}else{
	 echo "Ha Ocurrido un Error";
	 exit();	
	}
?>