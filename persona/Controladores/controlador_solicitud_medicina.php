<?php
// Llamado a la clase a usarse
include_once("../Clases/clase_solicitud_medicina.php");
include_once("../Clases/clase_titular.php");
include_once("../Clases/clase_detalle_recaudos.php");
include_once("../Clases/clase_detalle_solicitud.php");
include_once("../Clases/clase_medicamento.php");
$ope = $_POST['ope'];
switch($ope){
  case "iMedicina":	{
	incluir();
	break;
	}
  case "Buscar":{
	buscar();
	break;
	}
  case "mMedicina":	{	
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
	$sMedicina = new sMedicina();
	$titular = new titular();
	$detalle_rec= new detalle_rec();
	$Medicamento = new medicamento();
	$detalle_solicitud= new detalle_solicitud();		
	$idSolicitud='0';	
	$idSolicitud_recaudo='0';
	$id_detalle_solicitud='0';
	$var_control= false; //variable de control para seguir o terminar la transaccion
//envio la cedula para buscar el id del titular
	$titular->setCed($_POST['cedTitular']);
	$buscarTitular=$titular->validar_titular();
	for($i=0;$i<count($buscarTitular);$i++){
		$idTitular=$buscarTitular[$i][1]; //Obtenemos el Id titular por la cedula
	}
	$sMedicina->setidTitular($idTitular);
		$consulta = $sMedicina->validar_solicitud();
				if ($consulta){
					$consulta = $sMedicina->sig_tupla($consulta);	
					$id=	$consulta["id_titular"];
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
						exit();
						}
					} 						
//Insertar cabecera de solicitud medicina	
	$result = $sMedicina->buscaUltimoID();	
	if ($result){
		$result = $sMedicina->sig_tupla($result);		
		$idSolicitud = $result['id_solicitud'] + 1; //Buscamos el id Solicitud por ultimo Registro
	}
	$sMedicina->setidSolicitud($idSolicitud);	
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
	$sMedicina->setidBeneficiario($idBeneficiario);
	$sMedicina->settipoBeneficiario($TipoBeneficiario);
//Se envia el Nro. 1 xq en la BD la Solicitud de Medicinas es 1 para Ahorrar consulta
	$sMedicina->setidServicio('1');
	$sMedicina->setnombAutorizado($_POST['nombAutorizado']);
	$sMedicina->setcedAutorizado($_POST['cedAutorizado']);
	$sMedicina->setTratamiento($_POST['tratamiento']);
	$sMedicina->setfechaIni($_POST['fecha_ini']);
	$sMedicina->setfechaFin($_POST['fecha_fin']);
	$sMedicina->setPatologia($_POST['patologia']);
	$sMedicina->setObservacion($_POST['observacion']);
	$sMedicina->setidProveedor($_POST['organizacion']);
	$sMedicina->setcodHoja($_POST['codHoja']);
	$sMedicina->IniciaTransaccion();
	$incluirSolicitud=$sMedicina->iSolicitud_Medicina();
	if($incluirSolicitud!='-1'){
		$var_control=true;
		echo "Error 1";
	}
//Insertar el arreglo de Detalle de medicamentos	
	$arregloMed = $_POST["medicamento"]; //Arreglo de Medicinas
	$arregloCant = $_POST["cantidad"]; //Arreglo de Cantidad
	$cont_med='0';
	while($cont_med<count($arregloMed) && $cont_med<count($arregloCant)){	
		$Medicamento->setNom($arregloMed[$cont_med]);
		$vMedicamento=$Medicamento->valida_medicamento();
		if($vMedicamento=='-1'){
			$incluirMedicamento=$Medicamento->iMedicamento();
			if($incluirMedicamento!='-1'){
				$var_control=true;	 
				echo "Error 2";
			}else{
//si la inclusion del medicamento fue correcta procedemos a insetarlo en el detalle
				$Medicamento->setNom($arregloMed[$cont_med]);
				$bMedicamento=$Medicamento->bMedicamento();
				for($i=0;$i<count($bMedicamento);$i++){
					$idMedicamento=$bMedicamento[$i][1]; //Obtenemos el Id titular por la cedula
				}
				$result = $detalle_solicitud->UltimoID_solicitud();
				if ($result){
					$result = $detalle_solicitud->sig_tupla($result);		
					$id_detalle_solicitud = $result["id_detalle_solicitud"] + 1;
					}		
				$detalle_solicitud->setidDetalleSolicitud($id_detalle_solicitud);	
				$detalle_solicitud->setidSolicitud($idSolicitud);	
				$detalle_solicitud->setidMedicamento($idMedicamento);
				$detalle_solicitud->setCantidad($arregloCant[$cont_med]);
				$iDetalle_solicitud=$detalle_solicitud->iDetalle_solicitud();
				if($iDetalle_solicitud!='-1'){
					$var_control=true;	 
					echo "Error 4";
				}
			}
		}else{
//si el medicamento existe en la base de datos, se procese a incluir en el sistema el detalle
			$Medicamento->setNom($arregloMed[$cont_med]);
			$bMedicamento=$Medicamento->bMedicamento();
			for($i=0;$i<count($bMedicamento);$i++){
				$idMedicamento=$bMedicamento[$i][1]; //Obtenemos el Id titular por la cedula
			}
			$result = $detalle_solicitud->UltimoID_solicitud();
			if ($result){
				$result = $detalle_solicitud->sig_tupla($result);		
				$id_detalle_solicitud = $result["id_detalle_solicitud"] + 1;
				}		
			$detalle_solicitud->setidDetalleSolicitud($id_detalle_solicitud);	
			$detalle_solicitud->setidSolicitud($idSolicitud);	
			$detalle_solicitud->setidMedicamento($idMedicamento);
			$detalle_solicitud->setCantidad($arregloCant[$cont_med]);
			$iDetalle_solicitud=$detalle_solicitud->iDetalle_solicitud();
			if($iDetalle_solicitud!='-1'){
				$var_control=true;	 
				echo "Error 5";
			}
			//Registramos el detalle de profesion			
		}
		$cont_med++;	 
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
	if ($var_control){	
			$sMedicina->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$sMedicina->FinTransaccion();	
			echo "Los Datos se guardaron con Exito, Imprimir ? ";
			exit();	
		}
}
function modificar(){
	$sMedicina= new sMedicina();
	$id_detalle_coberutra=0;
	$Total=0;
	$Resta=0;	
	$var_control= false; //variable de control para seguir o terminar la transaccion	
//Obtenemos el id de la solicitud
	$sMedicina->setidSolicitud($_POST['idSolicitud']);
//id del Medicamento	
	$cantidad = $_POST["monto"]; //Arreglo de Cantidad
	$idMedicamento=$_POST["idMedicamento"]; //Arreglo de ids Medicamento;
	$arregloFactura=$_POST["nroFactura"];
	$arregloControl=$_POST["nroControl"];
	$cont_cant='0';
	$sMedicina->IniciaTransaccion();
	while($cont_cant<count($cantidad) && $cont_cant<count($idMedicamento)){
		$plata=str_replace("Bs ","",$cantidad[$cont_cant]);		
	$sMedicina->setMonto($plata);
	$sMedicina->setidMedicamento($idMedicamento[$cont_cant]);	
	$sMedicina->setnroFactura($arregloFactura[$cont_cant]);
	$sMedicina->setnroControl($arregloControl[$cont_cant]);
	$moficiar=$sMedicina->mDetalle_solcitud();
	if($moficiar!='-1'){
		echo "Error 1";
		$var_control=true;
	}else{
		$Total+=$cantidad[$cont_cant];
	}
	$cont_cant++;	
	}	
//Verificamos los id del Titular y Beneficiario para enviarlo
	if(isset($_POST['idTitular'])){
		$sMedicina->setidTitular($_POST['idTitular']);
		$sMedicina->setidBeneficiario('0');
		$sMedicina->settipoBeneficiario('T');		
	}
	if(isset($_POST['idBeneficiario'])){
		$sMedicina->setidTitular('0');
		$sMedicina->setidBeneficiario($_POST['idBeneficiario']);
		$sMedicina->settipoBeneficiario('B');
	}
//obtenemos el ultimo id del detalle de la cobertura
	$id = $sMedicina->UltimoID_dCobertura();
		if ($id){
			$id = $sMedicina->sig_tupla($id);		
			$id_detalle_coberutra = $id["id_detalle_cobertura"] + 1;
		}	
//Buscamos la cobertura para el primer registro del consumo inicial.	
	$result=$sMedicina->buscar_cobertura();
	if ($result){
			$result = $sMedicina->sig_tupla($result);	
//El Monto de la cobertura	
			$Monto = $result["monto"];
//El id de la cobertura para el detalle
			$idCobertura=$result["id_cobertura"];
		}
	$buscar=$sMedicina->montoDisponible();
	if ($buscar){
			$buscar = $sMedicina->sig_tupla($buscar);	
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
		echo "Error 2";
	// echo "Sobrepasa el limite de cobertura. \n"	;
	 $var_control=true;
	}
	$sMedicina->setidCobertura($idCobertura);
	$sMedicina->setidDetalle_cobertura($id_detalle_coberutra);
	$sMedicina->setmontoDisponible($Resta);
	$iDetalle_cobertura=$sMedicina->iDetalle_cobertura();
	if($iDetalle_cobertura!='-1'){
		echo "Error 3";
		$var_control=true;
	}
	$solicitudProcesada=$sMedicina->solicitudProcesada();
	if($solicitudProcesada!='-1'){
		echo "Error 4";
		$var_control=true;
	}
	if ($var_control){	
			$sMedicina->RompeTransaccion();		
			echo "No se pudo llevar a cabo el registro debido a un error interno de la Base de Datos.";
			exit();
		}else{
			$sMedicina->FinTransaccion();	
			echo "bien";
			exit();	
		}
}
?>
