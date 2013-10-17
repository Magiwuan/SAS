<?php
	include_once("../../Clases/clase_upsa.php");
	
 	$upsa= new upsa();
 	$upsa->setidUpsa($_POST['id_upsa']);
	$respuesta=$upsa->eUpsa();
	echo "ddd".$_POST['id_upsa'];
	if($respuesta<0){
		echo "La UPSA ha sido Eliminada!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>
