<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_afiliacion_PDF.php");
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_beneficiario.php");
	include_once("../Clases/clase_ciudad.php");
	include_once("../Clases/clase_upsa.php");
	$titular= new titular();	
	$beneficiario= new beneficiario();	
	$ciudad= new ciudad();
	$upsa= new upsa();
// Se envia el valor del tipo de articulo.
	$id=$_GET["id"];
	$titular->setidTitular($id);
	$resultado=$titular->buscar_id();
	if($resultado!='-1'){
	$pdf=new PDF('P','mm','A4');
	$d= "DÍA";
	$dia = utf8_decode($d);
	$a= "AÑO";	
	$año = utf8_decode($a);
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
  	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(6,6,6,6);
	$Fecha=date("d/m/Y");
  	 	$elDia=substr($Fecha,0,2);
  	 	$elMes=substr($Fecha,3,2);
  	 	$elYear=substr($Fecha,6,4);

	$pdf->Cell(150);
	$pdf->Cell(45,6,'FECHA',1,1,'C',true);
	$pdf->Cell(154);
	$pdf->Cell(15,6,$dia,1,0,'C',true);
	$pdf->Cell(15,6,'MES',1,0,'C',true);
	$pdf->Cell(15,6,$año,1,1,'C',true);
	   	for($i=0;$i<count($resultado);$i++){
			
		if($resultado[$i][2]=='V'){
			$nacionalidad ='VENEZOLANO';
		}else{
			$nacionalidad ='EXTRANJERO';
		}
		$cedula 		=$resultado[$i][3];
		$nombre1 		=utf8_decode($resultado[$i][4]);
		$nombre2 		=utf8_decode($resultado[$i][5]);
		$apellido1 		=utf8_decode($resultado[$i][6]);
		$apellido2 		=utf8_decode($resultado[$i][7]);
		if($resultado[$i][8]=='M'){
			$sexo ='MASCULINO';
		}else{
			$sexo ='FEMENINO';
		}
		$fecha_nac 		=$resultado[$i][9];
		if($resultado[$i][10]=='S'){
			$estado_civ ='SOLTERO';
		}else{
			if($resultado[$i][10]=='C'){
				$estado_civ ='CASADO';
			}else{
				if($resultado[$i][10]=='D'){
					$estado_civ ='DIVORCIADO';
				}else{
					if($resultado[$i][10]=='V'){
						$estado_civ ='VIUDO';
					}
					
				}
			}			
		}
		$celular 		=$resultado[$i][11];
		$telefono 		=$resultado[$i][12];
		$correo_elect 	=$resultado[$i][13];
		$fecha_ingr 	=$resultado[$i][14];
		$direccion_hab 	=$resultado[$i][15];
		$id_cargo 		=$resultado[$i][16];
		$id_ciudad 		=$resultado[$i][17];
		$id_departamento=$resultado[$i][18];
		$id_upsa 		=$resultado[$i][19];
		$CiudadNac		=$resultado[$i][22];
		$correo_corp 	=$resultado[$i][23];
		}
	$ciudad->setidCiudad($CiudadNac);
	$consulta=$ciudad->buscar_c_e_p();
	for($i=0;$i<count($consulta);$i++){
		$nombCiudad= $consulta[$i][1];
		$nombEstado= $consulta[$i][2];
		$nombPais= $consulta[$i][3];

	}
	$pdf->Cell(45,6,'DATOS DEL TITULAR',1,0,'C',true);
	$pdf->Cell(109,6,'','L',0,'C',true);
	$pdf->Cell(15,6,$elDia,1,0,'C',true);
	$pdf->Cell(15,6,$elMes,1,0,'C',true);
	$pdf->Cell(15,6,$elYear,1,1,'C',true);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(90,6,'APELLIDO(S) Y NOMBRE(S)',1,0,'C',true);
	$pdf->Cell(32,6,'NACIONALIDAD',1,0,'C',true);
	$pdf->Cell(47,6,utf8_decode('CÉDULA DE IDENTIDAD'),1,0,'C',true);
	$pdf->Cell(30,6,'SEXO',1,1,'C',true);	
	$pdf->SetFont('Times','',10);
	$pdf->Cell(90,6,$nombre1.' '.$nombre2.' '.$apellido1.' '.$apellido2,1,0,'C',true);
	$pdf->Cell(32,6,$nacionalidad,1,0,'C',true);
	$pdf->Cell(47,6,$cedula,1,0,'C',true);
	$pdf->Cell(30,6,$sexo,1,1,'C',true);	
	$pdf->Ln(3);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(40,6,'FECHA DE NAC.',1,0,'C',true);
	$pdf->Cell(20,6,'EDAD',1,0,'C',true);
	$pdf->Cell(30,6,'CIUDAD',1,0,'C',true);
	$pdf->Cell(30,6,'ESTADO',1,0,'C',true);
	$pdf->Cell(30,6,'EDO. CIVIL',1,0,'C',true);	
	$pdf->Cell(49,6,utf8_decode('TELÉFONOS'),1,1,'C',true);	
	$pdf->SetFont('Times','',10);
	if (strlen($fecha_nac)==10)
	{
  	 	$elDia=substr($fecha_nac,8,2);
		$elMes=substr($fecha_nac,5,2);
		$elYear=substr($fecha_nac,0,4);
		$FechaNac=$elDia."-".$elMes."-".$elYear;		
	}
	$titular->setFec_nac($fecha_nac);
	$edad=$titular->edad();	
	$pdf->Cell(40,6,$FechaNac,1,0,'C',true);
	$pdf->Cell(20,6,$edad,1,0,'C',true);
	$pdf->Cell(30,6,$nombCiudad,1,0,'C',true);
	$pdf->Cell(30,6,$nombEstado,1,0,'C',true);
	$pdf->Cell(30,6,$estado_civ,1,0,'C',true);
	$pdf->Cell(49,6,$telefono.' / '.$celular,1,1,'C',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(199,6,utf8_decode("DIRECCIÓN DE HABITACIÓN"),1,1,'C',true);	
	$pdf->SetFont('Times','',9);
	$pdf->Cell(199,6,$direccion_hab,1,1,'L',true);
	$ciudad->setidCiudad($id_ciudad);
	$consulta=$ciudad->buscar_c_e_p();
	for($i=0;$i<count($consulta);$i++){
		$nombCiudad= utf8_decode($consulta[$i][1]);
		$nombEstado= utf8_decode($consulta[$i][2]);
		$nombPais= $consulta[$i][3];
	}
	$pdf->Cell(32,6,'Pais: '.$nombPais,1,0,'L',true);	
	$pdf->Cell(42,6,'Estado: '.$nombEstado,1,0,'L',true);
	$pdf->Cell(44,6,'Ciudad: '.$nombCiudad,1,0,'L',true);
	$pdf->Cell(81,6,'E-mail: '.$correo_elect,1,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',9);
	$upsa->setidUpsa($id_upsa);
	$consulta=$upsa->Buscar_upsa();
	for($i=0;$i<count($consulta);$i++){
		$nombre			=$consulta[$i][1];
		$direccion		=utf8_decode($consulta[$i][2]);
		$ciudad_upsa	=utf8_decode($consulta[$i][3]);
		$estado_upsa	=utf8_decode($consulta[$i][4]);
		$pais_upsa		=$consulta[$i][5];

	}	
	$pdf->Cell(199,6,utf8_decode('DIRECCIÓN DE TRABAJO'),1,1,'C',true);	
	$pdf->SetFont('Times','',10);
	$pdf->Cell(35,6,'Upsa: '.$nombre,1,0,'L',true);
	$pdf->Cell(114,6,utf8_decode('Dirección: ').$direccion,1,0,'L',true);
	$pdf->Cell(50,6,'Ciudad: '.$ciudad_upsa,1,1,'L',true);
	$pdf->Cell(50,6,'Estado: '.$estado_upsa,1,0,'L',true);
	$pdf->Cell(40,6,'Pais: '.$pais_upsa,1,0,'L',true);	
	$pdf->Cell(109,6,'E-mail: '.$correo_corp,1,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(199,6,'BENEFICIARIOS',1,1,'C',true);	
	$pdf->Cell(80,6,'APELLIDOS Y NOMBRES',1,0,'C',true);
	$pdf->Cell(22,6,'C.I.',1,0,'C',true);
	$pdf->Cell(23,6,'FECHA NAC.',1,0,'C',true);
	$pdf->Cell(11,6,'EDAD',1,0,'C',true);
	$pdf->Cell(22,6,'SEXO',1,0,'C',true);
	$pdf->Cell(25,6,'PARENTESCO',1,0,'C',true);
	$pdf->Cell(16,6,'PARTIC.',1,1,'C',true);
	$pdf->SetFont('Times','',10);
	$beneficiario->setidTitular($id);
	$cons=$beneficiario->buscar_Beneficiario();
	if($cons==0){
	$pdf->Cell(199,6,'NO SE ASIGNARON BENEFICIAROS POR ESTE TITULAR ',1,1,'C',true);	
	}else{
		
	for ($i=0;$i<count($cons);$i++){		
		if($cons[$i][9]=='M'){
			$sex='MASCULINO';
		}else{
			$sex='FEMENINO';
		}
		if($cons[$i][4]!='0'){
			$ced=$cons[$i][3].'-'.$cons[$i][4];
		}else{
			$ced='N/A';
		}
	$titular->setFec_nac($cons[$i][10]);
	$edad=$titular->edad();	
$pdf->Cell(80,6,utf8_decode($cons[$i][5]).' '.utf8_decode($cons[$i][6]).' '.utf8_decode($cons[$i][7]).' '.utf8_decode($cons[$i][8]),1,0,'C',true);
		$elDia=substr($cons[$i][10],8,2);
		$elMes=substr($cons[$i][10],5,2);
		$elYear=substr($cons[$i][10],0,4);
	$fb=$elDia.'-'.$elMes.'-'.$elYear;
		$pdf->Cell(22,6,$ced,1,0,'C',true);
		$pdf->Cell(23,6,$fb,1,0,'C',true);
		$pdf->Cell(11,6,$edad,1,0,'C',true);
		$pdf->Cell(22,6,$sex,1,0,'C',true);
		$pdf->Cell(25,6,$cons[$i][13],1,0,'C',true);
		$pdf->Cell(16,6,$cons[$i][14],1,1,'C',true);
	}
	}
	$pdf->SetFont('Times','B',10);
	$pdf->Ln(3);
	$pdf->Cell(99,6,'TITULAR',0,0,'L',true);
	$pdf->Cell(100,6,'REGISTRADO POR: nombre de la persona logeada en el sistema.',0,1,'L',true);
	$pdf->Cell(99,6,'FIRMA Y HUELLA',0,0,'L',true);
	$pdf->Cell(100,6,'FIRMA Y SELLO',0,1,'L',true);	
	$pdf->Cell(99,6,' ','0',0,'L',true);
	$pdf->Cell(100,6,' ','0',1,'L',true);
// Se envia el PDF.
		$pdf->Output();
	}else{
		echo 'Ha ocurrido un error generando el PDF.';
	}
// Fin del Controlador que el General PDF de la consulta de articulos		
?>
