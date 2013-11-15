<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
<link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" />
<link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.8.2.min.js"></script> 
<script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>               
<script language="javascript" type="text/javascript" src="../../JavaScript/cobertura_jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../JavaScript/cobertura.js"></script>
<script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>  	
<script language="javascript" type="text/javascript" src="../../JavaScript/jscal2.js"></script>    
<script language="javascript" type="text/javascript" src="../../JavaScript/es.js"></script>    

<script language="javascript" type="text/javascript" >
$(document).ready(function(){
	$(document).ready(function(){
	  $(function() {
        $('input#monto').blur(function() {
	    var amt = parseFloat(this.value);
        $(this).val('Bs ' + amt.toFixed(2));
      });

    });
	});
   $('#nuevo').click(function(){
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
			
		$('#boton_fec_ini').attr('disabled', false);
		$('#boton_fec_fin').attr('disabled', false);
		$('#descripcion').attr('disabled', false);
		$('#tipo').attr('disabled', false);
		$('#monto').attr('disabled', false);
		$('#fecha_inicio').attr('disabled', false);
		$('#fecha_fin').attr('disabled', false);	
		
   });	
   $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);
		
		$('#boton_fec_ini').attr('disabled', true);
		$('#boton_fec_fin').attr('disabled', true);
		$('#descripcion').attr('disabled', true);
		$('#tipo').attr('disabled', true);
		$('#monto').attr('disabled', true);
		$('#fecha_inicio').attr('disabled', true);
		$('#fecha_fin').attr('disabled', true);	
	
		}
    });
    });

function limpiar_form(ele) {
   $(ele).find('input').each(function() {
      switch(this.type) {
         case 'text':
         case 'textarea':
				 $(this).val('');
               	 break;
      }
   }); 			
 $(ele).find('select').each(function() {
       $("#"+this.id).val('0');
   });

   $(ele).find('textarea').each(function() {
       $("#"+this.id).val('');
   });
 
   }
</script>
<script language="javascript" type="text/javascript">   
    var nav4 = window.Event ? true : false;
function IsNumber(evt){
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}
</script>  
<style type="text/css">.btn_act{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px;
  color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../Imagen_sistema/cancelar.jpg);
}.btn_nuevo_act_img{background-image: url(../../Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px;	 width: 22px; border: 0px;
background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(../../Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px; 
  background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px; font-size: 13px; color:black;
  padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{
  height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px;
  color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}/*.btn_guardar_desact_img{
  background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333;
  border-right:1px solid #333; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; 
  cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
</style>
</head>
    <body>
        <div id="cuerpo">
           <form action="" method="POST" id="form_cobertura" name="form_cobertura">
            <table width="696" height="25" border="0" cellpadding="0" cellspacing="0">
    			<tr>
      				<td width="684" height="37"> <h1> Agregando Cobertura </h1></td>
      				 <td  valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onclick="location.href='../../../html/blanco.html'" title="Salir" /></td>
   				</tr>
  			</table>
              <fieldset>  
   				<legend align="left"> Partidas</th> </legend>
   				<table width="679" height="112" cellpadding="0" cellspacing="0">
   				    <tr>
   				      <td width="149" height="37">&nbsp;</td>
   				      <td width="81">Descripción:</td>
   				      <td colspan="5" ><select name="descripcion" id="descripcion" disabled="disabled">
						   <option value="0"  disabled="disabled"> Seleccionar</option>
   				        <option value="SERVICIOS PRIMARIOS" selected> Servicios Primarios</option>
   				      </select></td>
			        </tr>
   				    <tr>
   				      <td height="22">&nbsp;</td>
   				      <td>Tipo:</td>
   				      <td colspan="5"><select name="tipo" id="tipo" disabled="disabled">
   				        <option value="0"  disabled="disabled"> Seleccionar</option>
   				        <option value="Individual" selected> Individual</option>
   				       <!-- <option value="Grupo Familia">Grupo Familiar</option>!-->
 				        </select></td>
			        </tr>
   				    <tr>
   				      <td height="25">&nbsp;</td>
   				      <td>Monto Bs.:</td>
   				      <td colspan="2"><input name="monto" type="text" onkeypress="return IsNumber(event);" disabled class="required" id="monto" size="22" /></td>
   				      <td>
   				        <div id="test" class="test" title="Ejemplo: 000000.00 colocar el monto total de la cobertura" style="cursor: pointer; width:30px;"><img src="../../../Imagenes/ayuda.png" width="15" height="15"/></div>
 				      </td>
   				      <td>&nbsp;</td>
   				      <td>&nbsp;</td>
			        </tr>
   				    <tr>
   				      <td height="26">&nbsp;</td>
   				      <td>Periodo: </td>
   				      <td width="74" align="right"><input name="fecha_inicio" type="text" id="fecha_inicio" size="12" maxlength="10" readonly title="Desde" /></td>
   				      <td width="64" align="left"><button name="boton_fec_ini" id="boton_fec_ini" class="button" disabled="disabled" title="Calendario para selecionar la fecha" ><img src="../../Imagen_sistema/calend.png" alt="" width="20" height="20"/></button>
   				        <!--  Script para leer la fecha  -->
   				        <script type="text/javascript">
      Calendar.setup({
        inputField : "fecha_inicio",
		dateFormat: "%d-%m-%Y",
        trigger    : "boton_fec_ini",
        onSelect   : function() { this.hide() },
      });
	                                  </script></td>
   				      <td width="78"><input name="fecha_fin" type="text" id="fecha_fin" size="12" maxlength="10" readonly  title="Hasta"/></td>
   				      <td width="86"><button name="boton_fec_fin" id="boton_fec_fin" class="button" disabled="disabled" title="Calendario para selecionar la fecha"><img src="../../Imagen_sistema/calend.png" alt="" width="20" height="20"/></button>
   				        <script type="text/javascript">
      Calendar.setup({
        inputField : "fecha_fin",
		dateFormat: "%d-%m-%Y",
        trigger    : "boton_fec_fin",
        onSelect   : function() { this.hide() },
      });
                                      </script></td>
   				      <td width="145"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
			        </tr>
			      </table></td>
              </fieldset>
              <table  width="686" border="0" cellspacing="0" cellpadding="0" >
      				<tr>
                          <td width="250">&nbsp;</td>
                          <td width="95"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' title="Pulse para activar campos" /></td>
      <td width="100"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar"  title="Guardar"/></td>
      <td width="241">&nbsp;</td>
      			    </tr>
             </table> 
          		<hr />
                <div id="div_listar_cobertura"></div>             
          </form>    
        </div>
    </body>
</html>
