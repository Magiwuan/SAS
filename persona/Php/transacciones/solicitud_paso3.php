<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
include_once("../../Clases/clase_solicitud_medicina.php");
include_once("../../Clases/clase_solicitud_orden.php");
 $sMedicina= new sMedicina(); 
 $cod=$_GET['id'];
 $sMedicina->setcodHoja($cod);
 $resp=$sMedicina->buscar_solicitud(); 
 if($resp){
	 $resul=$sMedicina->sig_tupla($resp);	
	 if($resul['ced_autorizado']!=0){
		 $autorizado=$resul['ced_autorizado'];
	 }else{
		 $autorizado='';
	 }	 
	 	$elDia=substr($resul['fecha'],8,2);
		$elMes=substr($resul['fecha'],5,2);
		$elYear=substr($resul['fecha'],0,4);
		$fecha=$elDia."-".$elMes."-".$elYear;	
		if($resul['tratamiento']=='P'){
		$elDia=substr($resul['fecha_ini'],8,2);
		$elMes=substr($resul['fecha_ini'],5,2);
		$elYear=substr($resul['fecha_ini'],0,4);
		$fecha_ini=$elDia."-".$elMes."-".$elYear;	
		$elDia=substr($resul['fecha_fin'],8,2);
		$elMes=substr($resul['fecha_fin'],5,2);
		$elYear=substr($resul['fecha_fin'],0,4);
		$fecha_fin=$elDia."-".$elMes."-".$elYear;
		} 
?><!DOCTYPE html>
<html lang="es">
  <head>
    <title>.:Aprobar Solicitud:.</title>    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
  	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />       
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" /> 
    <link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />	
    <link rel="stylesheet" type="text/css" href="../../JavaScript/jquery.alerts.css"/>	
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.8.2.min.js"></script>            
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>
    <script src="../../JavaScript/solicitud_medicina.js"></script> 
    <script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){
		  $('input[name="monto[]"]').change(function(event){            
			    var amt = parseFloat(this.value);
                $(this).val('Bs ' + amt.toFixed(2));    			
        });
		 $('input[name="monto"]').change(function(event){            
			    var amt = parseFloat(this.value);
                $(this).val('Bs ' + amt.toFixed(2));    			
        });
		$('input[name="nroFactura[]"]').blur(function(event){  
		jConfirm('Aplicar misma factura a todos?', 'Mensaje Confirmación', function(r) {
					if(r==true){		
						var arr=  $('input[name="nroFactura[]"]').val();       
							 jQuery.each( arr, function( ) {
								   $('input[name="nroFactura[]"]').val(arr);				 
							});
					}
					});	
		
        });
		});
	</script> 
<script language="javascript" type="text/javascript">   
var nav4 = window.Event ? true : false;
function IsNumber(evt){
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}

 var nav = window.Event ? true : false;
function isInteger(evt){
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57));
}
</script>  
</head>
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
	  background-image: url(../../Imagen_sistema/guardar.jpg);
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
.btn_act1 {  height: 23px; 
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
  background-image: url(Imagen_sistema/cancelar.jpg);
}
</style>
<body>
<form action="javascript: fn_agregar();" method="POST" id="form_solicitud_medicina" name="form_solicitud_medicina">
<table width="790" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="785"><h1>Finalizar Solicitud</h1></td>
      <td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onclick="location.href='../../../html/blanco2.html'"/></td>
    </tr>
  </table>
<fieldset>
 <legend align="left">Datos Principales</legend>
 <table width="770" border="0"  cellpadding="0" cellspacing="0" >
 <tr>
   <td>
   <table width="770" border="0"  cellpadding="0" cellspacing="0">
     <tr>
       <td width="4" rowspan="11"></td>
       <td width="131">Código:</td>
       <td width="105"><input name="codigo" type="text" disabled id="codigo" size="16" maxlength="12" value="<?php echo $resul['cod_hoja']; ?>" /></td>
       <td align="right">Fecha de emisión:</td>
       <td colspan="4"><input name="fecha" type="text" disabled id="fecha" value="<?php echo $fecha; ?>" size="14" maxlength="10" /></td>
       </tr>
     <tr>
       <td>Nro. C.I titular:</td>
       <td><input name="cedTitular" type="text" id="cedTitular" value="<?php echo $resul['nacionalidad'];?>-<?php echo $resul['cedula'];?>" size="16" readonly /></td>
       <td colspan="4"><input name="vacio" type="text" disabled id="box" value="<?php echo $resul['apellido1'];?> <?php echo $resul['apellido2'];?>, <?php echo $resul['nombre1'];?> <?php echo $resul['nombre2'];?>" size="45" /></td>
     </tr>
     <tr>
       <td height="20">Beneficiario:</td>
       <td colspan="5"><?php if($resul['id_beneficiario']=='0'){
      	echo '<input name="beneficiario" type="text" id="beneficiario" size="45" readonly value="Mismo Titular" />';
			echo '<input name="idTitular" type="hidden" id="id" size="6" value="'.$resul['id_titular'].'" />';
         }else{
		echo '<input name="idBeneficiario" type="hidden" id="id" size="6" value="'.$resul['id_beneficiario'].'" />';
		$sMedicina->setidBeneficiario($resul["id_beneficiario"]);
		$consulta_B=$sMedicina->consultar_beneficiario();
		$consulta_B=$sMedicina->sig_tupla($consulta_B);		
		echo '<input name="beneficiario" type="text" id="beneficiario" size="45" readonly value="'.$consulta_B['apellido1'].' '.$consulta_B['apellido2'].', '.$consulta_B['nombre1'].' '.$consulta_B['nombre2'].' '.$consulta_B['nacionalidad'].'-'.$consulta_B['cedula'].'" />';
		 }		 
		 ?></td>
     </tr>
     <tr>
       <td>Autorizado a retirar:</td>
       <td colspan="2"><input name="nombAutorizado" type="text" disabled id="nombAutorizado" value="<?php echo $resul['autorizado'];?>" size="45" /></td>
       <td width="115" align="right">Nro. Cédula:</td>
       <td colspan="2"><input name="cedAutorizado" type="text" disabled id="cedAutorizado" value="<?php echo $autorizado;?>" size="16" /></td>
     </tr>
     <tr>
       <td height="29">Proveedor:</td>
       <td colspan="5"><input name="farmacia" type="text" disabled id="farmacia" value="<?php echo $resul['alias'].' - '.$resul['organizacion']; ?>" size="50" /></td>
     </tr>
     <tr>
       <td>Rif Organización:</td>
       <td colspan="5"><input name="cedAutorizado2" type="text" disabled id="cedAutorizado2" value="<?php echo $resul['rif'];?>" size="16" />
         <?php if($resul['id_medico']!=''){
		  $sOrden= new sOrden();
		  $sOrden->setidMedico($resul['id_medico']);
		  $med=$sOrden->buscar_medico();
		  $med=$sOrden->sig_tupla($med);	
		  echo' Médico: <input name="idBeneficiario" type="text" id="id" size="60" value="'.$med['nacionalidad'].'-'.$med['cedula'].' '.$med['nombre'].' '.$med['apellido'].' - '.$med['especialidad'].' " readonly="readonly" />';  
	  } ?></td>
     </tr>
     <tr>
       <td>Dirección:</td>
       <td colspan="5"><textarea name="direccion" cols="45" rows="2" disabled id="direccion"><?php echo $resul['direccion'];?></textarea></td>
     </tr>
     <tr>
       <td>Tratamiento:</td>
       <td><input type="radio" name="tratamiento" id="tratamiento1" value="T" <?php if($resul['tratamiento']=='T') echo "checked=\"checked\""?> disabled="disabled" >
         Temporal</td>
       <td width="154"><input type="radio" name="tratamiento" id="tratamiento2" value="P" <?php if($resul['tratamiento']=='P') echo "checked=\"checked\""?> disabled="disabled" >
         Permanente</td>
       <td colspan="2">Desde:<input name="fecha_ini" type="text" disabled id="fecha_ini" value="<?php echo $fecha_ini?>" size="12" maxlength="10" /></td>
       <td width="241">Hasta:<input name="fecha_fin" type="text" disabled id="fecha_fin" value="<?php echo $fecha_fin?>" size="12" maxlength="10" /></td>
       ></tr>
     <tr>
       <td height="25">Patología:</td>
       <td colspan="2"><input name="patologia" type="text" disabled id="patologia" value="<?php echo $resul['patologia'];?>" size="22" /></td>
       <td height="25" colspan="3"><?php if($resul['id_servicio']!=1){echo  "<div style='color:#F00'>*Nota: El Tratamiento aplica solo para solicitud de medicina.</div>";} ?></td>
     </tr>
     <tr height="5">
       <td height="5" colspan="6"><input type="hidden" name="idSolicitud" value="<?php echo $resul['id_solicitud']; ?>">
         <input name="ope" type="hidden" id="ope" value="mMedicina" hidden="hidden" />
         <input name="op" type="hidden" id="op" value="mSolicitud" hidden="hidden" />
         <input type="hidden" name="idServicio" id="idServicio" value="<?php echo $resul['id_servicio'];?>"></td>
     </tr>
   </table></td>
 </tr>
 </table>
</fieldset>   
<fieldset>       
<legend align="left"><?php if($resul['id_servicio']!='1'){ echo 'Detalle de orden Medica'; }else{ echo 'Detalle de Medicamentos';}?></legend> 
<table width="770" border="0"  cellpadding="0" cellspacing="0" title="Indicar Nro. de Factura, Nro. de Contro y el Monto.">
<tr>
<td width="770">&nbsp;</td>
</tr>
<tr>
<td width="770"> 
<div id="capa_datos" style="margin:auto; border: none; text-align:center; padding:2px; width:760px;"> 
 <?php
$sMedicina->setidSolicitud($resul['id_solicitud']);
$detalle=$sMedicina->detalle_SM();
if($detalle=='-1'){				
	$sOrden= new sOrden();
	$sOrden->settipoServicio($resul['id_servicio']);
	$sOrden->setidSolicitud($resul['id_solicitud']);
	$detalle=$sOrden->detalle_SM_1();
?><input id="marco" type="text" size="<?php if($resul['id_servicio']!='5'){ echo '30'; }else{ echo '37';}?>" value="<?php if($resul['id_servicio']!='5'){ echo 'Examen'; }else{ echo 'Motivo de la consulta';}?>" style=" background:#E1F0FF; text-align:center;" readonly/><input id="marco" type="text" size="<?php if($resul['id_servicio']!='5'){ echo '40'; }else{ echo '48';}?>" value="<?php if($resul['id_servicio']!='5'){ echo 'Descripcion del Examen'; }else{ echo 'Diagnostico';}?>" style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="4" value="Cant." style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="11" value="Nro. Factura" style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="9" value="Nro. Control" style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="8" value="Monto3" style=" background:#E1F0FF; text-align:center;" readonly/>
<?
if($resul['id_servicio']!='5'){
	for($i=0;$i<count($detalle);$i++){
		echo '<input name="campo" type="text" id="campo" size="30" readonly value="'.$detalle[$i][4].'"/>';	
		echo '<input name="descripcion" type="text" id="descripcion" size="40" readonly value=" '.$detalle[$i][1].'" />';					
		echo '<input name="cantidad" type="text" id="cantidad" size="4" readonly value=" '.$detalle[$i][2].'" />';
		echo '<input name="idCampo" type="hidden" id="idCampo" value="'.$detalle[$i][3].'" />';
		echo '<input name="nroFactura" type="text" id="nroFactura" onkeypress="return isInteger(event);" size="11" maxlength="11"  />';
		echo '<input name="nroControl" type="text" id="nroControl" onkeypress="return isInteger(event);" size="9" maxlength="11"  />';
		echo '<input name="monto" type="text" id="monto" onkeypress="return IsNumber(event);" size="8" maxlength="11"  />';
	}					
}else{
	for($i=0;$i<count($detalle);$i++){
		echo '<input name="motivo" type="text" id="motivo" size="37" readonly value=" '.$detalle[$i][2].'" />';	
		echo '<input name="diagnostico" type="text" id="diagnostico" size="48" readonly value=" '.$detalle[$i][3].'" />';
		echo '<input name="cantidad" type="text" id="cantidad" size="4" readonly value=" '.$detalle[$i][1].'" />';							
		echo '<input name="nroFactura" type="text" id="nroFactura" onkeypress="return isInteger(event);" size="12" maxlength="11"  />';
		echo '<input name="nroControl" type="text" id="nroControl" onkeypress="return isInteger(event);" size="12" maxlength="11"  />';
		echo '<input name="monto" type="text" id="monto" onkeypress="return IsNumber(event);" size="12" maxlength="11"  />';			
	}
}				
}else{
?><input id="marco" type="text" size="44" value="Descripcion del Medicamento" style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="6" value="Cant." style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="12" value="Nro. Factura" style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="12" value="Nro. Control" style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="12" value="Monto2" style=" background:#E1F0FF; text-align:center;" readonly/><?
	for($i=0;$i<count($detalle);$i++){				
	echo '<input name="medicamento[]" type="text" id="medicamento" size="44" readonly value=" '. $detalle[$i][1].'" />';				
	echo '<input name="cantidad[]" type="text" id="cantidad" size="6" readonly value=" '. $detalle[$i][2].'" />';
	echo '<input name="idMedicamento[]" type="hidden" id="id" size="6" value="'.$detalle[$i][3].'" />';
	echo '<input name="nroFactura[]" type="text" id="nroFactura" onkeypress="return isInteger(event);" size="12" maxlength="11"  />';
	echo '<input name="nroControl[]" type="text" id="nroControl" onkeypress="return isInteger(event);" size="12" maxlength="11"  />';
	echo '<input name="monto[]" type="text" id="monto" onkeypress="return IsNumber(event);" size="12" maxlength="11" />';				
	}	
}
?></div>  
</td>
</tr>
<tr>
<td width="770">&nbsp;</td>
</tr>
</table>        
</fieldset>
<fieldset>  
<legend align="left">Area de Observaciones</legend>   
<table width="770" border="0"  cellpadding="0" cellspacing="0">
 <tr height="5">
 <td width="41" rowspan="4">&nbsp;</td>
 <td height="5" colspan="3">&nbsp;</td>
 </tr>
 <tr>
 <td width="85">Obsevación:</td>
  <td width="644"><textarea name="observacion" cols="70" rows="2" disabled id="observacion" ><?php echo $resul['observacion'];?> </textarea>
  </td>
  </tr>
  <tr>
  <td>Recaudos:</td>
   <td colspan="2">
  <?php 	
  include_once("../../Clases/clase_recaudo.php");
	$recaudo= new recaudos();	
	if($resul['id_servicio']=='1'){
		$var='SOLICITUD - MÉDICINAS';
	}else{
		$var='REEMBOLSOS';
	}
	$recaudo->setTiporecaudo($var);
	$consul=$recaudo->lista_recaudo();
	$rsp=$sMedicina->buscar_reacudos_solicitud();
	for($i=0;$i<count($consul);$i++)			
	{				
		if($consul[$i][3]==$var){					
		?><input type="checkbox" name="recaudos[]" id="checkbox" value="<?php echo $consul[$i][1];?>" disabled="disabled"        
           <?php 
               for($x=0;$x<count($rsp);$x++){	                              
                    if ($consul[$i][1]==$rsp[$x][1]){echo "checked=\"checked\"";}
               }?>
        ><?php echo $consul[$i][2].'<br />';?>
        <?php		
				}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Solicitud de Medicinas. Por favor <a href='#'>click</a></div>";}			
		}?></td>
</tr>  
<tr height="5">
<td height="5" colspan="3">&nbsp;</td>
</tr>   
</table>
</fieldset>
<table  width="790" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="310">&nbsp;</td>
<td width="460" ><input name="guardar" type="submit" id="guardar" class='btn_act btn_nuevo_act_img' value="Guardar" onClick="if(!valMonto()){return false};" /></td>
</tr>
</table>  
</form>
<script language="javascript" type="text/javascript">
function valMonto(){
	var m=$('#monto').val();
	if(m==''){
		jAlert('El campo  "Monto"  no puede estar vacio','Dialogo de Alerta');
		$('#monto').focus();
		return false;	
	}
	var checkOK="Bs "+"123456789.00";
	var checkStr=$('#monto').val();
	var allValid=true; 
	for(i=0;i<checkStr.length;i++){
		ch = checkStr.charAt(i); 
		for(j=0;j<checkOK.length;j++)
			if(ch==checkOK.charAt(j))
				break;
			if(j==checkOK.length){ 
  			allValid=false; 
  			break; 
			}
	}
	if(!allValid){ 
		jAlert('El campo \"Monto\" es incorrecto. Ej: Bs 000000.00','Dialogo de Alerta');
		$('#monto').val()='';  
		$('#monto').focus(); 
		return false; 
	} 
	 return true;
	 
	}	 	
function fn_agregar(){
var str = $("#form_solicitud_medicina").serialize();
	$.ajax({
	url: '<?php if($resul['id_servicio']=='1'){ echo "../../Controladores/controlador_solicitud_medicina.php"; }else{ echo "../../Controladores/controlador_solicitud_orden";}?>',
	data: str,
	type: 'post',
	success: function(data){
			jAlert(data);		
	}
	});
};	
<?php }?>
</script>
</body>
</html>
