<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_solicitud_medicina_PDF.php");
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_solicitud_medicina.php");
	$titular= new titular();	
	$sMedicina = new sMedicina();
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
  	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(8,10,10,10);
//envio la cedula para buscar el id del titular
	if(isset($_GET['cd'])){
		$titular->setCed($_GET['cd']);
		$buscarTitular=$titular->validar_titular();
		if($buscarTitular){
			$resl=$titular->sig_tupla($buscarTitular);
			$idTitular=$resl['id_titular'];
		}
	$sMedicina->setidTitular($idTitular);
	$consulta = $sMedicina->cabecera_SM();	
	if ($consulta){
		$consulta = $sMedicina->sig_tupla($consulta);			
	$pdf->Cell(50,6,' ',0,0,'C',true);
	$pdf->Cell(50,6,' ',0,0,'C',true);
	$pdf->Cell(50,6,' ',0,0,'C',true);	
	$pdf->Cell(45,6,$consulta["cod_hoja"],1,1,'C',true);
	
	$pdf->SetFont('Times','B',11);	
	$pdf->Cell(152,6,'',0,0,'C',true);
	$pdf->Cell(45,6,' ','T',1,'C',true);
	$pdf->Cell(195,6,utf8_decode($consulta["descripcion"]),0,1,'C',true);
	$pdf->SetFont('Times','',8);	
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->Cell(188,6,'',0,1,'C',true);
	$pdf->Cell(195,6,'',0,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(22,6,utf8_decode('FARMACIA: '),0,0,'L',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(173,6,utf8_decode($consulta["alias"]),0,1,'L',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(25,6,utf8_decode('DIRECCIÓN: '),0,0,'L',true);	
	$pdf->SetFont('Times','',10);
	$pdf->Cell(170,6,utf8_decode($consulta["direccion"]),0,1,'L',true);		
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(160,6,'NOMBRE(S) Y APELLIDO(S) DEL TITULAR',1,0,'C',true);
	$pdf->Cell(35,6,'CED. IDENTIDAD',1,1,'C',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(160,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].' '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(124,6,'NOMBRE(S) Y APELLIDO(S) DEL BENEFICIARIO ',1,0,'C',true);
	$pdf->Cell(36,6,'CED. IDENTIDAD',1,0,'C',true);
	$pdf->Cell(35,6,'PARENTESCO',1,1,'C',true);
		$pdf->SetFont('Times','',10);
	if($consulta["id_beneficiario"]=='0'){
		$pdf->Cell(124,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
	$pdf->Cell(36,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,'Titular',1,1,'C',true);
	}else{
		$sMedicina->setidBeneficiario($consulta["id_beneficiario"]);
		$consulta_B=$sMedicina->consultar_beneficiario();
		$consulta_B=$sMedicina->sig_tupla($consulta_B);	
	$pdf->Cell(124,6,utf8_decode($consulta_B["nombre1"]).' '.utf8_decode($consulta_B["nombre2"]).' '.utf8_decode($consulta_B["apellido1"]).' '.utf8_decode($consulta_B["apellido2"]),1,0,'C',true);
	$pdf->Cell(36,6,$consulta_B["nacionalidad"].'-'.$consulta_B["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta_B["parentesco"],1,1,'C',true);		
	}
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(90,6,'PERTENECE A LA UNIDAD O PLANTA	',1,0,'C',true);
	$pdf->Cell(70,6,'AUTORIZADO A RETIRAR',1,0,'C',true);
	$pdf->Cell(35,6,'CED. IDENTIDAD',1,1,'C',true);
	$pdf->SetFont('Times','',10);	
	$pdf->Cell(90,6,$consulta["upsa"],1,0,'C',true);
	$pdf->Cell(70,6,$consulta["autorizado"],1,0,'C',true);
	if($consulta["ced_autorizado"]==0){ $ced_auto="";}else{ $ced_auto==$consulta["ced_autorizado"];}
	$pdf->Cell(35,6,$ced_auto,1,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(195,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD',1,1,'C',true);
	$pdf->Cell(165,6,'MEDICAMENTOS',1,0,'C',true);
	//$pdf->Cell(73,6,'DENOMINACION',1,0,'C',true);
	$pdf->Cell(30,6,'CANTIDAD',1,1,'C',true);
	$pdf->SetFont('Times','',10);	
	$sMedicina->setidSolicitud($consulta['id_solicitud']);
	$consulta_detalle=$sMedicina->detalle_SM();
	for($i=0;$i<count($consulta_detalle);$i++){		
	$pdf->Cell(165,6,$consulta_detalle[$i]['1'],1,0,'C',true);
	/*$pdf->Cell(73,6,''$consulta_detalle['denominacion'],1,0,'C',true);*/
	$pdf->Cell(30,6,$consulta_detalle[$i]['2'],1,1,'C',true);
	}
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(195,6,'OBSERVACIONES: ','LTR',1,'l',true);
	$pdf->SetFont('Times','',10);	
		$pdf->Cell(195,6,$consulta['observacion'],'LRB',1,'L',true);
	$consul=$sMedicina->buscar_reacudos_solicitud();	
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(195,6,utf8_decode('VERIFICAR RÉCIPE(S) E INDICACIONES (ANEXO(S)):'),'LRT',1,'L',true);
	$pdf->SetFont('Times','',10);	
	$prueba = array();
		for($i=0;$i<count($consul);$i++)			
			{		
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}
			}
		$pdf->multiCell(195,6,utf8_decode($prueba),'LRB',1,'L',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(31,6,utf8_decode('FECHA EMISIÓN:'),'TBL',0,'L',true);
	$pdf->SetFont('Times','',10);	
	$pdf->Cell(164,6,date('d-m-Y'),'RTB',1,'L',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(66,6,'AUTORIZADO POR',1,0,'L',true);
	$pdf->Cell(65,6,'RETIRADO POR',1,0,'L',true);
	$pdf->Cell(64,6,'REGISTRADO POR',1,1,'L',true);
	$pdf->SetFont('Times','',10);	
	$pdf->Cell(66,6,'Firma y Sello','LRT',0,'L',true);
	$pdf->Cell(65,6,'Firma','LRT',0,'L',true);
	$pdf->Cell(64,6,'Firma y Sello','LRT',1,'L',true);
	$pdf->Cell(66,6,'','LR',0,'L',true);
	$pdf->Cell(65,6,'','LR',0,'L',true);
	$pdf->Cell(64,6,'','LR',1,'L',true);
	$pdf->Cell(66,6,'','LR',0,'L',true);
	$pdf->Cell(65,6,'','LR',0,'L',true);
	$pdf->Cell(64,6,'','LR',1,'L',true);
	$pdf->Cell(66,6,'','LRB',0,'L',true);
	$pdf->Cell(65,6,'','LRB',0,'L',true);
	$pdf->Cell(64,6,'','LRB',1,'L',true);	
	$pdf->SetFont('Times','B',8);	
	$pdf->Cell(188,6,'','T',1,'L',true);
	$pdf->Cell(188,6,'FACTURAR A NOMBRE DE LA EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A',0,1,'L',true);
	$pdf->Output();
	$pdf->Output();
	}
	}
	if(isset($_GET['id'])){
	$sMedicina->setidSolicitud($_GET['id']);
	$consulta = $sMedicina->cabecera_SM();			
	$pdf->Cell(43,6,' ',0,0,'C',true);
	$pdf->Cell(50,6,' ',0,0,'C',true);
	$pdf->Cell(50,6,' ',0,0,'C',true);	
	$pdf->Cell(45,6,'COD DE LA HOJA '.'ID:'.$idBene,1,1,'C',true);
	if ($consulta){
		$consulta = $sMedicina->sig_tupla($consulta);	
	
	$pdf->SetFont('Times','B',11);	
	$pdf->Cell(152,6,'',0,0,'C',true);
	$pdf->Cell(45,6,' ','T',1,'C',true);
	$pdf->Cell(195,6,utf8_decode($consulta["descripcion"]),0,1,'C',true);
	$pdf->SetFont('Times','',8);	
				$pdf->Cell(188,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->Cell(188,6,'',0,1,'C',true);
	$pdf->Cell(195,6,'',0,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(22,6,utf8_decode('FARMACIA: '),0,0,'L',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(173,6,utf8_decode($consulta["alias"]),0,1,'L',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(25,6,utf8_decode('DIRECCIÓN: '),0,0,'L',true);	
	$pdf->SetFont('Times','',10);
	$pdf->Cell(170,6,utf8_decode($consulta["direccion"]),0,1,'L',true);		
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(160,6,'NOMBRE(S) Y APELLIDO(S) DEL TITULAR',1,0,'C',true);
	$pdf->Cell(35,6,'CED. IDENTIDAD',1,1,'C',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(160,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].' '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(124,6,'NOMBRE(S) Y APELLIDO(S) DEL BENEFICIARIO ',1,0,'C',true);
	$pdf->Cell(36,6,'CED. IDENTIDAD',1,0,'C',true);
	$pdf->Cell(35,6,'PARENTESCO',1,1,'C',true);
		$pdf->SetFont('Times','',10);
	if($consulta["id_beneficiario"]=='0'){
		$pdf->Cell(124,6,utf8_decode($consulta["nombre1"]).' '.$consulta["nombre2"].', '.$consulta["apellido1"].' '.$consulta["apellido2"],1,0,'C',true);
	$pdf->Cell(36,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,'Titular',1,1,'C',true);
	}else{
		$sMedicina->setidBeneficiario($consulta["id_beneficiario"]);
		$consulta_B=$sMedicina->consultar_beneficiario();
		$consulta_B=$sMedicina->sig_tupla($consulta_B);	
	$pdf->Cell(124,6,utf8_decode($consulta_B["nombre1"]).' '.utf8_decode($consulta_B["nombre2"]).' '.utf8_decode($consulta_B["apellido1"]).' '.utf8_decode($consulta_B["apellido2"]),1,0,'C',true);
	$pdf->Cell(36,6,$consulta_B["nacionalidad"].'-'.$consulta_B["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,$consulta_B["parentesco"],1,1,'C',true);		
	}
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(90,6,'PERTENECE A LA UNIDAD O PLANTA	',1,0,'C',true);
	$pdf->Cell(70,6,'AUTORIZADO A RETIRAR',1,0,'C',true);
	$pdf->Cell(35,6,'CED. IDENTIDAD',1,1,'C',true);
	$pdf->SetFont('Times','',10);	
	$pdf->Cell(90,6,$consulta["upsa"],1,0,'C',true);
	$pdf->Cell(70,6,$consulta["autorizado"],1,0,'C',true);
	if($consulta["ced_autorizado"]==0){ $ced_auto="";}else{ $ced_auto==$consulta["ced_autorizado"];}
	$pdf->Cell(35,6,$ced_auto,1,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(195,6,'PARA USO DEL SISTEMA AUTOGESTIONADO DE SALUD',1,1,'C',true);
	$pdf->Cell(165,6,'MEDICAMENTOS',1,0,'C',true);
	//$pdf->Cell(73,6,'DENOMINACION',1,0,'C',true);
	$pdf->Cell(30,6,'CANTIDAD',1,1,'C',true);
	$pdf->SetFont('Times','',10);	
	$sMedicina->setidSolicitud($consulta['id_solicitud']);
	$consulta_detalle=$sMedicina->detalle_SM();
	for($i=0;$i<count($consulta_detalle);$i++){		
	$pdf->Cell(165,6,$consulta_detalle[$i]['1'],1,0,'C',true);
	/*$pdf->Cell(73,6,''$consulta_detalle['denominacion'],1,0,'C',true);*/
	$pdf->Cell(30,6,$consulta_detalle[$i]['2'],1,1,'C',true);
	}
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(195,6,'OBSERVACIONES: ','LTR',1,'l',true);
	$pdf->SetFont('Times','',10);	
		$pdf->Cell(195,6,$consulta['observacion'],'LRB',1,'L',true);
	$consul=$sMedicina->buscar_reacudos_solicitud();	
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(195,6,utf8_decode('VERIFICAR RÉCIPE(S) E INDICACIONES (ANEXO(S)):'),'LRT',1,'L',true);
	$pdf->SetFont('Times','',10);	
	$prueba = array();
		for($i=0;$i<count($consul);$i++)			
			{		
				if($i==0){	
				$prueba=$consul[$i]['2'];
				}else{
					$prueba=$prueba.', '.$consul[$i]['2'];
				}
			}
		$pdf->multiCell(195,6,utf8_decode($prueba),'LRB',1,'L',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(31,6,utf8_decode('FECHA EMISIÓN:'),'TBL',0,'L',true);
	$pdf->SetFont('Times','',10);	
	$pdf->Cell(164,6,date('d-m-Y'),'RTB',1,'L',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(66,6,'AUTORIZADO POR',1,0,'L',true);
	$pdf->Cell(65,6,'RETIRADO POR',1,0,'L',true);
	$pdf->Cell(64,6,'REGISTRADO POR',1,1,'L',true);
	$pdf->SetFont('Times','',10);	
	$pdf->Cell(66,6,'Firma y Sello','LRT',0,'L',true);
	$pdf->Cell(65,6,'Firma','LRT',0,'L',true);
	$pdf->Cell(64,6,'Firma y Sello','LRT',1,'L',true);
	$pdf->Cell(66,6,'','LR',0,'L',true);
	$pdf->Cell(65,6,'','LR',0,'L',true);
	$pdf->Cell(64,6,'','LR',1,'L',true);
	$pdf->Cell(66,6,'','LR',0,'L',true);
	$pdf->Cell(65,6,'','LR',0,'L',true);
	$pdf->Cell(64,6,'','LR',1,'L',true);
	$pdf->Cell(66,6,'','LRB',0,'L',true);
	$pdf->Cell(65,6,'','LRB',0,'L',true);
	$pdf->Cell(64,6,'','LRB',1,'L',true);	
	$pdf->SetFont('Times','B',8);	
	$pdf->Cell(188,6,'','T',1,'L',true);
	$pdf->Cell(188,6,'FACTURAR A NOMBRE DE LA EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A',0,1,'L',true);
	$pdf->Output();
	}
	}	
?>
