<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_proveedor.php");
include_once("../Clases/clase_detalle_servicio.php");

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
	$proveedor = new proveedor();
	$detalle_serv = new detalle_serv();
//declaracion de unas variables a usarse
	$idProveedor='0';
	$idDetalle='0';
	$var_control= false; //variable de control para seguir o terminar la transaccion
	// Se envian los datos por los metodos set
		$proveedor->setRif($_POST["rif"]);
		$proveedor->setAlias($_POST["alias"]);
		$proveedor->setNombre($_POST["nombre"]);
		$proveedor->setPersonaContacto($_POST["persona_cont"]);
		$proveedor->setCel($_POST["celular"]);
		$proveedor->setTlf($_POST["telefono"]);
		$proveedor->setFax($_POST["fax"]);
		$proveedor->setCorreo($_POST["correo"]);	
		$proveedor->setidCiudad($_POST["ciudad"]);
		$proveedor->setDireccion($_POST["direccion"]);
		$proveedor->setFechaInicio($_POST["fecha_ini"]);
		$proveedor->setFechaFin($_POST["fecha_fin"]);
		// Se verifica que no exista para poder incluir
		$Validaproveedor=$proveedor->valida_proveedor();
				// Se inicia la Transacción
				$proveedor->IniciaTransaccion();
		if ($Validaproveedor=='0'){
		// Si $vadila_proveedor no encuentra nada (-1) 
		// Busca el ultimo registro de la entrada e incrementa el id
				$result = $proveedor->proveedor_UltimoID();	
					if ($result){
					$result = $proveedor->sig_tupla($result);		
					$idProveedor = $result["id_proveedor"] + 1;
					}
					$proveedor->setidProveedor($idProveedor);
		//Registramos El proveedor		
					$iProveedor= $proveedor->iProveedor();
					if($iProveedor!='-1'){
						$var_control=true;
						echo "Error 1";
					}
			$arreglo_serv = $_POST["servicio"]; //Arreglo de Servicio
			$cont_serv='0';
			while($cont_serv<count($arreglo_serv)){	
		//Consultamos el ultimo $id_detalle_servicio y traemos el ultimo	
		// Busca el ultimo registro de la entrada e incrementa el id
					$result = $detalle_serv->UltimoID_serv();
						if ($result){
						$result = $detalle_serv->sig_tupla($result);		
						$idDetalle = $result["id_detalle_servicio"] + 1;						}	
	
						$detalle_serv->setIdDetalleServicio($idDetalle);	
						$detalle_serv->setIdProveedor($idProveedor);	
						$detalle_serv->setIdServicio($arreglo_serv[$cont_serv]);
		//Registramos el detalle de servicio			
						$iDetalle_Serv=$detalle_serv->iDetalle_Serv();
						if($iDetalle_Serv!='-1'){
							$var_control=true;	 
							echo "Error 2";
						}
				$cont_serv++;	 
				}
		}else{
			echo "No";//Proveedor ya registrado			
			$var_control=true;
			exit();
		}
	
		if ($var_control){	
			$proveedor->RompeTransaccion();
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$proveedor->FinTransaccion();	
			echo "Los Datos se guardaron con Exito!";
			exit();	
		}
}

//       Funcion para Modificar
function modificar(){
// Se crea un Objeto  de la clase 
	$proveedor = new proveedor();
	$detalle_serv = new detalle_serv();
	$idDetalle_serv = '0';
	$idProveedor = $_POST['id_proveedor']; /* 28-03 No Estaba modificando proveedor por que no habia ID PROVEEDOR que modificar ! */
	$var_control= false; //variable de control para seguir o terminar la transaccion
	// Se envian los datos por los metodos set	
		$proveedor->setidProveedor($idProveedor);
		$proveedor->setRif($_POST["rif"]);
		$proveedor->setAlias($_POST["alias"]);
		$proveedor->setNombre($_POST["nombre"]);
		$proveedor->setPersonaContacto($_POST["persona_cont"]);
		$proveedor->setCel($_POST["celular"]);
		$proveedor->setTlf($_POST["telefono"]);
		$proveedor->setFax($_POST["fax"]);
		$proveedor->setCorreo($_POST["correo"]);	
		$proveedor->setidCiudad($_POST["ciudad"]);
		$proveedor->setDireccion($_POST["direccion"]);
		$proveedor->setFechaInicio($_POST["fecha_ini"]);
		$proveedor->setFechaFin($_POST["fecha_fin"]);
				// Se inicia la Transacción
				$proveedor->IniciaTransaccion();
			
		$mProveedor=$proveedor->mProveedor();
		if($mProveedor!='-1'){				
			$var_control=true;
			echo "Error interno de la Base de Datos 1!";
			exit();
		}
//Para trabajo mas facil borramos el detalle de los servicios e insertamos nuevamente.
		$detalle_serv->setIdProveedor($idProveedor);
		$eDetalle_Serv=$detalle_serv->eDetalle_Serv();
		if($eDetalle_Serv!='-1'){				
			$var_control=true;
			echo "Error interno de la Base de Datos 2!";
			exit();
		}
		$arreglo_serv = $_POST["servicio"]; //Arreglo de servicio
			$cont_serv='0';
			while($cont_serv<count($arreglo_serv)){	
		//Consultamos el ultimo $id_detalle_servicio y traemos el ultimo	
		// Busca el ultimo registro de la entrada e incrementa el id	
					$result = $detalle_serv->UltimoID_serv();
					if ($result){
						$result = $detalle_serv->sig_tupla($result);		
						$idDetalle_serv = $result["id_detalle_servicio"] + 1;
					}	
					$detalle_serv->setIdDetalleServicio($idDetalle_serv);	
					$detalle_serv->setIdServicio($arreglo_serv[$cont_serv]);
		//Registramos el Detalle de la Servicio
				$iDetalle_Serv=$detalle_serv->iDetalle_Serv();
					if($iDetalle_Serv!='-1'){
					 $var_control=true;	 
					 echo "Error interno de la Base de Datos 3!";
					 }
			 $cont_serv++;	 
			 }	
		if ($var_control){	
			$proveedor->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$proveedor->FinTransaccion();	
			echo "Los datos fueron guardados con Exito!";
			exit();	
		}	
}
// se envian los datos del formulario por los metodos set de cada uno

?>
