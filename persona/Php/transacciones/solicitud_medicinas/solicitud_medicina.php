<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../../usuario/denied.php");
}

include_once("../../../Clases/clase_solicitud_medicina.php");
$sMedicina= new sMedicina();
$res=$sMedicina->buscaUltimoID();
$res=$sMedicina->sig_tupla($res);
$compl='SM-';
$idSolicitud='0';
if($res){
	$idSolicitud=$res['id_solicitud']+1;
}else{
	$idSolicitud='1';
}
?><!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Solicitud de Medicinas:.</title>        
<link rel="stylesheet" type="text/css" href="../../../Css/estilo2.css" />       
<link rel="stylesheet" type="text/css" href="../../../Css/estilos.css" /> 
<link rel="stylesheet" type="text/css" href="../../../Css/jscal2.css" />

<link href="../../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	        
<script src="../../../JavaScript/solicitud_medicamentos.js"></script>        

<script language="javascript" type="text/javascript" src="../../../JavaScript/jquery-1.4.2.min.js"></script>    
<script language="javascript" type="text/javascript" src="../../../JavaScript/jquery.alerts.js"></script>     
<script language="javascript" type="text/javascript" src="../../../JavaScript/jscal2.js"></script>    
<script language="javascript" type="text/javascript" src="../../../JavaScript/es.js"></script> 

  <link type="text/css" rel="stylesheet" href="../jquery/themes/base/jquery.ui.theme.css" />
  <link type="text/css" rel="stylesheet" href="../jquery/themes/base/jquery.ui.autocomplete.css" />	
  <script type="text/javascript" src="../jquery/ui/jquery.ui.core.js"></script>
  <script type="text/javascript" src="../jquery/ui/jquery.ui.widget.js"></script>
  <script type="text/javascript" src="../jquery/ui/jquery.ui.position.js"></script>
  <script type="text/javascript" src="../jquery/ui/jquery.ui.autocomplete.js"></script>
<script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){		
		$('#nuevo').click(function(){				
		$('#guardar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#guardar').attr('disabled', false);
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);		
		$('#organizacion').attr('disabled', false);
	    $('#cedTitular').attr('disabled', false);
		$('#beneficiario').attr('disabled', false);
		$('#nombAutorizado').attr('disabled', false);
		$('#cedAutorizado').attr('disabled', false);
		$('#tratamiento1').attr('disabled', false);
		$('#tratamiento2').attr('disabled', false);
		$('#patologia').attr('disabled', false);
		$('#medicamento').attr('disabled', false);
		$('#cantidad').attr('disabled', false);
		$('#observacion').attr('disabled', false);
		$('input[name="recaudos[]"]').attr('disabled', false);				
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
		$('#organizacion').attr('disabled', true);
	    $('#cedTitular').attr('disabled', true);
		$('#beneficiario').attr('disabled', true);
		$('#nombAutorizado').attr('disabled', true);
		$('#cedAutorizado').attr('disabled', true);
		$('#tratamiento1').attr('disabled', true);
		$('#tratamiento2').attr('disabled', true);
		$('#patologia').attr('disabled', true);
		$('#medicamento').attr('disabled', true);
		$('#cantidad').attr('disabled', true);
		$('#observacion').attr('disabled', true);
		$('input[name="recaudos[]"]').attr('disabled', true);
		}
    });			   	  
	$("#organizacion").change(function(event){
		$("#cap4").load('../../../Controladores/control_direccion_organizacion.php?select='+$("#organizacion").val());
		});	
	$("#cedTitular").change(function(event){
		$("#cap3").load('../../../Controladores/control_caja_titular.php?caja='+$("#cedTitular").val());
			$("#cap3").css("display","block");					
			$("#cap3").load('../../../Controladores/control_caja_titular.php?caja='+$("#cedTitular").val(), function(event){
			if ($("#box").val() == "No existen registros relacionados") {
				$("#cap1").css("display","block");	
				$("#cap2").css("display","none");
			}else{						
				$("#beneficiario").load('../../../Controladores/control_select_beneficiario.php?select='+$("#cedTitular").val());					
				$("#cap1").css("display","none");	
				$("#cap2").css("display","block"); 	
			}
		});				
	});	             
	$('#tratamiento2').click(function(){
		$('#boton_fec_ini').attr('disabled', false);
		$('#boton_fec_fin').attr('disabled', false);
	});
	$('#tratamiento1').click(function(){
		$('#boton_fec_ini').attr('disabled', true);
		$('#boton_fec_fin').attr('disabled', true);
		$('#fecha_ini').val('');
		$('#fecha_fin').val('');
	});	
});	

var icremento =1;
function crear(obj) {
	if(icremento>5){
		$("#capa_datos").css({			     	   
			   	"margin": "auto",
				"text-align":"center",
				"width": "auto",
				"height": "124px",		
				"padding": "2px",
				"border-radius": "4px",
				"overflow": "auto"
			})
	}	
	if($('#medicamento').val()=='Buscar Medicinas' || $('#medicamento').val().length < 1){
		jAlert('El campo "Medicamentos" no puede estar vacio!','Dialogo de Alerta');
		$('#medicamento').focus();
		return false;
	} 
	var d=$('#cantidad').val();
	 if (!/^([0-9])*$/.test(d)){
		jAlert('El campo "Cantidad" admite solo números!','Dialogo de Alerta');
		$('#cantidad').focus();
		return false;
	 }
	if(d==''){
		jAlert('El campo "Cantidad" no puede estar vacio!','Dialogo de Alerta');
		$('#cantidad').focus();
		return false;
	} 	
	var medicamento = document.getElementById('medicamento').value;  	
//para validar que no repita el medicamento en el arreglo.
	for(var i=0;i<document.getElementsByName('medicamento[]').length;i++)
	{			 					
		if (document.getElementsByName('medicamento[]')[i].value==medicamento){
			jAlert('Estas intentando enviar un medicamento con caracteristicas iguales.\nVerifica los datos!');
			return false;
		}				  
	}	
  field = document.getElementById('capa_datos'); 
  contenedor = document.createElement('div'); 
  contenedor.id = 'div'+icremento; 
  field.appendChild(contenedor); 
//Medicamento nombre
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'medicamento'+'[]';
  boton.vAlign= "middle";
  boton.id ='med';
  boton.value =  document.getElementById('medicamento').value;    
  boton.readOnly = true;
  boton.size='65';
  contenedor.appendChild(boton); 
//cantidad Campo de texto
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'cantidad'+'[]';
  boton.id = 'cant';
  boton.vAlign= "middle";
  boton.value =  document.getElementById('cantidad').value;
  boton.readOnly = true;
  boton.size='4';
  contenedor.appendChild(boton); 
//Boton de borrado 
  boton = document.createElement('input');
  boton.vAlign= "middle";
  boton.type = 'image'; 
  boton.width= '15';
  boton.height= '15';
  boton.src = "../../../Imagen_sistema/delete.png";
  boton.name = 'div'+icremento;   
  boton.onclick = function () {borrar(this.name)} 
  contenedor.appendChild(boton); 
  icremento++;    
$("#ocultar").css("display", "block");
return true;	
}
//funcion para borrar los objetos creados.
function borrar(obj) {	
  field = document.getElementById('capa_datos'); 
  field.removeChild(document.getElementById(obj));    
  icremento--; 
   if(icremento==1){
	  $("#ocultar").css("display", "none");	
  }
  return true;
}
 $(function() {       
        $("#medicamento").autocomplete({
            source: "completar_medicinas.php"
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
<form action="" method="POST" id="form_solicitud_medicina" name="form_solicitud_medicina">
<table width="779" height="25" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="757"> <h1>Solicitud de Medicinas</h1></td>
      <td width="22" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img'   onclick="location.href='../../../../html/blanco2.html'"title="Salir"/></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left">Datos Principales</legend>
    <table width="757" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td>&nbsp;</td>
      <td>Código:</td>
      <td><input name="fecha2" id="fecha2" type="text" size="8" readonly value="<?php echo $compl.''.$idSolicitud; ?>"/></td>
      <td colspan="5"><input type="hidden" name="codHoja" id="codHoja" value="<?php echo $compl.''.$idSolicitud; ?>"></td>
      </tr>
    <tr>
      <td width="24">&nbsp;</td>
      <td width="118">Fecha de emisión:</td>
      <td width="103"><input name="fecha" id="fecha" type="text" size="14" maxlength="10" value="<?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y"); ?>" readonly /></td>
      <td colspan="5">&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nro. C.I titular:</td>
      <td><input name="cedTitular" type="text" disabled id="cedTitular" title="Ejemplo: 20643089, Si la C.I es menor a ocho (8) dígitos complete con ceros (0) a la izquierda Ejemplo: 08042667" size="16" /></td>
      <td colspan="5"><div id="cap3" ><input name="vacio" type="text" id="box" size="45" readonly title="Nombre del Titular" /></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="23">Beneficiario:</td>
      <td colspan="6"><div id="cap1" style="color:#FF0000; display:block; width:"200" ">*Por favor seleccione un titular</div><div id="cap2" style="display: none; "><select name="beneficiario" id="beneficiario" title="Grupo Familiar" >
        <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
      </select></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Autoriza a retirar:</td>
      <td colspan="2"><input name="nombAutorizado" type="text" disabled id="nombAutorizado" title="Nombre de la persona autorizada a retirar medicamento" size="35" /></td>
      <td width="83">Nro. Cedula:</td>
      <td colspan="3"><input name="cedAutorizado" type="text" disabled id="cedAutorizado" title="Cedula del Autorizado" size="16" />
        <input name="ope" type="hidden" id="ope" value="iMedicina" hidden="hidden" /></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Farmacia:</td>
      <td colspan="6"><select name="organizacion" id="organizacion" disabled="disabled">
              <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
              <?php include_once("../../../Clases/clase_proveedor.php");
				$proveedor=new proveedor();
				$lista=$proveedor->lista_proveedor_medicinas();
				for($i=0;$i<count($lista);$i++)
				{
			?><option value="<?php echo $lista[$i][1];?>"><?php echo $lista[$i][2];?></option>
              <?php }?>
            </select></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Dirección:</td>
      <td colspan="6"><div id="cap4"><textarea name="direccion" id="direccion" cols="45" rows="2" readonly></textarea></div></td>     
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tratamiento:</td>
      <td><input type="radio" name="tratamiento" id="tratamiento1" value="T" disabled="disabled" ><label for="tratamiento1">Temporal</label></td>
      <td width="118"><input type="radio" name="tratamiento" id="tratamiento2" value="P" title="Debe indicar fecha" disabled="disabled"  ><label for="tratamiento2">Permanente</label></td>
      <td>Desde:        
        <input name="fecha_ini" id="fecha_ini" type="text" size="12" maxlength="10" readonly title="Fecha de inicio"/></td>
      <td width="42" valign="bottom"><button name="boton_fec_ini" id="boton_fec_ini" class="button" disabled="disabled"  ><img src="../../../Imagen_sistema/calend.png" width="20" height="20" /></button><script type="text/javascript">
      	Calendar.setup({
		inputField : "fecha_ini",
		dateFormat: "%d-%m-%Y",
		trigger    : "boton_fec_ini",
		onSelect   : function() { this.hide() },
      	});    
	</script><td width="74">Hasta: 
<input name="fecha_fin" id="fecha_fin" type="text" size="12" maxlength="10" readonly title="Fecha de fin"/></td>
      <td width="170" valign="bottom"><button name="boton_fec_fin" id="boton_fec_fin" class="button" disabled="disabled" ><img src="../../../Imagen_sistema/calend.png" width="20" height="20" /></button><script type="text/javascript">
      	Calendar.setup({
		inputField : "fecha_fin",
		dateFormat: "%d-%m-%Y",
		trigger    : "boton_fec_fin",
		onSelect   : function() { this.hide() },
      	});    
	</script></tr>
    <tr>
      <td>&nbsp;</td>
      <td height="28">Patología:</td>
      <td colspan="6"><select name="patologia" id="patologia" title="Estudio" disabled="disabled">
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
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="6">&nbsp;</td>
    </tr>
    </table>   
    </fieldset>
     <fieldset> 
      <legend align="left">Detalle de Medicamentos</legend>   
     <table width="738" border="0">   
    <tr>
      <td width="47">&nbsp;</td>
      <td width="93">Medicamentos:</td>
      <td width="257"><input style="color:#909090" name="medicamento" id="medicamento" disabled="disabled" size="40"  type="text" value="Buscar Medicinas" onfocus = "if(this.value=='Buscar Medicinas') {this.value=''; this.style.color='#000'}" onblur="if(this.value==''){this.value='Buscar Medicinas'; this.style.color='#909090'}" onClick="if(this.value!=''){this.value=''; this.style.color='#000'} "/></td>
      <td width="70">Cantidad:</td>
      <td width="159"><input name="cantidad" type="text" disabled="disabled" id="cantidad" size="20"  /></td>
      <td width="86">&nbsp;</td>
    </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>       
     </tr>
  </table></fieldset>
  <table  width="747" border="0">
      <tr>
      <td width="296">&nbsp;</td>
      <td width="96"> <input name="agregar" type="button" id="agregar" value="Agregar"disabled="disabled" title="Agregar un servicio"class='btn_guardar_desact btn_guardar_act_img3'  onclick="if(!crear(this)){return false;}" />
      </td>
      <td width="341">&nbsp;</td>
      </tr>
      <tr>
       <td colspan="4"><div id="ocultar" style="display:none; text-align:center;"><fieldset><input id="marco" type="text" size="64" value=" Descripci&oacute;n de Medicamento " style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="9" value=" Cantidad " style=" background:#E1F0FF; text-align:center;" readonly/><div id="capa_datos"></div>
  </fieldset></div></td>
      </tr>
  </table>
  <fieldset>  
    <legend align="left">Area de Observaciones</legend>   
    <table width="739" border="0">
    <tr>
      <td width="2">&nbsp;</td>
      <td width="99" height="24">Obsevación:</td>
      <td width="531"><span>
        <textarea name="observacion" cols="50" rows="2" disabled id="observacion" ></textarea>
      </span></td>
      <td width="89">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Recaudos:</td>
      <td colspan="2"><?php 	include_once("../../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('SOLICITUD - MÉDICINAS');
			$consul=$recaudo->lista_recaudo();
			for($i=0;$i<count($consul);$i++)			
			{
			if($consul[$i][3]=='SOLICITUD - MÉDICINAS'){					
		?>  <input type="checkbox" name="recaudos[]" id="<?php echo $i;?>" value="<?php echo $consul[$i][1];?>" disabled="disabled">
        <?php echo "<label  for='$i'>".$consul[$i][2]."</label>"; ?><br>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Solicitud de Medicinas. Por favor <a href='#'>click</a></div>";}			
		}?></td>
      </tr>     
    </table>
   </fieldset>
   <table  width="746" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="357" align="right"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' onclick="limpiar_form(this.form)" title="Pulse para activar campos"/></td>
      <td width="389" ><input name="guardar" type="submit" class='btn_guardar_desact btn_guardar_act_img' id="guardar" disabled="disabled"  value=" Guardar" title="Guardar" onClick="if(!recuados()){return false;}"  /></td>
      </tr>
  </table>  
</form>
</div>
<script language="javascript" type="text/javascript">
function recuados(){
	if(icremento=='1'){
		 jAlert("Debe ingresar al menos un medicamento!");  
          return false;	
	}  
	if($('input[name="recaudos[]"]').is(':checked')){ 
	}else{  
          jAlert("Debe seleccionar los recuados!");  
          return false;	  
     	}	
	return true;
}
function fn_agregar(){
		var str = $("#form_solicitud_medicina").serialize();
		$.ajax({
			url: '../../../Controladores/controlador_solicitud_medicina.php',
			data: str,
			type: 'post',
			success: function(data){
					if(confirm(data)){	
					abreVentana();
					location.reload();						
					}else{
					location.reload();
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
    miPopup = window.open("../../../Controladores/controlador_solicitud_medicina_PDF.php?cd="+$("#cedTitular").val(),"miwin","width=800px,height=800px,scrollbars=yes,resizable=yes,left="+posicion_x+",top="+posicion_y+""); 
    miPopup.focus();
} 
</script>
</body>
</html>
