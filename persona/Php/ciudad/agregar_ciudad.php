<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><!DOCTYPE html >
<html lang="es">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
    <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
	<link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />    	
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.8.2.min.js"></script>            
    <script language="javascript" type="text/javascript" src="../../JavaScript/ciudad_jquery.js"></script> 
    <script language="javascript" type="text/javascript" src="../../JavaScript/ciudad.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
    </head><script language="javascript" type="text/javascript" >
	  
	  $(document).ready(function(){

    	$('#nuevo').click(function(){
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
		
		$('#nombre').attr('disabled', false);
		$('#nombre').focus();
		$('#direccion').attr('disabled', false);	
		$('#estado').attr('disabled', false);		
		
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);	
		
		$('#nombre').attr('disabled', true);
		$('#direccion').attr('disabled', true);	
		$('#estado').attr('disabled', true);			
		}
    });
    });
	function limpiar_form(ele) {
   $(ele).find('input').each(function() {
      switch(this.type) {
         case 'select':
         case 'text':
				 $(this).val('');
               	 break;
      }
   }); 			
 $(ele).find('select').each(function() {
       $("#"+this.id).val('0');
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
          <form action="javascript: fn_agregar();" method="post" id="form_ciudad" name="form_ciudad">
            <table width="686" height="45">
   				 <tr>
      				<td width="664" height="39"> <h1> Agregando Ciudad </h1></td>
   				   <td width="22" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onclick="location.href='../../../html/blanco.html'" title="Salir" /></td>
    			 </tr>
  			</table>
              <fieldset>  
   				<table width="680" height="59" cellpadding="0" cellspacing="0">
   				  <tbody>
   				    <tr>
   				      <td width="181" height="27"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
   				      <td width="62">Nombre:</td>
   				      <td width="421" ><label for="textarea">
   				        <input name="nombre" type="text" disabled="disabled" class="required" id="nombre" size="30" title="Nombre de la Ciudad" />
 				        </label></td>
			        </tr>
   				    <tr>
   				      <td height="24">&nbsp;</td>
   				      <td>Estado:</td>
   				      <td ><select name="estado" id="estado" disabled="disabled" title="Estado que pertenece la ciudad">
   				        <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
   				        <?php include_once("../../Clases/clase_estado.php");
$estado=new estado();
$lista=$estado->lista_estado();
for($i=0;$i<count($lista);$i++)
{
	$idEstado	=	$lista[$i][1];
	$NombEstado	=	$lista[$i][2];
?>
   				        <option value="<?php echo $idEstado;?>"><?php echo $NombEstado;?></option>
   				        <?php }?>
 				        </select></td>
			        </tr>
			      </tbody>
			    </table>
   				<legend align="left"> </legend>
              </fieldset>
           			   <table  width="685" border="0"  cellpadding="0" cellspacing="0">
                           <tr>
                           <td align="right" ><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' onclick="limpiar_form(this.form)" title="Pulse para activar campos" /></td>
                           <td ><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onclick="if(!valida()){return false};" value=" Agregar" title="Guardar" /></td>
                           </tr>
                       </table>
          <hr />
           <div id="div_listar_ciudad"></div>
           </div>             
          </form>    
        </div>
    </body>
</html>
