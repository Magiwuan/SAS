<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Documento sin título</title>          
        <link href="../../Css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
        <link rel="stylesheet" type="text/css" href="../../Css/jquery.asmselect.css" />
        <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />		 
         <script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.4.2.min.js"></script>            
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.js"></script> <!--Js Para el listado de los combos de Discapacidad,Profesion -->
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.blockUI.js"></script>       
        <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor_jquery.js"></script>  
        <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script>
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>  
        
   </head>
    <body>
     <div id="cuerpo"> 
            <form action="javascript: fn_consultar();" id="frm_buscar_proveedor" name="frm_buscar_proveedor" method="post">
                <table width="692" height="45" class="formulario" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <th width="70">Empresa</th>
                            <td width="137"><input name="ordenar_org" type="text" id="ordenar_org" size="14" title="Escriba las primeras letras de la organización"/></td>
                            <th width="70" >Ordenar </th>
                            <td width="157">
                            	<select name="ordenar_por" id="ordenar_por" title="Ordenar la lista de organización">
                                	<option value="0" selected="selected" seleted="seleted">Seleccionar</option>
                                    <option value="1">Organizaci&oacute;n</option>
                                    <option value="2">Alias</option>
                                    <option value="3">Organizaci&oacute;n y Alias</option>
                                </select>
                            </td>
                            <th width="33">Ver</th>
                            <td width="60"><select name="paginas" id="paginas" title="Lista por cantidad">
                              <option value="5" selected="selected">5</option>
                               <option value="10">10</option>
                               <option value="15" >15</option>
                               <option value="20">20</option>
                          </select></td>
                            <td width="80"><input type="submit" value="  Buscar  " class="button" title="Buscar Proveedor"/></td>
                            <td width="83"><input name="b4" type="button" id="b4" class="button" onclick="limpiar();" value=" Limpiar "  title="Limpiar campos" /></td>             
                        </tr>
                    </tbody>
                  </table>
           <div id="div_listar_proveedor"></div>
            </form>

<script language="javascript" type="text/javascript">
function limpiar(){		
			$('#ordenar_org').val('');		
			$('#ordenar_por').val('0');
			fn_listar_proveedor();	
		}	 
<!-- Creamos una funcion consultar para Enviar un mensaje de Alerta cuando no encuentre datos !-->
function fn_consultar(){
	var str = $("#frm_buscar_proveedor").serialize();
	$.ajax({
		url: '../../Controladores/control_verificar_filtro_proveedor.php',
		type: 'get',
		data: str,
		success: function(data){
			if(data=='No'){
				jAlert("BOOM!! No hay Resultados :(");
				$('#ordenar_org').focus();
			}else{
				fn_listar_proveedor();						
			}			
		}
	});
}
	 </script>
     </div>
    </body>
</html>
