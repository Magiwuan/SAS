<?php
	include_once("../../Clases/clase_departamento.php");
 	$departamento= new departamento();
 	$departamento->setidDepartamento($_POST['id_departamento']);
	$respuesta=$departamento->eDepartamento();
	if($respuesta<0){
		echo "El Departamento ha sido Eliminado!";
		exit();
	}else{
	 echo "Ha ocurrido un Error ";
	 exit();	
	}
?>