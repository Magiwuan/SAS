<?php
	include_once("../../Clases/clase_pais.php");
 	$pais= new pais();
 	$pais->setidPais($_POST['id_pais']);
	$respuesta=$pais->ePais();
	if($respuesta<0){
		echo "El País fue Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>