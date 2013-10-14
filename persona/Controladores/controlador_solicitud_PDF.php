<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_solicitud_medicina_PDF.php");
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_solicitud_medicina.php");
	include_once("../Clases/clase_solicitud_orden.php");
	include_once("../Clases/clase_solicitud_reembolso.php");
	include_once("../Clases/clase_recaudo.php");
	$recaudo= new recaudos();
	$sOrden= new sOrden();
	$titular= new titular();	
	$sMedicina = new sMedicina();
	$sReembolso= new sReembolso();
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
  	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(10,10,10,10);
	if(isset($_GET['id'])){
	$sMedicina->setidSolicitud($_GET['id']);
	$verificar=$sMedicina->buscar_idservicio();
		if ($verificar){
		$verificar = $sMedicina->sig_tupla($verificar);
		$tipoSolicitud= $verificar["id_servicio"];
		$idReembolso= $verificar["id_solicitud_reembolso"];
		}
	$sOrden->settipoServicio($tipoSolicitud);
		if($tipoSolicitud=='1' && $idReembolso=='0'){
			$consulta = $sMedicina->cabecera_SM();			
			$pdf->Cell(43,6,' ',0,0,'C',true);
			$pdf->Cell(50,6,' ',0,0,'C',true);
			$pdf->Cell(50,6,' ',0,0,'C',true);
				if($consulta){
				$consulta = $sMedicina->sig_tupla($consulta);		
			$pdf->Cell(45,6,$consulta["cod_hoja"],1,1,'C',true);	
				$pdf->SetFont('Times','B',13);	
				$pdf->Cell(143,6,'',0,0,'C',true);
				$pdf->Cell(45,6,' ','T',1,'C',true);
				$pdf->Cell(188,6,$consulta["descripcion"],0,1,'C',true);
				$pdf->SetFont('Times','',9);
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->SetFont('Times','',11);
				$pdf->Cell(188,6,'EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A.',0,1,'C',true);
				$pdf->Cell(188,6,'',0,1,'C',true);
				$pdf->SetFont('Times','',11);	
				$pdf->Cell(188,6,'Farmacia: '.$consulta["alias"],0,1,'L',true);
				$pdf->Cell(188,6,'Direccion: '.$consulta["direccion"],0,1,'L',true);	
				$pdf->Cell(161,6,'Apellido(s) y Nombres(s) del Titular: '.utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'L',true);
				$pdf->Cell(27,6,'C.I: '.$consulta["cedula"],1,1,'C.I:',true);
				$pdf->Cell(118,6,'Apellido(s) y Nombres(s) del Beneficiario: ',1,0,'C',true);
				$pdf->Cell(35,6,'Cedula de Identidad',1,0,'C',true);
				$pdf->Cell(35,6,'Parentesco',1,1,'C',true);
				if($consulta["id_beneficiario"]=='0'){
					$pdf->Cell(118,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
					$pdf->Cell(35,6,$consulta["cedula"],1,0,'C',true);
					$pdf->Cell(35,6,'Titular',1,1,'C',true);
				}else{
					$sMedicina->setidBeneficiario($consulta["id_beneficiario"]);
					$consulta_B=$sMedicina->consultar_beneficiario();
					$consulta_B=$sMedicina->sig_tupla($consulta_B);	
					$pdf->Cell(118,6,utf8_decode($consulta_B["nombre1"]).' '.utf8_decode($consulta_B["nombre2"]).' '.utf8_decode($consulta_B["apellido1"]).' '.utf8_decode($consulta_B["apellido2"]),1,0,'C',true);
					$pdf->Cell(35,6,$consulta_B["cedula"],1,0,'C',true);
					$pdf->Cell(35,6,$consulta_B["parentesco"],1,1,'C',true);		
				}
				$pdf->Cell(90,6,'Pertenece a la Unidad o Plata:',1,0,'C',true);
				$pdf->Cell(63,6,'Atoriza para retirar:',1,0,'C',true);
				$pdf->Cell(35,6,'Cedula:',1,1,'C',true);
				$pdf->Cell(90,6,$consulta["upsa"],1,0,'C',true);
				$pdf->Cell(63,6,'',1,0,'C',true);
				$pdf->Cell(35,6,'',1,1,'C',true);
				$pdf->Cell(188,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD',1,1,'C',true);
				$pdf->Cell(85,6,'MEDICAMENTOS',1,0,'C',true);
				$pdf->Cell(73,6,'DENOMINACION',1,0,'C',true);
				$pdf->Cell(30,6,'CANTIDAD',1,1,'C',true);
				$sMedicina->setidSolicitud($consulta['id_solicitud']);
					$consulta_detalle=$sMedicina->detalle_SM();
					for($i=0;$i<count($consulta_detalle);$i++){		
						$pdf->Cell(85,6,$consulta_detalle[$i]['1'],1,0,'C',true);
						$pdf->Cell(73,6,''/*$consulta_detalle['denominacion']*/,1,0,'C',true);
						$pdf->Cell(30,6,$consulta_detalle[$i]['2'],1,1,'C',true);
					}
				$pdf->Cell(188,6,'OBSERVACIONES: ','LTR',1,'l',true);
				$pdf->Cell(188,6,$consulta['observacion'],'LRB',1,'L',true);
				$consul=$sMedicina->buscar_reacudos_solicitud();			
	$pdf->Cell(188,6,'Vereficar Orden(es) y Recaudo(s) Anexo(s)','RLT',1,'L',true);	
		for($i=0;$i<count($consul);$i++)			
			{		
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}
			}
		$pdf->multiCell(188,6,utf8_decode($prueba),'LRB',1,'L',true);
				$pdf->Cell(188,6,'Fecha Emision: '. date('d-m-Y'),1,1,'L',true);
				$pdf->Cell(63,6,'Autorizado por:',1,0,'L',true);
				$pdf->Cell(62,6,'Retirado por:',1,0,'L',true);
				$pdf->Cell(63,6,'Sistema Autogestionado de salud',1,1,'L',true);
				$pdf->Cell(63,6,'Firma y Sello','LRT',0,'L',true);
				$pdf->Cell(62,6,'Firma','LRT',0,'L',true);
				$pdf->Cell(63,6,'Firma y Sello','LRT',1,'L',true);
				$pdf->Cell(63,6,'','LR',0,'L',true);
				$pdf->Cell(62,6,'','LR',0,'L',true);
				$pdf->Cell(63,6,'','LR',1,'L',true);
				$pdf->Cell(63,6,'','LRB',0,'L',true);
				$pdf->Cell(62,6,'','LRB',0,'L',true);
				$pdf->Cell(63,6,'','LRB',1,'L',true);
				$pdf->SetFont('Times','B',6);	
				$pdf->Cell(188,6,'','T',1,'L',true);
				$pdf->Cell(188,6,'FACTURAR A NOMBRE DE LA EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A',0,1,'L',true);
			$pdf->Output();//cierre del si de $tipoSolicitud;
			}//cierre del si $consulta
			}elseif($tipoSolicitud!='1'  && $idReembolso=='0'){
				$sOrden->setidSolicitud($_GET['id']);
				$consulta = $sOrden->cabecera_SM();			
				$pdf->Cell(43,6,' ',0,0,'C',true);
				$pdf->Cell(50,6,' ',0,0,'C',true);
				$pdf->Cell(50,6,' ',0,0,'C',true);		
				if ($consulta){
					$consulta = $sOrden->sig_tupla($consulta);	
				$pdf->Cell(45,6,$consulta["cod_hoja"],1,1,'C',true);
			
				$pdf->SetFont('Times','B',12);	
				$pdf->Cell(143,6,'',0,0,'C',true);
				$pdf->Cell(45,6,' ','T',1,'C',true);
				$pdf->Cell(188,6,utf8_decode($consulta["descripcion"]),0,1,'C',true);
					$pdf->SetFont('Times','',9);
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->SetFont('Times','',11);
				$pdf->Cell(188,6,'EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A.',0,1,'C',true);
				$pdf->Cell(188,6,'',0,1,'C',true);
				$pdf->SetFont('Times','',11);	
				$pdf->Cell(188,6,'Farmacia: '.$consulta["alias"],0,1,'L',true);
				$pdf->Cell(188,6,'Direccion: '.$consulta["direccion"],0,1,'L',true);	
				$pdf->Cell(161,6,'Apellido(s) y Nombres(s) del Titular: '.utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'L',true);
				$pdf->Cell(27,6,'C.I: '.$consulta["cedula"],1,1,'C.I:',true);
				$pdf->Cell(118,6,'Apellido(s) y Nombres(s) del Beneficiario: ',1,0,'C',true);
				$pdf->Cell(35,6,'Cedula de Identidad',1,0,'C',true);
				$pdf->Cell(35,6,'Parentesco',1,1,'C',true);
				if($consulta["id_beneficiario"]=='0'){
					$pdf->Cell(118,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
				$pdf->Cell(35,6,$consulta["cedula"],1,0,'C',true);
				$pdf->Cell(35,6,'Titular',1,1,'C',true);
				}else{
					$sOrden->setidBeneficiario($consulta["id_beneficiario"]);
					$consulta_B=$sOrden->consultar_beneficiario();
					$consulta_B=$sOrden->sig_tupla($consulta_B);	
				$pdf->Cell(118,6,utf8_decode($consulta_B["nombre1"]).' '.utf8_decode($consulta_B["nombre2"]).' '.utf8_decode($consulta_B["apellido1"]).' '.utf8_decode($consulta_B["apellido2"]),1,0,'C',true);
				$pdf->Cell(35,6,$consulta_B["cedula"],1,0,'C',true);
				$pdf->Cell(35,6,$consulta_B["parentesco"],1,1,'C',true);	
				}
			$pdf->Cell(90,6,'Pertenece a la Unidad o Plata:',1,0,'C',true);
				$pdf->Cell(63,6,'Atoriza para retirar:',1,0,'C',true);
				$pdf->Cell(35,6,'Cedula:',1,1,'C',true);
				$pdf->Cell(90,6,$consulta["upsa"],1,0,'C',true);
				$pdf->Cell(63,6,'',1,0,'C',true);
				$pdf->Cell(35,6,'',1,1,'C',true);
				$pdf->Cell(188,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD'.$consulta['id_solicitud'],1,1,'C',true);
//SOLICITUD DE CONSULTA 	
				$sOrden->setidSolicitud($consulta['id_solicitud']);
				if($tipoSolicitud=='5'){					
				$consulta_detalle=$sOrden->detalle_SM_1();
				$pdf->Cell(188,4,'','T',1,'L',true);
				for($i=0;$i<count($consulta_detalle);$i++){		
				$pdf->MultiCell(188,6,'Motivo: '.$consulta_detalle[$i]['2'],1,'J',1,8);
					$pdf->Cell(188,4,'','T',1,'L',true);
				$pdf->MultiCell(188,6,utf8_decode('Diagnostico: ').$consulta_detalle[$i]['3'],1,'J',1,8);
					
				}
				$pdf->Cell(188,4,'','T',1,'L',true);
				}else{
					$pdf->Cell(188,4,'','T',1,'L',true);
				$consulta_detalle=$sOrden->detalle_SM_1();
				for($i=0;$i<count($consulta_detalle);$i++){		
				$pdf->Cell(188,6,'Examen: '.$consulta_detalle[$i]['4'],1,1,'L',true);
					$pdf->Cell(188,4,'','T',1,'L',true);
				$pdf->Cell(188,6,utf8_decode('Descripción: ').$consulta_detalle[$i]['1'],1,1,'L',true);	
				}
					$pdf->Cell(188,4,'','T',1,'L',true);
				$pdf->Cell(188,6,'OBSERVACIONES: ','LTR',1,'l',true);
					$pdf->Cell(188,6,$consulta['observacion'],'LRB',1,'L',true);				
				}	
				$consul=$sOrden->buscar_reacudos_solicitud();			
				$pdf->Cell(188,6,'Vereficar Orden(es) y Recaudo(s) Anexo(s)',1,1,'L',true);		
				for($i=0;$i<count($consul);$i++)			
			{		
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}
			}
		$pdf->multiCell(188,6,utf8_decode($prueba),'LRB',1,'L',true);						
				$pdf->Cell(188,6,'Fecha Emision: '. date('d-m-Y'),1,1,'L',true);
				$pdf->Cell(70,6,utf8_decode('Centro Médico o Médico tratante'),1,0,'L',true);
				$pdf->Cell(58,6,'Firma del Paciente',1,0,'L',true);
				$pdf->Cell(60,6,'Sistema Autogestionado de salud',1,1,'L',true);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(70,6,'Firma y Sello','LRT',0,'L',true);
				$pdf->Cell(58,6,'','LRT',0,'L',true);
				$pdf->Cell(60,6,'','LRT',1,'L',true);		
				$pdf->Cell(70,6,'','LR',0,'L',true);
				$pdf->Cell(58,6,'','LR',0,'L',true);	
				$pdf->Cell(60,6,'','LR',1,'L',true);
				$pdf->Cell(70,6,'','LRB',0,'L',true);
				$pdf->Cell(58,6,'','LRB',0,'L',true);
				$pdf->Cell(60,6,'','LRB',1,'L',true);
				$pdf->SetFont('Times','B',6);	
				$pdf->Cell(188,6,'','T',1,'L',true);
				$pdf->Cell(188,6,'FACTURAR A NOMBRE DE LA EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A',0,1,'L',true);				
				}//cierre del si $consulta
				$pdf->Output();
				//cierre del si $tipoSolicitud
			}
			
		
			
	}
	if(isset($_GET['id_r'])){
		$sReembolso->setidSolicitud_reembolso($_GET['id_r']);
		$consulta=$sReembolso->cabecera_Reembolso();
		if ($consulta){
		$consulta = $sReembolso->sig_tupla($consulta);
		
		$pdf->Cell(43,6,' ',0,0,'C',true);
		$pdf->Cell(50,6,' ',0,0,'C',true);
		$pdf->Cell(50,6,' ',0,0,'C',true);	
		$pdf->Cell(45,6,$consulta["cod_hoja"],1,1,'C',true);
		$pdf->SetFont('Times','B',12);	
				$pdf->Cell(143,6,'',0,0,'C',true);
				$pdf->Cell(45,6,' ','T',1,'C',true);
				$pdf->Cell(188,6,'SOLICITUD DE REEMBOLSO',0,1,'C',true);
			$pdf->SetFont('Times','',9);
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->SetFont('Times','',11);
				$pdf->Cell(188,6,'EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A.',0,1,'C',true);
				$pdf->Cell(188,6,'',0,1,'C',true);
			$pdf->SetFont('Times','',11);	
				$elDia=substr($consulta["fecha"],8,2);
		$elMes=substr($consulta["fecha"],5,2);
		$elYear=substr($consulta["fecha"],0,4);
		$fecha=$elDia."-".$elMes."-".$elYear;		
			$pdf->Cell(70,6,'Fecha Emision: '.$fecha,1,1,'L',true);
		$pdf->Cell(161,6,'Apellido(s) y Nombres(s) del Titular: '.utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'L',true);
	$pdf->Cell(27,6,'C.I: '.$consulta["cedula"],1,1,'C.I:',true);
	$pdf->Cell(118,6,'Apellido(s) y Nombres(s) del Beneficiario: ',1,0,'C',true);
	$pdf->Cell(35,6,'Cedula de Identidad',1,0,'C',true);
	$pdf->Cell(35,6,'Parentesco',1,1,'C',true);
	if($consulta["id_beneficiario"]=='0'){
		$pdf->Cell(118,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,'Titular',1,1,'C',true);
	}else{
		$sReembolso->setidBeneficiario($consulta["id_beneficiario"]);
		$consulta_B=$sReembolso->consultar_beneficiario();
		$consulta_B=$sReembolso->sig_tupla($consulta_B);	
	$pdf->Cell(118,6,utf8_decode($consulta_B["nombre1"]).' '.utf8_decode($consulta_B["nombre2"]).' '.utf8_decode($consulta_B["apellido1"]).' '.utf8_decode($consulta_B["apellido2"]),1,0,'C',true);
	$pdf->Cell(35,6,$consulta_B["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta_B["parentesco"],1,1,'C',true);	
	}
$pdf->Cell(100,6,'Pertenece a la Unidad o Plata:',1,0,'C',true);
	$pdf->Cell(35,6,utf8_decode('Tipo Nómina'),1,0,'C',true);
	$pdf->Cell(53,6,'Tlf. Habitacion / Celular',1,1,'C',true);
	$pdf->Cell(100,6,$consulta["upsa"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta["nomina"],1,0,'C',true);
	$pdf->Cell(53,6,$consulta["telefono"].' / '.$consulta["celular"],1,1,'C',true);
	$pdf->Cell(188,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD',1,1,'C',true);
	$sReembolso->setidSolicitud_reembolso($consulta['id_solicitud_reembolso']);
	$consulta_detalle=$sReembolso->Detalle_reembolso();
$pdf->Cell(188,2,'','T',1,'L',true);
	$pdf->Cell(188,6,'Servicio: '.utf8_decode($consulta["servicio"]),1,1,'L',true);
		
	for($i=0;$i<count($consulta_detalle);$i++){	

	$pdf->Cell(62,6,'Nro Factura: '.$consulta_detalle[$i]['1'],1,0,'L',true);
	$pdf->Cell(63,6,'Nro Control: '.$consulta_detalle[$i]['2'],1,0,'L',true);
	$pdf->Cell(63,6,'Monto Factura '.$consulta_detalle[$i]['4'],1,1,'L',true);	
	$pdf->multiCell(188,6,utf8_decode('Descripción: ').$consulta_detalle[$i]['3'],1,1,'L',true);	
			
	}	
	$pdf->Cell(188,2,'','T',1,'L',true);
	$pdf->Cell(188,6,'OBSERVACION: ','LTR',1,'l',true);
		$pdf->Cell(188,6,$consulta['observacion'],'LR',1,'L',true);
	$pdf->Cell(188,6,'DIAGNOSTICO: ','LTR',1,'l',true);
		$pdf->Cell(188,6,$consulta['diagnostico'],'LRB',1,'L',true);	
	$consul=$sReembolso->buscar_reacudos_solicitud();			
	$pdf->Cell(188,6,'Vereficar Orden(es) y Recaudo(s) Anexo(s)','RLT',1,'L',true);
	for($i=0;$i<count($consul);$i++)			
			{
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}			
			}
		$pdf->multiCell(188,6,utf8_decode($prueba),'LRB',1,'L',true);
	$pdf->Cell(70,6,'Trabajador',1,0,'L',true);
	$pdf->Cell(118,6,'Sistema Autogestionado de salud',1,1,'L',true);
	$pdf->Cell(70,6,'Firma','LR',0,'L',true);
	$pdf->Cell(118,6,'Firma y Sello','LR',1,'L',true);
	$pdf->Cell(70,6,'','LRB',0,'L',true);
	$pdf->Cell(118,6,'','LRB',0,'L',true);	
		$pdf->Output();
		}
		
	}
	
	
?>