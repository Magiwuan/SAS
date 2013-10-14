<?php
	include_once("../../Clases/clase_patologia.php");
 	$patologia= new patologia();
 	$patologia->setidpatologia($_POST['id_patologia']);
	$respuesta=$patologia->epatologia();
	if($respuesta<0){
		echo "La Patología ha sido Eliminada!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>