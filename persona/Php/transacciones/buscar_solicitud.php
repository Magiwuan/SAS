<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Solicitudes Pendientes:.</title>
	<link href="../../Css/estilo2.css" rel="stylesheet" type="text/css" />   
    <link href="../../Css/estilos.css" rel="stylesheet" type="text/css" />
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />		
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.8.2.min.js"></script>            
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/sMedicina_jquery.js"></script>  
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script> 
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 	
</head>
<body>
<div id='cuerpo'>
<form action="javascript: fn_consultar();" id="frm_buscar" name="frm_buscar" method="post">
<table width="250" height="45" class="formulario" cellpadding="0" cellspacing="0">
 <tbody>
  <tr>
   <th width="176">Codigo</th>
   <td width="96"><input name="buscar" type="text" id="buscar" size="14" /></td>
   <td width="80"><input type="submit" class="btn btn-primary" value="  Buscar  " /></td>
  </tr>
 </tbody>
</table>
</form>
</div>
<script>
<!--  Creamos una funcion consultar para Enviar un mensaje de Alerta cuando no encuentre datos !-->
function fn_consultar(){
	var str = $("#frm_buscar").serialize();
	$.ajax({
		url: '../../Controladores/control_verificar_filtro_b_solicitud.php',
		type: 'post',
		data: str,
		success: function(data){
			var enviar=$('#buscar').val();			
			if(data=='No'){
				jAlert("Código de solicitud no valido, favor verifique e intente de nuevo");
				$('#buscar').val('');	
			}else if(data=='1'){			
				$('#cuerpo').load('solicitud_paso3.php?id='+enviar);
			}else if(data=='2'){
				$('#cuerpo').load('solicitud_reembolso/aprobar_monto_reembolso.php?id='+enviar);
			}
		}
	});
}
</script>
</body>
</html>
