<!--<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><!DOCTYPE html>
<html lang="es">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" /> 
    <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
	<link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	  	
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.4.2.min.js"></script>            
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.blockUI.js"></script>   
   	<script language="javascript" type="text/javascript" src="../../JavaScript/servicio_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/servicio.js"></script>  
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
     </head> <script language="javascript" type="text/javascript" >
	  
	  $(document).ready(function(){

    	$('#nuevo').click(function(){
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
		
		$('#nombre').attr('disabled', false);
		$('#descripcion').attr('disabled', false);
		$('#nombre').focus();
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);	
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);
		
		$('#nombre').attr('disabled', true);
		$('#descripcion').attr('disabled', true);			
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
   $(ele).find('textarea').each(function() {
       $("#"+this.id).val('');
   });
 
   }
</script>  
<style>
.btn_act{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #09F;
  border-right:1px solid #09F; 
  border-top:0px; 
  border-left:0px; 
  font-size: 13px;
  color:black; 
  padding-left: 20px; 
  background-repeat: no-repeat; 
  cursor:hand; cursor:pointer;
  margin-left:5px; 
  margin-right:5px; 
  outline-width:0px;
  background-image: url(../../Imagen_sistema/cancelar.jpg);
}
.btn_nuevo_act_img{
	  background-image: url(../../Imagen_sistema/nuevo.jpg);
}
.btn_cancelar_act_img{
	 margin: auto;
	 background-repeat: no-repeat; 
	 cursor:hand; cursor:pointer;
	 height: 21px;
	 width: 22px;
	 border: 0px;
	 background-image: url(../../Imagen_sistema/cancelar.jpg);
}
.btn_guardar_act_img{
	  background-image: url(../../Imagen_sistema/guardar.jpg);
}
.btn_act:hover{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #0F0;
  border-right:1px solid #0F0; 
  border-top:0px; 
  border-left:0px;
  font-size: 13px; 
  color:black;
  padding-left: 20px; 
  background-repeat: no-repeat;
  cursor:hand; 
  cursor:pointer; 
  margin-left:5px; 
  margin-right:5px;
  outline-width:0px;
}

.btn_guardar_desact{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #999;
  border-right:1px solid #999; 
  border-top:0px; 
  border-left:0px; 
  font-size: 13px;
  color:#CCC;
  padding-left: 20px; 
  background-repeat: no-repeat; 
  cursor:hand; cursor:pointer;
  margin-left:5px; 
  margin-right:5px; 
  outline-width:0px;
}
/*.btn_guardar_desact_img{
  background-image: url(Imagen_sistema/guardar_desac.jpg);

}*/
.btn_guardar_desact:hover{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #333;
  border-right:1px solid #333; 
  border-top:0px; 
  border-left:0px;
  font-size: 13px; 
  color:#CCC;
  padding-left: 20px; 
  background-repeat: no-repeat;
  cursor:hand; 
  cursor:pointer; 
  margin-left:5px; 
  margin-right:5px;
  outline-width:0px;
}
</style>    
     <body>
        <div id="cuerpo">
          <form action="" method="post" id="form_servicio" name="form_servicio">
            <table width="686" height="25" border="0" cellpadding="0" cellspacing="0">
    			<tr>
      				<td width="687"><h1>Agregando Servicios</h1></td>
      				 <td width="22" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onclick="location.href='../../../html/blanco.html'" title="Salir" /></td>
   				</tr>
  			</table>
              <fieldset>  
   				<legend align="left">Servicios de Salud</legend>
   						<table width="677" height="68" cellpadding="0" cellspacing="0">
                    		<tbody>
                       			<tr>
                                <td width="147" height="28"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden"/></td>
                                <td width="90">Nombre:</td>
                                <td width="438" >
                                  <input name="nombre" type="text" disabled="disabled" id="nombre" size="20" title="Nombre de servicios" />
                                </label></td>
                               </tr>
                                <tr>
                              <td height="37">&nbsp;</td>
                                <td>Descripción:</td>
                                <td><textarea name="descripcion" cols="45" rows="2" disabled="disabled" id="descripcion" title="Descripción del servicio"></textarea></td>
                            </tr>                    
                            </tbody>
                        </table>    
                   </fieldset>
              <table  width="686" border="0">
                           <tr>
  <td width="322" align="right"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' onclick="limpiar_form(this.form)" title="Pulsar para activar campos" /></td>
      <td width="354"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" title="Guardar" /></td>
                           </tr>
                       </table>
          <hr/>
           <div id="div_listar_servicio"></div>
          </form>    
        </div>
</body>
</html>
