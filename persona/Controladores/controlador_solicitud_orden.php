<?php
//NOTA LA CANTIDAD DE EXAMEN ES 1 POR QUE SE HACE 1 PILAS !! 


// Llamado a la clase a usarse
include_once("../Clases/clase_solicitud_orden.php");
include_once("../Clases/clase_titular.php");
include_once("../Clases/clase_detalle_recaudos.php");
include_once("../Clases/clase_detalle_solicitud.php");
include_once("../Clases/clase_examen.php");
include_once("../Clases/clase_cobertura.php");
$ope = $_POST['op'];
switch($ope){
  case "iSolicitud":{
	incluir();
	break;
	}
  case "Buscar":{
	buscar();
	break;
	}
  case "mSolicitud":{	
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
	$sOrden= new sOrden();
	$titular= new titular();
	$detalle_rec= new detalle_rec();
	$examen= new examen();	
	$detalle_solicitud= new detalle_solicitud(); 
	$var_control= false;
	$idSolicitud=0;
	$id_detalle_solicitud=0;
	$idSolicitud_recaudo=0;
	//envio la cedula para buscar el id del titular
	$sOrden->IniciaTransaccion();
	$titular->setCed($_POST['cedTitular']);
		$buscarTitular=$titular->validar_titular();
		if($buscarTitular){
			$resl=$titular->sig_tupla($buscarTitular);
			$idTitular=$resl['id_titular'];
		}
		$sOrden->setidTitular($idTitular);
			$consulta = $sOrden->validar_solicitud();
					if ($consulta){
						$consulta = $sOrden->sig_tupla($consulta);	
						$ultimoRegistro = $consulta["hora"];
						$elDia=substr($consulta["fecha"],8,2);
						$elMes=substr($consulta["fecha"],5,2);
						$elYear=substr($consulta["fecha"],0,4);
						$ultimaFecha=$elDia."-".$elMes."-".$elYear;					
						}						
						if($ultimaFecha==date('d-m-Y')){
							$hToday= time();						
							$hMedia = abs($hToday - $ultimoRegistro);
							$Min= floor($hMedia/60);					
							if($Min<0){
							echo 'Tan rapido otra Solicitud,'." ";
							echo "Menos de ".$Min." minutos?";
							$var_control=true;
							}
						} 	
	//Insertar cabecera de solicitud medicina	
	$result = $sOrden->buscaUltimoID();	
	if ($result){
		$result = $sOrden->sig_tupla($result);		
		$idSolicitud = $result['id_solicitud'] + 1; //Buscamos el id Solicitud por ultimo Registro
	}
	$idBeneficiario=$_POST['beneficiario'];
	if($idBeneficiario=='-1'){
		$TipoBeneficiario='T';
		$idBeneficiario=0;
//Si el Beneficario es el titular el Campo idBeneficiario ira vacio
	}else{
		$TipoBeneficiario='B';
		$idBeneficiario=$idBeneficiario;
//si el Beneficiario no es el titular Mandamos el ID de su Asociado
	}
		if($_POST['Tipo']=='2'){
			$tipo='ESPECIALES';
		}elseif($_POST['Tipo']=='3'){
			$tipo='LABORATORIO';
		}elseif($_POST['Tipo']=='4'){
			$tipo='IMAGEN';
		}elseif($_POST['Tipo']=='5'){
			$tipo='CONSULTA';
		}
	$sOrden->setidSolicitud($idSolicitud);
	$sOrden->settipoBeneficiario($TipoBeneficiario);
	$sOrden->setidBeneficiario($idBeneficiario);
	$sOrden->setidServicio($_POST['Tipo']);
	$sOrden->setPatologia($_POST['patologia']);
	$sOrden->setObservacion($_POST['observacion']);
	$sOrden->setidMedico($_POST['medico']);
	$sOrden->setidProveedor($_POST['organizacion']);
	$sOrden->setcodHoja($_POST['codHoja']);
	$iSolicitud_Orden=$sOrden->iSolicitud_Orden();
	if($iSolicitud_Orden!='-1'){
		$var_control=true;
		echo "Error 1";
	}	
	//Insertar el arreglo de Detalle de medicamentos		
	$cont_med='0';
	if($_POST["motivo"]!='' && $_POST["diagnostico"]!=''){
			$result = $detalle_solicitud->UltimoID_solicitud();
				if ($result){
					$result = $detalle_solicitud->sig_tupla($result);		
					$id_detalle_solicitud = $result["id_detalle_solicitud"] + 1;
					}						
				$detalle_solicitud->setidDetalleSolicitud($id_detalle_solicitud);	
				$detalle_solicitud->setidSolicitud($idSolicitud);	
				$detalle_solicitud->setmotivoConsulta($_POST["motivo"]);
				$detalle_solicitud->setDiagnostico($_POST["diagnostico"]);
				$detalle_solicitud->setCantidad(1);
				$iDetalle_solicitud=$detalle_solicitud->iDetalle_solicitud();
				if($iDetalle_solicitud!='-1'){
					$var_control=true;	 
					echo "Error 4";
				}					
	}else{
	$arregloExamen = $_POST["campo"]; //Arreglo de Examen
	$arregloDescrip = $_POST["descripcion"]; //Arreglo de Cantidad
	while($cont_med<count($arregloExamen) && $cont_med<count($arregloDescrip)){	
		$examen->setTipoexamen($tipo);		
		$examen->setDescripcion($arregloExamen[$cont_med]);
		$val_examen=$examen->validar_examen();	
		if($val_examen=='0'){
			$iExamen=$examen->iExamen();		
			if($iExamen!='-1'){
				$var_control=true;	 
				echo "Error 2";
			}else{
				$examen->setDescripcion($arregloExamen[$cont_med]);
				$val_examen=$examen->validar_examen();	
				if($val_examen){
					$val_examen=$examen->sig_tupla($val_examen);
					$idExamen=$val_examen['id_examen'];
				}	
			
				$result = $detalle_solicitud->UltimoID_solicitud();
				if ($result){
					$result = $detalle_solicitud->sig_tupla($result);		
					$id_detalle_solicitud = $result["id_detalle_solicitud"] + 1;
					}						
				$detalle_solicitud->setidDetalleSolicitud($id_detalle_solicitud);	
				$detalle_solicitud->setidSolicitud($idSolicitud);	
				$detalle_solicitud->setidExamen($idExamen);
				$detalle_solicitud->setDescripcion($arregloDescrip[$cont_med]);
				$detalle_solicitud->setCantidad(1);
				$iDetalle_solicitud=$detalle_solicitud->iDetalle_solicitud();
				if($iDetalle_solicitud!='-1'){
					$var_control=true;	 
					echo "Error 4";
				}					
			}
		}else{
				$examen->setDescripcion($arregloExamen[$cont_med]);
				$val_examen=$examen->validar_examen();	
				if($val_examen){
					$resl=$examen->sig_tupla($val_examen);
					$idExamen=$resl['id_examen'];
				}
			
				$result = $detalle_solicitud->UltimoID_solicitud();
				if ($result){
					$result = $detalle_solicitud->sig_tupla($result);		
					$id_detalle_solicitud = $result["id_detalle_solicitud"] + 1;
					}						
				$detalle_solicitud->setidDetalleSolicitud($id_detalle_solicitud);	
				$detalle_solicitud->setidSolicitud($idSolicitud);	
				$detalle_solicitud->setidExamen($idExamen);
				$detalle_solicitud->setDescripcion($arregloDescrip[$cont_med]);
				$detalle_solicitud->setCantidad(1);
				$iDetalle_solicitud=$detalle_solicitud->iDetalle_solicitud();
				if($iDetalle_solicitud!='-1'){
					$var_control=true;	 
					echo "Error 4";
				}	
				
			}
		$cont_med++;
		}
	}
	//Insertar el arreglo de recaudos		
	$arreglo_recaudos = $_POST["recaudos"]; //Arreglo de discapacidad
	$cont_rec='0';
	while($cont_rec<count($arreglo_recaudos)){
		$result = $detalle_rec->sUltimoID_Rec();
		if ($result){
			$result = $detalle_rec->sig_tupla($result);		
			$idSolicitud_recaudo = $result["id_solicitud_recaudo"] + 1;
		}	
		$detalle_rec->setId_solicitud_rec($idSolicitud_recaudo);
		$detalle_rec->setidSolicitud($idSolicitud);
		$detalle_rec->setidRecaudos($arreglo_recaudos[$cont_rec]);
	//Registramos el Detalle de los recaudos
	$iSolicitud_Recaudos=$detalle_rec->iSolicitud_Recaudos();
		if($iSolicitud_Recaudos!='-1'){
			$var_control=true;	 
			echo "Error 6";
		}
	$cont_rec++;	 	
	}	
		
//Control de la transaccion	
	if ($var_control){	
			$sOrden->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$sOrden->FinTransaccion();	
			echo "Los Datos se guardaron con Exito, Imprimir ?";
			exit();	
		}
}
function modificar(){
	$detalle_solicitud= new detalle_solicitud();
	$sOrden= new sOrden();
	$cobertura= new cobertura();
	$id_detalle_coberutra=0;
	$Total=0;
	$Resta=0;	
	$var_control= false; //variable de control para seguir o terminar la transaccion	
	$plata=str_replace("Bs ","",$_POST['monto']);
	$detalle_solicitud->setMonto($plata);
	$idServicio=$_POST['idServicio'];
	if($idServicio=='5'){
		$detalle_solicitud->setmotivoConsulta($_POST["motivo"]);
		$detalle_solicitud->setDiagnostico($_POST["diagnostico"]);
	$mDetalle_solcitud_consulta=$detalle_solicitud->mDetalle_solcitud_consulta();
		if($mDetalle_solcitud_consulta!='-1'){
			$var_control=true;
			echo "Error mDtalle_solicitud";
		}else{
		$Total+=$plata;
	}
	}else{
		$detalle_solicitud->setidExamen($_POST["idCampo"]);
		$detalle_solicitud->setDescripcion($_POST["descripcion"]);
		$mDetalle_solcitud_consulta=$detalle_solicitud->mDetalle_solcitud_orden();
		if($mDetalle_solcitud_consulta!='-1'){
			$var_control=true;
			echo "Error mDtalle_solicitud";
		}else{
		$Total+=$plata;
	}
	}
//Verificamos los id del Titular y Beneficiario para enviarlo
	if(isset($_POST['idTitular'])){
		$sOrden->setidTitular($_POST['idTitular']);
		$sOrden->setidBeneficiario('0');
		$sOrden->settipoBeneficiario('T');		
	}
	if(isset($_POST['idBeneficiario'])){
		$sOrden->setidTitular('0');
		$sOrden->setidBeneficiario($_POST['idBeneficiario']);
		$sOrden->settipoBeneficiario('B');
	}
	$sOrden->IniciaTransaccion();	
	//obtenemos el ultimo id del detalle de la cobertura
	$id = $cobertura->UltimoID_dCobertura();
		if ($id){
			$id = $cobertura->sig_tupla($id);		
			$id_detalle_coberutra = $id["id_detalle_cobertura"] + 1;
		}
	
	//Buscamos la cobertura para el primer registro del consumo inicial.	
	$result=$cobertura->buscar_cobertura();
	if ($result){
			$result = $cobertura->sig_tupla($result);	
//El Monto de la cobertura	
			$Monto = $result["monto"];
//El id de la cobertura para el detalle
			$idCobertura=$result["id_cobertura"];
		}
	$buscar=$cobertura->montoDisponible();
	if ($buscar){
			$buscar = $cobertura->sig_tupla($buscar);	
//El Monto de la cobertura	
			$montoDisponible = $buscar["monto_disponible"];	
		}	
		if($montoDisponible!=''){
			$montoDisponible=$montoDisponible;
		}else{
			$montoDisponible=$Monto;
		}			
	$Resta=$montoDisponible-$Total;
	if($Resta<0){
	 echo "Sobrepasa el limite de cobertura. \n"	;
	 $var_control=true;
	}
	$cobertura->setidCobertura($idCobertura);
	$cobertura->setidDetalle_cobertura($id_detalle_coberutra);
	$cobertura->setmontoDisponible($Resta);
	$iDetalle_cobertura=$cobertura->iDetalle_cobertura();
	if($iDetalle_cobertura!='-1'){
		echo "Error DetalleCobertura";
		$var_control=true;
	}
	$sOrden->setidSolicitud($_POST["idSolicitud"]);
	$solicitudProcesada=$sOrden->solicitudProcesada();
	if($solicitudProcesada!='-1'){
		echo "Error procesada";
		$var_control=true;
	}
		//Control de la transaccion	
	if ($var_control){	
			$sOrden->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$sOrden->FinTransaccion();	
			echo "Bien";
			exit();	
		}

}
?>
