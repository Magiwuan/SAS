<?php
include_once("../Clases/clase_proveedor.php");
$proveedor= new proveedor();		
$proveedor->setidProveedor($_GET["select"]);
$result= $proveedor->CajaDireccion();
foreach ($result as $textarea) { echo $textarea; }
?>