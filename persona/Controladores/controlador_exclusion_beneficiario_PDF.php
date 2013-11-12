<?php
// Llamado a la clase a usarse.
	include_once("../Clases/clase_exclusion_PDF.php");
	include_once("../Clases/clase_titular.php");
	include_once("../Clases/clase_departamento.php");
	include_once("../Clases/clase_cargo.php");
	include_once("../Clases/clase_detalle_profesion.php");
	include_once("../Clases/clase_beneficiario.php");
	include_once("../Clases/clase_ciudad.php");
	include_once("../Clases/clase_upsa.php");
	$titular= new titular();	
	$beneficiario= new beneficiario();	
	$ciudad= new ciudad();
	$upsa= new upsa();
	$departamento= new departamento();
	$detalle_pro= new detalle_pro();
	$cargo= new cargo();
	$id2=$_GET["id2"];
	$id=$_GET["id"];
	$titular->setidTitular($id2);
	$resultado=$titular->buscar_id();
	if($resultado!='-1'){
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Ln(4);  	
	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(255);
    $pdf->SetTextColor(000);
	$pdf->SetMargins(6,6,6,6);
	
	$Fecha=date("d/m/Y");
	if (strlen($Fecha)==10){
  	 	$elDia=substr($Fecha,0,2);
  	 	$elMes=substr($Fecha,3,2);
  	 	$elYear=substr($Fecha,6,4);
	}
	$pdf->Cell(150);
	$pdf->Cell(45,6,'FECHA',1,1,'C',true);
	$pdf->Cell(154);
	$pdf->Cell(15,6,utf8_decode('DÍA'),1,0,'C',true);
	$pdf->Cell(15,6,'MES',1,0,'C',true);
	$pdf->Cell(15,6,utf8_decode('AÑO'),1,1,'C',true);
	   	for($i=0;$i<count($resultado);$i++){
			if($resultado[$i][2]=='V'){
				$nacionalidad ='Venezolano';
			}else{
				$nacionalidad ='Extranjero';
			}

		$cedula 		=$resultado[$i][3];
		$nombre1 		=utf8_decode($resultado[$i][4]);
		$nombre2 		=utf8_decode($resultado[$i][5]);
		$apellido1 		=utf8_decode($resultado[$i][6]);
		$apellido2 		=utf8_decode($resultado[$i][7]);
		$estado_civ =$resultado[$i][10];
		$sexo=$resultado[$i][8];
		$fecha_nac 		=$resultado[$i][9];
		
			
		$celular 		=$resultado[$i][11];
		$telefono 		=$resultado[$i][12];
		$correo_elect 	=$resultado[$i][13];
		$fecha_ingr 	=$resultado[$i][14];
		$direccion_hab 	=utf8_decode($resultado[$i][15]);
		$id_cargo 		=$resultado[$i][16];
		$id_ciudad 		=$resultado[$i][17];
		$id_departamento=$resultado[$i][18];
		$id_upsa 		=$resultado[$i][19];
		$CiudadNac		=$resultado[$i][22];
		$correo_corp	=$resultado[$i][23];
		$profesion	=	utf8_decode($resultado[$i][26]);
		}
	$ciudad->setidCiudad($CiudadNac);
	$consulta=$ciudad->buscar_c_e_p();
	for($i=0;$i<count($consulta);$i++){
		$nombCiudad= $consulta[$i][1];
		$nombEstado= $consulta[$i][2];
		$nombPais= $consulta[$i][3];

	}
	$pdf->Cell(45,6,'DATOS DEL TITULAR',1,0,'C',true);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(109,6,'','L',0,'C',true);
	$pdf->Cell(15,6,$elDia,1,0,'C',true);
	$pdf->Cell(15,6,$elMes,1,0,'C',true);
	$pdf->Cell(15,6,$elYear,1,1,'C',true);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(90,6,'APELLIDO(S) Y NOMBRE(S)',1,0,'C',true);
	$pdf->Cell(32,6,'NACIONALIDAD',1,0,'C',true);
	$pdf->Cell(47,6,utf8_decode('CÉDULA DE IDENTIDAD'),1,0,'C',true);
	$pdf->Cell(30,6,'SEXO',1,1,'C',true);	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(90,6,$nombre1.' '.$nombre2.' '.$apellido1.' '.$apellido2,1,0,'C',true);
	$pdf->Cell(32,6,$nacionalidad,1,0,'C',true);
	$pdf->Cell(47,6,$cedula,1,0,'C',true);
	$pdf->Cell(30,6,$sexo,1,1,'C',true);	//sexo
	$pdf->Ln(3);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(40,6,'FECHA DE NAC.',1,0,'C',true);
	$pdf->Cell(20,6,'EDAD',1,0,'C',true);
	$pdf->Cell(30,6,'CIUDAD',1,0,'C',true);
	$pdf->Cell(30,6,'ESTADO',1,0,'C',true);
	$pdf->Cell(30,6,'EDO. CIVIL',1,0,'C',true);
	$pdf->Cell(49,6,utf8_decode('TELÉFONOS'),1,1,'C',true);	
	$pdf->SetFont('Times','',10);
	if (strlen($fecha_nac)==10){
  	 	$elDia=substr($fecha_nac,8,2);
		$elMes=substr($fecha_nac,5,2);
		$elYear=substr($fecha_nac,0,4);
		$FechaNac=$elDia."-".$elMes."-".$elYear;		
	}
	if (strlen($fecha_ingr)==10){
  	 	$elDia=substr($fecha_ingr,8,2);
		$elMes=substr($fecha_ingr,5,2);
		$elYear=substr($fecha_ingr,0,4);
		$fecha_Ingr=$elDia."-".$elMes."-".$elYear;		
	}
	$titular->setFec_nac($fecha_nac);
	$edad=$titular->edad();	
	$pdf->Cell(40,6,$FechaNac,1,0,'C',true);
	$pdf->Cell(20,6,$edad,1,0,'C',true);
	$pdf->Cell(30,6,$nombCiudad,1,0,'C',true);
	$pdf->Cell(30,6,$nombEstado,1,0,'C',true);
	$pdf->Cell(30,6,$estado_civ,1,0,'C',true);//estado civil
	$pdf->Cell(49,6,$telefono.' / '.$celular,1,1,'C',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(199,6,utf8_decode("DIRECCIÓN DE HABITACIÓN"),1,1,'C',true);	
	$pdf->SetFont('Times','',9);
	$pdf->Cell(199,6,$direccion_hab,1,1,'L',true);
	$ciudad->setidCiudad($id_ciudad);
	$consulta=$ciudad->buscar_c_e_p();
	for($i=0;$i<count($consulta);$i++){
		$nombCiudad= $consulta[$i][1];
		$nombEstado= $consulta[$i][2];
		$nombPais= $consulta[$i][3];
	}
	$pdf->Cell(32,6,'Pais: '.$nombPais,1,0,'L',true);	
	$pdf->Cell(42,6,'Estado: '.$nombEstado,1,0,'L',true);
	$pdf->Cell(47,6,'Ciudad: '.$nombCiudad,1,0,'L',true);
	$pdf->Cell(78,6,'E-mail: '.$correo_elect,1,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);
	$upsa->setidUpsa($id_upsa);
	$consulta=$upsa->Buscar_upsa();
	for($i=0;$i<count($consulta);$i++){
		$upsa			=$consulta[$i][1];
		$direccion		=$consulta[$i][2];
		$ciudad_upsa	=$consulta[$i][3];
		$estado_upsa	=$consulta[$i][4];
		$pais_upsa		=$consulta[$i][5];
	}
	$departamento->setidDepartamento($id_departamento);
	$consulta=$departamento->buscar();
	for($i=0;$i<count($consulta);$i++){
		$departamento			=$consulta[$i][2];
	}
	$cargo->setidCargo($id_cargo);
	$consulta=$cargo->buscar_cargo();
	for($i=0;$i<count($consulta);$i++){
		$nomCargo			=$consulta[$i][2];
	}
	$pdf->Cell(199,6,utf8_decode("DIRECCIÓN DE TRABAJO"),1,1,'C',true);	
	$pdf->SetFont('Times','',9);
	$pdf->Cell(199,6,$direccion,1,1,'L',true);
	$pdf->Cell(40,6,'Pais: '.$pais_upsa,1,0,'L',true);	
	$pdf->Cell(45,6,'Estado: '.$estado_upsa,1,0,'L',true);
	$pdf->Cell(50,6,'Ciudad: '.$ciudad_upsa,1,0,'L',true);
	$pdf->Cell(64,6,utf8_decode("Profesión: ").$profesion,1,1,'L',true);
	$pdf->Cell(77,6,'Departamento: '.utf8_decode($departamento),1,0,'L',true);
	$pdf->Cell(58,6,'UPSA: '.utf8_decode($upsa),1,0,'L',true);
	$pdf->Cell(64,6,'Fecha de Ingreso: '.$fecha_Ingr,1,1,'L',true);
	$pdf->Cell(135,6,'E-mail: '.$correo_corp,1,0,'L',true);
	$pdf->Cell(64,6,'Cargo: '.utf8_decode($nomCargo),1,1,'L',true);
	$pdf->Ln(5);
	$pdf->Cell(199,6,utf8_decode("EXCLUSIÓN DE BENEFICIARIO"),1,1,'C',true);	
	$pdf->SetFont('Times','B',10);	
	$pdf->Cell(199,6,'BENEFICIARIO',1,1,'C',true);	
	$pdf->Cell(80,6,'APELLIDO(S) Y NOMBRE(S)',1,0,'C',true);
	$pdf->Cell(27,6,'C.I.',1,0,'C',true);
	$pdf->Cell(28,6,'FECHA NAC.',1,0,'C',true);
	$pdf->Cell(18,6,'EDAD',1,0,'C',true);
	$pdf->Cell(18,6,'SEXO',1,0,'C',true);
	$pdf->Cell(28,6,'PARENTESCO',1,1,'C',true);
	$pdf->SetFont('Times','',10);
	$beneficiario->setidBeneficiario($id);
	$cons=$beneficiario->excluir_Beneficiario();
	for ($i=0;$i<count($cons);$i++){		
	$titular->setFec_nac($cons[$i][10]);
	$edad=$titular->edad();	
$pdf->Cell(80,6,utf8_decode($cons[$i][5]).' '.utf8_decode($cons[$i][6]).' '.utf8_decode($cons[$i][7]).' '.utf8_decode($cons[$i][8]),1,0,'C',true);
		$pdf->Cell(27,6,$ced=$cons[$i][3].'-'.$cons[$i][4],1,0,'C',true);
		$pdf->Cell(28,6,$cons[$i][10],1,0,'C',true);
		$pdf->Cell(18,6,$edad,1,0,'C',true);
		$pdf->Cell(18,6,$cons[$i][9],1,0,'C',true);
		$pdf->Cell(28,6,$cons[$i][13],1,1,'C',true);
	}
	$pdf->Ln(5);
	$pdf->SetFont('Times','',10);
	if($nacionalidad='Venezolano'){
		$nac='V';
	}else{
		$nac='E';
	}
	$pdf->Cell(199,5,'Yo: '.$nombre1.' '.$nombre2.' '.$apellido1.' '.$apellido2.' portador de la C.I.: '.$nac.'-'.$cedula.' '.utf8_decode("por medio de la siguiente declaro ante Autogestión"),0,1,'C');
	$pdf->Cell(199,5,utf8_decode(" de Salud de la Empresa Mixta Arroz del ALBA S.A. La exclusión del beneficiario arriba señalado y anexo recaudos"),0,1,'C');
	$pdf->SetFont('Times','B',10);
	$pdf->Ln(5);
	$pdf->Cell(199,6,'FIRMA: ______________________________',0,1,'C',true);
	$pdf->Ln(2);
	$pdf->Cell(70,6,'','',0,'C',true);
	$pdf->Cell(58,6,'HUELLA: ','LRT',0,'l',true);
	$pdf->Cell(58,6,'','',1,'C',true);
	$pdf->Cell(70,6,'','',0,'C	',true);
	$pdf->Cell(58,6,'','RL',0,'l',true);
	$pdf->Cell(58,6,'','',1,'C',true);
	$pdf->Cell(70,6,'','',0,'C',true);
	$pdf->Cell(58,6,'','RLB',0,'l',true);
	$pdf->Cell(58,6,'','',1,'C',true);
	$pdf->Cell(70,6,'','',0,'C',true);
	$pdf->Cell(58,6,'','RLB',0,'l',true);
	$pdf->Cell(58,6,'','',1,'C',true);
	$pdf->Cell(70,6,'','',0,'C',true);
	$pdf->Cell(58,6,'','RL',0,'l',true);
	$pdf->Cell(58,6,'','',1,'C',true);
	$pdf->Cell(70,6,'','',0,'C',true);
	$pdf->Cell(58,6,'','RLB',0,'l',true);
	$pdf->Cell(58,6,'','',1,'C',true);

// Se envia el PDF.
		$pdf->Output();
	}else{
		echo 'Ha ocurrido un error generando el PDF.';
	}
// Fin del Controlador que el General PDF de la consulta de articulos
?>
