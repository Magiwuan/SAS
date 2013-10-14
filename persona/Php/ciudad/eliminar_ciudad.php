<?php
	include_once("../../Clases/clase_ciudad.php");
 	$ciudad= new ciudad();
 	$ciudad->setidCiudad($_POST['id_ciudad']);
	$respuesta=$ciudad->eCiudad();
	if($respuesta<0){
		echo "La Ciudad ha sido eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>