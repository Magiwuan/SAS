<?php
include_once("../clases/clase_medico.php");
 $medico= new medico();
	$medico->setApellido($_GET['ordenar_org']);
	$medico->setOrden($_GET['ordenar_por']);	
	$consulta=$medico->sql();
// Si la Consulta Retorna -1 Envia un mensaje de Error.
		if($consulta=='-1'){
			echo "No";
		}
?>