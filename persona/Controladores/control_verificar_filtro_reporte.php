<?php
include_once("../Clases/clase_titular.php");
 $titular= new titular();
	$titular->setOrden($_GET['ordenar_por']);	
	$titular->setCed($_GET['buscar']);
	$consulta=$titular->sql();
// Si la Consulta Retorna -1 Envia un mensaje de Error.
		if($consulta=='-1'){
			echo "No";
		}	
?>
