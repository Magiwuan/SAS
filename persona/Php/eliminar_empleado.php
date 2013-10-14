<?php
	include_once("../Clases/clase_titular.php");
 	$titular= new titular();
 	$titular->setidTitular($_POST['id_titular']);
	$respuesta=$titular->eTitular();
	if($respuesta<0){
		echo "Eliminado!";
		exit();
	}else{
	 echo "Ha Ocurrido un Error";
	 exit();	
	}
?>