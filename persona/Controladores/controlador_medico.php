<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_medico.php");
include_once("../Clases/clase_detalle_proveedor.php");

$ope = $_POST['ope'];
switch($ope){
  case "I":	{
	incluir();
	break;
	}
  case "Buscar":{
	buscar();
	break;
	}
  case "M":	{	
  	modificar();
	break;
	}
  case "Elimina":{
	elimina();
	break;
	}
}
//       Funcion para Registrar
function incluir(){
// Se crea un Objeto  de la clase 
	$medico = new medico();
	$detalle_pro = new detalle_pro();
//declaracion de unas variables a usarse
	$idMedico='0';
	$idDetalle_pro='0';
	$var_control= false; //variable de control para seguir o terminar la transaccion
	// Se envian los datos por los metodos set
	$medico->setNacionalidad($_POST["nacionalidad"]);
	$medico->setNombre($_POST["nombre"]);
	$medico->setApellido($_POST["apellido"]);
	$medico->setCedula($_POST["ced2"]);
	$medico->setEspecialidad($_POST["especialidad"]);		
		// Se verifica que no exista para poder incluir
		$Validamedicos=$medico->validar_medico();
		// Se inicia la Transacción
		$medico->IniciaTransaccion();
		if ($Validamedicos=='-1'){
		// Si $vadila_medico no encuentra nada (-1) 
		// Busca el ultimo registro de la entrada e incrementa el id
				$result = $medico->medico_UltimoID();	
					if ($result){
					$result = $medico->sig_tupla($result);		
					$idMedico = $result["id_medico"] + 1;
					}
					$medico->setidMedico($idMedico);
		//Registramos El trabajador			
					$iMedico= $medico->iMedico();
					if($iMedico!='-1'){
						$var_control=true;
						echo "Error 1";
					}
			$arreglo_pro = $_POST["proveedor"]; //Arreglo de Proveedor
			$cont_pro='0';
			while($cont_pro<count($arreglo_pro)){	
		//Consultamos el ultimo $id_detalle_proicio y traemos el ultimo	
		// Busca el ultimo registro de la entrada e incrementa el id
					$result = $detalle_pro->UltimoID_Pro();
						if ($result){
						$result = $detalle_pro->sig_tupla($result);		
						$idDetalle_pro = $result["id_proveedor_medico"] + 1;
						}		
						$detalle_pro->setId_proveedor_medico($idDetalle_pro);	
						$detalle_pro->setIdMedico($idMedico);	
						$detalle_pro->setIdProveedor($arreglo_pro[$cont_pro]);
		//Registramos el detalle de servicio			
						$iProveedor_Medico=$detalle_pro->iProveedor_Medico();
						if($iProveedor_Medico!='-1'){
							$var_control=true;	 
							echo "Error 2";
						}
				$cont_pro++;	 
				}
		}else{
			echo "No";//usuario ya registrado			
			$var_control=true;
			exit();
		}
	
		if ($var_control){	
			$medico->RompeTransaccion();
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$medico->FinTransaccion();	
			echo "Los Datos se guardaron con Exito!";
			exit();	
		}
}
//       Funcion para Modificar
function modificar(){
// Se crea un Objeto  de la clase 
	$medico = new medico();
	$detalle_pro = new detalle_pro();
	$idDetalle_pro = '0';
	
	$var_control= false; //variable de control para seguir o terminar la transaccion
	// Se envian los datos por los metodos set	
	$medico->setidMedico($_POST['id_medico']);
	$medico->setNacionalidad($_POST["nacionalidad"]);
	$medico->setNombre($_POST["nombre"]);
	$medico->setApellido($_POST["apellido"]);
	$medico->setCedula($_POST["ced"]);
	$medico->setEspecialidad($_POST["especialidad"]);
	$iMedico=$medico->iMedico();
				// Se inicia la Transacción
				$medico->IniciaTransaccion();
			
		$mMedico=$medico->mMedico();
		if($mMedico!='-1'){				
			$var_control=true;
			echo "Error interno de la Base de Datos 1!";
			exit();
		}
//Para trabajo mas facil borramos el detalle de los servicios e insertamos nuevamente.
		$detalle_pro->setIdProveedor($idProveedor);
		$mProveedor_Medico=$detalle_pro->mProveedor_Medico();
		if($mProveedor_Medico!='-1'){				
			$var_control=true;
			echo "Error interno de la Base de Datos 2!";
			exit();
		}
		$arreglo_pro = $_POST["proveedor"]; //Arreglo de servicio
			$cont_pro='0';
			while($cont_pro<count($arreglo_pro)){	
		//Consultamos el ultimo $id_detalle_proicio y traemos el ultimo	
		// Busca el ultimo registro de la entrada e incrementa el id	
					$result = $detalle_pro->UltimoID_Pro();
					if ($result){
						$result = $detalle_pro->sig_tupla($result);		
						$idDetalle_pro = $result["id_proveedor_medico"] + 1;
					}	
					$detalle_pro->setId_proveedor_medico($idDetalle_pro);	
					$detalle_pro->setIdProveedor($arreglo_pro[$cont_pro]);
		//Registramos el Detalle de la Servicio
				$iProveedor_Medico=$detalle_pro->iProveedor_Medico();
					if($iProveedor_Medico!='-1'){
					 $var_control=true;	 
					 echo "Error interno de la Base de Datos 3!";
					 }
			 $cont_pro++;	 
			 }	
		if ($var_control){	
			$medico->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$medico->FinTransaccion();	
			echo "Los datos fueron guardados con Exito!!!";
			exit();	
		}	
}
// se envian los datos del formulario por los metodos set de cada uno

?>