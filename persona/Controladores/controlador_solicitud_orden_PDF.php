<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_solicitud_medicina_PDF.php");
	include_once("../Clases/clase_solicitud_orden.php");
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_recaudo.php");
	$recaudo= new recaudos();
	$titular= new titular();
	$sOrden= new sOrden();
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
  	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(10,10,10,10);
	$titular->setCed($_GET['cd']);
		$rspTitular=$titular->validar_titular();
		if($rspTitular){
			$resutl=$titular->sig_tupla($rspTitular);
			$idTitular=$result["id_titular"];
		}
		echo $idTitular;
	$sOrden->setidTitular($idTitular);
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
	$pdf->Cell(188,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD',1,1,'C',true);
		$pdf->Cell(188,4,'','T',1,'L',true);
	$sOrden->setidSolicitud($consulta['id_solicitud']);
	$consulta_detalle=$sOrden->detalle_SM_1();
	for($i=0;$i<count($consulta_detalle);$i++){		
	$pdf->Cell(188,6,'Examen: '.$consulta_detalle[$i]['4'],1,1,'L',true);
		$pdf->Cell(188,4,'','T',1,'L',true);
	$pdf->Cell(188,6,utf8_decode('Descripción: ').$consulta_detalle[$i]['1'],1,1,'L',true);	
	}
		$pdf->Cell(188,4,'','T',1,'L',true);
	$pdf->Cell(188,6,'OBSERVACIONES: ','LTR',1,'l',true);
		$pdf->Cell(188,6,$consulta['observacion'],'LRB',1,'L',true);
	$consul=$sOrden->buscar_reacudos_solicitud();			
	$pdf->Cell(188,6,'Vereficar Orden(es) y Recaudo(s) Anexo(s)',1,1,'L',true);
$prueba = array();
		for($i=0;$i<count($consul);$i++)			
			{		
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}
			}
		$pdf->multiCell(188,6,utf8_decode($prueba),'LRB',1,'L',true);
	$pdf->Cell(188,6,'Fecha Emision: '.$consulta["fecha"],1,1,'L',true);
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
	
	}
	$pdf->Output();
	
