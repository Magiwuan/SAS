<?php
//       Llama la Libreria de la carpeta FPDF 
include_once("fpdf/fpdf.php");

class PDF extends FPDF
{	
	private $tipo;

	function Header()
	{
		//Logo
		$this->Image('../Imagen_sistema/cintillo.jpg',6,6,199,25);
		//Título		
		$t=utf8_decode('PLANILLA EXCLUSIÓN DE BENEFICIARIO');
		$this->Ln(17);
		$this->SetFont('Times','B',12);
		$this->Cell(0,10,$t,0,1,'C');
		$this->SetFont('Times','B',8);
		$this->Cell(0,1,'Sistema Autogestionado de Salud',0,1,'C');
		$this->SetFont('Times','B',12);
		$this->Cell(0,10,'EMPRESA MIXTA SOCIALISTA ARROZ DEL ALBA, S.A.',0,1,'C');
		$this->Ln(0);		
	}
	function Footer()
	{
		$this->SetFont('Times','',12);
		$t=utf8_decode('Carretera nacional vía Turen, sector E, planta Arroz del Alba, S.A Piritu Estado Portuguesa');
		$v=utf8_decode('Teléfonos 0256-3361377 / 3361455 / 3361333 / 3362000 / 3361255 ');
		$this->SetY(-15);
		$this->SetFont('Times','I',9);
		$this->Cell(0,2,$t,0,1,'C',0);
		$this->SetFont('Times','BI',9);
		$this->Cell(0,4,$v,0,0,'C',0);
	}
}
?>