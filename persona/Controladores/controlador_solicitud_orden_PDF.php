<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_solicitud_medicina_PDF.php");
	include_once("../Clases/clase_solicitud_orden.php");
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_recaudo.php");
	$recaudo= new recaudos();
	$titular= new titular();
	$sOrden= new sOrden();
	$pdf=new PDF('P','mm','letter');
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
  	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(10,10,10,10);

	$titular->setCed($_GET['cd']);
			$buscarTitular=$titular->validar_titular();
		if($buscarTitular){
			$resl=$titular->sig_tupla($buscarTitular);
			$idTitular=$resl['id_titular'];
		}
	$sOrden->setidTitular($idTitular);
	$consulta = $sOrden->cabecera_SM();			
				$pdf->Cell(50,6,' ',0,0,'C',true);
				$pdf->Cell(50,6,' ',0,0,'C',true);
				$pdf->Cell(50,6,' ',0,0,'C',true);		
				if ($consulta){
					$consulta = $sOrden->sig_tupla($consulta);	
				$pdf->Cell(45,6,$consulta["cod_hoja"],1,1,'C',true);	
	
	$pdf->SetFont('Times','B',11);	
	$pdf->Cell(150,6,'',0,0,'C',true);
	$pdf->Cell(45,6,' ','T',1,'C',true);
	$pdf->Cell(195,6,utf8_decode($consulta["descripcion"]),0,1,'C',true);
	$pdf->SetFont('Times','',8);	
				$pdf->Cell(195,6,'Sistema Autogestionado de Salud',0,1,'C',true);
				$pdf->Cell(195,6,'',0,1,'C',true);
$pdf->Cell(195,6,'',0,1,'C',true);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(26,6,utf8_decode('PROVEEDOR: '),0,0,'L',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(169,6,utf8_decode($consulta["alias"]),0,1,'L',true);
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
	$pdf->Cell(36,6,$consulta["nacionalidad"].'-'.$consulta["cedula"],1,0,'C',true);
	$pdf->Cell(35,6,'Titular',1,1,'C',true);

	}else{
		$sOrden->setidBeneficiario($consulta["id_beneficiario"]);
		$consulta_B=$sOrden->consultar_beneficiario();
		$consulta_B=$sOrden->sig_tupla($consulta_B);	
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
	$sOrden->setidSolicitud($consulta['id_solicitud']);
	$sOrden->settipoServicio($consulta["id_servicio"]);
		if($consulta["id_servicio"]=='5'){					
			$consulta_detalle=$sOrden->detalle_SM_1();
				$pdf->Cell(195,4,'','TB',1,'L',true);
				for($i=0;$i<count($consulta_detalle);$i++){		
						$cant=strlen($consulta_detalle[$i]['2']);
						$espacios = substr_count($consulta_detalle[$i]['2']," ");
						$numTotal=$cant+$espacios;
						if($numTotal>80){
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(22,6,utf8_decode('MOTIVO:'),1,0,'L',true);						
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(173,6,utf8_decode($consulta_detalle[$i]['2']),1,1,'L',true);	
						$pdf->Cell(22,1,'',0,1,'L',true);	
						}else{	
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(18,6,utf8_decode('MOTIVO:'),'TBL',0,'L',true);
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(177,6,utf8_decode($consulta_detalle[$i]['2']),'TBR',1,'L',true);	
						$pdf->Cell(195,4,'','T',1,'L',true);
						}
					
						$espacios = substr_count($consulta_detalle[$i]['3']," ");
						$numTotal=$cant+$espacios;
						if($numTotal>80){
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(28	,6,utf8_decode('DIAGNOSTICO:'),1,0,'L',true);						
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(167,6,utf8_decode($consulta_detalle[$i]['3']),1,1,'L',true);	
						$pdf->Cell(22,1,'',0,1,'L',true);	
						$pdf->Cell(195,4,'',0,1,'L',true);
						}else{	
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(28,6,utf8_decode('DIAGNOSTICO:'),'TBL',0,'L',true);
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(167,6,utf8_decode($consulta_detalle[$i]['3']),'TBR',1,'L',true);	
						$pdf->Cell(195,4,'','T',1,'L',true);
						}
					}
					
				}else{
					
				$consulta_detalle=$sOrden->detalle_SM_1();
				for($i=0;$i<count($consulta_detalle);$i++){		
						$cant=strlen($consulta_detalle[$i]['4']);
						$espacios = substr_count($consulta_detalle[$i]['4']," ");
						$numTotal=$cant+$espacios;
						if($numTotal>80){
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(22,6,utf8_decode('ÉXAMEN:'),1,0,'L',true);						
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(173,6,utf8_decode($consulta_detalle[$i]['4']),1,1,'L',true);	
						$pdf->Cell(22,1,'',0,1,'L',true);	
						}else{	
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(18,6,utf8_decode('ÉXAMEN:'),'TBL',0,'L',true);
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(177,6,utf8_decode($consulta_detalle[$i]['4']),'TBR',1,'L',true);	
						}
					$pdf->Cell(195,4,'',0,1,'L',true);
					$cant=strlen($consulta_detalle[$i]['1']);
						$espacios = substr_count($consulta_detalle[$i]['1']," ");
						$numTotal=$cant+$espacios;
					if($numTotal>80){
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(22,6,utf8_decode('DESCRIPCIÓN:'),1,0,'L',true);						
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(173,6,utf8_decode($consulta_detalle[$i]['1']),1,1,'L',true);	
						$pdf->Cell(22,1,'',0,1,'L',true);	
						}else{	
						$pdf->SetFont('Times','B',10);
						$pdf->Cell(28 ,6,utf8_decode('DESCRIPCIÓN:'),'TBL',0,'L',true);
						$pdf->SetFont('Times','',10);
						$pdf->multiCell(167,6,utf8_decode($consulta_detalle[$i]['1']),'TBR',1,'L',true);	
						}		
				}
			}
						$pdf->SetFont('Times','B',10);	
				$pdf->Cell(195,6,'OBSERVACIONES: ','LTR',1,'l',true);
					$pdf->SetFont('Times','',10);	
					$pdf->Cell(195,6,$consulta['observacion'],'LRB',1,'L',true);				
					
				$consul=$sOrden->buscar_reacudos_solicitud();			
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
		$pdf->Cell(31,6,utf8_decode('FECHA EMISIÓN:'),'TBL',0,'L',true);
		$pdf->SetFont('Times','',10);	
		$pdf->Cell(164,6,date('d-m-Y'),'RTB',1,'L',true);
		$pdf->SetFont('Times','B',10);	
				$pdf->Cell(71,6,utf8_decode('CENTRO MÉDICO / MÉDICO TRATANTE'),1,0,'L',true);
				$pdf->Cell(58,6,'FIRMA DEL PACIENTE',1,0,'L',true);
				$pdf->Cell(66,6,'REGISTRADO POR ',1,1,'L',true);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(71,6,'Firma y Sello','LRT',0,'L',true);
				$pdf->Cell(58,6,'Firma','LRT',0,'L',true);
				$pdf->Cell(66,6,'Firma y Sello','LRT',1,'L',true);		
				$pdf->Cell(71,6,'','LR',0,'L',true);
				$pdf->Cell(58,6,'','LR',0,'L',true);	
				$pdf->Cell(66,6,'','LR',1,'L',true);
				$pdf->Cell(71,6,'','LR',0,'L',true);
				$pdf->Cell(58,6,'','LR',0,'L',true);	
				$pdf->Cell(66,6,'','LR',1,'L',true);
				$pdf->Cell(71,6,'','LR',0,'L',true);
				$pdf->Cell(58,6,'','LR',0,'L',true);	
				$pdf->Cell(66,6,'','LR',1,'L',true);
				$pdf->Cell(71,6,'','LRB',0,'L',true);
				$pdf->Cell(58,6,'','LRB',0,'L',true);
				$pdf->Cell(66,6,'','LRB',1,'L',true);
				
				$pdf->SetFont('Times','B',8 );	
				$pdf->Cell(188,6,'','T',1,'L',true);
				$pdf->Cell(188,6,'FACTURAR A NOMBRE DE LA EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA S.A',0,1,'L',true);				
				//cierre del si $consulta
	$pdf->Output();
	}

	
