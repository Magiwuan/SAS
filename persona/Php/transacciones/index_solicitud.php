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
        <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
        <link rel="stylesheet" type="text/css" href="../../Css/jquery.asmselect.css" />
        <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />		
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.4.2.min.js"></script>            
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.js"></script>
       	<script language="javascript" src="../../JavaScript/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>    
        <script language="javascript" type="text/javascript" src="../../JavaScript/sMedicina_jquery.js"></script>  
        <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script> 
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>  
       <script language="javascript" type="text/javascript">
	    $(document).ready(function() {
  	$("#b5").click(function(event) {
		$("#buscar").val('');
		var miPopup 
		miPopup = window.open("buscar_trabajador.php","miwin","width=530px,height=300px,scrollbars=yes,resizable=yes") 
		miPopup.focus();
	});
   });
</script>
</head>
<body>
<div id="cuerpo">
   <form action="javascript: fn_consultar();" id="frm_buscar" name="frm_buscar" method="post">
  <table width="789" height="40" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <th width="29" height="38" align="right">&nbsp;</th>
        <th width="32" align="right"><div title="Buscar Trabajadores" id="b5" style="width:25px; cursor:pointer"><img src="../../Imagen_sistema/lupa.png" alt="Consultar" width="20" height="20" align="absmiddle"/></div></th>
        <th width="66">Cedula</th>
        <td width="88"><input name="buscar" type="text" id="buscar" size="14" /></td>
        <th width="84">Ordenar</th>
        <td width="135"><select name="ordenar_por" id="ordenar_por">
          <option value="0" seleted="seleted">Seleccionar</option>
          <option value="1">Apellido</option>
          <option value="2">Cedula</option>
          <option value="3">Apellido y Cedula</option>
        </select></td>
        <th width="42">Ver</th>
        <td width="58"><select name="paginas" id="paginas">
         <option value="2" >2</option>
          <option value="5" selected="selected">5</option>
          <option value="10" >10</option>
          <option value="15" >15</option> 
        </select></td>
        <td width="82"><input type="submit" value="  Buscar  " class="button"/></td>
        <td width="171"><input name="b4" type="button" id="b4" class="button" value=" Limpiar " /></td>
      </tr>
    </tbody>
  </table>
  <div id="div_listar"></div>

</form>
  <script>
  <!--  Creamos una funcion consultar para Enviar un mensaje de Alerta cuando no encuentre datos !-->
function fn_consultar(){
	var str = $("#frm_buscar").serialize();
	$.ajax({
		url: '../../Controladores/control_verificar_filtro_solicitud.php',
		type: 'post',
		data: str,
		success: function(data){
			if(data=='No'){
				jAlert("No se encontro resgistros, favor verifique e intente de nuevo");
				$('#buscar').val('');
				
			}else{
			fn_buscar();						
			}			
		}
	});
}
</script>
</div>
</body>
</html>
