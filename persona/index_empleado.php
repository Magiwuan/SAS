<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: Php/usuario/denied.php");
}
unset($_SESSION['idTitular']);
unset($_SESSION['nombre1']);
unset($_SESSION['apellido1']);
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>.:Index TitulAR:.</title>          
    <link href="Css/estilo2.css" rel="stylesheet" type="text/css" />   
    <link href="Css/estilo.css" rel="stylesheet" type="text/css" />
    <link href="Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
    <link rel="stylesheet" type="text/css" href="Css/jquery.asmselect.css" />
    <link href="JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />		
    <script language="javascript" type="text/javascript" src="JavaScript/jquery-1.8.2.min.js"></script>
    <script language="javascript" type="text/javascript" src="JavaScript/empleado_jquery.js"></script>  
    <script language="javascript" type="text/javascript">
	    $(document).ready(function() {			
			$("#b5").click(function(event) {
			$("#buscar").val('');	
			var miPopup 
			miPopup = window.open("Php/transacciones/buscar_trabajador.php","miwin","width=530px,height=300px,scrollbars=yes,resizable=yes") 
			miPopup.focus();
			});
		});
</script>      
   </head>
    <body>
     <div id="cuerpo"> 
            <form action="javascript: fn_consultar();" id="frm_buscar" name="frm_buscar" method="post">
                <table width="696" height="51" class="formulario">
                    <tbody>
                        <tr>
        <th width="32" height="45" align="right"><div title="Buscar Trabajadores" id="b5" style="width:25px; cursor:pointer"><img src="Imagen_sistema/lupa.png" alt="Consultar" width="20" height="20" align="absmiddle"/></div></th>
                            <th width="63">Cedula</th>
                            <td width="94"><input name="buscar" type="text" id="buscar" size="14" title="Escriba las primeras letras del Apellido" /></td>
                            <th width="90">Ordenar</th>
                            <td width="161">
                            	<select name="ordenar_por" id="ordenar_por" title="Ordenar la lista de titulares">
                                	<option value="0" seleted="seleted">Seleccionar</option>
                                    <option value="1">Apellido</option>
                                    <option value="2">Cedula</option>
                                    <option value="3">Apellido y Cedula</option>
                                </select>
                            </td>
                            <th width="31">Ver</th>
                            <td width="58"><select name="paginas" id="paginas" title="Listar por cantidad">
                              <option value="5">5</option>
                               <option value="10" >10</option>
                               <option value="15" selected="selected">15</option>
                               <option value="20">20</option>
                            </select></td>
                            <td width="78"><input type="submit" value="  Buscar  " class="btn btn-primary btn-small" title="Buscar Titular" /></td>
                            <td width="75"><input name="b4" type="button" id="b4" class="btn btn-primary btn-small" onclick="limpiar();" value=" Limpiar " title="Limpiar Campos" /></td>             
                        </tr>
                    </tbody>
                  </table>
           <div id="div_listar"></div>     
              </form>

<script language="javascript" type="text/javascript">

function limpiar(){		
			$('#buscar').val('');	
			$('#ordenar_por').val('0');
			$('#paginas').val('10');
		}	 
<!-- Creamos una funcion consultar para Enviar un mensaje de Alerta cuando no encuentre datos !-->
function fn_consultar(){
	var str = $("#frm_buscar").serialize();
	$.ajax({
		url: 'Controladores/control_verificar_filtro_titular.php',
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
</div>
</body>
</html>
