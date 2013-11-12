<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
if(empty($_POST['id_beneficiario'])){
		echo "BOOM!! Error :(";
		exit;
	}
include_once("../../Clases/clase_beneficiario.php");
	$beneficiario= new beneficiario();	
	$beneficiario->setidBeneficiario($_POST['id_beneficiario']);
	$consulta=$beneficiario->buscar_id();
	for($i=0;$i<count($consulta);$i++)			
	{
		$id_titular		= $consulta[$i][2];
		$nacionalidad	= $consulta[$i][3];
		$cedula			= $consulta[$i][4];
		$nombre1		= $consulta[$i][5];
		$nombre2		= $consulta[$i][6];
		$apellido1		= $consulta[$i][7];
		$apellido2		= $consulta[$i][8];
		$sexo			= $consulta[$i][9];
		$fecha_n		= $consulta[$i][10];		
		$celular		= $consulta[$i][11];
		$telefono		= $consulta[$i][12];
		$parentesco		= $consulta[$i][13];
		$participacion	= $consulta[$i][14];
		$estado_civ		= $consulta[$i][15];
		$estatus		= $consulta[$i][16];
		
		$elDia=substr($fecha_n,8,2);
		$elMes=substr($fecha_n,5,2);
		$elYear=substr($fecha_n,0,4);
		$fecha_nac=$elDia."-".$elMes."-".$elYear;	
				
	}
?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Modificar Beneficiario:.</title>        
<link rel="stylesheet" type="text/css" href="Css/estilo2.css" />  
<link rel="stylesheet" type="text/css" href="Css/estilo.css" />
<link rel="stylesheet" type="text/css" href="Css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="Css/border-radius.css" /> 
<link href="JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />			
<script src="JavaScript/jscal2.js"></script>    
<script src="JavaScript/es.js"></script> 
<script language="javascript" type="text/javascript" src="JavaScript/beneficiario_jquery.js"></script>
<script language="javascript" type="text/javascript" src="JavaScript/beneficiario.js"></script>   
<script language="javascript" type="text/javascript" src="JavaScript/jquery.alerts.js"></script>
<script language="javascript" type="text/javascript" >
	  $(document).ready(function(){
    	$('#modificar').click(function(){
		$("#cap_dis").load('Php/beneficiario/select_discapacidad.php');
		$('#guardar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#guardar').attr('disabled', false);
		$('#modificar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#modificar').attr('disabled', true);
		
		$('#bt').attr('disabled', false);
		$('#nacionalidad1').attr('disabled', false);
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
     $('#guardar').click(function(){
		if(valida()){	
		fn_guardar();			
		$('#modificar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#modificar').attr('disabled', false);
		$('#guardar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#guardar').attr('disabled', true);	
		
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
</script>
<style style="text/css">
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
  background-image: url(Imagen_sistema/cancelar.jpg);
}
.btn_modificar_act_img{
	  background-image: url(Imagen_sistema/page_edit.png);
}
.btn_cancelar_act_img{
	 margin: auto;
	 background-repeat: no-repeat; 
	 cursor:hand; cursor:pointer;
	 height: 21px;
	 width: 22px;
	 border: 0px;
	 background-image: url(Imagen_sistema/cancelar.jpg);
}
.btn_guardar_act_img{
	  background-image: url(Imagen_sistema/guardar.jpg);
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
}.btn_guardar_desact{
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
}/*.btn_guardar_desact_img{
  background-image: url(Imagen_sistema/guardar_desac.jpg);

}*/.btn_guardar_desact:hover{
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
}.btn_act1 {  height: 23px; 
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
.btn_guardar_desact1 {  height: 23px; 
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
</style>
</head>
<body> 
<div id="cuerpo">
<form action="javascript: fn_modificar();" method="POST" id="form_beneficiario" name="form_beneficiario">
<table width="696" height="25" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="684"><h1>Gestion de Beneficiario</h1></td>
      <td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar_vista_modificar();"/></td>   
    </tr>
  </table>
  <fieldset>
  <legend align="left">Datos Personales</legend>
    <table width="686" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="8" height="30">&nbsp;</td>
      <td width="109">Nacionalidad:</td>
      <td width="187">
      	<input type="radio" name="nacionalidad" id="nacionalidad1" value="V" <?php if($nacionalidad=='V') echo "checked=\"checked\""?> disabled="disabled" >Venezolano 
        <input type="radio" name="nacionalidad" id="nacionalidad2" value="E" <?php if($nacionalidad=='E') echo "checked=\"checked\""?> disabled="disabled"> Extranjero
       </td>
      <td width="135">Nro. C.I o Pasaporte:</td>
      <td colspan="2"><input name="cedula" type="text" disabled id="cedula" value="<?php if($cedula==0){echo "N/A";}else{ echo $cedula;};?>" size="16" readonly />
        <input name="ope" type="hidden" id="ope" value="M" hidden="hidden" />
        <input name="id_beneficiario" type="hidden" id="id_beneficiario" value="<?php echo $_POST['id_beneficiario']; ?>" hidden="hidden" /></td>
      </tr>
    <tr>
      <td height="29">&nbsp;</td>
      <td>Primer Nombre:</td>
      <td><input name="nombre1" type="text" disabled id="nombre1" value="<?php echo $nombre1;?>" size="20"  /></td>
      <td>Segundo Nombre:</td>
      <td colspan="2">
        <input name="nombre2" type="text" disabled id="nombre2" value="<?php echo $nombre2;?>" size="20"  />
      </td>
      </tr>
    <tr>
      <td height="29">&nbsp;</td>
      <td>Primer Apellido:</td>
      <td><input name="apellido1" type="text" disabled id="apellido1" value="<?php echo $apellido1;?>" size="20" /></td>
      <td>Segundo Apellido:</td>
      <td colspan="2">
        <input name="apellido2" type="text" disabled id="apellido2" value="<?php echo $apellido2;?>" size="20" />
      </td>
      </tr>
    <tr>
      <td height="32">&nbsp;</td>
      <td>Sexo:</td>
      <td><input type="radio" name="sexo" id="sexo1" value="F" <?php if($sexo=='F') echo "Checked=\"checked\""?> disabled="disabled" > Femenino        
        <input type="radio" name="sexo" id="sexo2" value="M" <?php if($sexo=='M') echo "Checked=\"checked\""?> disabled="disabled" > Masculino
       </td>
      <td>Fecha de Nacimiento:</td>
      <td width="72"> <input name="fecha_nac" type="text" disabled id="fecha_nac" value="<?php echo $fecha_nac;?>" size="12" maxlength="10" readonly /></td>
      <td width="189"><button name="bt" id="bt" class="button" disabled="disabled"><img src="Imagen_sistema/calend.png" width="20" height="20"/></button>
</td>
    </tr>
        <tr>
      <td height="28">&nbsp;</td>
      <td>Celular:</td>
      <td>
        <input name="celular" type="text" disabled id="celular"  value="<?php echo $celular;?>" size="15" maxlength="12" />
      </td>
      <td>Teléfono:</td>
      <td colspan="2"><input name="telefono" type="text" disabled id="telefono" value="<?php echo $telefono;?>" size="15" maxlength="12"  /></td>
      </tr>
        <tr>
          <td height="29">&nbsp;</td>
          <td>Parentesco:</td>
          <td><select name="parentesco" disabled="disabled" id="parentesco">
            <option value="0" selected> Seleccionar</option>
            <option value="MADRE" <?php if($parentesco=='MADRE') echo "Selected=\"Selected\""; ?>>Madre</option>
            <option value="PADRE" <?php if($parentesco=='PADRE') echo "Selected=\"Selected\""; ?>>Padre</option>
            <option value="ESPOSA" <?php if($parentesco=='ESPOSA') echo "Selected=\"Selected\""; ?>>Esposa</option>
            <option value="CONCUBINATO" <?php if($parentesco=='CONCUBINATO') echo "Selected=\"Selected\""; ?>>Concubinato</option>
            <option value="HIJO" <?php if($parentesco=='HIJO') echo "Selected=\"Selected\""; ?>>Hijo</option>
            <option value="HIJA" <?php if($parentesco=='HIJA') echo "Selected=\"Selected\""; ?>>Hija</option>
          </select></td>
          <td>Participacion:</td>
          <td colspan="2"><input name="participacion" type="text" disabled id="participacion"  value="<?php echo $participacion;?>" size="12"/></td>
        </tr>
    <tr>
      <td height="29">&nbsp;</td>
      <td>Estado Civil:</td>
      <td><select name="estado_civ" disabled="disabled" id="estado_civ">
            <option value="0" selected> Seleccionar</option>
            <option value="S" <?php if($estado_civ=='S') echo "Selected=\"Selected\""; ?>>Soltero</option>
            <option value="C" <?php if($estado_civ=='C') echo "Selected=\"Selected\""; ?>>Casado</option>
            <option value="D" <?php if($estado_civ=='D') echo "Selected=\"Selected\""; ?>>Divorciado</option>
            <option value="V" <?php if($estado_civ=='V') echo "Selected=\"Selected\""; ?>>Viudo</option>
          </select></td>
      <td>Discapacidad:</td>
      <td colspan="2" rowspan="3" valign="top"><select name="discapacidad[]" id="discapacidad" multiple="multiple" title="Seleccionar" >
        <?php	include_once("../../Clases/clase_discapacidad.php");
                    include_once("../../Clases/clase_detalle_discapacidad.php");
                    $discapacidad=new discapacidad();
                    $detalle_disc= new detalle_disc();                    
                    
                    $detalle_disc->setidBeneficiario($_POST['id_beneficiario']);
                    $discapcidades=$detalle_disc->buscar_discapacidades_beneficiario();
                    
                    $lista=$discapacidad->lista_discapacidad();
                    for($i=0;$i<count($lista);$i++)
                    {
                   ?><option value="<?php echo $lista[$i][1];?>" 
                                <?php 
                                    for($x=0;$x<count($discapcidades);$x++)
                                    {
                                        if($lista[$i][1]==$discapcidades[$x][3])
                                        {
                                            echo "Selected=\"Selected\"";
                                        }
                                    }
                                    ?> > <?php echo $lista[$i][2];?></option>
        <?php }?>
      </select></td>
      </tr>
    <tr>
      <td height="28">&nbsp;</td>
      <td>Recaudos:</td>
      <td colspan="2"><?php 	include_once("../../Clases/clase_recaudo.php");
                include_once("../../Clases/clase_detalle_recaudos.php");
                $recaudo= new recaudos();		
                $detalle_rec= new detalle_rec();
                $detalle_rec->setidBeneficiario($_POST["id_beneficiario"]);
                $recaudo->setTiporecaudo('AFILIACIÓN - BENEFICIARIO');
                $consu=$detalle_rec->buscar_recaudos_beneficiario();
                $consul=$recaudo->lista_recaudo();
                for($i=0;$i<count($consul);$i++)			
                 {
                if($consul[$i][3]=='AFILIACIÓN - BENEFICIARIO')
               {								
            ?><input type="checkbox" disabled="disabled" name="recaudos[]" id="checkbox" class="ck" value="<?php echo $consul[$i][1];?>" 
                                <?php 
                                for($x=0;$x<count($consu);$x++)			
                                {	                               
                                    if ($consul[$i][1]==$consu[$x][3]) 
                                    { 	
                                        echo "checked=\"checked\"";
                                    }
                                }
                                 ?> />
        <?php echo $consul[$i][2]; ?>
        <?php		
		}else { echo "<div id='color_error' style='color:#F00'> Alerta: No se han asignado recaudos por Beneficiario</div>";}			
		}?></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      </tr>
    </table>      
</fieldset>
<table  width="720" border="0">
      <tr>
      <td width="263"></td>
      <td width="67"><input name="modificar" type="button" id="modificar" value="  Modificar" class='btn_act btn_modificar_act_img'/></td>
      <td width="67"><input name="guardar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="guardar" onClick="if(!valida()){return false};" value="Guardar" /></td>
      <td width="336">&nbsp;</td>
      </tr>
  </table>
</form>
 </div> 
</body>
</html>
