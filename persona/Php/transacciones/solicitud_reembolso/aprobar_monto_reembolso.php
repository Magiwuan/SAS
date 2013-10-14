<?php
include_once('../../../Clases/clase_solicitud_reembolso.php');
$sReembolso= new sReembolso();
$codHoja=$_GET['id'];
 $sReembolso->setcodHoja($codHoja);
 $resp=$sReembolso->cabecera_reembolso(); 
 if($resp){
	 $resul=$sReembolso->sig_tupla($resp);	
	
	 $elDia=substr($resul['fecha'],8,2);
		$elMes=substr($resul['fecha'],5,2);
		$elYear=substr($resul['fecha'],0,4);
		$fecha=$elDia."-".$elMes."-".$elYear;	 
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>.:Aprobar Reembolso:.</title>        
  <link rel="stylesheet" type="text/css" href="../../../Css/estilo2.css" />       
    <link rel="stylesheet" type="text/css" href="../../../Css/estilo.css" /> 	
	<link rel="stylesheet" type="text/css" href="../../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../../Css/border-radius.css" /> 	
    <script language="javascript" type="text/javascript" src="../../../JavaScript/jquery-1.4.2.min.js"></script>     
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/jquery.ui.js"></script>    
    <script language="JavaScript" type="text/javascript" src="../../../JavaScript/jquery.asmselect.js"></script>	
     <script language="JavaScript" type="text/javascript" src="../../../JavaScript/sReembolso_jquery.js"></script>	
     <script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){
            $('input#montoAprobado').change(function(event){
			
				amt = parseFloat(this.value);
                $(this).val('Bs ' + amt.toFixed(2));
            });
		var nav4 = window.Event ? true : false;
function IsNumber(evt){
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}
		</script>
</head>
<body> 
<div id="cuerpo1">
<form action="javascript: fn_agregar();" method="POST" id="from_solicitud_reembolso" name="from_solicitud_reembolso">

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
      <td width="100"><input name="fecha2" id="fecha2" type="text" size="8" readonly value="<?php echo $resul['cod_hoja'];  ?>"/></td>
      <td width="265"><input name="op" type="hidden" id="op" value="mSolicitud" hidden="hidden" />
        <input type="hidden" name="idSolicitud_reembolso" id="idSolicitud_reembolso" value="<?php echo $resul['id_solicitud_reembolso']; ?>"></td>
      <td width="179">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Fecha de Emisión:</td>
      <td colspan="3"><input name="fecha" id="fecha" type="text" size="12" maxlength="10" readonly value="<?php echo $fecha; ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nro. C.I titular:</td>
      <td><input name="cedTitular" type="text" id="cedTitular" size="16" readonly value="<?php echo $resul['nacionalidad'].'-'.$resul['cedula']; ?>" /></td>
      <td colspan="2"><div id="cap4" style="color:#FF0000; display:block; width:200px;">
  <input name="vacio" type="text" id="box" size="45" readonly value="<?php echo $resul['apellido1'].' '.$resul['apellido2'].', '.$resul['nombre1'].' '.$resul['nombre2']; ?>"  />
      </div></td>
      </tr>
    <tr>
      <td width="7">&nbsp;</td>
      <td width="120">Beneficiario:</td>
      <td colspan="3"> <?php if($resul['id_beneficiario']=='0'){
      	echo '<input name="beneficiario" type="text" id="beneficiario" size="45" readonly value="Mismo Titular" />';
			echo '<input name="idTitular" type="hidden" id="id" size="6" value="'.$resul['id_titular'].'" />';

         }else{
		echo '<input name="idBeneficiario" type="hidden" id="id" size="6" value="'.$resul['id_beneficiario'].'" />';
		$sReembolso->setidBeneficiario($resul["id_beneficiario"]);
		$consulta_B=$sReembolso->consultar_beneficiario();
		$consulta_B=$sReembolso->sig_tupla($consulta_B);		
		echo '<input name="beneficiario" type="text" id="beneficiario" size="45" readonly value="'.$consulta_B['apellido1'].' '.$consulta_B['apellido2'].', '.$consulta_B['nombre1'].' '.$consulta_B['nombre2'].' '.$consulta_B['nacionalidad'].'-'.$consulta_B['cedula'].'" />';
		 }		 
		 ?></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tipor de Servicio:</td>
      <td colspan="2"><span style="color:#FF0000; display:block; width:200px;">
        <input name="box2" type="text" id="box3" size="45" readonly value="<?php echo $resul['servicio']; ?>" />
      </span></td>
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
    <table  width="677" border="0">
      <tr>
        <td width="747"><div id="ocultar" style="margin:auto; text-align:justify; padding:2px;">
       <fieldset> 
      <legend align="left">Detalle de  Reembolso</legend>
      <div id="capa_datos" style="margin:auto; text-align:justify; padding:2px;">
    <?php   
   	$sReembolso->setidSolicitud_reembolso($resul['id_solicitud_reembolso']);
	$detalle=$sReembolso->Detalle_reembolso();
	?><input id="marco2" type="text" size="16" value=" Nro Factura " style="background:#E1F0FF; text-align:center;" readonly /><input id="marco2" type="text" size="16" value=" Nro Control " style=" background:#E1F0FF; text-align:center;" readonly /><input id="marco2" type="text" size="16" value=" Monto Factura " style="background:#E1F0FF; text-align:center;" readonly /><input id="marco2" type="text" size="16" value=" Monto Aprobado " style="background:#E1F0FF; text-align:center;" readonly /><br><?php
	
	for($i=0;$i<count($detalle);$i++){	
	echo '<input name="nroFactura" type="text" id="nroFactura" size="16" readonly value=" '.$detalle[$i][1].'" />';	
	echo '<input name="nroControl" type="text" id="nroControl" size="16" readonly value=" '.$detalle[$i][2].'" />';
	echo '<input name="montoFactura" type="text" id="montoFactura" size="16" readonly value=" '.$detalle[$i][4].'" />';
	echo '<input name="montoAprobado" type="text" id="montoAprobado"  onkeypress="return IsNumber(event);" size="16" maxlength="11" />'."<br>";
	}
	?></div>
   </fieldset></div></td>
      </tr>
  </table>  
    <fieldset>  
   <legend align="left">Recaudos</legend>
   <table width="680" border="0"  cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td height="24">Diagnostico:</td>
      <td><textarea name="diagnostico" cols="50" rows="2" readonly id="diagnostico"><?php echo $resul['diagnostico']; ?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="24">Obsevación:</td>
      <td><textarea name="observacion" cols="50" rows="2" readonly id="observacion"><?php echo $resul['observacion']; ?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td width="116" height="24">Recaudos:</td>
      <td width="493" rowspan="2"><?php 	include_once("../../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('REEMBOLSOS');
			$consul=$recaudo->lista_recaudo();
			$rsp=$sReembolso->buscar_reacudos_solicitud();
			for($i=0;$i<count($consul);$i++)			
			{				
			if($consul[$i][3]=='REEMBOLSOS'){					
		?><input type="checkbox" name="recaudos[]" id="checkbox" value="<?php echo $consul[$i][1];?>" disabled="disabled"        
           <?php 
                                for($x=0;$x<count($rsp);$x++){	                              
                                 if ($consul[$i][1]==$rsp[$x][1]){echo "checked=\"checked\"";}
                                }?>
        ><?php echo mb_convert_case($consul[$i][2], MB_CASE_TITLE, "utf-8"); ?><br />
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Solicitud de Medicinas. Por favor <a href='#'>click</a></div>";}			
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
   <table  width="662" border="0">
      <tr>
      <td width="276">&nbsp;</td>
      <td width="74"><input name="agregar" type="submit" id="agregar" value="Guardar" class="button" onclick="if(!valMonto()){return false};" />
      </td>
      <td width="298">&nbsp;</td>
      </tr>
  </table>
  
</form>
</div>
<script language="javascript" type="text/javascript">
function valMonto(){

	if($('#montoAprobado').val()==''){
		jAlert('El campo  "Monto Aprobado"  no puede estar vacio','Dialogo de Alerta');
		$('#montoAprobado').focus();
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
		jAlert('El campo \"Monto Aprobado\" es incorrecto. Ej: Bs 000000.00','Dialogo de Alerta');
		$('#montoAprobado').val()='';  
		$('#montoAprobado').focus(); 
		return false; 
	} 
	 return true;
	 
	}	
	function fn_agregar(){		
		var str = $("#from_solicitud_reembolso").serialize();
		$.ajax({
			url: '../../Controladores/controlador_solicitud_reembolso.php',
			data: str,
			type: 'post',
			success: function(data){						
					if(data!=""){
				jAlert(data);
				}
			}
		});
	};	
<?php } ?>
</script>

</body>

</html>