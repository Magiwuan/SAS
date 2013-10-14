<?php
include_once("../Clases/clase_upsa.php");
$upsa= new upsa();		
$upsa->setidUpsa($_GET["select"]);
$result= $upsa->CajaDireccion();
foreach ($result as $textarea) { echo $textarea; }
?>