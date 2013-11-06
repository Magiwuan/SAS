<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../../usuario/denied.php");
}
?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<table width="644" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="formulario">&nbsp;</td>
    <td class="formulario">Motivo de consulta:</td>
    <td colspan="2" class="formulario"><textarea name="motivo" id="motivo" cols="50" rows="2"></textarea></td>
    <td class="formulario">&nbsp;</td>
  </tr>
  <tr>
    <td class="formulario">&nbsp;</td>
    <td class="formulario">Diagnostico:</td>
    <td colspan="2" class="formulario"><textarea name="diagnostico" id="diagnostico" cols="50" rows="2"></textarea></td>
    <td class="formulario">&nbsp;</td>
  </tr>
</table>
</body>
</html>
