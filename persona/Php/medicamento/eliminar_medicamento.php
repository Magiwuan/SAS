<?php
	include_once("../../Clases/clase_medicamento.php");
 	$medicamento= new medicamento();
 	$medicamento->setidMedicamento($_POST['id_medicamento']);
	$respuesta=$medicamento->eMedicamento();
	if($respuesta<0){
		echo "El Medicamento ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>