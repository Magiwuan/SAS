<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" /> 
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	
    <link rel="stylesheet" type="text/css" href="../../Css/validationEngine.jquery.css" />
	<script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.validationEngine-es.js"  charset="utf-8">		    </script>
	<script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.validationEngine.js" charset="utf-8"></script> 
	<script src="../../JavaScript/jscal2.js"></script>    
    <script src="../../JavaScript/es.js"></script>    
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/medico_jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/medico.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
	</head><script language="javascript" type="text/javascript" >
	  $(document).ready(function(){
    	$('#nuevo').click(function(){
		$("#cap_dis").load('select_medico.php');
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
		
		$('#ced2').attr('disabled', false);
		$('#nacionalidad1').attr('disabled', false);
		$('#nacionalidad1').focus();
		$('#nacionalidad2').attr('disabled', false);
		$('#cedula').attr('disabled', false);
		$('#nombre').attr('disabled', false);
		$('#apellido').attr('disabled', false);
		$('#especialidad').attr('disabled', false);
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);	
		
		$('#ced2').attr('disabled', true);
		$('#nacionalidad1').attr('disabled', true);
		$('#nacionalidad2').attr('disabled', true);
		$('#cedula').attr('disabled', true);
		$('#nombre').attr('disabled', true);
		$('#apellido').attr('disabled', true);
		$('#especialidad').attr('disabled', true);		
		}
    });
    });
	jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#form_medico").validationEngine();
		});
	function limpiar_form(ele) {
   $(ele).find('input').each(function() {
      switch(this.type) {
         case 'password':
         case 'select':
         case 'textarea':
				 $(this).val('');
               	 break;
		case 'text':
		if($('input[name="cedula"]')){}else {$(this).val('');}
		break;
         case 'checkbox':
         case 'radio':
         	this.checked = false;
			   break;
      }
   }); 			
   $(ele).find('select').each(function() {
       $("#"+this.id + " option[value=0]").attr("selected",true);
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
	<form action="" method="post" id="form_medico" name="form_medico">
		<table width="686" height="25" border="0" cellpadding="0" cellspacing="0">
    	<tr>
     		<td width="687"><h1>Agregando Médico</h1></td>
     		<td width="22" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar();" title="Salir"/></td>
    	</tr>
  		</table>
	  <fieldset>
		<legend align="left">Datos Personales</legend>
		<table width="682" border="0" cellpadding="0" cellspacing="0">
		<tr>
          <td width="34">&nbsp;</td>
          <td width="86">Nacionalidad:</td>
          <td width="194">
          <input type="radio" name="nacionalidad" id="nacionalidad1" value="V" disabled="disabled" >Venezolano 
          <input type="radio" name="nacionalidad" id="nacionalidad2" value="E" disabled="disabled">Extranjero
          </td>
          <td width="135">Nro. C.I o Pasaporte:</td>
          <td width="98"><input name="ced2" type="text" disabled id="ced2" size="16" /></td>
          <td width="135"><a href="#" onclick="jQuery('#test').validationEngine('showPrompt', 'Ejemplo: 20643089, Si la C.I es menor a ocho (8) dígitos complete con ceros (0) a la izquierda Ejemplo: 08042667', 'pass')" title="Ayuda">
			      <div id="test" class="test" style="width:30px;"><img src="../../../Imagenes/ayuda.png" width="15" height="15"/></div>
			    </a></td>
          </tr>
          <tr>
          <td>&nbsp;</td>
          <td>Nombres:</td>
          <td><input name="nombre" type="text" disabled id="nombre" size="30" /></td>
          <td>Apellidos:</td>
          <td colspan="2"><input name="apellido" type="text" disabled id="apellido" size="30" />
          </td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td><span>Especialidad:</span></td>
          <td><select name="especialidad" id="especialidad" disabled="disabled">
            <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
            <?php include_once("../../Clases/clase_especialidad.php");
				$especialidad=new especialidad();
				$lista_especialidad=$especialidad->lista_especialidad();
				for($i=0;$i<count($lista_especialidad);$i++)
				{
			?><option value="<?php echo $lista_especialidad[$i][1];?>"><?php echo $lista_especialidad[$i][2];?></option>
           <?php }?>
          </select></td>
        <td>Organización:</td>
 		<td colspan="2" rowspan="2" valign="top"><div id="cap_dis" style="width:20px"></div>
 		  </td>
 		</tr>
      <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
		<td>&nbsp;</td>
       </tr>
    </table>       
 </fieldset>
  <table  width="686" border="0">
   <tr>
  <td width="339" align="right"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' title="Pulsar para activar campos" /></td>
      <td width="337"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" title="Guardar"/></td>
   </tr>
</table>   
</form>    
</div>
</body>
</html>