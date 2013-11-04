<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Entrada de Articulos</title>        
	<link rel="stylesheet" type="text/css" href="Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="Css/border-radius.css" /> 
    <link href="JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="Css/validationEngine.jquery.css" type="text/css"/>
	<script src="JavaScript/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
	<script src="JavaScript/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>	
	<script src="JavaScript/jscal2.js"></script>    
    <script src="JavaScript/es.js"></script>        
	<script language="JavaScript" type="text/javascript" src="JavaScript/jquery.ui.js"></script>    
    <script language="JavaScript" type="text/javascript" src="JavaScript/jquery.asmselect.js"></script>     
	<script language="javascript" type="text/javascript" src="JavaScript/jquery.alerts.js"></script> 
    <script language="javascript" type="text/javascript" src="JavaScript/empleado.js"></script>   
     <script language="javascript" type="text/javascript" >	  
	  $(document).ready(function(){	
	    $('#nuevo').click(function(){	
		$("#disc_capa").css("display","block");
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
		
	    $('#bt').attr('disabled', false);
		$('#bt_fna').attr('disabled', false);
		$('#nacionalidad1').attr('disabled', false);
		$('#nacionalidad1').focus();
		$('#nacionalidad2').attr('disabled', false);
		$('#cedula').attr('disabled', false);
		$('#nombre1').attr('disabled', false);
		$('#nombre2').attr('disabled', false);
		$('#apellido1').attr('disabled', false);
		$('#apellido2').attr('disabled', false);
		$('#sexo1').attr('disabled', false);
		$('#sexo2').attr('disabled', false);
		$('#estado').attr('disabled', false);
		$('#celular').attr('disabled', false);
		$('#telefono').attr('disabled', false);
		$('#estado_civ').attr('disabled', false);
		$('#discapacidad').attr('disabled', false);
		$('#estado2').attr('disabled', false);
		$('#correo').attr('disabled', false);
		$('#direccion').attr('disabled', false);
		$('#tipo_nomina1').attr('disabled', false);
		$('#tipo_nomina2').attr('disabled', false);
		$('#tipo_nomina3').attr('disabled', false);
		$('#tipo_nomina4').attr('disabled', false);
		$('#tipo_nomina5').attr('disabled', false);
		$('#profesion').attr('disabled', false);
		$('#cargo').attr('disabled', false);
		$('#departamento').attr('disabled', false);
		$('#upsa').attr('disabled', false);
		$('#correo2').attr('disabled', false);
		$('#observacion').attr('disabled', false);
		$('input[name="recaudos[]"]').attr('disabled', false);
				
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);	
		$("#disc_capa").css("display","none");		
		$('#bt').attr('disabled', true);
		$('#bt_fna').attr('disabled', true);
		$('#nacionalidad1').attr('disabled', true);
		$('#nacionalidad2').attr('disabled', true);
		$('#cedula').attr('disabled', true);
		$('#nombre1').attr('disabled', true);
		$('#nombre2').attr('disabled', true);
		$('#apellido1').attr('disabled', true);
		$('#apellido2').attr('disabled', true);
		$('#sexo1').attr('disabled', true);
		$('#sexo2').attr('disabled', true);
		$('#estado').attr('disabled', true);
		$('#celular').attr('disabled', true);
		$('#telefono').attr('disabled', true);
		$('#estado_civ').attr('disabled', true);
		$('#discapacidad').attr('disabled', true);
		$('#estado2').attr('disabled', true);
		$('#correo').attr('disabled', true);
		$('#direccion').attr('disabled', true);
		$('#tipo_nomina1').attr('disabled', true);
		$('#tipo_nomina2').attr('disabled', true);
		$('#tipo_nomina3').attr('disabled', true);
		$('#tipo_nomina4').attr('disabled', true);
		$('#tipo_nomina5').attr('disabled', true);
		$('#profesion').attr('disabled', true);
		$('#cargo').attr('disabled', true);
		$('#departamento').attr('disabled', true);
		$('#upsa').attr('disabled', true);
		$('#correo2').attr('disabled', true);
		$('#observacion').attr('disabled', true);
		$('input[name="recaudos[]"]').attr('disabled', true);	
		}
    });
    });
function limpiar_form(ele) {
   $(ele).find('input').each(function() {
      switch(this.type) {
         case 'password':
         case 'select':
         case 'text':
         case 'textarea':
				 $(this).val('');
               	 break;
         case 'checkbox':
         case 'radio':
         	this.checked = false;
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
.btn_act{height: 23px;background-color: #f5f5f0;border-bottom: 1px solid #09F;border-right:1px solid #09F;border-top:0px;border-left:0px;font-size: 13px;color:black;padding-left: 20px;background-repeat: no-repeat;cursor:hand; cursor:pointer;margin-left:5px;margin-right:5px;outline-width:0px;background-image: url(Imagen_sistema/cancelar.jpg);}.btn_nuevo_act_img{background-image: url(Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto;background-repeat: no-repeat;cursor:hand; cursor:pointer;height: 21px;width: 22px;border: 0px;background-image: url(Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px;background-color: #f5f5f0;border-bottom: 1px solid #0F0;border-right:1px solid #0F0;border-top:0px;border-left:0px;font-size: 13px;color:black;padding-left: 20px;  background-repeat: no-repeat;cursor:hand;cursor:pointer;margin-left:5px;margin-right:5px;outline-width:0px;}.btn_guardar_desact{height: 23px;background-color: #f5f5f0;border-bottom: 1px solid #999;border-right:1px solid #999;border-top:0px;border-left:0px;font-size: 13px;color:#CCC;padding-left: 20px;background-repeat: no-repeat;cursor:hand; cursor:pointer;margin-left:5px;margin-right:5px;outline-width:0px;}/*.btn_guardar_desact_img{background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{height: 23px;background-color: #f5f5f0;border-bottom: 1px solid #333;border-right:1px solid #333;border-top:0px;border-left:0px;font-size: 13px;color:#CCC;padding-left: 20px;background-repeat: no-repeat;cursor:hand;cursor:pointer;margin-left:5px;margin-right:5px;outline-width:0px;}.btn_act1 {height: 23px;background-color: #f5f5f0;border-bottom: 1px solid #09F;border-right:1px solid #09F;border-top:0px;border-left:0px;font-size: 13px;color:black; padding-left: 20px;background-repeat: no-repeat;cursor:hand;cursor:pointer;margin-left:5px;margin-right:5px;outline-width:0px;background-image: url(Imagen_sistema/cancelar.jpg);}
</style>
</head>
<body> 
<form action="" method="POST" id="form_titular" name="form_titular">
<table width="696" height="25" border="0" cellpadding="0" cellspacing="o">
    <tr>
      <td width="687"><h1>Agregando Titular</h1></td>
       <td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar();" title="Salir" /></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left">Datos Personales</legend>
    <table width="686" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="120">Nacionalidad:</td>
      <td width="181">
        <input name="nacionalidad" type="radio" disabled="disabled" id="nacionalidad1" value="V" ><label for="nacionalidad1">Venezolano</label>
        <input name="nacionalidad" type="radio" disabled="disabled" id="nacionalidad2" value="E"><label for="nacionalidad2">Extranjero</label>
      </td>
      <td width="138">Nro. C.I o Pasaporte:</td>
      <td colspan="2"><input name="cedula" type="text" disabled="disabled" id="cedula" size="20" maxlength="16" /></td>
      <td><a href="#" onclick="jQuery('#test').validationEngine('showPrompt', 'Ejemplo: 20643089, Si la C.I es menor a ocho (8) dígitos complete con ceros (0) a la izquierda Ejemplo: 08042667', 'pass')" title="Ayuda">
			      <div id="test" class="test" style="width:30px;"><img src="../Imagenes/ayuda.png" width="15" height="15"/></div>
			    </a></td>
      </tr>
    <tr>
      <td>Primer Nombre:</td>
      <td><input name="nombre1" type="text" disabled="disabled" id="nombre1" size="28" /></td>
      <td>Segundo Nombre:</td>
      <td colspan="3"><input name="nombre2" type="text" disabled="disabled" id="nombre2" size="25" /></td>
      </tr>
    <tr>
      <td>Primer Apellido:</td>
      <td><input name="apellido1" type="text" disabled="disabled" id="apellido1" size="28"/></td>
      <td>Segundo Apellido:</td>
      <td colspan="3">
        <input name="apellido2" type="text" disabled="disabled" id="apellido2" size="25" />
      </td>
      </tr>
    <tr>
      <td>Sexo:</td>
      <td><input name="sexo" type="radio" disabled="disabled" id="sexo1" value="F"><label for="sexo1">Femenino</label>  
        <input name="sexo" type="radio" disabled="disabled" id="sexo2" value="M"><label for="sexo2">Masculino</label>
       </td>
      <td>Fecha de Nacimiento:</td>
      <td width="74"><input name="fecha_nac" type="text" id="fecha_nac" size="12" maxlength="10" readonly /></td>
      <td width="43"><button name="bt" id="bt" class="button" disabled="disabled"><img src="Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
      <td width="111">
    </td>
    </tr>
        <tr>
          <td>Lugar Nacimiento:</td>
          <td><select name="estado2" disabled="disabled" id="estado2">
            <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
            <?php include_once("../Clases/clase_estado.php");
				$estado =new estado();
				$lista_estado=$estado->lista_estado();
				for($j=0;$j<count($lista_estado);$j++)
				{				
			?> <option value="<?php echo $lista_estado[$j][1];?>"><?php echo $lista_estado[$j][2];?></option>
            <?php }?>
          </select></td>
          <td>Ciudad:          </td>
          <td colspan="3">
          <div id="cap5" style="color:#FF0000; display:block; width:160px;">*Por favor elija un estado</div>
          <div id="cap6" style="display: none;">
          		<select name="ciudad2" id="ciudad2" >
    			</select>
     	  </div></td>
        </tr>
        <tr>
      <td>Celular:</td>
      <td><input name="celular" type="text" disabled="disabled" id="celular" size="15" maxlength="12" /></td>
      <td>Teléfono:</td>
      <td colspan="3"><input name="telefono" type="text" disabled="disabled" id="telefono" size="15" maxlength="12" /></td>
      </tr>
    <tr>
      <td>Estado Civil:</td>
      <td><select name="estado_civ" disabled="disabled" id="estado_civ">
        <option value="0"> seleccionar</option>
        <option value="S"> Soltero</option>
        <option value="C"> Casado</option>
        <option value="D"> Divorciado</option>
        <option value="E"> Viudo</option>
      </select></td>
      <td>Discapacidad:</td>
      <td colspan="3" rowspan="2" valign="top"><div id="disc_capa" style="display:none;"> 
<select name="discapacidad[]" multiple="multiple"  id="discapacidad" title="Seleccionar">
  <?php include_once("../Clases/clase_discapacidad.php");
			$discapacidad=new discapacidad();
			$lista_discapacidad=$discapacidad->lista_discapacidad();
			for($i=0;$i<count($lista_discapacidad);$i++)
			{			
			?>
  <option value="<?php echo $lista_discapacidad[$i][1];?>" 
		  	<?php /*if($lista_discapacidad[$i][2]=='N/A')
				{
					echo "Selected=\"Selected\"";
				}
				*/	?>> <?php echo $lista_discapacidad[$i][2];?></option>
  <?php }?>
</select>
</div>
      </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>     
    </tr>
    </table>    
  </fieldset>
     <fieldset> 
      <legend align="left">Dirección de Habitación</legend>   
     <table width="686" border="0" cellpadding="0" cellspacing="0">   
    <tr>
      <td width="128">Estado:</td>
      <td width="160">
        <select name="estado" disabled="disabled" id="estado">
          <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
          <?php		
			for($i=0;$i<count($lista_estado);$i++)
			{
			?>
          <option value="<?php echo $lista_estado[$i][1];?>"><?php echo $lista_estado[$i][2];?></option>
          <?php }?>
        </select>
      </td>
      <td width="52">Ciudad:</td>
      <td width="253">
      <div id="cap1" style="color:#FF0000; display:block; width:160px;">*Por favor elija un estado</div>
      <div id="cap2" style="display: none;">
      	<select name="ciudad" id="ciudad" >
      	</select>
      </div></td>
      <td width="71">&nbsp;</td>
    </tr>    
     <tr>
       <td>Correo Electronico:</td>
       <td colspan="4"><input name="correo" type="text" disabled="disabled" id="correo" size="50" /></td>
    </tr>
    <tr>
      <td height="42">Direccion de Hab.:</td>
      <td colspan="4"><textarea name="direccion" cols="45" rows="2" disabled="disabled" id="direccion"></textarea></td>
    </tr>
  </table>
  </fieldset>
  <fieldset>  
    <legend align="left">Datos del Trabajo</legend>   
    <table width="686" border="0" cellpadding="0" cellspacing="0">  
      <tr>
        <td>Tipo Nómina:</td>
        <td><input name="tipo_nomina" type="radio" disabled="disabled" id="tipo_nomina1" value="P" /><label for="tipo_nomina1">Presidente</label></td>
        <td><input name="tipo_nomina" type="radio" disabled="disabled" id="tipo_nomina2" value="D" /><label for="tipo_nomina2">Directivo</label></td>
        <td width="108"><input name="tipo_nomina" type="radio" disabled="disabled" id="tipo_nomina3" value="E" /><label for="tipo_nomina3">Empleado</label></td>
        <td width="108"><input name="tipo_nomina" type="radio" disabled="disabled" id="tipo_nomina4" value="C" /><label for="tipo_nomina4">Contratado</label></td>
        <td width="145"><input name="tipo_nomina" type="radio" disabled="disabled" id="tipo_nomina5" value="O" /><label for="tipo_nomina5">Obrero</label></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
      <td width="133" height="28">Fecha de ingreso:</td>
      <td width="87"><input name="fecha_ingr" id="fecha_ingr" type="text" size="12" maxlength="10" readonly /></td>
      <td width="89"><button name="bt_fna" id="bt_fna" class="button" disabled="disabled" ><img src="Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha" /></button> 
      </td>
      <td width="88" >Profesión:</td>
      <td colspan="2" valign="top"><select name="profesion" disabled="disabled" id="profesion">
		    <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
  <?php include_once("../Clases/clase_profesion.php");
			$profesion=new profesion();
			$lista_profesion=$profesion->lista_profesion();
			for($i=0;$i<count($lista_profesion);$i++)
			{
			?>
  <option value="<?php echo $lista_profesion[$i][1];?>"><?php echo $lista_profesion[$i][2];?></option>
  <?php }?>
</select></td>
      <td width="6">&nbsp;</td>
    </tr>
    <tr>
      <td height="24">Cargo:</td>
      <td colspan="2">
        <select name="cargo" disabled="disabled" id="cargo" title="Seleccionar">
          <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
			<?php include_once("../Clases/clase_cargo.php");
				$cargo=new cargo();
				$lista_cargo=$cargo->lista_cargo();
				for($i=0;$i<count($lista_cargo);$i++)
				{
			?>   <option value="<?php echo $lista_cargo[$i][1];?>"><?php echo $lista_cargo[$i][2];?></option>
			<?php }?>
      </select>
      </td>
      <td>Correo Corporativo:</td> 
      <td colspan="3"><input name="correo2" type="text" disabled="disabled" id="correo2" size="35" /></td>
    </tr>
    <tr>
      <td height="24">Departamento:</td>
      <td colspan="2">
        <select name="departamento" disabled="disabled" id="departamento">
          <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
			<?php include_once("../Clases/clase_departamento.php");
            $departamento=new departamento();
            $lista_departamento=$departamento->lista_departamento();
            for($i=0;$i<count($lista_departamento);$i++)
            {              
            ?><option value="<?php echo $lista_departamento[$i][1];?>"><?php echo $lista_departamento[$i][2];?></option>
            <?php }?>
        </select>
      </td>
      <td>UPSA:</td>
      <td><select name="upsa" disabled="disabled" id="upsa" title="Sede o Planta">
          <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
			<?php include_once("../Clases/clase_upsa.php");
            $upsa=new upsa();
            $lista_upsa=$upsa->lista_upsa();
            for($i=0;$i<count($lista_upsa);$i++)
            {
            ?><option value="<?php echo $lista_upsa[$i][1];?>"><?php echo $lista_upsa[$i][2];?></option>
            <?php }?>
        </select>
     </td>
      <td></td>
      <td></td>
    </tr>
       <tr>
      <td height="37">Dirección:</td>
      <td colspan="6"><div id="cap4" style="width:320px;"><textarea name="direccion2" id="direccion2" cols="45" rows="2" readonly></textarea></div></td>
    </tr>
      <tr>
        <td height="37">Observaciones:</td>
        <td colspan="6"><textarea name="observacion" cols="45" rows="2" disabled="disabled" id="observacion"></textarea></td>
      </tr>
      <tr>
        <td height="23" rowspan="2">Recaudos:</td>
        <td height="23" colspan="5"><?php include_once("../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('AFILIACIÓN - TITULAR');
			$lista_recaudo=$recaudo->lista_recaudo();
			for($i=0;$i<count($lista_recaudo);$i++)			
			{				
				if($lista_recaudo[$i][3]=='AFILIACIÓN - TITULAR'){					
		?><input type="checkbox" name="recaudos[]" id="<?php echo $i;?>" value="<?php echo $lista_recaudo[$i][1];?>" disabled="disabled">
        <?php echo "<label  for='$i'>".$lista_recaudo[$i][2]."</label>"; ?>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Afiliacion Titular. Por favor <a href='#'>click</a></div>";}			
		}?></td>
       <td></td>
      </tr>    
    </table>
  </fieldset>
  <table  width="686" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="245">&nbsp;</td>
      <td width="90"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' title="Pulse para activar campos" onclick="limpiar_form(this.form)" /></td>
      <td width="97"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" /></td>
      <td width="248"></td>
      </tr>
  </table> 
</form>
</body>
</html>
