<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_solicitud_reembolso.php");
include_once("../Clases/clase_titular.php");
include_once("../Clases/clase_detalle_recaudos.php");
include_once("../Clases/clase_detalle_solicitud.php");

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
	$sReembolso= new sReembolso();
	$titular= new titular();
	$detalle_rec= new detalle_rec();
	$detalle_solicitud= new detalle_solicitud(); 
	$idSolicitud_reembolso=0;
	$id_detalle_reembolso=0;
	$idBeneficiario=0;
	$var_control= false;
		//envio la cedula para buscar el id del titular
	$sReembolso->IniciaTransaccion();
	$titular->setCed($_POST['cedTitular']);
	$buscarTitular=$titular->validar_titular();
	for($i=0;$i<count($buscarTitular);$i++){
		$idTitular=$buscarTitular[$i][1]; //Obtenemos el Id titular por la cedula
	}
		$sReembolso->setidTitular($idTitular);
			$consulta = $sReembolso->validar_solicitud_reembolso();
					if ($consulta){
						$consulta = $sReembolso->sig_tupla($consulta);	
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
							echo 'Tan rapido otro Reembolso,'." ";
							echo "Menos de ".$Min." minutos?";
							$var_control=true;
							exit();
							}
						} 
	//Insertar cabecera de solicitud medicina	
	$result = $sReembolso->buscaUltimoID();	
	if ($result){
		$result = $sReembolso->sig_tupla($result);		
		$idSolicitud_reembolso = $result['id_solicitud_reembolso'] + 1; //Buscamos el id Solicitud por ultimo Registro
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
	$sReembolso->setidSolicitud_reembolso($idSolicitud_reembolso);
	$sReembolso->settipoBeneficiario($TipoBeneficiario);
	$sReembolso->setidBeneficiario($idBeneficiario);
	$sReembolso->setObservacion($_POST['observacion']);	
	$sReembolso->setDiagnostico($_POST['diagnostico']);
	$sReembolso->setcodHoja($_POST['codHoja']);
	if($_POST['Tipo']=='M'){
			$idServicio=1;
		}elseif($_POST['Tipo']=='L'){
			$idServicio=3;
		}
		elseif($_POST['Tipo']=='I'){
			$idServicio=4;
		}		
		elseif($_POST['Tipo']=='C'){
			$idServicio=5;
		}
	$sReembolso->setidServicio($idServicio);
	
	$iSolicitud_Reembolso=$sReembolso->iSolicitud_Reembolso();
	echo $iSolicitud_Reembolso;
	if($iSolicitud_Reembolso!='-1'){
		$var_control=true;
		echo "  Error iSolicitud_Reembolso";
	}	
	
	$arreglo_nroFactura = $_POST["nroFactura"]; //Arreglo de discapacidad
	$arreglo_nroControl = $_POST["nroControl"]; //Arreglo de discapacidad
	$arreglo_descripFact= $_POST["descripcionFactura"]; //Arreglo de discapacidad
	$arreglo_monto 		= $_POST["monto"]; //Arreglo de discapacidad
	$cont=0;
	while($cont<count($arreglo_nroFactura)&&$cont<count($arreglo_nroControl)&&$cont<count($arreglo_descripFact)&&$cont<count($arreglo_monto)){
		$result = $detalle_solicitud->UltimoID_detalle_Reembolso();
				if ($result){
					$result = $detalle_solicitud->sig_tupla($result);		
					$id_detalle_reembolso = $result["id_detalle_reembolso"] + 1;
					}						
		$detalle_solicitud->setnroFactura($arreglo_nroFactura[$cont]);
		$detalle_solicitud->setnroControl($arreglo_nroControl[$cont]);
		$plata=str_replace("Bs ","",$arreglo_monto[$cont]);
		$detalle_solicitud->setmontoFactura($plata);
		$detalle_solicitud->setDescripcion($arreglo_descripFact[$cont]);
		$detalle_solicitud->setidSolicitud($idSolicitud_reembolso);
		$detalle_solicitud->setidDetalleSolicitud($id_detalle_reembolso);	
		$iDetalle_reembolso=$detalle_solicitud->iDetalle_reembolso();
				if($iDetalle_reembolso!='-1'){
					$var_control=true;	 
					echo "Error iDetalle_reembolso";
				}	
		$cont++;
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
		$detalle_rec->setidSolicitud($idSolicitud_reembolso);
		$detalle_rec->setidRecaudos($arreglo_recaudos[$cont_rec]);
	//Registramos el Detalle de los recaudos
	$iSolicitud_Recaudos=$detalle_rec->iSolicitud_reembolso_Recaudos();
		if($iSolicitud_Recaudos!='-1'){
			$var_control=true;	 
			echo "Error iSolicitud_Recaudos";
		}
	$cont_rec++;	 	
	}	
	//Control de la transaccion	
	if ($var_control){	
			$sReembolso->RompeTransaccion();		
			echo " No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$sReembolso->FinTransaccion();	
			echo " Los Datos se guardaron con Exito, Imprimir ? ";
			exit();	
		}
}
function modificar(){
	$detalle_solicitud= new detalle_solicitud();
	$sReembolso= new sReembolso();
	$id_detalle_coberutra=0;
	$Total=0;
	$Resta=0;	
	$var_control= false; //variable de control para seguir o terminar la transaccion	
		
	//Verificamos los id del Titular y Beneficiario para enviarlo
	if(isset($_POST['idTitular'])){
		$sReembolso->setidTitular($_POST['idTitular']);
		$sReembolso->setidBeneficiario('0');
		$sReembolso->settipoBeneficiario('T');		
	}
	if(isset($_POST['idBeneficiario'])){
		$sReembolso->setidTitular('0');
		$sReembolso->setidBeneficiario($_POST['idBeneficiario']);
		$sReembolso->settipoBeneficiario('B');
	}
	$sReembolso->IniciaTransaccion();	
	//obtenemos el ultimo id del detalle de la cobertura
	$Total=$_POST['montoAprobado'];
	$id = $sReembolso->UltimoID_dCobertura();
		if ($id){
			$id = $sReembolso->sig_tupla($id);		
			$id_detalle_coberutra = $id["id_detalle_cobertura"] + 1;
		}

			//Buscamos la cobertura para el primer registro del consumo inicial.	
	$result=$sReembolso->buscar_cobertura();
	if ($result){
			$result = $sReembolso->sig_tupla($result);	
//El Monto de la cobertura	
			$Monto = $result["monto"];
//El id de la cobertura para el detalle
			$idCobertura=$result["id_cobertura"];
		}
	$buscar=$sReembolso->montoDisponible();
	if ($buscar){
			$buscar = $sReembolso->sig_tupla($buscar);	
//El Monto de la cobertura	
			$montoDisponible = $buscar["monto_disponible"];	
		}	
		if($montoDisponible!=''){
			$montoDisponible=$montoDisponible;
		}else{
			$montoDisponible=$Monto;
		}			
	$Resta=$montoDisponible-$Total;
	echo $Resta;
	if($Resta<0){
		echo "Error cobertura resta";
	// echo "Sobrepasa el limite de cobertura. \n"	;
	 $var_control=true;
	}
	$sReembolso->setidCobertura($idCobertura);
	$sReembolso->setidDetalle_cobertura($id_detalle_coberutra);
	$sReembolso->setmontoDisponible($Resta);
	$iDetalle_cobertura=$sReembolso->iDetalle_cobertura();
	if($iDetalle_cobertura!='-1'){
		echo "Error DetalleCobertura";
		$var_control=true;
	}
	$sReembolso->setidSolicitud_reembolso($_POST["idSolicitud_reembolso"]);
	$sReembolso->setMonto($_POST['montoAprobado']);
	$mDetalle_reembolso=$sReembolso->mDetalle_reembolso();
	if($mDetalle_reembolso!='-1'){
		echo "Error Detalle reembolso";
		$var_control=true;
	}
	$solicitudProcesada=$sReembolso->solicitudProcesada();
	if($solicitudProcesada!='-1'){
		echo "Error procesada";
		$var_control=true;
	}
		//Control de la transaccion	
	if ($var_control){	
			$sReembolso->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$sReembolso->FinTransaccion();	
			echo "Bien";
			exit();	
		}
}
?>