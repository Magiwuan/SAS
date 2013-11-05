<!DOCTYPE HTML >
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
  	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />      
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  	
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" />   
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	
    <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor.js"></script>
    <script language="JavaScript" type="text/javascript" src="JavaScript/jquery.ui.js"></script>    
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
	<script language="javascript" type="text/javascript" src="../../JavaScript/jscal2.js"></script>    
	<script language="javascript" type="text/javascript" src="../../JavaScript/es.js"></script>  	
    <script language="JavaScript" type="text/JavaScript">	
	   $(document).ready(function(){

			$('#nuevo').click(function(){
			$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
			$('#agregar').attr('disabled', false);
			$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
			$('#nuevo').attr('disabled', true);					
		
			$('#nombre').attr('disabled', false);
			$('#alias').attr('disabled', false);
			$('#persona_cont').attr('disabled', false);
			$('#rif').attr('disabled', false);
			$('#correo').attr('disabled',false);
			$('#celular').attr('disabled', false);
			$('#estado').attr('disabled', false);
			$('#telefono').attr('disabled', false);
			$('#fax').attr('disabled', false);
			$('#direccion').attr('disabled', false);
			$('#bt_i').attr('disabled', false);
			$('#bt_f').attr('disabled', false);
			
    	});	
     $('#agregar').click(function(){
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);
			
			$('#bt_i').attr('disabled', true);
			$('#bt_f').attr('disabled', true);
			$('#nombre').attr('disabled', true);
			$('#alias').attr('disabled', true);
			$('#persona_cont').attr('disabled', true);
			$('#rif').attr('disabled', true);
			$('#correo').attr('disabled', true);
			$('#celular').attr('disabled', true);
			$('#estado').attr('disabled', true);
			$('#telefono').attr('disabled', true);
			$('#fax').attr('disabled', true);
			$('#direccion').attr('disabled', true);
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
 $('#capa_servi').load('select_servicio.php');
   }
  	    
		});	 

</script>
<style>
.btn_act{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_nuevo_act_img{background-image: url(../../Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px; width: 22px; border: 0px; background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(../../Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px;font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer;  margin-left:5px; margin-right:5px;  outline-width:0px;}/*.btn_guardar_desact_img{background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333; border-right:1px solid #333; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}#popup {left: 0; position: absolute; top: 0; width: 100%; z-index: 1001;}.content-popup {margin:0px;  padding:10px;  width:732px;   min-height:250px; border-radius:4px; background-color:#FFFFFF; box-shadow: 0 2px 5px #666666;}.close {position:relative; left:700px;}
</style>
</head>
<body>
<div id="cuerpo"> 
<form action="" method="POST" id="form_proveedor" name="form_proveedor">
<table width="686" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="683"> <h1> Agregando Proveedor de Salud</h1></td>
      <td width="22" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar();" title="Salir" /></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left">Datos de la Organización </legend>
  <table width="682" height="265" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="1" height="27">&nbsp;</td>
      <td width="118">Nombre:</td>
      <td colspan="3"><input name="nombre" type="text" disabled id="nombre" size="40" title="Nombre de la Organización"/></td>
      <td width="54">Alias:</td>
      <td colspan="3"><input name="alias" type="text" disabled id="alias" size="30" title="Nombre de la Franquicia" /></td>
      </tr>
     <tr>
       <td>&nbsp;</td>
      <td>Persona Contacto:</td>
      <td colspan="3" valign="top"><span>
        <input name="persona_cont" type="text" disabled id="persona_cont" size="40" title="Persona con quien se reliza el convenio"  />
      </span></td>
      <td>R.I.F:</td>
      <td width="98"><input name="rif" type="text" disabled id="rif" size="16" title="Registro de Información Fiscal del Proveedor" /></td>
      <td width="149"><div id="test" title="Ejemplo: j-1234567-8 " class="test" style="width:30px; cursor:pointer;"><img src="../../../Imagenes/ayuda.png" width="15" height="15"/></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Correo eléctronico:</td>
      <td colspan="3"><input name="correo" type="text" disabled id="correo" size="40" title="Correo del Proveedor o Persona contacto" /></td>
      <td>Celular:</td>
      <td colspan="2"><input name="celular" type="text" disabled id="celular" size="15" maxlength="12" title="Celular de la persona contacto"  /></td>
      </tr>
  	 <tr>
  	   <td>&nbsp;</td>
      		<td>Estado:</td>
      		<td colspan="3">
      			<div id="select_estado">
      				<select name="estado" id="estado" disabled="disabled" title="Estado donde esta ubicado">
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
       			  </select>
                </div>
      		</td>

      <td>Teléfono:</td>
      <td colspan="3"><input name="telefono" type="text" disabled id="telefono" size="15" maxlength="12" title="Teléfono del proveedor"/></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span>Ciudad:</span></td>
      <td colspan="3"><div id="select_ciudad"><div id="cap1" style="color:#FF0000; display:block; width:"200" ">*Por favor elija un estado</div><div id="cap2" style="display: none; "><select name="ciudad" id="ciudad" >
        <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
      </select></div></div></td>
      <td>Fax:</td>
      <td colspan="2"><input name="fax" type="text" disabled id="fax" size="15" maxlength="12" title="Fax del Proveedor campo opcional" /></td>
      </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Dirección:</td>
          <td colspan="7"><label for="direccion"></label>
            <textarea name="direccion" cols="45" rows="2" disabled id="direccion" title="Dirección donde esta ubicado el proveedor"></textarea>
            <input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
        </tr>
        <tr>			
          <td height="32">&nbsp;</td>
          <td>Fecha de Inicio:</td>
      <td width="74"><input name="fecha_ini" type="text" id="fecha_ini" size="12" maxlength="10" readonly /></td>
      <td width="43"><button name="bt_i" id="bt_i" class="button"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
          <td align="right">Servicio:</td>
          <td colspan="4" rowspan="4" valign="top"><div id="capa_servi" style="width:20px">
			    <select name="servicio[]" id="servicio" multiple="multiple" title="Seleccionar">
              <?php include_once("../../Clases/clase_servicio.php");
				$servicio=new servicio();
				$lista=$servicio->lista_servicio();
				for($i=0;$i<count($lista);$i++)
				{
					$idServicio		=	$lista[$i][1];
					$NombServicio	=	$lista[$i][2];
				?>
              <option value="<?php echo $idServicio;?>"><?php echo $NombServicio;?></option>
              <?php }?>
  </select>
          </div></td>
    </tr>
    <tr>      
      <td height="28">&nbsp;</td>
      <td>Fecha de Fin:</td>
      <td align="right"><input name="fecha_fin" type="text" id="fecha_fin" size="12" title="Fecha Hasta" maxlength="10" readonly /></td>
      <td align="left"><button name="bt_f" id="bt_f" class="button" disabled="disabled"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
      <td> <script language="JavaScript" type="text/JavaScript">	 
		 Calendar.setup({
			inputField : "fecha_ini",
			dateFormat: "%d-%m-%Y",
			trigger    : "bt_i",
			onSelect   : function() { this.hide() },
		  });
      Calendar.setup({
        inputField : "fecha_fin",
		dateFormat: "%d-%m-%Y",
        trigger    : "bt_f",
        onSelect   : function() { this.hide() },
      });  
      </script> </td>
      </tr>
     </table>      
    </fieldset>
   <table  width="686" border="0" cellpadding="0" cellspacing="0">
      <tr>
            <td width="258">&nbsp;</td>
      <td width="95"><input name="nuevo" onClick="limpiar_form(this);" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' title="Pulse para activar campos" /></td>
      <td width="100"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" title="Guardar" /></td>
      <td width="237"></td>
      </tr>
  </table>        
  </form>
</div>    
</body>
</html>
