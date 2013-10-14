<?php
include_once("../Clases/clase_beneficiario.php");
include_once("../Clases/clase_titular.php");
$beneficiario= new beneficiario();
$titular= new titular();	
$cadena = preg_replace('/[A-Za-z - -,]/is', '',$_GET["select"]); 
if(isset($cadena)){	
		$titular->setCed($cadena);
		$consulta=$titular->validar_titular();
			for($i=0;$i<count($consulta);$i++)			
			{
				$idTitular = $consulta[$i][1];
			}
			if($consulta!='-1'){
				$beneficiario->setidTitular($idTitular);
				$respuesta=$beneficiario->validar_combo();
				if($respuesta!='-1'){
					$select= $beneficiario->combo_beneficiario(); 
					foreach ($select as $seleccion) { echo $seleccion; }	
				}else{	
					$select=$beneficiario->combo_error(); 
					foreach ($select as $seleccion) { echo $seleccion; }
				}
			}		
 }else{
	echo "Error, Comuniquese cn el Administrador de Sistema";
 }
?>