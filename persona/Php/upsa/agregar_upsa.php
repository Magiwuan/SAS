<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
   	<script language="javascript" type="text/javascript" src="../../JavaScript/upsa_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/upsa.js"></script>
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
          <form action="" method="post" id="form_upsa" name="form_upsa">
            <table width="686" height="25" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="682" height="37"><h1>Agregando UPSA</h1></td>
                   <td width="20" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onclick="location.href='../../../html/blanco.html'" title="Salir"/></td>
                </tr>
  			</table>
              <fieldset>  
			    <legend align="left">Sede</legend>
    				<table width="677" height="91" cellpadding="0" cellspacing="0">
                   	 <tbody>
                        <tr>
                          <td width="161" height="25"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
                            <td width="64">Nombre:</td>
                            <td colspan="3">
                              <input name="nombre" type="text" disabled="disabled" class="required" id="nombre" size="30"  title="Nombre de la Planta o Sede"/>
                          </label></td>
                        </tr>
                        <tr>
                          <td height="37">&nbsp;</td>
                          <td>Dirección:</td>
                          <td colspan="3" >
                          <textarea name="direccion" cols="45" rows="2" disabled="disabled" id="direccion" title="Dirección donde esta ubicado la UPSA"></textarea></td>
                        </tr>
                        <tr>
                          <td height="24">&nbsp;</td>
                          <td>Estado:</td>
                          <td width="149" ><select name="estado" id="estado" disabled="disabled" title="Estado donde esta ubicado">
                            <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
                            <?php include_once("../../Clases/clase_estado.php");
						$estado=new estado();
						$lista_estado=$estado->lista_estado();
						for($i=0;$i<count($lista_estado);$i++)
						{
						?><option value="<?php echo $lista_estado[$i][1];?>"><?php echo $lista_estado[$i][2];?></option>
                        <?php }?>
                          </select></td>
                          <td width="52" >Ciudad:</td>
                          <td width="249"><div id="cap1" style="color:#FF0000; display:block;  ">*Por favor elija un estado</div><div id="cap2" style="display: none;"><select name="ciudad" id="ciudad" ></select></div></td>
                        </tr>
                    
                    </tbody>
                    </table>
             </fieldset>
<table  width="686" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="331" align="right"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' onclick="limpiar_form(this.form)" title="Pulse para activar los campos" /></td>
      <td width="100"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" title="Guardar" /></td>
<td width="255">&nbsp;</td>
</tr>
</table>
<hr />
<div id="div_listar_upsa"><div style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>
</div>                   
</form>    
</div>	
</body>
</html>