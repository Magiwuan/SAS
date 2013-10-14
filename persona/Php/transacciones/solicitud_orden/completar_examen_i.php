<?php
include_once('../../../Clases/clase_examen.php');
$examen= new examen();
$q = strtolower($_GET["term"]);
if (!$q) return;
$limpio = trim($q); //le asignamos a cadena $Q sin espacios
$examen->setDescripcion($limpio);
$consulta=$examen->bExamen_i();
$arreglo=array();
//Nota: Array_push hace que cada elemento encontrado 
for($i=0;$i<count($consulta);$i++)	
	{
		$arreglo[$i]=$consulta[$i][2];
	}
//pasamos el array a formato JSON y lo imprimimos
echo json_encode($arreglo);
?>