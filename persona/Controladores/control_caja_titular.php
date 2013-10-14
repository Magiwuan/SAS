<?php
include_once("../Clases/clase_titular.php");
$titular= new titular();		
$titular->setCed($_GET["caja"]);
$validar=$titular->validar_titular();
if($validar!='-1'){
$result= $titular->CajaNombre();
foreach ($result as $text) { echo $text; }
}else{
$result= $titular->CajaNombre();
foreach ($result as $text) { echo $text; }
}
?>