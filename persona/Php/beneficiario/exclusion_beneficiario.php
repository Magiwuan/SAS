<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><!DOCTYPE HTML>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Exclusion de Beneficiario</title>        
  	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />       
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" /> 	
    <link rel="stylesheet" type="text/css" href="../../JavaScript/jquery.alerts.css" />  	      
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>  
	<script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.ui.js"></script>    
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script> 
    <script language="javascript" type="text/javascript" src="../../JavaScript/beneficiario_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/exclusion.js"></script>
 <style type="text/css">
.btn_act{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(Imagen_sistema/cancelar.jpg);}.btn_nuevo_act_img{background-image: url(Imagen_sistema/bien.png);}.btn_cancelar_act_img{ margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px;  width: 22px; border: 0px; background-image: url(Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{ background-image: url(Imagen_sistema/guardar.jpg);}.btn_act:hover{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}/*.btn_guardar_desact_img{
  background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333; border-right:1px solid #333; border-top:0px; border-left:0px;font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px;outline-width:0px;}#popup{left: 0; position: absolute; top: 0; width: 100%; z-index: 1001;}.content-popup {margin:0px; padding:10px; width:732px;    min-height:250px; border-radius:4px; background-color:#FFFFFF; box-shadow: 0 2px 5px #666666;}.close { position:relative;left:700px;}
</style>
</head>
<body> 
<div id="cuerpo">
<form action="javascript: fn_enviar_eliminar();" method="POST" id="form_exclusion" name="form_exclusion">
<table width="697" height="25" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="685"><h1>Exclusión de Beneficiario</h1></td>
<td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' title=""="Salir"  onclick= "fn_cerrar_vista_modificar();" /></td>
</tr>
</table>
<fieldset>  
  <legend align="left">Motivo de Exclusión</legend>   
    <table width="681" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="47">&nbsp;</td>
        <td width="76" height="23">Recaudos:</td>
        <td width="548" rowspan="2"><?php 	include_once("../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('EXCLUSIÓN - BENEFICIARIO');
			$consul=$recaudo->lista_recaudo();
			for($i=0;$i<count($consul);$i++)			
			{				
				if($consul[$i][3]=='EXCLUSIÓN - BENEFICIARIO'){					
		?><input type="checkbox" name="recaudos[]" id="<?php echo $i;?>" value="<?php echo $consul[$i][1];?>">
        <?php echo "<label  for='$i'>".$consul[$i][2]."</label>"; ?>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos de exclusión. Por favor <a href='#'>click</a></div>";}			
		}?></td> 
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="23">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="57">Motivo:</td>
        <td><textarea name="direccion" id="direccion" cols="45" rows="2"></textarea>
          <input name="ope" type="hidden" id="ope" value="E">
          <input name="idBeneficiario" type="hidden" id="idBeneficiario" value="<?php echo $_POST['id_beneficiario']; ?>">
          <input type="hidden" name="idTitular" id="idTitular" value="<?php echo $_SESSION['id_titular'] ?>"></td>
      </tr>     
    </table>
 </fieldset>
   <table  width="687" border="0" cellpadding="1" cellspacing="1">
      <tr>
      <td width="283">&nbsp;</td>
      <td width="91"><input name="aceptar" type="submit" id="aceptar" value="Aceptar" class='btn_act btn_nuevo_act_img'  />
      </td>
      <td width="299">
      </td>
      </tr>
  </table>  
</form>
</div>
</body>
</html>
