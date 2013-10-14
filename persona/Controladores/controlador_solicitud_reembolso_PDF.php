<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_solicitud_reembolso.php");
	include_once("../Clases/clase_recaudo.php");
	include_once("../Clases/clase_solicitud_medicina_PDF.php");

	$recaudo= new recaudos();
	$titular= new titular();	
	$sReembolso= new sReembolso();
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
  	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(10,10,10,10);
if(isset($_GET['cd'])){
		$titular->setCed($_GET['cd']);
		$buscarTitular=$titular->validar_titular();
		for($i=0;$i<count($buscarTitular);$i++){
			$idTitular=$buscarTitular[$i][1]; //Obtenemos el Id titular por la cedula
		}
		$sReembolso->setidTitular($idTitular);
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
		$pdf->SetFont('Times','',8);	
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
		$pdf->SetFont('Times','',9);	
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