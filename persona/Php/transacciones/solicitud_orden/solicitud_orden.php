<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../../usuario/denied.php");
}
include_once("../../../Clases/clase_solicitud_orden.php");
$sOrden= new sOrden();
$compl='SO-';
$idSolicitud='0';
$res=$sOrden->buscaUltimoID();
$res=$sOrden->sig_tupla($res);
if($res){
	$idSolicitud=$res['id_solicitud']+1;
}else{
	$idSolicitud='1';
}
?><!DOCTYPE HTML>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>.:Orden Solicitud:.</title>        
  	<link rel="stylesheet" type="text/css" href="../../../Css/estilo2.css" />       
    <link rel="stylesheet" type="text/css" href="../../../Css/estilos.css" /> 	
    <link rel="stylesheet" type="text/css" href="../../../Css/border-radius.css" />
     <link href="../../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	 	
    <script language="javascript" type="text/javascript" src="../../../JavaScript/jquery-1.4.2.min.js"></script>     
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/jquery.ui.js"></script>    
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/jquery.asmselect.js"></script>	
     <script language="JavaScript" type="text/javascript" src="../../../JavaScript/sOrden_jquery.js"></script>
     <script language="JavaScript" type="text/javascript" src="../../../JavaScript/sOrden.js"></script>
     <script language="javascript" type="text/javascript" src="../../../JavaScript/jquery.alerts.js"></script> 
    <script language="JavaScript" type="text/JavaScript">	
	   $(document).ready(function(){		
		$("#organizacion").change(function(event){				
			var org=$("#organizacion option:selected").val();
			$("#medico").load('../../../Controladores/control_select_medico.php?select='+org);	
			$("#cap1").css("display","none");
			$("#cap2").css("display","block"); 
			$("#cap3").load('../../../Controladores/control_direccion_organizacion.php?select='+org);
			$("#Tipo").load('../../../Controladores/control_select_serProveedor.php?select='+org);
			
		});			
			$("#cedTitular").change(function(event){
				var cd=$("#cedTitular").val();
				$("#cap4").load('../../../Controladores/control_caja_titular.php?caja='+cd);
				$("#cap4").css("display","block");					
					$("#cap4").load('../../../Controladores/control_caja_titular.php?caja='+cd, function(event){
						if ($("#box").val() == "No existen registros relacionados") {
						$("#cap5").css("display","block");	
						$("#cap6").css("display","none");
						}else{						
						$("#beneficiario").load('../../../Controladores/control_select_beneficiario.php?select='+cd);					
						$("#cap5").css("display","none");	
						$("#cap6").css("display","block"); 	
						}
					});				
				});	 
				$("#Tipo").change(function(event){   
				
				if($("#Tipo").val()=='2'){
					$("#cap7").load('examenes_especiales.php');
					$("#bt_agregar").css("display","block");
				}
				if($("#Tipo").val()=='3'){
					$("#cap7").load('examenes_laboratorios.php');
					$("#bt_agregar").css("display","block");
				}	
				if($("#Tipo").val()=='4'){
					$("#cap7").load('examenes_imagenes.php');
					$("#bt_agregar").css("display","block");
				}	
				if($("#Tipo").val()=='5'){
					$("#cap7").load('orden_de_consulta.php');
					$("#bt_agregar").css("display","none");
				}	
				 
			});	        

	    $('#nuevo').click(function(){	
		$('#guardar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#guardar').attr('disabled', false);
		
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);		
		$('#organizacion').attr('disabled', false);
	    $('#cedTitular').attr('disabled', false);
		$('#patologia').attr('disabled', false);
		$('#Tipo').attr('disabled', false);
		$('#observacion').attr('disabled', false);
		$('input[name="recaudos[]"]').attr('disabled', false);				
    });	
	$('#Tipo').change(function(event){	
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');		
		$('#agregar').attr('disabled', false);
	});
     $('#guardar').click(function(){
		if(valida() && recuados()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);	
		$('#guardar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#guardar').attr('disabled', true);			
		$('#cedTitular').attr('disabled', true);
		$('#patologia').attr('disabled', true);
		$('#Tipo').attr('disabled', true);
		$('#observacion').attr('disabled', true);	
		$('input[name="recaudos[]"]').attr('disabled', true);						
		}
    });
    });
</script>  
<style type="text/css">
.btn_act{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; 
font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; 
outline-width:0px; background-image: url(../../../Imagen_sistema/cancelar.jpg);}
.btn_nuevo_act_img{background-image: url(../../../Imagen_sistema/nuevo.jpg);}
.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px; width: 22px; border: 0px; 
background-image: url(../../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(../../../Imagen_sistema/guardar.jpg);}
.btn_guardar_act_img3{background-image: url(../../../Imagen_sistema/add.png);}.btn_guardar_act_img2{background-image: url(../../../Imagen_sistema/guardar.jpg);}
.btn_act:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px; font-size: 13px; 
color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
.btn_guardar_desact{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; 
font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
.btn_guardar_desact:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333; border-right:1px solid #333; border-top:0px; border-left:0px; 
font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
.btn_act1{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; 
color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; 
background-image: url(../../../Imagen_sistema/cancelar.jpg);}.btn_guardar_desact1{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; 
border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand;
cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
</style>
</head>
<body> 
<div id="cuerpo">
<form action="" method="POST" id="form_orden_solicitud" name="form_orden_solicitud">
<table width="773" height="25" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="751"> <h1>Orden Médica</h1></td>
      <td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img'  title="Salir" onclick="location.href='../../../../html/blanco.html'"/></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left">Datos Principales</legend>
    <table width="760" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td >&nbsp;</td>
      <td >Fecha de Emisión:</td>
      <td colspan="2" ><input name="fecha" id="fecha" type="text" size="12" maxlength="10" readonly value="<?php date_default_timezone_set('America/Caracas'); echo date('d-m-Y') ?>"/></td>
      <td width="119" align="right"><input type="hidden" name="codHoja" id="codHoja" value="<?php echo $compl.''.$idSolicitud; ?>">
        <input name="op" type="hidden" id="op" value="iSolicitud" hidden="hidden" />
        codigo: </td>
      <td width="319" ><input name="fecha2" id="fecha2" type="text" size="8" readonly value="<?php echo $compl.''.$idSolicitud; ?>"/></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >Organización:</td>
      <td colspan="2" ><select name="organizacion" id="organizacion" disabled="disabled">
              <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
              <?php include_once("../../../Clases/clase_proveedor.php");
				$proveedor=new proveedor();
				$lista=$proveedor->lista_proveedor_ordenes();
				for($i=0;$i<count($lista);$i++)
				{
			?><option value="<?php echo $lista[$i][1];?>"><?php echo $lista[$i][2];?></option>
              <?php }?>
            </select></td>
      <td >Médico que Refiere:</td>
      <td > <div id="cap1" style="color:#FF0000; display:block; width:180px;">*Por favor elija Organizacion</div>
          <div id="cap2" style="display: none;">
          		<select name="medico" id="medico" >
                <option value="0" selected="selected" disabled="disabled">Seleccionar </option></select>
     	  </div></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >Dirección:</td>
      <td colspan="4" ><div id="cap3"><textarea name="direccion" id="direccion" cols="45" rows="2" readonly></textarea></div></td>
      </tr>
    <tr>
      <td >&nbsp;</td>
      <td >Nro. C.I titular:</td>
      <td width="106" ><input name="cedTitular" type="text" disabled id="cedTitular" size="16" title="Ejemplo: 20643089, Si la C.I es menor a ocho (8) dígitos complete con ceros (0) a la izquierda Ejemplo: 08042667" /></td>
      <td colspan="3" ><div id="cap4" style="color:#FF0000; display:block; width:200px;"><input name="vacio" type="text" id="box" size="45" readonly /></div></td>
      </tr>
    <tr>
      <td width="11" >&nbsp;</td>
      <td width="113" >Beneficiario:</td>
      <td colspan="4" ><div id="cap5" style="color:#FF0000; display:block; width:200px;">*Por favor seleccione un titular</div><div id="cap6" style="display: none; "><select name="beneficiario" id="beneficiario" >
        <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
      </select></div></td>
      </tr>
    <tr>
      <td >&nbsp;</td>
      <td >Patología:</td>
      <td colspan="3" ><select name="patologia" id="patologia" disabled="disabled">
        <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
        <?php include_once("../../../Clases/clase_patologia.php");
				$patologia=new patologia();
				$lista=$patologia->lista_patologia();
				for($i=0;$i<count($lista);$i++)
				{
			?>
        <option value="<?php echo $lista[$i][1];?>"><?php echo $lista[$i][2];?></option>
        <?php }?>
      </select></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td >&nbsp;</td>
      <td >Tipor de Orden:</td>
      <td colspan="3" ><select name="Tipo" disabled id="Tipo" >  

      <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
      </select></td>
      <td>&nbsp;</td>
      </tr>
    </table>
    
    
    </fieldset>
     <fieldset> 
      <legend align="left">Detalle de la orden medica </legend>
     <div id="cap7"></div>
    </fieldset>
     <table  width="770" border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td width="297">&nbsp;</td>
         <td width="96"><div id="bt_agregar" style="display:block">
           <input name="agregar" type="button" id="agregar" value="Agregar"disabled="disabled" title="Agregar un servicio"class='btn_guardar_desact btn_guardar_act_img3'  onclick="if(!crear(this)){return false;}" /></div>
         </td>
         <td width="377">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="4"><div id="ocultar" style="display:none; text-align:center;">
           <fieldset><input id="marco2" type="text" size="64" value=" Descripción de Medicamento " style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco2" id="marco2" type="text" size="9" value=" Cantidad " style=" background:#E1F0FF; text-align:center;" readonly/><div id="capa_datos"></div>
           </fieldset>
         </div></td>
       </tr>
     </table>
    <fieldset>  
    <legend align="left">Area de Observaciones</legend>   
    <table width="761" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="46">&nbsp;</td>
      <td width="87" height="24">Obsevación:</td>
      <td width="478">
        <textarea name="observacion" cols="50" rows="2" disabled id="observacion"></textarea>
      </td>
      <td width="150">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Recaudos:</td>
      <td colspan="2"><?php 	include_once("../../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('ORDEN MEDICA');
			$consul=$recaudo->lista_recaudo();
			for($i=0;$i<count($consul);$i++)			
			{
			if($consul[$i][3]=='ORDEN MEDICA'){					
		?>
          <input type="checkbox" name="recaudos[]" id="<?php echo $i;?>" value="<?php echo $consul[$i][1];?>" disabled="disabled">
        <?php echo "<label  for='$i'>".ucfirst(strtolower($consul[$i][2]))."</label>"; ?><br>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Solicitud de Medicinas. Por favor <a href='#'>click</a></div>";}			
		}?></td>
      </tr>
     
    </table>
   </fieldset>
   <table  width="773" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="348" align="right"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' onclick="limpiar_form(this.form)" title="Pulse para activar campos"/></td>
      <td width="425"><input name="guardar" type="submit" class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="guardar" onClick="if(!recuados()){return false;}"  value=" Guardar" />
      </td>
      </tr>
  </table>  
</form>
</div>
<script language="javascript" type="text/javascript">
function recuados(){
	if($("#Tipo").val()=='0'){	
			$('#Tipo').focus();
			return false;	
	}
	if($("#Tipo").val()=='C'){
		if($('#motivo').val().length < 1){
			jAlert('El campo  "motivo"  no puede estar vacio','Dialogo de Alerta');
			$('#motivo').focus();
			return false;	
		}
		if($('#diagnostico').val().length < 1){
			jAlert('El campo  "diagnostico"  no puede estar vacio','Dialogo de Alerta');
			$('#diagnostico').focus();
			return false;	
		}
	}else{
		if(icremento=='1'){	
			 jAlert("Debe ingresar al menos un detalle!"); 
			 $('#Tipo').focus(); 
			  return false;	
		}  		
	}
	
	if($('input[name="recaudos[]"]').is(':checked')) 	
	{ } 
	else {  
          jAlert("Debe seleccionar los recuados!");  
          return false;	  
     	}	
	return true;
}
	function fn_agregar(){
		var str = $("#form_orden_solicitud").serialize();
		$.ajax({
			url: '../../../Controladores/controlador_solicitud_orden.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data!=""){
				if(confirm(data)){	
					abreVentana();
					location.reload();						
					}else{
					location.reload();
					}
				}
			}
		});
	};	
var miPopup=0;
function abreVentana(ancho,alto){ 
	var posicion_x; 
	var posicion_y; 
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/4); 
    miPopup = window.open("../../../Controladores/controlador_solicitud_orden_PDF.php?cd="+$("#cedTitular").val(),"miwin","width=800px,height=800px,scrollbars=yes,resizable=yes,left="+posicion_x+",top="+posicion_y+""); 
    miPopup.focus();
} 
</script>

</body>

</html>
