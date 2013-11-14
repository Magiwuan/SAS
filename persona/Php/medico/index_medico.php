<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Documento sin título</title>          
        <link href="../../Css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="../../Css/estilo2.css" rel="stylesheet" type="text/css" />
        <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
        <link rel="stylesheet" type="text/css" href="../../Css/jquery.asmselect.css" />
        <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" /> 
       	<script language="javascript" src="../../JavaScript/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"> </script>
        <script language="javascript" type="text/javascript" src="../../JavaScript/medico_jquery.js"></script>  
        <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script>
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>     
    </head>
    <body>
     <div id="cuerpo"> 
            <form action="javascript: fn_consultar();" id="frm_buscar_medico" name="frm_buscar_medico" method="post">
                <table width="686" height="45" class="formulario" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <th width="60">Médico</th>
                            <td width="144"><input name="apellido" type="text" id="apellido" size="14" title="Escriba las primeras letras del Apellido" /></td>
                            <th width="75" >Ordenar </th>
                            <td width="155">
                            	<select name="ordenar_por" id="ordenar_por" title="Ordenar la lista de Médicos">
                                	<option value="0" selected="selected" seleted="seleted">Seleccionar</option>
                                    <option value="1">Apellido</option>
                                    <option value="2">Cedula</option>
                                    <option value="3">Apellido yCedula</option>
                                </select>
                            </td>
                            <th width="33">Ver</th>
                            <td width="60"><select name="paginas" id="paginas" title="Lista por cantidad">
                              <option value="5">5</option>
                               <option value="10" selected="selected">10</option>
                               <option value="15" >15</option>
                               <option value="20">20</option>
                            </select></td>
                            <td width="80"><input type="submit" value="  Buscar  " class="btn btn-primary" title="Buscar Médico"/></td>
                            <td width="77"><input name="b4" type="button" id="b4" class="btn btn-primary" onclick="limpiar();" value=" Limpiar " title="Limpiar campos" /></td>             
                        </tr>
                    </tbody>
                  </table>
           <div id="div_listar_medico"></div>
            </form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){ 
	 	
});
function limpiar(){		
			$('#ordenar_org').val('');		
			$('#ordenar_por').val('0');
			fn_listar_medico();	
		}	 
<!-- Creamos una funcion consultar para Enviar un mensaje de Alerta cuando no encuentre datos !-->
function fn_consultar(){
	var str = $("#frm_buscar_medico").serialize();
	$.ajax({
		url: '../../Controladores/control_verificar_filtro_medico.php',
		type: 'get',
		data: str,
		success: function(data){
			if(data=='No'){
				jAlert("BOOM!! No hay Resultados :(");
				$('#ordenar_org').focus();
			}else{
				fn_listar_medico();						
			}			
		}
	});
}
	 </script>
     </div>
    </body>
</html>
