<?php
include_once("../clases/clase_proveedor.php");
 $proveedor= new proveedor();
	$proveedor->setNombre($_GET['ordenar_org']);
	$proveedor->setOrden($_GET['ordenar_por']);	
	$consulta=$proveedor->sql();
// Si la Consulta Retorna -1 Envia un mensaje de Error.
		if($consulta=='-1'){
			echo "No";
		}
?>