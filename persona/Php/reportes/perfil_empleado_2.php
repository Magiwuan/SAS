<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
header("Location: ../usuario/denied.php");
}?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Reporte de Titulares:.</title>  
</head>
<body>
  <form action="javascript: fn_consultar();" id="frm_buscar" name="frm_buscar" method="post">
  <h1>Detalle de <?php echo $_POST["nomb"].' '.$_POST["ape"];?></h1>
  <table width="686" height="45" class="formulario">
   <tbody>
    <tr>
    <th width="63">Desde:</th>
    <td width="94"><input name="fecha1" type="text" id="fecha1" size="14" /></td>
    <td width="43"><button name="bt1" id="bt1"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
     <script type="text/javascript">
       Calendar.setup({
       inputField : "fecha1",
       dateFormat: "%d-%m-%Y",
       trigger: "bt1",
       onSelect   : function() { this.hide() },
       });
     </script>
   <th width="90">Hasta:</th>
   <td width="161"><input name="fecha2" type="text" id="fecha2" size="14" /></td>
   <td width="43"><button name="bt2" id="bt2" ><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
    <script type="text/javascript">
	 Calendar.setup({
	 inputField : "fecha2",
	 dateFormat: "%d-%m-%Y",
	 trigger: "bt2",
	 onSelect   : function() { this.hide() },
	 });
	</script>
  <th width="31">Ver</th>
  <td width="58"><select name="paginas" id="paginas" title="Listar por cantidad">
   <option value="5">5</option>
   <option value="10" selected="selected">10</option>
   <option value="15" >15</option>
   <option value="20">20</option>
   </select>
  </td>
  <td width="78"><input type="submit" value="  Buscar  " class="btn btn-primary " title="Buscar Titular"/></td>
  <td width="75"><input name="b4" type="button" id="b4" class="btn btn-primary " onclick="limpiar();" value=" Limpiar " title="Limpiar Campos" /></td> 
  </tr>
</tbody>
</table> 
</form>
<script language="javascript" type="text/javascript">
  function limpiar(){
	$('#ordenar_ape').val('');
	$('#ordenar_por').val('0');
	$('#buscar').val('');
	 fn_buscar();
  } 
// Creamos una funcion consultar para Enviar un mensaje de Alerta cuando no encuentre datos 
  function fn_consultar(){
	var str = $("#frm_buscar").serialize();
	$.ajax({
	 url: '../../Controladores/control_verificar_filtro_reporte.php',
	 type: 'get',
	 data: str,
	 success: function(data){
	  if(data=='No'){
		jAlert("BOOM!! No hay Resultados :(");
	  }else{
		fn_buscar();
	  }
	}
   });
  } 
</script>
</body>
</html>
