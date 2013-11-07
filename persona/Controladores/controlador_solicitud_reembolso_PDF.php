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
	$pdf->SetMargins(8,10,10,10);
if(isset($_GET['cd'])){
		$titular->setCed($_GET['cd']);
		$buscarTitular=$titular->validar_titular();
	if($buscarTitular){
			$resl=$titular->sig_tupla($buscarTitular);
			$idTitular=$resl['id_titular'];
		}
		$sReembolso->setidTitular($idTitular);
		$consulta=$sReembolso->cabecera_Reembolso();
		if ($consulta){
		$consulta = $sReembolso->sig_tupla($consulta);		
		$pdf->Cell(50,6,' ',0,0,'C',true);
		$pdf->Cell(50,6,' ',0,0,'C',true);
		$pdf->Cell(50,6,' ',0,0,'C',true);	
		$pdf->Cell(45,6,$consulta["cod_hoja"],1,1,'C',true);
		$pdf->SetFont('Times','B',11);	
				$pdf->Cell(152,6,'',0,0,'C',true);
				$pdf->Cell(45,6,' ','T',1,'C',true);
			$pdf->Cell(188,6,'SOLICITUD DE REEMBOLSO',0,1,'C',true);
		$pdf->SetFont('Times','',8);	
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->Cell(188,6,'',0,1,'C',true);
		
		$elDia=substr($consulta["fecha"],8,2);
		$elMes=substr($consulta["fecha"],5,2);
		$elYear=substr($consulta["fecha"],0,4);
		$fecha=$elDia."-".$elMes."-".$elYear;		
			$pdf->SetFont('Times','B',10);
			$pdf->Cell(23,6,'Fecha Emision: ','TBL',0,'L',true);
				$pdf->SetFont('Times','',10);
			$pdf->Cell(40,6,$fecha,'RTB',1,'L',true);
				$pdf->SetFont('Times','B',10);
		$pdf->Cell(160,6,'NOMBRE(S) Y APELLIDO(S) DEL TITULAR',1,0,'C',true);
	$pdf->Cell(35,6,'CED. IDENTIDAD',1,1,'C',true);
		$pdf->SetFont('Times','',10);
	$pdf->Cell(160,6,utf8_decode($consulta["nombre1"].' '.$consulta["nombre2"].' '.$consulta["apellido1"].' '.$consulta["apellido2"]),1,0,'C',true);
	$pdf->Cell(35,6,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,1,'C',true);
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(124,6,'NOMBRE(S) Y APELLIDO(S) DEL BENEFICIARIO ',1,0,'C',true);
	$pdf->Cell(36,6,'CED. IDENTIDAD',1,0,'C',true);
	$pdf->Cell(35,6,'PARENTESCO',1,1,'C',true);
		$pdf->SetFont('Times','',10);
	if($consulta["id_beneficiario"]=='0'){
		$pdf->Cell(124,6,utf8_decode($consulta["nombre1"].' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"]),1,0,'C',true);
	$pdf->Cell(36,6,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,'Titular',1,1,'C',true);
	}else{
		$sReembolso->setidBeneficiario($consulta["id_beneficiario"]);
		$consulta_B=$sReembolso->consultar_beneficiario();
		$consulta_B=$sReembolso->sig_tupla($consulta_B);	
	$pdf->Cell(124,6,utf8_decode($consulta_B["nombre1"].' '.$consulta_B["nombre2"].' '.$consulta_B["apellido1"].' '.$consulta_B["apellido2"]),1,0,'C',true);
	$pdf->Cell(36,6,$consulta_B["nacionalidad"].'-'.$consulta_B["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta_B["parentesco"],1,1,'C',true);		
	}
	if($consulta["nomina"]=='C'){
		$tipoNomina="CONTRATADO";
	}elseif($consulta["nomina"]=='P'){
		$tipoNomina="PRESIDENTE";
	}elseif($consulta["nomina"]=='O'){
		$tipoNomina="OBRERO";
	}elseif($consulta["nomina"]=='D'){
		$tipoNomina="DIRECTIVO";
	}elseif($consulta["nomina"]=='E'){
		$tipoNomina="EMPLEADO";
	}
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(100,6,'PERTENECE A LA UNIDAD O PLANTA',1,0,'C',true);
	$pdf->Cell(36,6,utf8_decode('TIPO NÓMINA'),1,0,'C',true);
	$pdf->Cell(59,6,utf8_decode('TLF. HABITACIÓN / CELULAR'),1,1,'C',true);
		$pdf->SetFont('Times','',10);
	$pdf->Cell(100,6,utf8_decode($consulta["upsa"]),1,0,'C',true);
	$pdf->Cell(36,6,utf8_decode($tipoNomina),1,0,'C',true);
	$pdf->Cell(59,6,$consulta["telefono"].' / '.$consulta["celular"],1,1,'C',true);
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(195,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD',1,1,'C',true);
	$sReembolso->setidSolicitud_reembolso($consulta['id_solicitud_reembolso']);
	$consulta_detalle=$sReembolso->Detalle_reembolso();
$pdf->Cell(188,2,'','T',1,'L',true);
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(20,6,'SERVICIO:','LBT',0,'L',true);
		$pdf->SetFont('Times','',10);
	$pdf->Cell(175,6,utf8_decode($consulta["servicio"]),'RBT',1,'L',true);
	
	for($i=0;$i<count($consulta_detalle);$i++){	
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(28,6,'NRO. FACTURA: ','LBT',0,'L',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(34,6,$consulta_detalle[$i]['1'],'TBR',0,'L',true);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(28,6,'NRO. CONTROL:','TBL',0,'L',true);		
	$pdf->SetFont('Times','',10);
	$pdf->Cell(34,6,$consulta_detalle[$i]['2'],'TBR',0,'L',true);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(33,6,'MONTO FACTURA:','LTB',0,'L',true);	
	$pdf->SetFont('Times','',10);
	$pdf->Cell(38,6,$consulta_detalle[$i]['4'],'TBR',1,'L',true);	
	/*Intenta adivinar que hace esto es facil.
	$cant=strlen($consulta_detalle[$i]['3']);
	$espacios = substr_count($consulta_detalle[$i]['3']," ");
	$numTotal=$cant+$espacios;
	if($numTotal>80){
		$pdf->Cell(28,6,utf8_decode('DESCRIPCIÓN: '),'RLT',0,'L',true);
		$pdf->Cell(167,6,'','BLT',1,'L',true);
		$pdf->multiCell(195,6,utf8_decode($consulta_detalle[$i]['3']),'LRB',1,'L',true);	
	}else{	
		$pdf->Cell(28,6,utf8_decode('DESCRIPCIÓN: '),1,0,'L',true);
		$pdf->multiCell(167,6,utf8_decode($consulta_detalle[$i]['3']),1,1,'L',true);	}
		$pdf->Cell(28,1,'',0,1,'L',true);
			
	}	*/
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(28,6,utf8_decode('DESCRIPCIÓN: '),1,0,'L',true);
	$pdf->SetFont('Times','',10);
	$pdf->multiCell(167,6,utf8_decode($consulta_detalle[$i]['3']),1,1,'L',true);	}
	$pdf->Cell(28,1,'',0,1,'L',true);
	
	$pdf->Cell(195,2,'',0,1,'L',true);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(195,6,utf8_decode('OBSERVACIÓN'),'LTR',1,'l',true);
	$pdf->SetFont('Times','',10);
		$pdf->Cell(195,6,utf8_decode($consulta['observacion']),'LRB',1,'L',true);
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(195,6,'DIAGNOSTICO','LTR',1,'l',true);
	$pdf->SetFont('Times','',10);
		$pdf->Cell(195,6,utf8_decode($consulta['diagnostico']),'LRB',1,'L',true);	
	$consul=$sReembolso->buscar_reacudos_solicitud();	
	$pdf->SetFont('Times','B',10);		
	$pdf->Cell(195,6,utf8_decode('VERIFICAR RÉCIPE(S) E INDICACIONES (ANEXO(S))'),'RLT',1,'L',true);
	$prueba = array();
		for($i=0;$i<count($consul);$i++)			
			{		
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}
			}
		$pdf->SetFont('Times','',10);
		$pdf->multiCell(195,6,utf8_decode($prueba),'LRB',1,'L',true);
		$pdf->SetFont('Times','B',10);
	$pdf->Cell(77,6,'TRABAJADOR','LRT',0,'L',true);
	$pdf->Cell(118,6,'SISTEMA AUTOGESTIONADO DE SALUD','LRT',1,'L',true);
	$pdf->Cell(77,6,'Firma','LR',0,'L',true);
	$pdf->Cell(118,6,'Firma y Sello','LR',1,'L',true);
	$pdf->Cell(77,6,'','LR',0,'L',true);
	$pdf->Cell(118,6,'','LR',1,'L',true);
	$pdf->Cell(77,6,'','LR',0,'L',true);
	$pdf->Cell(118,6,'','LR',1,'L',true);
	$pdf->Cell(77,6,'','LRB',0,'L',true);
	$pdf->Cell(118,6,'','LRB',0,'L',true);	
		$pdf->Output();
		}
}	
?>
