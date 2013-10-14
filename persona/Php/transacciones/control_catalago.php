<?php
$nomb=$_POST['nomb'];
$ape=$_POST['ape'];
if(isset($nomb)){
header("Location: listado_empleado.php?id1=".$nomb);
}
if(isset($ape)){
header("Location: listado_empleado.php?id2=".$ape);
}
?>
 
 