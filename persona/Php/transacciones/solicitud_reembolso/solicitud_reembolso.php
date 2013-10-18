<?php
include_once("../../../Clases/clase_solicitud_reembolso.php");
$sReembolso= new sReembolso();
$res=$sReembolso->buscaUltimoID();
$res=$sReembolso->sig_tupla($res);
$compl='SR-';
$idReembolso='0';
if($res){
	$idReembolso=$res['id_solicitud_reembolso']+1;
}else{
	$idReembolso='1';
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>.:Solicitud Reembolso:.</title>        
 	<link rel="stylesheet" type="text/css" href="../../../Css/estilo2.css" />       
    <link rel="stylesheet" type="text/css" href="../../../Css/estilo.css" /> 	
	<link rel="stylesheet" type="text/css" href="../../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../../Css/border-radius.css" /> 
    <link href="../../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	 	
	
    <script language="javascript" type="text/javascript" src="../../../JavaScript/jquery-1.4.2.min.js"></script>     
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/jquery.ui.js"></script>    
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/jquery.asmselect.js"></script>	
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/sReembolso.js"></script>	
	<script language="javascript" type="text/javascript" src="../../../JavaScript/jquery.alerts.js"></script> 

  <script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){
		    
            $('input#monto').change(function(event){
				amt = parseFloat(this.value);
                $(this).val('Bs ' + amt.toFixed(2));
            });

       
			$("#cedTitular").change(function(event){
				$("#cap4").load('../../../Controladores/control_caja_titular.php?caja='+$("#cedTitular").val());
				$("#cap4").css("display","block");					
					$("#cap4").load('../../../Controladores/control_caja_titular.php?caja='+$("#cedTitular").val(), function(event){
						if ($("#box").val() == "No existen registros relacionados") {
						$("#cap5").css("display","block");	
						$("#cap6").css("display","none");
						}else{						
						$("#beneficiario").load('../../../Controladores/control_select_beneficiario.php?select='+$("#cedTitular").val());					
						$("#cap5").css("display","none");	
						$("#cap6").css("display","block"); 	
						}
					});				
				});	 
		});	
 </script>
 <script language="javascript" type="text/javascript" >	  
	  $(document).ready(function(){		
	    $('#nuevo').click(function(){	
			$('#guardar').removeClass('btn_guardar_desact').addClass('btn_act');
			$('#guardar').attr('disabled', false);	
			$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');		
			$('#agregar').attr('disabled', false);		
			$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
			$('#nuevo').attr('disabled', true);				
			$('#cedTitular').attr('disabled', false);
			$('#Tipo').attr('disabled', false);
			$('#nroFactura').attr('disabled', false);
			$('#nroControl').attr('disabled', false);
			$('#descripcionFactura').attr('disabled', false);
			$('#monto').attr('disabled', false);
			$('#diagnostico').attr('disabled', false);	
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
			$('#cedTitular').attr('disabled', true);
			$('#Tipo').attr('disabled', true);
			$('#nroFactura').attr('disabled', true);
			$('#nroControl').attr('disabled', true);
			$('#descripcionFactura').attr('disabled', true);
			$('#monto').attr('disabled', true);
			$('#diagnostico').attr('disabled', true);	
			$('#observacion').attr('disabled', true);			
			$('input[name="recaudos[]"]').attr('disabled', true);	
			}
    	});	
	 });
</script>



<script type="text/javascript">   
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
icremento =1;
function crear(obj) {
	if(icremento>5){
		$("#capa_datos").css({			     	   
			   	"margin": "auto",
				"text-align":"justify",
				"width": "auto",
				"height": "124px",		
				"padding": "2px",
				"border-radius": "4px",
				"overflow": "auto"
			})
	}	
	var d=$('#nroFactura').val();
	 if (!/^([0-9])*$/.test(d)){
		jAlert('El campo "Nro. Factura" admite solo números','Dialogo de Alerta');
		$('#nroFactura').focus();
		return false;
	 }	 
	if(d==''){
		jAlert('El campo  "Nro. Factura"  no puede estar vacio','Dialogo de Alerta');
		$('#nroFactura').focus();
		return false;	
	}
	var x=$('#nroControl').val();
	 if (!/^([0-9])*$/.test(x)){
		jAlert('El campo "Nro. Control" admite solo números!','Dialogo de Alerta');
		$('#nroControl').focus();
		return false;
	 }
	if(x==''){
		jAlert('El campo  "Nro. Control"  no puede estar vacio','Dialogo de Alerta');
		$('#nroControl').focus();
		return false;	
	}
	if($('#descripcionFactura').val().length < 1){
		jAlert('El campo  "Descripción Factura"  no puede estar vacio','Dialogo de Alerta');
		$('#descripcionFactura').focus();
		return false;	
	}	
	var m=$('#monto').val();
	if($('#monto').val()==''){
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
	
	
	
		var nroFactura = document.getElementById('nroFactura').value;    
//para validar que no repita el medicamento en el arreglo.
	for(var i=0;i<document.getElementsByName('nroFactura[]').length;i++)
	{			 					
		if (document.getElementsByName('nroFactura[]')[i].value==nroFactura){
			alert('Estas intentando Enviar un Nro de Factura de mismas Caracteristicas.\nVerifica los datos!');
			return false;
		}				  
	}	
  field = document.getElementById('capa_datos'); 
  contenedor = document.createElement('div'); 
  contenedor.id = 'div'+icremento; 
  field.appendChild(contenedor); 
//nroFactura 
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'nroFactura'+'[]';
  boton.vAlign= "middle";
  boton.id ='nroFactura';
  boton.value =  document.getElementById('nroFactura').value;    
  boton.readOnly = true;
  boton.size='16';
  contenedor.appendChild(boton); 
//nroControl Campo de texto
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'nroControl'+'[]';
  boton.id = 'nroControl';
  boton.vAlign= "middle";
  boton.value =  document.getElementById('nroControl').value;
  boton.readOnly = true;
  boton.size='16';
  contenedor.appendChild(boton);  
//descripcionFactura Campo de texto
  boton = document.createElement('input'); 
  boton.type = 'hidden'; 
  boton.name = 'descripcionFactura'+'[]';
  boton.id = 'descripcionFactura';
  boton.vAlign= "middle";
  boton.value =  document.getElementById('descripcionFactura').value;
  boton.readOnly = true;
  boton.size='16';
  contenedor.appendChild(boton);      
  //monto Campo de texto
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'monto'+'[]';
  boton.id = 'monto';
  boton.vAlign= "middle";
  boton.value =  document.getElementById('monto').value;
  boton.readOnly = true;
  boton.size='16';
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
</script>
  <style type="text/css">
  .btn_act{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; 
  border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img {background-image: url(../../../Imagen_sistema/add.png);}.btn_act1 {height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../../Imagen_sistema/cancelar.jpg);}.btn_act1 {height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img1 {background-image: url(../../../Imagen_sistema/add.png);}.btn_guardar_act_img1 {background-image: url(../../../Imagen_sistema/guardar.jpg);}.btn_guardar_desact {height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_nuevo_act_img {background-image: url(../../../Imagen_sistema/nuevo.jpg);}
</style>
</head>
<body> 
<div id="cuerpo1">
<form action="" method="POST" id="from_solicitud_reembolso" name="from_solicitud_reembolso">

<table width="664" height="37" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="664" height="37"> <h1>Solicitud de Reembolsos</h1></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left">Datos Principales</legend>
    <table width="671" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td>codigo:</td>
      <td width="100"><input name="fecha2" id="fecha2" type="text" size="8" readonly value="<?php echo $compl.''.$idReembolso; ?>"/></td>
      <td width="243"><input name="op" type="hidden" id="op" value="iSolicitud" hidden="hidden" />
        <input type="hidden" name="codHoja" id="codHoja" value="<?php echo $compl.''.$idReembolso;; ?>"></td>
      <td width="165">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Fecha de Emisión:</td>
      <td colspan="3"><input name="fecha" type="text" id="fecha" value="<?php date_default_timezone_set('America/Caracas'); echo date('d-m-Y') ?>" size="12" maxlength="10" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nro. C.I titular:</td>
      <td><input name="cedTitular" type="text" disabled id="cedTitular" size="16" /></td>
      <td colspan="2"><div id="cap4" style="color:#FF0000; display:block; width:200px;">
        <input name="vacio" type="text" id="box" size="45" readonly />
      </div></td>
      </tr>
    <tr>
      <td width="7">&nbsp;</td>
      <td width="113">Beneficiario:</td>
      <td colspan="3"><div id="cap5" style="color:#FF0000; display:block; width:200px;">*Por favor seleccione un titular</div><div id="cap6" style="display: none; "><select name="beneficiario" id="beneficiario" >
        <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
      </select></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tipor de Servicio:</td>
      <td colspan="2"><select name="Tipo" disabled id="Tipo">
        <option value="0"> seleccionar</option>
        <option value="L">Examenes de Laboratorio</option>
        <option value="I">Examenes de Imagen</option>
        <option value="E">Examenes Especiales</option>
        <option value="C">Orden de Consulta</option>
        <option value="M">Medicinas</option>
      </select></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    </table>    
    
    </fieldset>
    <fieldset> 
      <legend align="left">Detalle de  Reembolso   </legend>
      <table width="668" border="0"  cellpadding="0" cellspacing="0">   
        <tr>
      <td width="11" rowspan="2">&nbsp;</td>
      <td width="125" rowspan="2">Nro. Factura:</td>
      <td width="114" rowspan="2"><label for="medicamento"><span>
        <input name="nroFactura" type="text" disabled id="nroFactura" size="16" onkeypress="return isInteger(event);" />
      </span></label></td>
      <td width="81"></td>
      <td width="301" rowspan="2"><span>
        <input name="nroControl" type="text" disabled id="nroControl" onkeypress="return isInteger(event);" size="16" />
      </span></td>
      <td width="12" rowspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>Nro. Control:</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Descripción Factura:</td>
          <td colspan="4"><textarea name="descripcionFactura" cols="50" rows="2" disabled id="descripcionFactura"></textarea></td>
        </tr>
        <tr>
       <td>&nbsp;</td>
       <td>Monto de Factura:</td>
       <td><input name="monto" type="text" onkeypress="return IsNumber(event);" disabled id="monto" size="16" title="Si el monto es exacto y no lleva decimales agregar '.00' al final" /></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       
        </tr>
     <tr>
       <td>&nbsp;</td>
       <td colspan="5"></td>
       </tr>
    </table>
    
    </fieldset>
  
    <table  width="686" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="288">&nbsp;</td>
        <td width="96">
          <input name="agregar" type="button" disabled class='btn_guardar_desact btn_guardar_act_img' id="agregar"  onclick="if(!crear(this)){return false;}" value="Agregar" /></td>
        <td width="302">&nbsp;</td>
      </tr>      
    </table>
      <div id="ocultar" style="display:none; text-align:justify; margin:auto; padding:4px;">
           <fieldset>
             <input id="marco2" type="text" size="16" value=" Nro Factura " style=" background:#E1F0FF; text-align:center;" readonly/><input id="marco2" type="text" size="16" value=" Nro Control " style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco2" id="marco2" type="text" size="16" value=" Monto " style=" background:#E1F0FF; text-align:center;" readonly/>
             <div id="capa_datos" style="text-align:justify; margin:auto;"></div>
        </fieldset>
    </div>
    <fieldset>  
      <legend align="left">Recaudos
    </legend><table width="680" border="0"  cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td height="24">Diagnostico:</td>
      <td><textarea name="diagnostico" cols="50" rows="2" disabled id="diagnostico"></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="24">Obsevación:</td>
      <td><textarea name="observacion" cols="50" rows="2" disabled id="observacion"></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td width="116" height="24">Recaudos:</td>
      <td width="493" rowspan="2"><?php 	include_once("../../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('REEMBOLSOS');
			$consul=$recaudo->lista_recaudo();
			for($i=0;$i<count($consul);$i++)			
			{
			if($consul[$i][3]=='REEMBOLSOS'){					
		?>
     <input name="recaudos[]" type="checkbox" disabled id="<?php echo $i;?>" value="<?php echo $consul[$i][1];?>">
        <?php setlocale(LC_ALL,'es');  echo "<label  for='$i'>".$consul[$i][2]."</label>"; ?><br>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Solicitud de Reembolso. Por favor <a href='#'>click</a></div>";}			
		}?></td>
      <td width="25">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="24">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     
    </table>
 </fieldset>
    <table  width="773" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="348" align="right"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img' onclick="limpiar_form(this.form)" title="Pulse para activar campos"/></td>
        <td width="425"><input name="guardar" type="submit" class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="guardar" onClick="if(!recuados()){return false;}"  value=" Guardar" /></td>
      </tr>
    </table>
</form>
</div>
<script language="javascript" type="text/javascript">
function recuados(){
	if($("#Tipo").val()=='0'){	
			$('#Tipo').focus();
			return false;	
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
		var str = $("#from_solicitud_reembolso").serialize();
		$.ajax({
			url: '../../../Controladores/controlador_solicitud_reembolso.php',
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
    miPopup = window.open("../../../Controladores/controlador_solicitud_reembolso_PDF.php?cd="+$("#cedTitular").val(),"miwin","width=800px,height=800px,scrollbars=yes,resizable=yes,left="+posicion_x+",top="+posicion_y+""); 
    miPopup.focus();
} 
</script>

</body>

</html>
