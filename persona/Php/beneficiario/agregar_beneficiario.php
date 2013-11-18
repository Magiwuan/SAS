<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
 if(isset($_POST["id_titular"]) && isset($_POST["nombre1"]) && isset($_POST["apellido1"])){
	 $_SESSION["id_titular"]=$_POST["id_titular"];
	 $_SESSION["nombre1"]	=$_POST["nombre1"];
	 $_SESSION["apellido1"]	=$_POST["apellido1"];
 }else{
	 $_SESSION["id_titular"]=$_SESSION["id_titular"];
	 $_SESSION["nombre1"]	=$_SESSION["nombre1"];
	 $_SESSION["apellido1"]	=$_SESSION["apellido1"];
 }
?>
<?php

include_once("../../Clases/clase_titular.php");
	$titular= new titular();	
	$titular->setidTitular($_SESSION["id_titular"]);
	$consulta=$titular->buscar_id();
	for($i=0;$i<count($consulta);$i++)			
	{
		$cedula			= $consulta[$i][3];
		$celular		= $consulta[$i][11];
		$telefono		= $consulta[$i][12];	
	}
?><!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>.:Agregar Beneficiario:.</title>          
<link rel="stylesheet" type="text/css" href="Css/jscal2.css"/>
<link rel="stylesheet" type="text/css" href="Css/border-radius.css"/> 	
<link rel="stylesheet" type="text/css" href="JavaScript/jquery.alerts.css" />  
<script language="javascript" type="text/javascript" src="JavaScript/jscal2.js"></script>    
<script language="javascript" type="text/javascript" src="JavaScript/es.js"></script> 
<script language="javascript" type="text/javascript" src="JavaScript/jquery.js"></script>
<script language="javascript" type="text/javascript" src="JavaScript/jquery-1.8.2.min.js" ></script>  
<script language="javascript" type="text/javascript" src="JavaScript/beneficiario_jquery.js"></script> 
<script language="javascript" type="text/javascript" src="JavaScript/jquery.alerts.js"></script> 
<script language="javascript" type="text/javascript" src="JavaScript/beneficiario.js"></script> 
<script language="JavaScript" type="text/javascript" src="JavaScript/jquery.asmselect.js"></script> 
<script language="javascript" type="text/javascript" >
	  $(document).ready(function(){		  
		/*$('#parentesco').change(function(){
			var parent = $('#parentesco').val();
			if(parent=='Hijo' || parent=='Hija'){
				$('#estado_civ').val('S');
				$('#estado_civ').attr('disabled', true);
			}else{
				$('#estado_civ').attr('disabled', false);
			}
		});	*/
    	$('#nuevo').click(function(){
		limpiar_form();
		$("#cap_dis").load('Php/beneficiario/select_discapacidad.php');
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);		
		$('#bt').attr('disabled', false);
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
		$('#fecha_nac').attr('disabled', false);
		$('#celular').attr('disabled', false);
		$('#telefono').attr('disabled', false);
		$('#parentesco').attr('disabled', false);
		$('#participacion').attr('disabled', false);
		$('#estado_civ').attr('disabled', false);
		$('#discapacidad').attr('disabled', false);
		$('input[name="recaudos[]"]').attr('disabled', false);
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);		
		$('#bt').attr('disabled', true);
		$('#nacionalidad1').attr('disabled', true);
		$('#nacionalidad2').attr('disabled', true);
		$('#cedula').attr('disabled', true);
		$('#nombre1').attr('disabled', true);
		$('#nombre2').attr('disabled', true);
		$('#apellido1').attr('disabled', true);
		$('#apellido2').attr('disabled', true);
		$('#sexo1').attr('disabled', true);
		$('#sexo2').attr('disabled', true);
		$('#fecha_nac').attr('disabled', true);
		$('#celular').attr('disabled', true);
		$('#telefono').attr('disabled', true);
		$('#parentesco').attr('disabled', true);
		$('#participacion').attr('disabled', true);
		$('#estado_civ').attr('disabled', true);
		$('#discapacidad').attr('disabled', true);
		$('input[name="recaudos[]"]').attr('disabled', false);		
		}
    });
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
<style type="text/css">
.btn_act{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px;
  color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(Imagen_sistema/cancelar.jpg);
}.btn_nuevo_act_img{background-image: url(Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px; width: 22px; border: 0px; background-image: url(Imagen_sistema/cancelar.jpg);}
.btn_guardar_act_img{background-image: url(Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #0F0;
  border-right:1px solid #0F0; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; 
  cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999;
  border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer;
  margin-left:5px; margin-right:5px; outline-width:0px;}/*.btn_guardar_desact_img{background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{
  height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333; border-right:1px solid #333; border-top:0px; border-left:0px; font-size: 13px; 
  color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
</style>
</head>
<body> 
<div id="cuerpo">
<form action="" method="POST" id="form_beneficiario" name="form_beneficiario">
<table width="696" height="25" border="0" cellpadding="0" cellspacing="0">
 <tr>
   <td width="684" height="37" ><h1>Titular: <?php echo $_SESSION["nombre1"].' '.$_SESSION["apellido1"];?></h1></td>
   <td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar_vista_agregar();" title="Salir" /></td>
 </tr>
</table>
<fieldset>
<legend align="left">Datos personales del beneficiario</legend>
<table width="686" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">
      	<div id="popup" style="display: none;">
   	  <div class="content-popup">
      <div class="close"><a href="#" id="close"><img src="Imagen_sistema/close.png"></a></div>
      <div id="cap"></div> 
    	</div>
	</div>
      	<input name="ope" type="hidden" id="ope" value="I" hidden="hidden"/>
      	<input name="id_titular" type="hidden" id="id_titular" value="<?php echo $_POST["id_titular"]; ?>" hidden="hidden"/></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td width="103">Nacionalidad:</td>
      <td width="179">
      	<input type="radio" name="nacionalidad" id="nacionalidad1" value="V" disabled="disabled"><label for="nacionalidad1">Venezolano<label/> 
        <input type="radio" name="nacionalidad" id="nacionalidad2" value="E" disabled="disabled"><label for="nacionalidad2">Extranjero<label/>
       </td>
      <td width="145">Nro. C.I o Pasaporte:</td>
      <td colspan="2"><input name="cedula" type="text" disabled id="cedula" value="<?php echo $cedula;?>-" size="20" maxlength="16"/></td>
      <td colspan="2"><div title="Si es menor de edad y no posee identificación, favor deje la cedula del titular y siga el correlativo del numero de hijos registrados en sistema" style="width:30px; cursor:pointer;">
					  <img src="../Imagenes/ayuda.png" width="15" height="15"/></div>
		</td>
      </tr>
    <tr>
      <td height="29">&nbsp;</td>
      <td>Primer Nombre:</td>
      <td><input name="nombre1" type="text" disabled id="nombre1" size="28" /></td>
      <td>Segundo Nombre:</td>
      <td colspan="4"><input name="nombre2" type="text" disabled id="nombre2" size="28"/></td>
      </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td>Primer Apellido:</td>
      <td><input name="apellido1" type="text" disabled id="apellido1" size="28"/></td>
      <td>Segundo Apellido:</td>
      <td colspan="4">
        <input name="apellido2" type="text" disabled id="apellido2" size="28"/>
      </td>
      </tr>
    <tr>
      <td height="34">&nbsp;</td>
      <td>Sexo:</td>
      <td><input type="radio" name="sexo" id="sexo1" value="F" disabled="disabled"><label for="sexo1">Femenino<label/>    
        <input type="radio" name="sexo" id="sexo2" value="M" disabled="disabled"><label for="sexo2">Masculino<label/>
       </td>
      <td>Fecha de Nacimiento:</td>
      <td width="72"> <input name="fecha_nac" id="fecha_nac" type="text" size="12" maxlength="10" readonly/></td>
      <td width="42"><button name="bt" id="bt" class="button" disabled="disabled" ><img src="Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
      <td width="82">    </td>
      <td width="37">&nbsp;</td>
      </tr>
    <tr>
    <td height="29">&nbsp;</td>
    <td>Celular:</td>
    <td>
        <input name="celular" type="text" disabled id="celular" size="15" maxlength="12" value="<?php echo $celular;?>"/>
      </span></td>
      <td>Teléfono:</td>
      <td colspan="4"><input name="telefono" type="text" disabled id="telefono" size="15" maxlength="12" value="<?php echo $telefono;?>"/></td>
      </tr>
        <tr>
          <td height="27">&nbsp;</td>
          <td>Parentesco:</span></td>
          <td><select name="parentesco"  id="parentesco">
            <option value="0" selected>Seleccionar</option>
            <option value="Madre">Madre</option>
            <option value="Padre">Padre</option>
            <option value="Esposa">Esposa</option>
            <option value="Esposo">Esposo</option>
            <option value="Concubinato">Concubinato</option>
            <option value="Hijo">Hijo</option>
            <option value="Hija">Hija</option>
          </select></td>
          <td>Participación</td>
          <td><input name="participacion" type="text" disabled id="participacion" size="12"/></td>
          <td><div title="Porcentaje de Poliza de Vida Ejemplo: 30%" id="test2" class="test2" style="width:30px; cursor:pointer;" ><img src="../Imagenes/ayuda.png" width="15" height="15"/></div>
			    </td>
          <td colspan="2">&nbsp;</td>
        </tr>
    <tr>
      <td height="28">&nbsp;</td>
      <td>Estado Civil:</td>
      <td><select name="estado_civ" disabled="disabled" id="estado_civ">
        <option value="0">Seleccionar</option>
        <option value="SOLTERO">Soltero</option>
        <option value="CASADO">Casado</option>
        <option value="CONCUBINATO">Concubinato</option>
        <option value="DIVORCIADO">Divorciado</option>
        <option value="VIUDO">Viudo</option>
      </select></td>
        <td>Discapacidad:</td>
      <td colspan="4" rowspan="2" valign="top"><div id="cap_dis" style="width:20px"></div>
      </td>

      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Recaudos:</td>
      <td colspan="2"><div id="recaudos"><?php 	include_once("../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('AFILIACIÓN - BENEFICIARIO');
			$consul=$recaudo->lista_recaudo();
			for($i=0;$i<count($consul);$i++)			
			{
				if($consul[$i][3]=='AFILIACIÓN - BENEFICIARIO'){					
		?>
         <input type="checkbox" name="recaudos[]" id="<?php echo $i;?>" value="<?php echo $consul[$i][1];?>" disabled="disables">
        <?php echo "<label  for='$i'>".$consul[$i][2]."</label>"; ?>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Solicitud de Medicinas. Por favor <a href='#'>click</a></div>";}			
		}?></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
</td>
      </tr>
    </table>      
</fieldset>
<table  width="686" border="0">
      <tr>
       <td width="265">&nbsp;</td>
      <td width="76"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' title="Pulse para activar los campos"/></td>
      <td width="76"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" /></td>
      <td width="265"></td>
      </tr>
  </table>
   <div id="div_listar_beneficiario"></div>
   <div id="div_oculto_beneficiario" style="display: none;"></div> 
</form>
 </div> 
</body>
</html>
