<?
	$bd_host = "localhost";
	$bd_usuario = "root";
	$bd_password = "iutep";
	$bd_base = "bdsas";
	$con = mysql_connect($bd_host, $bd_usuario, $bd_password) or die("Error en la conexión a MsSql");
	mysql_select_db($bd_base, $con);
?>